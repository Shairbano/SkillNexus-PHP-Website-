<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_email']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../login.php");
    exit();
}

// Handle accept/reject
if(isset($_GET['action']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $action = $_GET['action'];

    if($action === 'accept'){
        $stmt = $connection->prepare("UPDATE affiliation_requests SET status='accepted' WHERE id=?");
    } elseif($action === 'reject'){
        $stmt = $connection->prepare("UPDATE affiliation_requests SET status='rejected' WHERE id=?");
    }
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all pending requests
$requests = $connection->query("SELECT * FROM affiliation_requests ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title style="margin-bottom: 20px;">Manage Requests</title>
<link rel="stylesheet" href="/NUST/Portal/css/admin.css">
<link rel="stylesheet" href="/NUST/Portal/css/style.css">
</head>
<body>

<?php include("../php/header.php"); ?>

<div class="admin-container">

<h2>Manage Affiliation Requests</h2>

<table border="1" style="border:solid;color:green">
    <thead>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Category</th>
            <th>User Email</th>
            <th>Company Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($req = $requests->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $req['id']; ?></td>
            <td><?php echo $req['company_name']; ?></td>
            <td><?php echo $req['category_type']; ?></td>
            <td><?php echo $req['user_email']; ?></td>
            <td><?php echo $req['contact_email']; ?></td>
            <td><?php echo ucfirst($req['status']); ?></td>
            <td>
                <?php if($req['status']=='pending'){ ?>
                <a href="manage_requests.php?action=accept&id=<?php echo $req['id']; ?>" class="accept-btn">Accept</a>
                <a href="manage_requests.php?action=reject&id=<?php echo $req['id']; ?>" class="reject-btn">Reject</a>
                <?php } else { echo '-'; } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>

<?php include("../php/footer.php"); ?>
</body>
</html>
