<?php
require_once "auth.php";
require_once "../library.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "status" => false,
        "message" => "Method tidak diizinkan"
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];
$user = $db->sql("SELECT id, username FROM users WHERE id = ?",['i', $user_id]);

if (count($user) === 0) {
    http_response_code(404);
    echo json_encode([
        "status" => false,
        "message" => "User tidak ditemukan"
    ]);
    exit;
}

echo json_encode([
    "status" => true,
    "user" => $user[0]
]);