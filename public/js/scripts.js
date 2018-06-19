var listItems = document.getElementById('list-items');
var form = document.querySelector('form');
var counter = 0;

function supressShiftEnter(event) {
    //shift enter is pressed
    if (event.keyCode == 13 && event.shiftKey) {
        var form = event.srcElement.form;
        form.submit();
    } else {
        event.preventDefault();
        return false;
    }
}

listItems.addEventListener('keydown', event => {
    if (event.keyCode == 13 && !event.shiftKey) {
        event.preventDefault();

        counter++;

        var input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('name', `list_item_${counter}`);

        event.target.parentNode.appendChild(input);
        
        input.focus();
    }
});


form.addEventListener('submit', event => {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
});