<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Project</title>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</head>
<body>
<h1>AUTO DEPLOY WORKING 🔥</h1>
<h1>WOYYY BISA DONGGG</h1>
<form id="loginForm">
    <p id="error" style="color:red;"></p>
    Username <input type="text" class="username" required><br>
    Password <input type="password" class="password" required><br>
    <button type="submit">Login</button>
</form>
<a href="registrasi.php" class="btn-register">Register</a>
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
<style>
.btn-register {
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