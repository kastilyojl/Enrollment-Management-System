<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include '../../../../connection.php';

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

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/multi.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2>Add Course</h2>
                <button class="view-all-button" onclick="viewAll()">View All</button>
            </div>

            <form id="myForm" action="../PROCESS/2_course-process-c.php" method="post">
                <div class="form-section">
                    <div class="form-row">
                        <label for="subj_dept"><strong>*Department:</strong></label>
                        <select id="subj_dept" name="subj_dept" required onchange="updateYearLevelOptions()">
                            <option value="" disabled hidden selected>Select a department</option>
                            <option value="SHS">SHS</option>
                            <option value="COLLEGE">COLLEGE</option>
                        </select>

                        <label for="prog_code"><strong>*Program Code:</strong></label>
                        <select id="prog_code" name="prog_code" required>
                            <option value="" disabled hidden selected>Select a program code</option>
                            <?php foreach ($prog_codes as $code) : ?>
                                <option value="<?= $code ?>"><?= $code ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="subj_ylvl"><strong>*Year-Level:</strong></label>
                        <select id="subj_ylvl" name="subj_ylvl" required>
                            <option value="" disabled hidden selected>Select year-level</option>
                        </select>

                        <label for="subj_sem"><strong>*Semester:</strong></label>
                        <select id="subj_sem" name="subj_sem" required>
                            <option value="" disabled hidden selected>Select a department</option>
                            <option value="1ST">1ST SEMESTER</option>
                            <option value="2ND">2ND SEMESTER</option>
                        </select>
                    </div>
                </div>

                <div class="form-section">
                    <table>
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Course Name</th>
                                <th>Lec</th>
                                <th>Lab</th>
                                <th>Total Minutes</th>
                            </tr>
                        </thead>
                        <tbody id="d_subject">
                            <!-- Inside <tbody id="d_subject"> -->
                            <tr>
                                <td><input type="text" name="subjects[0][subj_code]" /></td>
                                <td><input type="text" name="subjects[0][subj_title]" /></td>
                                <td><input type="number" name="subjects[0][subj_units]" /></td>
                                <td><input type="number" name="subjects[0][subj_Labunits]" /></td>
                                <td><input type="number" name="subjects[0][subj_total_minutes]" /></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-buttons">
                        <button type="button" onclick="addRow()">Add</button>
                        <button type="button" onclick="removeRow()">Remove</button>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-action-buttons">
                        <button type="button" onclick="saveData()">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <script src="../JS/2_course-c.js"></script>
</body>

</html>