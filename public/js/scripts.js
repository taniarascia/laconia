/** 
 * Laconia JavaScript
 */

// Promisified XHR
const makeRequest = (method, url, data) => {
    return new Promise((resolve, reject) => {
        var request = new XMLHttpRequest();

        request.open(method, url);
        request.onload = function () {
            if (this.status >= 200 && this.status < 300) {
                resolve(request.response);
            } else {
                reject({
                    status: this.status,
                    statusText: request.statusText
                });
            }
        };

        request.onerror = function () {
            reject({
                status: this.status,
                statusText: request.statusText
            });
        };
        
        request.send(data);
    });
}

const listItems = document.querySelector('#message');
const form = document.querySelector('form');
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

if (form) {
    form.addEventListener('submit', event => {
        event.preventDefault();

        const formData = new FormData(form);
        const url = window.location.href;
        const thisForm = event.target;
        const formId = event.target.id;

        const username = document.querySelector('#username');
        const password = document.querySelector('#password');
        const email = document.querySelector('#email');
        const inputs = document.querySelectorAll('input');

        const showMessage = (data => {
            const message = document.querySelector('.message');
            message.textContent = data;
            message.style.display = 'block';
        });

        inputs.forEach(input => {
            input.onfocus = function () {
                this.classList.remove('has-error')
            }
        });

        if (username && username.value === '') {
            username.classList.add('has-error');
        }
        if (password && password.value === '') {
            password.classList.add('has-error');
        }
        if (email && email.value === '') {
            email.classList.add('has-error');
        }
        if (username && username.value === '' || password && password.value === '' || email && email.value === '') {
            return;
        }

        makeRequest('POST', url, formData)
            .then(data => {
                switch (formId) {
                    case 'form-register':
                    case 'form-login':
                        if (data !== 'Proceed') {
                            showMessage(data);
                        } else {
                            window.location.href = '/home';
                        }
                        break;
                    case 'form-forgot-password':
                    case 'form-create-password':
                        showMessage(data);
                        if (data === 'Your password has been updated') {
                            thisForm.remove();
                        }
                        break;
                }
            })
            .catch(error => {
                console.error('There was an error!', error.statusText);
            });
    });
}