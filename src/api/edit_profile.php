<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");
$username = urlencode($_SESSION['Username']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_type = $_POST['update_type'];
    $new_data = $_POST['new_data'];
    if ($update_type=='name' || $update_type=='password') {
        $second_data = $_POST['second_data'];
    }
    $username = $_SESSION['Username']; 

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
        case 'name':
            update_profile($con, $username, 'Name', $new_data);
            update_profile($con, $username, 'Surname', $second_data);
            break;
        case 'password':
            if(check_login($username, $new_data, $con)) {
                update_profile($con, $username, 'Password', $second_data);
            }
        default:
            break;
    }

    echo "<script>window.open('profile.php?user=$username','_self');</script>";
}

