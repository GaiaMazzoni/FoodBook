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
<?php
    include 'functions.php';
    include 'includes/connection.php';
 
    session_start();

    if (isset($_POST['back'])) {
        echo "<script>window.open('new_post.php','_self')</script>";
    }

    if (isset($_POST['publish'])) {
        $username = $_SESSION['Username'];
        $description = $_SESSION['Description'];
        add_post($username, $description, $con);
        print_r("added post");
        $idPost = get_last_post_id($_SESSION['Username'],$con);
        if (isset($_POST['Appetizer'])) {
            add_tag("Appetizer",$idPost,$username,$con);
        }
        if (isset($_POST['Cocktail'])) {
            add_tag("Cocktail",$idPost,$username,$con);
        }
        if (isset($_POST['Dessert'])) {
            add_tag("Dessert",$idPost,$username,$con);
        }
        if (isset($_POST['Drink'])) {
            add_tag("Drink",$idPost,$username,$con);
        }
        if (isset($_POST['Fish'])) {
            add_tag("Fish",$idPost,$username,$con);
        }
        if (isset($_POST['Main course'])) {
            add_tag("Main course",$idPost,$username,$con);
        }
        if (isset($_POST['Meat'])) {
            add_tag("Meat",$idPost,$username,$con);
        }
        if (isset($_POST['Salad'])) {
            add_tag("Salad",$idPost,$username,$con);
        }
        if (isset($_POST['Snack'])) {
            add_tag("Snack",$idPost,$username,$con);
        }
        if (isset($_POST['Soup'])) {
            add_tag("Soup",$idPost,$username,$con);
        }
        if (isset($_POST['15min'])) {
            add_tag("15min",$idPost,$username,$con);
        }
        if (isset($_POST['30min'])) {
            add_tag("30min",$idPost,$username,$con);
        }
        if (isset($_POST['45min'])) {
            add_tag("45min",$idPost,$username,$con);
        }
        if (isset($_POST['1h-2h'])) {
            add_tag("1h-2h",$idPost,$username,$con);
        }
        if (isset($_POST['2h-3h'])) {
            add_tag("2h-3h",$idPost,$username,$con);
        }
        if (isset($_POST['3h-4h'])) {
            add_tag("3h-4h",$idPost,$username,$con);
        }
        if (isset($_POST['4h+'])) {
            add_tag("4h+",$idPost,$username,$con);
        }
        if (isset($_POST['Gluten-free'])) {
            add_tag("Gluten-free",$idPost,$username,$con);
        }
        if (isset($_POST['Pescetarian'])) {
            add_tag("Pescetarian",$idPost,$username,$con);
        }
        if (isset($_POST['Vegan'])) {
            add_tag("Vegan",$idPost,$username,$con);
        }
        if (isset($_POST['Vegetarian'])) {
            add_tag("Vegetarian",$idPost,$username,$con);
        }
        if (isset($_POST['Beginner'])) {
            add_tag("Beginner",$idPost,$username,$con);
        }
        if (isset($_POST['Intermediate'])) {
            add_tag("Intermediate",$idPost,$username,$con);
        }
        if (isset($_POST['Expert'])) {
            add_tag("Expert",$idPost,$username,$con);
        }
        if (isset($_POST['$'])) {
            add_tag("$",$idPost,$username,$con);
        }
        if (isset($_POST['$$'])) {
            add_tag("$$",$idPost,$username,$con);
        }
        if (isset($_POST['$$$'])) {
            add_tag("$$$",$idPost,$username,$con);
        }
        //echo "<script>window.open('home.php','_self')</script>";
    }
?>
<style>
    h1{
        margin: 0;
    }
    body {
        position: relative;
        padding-top: 50px;
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
        padding: 10px;
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
        padding: 10px;
    }
    #description {
        width: 100%; 
        height: 100px;
    }
    #imageSelection {
        width: 100%; 
        margin-bottom: 10px;
    }
    .select{
        background-color: #fccf00;
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
                
        </div>
    </div>
    <form method="post">
    <div id="FoodTypes" class="btn-group">
        <button type=button class="btn btn-primary" name="Appetizer" onclick="select(this)">Appetizer</button>
        <button type=button class="btn btn-primary" name="Cocktail" onclick="select(this)">Cocktail</button>
        <button type=button class="btn btn-primary" name="Dessert" onclick="select(this)">Dessert</button>
        <button type=button class="btn btn-primary" name="Drink" onclick="select(this)">Drink</button>
        <button type=button class="btn btn-primary" name="Fish" onclick="select(this)">Fish</button>
        <button type=button class="btn btn-primary" name="Main course" onclick="select(this)">Main course</button>
        <button type=button class="btn btn-primary" name="Meat" onclick="select(this)">Meat</button>
        <button type=button class="btn btn-primary" name="Salad" onclick="select(this)">Salad</button>
        <button type=button class="btn btn-primary" name="Snack" onclick="select(this)">Snack</button>
        <button type=button class="btn btn-primary" name="Soup" onclick="select(this)">Soup</button>
    </div>

    <div id="Time" class="btn-group">
        <button type=button class="btn btn-primary" name="15min" onclick="select(this)">15min</button>
        <button type=button class="btn btn-primary" name="30min" onclick="select(this)">30min</button>
        <button type=button class="btn btn-primary" name="45min" onclick="select(this)">45min</button>
        <button type=button class="btn btn-primary" name="1h+" onclick="select(this)">>1h+</button>
    </div>

    <div id="Diet" class="btn-group">
        <button type=button class="btn btn-primary" name="Gluten-free" onclick="select(this)">Gluten-free</button>
        <button type=button class="btn btn-primary" name="Pescetarian" onclick="select(this)">Pescetarian</button>
        <button type=button class="btn btn-primary" name="Vegan" onclick="select(this)">Vegan</button>
        <button type=button class="btn btn-primary" name="Vegetarian" onclick="select(this)">Vegetarian</button>
    </div>

    <div id="Difficulty" class="btn-group">
        <button type=button class="btn btn-primary" name="Beginner" onclick="select(this)">Beginner</button>
        <button type=button class="btn btn-primary" name="Intermediate" onclick="select(this)">Intermediate</button>
        <button type=button class="btn btn-primary" name="Expert" onclick="select(this)">Expert</button>
    </div>

    <div id="Budget" class="btn-group">
        <button type=button class="btn btn-primary" name="$" onclick="select(this)">$</button>
        <button type=button class="btn btn-primary" name="$$" onclick="select(this)">$$</button>
        <button type=button class="btn btn-primary" name="$$$" onclick="select(this)">$$$</button>
    </div>
    </form>    
</body>
</html>

<script>

    function select(button){
        if(button.classList.contains('select')){
            button.classList.remove('select');
        }else{
            button.classList.add('select');
        }
    }
</script>

