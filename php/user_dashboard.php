<?php
session_start();
include("db.php");

// If user is not logged in OR logged in as admin → block
if (!isset($_SESSION['user_email']) || $_SESSION['is_admin'] === true) {
    header("Location: login.php");
    exit();
}

// Fetch user name
$user_email = $_SESSION['user_email'];
$user_query = "SELECT fname FROM users WHERE email='$user_email' LIMIT 1";
$user_result = $connection->query($user_query);
$user = $user_result->fetch_assoc();
$user_name = $user['fname'];

// Fetch approved partners (FULLY FIXED QUERY)
$partners_query = "SELECT company_name, category_type 
                   FROM affiliation_requests 
                   WHERE status='accepted'";

$partners_result = $connection->query($partners_query);

// Debug if query fails
if (!$partners_result) {
    die("QUERY FAILED: " . $connection->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Dashboard</title>
<link rel="stylesheet" href="/NUST/Portal/css/user_dashboard.css">
<link rel="stylesheet" href="/NUST/Portal/css/style.css">
</head>
<body>

<?php include("../php/header.php"); ?>

<div class="dashboard-container">

    <!-- Welcome User -->
    <h2 class="welcome-text">Welcome, <?php echo $user_name; ?></h2>

    <!-- Hero Section -->
    <div class="hero-box">
        <h1>Become a Partner with Us</h1>
        <p>
            Join our partnership program and collaborate with us professionally.  
            You may apply as an Industry Partner or an Educational/Research Institution.
        </p>
    </div>

    <!-- Partner Type Boxes -->
    <div class="partner-options">

        <div class="option-card">
            <h3>Industry Partner</h3>
            <p>Collaborate in business, internships, workshops, and technology solutions.</p>
            <ul>
                <li>Business collaborations</li>
                <li>Internship & training</li>
                <li>Skill development programs</li>
            </ul>
        </div>

        <div class="option-card">
            <h3>Educational / Research Institution</h3>
            <p>Partner for academic collaboration, research, and student development.</p>
            <ul>
                <li>Academic collaboration</li>
                <li>Joint research</li>
                <li>Student development programs</li>
            </ul>
        </div>

    </div>

    <!-- Apply button -->
    <div class="apply-section">
        <a href="/NUST/Portal/php/affiliation.php" class="apply-btn">Apply for Affiliation</a>
    </div>

    <!-- Approved Partners List -->
    <h2 class="partners-heading">Our Successful Partners</h2>

    <div class="partners-list" style="align-items:center">

        <?php if ($partners_result->num_rows > 0) { ?>

            <?php while ($p = $partners_result->fetch_assoc()) { ?>
                <div class="partner-card">
                    <span class="type-tag"><?php echo $p['category_type']; ?></span>
                    <br>
                    <br>

                    <h4><?php echo $p['company_name']; ?></h4>
                    <span class="approved-badge">Approved</span>
                </div>
            <?php } ?>

        <?php } else { ?>
            <p class="no-partners">No partners approved yet.</p>
        <?php } ?>

    </div>

</div>
<h2 style="text-align:center; font-weight:bold; font-size:40px; color:green; margin-top:50px;">
        Register as an Employee
    </h2>
    <p style="text-align:center; color:black; font-size:18px; width:70%; margin:auto; margin-top:20px;border-style: solid; border-width: 20px; border-color: green; padding:15px; border-radius:10px;">
        Join the NSTP workforce and become part of a dynamic, innovative, and growth-oriented environment.
        As an employee, you will contribute to cutting-edge projects, work alongside industry and academic experts,
        and develop your professional skills through real-world opportunities. Whether you specialize in
        technology, research, design, engineering, or management — NSTP provides a platform where talent and vision meet.
    </p>

    <div class="hero-buttons" style="margin-top:30px; margin-bottom:50px;margin-left:5%;">
        <a href="/NUST/Portal/php/expertise.php" class="hero-btn"style="background-color:darkgreen; color:white; padding:10px 20px; border-radius:5px; text-decoration:none;">Register as Employee</a>
    </div>

<?php include("../php/footer.php"); ?>

</body>
</html>
