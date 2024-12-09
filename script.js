// Smooth Scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Form Validation
document.querySelector('form').addEventListener('submit', function (e) {
    let isValid = true;
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();

    // Clear previous error messages
    document.querySelectorAll('.error').forEach(error => error.remove());

    // Name validation
    if (name === "") {
        showError('name', 'Name is required.');
        isValid = false;
    }

    // Email validation
    if (email === "") {
        showError('email', 'Email is required.');
        isValid = false;
    } else if (!validateEmail(email)) {
        showError('email', 'Please enter a valid email address.');
        isValid = false;
    }

    // Subject validation
    if (subject === "") {
        showError('subject', 'Subject is required.');
        isValid = false;
    }

    // Message validation
    if (message === "") {
        showError('message', 'Message is required.');
        isValid = false;
    }

    // Stop form submission if validation fails
    if (!isValid) {
        e.preventDefault();
    }
});

// Show error message function
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const error = document.createElement('div');
    error.className = 'error';
    error.style.color = 'red';
    error.style.fontSize = '0.9em';
    error.textContent = message;
    field.insertAdjacentElement('afterend', error);
}

// Email validation function
function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(email);
}
document.addEventListener("DOMContentLoaded", () => {
    const image = document.querySelector('.scroll-image');
    const revealImage = () => {
        const rect = image.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            image.classList.add('visible');
        }
    };

    window.addEventListener("scroll", revealImage);
});
