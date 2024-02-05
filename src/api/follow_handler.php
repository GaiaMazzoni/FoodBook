<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remove = $_POST['remove'];
    $username = $_POST['following'];

    if($remove == 1) {
        unfollow($username, $_SESSION['Username'], $con);
    } else {
        follow($username, $_SESSION['Username'], $con);
    }
    
}