<?php require('../Database/epCB_Report.php');

$message = '';

if(isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $retrieveReportAll = mysqli_query($connection,  "SELECT * FROM d_report WHERE id_report = '$searchID' ");

    if(mysqli_num_rows($retrieveReportAll) < 1) {
        $message = 'No Student ID Found';
    }

} else {
    $retrieveReportAll = mysqli_query($connection,  "SELECT * FROM d_report WHERE disciplinary_action = '' ");
    $message = 'No Student Report';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Student</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">

</head>
<body>

    <div class="container">
        <div class="header">
            <form action="./Report.php" method="get">
                <input type="text" placeholder="Search by ID" name="searchID">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <table>
            <tr class="thead">
                <th>Id no.</th>
                <th>Name</th>
                <th>Sender</th>
                <th>Report</th>
                <th>Disciplinary Action</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php
                if (mysqli_num_rows($retrieveReportAll) > 0) {
                while($result = mysqli_fetch_array($retrieveReportAll)) {
                ?>
                <tr>
                    <td><?php echo $result['id_report']?></td>
                    <td><?php echo $result['stud_name'] ?></td>
                    <td><?php echo $result['sender_name']?></td>
                    <td><?php echo $result['report']?></td>
                    <form action="../Database/epCB_Report.php" method="post">
                    <td class="dicisplinary_action">
                        <textarea name="action" placeholder="Enter Action"></textarea>
                    </td>
                    <td>
                    <div class="date">
                            <div><label for="start_date">Start</label><input type="date" name="start_date"></div>
                            <div><label for="end_date">End</label><input type="date" name="end_date"></div>
                        </div>
                    </td>
                    <td class="action">
                            <button type="submit" name="save">Save</button>
                            <input type="hidden" name="id_report" value = "<?php echo $result['id_report']?>" >
                        </form>
                        <form id="deleteForm" action="../Database/epCB_Report.php" method="get">
                            <button type="submit" name="delete" onclick="confirmDelete(event)">Delete</button>
                            <input type="hidden" name="deleteID" value = "<?php echo $result['id_report']?>">
                            <input type="hidden" name="sender_name" value = "<?php echo $result['sender_name']?>">
                            <input type="hidden" name="report" value = "<?php echo $result['report']?>">
                        </form>
                    </td>
                </tr>
            <?php } } else {
                    echo "<tr><td colspan='7'>$message</td></tr>";
                }?>
            
        </table>
    </div>
    
    <script src="../Javascript/sweetalert.min"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target.closest('form');
            
            swal({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    
                }
            });
        };
    </script>

</body>
</html>
