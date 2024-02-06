
$(document).ready(function(){
    $('#tag_form').load('../view/tags.php');
});

document.getElementById("publish").addEventListener('click', function(){
    publish_post();
});

document.getElementById("back").addEventListener('click', function() {
    window.open('../view/new_post.php','_self');
});

function publish_post() {
    let cat = document.getElementsByClassName("select");
    let formData = new FormData();
    formData.append('num_cat', cat.length);
    for (let i = 0; i < cat.length; i++) {
        formData.append(i+1, cat[i].id);
    }
    formData.forEach((value, key) => { console.log(key, value); });
    axios.post('../api/category.php', formData).then(response => {
    })
    .catch(error => {
        console.error(error);
    });
    window.open('../view/home.php','_self');
}