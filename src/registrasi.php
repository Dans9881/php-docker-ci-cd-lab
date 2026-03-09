<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <script src="/assets/js/jquery-3.7.1.min.js"></script>
<style>
body{
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg,#0f172a,#1e293b);
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0;
}
.card{
    background:white;
    padding:35px;
    border-radius:10px;
    width:320px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}
.card h2{
    text-align:center;
    margin-bottom:20px;
}
input{
    width:100%;
    padding:10px;
    margin-top:8px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:6px;
    font-size:14px;
}
input:focus{
    outline:none;
    border-color:#2563eb;
}
button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:6px;
    background:#2563eb;
    color:white;
    font-weight:bold;
    cursor:pointer;
}
button:hover{
    background:#1d4ed8;
}
#error{
    color:red;
    font-size:14px;
}
#success{
    color:green;
    font-size:14px;
}
.btn-login{
    display:block;
    text-align:center;
    margin-top:15px;
    padding:8px;
    background:#198754;
    color:white;
    text-decoration:none;
    border-radius:6px;
}
.btn-login:hover{
    background:#157347;
}
</style>
</head>
<body>
<div class="card">
<h2>Register</h2>
<form id="registerForm">
<p id="error"></p>
<p id="success"></p>
<label>Username</label>
<input type="text" class="username" required>
<label>Password</label>
<input type="password" class="password" required>
<button type="submit">Register</button>
</form>
<a href="index.php" class="btn-login">Sudah punya akun? Login</a>
</div>
<script>
$(document).ready(function () {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            username: $('.username').val(),
            password: $('.password').val()
        };
        $.ajax({
            url: '/api/register.php',
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
</body>
</html>