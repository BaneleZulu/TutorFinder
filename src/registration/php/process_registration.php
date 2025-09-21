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

logResults("Log from api call", json_encode($input["formData"], JSON_PRETTY_PRINT));
logResults("Log from api call2", json_encode($input, JSON_PRETTY_PRINT));
logResults("Log from api call3", json_encode($_POST, JSON_PRETTY_PRINT));

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

function createSessionVariables(array $data, string $userType): void
{
    switch ($userType) {
        case "MENTEE":
            $_SESSION["uuid"] = $data["uuid"];
            $_SESSION["image"] = $data["profile_image"];
            $_SESSION["name"] = $data["fullname"];
            $_SESSION["dob"] = $data["dob"];
            $_SESSION["role"] = $data["user_role"];
            $_SESSION["phone"] = $data["phone"];
            $_SESSION["email"] = $data["email"];
            $_SESSION["address"] = $data["address"];
            $_SESSION["verified"] = $data["is_verified"];
            $_SESSION["education"] = $data["education_level"];
            $_SESSION["3rdEducation"] = $data["tertiary_education"];
            $_SESSION["interest"] = $data["interests"];
            $_SESSION["goals"] = $data["learning_goals"];
            break;
        case "MENTOR":
            $_SESSION["uuid"] = $data["uuid"];
            $_SESSION["image"] = $data["profile_image"];
            $_SESSION["name"] = $data["fullname"];
            $_SESSION["dob"] = $data["dob"];
            $_SESSION["role"] = $data["user_role"];
            $_SESSION["phone"] = $data["phone"];
            $_SESSION["email"] = $data["email"];
            $_SESSION["address"] = $data["address"];
            $_SESSION["verified"] = $data["is_verified"];
            $_SESSION["bio"] = $data["bio"];
            $_SESSION["skills"] = $data["specialities"];
            $_SESSION["exp"] = $data["experience_years"];
            $_SESSION["hrRate"] = $data["hourly_rate"];
            $_SESSION["availStatus"] = $data["availability_status"];
            $_SESSION["rating"] = $data["average_rating"];
            $_SESSION["verified"] = $data["verification_status"];
            $_SESSION["token"] = $data["auth_token"];
            $_SESSION["active"] = $data["is_active"];
            break;
    }
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

    // $user = new User($pdo);
    // define("userID", $user->createUser($input));
    // $results = $user->getUserDetails(userID, $userType);
    // $_SESSION["id"] = userID;
    // createSessionVariables($results, $userType);

    // echo json_encode($results, JSON_PRETTY_PRINT, JSON_ERROR_UTF8);
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
