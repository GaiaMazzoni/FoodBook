document.addEventListener('DOMContentLoaded', function(){
    
});

window.addEventListener('load', check_follow);
function check_follow() {
    var button = document.getElementById("followButton");
    var username = document.getElementById("username").textContent;
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
    var button = document.getElementById("followButton");
    var username = document.getElementById("username").textContent;
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
        console.log(response.data);
    });  
    location.reload();
}

function select(button){
    let user = document.getElementById("username").textContent;
    console.log(user);
    if(!button.classList.contains('select')){
        Array.from(document.getElementsByClassName('select')).forEach(element => {
            element.classList.remove('select');
        });
        button.classList.add('select');
    }
    let hor = document.getElementsByClassName('hor')[0];
    if(!hor.classList.contains('select')){
        let imageContainer = document.querySelector('.image-container');
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            console.log(xhr.responseText);
            if (xhr.readyState == 4 && xhr.status == 200) {
                imageContainer.innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", `../api/load_posts_ver.php?user=${user}`, true);
        xhr.send();
    }else{
        let imageContainer = document.querySelector('.image-container');
        while (imageContainer.firstChild) {
            imageContainer.removeChild(imageContainer.firstChild);
        }

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                imageContainer.innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", `../api/load_posts_hor.php?user=${user}`, true);
        xhr.send();
    }
}

function uploadImage() {
    const formDataImage = new FormData();
    console.log("ciao");
    formDataImage.append("image", document.querySelector("image").files[0]);
    console.log(document.querySelector("#image").files[0]);
    axios.post('../api/edit_image.php', formDataImage).then(response => {
        console.log(response.data);
    });

};

document.getElementById("horizontal_post_button").addEventListener("click", function() {
    document.getElementById("horizontal").style.display = "block";
    document.getElementById("vertical").style.display = "none";
});

document.getElementById("vertical_post_button").addEventListener("click", function() {
    document.getElementById("horizontal").style.display = "none";
    document.getElementById("vertical").style.display = "block";
});