function check_like() {
    var buttons = document.getElementsByClassName("like");
    if(buttons.length > 0) {
        Array.from(buttons).forEach(element => {
            let post_publisher = element.id;
            let post_id = element.value;
            let formData = new FormData();
            formData.append('post_publisher', post_publisher);
            formData.append('post_id', post_id);
            axios.post("../api/check_like.php", formData).then(response => {
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
        let post_publisher = button.id;
        let post_id = button.value;
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
        axios.post("../api/likes.php", formData).then(response => {
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
        post_publisher_comment = button.getAttribute('data-username');
        post_id_comment = button.id;
        let formData = new FormData();
        formData.append('post_publisher', post_publisher_comment);
        formData.append('post_id', post_id_comment);
        axios.post("../api/print_comments.php", formData).then(response => {
            const commentsContainer = document.getElementById("print_comments");
            commentsContainer.innerHTML = response.data;
        });
        console.log("il post value è: ", post_publisher_comment);
    });
});

document.getElementById('comment_form').addEventListener('submit', function(event) {
    let comment = document.getElementById('commentText').value;
    let formData = new FormData();
    formData.append('post_publisher', post_publisher_comment);
    formData.append('post_id', post_id_comment);
    formData.append('text', comment);
    axios.post("../api/comment.php", formData).then(response => {
        console.log(response.data);
    });
    location.reload(true);
});