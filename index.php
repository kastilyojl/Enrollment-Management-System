<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="./tab-icon.svg">
    <title>Online Enrollment System</title>
    <link rel="stylesheet" href="../en5/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="../en5/reset.css">
    <link rel="stylesheet" href="../en5/index.css">
    <style>
        .footer .credit a {
          color: var(--blue);
        }
        #and {
            color: var(--darkblue);
        }
    </style>
</head>

<body>
    <!--header starts-->
    <header class="header">
        <a href="#" class="logo">ACADEMY</a>

        <nav class="navbar">
            <a href="#home">HOME</a>
            <a href="#about">ABOUT</a>
            <a href="#programs">PROGRAMS</a>
            <a href="#plans">PLANS</a>
            <a href="#register">REGISTER</a>
            <a href="https://www.facebook.com/story.php?story_fbid=pfbid031tFzvhT9MGda7e8rHtKad2CnRrpDtv29Pph9rMnLM5XAd1Ls5gzWeWgWiHapjF7Bl&id=799462750137459&mibextid=Nif5oz&paipv=0&eav=AfZM8fEfYM_L6K-vkKQ_1V8rpchJ4fYG6LchqbsObxyrqHFNFqq3ZmyNmhnFPKG6b9E&_rdr" target="_blank">
                PAYMENT</a>
            <a onclick="login()">LOGIN</a>
            <a href="#contact">CONTACT US</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </header>
    <!--header ends-->


    <!--home section starts-->
    <section class="home" id="home">
        <div class="image">
            <img src="./Images/study.jpg" alt="">
        </div>

        <div class="content">
            <h3>Welcome to [School's Name] Enrollment System!</h3>
            <p>Your journey to success starts here. Our platform makes registration quick and easy. Enroll in our
                offered programs and keep tracked of your enrollment records—all in one place.</p>
            <br>
            <p>Let's make this the best school year. Welcome aboard!</p>
            <a href="./how_to.php" class="btn">how to enroll?</a>
        </div>

    </section>
    <!--home section ends-->

    <!-- about starts-->
    <section class="about" id="about">
        <h1 class="heading"><span>about</span>us</h1>

        <div class="row">
            <div class="image">
                <img src="./Images/talk.jpg" alt="">
            </div>
            <div class="content">
                <h3>simplifying your enrollment journey</h3>
                <p>Our platform is dedicated to simplifying the registration and enrollment process for both Senior High
                    School (SHS) and college students. We handle everything from registration and payment verification
                    to course evaluation and final enrollment, ensuring a smooth and efficient experience for all
                    students.</p>
                <p>Join us and make your educational journey hassle-free!</p>
            </div>
        </div>
    </section>
    <!-- about ends-->


    <!--programs section starts-->
    <!--SHS-->
    <section class="programs" id="programs">

        <h1 class="heading"><span>SENIOR HIGH</span></h1>
        <div class="box-container">
            <div class="box">
                <img src="./Images/rocket.svg" alt="">
                <h3>STEM</h3>
                <p>"Where Futures Take Flight"</p>
                <br>
                <p>Prepare for tomorrow's challenges with our dynamic STEM program. Dive into hands-on learning and
                    unlock your potential in science, technology, engineering, and mathematics.</p>
            </div>

            <div class="box">
                <img src="./Images/abacus.svg" alt="">
                <h3>ABM</h3>
                <p>"Shaping Tomorrow's Leaders"</p>
                <br>
                <p>Forge your path in business and finance with our ABM program. Gain essential skills in accounting,
                    business, and management, setting the foundation for a successful career in the corporate world.</p>
            </div>

            <div class="box">
                <img src="./Images/thinking.svg" alt="">
                <h3>HUMSS</h3>
                <p>"Shaping Minds, Shaping Futures"</p>
                <br>
                <p>Uncover the depths of human society and culture with our HUMSS program. Develop critical thinking and
                    communication skills for a future in the humanities and social sciences.</p>
            </div>

            <div class="box">
                <img src="./Images/tesda.png" alt="">
                <h3>TECHVOC</h3>
                <p>"Empowering Through Technology"</p>
                <br>
                <p>Dive into ICT (Information and
                    Communication Technology), HE (Home Economics), and IA (Industrial Arts). Prepare for in-demand
                    careers in technology, culinary arts, and craftsmanship.</p>
            </div>
        </div>

        <!--4 YR COLLEGE-->
        <h1 class="heading">4-YEAR<span>COLLEGE</span></h1>
        <div class="box-container">

            <div class="box">
                <img src="./Images/cs.svg" alt="">
                <h3>BS Computer Science</h3>
                <p>"Coding the Future"</p>
                <br>
                <p>Join the forefront of technological advancement with our BS Computer Science program. Dive deep into
                    coding, algorithms, and software engineering. Prepare for a dynamic career in the digital world.</p>
            </div>

            <div class="box">
                <img src="./Images/IS.svg" alt="">
                <h3>BS Information Systems</h3>
                <p>"Powering Data-driven Futures"</p>
                <br>
                <p>Harness the potential of data with our BS Information Systems program. Dive into database management,
                    analytics, and system design. Prepare for a dynamic career at the intersection of technology and
                    business.</p>
            </div>

            <div class="box">
                <img src="./Images/police.svg" alt="">
                <h3>BS Criminology</h3>
                <p>"Shaping Justice, Securing Communities"</p>
                <br>
                <p>Join the frontline of law enforcement and crime prevention with our BS Criminology program. Delve
                    into criminal psychology, law enforcement techniques, and crime scene investigation. Prepare for a
                    career dedicated to ensuring safety and upholding justice in our communities. </p>
            </div>

        </div>

        <div class="box-container">
            <div class="box">
                <img src="./Images/finance.svg" alt="">
                <h3>BS Entrepreneurship</h3>
                <p>"Empowering Ideas, Building Ventures"</p>
                <br>
                <p>Fuel your passion for innovation and leadership with our BS Entrepreneurship program. Explore the art
                    of business creation, management, and growth. Equip yourself with the skills and mindset to succeed
                    in the dynamic world of entrepreneurship.</p>
            </div>

            <div class="box">
                <img src="./Images/tour.svg" alt="">
                <h3>BS Tourism Management</h3>
                <p>"Journeying to Hospitality Excellence"</p>
                <br>
                <p>Embark on a thrilling adventure in the world of hospitality with our BS Tourism Management program.
                    Dive into tourism trends, event planning, and hospitality operations. Prepare for a dynamic career
                    in the global tourism industry. </p>
            </div>

            <div class="box">
                <img src="./Images/books.svg" alt="">
                <h3>BTV Teacher Education</h3>
                <p>"Inspiring Future Educators"</p>
                <br>
                <p>Embark on a transformative journey into the realm of education with our BTV Teacher Education
                    program. Dive into innovative teaching methods, curriculum design, and classroom management. Prepare
                    to shape young minds and make a lasting impact in the field of education. </p>
            </div>
        </div>



        <!--2 YR COLLEGE-->
        <h1 class="heading">2-YEAR<span>COLLEGE</span></h1>
        <div class="box-container">

            <div class="box">
                <img src="./Images/act.svg" alt="">
                <h3>Associated in Computer Technology</h3>
                <p>"Pioneering Tech Solutions"</p>
                <br>
                <p>Forge a path in the digital landscape with our Associated in Computer Technology program. Explore
                    cutting-edge software, hardware, and network systems. Prepare for a dynamic career at the forefront
                    of technological innovation.</p>
            </div>

            <div class="box">
                <img src="./Images/tools.svg" alt="">
                <h3>Specialization in Computer Numerical Control</h3>
                <p>"Precision in Motion"</p>
                <br>
                <p>Master the art of precision machining with our Specialization in Computer Numerical Control program.
                    Dive into advanced CNC technology, programming, and machining techniques. Prepare for a career at
                    the forefront of manufacturing innovation. </p>
            </div>

            <div class="box">
                <img src="./Images/binary.svg" alt="">
                <h3>Programming Leading to Computer Science</h3>
                <p>"Crafting Tomorrow's Solutions"</p>
                <br>
                <p>Explore the foundations of programming on your way to Computer Science. Master coding languages,
                    algorithms, and software development. Prepare to innovate in the ever-evolving tech industry. </p>
            </div>

            <div class="box">
                <img src="./Images/ui.svg" alt="">
                <h3>Programming Leading to Information Systems</h3>
                <p>"Building Digital Foundations"</p>
                <br>
                <p>Embark on a journey into programming as a pathway to Information Systems. Master coding languages,
                    database management, and system design. Prepare for a career at the forefront of digital
                    transformation. </p>
            </div>

        </div>

    </section>
    <!--programs section ends-->

    <!--plans section starts-->
    <section class="plans" id="plans">
        <h1 class="heading"><span>plans</span></h1>
        <div class="box-container">

            <div class="box">
                <h3 class="title">installment plan</h3>
                <img src="./Images/cost.png" alt="">
                <h3 class="price">P1,500<span>/down</span></h3>
                <ul>
                    <li>BS Computer Science</li>
                    <li>BS Information Systems</li>
                    <li>BS Criminology</li>
                    <li>BS Tourism Management</li>
                    <li>BS Entrepreneurship</li>
                    <li>BTV Teacher Education</li>
                </ul>
            </div>

            <div class="box">
                <h3 class="title">alumni plan</h3>
                <img src="./Images/cost.png" alt="">
                <h3 class="price">P6,300<span>/full</span></h3>
                <ul>
                    <li>BS Computer Science</li>
                    <li>BS Information Systems</li>
                    <li>BS Criminology</li>
                    <li>BS Tourism Management</li>
                    <li>BS Entrepreneurship</li>
                    <li>BTV Teacher Education</li>
                </ul>
            </div>

            <div class="box">
                <h3 class="title">regular plan</h3>
                <img src="./Images/cost.png" alt="">
                <h3 class="price">P8,100<span>/full</span></h3>
                <ul>
                    <li>BS Computer Science</li>
                    <li>BS Information Systems</li>
                    <li>BS Criminology</li>
                    <li>BS Tourism Management</li>
                    <li>BS Entrepreneurship</li>
                    <li>BTV Teacher Education</li>
                </ul>
            </div>

        </div>

    </section>
    <!--plan section ends-->

    <!--register section starts-->
    <section class="register" id="register">
        <h1 class="heading"><span>register</span>now</h1>
        <div class="box-container">
            <div class="box">
                <img src="./Images/form.jpg" alt="">
                <h3>Online Application</h3>
                <p>Begin your journey by completing our online application form. Provide accurate details to expedite
                    your enrollment process.
                </p>
                <a onclick="onlineApp()" class="btn">Go to step 1</a>
            </div>

            <div class="box">
                <img src="./Images/upload.png" alt="">
                <h3>Payment Verification</h3>
                <p>Once you've filled out the application form, submit your proof of payment for your tuition fees.
                    Upload your payment receipts and provide necessary transaction details.
                </p>
                <a onclick="paymentVer()" class="btn">Go to step 2</a>
            </div>

            <div class="box">
                <img src="./Images/status.png" alt="">
                <h3>Transaction Status</h3>
                <p>Keep track of your application and payment status effortlessly. To monitor the progress of your
                    submissions and stay updated on any necessary actions.
                </p>
                <a onclick="tranStat()" class="btn">Go to step 3</a>
            </div>
        </div>
        </div>
    </section>
    <!--register section ends-->

    <!-- contact us section starts-->
    <section class="contact" id="contact">
        <div class="share">
            <a href="https://www.facebook.com/WITIofficial" class="fa-brands fa-facebook-f"> <span>a c e b o o k</span></a>
        </div>
        <!-- <h1 class="heading"><span>contact</span>us</h1>

        <div class="row">
            <div class="image">
                <img src="../en4/images/contact.png" alt="">
            </div>
            <form action="#">
                <h3>get in touch</h3>
                <input type="text" placeholder="fullname" class="box">
                <input type="email" placeholder="your email" class="box">
                <input type="text" placeholder="your number" class="box">
                <textarea name="" placeholder="your message" class="box" cols="30" rows="10"></textarea>
                <input type="submit" value="send message" class="btn">
            </form>
        </div> -->
    </section>
    <!--contact us section ends -->

    <!--footer section starts-->
    <section class="footer">
        <div class="credit">created by: <span>
            <a href="mailto:castillojlb0922@gmail.com">Castillo</a> <span id="and">And</span> 
            <a href="mailto:clareonlovely@gmail.com">Clareon</a> </span> | all rights reserved</div>
    </section>
    <!--footer section ends-->
    <script src="../en5/index.js"></script>
    <script>
        function login() {
            window.location.href = "./private/login/login.php";
        }

        function onlineApp() {
            window.location.href = "./Detail_Page/Stud_Type.php";
        }

        function paymentVer() {
            window.location.href = "./Detail_Page/Payment_Page.php";
        }

        function tranStat() {
            window.location.href = "./Detail_Page/Verification_Page.php";
        }
    </script>
</body>

</html>