<?php
session_start();
include "koneksi.php";

header('Content-Type: application/json');

$username = $_POST['username'] ?? '';
$password = $_POST['password']?? '';

if ($username == '' || $password == '') {
    echo json_encode([
        "status" => false,
        "message" => "username dan password wajib diisi!"
    ]);
    exit;
}

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "username atau password salah!"
    ]);
    exit;
}
$user = $res->fetch_assoc();

if (!password_verify($password, $user['password'])) {
    echo json_encode([
        "status" => false,
        "message" => "Username atau password salah!"
    ]);
    exit;
}
unset($user['password']);

$_SESSION['login'] = true;
$_SESSION['username'] = $user['username'];

echo json_encode([
    "status" => true,
    "message" => "username dan password wajib diisi!",
    "user" => $user,
], JSON_PRETTY_PRINT);
?>