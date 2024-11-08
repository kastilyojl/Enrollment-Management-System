<?php

// require("/xampp/htdocs/Enrollment_v3/algorithm/dsv2/index.php");
session_start();
require('../Database/db.php');

// Ensure $id is set and sanitized to prevent SQL injection

    $sqlclearance = mysqli_query($connection, "SELECT * FROM d_studinfo");
    $clearance = mysqli_fetch_array($sqlclearance);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Student</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">
</head>
<body>

    <div class="container">
        <div class="header">
            <form action="../Database/arCB_Registration.php" method="post">
                <input type="text" placeholder="Search" name="searchID">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <table>
            <tr class="thead">
                <th>Documents</th>
                <th>Tuition</th>
                <th>Grades</th>
                <th>Clearance</th>
                <th>Course Selection</th>
                <th>Eligible To Enroll</th>
            </tr>
            <tr>
                <td><?php echo $clearance['lname']; ?></td>
            </tr>
        </table>
    </div>

</body>
</html>
