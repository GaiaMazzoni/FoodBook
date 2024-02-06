<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");
 
function insert_post_image($postId, $image, $mysqli){
    $username = $_SESSION['Username'];
    $stmt = $mysqli->prepare("INSERT INTO image (`Username`, `IdPost`, `Images`) VALUES (?, ?, ?);");
    $stmt->bind_param("sis", $username, $postId, $image);
    if(!$stmt->execute()) {
        return $mysqli->errno;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $username = $_SESSION['Username'];
    add_post($username, $description, $con);
    $result = '';
    for ($i=0; $i<$_POST['length']; $i++) {
        $id = get_last_post_id($username, $con);
        $result .= insert_post_image($id, $_POST[$i], $con);
    }

    header('Content-Type: application/json');
    echo json_encode($result);
}