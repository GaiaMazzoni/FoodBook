<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </style>
    <title>Responsive Interface</title>
    <?php
    include("includes/header.php");
    include("includes/footer.php");
    include("includes/connection.php");
    session_start();
    ?>
</head>
<style>

</style>
<body>
    <?php
        $username = $_SESSION['Username'];
        $followers = get_all_followed($username, $mysqli);
    ?>
</body>
</html>
