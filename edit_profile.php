<?php
session_start();
include_once("includes/connection.php"); // Includi la connessione al database
include_once 'functions.php';
$username = urlencode($_SESSION['Username']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_type = $_POST['update_type'];
    $new_data = $_POST['new_data'];
    if ($update_type=='name' || $update_type=='password') {
        $second_data = $_POST['second_data'];
    }
    $username = $_SESSION['Username']; 
    echo "l'update type è: '$update_type'<br>";
    echo "il new_data è: '$new_data'<br>";
    if ($new_data == null) {
        echo "newdata e null<br>";
    }

    switch ($update_type) {
        case 'email':
            update_profile($con, $username, 'E_mail', $new_data);
            break;
        case 'image':
            $result = upload_image("images/", $new_data);
            if ($result[0] == 1) {
                echo "Caricamento dell'immagine avvenuto con successo. Nome del file: " . $result[1];
            } else {
                echo "Errore durante il caricamento dell'immagine: " . $result[1];
            }
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

