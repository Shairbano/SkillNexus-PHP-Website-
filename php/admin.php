<?php
session_start();
include("db.php");

// Admin check
if (!isset($_SESSION['user_email']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit();
}

$admin_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="/NUST/Portal/css/admin.css">
<link rel="stylesheet" href="/NUST/Portal/css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="admin-container">

    <!-- Hero Section -->
    <div class="admin-hero">
        <h1>Welcome, Admin!</h1>
        <p>Manage your users and affiliation requests efficiently from one place.</p>
    </div>

    <!-- Dashboard Buttons -->
    <div class="admin-buttons">
        <div class="button-card">
            <a href="manage_users.php">Manage Users</a>
            <p>Add new users, view all users, or remove users with ease.</p>
        </div>
        <div class="button-card">
            <a href="manage_requests.php">Manage Affiliation Requests</a>
            <p>Accept or reject partnership requests and keep the workflow smooth.</p>
        </div>
        <div class="button-card">
            <a href="expertise_fetch.php">Search Employees</a>
            <p>Search employees with their expertise.</p>
        </div>
    </div>

    <!-- Motivational Quote -->
    <div class="admin-quote">
        <p>"A good admin not only manages data, but empowers users and partners to grow."</p>
    </div>

</div>

<?php include("footer.php"); ?>
<script src="/NUST/Portal/js/admin.js"></script>
</body>
</html>
