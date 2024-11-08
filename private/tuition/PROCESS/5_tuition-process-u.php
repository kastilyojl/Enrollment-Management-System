<?php
include '../../../public/Enrollment_v3/Database/MySql/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prog_dept = $_POST["prog_dept"];
    $prog_code = $_POST["prog_code"];
    $t_code = $_POST["t_code"];
    $t_cat = $_POST["t_cat"];
    $t_famt = $_POST["t_famt"];
    $t_inst = $_POST["t_inst"];
    $t_pre = $_POST["t_pre"];
    $t_mid = $_POST["t_mid"];
    $t_fin = $_POST["t_fin"];

    // Proceed with the update
    $sql = "UPDATE d_tuitions SET prog_dept = ?, prog_code = ?, t_cat = ?, t_famt = ?, t_inst = ?, t_pre = ?, t_mid = ?, t_fin = ? WHERE t_code = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssdddds", $prog_dept, $prog_code, $t_cat, $t_famt, $t_inst, $t_pre, $t_mid, $t_fin, $t_code);

    if ($stmt->execute()) {
        $response = ["success" => true, "message" => "Updated successfully!"];
    } else {
        $response = ["success" => false, "error" => "Error: " . $stmt->error];
    }

    $stmt->close();
} else {
    // Handle invalid request method
    $response = ["success" => false, "error" => "Invalid request method."];
}

$connection->close();

header('Content-Type: application/json');
echo json_encode($response);
exit;
