<?php
session_start();
include("includes/connection.php");

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </style>
    <title><?php echo '$user Profile'; ?></title>
</head>
</head>
<style>
    
</style>
<body>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <img src="images/<?php echo $profile_picture; ?>" class="img-fluid rounded-circle mb-3" alt="Immagine Profilo" style="width: 150px; height: 150px; object-fit: cover;">

                        <h3 class="card-title"><?php echo $first_name . " " . $surname; ?></h3>
                        <p class="text-muted">@<?php echo $user; ?></p>
                        <p class="card-text">
                            <strong>Email:</strong> <?php echo $email; ?><br>
                            <strong>Data di nascita:</strong> <?php echo $birth_date; ?><br>
                            <strong>Bio:</strong> <?php echo $bio; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>