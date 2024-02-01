<!DOCTYPE html>
<?php
    session_start();
    include_once 'functions.php';
    include_once("includes/header.php");
    include_once("includes/footer.php");

?>
<head>
    <title>Post</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .post-container {
            max-width: 300px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        .profile-section {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .username {
            font-weight: bold;
        }

        .post-image {
            width: 100%;
            height: auto;
        }

        .icons {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #eee;
        }

        .icon {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .icon img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="post-container">
    <div class="profile-section">
        <img class="profile-image" src="images/profile_pizza.png" alt="">
        <div class="username">username123</div>
    </div>
    <img class="post-image" src="images/logo.png" alt="">
    <div class="icons">
        <div class="icon">
            <img src="images/like-icon.png" alt="Like Icon">
        </div>
        <div class="icon">
            <img src="images/comment-icon.png" alt="Comment Icon">
        </div>
    </div>
</div>

</body>
</html>