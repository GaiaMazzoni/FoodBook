<?php
session_start();
include_once("includes/connection.php");
include_once("functions.php");

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}

function follow($username, $follower_username, $con) {
    $current_date_time = date("Y-m-d H:i:s");
    $queryNotify = $con->prepare("INSERT INTO notification(UsernameTo, UsernameFrom, Type, DateAndTime) VALUES (?, ?, ?, ?)");
    $notificationType = 3;
    $queryNotify -> bind_param("ssis", $follower_username, $username, $notificationType, $current_date_time);
    $queryNotify -> execute();
    $query = $con->prepare("INSERT INTO follow(Follower_Username, Username) VALUES (?, ?)");
    $query->bind_param("ss", $follower_username, $username);
    $query->execute();
}

function unfollow($username, $follower_username, $con) {
    $query = $con->prepare("DELETE FROM follow WHERE Follower_Username = ? AND Username = ?");
    $query->bind_param("ss", $follower_username, $username);
    $query->execute();
}

$username = $_SESSION['Username'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remove = $_POST['remove'];
    $username = $_POST['following'];

    if($remove == 1) {
        echo unfollow($username, $_SESSION['Username'], $con);
    } else {
        echo follow($username, $_SESSION['Username'], $con);
    }
    
}