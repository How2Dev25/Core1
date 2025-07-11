
// Generic password toggle (no need to pass inputId)
function togglePassword(toggleElement) {
    const input = toggleElement.closest('.relative').querySelector('input');
    const icon = toggleElement.querySelector('i');

    if (!input) return;

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bx-hide');
        icon.classList.add('bx-show');
    } else {
        input.type = 'password';
        icon.classList.remove('bx-show');
        icon.classList.add('bx-hide');
    }
}

// Optional: validate if password and confirm password match (for register only)
function validatePasswords() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirmPassword');
    const message = document.getElementById('passwordMatchMessage');

    if (!passwordInput || !confirmInput || !message) return;

    const password = passwordInput.value;
    const confirm = confirmInput.value;

    if (password && confirm && password !== confirm) {
        message.classList.remove('hidden');
    } else {
        message.classList.add('hidden');
    }
}