let currentRoomFilter = 'all';

function filterAppliances() {
//Get Values from Inputs
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const sortValue = document.getElementById('sortFilter').value;
    
// Dropdown filters
    const typeValue = document.getElementById('typeFilter').value; // e.g., 'tv', 'ac'
    const wattValue = document.getElementById('wattageFilter').value;
    const energyValue = document.getElementById('energyFilter').value;
    
//Loop through each Section (The Groups)
    const groups = document.querySelectorAll('.type-section');
    
    groups.forEach(group => {
        const cards = Array.from(group.getElementsByClassName('product-card'));
        let visibleCount = 0;

//Check visibility for each card
        cards.forEach(card => {
// Get Card Data
            const name = card.getAttribute('data-name').toLowerCase();
            const room = card.getAttribute('data-room');   // e.g., 'kitchen'
            const type = card.getAttribute('data-type');   // e.g., 'tv'
            const wattage = parseInt(card.getAttribute('data-wattage'));
            const energy = parseInt(card.getAttribute('data-energy'));

            let isVisible = true;

 // --- FILTER LOGIC ---
            
       //Sidebar Room Check
            if (currentRoomFilter !== 'all' && room !== currentRoomFilter) isVisible = false;

        //Dropdown Type Check (TV, AC, etc.)
            if (typeValue !== 'all' && type !== typeValue) isVisible = false;

        //Search Text
            if (searchText && !name.includes(searchText)) isVisible = false;

        // Wattage
            if (wattValue === 'low' && wattage >= 200) isVisible = false;
            if (wattValue === 'high' && wattage < 200) isVisible = false;

         // Energy
            if (energyValue === 'low' && energy >= 5) isVisible = false;
            if (energyValue === 'high' && energy < 5) isVisible = false;

         // Apply Visibility
            card.style.display = isVisible ? 'block' : 'none';
            if (isVisible) visibleCount++;
        });

 //Hide the whole Group Header if no cards are visible inside it
        group.style.display = visibleCount > 0 ? 'block' : 'none';

//Sort visible cards inside this group
        if (visibleCount > 0) {
            const visibleCards = cards.filter(c => c.style.display !== 'none');
            visibleCards.sort((a, b) => {
                const nameA = a.getAttribute('data-name').toLowerCase();
                const nameB = b.getAttribute('data-name').toLowerCase();
                if (sortValue === 'az') return nameA.localeCompare(nameB);
                return nameB.localeCompare(nameA); // za
            });
        // Re-append cards in sorted order
            const groupGrid = group.querySelector('.product-grid');
            visibleCards.forEach(card => groupGrid.appendChild(card));
        }
    });
}

// --- Sidebar Navigation Logic ---
function switchTab(room, element) {
    //Update visual active state on sidebar
    document.querySelectorAll('.sidebar .nav-item').forEach(el => el.classList.remove('active'));
    element.classList.add('active');

    // Set the global room filter variable
    currentRoomFilter = room;

    //Update Page Title
    const titles = {
        'all': 'All Appliances',
        'kitchen': 'Kitchen',
        'living': 'Living Room',
        'bedroom': 'Bedroom'
    };
    const titleEl = document.getElementById('pageTitle');
    if(titleEl) titleEl.innerText = titles[room] || 'Appliances';

    // Run the main filter function
    filterAppliances();
}

// --- Menu Toggles ---
function toggleFilterMenu() {
    document.getElementById('filterMenu').classList.toggle('show');
}

window.onclick = function(event) {
    if (!event.target.matches('.filter-btn') && !event.target.closest('.filter-btn') && !event.target.closest('.filter-dropdown')) {
        const menu = document.getElementById('filterMenu');
        if (menu) menu.classList.remove('show');
    }
}