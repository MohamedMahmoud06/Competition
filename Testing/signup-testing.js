function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function validatePassword(password) {
    return password.length >= 8;
}


function signUp() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('pass').value;
    const kind = document.querySelector('input[name="flexRadioDefault"]:checked').value;

    // Validate input data
    if (!name || !email || !password) {
        alert('Please fill in all fields.');
        return;
    }

    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    if (!validatePassword(password)) {
        alert('Password must be at least 8 characters long.');
        return;
    }

   
    console.log('Name:', name);
    console.log('Email:', email);
    console.log('Password:', password);
    console.log('Account Type:', kind);

    
    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('pass').value = '';
    document.querySelector('input[name="flexRadioDefault"]:checked').checked = false;

    alert('Sign-up successful! Please log in.');
}
