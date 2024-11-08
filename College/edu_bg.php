<?php require('../Detail_Page/restriction.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Background - College</title>
    <link rel="stylesheet" href="../Style/Admission_Form.css">

    <style>
        @media screen and (max-width: 680px) {
            .content {
                display: flex;
                flex-direction: column;
            }
        }
    </style>

</head>
<body>

    <script> window.onload = function() { progressBar(3); }; </script>

    <div class="container">
        <div class="header">
            <h3>Education Background</h3>
        </div>
        <form class="form" action="./requirements.php" method="post">
            <?php
                ParentInfo();
                require('../Pass_Value/val_student.php');
                require('../Pass_Value/val_academic.php');
                require('../Pass_Value/val_parents.php');
             ?>
            <div class="content">
                <div class="input col-span2">
                    <label>High School (G10)</label>
                    <input type="text" style="text-transform: capitalize;" name="g10school" placeholder="Name of school" value="<?php echo $g10_sch_value; ?>">
                </div>
                <div class="input">
                    <label>Year Level</label>
                    <input type="text" style="text-transform: capitalize;" name="g10yrlvl" placeholder="E.g. Grade 10" value="<?php echo $g10_yr_value; ?>">
                </div>
                <div class="input">
                    <label>Year Graduated</label>
                    <input type="text" style="text-transform: capitalize;" name="g10yrgraduate" accept="numbers" value="<?php echo $yr_grad1_value; ?>">
                </div>

                <div class="input col-span2">
                    <label>High School (G12)</label>
                    <input type="text" style="text-transform: capitalize;" name="g12school" placeholder="Name of school" value="<?php echo $g12_sch_value; ?>">
                </div>
                <div class="input">
                    <label>Year Level</label>
                    <input type="text" style="text-transform: capitalize;" name="g12yrlvl" placeholder="E.g. Grade 12" value="<?php echo $g12_yr_value; ?>">
                </div>
                <div class="input">
                    <label>Year Graduated</label>
                    <input type="text" style="text-transform: capitalize;" name="g12yrgraduate"  value="<?php echo $yr_grad2_value; ?>">
                </div>
                    
                <div class="input col-span2">
                    <label>TESDA NC</label>
                    <input type="text" style="text-transform: capitalize;" name="TESDAschool" placeholder="Name of school" value="<?php echo $tsd_sch_value; ?>">
                </div>
                <div class="input">
                    <label>Year Level</label>
                    <input type="text" style="text-transform: capitalize;" name="TESDAyrlvl" placeholder="" value="<?php echo $tsd_yr_value; ?>">
                </div>
                <div class="input">
                    <label>Year Graduated</label>
                    <input type="text" style="text-transform: capitalize;" name="TESDAyrgraduate" value="<?php echo $yr_grad3_value; ?>">
                </div>

            </div>
            <div class="footer">
                <button class="back" type="button" value="Back" onclick="goBack1('parents')">Back</button>
                <button class="next" name="EduBG_Form" type="submit" value="Next">Next</button>
            </div>

        </form>
    </div>

        <script src="../Javascript/Admission_Form.js"></script>
        <script src="../Javascript/Form_Page.js"></script>
    
</body>
</html>