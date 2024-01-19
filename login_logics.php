<?php
session_start();
include("includes/connection.php");

include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["username"];
    $password = $_POST["password"];

    if (check_login($usernameOrEmail, $password, $conn)) {
        $_SESSION['Username'] = $usernameOrEmail;
        header("Location: profile.php");
        exit;
    } else {
        echo "Incorrect username or password";
    }
}

close_connection($conn);
?>
