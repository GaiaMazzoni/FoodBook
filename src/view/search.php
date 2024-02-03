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
    .select{
        background-color: #000;
    }
</style>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .post-container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .profile-section {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .profile-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .username {
        font-weight: bold;
    }

    .post-image {
        width: 100%;
        height: auto;
    }

    .interaction-icons {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #eee;
    }

    .icon {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .icon img {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }

    .profile-section a {
        display: flex; 
        align-items: center; 
        text-decoration: none;
        color: inherit;
    }

    .post-description{
        padding: 10px;
    }

    .collapsible-tags-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-top: 1px solid #eee;
    }

    .tags-button {
        background-color: transparent;
        border: none;
        color: #4f0484;
        cursor: pointer;
    }

    .tags-button:focus {
        outline: none;
    }

    .tags-collapse {
        display: flex;
        flex-wrap: wrap;
    }

    .tag-pill {
        margin-right: 5px;
        margin-bottom: 5px;
        padding: 5px 10px;
        background-color: #4f0484;
        color: #fff;
        border-radius: 20px;
        cursor: pointer;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <script src="./search.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Search</title>
</head>
<style>
.btn-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px; /* Aggiunge uno spazio tra i bottoni */
}

.btn-group button {
    margin-bottom: 10px; /* Spazio aggiuntivo sotto ciascun bottone, se necessario */
}
</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <center><div class="btn-group">
                <button type="button" id="show_friends_form" class="btn btn-primary">friends</button>
                <button type="button" id="show_post_form" class="btn btn-primary">post</button>
            </div></center>

            <div id="friends_form">
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
                        <a href="profile.php?user=<?php echo urlencode($username); ?>" style="text-decoration: none; color: inherit;">
                            <img src="images/<?php echo $profile_pic; ?>" class="img-fluid rounded-circle mb-3" id="p_profile" alt="Immagine Profilo">
                            <?php echo htmlspecialchars($username); ?>
                        </a>
                    </div></center>
                <?php endforeach; ?>
                </div>

            <div id="post_form" style="display: none;">
                <div id="tag_form"></div>
                <div class="text-center">
                    <button type="" class="btn btn-primary" id="category_s_button" name="category_s_button" onclick="search_category(event)">Search</button>
                </div>
                <div id="print_result"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
