<?php require('../Detail_Page/restriction.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirements - SHS</title>
    <link rel="stylesheet" href="../Style/Admission_Form.css">

    <style>
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
            accent-color: red;
        }
    </style>

</head>
<body>

    <div class="container">
            <div class="header">
                <h3>Student Profile</h3>
            </div>
            <form class="form" action="./academic_info.php" method="post">
                
                <div class="content">
                    <div class="input col-span2">
                        <label class="required" for="Name">Name</label>
                        <div class="align name">
                            <input type="text" style="text-transform: capitalize;" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lname_value; ?>"  class="<?php echo getErrorClass('lname'); ?>">
                            <input type="text" style="text-transform: capitalize;" id="fname" name="fname" placeholder="First Name"  value="<?php echo $fname_value; ?>"  class="<?php echo getErrorClass('fname'); ?>">
                            <input type="text" style="text-transform: capitalize;" id="mname" name="mname" placeholder="Middle Name" value="<?php echo $mname_value; ?>">
                        </div>
                    </div>
                    <div class="input col-span2">
                        <label class="required">Address</label>
                        <input type="text" style="text-transform: capitalize;" id="address" name="address" placeholder="Enter Home Address" value="<?php echo $h_addr_value; ?>" class="<?php echo getErrorClass('address'); ?>">
                    </div>
                    <div class="input">
                        <label class="required">Place of Birth</label>
                        <input type="text" style="text-transform: capitalize;" id="placebirth" name="placebirth" placeholder="Enter Place of Birth" value="<?php echo $b_place_value; ?>" class="<?php echo getErrorClass('placebirth'); ?>">
                    </div>
                    <div class="input">
                        <label class="required">Date of Birth</label>
                        <input type="date" id="birthdate" name="birthdate" min="1980-01-01" max="2020-12-31" value="<?php echo $b_date_value; ?>" class="<?php echo getErrorClass('birthdate'); ?>">
                    </div>
                    <div class="input">
                        <label>Cellphone Number</label>
                            <div class="cell-container">
                                <span>(+63)</span>
                                <input type="tel" id="telephone" name="cellphone" minlength="10" maxlength="10" value="<?php echo $p_num_value; ?>">
                            </div>
                    </div>
                    <div class="input gender-side">
                        <label class="required">Gender</label> <br>
                        <div class="align gender">
                            <label class="radio-button">Male</label><input type="radio" name="gender" id="male" value="1" <?php echo ($sex_value == 1) ? 'checked' : ''; ?>>
                            <label class="radio-button">Female</label><input type="radio" name="gender" id="female" value="2" <?php echo ($sex_value == 2) ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="input">
                        <label>Religion</label>
                        <input type="text" style="text-transform: capitalize;" name="religion" placeholder="Religion" value="<?php echo $rel_value; ?>">
                    </div>
                    <div class="input">
                        <label class="required">Civil Status</label>
                            <select name="civilstatus" id="civilstatus" class="<?php echo getErrorClass('civilstatus'); ?>">
                                <option value="" hidden>Select Civil Status</option>
                                <option value="1" <?php echo ($cvl_stat_value == 1) ? 'selected' : ''; ?>>Single</option>
                                <option value="2" <?php echo ($cvl_stat_value == 2) ? 'selected' : ''; ?>>Married</option>
                                <option value="3" <?php echo ($cvl_stat_value == 3) ? 'selected' : ''; ?>>Widowed</option>
                                <option value="4" <?php echo ($cvl_stat_value == 4) ? 'selected' : ''; ?>>Legally Seperated</option>
                            </select>
                    </div>
                    <div class="input">
                        <label class="required">Email</label> <br>
                        <div class="align email">
                            <input type="email" id="email" name="email" placeholder="Enter Email Address" value="<?php echo $e_mail_value; ?>" class="<?php echo getErrorClass('email'); ?>">
                        </div>
                    </div>

                </div>

                <div class="footer">
                    <div class="note">Note: Fill out required (*) field to proceed.</div>
                    <button class="next" type="submit" name="student_form">Next</button>
                </div>
            </form>
        </div>

        <script src="../Javascript/Admission_Form.js"></script>
        <script src="../Javascript/Form_Page.js"></script>
        <script src="../Javascript/Form_Restriction.js"></script>
    
</body>
</html>