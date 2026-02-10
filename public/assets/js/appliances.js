let currentRoomFilter = 'all';

// FILTER DROPDOWN
function toggleFilterMenu() {
    const menu = document.getElementById("filterMenu");
    menu.classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.filter-btn') && !event.target.closest('.filter-btn') && !event.target.closest('.filter-dropdown')) {
        const dropdowns = document.getElementsByClassName("filter-dropdown");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// FILTERING LOGIC
function filterAppliances() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const sortValue = document.getElementById('sortFilter').value;
    const groupValue = document.getElementById('groupFilter').value;
    const wattageValue = document.getElementById('wattageFilter').value;
    const energyValue = document.getElementById('energyFilter').value;

    const cards = Array.from(document.querySelectorAll('.product-card'));
    const groups = document.querySelectorAll('.group-section');

    cards.forEach(card => {
        const room = card.getAttribute('data-room');
        const cardGroup = card.getAttribute('data-group');
        const name = (card.getAttribute('data-name') || '').toLowerCase();
        const wattage = parseFloat(card.getAttribute('data-wattage'));
        const energy = parseFloat(card.getAttribute('data-energy'));

        let isVisible = true;

        // TAB filter
        if (currentRoomFilter !== 'all' && room !== currentRoomFilter) isVisible = false;

        // SEARCH filter
        if (searchText && !name.includes(searchText)) isVisible = false;

        // GROUP filter
       if (groupValue !== 'all') {
            const cardGroupNormalized = cardGroup.replace(/\s+/g, '-');
            if (cardGroupNormalized !== groupValue) isVisible = false;
        }

        // WATTAGE filter
        if (wattageValue === 'low' && wattage >= 200) isVisible = false;
        if (wattageValue === 'high' && wattage < 200) isVisible = false;

        // ENERGY filter
        if (energyValue === 'low' && energy >= 5) isVisible = false;
        if (energyValue === 'high' && energy < 5) isVisible = false;

        card.style.display = isVisible ? 'block' : 'none';
        if (isVisible) card.classList.add('visible-item');
        else card.classList.remove('visible-item');
    });

    // SORT within each group
    groups.forEach(group => {
        const grid = group.querySelector('.product-grid');
        const visibleCards = Array.from(group.querySelectorAll('.product-card.visible-item'));

        visibleCards.sort((a, b) => {
            const nameA = a.getAttribute('data-name').toLowerCase();
            const nameB = b.getAttribute('data-name').toLowerCase();
            if (sortValue === 'az') return nameA.localeCompare(nameB);
            if (sortValue === 'za') return nameB.localeCompare(nameA);
            return 0;
        });

        visibleCards.forEach(card => grid.appendChild(card));
        group.style.display = visibleCards.length > 0 ? 'block' : 'none';
    });
}

// TABS
function switchTab(room, element) {
    document.querySelectorAll('.sidebar .nav-item').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
    currentRoomFilter = room;

    const titles = {
        'all': 'All Appliances',
        'kitchen': 'Kitchen',
        'living room': 'Living Room',
        'bedroom': 'Bedroom'
    };
    
    const titleEl = document.getElementById('pageTitle');
    if(titleEl) titleEl.innerText = titles[room] || 'Appliances';

    filterAppliances();
}

document.addEventListener("DOMContentLoaded", () => {
    filterAppliances();
});
