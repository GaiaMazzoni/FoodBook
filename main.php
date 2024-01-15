<!DOCTYPE html>
<html>
<head>
    <title>FoodBook login and signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    body{
        overflow-x: hidden;
    }
    #signup{
        width: 60%;
        border-radius: 30px;
    }
    #login{
        width: 60%;
        border-radius: 30px;
        background-color: #fff;
        border: 1px solid #1da1f2;
        color: #1da1f2;
    }
</style>
<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <center><h1>FoodBook</h1></center>
            </div>
        </div>
    </div>
    <div class="row">
       <div class="col-sm-6" style="left:8%;">
            <img src="images/logo.png" alt="FoodBook" class="img-rounded" title="FoodBook logo" width="650px" 
            height="565px">
            <form method="post" action="">
                <button id="signup" class="btn btn-info btn-lg" name="signup">Sign up</button></br></br>
                <?php
                    if(isset($_POST['signup'])){
                        echo "<script>window.open('signup.php','_self')</script>";
                    }
                ?>
                <button id="login" class="btn btn-info btn-lg" name="login">Log in</button></br></br>
                <?php
                    if(isset($_POST['login'])){
                        echo "<script>window.open('login.php','_self')</script>";
                    }
                ?>
            </form>
       </div> 
    </div>
</body>
</html>