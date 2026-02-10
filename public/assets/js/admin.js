function switchTab(id, el) {
    document.querySelectorAll('.view-section').forEach(d => d.classList.remove('active'));
    document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    if (el) el.classList.add('active');
}

function openModal(id) {
    const el = document.getElementById(id);
    if(el) el.style.display = 'flex';
}

function closeModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
	
    if (id === 'modalAppliance') {
        closeApplianceModal();
        return;
    }

    el.style.display = 'none';
    el.classList.remove('active');
}

function handleOutsideClick(event, modalId) {
    const modal = document.getElementById(modalId);
    if (event.target === modal) {
        closeModal(modalId);
    }
}

function openRoleModal(btn, userId) {
    document.getElementById('roleUserId').value = userId;
    openModal('modalRole');
}


document.addEventListener('DOMContentLoaded', () => {
    const rows = document.querySelectorAll('.app-row');
    const brands = new Set();
    const groups = new Set();
    const categories = new Set();

    rows.forEach(row => {
        brands.add(row.getAttribute('data-brand'));
        groups.add(row.getAttribute('data-group'));
        const cat = row.getAttribute('data-category');
        if (cat) categories.add(cat);
    });

    const brandSelect = document.getElementById('filterBrand');
    if(brandSelect) brands.forEach(b => brandSelect.add(new Option(b, b)));

    const groupSelect = document.getElementById('filterGroup');
    if(groupSelect) groups.forEach(g => groupSelect.add(new Option(g, g)));

    const catSelect = document.getElementById('filterCategory');
    if (catSelect) { categories.forEach(c => catSelect.add(new Option(c, c))); }

    sortUsers();

    document.querySelectorAll('.modal .close, .modal .cancel-btn, .close-modal').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const modal = this.closest('.modal') || this.closest('div[id^="modal"]');
            if(modal) {
                closeModal(modal.id);
            }
        });
    });
});

function filterApps() {
    const search = document.getElementById('appSearch').value.toLowerCase();
    const brand = document.getElementById('filterBrand').value;
    const group = document.getElementById('filterGroup').value;
    const categoryElement = document.getElementById('filterCategory');
    const category = categoryElement ? categoryElement.value : "";

    document.querySelectorAll('.app-row').forEach(row => {
        const rBrand = row.getAttribute('data-brand');
        const rGroup = row.getAttribute('data-group');
        const rCategory = row.getAttribute('data-category');
        const rSearch = row.getAttribute('data-search');

        const show = rSearch.includes(search) &&
            (brand === "" || rBrand === brand) &&
            (group === "" || rGroup === group) &&
            (category === "" || rCategory === category);

        row.style.display = show ? '' : 'none';
    });
}

function searchTable(inputId, tableId) {
    let filter = document.getElementById(inputId).value.toUpperCase();
    let rows = document.getElementById(tableId).getElementsByTagName('tr');
    for (let i = 1; i < rows.length; i++) {
        rows[i].style.display = rows[i].innerText.toUpperCase().includes(filter) ? '' : 'none';
    }
}

function filterUsers() {
    const searchInput = document.getElementById('userSearch').value.toLowerCase();
    const roleFilter = document.getElementById('userRoleFilter').value;
    const rows = document.querySelectorAll('.user-row');

    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        const role = row.getAttribute('data-role');

        const matchesSearch = name.includes(searchInput);
        const matchesRole = roleFilter === '' || role === roleFilter;

        if (matchesSearch && matchesRole) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function sortUsers() {
    const sortValue = document.getElementById('userSort').value;
    const tableBody = document.getElementById('usersTableBody');
    const rows = Array.from(document.querySelectorAll('.user-row'));

    rows.sort((a, b) => {
        const nameA = a.getAttribute('data-name');
        const nameB = b.getAttribute('data-name');
        const timeA = parseInt(a.getAttribute('data-timestamp'));
        const timeB = parseInt(b.getAttribute('data-timestamp'));

        switch (sortValue) {
            case 'az': return nameA.localeCompare(nameB);
            case 'za': return nameB.localeCompare(nameA);
            case 'newest': return timeB - timeA;
            case 'oldest': return timeA - timeB;
            default: return 0;
        }
    });

    rows.forEach(row => tableBody.appendChild(row));
}


function openApplianceModal() {
    const modal = document.getElementById('modalAppliance');
    modal.style.display = ''; 
    modal.classList.add('active');
}

function closeApplianceModal() {
    const modal = document.getElementById('modalAppliance');
    const form = document.getElementById('applianceForm');

    if (modal) {
        modal.classList.remove('active');
        modal.style.display = 'none';
    }

    if (form) form.reset();

    const img = document.getElementById('previewImage');
    const hint = document.getElementById('uploadHint');
    const removeBtn = document.getElementById('removePhotoBtn');

    if (img) {
        img.style.display = 'none';
        img.src = '';
    }
    if (hint) {
        hint.style.display = 'flex';
    }
    if (removeBtn) {
        removeBtn.style.display = 'none';
    }
}

function handleFileSelect(event) {
    const input = event.target;
    const img = document.getElementById('previewImage');
    const hint = document.getElementById('uploadHint');
    const removeBtn = document.getElementById('removePhotoBtn');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            img.src = e.target.result;
            
            img.style.display = 'block';
            hint.style.display = 'none';
            removeBtn.style.display = 'flex';
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function removePhoto() {
    const input = document.getElementById('hiddenFileInput');
    const img = document.getElementById('previewImage');
    const hint = document.getElementById('uploadHint');
    const removeBtn = document.getElementById('removePhotoBtn');

    input.value = '';
    img.src = '';

    img.style.display = 'none';
    hint.style.display = 'flex';
    removeBtn.style.display = 'none';
}