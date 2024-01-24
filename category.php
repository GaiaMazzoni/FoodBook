<?php

include("includes/connection.php");
include "function.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_cat = $_POST['num_cat'];
    $id = get_last_post_id($_SESSION['Username'],$con);
    for($i = 1; $i < $num_cat; $i++) {
        $cat = $_POST[$i];
        add_tag($cat, $id, $_SESSION['Username'], $con);
    }
} else {
    echo "Non è una richiesta POST";
}
