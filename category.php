<?php
session_start();
include_once("includes/connection.php");
include_once "functions.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_cat = $_POST['num_cat'];
    $username = $_SESSION['Username'];
    $id = get_last_post_id($username,$con);
    for($i = 1; $i < $num_cat+1; $i++) {
        $cat = $_POST[$i];
        add_tag($cat, $id, $username, $con);
    }
} 
