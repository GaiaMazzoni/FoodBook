<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['following'];
    $follower_username = $_SESSION['Username'];
    $var = checkFollower($username, $follower_username, $con);

    header('Content-Type: application/json');
    echo json_encode($var);
}
