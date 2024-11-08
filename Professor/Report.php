<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make A Report</title>
    <link rel="stylesheet" href="../Style/Report.css">
</head>
<body>

    <div class="container">
        <form action="../Database/epCB_Report.php" method="post">
            <div class="header">
                <h3>Make A Report</h3>
            </div>
            <div class="student">
                <input type="text" name="stud_no" placeholder="Enter Student No.">
                <input type="text" name="stud_name" placeholder="Enter Student Name">
            </div>
            <div>
                <input readonly style="text-transform:none" type="text" name="sender_name" placeholder="Enter Professor Name" value="<?php echo (!empty($_SESSION['email']) ? $_SESSION['email'] : '')?>">
                <textarea name="report_text" placeholder="Enter Report"></textarea>
            </div>
            <button style="cursor: pointer;" type="submit" name="submitReport">Submit</button>
        </form>
    </div>

</body>
</html>