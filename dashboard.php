<?php
session_start();
include "auth_page.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">
    <div class="card">
        <h1>🚀 Dashboard</h1>
        <p class="welcome">
        <div class="actions">
            <a href="tickets.php" class="btn btn-primary">🎫 Lihat Tiket</a>
            <a href="logout.php" class="btn btn-danger">🚪 Logout</a>
        </div>
    </div>
</div>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #198754, #0d6efd);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 100%;
    max-width: 400px;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    text-align: center;
}

h1 {
    margin-bottom: 10px;
}

.welcome {
    margin-bottom: 25px;
    font-size: 16px;
}

.actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn {
    display: inline-block;
    padding: 10px;
    text-decoration: none;
    border-radius: 6px;
    color: white;
    font-weight: bold;
    transition: 0.2s;
}

.btn-primary {
    background: #0d6efd;
}

.btn-primary:hover {
    background: #0b5ed7;
}

.btn-danger {
    background: #dc3545;
}

.btn-danger:hover {
    background: #bb2d3b;
}
</style>

</body>
</html>