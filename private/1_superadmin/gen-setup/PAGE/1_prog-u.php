<?php
$ReadOnly = true;
$Required = true;

$id = isset($_GET['id']) ? $_GET['id'] : '';
$prog_code = isset($_GET['prog_code']) ? $_GET['prog_code'] : '';
$prog_title = isset($_GET['prog_title']) ? $_GET['prog_title'] : '';
$prog_dept = isset($_GET['prog_dept']) ? $_GET['prog_dept'] : '';
$prog_yrs = isset($_GET['prog_yrs']) ? $_GET['prog_yrs'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Program</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/cu.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Update Program</h2>
            <button class="back-all-button" onclick="backAll()">Back</button>
        </div>
        <form action="../PROCESS/1_prog-process-u.php" method="post">
            <div class="form-section">
                <div class="form-row">
                    <label for="prog_dept"><strong>*Department:</strong></label>
                    <select id="prog_dept" name="prog_dept" <?php if ($Required) echo 'required'; ?>>
                        <option value="" disabled hidden>Select a department</option>
                        <option value="SHS" <?php if ($prog_dept == 'SHS') echo 'selected'; ?>>SHS</option>
                        <option value="COLLEGE" <?php if ($prog_dept == 'COLLEGE') echo 'selected'; ?>>COLLEGE</option>
                    </select>
                </div>
                <div class="form-row">
                    <input type="hidden" id="id" name="id" <?php if ($ReadOnly) echo 'readonly'; ?> value="<?php echo htmlspecialchars($id); ?>">
                    <label for="prog_code"><strong>*Code:</strong></label>
                    <input type="text" id="prog_code" name="prog_code" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($prog_code); ?>">
                </div>
                <div class="form-row">
                    <label for="prog_title"><strong>*Name:</strong></label>
                    <input type="text" id="prog_title" name="prog_title" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($prog_title); ?>">
                </div>
                <div class="form-row">
                    <label for="prog_yrs"><strong>*Years:</strong></label>
                    <select id="prog_yrs" name="prog_yrs" <?php if ($Required) echo 'required'; ?>>
                        <option value="" disabled hidden>Select a duration</option>
                        <option value="1-year" <?php if ($prog_yrs == '1-year') echo 'selected'; ?>>1-year</option>
                        <option value="2-years" <?php if ($prog_yrs == '2-years') echo 'selected'; ?>>2-years</option>
                        <option value="4-years" <?php if ($prog_yrs == '4-years') echo 'selected'; ?>>4-years</option>
                    </select>
                </div>
            </div>
            <div class="form-section">
                <div class="form-action-buttons">
                    <input type="submit" value="update">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../JS/1_prog-u.js"></script>

</html>