<?php
include 'functions.php';
include("includes/connection.php");
session_start();
$username = $_SESSION['Username'];

if(isset($_GET['user'])){
    $user = $_GET['user'];
    $idList = get_all_post_ids_of_user($user, $con);
    foreach ($idList as $id) {
        echo print_post($user, $id['IdPost'], $con);
    }
}

