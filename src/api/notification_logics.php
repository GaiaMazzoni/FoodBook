<?php
include_once '../includes/functions.php';
include_once '../includes/connection.php';
include_once '../includes/database.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allNotif = get_all_unread_notifications($_SESSION['Username'], $con);
    $type = $_POST["type"];
    if ($type == "check") {
        if($allNotif != NULL){
            $result = "true";
        }else{
            $result = "false";
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        foreach ($allNotif as $n) {
            read_notification($n, $con);
        }
    }
    
    
}