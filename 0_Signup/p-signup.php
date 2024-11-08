<?php
// Input requirements
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Valid email is required.'); 
    window.location.href='./signup.php';</script>";
    exit();
}

if (strlen($_POST["password"]) < 8) {
    echo "<script>alert('Password must be at least 8 characters'); 
    window.location.href='./signup.php';</script>";
    exit();
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    echo "<script>alert('Password must contain at least one letter.'); 
    window.location.href='./signup.php';</script>";
    exit();
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    echo "<script>alert('Password must contain at least one number.'); 
    window.location.href='./signup.php';</script>";
    exit();
}

if ($_POST["password"] !== $_POST["confirm_password"]) {
    echo "<script>alert('Password must match.'); 
    window.location.href='./signup.php';</script>";
    exit();
}

if ($_POST["user_type"] > 5 || $_POST["user_type"] < 1) {
    echo "<script>alert('Invalid user'); 
    window.location.href='./signup.php';</script>";
    exit();
}

include '../connection.php';

$checkEmail = "SELECT * FROM users WHERE email = '{$_POST["email"]}' ";
$queryEmail = mysqli_query($conn, $checkEmail);

if ($queryEmail && mysqli_num_rows($queryEmail) > 0) {
    echo "<script>alert('Email already exist!'); 
    window.location.href='./signup.php';</script>";
    exit();
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Prepare SQL statement
$query = "INSERT INTO users (id, username, password1, isused, usertype, name, last_name, email, email_verified_at, password, remember_token, admission_number, roll_number, note, class_id, gender, date_of_birth, mobile_number, marital_status, address, permanent_address, admission_date, profile_pic, blood_group, qualification, height, weight, user_type, is_delete, status, work_experience, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Failed to prepare statement: " . $mysqli->error);
}

$temp0 = 1;
$temp1 = 0;
$temp3='0000-00-00 00:00:00';
$temp4='0000-00-00';
$temp = "na";

// Bind parameters
$stmt->bind_param("isssssssssssssissssssssssssiiisss", $temp1, $temp, $temp, $temp, $temp, $temp, $temp, $_POST["email"], $temp3, $password_hash, $temp, $temp, $temp, $temp, $temp0, $temp, $temp4, $temp, $temp, $temp, $temp, $temp3, $temp, $temp, $temp, $temp, $temp, $_POST["user_type"], $temp1, $temp1, $temp, $temp3, $temp3);

// Execute statement
if ($stmt->execute()) {
    echo "<script>alert('Account Created');</script>";
    echo "<script>window.location.href='./signup.php';</script>";
} else {
    die("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();
