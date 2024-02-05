document.addEventListener('onload', function(){
    let nextButton = document.getElementById('next').addEventListener('click', handleImageUpload);
});

function handleImageUpload(postId) {
    const fileInput = document.getElementById("imageSelection");

    if (fileInput.files.length > 0) {
        const uploadPromises = [];
        const formDataImage = new FormData();
        let postId = fileInput.getAttribute('data-post');
        formDataImage.append("length", fileInput.files.length);
        formDataImage.append("description", document.getElementById("description").value);
        for (let i = 0; i < fileInput.files.length; i++) {
            formDataImage.append(i, fileInput.files[i].name);
            console.log(fileInput.files[i].name);
        }
        axios.post('../api/upload_image.php', formDataImage).then(response => {
            window.open('./tag_selection.php','_self');
        });
    }
}


