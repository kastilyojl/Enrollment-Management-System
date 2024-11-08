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
        <h2 class="name">Program Table</h2>
        <form id="search-form" class="form-container" onsubmit="return false;">
            <input type="text" class="input-box" id="search-box" name="query" placeholder="Enter your search query">
            <div class="button-container">
                <a href="../PAGE/1_prog-c.php" class="add-new-button">Add New</a>
            </div>
        </form>
        <div class="table-container">
            <form class="table" action="../PROCESS/1_prog-process-rd.php" method="POST">
                <table class="t-content" id="program-table">
                    <thead>
                        <tr>
                            <th class="hidden">ID</th>
                            <th>Program Code</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Years</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php include '../PROCESS/1_prog-process-rd.php'; ?>
                        <?php foreach ($d_program as $row) : ?>
                            <tr>
                                <td class="hidden"><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['prog_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['prog_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['prog_dept']); ?></td>
                                <td><?php echo htmlspecialchars($row['prog_yrs']); ?></td>
                                <td>
                                    <form action="../PROCESS/1_prog-process-rd.php" method="POST" style="display:inline;">
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
<script src="../JS/1_prog-rd.js"></script>

</html>