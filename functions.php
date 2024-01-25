<?php
    include ("includes/connection.php");

    function check_login($usernameOrEmail, $password, $mysqli){
        $stmt = $mysqli->prepare("SELECT Username, E_mail FROM users WHERE Username=? OR E_mail=? AND Password=?");
        $stmt->bind_param("sss",$usernameOrEmail, $usernameOrEmail, $password);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        if(!$row){
            return false;
        }else{
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

    // Close connection
    function close_connection($con) {
        $con->close();
    }

    function get_img_profile($con,$username) {
        $img_query = "SELECT ProfilePicture FROM users WHERE Username='$username'";
        $img_result = mysqli_query($con, $img_query);
        $img_row = mysqli_fetch_assoc($img_result);
        return $img_row['ProfilePicture'];
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
                        <form method='post' action='edit_profile.php'>
                            <input type='hidden' name='update_type' value='$type'>
                            <input type='$inputType' name='new_data' $maxLengthAttr required>
                            <input type='submit' value='Invia' name='submit'>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    }

    function checkFollower($username, $follower_username, $con) {
        $query = $con->prepare("SELECT * FROM follow WHERE Username = ? AND Follower_Username = ?");
       /* if ($query === false) {
            return "Error preparing statement: " . $con->error;
        }*/
    
        $query->bind_param("ss", $username, $follower_username);
        $query->execute();
        return $query->get_result()->num_rows;
        /*if (!$query->execute()) {
            return "Error executing statement: " . $query->error;
        }*/
    
        //$result = $query->get_result();
       /* if ($result === false) {
            return "Error in get_result: " . $query->error;
        }*/
    
        //$count = $result->num_rows;
        //return $count;
    }
    

    function follow($username, $follower_username, $con) {
        $query = $con->prepare("INSERT INTO follow(Follower_Username, Username) VALUES (?, ?)");
        $query->bind_param("ss", $follower_username, $username);
        $query->execute();
    }

    function unfollow($username, $follower_username, $con) {
        $query = $con->prepare("DELETE FROM follow WHERE Follower_Username = ? AND Username = ?");
        $query->bind_param("ss", $follower_username, $username);
        $query->execute();
    }
    
