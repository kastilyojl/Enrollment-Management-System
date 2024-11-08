document.addEventListener("DOMContentLoaded", function () {
    function updateSchoolYear() {
        const startDateElement = document.getElementById("start-date");
        const endDateElement = document.getElementById("end-date");
        const schoolYearField = document.getElementById("school-year");
        const term1Field = document.getElementById("t1_acad");
        const term2Field = document.getElementById("t2_acad");

        // Term 1
        const startDateElement1 = document.getElementById("t1_sdate");

        // Term 2
        const endDateElement2 = document.getElementById("t2_edate");

        const startDate = new Date(startDateElement.value);
        const endDate = new Date(endDateElement.value);

        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
            const startYear = startDate.getFullYear();
            const endYear = endDate.getFullYear();

            if (startDate > endDate) {
                schoolYearField.value = "Invalid Date Range";
                term1Field.value = "";
                term2Field.value = "";
                startDateElement1.value = "";
                endDateElement2.value = "";
            } else {
                schoolYearField.value = `${startYear}-${endYear}`;
                term1Field.value = "1ST";
                term2Field.value = "2ND";

                // Term-1 dates
                startDateElement1.value = startDate.toISOString().split('T')[0];

                // Term-2 dates
                endDateElement2.value = endDate.toISOString().split('T')[0];
            }
        } else {
            schoolYearField.value = "";
            term1Field.value = "";
            term2Field.value = "";
            startDateElement1.value = "";
            endDateElement2.value = "";
        }
    }

    document.getElementById("start-date").addEventListener("change", updateSchoolYear);
    document.getElementById("end-date").addEventListener("change", updateSchoolYear);
});

function viewAll() {
    console.log("View All button clicked");
    window.location.href = "../PAGE/0_sysetup-rd.php";
}
