<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/sign_up.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/signup.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="row">
        <div class="col-12 text-center">
            <header>
                <img src="../images/logo.png" alt="FoodBook" class="img-rounded" title="FoodBook logo" width="100" 
                height="100" id = "logo">
                <h1>FoodBook</h1>
                <h2>SignUp</h2>
            </header>
            
        </div>
    </div>
    <div class="main-content">
        <form method="post" class="row">
            <div class="col-sm-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-pencil"></em></span>
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" maxlength="20" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-user"></em></span>
                    <label for="surname">Surname:</label>
                    <input type="text" class="form-control" placeholder="Surname" name="surname" id="surname" maxlength="20" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-user"></em></span>
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" maxlength="20" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-envelope"></em></span>
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" maxlength="30" required>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-calendar"></em></span>
                    <label for="birth_date">Birth date:</label>
                    <input type="date" class="form-control" name="birth_date" id="birth_date" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-lock"></em></span>
                    <label for="password">Password:</label>
                    <input type="password" id="password" class="form-control" placeholder="Password" name="password" minlength="8" maxlength="20" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-lock"></em></span>
                    <label for="confirm_password">Confirm password:</label>
                    <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" minlength="8" maxlength="20" name="confirm_password" required>
                </div>
                <p id=login_button><a href="login.php">Already have an account?</a></p>
            </div>
            <div class="signupB">
                <button type="submit" class="btn btn-info w-50" name="signup" id="signup">Sign Up</button>
            </div>
        
        </form>
    </div>
</body>
</html>