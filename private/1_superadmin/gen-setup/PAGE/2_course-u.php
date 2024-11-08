<?php

include '../../../../connection.php';

$ReadOnly = true;
$Required = true;

// Fetch program codes from the database securely using prepared statements
$prog_codes = [];
$sql = "SELECT prog_code FROM d_program";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prog_codes[] = htmlspecialchars($row['prog_code']);
    }
} else {
    echo "0 results";
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
$prog_code = isset($_GET['prog_code']) ? $_GET['prog_code'] : '';
$subj_code = isset($_GET['subj_code']) ? $_GET['subj_code'] : '';
$subj_title = isset($_GET['subj_title']) ? $_GET['subj_title'] : '';
$subj_units = isset($_GET['subj_units']) ? $_GET['subj_units'] : '';
$subj_Lecunits = isset($_GET['subj_Lecunits']) ? $_GET['subj_Lecunits'] : '';
$subj_Labunits = isset($_GET['subj_Labunits']) ? $_GET['subj_Labunits'] : '';
$subj_total_hours = isset($_GET['subj_total_hours']) ? $_GET['subj_total_hours'] : '';
$subj_dept = isset($_GET['subj_dept']) ? $_GET['subj_dept'] : '';
$subj_ylvl = isset($_GET['subj_ylvl']) ? $_GET['subj_ylvl'] : '';

$stmt->close();
$conn->close();
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
            <h2>Update Course</h2>
            <button class="back-all-button" onclick="backAll()">Back</button>
        </div>
        <form action="../PROCESS/2_course-process-u.php" method="post">
            <div class="form-section">

                <div class="form-row">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <label for="subj_dept"><strong>*Department:</strong></label>
                    <select id="subj_dept" name="subj_dept" <?php if ($Required) echo 'required'; ?>>
                        <option value="" disabled hidden>Select a department</option>
                        <option value="shs" <?php if ($subj_dept == 'shs') echo 'selected'; ?>>SHS</option>
                        <option value="college" <?php if ($subj_dept == 'college') echo 'selected'; ?>>College</option>
                    </select>
                </div>

                <div class="form-row">
                    <label for="prog_code"><strong>*Program Code:</strong></label>
                    <select id="prog_code" name="prog_code" <?php if ($Required) echo 'required'; ?>>
                        <option value="" disabled hidden>Select a program code</option>
                        <?php foreach ($prog_codes as $code) : ?>
                            <option value="<?php echo $code; ?>" <?php if ($prog_code == $code) echo 'selected'; ?>><?php echo $code; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-row">
                    <label for="subj_ylvl"><strong>*Year-Level:</strong></label>
                    <select id="subj_ylvl" name="subj_ylvl" <?php if ($Required) echo 'required'; ?>>
                        <option value="" disabled hidden>Select year-level</option>
                        <option value="Grade 11" <?php if ($subj_ylvl == 'Grade 11') echo 'selected'; ?>>Grade 11</option>
                        <option value="Grade 12" <?php if ($subj_ylvl == 'Grade 12') echo 'selected'; ?>>Grade 12</option>
                        <option value="1st year" <?php if ($subj_ylvl == '1st year') echo 'selected'; ?>>1st Year</option>
                        <option value="2nd year" <?php if ($subj_ylvl == '2nd year') echo 'selected'; ?>>2nd Year</option>
                        <option value="3rd year" <?php if ($subj_ylvl == '3rd year') echo 'selected'; ?>>3rd Year</option>
                        <option value="4th year" <?php if ($subj_ylvl == '4th year') echo 'selected'; ?>>4th Year</option>
                    </select>
                </div>

                <div class="form-row">
                    <label for="subj_code"><strong>*Course Code:</strong></label>
                    <input type="text" id="subj_code" name="subj_code" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($subj_code); ?>">
                </div>

                <div class="form-row">
                    <label for="subj_title"><strong>*Course Name:</strong></label>
                    <input type="text" id="subj_title" name="subj_title" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($subj_title); ?>">
                </div>

                <div class="form-row">
                    <label for="subj_units"><strong>*Units:</strong></label>
                    <input type="number" id="subj_units" name="subj_units" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($subj_units); ?>">
                </div>

                <div class="form-row">
                    <label for="subj_Labunits"><strong>*Lab:</strong></label>
                    <input type="number" id="subj_Labunits" name="subj_Labunits" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($subj_Labunits); ?>">
                </div>

                <div class="form-row">
                    <label for="subj_total_hours"><strong>*Total Minutes:</strong></label>
                    <input type="number" id="subj_total_hours" name="subj_total_hours" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($subj_total_hours); ?>">
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
<script src="../JS/2_course-u.js"></script>

</html>