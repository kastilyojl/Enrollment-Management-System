<?php
    require('../Database/db.php');

    $eligible = mysqli_query($connection, "SELECT * FROM d_decisiontree");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Student</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <div>Complete = &#10004; : Not Complete = &#10060; </div>
            <div class="data_set"><a href="./Splitting-No-Computation-Comparison.pptx">Data Set</a></div>
        </div>
        <table>
            <tr class="thead">
                <th>Id no.</th>
                <th>Documents</th>
                <th>Tuition</th>
                <th>Grades</th>
                <th>Clearance</th>
                <th>Course Selection</th>
                <th>Eligible To Enroll</th>
                <th>Remarks</th>
            </tr>
            <?php while($result = mysqli_fetch_array($eligible)) { ?>
                <td><?php $result['id_Eligible'] == 1 ? '&#10004;' : ($result['id_Eligible'] ==  0 ? '&#10060;' : '');?></td>
                <td><?php $result['documents'] == 1 ? '&#10004;' : ($result['documents'] ==  0 ? '&#10060;' : '');?></td>
                <td><?php $result['payment'] == 1 ? '&#10004;' : ($result['payment'] ==  0 ? '&#10060;' : '');?></td>
                <td><?php $result['grades'] == 1 ? '&#10004;' : ($result['grades'] ==  0 ? '&#10060;' : '');?></td>
                <td><?php $result['clearance'] == 1 ? '&#10004;' : ($result['clearance'] ==  0 ? '&#10060;' : '');?></td>
                <td><?php $result['course_selection'] == 1 ? '&#10004;' : ($result['course_selection'] ==  0 ? '&#10060;' : '');?></td>
                <td><?php $result['eligible'] == 1 ? '&#10004;' : ($result['eligible'] ==  0 ? '&#10060;' : '');?></td>
                <td><?php $result['remarks'] == 1 ? '&#10004;' : ($result['remarks'] ==  0 ? '&#10060;' : '');?></td>
            <tr>
            <?php } ?>

            </tr>

        </table>
    </div>

</body>
</html>
