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

async function publish_post() {
    const fileInput = document.getElementById("imageSelection");
    
    let imageformData = new FormData();
    let postformData = new FormData();
    if (fileInput.files.length > 0) {

        let cat = document.getElementsByClassName("select");
        postformData.append("description", document.getElementById("description").value);
        postformData.append('num_cat', cat.length);
        for (let i = 0; i < cat.length; i++) {
            postformData.append((i+1), cat[i].id);
        }

        await axios.post('../api/upload_post.php', postformData);

        imageformData.append("length", fileInput.files.length);
        console.log(fileInput.files.length);
        for (let i = 0; i < fileInput.files.length; i++) {
            imageformData.append(i+1, fileInput.files[i].name);
        }

        await axios.post('../api/upload_image.php', imageformData);
 
    }
    window.open('../view/home.php','_self');
}


