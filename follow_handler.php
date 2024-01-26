<?php
session_start();
include("includes/connection.php");
include("functions.php");

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['Username'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remove = $_POST['remove'];
    $username = $_POST['following'];

    if($remove == 1) {
        unfollow($username, $_SESSION['Username'], $con);
        echo "ho eseguito l'unfollow";
    } else {
        follow($username, $_SESSION['Username'], $con);
        echo "Ho eseguito il follow amo";
    }
    
}