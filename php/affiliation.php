<?php
session_start();
include("db.php"); // Your DB connection

// Make sure user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['user_email']; // logged-in user email
$message = ""; // feedback message

if (isset($_POST['submit'])) {

    // Collect form data
    $category = htmlspecialchars($_POST['category']);
    $company_name = htmlspecialchars($_POST['name']);
    $contact = htmlspecialchars($_POST['contact']);
    $address = htmlspecialchars($_POST['address']);
    $company_email = htmlspecialchars($_POST['company_email']); // institute/company email

    // Handle file uploads
    $uploads_dir = "../uploads/";

    // Create uploads folder if it doesn't exist
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0755, true);
    }

    $business_license = $_FILES['business_license']['name'];
    $company_certification = $_FILES['company_certification']['name'];

    $business_tmp = $_FILES['business_license']['tmp_name'];
    $cert_tmp = $_FILES['company_certification']['tmp_name'];

    // Generate unique names to avoid overwriting
    $business_file = time() . "_bl_" . basename($business_license);
    $cert_file = time() . "_cert_" . basename($company_certification);

    $business_path = $uploads_dir . $business_file;
    $cert_path = $uploads_dir . $cert_file;

    if (move_uploaded_file($business_tmp, $business_path) && move_uploaded_file($cert_tmp, $cert_path)) {

        // Insert into database with both user_email and company_email
        $stmt = $connection->prepare(
            "INSERT INTO affiliation_requests 
            (category_type, company_name, contact_person, address, user_email, contact_email, business_license, company_certification, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')"
        );
        $stmt->bind_param("ssssssss", $category, $company_name, $contact, $address, $user_email, $company_email, $business_file, $cert_file);

        if ($stmt->execute()) {
            $message = "Application Submitted Successfully!";
        } else {
            $message = "Error in submission: " . $stmt->error;
        }

        $stmt->close();

    } else {
        $message = "Error uploading files. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Become a Partner</title>
<link rel="stylesheet" href="/NUST/Portal/css/style.css">
<link rel="stylesheet" href="/NUST/Portal/css/form.css">
</head>
<body>

<?php include 'header.php'; ?>

<h2 class="page-title">Become a Partner</h2>

<?php if (!empty($message)) {
    $class = (strpos($message, 'Successfully') !== false) ? 'success-message' : 'error-message';
    echo '<p class="' . $class . '">' . $message . '</p>';
} ?>

<form action="" method="post" class="styling" id="partnerForm" enctype="multipart/form-data">

    <fieldset>
        <legend>Partnership Details</legend>
        <label for="category">Select Category for Affiliation</label>
        <select name="category" id="category" required>
            <option value="" disabled selected>Select a category</option>
            <option value="Industry Partners">Industry Partners</option>
            <option value="Educational or Research Institutes">Educational or Research Institutes</option>
        </select>
    </fieldset>

    <fieldset>
        <legend>Company Information</legend>
        <label for="name">Company Name</label>
        <input type="text" name="name" id="name" placeholder="Enter Company Name" required>

        <label for="contact">Contact No</label>
        <input type="text" name="contact" id="contact" placeholder="Enter Contact No" required>

        <label for="address">Address</label>
        <input type="text" name="address" id="address" placeholder="Enter Address" required>

        <!-- User Email (readonly) -->
        <label for="user_email">Your Email (Logged-in)</label>
        <input type="email" name="user_email" id="user_email" 
               value="<?php echo htmlspecialchars($user_email); ?>" readonly required>

        <!-- Institute/Company Email (manual input) -->
        <label for="company_email">Institute/Company Email</label>
        <input type="email" name="company_email" id="company_email" 
               placeholder="Enter Institute/Company Email" required>
    </fieldset>

    <fieldset>
        <legend>Upload Documents</legend>
        <label for="business_license">Business License</label>
        <input type="file" name="business_license" id="business_license" accept=".pdf,.doc,.docx" required>

        <label for="company_certification">Company Certification</label>
        <input type="file" name="company_certification" id="company_certification" accept=".pdf,.doc,.docx" required>
    </fieldset>

    <button type="submit" name="submit">Submit Application</button>
</form>

<script src="/NUST/Portal/js/affiliation.js"></script>
<?php include "footer.php"; ?>
</body>
</html>
