<!DOCTYPE html>
<html>
<head>
    <title>FoodBook login and signup</title>
    <meta charset="utf-8">
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

    button {
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
<title>New Post Creation</title>
<body>
    <div class="row">
        <div class="col-sm-12 text-center">
            <div id="top_banner">
                <form method="post">
                    <button id="close" class="close_button" name="close">X</button>
                    <h1>New Post</h1>
                    <button id="next" class="next_button" name="next">Next</button>
                </form>
            </div>

            <form>
                <input type="file" id="imageSelection" class="form-control" name="image" accept="image/*">
                <textarea id="description" class="form-control" name="description" placeholder="Enter your post description"></textarea>
            </form>

            <?php
                include 'functions.php';

                if(isset($_POST['close'])){
                    echo "<script>window.open('home.php','_self')</script>";
                }

                if(isset($_POST['next'])){
                    add_post($username, $_POST['description'],$conn);
                }
            ?>

        </div>
    </div>
</body>
</html>