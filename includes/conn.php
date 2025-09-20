<?php
error_reporting(E_ALL); // Report all PHP errors
ini_set('display_errors', 1); // Display all PHP errors

header('Content-Type: application/json'); // Set the response content type to JSON
header("Access-Control-Allow-Origin: *"); // Allow CORS
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


include($_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php');
function initializeDatabase()
{
    $host = 'localhost';
    $db = 'tutorfinder';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Ensure exceptions are thrown
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        // Log autocommit setting
        $autocommit = $pdo->query('SELECT @@autocommit')->fetchColumn();
        logResults("Autocommit is " . ($autocommit ? "enabled" : "disabled") . ".");

        // Log current database
        $currentDb = $pdo->query('SELECT DATABASE()')->fetchColumn();
        logResults("Connected to database: $currentDb");

        return $pdo;
    } catch (PDOException $e) {
        logResults("Database Connection Failed: " . $e->getMessage());
        respondWithJSON(false, "Database Connection Failed" . $e->getMessage());
        exit;
    }
}


$pdo = initializeDatabase();
