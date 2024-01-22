function popUpFunction(btn_id, menu_id) {
    var btn = document.getElementById(btn_id);
    var menu = document.getElementById(menu_id);

    if (btn && menu) {
        btn.addEventListener('click', function(event) {
            event.preventDefault(); 
            menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
        });
    }
}