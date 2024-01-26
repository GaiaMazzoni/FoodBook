<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </style>
    <title>Responsive Interface</title>
    <?php
    include("includes/header.php");
    include("includes/footer.php");
    include("includes/connection.php");
    include("functions.php");
    ?>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .post-container {
            max-width: 600px;
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

        .interaction-icons {
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

        .profile-section a {
            display: flex; 
            align-items: center; 
            text-decoration: none;
            color: inherit;
        }

        .post-description{
            padding: 10px;
        }
    </style>
</style>
<body>
    <?php
        $username = $_SESSION['Username'];
        $followers = get_all_followed($username, $con);
        $posts = get_all_posts_from_followers($followers, $con);
        foreach($posts as $post){
            echo print_post($post['Username'], $post['IdPost'], $con);
        }
    ?>
</body>
</html>
