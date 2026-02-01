<?php
session_start();
include("db.php");

// Check login
if (!isset($_SESSION['user_email'])) {
    header("Location:login.php");
    exit();
}

$user_email = $_SESSION['user_email'];

//---------------------------------------------
// FETCH FIRST NAME & LAST NAME FROM DATABASE
//---------------------------------------------
$fname = "";
$lname = "";

$get_user = $connection->prepare("SELECT fname, lname FROM users WHERE email = ?");
$get_user->bind_param("s", $user_email);
$get_user->execute();
$get_user->bind_result($fname, $lname);
$get_user->fetch();
$get_user->close();
//---------------------------------------------


$message = "";
if (isset($_POST['submit'])) {

    $expertise_json = $_POST['hiddenExpertise'];  // frontend se JSON aa raha

    if (!empty($expertise_json)) {

        // NOTE: user_id must be inserted if employees table requires it
        $stmt = $connection->prepare("INSERT INTO employees (user_id, expertise) VALUES (?, ?)");

        // Fetch user_id from users table
        $get_id = $connection->prepare("SELECT id FROM users WHERE email = ?");
        $get_id->bind_param("s", $user_email);
        $get_id->execute();
        $get_id->bind_result($user_id);
        $get_id->fetch();
        $get_id->close();

        $stmt->bind_param("is", $user_id, $expertise_json);

        if ($stmt->execute()) {
            $message = "Expertise Added Successfully!";
        } else {
            $message = "Database Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Please select at least one expertise!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as an Employee</title>

    <link rel="stylesheet" href="/NUST/Portal/css/expertise.css">
    <script src="/NUST/Portal/js/expertise.js" defer></script>
</head>

<body>

<h2>Register as an Employee</h2>

<?php if (!empty($message)) { echo "<p>$message</p>"; } ?>

<form action="" method="post" class="styling">

    <fieldset>
        <h2 style="text-align:center; margin:20px;">Employee Expertise Registration</h2>

        <div class="container">
            <div style="margin:30px; width:50%">
                <label>First Name</label>
                <input type="text" name="firstname" value="<?php echo $fname; ?>" readonly>
            </div>

            <div style="margin:30px; width:50%">
                <label>Last Name</label>
                <input type="text" name="lastname" value="<?php echo $lname; ?>" readonly>
            </div>
        </div>

        <label>Your Email</label>
        <input type="email" name="user_email" value="<?php echo $user_email; ?>" readonly>

        <!-- SELECTED EXPERTISE LIST DISPLAY -->
        <div id="selected-list"></div>

        <!-- MULTIPLE SELECT EXPERTISE -->
        <label><b>Select Expertise:</b></label>
        <select id="expertise">
            <option value="" disabled selected>Select an expertise</option>
            <option value="Web Development">Web Development</option>
            <option value="Graphic Designer">Graphic Designer</option>
            <option value="Penetration Testing">Penetration Testing</option>
            <option value="Flask Developer">Flask Developer</option>
            <option value="Others">Others</option>
        </select>

        <div id="other-fields"></div>

        <!-- STORE JSON LIST -->
        <input type="hidden" name="hiddenExpertise" id="hiddenExpertise">

    </fieldset>

    <button type="submit" name="submit">Register</button>
</form>

</body>
</html>
