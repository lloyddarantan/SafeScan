<?php 
require __DIR__ . '/../others/navigation.php';
?>

<title>SafeScan</title>
<link rel="stylesheet" href="/assets/css/appliances.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="dashboard-container">

    <aside class="sidebar">
        <a class="nav-item active" onclick="switchTab('all', this)">All</a>
        <a class="nav-item" onclick="switchTab('kitchen', this)">Kitchen</a>
        <a class="nav-item" onclick="switchTab('living-room', this)">Living Room</a>
        <a class="nav-item" onclick="switchTab('bedroom', this)">Bedroom</a>
    </aside>

    <main class="main-content">
        <div id="main-appliances-list">
            
            <div class="header-row">
                <span class="page-title" id="pageTitle">All Appliances</span>

                <div class="controls-wrapper">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInput" onkeyup="filterAppliances()" placeholder="Search..">
                    </div>

                    <div class="filter-container">
                        <button class="filter-btn" onclick="toggleFilterMenu()">
                            <i class="fa-solid fa-sliders"></i> Filter
                        </button>

                        <div id="filterMenu" class="filter-dropdown">
                            <div class="filter-group">
                                <label>Sort</label>
                                <select id="sortFilter" onchange="filterAppliances()">
                                    <option value="az">Alphabetical (A → Z)</option>
                                    <option value="za">Alphabetical (Z → A)</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Group</label>
                                <select id="groupFilter" onchange="filterAppliances()">
                                    <option value="all">All Groups</option>
                                    <?php if(isset($groupedAppliances)): ?>
                                        <?php foreach(array_keys($groupedAppliances) as $g): ?>
                                            <option value="<?= strtolower(str_replace(' ', '-', $g)) ?>">
                                                <?= htmlspecialchars($g) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Wattage</label>
                                <select id="wattageFilter" onchange="filterAppliances()">
                                    <option value="all">Any Wattage</option>
                                    <option value="low">Low (&lt; 300W)</option>
                                    <option value="high">High (&gt; 300W)</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Energy Consumption</label>
                                <select id="energyFilter" onchange="filterAppliances()">
                                    <option value="all">Any Consumption</option>
                                    <option value="low">Low (&lt; 2kWh)</option>
                                    <option value="high">High (&gt; 3kWh)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="appliances-grid-container">
                <?php if(isset($groupedAppliances)): ?>
                    <?php foreach ($groupedAppliances as $groupName => $items): ?>
                        
                        <?php 
                        // Generate ID for sidebar navigation (e.g., 'living-room')
                        $groupID = strtolower(str_replace(' ', '-', $groupName)); 
                        ?>

                        <div class="group-section" id="<?= $groupID ?>">
                            <h3 class="group-title">
                                <?= htmlspecialchars($groupName) ?>
                                <span style="font-size: 0.8em; color: #999; font-weight: normal;">(<?= count($items) ?>)</span>
                            </h3>
                            
                            <div class="product-grid">
                                <?php 
                                $limit = 4; // LIMIT: Show 4 items initially
                                $index = 0;
                                foreach ($items as $a): 
                                    // If index is 4 or greater, hide it
                                    $visibilityClass = ($index >= $limit) ? 'appliance-hidden' : '';
                                ?>
                                    <div class="product-card <?= $visibilityClass ?>"
                                         onclick="openApplianceModal(this)"
                                         data-room="<?= strtolower($a['category']) ?>"
                                         data-group="<?= strtolower($groupName) ?>"
                                         data-name="<?= strtolower($a['type']) ?>"
                                         data-brand="<?= htmlspecialchars($a['brand']) ?>"
                                         data-wattage="<?= $a['wattage'] ?>"
                                         data-energy="<?= $a['energy_consumption'] ?>"
                                         data-img="<?= $a['image'] ?>"
                                         data-display-name="<?= htmlspecialchars($a['type']) ?>">

                                        <form method="POST" action="/favorite/toggle" style="display:inline;" onclick="event.stopPropagation()">
                                            <input type="hidden" name="appliance_id" value="<?= $a['appliance_id'] ?>">
                                            <button type="submit" class="fav-btn <?= $a['isLiked'] ? 'active' : '' ?>">
                                                <i class="<?= $a['isLiked'] ? 'fa-solid' : 'fa-regular' ?> fa-heart"></i>
                                            </button>
                                        </form>

                                        <div class="card-image">
                                            <img src="<?= $a['image'] ?>" alt="<?= htmlspecialchars($a['type']) ?>">
                                        </div>

                                        <div class="card-info">
                                            <h4><?= htmlspecialchars($a['type']) ?></h4>
                                            <p class="brand"><?= htmlspecialchars($a['brand']) ?></p>

                                            <div class="specs">
                                                <span><i class="fa-solid fa-bolt"></i> <?= $a['wattage'] ?> W</span>
                                                <span><i class="fa-solid fa-plug"></i> <?= $a['energy_consumption'] ?> kWh</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                    $index++; 
                                endforeach; 
                                ?>
                            </div>

                            <?php if(count($items) > $limit): ?>
                                <div class="see-more-wrapper">
                                    <button class="btn-see-more" onclick="toggleSeeMore(this)">
                                        See More <i class="fa-solid fa-chevron-down"></i>
                                    </button>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<div id="authModal" class="modal-overlay">
    <div class="modal-box">
        <span class="close-modal">&times;</span>
        <div class="modal-content">
            <i class="fa-solid fa-lock" style="font-size: 3rem; color: orange; margin-bottom: 15px;"></i>
            <h3>Login Required</h3>
            <p>You need to sign in to view your profile, use the chat, or upload appliances.</p>
            <div class="modal-actions">
                <a href="/login" class="btn-login">Log In</a>
                <a href="/signup" class="btn-signup">Sign Up</a>
            </div>
        </div>
    </div>
</div>

<div id="applianceDetailModal" class="modal-overlay">
    <div class="modal-box detail-modal-box">
        
        <div class="close-modal-modal" onclick="closeApplianceModal()">
            <i class="fa-solid fa-xmark"></i>
        </div>

        <button class="nav-arrow prev" onclick="changeAppliance(-1)">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="nav-arrow next" onclick="changeAppliance(1)">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="detail-modal-layout">
            <div class="detail-image-container">
                <img id="detailImage" src="" alt="Appliance Image">
            </div>

            <div class="detail-info-container">
                <span id="detailBrand" class="detail-brand">BRAND NAME</span>
                
                <h2 id="detailTitle">Appliance Title</h2>
                
                <div class="detail-specs-grid">
                    <div class="spec-item">
                        <i class="fa-solid fa-bolt"></i>
                        <span class="label">Power Usage</span>
                        <span class="value" id="detailWattage">0 W</span>
                    </div>

                    <div class="spec-item">
                        <i class="fa-solid fa-plug"></i>
                        <span class="label">Energy Rating</span>
                        <span class="value" id="detailEnergy">0 kWh</span>
                    </div>

                    <div class="spec-item">
                        <i class="fa-solid fa-layer-group"></i>
                        <span class="label">Category</span>
                        <span class="value" id="detailGroup">Room</span>
                    </div>

                    <div class="spec-item">
                        <i class="fa-regular fa-circle-check"></i>
                        <span class="label">Status</span>
                        <span class="value">Available</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../others/footer.php'; ?>

<script src="/assets/js/appliances.js"></script>