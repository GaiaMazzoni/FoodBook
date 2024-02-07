<?php
include_once ("connection.php");
include_once ("database.php");

/**
 * Prints the icons of the users followed by username.
 */
function print_followed($username, $mysqli) {
    $followed_users = get_all_follower($username, $mysqli);

    if ($followed_users) {
        foreach ($followed_users as $user) {
            $userPhoto = get_img_profile($mysqli, $user);
            echo "<div class='dropdown-item alert alert-info'>";
            echo "<a href='profile.php?user=" . htmlspecialchars($user) . "' style='text-decoration: none; color: inherit;'>";
            echo "<img src='../images/" . htmlspecialchars($userPhoto) . "' class='img-fluid rounded-circle mb-3' alt='Profile Image'>";
            echo "<p>" . htmlspecialchars($user) . "</p>";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "Non stai seguendo nessuno.";
    }
}

/**
 * Prints the icons of the users who follow the username given. 
 */
function print_following($username, $mysqli) {
    $followed_users = get_all_following($username, $mysqli);

    if ($followed_users) {
        foreach ($followed_users as $user) {
            $userPhoto = get_img_profile($mysqli, $user);
            echo "<div class='dropdown-item alert alert-info'>";
            echo "<a href='../view/profile.php?user=" . htmlspecialchars($user) . "' style='text-decoration: none; color: inherit;'>";
            echo "<img src='../images/" . htmlspecialchars($userPhoto) . "' class='img-fluid rounded-circle mb-3' alt='Profile Image'>";
            echo "<p>" . htmlspecialchars($user) . "</p>";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "Empty";
    }
}

/**
 * Shows the post. 
 */
function print_post($username, $postId, $mysqli, $type){
    $profilePicture = get_img_profile($mysqli, $username);
    $imagePost = get_post_image($username, $postId, $mysqli);
    $postDescription = get_post_description($username, $postId, $mysqli);
    $tags = get_tags_of_post($username, $postId, $mysqli);
    $tagPills = print_tags_of_post($tags, $mysqli);
   
    $result = "
        <div class='post-container'>
            <div class='profile-section'>
                <a href='profile.php?user=$username' style='text-decoration: none; color: inherit;'>
                    <img class='profile-image' src='../images/$profilePicture' alt=''>
                    <div class='username'>$username</div>
                </a>
            </div>";
    $result .= "<div id='images_$username$postId' class='carousel slide' data-bs-ride='carousel'>
                    <div class='carousel-indicators'>";
    $active = "class='active'";

    for($i = 0; $i < count($imagePost); $i++) {
        $result .= "<button type='button' data-bs-target='#images_$username$postId' data-bs-slide-to='$i' $active</button>";
        $active = '';
    }

    $result .= "
            </div>
            <div class='carousel-inner'>";
            $active = "active";
            foreach($imagePost as $image) {
                $result .= "
                    <div class='carousel-item $active'>
                        <img src='../images/$image' alt='' class='d-block' style='width:100%'>
                    </div>
                ";
                $active = '';
            }
    $result .= "
            </div>
            <button class='carousel-control-prev' type='button' data-bs-target='#images_$username$postId' data-bs-slide='prev'>
                <span class='carousel-control-prev-icon'></span>
            </button>
            <button class='carousel-control-next' type='button' data-bs-target='#images_$username$postId' data-bs-slide='next'>
                <span class='carousel-control-next-icon'></span>
            </button>
            </div>";

    $result .= "<div class='icon'>
        <div class='icon'>
            <button class='like' id='$username' value='$postId'>
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-heart' viewBox='0 0 16 16'>
                <path d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15'/>
            </svg></button>
        </div>
        <div class='comment btn btn-primary' id='$postId' data-username='$username'  data-bs-toggle='offcanvas' data-bs-target='#comment'>
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat' viewBox='0 0 16 16'>
                <path d='M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105'/>
            </svg>
        </div>
        </div>";

    $result .= "
        <div class='collapsible-tags-container'>
            <button class='tags-button' role='button' data-bs-toggle='collapse' data-bs-target='#tagsCollapse_$username$postId' aria-expanded='true' aria-controls='tagsCollapse_$username$postId' disable>
                Show Tags
            </button>
            <div class='collapse' id='tagsCollapse_$username$postId'>
                $tagPills
            </div>
        </div>
        <div class='post-description'>$postDescription</div>
    </div>";

    return $result;
}

/**
 * Prints the tags given.
 */
function print_tags_of_post($tags, $mysqli){
    $tagPills = "";
    foreach($tags as $tag){
        $stmt = $mysqli->prepare("SELECT CategoryName FROM category WHERE IdCategory=?");
        $stmt->bind_param("i", $tag['IdCategory']);
        $stmt->execute();
        $tagName = $stmt->get_result()->fetch_assoc()['CategoryName'];
        $tagPills .= "<span class='tag-pill'>$tagName</span>";
    }
    return $tagPills;
}

// Close connection
function close_connection($con) {
    $con->close();
}

function generateModalForm($type, $label, $maxLength = null) {
    $inputType = 'text';
    if ($type === 'image') $inputType = 'file';
    if ($type === 'email') $inputType = 'email';
    if ($type === 'birthdate') $inputType = 'date';
    
    $maxLengthAttr = is_null($maxLength) ? '' : "maxlength='$maxLength'";

    return "
    <div class='modal' id='change_{$type}_form'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title'>Change $label</h4>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form method='post' action='../api/edit_profile.php'  enctype='multipart/form-data'>
                        <input type='hidden' name='update_type' value='$type'>
                        <input type='$inputType' name='new_data' $maxLengthAttr required>
                        <input type='submit' value='Invia' name='submit'>
                    </form>
                </div>
            </div>
        </div>
    </div>";
}
function printFollowNotification($usernameFrom){
    $notificationMessage = "$usernameFrom now follows you!";
    return "<div class='rectangle'>
                <div class='content'>
                    <p>$notificationMessage</p>
                </div>
            </div>";
}

function printCommentNotification($usernameFrom, $usernameTo, $idPost, $commentText, $mysqli){
    $notificationMessage = "$usernameFrom commented under your post: $commentText";
    $postImg = get_post_image($usernameTo, $idPost, $mysqli);
    return "<div class='rectangle'>
                <div class='content'>
                    <p>$notificationMessage</p>
                    <img src='../images/$postImg[0]' alt=''>
                </div>
            </div>";
}

function printLikeNotification($usernameTo, $usernameFrom, $idPost, $mysqli){
    $postImg = get_post_image($usernameTo, $idPost, $mysqli);
    $notificationMessage = "$usernameFrom liked your post.";
    return "<div class='rectangle'>
                <div class='content'>
                    <p>$notificationMessage</p>
                    <img src='../images/$postImg[0]' alt=''>
                </div>
            </div>";
}

function print_notifications_of_user($usernameTo, $mysqli){
    $notifications = get_all_notifications_for_user($usernameTo, $mysqli);
    $notificationsMessage = "";
    foreach($notifications as $notif){
        if($notif['Type'] == "1"){
            $notificationsMessage .= printLikeNotification($notif['UsernameTo'],$notif['UsernameFrom'], $notif['IdPost'], $mysqli);
        }else if($notif['Type'] == "2"){
            $commentText = get_comment_text_from_notification($notif, $mysqli);
            $notificationsMessage .= printCommentNotification($notif['UsernameFrom'], $notif['UsernameTo'], $notif['IdPost'], $commentText, $mysqli);
        }else{
            $notificationsMessage .= printFollowNotification($notif['UsernameFrom']);
        }
    }
    return $notificationsMessage;
}

/**
 * Shows the comments of a post. 
 */
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




