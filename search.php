<?php
session_start();
include("includes/header.php");
include("includes/footer.php");
include("includes/connection.php");

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}

$search_results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['friend_search'])) {
    $search_term = mysqli_real_escape_string($con, $_POST['friend_search']);
    $session_user = $_SESSION['Username'];
    
    $query = "SELECT Username FROM users WHERE (Username LIKE '%$search_term%' OR Name LIKE '%$search_term%' OR 
        Surname LIKE '%$search_term%' OR E_mail LIKE '%$search_term%') AND Username != '$session_user'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row['Username'];
        }
    } else {
        echo "No results found";
    }
}
?>
<style>
    #p_profile{
        width: 50px;
        height: 50px;
    }
    #friend_search {
        width: 70%;
        margin: 10px;
        
    }
    #s_button {
        margin-bottom: 5px;
    }
    .alert {
        width: 70%;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Search</title>
</head>
<style>

</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center" id="search_text" name="search_text">Search some friend</h3>
            <form method="POST">
                <div class="form-group">
                    <center><input type="text" class="form-control" id="friend_search" name="friend_search" placeholder="..."></center>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="s_button" name="s_button">Search</button>
                </div>
            </form>

            <?php foreach($search_results as $username): ?>
                <?php
                    $img_query = "SELECT ProfilePicture FROM users WHERE Username='$username'";
                    $img_result = mysqli_query($con, $img_query);
                    $img_row = mysqli_fetch_assoc($img_result);
                    $profile_pic = $img_row['ProfilePicture'];
                ?>
                <center><div class="alert alert-info">
                    <img src="images/<?php echo $profile_pic; ?>" class="img-fluid rounded-circle mb-3" id="p_profile" alt="Immagine Profilo">
                    <?php echo htmlspecialchars($username); ?>
                </div></center>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>
