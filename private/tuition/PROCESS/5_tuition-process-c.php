<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../../public/Enrollment_v3/Database/MySql/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prog_dept = $_POST["prog_dept"] ?? '';
    $prog_code = $_POST["prog_code"] ?? '';
    $tuition_rows = $_POST["tuitions"] ?? [];

    if (empty($prog_code) || empty($prog_dept) || empty($tuition_rows)) {
        http_response_code(400);
        echo json_encode(["message" => "All fields are required.", "clearFields" => false]);
        exit;
    }

    $connection->begin_transaction();

    try {
        $errors = [];
        foreach ($tuition_rows as $row) {
            $t_code  = $row["t_code"] ?? '';
            $t_cat = $row["t_cat"] ?? '';
            $t_famt = $row["t_famt"] ?? '';
            $t_inst = $row["t_inst"] ?? '';
            $t_pre = $row["t_pre"] ?? '';
            $t_mid = $row["t_mid"] ?? '';
            $t_fin = $row["t_fin"] ?? '';

            $result = saveFormData($prog_dept, $prog_code, $t_code, $t_cat, $t_famt, $t_inst, $t_pre, $t_mid, $t_fin);

            if (!$result["success"]) {
                $errors[] = "Error saving tuition for program {$prog_code}: " . $result["error"];
            }
        }

        if (empty($errors)) {
            $connection->commit();
            echo json_encode(["message" => "Data saved successfully.", "clearFields" => true]);
        } else {
            $connection->rollback();
            http_response_code(500);
            echo json_encode(["message" => implode(", ", $errors), "clearFields" => false]);
        }
    } catch (Exception $e) {
        $connection->rollback();
        http_response_code(500);
        echo json_encode(["message" => "Transaction failed: " . $e->getMessage(), "clearFields" => false]);
    }
}

function saveFormData($prog_dept, $prog_code, $t_code, $t_cat, $t_famt, $t_inst, $t_pre, $t_mid, $t_fin)
{
    global $connection;
    $query = "INSERT INTO d_tuitions (prog_dept, prog_code, t_code, t_cat, t_famt, t_inst, t_pre, t_mid, t_fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        return ["success" => false, "error" => "Failed to prepare statement: " . $connection->error];
    }

    $stmt->bind_param("ssssddddd", $prog_dept, $prog_code, $t_code, $t_cat, $t_famt, $t_inst, $t_pre, $t_mid, $t_fin);

    if ($stmt->execute()) {
        return ["success" => true];
    } else {
        $error = $stmt->error;
        return ["success" => false, "error" => "Error executing statement: " . $error];
    }
}
