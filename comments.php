<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $comment = $_POST['comment'];
    $uid = $_SESSION['user_id'];

    mysqli_query($conn,
        "INSERT INTO comments (user_id, comment)
         VALUES ($uid, '$comment')"
    );
}

$result = mysqli_query($conn,
    "SELECT comments.*, users.username
     FROM comments
     JOIN users ON comments.user_id = users.id
     ORDER BY comments.id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comments</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        /* Navbar */
        .navbar {
            background: #0d6efd;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            background: #dc3545;
            padding: 8px 14px;
            border-radius: 4px;
            font-weight: bold;
        }

        .navbar a:hover {
            background: #bb2d3b;
        }

        /* Main container */
        .container {
            width: 60%;
            margin: 30px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
        }

        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            resize: none;
            outline: none;
            font-size: 14px;
        }

        textarea:focus {
            border-color: #0d6efd;
        }

        .btn {
            margin-top: 10px;
            padding: 10px 18px;
            background: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #0b5ed7;
        }

        /* Comments */
        .comment-box {
            margin-top: 25px;
        }

        .comment {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #0d6efd;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .username {
            font-weight: bold;
            color: #0d6efd;
        }

        .time {
            font-size: 12px;
            color: #777;
        }

        .comment-text {
            font-size: 14px;
            color: #333;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div>Welcome, <?= $_SESSION['username'] ?></div>
    <a href="logout.php">Logout</a>
</div>

<!-- Content -->
<div class="container">
    <h2>Comments</h2>

    <form method="post">
        <textarea name="comment" rows="4" placeholder="Write your comment..." required></textarea>
        <button class="btn" name="add">Add Comment</button>
    </form>

    <div class="comment-box">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="comment">
                <div class="comment-header">
                    <div class="username"><?= $row['username'] ?></div>
                    <div class="time"><?= $row['created_at'] ?></div>
                </div>
                <div class="comment-text"><?= $row['comment'] ?></div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
