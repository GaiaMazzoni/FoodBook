<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    #login {
        background-color:  #fccf00;
        border-radius: 30px;
        border: 1px solid #4f0484;
        color: #4f0484;
        padding: 1 1.5%;
    }
    #signup {
        text-align: right;
        color: #1E90FF;
        padding: 1%;
    }
    #signup a {
        color: inherit; 
        text-decoration: none; 
    }
    #signup a:hover {
        text-decoration: underline; 
    }

</style>
<body>
    <div class="row">
        <div class="col-12 text-center">
            <img src="images/logo.png" alt="FoodBook" class="img-rounded" title="FoodBook logo" width="100px" 
                height="100px" id = "logo">
            <h1>FoodBook</h1>
            <h4>LogIn</h4>
        </div>
    </div>
    <div class="main-content">
        <form action="login_logics.php" method="post" class="row">
            <div class="col-sm-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input type="text" class="form-control" placeholder="Username or e-mail" name="username" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input type="text" class="form-control" placeholder="Password" name="password" required>
                </div>
                <p id="signup"><a href="signup.php">Don't have an account?</a></p>
            </div>
            <center><button type="submit" class="btn btn-info w-50" name="login" id="login">Log In</button></center>
        </form>
    </div>
</body>
</html>