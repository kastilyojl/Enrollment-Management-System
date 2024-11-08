<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Year Table</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/rd.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="name">School Year Table</h2>
        <form id="search-form" class="form-container" onsubmit="return false;">
            <input type="text" class="input-box" id="search-box" name="query" placeholder="Enter your search query">
            <div class="button-container">
                <a href="../PAGE/0_sysetup-c.php" class="add-new-button">Add New</a>
            </div>
        </form>
        <div class="table-container">
            <table class="t-content" id="school-year-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>S.Y.</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Semester</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Semester</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php include '../PROCESS/0_sysetup-process-rd.php'; ?>
                    <?php foreach ($d_sysetup as $row) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['sy']); ?></td>
                            <td><?php echo htmlspecialchars($row['sdate_sy']); ?></td>
                            <td><?php echo htmlspecialchars($row['edate_sy']); ?></td>
                            <td><?php echo htmlspecialchars($row['t1_acad']); ?></td>
                            <td><?php echo htmlspecialchars($row['t1_sdate']); ?></td>
                            <td><?php echo htmlspecialchars($row['t1_edate']); ?></td>
                            <td><?php echo htmlspecialchars($row['t2_acad']); ?></td>
                            <td><?php echo htmlspecialchars($row['t2_sdate']); ?></td>
                            <td><?php echo htmlspecialchars($row['t2_edate']); ?></td>
                            <td>
                                <form action="../PROCESS/0_sysetup-process-rd.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" name="update">Edit</button>
                                </form>
                                <button type="button" onclick="confirmDelete('<?php echo htmlspecialchars($row['id']); ?>')">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            <button id="prevPage">Previous</button>
            <span id="pageNum">1</span>
            <button id="nextPage">Next</button>
        </div>
    </div>
    <script src="../JS/0_sysetup-rd.js"></script>
</body>

</html>