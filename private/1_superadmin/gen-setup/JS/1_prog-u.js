function backAll() {
    console.log("View All button clicked");
    window.location.href = "../PAGE/1_prog-rd.php";
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
                        title: "Updating...",
                        text: response.message,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#28a745',
                        confirmButtonText: 'OK',
                        cancelButtonText: 'View',
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                            window.location.href = "../PAGE/1_prog-rd.php"; // Replace with your desired URL
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
