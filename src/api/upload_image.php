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
    $username = $_SESSION['Username'];
    $id = get_last_post_id($username, $con);
    for ($i=1; $i < $_POST['length'] + 1; $i++) {
        insert_post_image($id, $_POST[$i], $con);
    }
}

    