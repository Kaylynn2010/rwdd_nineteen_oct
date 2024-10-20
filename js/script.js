const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
});

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Collect form data
        const formData = new FormData(loginForm);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        // GET is for getting data
        // POST is for sending
        // PUT is for updating
        // DELETE is for deleting
        // Send login request to the server
        fetch('/rwdd_nineteen_oct/api/apiLogin.php', { // Adjust this path based on your setup
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => {
            console.log(response); // Log the response object
            return response.json(); // Try to parse JSON
        })
        .then(data => {
            if (data.success) {
                // Handle successful login
                alert("login successful")
                window.location.href = '/dashboard'; // Adjust the URL as needed,rmb, mainpage.php
            } else {
                // Handle login error
                alert(data.message || 'Login failed. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', function (event) {
        event.preventDefault(); //Prevent the default form submission!

        // Collect form data
        const formData2 = new FormData(registerForm);
        const data2 = {};
        formData2.forEach((value2, key2) => {
            data2[key2] = value2;
        });
        // GET is for getting data
        // POST is for sending
        // PUT is for updating
        // DELETE is for deleting
        // Send login request to the server
        fetch('/rwdd_nineteen_oct/api/apiRegister.php', { // Adjust this path based on your setup
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data2),
        })
        .then(response2 => {
            console.log(response2); // Log the response object
            return response2.json(); // Try to parse JSON
        })
        .then(data2 => {
            if (data2.success) {
                // Handle successful registration
                alert('registration successful')
                window.location.href = '/dashboard' // Adjust the URL as needed, this goes to XAMPP browser
            } else {
                // Handle regis error
                alert(data2.message || 'Registration failed. Please try again.');
            }
        })
        .catch (error2 => {
            console.error('Error: ', error2);
            alert('An error occured. Please try again later.')
        });
    });
});
