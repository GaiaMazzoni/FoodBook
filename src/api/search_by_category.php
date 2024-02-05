<?php
include_once("../includes/connection.php");
include_once("../includes/functions.php");
include_once("../includes/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_cat = $_POST['num_cat'];
    $cat_list = [];
    for($i = 1; $i < $num_cat+1; $i++) {
        $cat_name = $_POST[$i];
        $cat_list[] = get_id_category($cat_name, $con);
    }
    $result = get_posts_from_category($cat_list, $num_cat, $con);
    $print = "<?php";

    foreach($result as $post) {
        $print .= print_base_post($post['Username'],$post['IdPost'],$con);
        //$print .= ";";
    }

    $print .= "?>";

    error_log($print . PHP_EOL, 3, "log.txt");

    header('Content-Type: application/json');
    echo json_encode("$print");
} 