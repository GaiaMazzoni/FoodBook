document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('next').addEventListener('click', function() {
        handleImageUpload();
    });
    document.getElementById('close').addEventListener('click', function() {
        window.open('./home.php','_self');
    });
});

function handleImageUpload() {
    const fileInput = document.getElementById("imageSelection");

    if (fileInput.files.length > 0) {
        const formDataImage = new FormData();
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


