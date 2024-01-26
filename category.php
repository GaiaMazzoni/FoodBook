<?php
include("includes/connection.php");
include "functions.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_cat = $_POST['num_cat'];
    $username = $_SESSION['Username'];
    $id = get_last_post_id($username,$con);
    for($i = 1; $i < $num_cat+1; $i++) {
        $cat = $_POST[$i];
        add_tag($cat, $id, $username, $con);
    }
} else {
    echo "Non è una richiesta POST";
}
