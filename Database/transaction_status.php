<?php

require('db.php');

if (isset($_POST['transaction'])) {
    $enterid = $_POST['enterID'];
    $sqlTransaction = mysqli_query($connection, "SELECT id_stuInfo FROM d_studinfo");

    $found = false;

    while ($result = mysqli_fetch_array($sqlTransaction)) {
        if ($enterid === $result['id_stuInfo']) {
            $found = true;
            break;
        }
    }

    if ($found) {
        header("Location: ../Pre-Admission/transaction.php?id_stuInfo=$enterid");
    } else {
        header("Location: ../Pre-Admission/verification.php");
    }
    exit;
}
?>
