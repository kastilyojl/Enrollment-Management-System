<?php

// STUDENT ADMISSION YEAR LEVEL

require('db.php');

$countG11 = "SELECT COUNT(*) AS total FROM d_studinfo WHERE gy_level = 11 AND is_Enrolled = 0"; 
$countResultG11 = mysqli_query($connection, $countG11);
$countG12 = "SELECT COUNT(*) AS total FROM d_studinfo WHERE gy_level = 12 AND is_Enrolled = 0"; 
$countResultG12 = mysqli_query($connection, $countG12);
$countC1 = "SELECT COUNT(*) AS total FROM d_studinfo WHERE gy_level = 1 AND is_Enrolled = 0"; 
$countResultC1 = mysqli_query($connection, $countC1);
$countC2 = "SELECT COUNT(*) AS total FROM d_studinfo WHERE gy_level = 2 AND is_Enrolled = 0"; 
$countResultC2 = mysqli_query($connection, $countC2);
$countC3 = "SELECT COUNT(*) AS total FROM d_studinfo WHERE gy_level = 3 AND is_Enrolled = 0"; 
$countResultC3 = mysqli_query($connection, $countC3);
$countC4 = "SELECT COUNT(*) AS total FROM d_studinfo WHERE gy_level = 4 AND is_Enrolled = 0"; 
$countResultC4 = mysqli_query($connection, $countC4);

$totalG11 = 0;
$totalG12 = 0;
$totalC1 = 0;
$totalC2 = 0;
$totalC3 = 0;
$totalC4 = 0;

$row1 = mysqli_fetch_assoc($countResultG11);
$totalG11 = $row1['total'];

$row2 = mysqli_fetch_assoc($countResultG12);
$totalG12 = $row2['total'];

$row3 = mysqli_fetch_assoc($countResultC1);
$totalC1 = $row3['total'];

$row4 = mysqli_fetch_assoc($countResultC2);
$totalC2 = $row4['total'];

$row5 = mysqli_fetch_assoc($countResultC3);
$totalC3 = $row5['total'];

$row6 = mysqli_fetch_assoc($countResultC4);
$totalC4 = $row6['total'];



// PAYMENT ACCOUNTING

$countQuery = "SELECT COUNT(*) AS total FROM d_payver"; 
$countResult = mysqli_query($connection, $countQuery);

$countQueryStat = "SELECT COUNT(*) AS totalStat FROM d_payver WHERE d_stat = 2"; 
$countResultStat = mysqli_query($connection, $countQueryStat);

$totalData = 0;
$totalDataStat = 0;

if ($countResult) {
    $row = mysqli_fetch_assoc($countResult);
    $totalData = $row['total'];

    if ($countResultStat) {
        $row1 = mysqli_fetch_assoc($countResultStat);
        $totalDataStat = $row1['totalStat'];
    } else {
        echo "Error: " . mysqli_error($connection);
    }
} else {
    echo "Error: " . mysqli_error($connection);
}

/*USER TYPE*/

$countSuper = "SELECT COUNT(*) AS total FROM users WHERE user_type = 1"; 
$countResulSuper = mysqli_query($connection, $countSuper);

$countAccounting = "SELECT COUNT(*) AS total FROM users WHERE user_type = 2"; 
$countResulAccounting = mysqli_query($connection, $countAccounting);

$countRegistrar = "SELECT COUNT(*) AS total FROM users WHERE user_type = 3"; 
$countResulRegistrar = mysqli_query($connection, $countRegistrar);

$countProf = "SELECT COUNT(*) AS total FROM users WHERE user_type = 4"; 
$countResulProf = mysqli_query($connection, $countProf);

$countStudent = "SELECT COUNT(*) AS total FROM users WHERE user_type = 5"; 
$countResulStudent = mysqli_query($connection, $countStudent);

$totalSuper = 0;
$totalAccounting = 0;
$totalRegsitrar = 0;
$totalProf = 0;
$totalStudent = 0;

$acc1 = mysqli_fetch_assoc($countResulSuper);
$totalSuper = $acc1['total'];
$acc2 = mysqli_fetch_assoc($countResulAccounting);
$totalAccounting = $acc2['total'];
$acc3 = mysqli_fetch_assoc($countResulRegistrar);
$totalRegsitrar = $acc3['total'];
$acc4 = mysqli_fetch_assoc($countResulProf);
$totalProf = $acc4['total'];
$acc5 = mysqli_fetch_assoc($countResulStudent);
$totalStudent = $acc5['total'];

?>