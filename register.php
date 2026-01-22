<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registrasi</title>
        <script src="assets/js/jquery-3.7.1.min.js"></script>
    </head>
    <body>
        <form id="registerForm" method="post">
            <p id="error" class="error" style="color:red;"></p>
            <p id="success" class="success" style="color:green;"></p>
            Username <input type="text" class="username" name="username" required><br>
            Password <input type="password" class="password" name="password" required><br>
            <input type="hidden" class="btn-register" name="action" value="register">
            <button type="submit">Register</button>
        </form>
        <a href="index.php" class="btn-login">Sudah Punya Akun? Login</a>
        <script>
            $(document).ready(function () {
                $('#registerForm').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: 'api.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (res) {
                            $('#error').text('');
                            $('#success').text('');
                            if (res.status) {
                                $('#success').text(res.message);
                                setTimeout(function(){
                                    window.location.href = "index.php";
                                }, 1500);
                            } else {
                                $('#error').text(res.message);
                            }
                        },
                        error: function () {
                            $('#error').text('Username Sudah Terdaftar!');
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