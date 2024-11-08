document.addEventListener("DOMContentLoaded", function () {
    function updateSchoolYear() {
        const startDateElement = document.getElementById("start-date");
        const endDateElement = document.getElementById("end-date");
        const schoolYearField = document.getElementById("school-year");

        const startDate = new Date(startDateElement.value);
        const endDate = new Date(endDateElement.value);

        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
            const startYear = startDate.getFullYear();
            const endYear = endDate.getFullYear();

            if (startDate > endDate) {
                schoolYearField.value = "Invalid Date Range";

                startDateElement1.value = "";
                endDateElement2.value = "";
            } else {
                schoolYearField.value = `${startYear}-${endYear}`;
            }
        } else {
            schoolYearField.value = "";

        }
    }

    document.getElementById("start-date").addEventListener("change", updateSchoolYear);
    document.getElementById("end-date").addEventListener("change", updateSchoolYear);
});



function backAll() {
    console.log("View All button clicked");
    window.location.href = "../PAGE/0_sysetup-rd.php";
}


$(document).ready(function () {
    $('.form-container form').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json', // Expect JSON response
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: "Updating...", // Change the title to indicate successful update
                        text: response.message,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#28a745',
                        confirmButtonText: 'OK',
                        cancelButtonText: 'View',
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                            // Handle "View" button click action
                            window.location.href = "../PAGE/0_sysetup-rd.php"; // Replace with your desired URL
                        }
                    });
                } else {
                    var errorMessage = response.error || 'An error occurred';
                    Swal.fire({
                        title: "Error!",
                        text: errorMessage,
                        icon: "error"
                    });
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                Swal.fire({
                    title: "Error!",
                    text: errorMessage,
                    icon: "error"
                });
            }
        });
    });
});
