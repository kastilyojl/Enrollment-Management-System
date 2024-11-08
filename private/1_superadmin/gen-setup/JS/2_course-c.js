function viewAll() {
    window.location.href = '../PAGE/2_course-rd.php'; // Adjust URL as needed
}

function addRow() {
    const table = document.getElementById("d_subject");
    const newRow = table.rows[0].cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    table.appendChild(newRow);
}

function removeRow() {
    const table = document.getElementById("d_subject");
    if (table.rows.length > 1) {
        table.deleteRow(table.rows.length - 1);
    }
}

function updateYearLevelOptions() {
    const subjDept = document.getElementById("subj_dept").value;
    const subjYlvl = document.getElementById("subj_ylvl");
    subjYlvl.innerHTML = '';

    if (subjDept === "SHS") {
        addOption(subjYlvl, "Grade 11", "Grade 11");
        addOption(subjYlvl, "Grade 12", "Grade 12");
    } else if (subjDept === "COLLEGE") {
        addOption(subjYlvl, "1st year", "1st year");
        addOption(subjYlvl, "2nd year", "2nd year");
        addOption(subjYlvl, "3rd year", "3rd year");
        addOption(subjYlvl, "4th year", "4th year");
    }

    subjYlvl.selectedIndex = 0;
}

function addOption(selectElement, text, value) {
    const option = document.createElement("option");
    option.text = text;
    option.value = value;
    selectElement.add(option);
}

function saveData() {
    const prog_code = document.getElementById("prog_code").value;
    const subj_dept = document.getElementById("subj_dept").value;
    const subj_ylvl = document.getElementById("subj_ylvl").value;
    const subj_sem = document.getElementById("subj_sem").value;
    const subject_rows = [];

    const table = document.getElementById("d_subject");
    let allFieldsValid = true;

    for (let i = 0; i < table.rows.length; i++) {
        const row = table.rows[i];
        const subj_code = row.querySelector('input[name^="subjects["][name$="[subj_code]"]').value.trim();
        const subj_title = row.querySelector('input[name^="subjects["][name$="[subj_title]"]').value.trim();
        const subj_units = row.querySelector('input[name^="subjects["][name$="[subj_units]"]').value.trim();
        const subj_Labunits = row.querySelector('input[name^="subjects["][name$="[subj_Labunits]"]').value.trim();
        const subj_total_minutes = row.querySelector('input[name^="subjects["][name$="[subj_total_minutes]"]').value.trim();

        if (!subj_code || !subj_title || !subj_total_minutes) {
            allFieldsValid = false;
            break;
        }

        if (subj_units === "0" && subj_Labunits === "0") {
            allFieldsValid = false;
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: "Both subj_units and subj_Labunits cannot be 0.",
            });
            break;
        }

        subject_rows.push({
            subj_code: subj_code,
            subj_title: subj_title,
            subj_units: subj_units,
            subj_Labunits: subj_Labunits,
            subj_total_minutes: subj_total_minutes
        });
    }

    if (!allFieldsValid) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "Please complete all fields in the added rows and ensure at least one of subj_units or subj_Labunits is greater than 0.",
        });
        return;
    }

    if (subject_rows.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "No data to save.",
        });
        return;
    }

    $.ajax({
        type: "POST",
        url: "../PROCESS/2_course-process-c.php",
        data: {
            prog_code: prog_code,
            subj_dept: subj_dept,
            subj_ylvl: subj_ylvl,
            subj_sem: subj_sem,
            subjects: subject_rows
        },
        success: function (response) {
            if (response.clearFields) {
                document.getElementById("myForm").reset();
            }
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message,
            });
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "An error occurred while saving data: " + xhr.responseText,
            });
        }
    });
}

