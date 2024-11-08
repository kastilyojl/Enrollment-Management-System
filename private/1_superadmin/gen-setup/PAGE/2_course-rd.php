<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Table</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/rd.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="name">Course Table</h2>
        <form id="search-form" class="form-container" onsubmit="return false;">
            <input type="text" class="input-box" id="search-box" name="query" placeholder="Enter your search query">
            <div class="button-container">
                <a href="../PAGE/2_course-c.php" class="add-new-button">Add New</a>
            </div>
        </form>
        <div class="table-container">
            <form class="table" action="../PROCESS/2_course-process-rd.php" method="POST">
                <table class="t-content" id="course-table">
                    <thead>
                        <tr>
                            <th class="hidden">ID</th>
                            <th>Program Code</th>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Lec</th>
                            <th>Lab</th>
                            <th>Total Hrs</th>
                            <th>Department</th>
                            <th>Year-Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php include '../PROCESS/2_course-process-rd.php'; ?>
                        <?php foreach ($d_subject as $row) : ?>
                            <tr>
                                <td class="hidden"><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['prog_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_units']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_Labunits']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_total_hours']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_dept']); ?></td>
                                <td><?php echo htmlspecialchars($row['subj_ylvl']); ?></td>
                                <td>
                                    <form action="../PROCESS/2_course-process-rd.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <button type="submit" name="update">Edit</button>
                                    </form>
                                    <button type="button" onclick="confirmDelete('<?php echo htmlspecialchars($row['id']); ?>')">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="pagination-container">
            <button id="prevPage">Previous</button>
            <span id="pageNum"></span>
            <button id="nextPage">Next</button>
        </div>
    </div>
</body>
<script src="../JS/2_course-rd.js"></script>

</html>