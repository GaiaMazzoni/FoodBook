<?php

session_start();
include("includes/connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_publisher = $_POST['post_publisher'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['text'];
    $user_who_commented = $_SESSION['Username'];
    $id_interaction = get_last_interaction_id($post_publisher, $post_id, $con);
    if($id_interaction == null) {
        $id_interaction = 0;
    }
    $id_interaction = $id_interaction + 1;
    

    $id_notification = get_last_notification_id($post_publisher, $post_id, $con);
    if($id_notification == null) {
        $id_notification = 0;
    }
    $id_notification = $id_notification + 1;
    echo $id_notification;

    $queryInter = $con->prepare("INSERT INTO interaction(Post_Publisher, Published_Post_Id, UsernameWhoLiked, idInteraction, idNotification) VALUES(?,?,?,?,?)");
    $queryInter->bind_param("sisii", $post_publisher, $post_id, $user_who_commented, $id_interaction, $id_notification);
    $result = $queryInter->execute();
    if(!$result) {
        echo $con->errno;
    }

    $current_date_time = date("Y-m-d H:i:s");

    $query = $con->prepare("INSERT INTO comment(Post_Publisher, Published_Post_Id, UsernameWhoLiked, idInteraction, DateAndTime, CommentText) VALUES (?,?,?,?,?,?)");
    $query->bind_param("sisiss", $post_publisher, $post_id, $user_who_commented, $id_interaction, $current_date_time, $comment);
    $result = $query->execute();
    if(!$result) {
        echo $con->errno;
    }
}