<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Project</title>
        <script src="assets/js/jquery-3.7.1.min.js"></script>
    </head>
    <body>
    <form id="loginForm">
        <p id="error" class="error" style="color:red;"></p>
            Username <input type="text" class="username" name="username" required><br>
            Password <input type="password" class="password" name="password" required><br>
            <button type="submit" class="btn-login" name="action" value="login">Login</button>
    </form>
    <a href="register.php" class="btn-register">Register</a>
    <script>
        $(document).ready(function () {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'api.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            window.location.href = 'dashboard.php';
                        } else {
                            $('#error').text(res.message);
                        }
                    },
                    error: function () {
                        $('#error').text('Terjadi Kesalahan Server');
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