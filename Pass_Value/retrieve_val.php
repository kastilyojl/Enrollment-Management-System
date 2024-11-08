<?php

session_start();

    $id_payver_val = '';
    $fullname_val = '';
    $amount_val = '';
    $purpose_val = '';
    $semester_val = '';
    $reference_no_val = '';
    $type_val = '';
    $file_name = '';

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

    if (isset($_SESSION['p_file'])) {
        $file_name = $_SESSION['p_file'];
    }


// Initialize form data
$lname_value = '';
$fname_value = '';
$mname_value = '';
$h_addr_value = '';
$b_date_value = '';
$b_place_value = '';
$p_num_value = '';
$sex_value = '';
$rel_value = '';
$cvl_stat_value = ''; 
$e_mail_value = '';

if (isset($_SESSION['lname'])) {
    $lname_value = $_SESSION['lname'];
}

if (isset($_SESSION['fname'])) {
    $fname_value = $_SESSION['fname'];
}

if (isset($_SESSION['mname'])) {
    $mname_value = $_SESSION['mname'];
}

if (isset($_SESSION['address'])) {
    $h_addr_value = $_SESSION['address'];
}

if (isset($_SESSION['birthdate'])) {
    $b_date_value = $_SESSION['birthdate'];
}

if (isset($_SESSION['placebirth'])) {
    $b_place_value = $_SESSION['placebirth'];
}
if (isset($_SESSION['cellphone'])) {
    $p_num_value = $_SESSION['cellphone'];
}

if (isset($_SESSION['gender'])) {
    $sex_value = $_SESSION['gender'];
}

if (isset($_SESSION['religion'])) {
    $rel_value = $_SESSION['religion'];
}

if (isset($_SESSION['civilstatus'])) {
    $cvl_stat_value = $_SESSION['civilstatus'];
}

if (isset($_SESSION['email'])) {
    $e_mail_value = $_SESSION['email'];
}

//--------------------

$s_type_value = '';
$p_school_value = '';
$gy_level_value = '';
$e_branch_value = '';
$str_crs_value = '';
$lrn_value = '';
$vou_type_value = '';
$esc_cert_value = '';
$scho_of_value = '';


if (isset($_SESSION['type'])) {
    $s_type_value = $_SESSION['type'];
}

if (isset($_SESSION['prevschool'])) {
    $p_school_value = $_SESSION['prevschool'];
}

if (isset($_SESSION['yrlevel'])) {
    $gy_level_value = $_SESSION['yrlevel'];
}

if (isset($_SESSION['branch'])) {
    $e_branch_value = $_SESSION['branch'];
}

if (isset($_SESSION['strand'])) {
    $str_crs_value = $_SESSION['strand'];
}

if (isset($_SESSION['lrn'])) {
    $lrn_value = $_SESSION['lrn'];
}

if (isset($_SESSION['voucher'])) {
    $vou_type_value = $_SESSION['voucher'];
}

if (isset($_SESSION['ESC'])) {
    $esc_cert_value = $_SESSION['ESC'];
}

if (isset($_SESSION['Scholar'])) {
    $scho_of_value = $_SESSION['Scholar'];
}

// ---------------------------

$mr_name_value = '';
$fr_name_value = '';
$mr_occu_value = '';
$fr_occu_value = '';
$mr_pnum_value = '';
$fr_pnum_value = '';
$g_name_value = '';
$g_occu_value = '';
$g_pnum_value = '';

if (isset($_SESSION['mother'])) {
    $mr_name_value = $_SESSION['mother'];
}

if (isset($_SESSION['father'])) {
    $fr_name_value = $_SESSION['father'];
}

if (isset($_SESSION['motheroccupation'])) {
    $mr_occu_value = $_SESSION['motheroccupation'];
}

if (isset($_SESSION['fatheroccupation'])) {
    $fr_occu_value = $_SESSION['fatheroccupation'];
}

if (isset($_SESSION['motherphone'])) {
    $mr_pnum_value = $_SESSION['motherphone'];
}

if (isset($_SESSION['fatherphone'])) {
    $fr_pnum_value = $_SESSION['fatherphone'];
}

if (isset($_SESSION['guardian'])) {
    $g_name_value = $_SESSION['guardian'];
}

if (isset($_SESSION['guardianoccupation'])) {
    $g_occu_value = $_SESSION['guardianoccupation'];
}

if (isset($_SESSION['guardianphone'])) {
    $g_pnum_value = $_SESSION['guardianphone'];
}

// -----------------------------

$g10_sch_value = '';
$g10_yr_value = '';
$yr_grad1_value = '';
$g12_sch_value = '';
$g12_yr_value = '';
$yr_grad2_value = '';
$tsd_sch_value = '';
$tsd_yr_value = '';
$yr_grad3_value = '';

if (isset($_SESSION['g10school'])) {
    $g10_sch_value = $_SESSION['g10school'];
}

if (isset($_SESSION['g10yrlvl'])) {
    $g10_yr_value = $_SESSION['g10yrlvl'];
}

if (isset($_SESSION['g10yrgraduate'])) {
    $yr_grad1_value = $_SESSION['g10yrgraduate'];
}

if (isset($_SESSION['g12school'])) {
    $g12_sch_value = $_SESSION['g12school'];
}

if (isset($_SESSION['g12yrlvl'])) {
    $g12_yr_value = $_SESSION['g12yrlvl'];
}

if (isset($_SESSION['g12yrgraduate'])) {
    $yr_grad2_value = $_SESSION['g12yrgraduate'];
}

if (isset($_SESSION['TESDAschool'])) {
    $tsd_sch_value = $_SESSION['TESDAschool'];
}

if (isset($_SESSION['TESDAyrlvl'])) {
    $tsd_yr_value = $_SESSION['TESDAyrlvl'];
}

if (isset($_SESSION['TESDAyrgraduate'])) {
    $yr_grad3_value = $_SESSION['TESDAyrgraduate'];
}

?>