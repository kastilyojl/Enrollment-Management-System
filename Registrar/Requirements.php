<?php 
require('../Database/db.php');

// Search

$message = '';

if(isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $sqlDocuments = mysqli_query($connection, "SELECT * FROM d_softcopy WHERE id_stuInfo = '$searchID'");

    if(mysqli_num_rows($sqlDocuments) < 1) {
        $message = 'No Student ID Found';
    }

} else {
    $sqlDocuments = mysqli_query($connection, "SELECT * FROM d_softcopy WHERE stat = '0'");
    $message = 'No Student Requirements Found';
}

$id = ''; 
$form137 = ''; 
$esc_certificate = '';
$cert_gm = '';
$g10_certofreg = '';
$hon_diss = '';
$b_cert = '';

if (isset($_POST['editButton'])) {
    $id = $_POST['id_stuInfo'];
    $form137 = $_POST['form138'];
    $esc_certificate = $_POST['esc_certificate'];
    $cert_gm = $_POST['cert_gm'];
    $g10_certofreg = $_POST['g10_certofreg'];
    $hon_diss = $_POST['hon_diss'];
    $b_cert = $_POST['b_cert'];
}

if (isset($_POST['saveEdit'])) {
    $updateid_stuInfo = $_POST['updateid_stuInfo'];
    $updateform138 = $_POST['updateform138'];
    $update_esc_certificate = $_POST['update_esc_certificate'];
    $update_cert_gm = $_POST['update_cert_gm'];
    $update_g10_certofreg = $_POST['update_g10_certofreg'];
    $update_hon_diss = $_POST['update_hon_diss'];
    $update_b_cert = $_POST['update_b_cert'];

    $update = "UPDATE d_softcopy SET form138 = '$updateform138', esc_certificate = '$update_esc_certificate', cert_gm = '$update_cert_gm', g10_certofreg = '$update_g10_certofreg', hon_diss = '$update_hon_diss', b_cert = '$update_b_cert' WHERE id_stuInfo = '$updateid_stuInfo'";
    $updated = mysqli_query($connection, $update);

    $complete = "UPDATE d_softcopy 
                SET stat = '1' 
                WHERE id_stuInfo = '$updateid_stuInfo' 
                AND form138 = 'Submit' 
                AND esc_certificate = 'Submit' 
                AND cert_gm = 'Submit' 
                AND g10_certofreg = 'Submit' 
                AND hon_diss = 'Submit' 
                AND b_cert = 'Submit'";

    $queryComplete = mysqli_query($connection, $complete);

    if ($updated) {
        // echo '<script>alert("Update successful")</script>; window.';
        echo "<script>window.location.href='./Requirements.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirements</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">
    <style>
        
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background:  #00004C;
            border-radius: 50px;
        }

        .edit {
            height: 60%;
            width: 60%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid black;
            background: #ffffff;
            border-radius: 10px;
            display: none; 
        }

        .edit.active {
            display: block;
        }

        .edit .body form{
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .edit .header #closeEdit {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            font-weight: bold;
            color: #ffff
            
        }

        .edit .header #closeEdit:hover {
            background: #1F1F1F;
            text-align: center;
            cursor: pointer;
            border-radius: 0 10px 0 0;
            background: red; 
        }

        .edit .header {
            background: #2E2E2E;
            height: 30px;
            padding: 0;
            display: flex;
            justify-content: end;
            align-items: center;
            border-radius: 10px 10px 0 0;
            
        }

        .edit .body {
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            row-gap: 20px
        }

        .edit .body div {
            margin:0 20px
        }
        .edit .body input {
            height: 30px
        }

        .edit .body select, .edit .body input {
            width: 100%;
            margin-top: 4px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .footer {
            display: flex;
            justify-content: end;
            align-items: center;
        }
        .footer .saveEditbtn, button {
            height: 30px;
            padding: 0 20px;
            background: #00004C;
            color: #ffff;
            border: none;
            border-radius: 4px;
        }
    </style>
     
</head>
<body>
    <div class="container">
        <div class="header">
            <form action="./Requirements.php" method="get">
                <input type="text" placeholder="Search by ID" name="searchID">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <table>
            <tr class="thead">
                <th>Id No.</th>
                <th>Form 137</th>
                <th>ESC Certificate</th>
                <th>Certificate of Good Moral</th>
                <th>Certificate of Recognition</th>
                <th>Honorary of Dismissal</th>
                <th>Birth Certificate</th>
                <th>Action</th>
            </tr>
            <?php 
            if (mysqli_num_rows($sqlDocuments) > 0) {
                while($row = mysqli_fetch_array($sqlDocuments)) { ?>
                    <tr>
                        <td><?php echo $row['id_stuInfo']?></td>
                        <td><?php echo $row['form138'] === 'Submit' ? '&#10004;' : ($row['form138'] === 'Missing' ? '&#10060;' : '');?></td>
                        <td><?php echo $row['esc_certificate'] === 'Submit' ? '&#10004;' : ($row['esc_certificate'] === 'Missing' ? '&#10060;' : '');?></td>
                        <td><?php echo $row['cert_gm'] === 'Submit' ? '&#10004;' : ($row['cert_gm'] === 'Missing' ? '&#10060;' : '');?></td>
                        <td><?php echo $row['g10_certofreg'] === 'Submit' ? '&#10004;' : ($row['g10_certofreg'] === 'Missing' ? '&#10060;' : '');?></td>
                        <td><?php echo $row['hon_diss'] === 'Submit' ? '&#10004;' : ($row['hon_diss'] === 'Missing' ? '&#10060;' : '');?></td>
                        <td><?php echo $row['b_cert'] === 'Submit' ? '&#10004;' : ($row['b_cert'] === 'Missing' ? '&#10060;' : '');?></td>
                        <td>
<button type="button" onclick="openEdit(event, '<?php echo $row['id_stuInfo']; ?>', '<?php echo $row['form138']; ?>', '<?php echo $row['esc_certificate']; ?>', '<?php echo $row['cert_gm']; ?>', '<?php echo $row['g10_certofreg']; ?>', '<?php echo $row['hon_diss']; ?>', '<?php echo $row['b_cert']; ?>')">Edit</button>

                        </td>
                    </tr>
                <?php } 
            } else {
                echo "<tr><td colspan='8'>$message</td></tr>";
            } ?>
        </table>
    </div>

    <div class="edit" id="openEdit">
        <div class="container">
            <div class="header">
                <span id="closeEdit" onclick="closeEdit()">x</span>
            </div>
            <div class="body">
                    <div>
                    <form action="./Requirements.php" method="post">
                        <label for="form">Id Number</label> <br>
                        <input type="text" readonly name="updateid_stuInfo" value='<?php echo $id; ?>'>
                    </div>
                    <div>
                        <label for="form">Form 137</label> <br>
                        <select name="updateform138">
                            <option value="" hidden>Select...</option>
                            <option value="Submit" <?php echo ($form137 == 'Submit') ? 'selected' : ''; ?>>Submit</option>
                            <option value="Missing" <?php echo ($form137 == 'Missing') ? 'selected' : ''; ?>>Missing</option>
                        </select>
                    </div>
                    <div>
                        <label for="form">ESC Certificate</label> <br>
                        <select name="update_esc_certificate">
                            <option value="" hidden>Select...</option>
                            <option value="Submit" <?php echo ($esc_certificate == 'Submit') ? 'selected' : ''; ?>>Submit</option>
                            <option value="Missing" <?php echo ($esc_certificate == 'Missing') ? 'selected' : ''; ?>>Missing</option>
                        </select>
                    </div>
                    <div>
                        <label for="form">Certificate Of Good Moral</label> <br>
                        <select name="update_cert_gm">
                            <option value="" hidden>Select...</option>
                            <option value="Submit" <?php echo ($cert_gm == 'Submit') ? 'selected' : ''; ?>>Submit</option>
                            <option value="Missing" <?php echo ($cert_gm == 'Missing') ? 'selected' : ''; ?>>Missing</option>
                        </select>
                    </div>
                    <div>
                        <label for="form">Certificate Of Recognition</label> <br>
                        <select name="update_g10_certofreg">
                            <option value="" hidden>Select...</option>
                            <option value="Submit" <?php echo ($g10_certofreg == 'Submit') ? 'selected' : ''; ?>>Submit</option>
                            <option value="Missing" <?php echo ($g10_certofreg == 'Missing') ? 'selected' : ''; ?>>Missing</option>
                        </select>
                    </div>
                    <div>
                        <label for="form">Honorary Of Dismissal</label> <br>
                        <select name="update_hon_diss">
                            <option value="" hidden>Select...</option>
                            <option value="Submit" <?php echo ($hon_diss == 'Submit') ? 'selected' : ''; ?>>Submit</option>
                            <option value="Missing" <?php echo ($hon_diss == 'Missing') ? 'selected' : ''; ?>>Missing</option>
                        </select>
                    </div>
                    <div>
                        <label for="form">Birth Certificate</label> <br>
                        <select name="update_b_cert">
                            <option value="" hidden>Select...</option>
                            <option value="Submit" <?php echo ($b_cert == 'Submit') ? 'selected' : ''; ?>>Submit</option>
                            <option value="Missing" <?php echo ($b_cert == 'Missing') ? 'selected' : ''; ?>>Missing</option>
                        </select>
                    </div>
                    <div class="footer">
                        <button type="submit" class="saveEditbtn" name="saveEdit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEdit(event, id, form137, esc_certificate, cert_gm, g10_certofreg, hon_diss, b_cert) {
            event.preventDefault(); // Prevent form submission
            document.getElementById('openEdit').classList.add('active');

            // Populate modal fields
            document.querySelector('input[name="updateid_stuInfo"]').value = id;
            document.querySelector('select[name="updateform138"]').value = form137;
            document.querySelector('select[name="update_esc_certificate"]').value = esc_certificate;
            document.querySelector('select[name="update_cert_gm"]').value = cert_gm;
            document.querySelector('select[name="update_g10_certofreg"]').value = g10_certofreg;
            document.querySelector('select[name="update_hon_diss"]').value = hon_diss;
            document.querySelector('select[name="update_b_cert"]').value = b_cert;
        }

        function closeEdit() {
            document.getElementById('openEdit').classList.remove('active');
        }
    </script>
</body>
</html>
