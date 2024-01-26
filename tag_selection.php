<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<?php
    include 'functions.php';
    include 'includes/connection.php';
 
    session_start();

    if (isset($_POST['back'])) {
        echo "<script>window.open('new_post.php','_self')</script>";
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
                    <button id="publish" type="button" onclick="publish_post()" class="publish_button" name="publish">Publish</button>
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

    function publish_post() {
        let cat = document.getElementsByClassName("select");
        let formData = new FormData();
        formData.append('num_cat', cat.length);
        for (let i = 0; i < cat.length; i++) {
            console.log(cat[i].name);
            formData.append(i+1, cat[i].name);
        }
        formData.forEach((value, key) => { console.log(key, value); });
        axios.post('category.php', formData).then(response => {
            console.log(response.data);
        })
        .catch(error => {
            console.error(error);
        });
    }
        
</script>

