const wrapper = document.querySelector('.wrapper');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnRegister-popup');
const iconClose = document.querySelector('.icon-close');

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

btnPopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
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
        fetch('/rwdd_kaylynn_assignment/public_frontend/api/login.php', { // Adjust this path based on your setup
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