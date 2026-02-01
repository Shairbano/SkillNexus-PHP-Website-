document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("signupForm");

    form.addEventListener("submit", function(e) {
        let hasError = false;

        // Clear previous error messages
        document.querySelectorAll(".error-msg").forEach(span => span.textContent = "");

        const fname = document.getElementById("fname").value.trim();
        const lname = document.getElementById("lname").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const confirm = document.getElementById("confirm").value;

        const nameRegex = /^[A-Za-z]+$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

        // First name
        if (!fname) {
            document.getElementById("fname-error").textContent = "First name is required.";
            hasError = true;
        } else if (!nameRegex.test(fname)) {
            document.getElementById("fname-error").textContent = "First name must contain only letters.";
            hasError = true;
        }

        // Last name
        if (!lname) {
            document.getElementById("lname-error").textContent = "Last name is required.";
            hasError = true;
        } else if (!nameRegex.test(lname)) {
            document.getElementById("lname-error").textContent = "Last name must contain only letters.";
            hasError = true;
        }

        // Email
        if (!email) {
            document.getElementById("email-error").textContent = "Email is required.";
            hasError = true;
        } else if (!emailRegex.test(email)) {
            document.getElementById("email-error").textContent = "Please enter a valid email.";
            hasError = true;
        }

        // Password
        if (!password) {
            document.getElementById("password-error").textContent = "Password is required.";
            hasError = true;
        } else if (!passwordRegex.test(password)) {
            document.getElementById("password-error").textContent = "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.";
            hasError = true;
        }

        // Confirm password
        if (!confirm) {
            document.getElementById("confirm-error").textContent = "Please confirm your password.";
            hasError = true;
        } else if (password !== confirm) {
            document.getElementById("confirm-error").textContent = "Passwords do not match.";
            hasError = true;
        }

        if (hasError) {
            e.preventDefault(); // Stop form submission if any error
        }
    });
});
