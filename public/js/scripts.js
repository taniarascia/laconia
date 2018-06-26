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
const formRegister = document.querySelector('#form-register');

if (formSubmit || formRegister) {
    const form = document.querySelector('form');
    form.addEventListener('submit', event => {
        event.preventDefault();

        const formData = new FormData(form);
        const request = new XMLHttpRequest();
        const url = window.location.href;
        const messageContainer = document.querySelector('#message');
        const messageExists = document.querySelector('p.message');
        const message = document.createElement('p');
        message.classList.add('message');

        request.open('POST', url);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                console.log(request);
                if (request.responseText !== '"Proceed"') {
                    if (!messageExists) {
                        messageContainer.appendChild(message)
                        message.textContent = JSON.parse(request.responseText);
                    } else {
                        messageExists.textContent = JSON.parse(request.responseText);
                    }
                } else {
                    window.location.href = '/home';
                }
            } else {
                message.textContent = 'Something went wrong';
                return;
            }
        }
        request.send(formData);
    });
}

// Doesn't work
//fetch(url, 
//     { 
//         method: 'POST',
//         body: formData
//     } 
// )
// .then(response => {
//     return response.json();
// })
// .then(data => { 
//     if (data !== 'Proceed') {
//         if (!messageExists) {
//             messageContainer.appendChild(message);
//             message.textContent = data;
//         } else {
//             messageExists.textContent = data;
//         }
//     } else {
//         window.location.href = '/home';
//     }
// })
// .catch(error => {
//     console.log(error);
//     message.textContent = error;
// });