<?php 
include_once("../includes/connection.php");
include_once("../includes/functions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_publisher']) && isset($_POST['post_id'])) {
    $result = print_comments($_POST['post_publisher'], $_POST['post_id'], $con)
    ;

    header('Content-Type: application/json');
    echo json_encode($result);
} 
        