function validatePassword(password, confirm_password){
    if(password.value != confirm_password.value) {
        return 1;
    } else {
        return 0;
    }
}
