<?php
session_start();
include_once("../includes/connection.php");
include_once("../functions.php");
include_once("../includes/database.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>FoodBook login and signup</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    h1{
        margin: 0;
    }

    body {
        position: relative;
        padding-top: 50px;
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

</style>
<title>New Post Creation</title>
<body>
    <div class="row">
        <div class="col-sm-12 text-center">
            <div id="top_banner">
                <form method="post" action="../api/new_post_logics.php">
                    <button id="close" class="close_button" name="close">X</button>
                    <h1>New Post</h1>
                    <button type="button" id="next" onclick="handleImageUpload()" class="next_button" name="next">Next</button>
                    <input type="file" data-post=<?php echo get_last_post_id($_SESSION['Username'], $con)?>  id="imageSelection" class="form-control" name="image[]" multiple>
                    <textarea id="description" class="form-control" name="description" placeholder="Enter your post description"></textarea>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
function handleImageUpload(postId) {
    const fileInput = document.getElementById("imageSelection");

    if (fileInput.files.length > 0) {
        const uploadPromises = [];
        const formDataImage = new FormData();
        let postId = fileInput.getAttribute('data-post');
        formDataImage.append("length", fileInput.files.length);
        formDataImage.append("description", document.getElementById("description").value);
        for (let i = 0; i < fileInput.files.length; i++) {
            formDataImage.append(i, fileInput.files[i].name);
            console.log(fileInput.files[i].name);
        }
        const uploadPromise = axios.post('../api/upload_image.php', formDataImage)
        .then(response => {
            window.open('./tag_selection.php','_self');
        });
    }
}


</script>
</html>