<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    h1{
        margin: 0;
    }
    body {
        position: relative;
        padding-top: 50px; /* Adjusted padding for top banner */
    }
    button{
        background-color: #fccf00;
    }
    #top_banner {
        box-sizing: border-box;
        background-color: #4f0484;
        position: sticky;
        top: 0;
        width: 100%;
        padding: 10px; /* Added padding */
        text-align: center;
        color: white;
    }
    #bottom_banner {
        box-sizing: border-box;
        background-color: #4f0484;
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 5%;
        text-align: center;
        padding: 10px; /* Added padding */
    }
    #description {
        width: 100%; /* Make the textarea take up the full width */
        height: 100px; /* Set an initial height for better appearance */
    }
    #imageSelection {
        width: 100%; /* Make the image selection input take up the full width */
        margin-bottom: 10px; /* Added margin for spacing */
    }
</style>
<body>

    <div class="row">
        <div class="col-sm-12 text-center">
            <div id="top_banner">
                <form method="post">
                    <button id="back" class="back_button" name="back">Back</button>
                    <h1>New Post</h1>
                    <button id="publish" class="publish_button" name="publish">Publish</button>
                </form>
            </div>
                
            <?php
                include 'functions.php';
                include ("includes/connection.php");

                session_start();

                if(isset($_POST['back'])){
                    echo "<script>window.open('new_post.php','_self')</script>";
                }

                if(isset($_POST['publish'])){
                    add_post($_SESSION['Username'], $_SESSION['Description'],$con);
                    echo "<script>window.open('home.php','_self')</script>";
                }
            ?>

        </div>
    </div>
    <form method="post">
    <div id="Food Types" class="btn-group">
        <button class="btn btn-primary" name="Appetizer">Appetizer</button>
        <button class="btn btn-primary" name="Cocktail">Cocktail</button>
        <button class="btn btn-primary" name="Dessert">Dessert</button>
        <button class="btn btn-primary" name="Drink">Drink</button>
        <button class="btn btn-primary" name="Fish">Fish</button>
        <button class="btn btn-primary" name="Main course">Main course</button>
        <button class="btn btn-primary" name="Meat">Meat</button>
        <button class="btn btn-primary" name="Salad">Salad</button>
        <button class="btn btn-primary" name="Snack">Snack</button>
        <button class="btn btn-primary" name="Soup">Soup</button>
    </div>

    <div id="Time" class="btn-group">
        <button class="btn btn-primary" name="15min">15min</button>
        <button class="btn btn-primary" name="30min">30min</button>
        <button class="btn btn-primary" name="45min">45min</button>
        <button class="btn btn-primary" name="1h+">>1h+</button>
    </div>

    <div id="Diet" class="btn-group">
        <button class="btn btn-primary" name="Gluten-free">Gluten-free</button>
        <button class="btn btn-primary" name="Pescetarian">Pescetarian</button>
        <button class="btn btn-primary" name="Vegan">Vegan</button>
        <button class="btn btn-primary" name="Vegetarian">Vegetarian</button>
    </div>

    <div id="Difficutly" class="btn-group">
        <button class="btn btn-primary" name="Beginner">Beginner</button>
        <button class="btn btn-primary" name="Intermediate">Intermediate</button>
        <button class="btn btn-primary" name="Expert">Expert</button>
    </div>

    <div id="Budget" class="btn-group">
        <button class="btn btn-primary" name="$">$</button>
        <button class="btn btn-primary" name="$$">$$</button>
        <button class="btn btn-primary" name="$$$">$$$</button>
    </div>
    </form>
</body>

    

    
    
</body>
</html>