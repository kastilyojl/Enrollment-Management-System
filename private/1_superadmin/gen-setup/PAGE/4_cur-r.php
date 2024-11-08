<?php
// Restrict settings
$ReadOnly = true;
$Required = true;

include '../../../../connection.php';

function fetchPrograms($conn)
{
    $sql = "SELECT id, prog_dept, prog_title, prog_code, prog_yrs FROM d_program ORDER BY id ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}

function fetchSubject($conn, $prog_code)
{
    $sql = "SELECT DISTINCT subj_ylvl, subj_sem FROM d_subject WHERE prog_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $prog_code);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function fetchSubjectDetails($conn, $prog_code, $subj_ylvl, $subj_sem)
{
    $sql = "SELECT subj_code, subj_title FROM d_subject WHERE prog_code = ? AND subj_ylvl = ? AND subj_sem = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $prog_code, $subj_ylvl, $subj_sem);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

$programs = fetchPrograms($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs Offered</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/dis.css">

</head>

<body>
    <div class="container">
        <h1>Programs Offered</h1>
        <div class="programs">
            <?php foreach ($programs as $program) : ?>
                <div class="program">
                    <h2><?php echo htmlspecialchars($program['prog_title'] ?? ''); ?></h2>
                    <p><?php echo htmlspecialchars($program['prog_dept'] ?? ''); ?></p>
                    <p>Years: <?php echo htmlspecialchars($program['prog_yrs'] ?? ''); ?></p>
                    <h3>Courses:</h3>
                    <div class="year-boxes">
                        <?php
                        $subjectLevels = fetchSubject($conn, $program['prog_code']);
                        foreach ($subjectLevels as $subject) : ?>
                            <div class="year-box">
                                <strong><?php echo htmlspecialchars($subject['subj_ylvl'] ?? ''); ?>
                                    <?php if ($subject['subj_ylvl'] === '1ST' || $subject['subj_ylvl'] === '2ND') : ?>
                                        Semester,
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($subject['subj_sem'] ?? ''); ?>:</strong>
                                <ul class="subjects">
                                    <?php
                                    $subjectDetails = fetchSubjectDetails($conn, $program['prog_code'], $subject['subj_ylvl'], $subject['subj_sem']);
                                    foreach ($subjectDetails as $detail) : ?>
                                        <li><?php echo htmlspecialchars($detail['subj_title'] ?? ''); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>