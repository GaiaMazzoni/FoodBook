<?php
include_once("../includes/connection.php");
include_once("../includes/functions.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allNotif = get_all_unread_notifications($_POST['usernameTo'], $con);
    if($allNotif != NULL){
        echo "true";
    }
}