<?php
session_start();
include("db.php");
include("header.php");

/* =========================
   LOGIN CHECK
   ========================= */
if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}

$admin_email = $_SESSION['user_email'];

/* =========================
   SEARCH LOGIC
   ========================= */
if (isset($_POST['search'])) {

    $expertise = trim($_POST['expertise']);

    // Employee IDs store karne ke liye array
    $empIds = [];

    // JOIN QUERY
    $sql = "
        SELECT 
            employees.id AS emp_id,
            employees.expertise,
            users.fname,
            users.lname,
            users.email
        FROM employees
        INNER JOIN users ON employees.user_id = users.id
        WHERE employees.expertise LIKE '%$expertise%'
    ";

    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        echo "<h2 style='text-align:center;color:brown;'>
                Employees with expertise in " . htmlspecialchars($expertise) . "
              </h2>";

        echo "<table border='2' style='margin-left:auto;margin-right:auto;border-collapse:collapse;'>
                <tr>
                    <th>Employee ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Expertise</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {

            // 🔹 Employee ID session ke liye collect
            $empIds[] = $row['emp_id'];

            $fullName = $row['fname'] . " " . $row['lname'];

            echo "<tr>
                    <td>{$row['emp_id']}</td>
                    <td>{$fullName}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['expertise']}</td>
                  </tr>";
        }

        echo "</table>";

        // 🔹 IDs session mein store
        $_SESSION['expertise_emp_ids'] = $empIds;

    } else {
        echo "<div class='no-records' style='text-align:center;color:red;'>
                No records found relevant to this category.
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Employee Expertise Check</title>

    <link rel="stylesheet" href="/NUST/Portal/css/admin.css">
    <link rel="stylesheet" href="/NUST/Portal/css/style.css">
</head>

<body>

<!-- =========================
     SEARCH FORM
     ========================= -->
<form method="POST" action="" class="styling" style="margin-top:10%;margin-left:30%">

    <label for="expertise"><b>Enter Expertise Category:</b></label><br><br>

    <input 
        type="text" 
        id="expertise" 
        name="expertise" 
        list="expertiseList" 
        required 
        placeholder="Type or choose expertise"
    >

    <!-- =========================
         DATALIST
         ========================= -->
    <datalist id="expertiseList">
        <?php
        $sql = "SELECT DISTINCT expertise FROM employees";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . htmlspecialchars($row['expertise']) . "'>";
            }
        }
        ?>
    </datalist>

    <br><br>
    <button type="submit" name="search" style="background-color:green;color:white;border:solid;">Search</button>

</form>

</body>

<?php include("footer.php"); ?>
</html>
