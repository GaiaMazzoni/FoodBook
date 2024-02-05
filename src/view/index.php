<?php
include_once("../includes/connection.php");
include_once("../functions.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>FoodBook login and signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body{
        overflow-x: hidden;
    }
    #signup_button{
        width: 200px;
        border-radius: 30px;
        background-color: #fccf00;
        border: 1px solid #4f0484;
        color: #4f0484;
    }
    #login_button{
        width: 200px;
        border-radius: 30px;
        background-color: #4f0484;
        border: 1px solid #fccf00;
        color: #fccf00;
    }
    form {
        padding: 2%;
    }
</style>
<body>
    <div class="row">
       <div class="col-sm-12 text-center">
            <img src="../images/logo.png" alt="FoodBook" class="img-rounded" title="FoodBook logo" width="200px" 
            height="200px" id = "logo">
            <h1>FoodBook</h1>
            <p>Join us</p>
            <form method="post" action="">
                <button id="signup_button" class="btn btn-info btn-lg" name="signup_button">Sign up</button></br></br>
            </form>
       </div> 
    </div>
</body>
</html>