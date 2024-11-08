<?php

    $id_payver_val = '';
    $fullname_val = '';
    $amount_val = '';
    $purpose_val = '';
    $semester_val = '';
    $reference_no_val = '';
    $type_val = '';
    $alumnicard_val = '';
    $p_file_val = '';

    if (isset($_SESSION['id_payver'])) {
        $id_payver_val = $_SESSION['id_payver'];
    }
    
    if (isset($_SESSION['fullname'])) {
        $fullname_val = $_SESSION['fullname'];
    }
    
    if (isset($_SESSION['amount'])) {
        $amount_val = $_SESSION['amount'];
    }
    
    if (isset($_SESSION['purpose'])) {
        $purpose_val = $_SESSION['purpose'];
    }
    
    if (isset($_SESSION['semester'])) {
        $semester_val = $_SESSION['semester'];
    }
    
    if (isset($_SESSION['reference_no'])) {
        $reference_no_val = $_SESSION['reference_no'];
    }

    if (isset($_SESSION['type'])) {
        $type_val = $_SESSION['type'];
    }
    
    if (isset($_SESSION['alumnicard'])) {
        $alumnicard_val = $_SESSION['alumnicard'];
    }
    
    if (isset($_SESSION['p_file'])) {
        $p_file_val = $_SESSION['p_file'];
    }

?>