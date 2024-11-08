<?php

require('db.php');

        // $CheckID = "SELECT id FROM d_clearanceadmin";
        // $sql = mysqli_query($connection, $CheckID);
        // $result = mysqli_fetch_array($sql);

        if (isset($_POST['submit1'])) {
            $id = 1;
            $department = 1;
        
            // Check if the file was uploaded without errors
            if (isset($_FILES['clearanceshs']) && $_FILES['clearanceshs']['error'] === UPLOAD_ERR_OK) {
                $file_name = addslashes(file_get_contents($_FILES['clearanceshs']['tmp_name']));
        
                // Check if the record with the given id already exists
                $sqlCheck = mysqli_query($connection, "SELECT id FROM d_clearanceadmin WHERE id = $id");
                
                if (mysqli_num_rows($sqlCheck) > 0) {
                    // Update the existing record
                    $sqlClearance = mysqli_query($connection, "UPDATE d_clearanceadmin SET clearance_file = '$file_name' WHERE id = $id");
                } else {
                    // Insert a new record
                    $sqlClearance = mysqli_query($connection, "INSERT INTO d_clearanceadmin (id, clearance_file, department) VALUES ('$id', '$file_name', '$department')");
                }
        
                if ($sqlClearance) {
                    echo '<script>
                            alert("Uploaded Successfully");
                            window.location.href = "../Registrar/Clearanc3.php";
                          </script>';
                    exit;
                } else {
                    echo '<script>alert("Database Error")</script>';
                }
            } else {
                echo '<script>alert("File upload error or no file selected")</script>';
            }
        }
        

        if (isset($_POST['submit2'])) {
            $id = 2;
            $department = 2;
        
            // Check if the file was uploaded without errors
            if (isset($_FILES['clearancecollege']) && $_FILES['clearancecollege']['error'] === UPLOAD_ERR_OK) {
                $file_name = addslashes(file_get_contents($_FILES['clearancecollege']['tmp_name']));
        
                // Check if the record with the given id already exists
                $sqlCheck = mysqli_query($connection, "SELECT id FROM d_clearanceadmin WHERE id = $id");
                
                if (mysqli_num_rows($sqlCheck) > 0) {
                    // Update the existing record
                    $sqlClearance = mysqli_query($connection, "UPDATE d_clearanceadmin SET clearance_file = '$file_name' WHERE id = $id");
                } else {
                    // Insert a new record
                    $sqlClearance = mysqli_query($connection, "INSERT INTO d_clearanceadmin (id, clearance_file, department) VALUES ('$id', '$file_name', '$department')");
                }
        
                if ($sqlClearance) {
                    echo '<script>
                            alert("Uploaded Successfully");
                            window.location.href = "../Registrar/Clearanc3.php";
                          </script>';
                    exit;
                } else {
                    echo '<script>alert("Database Error")</script>';
                }
            } else {
                echo '<script>alert("File upload error or no file selected")</script>';
            }
        }
        
            
            
    
            
        

?>