$(document).ready(function(){
    $('#tag_form').load('./tags.php');
});

function search_category(event) {
    event.preventDefault(); 
    let cat = document.getElementsByClassName("select");
    let formData = new FormData();
    formData.append('num_cat', cat.length);
    for (let i = 0; i < cat.length; i++) {
        formData.append(i+1, cat[i].id);
    }
    axios.post('search_by_category.php', formData).then(response => {
        const postContainer = document.getElementById("print_result");
        postContainer.innerHTML = response.data;
    });
}

document.getElementById("show_friends_form").addEventListener("click", function() {
    document.getElementById("friends_form").style.display = "block";
    document.getElementById("post_form").style.display = "none";
});

document.getElementById("show_post_form").addEventListener("click", function() {
    document.getElementById("friends_form").style.display = "none";
    document.getElementById("post_form").style.display = "block";
});
