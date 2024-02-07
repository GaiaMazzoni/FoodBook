//all the tags (categories)
var tags_buttons = document.querySelectorAll('[name="tags"]');

tags_buttons.forEach(function(button) {
    button.addEventListener('click', function() {
        select(button);
    });
});

//function to select a button when clicked.
function select(button) {
    button.classList.toggle('select');
}