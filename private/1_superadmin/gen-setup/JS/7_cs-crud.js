
document.addEventListener('DOMContentLoaded', () => {
    fetchData();
    setInterval(fetchData, 5000); // Fetch data every 5 seconds
});

function fetchData() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'path_to_your_php_script.php', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const data = JSON.parse(this.responseText);
            populateTable(data);
        }
    };
    xhr.send();
}

function populateTable(data) {
    const tableBody = document.getElementById('table-body');
    tableBody.innerHTML = '';

    data.forEach(row => {
        const newRow = document.createElement('tr');

        Object.values(row).forEach(value => {
            const newCell = document.createElement('td');
            newCell.textContent = value;
            newRow.appendChild(newCell);
        });

        const actionCell = document.createElement('td');
        const removeButton = document.createElement('button');
        removeButton.textContent = 'remove';
        removeButton.addEventListener('click', () => {
            removeRow(row.id); // Pass the row ID to the remove function
        });
        actionCell.appendChild(removeButton);
        newRow.appendChild(actionCell);

        tableBody.appendChild(newRow);
    });
}

function removeRow(rowId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../PAGE/7_cs-crud.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.status === 200) {
            fetchData(); // Refresh the table after removing the row
        }
    };
    xhr.send(`remove=true&id=${rowId}`);
}
