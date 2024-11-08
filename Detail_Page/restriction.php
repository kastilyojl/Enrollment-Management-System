<?php

require('../Pass_Value/retrieve_val.php');
// Admission Personal Information Form

function studentProfile() {
    if (isset($_POST['student_form'])) {
        require('../Pass_Value/session1.php');
        require('../Database/db.php');


        // Validate other form inputs
        $errors = [];

        if (empty($_POST['lname'])) {
            $errors[] = 'lname';
        }

        if (empty($_POST['fname'])) {
            $errors[] = 'fname';
        }

        if (empty($_POST['address'])) {
            $errors[] = 'address';
        }

        if (empty($_POST['birthdate'])) {
            $errors[] = 'birthdate';
        }

        if (empty($_POST['placebirth'])) {
            $errors[] = 'placebirth';
        }

        if (empty($_POST['gender'])) {
            $errors[] = 'gender';
        }

        if (empty($_POST['civilstatus'])) {
            $errors[] = 'civilstatus';
        }

        if (empty($_POST['email'])) {
            $errors[] = 'email';
        }

        if (!empty($errors)) {
            $errorString = implode(',', $errors);
            header("Location: ./student.php?errors=$errorString");
            exit;
        }

        // Proceed with form submission or other logic if no errors

        $e_mail = $_POST['email']; // Assuming the email input name is 'email'

        // Check if email exists
        $query = "SELECT e_mail FROM d_studinfo WHERE e_mail = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $e_mail);
        $stmt->execute();
        $result = $stmt->get_result();

        // d_user table
        if ($result->num_rows > 0) {
            echo '<script>alert("Email Already Exist"); window.history.back();</script>';
            exit;
        }

        $checkEmail = "SELECT * FROM users WHERE email = '$e_mail'";
            $queryEmail = mysqli_query($connection, $checkEmail);

            if ($queryEmail && mysqli_num_rows($queryEmail) > 0) {
                echo '<script>alert("Email Already Exist"); window.history.back();</script>';
                exit;
            }

            $stmt->close();

    }
}

function AcademicInfo() {
    if (isset($_POST['academic_form'])) {

        require('../Pass_Value/session2.php');

        $errors = [];

        if (empty($s_type)) {
            $errors[] = 'type';
        }

        if (empty($gy_level)) {
            $errors[] = 'yrlevel';
        }

        if (empty($e_branch)) {
            $errors[] = 'branch';
        }

        if (empty($str_crs)) {
            $errors[] = 'strand';
        }

        if (empty($vou_type)) {
            $errors[] = 'voucher';
        }
     

        if (!empty($errors)) {
            $errorString = implode(',', $errors);
            header("Location: ./academic_info.php?errors=$errorString");
            exit;
        }

        

    }
}

function AcademicInfo1() { // Voucher Remove For College
    if (isset($_POST['academic_form'])) {

        require('../Pass_Value/session5.php');

        $errors = [];

        if (empty($s_type)) {
            $errors[] = 'type';
        }

        if (empty($gy_level)) {
            $errors[] = 'yrlevel';
        }

        if (empty($e_branch)) {
            $errors[] = 'branch';
        }

        if (empty($str_crs)) {
            $errors[] = 'strand';
        }
     
        if (!empty($errors)) {
            $errorString = implode(',', $errors);
            header("Location: ./academic_info.php?errors=$errorString");
            exit;

        }

    }
}

function ParentInfo() {
    if (isset($_POST['Parent_form'])) {

        require('../Pass_Value/session3.php');
    }
}

function EduBG() {
    if (isset($_POST['EduBG_Form'])) {

        require('../Pass_Value/session4.php');
    }
}

// Admission Form Payment

 function Payment() {

    require('../Pass_Value/session6.php');
    
        $errors = [];
    
        if (empty($id_payver)) {
            $errors[] = 'id_payver';
        }   
        
        if (empty($fullname)) {
            $errors[] = 'fullname';
        }      
    
        if (empty($amount)) {
            $errors[] = 'amount';
        }      
    
        if (empty($purpose)) {
            $errors[] = 'purpose';
        }      
    
        if (empty($semester)) {
            $errors[] = 'semester';
        }      
    
        if (empty($reference_no)) {
            $errors[] = 'reference_no';
        }          
    
        if (empty($file_name)) {
            $errors[] = 'p_file';
        }   
    
        if (!empty($errors)) {
            $errorString = implode(',', $errors);
            header("Location: ../Pre-Admission/payment_Form.php?errors=$errorString");
            exit;
        }
     }
 

function getErrorClass($field) {
    if (isset($_GET['errors'])) {
        $errors = explode(',', $_GET['errors']);
        if (in_array($field, $errors)) {
            return 'error';
        }
    }
    return '';
}

?>
