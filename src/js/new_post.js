$(document).ready(function(){
    $('#tag_form').load('../view/tags.php');
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("publish").addEventListener('click', function(){
        publish_post();
    });
    document.getElementById('close').addEventListener('click', function() {
        window.open('./home.php','_self');
    });
});

function publish_post() {
    const fileInput = document.getElementById("imageSelection");
    let cat = document.getElementsByClassName("select");
    let formData = new FormData();
    if (fileInput.files.length > 0) {
        formData.append("length", fileInput.files.length);
        formData.append("description", document.getElementById("description").value);
        for (let i = 0; i < fileInput.files.length; i++) {
            formData.append(i, fileInput.files[i].name);
        }
        formData.append('num_cat', cat.length);
        for (let i = 0; i < cat.length; i++) {
            formData.append(i+1, cat[i].id);
        }
        axios.post('../api/upload_post.php', formData);
    }
    window.open('../view/home.php','_self');
}


