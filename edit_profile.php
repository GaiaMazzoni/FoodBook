<?php
session_start();
include("includes/connection.php"); // Includi la connessione al database
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_type = $_POST['update_type'];
    $new_data = $_POST['new_data'];
    $username = $_SESSION['Username']; 
    echo "l'update type è: '$update_type'<br>";
    if ($new_data == null) {
        echo "newdata e null<br>";
    }

    switch ($update_type) {
        case 'email':
            update_profile($con, $username, 'E_mail', $new_data);
            break;
        case 'image':
            update_profile($con, $username, 'ProfilePicture', $new_data);
            break;
        case 'bio':
            update_profile($con, $username, 'Bio', $new_data);
            break;
        case 'birthdate':
            update_profile($con, $username, 'BirthDate', $new_data);
            break;
        default:
            break;
    }

    //echo "<script>window.open('profile.php','_self')</script>";
}

