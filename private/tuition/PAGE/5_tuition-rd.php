<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition Table</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../../1_superadmin/gen-setup/CSS/rd.css">
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="name">Tuition Table</h2>
        <form id="search-form" class="form-container" onsubmit="return false;">
            <input type="text" class="input-box" id="search-box" name="query" placeholder="Enter your search query">
            <div class="button-container">
                <a href="../PAGE/5_tuition-c.php" class="add-new-button">Add New</a>
            </div>
        </form>
        <div class="table-container">
            <form class="table" action="../PROCESS/5_tuition-process-rd.php" method="POST">
                <table class="t-content" id="tuition-table">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Program</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Full Amount</th>
                            <th>Installment Amount</th>
                            <th>Prelims</th>
                            <th>Midterms</th>
                            <th>Finals</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php include '../PROCESS/5_tuition-process-rd.php'; ?>
                        <?php foreach ($d_tuitions as $row) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['prog_dept']); ?></td>
                                <td><?php echo htmlspecialchars($row['prog_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['t_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['t_cat']); ?></td>
                                <td><?php echo htmlspecialchars($row['t_famt']); ?></td>
                                <td><?php echo htmlspecialchars($row['t_inst']); ?></td>
                                <td><?php echo htmlspecialchars($row['t_pre']); ?></td>
                                <td><?php echo htmlspecialchars($row['t_mid']); ?></td>
                                <td><?php echo htmlspecialchars($row['t_fin']); ?></td>
                                <td>
                                    <form action="../PROCESS/5_tuition-process-rd.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['t_code']); ?>">
                                        <button type="submit" name="update">Edit</button>
                                    </form>
                                    <button type="button" onclick="confirmDelete('<?php echo htmlspecialchars($row['t_code']); ?>')">Delete</button>
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
    <script src="../JS/5_tuition-rd.js"></script>
</body>

</html>