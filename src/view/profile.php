<?php
include_once("../includes/header.php");
include_once("../includes/footer.php");
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("comment_form.php");

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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/profile.css">
<script src="../js/profile.js" defer></script>
    <title><?php echo "$user Profile"; ?></title>
</head>
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
    <form method='post' enctype='multipart/form-data'>
        <input type='hidden' name='update_type' value='ema'>
        <input type='file' name='new_data' id="image" required>
        <input type='submit' value='Invia' name='submit' id="image_form">
    </form>
    <div class='modal' id='change_name_form'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title'>Change Name</h4>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form method='post' action='../api/edit_profile.php'>
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
                    <form method='post' action='../api/edit_profile.php'>
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
            <img src="../images/<?php echo $profile_picture; ?>" class="img-fluid rounded-circle mb-3" id="p_profile" alt="Immagine Profilo">
        </div>
        <div class="col-12 col-md-3 text-center">
            <h3 class="card-title"><?php echo $first_name . " " . $surname; ?></h3>
            <p id="username" class="text-muted"><?php echo $user; ?></p>
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
    <?php if (!$is_own_profile): ?>
        <button id="followButton" class="" >Follow</button>
    <?php endif; ?>
</div>
<div class="button-container">
    <button id="horizontal_post_button" type="button" class="post-view hor">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-3x2" viewBox="0 0 16 16">
            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v8a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5zM1.5 3a.5.5 0 0 0-.5.5V7h4V3zM5 8H1v3.5a.5.5 0 0 0 .5.5H5zm1 0v4h4V8zm4-1V3H6v4zm1 1v4h3.5a.5.5 0 0 0 .5-.5V8zm0-1h4V3.5a.5.5 0 0 0-.5-.5H11z"/>
        </svg>
    </button>
    
    <button id="vertical_post_button" type="button" class="post-view ver">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-vertical" viewBox="0 0 16 16">
            <path d="M8.354 14.854a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 13.293V2.707L6.354 3.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 2.707v10.586l1.146-1.147a.5.5 0 0 1 .708.708z"/>
        </svg>
    </button>

</div>

    <div class="image-container">
        
    </div>
</body>
</html>
