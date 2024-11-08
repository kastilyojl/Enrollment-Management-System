<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <link rel="stylesheet" href="../Style/Form_Page.css">

</head>
<body>

    <?php $src = $_POST['src']; ?>

    <div class="container">
        <div class="header">
            <div class="h-left">
                <img id="logo" src="../Images/sample-school-logo.png" alt="">
                <h3>Academy</h3>
            </div>
            <div class="h-right">
                <h4 class="need-help"><a href="../how_to.php#online_registration" target="_blank">Need Help</a></h4>
                <span class="help-icon">?</span>
            </div>
        </div>
        <div class="content">
            <div class="left-side">
                <div class="title">
                    <h3>Registration Form</h3>
                    <p>Fill out the form for registration</p>
                </div>
                <div class="list-container">
                    <div class="list" id="student-profile">Student Profile</div>
                    <div class="list" id="academic-info">Academic Information</div>
                    <div class="list" id="parent-info">Parents Profile</div>
                    <div class="list" id="edu-bg">Education Background</div>
                    <div class="list" id="requirements">Requirements</div>
                </div>
            </div>
            <div class="right-side">
                <div class="frame-container">
                    <iframe src="<?php echo $src ?>" frameborder="0" width="100%" height="100%"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="../Javascript/Form_Page"></script>

</body>
</html>