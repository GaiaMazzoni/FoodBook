<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["username"];
    $password = $_POST["password"];

    if (check_login($usernameOrEmail, $password, $conn)) {
        echo "<script>window.open('home.php','_self')</script>";
        exit;
    } else {
        echo "Incorrect username or password";
    }
}

close_connection($conn);
?>
