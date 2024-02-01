<?php
include_once("includes/connection.php");
    if(isset($_POST['signup'])){
        $first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
        $surname = htmlentities(mysqli_real_escape_string($con,$_POST['surname']));
        $username = htmlentities(mysqli_real_escape_string($con,$_POST['username']));
        $birthdate = htmlentities(mysqli_real_escape_string($con,$_POST['birth_date']));
        $email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
        $password = htmlentities(mysqli_real_escape_string($con,$_POST['password']));

        $check_username_query = "select Username from users where Username='$username'";
        $run_username = mysqli_query($con,$check_username_query);
        $check_email_query = "select username from users where E_mail='$email'";
        $run_email = mysqli_query($con,$check_email_query);

        if(strlen($password) < 9) {
            echo "<script>alert('Password should be minimum 8 characters')</script>";
            exit();
        }

        $check = mysqli_num_rows($run_username);

        if($check == 1){
            echo "<script>alert('Username already exist, please try using another username')</script>";
            echo "<script>window.open('signup.php','_self')";
            exit();
        }

        $check = mysqli_num_rows($run_email);

        if($check == 1){
            echo "<script>alert('Email already exist, please try using another email')</script>";
            echo "<script>window.open('signup.php','_self')";
            exit();
        }

        $rand=rand(1,3);

            if($rand==1)
                $profile_picture = "profile_pizza.png";
            else if($rand==2)
                $profile_picture = "profile_cake.png";
            else if($rand==3)
                $profile_picture = "profile_veg.png";

        $insert = "insert into users(Name,Surname,Username,E_mail,BirthDate,Password,ProfilePicture,Bio)
        values('$first_name','$surname','$username','$email','$birthdate','$password','$profile_picture','My bio...')";
        $run_insert = mysqli_query($con,$insert);

        if($run_insert){

        }
        else {
            echo "<script>alert('Registration failed, please try again')</script>";
            echo "<script>window.open('signup.php','_self')";
            exit();
        }
    }

?>