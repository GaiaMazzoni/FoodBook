<?php
$con = mysqli_connect("localhost","root","","foodbook");
 
 if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}