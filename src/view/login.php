<?php
    session_start();
    include_once("../includes/connection.php");
    if(isset($_SESSION['login_error'])){
        echo '<div class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
        unset($_SESSION['login_error']);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/login_css.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="row">
        <div class="col-12 text-center">
            <img src="../images/logo.png" alt="FoodBook" class="img-rounded" title="FoodBook logo" width="100px" 
                height="100px" id = "logo">
            <h1>FoodBook</h1>
            <h4>LogIn</h4>
        </div>
    </div>
    <div class="main-content">
        <form action="../api/login_logics.php" method="post" class="row">
            <div class="col-sm-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input type="text" class="form-control" placeholder="Username or e-mail" name="usernameoremail" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <p id="signup_button"><a href="signup.php">Don't have an account?</a></p>
            </div>
            <center><button type="submit" class="btn btn-info w-50" name="login" id="login">Log In</button></center>
        </form>
    </div>
</body>
</html>