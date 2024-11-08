<?php
session_start();
require('C:\xampp\htdocs\en4\public\Enrollment_v3\Database\MySql\db.php');
require('C:\xampp\htdocs\en4\public\Enrollment_v3\Database\Query\Data_Convertion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to find the user by email
    $sql = "SELECT * FROM d_user WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);

        // Check if the password matches ($password === $user['password_hash']) -> Password Not Hash
        if (password_verify($password, $user['password_hash'])) {
            // Fetch personal information
            $sqlUserInfo = "SELECT * FROM d_studinfo WHERE e_mail = '$email'";
            $resultUserInfo = mysqli_query($connection, $sqlUserInfo);

            if ($resultUserInfo) {
                $userInfo = mysqli_fetch_array($resultUserInfo);

                $id = $userInfo['id_stuInfo'];

                $sqlSoftCopy = "SELECT * FROM d_softcopy WHERE id_stuInfo = '$id'";
                $resultSoftCopy = mysqli_query($connection, $sqlSoftCopy);
                $SoftCopy = mysqli_fetch_array($resultSoftCopy);

                $sqlEdu = "SELECT * FROM d_eduinfo WHERE id_eduInfo = '$id'";
                $resultEdu = mysqli_query($connection, $sqlEdu);
                $EduInfo = mysqli_fetch_array($resultEdu);

                $sqlClearance = "SELECT * FROM d_clearance WHERE id_clearance = '$id'";
                $queryClearance = mysqli_query($connection, $sqlClearance);
                $Clearance = mysqli_fetch_array($queryClearance);

                require('../src/Workflow/User-Info/studInfo.php');

                header('Location: ../../../private/sidebar-menu/sbar-student.php');
                exit;
            } else {
                echo "User information not found.";
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>
