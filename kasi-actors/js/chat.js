const openChatBtn = document.querySelector('.chat-btn');
const chat = document.querySelector('.chat-box');
const chatForm = document.querySelector('.chat-form');
const msgInput = document.querySelector('#message');
const messageBody = document.querySelector('.chat-body');


// open chat
openChatBtn.addEventListener('click', function(e) {
    chat.classList.add('open-chat');
    const registerForm = document.querySelector('.register-form');
    const nameInput = registerForm.querySelector('input');

    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        document.querySelector('.chat-header .name').innerHTML =  `<i class="fas fa-user-check"></i> ${nameInput.value}`;
        document.querySelector('.chat-header .name').classList.add('show');
        this.classList.add('hide');
        setTimeout(() => {
            registerForm.style.display = 'none';
            chatForm.classList.add('show');
        }, 500);
    });
});




chatForm.addEventListener('submit', sendMessage);

function sendMessage(e) {
    e.preventDefault();

    let message = createMessage(msgInput.value);
    updateUI(message);
    msgInput.value = '';
}


function updateUI(newMessage) {
    messageBody.innerHTML += newMessage;
}


function createMessage(text) {
    let currentHour = new Date().getHours();
    let currentMin = new Date().getMinutes();
    let currentTime = `${currentHour}:${currentMin}`;
    
    let message = `
    <div class="message left">
        <span class="time">${currentTime}</span>
        <span class="text">${text}</span>
    </div>
    `;

    return message;
}