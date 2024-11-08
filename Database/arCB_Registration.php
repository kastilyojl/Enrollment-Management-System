<?php
    require('db.php');

    $result = '';
    // Save/Update Action
    if (isset($_POST['save'])) {
        $id_stuInfo = $_POST['id_stuInfo'];
        $status = $_POST['status'];
        $Tag = $_POST['Tag'];
    
        $queryUpdate = "UPDATE d_studinfo SET tagged = '$Tag' WHERE id_stuInfo = '$id_stuInfo'";
        $sqlUpdate = mysqli_query($connection, $queryUpdate);
    
        if ($sqlUpdate) {

            if ($Tag == 3 || $Tag == 2) {
                $sqlEmail = mysqli_query($connection, "SELECT * FROM d_studinfo WHERE id_stuInfo = '$id_stuInfo'");
    
                if ($resultEmail = mysqli_fetch_array($sqlEmail)) {
                    $_SESSION['email'] = $resultEmail['e_mail'];
                    $_SESSION['lname'] = $resultEmail['lname'];
                    $_SESSION['fname'] = $resultEmail['fname'];
                    $_SESSION['mname'] = $resultEmail['mname'];

                    require_once('../phpMailer/send.php');

                    echo '<script>window.location.href = "../Registrar/registration_List.php";</script>';

                //     echo '<script>
                //     swal({
                //         title: "Saved Successfully",
                //         icon: "success",
                //         buttons: false,
                //         timer: 2000 // Auto-close after 2 second
                //     }).then(() => {
                //         window.location.href = "../../src/User/Registrar/Pre-Admission/registration_List.php";
                //     });
                // </script>';

                }
        
            } else {
                echo '<script>window.location.href = "../Registrar/registration_List.php";</script>';
            }        

        }
    }

    // Delete Action
    if(isset($_GET['deleteID'])) {
        $deleteID = $_GET['deleteID'];

        // echo '<script>alert("You are trying to delete is:  ' . $deleteID . ' ")</script>'; TEST
        $sqlDelete = mysqli_query($connection, "DELETE FROM d_studinfo WHERE id_stuInfo = '$deleteID'");
        $sqlDelete = mysqli_query($connection, "DELETE FROM d_eduinfo WHERE id_eduInfo = '$deleteID'");
        $sqlDelete = mysqli_query($connection, "DELETE FROM d_softcopy WHERE id_stuInfo = '$deleteID'");

        echo '<script>window.location.href = "../../src/User/Registrar/Pre-Admission/registration_List.php";</script>';
    }

?>

<script src="../../src/Javascript/sweetalert.min.js"></script>