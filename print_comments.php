<?php 
include_once("includes/connection.php");

function get_all_comments($username, $id_post, $mysqli) {
    $comments = [];
    $stmt = $mysqli->prepare("SELECT * FROM comment WHERE Post_Publisher = ? AND IdPost = ?");
    $stmt->bind_param("si", $username, $id_post);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $comments = $result;

    usort($comments, function($comment1, $comment2){
        return strtotime($comment2['DateAndTime']) - strtotime($comment1['DateAndTime']);
    });

    return $comments;
}

function print_comments($username, $post_id, $mysqli) {
    $comments = get_all_comments($username, $post_id, $mysqli);
    $output = "";
    foreach ($comments as $comment) {
        $user_who_commented = $comment['Username_Who_Commented'];
        $text = $comment['Comment_Text'];

        $output .= "<div class='alert alert-info'>";
        $output .= "<a href='profile.php?user=" . urlencode($user_who_commented) . "'>";
        $output .= htmlspecialchars($user_who_commented);
        $output .= "</a>";
        $output .= "<p>" . htmlspecialchars($text) . "</p>";
        $output .= "</div>";
        
    }
    return $output;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_publisher']) && isset($_POST['post_id'])) {
    echo print_comments($_POST['post_publisher'], $_POST['post_id'], $con)
    ;
} 
        