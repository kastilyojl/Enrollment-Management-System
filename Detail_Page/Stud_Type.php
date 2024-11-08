<?php require('../Pass_Value/unsetSession.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Type</title>

    <link rel="stylesheet" href="../Style/student_Type.css">
</head>
<body>

    <div class="container">
        <form class="card-container" action="./Form_Page.php" method="post">
            <div class="card">
                <div class="img_container">
                    <img src="../Images/stud-icon.png" alt="">
                </div>
                <div class="type_student">Senior High School</div>
                <button type="submit" value="../SHS/student.php" name="src">Register Now!</button>
            </div>
            <div class="card">
                <div class="img_container">
                    <img src="../Images/stud-icon.png" alt="">
                </div>
                <div class="type_student">College</div>
                <button type="submit" value="../College/student.php" name="src">Register Now!</button>
            </div>
        </form>
    </div>

    
</body>
</html>