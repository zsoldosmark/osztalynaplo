const classSelect = document.querySelector('#classSelect');
const contentDiv = document.querySelector('#content');
const btnAll = document.querySelector('#btn-all');

classSelect.addEventListener('change', () => {
    const selectedClass = classSelect.value;
    
    if (!selectedClass) {
        contentDiv.innerHTML = '';
        return;
    }

    fetch(`ajax.php?action=get_class&class=${encodeURIComponent(selectedClass)}`)
        .then(response => response.text())
        .then(html => {
            contentDiv.innerHTML = html;
        });
});

if (btnAll) {
    btnAll.addEventListener('click', () => {
        fetch('ajax.php?action=get_all')
            .then(response => response.text())
            .then(html => {
                contentDiv.innerHTML = html;
            });
    });
}