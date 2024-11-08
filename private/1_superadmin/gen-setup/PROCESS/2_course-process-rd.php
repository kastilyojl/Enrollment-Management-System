<?php
include '../../../../connection.php';

function fetchData($conn, $query = '')
{
    $d_subject = [];
    if ($query) {
        $sql = "SELECT * FROM d_subject WHERE prog_code LIKE ? OR subj_code LIKE ? OR subj_title LIKE ? OR subj_units LIKE ? OR subj_Labunits LIKE ? OR subj_total_hours LIKE ? OR subj_dept LIKE ? OR subj_ylvl LIKE ?";
        if ($stmt = $conn->prepare($sql)) {
            $searchTerm = '%' . $query . '%';
            $stmt->bind_param("ssssssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $d_subject[] = $row;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        $sql = "SELECT * FROM d_subject";
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $d_subject[] = $row;
            }
            $result->free();
        } else {
            echo "Error fetching data: " . $conn->error;
        }
    }
    return $d_subject;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $row_id = intval($_POST['id']);

        // Query the database for the row data
        $sql = "SELECT * FROM d_subject WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $row_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $query_string = http_build_query($row);
                header("Location: ../PAGE/2_course-u.php?$query_string");
                exit();
            } else {
                echo "No data found for the selected row.";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } elseif (isset($_POST['id'])) {
        $row_id = intval($_POST['id']);

        $sql = "DELETE FROM d_subject WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $row_id);
            if ($stmt->execute()) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Error deleting record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}

// Handle AJAX request for search
if (isset($_GET['ajax_query'])) {
    $query = $_GET['ajax_query'];
    $d_subject = fetchData($conn, $query);
    echo json_encode($d_subject);
    exit();
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
$d_subject = fetchData($conn, $query);
$conn->close();
