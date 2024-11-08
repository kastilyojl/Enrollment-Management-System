<?php
session_start();

require('../Database/db.php');
    $installment = 1500;
    $alumni = 6300;
    $regular = 8100;

    $query = "SELECT * FROM d_studinfo WHERE id_stuInfo = '" . $_SESSION['id_stuInfo'] . "'";
    $queryVou = mysqli_query($connection, $query);

    $queryPayment = "SELECT * FROM d_payver WHERE id_payVer = '" . $_SESSION['id_stuInfo'] . "'";
    $queryPaymentVer = mysqli_query($connection, $queryPayment);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition and Payment Plans - Payment Verification</title>
</head>
<body>

    <?php while($retrieved = mysqli_fetch_array($queryPaymentVer)) { 
        echo ($alumni - intval($retrieved['amount']));
     }?>
    
</body>
</html>