<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add School Year</title>
    <link rel="stylesheet" href="../../../../reset.css">
    <link rel="stylesheet" href="../CSS/cu.css">
    <script src="../JS/0_sysetup-c.js"></script>
    <script src="../../../../jquery-3.6.0.min.js"></script>
    <script src="../../../../package/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Add School Year</h2>
            <button class="view-all-button" onclick="viewAll()">View All</button>
        </div>

        <form id="myForm" action="../PROCESS/0_sysetup-process-c.php" method="post">
            <div class="form-section">
                <div class="form-row">
                    <label for="school-year">School Year:</label>
                    <input type="text" id="school-year" name="school-year" readonly>
                </div>
                <div class="form-row date">
                    <label for="start-date"><strong>*Start Date:</strong></label>
                    <label for="end-date"><strong>*End Date:</strong></label>
                    <input type="date" id="start-date" name="start-date" required>  <!--Start Date-->
                    <input type="date" id="end-date" name="end-date" required> <!--End Date-->
                </div>
            </div>

            <div class="form-section">
                <div class="form-row">
                    <label for="t1_acad">Semester:</label>
                    <input type="text" id="t1_acad" name="t1_acad" value="1ST" readonly>
                </div>
                <div class="form-row date">
                    <label for="t1_sdate">Start Date:</label>
                    <label for="t1_edate"><strong>*End Date:</strong></label>
                    <input type="date" id="t1_sdate" name="t1_sdate" readonly>  <!--Start Date-->
                    <input type="date" id="t1_edate" name="t1_edate" required> <!--End Date-->
                </div>
            </div>

            <div class="form-section">
                <div class="form-row">
                    <label for="t2_acad">Semester:</label>
                    <input type="text" id="t2_acad" name="t2_acad" value="2ND" readonly>
                </div>
                <div class="form-row date">
                    <label for="t2_sdate"><strong>*Start Date:</strong></label>
                    <label for="t2_edate">End Date:</label>
                    <input type="date" id="t2_sdate" name="t2_sdate" required> <!--Start Date-->
                    <input type="date" id="t2_edate" name="t2_edate" readonly> <!--End Date-->
                </div>
            </div>

            <div class="form-section">
                <div class="form-action-buttons">
                    <input type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#myForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json', // Expect JSON response
                success: function(response) {
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
                            location.reload(); // Reload the page to reset all form fields
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            window.location.href = "../PAGE/0_sysetup-rd.php"; // Replace with your desired URL
                        }
                    });
                },
                error: function(xhr, status, error) {
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
</script>

</html>