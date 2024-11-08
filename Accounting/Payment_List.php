<?php
    require('../Database/asc_Payment.php');

$message = '';

if(isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $sqlStudPL = mysqli_query($connection, "SELECT * FROM d_payver WHERE id_payVer = '$searchID' OR ref_no = '$searchID'");

    if(mysqli_num_rows($sqlStudPL) < 1) {
        $message = 'No Student ID / Reference Number Found';
    }

} else {
    $sqlStudPL = mysqli_query($connection, "SELECT * FROM d_payver WHERE d_stat != 2");
    $message = 'No Student Payment';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College List</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">

    <style>
        .enlarged {
            width: auto;
            height: 400px;
            transition: width 0.3s ease;
            cursor: pointer;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            top: 20%;
        }
    </style>
</head>
<body>

<div class="container">
        <div class="header">
            <form action="./Payment_List.php" method="get">
                <input type="text" placeholder="Search by ID / Ref No." name="searchID">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <table>
            <tr class="thead">
                <th>Id no.</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Purpose</th>
                <th>Semester</th>
                <th>Reference No.</th>
                <th>Receipt</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Tag</th>
                <th>Action</th>
            </tr>
            <tr>
            <?php
            if (mysqli_num_rows($sqlStudPL) > 0) {
             while($result = mysqli_fetch_array($sqlStudPL)) { ?>
                <td><?php echo $result['id_payVer']?></td>
                <td><?php echo $result['p_name']?></td>
                <td><?php echo $result['amount']?></td>
                <td><?php echo $result['purpose']?></td>
                <td><?php echo $result['semester']?></td>
                <td><?php echo $result['ref_no']?></td>
                <td>
                    <?php
                        echo '<img class="thumbnail" src="data:image/*;base64,'.base64_encode($result['p_file']).'" height="30" width="80" style="cursor: pointer;"/>';
                    ?>
                </td>
                <td>
                <form action="../Database/asc_Payment.php" method="post">
                    <select name="payment_plan">
                        <option value="" hidden>Select</option>
                        <option value="2">Fully Paid</option>
                        <option value="1">Paying</option>
                    </select>
                </td>
                <td><textarea name="remarks" placeholder="Enter remarks"></textarea></td>
                <td>
                    <select name="payment_status">
                        <option value="" hidden>Select</option>
                        <option value="0">Pending</option>
                        <option value="2">Verified</option>
                        <option value="1">Not Verified</option>
                    </select>
                </td>
                <td class="action">
                        <button type="submit" name="saveAPay">Save</button>
                        <input type="hidden" name="id_payVer" value = "<?php echo $result['id_payVer']?>" >
                        <input type="hidden" name="reference" value= "<?php echo $result['ref_no']?>">    
                    </form>
                    <form id="deleteForm" action="../Database/asc_Payment.php" method="get">
                            <button type="submit" name="deleteAPay" onclick="confirmDelete(event)">Delete</button>
                            <input type="hidden" name="deleteID" value="<?php echo $result['id_payVer'] ?>">
                            <input type="hidden" name="reference" value= "<?php echo $result['ref_no']?>">    
                        </form>
                    </td>
                </tr>
            <?php } } else {
                    echo "<tr><td colspan='11'>$message</td></tr>";
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                this.classList.toggle('enlarged');
                });
            });
        });
    </script>

</body>
</html>
