<?php
    require('../Database/asc_Registration_Form.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../Style/Submission_Success.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</head>
<body>

    <div class="form-container">
        <div class="top">
            <div class="img-container">
                <img class="success-img" src="../Images/submit.png" alt="">
            </div>
            <h3>Form submitted successfully!</h3>
            <div class="id-con">
                <p>Your Temporary ID is: <span><?php echo $result['id_stuInfo']?></span></p>
            </div>
        </div>
        <div class="bottom">
            <div><a href="../index.php" target="_top">Home</a></div>
            <button class="download">Download Form</button>
        </div>
    </div>
    
    <?php
    ob_start();
    include '../Student_Profile/Registration_Form.php';
    

    $content = ob_get_clean();
    ?>

    <div id="student_registrationForm" style="display: none;">
    
        <style>
            <?php include '../Style/registration_Form.css'; ?>
        </style>
        <?php echo $content; ?>
        
    </div>

    <script>
        let btn = document.querySelector(".download");
        btn.addEventListener('click', () => {
            
            let content = document.getElementById("student_registrationForm").innerHTML;
            
            html2pdf().from(content).set({ 
                filename: 'Registration_Form',
            }).save();
        });
    </script>

</body>
</html>