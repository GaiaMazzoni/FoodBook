<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");
 
function insert_post_image($postId, $image, $mysqli){
    $username = $_SESSION['Username'];
    $stmt = $mysqli->prepare("INSERT INTO image (`Username`, `IdPost`, `Images`) VALUES (?, ?, ?);");
    $stmt->bind_param("sis", $username, $postId, $image);
    $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $username = $_SESSION['Username'];
    add_post($username, $description, $con);
    $result = '';
    for ($i=0; $i<$_POST['length']; $i++) {
        $id = get_last_post_id($username, $con);
        insert_post_image($id, $_POST[$i], $con);
    }
    $num_cat = $_POST['num_cat'];
    $username = $_SESSION['Username'];
    $id = get_last_post_id($username,$con);
    for($i = 1; $i < $num_cat+1; $i++) {
        $cat = $_POST[$i];
        add_tag($cat, $id, $username, $con);
    }
}

    