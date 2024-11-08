<?php
    require('db.php');

    if(isset($_GET['id_stuInfo'])) {
        $temp_id = $_GET['id_stuInfo'];

        require('Data_Convertion.php');
    
        // student Info
        $queryStudRL = "SELECT * FROM d_studinfo WHERE id_stuInfo = '$temp_id'";
        $sqlStudRL = mysqli_query($connection, $queryStudRL);
        $result = mysqli_fetch_array($sqlStudRL); 

        $date = new DateTime($result['b_date']);

        // Format the date to 'F j, Y'
        $formattedDate = $date->format('F j, Y');

        $s_type_val = isset($s_type[$result['s_type']]) ? $s_type[$result['s_type']] : '';
        $branch_val = isset($branch[$result['e_branch']]) ? $branch[$result['e_branch']] : '';
        $dept_val = isset($dept[$result['dept']]) ? $dept[$result['dept']] : '';
        $gy_lvl_val = isset($gy_lvl[$result['gy_level']]) ? $gy_lvl[$result['gy_level']] : '';
        $sex_val = isset($sex[$result['sex']]) ? $sex[$result['sex']] : '';
        $str_crs_val = isset($str_crs[$result['str_crs']]) ? $str_crs[$result['str_crs']] : '';
        $cvl_stat_val = isset($cvl_stat[$result['cvl_stat']]) ? $cvl_stat[$result['cvl_stat']] : '';
        
    
        // student Edu BG
        $queryStudEduBG = "SELECT * FROM d_eduinfo WHERE id_eduInfo = '$temp_id'";
        $sqlStudEduBG = mysqli_query($connection, $queryStudEduBG);
        $result1 = mysqli_fetch_array($sqlStudEduBG);
        
    
        // 2x2 picture
        $res = mysqli_query($connection, "SELECT 2x2_pic FROM d_softcopy WHERE id_stuInfo = '$temp_id'");
        $row = mysqli_fetch_assoc(($res));
    
        // check softcopy
        $res1 = mysqli_query($connection, "SELECT * FROM d_softcopy WHERE id_stuInfo = '$temp_id'");
        $row1 = mysqli_fetch_assoc(($res1));
        $checked1 = !empty($row1['form138']) ? 'checked' : '';
        $checked2 = !empty($row1['esc_certificate']) ? 'checked' : '';
        $checked3 = !empty($row1['cert_gm']) ? 'checked' : '';
        $checked4 = !empty($row1['g10_certofreg']) ? 'checked' : '';
        $checked5 = !empty($row1['hon_diss']) ? 'checked' : '';
        $checked6 = !empty($row1['b_cert']) ? 'checked' : '';
        $checked7 = !empty($row1['2x2_pic']) ? 'checked' : '';



        // $p_plan_val = isset($p_plan[$result['p_plan']]) ? $p_plan[$result['p_plan']] : '';
        // $d_stat_val = isset($d_stat[$result['d_stat']]) ? $d_stat[$result['d_stat']] : '';
    
        // $admission_stat_val = isset($admission_stat[$result['admission_stat']]) ? $admission_stat[$result['admission_stat']] : '';
        // $admission_tag_val = isset($admission_tag[$result['admission_tag']]) ? $admission_tag[$result['admission_tag']] : '';
        }
?>