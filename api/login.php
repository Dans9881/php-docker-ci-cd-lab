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

$users = $db->sql("SELECT id, username, password FROM users WHERE username = ?",['s', $username]);

if (count($users) === 0 || !password_verify($password, $users[0]['password'])) {
    http_response_code(401);
    echo json_encode([
        "status" => false,
        "message" => "Username atau password salah"
    ]);
    exit;
}

$user = $users[0];
session_regenerate_id(true);
$_SESSION['login'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

echo json_encode([
    "status" => true,
    "message" => "Login berhasil",
    "user" => [
        "id" => $user['id'],
        "username" => $user['username']
    ]
]);