<?php require('../Detail_Page/restriction.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Verification</title>

    <link rel="stylesheet" href="../Style/Admission_Form.css">

    <style> 
        .container {
            grid-template-rows: 1fr;
        }
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
          
            <form class="form" action="../Database/asc_Payment.php" method="post" enctype="multipart/form-data">

                <div class="content">
                    <div class="input">
                        <label class="required">Student ID No.</label>
                        <input type="text" id="id_payver" name="id_payver" placeholder="Enter student no." readonly value="<?php echo $_SESSION['id_stuInfo']; ?>" class="<?php echo getErrorClass('id_payver'); ?>">
                    </div>
                    <div class="input">
                        <label class="required">Name</label>
                        <input type="text" id="fullname" name="fullname" readonly placeholder="Last Name, First Name, M.I." value="<?php 
                    echo (isset($_SESSION['lname']) ? $_SESSION['lname'] : '') . ", " . 
                        (isset($_SESSION['fname']) ? $_SESSION['fname'] : '') . " " . 
                        (isset($_SESSION['mname']) ? $_SESSION['mname'] : ''); 
                    ?>" class="<?php echo getErrorClass('fullname'); ?>">
                    </div>
                    <div class="input">
                        <label class="required">Amount</label>
                        <input type="text" id="amount" placeholder="Enter Amount" name="amount" class="<?php echo getErrorClass('amount'); ?>">
                    </div>
                    <div class="input">
                        <label class="required">Purpose</label>
                        <select name="purpose" id="purpose" class="<?php echo getErrorClass('purpose'); ?>">
                            <option value="" hidden>Select</option>
                            <option value="Graduation Fee">Graduation Fee</option>
                            <option value="Tuition Fee">Tuition Fee</option>
                            <option value="Request Documents">Request For Documents</option>
                        </select>
                    </div>
                    <div class="input">
                        <label class="required">Semester</label>
                        <select name="semester" id="semester" class="<?php echo getErrorClass('semester'); ?>">
                            <option value="" hidden>Select</option>
                            <option value="1st">1st Semester</option>
                            <option value="2nd">2nd Semester</option>
                        </select>
                    </div>
                    <div class="input">
                        <label class="required">Reference #</label>
                        <input type="tel" id="reference_no" placeholder="Enter reference #" name="reference_no" class="<?php echo getErrorClass('reference_no'); ?>">
                    </div>
                    <div class="input" hidden>
                        <label class="required">Alumni Card Granted</label><br>
                        <input type="radio" name="type" value="2" onclick="hideShowInputBox('hide')"><label>No</label>
                        <input type="radio" name="type" value="1" onclick="hideShowInputBox('show')"><label>Yes</label>
                        <input id="inputBox" name="alumnicard" type="file" accept="image/*">
                    </div>
                    <div class="input col-span2">
                        <label for="receipt" class="required">Upload Receipt</label>
                        <input type="file" id="p_file" name="p_file" accept="image/*" class="<?php echo getErrorClass('p_file'); ?>">
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