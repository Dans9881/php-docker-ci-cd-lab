<?php
include "auth.php";
?>

<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <h1>Welcome To My Project</h1>
        <p>Halo, <?php echo $_SESSION['username']; ?></p>
        <a href="logout.php" class="btn-logout">Logout</a>
        <style>
        .btn-logout {
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