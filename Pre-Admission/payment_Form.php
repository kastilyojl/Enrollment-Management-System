<?php require('../Detail_Page/restriction.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Verification</title>

    <link rel="stylesheet" href="../Style/Admission_Form.css">

    <style> 
        #inputBox{
        display: none;
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
            accent-color: red;
        }

    </style>

</head>
<body>

    <div class="container">
            <div class="header">
                <h3>Payment</h3>
            </div>
            <form class="form" action="../Database/asc_Payment.php" method="post" enctype="multipart/form-data">

                <div class="content">
                    <div class="input">
                        <label class="required">Student ID No.</label>
                        <input type="text" id="id_payver" name="id_payver" placeholder="Enter student no." value="<?php echo $id_payver_val; ?>" class="<?php echo getErrorClass('id_payver'); ?>">
                    </div>
                    <div class="input">
                        <label class="required">Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Last Name, First Name, M.I." value="<?php echo $fullname_val; ?>" class="<?php echo getErrorClass('fullname'); ?>">
                    </div>
                    <div class="input">
                        <label class="required">Amount</label>
                        <input type="text" id="amount" placeholder="Enter Amount" name="amount" value="<?php echo $amount_val; ?>" class="<?php echo getErrorClass('amount'); ?>">
                    </div>
                    <div class="input">
                        <label class="required">Purpose</label>
                        <select name="purpose" id="purpose" value="<?php echo $purpose_val; ?>" class="<?php echo getErrorClass('purpose'); ?>">
                            <option value="" hidden>Select</option>
                            <option value="Graduation Fee"    <?php echo ($purpose_val == "Graduation Fee") ? 'selected' : ''; ?>>Graduation Fee</option>
                            <option value="Tuition Fee"       <?php echo ($purpose_val == "Tuition Fee") ? 'selected' : ''; ?>>Tuition Fee</option>
                            <option value="Request Documents" <?php echo ($purpose_val == "Request Documents") ? 'selected' : ''; ?>>Request For Documents</option>
                        </select>
                    </div>
                    <div class="input">
                        <label class="required">Semester</label>
                        <select name="semester" id="semester" class="<?php echo getErrorClass('semester'); ?>">
                            <option value="" hidden>Select</option>
                            <option value="1st" <?php echo ($semester_val == "1st") ? 'selected' : ''; ?>>1st Semester</option>
                            <option value="2nd" <?php echo ($semester_val == "2nd") ? 'selected' : ''; ?>>2nd Semester</option>
                        </select>
                    </div>
                    <div class="input">
                        <label class="required">Reference #</label>
                        <input type="tel" id="reference_no" placeholder="Enter reference #" name="reference_no" value="<?php echo $reference_no_val; ?>" class="<?php echo getErrorClass('reference_no'); ?>">
                    </div>
                    <div class="input">
                        <label>Alumni Card Granted</label><br>
                        <input type="radio" name="type" value="2" <?php echo ($type_val == 2) ? 'checked' : ''; ?> onclick="hideShowInputBox('hide')"><label>No</label>
                        <input type="radio" name="type" value="1" <?php echo ($type_val == 1) ? 'checked' : ''; ?> onclick="hideShowInputBox('show')"><label>Yes</label>
                        <input id="inputBox" name="alumnicard" type="file" accept="image/*">
                    </div>
                    <div class="input col-span2">
                        <label for="receipt" class="required">Upload Receipt</label>
                        <input type="file" id="p_file" name="p_file" accept="image/*" value="<?php echo $file_name?>" class="<?php echo getErrorClass('p_file'); ?>">
                    </div>
                    
                </div>

                <div class="footer">
                    <div class="note">Note: Fill out required (*) field to proceed.</div>
                    <button class="next" type="submit" name="submitPayment">Submit</button>
                </div>
            </form>

        </div>

        <script src="../Javascript/Admission_Form"></script>
        <script src="../Javascript/Form_Restriction"></script>

</body>
</html>