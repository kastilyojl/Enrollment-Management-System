<?php
include '../../../public/Enrollment_v3/Database/MySql/db.php';

$ReadOnly = true;
$Required = true;

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

$prog_dept = isset($_GET['prog_dept']) ? $_GET['prog_dept'] : '';
$prog_code = isset($_GET['prog_code']) ? $_GET['prog_code'] : '';
$t_code = isset($_GET['t_code']) ? $_GET['t_code'] : '';
$t_cat = isset($_GET['t_cat']) ? $_GET['t_cat'] : '';
$t_famt = isset($_GET['t_famt']) ? $_GET['t_famt'] : '';
$t_inst = isset($_GET['t_inst']) ? $_GET['t_inst'] : '';
$t_pre = isset($_GET['t_pre']) ? $_GET['t_pre'] : '';
$t_mid = isset($_GET['t_mid']) ? $_GET['t_mid'] : '';
$t_fin = isset($_GET['t_fin']) ? $_GET['t_fin'] : '';

$stmt->close();
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tuition</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../../1_superadmin/gen-setup/CSS/cu.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Update Tuition</h2>
            <button class="back-all-button" onclick="backAll()">Back</button>
        </div>
        <form action="../PROCESS/5_tuition-process-u.php" method="post">
            <div class="form-section">
                <div class="form-row">
                    <label for="prog_dept"><strong>*Department:</strong></label>
                    <select id="prog_dept" name="prog_dept" <?php if ($Required) echo 'required'; ?>>
                        <option value="" disabled hidden>Select a department</option>
                        <option value="SHS" <?php if ($prog_dept == 'SHS') echo 'selected'; ?>>SHS</option>
                        <option value="COLLEGE" <?php if ($prog_dept == 'COLLEGE') echo 'selected'; ?>>College</option>
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
                    <label for="t_code"><strong>*Code:</strong></label>
                    <input type="text" id="t_code" name="t_code" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t_code); ?>">
                </div>

                <div class="form-row">
                    <label for="t_cat"><strong>*Category:</strong></label>
                    <input type="text" id="t_cat" name="t_cat" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t_cat); ?>">
                </div>

                <div class="form-row">
                    <label for="t_famt"><strong>*Full Amount:</strong></label>
                    <input type="number" id="t_famt" name="t_famt" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t_famt); ?>">
                </div>

                <div class="form-row">
                    <label for="t_inst"><strong>*Installment Downpayment:</strong></label>
                    <input type="number" id="t_inst" name="t_inst" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t_inst); ?>">
                </div>

                <div class="form-row">
                    <label for="t_pre"><strong>*Prelims:</strong></label>
                    <input type="number" id="t_pre" name="t_pre" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t_pre); ?>">
                </div>

                <div class="form-row">
                    <label for="t_mid"><strong>*Midterms:</strong></label>
                    <input type="number" id="t_mid" name="t_mid" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t_mid); ?>">
                </div>

                <div class="form-row">
                    <label for="t_fin"><strong>*Finals:</strong></label>
                    <input type="number" id="t_fin" name="t_fin" <?php if ($Required) echo 'required'; ?> value="<?php echo htmlspecialchars($t_fin); ?>">
                </div>
            </div>
            <div class="form-section">
                <div class="form-action-buttons">
                    <input type="submit" value="Update">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../JS/5_tuition-u.js"></script>

</html>