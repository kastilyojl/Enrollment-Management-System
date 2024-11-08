$(document).ready(function () {
    var form = $('#myForm');
    var submitBtn = form.find('input[type="submit"]');

    form.on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Disable submit button to prevent double submission
        submitBtn.prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json', // Expect JSON response
            success: function (response) {
                Swal.fire({
                    title: "Saving...",
                    text: response.message,
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#28a745',
                    confirmButtonText: 'OK',
                    cancelButtonText: 'View',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = "../PAGE/1_prog-rd.php";
                    }
                });
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                // Enable submit button in case of error
                submitBtn.prop('disabled', false);

                // Check for specific error messages
                if (errorMessage.includes("Duplicate entry")) {
                    Swal.fire({
                        title: "Error!",
                        text: "Duplicate entry for program code.",
                        icon: "error"
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: errorMessage,
                        icon: "error"
                    });
                }
            }
        });
    });
});

function viewAll() {
    console.log("View All button clicked");
    window.location.href = "../PAGE/1_prog-rd.php";
}
