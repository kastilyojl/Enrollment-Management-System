<?php
include '../../../../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $prog_code = $_POST["prog_code"];
    $subj_code = $_POST["subj_code"];
    $subj_title = $_POST["subj_title"];
    $subj_units = $_POST["subj_units"];
    $subj_Labunits = $_POST["subj_Labunits"];
    $subj_total_hours = $_POST["subj_total_hours"] ?? 0;

    $hours = floor($subj_total_hours / 60);
    $minutes = $subj_total_hours % 60;
    $seconds = 0;

    $subj_total_hours = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    $subj_dept = $_POST["subj_dept"];
    $subj_ylvl = $_POST["subj_ylvl"];

    // Check if department and year-level choices match
    if (($subj_dept === "shs" && ($subj_ylvl === "Grade 11" || $subj_ylvl === "Grade 12")) ||
        ($subj_dept === "college" && ($subj_ylvl === "1st year" || $subj_ylvl === "2nd year" || $subj_ylvl === "3rd year" || $subj_ylvl === "4th year"))
    ) {

        // Proceed with the update
        $sql = "UPDATE d_subject SET prog_code = ?, subj_code = ?, subj_title = ?, subj_units = ?, subj_Labunits = ?, subj_total_hours = ?,subj_dept = ?, subj_ylvl = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $prog_code, $subj_code, $subj_title, $subj_units, $subj_Labunits, $subj_total_hours, $subj_dept, $subj_ylvl, $id);

        if ($stmt->execute()) {
            $response = ["success" => true, "message" => "Updated successfully!"];
        } else {
            $response = ["success" => false, "error" => "Error: " . $stmt->error];
        }

        $stmt->close();
    } else {
        // Department and year-level choice do not match, send error response
        $response = ["success" => false, "error" => "Department and Year-Level choice do not match."];
    }

    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
