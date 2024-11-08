<?php require('../Database/erCB_Clearance.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearance Admin</title>
    <link rel="stylesheet" href="../Style/Admin_Clearance.css">
</head>
<body>

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Senior High School</h2>
            <label for="input_file" id="drop_image">
                <div class="image_view">
                    <img src="../Images/bx-cloud-upload.svg" alt="upload" class="filter-blue">
                    <p id="file_name">Browse File To Upload</p>
                </div>
                <input type="file" name="clearanceshs" id="input_file" hidden>
            </label>
            <button type="submit" name="submit1">Submit</button>
        </form>

            <form action="" method="post" enctype="multipart/form-data">
                <h2>College</h2>
                <label for="input_file1" id="drop_image">
                    <div class="image_view">
                        <img src="../Images/bx-cloud-upload.svg" style="fill: red;" alt="upload" class="filter-blue">
                        <p id="file_name1">Browse File To Upload</p>
                    </div>
                    <input type="file" name="clearancecollege" id="input_file1" hidden>
                </label>
                <button type="submit" name="submit2">Submit</button>
            </form>
    </div>

    <script>
    document.getElementById('input_file').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('file_name').textContent = fileName;
    });

    document.getElementById('input_file1').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('file_name1').textContent = fileName;
    });
</script>

</body>
</html>