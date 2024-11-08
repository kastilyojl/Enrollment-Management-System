<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../../../connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prog_code = $_POST["prog_code"] ?? '';
    $subj_dept = $_POST["subj_dept"] ?? '';
    $subj_ylvl = $_POST["subj_ylvl"] ?? '';
    $subj_sem = $_POST["subj_sem"] ?? '';
    $subject_rows = $_POST["subjects"] ?? [];

    if (empty($prog_code) || empty($subj_dept) || empty($subj_ylvl) || empty($subj_sem) || empty($subject_rows)) {
        http_response_code(400);
        echo json_encode(["message" => "All fields are required.", "clearFields" => false]);
        exit;
    }

    $conn->begin_transaction();

    try {
        $errors = [];
        foreach ($subject_rows as $row) {
            $subj_code = $row["subj_code"] ?? '';
            $subj_title = $row["subj_title"] ?? '';
            $subj_units = $row["subj_units"] ?? '';
            $subj_Labunits = $row["subj_Labunits"] ?? '';
            $subj_total_minutes = $row["subj_total_minutes"] ?? 0;

            $hours = floor($subj_total_minutes / 60);
            $minutes = $subj_total_minutes % 60;
            $seconds = 0;

            $subj_total_hours = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

            // Validation logic
            if ($subj_units === '' || $subj_Labunits === '') {
                $errors[] = "Both Lec and Lab units must have one contains value provided.If one has no value, input 0.";
                continue;
            }

            if ($subj_units === '0' && $subj_Labunits === '0') {
                $errors[] = "Lec and Lab Units cannot be both zero.";
                continue; // Skip saving
            }

            $result = saveFormData($prog_code, $subj_code, $subj_title, $subj_units, $subj_Labunits, $subj_total_hours, $subj_dept, $subj_ylvl, $subj_sem);

            if (!$result["success"]) {
                $errors[] = "Error saving subject {$subj_code}: " . $result["error"];
            }
        }

        if (empty($errors)) {
            $conn->commit();
            echo json_encode(["message" => "Successfully Saved!", "clearFields" => true]);
        } else {
            $conn->rollback();
            http_response_code(500);
            echo json_encode(["message" => implode(", ", $errors), "clearFields" => false]);
        }
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        if (strpos($exception->getMessage(), "Duplicate entry") !== false) {
            http_response_code(400);
            echo json_encode(["message" => "Duplicate entry for program code.", "clearFields" => false]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $exception->getMessage(), "clearFields" => false]);
        }
    }
}

function saveFormData($prog_code, $subj_code, $subj_title, $subj_units, $subj_Labunits, $subj_total_hours, $subj_dept, $subj_ylvl, $subj_sem)
{
    global $conn;
    $query = "INSERT INTO d_subject (prog_code, subj_code, subj_title, subj_units, subj_Labunits, subj_total_hours, subj_dept, subj_ylvl, subj_sem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        return ["success" => false, "error" => "Failed to prepare statement: " . $conn->error];
    }

    $stmt->bind_param("sssssssss", $prog_code, $subj_code, $subj_title, $subj_units, $subj_Labunits, $subj_total_hours, $subj_dept, $subj_ylvl, $subj_sem);

    if ($stmt->execute()) {
        return ["success" => true];
    } else {
        $error = $stmt->error;
        if (strpos($error, "Duplicate entry") !== false) {
            return ["success" => false, "error" => "Duplicate entry for subject code: " . $subj_code];
        } else {
            return ["success" => false, "error" => "Error executing statement: " . $error];
        }
    }
}
