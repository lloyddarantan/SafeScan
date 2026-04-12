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

function setApplianceView(viewType, btn) {
    const buttons = btn.parentElement.querySelectorAll('.btn-view');
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const container = document.querySelector('#appliances .table-container');

    if (!container) return;

    if (viewType === 'grid') {
        container.classList.add('grid-view');
    } else {
        container.classList.remove('grid-view');
    }
}

function openEditAppliance(data) {
    document.getElementById('edit_appliance_id').value = data.appliance_id;
    document.getElementById('edit_brand').value = data.brand;
    document.getElementById('edit_type').value = data.type;
    document.getElementById('edit_watt').value = data.watt;
    document.getElementById('edit_cons').value = data.cons;
    document.getElementById('edit_safety_reminder').value = data.safety_reminder;
    document.getElementById('edit_hazards').value = data.hazards;
    document.getElementById('edit_current_image').value = data.image;

    document.getElementById('edit_category').value = data.category;
    document.getElementById('edit_group').value = data.group;

    const preview = document.getElementById('editPreviewImage');
    preview.src = data.image_path || '/assets/img/appliances/' + data.image;

    openModal('modalEditAppliance');
}

function handleEditFileSelect(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('editPreviewImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

let currentDeleteId = null;

function openDeleteModal(applianceId) {
    currentDeleteId = applianceId;
    openModal('deleteModal'); 
}

function closeDeleteModal() {
    currentDeleteId = null;
    closeModal('deleteModal'); 
}

function keepApplianceTabOpen() {
    sessionStorage.setItem('reopenSection', 'appliances');
}

function confirmDelete() {
    if (currentDeleteId) {
        keepApplianceTabOpen();
        window.location.href = '/admin/delete_appliance?id=' + currentDeleteId;
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const addForm = document.querySelector('form[action="/admin/add_appliance"]');
    const editForm = document.querySelector('form[action="/admin/edit_appliance"]');
    
    if (addForm) addForm.addEventListener('submit', keepApplianceTabOpen);
    if (editForm) editForm.addEventListener('submit', keepApplianceTabOpen);


    let sectionToReopen = sessionStorage.getItem('reopenSection');
    
    if (sectionToReopen === 'appliances') {
        let applianceTabBtn = Array.from(document.querySelectorAll('.tab-link'))
                                   .find(tab => tab.textContent.includes('Appliances'));
        
        if (applianceTabBtn) {
            switchTab('appliances', applianceTabBtn);
        }
        
        sessionStorage.removeItem('reopenSection'); 
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('locationPieChart');
    
    if (canvas) {
        const ctx = canvas.getContext('2d');
        
        const locationLabels = JSON.parse(canvas.getAttribute('data-labels'));
        const locationData = JSON.parse(canvas.getAttribute('data-counts'));

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: locationLabels,
                datasets: [{
					label: 'Users by Location',
                    data: locationData,
                    backgroundColor: [
                        '#F89b42',
                        '#1a2238',
                        '#ff4d4d',
                        '#e08b3b',
                        '#888888',
                        '#555555'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
    responsive: true,
    maintainAspectRatio: false, // Essential for the 300px height to work
    plugins: {
        title: {
            display: false // Hide Chart.js title since the HTML card header has it
        },
        legend: {
            position: 'bottom', // Moving the legend to the bottom looks cleaner for pie charts
            labels: {
                padding: 20,
                usePointStyle: true // Makes the legend indicators circles instead of boxes
            }
        }
    }
}
        });
    }
});

let applianceChartInstance = null;
let parsedAppStats = null;

document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('applianceChart');
    
    if (canvas) {
        parsedAppStats = JSON.parse(canvas.getAttribute('data-stats'));
        
        const ctx = canvas.getContext('2d');
        const defaultLabels = Object.keys(parsedAppStats['group_watts']);
        const defaultData = Object.values(parsedAppStats['group_watts']);

        applianceChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: defaultLabels,
                datasets: [{
                    label: 'Average Watts',
                    data: defaultData,
                    backgroundColor: '#F89b42',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Average Watts per Group',
                        color: '#1a2238'
                    },
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});

function updateAppChart(dataKey, chartTitle, btnElement) {
    if (!applianceChartInstance || !parsedAppStats) return;

    document.querySelectorAll('.btn-chart-toggle').forEach(btn => btn.classList.remove('active'));
    btnElement.classList.add('active');

    const newLabels = Object.keys(parsedAppStats[dataKey]);
    const newData = Object.values(parsedAppStats[dataKey]);
    
    const isWatts = dataKey.includes('watts');
    const color = isWatts ? '#F89b42' : '#ff4d4d';
    const label = isWatts ? 'Average Watts' : 'Average kWh';

    applianceChartInstance.data.labels = newLabels;
    applianceChartInstance.data.datasets[0].data = newData;
    applianceChartInstance.data.datasets[0].label = label;
    applianceChartInstance.data.datasets[0].backgroundColor = color;
    applianceChartInstance.options.plugins.title.text = chartTitle;
    
    applianceChartInstance.update();
}