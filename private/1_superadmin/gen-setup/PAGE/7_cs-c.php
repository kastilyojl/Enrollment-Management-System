<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Enable MySQL error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection
include '../../../../connection.php';

// Fetch student information from the database
$d_studinfo = [];
$sql = "SELECT id_stuInfo, lname, fname, e_mail, dept, str_crs, gy_level, sem FROM d_studinfo WHERE is_Enrolled = 1";
$stmt = $conn->prepare($sql);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $d_studinfo[] = $row;
    }
} else {
    die("Error fetching student information: " . $stmt->error);
}

$stmt->close();

// Function to check if record exists in d_progstud based on id_stuInfo or e_mail
function recordExists($conn, $id_stuInfo, $e_mail)
{
    $sql = "SELECT COUNT(*) as count FROM d_progstud WHERE id_stuInfo = ? OR e_mail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id_stuInfo, $e_mail);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['count'] > 0;
}

// Insert new records into d_progstud if they don't exist
$insert_sql = "INSERT INTO d_progstud (id_stuInfo, lname, fname, e_mail, prog_dept, prog_code, prog_ylvl, sem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);

foreach ($d_studinfo as $row) {
    $id_stuInfo = $row['id_stuInfo'];
    $e_mail = $row['e_mail'];

    if (!recordExists($conn, $id_stuInfo, $e_mail)) {
        // Convert dept to appropriate string
        $prog_dept = ($row['dept'] == 1) ? 'SHS' : (($row['dept'] == 2) ? 'COLLEGE' : 'Unknown');
        $sem = ($row['sem'] == 1) ? '1ST' : (($row['sem'] == 2) ? '2ND' : 'Unknown');

        // Convert gy_level to appropriate string
        switch ($row['gy_level']) {
            case 11:
                $prog_ylvl = 'Grade 11';
                break;
            case 12:
                $prog_ylvl = 'Grade 12';
                break;
            case 1:
                $prog_ylvl = '1st year';
                break;
            case 2:
                $prog_ylvl = '2nd year';
                break;
            case 3:
                $prog_ylvl = '3rd year';
                break;
            case 4:
                $prog_ylvl = '4th year';
                break;
            default:
                $prog_ylvl = 'Unknown';
                break;
        }

        $prog_code = $row['str_crs'];

        $insert_stmt->bind_param("ssssssss", $id_stuInfo, $row['lname'], $row['fname'], $e_mail, $prog_dept, $prog_code, $prog_ylvl, $sem);
        if (!$insert_stmt->execute()) {
            die("Error inserting into d_progstud: " . $insert_stmt->error);
        }
    }
}

// // Function to check if record exists in d_enrollcourses based on id_stuInfo and subj_code
// function recordExists2($conn, $id_stuInfo, $subj_code)
// {
//     $sql = "SELECT COUNT(*) as count FROM d_enrollcourses WHERE id_stuInfo = ? AND subj_code = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("ss", $id_stuInfo, $subj_code);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $row = $result->fetch_assoc();
//     $stmt->close();
//     return $row['count'] > 0;
// }

// Insert new records into d_enrollcourses if they don't exist
$insert_sql = "INSERT INTO d_enrollcourses (id_stuInfo, prog_dept, prog_code, prog_ylvl, sem, subj_code, subj_title, subj_units, subj_Labunits, remarks, cs_action) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);

// Function to check if record exists
function recordExists2($conn, $id_stuInfo, $subj_code)
{
    $check_sql = "SELECT 1 FROM d_enrollcourses WHERE id_stuInfo = ? AND subj_code = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $id_stuInfo, $subj_code);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $exists = $result->num_rows > 0;
    $check_stmt->close();
    return $exists;
}

// Enrollment processing
$remarks = 1; // enrolled
$cs_action = 1; // added
foreach ($d_studinfo as $student) {
    $id_stuInfo = $student['id_stuInfo'];

    // Fetch program data for each student
    $sql = "SELECT prog_dept, prog_code, prog_ylvl, sem FROM d_progstud WHERE id_stuInfo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_stuInfo);
    $stmt->execute();
    $result = $stmt->get_result();
    $program_data = $result->fetch_assoc();
    $stmt->close();

    if ($program_data) {
        $prog_dept = $program_data['prog_dept'];
        $prog_code = $program_data['prog_code'];
        $prog_ylvl = $program_data['prog_ylvl'];
        $sem = $program_data['sem'];

        // Fetch subjects based on program data
        $subjects = [];
        $sql = "SELECT subj_code, subj_title, subj_units, subj_Labunits FROM d_subject WHERE prog_code = ? AND subj_ylvl = ? AND subj_sem = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $prog_code, $prog_ylvl, $sem);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
        $stmt->close();

        // Insert subjects into d_enrollcourses
        foreach ($subjects as $subject) {
            $subj_code = $subject['subj_code'];
            $subj_title = $subject['subj_title'];
            $subj_units = $subject['subj_units'];
            $subj_Labunits = $subject['subj_Labunits'];

            if (!recordExists2($conn, $id_stuInfo, $subj_code)) {
                $insert_stmt->bind_param("sssssssssss", $id_stuInfo, $prog_dept, $prog_code, $prog_ylvl, $sem, $subj_code, $subj_title, $subj_units, $subj_Labunits, $remarks, $cs_action);
                if (!$insert_stmt->execute()) {
                    die("Error inserting into d_enrollcourses: " . $insert_stmt->error);
                }
            }
        }
    } else {
        die("Error: No program data found for id_stuInfo $id_stuInfo.");
    }
}

