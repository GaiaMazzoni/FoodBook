<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["usernameoremail"];
    $password = $_POST["password"];

    if (check_login($usernameOrEmail, $password, $con) == true) {
        $username = $_SESSION['Username'];
        header("Location: ../view/profile.php?user=$username");
    } else {
        $_SESSION['login_error'] = 'incorrect username, e-mail or password';
        header("Location: ../view/login.php");
        close_connection($con);
    }
}

