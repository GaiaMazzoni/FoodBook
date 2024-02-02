<?php
include 'functions.php';
include 'includes/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allNotif = get_all_unread_notifications($_POST['usernameTo'], $con);
    if($allNotif != NULL){
        echo "true";
    }
}