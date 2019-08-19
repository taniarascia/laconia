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
                    statusText: request.statusText,
                });
            }
        };

        request.onerror = function () {
            reject({
                status: this.status,
                statusText: request.statusText,
            });
        };

        request.send(data);
    });
}

// Create new list items with shift + tab
const listItems = document.querySelector('#list-items');
const forms = document.querySelectorAll('form');
const formCreate = document.querySelector('#form-create');
const deleteButtons = document.querySelectorAll('.delete-list-item');
let counter = 0;

if (listItems && formCreate) {
    listItems.addEventListener('keydown', event => {
            event.preventDefault();

            const input = document.querySelector('list_item_0');
            input.focus();
    });
}

// Process all forms
if (forms) {
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            event.preventDefault();

            const formData = new FormData(form);
            const url = window.location.href;
            const thisForm = event.target;
            const formId = event.target.id;

            const username = document.querySelector('#username');
            const password = document.querySelector('#password');
            const email = document.querySelector('#email');
            const title = document.querySelector('#title');
            const comment = document.querySelector('#comment');
            const comments = document.querySelector('#comments');
            const inputs = document.querySelectorAll('input');
            const inputGroups = document.querySelectorAll('.input-group');

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
            if (title && title.value === '') {
                title.classList.add('has-error');
            }
            if (username && username.value === '' ||
                password && password.value === '' ||
                email && email.value === '' ||
                title && title.value === '') {
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
                                window.location.href = '/dashboard';
                            }
                            break;
                        case 'form-forgot-password':
                        case 'form-create-password':
                        case 'form-settings':
                        case 'form-create-list':
                        case 'form-edit-list':
                        case 'form-delete-user':
                            showMessage(data);
                            // Remove password form on create-password
                            if (data === 'Your password has been updated') {
                                thisForm.remove();
                            }
                            // Clear inputs on create form
                            if (data === 'List successfully created') {
                                thisForm.reset();
                                title.focus();
                            }
                            // Clear inputs on create form
                            if (data === 'User deleted') {
                                window.location.href = '/';
                            }
                            break;
                        case 'form-comments':
                            if (data === 'Nice try' || data === 'This is a duplicate comment') {
                                showMessage(data);
                            } else {
                                while (thisForm.firstChild) thisForm.removeChild(thisForm.firstChild);
                                const message = document.createElement('div');
                                message.classList.add('message');
                                message.textContent = 'Your comment has been posted!';
                                message.style.display = 'block';
                                thisForm.appendChild(message);

                                // Display comment
                                const arr = JSON.parse(data);

                                const uname = document.createElement('a');
                                uname.href = `${window.location.href + arr[0]}`;
                                uname.textContent = arr[0];

                                const ucomment = document.createElement('p');
                                ucomment.textContent = arr[1];

                                const commentContainer = document.createElement('div');
                                commentContainer.classList.add('comments');
                                commentContainer.appendChild(uname);
                                commentContainer.appendChild(ucomment);

                                comments.appendChild(commentContainer);
                            }
                            break;
                        default:
                            showMessage(data);
                            // Remove list item on front end view for list item deletion
                            if (data === 'List deleted') {
                                const thisList = thisForm.closest('.items');
                                thisList.remove();
                            }
                    }
                })
                .catch(error => {
                    console.error('There was an error!', error.statusText);
                });
        });
    });
}