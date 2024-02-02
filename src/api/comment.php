<?php

session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_publisher = $_POST['post_publisher'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['text'];
    $user_who_commented = $_SESSION['Username'];
    $current_date_time = date("Y-m-d H:i:s");

    $queryNotify = $con->prepare("INSERT INTO notification(UsernameTo, UsernameFrom, Type, DateAndTime, IdPost) VALUES (?, ?, ?, ?, ?)");
    $notificationType = 2;
    $queryNotify -> bind_param("ssisi", $post_publisher, $user_who_commented, $notificationType, $current_date_time, $post_id);
    $queryNotify -> execute();

    $query = $con->prepare("INSERT INTO comment(Post_Publisher, IdPost, Username_Who_Commented, DateAndTime, Comment_Text) VALUES (?,?,?,?,?)");
    $query->bind_param("sisss", $post_publisher, $post_id, $user_who_commented, $current_date_time, $comment);
    $query->execute();
}