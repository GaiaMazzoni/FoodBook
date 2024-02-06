<?php
include_once("../includes/connection.php");
include_once("../includes/header.php");
include_once("../includes/footer.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");
include_once("comment_form.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../js/home.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodBook Home</title>

</head>
<body>
    <?php
        $username = $_SESSION['Username'];
        $followers = get_all_follower($username, $con);
        $posts = get_all_posts_from_followers($followers, $con);
        foreach($posts as $post){
            echo print_post($post['Username'], $post['IdPost'], $con, 1);
        }
    ?>
</body>
</html>
