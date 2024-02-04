<?php

session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_publisher = $_POST['post_publisher'];
    $post_id = $_POST['post_id'];
    $user_who_liked = $_SESSION['Username'];
    $var = check_likes($post_publisher, $post_id, $user_who_liked, $con);
    
    header('Content-Type: application/json');
    echo json_encode($var);
}
