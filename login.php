<?php
session_start();
include "connection.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($q);

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: comments.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            width: 360px;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.10);
        }

        h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            margin-bottom: 14px;
        }

        input:focus {
            border-color: #0d6efd;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
        }

        .btn-login {
            background: #0d6efd;
            color: white;
        }

        .btn-login:hover {
            background: #0b5ed7;
        }

        .btn-register {
            background: #28a745;
            color: white;
            margin-top: 10px;
            text-decoration: none;
            display: block;
            text-align: center;
            line-height: 40px;
            height: 40px;
        }

        .btn-register:hover {
            background: #218838;
        }

        .error {
            background: #ffe5e5;
            color: #b30000;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 12px;
            text-align: center;
        }

        .small {
            text-align: center;
            color: #777;
            font-size: 13px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="box">
    <h2>Login</h2>

    <?php if (!empty($error)) { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="btn btn-login" name="login">Login</button>
    </form>

    <a class="btn btn-register" href="register.php">Create New Account</a>

    <div class="small">
        Comment System Project
    </div>
</div>

</body>
</html>
