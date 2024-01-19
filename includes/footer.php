<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    body{
        position: relative;
    }
    button{
        background-color: #fccf00;
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
    <div id="bottom_banner" class="bottom-banner">
        <button class="new_post_button" name="new_post_button">NewPost</button>
        <button class="profile_button" name="profile_button">Profile</button>
    </div>
    </form>

    <?php
        if(isset($_POST['new_post_button'])){
            echo "<script>window.open('new_post.php','_self')</script>";
        }
        if(isset($_POST['profile_button'])){
            echo "<script>window.open('profile.php','_self')</script>";
        }
    ?>
    
</body>
</html>
