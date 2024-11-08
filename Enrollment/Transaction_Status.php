<?php 
session_start();
    require('../Database/db.php');
    require('../Database/Data_Convertion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="../Style/Student_Report.css">

    <style>
        .container{
            grid-template-rows: 1fr;
        }
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

        .totalAmount {
            text-align: end;
            padding:10px 50px;
            background-color: #00004C;
            color: #ffff;
        }

    </style>
</head>
<body>

<?php
    $query = "SELECT * FROM d_payver WHERE id_payVer = '" . $_SESSION['id_stuInfo'] . "'";

    $retrievedP = mysqli_query($connection, $query);
    $totalAmount = 0;
?>

   <div class="container">
        <table>
            <tr class="thead">
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
             while($result = mysqli_fetch_array($retrievedP)) { 
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
            <?php $totalAmount += $result['amount']; } ?>
            <tr>
                <td class="totalAmount" colspan="9">Totol Amount: <strong><?php echo $totalAmount?></strong></td>
            </tr>
            
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
