const sidebarToggle = document.querySelector("#sidebar-toggle");
const sidebar = document.querySelector("#sidebar");
const sidebarFooter = document.querySelector(".sidebar-footer");

sidebarToggle.addEventListener("click", function () {
    sidebar.classList.toggle("collapsed");
    sidebarFooter.classList.toggle("collapsed");
});

document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('a.sidebar-link');

    links.forEach(link => {
        link.addEventListener('click', function () {
            // Remove active class from all links
            links.forEach(l => l.classList.remove('active'));

            // Add active class to the clicked link
            this.classList.add('active');
        });
    });
});

/*dashboards*/
function switch_superadmin() {
    document.getElementById("myIframe").src = "../../SAdmin_Statistics.php";
}
function switch_accounting() {
    document.getElementById("myIframe").src = "../../Accounting/Statistics.php";
}
function switch_registrar() {
    document.getElementById("myIframe").src = "../../Registrar/Statistics.php";
}
function switch_professor() {
    document.getElementById("myIframe").src = "ok";
}
function switch_student() {
    document.getElementById("myIframe").src = "ok";
}


/*-general setup-admin*/
function switch_sy() {
    document.getElementById("myIframe").src = "../1_superadmin/gen-setup/PAGE/0_sysetup-c.php";
}

function switch_cur() {
    document.getElementById("myIframe").src = "../1_superadmin/gen-setup/PAGE/0_curriculum-page.php";
}

function switch_tui() {
    document.getElementById("myIframe").src = "../1_superadmin/gen-setup/PAGE/5_tuition-c.php";
}

function switch_curs() {
    document.getElementById("myIframe").src = "../../0_Signup/signup.php";
}


/*-registrar-admin*/
function switch_app() {
    document.getElementById("myIframe").src = "../../Registrar/registration_List.php";
}
function switch_req() {
    document.getElementById("myIframe").src = "../../Registrar/Requirements.php";
}
function switch_id() {
    document.getElementById("myIframe").src = "../../Registrar/IDSetup.php";
}

/*evaluation-admin*/
function switch_clr() {
    document.getElementById("myIframe").src = "../../Registrar/Clearanc3.php";
}
function switch_sg() {
    document.getElementById("myIframe").src = "../../Registrar/Grades.php";
}
function switch_dr() {
    document.getElementById("myIframe").src = "../../Registrar/Report.php";
}
function switch_cs() {
    document.getElementById("myIframe").src = "../1_superadmin/gen-setup/PAGE/7_cs-c.php";
}
function switch_en() {
    document.getElementById("myIframe").src = "../../Algorithm/admin.php";
}
function switch_masR() {
    document.getElementById("myIframe").src = "../../login/unavailable.php";
}

/*payment-tracking-admin*/
function switch_tp() {
    document.getElementById("myIframe").src = "../../login/unavailable.php";
}
function switch_pv() {
    document.getElementById("myIframe").src = "../../Accounting/Payment_List.php";
}

function switch_ts() {
    document.getElementById("myIframe").src = "../../Accounting/Transaction_Status.php";
}

function switch_masA() {
    document.getElementById("myIframe").src = "../../login/unavailable.php";
}

/*general-information-all*/
function switch_curI() {
    document.getElementById("myIframe").src = "../1_superadmin/gen-setup/PAGE/4_cur-r.php";
}
function switch_tuiI() {
    document.getElementById("myIframe").src = "../../Enrollment/Plan.php";
}

/*my-students-professor*/
function switch_csP() {
    document.getElementById("myIframe").src = "../../login/unavailable.php";
}
function switch_drP() {
    document.getElementById("myIframe").src = "../../Professor/Report.php";
}
function switch_sgP() {
    document.getElementById("myIframe").src = "../../Professor/Upload_Grades.php";
}

/*enrollment-evaluation-student*/
function switch_profile() {
    document.getElementById("myIframe").src = "../../Student_Profile/profile.php";
}
function switch_reqS() {
    document.getElementById("myIframe").src = "../../Enrollment/Requirements.php";
}
function switch_cgS() {
    document.getElementById("myIframe").src = "../../Enrollment/View_Grades.php";
}
function switch_drS() {
    document.getElementById("myIframe").src = "../../Enrollment/Report.php";
}
function switch_clrS() {
    document.getElementById("myIframe").src = "../../Enrollment/Clearance.php";
}
function switch_csS() {
    document.getElementById("myIframe").src = "../../login/unavailable.php";
}
function switch_enS() {
    document.getElementById("myIframe").src = "../../Algorithm/student.php";
}
/*payment-tracking-student*/
function switch_tpS() {
    document.getElementById("myIframe").src = "../../login/unavailable.php";
}
function switch_pvS() {
    document.getElementById("myIframe").src = "../../Enrollment/Payment_Form.php";
}
function switch_tsS() {
    document.getElementById("myIframe").src = "../../Enrollment/Transaction_Status.php";
}