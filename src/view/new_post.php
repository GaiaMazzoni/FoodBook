<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>FoodBook login and signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/new_post.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../js/new_post.js" defer></script>
</head>
<body> 
    <div class="row">
        <div class="col-sm-12 text-center">
            <div id="top_banner">
                <form method="post">
                    <button id="close" type="button" class="close_button" name="close">X</button>
                    <h1>New Post</h1>
                    <button id="publish" type="button" class="publish_button" name="publish">Publish</button>
                    <input type="file" id="imageSelection" class="form-control" name="image[]" multiple>
                    <label for="description">Description:</label>
                    <textarea id="description" class="form-control" name="description" placeholder="Enter your post description"></textarea>
                </form> 
            </div>
            <div id="tag_form"></div>
        </div>
    </div>
</body>
</html>