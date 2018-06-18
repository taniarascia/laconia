var listItems = document.getElementById('list-items');
var form = document.querySelector('form');
var url = window.location.href;

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
        var input = document.createElement('input');
        input.type = 'text';
        input.name = event.target.name++;

        event.target.parentNode.appendChild(input);
        input.focus();
    }
});


form.addEventListener('submit', event => {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
});

    // const formData = new FormData(form);

    // fetch(url, {
    //     method: 'POST',
    //     body: formData
    // }).then(response => {
    //     console.log(response);
    // });