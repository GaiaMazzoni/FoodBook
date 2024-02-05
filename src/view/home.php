<?php
include_once("../includes/connection.php");
include_once("../includes/header.php");
include_once("../includes/footer.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");
include_once("comment_form.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../js/home.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodBook Home</title>

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

    .collapsible-tags-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-top: 1px solid #eee;
    }

    .tags-button {
        background-color: transparent;
        border: none;
        color: #4f0484;
        cursor: pointer;
    }

    .tags-button:focus {
        outline: none;
    }

    .tags-collapse {
        display: flex;
        flex-wrap: wrap;
    }

    .tag-pill {
        margin-right: 5px;
        margin-bottom: 5px;
        padding: 5px 10px;
        background-color: #4f0484;
        color: #fff;
        border-radius: 20px;
        cursor: pointer;
    }
</style>
<body>
    <?php
        $username = $_SESSION['Username'];
        $followers = get_all_followed($username, $con);
        $posts = get_all_posts_from_followers($followers, $con);
        foreach($posts as $post){
            echo print_post($post['Username'], $post['IdPost'], $con, 1);
        }
    ?>
</body>
</html>
