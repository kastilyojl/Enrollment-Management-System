<?php

// print_r($_POST);
    require('db.php');

    // $queryStudPL = 'SELECT * FROM d_payver WHERE d_stat != 2';
    // $sqlStudPL = mysqli_query($connection, $queryStudPL);

    $queryStudPLALL = 'SELECT * FROM d_payver';
    $sqlStudPLALL = mysqli_query($connection, $queryStudPLALL);

    if(isset($_POST['submitPayment'])) {

        require('../Detail_Page/restriction.php');
        Payment();
        
        $id_payVer = $_POST['id_payver'];
        $p_name = $_POST['fullname'];
        $amount = $_POST['amount'];
        $purpose = $_POST['purpose'];
        $semester = $_POST['semester'];
        $ref_no = $_POST['reference_no'];

            // Receipt Image
            if (isset($_FILES['p_file'])) {
                if($_FILES['p_file']['error'] === UPLOAD_ERR_NO_FILE) {
                    $file_name = '';
                } else {
                    $file_name = addslashes(file_get_contents($_FILES['p_file']['tmp_name']));
                }
            } else {
                $file_name = '';
            }

            if (isset($_FILES['alumnicard'])) {
                if($_FILES['alumnicard']['error'] === UPLOAD_ERR_NO_FILE) {
                    $file_name1 = '';
                } else {
                    $file_name1 = addslashes(file_get_contents($_FILES['alumnicard']['tmp_name']));
                }
            } else {
                $file_name1 = '';
            }
        
            $queryCreatePayment = "INSERT INTO d_payver(id_payVer, p_name, amount, purpose, semester, ref_no, alumni_card, p_file, p_plan, d_stat, d_rmks) 
                                    VALUES ('$id_payVer', '$p_name', '$amount', '$purpose', '$semester', '$ref_no','$file_name1' ,'$file_name','0' ,'0', '')";	
            $sqlCreatePayment = mysqli_query($connection, $queryCreatePayment);

            require('../Pass_Value/unsetSession2.php');
            header('Location: ../Detail_Page/payment_sucess.php');
            exit;
        }

        if(isset($_GET['deleteID'])) {
            $deleteID = $_GET['deleteID'];
            $reference = $_GET['reference'];
            $sqlDelete = mysqli_query($connection, "DELETE FROM d_payver WHERE id_payVer = '$deleteID' AND ref_no = '$reference'");
    
            // echo '<script>alert("You tryied to delete ' .$deleteID. ' ")</script>'; TEST
            echo '<script>window.location.href = "../Accounting/Payment_List.php"</script>';
    
        }

        if (isset($_POST['saveAPay'])) {
            $id_payVer = $_POST['id_payVer'];
            $payment_status = intval($_POST['payment_status']);
            $p_plan = intval($_POST['payment_plan']);
            $remarks = $_POST['remarks'];
            $reference = $_POST['reference'];
        
            $queryUpdate = "UPDATE d_payver SET p_plan = '$p_plan', d_stat = '$payment_status', d_rmks = '$remarks' WHERE id_payVer = '$id_payVer' AND ref_no = '$reference'";
            $sqlUpdate = mysqli_query($connection, $queryUpdate);
        
            if ($sqlUpdate) {
                echo '<script>window.location.href = "../Accounting/Payment_List.php";</script>';
            } else {
                echo 'Error updating record: ' . mysqli_error($connection);
            }
        }

    

?>