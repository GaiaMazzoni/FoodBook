<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['signup_button'])){
        echo "<script>window.open('./signup.php','_self')</script>";
    }
    if(isset($_POST['login_button'])){
        echo "<script>window.open('./login.php','_self')</script>";
    }
}
                    