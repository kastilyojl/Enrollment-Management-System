<?php
session_start();
if(isset($_POST['logout'])) {
    
    $_SESSION = array();

    session_destroy();

    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../../tab-icon.svg">
    <title>Professor</title>
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="../sidebar-menu/sbar.css">
    <style>
        .main .navbar p {
            margin: 0;
            position: absolute;
            right: 20px;
            background: #00004C;
            padding: 4px 10px;
            color:#ffff;
            border-radius: 4px
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#"><img src="../../Images/sample-logo.png" alt=""></a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">PROFESSOR</li>
                    <!-- <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-user"></i> MY PROFILE
                        </a>
                    </li> -->
                    <!--General Information-->
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#one" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-circle-info"></i> GENERAL INFO
                        </a>
                        <ul id="one" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a href="#" onclick="switch_curI()" class="sidebar-link">Curriculum</a></li>
                            <li class="sidebar-item"><a href="#" onclick="switch_tuiI()" class="sidebar-link">Tuitions & Payment Plans</a></li>
                        </ul>
                    </li>
                    <!--My Students-->
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#two" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-address-card"></i> MY STUDENTS
                        </a>
                        <ul id="two" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <!-- <li class="sidebar-item"><a href="#" onclick="switch_csP()" class="sidebar-link">Courses & Students</a></li> -->
                            <li class="sidebar-item"><a href="#" onclick="switch_drP()" class="sidebar-link">Disciplinary Reports</a></li>
                            <li class="sidebar-item"><a href="#" onclick="switch_sgP()" class="sidebar-link">Semester Grades</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Footer -->
                <footer class="sidebar-footer">
                    <div class="container-fluid">
                        <div class="row text-muted justify-content-center align-items-center">
                            <div class="col-auto">
                                <form action="" method="post">
                                        <a href="#" class="text-white">
                                            <button type="submit" name="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                                        </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </aside>

        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></i></span>
                </button>
                <p><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></p>
            </nav>

            <main class="content px-3 py-2">
                <iframe id="myIframe" src="../1_superadmin/gen-setup/PAGE/4_cur-r.php" width="100%" height="100%"></iframe>
            </main>

            <!-- <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted justify-content-center align-items-center">
                        <div class="col-auto">
                            <p class="mb-0">
                            <div class="credit">created by: <span>castillo and clareon</span> | all rights reserved</div>
                            </p>
                        </div>
                    </div>
                </div>
            </footer> -->
        </div>
    </div>

    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../sidebar-menu/sbar.js"></script>
</body>

</html>