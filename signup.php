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
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-6 text-md-right text-sm-center">
                <img src="images/logo.png" alt="FoodBook" class="img-rounded" title="FoodBook logo" width="200px" 
                height="200px" id = "logo">
        </div>
        <div class="col-sm-12 col-md-6 text-md-left text-sm-center">
            <h1>FoodBook</h1>
            <h4>SignUp</h4>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="main-content">
                <form action="" method="post">
                    <div class="col-sm-12 col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                <input type="text" class="form-control" placeholder="First Name" name="first_name">
                            </div>
                            
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" placeholder="Username" name="username" required>
                            </div>
                            
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" id="password" class="form-control" placeholder="Password" name="password" onkeyup="validatePassword();" required>
                            </div>
                        
                    </div>
                    <div class="col-sm-12 col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" placeholder="Surname" name="surname" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input type="date" class="form-control" name="birth_date" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password" onkeyup="validatePassword();" required>
                            </div>
                    </div>
                    <center><button type="submit" class="btn btn-info btn-block" name="signup">Sign Up</button></center>
                </form>
            </div>
        </div>
    </div>
</body>
</html>