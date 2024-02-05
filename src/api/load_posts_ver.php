<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

$username = $_SESSION['Username'];

if(isset($_GET['user'])){
    $user = $_GET['user'];
    $idList = get_all_post_ids_of_user($user, $con);
    $idList = array_reverse($idList);
    foreach ($idList as $id) {
        $result = print_base_post($user, $id['IdPost'], $con);
    }
    header('Content-Type: application/json');
    echo json_encode($result);
}

