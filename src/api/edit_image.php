<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
$username = urlencode($_SESSION['Username']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $image = $_POST["image"];
    echo "ciao";
    $result = upload_image("../images/", $_FILES($image));
    if ($result[0] == 1) {
        echo "Caricamento dell'immagine avvenuto con successo. Nome del file: " . $result[1];
    } else {
        echo "Errore durante il caricamento dell'immagine: " . $result[1];
    }
    update_profile($con, $username, 'ProfilePicture', $result[1]);
}