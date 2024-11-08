function viewAll() {
    window.location.href = '../PAGE/3_prq-rd.php'; // Adjust URL as needed
}


function saveData() {
    const subj_code = document.getElementById("subj_code").value;
    const prerequisites = [];

    // Loop through each row in the table and gather data
    const table = document.getElementById("d_prq");
    for (let i = 0; i < table.rows.length; i++) {
        const row = table.rows[i];
        const prq_code = row.querySelector('select[name^="prerequisites["][name$="[prq_code]"]').value;
        const prq_title = row.querySelector('input[name^="prerequisites["][name$="[prq_title]"]').value;

        // Check if any of the fields in the row are not empty
        if (prq_code || prq_title) {
            // Push data into prerequisites array only if row has data
            prerequisites.push({
                prq_code: prq_code,
                prq_title: prq_title
            });
        }
    }

    // Check if there are no rows with data
    if (prerequisites.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "No data to save.",
        });
        return; // Exit function if no data to save
    }

    // Send data to the server for processing
    $.ajax({
        type: "POST",
        url: "../PROCESS/3_prq-process-c.php",
        data: {
            subj_code: subj_code,
            prerequisites: prerequisites
        },
        success: function (response) {
            if (response.clearFields) {
                // Clear input fields after successful save
                document.getElementById("myForm").reset();
            }
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message,
            });
        },
        error: function (xhr, status, error) {
            if (xhr.status === 400 && xhr.responseJSON.message.includes("Duplicate entry")) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Duplicate entry for prerequisite code.",
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "An error occurred while saving data: " + error,
                });
            }
        }
    });
}

