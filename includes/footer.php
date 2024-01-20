<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    button{
        background-color: #fccf00;
    }
    #bottom_banner{
        box-sizing: border-box;
        background-color: #4f0484;
        position: fixed;
        bottom: 0;
        width: 99.8%;
        height: 30px;
        padding: 0.2%;
        margin: 0.1%;
    }
</style>
<body>
    <form method="post">
    <div id="bottom_banner" class="bottom-banner row">
        <div class="col-xs-6 text-left">
            <button class="new_post_button" name="new_post_button">NewPost</button>
        </div>
        <div class="col-xs-6 text-right">
            <button class="profile_button" name="profile_button">Profile</button>
        </div>
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
