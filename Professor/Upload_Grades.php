<?php
require('../Database/db.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['excel_download'])) {
        $id = 3;
        
        $query = "SELECT clearance_file FROM d_clearanceadmin WHERE department = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($fileData);
            $stmt->fetch();
            
            $fileName = "excel_file.xlsx";  // Corrected the file extension to .xlsx
            
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            echo $fileData;
        } else {
            echo '<script>alert("File not found")</script>';
        }

        $stmt->close();
        $connection->close();
    } else {
        echo "Invalid request.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploading Grades</title>

    <link rel="stylesheet" href="../Style/Professor_Grades.css">

</head>
<body>

    <div class="container">
        <form class="download" action="" method="post">
            <div>
                <h4>Grades Format</h4>
                <button type="submit" name="excel_download">Download</button>
            </div>
        </form>
        <div class="upload-container">
            <form action="../Database/epc_Grades.php" method="post" enctype="multipart/form-data">
                <div class="upload">
                    <label for="input_file" id="drop_image">
                        <div class="image_view">
                            <img src="../Images/bx-cloud-upload.svg" alt="upload" class="filter-blue">
                            <p id="file_name">Browse File To Upload</p>
                            <input type="file" name="files[]" onchange="previewFiles()" accept=".csv" id="input_file" multiple hidden>
                        </div>
                    </label>
                    <button type="submit" value="Upload Files" name="submit">Upload</button>
                </div>
            </form>
            <div class="file_list" id="file_list">
                <div class="file_names"></div>
            </div>
        </div>
    </div>
    
</body>
</html>

<script>
    function previewFiles() {
        var preview = document.querySelector('.file_names');
        var files = document.getElementById('input_file').files;

        var grid = document.getElementById('file_list').style.display = 'block';

        // Clear previous content
        preview.innerHTML = '';

        for (var i = 0; i < files.length; i++) {
            (function() {
                var fileDiv = document.createElement('div');
                fileDiv.className = 'file_name'; // Adding the class to the file div
                var iconSpan = document.createElement('span');
                var fileIcon = document.createElement('img');
                fileIcon.src = '../Images/csv-icon.png';
                iconSpan.appendChild(fileIcon);

                var fileNameP = document.createElement('p');
                fileNameP.textContent = files[i].name;

                var removeIcon = document.createElement('span');
                removeIcon.className = 'remove'; // Adding class to identify remove button
                removeIcon.innerHTML = '&#x2716;'; // X icon

                removeIcon.addEventListener('click', function() {
                    fileDiv.remove(); // Remove the file div on click
                });

                fileDiv.appendChild(iconSpan);
                fileDiv.appendChild(fileNameP);
                fileDiv.appendChild(removeIcon);

                preview.appendChild(fileDiv);
            })();
        }
    }
</script>
