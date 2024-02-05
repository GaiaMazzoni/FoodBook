<?php
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allNotif = get_all_unread_notifications($_POST['usernameTo'], $con);
    if($allNotif != NULL){
        $result = "true";
    }else{
        $result = "false";
    }
    header('Content-Type: application/json');
    echo json_encode($result);
}