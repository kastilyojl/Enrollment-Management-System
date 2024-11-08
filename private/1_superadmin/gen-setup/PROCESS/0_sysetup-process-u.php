<?php
include '../../../../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated data from the form
    $id = $_POST["id"];
    $sy = $_POST["school-year"];
    $sdate_sy = $_POST["start-date"];
    $edate_sy = $_POST["end-date"];

    $t1_acad = $_POST["t1_acad"];
    $t1_sdate = $_POST["t1_sdate"];
    $t1_edate = $_POST["t1_edate"];

    $t2_acad  = $_POST["t2_acad"];
    $t2_sdate = $_POST["t2_sdate"];
    $t2_edate = $_POST["t2_edate"];

    // Prepare and execute the SQL statement
    $sql = "UPDATE d_sysetup SET 
        sy = ?, sdate_sy = ?, edate_sy = ?, t1_acad = ?, t1_sdate = ?, t1_edate = ?, t2_acad = ?, t2_sdate = ?, t2_edate = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssi",
        $sy,
        $sdate_sy,
        $edate_sy,
        $t1_acad,
        $t1_sdate,
        $t1_edate,
        $t2_acad,
        $t2_sdate,
        $t2_edate,
        $id
    );

    // Execute the statement and handle success or failure
    if ($stmt->execute()) {
        $response = ["success" => true, "message" => "Updated successfully!"];
    } else {
        $response = ["success" => false, "error" => "Error: " . $stmt->error];
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
