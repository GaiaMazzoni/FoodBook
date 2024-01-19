<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </style>
    <title>Responsive Interface</title>
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
    <div id="Food Types" class="category_field">
        <button class="Appetizer" name="Appetizer">Appetizer</button>
        <button class="Cocktail" name="Cocktail">Cocktail</button>
        <button class="Dessert" name="Dessert">Dessert</button>
    </div>

    <div id="Time" class="category_field">
        <button class="15min" name="15min">15min</button>
        <button class="30min" name="30min">30min</button>
    </div>

    <div id="Diet" class="category_field">
        <button class="Gluten-free" name="Gluten-free">Gluten-free</button>
        <button class="Pescetarian" name="Pescetarian">Pescetarian</button>
    </div>

    <div id="Difficutly" class="category_field">
        <button class="Beginner" name="Beginner">Beginner</button>
        <button class="Expert" name="Expert">Expert</button>
    </div>

    <div id="Budget" class="category_field">
        <button class="$" name="$">$</button>
        <button class="$$" name="$$">$$</button>
    </div>
    </form>
</body>

    

    
    
</body>
</html>