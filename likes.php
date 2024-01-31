<?php

session_start();
include("includes/connection.php");
include("functions.php");

function likes($post_publisher, $post_id, $user_who_liked, $mysqli) {
    $current_date_time = date("Y-m-d H:i:s");
    $queryNotify = $mysqli->prepare("INSERT INTO notification(UsernameTo, UsernameFrom, Type, DateAndTime, IdPost) VALUES (?, ?, ?, ?, ?)");
    $notificationType = 1;
    $queryNotify -> bind_param("ssisi", $post_publisher, $user_who_liked, $notificationType, $current_date_time, $post_id);
    $queryNotify -> execute();
    $query = $mysqli->prepare("INSERT INTO likes(Post_Publisher, IdPost, Username_Who_Liked) VALUES(?,?,?)");
    $query->bind_param("sis", $post_publisher, $post_id, $user_who_liked);
    $query->execute();
}

function remove_likes($post_publisher, $post_id, $user_who_liked, $mysqli) {
    $query = $mysqli->prepare("DELETE FROM likes WHERE Post_Publisher = ? AND IdPost = ? AND Username_Who_Liked = ?");
    $query->bind_param("sis", $post_publisher, $post_id, $user_who_liked);
    $query->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_publisher = $_POST['post_publisher'];
    $post_id = $_POST['post_id'];
    $user_who_liked = $_SESSION['Username'];
    $remove = $_POST['remove'];
    if ($remove == 1) {
        echo remove_likes($post_publisher, $post_id, $user_who_liked, $con);
    } else {
        likes($post_publisher, $post_id, $user_who_liked, $con);
    }
}
