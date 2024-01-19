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
    #top_banner{
        box-sizing: border-box;
        background-color: #4f0484;
        position: sticky;
        top: 0px;
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

    <?php
        if(isset($_POST['home_button'])){
            echo "<script>window.open('home.php','_self')</script>";
        }
    ?>
    
</body>
</html>
