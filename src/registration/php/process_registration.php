<?php
// Handle CORS preflight request
// Allow requests from your frontend (adjust origin in production)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/conn.php';

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No content for OPTIONS
    respondWithJSON('Invalid request method', 204, false);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (empty($input) || !isset($input)):
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Empty param']);
    respondWithJSON('Empty data', 500, false);
    exit;
endif;


// Validate input
if (!isset($input['email']) || !isset($input['password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

[
    :ALL
    {
        name:
        dob:
        phone:
        password:
        passwordConfirm:
    }
    :MENTEE
    {
        education:
        tertiaryEducation:
        learningGoals:
    }
    :MENTOR
    {
       specialities:
       experienceYears:
       hourlyRate:
       selfie:
       idDocument:
       certificate:
    }

]



try {
    $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    // Additional XSS prevention
    if (preg_match('/<script|<\/script>|javascript:/i', $email) || preg_match('/<script|<\/script>|javascript:/i', $password)) {
        http_response_code(400);
        respondWithJSON('Invalid input detected', 400, false);
        exit;
    }

    // Prepare and execute query
    $stmt = $pdo->prepare("SELECT id, fullname, password, phone, status, is_varified from landlord_tbl WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user['password'])) {
        // Start session and store user data
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['fullname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['status'] = $user['status'];
        $_SESSION['verified'] = $user['is_varified'];

        echo json_encode([
            'success' => true,
            'user' => [
                'id' => htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'),
                'name' => htmlspecialchars($user['fullname'], ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'),
                'phone' => htmlspecialchars($user['phone'], ENT_QUOTES, 'UTF-8'),
                'status' => htmlspecialchars($user['status'], ENT_QUOTES, 'UTF-8'),
                'verified' => htmlspecialchars($user['is_varified'], ENT_QUOTES, 'UTF-8')
            ]
        ]);

        exit;
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
    error_log('Database error: ' . $e->getMessage());
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred']);
    error_log('Error: ' . $e->getMessage());
}

// Close connection
$pdo = null;
