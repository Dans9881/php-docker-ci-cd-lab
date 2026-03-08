<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <script src="./assets/js/jquery-3.7.1.min.js"></script>
</head>
<body>

<form id="registerForm">
    <p id="error" style="color:red;"></p>
    <p id="success" style="color:green;"></p>
    Username <input type="text" name="username" class="username" required><br>
    Password <input type="password" name="password" class="password" required><br>
    <button type="submit">Register</button>
</form>
<a href="index.php" class="btn-login">Sudah punya akun? Login</a>
<script>
$(document).ready(function () {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            username: $('.username').val(),
            password: $('.password').val()
        };
        $.ajax({
            url: 'api/register.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            dataType: 'json',
            success: function (res) {
                $('#error').text('');
                $('#success').text('');
                if (res.status) {
                    $('#success').text(res.message);
                    setTimeout(function(){
                        window.location.href = "index.php";
                    }, 1000);
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