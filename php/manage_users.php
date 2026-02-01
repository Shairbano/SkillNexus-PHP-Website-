<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_email']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../login.php");
    exit();
}

// Handle add user
if(isset($_POST['add_user'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("INSERT INTO users (fname,lname,email,password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $password);
    $stmt->execute();
    $stmt->close();
}

// Handle delete user
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all users
$users = $connection->query("SELECT * FROM users ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Users</title>
<link rel="stylesheet" href="/NUST/Portal/css/admin.css">
<link rel="stylesheet" href="/NUST/Portal/css/style.css">
</head>
<body>

<?php include("../php/header.php"); ?>

<div class="admin-container">

<h2>Manage Users</h2>

<!-- Add User Form -->
<form method="post" class="add-user-form" action="/NUST/Portal/php/manage_users.php">
    <input type="text" name="fname" placeholder="First Name" required>
    <input type="text" name="lname" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="password" placeholder="Password" required>
    <button type="submit" name="add_user">Add User</button>
</form>

<!-- Users Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php while($user = $users->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['fname'] . ' ' . $user['lname']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><a href="manage_users.php?delete=<?php echo $user['id']; ?>" class="delete-btn">Delete</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>

<?php include("../php/footer.php"); ?>
</body>
</html>
