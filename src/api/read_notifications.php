<?php
include '../includes/functions.php';
include '../includes/connection.php';
include '../includes/database.php';

echo "reading"; //VA LASCIATO??
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allNotif = get_all_unread_notifications($_POST['usernameTo'], $con);
    foreach ($allNotif as $n) {
        read_notification($n, $con);
    }
}