function backAll() {
    console.log("View All button clicked");
    window.location.href = "../PAGE/2_course-rd.php";
}


$(document).ready(function () {
    // Listen for form submission
    $('.form-container form').on('submit', function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Submit form data via AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            dataType: 'json', // Expect JSON response
            success: function (response) {
                // Check if the update was successful
                if (response.success) {
                    // Display success message with SweetAlert
                    Swal.fire({
                        title: "Updating...",
                        text: response.message,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#28a745',
                        confirmButtonText: 'OK',
                        cancelButtonText: 'View',
                    }).then((result) => {
                        // Redirect to the view page if "View" is clicked
                        if (result.dismiss === Swal.DismissReason.cancel) {
                            window.location.href = "../PAGE/2_course-rd.php"; // Replace with your desired URL
                        }
                    });
                } else {
                    // Display error message with SweetAlert
                    var errorMessage = response.error || 'An error occurred';
                    Swal.fire({
                        title: "Error!",
                        text: errorMessage,
                        icon: "error"
                    });
                }
            },
            error: function (xhr, status, error) {
                // Display error message with SweetAlert
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


