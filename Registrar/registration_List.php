<?php 
require('../Database/arCB_Registration.php');
require('../Database/Data_Convertion.php');

$message = '';

if(isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $sqlSearch = mysqli_query($connection, "SELECT * FROM d_studinfo WHERE id_stuInfo = '$searchID'");

    if(mysqli_num_rows($sqlSearch) < 1) {
        $message = 'No Student ID Found';
    }

} else {
    $sqlSearch = mysqli_query($connection, "SELECT * FROM d_studinfo WHERE tagged = '1'");
    $message = 'No Student Application';
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
            <form action="./registration_List.php" method="get">
                <input type="text" placeholder="Search by ID" name="searchID">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <table>
            <tr class="thead">
                <th>Id no.</th>
                <th>Name</th>
                <th>Year Level</th>
                <th>Program</th>
                <th>Application Check</th>
                <th hidden>Status</th>
                <th>Tag</th>
                <th>Action</th>
            </tr>
            <?php
                if (mysqli_num_rows($sqlSearch) > 0) {
                    while ($result = mysqli_fetch_array($sqlSearch)) {
                        $gy_lvl_val = isset($gy_lvl[$result['gy_level']]) ? $gy_lvl[$result['gy_level']] : '';
            ?>
                        <tr>
                            <td><?php echo $result['id_stuInfo']?></td>
                            <td><?php echo $result['lname'] .", " .$result['fname'] ." " .$result['mname']?></td>
                            <td><?php echo $gy_lvl_val?></td>
                            <td><?php echo $result['str_crs']?></td>
                            <td><a href="../Student_Profile/Registration_Form.php?id_stuInfo=<?php echo $result['id_stuInfo']?>" target="_blank">View</a></td>
                            <form id="saveForm" action="../Database/arCB_Registration.php" method="post">
                            <td hidden>
                                <select name="status">
                                    <option value="2">Complete</option>
                                    <option value="1">Incomplete</option>
                                </select>
                            </td>
                            <td>
                                <select name="Tag">
                                    <option value="1">Pending</option>
                                    <option value="3">Accepted</option>
                                    <option value="2">Not Accepted</option>
                                </select>
                            </td>
                            <td class="action">
                                    <button type="submit" name="save">Save</button>
                                    <input type="hidden" name="id_stuInfo" value="<?php echo $result['id_stuInfo']; ?>">
                                </form>
                                <form id="deleteForm" action="../Database/arCB_Registration.php" method="get">
                                    <button id="deleteButton" type="submit"  name="delete" onclick="confirmDelete(event)">Delete</button>
                                    <input type="hidden" name="deleteID" value="<?php echo $result['id_stuInfo']; ?>">
                                </form>
                            </td>
                        </tr>
            <?php 
                    }
                } else {
                    echo "<tr><td colspan='8'>$message</td></tr>";
                }
            ?>
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
