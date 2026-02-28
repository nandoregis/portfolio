const message = document.getElementById('message');
const btnClose = document.getElementById('message-close');

btnClose.addEventListener('click', () => {
    message.remove();
} );



