document.addEventListener('DOMContentLoaded', function() {
    loadPosts(addEventListeners);
    check_follow()
});


function loadPosts(callback) {
    let username = document.getElementById("username").textContent;
    console.log(username);
    let formData = new FormData();
    formData.append('user', username);
    axios.post('../api/load_posts_ver.php',formData).then(response => {
        const commentsContainer = document.getElementById("vertical-posts");
        commentsContainer.innerHTML = response.data;
        if (callback) callback();
    });
    axios.post('../api/load_posts_hor.php',formData).then(response => {
        const commentsContainer = document.getElementById("horizontal-posts");
        commentsContainer.innerHTML = response.data;
    }); 


    document.getElementById("horizontal").style.display = "block";
    document.getElementById("vertical").style.display = "none";

    document.getElementById("horizontal_post_button").addEventListener("click", function() {
        document.getElementById("horizontal").style.display = "block";
        document.getElementById("vertical").style.display = "none";
    });
    
    document.getElementById("vertical_post_button").addEventListener("click", function() {
        document.getElementById("horizontal").style.display = "none";
        document.getElementById("vertical").style.display = "block";
    });    
} 

function check_follow() {
    let button = document.getElementById("followButton");
    let username = document.getElementById("username").textContent;
    let formData = new FormData();
    formData.append('following', username);
    axios.post('../api/check_follow.php',formData).then(response => {
        if(response.data == 1) {
            if(!button.classList.contains("Follow")) {
                button.classList.add("Follow");
                button.innerHTML = "Unfollow";
            } 
        } 
    });                 
}

followButton = document.getElementById("followButton");
if(followButton) {
    document.getElementById("followButton").addEventListener("click",function() {
        follow();
    });
}

function follow() {
    let button = document.getElementById("followButton");
    let username = document.getElementById("username").textContent;
    let formData = new FormData();
    formData.append('following', username);
    if (button.classList.contains("Follow")) {
        button.classList.remove("Follow");
        formData.append('remove', 1);
    } else if (!button.classList.contains("Follow")) {
        button.classList.add("Follow");
        formData.append('remove', 0);
    }
    axios.post('../api/follow_handler.php',formData).then(response => {
    });  
    location.reload();
}


