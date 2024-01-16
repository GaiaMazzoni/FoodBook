<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        function validatePassword(){
            var password = document.getElementById("password");
            var confirm_password = document.getElementById("confirm_password");

            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Le password non corrispondono");
            } else {
                confirm_password.setCustomValidity('');
            }
        }
    </script>
</head>
<style>
    head + body {
        border: 2px solid black;
    }
    body {
        padding: 0% 7%;
        margin: 3%;
    }
    form>div>div {
        margin: 1%;
        padding: 1%;
    }
    form {
        margin: 2%;
    }
    #signup {
        background-color:  #fccf00;
        border-radius: 30px;
        border: 1px solid #4f0484;
        color: #4f0484;
        padding: 1 1.5%;
    }
    #login {
        text-align: right;
        color: #1E90FF;
        padding: 1%;
    }
    #login a {
        color: inherit; 
        text-decoration: none; 
    }
    #login a:hover {
        text-decoration: underline; 
    }

</style>
<body>
    <div class="row">
        <div class="col-12 text-center">
            <img src="images/logo.png" alt="FoodBook" class="img-rounded" title="FoodBook logo" width="100px" 
                height="100px" id = "logo">
            <h1>FoodBook</h1>
            <h4>SignUp</h4>
        </div>
    </div>
    <div class="main-content">
        <form action="" method="post" class="row">
            <div class="col-sm-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" placeholder="Surname" name="surname" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input type="date" class="form-control" name="birth_date" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" id="password" class="form-control" placeholder="Password" name="password" onkeyup="validatePassword();" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password" onkeyup="validatePassword();" required>
                </div>
                <p id="login"><a href="login.php">Already have an account?</a></p>
                <?php
                    if (isset($_POST['login'])) {
                        header("Location: login.php");
                        exit;
                    }
                ?>
            </div>
            <center><button type="submit" class="btn btn-info w-50" name="signup" id="signup">Sign Up</button></center>
        </form>
    </div>
</body>
</html>