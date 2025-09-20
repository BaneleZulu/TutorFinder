<?php

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function generateUuidV4()
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    private function generateAuthToken()
    {
        return bin2hex(random_bytes(32)); // Simple token; consider JWT for production
    }



    // Create a new user with role-specific data
    public function createUser(array $userData): int
    {
        // $uuid = $this->generateUuidV4();
        $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
        $userType = $userData['type'];

        $stmt = $this->pdo->prepare(
            "INSERT INTO users (uuid, fullname, dob, user_role, phone, email, password) 
             VALUES (UUID(), :fullname, :dob, :role, :phone, :email, :password)"
        );
        logResults("Executing statement: " . $stmt->queryString . " | Insert params: " . json_encode($userData, JSON_PRETTY_PRINT | JSON_ERROR_UTF8));
        $stmt->execute([
            ":fullname" => $userData['fullname'],
            ":dob" => $userData['dob'],
            ":role" => $userData['type'],
            ":phone" => $userData['phone'],
            ":email" => $userData['email'],
            ":password" => $hashedPassword,
        ]);

        $userId = $this->pdo->lastInsertId();

        if ($userType === 'MENTEE') {
            $this->createStudent($userId, $userData);
        } elseif ($userType === 'MENTOR') {
            $this->createTutor($userId, $userData);
        }
        // For ADMIN, no additional table

        return $userId;
    }

    private function createStudent(int $userId, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO students (id, education_level, tertiary_education, interests, learning_goals) 
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $userId,
            $data['education_level'] ?? null,
            $data['tertiary_education'] ?? null,
            $data['interests'] ?? null,
            $data['learning_goals'] ?? null
        ]);
    }

    private function createTutor(int $userId, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO tutors (id, bio, experience_years, hourly_rate, availability_status, average_rating, verification_status) 
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $userId,
            $data['bio'] ?? null,
            $data['experience_years'] ?? 0,
            $data['hourly_rate'] ?? null,
            $data['availability_status'] ?? 'available',
            $data['average_rating'] ?? 0,
            $data['verification_status'] ?? 'Pending'
        ]);

        $tutorUuid = $this->generateUuidV4();
        $authToken = $this->generateAuthToken();

        $stmt = $this->pdo->prepare(
            "INSERT INTO tutor_auth (id, tutor_uuid, auth_token, is_active) 
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$userId, $tutorUuid, $authToken, 1]);
    }

    // User login with history logging
    public function login(string $email, string $password, string $ip, string $hostname, string $device): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $status = ($user && password_verify($password, $user['password'])) ? 'success' : 'failed';

        $this->logLoginHistory($user['id'] ?? 0, $ip, $hostname, $device, $status); // Log even if failed (user_id=0 for unknown)

        if ($status === 'success') {
            if ($user['user_role'] === 'MENTOR') {
                $this->updateTutorLastLogin($user['id']);
            }
            return $user;
        }

        return false;
    }

    private function logLoginHistory(int $userId, string $ip, string $hostname, string $device, string $status): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO login_history (user_id, ip_address, hostname, device_type, login_status) 
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$userId, $ip, $hostname, $device, $status]);
    }

    private function updateTutorLastLogin(int $tutorId): void
    {
        $stmt = $this->pdo->prepare("UPDATE tutor_auth SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$tutorId]);
    }

    // Get user by ID
    public function getUserById(int $id): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user data
    public function updateUser(int $id, array $data): bool
    {
        $fields = [];
        $params = [];
        foreach ($data as $key => $value) {
            if ($key === 'password') {
                $value = password_hash($value, PASSWORD_DEFAULT);
            }
            $fields[] = "$key = ?";
            $params[] = $value;
        }
        $params[] = $id;

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    // Delete user (cascades to related tables)
    public function deleteUser(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Deactivate user (set is_verified to 0)
    public function deactivateUser(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE users SET is_verified = 0 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Deactivate tutor (set is_active to 0 in tutor_auth)
    public function deactivateTutor(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE tutor_auth SET is_active = 0 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Revoke tutor auth token
    public function revokeTutorToken(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE tutor_auth SET auth_token = NULL WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Add verification document
    public function addVerificationDocument(int $userId, string $type, string $url): int
    {
        $uuid = $this->generateUuidV4();
        $stmt = $this->pdo->prepare(
            "INSERT INTO verification_documents (uuid, user_id, document_type, document_url) 
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$uuid, $userId, $type, $url]);
        return $this->pdo->lastInsertId();
    }

    // Verify a document
    public function verifyDocument(int $docId, bool $isVerified, string $notes = null): bool
    {
        $verifiedAt = $isVerified ? 'CURRENT_TIMESTAMP' : 'NULL';
        $stmt = $this->pdo->prepare(
            "UPDATE verification_documents SET is_verified = ?, verified_at = $verifiedAt, verification_notes = ? WHERE id = ?"
        );
        return $stmt->execute([$isVerified ? 1 : 0, $notes, $docId]);
    }

    // Get login history for a user
    public function getLoginHistory(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM login_history WHERE user_id = ? ORDER BY login_time DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update student-specific data
    public function updateStudent(int $id, array $data): bool
    {
        $fields = [];
        $params = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $params[] = $value;
        }
        $params[] = $id;

        $sql = "UPDATE students SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    // Update tutor-specific data
    public function updateTutor(int $id, array $data): bool
    {
        $fields = [];
        $params = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $params[] = $value;
        }
        $params[] = $id;

        $sql = "UPDATE tutors SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    // Update tutor auth data (e.g., regenerate token)
    public function regenerateTutorToken(int $id): string|false
    {
        $newToken = $this->generateAuthToken();
        $stmt = $this->pdo->prepare("UPDATE tutor_auth SET auth_token = ? WHERE id = ?");
        if ($stmt->execute([$newToken, $id])) {
            return $newToken;
        }
        return false;
    }

    // Get verification documents for a user
    public function getVerificationDocuments(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM verification_documents WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
