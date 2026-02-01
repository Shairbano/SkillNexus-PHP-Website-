<?php
include("db.php");

$message = "";
$firstname = $lastname = $email = ""; // initialize to retain values

if(isset($_POST['firstname'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname  = htmlspecialchars($_POST['lastname']);
    $email     = htmlspecialchars($_POST['email']);
    $password  = $_POST['password'];
    $confirm   = $_POST['confirm'];

    // Check if passwords match
    if ($password !== $confirm) {
        $message = "Passwords do not match.";
    } else {
        // Check if email already exists
        $check = "SELECT * FROM users WHERE email='$email'";
        $result = $connection->query($check);

        if ($result && $result->num_rows > 0) {
            $message = "User already exists. Please login.";
        } else {
            $query = "INSERT INTO users (fname, lname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
            if ($connection->query($query)) {
                $message = "Signup successful! You can now login.";
                // Clear form fields after successful signup
                $firstname = $lastname = $email = "";
            } else {
                $message = "Error while saving data.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/NUST/Portal/css/style.css" type="text/css">
    <link rel="stylesheet" href="/NUST/Portal/css/signup.css" type="text/css">
    <script src="/NUST/Portal/js/signup.js"></script>
    
</head>
<body>
    <?php include_once 'header.php'; ?>

    <h2 style="margin-top: 20px; margin-bottom: 100px; text-align:center; font-weight:bold; font-size:40px; color:green;">Register Now!</h2>

    <!-- Display server-side message -->
    <?php 
    if (!empty($message)) { 
        $class = (strpos($message, 'successful') !== false) ? 'success-message' : 'error-message';
        echo '<p class="' . $class . '">' . $message . '</p>'; 
    } 
    ?>

    <form action="" method="post" class="styling" id="signupForm">
        <label for="signup" style="font-size:45px; margin-bottom:50px;">Sign Up</label>

        <div class="container">
            <div style="margin:50px; padding:10px; width:50%">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="firstname"style="width:110px" placeholder="Your first name.." value="<?php echo $firstname; ?>">
                <span class="error-msg" id="fname-error"></span>
            </div>
            <div style="margin:50px; padding:10px; width:50%">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lastname" style="width:110px"placeholder="Your last name.." value="<?php echo $lastname; ?>">
                <span class="error-msg" id="lname-error"></span>
            </div>
        </div>

        <div class="form-row">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email.." value="<?php echo $email; ?>" style="margin-right:40%; width:50%;">
            <span class="error-msg" id="email-error"></span>
        </div>

        <div class="form-row">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password.." style="margin-right:40%; width:50%;">
            <span class="error-msg" id="password-error"></span>
        </div>

        <div class="form-row">
            <label for="confirm">Confirm Password</label>
            <input type="password" id="confirm" name="confirm" placeholder="Confirm your password.." style="margin-right:40%; width:50%;">
            <span class="error-msg" id="confirm-error"></span>
        </div>

        <p style="color:black; font-size:25px;">Already have an account? 
            <a href="/NUST/Portal/php/login.php" style="color:blue;"><b>Login here</b></a>.
        </p>

        <button type="submit" style="margin-bottom:50px; margin-left:40%; width:20%;">Register</button>
    </form>

    <?php include_once 'footer.php'; ?>
</body>
</html>
