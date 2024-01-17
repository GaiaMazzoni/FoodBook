<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["username"];
    $password = $_POST["password"];

    if (check_login($usernameOrEmail, $password, $conn)) {
        echo 'login successfull';
        exit;
    } else {
        echo 'login unsuccesfull';
        exit;
    }
}

close_connection($conn);
?>
