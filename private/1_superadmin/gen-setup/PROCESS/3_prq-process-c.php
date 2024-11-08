<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../../../../connection.php';

// Search for subj_title using subj_code
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subj_code'])) {
    $subj_code = $_POST['subj_code'];

    $sql = "SELECT subj_title FROM d_subject WHERE subj_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $subj_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo htmlspecialchars($row['subj_title']);
    } else {
        echo "No title found";
    }

    $stmt->close();
}

// Saving function
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subj_code']) && isset($_POST['prerequisites'])) {
    $subj_code = $_POST["subj_code"];
    $prerequisites = $_POST["prerequisites"];

    // Check if all required fields are provided
    if (empty($subj_code) || empty($prerequisites)) {
        http_response_code(400);
        echo json_encode(["message" => "All fields are required.", "clearFields" => false]);
        exit;
    }

    try {
        $errors = [];
        foreach ($prerequisites as $prerequisite) {
            $prq_code = $prerequisite["prq_code"];
            $prq_title = $prerequisite["prq_title"];

            if (empty($prq_code) || empty($prq_title)) {
                $errors[] = "All fields are required for each prerequisite.";
                continue;
            }

            $result = savePrerequisite($subj_code, $prq_code, $prq_title);

            if (!$result["success"]) {
                $errors[] = "Error saving prerequisite {$prq_code}: " . $result["error"];
            }
        }

        if (empty($errors)) {
            echo json_encode(["message" => "Successfully Saved!", "clearFields" => true]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => implode(", ", $errors), "clearFields" => false]);
        }
    } catch (mysqli_sql_exception $exception) {
        if (strpos($exception->getMessage(), "Duplicate entry") !== false) {
            http_response_code(400);
            echo json_encode(["message" => "Duplicate entry for prerequisite code.", "clearFields" => false]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $exception->getMessage(), "clearFields" => false]);
        }
    }
}

function savePrerequisite($subj_code, $prq_code, $prq_title)
{
    global $conn;
    $query = "INSERT INTO d_prq (subj_code, subj_title, prq_code, prq_title) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        return ["success" => false, "error" => "Failed to prepare statement: " . $conn->error];
    }

    $subj_title = getSubjectTitle($subj_code);

    $stmt->bind_param("ssss", $subj_code, $subj_title, $prq_code, $prq_title);

    if ($stmt->execute()) {
        return ["success" => true];
    } else {
        $error = $stmt->error;
        if (strpos($error, "Duplicate entry") !== false) {
            return ["success" => false, "error" => "Duplicate entry for prerequisite code: " . $prq_code];
        } else {
            return ["success" => false, "error" => "Error executing statement: " . $error];
        }
    }
}

function getSubjectTitle($subj_code)
{
    global $conn;
    $query = "SELECT subj_title FROM d_subject WHERE subj_code = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $subj_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['subj_title'];
    } else {
        return "";
    }
}
