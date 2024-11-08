document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('progstud-table');
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
                url: '../PROCESS/7_cs-process-c.php',
                type: 'GET',
                data: { ajax_query: query },
                dataType: 'json',
                success: function (data) {
                    const tableBody = $('#table-body');
                    tableBody.empty();
                    if (data.length > 0) {
                        data.forEach(row => {
                            const tr = `<tr>
                                <td>${row.id_stuInfo}</td>
                                <td>${row.lname}</td>
                                <td>${row.fname}</td>
                                <td>${row.e_mail}</td>
                                <td>${row.dept}</td>
                                <td>${row.str_crs}</td>
                                <td>${row.gy_level}</td>
                                <td>
                                    <form action="../PROCESS/7_cs-process-c.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_stuInfo" value="${row.id_stuInfo}">
                                        <button type="submit" name="check">Check</button>
                                    </form>
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
            url: '../PROCESS/7_cs-process-c.php',
            type: 'GET',
            data: { ajax_query: '' },
            dataType: 'json',
            success: function (data) {
                const tableBody = $('#table-body');
                tableBody.empty();
                data.forEach(row => {
                    const tr = `<tr>
                        <td>${row.id_stuInfo}</td>
                        <td>${row.lname}</td>
                        <td>${row.fname}</td>
                        <td>${row.e_mail}</td>
                        <td>${row.dept}</td>
                        <td>${row.str_crs}</td>
                        <td>${row.gy_level}</td>
                        <td>
                            <form action="../PROCESS/7_cs-process-c.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_stuInfo" value="${row.id_stuInfo}">
                                <button type="submit" name="check">Check</button>
                            </form>
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
});
