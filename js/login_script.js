const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');

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
        fetch('/rwdd_kaylynn_assignment/public_frontend/api/login.php', { // Adjust this path based on your setup
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
                window.location.href = '/dashboard'; // Adjust the URL as needed
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