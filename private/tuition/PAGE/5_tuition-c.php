<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include '../../../public/Enrollment_v3/Database/MySql/db.php';

// Fetch program codes from the database securely using prepared statements
$prog_codes = [];
$sql = "SELECT prog_code FROM d_program";
$stmt = $connection->prepare($sql);
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
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tuition Plans</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../../1_superadmin/gen-setup/CSS/multi.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2>Add Tuition Plans</h2>
                <button class="view-all-button" onclick="viewAll()">View All</button>
            </div>

            <form id="myForm" action="../PROCESS/5_tuition-process-c.php" method="post">
                <div class="form-section">
                    <div class="form-row">
                        <label for="prog_dept"><strong>*Department:</strong></label>
                        <select id="prog_dept" name="prog_dept" required>
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

                    </div>
                </div>

                <div class="form-section">
                    <table>
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Full Amount</th>
                                <th>Installment Downpayment</th>
                                <th>Prelims</th>
                                <th>Midterms</th>
                                <th>Finals</th>
                            </tr>
                        </thead>
                        <tbody id="d_tuitions">
                            <tr>
                                <td><input type="text" name="tuitions[0][t_code]" /></td>
                                <td><input type="text" name="tuitions[0][t_cat]" /></td>
                                <td><input type="number" name="tuitions[0][t_famt]" /></td>
                                <td><input type="number" name="tuitions[0][t_inst]" /></td>
                                <td><input type="number" name="tuitions[0][t_pre]" /></td>
                                <td><input type="number" name="tuitions[0][t_mid]" /></td>
                                <td><input type="number" name="tuitions[0][t_fin]" /></td>
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
    <script src="../JS/5_tuition-c.js"></script>
</body>

</html>