<?php
include '../../../../connection.php';


$sql = "SELECT subj_code, subj_title, subj_units, subj_Labunits FROM d_enrollcourses WHERE prog_dept = '$prog_dept' AND prog_code = '$prog_code' AND prog_ylvl = '$prog_ylvl' AND sem = '$sem' AND remarks = 1";
if ($result = $conn->query($sql)) {
    $subjects = array();
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }
    $result->free();
} else {
    echo "Error fetching data: " . $conn->error;
}

echo json_encode($subjects);

$conn->close();
