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
        $stmt = $mysqli->prepare("SELECT IdCategory FROM category WHERE Name=?");
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
    
    function generateForm($type, $label, $name, $maxLength = null) {
        $inputType = $type === 'image' ? 'file' : 'text';
        $inputType = $type === 'birthdate' ? 'date' : $inputType;
        $maxLengthAttr = $maxLength ? "maxlength='$maxLength'" : '';
        $formExtra = $type === 'image' ? " enctype='multipart/form-data'" : '';
    
        echo "<div class='form text-center' style='display: none;' id='change_{$type}_form'>";
        echo "<a href='profile.php' class='close-btn' id='close_{$type}_form'>X</a>";
        echo "<p>New $label</p>";
        echo "<form action='edit_profile.php' method='post' $formExtra>";
        echo "<input type='hidden' name='update_type' value='$name'>";
        echo "<input type='$inputType' name='new_data' $maxLengthAttr required>";
        echo "<input type='submit' value='invia'>";
        echo "</form>";
        echo "</div>";
    }
?>