// For remarks = 0, cs_action = 0
$insert_sql = "INSERT INTO d_enrollcourses (id_stuInfo, prog_dept, prog_code, prog_ylvl, sem, subj_code, subj_title, subj_units, subj_Labunits, remarks, cs_action) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$remarks = 0; // not enrolled
$cs_action = 0; // remove

foreach ($d_studinfo as $student) {
    $id_stuInfo = $student['id_stuInfo'];

    // Fetch program data for each student
    $sql = "SELECT prog_dept, prog_code, sem FROM d_progstud WHERE id_stuInfo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_stuInfo);
    $stmt->execute();
    $result = $stmt->get_result();
    $program_data = $result->fetch_assoc();
    $stmt->close();

    if ($program_data) {
        $prog_dept = $program_data['prog_dept'];
        $prog_code = $program_data['prog_code'];
        $sem = $program_data['sem'];

        // Fetch subjects based on program data
        $subjects = [];
        $sql = "SELECT subj_code, subj_ylvl, subj_title, subj_units, subj_Labunits FROM d_subject WHERE prog_code = ? AND subj_sem = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $prog_code, $sem);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
        $stmt->close();

        // Insert subjects into d_enrollcourses
        foreach ($subjects as $subject) {
            $subj_code = $subject['subj_code'];
            $subj_ylvl = $subject['subj_ylvl'];
            $subj_title = $subject['subj_title'];
            $subj_units = $subject['subj_units'];
            $subj_Labunits = $subject['subj_Labunits'];

            if (!recordExists2($conn, $id_stuInfo, $subj_code)) {
                $insert_stmt->bind_param("sssssssssss", $id_stuInfo, $prog_dept, $prog_code, $subj_ylvl, $sem, $subj_code, $subj_title, $subj_units, $subj_Labunits, $remarks, $cs_action);
                if (!$insert_stmt->execute()) {
                    die("Error inserting into d_enrollcourses: " . $insert_stmt->error);
                }
            }
        }
    } else {
        die("Error: No program data found for id_stuInfo $id_stuInfo.");
    }
}

$insert_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student & Enrolled Program Table</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/rd.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="name">Student & Enrolled Program Table</h2>
        <form id="search-form" class="form-container" onsubmit="return false;">
            <input type="text" class="input-box" id="search-box" name="query" placeholder="Search...">
        </form>
        <div class="table-container">
            <table class="t-content" id="progstud-table">
                <thead>
                    <tr>
                        <th>Id No.</th>
                        <th>Surname</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Program</th>
                        <th>Year-Level</th>
                        <th>Semester</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php if (empty($d_studinfo)) : ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">No record found.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($d_studinfo as $row) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id_stuInfo']); ?></td>
                                <td><?php echo htmlspecialchars($row['lname']); ?></td>
                                <td><?php echo htmlspecialchars($row['fname']); ?></td>
                                <td><?php echo htmlspecialchars($row['e_mail']); ?></td>
                                <td>
                                    <?php
                                    echo ($row['dept'] == 1) ? 'SHS' : (($row['dept'] == 2) ? 'COLLEGE' : 'Unknown');
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['str_crs']); ?></td>
                                <td>
                                    <?php
                                    switch ($row['gy_level']) {
                                        case 11:
                                            echo 'Grade 11';
                                            break;
                                        case 12:
                                            echo 'Grade 12';
                                            break;
                                        case 1:
                                            echo '1st year';
                                            break;
                                        case 2:
                                            echo '2nd year';
                                            break;
                                        case 3:
                                            echo '3rd year';
                                            break;
                                        case 4:
                                            echo '4th year';
                                            break;
                                        default:
                                            echo 'Unknown';
                                            break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo ($row['sem'] == 1) ? '1ST' : (($row['sem'] == 2) ? '2ND' : 'Unknown');
                                    ?>
                                </td>
                                <td>
                                    <form action="../PROCESS/7_cs-process-c.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_stuInfo" value="<?php echo htmlspecialchars($row['id_stuInfo']); ?>">
                                        <button type="submit" name="check">Check</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            <button id="prevPage">Previous</button>
            <span id="pageNum"></span>
            <button id="nextPage">Next</button>
        </div>
        <div>
            <button>update</button>
        </div>
    </div>
</body>
<script src="../JS/7_cs-c.js"></script>

</html>