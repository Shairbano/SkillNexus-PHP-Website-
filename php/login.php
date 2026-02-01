<?php
include("db.php");
session_start();

// Admin credentials
$admin_email = "admin.partner@gmail.com";
$admin_password = "admin123";

$email_error = $password_error = "";
$email_value = "";

if(isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $email_value = $email;

    // Validate inputs
    if(empty($email)) {
        $email_error = "Email is required.";
    }

    if(empty($password)) {
        $password_error = "Password is required.";
    }

    if(!$email_error && !$password_error) {
        // Check database for user
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $connection->query($query);

        if ($result && $result->num_rows > 0) {
            $_SESSION['user_email'] = $email;

            if ($email === $admin_email && $password === $admin_password) {
                $_SESSION['is_admin'] = true;
                header("Location: admin.php");
                exit();
            } else {
                $_SESSION['is_admin'] = false;
                header("Location:user_dashboard.php");
                exit();
            }
        } else {
            $password_error = "Invalid email or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="/NUST/Portal/css/style.css" type="text/css">
<link rel="stylesheet" href="/NUST/Portal/css/login.css" type="text/css">
<script src="/NUST/Portal/js/login.js"></script>
</head>
<body>
<?php include_once 'header.php'; ?>

<h2 style="margin-top: 20px; margin-bottom: 100px; text-align:center; font-weight:bold; font-size:40px; color:green;">Login Now!</h2>

<form action="" method="post" class="styling" id="loginForm">
    <label for="login" style="font-size:45px; margin-bottom:50px;">Login</label>

    <div class="form-row">
        <label for="email"style="margin-right:80%;">Email</label><br>
        <input type="email" id="email" name="email" placeholder="Your email.." style="margin-right:40%; width:50%;" value="<?php echo $email_value; ?>">
        <span class="error-msg" id="email-error"><?php echo $email_error; ?></span>
    </div>

    <div class="form-row">
        <label for="password" style="margin-right:80%;">Password</label><br>
        <input type="password" id="password" name="password" placeholder="Your password.." style="margin-right:40%; width:50%;">
        <span class="error-msg" id="password-error"><?php echo $password_error; ?></span>
    </div>

    <p style="color:black; font-size:25px;">Don't have an account? 
        <a href="signup.php" style="color:blue;"><b>Register here</b></a>.
    </p>

    <button type="submit" style="margin-bottom:50px; margin-left:40%; width:20%;">Login</button>
</form>

<?php include_once 'footer.php'; ?>
</body>
</html>
