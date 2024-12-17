<?php

include '../../connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Validate email and password
    if (empty($email)) {
        echo "<script>alert('Email Not found. Type your registered email address. Thank you.');</script>";
        echo "<script>window.location.href='../login/login.php';</script>";
        exit();
    }

    if (empty($password)) {
        echo "<script>alert('Password is Empty.Type your registered password. [Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.] Thank you.');</script>";
        echo "<script>window.location.href='../login/login.php';</script>";
        exit();
    }

    //Check if login attempts session variable is set
    if (!isset($_SESSION['login_attempts'])) {
        // If not set, initialize it to 0
        $_SESSION['login_attempts'] = 0;
    }

    //Check if login attempts exceed the limit
    if ($_SESSION['login_attempts'] >= 3 && time() - $_SESSION['last_attempt_time'] < 30) {
        // If exceeded and last attempt was made within last 30 seconds, display message
        die("Too many login attempts. Please try again later (wait for 30 seconds).");
    } elseif ($_SESSION['login_attempts'] >= 3 && time() - $_SESSION['last_attempt_time'] >= 30) {
        // If exceeded and last attempt was made over 30 seconds ago, reset attempts and last attempt time
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_attempt_time'] = time();
    }

    // Prepare query using prepared statements to prevent SQL injection
    $query = "SELECT * FROM users WHERE email = ? AND (user_type = 1 OR user_type = 2 OR user_type = 3 OR user_type = 4 OR user_type = 5);";
    //1:superadmin 2:accounting 3:registrar 4:professor 5:student

    // Prepare statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("s", $email);

    // Execute statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // Fetch user details
        $row = $result->fetch_assoc();
        if ($row['user_type'] == 5) {
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Reset login attempts on successful login
                $_SESSION['login_attempts'] = 0;
                $_SESSION['email'] = $row['email'];

                $sqlUserInfo = "SELECT * FROM d_studinfo WHERE e_mail = '$email'";
                $resultUserInfo = mysqli_query($conn, $sqlUserInfo);

                    if ($resultUserInfo) {
                        $userInfo = mysqli_fetch_array($resultUserInfo);

                        $id = $userInfo['id_stuInfo'];

                        $sqlSoftCopy = "SELECT * FROM d_softcopy WHERE id_stuInfo = '$id'";
                        $resultSoftCopy = mysqli_query($conn, $sqlSoftCopy);
                        $SoftCopy = mysqli_fetch_array($resultSoftCopy);

                        $sqlEdu = "SELECT * FROM d_eduinfo WHERE id_eduInfo = '$id'";
                        $resultEdu = mysqli_query($conn, $sqlEdu);
                        $EduInfo = mysqli_fetch_array($resultEdu);

                        $sqlClearance = "SELECT * FROM d_clearance WHERE id_clearance = '$id'";
                        $queryClearance = mysqli_query($conn, $sqlClearance);
                        $Clearance = mysqli_fetch_array($queryClearance);

                        require('../../Student_Profile/studInfo.php');
                        // require('C:\xampp\htdocs\en4\public\Enrollment_v3\src\Workflow\User-Info\studInfo.php');
                    }
                
                // Redirect based on user type              
                header("Location:../sidebar-menu/sbar-student.php");
                exit();
            } else {
                // Invalid password
                // Increment login attempts on failed login
                $_SESSION['login_attempts']++;
                $_SESSION['last_attempt_time'] = time();
                $attemptsLeft = 3 - $_SESSION['login_attempts'];
                echo "<script>alert('Login failed. You have $attemptsLeft attempts left.');</script>";
                // Check if login attempts are less than 3
                if ($_SESSION['login_attempts'] < 3) {
                    // Redirect to login page immediately
                    echo "<script>window.location.href='../login/login.php';</script>";
                } else {
                    // If login attempts reach 3, wait for 30 seconds before reloading
                    echo "<script>setTimeout(function(){window.location.href='../login/login.php';},30000);</script>";
                    // If exceeded and last attempt was made within last 30 seconds, display message
                    die("Too many login attempts. Please try again later (wait for 30 seconds).");
                }
                exit();
            }
        } else {
            echo "<script>alert('User is not register. Go to registration first. Thank you.');</script>";
            echo "<script>window.location.href='../login/login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('User is not register. Go to registration first. Thank you.');</script>";
        echo "<script>window.location.href='../login/login.php';</script>";
        // Invalid email
        handleFailedLogin();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

function handleFailedLogin()
{
    // Increment login attempts on failed login
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt_time'] = time();

    if ($_SESSION['login_attempts'] >= 3) {
        echo "<script>alert('Too many login attempts. Please try again later (wait for 30 seconds).');</script>";
        echo "<script>setTimeout(function(){window.location.href='../login/login.php';},30000);</script>";
    } else {
        $attemptsLeft = 3 - $_SESSION['login_attempts'];
        echo "<script>alert('Login failed. You have $attemptsLeft attempts left.');</script>";
        echo "<script>window.location.href='../login/login.php';</script>";
    }
    exit();
}
