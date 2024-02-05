<?php
include_once("../includes/functions.php");

session_start();
session_unset();
session_destroy();
header("Location: ../view/login.php");
close_connection($con);
?>
