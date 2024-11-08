//table
document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('course-table');
    const rows = table.querySelectorAll('tbody tr');
    const rowsPerPage = 10;
    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    const prevPageButton = document.getElementById('prevPage');
    const nextPageButton = document.getElementById('nextPage');
    const pageNumElement = document.getElementById('pageNum');

    function paginateTable(page) {
        const startIndex = (page - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
        });

        pageNumElement.textContent = `Page ${page} of ${totalPages}`;
    }

    prevPageButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            paginateTable(currentPage);
        }
    });

    nextPageButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            paginateTable(currentPage);
        }
    });

    paginateTable(currentPage);
});


$(document).ready(function () {
    $('#search-box').on('input', function () {
        const query = $(this).val().trim();
        if (query) {
            $.ajax({
                url: '../PROCESS/2_course-process-rd.php',
                type: 'GET',
                data: { ajax_query: query },
                dataType: 'json',
                success: function (data) {
                    const tableBody = $('#table-body');
                    tableBody.empty();
                    if (data.length > 0) {
                        data.forEach(row => {
                            const tr = `<tr>
                                <td>${row.id}</td>
                                <td>${row.prog_code}</td>
                                <td>${row.subj_code}</td>
                                <td>${row.subj_title}</td>
                                <td>${row.subj_units}</td>     
                                <td>${row.subj_Lecunits}</td>
                                <td>${row.subj_Labunits}</td>
                                <td>${row.subj_total_hours}</td>
                                <td>${row.subj_dept}</td>
                                <td>${row.subj_ylvl}</td>
                                <td>
                                    <form action="../PROCESS/2_course-process-rd.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="${row.id}">
                                        <button type="submit" name="update">Edit</button>
                                    </form>
                                    <button type="button" onclick="confirmDelete(${row.id})">Delete</button>
                                </td>
                            </tr>`;
                            tableBody.append(tr);
                        });
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'No results found',
                            text: 'No records match your search query.'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error: " + status + ": " + error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your request.'
                    });
                }
            });
        } else {
            resetTable();
        }
    });

    function resetTable() {
        $.ajax({
            url: '../PROCESS/2_course-process-rd.php',
            type: 'GET',
            data: { ajax_query: '' },
            dataType: 'json',
            success: function (data) {
                const tableBody = $('#table-body');
                tableBody.empty();
                data.forEach(row => {
                    const tr = `<tr>
                        <td>${row.id}</td>
                        <td>${row.prog_code}</td>
                        <td>${row.subj_code}</td>
                        <td>${row.subj_title}</td>
                        <td>${row.subj_units}</td>     
                        <td>${row.subj_Lecunits}</td>
                        <td>${row.subj_Labunits}</td>
                        <td>${row.subj_total_hours}</td>
                        <td>${row.subj_dept}</td>
                        <td>${row.subj_ylvl}</td>
                        <td>
                            <form action="../PROCESS/2_course-process-rd.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="${row.id}">
                                <button type="submit" name="update">Edit</button>
                            </form>
                            <button type="button" onclick="confirmDelete(${row.id})">Delete</button>
                        </td>
                    </tr>`;
                    tableBody.append(tr);
                });
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.'
                });
            }
        });
    }

    window.confirmDelete = function (id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this item!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../PROCESS/2_course-process-rd.php';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = id;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    };
});
