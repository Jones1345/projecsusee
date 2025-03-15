// Function to validate user registration form
function validateRegistrationForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm_password").value;

    if (name === "" || email === "" || password === "" || confirmPassword === "") {
        alert("All fields are required!");
        return false;
    }

    // Email validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Enter a valid email address!");
        return false;
    }

    // Password validation
    if (password.length < 6) {
        alert("Password must be at least 6 characters long!");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return false;
    }

    return true;
}

// Function to confirm user deletion
function confirmDelete() {
    return confirm("Are you sure you want to delete this user?");
}

// Function to confirm package deletion
function confirmPackageDelete() {
    return confirm("Are you sure you want to delete this package?");
}

// Smooth Scroll for Navigation Links
document.addEventListener("DOMContentLoaded", function() {
    let links = document.querySelectorAll("a[href^='#']");
    links.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            let target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
});

// Function to toggle password visibility
function togglePasswordVisibility() {
    let passwordField = document.getElementById("password");
    let toggleIcon = document.getElementById("togglePassword");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.textContent = "🙈"; // Change to "hide" icon
    } else {
        passwordField.type = "password";
        toggleIcon.textContent = "👁️"; // Change to "show" icon
    }
}
