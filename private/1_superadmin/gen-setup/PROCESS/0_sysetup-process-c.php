<?php
include '../../../../connection.php';
header('Content-Type: application/json'); // Set header for JSON response

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form inputs
    $schoolYear = $_POST['school-year'];
    $startDate = $_POST["start-date"];
    $endDate = $_POST["end-date"];

    $t1_acad  = $_POST["t1_acad"];
    $t1_sdate = $_POST["t1_sdate"];
    $t1_edate = $_POST["t1_edate"];

    $t2_acad  = $_POST["t2_acad"];
    $t2_sdate = $_POST["t2_sdate"];
    $t2_edate = $_POST["t2_edate"];


    if (!validateFormData($schoolYear, $startDate, $endDate)) {
        http_response_code(400); // Bad request
        echo json_encode(["message" => "Invalid form data."]);
        exit;
    }

    // Perform database operation
    $result = saveFormData($schoolYear, $startDate, $endDate, $t1_acad, $t1_sdate, $t1_edate, $t2_acad, $t2_sdate, $t2_edate);

    if ($result["success"]) {
        echo json_encode(["message" => "Successfully Saved!", "clearFields" => true]);
    } else {
        http_response_code(500); // Internal server error
        echo json_encode(["message" => "Error: " . $result["error"], "clearFields" => false]);
    }
}

function validateFormData($schoolYear, $startDate, $endDate)
{
    // Perform validation on form data
    $errorMessage = '';

    // Validate school year format
    if (!preg_match('/^\d{4}-\d{4}$/', $schoolYear)) {
        $errorMessage .= 'School year format is not accepted. It should be YYYY-YYYY. ';
    }

    // Additional validation logic for other fields...

    // Return true if no errors, false otherwise
    return empty($errorMessage);
}

function saveFormData($schoolYear, $startDate, $endDate, $t1_acad, $t1_sdate, $t1_edate, $t2_acad, $t2_sdate, $t2_edate)
{
    include '../../../../connection.php';

    if ($conn->connect_errno) {
        return ["success" => false, "error" => "Connection error: " . $conn->connect_error];
    }

    // Updated SQL query
    $query = "INSERT INTO d_sysetup (sy, sdate_sy, edate_sy, t1_acad, t1_sdate, t1_edate, t2_acad, t2_sdate, t2_edate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        return ["success" => false, "error" => "Failed to prepare statement: " . $conn->error];
    }

    // Adjusted bind_param to match the new query
    $stmt->bind_param("sssssssss", $schoolYear, $startDate, $endDate, $t1_acad, $t1_sdate, $t1_edate, $t2_acad, $t2_sdate, $t2_edate);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return ["success" => true];
    } else {
        $stmt->close();
        $conn->close();
        return ["success" => false, "error" => "Error: " . $stmt->error];
    }
}
