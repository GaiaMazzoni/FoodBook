<?php
    session_start();
    include_once("../includes/connection.php");
    include_once("../includes/functions.php");
    include_once("../css/tags_selection_css.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../js/tag_selection.js" defer></script>
</head>
<body>
    <div class="row">
        <div class="col-sm-12 text-center">
            <div id="top_banner">
                <form method="post">
                    <button id="back" type="button" class="back_button" name="back">Back</button>
                    <h1>New Post</h1>
                    <button id="publish" type="button" class="publish_button" name="publish">Publish</button>
                </form>
            </div>
            <div id="tag_form"></div>     
        </div>
    </div>
</body>
</html>

