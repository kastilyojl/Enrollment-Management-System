<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirements - SHS</title>
    <link rel="stylesheet" href="../Style/Admission_Form.css">
</head>
<body class="<?php echo $dept; ?>">

<div class="container">
    <div class="header">
        <h3>Requirements</h3>
    </div>
    <form class="form" action="../Database/asc_Student.php" method="post" enctype="multipart/form-data">
        <div class="content" id="college">
            <h4>College Requirements</h4>
            <!-- Your college content here -->
        </div>

        <div class="content" id="shs">
            <h4>SHS Requirements</h4>
            <!-- Your SHS content here -->
        </div>
    </form>
</div>

<script>
    // Use PHP to echo the value of $dept into JavaScript
    var dept = "<?php echo $dept; ?>";
    console.log("Department:", dept);

    // Hide the appropriate content based on $dept value
    if (dept == 2) {
        document.getElementById("shs").style.display = "none";
        console.log("Hiding SHS content");
    } else if (dept == 1) {
        document.getElementById("college").style.display = "none";
        console.log("Hiding College content");
    }
</script>

<script src="../Javascript/Admission_Form"></script>

</body>
</html>
