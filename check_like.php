<?php

session_start();
include("includes/connection.php");
include("functions.php");

function check_likes($post_publisher, $post_id, $user_who_liked, $mysqli) {
    $query = $mysqli->prepare("SELECT * FROM likes WHERE Post_Publisher=? AND Published_Post_Id = ? AND UsernameWhoLiked = ?");
    $query->bind_param("sis", $post_publisher, $post_id, $user_who_liked);
    $query->execute();
    return $query->get_result()->num_rows;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_publisher = $_POST['post_publisher'];
    $post_id = $_POST['post_id'];
    $user_who_liked = $_SESSION['Username'];
    $var = check_likes($post_publisher, $post_id, $user_who_liked, $con);
    echo $var;
}
