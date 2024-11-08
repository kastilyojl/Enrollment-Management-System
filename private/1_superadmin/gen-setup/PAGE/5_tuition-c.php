<?php
$Required = true;
$ReadOnly = true;

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection
include '../../../../connection.php';


// Fetch program titles from the database securely using prepared statements
$subj_titles = [];
$sql = "SELECT subj_title FROM d_subject WHERE subj_ylvl ='Grade 11' OR subj_ylvl ='Grade 12'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subj_titles[] = htmlspecialchars($row['subj_title']);
    }
} 
// After fetching data from the database
// print_r($subj_titles);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Educational Fees Tables</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/tuition.css">
    <script src="../JS/5_tuitionPlans.js"></script>
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <!-- Table 1: Academic Tracks -->
    <form id="myForm" action="../PROCESS/5_tuition-process-c.php" method="post">
        <h2>Academic Tracks</h2>
        <table id="academicTracksTable1">
            <caption>First row is an example with prices in Philippine Pesos (₱)</caption>
            <thead>
                <tr>
                    <th rowspan="2">Strand</th>
                    <th colspan="2">Grade 11/YR (PAYEE)</th>
                    <th colspan="2">Grade 12/YR (PAYEE)</th>
                    <th colspan="2">SHS Voucher Grantee (Grade 11)</th>
                    <th colspan="2">SHS ESC & Non-ESC Grantee (Grade 11)</th>
                </tr>
                <tr>
                    <th>Cash (Discounted)</th>
                    <th>Down Payment (Installment)</th>
                    <th>Cash (Discounted)</th>
                    <th>Down Payment (Installment)</th>
                    <th>Voucher Amount</th>
                    <th>One-Time Fee</th>
                    <th>Voucher Amount</th>
                    <th>Down Payment</th>
                </tr>
            </thead>
            <tbody id="d_tuition">
                <tr>
                    <td>
                        <select name="tuition[0][prq_title]" required onchange="updatePrqName(this)">
                            <option value="" disabled hidden selected>Select a strand</option>
                            <?php foreach ($subj_codes as $code) : ?>
                                <option value="<?= $code ?>"><?= $code ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="text" name="prerequisites[0][prq_title]" readonly></td>
                </tr>
            </tbody>
        </table>
        <br>
        <!-- Buttons for Table 1 -->
        <div>
            <button type="button" onclick="addRow('academicTracksTable1')">Add New Row</button>
            <button type="button" onclick="removeLastRow('academicTracksTable1')">Remove Last Row</button>
            <button type="button" onclick="saveTable('academicTracksTable1')">Save</button> <!-- Save button -->
        </div>
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Table 2: Technical Vocational Livelihood Tracks -->
    <div>
        <h2>Technical Vocational Livelihood Tracks</h2>
        <table id="academicTracksTable2"> <!-- New table ID -->
            <caption>First row is an example with prices in Philippine Pesos (₱)</caption>
            <thead>
                <tr>
                    <th rowspan="2">Strand</th>
                    <th colspan="2">Grade 11/YR (PAYEE)</th>
                    <th colspan="2">Grade 12/YR (PAYEE)</th>
                    <th colspan="2">SHS Voucher Grantee (Grade 11)</th>
                    <th colspan="2">SHS ESC & Non-ESC Grantee (Grade 11)</th>
                </tr>
                <tr>
                    <th>Cash (Discounted)</th>
                    <th>Down Payment (Installment)</th>
                    <th>Cash (Discounted)</th>
                    <th>Down Payment (Installment)</th>
                    <th>Voucher Amount</th>
                    <th>One-Time Fee</th>
                    <th>Voucher Amount</th>
                    <th>Down Payment</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>Home Economics (HE)</td>
                    <td>₱400</td>
                    <td>₱90</td>
                    <td>₱500</td>
                    <td>₱120</td>
                    <td>₱7,000</td>
                    <td>₱250</td>
                    <td>₱5,000</td>
                    <td>₱200</td>
                </tr>
            </tbody>
        </table>
        <br>
        <!-- Buttons for Table 2 -->
        <div>
            <button type="button" onclick="addRow('academicTracksTable2')">Add New Row</button>
            <button type="button" onclick="removeLastRow('academicTracksTable2')">Remove Last Row</button>
            <button type="button" onclick="saveTable('academicTracksTable2')">Save</button> <!-- Save button -->
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Table 3: Not Covered by DepEd SHS Voucher -->
    <div>
        <h2>Not Covered by DepEd SHS Voucher</h2>
        <table id="notCoveredTable"> <!-- Check the table ID -->
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount</th>
                    <th>Instruction</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>Official School ID</td>
                    <td>₱150</td>
                    <td>Required to pay upon enrollment</td>
                </tr>
            </tbody>
        </table>

        <!-- Buttons for Table 3 -->
        <div>
            <button type="button" onclick="addRow('notCoveredTable')">Add New Row</button> <!-- Correct table ID -->
            <button type="button" onclick="removeLastRow('notCoveredTable')">Remove Last Row</button>
            <!-- Correct table ID -->
            <button type="button" onclick="saveTable('notCoveredTable')">Save</button> <!-- Correct table ID -->
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Table 4: Colleges Tuition Fees -->
    <div>
        <h2>Colleges Tuition Fees</h2> <!-- Table name -->
        <table id="collegesTuitionFeesTable"> <!-- New table -->
            <thead>
                <tr>
                    <th>Program</th> <!-- Column 1 -->
                    <th>No. of Units</th> <!-- Column 2 -->
                    <th>Per Unit</th> <!-- Column 3 -->
                    <th>Total Fees</th> <!-- Column 4 -->
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>BS Computer Science</td>
                    <td>20</td>
                    <td>₱405</td>
                    <td>₱8,100</td>
                </tr>
            </tbody>
        </table>
        <br>
        <!-- Buttons for Table 4 -->
        <div>
            <button type="button" onclick="addRow('collegesTuitionFeesTable')">Add New Row</button>
            <button type="button" onclick="removeLastRow('collegesTuitionFeesTable')">Remove Last Row</button>
            <button type="button" onclick="saveTable('collegesTuitionFeesTable')">Save</button> <!-- Save button -->
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Table 5: Colleges - Alumni Fees -->
    <div>
        <h2>Colleges - Alumni Fees</h2> <!-- Table name -->
        <table id="collegesAlumniFeesTable">
            <thead>
                <tr>
                    <th>Program</th> <!-- New column -->
                    <th>Discounted Fees</th> <!-- Previous first column -->
                    <th>Down Payment</th> <!-- Column 2 -->
                    <th>Prelims</th> <!-- Column 3 -->
                    <th>Midterms</th> <!-- Column 4 -->
                    <th>Finals</th> <!-- Column 5 -->
                    <th>Total</th> <!-- Column 6 -->
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>BS Computer Science</td> <!-- Program -->
                    <td>less ₱1,800</td> <!-- Discounted Fees -->
                    <td>₱2,000</td> <!-- Down Payment -->
                    <td>₱2,000</td> <!-- Prelims -->
                    <td>₱1,300</td> <!-- Midterms -->
                    <td>₱1,000</td> <!-- Finals -->
                    <td>₱6,300</td> <!-- Total -->
                </tr>
            </tbody>
        </table>
        <br>
        <!-- Buttons for Table 5 -->
        <div>
            <button type="button" onclick="addRow('collegesAlumniFeesTable')">Add New Row</button>
            <button type="button" onclick="removeLastRow('collegesAlumniFeesTable')">Remove Last Row</button>
            <button type="button" onclick="saveTable('collegesAlumniFeesTable')">Save</button> <!-- Save button -->
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Table 6: Colleges - Regular Student Fees -->
    <div>
        <h2>Colleges - Regular Student Fees</h2> <!-- Table name -->
        <table id="collegesRegularStudentFeesTable">
            <thead>
                <tr>
                    <th>Program</th> <!-- New column -->
                    <th>Down Payment</th> <!-- Column 2 -->
                    <th>Prelims</th> <!-- Column 3 -->
                    <th>Midterms</th> <!-- Column 4 -->
                    <th>Finals</th> <!-- Column 5 -->
                    <th>Total</th> <!-- Column 6 -->
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>Information Technology</td> <!-- Program -->
                    <td>₱2,000</td> <!-- Down Payment -->
                    <td>₱2,700</td> <!-- Prelims -->
                    <td>₱2,250</td> <!-- Midterms -->
                    <td>₱2,050</td> <!-- Finals -->
                    <td>₱9,000</td> <!-- Total -->
                </tr>
            </tbody>
        </table>
        <br>
        <!-- Buttons for Table 6 -->
        <div>
            <button type="button" onclick="addRow('collegesRegularStudentFeesTable')">Add New Row</button>
            <button type="button" onclick="removeLastRow('collegesRegularStudentFeesTable')">Remove Last Row</button>
            <button type="button" onclick="saveTable('collegesRegularStudentFeesTable')">Save</button>
            <!-- Save button -->
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Box for "Colleges - Irregular Student Fees" -->
    <div class="info-box">
        <h2>Colleges - Irregular Student Fees</h2>
        <p>Irregular students have variable schedules, often taking a different number of units. Here's an example
            calculation:</p>
        <p>Assume an irregular student takes 15 units in a semester, with each unit costing ₱1,200. The total fee is:
        </p>
        <p><strong>15 units × ₱1,200/unit = ₱18,000</strong></p>
        <p>This is just an example; actual fees may vary based on other factors like additional charges or discounts.
        </p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Table 7: Colleges Other Fees -->
    <div>
        <h2>Colleges - Other Fees</h2>
        <table id="collegesOtherFeesTable"> <!-- Correct table ID -->
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount</th>
                    <th>Instruction</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>Official School ID</td>
                    <td>₱150</td>
                    <td>Required to pay upon enrollment</td>
                </tr>
            </tbody>
        </table>
        <br>
        <!-- Buttons for Table 7 -->
        <div>
            <button type="button" onclick="addRow('collegesOtherFeesTable')">Add New Row</button> <!-- Correct ID -->
            <button type="button" onclick="removeLastRow('collegesOtherFeesTable')">Remove Last Row</button>
            <!-- Correct ID -->
            <button type="button" onclick="saveTable('collegesOtherFeesTable')">Save</button> <!-- Save button -->
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Table 8: Colleges Mandatory Fees -->
    <div>
        <h2>Colleges - Mandatory Fees</h2>
        <table id="collegesMandatoryFeesTable"> <!-- Correct table ID -->
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Amount</th>
                    <th>Instruction</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>Team Building</td>
                    <td>₱1,000</td>
                    <td>(Optional)</td>
                </tr>
            </tbody>
        </table>

        <!-- Buttons for Table 8 -->
        <div>
            <div>
                <button type="button" onclick="addRow('collegesMandatoryFeesTable')">Add New Row</button>
                <!-- Correct ID -->
                <button type="button" onclick="removeLastRow('collegesMandatoryFeesTable')">Remove Last Row</button>
                <!-- Correct ID -->
                <button type="button" onclick="saveTable('collegesMandatoryFeesTable')">Save</button>
                <!-- Save button -->
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</body>