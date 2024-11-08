<?php require('../Database/epCB_Report.php');
$id = $_SESSION['id_stuInfo'];
$retrieveReport = mysqli_query($connection,  "SELECT * FROM d_report WHERE id_report = '$id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Student</title>
    <link rel="stylesheet" href="../Style/Student_Report.css">

</head>
<body>

    <div class="container">
        <table>
            <tr class="thead">
                <th>Id no.</th>
                <th>Name</th>
                <th>Details</th>
                <th>Disciplinary Action</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            <?php
                while($result = mysqli_fetch_array($retrieveReport)) {
                ?>
                <tr>
                    <td><?php echo $result['id_report']?></td>
                    <td><?php echo $result['stud_name'] ?></td>
                    <td><?php echo $result['report']?></td>
                    <td><?php echo $result['disciplinary_action'] ?></td>
                    <td><?php echo $result['start_date']?></td>
                    <td><?php echo $result['end_date']?></td>
                </tr>
            <?php } ?>
            
        </table>
    </div>
    
</body>
</html>
