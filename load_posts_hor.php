<?php
include_once 'functions.php';
include_once("includes/connection.php");
session_start();

if(isset($_GET['user'])){
    $user = $_GET['user'];
    $images = print_post_image($user,$con); 
    foreach ($images as $img){
        $img = $img['Images'];
        echo "<img class='img' src='images/$img' alt=''>";
    }
}
