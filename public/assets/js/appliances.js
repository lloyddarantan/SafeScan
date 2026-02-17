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

    const isDefaultState = (
        searchText === '' && 
        groupValue === 'all' && 
        wattageValue === 'all' && 
        energyValue === 'all' && 
        currentRoomFilter === 'all'
    );

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
        if (wattageValue === 'low' && wattage >= 300) isVisible = false;
        if (wattageValue === 'high' && wattage < 300) isVisible = false;

        // ENERGY filter
        if (energyValue === 'low' && energy >= 2) isVisible = false;
        if (energyValue === 'high' && energy < 2) isVisible = false;

        if (isVisible) {
            card.classList.add('visible-item');
            
            if (isDefaultState) {
                card.style.display = ''; 
            } else {
                card.style.display = 'block'; 
            }
        } else {
            card.classList.remove('visible-item');
            card.style.display = 'none';
        }
    });

    const seeMoreButtons = document.querySelectorAll('.see-more-wrapper');
    seeMoreButtons.forEach(btn => {
		
        btn.style.display = isDefaultState ? 'flex' : 'none';
    });

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

    // Convert hyphen to space for matching data-room
    currentRoomFilter = room.replace(/-/g, ' ');

    // Update page title correctly
    const titles = {
        'all': 'All Appliances',
        'kitchen': 'Kitchen',
        'living room': 'Living Room',
        'bedroom': 'Bedroom'
    };

    const titleEl = document.getElementById('pageTitle');
    if (titleEl) titleEl.innerText = titles[currentRoomFilter] || 'Appliances';

    filterAppliances();
}


document.addEventListener("DOMContentLoaded", () => {
    filterAppliances();
});

function openApplianceModal(cardElement) {
    document.body.classList.add('modal-open');

    const allCards = Array.from(document.querySelectorAll('.product-card'));
    visibleApplianceCards = allCards.filter(card => card.offsetParent !== null);
    
    currentApplianceIndex = visibleApplianceCards.indexOf(cardElement);

    if (currentApplianceIndex > -1) {
        updateModalContent(visibleApplianceCards[currentApplianceIndex]);
        document.getElementById('applianceDetailModal').style.display = 'flex';
    }
}

function closeApplianceModal() {
    document.body.classList.remove('modal-open');
    document.getElementById('applianceDetailModal').style.display = 'none';
}

let isAnimating = false;

    function changeAppliance(direction) {
    if (visibleApplianceCards.length === 0 || isAnimating) return;
    
    isAnimating = true;
    const container = document.querySelector('.detail-modal-layout');
    
    const exitClass = direction === 1 ? 'slide-out-left' : 'slide-out-right';
    const enterClass = direction === 1 ? 'slideInRight' : 'slideInLeft';
    
    container.classList.add(exitClass);

    setTimeout(() => {
        let newIndex = currentApplianceIndex + direction;
        if (newIndex >= visibleApplianceCards.length) newIndex = 0;
        else if (newIndex < 0) newIndex = visibleApplianceCards.length - 1;

        currentApplianceIndex = newIndex;
        updateModalContent(visibleApplianceCards[currentApplianceIndex]);

        container.classList.remove(exitClass);

        container.style.animation = 'none';
        container.offsetHeight;
        container.style.animation = `${enterClass} 0.3s forwards`;

        setTimeout(() => {
            container.style.animation = '';
            isAnimating = false;
        }, 300);

    }, 200);
}

    function updateModalContent(card) {
        const img = card.getAttribute('data-img');
        const title = card.getAttribute('data-display-name');
        const brand = card.getAttribute('data-brand');
        const wattage = card.getAttribute('data-wattage');
        const energy = card.getAttribute('data-energy');
        const group = card.getAttribute('data-group');

        document.getElementById('detailImage').src = img;
        document.getElementById('detailTitle').textContent = title;
        document.getElementById('detailBrand').textContent = brand;
        document.getElementById('detailWattage').textContent = wattage + ' W';
        document.getElementById('detailEnergy').textContent = energy + ' kWh';
        document.getElementById('detailGroup').textContent = group.charAt(0).toUpperCase() + group.slice(1);
    }

    window.onclick = function(event) {
        const modal = document.getElementById('applianceDetailModal');
        if (event.target == modal) {
            closeApplianceModal();
        }
		
        const authModal = document.getElementById('authModal');
        if (event.target == authModal) {
            authModal.style.display = "none";
        }
    }
    
    document.addEventListener('keydown', function(event) {
        if (document.getElementById('applianceDetailModal').style.display === 'flex') {
            if (event.key === 'ArrowLeft') {
                changeAppliance(-1);
            } else if (event.key === 'ArrowRight') {
                changeAppliance(1);
            } else if (event.key === 'Escape') {
                closeApplianceModal();
            }
        }
    });

document.addEventListener('DOMContentLoaded', () => {
    const modalBox = document.querySelector('.detail-modal-box');
    let touchStartX = 0;
    let touchEndX = 0;

    modalBox.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    modalBox.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        const threshold = 50;
        
        if (touchEndX < touchStartX - threshold) {
            changeAppliance(1); 
        }
        
        if (touchEndX > touchStartX + threshold) {
            changeAppliance(-1);
        }
    }
});

function toggleSeeMore(btn) {
    const groupSection = btn.closest('.group-section');
    
    const hiddenItems = groupSection.querySelectorAll('.appliance-hidden');
    
    const isExpanded = btn.classList.contains('expanded');

    if (!isExpanded) {
        hiddenItems.forEach(item => {
            item.style.display = 'unset'; 
        });
        
        btn.innerHTML = 'Show Less <i class="fa-solid fa-chevron-up"></i>';
        btn.classList.add('expanded');
    } else {
        hiddenItems.forEach(item => {
            item.style.display = 'none';
        });
        
        btn.innerHTML = 'See More <i class="fa-solid fa-chevron-down"></i>';
        btn.classList.remove('expanded');
    }
}

window.addEventListener("load", () => {
    const hash = window.location.hash.slice(1); 
    if (hash) {

        const navItem = Array.from(document.querySelectorAll('.sidebar .nav-item'))
                             .find(el => el.getAttribute('onclick')?.includes(hash));

        if (navItem) {
            const onclickAttr = navItem.getAttribute('onclick');
            const match = /switchTab\('(.+?)'/.exec(onclickAttr);
            if (match) {
                const room = match[1];
                switchTab(room, navItem);
            }
        }
    }
});

