document.getElementById("partnerForm").addEventListener("submit", function(e) {
    let contact = document.getElementById("contact").value.trim();
    if (isNaN(contact) || contact.length < 10) {
        alert("Contact number must be numeric and at least 10 digits.");
        e.preventDefault();
    }
});
