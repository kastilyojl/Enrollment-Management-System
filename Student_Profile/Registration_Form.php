<?php require('../Database/asc_Registration_Form.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="../Style/registration_Form.css">
</head>
<body>

    <div class="container" class="Registration_Form">
        <div class="header">
            <div class="left-side">

                <div class="stud_pic">
                    <?php

                        if(!empty($row['2x2_pic'])) {
                            echo '<img class="profile" src="data:image/*;base64,'.base64_encode($row['2x2_pic']).'"/>';
                        } 
                        else if(empty($row['2x2_pic'])){ ?>
                            <img class="default-profile" src="../Images/profile-icon.png">
                        <?php } 
                    ?>
                
                </div>
                
            </div>
            <div class="center">
                <h1>Student Registration Form</h1>
            </div>
            <div class="right-side">
                <img src="../Images/sample-school-logo.png" alt="">
            </div>
        </div>
        <div class="info">

            <div class="id-container">
                <label>ID No. </label> <br>
                <?php echo $result['id_stuInfo']?>
            </div>

            <div class="title">Student Profile</div>
            <div class="fieldset">
                <div><label>Name: </label><?php echo $result['lname'].', '.$result['fname']. ' ' .$result['mname']?></div>
                <div id="email_css"><label>Email Address: </label><?php echo $result['e_mail']?></div>
                <div><label>Address: </label><?php echo $result['h_addr']?></div>
                <div><label>Cellphone No. </label><?php echo $result['p_num']?></div>
                <div><label>Place of Birth: </label><?php echo $result['b_place']?></div>
                <div><label>Date of Birth: </label><?php echo $formattedDate?></div>
                <div><label>Gender </label><?php echo $sex_val?></div>
                <div><label>Religion: </label><?php echo $result['rel']?></div>
                <div><label>Civil Status: </label><?php echo $cvl_stat_val?></div>        
            </div>
        
            <div class="title">Academic Information</div>
            <div class="fieldset">
                <div><label>Type Of Student: </label><?php echo $s_type_val?></div>
                <div><label>Previous School: </label><?php echo $result['p_school']?></div>
                <div><label>Department: </label><?php echo $dept_val?></div>
                <div><label>Grade Level: </label><?php echo $gy_lvl_val?></div>
                <div><label>Track/Strand: </label><?php echo $result['str_crs']?></div>
                <div><label>Campus: </label><?php echo $branch_val?></div>
                <div><label>LRN: </label><?php echo $result['lrn']?></div>
                <div><label>Voucher Type: </label><?php echo $result['vou_type']?></div>
                <div><label>ESC Certificate: </label><?php echo $result['esc_cert']?></div>
                <div><label>Scholar: </label><?php echo $result['scho_of']?></div>
            </div>

            <div class="title">Parent Information</div>
            <div class="fieldset">
                <div><label>Mother's Name: </label><?php echo $result['m_name']?></div>
                <div><label>Father's Name: </label><?php echo $result['f_name']?></div>
                <div><label>Mother's Occupation: </label><?php echo $result['m_occu']?></div>
                <div><label>Father's Occupation: </label><?php echo $result['f_occu']?></div>
                <div><label>Mother's Phone No. : </label><?php echo $result['m_pnum']?></div>
                <div><label>Father's Phone No. : </label><?php echo $result['f_pnum']?></div>
                <div><label>Guardian's Name: </label><?php echo $result['g_name']?></div>
                <div><label>Guardian's Occupation: </label><?php echo $result['g_occu']?></div>
                <div><label>Guardian's Phone No. : </label><?php echo $result['g_pnum']?></div>
            </div>

            <div class="title">Education Background</div>
            <div class="fieldset">
                <div><label>High School (G10): </label><?php echo $result1['g10_sch']?></div>
                <div><label>Year Level: </label><?php echo $result1['g10_yr']?></div>
                <div><label>Year Graduated: </label><?php echo $result1['yr_grad1']?></div>
                <div><label>High School (G12): </label><?php echo $result1['g12_sch']?></div>
                <div><label>Year Level: </label><?php echo $result1['g12_yr']?></div>
                <div><label>Year Graduated: </label><?php echo $result1['g12_yr']?></div>
                <div><label>TESDA NC: </label><?php echo $result1['tsd_sch']?></div>
                <div><label>Year Level: </label><?php echo $result1['tsd_yr']?></div>
                <div><label>Year Graduated: </label><?php echo $result1['yr_grad3']?></div>
            </div>

            <div class="title">Requirements - Soft Copy</div>
            <div class="fieldset">

                <div><label>Form 138 (JHS/SHS Card)</label><input type="checkbox" <?php echo $checked1?> readonly onclick="return false;"></div>
                <div><label>Certificate of Good Moral</label><input type="checkbox" <?php echo $checked2?> readonly onclick="return false;"></div>
                <div><label>G10 Certificate of Recognition</label><input type="checkbox" <?php echo $checked3?> readonly onclick="return false;"></div>
                <div><label>Transcript of Record (TCR) or F137</label><input type="checkbox" disabled></div>
                <div><label>ESC Certificate</label><input type="checkbox" <?php echo $checked4?> readonly onclick="return false;"></div>
                <div><label>Honorable of Dismissal</label><input type="checkbox" <?php echo $checked5?> readonly onclick="return false;"></div>
                <div><label>Birth Certificate</label><input type="checkbox" readonly <?php echo $checked6?> readonly onclick="return false;"></div>
                <div><label>2x2 Picture</label><input type="checkbox" <?php echo $checked7?> readonly onclick="return false;"></div>
            </div>

        </div>

    </div>

</body>
</html>