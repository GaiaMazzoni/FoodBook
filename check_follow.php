<?php
session_start();
include("includes/connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['following'];
    $follower_username = $_SESSION['Username'];
    $var = checkFollower($username, $follower_username, $con);
    echo $var;
}
