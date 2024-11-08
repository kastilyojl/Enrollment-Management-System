<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="../Style/Student_Profile.css">
    <style>
        .container {
            display: none;
        }
        .container.active {
            display: block;
        }
        #profile_nav {
            color: #00004C;
            font-weight: bolder;
        }
        #email_css {
            text-transform: none;
        }

    </style>
</head>
<body>

    <div class="container_parent">
        <div class="left">
            <div class="top">
                <div class="img_container">
                     <?php
                    if (!empty($_SESSION['2x2_pic'])) {
                        echo '<img class="profile" src="data:image/jpeg;base64,' . base64_encode($_SESSION['2x2_pic']) . '"/>';
                    }
                        else if(empty($row['2x2_pic'])){ ?>
                            <img class="default-profile" src="../Images/profile-icon.png">
                        <?php } ?>
                </div>
                <div class="name">
                <p>
                    <?php 
                    echo (isset($_SESSION['lname']) ? $_SESSION['lname'] : '') . ", " . 
                        (isset($_SESSION['fname']) ? $_SESSION['fname'] : '') . " " . 
                        (isset($_SESSION['mname']) ? $_SESSION['mname'] : ''); 
                    ?>
                </p>
                    <p id="email_css"><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></p>
                </div>
            </div>
            <div class="bottom">
                <div>
                    <span>Student No.</span>
                    <!-- <?php // echo $_SESSION['id_studInfo']?> Original Code -->
                    <span><?php echo isset($_SESSION['id_stuInfo']) ? $_SESSION['id_stuInfo'] : '';?></span>
                </div>
                <div>
                    <span>Department:</span>
                    <?php if ($_SESSION['dept'] = 2) {
                        $dept = "College";
                    } else {
                        $dept = "SHS";
                    }?>
                    <span><?php echo isset($_SESSION['dept']) ? $dept : ''; ?></span>
                </div>
                <div>
                    <span>Course/Strand</span>
                    <span><?php echo isset($_SESSION['str_crs']) ? $_SESSION['str_crs'] : '';?></span>
                </div>
                <!-- <div>
                    <span>Semester</span>
                    <span>1st Sem</span>
                </div> -->
            </div>
        </div>
        <div class="right">
            <div class="main">
                <div class="nav_bar">
                    <div onclick="nav('profile_nav')"; id="profile_nav" data-target="profile">Profile</div>
                    <div onclick="nav('parent_nav')"; id="parent_nav" data-target="parent">Parent</div>
                    <div onclick="nav('education_nav')"; id="education_nav" data-target="education">Education</div>
                </div>
                <div class="content-main">

                        <div id="profile" class="container active">
                            <form class="form">

                                <div class="content">
                                    <div class="input col-span2">
                                        <label for="Name">Name</label>
                                        <div class="align name">
                                            <input readonly type="text" value = "<?php echo isset($_SESSION['lname']) ? $_SESSION['lname'] : '';?>">
                                            <input readonly type="text" value = "<?php echo isset($_SESSION['fname']) ? $_SESSION['fname'] : '';?>">
                                            <input readonly type="text" value = "<?php echo isset($_SESSION['mname']) ? $_SESSION['mname'] : '';?>">
                                        </div>
                                    </div>
                                    <div class="input col-span2">
                                        <label >Address</label>
                                        <input readonly type="text" value = "<?php echo isset($_SESSION['h_addr']) ? $_SESSION['h_addr'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label >Place of Birth</label>
                                        <input readonly type="text" value = "<?php echo isset($_SESSION['b_place']) ? $_SESSION['b_place'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label >Date of Birth</label>
                                        <input readonly type="date" value = "<?php echo isset($_SESSION['b_date']) ? $_SESSION['b_date'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label>Cellphone Number</label>
                                            <div class="cell-container">
                                                <span>(+63)</span>
                                                <input readonly type="tel" value = "<?php echo isset($_SESSION['p_num']) ? $_SESSION['p_num'] : '';?>">
                                            </div>
                                    </div>
                                    <div class="input gender-side">
                                        <label >Gender</label> <br>
                                        <div class="align gender">
                                            <label class="radio-button">Male</label><input readonly type="radio" name="gender" value="1" <?php if (isset($_SESSION['sex']) && $_SESSION['sex'] == '1') echo 'checked'; ?> onclick="return false;">
                                            <label class="radio-button">Female</label><input readonly type="radio" name="gender" value="2" <?php if (isset($_SESSION['sex']) && $_SESSION['sex'] == '2') echo 'checked'; ?> onclick="return false;">
                                        </div>
                                    </div>
                                    <div class="input">
                                        <label>Religion</label>
                                        <input readonly type="text" value = "<?php echo isset($_SESSION['rel']) ? $_SESSION['rel'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label>Civil Status</label>
                                        <input readonly type="text" value = "<?php echo isset($_SESSION['cvl_stat']) ? $_SESSION['cvl_stat'] : '';?>">
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div id="parent" class="container">
                            <form class="form">
                                
                                <div class="content">
                                    <div class="input">
                                        <label>Mother</label>
                                        <input type="text" value = "<?php echo isset($_SESSION['m_name']) ? $_SESSION['m_name'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label>Father</label>
                                        <input type="text" value = "<?php echo isset($_SESSION['f_name']) ? $_SESSION['f_name'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label>Mother's Occupation</label>
                                        <input type="text" value = "<?php echo isset($_SESSION['m_occu']) ? $_SESSION['m_occu'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label>Father's Occupation</label>
                                        <input type="text" value = "<?php echo isset($_SESSION['f_occu']) ? $_SESSION['f_occu'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label>Mother's Cellphone #</label>
                                        <div class="cell-container">
                                            <span>(+63)</span>
                                            <input type="tel" value = "<?php echo isset($_SESSION['m_pnum']) ? $_SESSION['m_pnum'] : '';?>">
                                        </div>
                                    </div>
                                    <div class="input">
                                        <label>Father's Cellphone #</label>
                                        <div class="cell-container">
                                            <span>(+63)</span>
                                            <input type="tel" value = "<?php echo isset($_SESSION['f_pnum']) ? $_SESSION['f_pnum'] : '';?>">
                                        </div>
                                    </div>
                                    <div class="input">
                                        <label>Guardian</label>
                                        <input type="text" value = "<?php echo isset($_SESSION['g_name']) ? $_SESSION['g_name'] : '';?>">
                                    </div>
                                    <div class="input">
                                        <label>Guardian's Occupation</label>
                                        <input type="g_occu" value = "<?php echo isset($_SESSION['g_occu']) ? $_SESSION['g_occu'] : '';?>">
                                    </div>       
                                    <div class="input">
                                        <label>Guardian's Cellphone #</label>
                                        <div class="cell-container">
                                            <span>(+63)</span>
                                            <input type="tel" value = "<?php echo isset($_SESSION['g_pnum']) ? $_SESSION['g_pnum'] : '';?>">
                                        </div>
                                    </div>     
                                </div>
                            </form>
                        </div>
                        <div id="education" class="container">
                            <form class="form">
                                
                                <div class="content">
                                        <div class="input col-span2">
                                            <label>High School (G10)</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['g10_sch']) ? $_SESSION['g10_sch'] : '';?>">
                                        </div>
                                        <div class="input">
                                            <label>Year Level</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['g10_yr']) ? $_SESSION['g10_yr'] : '';?>">
                                        </div>
                                        <div class="input">
                                            <label>Year Graduated</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['yr_grad1']) ? $_SESSION['yr_grad1'] : '';?>">
                                        </div>
    
                                        <div class="input col-span2">
                                            <label>High School (G12)</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['g12_sch']) ? $_SESSION['g12_sch'] : '';?>">
                                        </div>
                                        <div class="input">
                                            <label>Year Level</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['g12_yr']) ? $_SESSION['g12_yr'] : '';?>">
                                        </div>
                                        <div class="input">
                                            <label>Year Graduated</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['yr_grad2']) ? $_SESSION['yr_grad2'] : '';?>">
                                        </div>
                                            
                                        <div class="input col-span2">
                                            <label>TESDA NC</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['tsd_sch']) ? $_SESSION['tsd_sch'] : '';?>">
                                        </div>
                                        <div class="input">
                                            <label>Year Level</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['tsd_yr']) ? $_SESSION['tsd_yr'] : '';?>">
                                        </div>
                                        <div class="input">
                                            <label>Year Graduated</label>
                                            <input type="text" value = "<?php echo isset($_SESSION['yr_grad3']) ? $_SESSION['yr_grad3'] : '';?>">
                                        </div>
                                    </div>
                                </form>
                        </div>

                    
                    <!-- <div id="about" class="content">
                        <h2>About</h2>
                        <p>This is the about page.</p>
                    </div>
                    <div id="contact" class="content">
                        <h2>Contact</h2>
                        <p>Get in touch with us!</p>
                    </div> -->
                </div> <!--Content Main-->
                
            </div> <!--Main-->
        </div> <!--Right-->
    </div>

    <script src="../Javascript/Student_Profile.js"></script>

</body>
</html>

