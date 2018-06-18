var listItems = document.getElementById('list-items');
var form = document.querySelector('form');

listItems.addEventListener('keydown', event => {
    if (event.keyCode == 13 && event.shiftKey) {
        var input = document.createElement('input');
        input.type = 'text';
        input.value = 'Keep going!';
        input.name = event.target.name++;

        event.target.parentNode.appendChild(input);
    }
});

form.addEventListener('submit', event => {
    event.preventDefault();
    
    submitForm();
}); 
