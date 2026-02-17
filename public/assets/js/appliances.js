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
	
    const modal = document.getElementById('applianceDetailModal');
    if (event.target == modal) {
        closeApplianceModal();
    }

    const authModal = document.getElementById('authModal');
    if (event.target == authModal) {
        authModal.style.display = "none";
    }
}

// FILTERING LOGIC
function filterAppliances() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const searchTerms = searchInput.split(' ').filter(term => term.trim() !== '');

    const sortValue = document.getElementById('sortFilter').value;
    const groupValue = document.getElementById('groupFilter').value;
    const wattageValue = document.getElementById('wattageFilter').value;
    const energyValue = document.getElementById('energyFilter').value;

    const cards = Array.from(document.querySelectorAll('.product-card'));
    const groups = document.querySelectorAll('.group-section');

    const isDefaultState = (
        searchInput === '' &&
        groupValue === 'all' &&
        wattageValue === 'all' &&
        energyValue === 'all' &&
        currentRoomFilter === 'all'
    );

    cards.forEach(card => {
        const room = card.getAttribute('data-room');
        const cardGroup = card.getAttribute('data-group');

        const name = (card.getAttribute('data-name') || '').toLowerCase();
        const brand = (card.getAttribute('data-brand') || '').toLowerCase();
        const searchData = `${name} ${brand}`;

        const wattage = parseFloat(card.getAttribute('data-wattage'));
        const energy = parseFloat(card.getAttribute('data-energy'));

        let isVisible = true;

        if (currentRoomFilter !== 'all' && room !== currentRoomFilter) isVisible = false;

        if (searchTerms.length > 0) {
            const matchesAllTerms = searchTerms.every(term => searchData.includes(term));
            if (!matchesAllTerms) isVisible = false;
        }
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
	
    currentRoomFilter = room.replace(/-/g, ' ');
	
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

// --- MODAL LOGIC START ---

let visibleApplianceCards = [];
let currentApplianceIndex = 0;

function openApplianceModal(cardElement) {
    document.body.classList.add('modal-open');

    const allCards = Array.from(document.querySelectorAll('.product-card'));
    visibleApplianceCards = allCards.filter(card => 
        card.classList.contains('visible-item') && card.offsetParent !== null
    );

    if (visibleApplianceCards.length === 0) visibleApplianceCards = allCards;

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
    const enterClass = direction === 1 ? 'slide-in-right' : 'slide-in-left';

    container.classList.add(exitClass);

    setTimeout(() => {
        let newIndex = currentApplianceIndex + direction;
        if (newIndex >= visibleApplianceCards.length) newIndex = 0;
        else if (newIndex < 0) newIndex = visibleApplianceCards.length - 1;

        currentApplianceIndex = newIndex;
        updateModalContent(visibleApplianceCards[currentApplianceIndex]);

        container.classList.remove(exitClass);
        
        void container.offsetWidth; 

        container.classList.add(enterClass);

        setTimeout(() => {
            container.classList.remove(enterClass);
            isAnimating = false;
        }, 300);

    }, 200);
}

function updateModalContent(card) {
    const img = card.getAttribute('data-img');
    const title = card.getAttribute('data-display-name') || card.getAttribute('data-name');
    const brand = card.getAttribute('data-brand');
    const wattage = card.getAttribute('data-wattage');
    const energy = card.getAttribute('data-energy');
    
    const safety = card.getAttribute('data-safety') || 'General safety precautions apply.';
    const hazards = card.getAttribute('data-hazards') || 'None reported.';

    document.getElementById('detailImage').src = img;
    document.getElementById('detailTitle').textContent = title;
    document.getElementById('detailBrand').textContent = brand;
    document.getElementById('detailWattage').textContent = wattage + ' W';
    document.getElementById('detailEnergy').textContent = energy + ' kWh';
    
    document.getElementById('detailSafety').textContent = safety;
    document.getElementById('detailHazards').textContent = hazards;
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
    
    if (!modalBox) return;

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


function setApplianceView(viewType, btn) {
    document.querySelectorAll('.btn-view').forEach(b => b.classList.remove('active'));
    if(btn) btn.classList.add('active');

    const tableView = document.querySelector('.table-container');
    const gridView = document.getElementById('appliances-grid');

    if (viewType === 'grid') {
        if(tableView) tableView.style.display = 'none';
        if(gridView) gridView.style.display = 'grid'; 
        localStorage.setItem('appView', 'grid');
    } else {
        if(tableView) tableView.style.display = 'block';
        if(gridView) gridView.style.display = 'none';
        localStorage.setItem('appView', 'list');
    }
}

function openEditAppliance(id, brand, type, group, category, watt, cons, safety, hazards, image_path) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_brand').value = brand;
    document.getElementById('edit_type').value = type;
    document.getElementById('edit_group').value = group;
    document.getElementById('edit_category').value = category;
    document.getElementById('edit_watt').value = watt;
    document.getElementById('edit_cons').value = cons;
    document.getElementById('edit_safety').value = safety;
    document.getElementById('edit_hazards').value = hazards;

    const previewImg = document.getElementById('edit_previewImage');
    const hint = document.getElementById('edit_uploadHint');
    
    if (image_path) {
        previewImg.src = image_path;
        previewImg.style.display = 'block';
        hint.style.display = 'none';
    } else {
        previewImg.src = '';
        previewImg.style.display = 'none';
        hint.style.display = 'flex';
    }

    openModal('modalEditAppliance');
}

function handleEditFileSelect(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('edit_previewImage');
        output.src = reader.result;
        output.style.display = 'block';
        document.getElementById('edit_uploadHint').style.display = 'none';
    };
    reader.readAsDataURL(event.target.files[0]);
}

function toggleSeeMore(button) {
    const groupSection = button.closest('.group-section');
    const hiddenCards = groupSection.querySelectorAll('.product-card.appliance-hidden');
    const isExpanded = button.classList.contains('expanded');

    if (!isExpanded) {
        hiddenCards.forEach(card => {
            card.style.display = 'block';
            card.classList.add('visible-by-button'); 
        });
        button.innerHTML = 'See Less <i class="fa-solid fa-chevron-up"></i>';
        button.classList.add('expanded');
    } else {
        hiddenCards.forEach(card => {
            card.style.display = 'none';
            card.classList.remove('visible-by-button');
        });
        button.innerHTML = 'See More <i class="fa-solid fa-chevron-down"></i>';
        button.classList.remove('expanded');
    }
}