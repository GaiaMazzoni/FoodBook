<?php
session_start();
include_once("../includes/connection.php");
include_once("../functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['back'])) {
        echo "<script>window.open('new_post.php','_self')</script>";
    }
}

