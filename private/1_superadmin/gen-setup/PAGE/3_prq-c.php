<?php
$Required = true;
$ReadOnly = true;

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection
include '../../../../connection.php';


// Fetch program codes from the database securely using prepared statements
$subj_codes = [];
$sql = "SELECT subj_code FROM d_subject";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subj_codes[] = htmlspecialchars($row['subj_code']);
    }
} else {
    echo "0 results";
}
// After fetching data from the database
// print_r($subj_codes);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prerequisite/s</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/multi.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2>Add Prerequisite/s</h2>
                <button class="view-all-button" onclick="viewAll()">View All</button>
            </div>

            <form id="myForm" action="../PROCESS/3_prq-process-c.php" method="post">
                <div class="form-section">
                    <div class="form-row">
                        <label for="subj_code"><strong>*Course Code:</strong></label>
                        <select id="subj_code" name="subj_code" required onchange="updateCourseName()">
                            <option value="" disabled hidden selected>Select a course code</option>
                            <?php foreach ($subj_codes as $code) : ?>
                                <option value="<?= $code ?>"><?= $code ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="subj_title">Course Name:</label>
                        <input type="text" id="subj_title" name="subj_title" readonly>
                    </div>
                </div>

                <div class="form-section">
                    <table>
                        <thead>
                            <tr>
                                <th>Prerequisite Code</th>
                                <th>Prerequisite Name</th>
                            </tr>
                        </thead>
                        <tbody id="d_prq">
                            <tr>
                                <td>
                                    <select name="prerequisites[0][prq_code]" required onchange="updatePrqName(this)">
                                        <option value="" disabled hidden selected>Select a course code</option>
                                        <?php foreach ($subj_codes as $code) : ?>
                                            <option value="<?= $code ?>"><?= $code ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><input type="text" name="prerequisites[0][prq_title]" readonly></td>
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
</body>
<script src="../JS/3_prq-c.js"></script>
<script>
    function updateCourseName() {
        const subj_code = $('#subj_code').val();
        if (subj_code) {
            $.ajax({
                type: 'POST',
                url: '../PROCESS/3_prq-process-c.php',
                data: {
                    subj_code: subj_code
                },
                success: function(response) {
                    $('#subj_title').val(response);
                }
            });
        }
    }

    function updatePrqName(selectElement) {
        const prq_code = $(selectElement).val();
        const subj_code = $('#subj_code').val();
        const prq_title_input = $(selectElement).closest('tr').find('input[name^="prerequisites["][name$="[prq_title]"]');

        if (prq_code === subj_code) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'You cannot add a prerequisite that is the same as the course code.',
            });
            $(selectElement).val('');
            prq_title_input.val('');
            return;
        }

        if (prq_code) {
            $.ajax({
                type: 'POST',
                url: '../PROCESS/3_prq-process-c.php',
                data: {
                    subj_code: prq_code
                },
                success: function(response) {
                    prq_title_input.val(response);
                }
            });
        }
    }


    function addRow() {
        const rowCount = $('#d_prq tr').length;
        const newRow = `<tr>
        <td>
            <select id="prq_code_${rowCount}" name="prerequisites[${rowCount}][prq_code]" required onchange="updatePrqName(this)">
                <option value="" disabled hidden selected>Select a course code</option>
                <?php foreach ($subj_codes as $code) : ?>
                    <option value="<?= $code ?>"><?= $code ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <input type="text" id="prq_title_${rowCount}" name="prerequisites[${rowCount}][prq_title]" readonly>
        </td>
    </tr>`;
        $('#d_prq').append(newRow);
    }


    function removeRow() {
        if ($('#d_prq tr').length > 1) {
            $('#d_prq tr:last').remove();
        }
    }
</script>

</html>