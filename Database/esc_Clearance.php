<?php 
session_start();
require('db.php');

    $fileQuery = "SELECT * FROM d_clearanceadmin";
    $sql = mysqli_query($connection, $fileQuery); 

    if (!$sql) {
        die("Query failed: " . mysqli_error($connection));
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['department'])) {
            $department = intval($_POST['department']);
            
            $query = "SELECT clearance_file FROM d_clearanceadmin WHERE department = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("i", $department);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($fileData);
                $stmt->fetch();
                
                $fileName = "clearance_form.pdf";
                
                header("Content-Type: application/pdf");
                header("Content-Disposition: attachment; filename=\"$fileName\"");
                echo $fileData;
            } else {
                echo '<script>alert("File Not Found")</script>';
            }
    
            $stmt->close();
            $connection->close();
        } else {
            echo "Invalid request.";
        }

        if(isset($_POST['submit'])) {
             
            $user_id = $_SESSION['id_stuInfo'];

            if(isset($_FILES['clearance_form'])) {
                if ($_FILES['clearance_form']['error'] === UPLOAD_ERR_OK) {
                    $file_name = addslashes(file_get_contents($_FILES['clearance_form']['tmp_name']));
                    $sqlClearance = mysqli_query($connection, "INSERT INTO d_clearance VALUES ('$user_id', '$file_name', '0')");
                    echo '<script>alert("Uploaded Succesfully")
                    window.location.href = "../Enrollment/Clearance.php"
                    </script>';
                    exit;
                } else {
                    $file_name = '';
                }
            } else {
                $file_name = '';
            }
        }

    }

?>