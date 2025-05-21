// ----------------------------------------------------------
// Hidding message with this code

function hidding_message() {
    const message = document.getElementById('message');
    message.style.display = 'none';
}

const interval = setInterval(hidding_message, 5000);

// ----------------------------------------------------------