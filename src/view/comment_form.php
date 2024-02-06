<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comment form:</title>
    <meta charset="UTF-8">
</head>
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
                <label for="commentText">Comment text:</label>
                <textarea id='commentText' name='commentText' rows='1' cols='30'></textarea>
                <input id='publish_comment' type='submit' class='$post_publisher' value='publish'>
            </form>
        </div>
    </div>
</body>
</html>