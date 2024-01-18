<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </style>
    <title>Responsive Interface</title>
</head>
<style>
    body{
        position: relative;
    }
    button{
        background-color: #fccf00;
    }
    #top_banner{
        box-sizing: border-box;
        background-color: #4f0484;
        position: sticky;
        top: 0px;
        width: 100%;
        height: 5%;
    }
    #bottom_banner{
        box-sizing: border-box;
        background-color: #4f0484;
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 5%;
    }
</style>
<body>
    <form method="post">
    <div id="top_banner" class="top-banner">
        <button class="home_button" name="home_button">Home</button>
        <button class="search_button" name="search_button">Search</button>
        <button class="notification_button" name="notification_button">Notifications</button>
    </div>

    <div id="bottom_banner" class="bottom-banner">
        <button class="new_post_button" name="new_post_button">NewPost</button>
        <button class="profile_button" name="profile_button">Profile</button>
    </div>
    </form>

    <?php
        if(isset($_POST['home_button'])){
            echo "<script>window.open('home.php','_self')</script>";
        }
        if(isset($_POST['new_post_button'])){
            echo "<script>window.open('new_post.php','_self')</script>";
        }
        if(isset($_POST['profile_button'])){
            echo "<script>window.open('profile.php','_self')</script>";
        }
    ?>
    
</body>
</html>
