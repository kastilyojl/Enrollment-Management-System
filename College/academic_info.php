<?php require('../Detail_Page/restriction.php'); 

require('../Database/db.php'); 
 
 $prog_codes = [];
 $sql = "SELECT prog_code FROM d_program WHERE prog_dept='COLLEGE'";
 $stmt = $connection->prepare($sql);
 $stmt->execute();
 $result = $stmt->get_result();

 if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prog_codes[] = htmlspecialchars($row["prog_code"]);
    } 
 }

 $stmt->close();
 $connection->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Information - College</title>
    <link rel="stylesheet" href="../Style/Admission_Form.css">

    <style>
        #inputBox, #inputBoxESC, #inputBoxScholar{
            display: none;
        }
        @media screen and (max-width: 680px) {
            .content {
                display: flex;
                flex-direction: column;
            }
        }
        @keyframes blink-border {
            0% { border-color: red; }
            20% { border-color: transparent; }
            40% { border-color: red; }
            60% { border-color: transparent; }
            80% { border-color: red; }
            100% { border-color: transparent; }
        }

        .error {
            animation: blink-border 1s;
            border-color: red;
        }
    </style>

</head>
<body>
<?php studentProfile();?>

<script> window.onload = function() { progressBar(1); }; </script>

    <div class="container">
            <div class="header">
                <h3>Academic Information</h3>
            </div>
            <form class="form" action="./parents.php" method="post">
                <?php
                    studentProfile();
                    require('../Pass_Value/val_student.php');
                ?>                
                <div class="content">
                    <div class="input">
                        <label>Semester</label>
                        <input type="text" name="semester" readOnly>
                    </div>
                    <div class="input ">
                        <label class="required">Department</label> <br>              
                        <input type="radio" name="dept" value="" onclick="return false;"><label>SHS</label>
                        <input type="radio" name="dept" value="2" checked onclick="return false;"><label>College</label>
                    </div>
                    <div class="input">
                        <label class="required">Type of Student</label><br>
                        <input type="radio" name="type" onclick="hideShowInputBox('hide')" value="2" <?php echo ($s_type_value == 2) ? 'checked' : ''; ?> class="<?php echo getErrorClass('type'); ?>"><label>Old Student</label>
                        <input type="radio" name="type" onclick="hideShowInputBox('show')" value="1" <?php echo ($s_type_value == 1) ? 'checked' : ''; ?> class="<?php echo getErrorClass('type'); ?>"><label>New Student</label>
                        <input id="inputBox" name="prevschool" type="text" placeholder="Enter Previous School" value="<?php echo $p_school_value; ?>">
                    </div>
                    <div class="input col-span2">
                        <label class="required">Year Level</label><br>
                        <input type="radio" value="1" name="yrlevel" <?php echo ($gy_level_value == 1) ? 'checked' : ''; ?> class="<?php echo getErrorClass('yrlevel'); ?>"><label>1st Year</label>
                        <input type="radio" value="2" name="yrlevel" <?php echo ($gy_level_value == 2) ? 'checked' : ''; ?> class="<?php echo getErrorClass('yrlevel'); ?>"><label>2nd Year</label>
                        <input type="radio" value="3" name="yrlevel" <?php echo ($gy_level_value == 3) ? 'checked' : ''; ?> class="<?php echo getErrorClass('yrlevel'); ?>"><label>3rd Year</label>
                        <input type="radio" value="4" name="yrlevel" <?php echo ($gy_level_value == 4) ? 'checked' : ''; ?> class="<?php echo getErrorClass('yrlevel'); ?>"><label>4th Year</label>
                    </div>
                    <div class="input col-span2">
                    <label class="required">Campus</label><br>
                        <input type="radio" name="branch" value="1" <?php echo ($e_branch_value == 1) ? 'checked' : ''; ?> class="<?php echo getErrorClass('branch'); ?>"><label>Banlic</label>
                        <input type="radio" name="branch" value="2" <?php echo ($e_branch_value == 2) ? 'checked' : ''; ?> class="<?php echo getErrorClass('branch'); ?>"><label>Uno</label>
                        <input type="radio" name="branch" value="3" <?php echo ($e_branch_value == 3) ? 'checked' : ''; ?> disabled><label>Marinig</label>
                        <input type="radio" name="branch" value="4" <?php echo ($e_branch_value == 4) ? 'checked' : ''; ?> disabled><label>San Jose</label>
                        <input type="radio" name="branch" value="5" <?php echo ($e_branch_value == 5) ? 'checked' : ''; ?> disabled><label>San Mateo</label>
                    </div>
                    <div class="input">
                        <label class="required">Bachelor of Science in</label>
                        <select name="strand" id="strand" class="<?php echo getErrorClass('strand'); ?>">
                            <option value="" disabled hidden selected>Select Track/Strand</option>
                            <?php foreach($prog_codes as $code) : ?>
                                <option value="<?= $code ?>"><?= $code?></option>
                            <?php endforeach;?>
                        </select>
                    </div> 
                </div>

                <div class="footer">
                    <button class="back" type="button" value="Back" onclick="goBack1('student')">Back</button>
                    <button class="next" name="academic_form" type="submit" value="Next">Next</button>
                </div>
            </form>
        </div>

        <script src="../Javascript/Admission_Form.js"></script>
        <script src="../Javascript/Form_Page.js"></script>
        <script src="../Javascript/Form_Restriction.js"></script>
    
</body>
</html>