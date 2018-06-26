const listItems = document.querySelector('#message');
let counter = 0;

if (listItems) {
    listItems.addEventListener('keydown', event => {
        if (event.keyCode == 13 && event.shiftKey) {
            event.preventDefault();
            
            const lastTextInput = document.getElementById(counter);
            if (lastTextInput && lastTextInput.value !== '') {
                counter++;

                const input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('id', counter);
                input.setAttribute('name', `list_item_${counter}`);
            
                event.target.parentNode.appendChild(input);

                input.focus();
            }
        }
    });
}

const formSubmit = document.querySelector('#form-login');

if (formSubmit) {
    formSubmit.addEventListener('submit', event => {
        event.preventDefault();

        const formData = new FormData(formSubmit);
        const request = new XMLHttpRequest();
        const url = window.location.href;
        const messageContainer = document.querySelector('#message');
        const messageExists = document.querySelector('p.message');
        const message = document.createElement('p');
            message.classList.add('message'); 

        request.open('POST', url);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                if (request.responseText) {
                    if (!messageExists) {
                        messageContainer.appendChild(message);
                        message.textContent = request.responseText
                    } else {
                        messageExists.textContent = request.responseText;
                    }
                } else {
                    window.location.href = '/home';
                }
            } else {
                message.textContent = 'Something went wrong...';
                return;
            }
        }
        request.send(formData);
    });
}