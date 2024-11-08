<?php

    $mr_name = $_POST['mother'];
    $fr_name = $_POST['father'];
    $mr_occu = $_POST['motheroccupation'];
    $fr_occu = $_POST['fatheroccupation'];
    $mr_pnum = $_POST['motherphone'];
    $fr_pnum = $_POST['fatherphone'];
    $g_name = $_POST['guardian'];
    $g_occu = $_POST['guardianoccupation'];
    $g_pnum = $_POST['guardianphone'];

    $_SESSION['mother'] = $mr_name;
    $_SESSION['father'] = $fr_name;
    $_SESSION['motheroccupation'] = $mr_occu;
    $_SESSION['fatheroccupation'] = $fr_occu;
    $_SESSION['motherphone'] = $mr_pnum;
    $_SESSION['fatherphone'] = $fr_pnum;
    $_SESSION['guardian'] = $g_name;
    $_SESSION['guardianoccupation'] = $g_occu;
    $_SESSION['guardianphone'] = $g_pnum;

?>