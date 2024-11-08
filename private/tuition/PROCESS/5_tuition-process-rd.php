<?php
include '../../../public/Enrollment_v3/Database/MySql/db.php';

function fetchData($connection, $query = '')
{
    $d_tuitions = [];
    if ($query) {
        $sql = "SELECT * FROM d_tuitions WHERE 
                prog_dept LIKE ? OR 
                prog_code LIKE ? OR 
                t_code LIKE ? OR 
                t_cat LIKE ? OR 
                t_famt LIKE ? OR 
                t_inst LIKE ? OR 
                t_pre LIKE ? OR 
                t_mid LIKE ? OR 
                t_fin LIKE ?";
        if ($stmt = $connection->prepare($sql)) {
            $searchTerm = '%' . $query . '%';
            $stmt->bind_param("sssssssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $d_tuitions[] = $row;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $connection->error;
        }
    } else {
        $sql = "SELECT * FROM d_tuitions";
        if ($result = $connection->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $d_tuitions[] = $row;
            }
            $result->free();
        } else {
            echo "Error fetching data: " . $connection->error;
        }
    }
    return $d_tuitions;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $row_id = $_POST['id'];

        $sql = "SELECT * FROM d_tuitions WHERE t_code = ?";
        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("s", $row_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $query_string = http_build_query($row);
                header("Location: ../PAGE/5_tuition-u.php?$query_string");
                exit();
            } else {
                echo "No data found for the selected row.";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $connection->error;
        }
    } elseif (isset($_POST['id'])) {
        $row_id = $_POST['id'];

        $sql = "DELETE FROM d_tuitions WHERE t_code = ?";
        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("s", $row_id);
            if ($stmt->execute()) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Error deleting record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $connection->error;
        }
    }
}

if (isset($_GET['ajax_query'])) {
    $query = $_GET['ajax_query'];
    $d_tuitions = fetchData($connection, $query);
    echo json_encode($d_tuitions);
    exit();
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
$d_tuitions = fetchData($connection, $query);
$connection->close();
