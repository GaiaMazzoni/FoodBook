<?php
    session_start();
    include_once 'functions.php';
    include_once 'includes/connection.php';

    if (isset($_POST['back'])) {
        echo "<script>window.open('new_post.php','_self')</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./tag_selection.js" defer></script>
</head>
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
            <div id="tag_form"></div>     
        </div>
    </div>
</body>
</html>

