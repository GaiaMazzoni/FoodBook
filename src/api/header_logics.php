<?php
include_once("../includes/connection.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['home_button'])){
        echo "<script>window.open('../view/home.php','_self')</script>";
    }
    if(isset($_POST['search_button'])){
        echo "<script>window.open('../view/search.php','_self')</script>";
    }
}
