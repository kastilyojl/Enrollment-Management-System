<?php require('../Database/esc_Clearance.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearance Student</title>
    <link rel="stylesheet" href="../Style/Student_Clearance.css">
    <style>
       
        @media screen and (max-width: 400px) {
            h4 {
                font-size: 14px;
            }

            .download div:nth-child(2) {
                margin-top:10px;
            }

            * {
                font-size: 12px;
            }

            #drop_image {
                width: 90%;
            }
            
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="download" action="clearance.php" method="post">
            <div>
                <h4>Senior High School Clearance Form</h4>
                <button type="submit" name="department" value="1">Download</button>
            </div>
            <div>
                <h4>College Clearance Form</h4>
                <button type="submit" name="department" value="2">Download</button>
            </div>
        </form>

        <form class="upload" action="../Database/esc_Clearance.php" method="post" enctype="multipart/form-data">
            <label for="input_file" id="drop_image">
                <div class="image_view">
                    <img src="../Images/bx-cloud-upload.svg" alt="upload" class="filter-blue">
                    <p id="file_name">Browse File To Upload</p>
                </div>
                <input type="file" name="clearance_form" id="input_file" hidden>
            </label>
            <button type="submit" name="submit">Submit</button>
        </form>    
    </div>

    <script>
    document.getElementById('input_file').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('file_name').textContent = fileName;
    });
</script>
    
</body>
</html>
