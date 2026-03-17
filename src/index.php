<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login | CICD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <style>
        body{
            background: #f4f6f9;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .login-card{
            width:350px;
        }
    </style>
</head>
<body>
<div class="card shadow login-card">
    <div class="card-body">
        <h4 class="text-center mb-4">Login</h4>
        <p id="error" class="text-danger"></p>
        <form id="loginForm">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>
        </form>
        <div class="text-center mt-3">
            <a href="registrasi.php" class="btn btn-success btn-sm">
                Register
            </a>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            username: $('.username').val(),
            password: $('.password').val()
        };
        $.ajax({
            url: 'api/login.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    window.location.href = "dashboard.php";
                } else {
                    $('#error').text(res.message);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    $('#error').text(xhr.responseJSON.message);
                } else {
                    $('#error').text("Terjadi kesalahan pada server");
                }
            }
        });
    });
});
</script>
</body>
</html>