<?php
include "connection.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Registration failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

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
            border-color: #28a745;
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

        .btn-register {
            background: #28a745;
            color: white;
        }

        .btn-register:hover {
            background: #218838;
        }

        .btn-login {
            background: #0d6efd;
            color: white;
            margin-top: 10px;
            text-decoration: none;
            display: block;
            text-align: center;
            line-height: 40px;
            height: 40px;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-login:hover {
            background: #0b5ed7;
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
    <h2>Create Account</h2>

    <?php if (!empty($error)) { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="btn btn-register" name="register">Register</button>
    </form>

    <a class="btn-login" href="login.php">Back to Login</a>

    <div class="small">
        Comment System Project
    </div>
</div>

</body>
</html>
