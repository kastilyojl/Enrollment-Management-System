<?php
    require('../Database/asc_Payment.php');
    require('../Database/Data_Convertion.php');

$message = '';

if(isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $sqlStudPLALL = mysqli_query($connection, "SELECT * FROM d_payver WHERE id_payVer = '$searchID' OR ref_no = '$searchID'");

    if(mysqli_num_rows($sqlStudPLALL) < 1) {
        $message = 'No Student ID / Reference Number Found';
    }

} else {
    $sqlStudPLALL = mysqli_query($connection, "SELECT * FROM d_payver");
    $message = 'No Student Payment';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College List</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">

    <style>
        .enlarged {
            width: auto;
            height: 400px;
            transition: width 0.3s ease;
            cursor: pointer;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            top: 20%;
        }
    </style>
</head>
<body>

<div class="container">
        <div class="header">
            <form action="./Transaction_Status.php" method="get">
                <input type="text" placeholder="Search by ID / Ref No." name="searchID">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <table>
            <tr>
                <th>Id no.</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Purpose</th>
                <th>Semester</th>
                <th>Reference No.</th>
                <th>Receipt</th>
                <th>Status</th>
                <th>Remarks</th>
            </tr>
            <tr>
            <?php
            if (mysqli_num_rows($sqlStudPLALL) > 0) {
             while($result = mysqli_fetch_array($sqlStudPLALL)) { 
                $d_stat_val = isset($d_stat[$result['d_stat']]) ? $d_stat[$result['d_stat']] : '';?>
                <td><?php echo $result['id_payVer']?></td>
                <td><?php echo $result['p_name']?></td>
                <td><?php echo $result['amount']?></td>
                <td><?php echo $result['purpose']?></td>
                <td><?php echo $result['semester']?></td>
                <td><?php echo $result['ref_no']?></td>
                <td>
                    <?php
                        echo '<img class="thumbnail" src="data:image/*;base64,'.base64_encode($result['p_file']).'" height="30" width="80" style="cursor: pointer;"/>';
                    ?>
                </td>
                <td><?php echo $d_stat_val?></td>
                <td><?php echo $result['d_rmks']?></td>
                </tr>
            <?php } } else {
                    echo "<tr><td colspan='9'>$message</td></tr>";
                }?>
            
        </table>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                this.classList.toggle('enlarged');
                });
            });
        });
    </script>

</body>
</html>
