<?php
session_start();

require('./DSv2/index.php');
require('../Database/db.php');

// Check database connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['id_stuInfo'];
$name = $_SESSION['lname'] . ' ' . $_SESSION['fname'] ?? null;
$yr_lvl = $_SESSION['gy_level'] ?? null;
$str_crs = $_SESSION['str_crs'] ?? null;

// Fetch data from the database
$clearance = fetchSingleValue($connection, "SELECT COUNT(*) FROM d_clearance WHERE id_clearance = ?", 'i', [$id]);
$documents = fetchSingleValue($connection, "SELECT COUNT(*) FROM d_softcopy WHERE id_stuInfo = ?", 'i', [$id]);
$grades = fetchSingleValue($connection, "SELECT COUNT(*) FROM d_grades WHERE name = ? AND track = ? AND grade_lvl = ?", 'sss', [$name, $str_crs, $yr_lvl]);
$cs_status = fetchSingleValue($connection, "SELECT COUNT(*) FROM d_progstud WHERE id_stuInfo = ?", 'i', [$id]);

// $documents = mysqli_query($connection, "SELECT stat FROM d_softcopy WHERE id_stuInfo = '$id'");
// $result = mysqli_fetch_array($documents);
// if ($result['stat'] == 1) {
//     $documents_stat = 1;
// } else if ($result['stat'] == 0) {
//     $documents_stat = 0;
// }

$documents = mysqli_query($connection, "SELECT stat FROM d_softcopy WHERE id_stuInfo = '$id'");
$result = mysqli_fetch_array($documents);
if ($result && isset($result['stat'])) {
    $documents_stat = $result['stat'] == 1 ? 1 : 0;
} else {
    $documents_stat = 0; // Default value if no result
}


// $clearance = mysqli_query($connection, "SELECT stat FROM d_clearance WHERE id_clearance = '$id'");
// $result = mysqli_fetch_array($clearance);
// if ($result['stat'] == 1) {
//     $clearance_stat = 1;
// } else if ($result['stat'] == 0) {
//     $clearance_stat = 0;
// }

$clearance =  mysqli_query($connection, "SELECT stat FROM d_clearance WHERE id_clearance = '$id'");
$result = mysqli_fetch_array($clearance);
if ($result && isset($result['stat'])) {
    $clearance_stat = $result['stat'] == 1 ? 1 : 0;
} else {
    $clearance_stat = 0; // Default value if no result
}


// $cs_status = mysqli_query($connection, "SELECT cs_status FROM d_progstud WHERE id_stuInfo = '$id'");
// $result = mysqli_fetch_array($cs_status);
// if(mysqli_num_rows($result) < 1) {

// } else {
//     if ($result['cs_status'] == 1) {
//         $course_selection_stat = 1;
//     } else if ($result['cs_status'] == 0) {
//         $course_selection_stat = 0;
//     }
// }


$cs_status = mysqli_query($connection, "SELECT cs_status FROM d_progstud WHERE id_stuInfo = '$id'");
$result = mysqli_fetch_array($cs_status);
if ($result && isset($result['cs_status'])) {
    $course_selection_stat = $result['cs_status'] == 1 ? 1 : 0;
} else {
    $course_selection_stat = 0; // Default value if no result
}
// Convert fetched data to 1 if exists, otherwise default to 0

// $documents_stat = $documents > 0 ? 1 : 0;
$tuition_stat = 0; // Placeholder for tuition status, assuming it's not fetched in this example
$grades_stat = $grades > 0 ? 1 : 0;
// $clearance_stat = $clearance > 0 ? 1 : 0;
// $course_selection_stat = $cs_status > 0 ? 1 : 0;

// Build decision tree and predict eligibility
$decisionTree = buildDecisionTree($data, 5, 2, 0);
$sampleData = [
    $documents_stat,
    $tuition_stat,
    $grades_stat,
    $clearance_stat,
    $course_selection_stat,
    1, // Assuming eligible field for prediction
];

$prediction = predict($decisionTree, $sampleData);

// Insert data into the decision tree table
// Insert data into the decision tree table
$checkID = mysqli_query($connection, "SELECT id_Eligible FROM d_decisiontree");
if (!$checkID) {
    die("Query failed: " . mysqli_error($connection));
}

if (mysqli_num_rows($checkID) < 1) {
    $insertQuery = "INSERT INTO d_decisiontree (id_Eligible, documents, payment, grades, clearance, course_selection, eligible, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    executeQuery($connection, $insertQuery, 'ssssssss', [$id, $documents_stat, $tuition_stat, $grades_stat, $clearance_stat, $course_selection_stat, $prediction, '']);
} else {
    $updateQuery = "UPDATE d_decisiontree SET documents = ?, payment = ?, grades = ?, clearance = ?, course_selection = ? WHERE id_Eligible = ?";
    executeQuery($connection, $updateQuery, 'ssssss', [$documents_stat, $tuition_stat, $grades_stat, $clearance_stat, $course_selection_stat, $id]);
}



// Function to fetch a single value (count)
function fetchSingleValue($connection, $query, $types, $params) {
    $stmt = mysqli_prepare($connection, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $result);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
    return 0;
}

// Function to execute a query
function executeQuery($connection, $query, $types, $params) {
    $stmt = mysqli_prepare($connection, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Student</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">
    <style>
        .container {
            height:100%;
        }
        table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 40px;
            font-size: 14px;
        }
        table tr th {
            padding: 10px 0;
            background: #e4e2e2;
        }
        .thead {
            position: sticky;
            top: 50px;
            z-index: 1;
        }
        table tr td {
            background-color: #ffff;
            padding: 4px 0;
            border-bottom: 1px solid gray;
        }
        
        .div {
            display: flex;
            justify-content: space-between;
        }
        .data_set {
            background: #00004C;
            height: 20px;
            padding: 2px 10px;
            border-radius: 4px;
        }
        .data_set a {
            text-decoration: none;
            color: #ffff;
        }
        .data_set:hover {
            background: green;
        }
    </style>
</head>
<body>

<div class="container">
    <table>
        <div class="div">
            <div>Complete = &#10004; : Not Complete = &#10060; </div>
            <div class="data_set"><a href="./Splitting-No-Computation-Comparison.pptx">Data Set</a></div>
        </div>
        <tr class="thead">
            <th>Documents</th>
            <th>Tuition</th>
            <th>Grades</th>
            <th>Clearance</th>
            <th>Course Selection</th>
            <th>Eligible To Enroll</th>
        </tr>
        <tr>
            <td><?php echo ($documents_stat === 1) ? '&#10004;' : (($documents_stat === 0) ? '&#10060;' : ''); ?></td>
            <td><?php echo ($tuition_stat === 1) ? '&#10004;' : (($tuition_stat === 0) ? '&#10060;' : '');?></td>
            <td><?php echo ($grades_stat === 1) ? '&#10004;' : (($grades_stat === 0) ? '&#10060;' : '');?></td>
            <td><?php echo ($clearance_stat === 1) ? '&#10004;' : (($clearance_stat === 0) ? '&#10060;' : '');?></td>
            <td><?php echo ($course_selection_stat === 1) ? '&#10004;' : (($course_selection_stat === 0) ? '&#10060;' : '');?></td>
            <td><?php echo $prediction ? "Eligible" : "Not Eligible"; ?></td>
        </tr>
    </table>
</div>

</body>
</html>
