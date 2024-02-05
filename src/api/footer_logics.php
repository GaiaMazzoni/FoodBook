<?php
session_start();
include_once("../includes/connection.php");

$username = $_SESSION['Username'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['new_post_button'])){
        echo "<script>window.open('../view/new_post.php','_self')</script>";
    }
    if (isset($_POST['profile_button'])) {
        echo "<script>window.open('../view/profile.php?user=$username','_self');</script>";
    }
}
       