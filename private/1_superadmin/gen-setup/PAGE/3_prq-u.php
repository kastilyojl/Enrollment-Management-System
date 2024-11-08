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
    <div class="form-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2>View Prerequisite/s</h2>
                <button class="view-all-button" onclick="viewAll()">View All</button>
            </div>
            <div class="form-section">
                <div class="form-row">
                    <label for="subj_code"><strong>Course Code:</strong></label>
                    <input type="text" id="subj_code" readonly>
                    <label for="subj_title">Course Name:</label>
                    <input type="text" id="subj_title" readonly>
                </div>
            </div>

            <div class="form-section">
                <table>
                    <thead>
                        <tr>
                            <th>Prerequisite Code</th>
                            <th>Prerequisite Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="d_prq">
                        <!-- Dynamic rows will be added here -->
                    </tbody>
                </table>
                <div class="form-buttons">
                    <button type="button" onclick="previousProgram()">Previous</button>
                    <button type="button" onclick="nextProgram()">Next</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../JS/3_prq-rd.js"></script>
</body>

</html>