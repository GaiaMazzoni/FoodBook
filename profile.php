<?php
session_start();
include_once 'functions.php';
include_once("includes/header.php");
include_once("includes/footer.php");
include_once("includes/connection.php");

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}

$user = isset($_GET['user']) ? mysqli_real_escape_string($con, $_GET['user']) : '';

$is_own_profile = ($_SESSION['Username'] == $user);

$get_user = "select * from users where Username='$user'";
$run_user = mysqli_query($con,$get_user);
$row = mysqli_fetch_array($run_user);

$first_name = $row['Name'];
$email = $row['E_mail'];
$surname = $row['Surname'];
$birth_date = $row['BirthDate'];
$profile_picture = $row['ProfilePicture'];
$bio = $row['Bio'];
$password = $row['Password'];


$user_posts = "select * from post where Username='$user'";
$run_posts = mysqli_query($con,$user_posts);
$num_posts = mysqli_num_rows($run_posts);

$user_follower = "select * from follow where Follower_Username='$user'";
$run_follower = mysqli_query($con,$user_follower);
$num_follower = mysqli_num_rows($run_follower);

$user_following = "select * from follow where Username='$user'";
$run_following = mysqli_query($con,$user_following);
$num_following = mysqli_num_rows($run_following);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  
    <title><?php echo "$user Profile"; ?></title>
</head>
<style>
    .collapsible-tags-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-top: 1px solid #eee;
    }

    .tags-button {
        background-color: transparent;
        border: none;
        color: #4f0484;
        cursor: pointer;
    }

    .tags-button:focus {
        outline: none;
    }

    .tags-collapse {
        display: flex;
        flex-wrap: wrap;
    }

    .tag-pill {
        margin-right: 5px;
        margin-bottom: 5px;
        padding: 5px 10px;
        background-color: #4f0484;
        color: #fff;
        border-radius: 20px;
        cursor: pointer;
    }
.position-relative {
    position: relative;
}
.container_form {
    position: relative;
    display: flex;
    justify-content: center;
}
.container_form > * {
    background-color: red;
    position: absolute;
    z-index: 1001;
    padding: 10px;
}
.close-btn {
    position: absolute;
    top: 1px;
    right: 10px;
    font-size: 20px;
    color: #000;
    text-decoration: none;
}
#followerButton, #followingButton {
    background-color: transparent; 
    border: none; 
    box-shadow: none;
    color: black;
}
#followerButton::after, #followingButton::after {
    display: none;
}
.dropdown-menu {
    max-height: 200px;
    overflow-y: auto;
    max-width: 200px;
}

.image-container {
    display: flex;
    flex-wrap: wrap;
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.button-container button {
    margin: 0 10px;
}

.image-container img {
    width: calc(33.33% - 10px);
    margin-bottom: 10px;
    box-sizing: border-box;
}

.select{
    background-color: #4f0484;
}

.post-container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
}

