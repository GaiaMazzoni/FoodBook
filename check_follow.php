<?php
session_start();
include_once("includes/connection.php");
include_once("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['following'];
    $follower_username = $_SESSION['Username'];
    $var = checkFollower($username, $follower_username, $con);
    echo $var;
}
