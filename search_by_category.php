<?php

include_once("includes/connection.php");
include_once("functions.php");

function get_posts_from_category($cat_list, $num_cat, $mysqli) {
    $placeholders = implode(',', array_fill(0, $num_cat, '?'));
    return $placeholders;
    /*$stmt = $mysqli->prepare("SELECT Username, IdPost FROM belong WHERE IdCategory IN ($placeholders) GROUP BY Username, IdPost HAVING COUNT(DISTINCT IdCategory) = ?");
    $params = array_merge($cat_list, array($num_cat));
    $stmt->bind_param("si", $cat_list, $num_cat);
    $types = str_repeat('s', count($cat_list)) . 'i';
    call_user_func_array(array($stmt, 'bind_param'), array_merge(array($types), $params));
    $stmt->execute();
    $post = $stmt->get_result();
    return $post;*/
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_cat = $_POST['num_cat'];
    $cat_list = [];
    for($i = 1; $i < $num_cat+1; $i++) {
        $cat_list[] = $_POST[$i];
    }
    return get_posts_from_category($cat_list,$num_cat,$con);

} 