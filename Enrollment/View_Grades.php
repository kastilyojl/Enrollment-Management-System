<?php
session_start();
require('../Database/db.php');

// Retrieve session variables
$fullName = $_SESSION['fname'] . " " . $_SESSION['lname'];
$str_crs = $_SESSION['str_crs'];
$gy_lvl = $_SESSION['gy_level'];

// Adjusting the value considering what the professor might input for strand/course
if ($str_crs == 'BSCS' || $str_crs == 'BS Computer Science' || $str_crs == 'Computer Science') {
    $str_crs_equivalent = "('BSCS')";
} else if($str_crs == 'Criminology' || $str_crs == 'BS Criminology' || $str_crs == 'Crim') {
    $str_crs_equivalent = "('Criminology')";
} else if($str_crs == 'Entrep' || $str_crs == 'BS Entrepreneurship' || $str_crs == 'BS Entrep' || $str_crs == 'BS Entrepreneur' || $str_crs == 'Entrepreneur') {
    $str_crs_equivalent = "('Entrepreneurship')";
} else if($str_crs == 'Tourism' || $str_crs == 'BS Tourism' || $str_crs == 'BS Tourism Management' || $str_crs == 'BSTM') {
    $str_crs_equivalent = "('BSTM')";
} else if($str_crs == 'Information System' || $str_crs == 'BS Information System' || $str_crs == 'BSIS') {
    $str_crs_equivalent = "('BSIS')";
} else if($str_crs == 'BTVTEd') {
    $str_crs_equivalent = "('BTVTEd')";
} else if($str_crs == 'CNC-ACT') {
    $str_crs_equivalent = "('CNC-ACT')";
} else {
    $str_crs_equivalent = "('$str_crs')";
}

if ($gy_lvl == 'G11' || $gy_lvl == 'G 11' || $gy_lvl == 'Grade 11' || $gy_lvl == '11' || $gy_lvl == 'Grade-11' || $gy_lvl == 'G-11') {
    $gy_lvl_equivalent = "('Grade 11')";
} else if ($gy_lvl == 'G12' || $gy_lvl == 'G 12' || $gy_lvl == 'Grade 12' || $gy_lvl == '12' || $gy_lvl == 'Grade-12' || $gy_lvl == 'G-12') {
    $gy_lvl_equivalent = "('Grade 12')";
} else if ($gy_lvl == '1st Year' || $gy_lvl == '1st' || $gy_lvl == '1st Year College') {
    $gy_lvl_equivalent = "('1st')";
} else if ($gy_lvl == '2nd Year' || $gy_lvl == '2nd' || $gy_lvl == '2nd Year College') {
    $gy_lvl_equivalent = "('3rd')";
} else if ($gy_lvl == '3rd Year' || $gy_lvl == '3rd' || $gy_lvl == '3rd Year College') {
    $gy_lvl_equivalent = "('3rd')";
} else if ($gy_lvl == '4th Year' || $gy_lvl == '4th' || $gy_lvl == '4th Year College') {
    $gy_lvl_equivalent = "('4th')";
} else {
    $gy_lvl_equivalent = "('$gy_lvl')";
}

// Construct the query
$query = "
SELECT 
    d_subject.subj_code, 
    d_subject.subj_title, 
    COALESCE(d_grades.subject, '') AS subject, 
    COALESCE(d_grades.final_grade, '') AS final_grade, 
    COALESCE(d_grades.remarks, '') AS remarks
FROM d_subject
LEFT JOIN d_grades 
    ON d_subject.prog_code = d_grades.track
    AND d_subject.subj_ylvl = d_grades.grade_lvl
    AND d_subject.subj_title = d_grades.subject
    AND d_grades.name = '$fullName'
WHERE d_subject.prog_code = '$str_crs'
  AND d_subject.subj_ylvl = d_subject.subj_ylvl
";

$result = mysqli_query($connection, $query);

if (!$result) {
    die('Error executing query: ' . mysqli_error($connection));
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">
    <style>
        h3 {
            height: 30px;
        }
        .failed {
            color: red; 
        }
        .passed {
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h3>2nd Semester</h3>
    </div>
    <table>
        <tr class="thead">
            <th>Code</th>
            <th>Subject Description</th>
            <th>Grades</th>
            <th>Remarks</th>
        </tr>

        <?php while ($row = mysqli_fetch_array($result)) { 
            $rowClass = ($row['remarks'] === "Failed") ? "failed" : "passed"; ?>
            <tr>
                <td><?php echo $row['subj_code']; ?></td>
                <td><?php echo $row['subj_title']; ?></td>
                <td><?php echo $row['final_grade']; ?></td>
                <td class="<?php echo $rowClass; ?>"><?php echo $row['remarks']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
