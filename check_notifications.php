<?php
include 'functions.php';
include 'includes/connection.php';

echo "reading";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allNotif = get_all_unread_notifications($_POST['usernameTo'], $con);
    foreach ($allNotif as $n) {
        echo $n['DateAndTime'];
        read_notification($n, $con);
    }
    
}