<?php
    session_start();
    require('db.php');

    if(isset($_POST['submitReport'])) {
        $stud_no = $_POST['stud_no'];
        $stud_name = $_POST['stud_name'];
        $sender_name = $_POST['sender_name'];
        $report_text = $_POST['report_text'];

        $sqlReport = mysqli_query($connection, "INSERT INTO d_report VALUES ('$stud_no', '$stud_name', '$sender_name', '$report_text', '',  '0000-00-00', '0000-00-00')");
        
        echo '<script>alert("Successfully Submitted")</script>';

        echo '<script>window.location.href = "../Professor/Report.php"</script>';
    }

    if(isset($_POST['save'])) {
        $action = $_POST['action'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $id_report = $_POST['id_report'];

        $queryUpdate = "UPDATE d_report SET disciplinary_action = '$action', start_date = '$start_date', end_date = '$end_date' WHERE id_report = '$id_report'";
        $sqlUpdate = mysqli_query($connection, $queryUpdate);
        echo '<script>window.location.href = "../Registrar/Report.php";</script>';
    }

    if(isset($_GET['deleteID'])) {
        $deleteID = $_GET['deleteID'];
        $sender_name = $_GET['sender_name'];
        $report = $_GET['report'];
        
        // echo '<script>alert("You are trying to delete is:  ' . $deleteID . ' ")</script>'; TEST
        $sqlDelete = mysqli_query($connection, "DELETE FROM d_report WHERE id_report = '$deleteID' AND sender_name = '$sender_name' AND report = '$report'");
        echo '<script>window.location.href = "../Registrar/Report.php";</script>';
    }
    

?>