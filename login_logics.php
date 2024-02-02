<?php
session_start();
include_once("includes/connection.php");
include_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["username"];
    $password = $_POST["password"];

    if (check_login($usernameOrEmail, $password, $con)) {
        echo "<script>window.open('profile.php?user=$usernameOrEmail','_self');</script>";
        exit;
    } else {
        $_SESSION['login_error'] = 'incorrect username, e-mail or password';
        //header("Location: login.php");
        exit;
    }
}

close_connection($con);