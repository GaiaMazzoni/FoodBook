<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $username = $_SESSION['Username'];
    add_post($username, $description, $con);

    $num_cat = $_POST['num_cat'];
    $id = get_last_post_id($username,$con);
    for($i = 1; $i < $num_cat + 1; $i++) {
        $cat = $_POST[$i];
        add_tag($cat, $id, $username, $con);
    }
}

    