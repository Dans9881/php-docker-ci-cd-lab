<?php
session_start();
require_once "../library.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => false,
        "message" => "Method tidak diizinkan"
    ]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$data = !empty($input) ? $input : $_POST;
$username = strtolower(trim($data['username'] ?? ''));
$password = $data['password'] ?? '';

if ($username === '' || $password === '') {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Username dan password wajib diisi"
    ]);
    exit;
}

$check = $db->sql("SELECT id FROM users WHERE username = ?",['s', $username]);

if (count($check) > 0) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Username sudah terdaftar"
    ]);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$insert_id = $db->sql("INSERT INTO users (username, password) VALUES (?, ?)",['ss', $username, $hash]);
session_regenerate_id(true);
$_SESSION['login'] = true;
$_SESSION['user_id'] = $insert_id;
$_SESSION['username'] = $username;

echo json_encode([
    "status" => true,
    "message" => "Register berhasil"
]);