let notificationsButton; 
let notificationicon;
let notificationPath;
let usernameTo;
document.addEventListener('DOMContentLoaded', function(){
    notificationsButton = document.getElementById('notification-button');
    notificationicon = document.getElementById('notificationIcon');
    notificationPath = document.getElementById('notificationPath');

    let checkNewNotifFormData = new FormData();
    checkNewNotifFormData.append("type", "check");
    axios.post("../api/notification_logics.php", checkNewNotifFormData).then(response => {
        if(response.data == "true"){
            if(!notificationsButton.classList.contains('newNotification')){
                notificationsButton.classList.add('newNotification');
                notificationicon.setAttribute('fill', 'red');
                notificationPath.setAttribute('d', "M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901");
            } 
        }
    });

    var logoutLink = document.getElementById('logout');
    logoutLink.addEventListener('click', function(event) {
        event.preventDefault();
        var confirmLogout = confirm("Are you sure you want to log out?");
        if (confirmLogout) {
            window.location.href = '../api/logout.php';
        }
    });

    //changes the notification icon based on whether there are any unread notifications
    notificationsButton.addEventListener('click', function() {
        if (notificationsButton.classList.contains('newNotification')) {
            notificationsButton.classList.remove('newNotification');
            notificationicon.setAttribute('fill', 'currentColor');
            notificationPath.setAttribute('d', "M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6");
        }
        let formData = new FormData();
        formData.append("type", "read");
        axios.post("../api/notification_logics.php", formData);
    });
});

