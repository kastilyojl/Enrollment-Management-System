<?php

// Input Value
$s_type = intval($_POST['type']);
$p_school = $_POST['prevschool'];
$gy_level = intval($_POST['yrlevel']);
$e_branch = intval($_POST['branch']);
$str_crs = $_POST['strand'];

// Retrieve Value When The Page Reload
$_SESSION['type'] = $s_type;
$_SESSION['prevschool'] = $p_school;
$_SESSION['yrlevel'] = $gy_level;
$_SESSION['branch'] = $e_branch;
$_SESSION['strand'] = $str_crs;

?>