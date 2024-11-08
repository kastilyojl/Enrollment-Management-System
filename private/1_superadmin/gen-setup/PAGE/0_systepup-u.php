<?php
// Restrict settings
$ReadOnly = true;
$Required = true;

// Fetch data
$id = isset($_GET['id']) ? $_GET['id'] : '';
$sy = isset($_GET['sy']) ? $_GET['sy'] : '';
$sdate_sy = isset($_GET['sdate_sy']) ? $_GET['sdate_sy'] : '';
$edate_sy = isset($_GET['edate_sy']) ? $_GET['edate_sy'] : '';

$t1_acad  = isset($_GET['t1_acad']) ? $_GET['t1_acad'] : '';
$t1_sdate = isset($_GET['t1_sdate']) ? $_GET['t1_sdate'] : '';
$t1_edate = isset($_GET['t1_edate']) ? $_GET['t1_edate'] : '';

$t2_acad  = isset($_GET['t2_acad']) ? $_GET['t2_acad'] : '';
$t2_sdate = isset($_GET['t2_sdate']) ? $_GET['t2_sdate'] : '';
$t2_edate = isset($_GET['t2_edate']) ? $_GET['t2_edate'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update School Year</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/cu.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-container">
        <!-- Form Header with View All Button -->
        <div class="form-header">
            <h2>Update School Year</h2>
            <button class="back-all-button" onclick="backAll()">Back</button>
        </div>

        <!-- Form for Update School Year -->
        <form action="../PROCESS/0_sysetup-process-u.php" method="post">
            <!-- School Year Information -->
            <div class="form-section">
                <div class="form-row">
                    <input type="hidden" id="id" name="id" <?php if ($ReadOnly) echo 'readonly'; ?> value="<?php echo htmlspecialchars($id); ?>">
                    <label for="school-year">School Year:</label>
                    <input type="text" id="school-year" name="school-year" <?php if ($ReadOnly) echo 'readonly'; ?> value="<?php echo htmlspecialchars($sy); ?>">
                </div>
                <div class="form-row">
                    <label for="start-date"><strong>*Start Date:</strong></label>
                    <input type="date" id="start-date" name="start-date" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($sdate_sy); ?>">
                    <label for="end-date"><strong>*End Date:</strong></label>
                    <input type="date" id="end-date" name="end-date" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($edate_sy); ?>">
                </div>
            </div>

            <div class="form-section">
                <div class="form-row">
                    <label for="t1_acad">Semester:</label>
                    <input type="text" id="t1_acad" name="t1_acad" value="1ST" <?php if ($ReadOnly) echo 'readonly'; ?> value="<?php echo htmlspecialchars($t1_acad); ?>">
                </div>
                <div class="form-row">
                    <label for="t1_sdate">Start Date:</label>
                    <input type="date" id="t1_sdate" name="t1_sdate" <?php if ($ReadOnly) echo 'readonly'; ?> value="<?php echo htmlspecialchars($t1_sdate); ?>">
                    <label for="t1_edate"><strong>*End Date:</strong></label>
                    <input type="date" id="t1_edate" name="t1_edate" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t1_edate); ?>">
                </div>
            </div>

            <div class="form-section">
                <div class="form-row">
                    <label for="t2_acad">Semester:</label>
                    <input type="text" id="t2_acad" name="t2_acad" value="2ND" <?php if ($ReadOnly) echo 'readonly'; ?> value="<?php echo htmlspecialchars($t2_acad); ?>">
                </div>
                <div class="form-row">
                    <label for="t2_sdate"><strong>*Start Date:</strong></label>
                    <input type="date" id="t2_sdate" name="t2_sdate" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t2_sdate); ?>">
                    <label for="t2_edate">End Date:</label>
                    <input type="date" id="t2_edate" name="t2_edate" <?php if ($ReadOnly) echo 'readonly'; ?> value="<?php echo htmlspecialchars($t2_edate); ?>">
                </div>
            </div>
            <!-- Form Action Buttons -->
            <div class="form-section">
                <div class="form-action-buttons">
                    <input type="submit" value="update">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../JS/0_sysetup-u.js"></script>

</html>