<?php
include '../../../../connection.php';
header('Content-Type: application/json'); // Set header for JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form inputs
    $prog_code = $_POST["prog_code"] ?? '';
    $prog_title = $_POST["prog_title"] ?? '';
    $prog_dept = $_POST["prog_dept"] ?? '';
    $prog_yrs = $_POST["prog_yrs"] ?? '';

    // Check if all required fields are provided
    if (empty($prog_code) || empty($prog_title) || empty($prog_dept) || empty($prog_yrs)) {
        http_response_code(400); // Bad request
        echo json_encode(["message" => "All fields are required.", "clearFields" => false]);
        exit;
    }

    // Perform database operation
    try {
        $result = saveFormData($prog_code, $prog_title, $prog_dept, $prog_yrs);

        if ($result["success"]) {
            echo json_encode(["message" => "Successfully Saved!", "clearFields" => true]);
        } else {
            http_response_code(500); // Internal server error
            echo json_encode(["message" => "Error: " . $result["error"], "clearFields" => false]);
        }
    } catch (mysqli_sql_exception $exception) {
        // Check if the error message contains the specific error for duplicate entry
        if (strpos($exception->getMessage(), "Duplicate entry") !== false) {
            http_response_code(400); // Bad request
            echo json_encode(["message" => "Duplicate entry for program code.", "clearFields" => false]);
            exit;
        } else {
            // Handle other types of SQL exceptions
            http_response_code(500); // Internal server error
            echo json_encode(["message" => "Error: " . $exception->getMessage(), "clearFields" => false]);
            exit;
        }
    }
}

function saveFormData($prog_code, $prog_title, $prog_dept, $prog_yrs)
{
    global $conn;
    // Prepare and execute the insert statement
    $query = "INSERT INTO d_program (prog_code, prog_title, prog_dept, prog_yrs) VALUES (?, ?, ?, ?);";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        return ["success" => false, "error" => "Failed to prepare statement: " . $conn->error];
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("ssss", $prog_code, $prog_title, $prog_dept, $prog_yrs);
    if ($stmt->execute()) {
        $stmt->close();
        return ["success" => true];
    } else {
        $error = $stmt->error;
        $stmt->close();
        return ["success" => false, "error" => "Error executing statement: " . $error];
    }
}
