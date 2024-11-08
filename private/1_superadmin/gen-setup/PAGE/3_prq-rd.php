<?php
include '../../../../connection.php';

// Fetch course and prerequisite details
$query = "SELECT subj_code, subj_title, prq_code, prq_title FROM d_prq";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Initialize variables
$subj_data = array(); // To store subj_code, subj_title, prq_code, and prq_title rows
$current_group = null; // To store the current group of subj_code, subj_title, and their rows

while ($row = $result->fetch_assoc()) {
    $subj_code = $row['subj_code'];
    $subj_title = $row['subj_title'];

    // Check if the current row belongs to the same group or it's a new group
    if (!$current_group || $current_group['subj_code'] !== $subj_code || $current_group['subj_title'] !== $subj_title) {
        // If it's a new group, store the previous group (if exists) and start a new one
        if ($current_group) {
            $subj_data[] = $current_group; // Store the current group
        }
        $current_group = array(
            'subj_code' => $subj_code,
            'subj_title' => $subj_title,
            'prerequisites' => array(), // To store the prerequisites for this group
        );
    }

    // Store the current row as a prerequisite for the current group
    $current_group['prerequisites'][] = array(
        'prq_code' => $row['prq_code'],
        'prq_title' => $row['prq_title'],
    );
}

// Store the last group
if ($current_group) {
    $subj_data[] = $current_group;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Prerequisites</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/multi.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <form action="../PROCESS/3_prq-process-rd.php" method="GET">
        <div class="form-wrapper">
            <div class="form-container">
                <div class="form-section">
                    <div class="form-row">
                        <label for="subj_code"><strong>Course Code:</strong></label>
                        <input type="text" id="subj_code" value="" readonly>
                        <label for="subj_title">Course Name:</label>
                        <input type="text" id="subj_title" value="" readonly>
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
                            <!-- Table body will be populated dynamically -->
                        </tbody>
                    </table>
                    <div class="form-buttons">
                        <button type="button" onclick="previousSubject()">Previous</button>
                        <button type="button" onclick="nextSubject()">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="../JS/3_prq-u.js"></script>

    <script>
        var subjData = <?php echo json_encode($subj_data); ?>;
        var currentGroupIndex = 0;

        function showCurrentGroup() {
            var currentGroup = subjData[currentGroupIndex];
            $("#subj_code").val(currentGroup.subj_code);
            $("#subj_title").val(currentGroup.subj_title);

            // Build the HTML for the prerequisites list
            var html = '';
            currentGroup.prerequisites.forEach(function(prerequisite) {
                html += "<tr><td>" + prerequisite.prq_code + "</td><td>" + prerequisite.prq_title + "</td></tr>";
            });
            $("#d_prq").html(html);
        }

        function previousSubject() {
            if (currentGroupIndex > 0) {
                currentGroupIndex--;
                showCurrentGroup();
            }
        }

        function nextSubject() {
            if (currentGroupIndex < subjData.length - 1) {
                currentGroupIndex++;
                showCurrentGroup();
            }
        }

        $(document).ready(function() {
            showCurrentGroup();
        });
    </script>
</body>

</html>