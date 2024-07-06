let current_page = 1;
const records_per_page = 10;

function prevPage() {
    if (current_page > 1) {
        current_page--;
        changePage(current_page);
    }
}

function nextPage() {
    const table = document.getElementById("user-table").getElementsByTagName("tbody")[0];
    const rows = table.getElementsByTagName("tr");
    if (current_page < numPages(rows)) {
        current_page++;
        changePage(current_page);
    }
}

function changePage(page) {
    const btn_next = document.getElementById("btn-next");
    const btn_prev = document.getElementById("btn-prev");
    const page_span = document.getElementById("page-num");

    const table = document.getElementById("user-table").getElementsByTagName("tbody")[0];
    const rows = table.getElementsByTagName("tr");

    if (page < 1) page = 1;
    if (page > numPages(rows)) page = numPages(rows);

    for (let i = 0; i < rows.length; i++) {
        rows[i].style.display = "none";
    }

    for (let i = (page - 1) * records_per_page; i < (page * records_per_page) && i < rows.length; i++) {
        rows[i].style.display = "";
    }

    page_span.innerHTML = `Page ${page} of ${numPages(rows)}`;

    if (page == 1) {
        btn_prev.style.visibility = "hidden";
    } else {
        btn_prev.style.visibility = "visible";
    }

    if (page == numPages(rows)) {
        btn_next.style.visibility = "hidden";
    } else {
        btn_next.style.visibility = "visible";
    }
}

function numPages(rows) {
    return Math.ceil(rows.length / records_per_page);
}

document.addEventListener('DOMContentLoaded', () => {
    changePage(1);
});

function searchUser() {
    const input = document.getElementById('search-bar').value.toUpperCase();
    const table = document.getElementById('user-table');
    const tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td')[1];
        if (td) {
            const txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(input) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
    changePage(1); // Reset to page 1 after search
}
