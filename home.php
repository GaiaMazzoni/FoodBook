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
    include("functions.php");
    ?>
</head>
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
    </style>
<body>
    <div class="offcanvas offcanvas-bottom" id="comment">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Comments:</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        
        <div class='offcanvas-body'>
            <div id=print_comments> 
            </div>  
            <form id='comment_form' method='post'>
                <textarea id='commentText' name='commentText' rows='1' cols='30'></textarea></br>
                <input id='publish_comment' type='submit' class='$post_publisher' value='publish'>
            </form>
        </div>
    </div>
    <?php
        $username = $_SESSION['Username'];
        $followers = get_all_followed($username, $con);
        $posts = get_all_posts_from_followers($followers, $con);
        foreach($posts as $post){
            echo print_post($post['Username'], $post['IdPost'], $con)
            ;
        }
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function check_like() {
        var buttons = document.getElementsByClassName("like");
        if(buttons.length > 0) {
            Array.from(buttons).forEach(element => {
                var post_publisher = element.id;
                var post_id = element.value;
                let formData = new FormData();
                formData.append('post_publisher', post_publisher);
                formData.append('post_id', post_id);
                axios.post("check_like.php", formData).then(response => {
                    if(response.data == 1) {
                        element.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/></svg>';
                        if (!element.classList.contains("OK")) {
                            element.classList.add("OK");
                        }
                    }
                });
            });
        }
    }
    
    window.onload = check_like;

    var like_bottons = document.querySelectorAll('.like');
    like_bottons.forEach(function(button) {
        button.addEventListener('click', function() {
            var post_publisher = button.id;
            var post_id = button.value;
            let formData = new FormData();
            formData.append('post_publisher', post_publisher);
            formData.append('post_id', post_id);
            if (button.classList.contains("OK")) {
                formData.append('remove', 1);
                button.classList.remove("OK");
                console.log("ciao sono in remove");
            } else {
                formData.append('remove', 0);
                console.log("ciao sono in add");
            }
            axios.post("likes.php", formData).then(response => {
                console.log(response.data);
            });
            location.reload(true);
        });
    });

    var post_publisher_comment = null;
    var post_id_comment = null;
    var comment_buttons = document.querySelectorAll('.comment');
    comment_buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            post_publisher_comment = button.getAttribute('data-username');;
            post_id_comment = button.id;
            let formData = new FormData();
            formData.append('post_publisher', post_publisher_comment);
            formData.append('post_id', post_id_comment);
            axios.post("print_comments.php", formData).then(response => {
                const commentsContainer = document.getElementById("print_comments");
                commentsContainer.innerHTML = response.data;
            });
            console.log("il post value è: ", post_publisher_comment);
        });
    });

    document.getElementById('comment_form').addEventListener('submit', function(event) {
        event.preventDefault();
        var comment = document.getElementById('commentText').value;
        let formData = new FormData();
        formData.append('post_publisher', post_publisher_comment);
        formData.append('post_id', post_id_comment);
        formData.append('text', comment);
        axios.post("comment.php", formData).then(response => {
            console.log(response.data);
        });
        location.reload(true);
    });

</script>

</html>
