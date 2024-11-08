<?php
// Database connection
include '../../../../connection.php';

if (isset($_GET['ajax_query'])) {
    $query = $_GET['ajax_query'];

    $search_sql = "SELECT * FROM d_studinfo WHERE id_stuInfo LIKE ? OR lname LIKE ? OR fname LIKE ? OR e_mail LIKE ? OR dept LIKE ? OR str_crs LIKE ? OR gy_level LIKE ? OR sem LIKE ?";
    $stmt = $conn->prepare($search_sql);
    $search_param = "%$query%";
    $stmt->bind_param("ssssssss", $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    $search_results = array();
    while ($row = $result->fetch_assoc()) {
        $search_results[] = $row;
    }

    echo json_encode($search_results);
    exit;
}

// If no search query provided, return all records
$sql = "SELECT * FROM d_studinfo";
$result = $conn->query($sql);
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['check'])) {
        $id_stuInfo = $_POST['id_stuInfo'];

        // Query the database for the row data
        $sql = "SELECT * FROM d_progstud WHERE id_stuInfo = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $id_stuInfo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $query_string = http_build_query($row);
                header("Location: ../PAGE/7_cs-crud.php?$query_string");
                exit();
            } else {
                echo "No data found for the selected row.";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}

echo json_encode($data);
$conn->close();
