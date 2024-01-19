<?php
session_start();
include("includes/connection.php");
include("includes/header.php");
include("includes/footer.php");

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['Username'];
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

$user_follower = "select * from follow where Username='$user'";
$run_follower = mysqli_query($con,$user_follower);
$num_follower = mysqli_num_rows($run_follower);

$user_following = "select * from follow where Follower_Username='$user'";
$run_following = mysqli_query($con,$user_following);
$num_following = mysqli_num_rows($run_following);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title><?php echo "$user Profile"; ?></title>
</head>
</head>
<style>
body > div{
    margin:0.5%;
}
#p_profile {
    margin: 1%;
}
</style>
<body>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <img src="images/<?php echo $profile_picture; ?>" class="img-fluid rounded-circle mb-3" id="p_profile" alt="Immagine Profilo" style="width: 200px; height: 200px; object-fit: cover;">
    </div>
    <div class="col-md-6 col-sm-12">
        <h3 class="card-title"><?php echo $first_name . " " . $surname; ?></h3>
        <p class="text-muted">@<?php echo $user; ?></p>
        <p class="card-text">
            <strong>Email:</strong> <?php echo $email; ?><br>
            <strong>Data di nascita:</strong> <?php echo $birth_date; ?><br>
            <strong>Bio:</strong> <?php echo $bio; ?><br>
            <?php echo $num_posts; ?>
            <?php echo $num_follower; ?>
            <?php echo $num_following; ?><br>
        </p>
    
    </div>
</div>
</body>
</html>