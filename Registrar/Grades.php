<?php 
    require('../Database/db.php');

    $message = '';

    if(isset($_GET["search"])) {
        $searchID = $_GET['searchID'];

        $sqlGrade = mysqli_query($connection, "SELECT * FROM d_grades WHERE name LIKE '%$searchID%' 
        OR grade_lvl LIKE '%$searchID%' OR subject LIKE '%$searchID%' 
        OR track LIKE '%$searchID%' OR final_grade LIKE '%$searchID%' OR remarks LIKE '%$searchID%'");

    if(mysqli_num_rows($sqlGrade) < 1) {
        $message = 'Data Not Found';
    }

} else {
    $sqlGrade = mysqli_query($connection, "SELECT * FROM d_grades");
    $message = 'No Student Grades';
}

        // $CheckID = "SELECT id FROM d_clearanceadmin";
        // $sql = mysqli_query($connection, $CheckID);
        // $resultExcel = mysqli_fetch_array($sql);

        if (isset($_POST['upload'])) {
            $id = 3;
            $department = 3;
        
            // Check if the file was uploaded without errors
            if (isset($_FILES['excel_format']) && $_FILES['excel_format']['error'] === UPLOAD_ERR_OK) {
                $file_name = addslashes(file_get_contents($_FILES['excel_format']['tmp_name']));
        
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
                            window.location.href = "./Grades.php";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">
    <style>
        .failed {
            color: red; 
        }
        .passed {
            color: green;
        } .header {
            display: flex;
            justify-content: space-between;
        } 

        .excel {
            display: flex;
            align-items:center;
        }
        .excel .box {
            margin-top: 6px;
        
        }
        .excel span {
            font-size: 14px
        } 
        
        input [type='submit'] {
            height: 30px;
        }
        
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <form action="./Grades.php" method="get">
                <input type="text" placeholder="Search" name="searchID">
                <button type="submit" name="search">Search</button>
            </form>
            <form class="excel" action="" method="post" enctype="multipart/form-data">
                <div class="box">
                    <span>Grade Format:</span>
                    <input type="file" name="excel_format" accept='.csv'>
                </div>
                <input type="submit" value="Upload" name="upload">
            </form>
        </div>
        <table>
            <tr class="thead">
                <th>Name</th>
                <th>Section & Grade</th>
                <th>Subject</th>
                <th>Course/Track</th>
                <th>Final Grades</th>
                <th>Remarks</th>
            </tr>
            <tr>
            <?php
            if (mysqli_num_rows($sqlGrade) > 0) {
                while($result = mysqli_fetch_array($sqlGrade)) {
                    $rowClass = ($result['remarks'] === "Failed") ? "failed" : "passed";
                ?>
            <tr >
                <td><?php echo $result['name']?></td>
                <td><?php echo $result['grade_lvl']?></td>
                <td><?php echo $result['subject']?></td>
                <td><?php echo $result['track']?></td>
                <td><?php echo $result['final_grade']?></td>
                <td class="<?php echo $rowClass; ?>"><?php echo $result['remarks']?></td>
            </tr>

            <?php } } else {
                    echo "<tr><td colspan='6'>$message</td></tr>";
                }?>    
            </tr>
        </table>
    </div>
    
</body>
</html>