<?php
include_once ("connection.php");

function check_login($usernameOrEmail, $password, $mysqli){
    $stmt = $mysqli->prepare("SELECT Username, E_mail, Password FROM users WHERE (Username=? OR E_mail=?)");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if(password_verify($password, $row['Password']) == true){
        $_SESSION['Username'] = $row['Username'];
        return true;
    }else{
        return false;
    }
}

function add_post($username, $text, $mysqli){
    $stmt = $mysqli->prepare("SELECT max(IdPost) FROM post WHERE Username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $IdPost = $stmt->get_result()->fetch_assoc()["max(IdPost)"] + 1;
    $dateAndTime = date('Y-m-d H:i:s');
    $stmt = $mysqli->prepare("INSERT INTO post (`Username`, `IdPost`, `DateAndTime`, `Text`) VALUES (?, ?, ?, ?);");
    $stmt->bind_param("siss",$username,$IdPost,$dateAndTime,$text);
    $stmt->execute();
}

function get_last_post_id($username, $mysqli){
    $stmt = $mysqli->prepare("SELECT max(IdPost) FROM post WHERE Username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(IdPost)"];
}

function add_tag($categoryName, $idPost, $username, $mysqli){
    $stmt = $mysqli->prepare("SELECT IdCategory FROM category WHERE CategoryName=?");
    $stmt->bind_param("s",$categoryName);
    $stmt->execute();
    $IdCategory = $stmt->get_result()->fetch_assoc()["IdCategory"];
    $stmt = $mysqli->prepare("INSERT INTO belong (`IdCategory`, `Username`, `IdPost`) VALUES (?, ?, ?);");
    $stmt->bind_param("isi", $IdCategory, $username, $idPost);
    $stmt->execute();
}

function get_img_profile($con, $username) {
    $img_query = "SELECT ProfilePicture FROM users WHERE Username='$username'";
    $img_result = mysqli_query($con, $img_query);
    $img_row = mysqli_fetch_assoc($img_result);
    $img = $img_row['ProfilePicture']; 
    if($img == null){
        $img = "null_profile.png";
    }
    return $img;
}

function get_all_follower($username, $mysqli){
    $stmt = $mysqli->prepare("SELECT * FROM follow WHERE Follower_Username = ?");
    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        return [];
    }
    $result = $stmt->get_result();
    $followers = [];
    while ($row = $result->fetch_assoc()) {
        $followers[] = $row['Username'];
    }
    return $followers;
}

function get_all_following($username, $mysqli) {
    $stmt = $mysqli->prepare("SELECT * FROM follow WHERE Username = ?");
    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        return [];
    }
    $result = $stmt->get_result();
    $followers = [];
    while ($row = $result->fetch_assoc()) {
        $followers[] = $row['Follower_Username'];
    }
    return $followers;
}

function get_all_posts_from_followers($followedList, $mysqli){
    $allPosts = [];
    foreach($followedList as $followed){
        $stmt = $mysqli->prepare("SELECT * FROM post WHERE Username=?");
        $stmt->bind_param("s", $followed);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $allPosts = array_merge($allPosts, $result);

    }

    usort($allPosts, function($post1, $post2){
        return strtotime($post2['DateAndTime']) - strtotime($post1['DateAndTime']);
    });

    return $allPosts;
}

