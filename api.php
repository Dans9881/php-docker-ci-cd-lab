<?php
session_start();
require_once "library.php";

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$data = !empty($input) ? $input : $_POST;

$action   = $data['action'] ?? '';
$username = strtolower(trim($data['username'] ?? ''));
$password = $data['password'] ?? '';

if ($username === '' || $password === '') {
    http_response_code(404);
    echo json_encode([
        "status" => false,
        "message" => "Username dan password wajib diisi!"
    ]);
    exit;
}

switch ($action) {
    case 'login':
        $users = $db->sql("select id, username, password from users where username = ?", ['s',$username]);

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
        break;

    case 'register':
        $register = $db->sql("select id from users where username = ?", ['s', $username]);

        if (count($register) > 0) {
            http_response_code(400);
            echo json_encode([
                "status" => false,
                "message" => "Username sudah terdaftar"
            ]);
            exit;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $insert_id = $db->sql("insert into users (username, password) values (?, ?)", ['ss', $username, $hash]);
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $insert_id;
        $_SESSION['username'] = $username;

        echo json_encode([
            "status" => true,
            "message" => "Berhasil Membuat Akun"
        ]);
        break;

    default:
        http_response_code(400);
        echo json_encode([
            "status" => false,
            "message" => "Action tidak valid"
        ]);
}
?>