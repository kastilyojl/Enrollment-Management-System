<?php
include '../../../../connection.php';

// Fetch data
$id_stuInfo = isset($_GET['id_stuInfo']) ? $_GET['id_stuInfo'] : '';
$lname = isset($_GET['lname']) ? $_GET['lname'] : '';
$fname = isset($_GET['fname']) ? $_GET['fname'] : '';
$e_mail = isset($_GET['e_mail']) ? $_GET['e_mail'] : '';
$prog_dept = isset($_GET['prog_dept']) ? $_GET['prog_dept'] : '';
$prog_code = isset($_GET['prog_code']) ? $_GET['prog_code'] : '';
$prog_ylvl = isset($_GET['prog_ylvl']) ? $_GET['prog_ylvl'] : '';
$sem = isset($_GET['sem']) ? $_GET['sem'] : '';

// Function to remove a course
if (isset($_POST['remove'])) {
    $subj_code = $_POST['remove'];
    $remove_sql = "UPDATE d_enrollcourses SET remarks = 0, cs_action = 0 WHERE id_stuInfo = '$id_stuInfo' AND subj_code = '$subj_code'";
    if (!$conn->query($remove_sql)) {
        echo "Error removing course: " . $conn->error;
    }
}

// Function to add a course
if (isset($_POST['add'])) {
    $subj_code = $_POST['add'];
    $add_sql = "UPDATE d_enrollcourses SET remarks = 1, cs_action = 1 WHERE id_stuInfo = '$id_stuInfo' AND subj_code = '$subj_code'";
    if (!$conn->query($add_sql)) {
        echo "Error adding course: " . $conn->error;
    }
}

// Fetch enrolled courses
$enrolled_courses = [];
$enrolled_sql = "SELECT subj_code, subj_title, subj_units, subj_Labunits FROM d_enrollcourses WHERE id_stuInfo = '$id_stuInfo' AND remarks = 1 AND cs_action = 1";
if ($enrolled_result = $conn->query($enrolled_sql)) {
    while ($enrolled_row = $enrolled_result->fetch_assoc()) {
        $enrolled_courses[] = $enrolled_row;
    }
    $enrolled_result->free();
} else {
    echo "Error fetching enrolled courses: " . $conn->error;
}

// Fetch available courses
$available_courses = [];
$available_sql = "SELECT subj_code, subj_title, subj_units, subj_Labunits FROM d_enrollcourses WHERE prog_dept = '$prog_dept' AND prog_code = '$prog_code' AND sem = '$sem' AND remarks = 0 AND cs_action = 0";
if ($available_result = $conn->query($available_sql)) {
    while ($available_row = $available_result->fetch_assoc()) {
        $available_courses[] = $available_row;
    }
    $available_result->free();
} else {
    echo "Error fetching available courses: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Selection</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/cs.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="button">
        <button class="back-all-button" onclick="backAll()">Back</button>
    </div>
    <div class="form-container">
        <div class="form-header">
            <h2>Student Information</h2>
        </div>
        <div class="info-card">
            <p>
                <span>Id No.: <?php echo htmlspecialchars($id_stuInfo); ?></span>
                <span>Name: <?php echo htmlspecialchars($lname); ?>, <?php echo htmlspecialchars($fname); ?></span>
                <span>Email: <?php echo htmlspecialchars($e_mail); ?></span>
            </p>
            <p>
                <span>Department: <?php echo htmlspecialchars($prog_dept); ?></span>
                <span>Program: <?php echo htmlspecialchars($prog_code); ?></span>
                <span>Year-Level: <?php echo htmlspecialchars($prog_ylvl); ?></span>
                <span>Semester: <?php echo htmlspecialchars($sem); ?></span>
            </p>
        </div>
    </div>

    <div class="tables-container">
        <div class="table-wrapper">
            <div class="form-header">
                <h2>Enrolled Courses</h2>
            </div>
            <div class="table-container" id="enrolled-courses-container">
                <table class="t-content" id="enrolled-course-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Course Name</th>
                            <th>Lec</th>
                            <th>Lab</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($enrolled_courses as $row) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['subj_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_units']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_Labunits']); ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="remove" value="<?php echo htmlspecialchars($row['subj_code']); ?>">
                                        <button type="submit">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <button id="prev-enrolled" onclick="prevPage('enrolled')">Previous</button>
                <button id="next-enrolled" onclick="nextPage('enrolled')">Next</button>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="form-header">
                <h2>Available Courses</h2>
            </div>
            <div class="table-container" id="available-courses-container">
                <table class="t-content" id="available-course-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Course Name</th>
                            <th>Lec</th>
                            <th>Lab</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($available_courses as $row) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['subj_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_units']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_Labunits']); ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="add" value="<?php echo htmlspecialchars($row['subj_code']); ?>">
                                        <button type="submit">Add</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <button id="prev-available" onclick="prevPage('available')">Previous</button>
                <button id="next-available" onclick="nextPage('available')">Next</button>
            </div>
        </div>
    </div>

    <script>
        const rowsPerPage = 5;
        let enrolledCurrentPage = 1;
        let availableCurrentPage = 1;

        function paginateTable(tableId, page) {
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            const totalPages = Math.ceil(rows.length / rowsPerPage);

            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = 'none';
            }

            for (let i = (page - 1) * rowsPerPage; i < page * rowsPerPage && i < rows.length; i++) {
                rows[i].style.display = '';
            }

            document.getElementById(`prev-${tableId.split('-')[0]}`).disabled = page === 1;
            document.getElementById(`next-${tableId.split('-')[0]}`).disabled = page === totalPages;
        }

        function prevPage(type) {
            if (type === 'enrolled' && enrolledCurrentPage > 1) {
                enrolledCurrentPage--;
                paginateTable('enrolled-course-table', enrolledCurrentPage);
            } else if (type === 'available' && availableCurrentPage > 1) {
                availableCurrentPage--;
                paginateTable('available-course-table', availableCurrentPage);
            }
        }

        function nextPage(type) {
            if (type === 'enrolled' && enrolledCurrentPage < Math.ceil(document.getElementById('enrolled-course-table').getElementsByTagName('tbody')[0].getElementsByTagName('tr').length / rowsPerPage)) {
                enrolledCurrentPage++;
                paginateTable('enrolled-course-table', enrolledCurrentPage);
            } else if (type === 'available' && availableCurrentPage < Math.ceil(document.getElementById('available-course-table').getElementsByTagName('tbody')[0].getElementsByTagName('tr').length / rowsPerPage)) {
                availableCurrentPage++;
                paginateTable('available-course-table', availableCurrentPage);
            }
        }

        window.onload = function() {
            paginateTable('enrolled-course-table', enrolledCurrentPage);
            paginateTable('available-course-table', availableCurrentPage);
        };
    </script>
</body>

</html>