function get_post_description($username, $postId, $mysqli){
    $stmt = $mysqli->prepare("SELECT Text FROM post WHERE Username=? AND IdPost=?");
    $stmt->bind_param("si",$username, $postId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()['Text'];
}

function get_tags_of_post($username, $postId, $mysqli){
    $stmt = $mysqli->prepare("SELECT IdCategory FROM belong WHERE Username=? AND IdPost=?");
    $stmt->bind_param("si", $username, $postId);
    $stmt->execute();
    $tags = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $tags;
}

function get_all_post_ids_of_user($username, $mysqli){
    $stmt = $mysqli->prepare("SELECT IdPost FROM post WHERE Username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function get_post_image($username, $postId, $mysqli){
    $stmt = $mysqli->prepare("SELECT Images FROM image WHERE Username=? AND IdPost=?");
    $stmt->bind_param("si", $username, $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $images = array();
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['Images'];
    }
    
    return $images;
}

function update_profile($con, $username, $type, $new_element) {
    $query = $con->prepare("UPDATE users SET $type = ? WHERE Username = ?");
    $query->bind_param("ss", $new_element, $username);
    $run_query = $query->execute();
    if($run_query){
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $con->error;
    }
}

function print_post_image($username, $mysqli){
    $stmt = $mysqli->prepare("SELECT IdPost FROM post WHERE Username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $postIds = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $allImages = array();
    foreach($postIds as $id){
        $allImages[] = get_post_image($username, $id, $mysqli);
    }
    return $allImages;
}

function get_all_first_images_of_post($username, $mysqli){
    $stmt = $mysqli->prepare("SELECT IdPost, Images FROM image WHERE Username=? GROUP BY IdPost");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $allImages = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $allImages;
}

function checkFollower($username, $follower_username, $con) {
    $query = $con->prepare("SELECT * FROM follow WHERE Username = ? AND Follower_Username = ?");
    $query->bind_param("ss", $username, $follower_username);
    $query->execute();
    return $query->get_result()->num_rows;
}
function get_all_notifications_for_user($usernameTo, $mysqli){
    $stmt = $mysqli->prepare("SELECT * FROM notification WHERE UsernameTo=?");
    $stmt->bind_param("s", $usernameTo);
    $stmt->execute();
    $allNotifications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    usort($allNotifications, function($notif1, $notif2){
        return strtotime($notif2['DateAndTime']) - strtotime($notif1['DateAndTime']);
    });

    return $allNotifications;
}

function get_comment_text_from_notification($notification, $mysqli){
    $usernameTo = $notification['UsernameTo'];
    $usernameFrom = $notification['UsernameFrom'];
    $dateAndTime = $notification['DateAndTime'];
    $idPost = $notification['IdPost'];
    $stmt = $mysqli->prepare("SELECT Comment_Text FROM comment WHERE Post_Publisher=? AND Username_Who_Commented=? AND DateAndTime=? AND IdPost=?");
    $stmt->bind_param("sssi", $usernameTo, $usernameFrom, $dateAndTime, $idPost);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()['Comment_Text']; 
}

function get_all_unread_notifications($usernameTo, $mysqli){
    $isNotRead = 0;
    $stmt = $mysqli->prepare("SELECT * FROM notification WHERE UsernameTo=? AND IsRead=?");
    $stmt->bind_param("si", $usernameTo, $isNotRead);
    $stmt->execute();
    $allUnread = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $allUnread;
}

function read_notification($notification, $mysqli){
    $isRead = 1;
    $stmt = $mysqli->prepare("UPDATE notification SET IsRead=? WHERE UsernameTo=? AND UsernameFrom=? AND DateAndTime=?");
    $stmt->bind_param("isss", $isRead, $notification['UsernameTo'], $notification['UsernameFrom'], $notification['DateAndTime']);
    $stmt->execute();
    $stmt->get_result();
}

function check_likes($post_publisher, $post_id, $user_who_liked, $mysqli) {
    $query = $mysqli->prepare("SELECT * FROM likes WHERE Post_Publisher=? AND IdPost = ? AND Username_Who_Liked = ?");
    $query->bind_param("sis", $post_publisher, $post_id, $user_who_liked);
    $query->execute();
    return $query->get_result()->num_rows;
}

function follow($followed_username, $follower_username, $con) {
    $current_date_time = date("Y-m-d H:i:s");
    $queryNotify = $con->prepare("INSERT INTO notification(UsernameTo, UsernameFrom, Type, DateAndTime) VALUES (?, ?, ?, ?)");
    $notificationType = 3;
    $queryNotify -> bind_param("ssis", $followed_username, $follower_username, $notificationType, $current_date_time);
    $queryNotify -> execute();
    $query = $con->prepare("INSERT INTO follow(Follower_Username, Username) VALUES (?, ?)");
    $query->bind_param("ss", $follower_username, $followed_username);
    $query->execute();
}

function unfollow($followed_username, $follower_username, $con) {
    $query = $con->prepare("DELETE FROM follow WHERE Follower_Username = ? AND Username = ?");
    $query->bind_param("ss", $follower_username, $followed_username);
    $query->execute();
}

function likes($post_publisher, $post_id, $user_who_liked, $mysqli) {
    $current_date_time = date("Y-m-d H:i:s");
    $queryNotify = $mysqli->prepare("INSERT INTO notification(UsernameTo, UsernameFrom, Type, DateAndTime, IdPost) VALUES (?, ?, ?, ?, ?)");
    $notificationType = 1;
    $queryNotify -> bind_param("ssisi", $post_publisher, $user_who_liked, $notificationType, $current_date_time, $post_id);
    $queryNotify -> execute();
    $query = $mysqli->prepare("INSERT INTO likes(Post_Publisher, IdPost, Username_Who_Liked) VALUES(?,?,?)");
    $query->bind_param("sis", $post_publisher, $post_id, $user_who_liked);
    $query->execute();
}

function remove_likes($post_publisher, $post_id, $user_who_liked, $mysqli) {
    $query = $mysqli->prepare("DELETE FROM likes WHERE Post_Publisher = ? AND IdPost = ? AND Username_Who_Liked = ?");
    $query->bind_param("sis", $post_publisher, $post_id, $user_who_liked);
    $query->execute();
}

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

function get_posts_from_category($cat_list, $num_cat, $mysqli) {
    $placeholders = implode(',', array_fill(0, $num_cat, '?'));
    $stmt = $mysqli->prepare("SELECT Username, IdPost FROM belong WHERE IdCategory IN ($placeholders) GROUP BY Username, IdPost HAVING COUNT(DISTINCT IdCategory) = ?");
    $params = array_merge($cat_list, array($num_cat));
    $types = str_repeat('s', count($cat_list)) . 'i';
    $stmt -> bind_param($types, ...$params);
    call_user_func_array(array($stmt, 'bind_param'), array_merge(array($types), $params));
    $stmt->execute();
    $post = $stmt->get_result();
    return $post;
}

function get_id_category($category_name, $mysqli) {
    $stmt = $mysqli->prepare("SELECT IdCategory FROM category WHERE CategoryName=?");
    $stmt -> bind_param('s', $category_name);
    $stmt -> execute();
    return $stmt -> get_result() -> fetch_assoc()['IdCategory'];
}
