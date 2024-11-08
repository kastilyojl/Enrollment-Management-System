<?php 
    require('../Database/db.php');
    require('../Database/Data_Convertion.php');

    // if(isset($_GET['id_stuInfo'])) {
    //     $ID = $_GET['id_stuInfo'];
    //     $retrieved = mysqli_query($connection, "SELECT * FROM d_studinfo WHERE id_stuInfo = '$ID'");
    //     $result = mysqli_fetch_array($retrieved);

    //     $retrievedP = mysqli_query($connection, "SELECT * FROM d_payver WHERE id_payVer = '$ID'");
    //     $resultP = mysqli_fetch_array($retrievedP);

    //     $stat_val = isset($admission_stat[$result['stat']]) ? $admission_stat[$result['stat']] : '';
    //     $tag_val = isset($admission_tag[$result['tagged']]) ? $admission_tag[$result['tagged']] : '';

    //     if(mysqli_num_rows($resultP) > 0) {
    //         $pay_stat_val = isset($d_stat[$resultP['d_stat']]) ? $d_stat[$resultP['d_stat']] : '';
    //     } else {
    //         $pay_stat_val = '';
    //     }
    // }


    if (isset($_GET['id_stuInfo'])) {
        $ID = $_GET['id_stuInfo'];
        
        $retrieved = mysqli_query($connection, "SELECT * FROM d_studinfo WHERE id_stuInfo = '$ID'");
        
        if ($retrieved) {
            $result = mysqli_fetch_array($retrieved);
            
            $retrievedP = mysqli_query($connection, "SELECT * FROM d_payver WHERE id_payVer = '$ID'");
            
            if ($retrievedP) {
                $resultP = mysqli_fetch_array($retrievedP);
                
                if ($result) {
                    $stat_val = isset($admission_stat[$result['stat']]) ? $admission_stat[$result['stat']] : '';
                    $tag_val = isset($admission_tag[$result['tagged']]) ? $admission_tag[$result['tagged']] : '';

                    if (mysqli_num_rows($retrievedP) > 0) {
                        $pay_stat_val = isset($d_stat[$resultP['d_stat']]) ? $d_stat[$resultP['d_stat']] : '';
                    } else {
                        $pay_stat_val = '';
                    }
                } 
            } 
        } 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="../Style/Admission_Form.css">
</head>
<body>

    <style>
        .container {
            height: 100%;
            width: 100%;
            display: grid;
            grid-template-rows: 1fr 1fr;
            padding: 10px;
            background-color: var(--white-color);
        }
        .tbl1, .tbl2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(50%, 1fr));
        }

        h2 {
            display: block;
            background: var(--main-color);
            height: 30px;
            color: var(--white-color);
            text-align: center;
        }
    </style>

    <div class="container">
        <div class="tbl1">
            <h2>Admission Status</h2> <br>
            <div><label for="">ID No. </label><?php echo $result['id_stuInfo']?></div>
            <div><label for="">Name: </label><?php echo $result['lname'] . " " .$result['fname'] . " " .$result['mname']?></div>
            <div><label for="">Year: </label><?php echo $result['gy_level']?></div>
            <div><label for="">Stand/Course: </label><?php echo $result['str_crs']?></div>
            <div><label for="">Status: </label><?php echo $stat_val?></div>
            <div><label for="">Tag: </label><?php echo $tag_val?></div>
        </div>
        <div class="tbl2">
            <h2>Payment Status</h2> <br>
            <?php 
                if(empty($resultP)) {
                   echo '<div>No Payment Transaction</div>';
                } else { ?>
                    <div><label for="">ID No. </label><?php echo $resultP['id_payVer']?></div>
                    <div><label for="">Name: </label><?php echo $resultP['p_name']?></div>
                    <div><label for="">Amount: </label><?php echo $resultP['amount']?></div>
                    <div><label for="">Purpose: </label><?php echo $resultP['purpose']?></div>
                    <div><label for="">Semester: </label><?php echo $resultP['semester']?></div>
                    <div><label for="">Reference No.:</label><?php echo $resultP['ref_no']?></div>
                    <div><label for="">Status: <?php echo $pay_stat_val?></label></div>
                    <div><label for="">Receipt: </label></div>
                    <div><label for="">Remarks: <?php echo $resultP['d_rmks']?></label></div>
              <?php  }

            ?>        
        </div>
    </div>
    
</body>
</html>