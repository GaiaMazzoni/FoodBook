<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["usernameoremail"];
    $password = $_POST["password"];

    if (check_login($usernameOrEmail, "passcripto", $con) == true) {
        $username = $_SESSION['Username'];
        $result = "<script>window.open('../view/profile.php?user=$username','_self');</script>";
    } else {
        $_SESSION['login_error'] = 'incorrect username, e-mail or password';
        $result = "<script>window.open('../view/profile.php?user=$username','_self');</script>";
        close_connection($con);
    }

    header('Content-Type: application/json');
    echo json_encode($result);
}

