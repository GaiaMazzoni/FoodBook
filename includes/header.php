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
    #top_banner{
        box-sizing: border-box;
        background-color: #4f0484;
        position: fixed;
        z-index: 1000;
        top: 0;
        width: 99.8%;
        height: 5%;
        padding: 0.2%;
        margin: 0.1%;
    }
    body {
        padding-top: 5%;
    }
</style>
<body>
    <form method="post">
    <div id="top_banner" class="top-banner row">
        <div class="col-xs-4 text-left">
            <button class="home_button" name="home_button">Home</button>
        </div>
        <div class="col-xs-4 text-center">
            <button class="search_button" name="search_button">Search</button>
        </div>
        <div class="col-xs-4 text-right">
            <button class="notification_button" name="notification_button">Notifications</button>
        </div>
    </div>

    <?php
        if(isset($_POST['home_button'])){
            echo "<script>window.open('home.php','_self')</script>";
        }
        if(isset($_POST['search_button'])){
            echo "<script>window.open('search.php','_self')</script>";
        }
    ?>
    
</body>
</html>
