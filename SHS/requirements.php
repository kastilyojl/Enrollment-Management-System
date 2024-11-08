<?php require('../Detail_Page/restriction.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirements - SHS</title>
    <link rel="stylesheet" href="../Style/Admission_Form.css">
</head>
<body>

    <script> window.onload = function() { progressBar(4); }; </script>

    <div class="container">
            <div class="header">
                <h3>Requirements</h3>
            </div>
            <form class="form" action="../Database/asc_Student.php" method="post" enctype="multipart/form-data">
                <?php
                    EduBG();
                    require('../Pass_Value/val_student.php');
                    require('../Pass_Value/val_academic.php');
                    require('../Pass_Value/val_parents.php');
                    require('../Pass_Value/val_edu_bg.php');
                ?>
                
                <div class="content requirements">
                    <div class="input twobytwo">
                        <label>2x2 Picture</label>
                        <input type="file" name="2x2_pic" accept="image/*">
                    </div>
                    <br>
                    
                    <div class="input hard_copy">
                        <label>Hard Copy</label>
                    </div>
                    <div class="input">
                        <label>ESC Certificate (if applicable)</label>
                        <!-- <input type="file" name="esc_certificate" accept="image/*" disabled> -->
                    </div>
                    <div class="input">
                        <label>Certificate of Good Moral</label>
                        <!-- <input type="file" name="cert_gm" accept="image/*" disabled> -->
                    </div>
                    <div class="input">
                        <label>G10 Certificate of Recognition</label>
                        <!-- <input type="file" name="g10_certofreg" accept="image/*" disabled> -->
                    </div>
                    <div class="input">
                        <label>Honorable Dismissal</label>
                        <!-- <input type="file" name="hon_diss" accept="image/*" disabled> -->
                    </div>
                    <div class="input">
                        <label>Birth Certificate</label>
                        <!-- <input type="file" name="b_cert" accept="image/*" disabled> -->
                    </div>
                    <div class="input">
                        <label>Form 138 (JHS/SHS Card)</label>
                        <!-- <input type="file" name="form138" accept="image/*" disabled> -->
                    </div>
                    <div class="input">
                        <label>Transcript of Record (TCR) or F137</label>
                        <!-- <input type="file" name="image" accept="image/*" disabled> -->
                    </div>                 
                    <div class="note">
                        <label>Note: Submit the requirments above to the registrar</label>
                    </div>
                </div>

                <div class="footer">
                    <button class="back" type="button" value="Back" onclick="goBack1('edu_bg')">Back</button>
                    <button class="next" type="submit" name="create" value="Submit">Submit</button>
                </div>
            </form>
        </div>

        <script src="../Javascript/Admission_Form.js"></script>
        <script src="../Javascript/Form_Page.js"></script>

</body>
</html>