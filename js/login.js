document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("loginForm");

    form.addEventListener("submit", function(e) {
        let hasError = false;

        document.querySelectorAll(".error-msg").forEach(span => span.textContent = "");

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(!email) {
            document.getElementById("email-error").textContent = "Email is required.";
            hasError = true;
        } else if(!emailRegex.test(email)) {
            document.getElementById("email-error").textContent = "Please enter a valid email.";
            hasError = true;
        }

        if(!password) {
            document.getElementById("password-error").textContent = "Password is required.";
            hasError = true;
        }

        if(hasError) {
            e.preventDefault();
        }
    });
});
