function validatePassword(password, confirm_password){
    if(password != confirm_password) {
        return 1;
    } else {
        return 0;
    }
}
document.getElementById("signup").addEventListener("click", function() {
    let username = document.getElementById("username").value;
    let first_name = document.getElementById("first_name").value;
    let surname = document.getElementById("surname").value;
    let email = document.getElementById("email").value;
    let birth_date = document.getElementById("birth_date").value;
    let password = document.getElementById("password").value;
    let confirm_password = document.getElementById("confirm_password").value;

    if ((validatePassword(password, confirm_password)) == 0) {
        let userData = new FormData();
        userData.append("user",username);
        userData.append("first_name", first_name);
        userData.append("surname",surname);
        userData.append("email", email);
        userData.append("birth_date", birth_date);
        userData.append("password", password);
        axios.post("../api/insert_user.php", userData).then(response => {
            if(response.data == "OK") {
                window.open('./login.php','_self');
            } else if(response.data == "USER") {
                alert("Username already used");
            } else if(response.data == "EMAIL") {
                alert("Mail already used");
            } else if(response.data == "FAIL") {
                alert("Something gone wrong");
            } 
        })
        .catch(error => {
            console.error(error);
        });
    } else {
        alert("Passwords doesn't match");
        window.open('./signup.php','_self')
    }
});

