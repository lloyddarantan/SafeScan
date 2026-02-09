 // TABS
        function switchTab(id, el) {
            document.querySelectorAll('.view-section').forEach(d => d.classList.remove('active'));
            document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
            document.getElementById(id).classList.add('active');
            if(el) el.classList.add('active');
        }

        function openModal(id) { document.getElementById(id).style.display = 'flex'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        function handleOutsideClick(e, id) { if(e.target.id === id) closeModal(id); }

        function openRoleModal(btn, userId) {
            document.getElementById('roleUserId').value = userId;
            openModal('modalRole');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('.app-row');
            const brands = new Set();
            const groups = new Set();

            rows.forEach(row => {
                brands.add(row.getAttribute('data-brand'));
                groups.add(row.getAttribute('data-group'));
            });

            const brandSelect = document.getElementById('filterBrand');
            brands.forEach(b => brandSelect.add(new Option(b, b)));
            
            const groupSelect = document.getElementById('filterGroup');
            groups.forEach(g => groupSelect.add(new Option(g, g)));
        });

        function filterApps() {
            const search = document.getElementById('appSearch').value.toLowerCase();
            const brand = document.getElementById('filterBrand').value;
            const group = document.getElementById('filterGroup').value;
            
            document.querySelectorAll('.app-row').forEach(row => {
                const rBrand = row.getAttribute('data-brand');
                const rGroup = row.getAttribute('data-group');
                const rSearch = row.getAttribute('data-search');

                const show = rSearch.includes(search) && 
                             (brand === "" || rBrand === brand) && 
                             (group === "" || rGroup === group);
                
                row.style.display = show ? '' : 'none';
            });
        }
        
        function searchTable(inputId, tableId) {
            let filter = document.getElementById(inputId).value.toUpperCase();
            let rows = document.getElementById(tableId).getElementsByTagName('tr');
            for(let i=1; i<rows.length; i++) { // Start at 1 to skip header
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

                switch(sortValue) {
                    case 'az': return nameA.localeCompare(nameB);
                    case 'za': return nameB.localeCompare(nameA);
                    case 'newest': return timeB - timeA;
                    case 'oldest': return timeA - timeB;
                    default: return 0;
                }
            });

            rows.forEach(row => tableBody.appendChild(row));
        }

        document.addEventListener("DOMContentLoaded", function() {
            sortUsers();
        });