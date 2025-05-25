<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once('./includes/conn.php');


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=tutorfinder_test_db', 'your_username', 'your_password');
    $type = $_GET['type'] ?? 'Getting Started';
    $valid_types = ['Getting Started', 'Pricing and Payments', 'Finding and Booking Tutors', 'Sessions and Learning', 'Tutor Quality and Safety', 'For Parents', 'Technical Support', 'Special Needs and Accommodations', 'International and Language Support'];
    if (!in_array($type, $valid_types)) $type = 'Getting Started';
    $stmt = $pdo->prepare('SELECT question, answer FROM faqs WHERE type = ?');
    $stmt->execute([$type]);
    $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['faqs' => $faqs]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error occurred']);
}
