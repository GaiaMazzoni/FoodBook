<?php

include_once("includes/connection.php");
include_once("functions.php");

function get_posts_from_category($cat_list, $num_cat, $mysqli) {
    $placeholders = implode(',', array_fill(0, $num_cat, '?'));
    $stmt = $mysqli->prepare("SELECT Username, IdPost FROM belong WHERE IdCategory IN ($placeholders) GROUP BY Username, IdPost HAVING COUNT(DISTINCT IdCategory) = ?");
    $params = array_merge($cat_list, array($num_cat));
    $types = str_repeat('s', count($cat_list)) . 'i';
    $stmt -> bind_param($types, ...$params);
    call_user_func_array(array($stmt, 'bind_param'), array_merge(array($types), $params));
    $stmt->execute();
    $post = $stmt->get_result();
    return $post;
}

function get_id_category($category_name, $mysqli) {
    $stmt = $mysqli->prepare("SELECT IdCategory FROM category WHERE CategoryName=?");
    $stmt -> bind_param('s', $category_name);
    $stmt -> execute();
    return $stmt -> get_result() -> fetch_assoc()['IdCategory'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_cat = $_POST['num_cat'];
    $cat_list = [];
    for($i = 1; $i < $num_cat+1; $i++) {
        $cat_name = $_POST[$i];
        $cat_list[] = get_id_category($cat_name, $con);
        echo $cat_name;
        echo $cat_list[$i-1];
    }
    $result = get_posts_from_category($cat_list, $num_cat, $con);
    $print = "<?php";

    foreach($result as $post) {
        $print .= print_base_post($post['Username'],$post['IdPost'],$con);
        $print .= ";";
    }

    $print .= "?>";
    echo $print;
} 