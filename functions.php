<?php
    function check_login($usernameOrEmail, $password, $mysqli){
        $stmt = $mysqli->prepare("SELECT Username, E_mail FROM users WHERE Username=? OR E_mail=? AND Password=?");
        $stmt->bind_param("sss",$usernameOrEmail, $usernameOrEmail, $password);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        if(!$row){
            return false;
        }else{
            echo "sto per inserire in sessione";
            $row["Username"] == $usernameOrEmail ? $_SESSION["Username"]=$row["Username"] : $_SESSION["Username"]=$row["Username"];
            return true;
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

    function get_img_profile($con,$username) {
        $img_query = "SELECT ProfilePicture FROM users WHERE Username='$username'";
        $img_result = mysqli_query($con, $img_query);
        $img_row = mysqli_fetch_assoc($img_result);
        return $img_row['ProfilePicture'];
    }

    //returns all users followed. 
    function get_all_followed($username, $mysqli){
        $stmt = $mysqli->prepare("SELECT Username FROM follow WHERE Follower_Username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $toreturn = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $toreturn;
    }

    function get_all_follower($username, $mysqli){
        $stmt = $mysqli->prepare("SELECT * FROM follow WHERE Follower_Username = ?");
        if ($stmt === false) {
            // Errore nella preparazione della query
            echo "Errore nella preparazione della query: " . $mysqli->error;
            return [];
        }
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            // Errore nell'esecuzione della query
            echo "Errore nell'esecuzione della query: " . $stmt->error;
            return [];
        }
        $result = $stmt->get_result();
        $followers = [];
        while ($row = $result->fetch_assoc()) {
            $followers[] = $row['Username'];
        }
        return $followers;
    }

    function print_followed($username, $mysqli) {
        $followed_users = get_all_follower($username, $mysqli);
    
        if ($followed_users) {
            foreach ($followed_users as $user) {
                $userPhoto = get_img_profile($mysqli, $user);
                echo "<div class='dropdown-item alert alert-info'>";
                echo "<a href='profile.php?user=" . htmlspecialchars($user) . "' style='text-decoration: none; color: inherit;'>";
                echo "<img src='images/" . htmlspecialchars($userPhoto) . "' class='img-fluid rounded-circle mb-3' alt='Profile Image'>";
                echo "<p>" . htmlspecialchars($user) . "</p>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "Non stai seguendo nessuno.";
        }
    }

    function get_all_following($username, $mysqli) {
        $stmt = $mysqli->prepare("SELECT * FROM follow WHERE Username = ?");
        if ($stmt === false) {
            // Errore nella preparazione della query
            echo "Errore nella preparazione della query: " . $mysqli->error;
            return [];
        }
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            // Errore nell'esecuzione della query
            echo "Errore nell'esecuzione della query: " . $stmt->error;
            return [];
        }
        $result = $stmt->get_result();
        $followers = [];
        while ($row = $result->fetch_assoc()) {
            $followers[] = $row['Follower_Username'];
        }
        return $followers;
    }

    
    function print_following($username, $mysqli) {
        $followed_users = get_all_following($username, $mysqli);
    
        if ($followed_users) {
            foreach ($followed_users as $user) {
                $userPhoto = get_img_profile($mysqli, $user);
                echo "<div class='dropdown-item alert alert-info'>";
                echo "<a href='profile.php?user=" . htmlspecialchars($user) . "' style='text-decoration: none; color: inherit;'>";
                echo "<img src='images/" . htmlspecialchars($userPhoto) . "' class='img-fluid rounded-circle mb-3' alt='Profile Image'>";
                echo "<p>" . htmlspecialchars($user) . "</p>";
                echo "</a>";
                echo "</div>";
            }
        } else {
            echo "Non stai seguendo nessuno.";
        }
    }
    
    function get_all_posts_from_followers($followedList, $mysqli){
        $allPosts = [];
        foreach($followedList as $followed){
            $stmt = $mysqli->prepare("SELECT * FROM post WHERE Username=?");
            $stmt->bind_param("s", $followed['Username']);
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

    function print_base_post($username, $postId, $mysqli) {
        $profilePicture = get_img_profile($mysqli, $username);
        $imagePost = get_post_image($username, $postId, $mysqli);
        $postDescription = get_post_description($username, $postId, $mysqli);
        $tags = get_tags_of_post($username, $postId, $mysqli);
        $tagPills = print_tags_of_post($tags, $mysqli);
        if($imagePost != NULL){
            return "
                <div class='post-container'>
                    <div class='profile-section'>
                        <a href='profile.php?user=$username' style='text-decoration: none; color: inherit;'>
                            <img class='profile-image' src='images/$profilePicture' alt=''>
                            <div class='username'>$username</div>
                        </a>
                    </div>
                    <img class='post-image' src='images/$imagePost' alt=''>
                    <div class='collapsible-tags-container'>
                        <button class='tags-button' role='button' data-bs-toggle='collapse' data-bs-target='#tagsCollapse_$postId' aria-expanded='true' aria-controls='tagsCollapse_$postId' disabled>
                            Show Tags
                        </button>
                        <div class='collapse show' id='tagsCollapse_$postId'>
                            $tagPills
                        </div>
                    </div>

                    <div class='post-description'>$postDescription</div>
                </div>
                ";
        }else{
            return "
                <div class='post-container'>
                    <div class='profile-section'>
                        <a href='profile.php?user=$username' style='text-decoration: none; color: inherit;'>
                            <img class='profile-image' src='images/$profilePicture' alt=''>
                            <div class='username'>$username</div>
                        </a>
                    </div>
                    <div class='collapsible-tags-container'>
                        <button class='tags-button' role='button' data-bs-toggle='collapse' data-bs-target='#tagsCollapse_$postId' aria-expanded='true' aria-controls='tagsCollapse_$postId' disabled>
                            Show Tags
                        </button>
                        <div class='collapse show' id='tagsCollapse_$postId'>
                            $tagPills
                        </div>
                    </div>
                    <div>
                        <div class='post-description'>$postDescription</div>
                    </div>
                </div>
                ";
    }
}
    function print_post($username, $postId, $mysqli){
        $profilePicture = get_img_profile($mysqli, $username);
        $imagePost = get_post_image($username, $postId, $mysqli);
        $images = get_post_images($username, $postId, $mysqli);
        $carousel = print_images_carousel($images, $mysqli);
        $postDescription = get_post_description($username, $postId, $mysqli);
        $tags = get_tags_of_post($username, $postId, $mysqli);
        $tagPills = print_tags_of_post($tags, $mysqli);
        if($imagePost != NULL){
            return "
                <div class='post-container'>
                    <div class='profile-section'>
                        <a href='profile.php?user=$username' style='text-decoration: none; color: inherit;'>
                            <img class='profile-image' src='images/$profilePicture' alt=''>
                            <div class='username'>$username</div>
                        </a>
                    </div>
                    $carousel
                    <div class='icon'>
                        <div class='icon'>
                            <button class='like' id='$username' value='$postId'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-heart' viewBox='0 0 16 16'>
                                <path d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15'/>
                            </svg></button>
                        </div>
                        <div class='comment btn btn-primary' type='button' id='$postId' data-username='$username'  data-bs-toggle='offcanvas' data-bs-target='#comment'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat' viewBox='0 0 16 16'>
                                <path d='M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105'/>
                            </svg>
                        </div>
                    </div>
                    <div class='collapsible-tags-container'>
                        <button class='tags-button' role='button' data-bs-toggle='collapse' data-bs-target='#tagsCollapse_$postId' aria-expanded='false' aria-controls='tagsCollapse_$postId'>
                            Show Tags
                        </button>
                        <div class='collapse' id='tagsCollapse_$postId'>
                            $tagPills
                        </div>
                    </div>
                    <div class='post-description'>$postDescription</div>
                </div>
                ";
        }else{
            return "
                <div class='post-container'>
                    <div class='profile-section'>
                        <a href='profile.php?user=$username' style='text-decoration: none; color: inherit;'>
                            <img class='profile-image' src='images/$profilePicture' alt=''>
                            <div class='username'>$username</div>
                        </a>
                    </div>
                    <div class='icon'>
                        <div class='icon'>
                            <button class='like' id='$username' value='$postId'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-heart' viewBox='0 0 16 16'>
                                    <path d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15'/>
                                </svg></button>
                        </div>
                        <div class='comment btn btn-primary' type='button' id='$postId' data-username='$username'  data-bs-toggle='offcanvas' data-bs-target='#comment'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat' viewBox='0 0 16 16'>
                                <path d='M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105'/>
                            </svg>
                        </div>
                        <div class='collapsible-tags-container'>
                            <button class='tags-button' role='button' data-bs-toggle='collapse' data-bs-target='#tagsCollapse_$postId' aria-expanded='false' aria-controls='tagsCollapse_$postId'>
                                Show Tags
                            </button>
                            <div class='collapse' id='tagsCollapse_$postId'>
                                $tagPills
                            </div>
                        </div>
                        <div class='post-description'>$postDescription</div>
                    </div>
                </div>
                ";
        }
        
    }

    function get_tags_of_post($username, $postId, $mysqli){
        $stmt = $mysqli->prepare("SELECT IdCategory FROM belong WHERE Username=? AND IdPost=?");
        $stmt->bind_param("si", $username, $postId);
        $stmt->execute();
        $tags = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $tags;
    }

    function print_tags_of_post($tags, $mysqli){
        $tagPills = "";
        foreach($tags as $tag){
            echo $tag['IdCategory'];
            $stmt = $mysqli->prepare("SELECT CategoryName FROM category WHERE IdCategory=?");
            $stmt->bind_param("i", $tag['IdCategory']);
            $stmt->execute();
            $tagName = $stmt->get_result()->fetch_assoc()['CategoryName'];
            $tagPills .= "<span class='tag-pill'>$tagName</span>";
        }
        return $tagPills;
    }

    function get_all_post_ids_of_user($username, $mysqli){
        $stmt = $mysqli->prepare("SELECT IdPost FROM post WHERE Username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    function insert_post_image($postId, $image, $mysqli){
        $username = $_SESSION['Username'];
        foreach($image as $img){
            $stmt = $mysqli->prepare("INSERT INTO image (`Username`, `IdPost`, `Images`) VALUES (?, ?, ?);");
            $stmt->bind_param("sis", $username, $postId, $img['name']);
            $stmt->execute();
        }
    }

    function get_post_image($username, $postId, $mysqli){
        $stmt = $mysqli->prepare("SELECT Images FROM image WHERE Username=? AND IdPost=?");
        $stmt->bind_param("si",$username, $postId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['Images'];
    }

    function get_post_images($username, $postId, $mysqli){
        $stmt = $mysqli->prepare("SELECT Images FROM image WHERE Username=? AND IdPost=?");
        $stmt->bind_param("si",$username, $postId);
        $stmt->execute();
        $images = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $images;
    }

    function print_images_carousel($images, $mysqli){
        $carousel = "<div id='carousel' class='carousel slide'>
                        <div class='carousel-inner'>";
        foreach($images as $img){
            $imgName = $img['Images'];
            if($images[0] == $img){
                $carousel .= "<div class='carousel-item active'>
                                <img src='images/$imgName' class='d-block w-100'>
                              </div>";
            }else{
                $carousel .= "<div class='carousel-item'>
                                <img src='images/$imgName' class='d-block w-100'>
                              </div>";
            }
        $carousel .=    "</div>
                        <button class='carousel-control-prev' type='button' data-bs-target='#carousel' data-bs-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Previous</span>
                        </button>
                        <button class='carousel-control-next' type='button' data-bs-target='#carousel' data-bs-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Next</span>
                        </button>
                    </div>";
        }
        return $carousel;
    }

    // Close connection
    function close_connection($con) {
        $con->close();
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
                        <form method='post' action='edit_profile.php'  enctype='multipart/form-data'>
                            <input type='hidden' name='update_type' value='$type'>
                            <input type='$inputType' name='new_data' $maxLengthAttr required>
                            <input type='submit' value='Invia' name='submit'>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    }

    //Returns an array of all the images from the posts made by the user
    function print_post_image($username, $mysqli){
        $stmt = $mysqli->prepare("SELECT Images FROM image WHERE Username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $images = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $images;
    }

    function checkFollower($username, $follower_username, $con) {
        $query = $con->prepare("SELECT * FROM follow WHERE Username = ? AND Follower_Username = ?");
        $query->bind_param("ss", $username, $follower_username);
        $query->execute();
        return $query->get_result()->num_rows;
    }
    

    function get_last_interaction_id($username, $post_id, $mysqli){
        $stmt = $mysqli->prepare("SELECT max(idInteraction) FROM interaction WHERE Post_Publisher=? AND Published_Post_Id=?");
        $stmt->bind_param("si",$username,$post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['max(idInteraction)'];
        } else {
            return null;
        }
    }
    function get_last_notification_id($username, $post_id, $mysqli){
        $stmt = $mysqli->prepare("SELECT max(IdNotification) FROM interaction");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['max(IdNotification)'];
        } else {
            return null;
        }
    }

    function addNotification($usernameTo, $usernameFrom, $idPost, $type, $dateAndTime, $mysqli){
        $stmt = $mysqli->prepare("INSERT INTO notification(UsernameTo, UsernameFrom, Type, DateAndTime, IdPost) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisi", $usernameTo, $usernameFrom, $type, $dateAndTime, $idPost);
        $stmt->execute();
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
                        <img src='images/$postImg' alt=''>
                    </div>
                </div>";
    }

    function printLikeNotification($usernameTo, $usernameFrom, $idPost, $mysqli){
        $postImg = get_post_image($usernameTo, $idPost, $mysqli);
        $notificationMessage = "$usernameFrom liked your post.";
        return "<div class='rectangle'>
                    <div class='content'>
                        <p>$notificationMessage</p>
                        <img src='images/$postImg' alt=''>
                    </div>
                </div>";
    }

    function get_all_notifications_for_user($usernameTo, $mysqli){
        $stmt = $mysqli->prepare("SELECT * FROM notification WHERE UsernameTo=?");
        $stmt->bind_param("s", $usernameTo);
        $stmt->execute();
        $allNotifications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        usort($allNotifications, function($notif1, $notif2){
            return strtotime($notif1['DateAndTime']) - strtotime($notif2['DateAndTime']);
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
    
    function upload_image($path, $image){
        $imageName = basename($image["name"]);
        $fullPath = $path.$imageName;
        
        $maxKB = 500;
        $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
        $result = 0;
        $msg = "";
        $imageSize = getimagesize($image["tmp_name"]);

        if($imageSize === false) {
            $msg .= "File caricato non è un'immagine! ";
        }

        if ($image["size"] > $maxKB * 1024) {
            $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
        }
        $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

        if(!in_array($imageFileType, $acceptedExtensions)){
            $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
        }

        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
        }

        if(strlen($msg)==0){
            if(!move_uploaded_file($image["tmp_name"], $fullPath)){
                $msg.= "Errore nel caricamento dell'immagine.";
            }
            else{
                $result = 1;
                $msg = $imageName;
            }
        }
        return array($result, $msg);
    }
    
