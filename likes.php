<?php

session_start();
include("includes/connection.php");
include("functions.php");

function get_id_interaction($username, $post_id, $user_who_liked, $mysqli) {
    $stmt = $mysqli->prepare("SELECT idInteraction FROM likes WHERE Post_Publisher=? AND Published_Post_Id=? AND UsernameWhoLiked = ?");
    $stmt->bind_param("sis", $username, $post_id, $user_who_liked);
    if (!$stmt->execute()) {
        return null;
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['idInteraction'];
}

function get_id_notification($username, $post_id, $user_who_liked, $id_interaction, $mysqli) {
    $stmt = $mysqli->prepare("SELECT IdNotification FROM interaction WHERE Post_Publisher=? AND Published_Post_Id=? AND UsernameWhoLiked = ? AND idInteraction = ?");
    $stmt->bind_param("sisi",$username, $post_id, $user_who_liked, $id_interaction);
    if (!$stmt->execute()) {
        return null;
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['IdNotification'];
}
function likes($post_publisher, $post_id, $user_who_liked, $mysqli) {
    $id_interaction = get_last_interaction_id($post_publisher, $post_id, $mysqli);
    $id_notification = get_last_notification_id($post_publisher, $post_id, $mysqli);

    if($id_interaction === null) {
        $id_interaction = 0;
    }
    $id_interaction = $id_interaction + 1;

    if($id_notification === null) {
        $id_notification = 0;
    }
    $id_notification = $id_notification + 1;

    $queryInter = $mysqli->prepare("INSERT INTO interaction(Post_Publisher, Published_Post_Id, UsernameWhoLiked, idInteraction, idNotification) VALUES(?,?,?,?,?)");
    $queryInter->bind_param("sisii", $post_publisher, $post_id, $user_who_liked, $id_interaction, $id_notification);
    $queryInter->execute();
    $query = $mysqli->prepare("INSERT INTO likes(Post_Publisher, Published_Post_Id, UsernameWhoLiked, idInteraction) VALUES(?,?,?,?)");
    $query->bind_param("sisi", $post_publisher, $post_id, $user_who_liked, $id_interaction);
    $query->execute();
}

function remove_likes($post_publisher, $post_id, $user_who_liked, $mysqli) {
    $id_interaction = get_id_interaction($post_publisher, $post_id, $user_who_liked, $mysqli);
    $id_notification = get_id_notification($post_publisher, $post_id, $user_who_liked, $id_interaction, $mysqli);

    $query = $mysqli->prepare("DELETE FROM likes WHERE Post_Publisher = ? AND Published_Post_Id = ? AND UsernameWhoLiked = ? AND idInteraction = ?");
    $query->bind_param("sisi", $post_publisher, $post_id, $user_who_liked, $id_interaction);
    $query->execute();

    $queryInter = $mysqli->prepare("DELETE FROM interaction WHERE Post_Publisher = ? AND Published_Post_Id = ? AND UsernameWhoLiked = ? AND idInteraction = ? AND idNotification = ?");
    $queryInter->bind_param("sisii", $post_publisher, $post_id, $user_who_liked, $id_interaction, $id_notification);
    $queryInter->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_publisher = $_POST['post_publisher'];
    $post_id = $_POST['post_id'];
    $user_who_liked = $_SESSION['Username'];
    $remove = $_POST['remove'];
    if ($remove == 1) {
        echo remove_likes($post_publisher, $post_id, $user_who_liked, $con);
    } else {
        likes($post_publisher, $post_id, $user_who_liked, $con);
    }
}
