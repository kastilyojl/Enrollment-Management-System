<?php

    // Input Value
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $h_addr = $_POST['address'];
    $b_date = $_POST['birthdate'];
    $b_place = $_POST['placebirth'];
    $p_num = $_POST['cellphone'];
    $sex = intval($_POST['gender']);
    $rel = $_POST['religion'];
    $cvl_stat = intval($_POST['civilstatus']);
    $e_mail = $_POST['email'];

    // Retrieve Value When The Page Reload
    $_SESSION['lname'] = $lname;
    $_SESSION['fname'] = $fname;
    $_SESSION['mname'] = $mname;
    $_SESSION['address'] = $h_addr;
    $_SESSION['birthdate'] = $b_date;
    $_SESSION['placebirth'] = $b_place;
    $_SESSION['cellphone'] = $p_num;
    $_SESSION['gender'] = $sex;
    $_SESSION['religion'] = $rel;
    $_SESSION['civilstatus'] = $cvl_stat;
    $_SESSION['email'] = $e_mail;


?>