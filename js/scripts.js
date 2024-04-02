
document.querySelectorAll('.toggle-password').forEach(function(toggleButton) {
    toggleButton.addEventListener('click', function() {

        const passwordInput = toggleButton.previousElementSibling;
        
        // Check the current type of the input field to determine the action.
        if (passwordInput.type === 'password') {
            // If the password is hidden, show it and change the toggle button text to indicate the action.
            passwordInput.type = 'text';
            toggleButton.textContent = '🚫'; 
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = '👁'; // I didn't wanna use any external images or images provided by the prof. So I am using emojis and ascii symbols, pretty cool right \(￣︶￣*\))
        }
    });
});


function comparePasswords() {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm').value;
    const pwErr = document.getElementById('pwErr');
    
    // Compare the values of the two fields.
    if (password !== confirm) {
        // If the values do not match, display an error message.
        pwErr.innerText = 'Passwords do not match';
    } else {
        // If the values match, clear any previous error message.
        pwErr.innerText = '';
    }
}

// a simple color script
window.addEventListener('load', function() {
    var usernameBox = document.getElementById('username-box');
    if (usernameBox) {
        // Generate a random background color
        var backgroundColor = '#' + Math.floor(Math.random()*16777215).toString(16);
        usernameBox.style.backgroundColor = backgroundColor;

        // Optional: Change text color based on background brightness
        var color = (parseInt(backgroundColor.substring(1), 16) > 0xffffff/2) ? 'black' : 'white';
        usernameBox.style.color = color;
    }
});
