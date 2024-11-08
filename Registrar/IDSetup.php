<?php require('../Database/arCB_Registration.php');
require('../Database/Data_Convertion.php');

    if(isset($_POST['Generate'])) {
        $id1 = $_POST['id1'];
        $id2 = $_POST['id2'];
        $id3 = $_POST['id3'];
        $checkedIds = $_POST['checkedIds'];
        $idsArray = explode(',', $checkedIds);

        if(empty($id1) && empty($id2) && empty($id3)) {
            echo '<script>window.location.href = "./IDSetup.php"</script>';
        }

        if(empty($id1) || empty($id2) || empty($id3)) {
            echo '<script>alert("Complete All Field")</script>';
            echo '<script>window.location.href = "./IDSetup.php"</script>';
        }

        $idIncrement = 0; // Start from the initial id3 value
        foreach ($idsArray as $id) {
            $setID = $id1 . $id2 . str_pad($id3 + $idIncrement, 3, '0', STR_PAD_LEFT);
            $queryUpdate = "UPDATE d_studinfo SET id_stuInfo = '$setID' WHERE id_stuInfo = '$id'";
            $sqlUpdate = mysqli_query($connection, $queryUpdate);

            $queryUpdate = "UPDATE d_eduinfo SET id_eduInfo = '$setID' WHERE id_eduInfo = '$id'";
            $sqlUpdate = mysqli_query($connection, $queryUpdate);

            $queryUpdate = "UPDATE d_softcopy SET id_stuInfo = '$setID' WHERE id_stuInfo = '$id'";
            $sqlUpdate = mysqli_query($connection, $queryUpdate);

            $queryUpdate = "UPDATE d_payver SET id_payVer = '$setID' WHERE id_payVer = '$id'";
            $sqlUpdate = mysqli_query($connection, $queryUpdate);

            $idIncrement++;
        }

        echo '<script>window.location.href = "./IDSetup.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Student</title>
    <link rel="stylesheet" href="../Style/admin_registration.css">

    <style>
        .selectAll {
            width: 100px;
        }

        .selectAll input {
            margin: 0 4px;
        }
        
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
        <form class="changeID" action="./IDSetup.php" method="post" onsubmit="updateCheckedIds()">
            <input type="text" placeholder="A" name="id1">
            <input type="text" placeholder="00" name="id2">
            <input type="text" placeholder="000" name="id3">
            <input type="hidden" name="checkedIds" id="checkedIds">
            <input type="submit" value="Generate" name="Generate">
        </form>
        </div>
        <table>
            <tr class="thead">
                <th class="selectAll"><input type="checkbox" name="checkAll" onchange="checkAll(this)"><label>Select All</label></th>
                <th>Id no.</th>
                <th>Name</th>
                <th>Year Level</th>
                <th>Program</th>
                <th>Tag</th>
            </tr>
            <?php
                $sqlSearch = mysqli_query($connection, "SELECT * FROM d_studinfo WHERE tagged = '3' && id_stuInfo LIKE '%Temp%'");
                if (mysqli_num_rows($sqlSearch) > 0) {
                while($result = mysqli_fetch_array($sqlSearch)) {
                $gy_lvl_val = isset($gy_lvl[$result['gy_level']]) ? $gy_lvl[$result['gy_level']] : '';
                $admission_tag_val = isset($admission_tag[$result['tagged']]) ? $admission_tag[$result['tagged']] : '';
                ?>
                <tr>
                    <td><input type="checkbox" name="checkbox" value="<?php echo $result['id_stuInfo']; ?>"></td>
                    <td><?php echo $result['id_stuInfo']?></td>
                    <td><?php echo $result['lname'] . ", " .$result['fname'] . " " .$result['mname'] ?></td>
                    <td><?php echo $gy_lvl_val?></td>
                    <td><?php echo $result['str_crs']?></td>
                    <td><?php echo $admission_tag_val?></td>
                </tr>
            <?php } } else {
                    echo "<tr><td colspan='6'>No Student Application</td></tr>";
                }?>
            
        </table>
    </div>

    <script>
    var checkboxes = document.querySelectorAll("input[name='checkbox']");
    var checkedIdsField = document.getElementById('checkedIds');

    function checkAll(myCheckbox) {
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = myCheckbox.checked;
        });
    }

    function updateCheckedIds() {
        var checkedIds = [];
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedIds.push(checkbox.value);
            }
        });
        checkedIdsField.value = checkedIds.join(',');
    }
</script>
    
</body>
</html>
