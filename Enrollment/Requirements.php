<?php
session_start();
require('../Database/db.php');
 
$query = mysqli_query($connection, "SELECT * FROM d_softcopy WHERE id_stuInfo = '".$_SESSION['id_stuInfo']."'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Style/Student_Report.css">
</head>
<body>

    <table>
        <tr>
            <th>Form 138</th>
            <th>ESC Certificate</th>
            <th>Certificate of Good Moral</th>
            <th>Certificate of Recognition</th>
            <th>Honorary Dissmisal</th>
            <th>Birth Certificate</th>
        </tr>
        <?php if($result = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?php echo $result['form138'] === 'Submit' ? '&#10004;' : ($result['form138'] === 'Missing' ? '&#10060;' : '');?></td>
            <td><?php echo $result['esc_certificate'] === 'Submit' ? '&#10004;' : ($result['esc_certificate'] === 'Missing' ? '&#10060;' : '');?></td>
            <td><?php echo $result['cert_gm'] === 'Submit' ? '&#10004;' : ($result['cert_gm'] === 'Missing' ? '&#10060;' : '');?></td>
            <td><?php echo $result['g10_certofreg'] === 'Submit' ? '&#10004;' : ($result['g10_certofreg'] === 'Missing' ? '&#10060;' : '');?></td>
            <td><?php echo $result['hon_diss'] === 'Submit' ? '&#10004;' : ($result['hon_diss'] === 'Missing' ? '&#10060;' : '');?></td>
            <td><?php echo $result['b_cert'] === 'Submit' ? '&#10004;' : ($result['b_cert'] === 'Missing' ? '&#10060;' : '');?></td>
        </tr>
        <?php }?>
        
    </table>
    
</body>
</html>