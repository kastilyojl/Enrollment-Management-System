<?php

    $g10_sch = $_POST['g10school'];
    $g10_yr = $_POST['g10yrlvl'];
    $yr_grad1 = $_POST['g10yrgraduate'];
    $g12_sch = $_POST['g12school'];
    $g12_yr = $_POST['g12yrlvl'];
    $yr_grad2 = $_POST['g12yrgraduate'];
    $tsd_sch = $_POST['TESDAschool'];
    $tsd_yr = $_POST['TESDAyrlvl'];
    $yr_grad3 = $_POST['TESDAyrgraduate'];

    $_SESSION['g10school'] = $g10_sch;
    $_SESSION['g10yrlvl'] = $g10_yr;
    $_SESSION['g10yrgraduate'] = $yr_grad1;
    $_SESSION['g12school'] = $g12_sch;
    $_SESSION['g12yrlvl'] = $g12_yr;
    $_SESSION['g12yrgraduate'] = $yr_grad2;
    $_SESSION['TESDAschool'] = $tsd_sch;
    $_SESSION['TESDAyrlvl'] = $tsd_yr;
    $_SESSION['TESDAyrgraduate'] = $yr_grad3;

?>