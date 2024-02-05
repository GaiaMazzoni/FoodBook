<?php
include_once("../includes/connection.php");

$first_name = $_POST['first_name'];
$surname = $_POST['surname'];
$username = $_POST['user'];
$birthdate = $_POST['birth_date'];
$email = $_POST['email'];
$password = $_POST['password'];

$check_username_query = "select Username from users where Username='$username'";
$run_username = mysqli_query($con,$check_username_query);
$check_email_query = "select username from users where E_mail='$email'";
$run_email = mysqli_query($con,$check_email_query);

$check = mysqli_num_rows($run_username);

if($check == 1){
    $result = "USER";
} else {
    $check = mysqli_num_rows($run_email);
    if($check == 1){
        $result = "EMAIL";
    } else {
        $rand=rand(1,3);
        if($rand==1)
            $profile_picture = "profile_pizza.png";
        else if($rand==2)
            $profile_picture = "profile_cake.png";
        else if($rand==3)
            $profile_picture = "profile_veg.png";

        $password = password_hash($password, PASSWORD_DEFAULT);
        $insert = "insert into users(Name,Surname,Username,E_mail,BirthDate,Password,ProfilePicture,Bio)
        values('$first_name','$surname','$username','$email','$birthdate','$password','$profile_picture','My bio...')";
        $run_insert = mysqli_query($con,$insert);
        if($run_insert){
            $result = "OK";
        }
        else {
            $result = "FAIL";
        }
    }
}

header('Content-Type: application/json');
echo json_encode($result);

