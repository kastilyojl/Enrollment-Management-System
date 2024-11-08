function viewAll() {
    window.location.href = '../PAGE/5_tuition-rd.php'; // Adjust URL as needed
}

function addRow() {
    const table = document.getElementById("d_tuitions");
    const newRow = table.rows[0].cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    table.appendChild(newRow);
}

function removeRow() {
    const table = document.getElementById("d_tuitions");
    if (table.rows.length > 1) {
        table.deleteRow(table.rows.length - 1);
    }
}

function saveData() {
    const prog_dept = document.getElementById("prog_dept").value;
    const prog_code = document.getElementById("prog_code").value;
    const tuition_rows = [];

    const table = document.getElementById("d_tuitions");
    let allFieldsValid = true;

    for (let i = 0; i < table.rows.length; i++) {
        const row = table.rows[i];
        const t_code = row.querySelector('input[name^="tuitions["][name$="[t_code]"]').value.trim();
        const t_cat = row.querySelector('input[name^="tuitions["][name$="[t_cat]"]').value.trim();
        const t_famt = row.querySelector('input[name^="tuitions["][name$="[t_famt]"]').value.trim();
        const t_inst = row.querySelector('input[name^="tuitions["][name$="[t_inst]"]').value.trim();
        const t_pre = row.querySelector('input[name^="tuitions["][name$="[t_pre]"]').value.trim();
        const t_mid = row.querySelector('input[name^="tuitions["][name$="[t_mid]"]').value.trim();
        const t_fin = row.querySelector('input[name^="tuitions["][name$="[t_fin]"]').value.trim();

        if (!t_code || !t_cat || !t_famt || !t_inst || !t_pre || !t_mid || !t_fin) {
            allFieldsValid = false;
            break;
        }

        tuition_rows.push({
            t_code: t_code,
            t_cat: t_cat,
            t_famt: parseFloat(t_famt),
            t_inst: parseFloat(t_inst),
            t_pre: parseFloat(t_pre),
            t_mid: parseFloat(t_mid),
            t_fin: parseFloat(t_fin),
        });
    }

    if (!allFieldsValid) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "Please complete all fields in the added rows.",
        });
        return;
    }

    if (tuition_rows.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "No data to save.",
        });
        return;
    }

    $.ajax({
        type: "POST",
        url: "../PROCESS/5_tuition-process-c.php",
        data: {
            prog_dept: prog_dept,
            prog_code: prog_code,
            tuitions: tuition_rows
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
