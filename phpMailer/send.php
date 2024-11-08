<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    require ('../Database/arCB_Registration.php');
   
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'castillojlb0922@gmail.com'; // my gmail
        $mail->Password = 'poycszhjyhxyxmhn'; // my gmail app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('castillojlb0922@gmail.com');

        $mail->addAddress($_SESSION['email']);

        // $mail->Subject = "Congratulations! Your Application Has Been Approved";

        $name = $_SESSION['lname'] . ' ' . $_SESSION['fname'] . ' ' . $_SESSION['mname'];

        $sub1 = "Congratulations! Your Application Has Been Approved";
        $sub2 = "We're Sorry! Your Application Has Been Denied";
    
        $text = "Dear $name,

        We are thrilled to inform you that your application has been officially approved!
We are excited to welcome you to [School Name]. Please take a moment to review the next steps outlined below: <br>

1. Login using your student account below:
    Username: {$_SESSION['email']}
    Password: Password1234
2. Make sure to submit any outstanding documents

If you have any questions or need assistance, feel free to reach out.

Congratulations once again, and we look forward to seeing you soon!";

        $text1 = "Dear $name,
        
        Thank you for your interest in [School Name]. We regret to inform you that your application has not been successful this time.
We encourage you to seek feedback and consider reapplying in the future.

Best wishes for your academic journey.";

        $mail->isHTML = true;
        
        if($Tag == 3) {
            $mail->Subject = $sub1;
            $mail->Body = $text;
        } elseif($Tag == 2) {
            $mail->Subject = $sub2;
            $mail->Body = $text1;
        }

        if($mail->send()) {
            echo "Email sent successfully!";
            unset($_SESSION['email']);
            unset($_SESSION['lname']);
            unset($_SESSION['fname']);
            unset($_SESSION['mname']);
        }

    

?>