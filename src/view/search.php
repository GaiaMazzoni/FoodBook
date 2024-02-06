<?php
include_once("../includes/header.php");
include_once("../includes/footer.php");
include_once("../includes/connection.php");
include_once("comment_form.php");

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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <script src="../js/search.js" defer></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/search.css">
    <title>Search</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="btn-group text-center">
                <button type="button" id="show_friends_form" class="btn btn-primary">friends</button>
                <button type="button" id="show_post_form" class="btn btn-primary">post</button>
            </div>

            <div id="friends_form">
                <h3 class="text-center" id="search_text" name="search_text">Search some friend</h3>
                <form method="POST">
                    <div class="form-group text-center">
                        <label for="friend_search">Friend Search:</label>
                        <input type="text" class="form-control" id="friend_search" name="friend_search" placeholder="...">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="s_button" name="s_button">Search</button>
                    </div>
                </form>
                <?php foreach($search_results as $user): 
                    $profile_pic = get_img_profile($con, $user); ?>
                    <div class="alert alert-info text-center">
                        <a href="profile.php?user=<?php echo urlencode($user); ?>">
                            <img src="../images/<?php echo $profile_pic; ?>" class="img-fluid rounded-circle mb-3" id="p_profile" alt="Profile Image">
                            <?php echo htmlspecialchars($user); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
                </div>

            <div id="post_form">
            <div class="text-center">
                    <button class="btn btn-primary" id="category_s_button" name="category_s_button">Search</button>
                </div>
                <div id="tag_form"></div>
                <div id="print_result"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>