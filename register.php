<?php
session_start();
include "koneksi.php";

if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        echo "username kosong!";
        exit;
    } else if (empty($password)) {
        echo "password kosong!";
        exit;
    }
    
    $pw_hash = password_hash($password,PASSWORD_DEFAULT);
    $stmt = $conn->prepare("select username from users where username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username sudah ada!";
        exit;
    }

    $stmt = $conn->prepare("insert into users (username, password) values (?, ?)");
    $stmt->bind_param("ss", $username, $pw_hash);
    $stmt->execute();
    echo "Registrasi Berhasil!";
}
?>

<html>
    <head>
        <title>Registrasi</title>
    </head>
    <body>
        <form action="register.php" method="post">
            Username <input type="text" class="username" name="username" required><br>
            Password <input type="password" class="password" name="password" required><br>
            <button type="submit" class="btn-register" name="action" value="register">Register</button>
        </form>
        <a href="index.php" class="btn-login">Login</a>
        <style>
        .btn-login {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 14px;
            background: #198754;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        </style>
    </body>
</html>