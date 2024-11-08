<?php require('../Detail_Page/restriction.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents - SHS</title>
    <link rel="stylesheet" href="../Style/Admission_Form.css">
</head>
<body>

    <script> window.onload = function() { progressBar(2); }; </script>
    
    <div class="container">
            <div class="header">
                <h3>Parents Profile</h3>
            </div>
            <form class="form" action="./edu_bg.php" method="post">
                <?php
                    AcademicInfo(); 
                    require('../Pass_Value/val_student.php');
                    require('../Pass_Value/val_academic.php');
                ?>
                <div class="content">
                    <div class="input">
                        <label>Mother</label>
                        <input type="text" style="text-transform: capitalize;" placeholder="Mother's Name" name="mother" value="<?php echo $mr_name_value; ?>">
                    </div>
                    <div class="input">
                        <label>Father</label>
                        <input type="text" style="text-transform: capitalize;" placeholder="Father's Name" name="father" value="<?php echo $fr_name_value; ?>">
                    </div>
                    <div class="input">
                        <label>Mother's Occupation</label>
                        <input type="text" style="text-transform: capitalize;" placeholder="Mother's Occupation" name="motheroccupation" value="<?php echo $mr_occu_value; ?>">
                    </div>
                    <div class="input">
                        <label>Father's Occupation</label>
                        <input type="text" style="text-transform: capitalize;" placeholder="Father's Occupation" name="fatheroccupation" value="<?php echo $fr_occu_value; ?>">
                    </div>
                    <div class="input">
                        <label>Mother's Cellphone #</label>
                        <div class="cell-container">
                            <span>(+63)</span>
                            <input type="tel" id="telephone" name="motherphone" minlength="10" maxlength="10" value="<?php echo $mr_pnum_value; ?>">
                        </div>
                    </div>
                    <div class="input">
                        <label>Father's Cellphone #</label>
                        <div class="cell-container">
                            <span>(+63)</span>
                            <input type="tel" id="telephone" name="fatherphone" minlength="10" maxlength="10" value="<?php echo $fr_pnum_value; ?>">
                        </div>
                    </div>
                    <div class="input">
                        <label>Guardian</label>
                        <input type="text" style="text-transform: capitalize;" placeholder="Guardian's Name" name="guardian" value="<?php echo $g_name_value; ?>">
                    </div>
                    <div class="input">
                        <label>Guardian's Occupation</label>
                        <input type="text" style="text-transform: capitalize;" placeholder="Guardian's Occupation" name="guardianoccupation" value="<?php echo $g_occu_value; ?>">
                    </div>       
                    <div class="input">
                        <label>Guardian's Cellphone #</label>
                        <div class="cell-container">
                            <span>(+63)</span>
                            <input type="tel" id="telephone" name="guardianphone" minlength="10" maxlength="10" value="<?php echo $g_pnum_value; ?>">
                        </div>
                    </div>     
                </div>

                <div class="footer">
                    <button class="back" type="button" value="Back" onclick="goBack1('academic_info')">Back</button>
                    <button class="next" name="Parent_form" type="submit" value="Next">Next</button>
                </div>
            </form>
        </div>

        <script src="../Javascript/Admission_Form.js"></script>
        <script src="../Javascript/Form_Page.js"></script>
    
</body>
</html>