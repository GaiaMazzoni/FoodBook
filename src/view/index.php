<?php
include_once("../includes/connection.php");
include_once("../includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>FoodBook login and signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="row">
       <div class="col-sm-12 text-center">
            <img src="../images/logo.png" alt="FoodBook" class="img-rounded" title="FoodBook logo" width="200" 
            height="200" id="logo">
            <h1>FoodBook</h1>
            <p>Join us</p>
            <form method="post" action="../api/index_logics.php">
                <button id="login_button" class="btn btn-info btn-lg" name="login_button"> Log in </button>
                <button id="signup_button" class="btn btn-info btn-lg" name="signup_button">Sign up</button>
            </form>
       </div> 
    </div>
</body>
</html>