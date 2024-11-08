<?php
include '../../../../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $prog_code = $_POST["prog_code"];
    $prog_title = $_POST["prog_title"];
    $prog_dept = $_POST["prog_dept"];
    $prog_yrs = $_POST["prog_yrs"];

    $sql = "UPDATE d_program SET prog_code = ?, prog_title = ?, prog_dept = ?, prog_yrs = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $prog_code, $prog_title, $prog_dept, $prog_yrs, $id);

    if ($stmt->execute()) {
        $response = ["success" => true, "message" => "Updated successfully!"];
    } else {
        $response = ["success" => false, "error" => "Error: " . $stmt->error];
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
