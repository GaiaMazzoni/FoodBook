<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

if(isset($_POST['user'])){
    $user = $_POST['user'];
    $images =  get_all_first_images_of_post($user, $con);
    $result = "";
    foreach ($images as $img){
        $i = $img['Images'];
        $result .= "<img class='img' src='../images/$i' alt=''>";
    }
    echo $result;
}

