<?php

    $_SESSION['email'] = $userInfo['e_mail'];
    $_SESSION['id_stuInfo'] = $userInfo['id_stuInfo'];
    $_SESSION['lname'] = $userInfo['lname'];
    $_SESSION['fname'] = $userInfo['fname'];
    $_SESSION['mname'] = $userInfo['mname'];
    $_SESSION['h_addr'] = $userInfo['h_addr'];
    $_SESSION['b_place'] = $userInfo['b_place'];
    $_SESSION['b_date'] = $userInfo['b_date'];
    $_SESSION['p_num'] = $userInfo['p_num'];
    $_SESSION['sex'] = $userInfo['sex'];
    $_SESSION['rel'] = $userInfo['rel'];
    $_SESSION['str_crs'] = $userInfo['str_crs'];
    $_SESSION['dept'] = $userInfo['dept'];

    $_SESSION['cvl_stat'] = $cvl_stat[$userInfo['cvl_stat']];
    $_SESSION['dept'] = $dept[$userInfo['dept']];
    $_SESSION['gy_level'] = $gy_lvl[$userInfo['gy_level']];

    $_SESSION['m_name'] = $userInfo['m_name'];
    $_SESSION['f_name'] = $userInfo['f_name'];
    $_SESSION['m_occu'] = $userInfo['m_occu'];
    $_SESSION['f_occu'] = $userInfo['f_occu'];
    $_SESSION['m_pnum'] = $userInfo['m_pnum'];
    $_SESSION['f_pnum'] = $userInfo['f_pnum'];
    $_SESSION['g_name'] = $userInfo['g_name'];
    $_SESSION['g_occu'] = $userInfo['g_occu'];
    $_SESSION['g_pnum'] = $userInfo['g_pnum'];

    $_SESSION['g10_sch'] = $EduInfo['g10_sch'];
    $_SESSION['g10_yr'] = $EduInfo['g10_yr'];
    $_SESSION['yr_grad1'] = $EduInfo['yr_grad1'];
    $_SESSION['g12_sch'] = $EduInfo['g12_sch'];
    $_SESSION['g12_yr'] = $EduInfo['g12_yr'];
    $_SESSION['yr_grad2'] = $EduInfo['yr_grad2'];
    $_SESSION['tsd_sch'] = $EduInfo['tsd_sch'];
    $_SESSION['tsd_yr'] = $EduInfo['tsd_yr'];
    $_SESSION['yr_grad3'] = $EduInfo['yr_grad3'];

    $_SESSION['2x2_pic'] = $SoftCopy['2x2_pic'];

    $_SESSION['id_clearance'] = $Clearance['id_clearance'];
?>