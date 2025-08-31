<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorfinder";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle win_enabled checkbox

        file_put_contents('log.txt', json_encode($_POST, JSON_PRETTY_PRINT), FILE_APPEND);
        echo json_encode(['status' => 'success', 'message' => 'Prizes and state updated']);
        exit;


        $win_enabled = isset($_POST['win_enabled']) ? 1 : 0;
        $stmt = $conn->prepare("INSERT INTO spin_state (win_enabled) VALUES (?)");
        $stmt->execute([$win_enabled]);

        // Handle prizes
        if (isset($_POST['prizes']) && is_array($_POST['prizes'])) {
            foreach ($_POST['prizes'] as $prize) {
                // Sanitize inputs to prevent SQL injection
                $name = trim($prize['name'] ?? '');
                $description = trim($prize['description'] ?? '');
                $color = trim($prize['color'] ?? '');
                $icon = trim($prize['icon'] ?? '');
                $id = (int)($prize['id'] ?? 0);

                if (empty($name) || empty($description)) {
                    continue; // Skip invalid entries
                }

                if ($id == 0) {
                    // Insert new prize
                    $stmt = $conn->prepare("INSERT INTO spin_win (name, description, color, icon) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$name, $description, $color, $icon]);
                } else {
                    // Update existing prize
                    $stmt = $conn->prepare("UPDATE spin_win SET name = ?, description = ?, color = ?, icon = ? WHERE id = ?");
                    $stmt->execute([$name, $description, $color, $icon, $id]);
                }
            }
        }

        // Return JSON response for AJAX
        echo json_encode(['status' => 'success', 'message' => 'Prizes and state updated']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