.profile-section {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.profile-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.username {
    font-weight: bold;
}

.post-image {
    width: 100%;
    height: auto;
}

.interaction-icons {
    padding: 10px;
    display: flex;
    justify-content: space-between;
    border-top: 1px solid #eee;
}

.icon {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.icon img {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

.profile-section a {
    display: flex; 
    align-items: center; 
    text-decoration: none;
    color: inherit;
}

.post-description{
    padding: 10px;
}

</style>
<body>
<?php if($is_own_profile): ?>
    <div class="dropdown">
        <button type="button" id="edit_profile" class="btn btn-primary btn-sm float-end mt-3dropdown-toggle" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
    </svg> Edit Profile</button>
        <ul class="dropdown-menu" id="edit_menu">
            <li><button type="button" class="btn btn-primary dropdown-item" data-bs-toggle="modal" data-bs-target="#change_image_form" id="change_image_btn">Change Image</button></li>
            <li><button type="button" class="btn btn-primary dropdown-item" data-bs-toggle="modal" data-bs-target="#change_bio_form" id="change_bio_btn">Change Bio</button></li>
            <li><button type="button" class="btn btn-primary dropdown-item" data-bs-toggle="modal" data-bs-target="#change_email_form" id="change_email_btn">Change Email</button></li>
            <li><button type="button" class="btn btn-primary dropdown-item" data-bs-toggle="modal" data-bs-target="#change_birthdate_form" id="change_birthdate_btn">Change BirthDate</button></li>
            <li><button type="button" class="btn btn-primary dropdown-item" data-bs-toggle="modal" data-bs-target="#change_name_form" id="change_name_btn">Change Name</button></li>
            <li><button type="button" class="btn btn-primary dropdown-item" data-bs-toggle="modal" data-bs-target="#change_password_form" id="change_password_btn">Change Password</button></li>
        </ul>
    </div>


    <?php 
        echo generateModalForm('bio', 'Bio', 150);
        echo generateModalForm('email', 'Email', 30);
        echo generateModalForm('birthdate', 'BirthDate');
        echo generateModalForm('image', 'Image'); 
    ?>
    <form method='post' action=''  enctype='multipart/form-data'>
        <input type='hidden' name='update_type' value='ema'>
        <input type='file' name='new_data' id="image" required>
        <input type='submit' value='Invia' onclick="uploadImage()" name='submit' id="image_form">
    </form>
    <div class='modal' id='change_name_form'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title'>Change Name</h4>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form method='post' action='edit_profile.php'>
                        <input type='hidden' name='update_type' value='name'>
                        <input type=text name='new_data' 20 required>
                        <input type=text name='second_data' 20 required>
                        <input type='submit' value='Invia' name='submit'>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class='modal' id='change_password_form'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title'>Change Password</h4>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form method='post' action='edit_profile.php'>
                        <input type='hidden' name='update_type' value='password'>
                        Old Password:
                        <input type=text name='new_data' 20 required>
                        </br>New Password:
                        <input type=text name='second_data' 20 required>
                        <input type='submit' value='Invia' name='submit'>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-3 text-center">
            <img src="images/<?php echo $profile_picture; ?>" class="img-fluid rounded-circle mb-3" id="p_profile" alt="Immagine Profilo" style="width: 200px; height: 200px; object-fit: cover;">
        </div>
        <div class="col-12 col-md-3 text-center">
            <h3 class="card-title"><?php echo $first_name . " " . $surname; ?></h3>
            <p class="text-muted">@<?php echo $user; ?></p>
            <p class="card-text">
                <strong>Email:</strong> <?php echo $email; ?><br>
                <strong>Data di nascita:</strong> <?php echo $birth_date; ?><br>
            </p>
            <div class="row">
                <div class="col-4 text-center">
                    <?php echo $num_posts; ?>
                    <p>post</p>
                </div>
                <div class="dropdown col-4 text-center">
                    <button type="button" id="followerButton" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <?php echo $num_follower; ?>
                        <p>follower</p>
                    </button>
                    <ul class="dropdown-menu">
                        <?php print_followed($user, $con); ?>
                    </ul>
                </div>
                <div class="dropdown col-4 text-center">
                    <button type="button" id="followingButton" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <?php echo $num_following; ?>
                        <p>following</p>
                    </button>
                    <ul class="dropdown-menu">
                        <?php print_following($user, $con); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <p class="card-text">
                <strong>Bio:</strong> <?php echo $bio; ?><br>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <?php if (!$is_own_profile): ?>
        <button id="followButton" class="" onclick="follow()">Follow</button>
        <script>
            function check_follow() {
                var button = document.getElementById("followButton");
                var username = "<?php echo addslashes($user); ?>";
                let formData = new FormData();
                formData.append('following', username);
                axios.post('check_follow.php',formData).then(response => {
                    if(response.data == 1) {
                        if(!button.classList.contains("Follow")) {
                            button.classList.add("Follow");
                            button.innerHTML = "Unfollow";
                        } 
                    } 
                });                 
            }

            check_follow();

            function follow() {
                var button = document.getElementById("followButton");
                var username = "<?php echo addslashes($user); ?>";
                let formData = new FormData();
                formData.append('following', username);
                if (button.classList.contains("Follow")) {
                    button.classList.remove("Follow");
                    formData.append('remove', 1);
                } else if (!button.classList.contains("Follow")) {
                    button.classList.add("Follow");
                    formData.append('remove', 0);
                }
                axios.post('follow_handler.php',formData).then(response => {
                    console.log(response.data);
                });  
                location.reload();
            }
        </script>
    <?php endif; ?>
</div>
<div class="button-container">
    <button type="button" class="post-view hor select" onclick="select(this)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-3x2" viewBox="0 0 16 16">
            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v8a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5zM1.5 3a.5.5 0 0 0-.5.5V7h4V3zM5 8H1v3.5a.5.5 0 0 0 .5.5H5zm1 0v4h4V8zm4-1V3H6v4zm1 1v4h3.5a.5.5 0 0 0 .5-.5V8zm0-1h4V3.5a.5.5 0 0 0-.5-.5H11z"/>
        </svg>
    </button>
    
    <button type="button" class="post-view ver" onclick="select(this)">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-vertical" viewBox="0 0 16 16">
            <path d="M8.354 14.854a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 13.293V2.707L6.354 3.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 2.707v10.586l1.146-1.147a.5.5 0 0 1 .708.708z"/>
        </svg>
    </button>

</div>

    <div class="image-container">
        <?php
            $images = print_post_image($user,$con); 
            foreach ($images as $img){
                $img = $img['Images'];
                echo "<img class='img' src='images/$img' alt=''>";
            }
        ?>
    </div>
</body>
</html>
<script>
    let user = "<?php echo addslashes($user); ?>";
    function select(button){
        if(!button.classList.contains('select')){
            Array.from(document.getElementsByClassName('select')).forEach(element => {
                element.classList.remove('select');
            });
            button.classList.add('select');
        }
        let hor = document.getElementsByClassName('hor')[0];
        if(!hor.classList.contains('select')){
            let imageContainer = document.querySelector('.image-container');
            while (imageContainer.firstChild) {
                imageContainer.removeChild(imageContainer.firstChild);
            }

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    imageContainer.innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", `load_posts_ver.php?user=${user}`, true);
            xhr.send();
        }else{
            let imageContainer = document.querySelector('.image-container');
            while (imageContainer.firstChild) {
                imageContainer.removeChild(imageContainer.firstChild);
            }

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    imageContainer.innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", `load_posts_hor.php?user=${user}`, true);
            xhr.send();
        }
    }

    function uploadImage() {
        event.preventDefault();
        const formDataImage = new FormData();
        console.log("ciao");
        formDataImage.append("image", document.querySelector("image").files[0]);
        console.log(document.querySelector("#image").files[0]);
        axios.post('edit_image.php', formDataImage).then(response => {
            console.log(response.data);
        });

    };

</script>