<?php
    
    require('db.php');

function generateUniqueID($connection) {
    do {
        $uniqueID = 'Temp-' . random_int(10000, 99999);
        $query = "SELECT id_stuInfo FROM d_studinfo WHERE id_stuInfo = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $uniqueID);
        $stmt->execute();
        $result = $stmt->get_result();
    } while ($result->num_rows > 0);

    $stmt->close();
    return $uniqueID;
}

    if(isset($_POST['create'])) {

        //create unique ID First
        // $uniqueID = 'Temp-'.uniqid();

        // Generate unique ID
        $uniqueID = generateUniqueID($connection);

        //Student Profile
        $lname = ucwords($_POST['lname']);
        $fname = ucwords($_POST['fname']);
        $mname = ucwords($_POST['mname']);
        $h_addr = $_POST['address'];
        $b_date = $_POST['birthdate'];
        $b_place = $_POST['placebirth'];
        $p_num = $_POST['cellphone'];
        $sex = intval($_POST['gender']);
        $rel = $_POST['religion'];
        $cvl_stat = intval($_POST['civilstatus']);
        $e_mail = $_POST['email'];

        $password_hash = password_hash('Password1234', PASSWORD_DEFAULT);

        // $sqlEmail = mysqli_query($connection, "INSERT INTO d_user VALUES ('$uniqueID', '$e_mail', 'Password1234' , '0', '0','0','0','1')");

        $query = "INSERT INTO users (id, username, password1, isused, usertype, name, last_name, email, email_verified_at, password, remember_token, admission_number, roll_number, note, class_id, gender, date_of_birth, mobile_number, marital_status, address, permanent_address, admission_date, profile_pic, blood_group, qualification, height, weight, user_type, is_delete, status, work_experience, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $connection->prepare($query);

        $temp0 = 1;
        $temp1 = 0;
        $temp3='0000-00-00 00:00:00';
        $temp4='0000-00-00';
        $temp = "na";
        $usertype = 5;

        // Bind parameters
        $stmt->bind_param("ssssssssssssssissssssssssssiiisss", $uniqueID, $temp, $temp, $temp, $temp, $temp, $temp, $e_mail, $temp3, $password_hash, $temp, $temp, $temp, $temp, $temp0, $temp, $temp4, $temp, $temp, $temp, $temp, $temp3, $temp, $temp, $temp, $temp, $temp, $usertype, $temp1, $temp1, $temp, $temp3, $temp3);
        $stmt->execute();
        
        
        //Academic Profile
        $s_type = intval($_POST['type']);
        $p_school = $_POST['prevschool'];
        $gy_level = intval($_POST['yrlevel']);
        $dept = intval($_POST['dept']);
        $e_branch = intval($_POST['branch']);
        $str_crs = $_POST['strand'];
        $lrn = $_POST['lrn'];
        $vou_type = $_POST['voucher'];
        $esc_cert = $_POST['ESC'];
        $scho_of = $_POST['Scholar'];

        //Parent Profile
        $mr_name = $_POST['mother'];
        $fr_name = $_POST['father'];
        $mr_occu = $_POST['motheroccupation'];
        $fr_occu = $_POST['fatheroccupation'];
        $mr_pnum = $_POST['motherphone'];
        $fr_pnum = $_POST['fatherphone'];
        $g_name = $_POST['guardian'];
        $g_occu = $_POST['guardianoccupation'];
        $g_pnum = $_POST['guardianphone'];

        $queryCreateStudInfo = "INSERT INTO d_studinfo(id_stuInfo, lname, fname, mname, s_type, p_school, e_branch, dept, gy_level, str_crs, vou_type, lrn, esc_cert, scho_of, h_addr, p_num, sex, rel, cvl_stat, b_date, b_place, m_name, m_occu, m_pnum, f_name, f_occu, f_pnum, g_name, g_occu, g_pnum, e_mail, stat, tagged, is_Enrolled, sem)
                            VALUES('$uniqueID', '$lname','$fname', '$mname', '$s_type', '$p_school', '$e_branch', '$dept', '$gy_level', '$str_crs', '$vou_type', '$lrn', '$esc_cert', '$scho_of', '$h_addr', '$p_num', '$sex', '$rel', '$cvl_stat', '$b_date', '$b_place' ,'$mr_name', '$mr_occu', '$mr_pnum', '$fr_name', '$fr_occu', '$fr_pnum', '$g_name', '$g_occu', '$g_pnum', '$e_mail', '0', '1', '0', '')";
        
        $sqlCreateStudInfo = mysqli_query($connection, $queryCreateStudInfo);

        //Education Background
        $g10_sch = $_POST['g10school'];
        $g10_yr = $_POST['g10yrlvl'];
        $yr_grad1 = $_POST['g10yrgraduate'];
        $g12_sch = $_POST['g12school'];
        $g12_yr = $_POST['g12yrlvl'];
        $yr_grad2 = $_POST['g12yrgraduate'];
        $tsd_sch = $_POST['TESDAschool'];
        $tsd_yr = $_POST['TESDAyrlvl'];
        $yr_grad3 = $_POST['TESDAyrgraduate'];
        
        $queryCreateEduBg = "INSERT INTO d_eduinfo(id_eduInfo, g10_sch, g10_yr, yr_grad1, g12_sch, g12_yr, yr_grad2, tsd_sch, tsd_yr, yr_grad3)
                        VALUES ('$uniqueID','$g10_sch','$g10_yr', '$yr_grad1', '$g12_sch', '$g12_yr', '$yr_grad2', '$tsd_sch', '$tsd_yr', '$yr_grad3')";
        
        $sqlCreateEduBg = mysqli_query($connection, $queryCreateEduBg);

        //Soft Copy
           
        // image
        if (isset($_FILES['2x2_pic'])) {
            if ($_FILES['2x2_pic']['error'] === UPLOAD_ERR_OK) {
                $file_name7 = addslashes(file_get_contents($_FILES['2x2_pic']['tmp_name']));
            } else {
                $file_name7 = '';
            }
        } else {
            $file_name7 = '';
        }

        $file_name1 = '';
        $file_name2 = '';
        $file_name3 = '';
        $file_name4 = '';
        $file_name5 = '';
        $file_name6 = '';
    
    $queryCreateSoftCopy = "INSERT INTO d_softcopy(id_stuInfo, name, form138, esc_certificate, cert_gm, g10_certofreg, hon_diss, b_cert, 2x2_pic, stat)
                            VALUES('$uniqueID', '', '$file_name1', '$file_name2', '$file_name3', '$file_name4', '$file_name5', '$file_name6', '$file_name7', '0')";
    
    $sqlCreateSoftCopy = mysqli_query($connection, $queryCreateSoftCopy);

    // reset value after form submission
    require('../Pass_Value/unsetSession.php');

    // echo '<script>alert("Sucessfully created!")</script>';
    header("Location: ../Detail_Page/registration_submit.php?id_stuInfo=$uniqueID");

    exit;

    }
    

?>