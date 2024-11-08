<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../../tab-icon.svg">
    <title>Enrollment System | Account Login</title>
    <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="./login.css">
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="student-admin">

                <form action="../login/login-process-stud.php" method="POST" class="login-student">
                    <h2 class="title">Student | Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" id="studentEmail" name="email" placeholder="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="studentPassword" name="password" placeholder="password">
                        <!-- <i class="fa-solid fa-eye toggle-password"></i> -->
                    </div>
                    <a class="forgot" href="https://cresmanagehub.com/forgot-password">forgot password?</a>
                    <input type="submit" value="Login" class="btn-solid" id="login1" aria-hidden="true">
                </form>

                <form action="../login/login-process-admin.php" method="POST" class="login-admin">
                    <h2 class="title">Admin | Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" id="adminEmail" name="email" placeholder="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="adminPassword" name="password" placeholder="password">
                        <!-- <i class="fa-solid fa-eye toggle-password"></i> -->
                    </div>
                    <a class="forgot" href="https://cresmanagehub.com/forgot-password">forgot password?</a>
                    <input type="submit" value="Login" class="btn-solid" id="login2" aria-hidden="true">
                </form>

            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Are you an admin here?</h3>
                    <button class="btn transparent" id="admin-btn">yes</button>
                </div>
                <img src="../../Images/admin.svg" class="image" alt="">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>Are you a student here?</h3>
                    <button class="btn transparent" id="student-btn">yes</button>
                </div>
                <img src="../../images/student.svg" class="image" alt="">
            </div>
        </div>
    </div>

</body>
<script src="../login/login.js"></script>
<script>
    // Function to hide the text input
    function hideTextInput(inputId) {
            var inputElement = document.getElementById(inputId);
            if (inputElement) {
                inputElement.setAttribute('type', 'hidden');
            }
        }

</script>
</html>