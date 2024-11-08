<?php require('../Database/erCB_Clearance.php');
require('../Database/db.php');

    $sqlClearance = mysqli_query($connection, "SELECT * FROM d_clearance WHERE stat = '0'");

    if (isset($_POST['save'])) {
        $id_clearance = $_POST['id_clearance'];
        $stat = $_POST['stat'];
    
        $queryUpdate = "UPDATE d_clearance SET stat = '$stat' WHERE id_clearance = '$id_clearance'";
        $sqlUpdate = mysqli_query($connection, $queryUpdate);
    
        if ($sqlUpdate) {
            echo 'save()';
            echo '<script>window.location.href = "Clearanc3.php";</script>';
        } else {
            echo 'Error updating record: ' . mysqli_error($connection);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Student</title>
    <link rel="stylesheet" href="../Style/Admin_Clearance.css">
</head>
<body>

    <div class="container">
        <div class="header">
                <form action="../Database/erCB_Clearance.php" method="post" enctype="multipart/form-data">
                    <label for="">Senior High School</label> <br>
                    <input type="file" name="clearanceshs" id="input_file" accept=".pdf"> <br>
                    <button type="submit" name="submit1">Submit</button>
                </form>
                <form action="../Database/erCB_Clearance.php"  method="post" enctype="multipart/form-data">
                    <label for="">College</label> <br>
                    <input type="file" name="clearancecollege" id="input_file" accept=".pdf"> <br>
                    <button type="submit" name="submit2">Submit</button>
                </form>
            </div>
        <table>
            <tr class="thead">
                <th>Id no.</th>
                <th>Clearance</th>               
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php 
            if (mysqli_num_rows($sqlClearance) > 0) {
            while($result = mysqli_fetch_array($sqlClearance)) : 
                ?>
            <tr>
                <td><?php echo $result['id_clearance']?></td>
                <td><a href="view_pdf.php?id=<?php echo $result['id_clearance']; ?>">View PDF</a></td>
                <td>
                    <form action="" method="post">
                        <select name="stat">
                            <option value="1">Accepted</option>
                            <option value="2">Not Accepted</option>
                        </select>
                </td>
                <td class="action">
                        <button type="submit" name="save">Save</button>
                        <input type="hidden" name="id_clearance" value = "<?php echo $result['id_clearance']?>" >
                    </form>
                </td>
                
            </tr>
            <?php endwhile; }  else {
                    echo "<tr><td colspan='4'>No Student Clearance</td></tr>";
                }?>
            
        </table>
    </div>

</body>
</html>
