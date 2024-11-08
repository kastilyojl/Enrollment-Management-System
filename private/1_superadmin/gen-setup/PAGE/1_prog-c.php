<?php
// Restrict settings
$ReadOnly = true;
$Required = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Program/Strand</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/cu.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-container">
        <!-- Form Header with View All Button -->
        <div class="form-header">
            <h2>Add Program/Strand</h2>
            <button class="view-all-button" onclick="viewAll()">View All</button>
        </div>

        <!-- Form for Program Setup -->
        <form id="myForm" action="../PROCESS/1_prog-process-c.php" method="post">
            <!-- Program Information -->
            <div class="form-section">
                <div class="form-row">
                    <label for="prog_dept"><strong>*Department:</strong></label>
                    <select id="prog_dept" name="prog_dept" <?php if ($Required) echo 'required'; ?>>
                        <option value="" <?php if (!isset($_POST['prog_dept']) || $_POST['prog_dept'] == '') echo 'selected'; ?> disabled hidden>Select a department</option>
                        <option value="SHS">SHS</option>
                        <option value="COLLEGE">COLLEGE</option>
                    </select>
                </div>
                <div class="form-row">
                    <label for="prog_code"><strong>*Program Code:</strong></label>
                    <input type="text" id="prog_code" name="prog_code" <?php if ($Required) echo 'required'; ?>>
                </div>
                <div class="form-row">
                    <label for="prog_title"><strong>*Program Name:</strong></label>
                    <input type="text" id="prog_title" name="prog_title" <?php if ($Required) echo 'required'; ?>>
                </div>
                <div class="form-row">
                    <label for="prog_yrs"><strong>*Years:</strong></label>
                    <select id="prog_yrs" name="prog_yrs" <?php if ($Required) echo 'required'; ?>>
                        <option value="" <?php if (!isset($_POST['prog_yrs']) || $_POST['prog_yrs'] == '0') echo 'selected'; ?> disabled hidden>Select a duration</option>
                        <option value="1-year">1-year</option>
                        <option value="2-years">2-years</option>
                        <option value="4-years">4-years</option>
                    </select>
                </div>
            </div>
            <!-- Form Action Buttons -->
            <div class="form-section">
                <div class="form-action-buttons">
                    <input type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../JS/1_prog-c.js"></script>

</html>