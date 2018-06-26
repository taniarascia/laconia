const listItems = document.getElementById('list-items');
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

    // if (form) {
    //     form.addEventListener('submit', event => {
    //         event.preventDefault();

    //         var formData = new FormData(form);
    //         var request = new XMLHttpRequest();
    //         var url = window.location.href;

    //         request.open('POST', url);
    //         request.onreadystatechange = function () {
    //             if (request.readyState == 4 && request.status == 200) {
    //                 document.getElementById('message').textContent = request.responseText;
    //             } else {
    //                 document.getElementById('message').textContent = request.responseText;
    //             }
    //         }
    //         request.send(formData);
    //     });
    // }