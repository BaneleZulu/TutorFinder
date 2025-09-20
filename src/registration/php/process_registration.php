<?php
// Handle CORS preflight request
// Allow requests from your frontend (adjust origin in production)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');


// Define the document root as a constant.
// The rtrim() function removes the trailing slash for consistency.
define("ROOT", rtrim($_SERVER["DOCUMENT_ROOT"], '/'));

// Define the other paths using the new constant.
define("DATABASE_PATH", ROOT . "/includes/conn.php");
define("CLASS_PATH", ROOT . "/model/php/User.php");

require_once DATABASE_PATH;
include_once CLASS_PATH;

if (!file_exists(DATABASE_PATH) || !file_exists(CLASS_PATH)):
    http_response_code(401); // No content for OPTIONS
    respondWithJSON("Missing file(s). Couldn't process with process.", 401, false);
endif;

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') :
    http_response_code(204); // No content for OPTIONS
    respondWithJSON('Invalid request method', 204, false);
    exit;
endif;

$input = json_decode(file_get_contents('php://input'), true);
if (empty($input) || !isset($input)):
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Empty param']);
    respondWithJSON('Empty data', 500, false);
    exit;
endif;

// echo json_encode($input, JSON_PRETTY_PRINT | JSON_ERROR_UTF16);

// Validate input
if (!isset($input['email']) || !isset($input['password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}



function validateEmailInDatabase(PDO $pdo, string $email): int
{
    $cmd = $pdo->prepare("SELECT COUNT(email) AS FLAG FROM users WHERE email = :email");
    $cmd->bindParam(':email', $email, PDO::PARAM_STR);
    $cmd->execute();
    $result = $cmd->fetch(PDO::FETCH_ASSOC);
    return (int) $result['FLAG'];
}


try {

    $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    $password = $input['password'];
    $userType = $input['type'];

    // Additional XSS prevention
    if (preg_match('/<script|<\/script>|javascript:/i', $email) || preg_match('/<script|<\/script>|javascript:/i', $password)) {
        http_response_code(400);
        respondWithJSON('Invalid input detected', 400, false);
        exit;
    }

    $flag = validateEmailInDatabase($pdo, $email);
    if ($flag) {
        respondWithJSON("Email is already in use.. Please retry your email or use another email", 409, false);
        $pdo = null;
        exit;
    }

    $user = new User($pdo);
    $userID =  $user->createUser($input);


    $cmd = $pdo->prepare("SELECT users.*,
	students.*
	FROM users
	JOIN students 
	ON users.id = students.id
	WHERE users.id = :id");
    $cmd->execute([':id' => $userID]);

    $results = $cmd->fetch(PDO::FETCH_ASSOC);

    echo json_encode($results, JSON_PRETTY_PRINT, JSON_ERROR_UTF8);
} catch (PDOException $e) {
    http_response_code(500);
    respondWithJSON($e->getMessage() . "|" . $e->getCode(), false, 500);
    error_log('Database error: ' . $e->getMessage());
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred']);
    error_log('Error: ' . $e->getMessage());
}

// Close connection
$pdo = null;
