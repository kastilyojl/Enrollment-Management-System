<?php

    $id_payver = $_POST['id_payver'];
    $fullname = $_POST['fullname'];
    $amount = $_POST['amount'];
    $purpose = $_POST['purpose'];
    $semester = $_POST['semester'];
    $reference_no = $_POST['reference_no'];
    $type = $_POST['type'];
    $file_name = $_POST['p_file'];
    
    // Retrieve Value When The Page Reload
    $_SESSION['id_payver'] = $id_payver;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['amount'] = $amount;
    $_SESSION['purpose'] = $purpose;
    $_SESSION['semester'] = $semester;
    $_SESSION['reference_no'] = $reference_no;
    $_SESSION['type'] = $type;

    if (isset($_FILES['p_file'])) {
        if ($_FILES['p_file']['error'] === UPLOAD_ERR_NO_FILE) {
            $file_name = '';
        } else {
            $file_name = $_FILES['p_file'];
            $_SESSION['p_file'] = $file_name;
        }
    }

?>