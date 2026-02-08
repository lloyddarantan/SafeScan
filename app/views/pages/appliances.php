<?php 
require __DIR__ . '/../others/navigation.php';
?>

<title>SafeScan</title>
<link rel="stylesheet" href="/assets/css/appliances.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="dashboard-container">

    <aside class="sidebar">
        <a class="nav-item active" onclick="switchTab('all', this)">All</a>
        <a class="nav-item" onclick="switchTab('kitchen', this)">Kitchen</a>
        <a class="nav-item" onclick="switchTab('living room', this)">Living Room</a>
        <a class="nav-item" onclick="switchTab('bedroom', this)">Bedroom</a>
    </aside>

    <main class="main-content">

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
                            <label>Category</label>
                            <select id="typeFilter" onchange="filterAppliances()">
                                <option value="all">All Types</option>
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
                                <option value="low">Low wattage (&lt; 200W)</option>
                                <option value="high">High wattage (&gt; 200W)</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Energy Consumption</label>
                            <select id="energyFilter" onchange="filterAppliances()">
                                <option value="all">Any Consumption</option>
                                <option value="low">Low (&lt; 5kWh)</option>
                                <option value="high">High (&gt; 5kWh)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="main-appliance-list">
            <?php if(isset($groupedAppliances)): ?>
                <?php foreach ($groupedAppliances as $groupName => $items): ?>
                    <div class="type-section">
                        <h3 class="type-title"><?= htmlspecialchars($groupName) ?></h3>
                        <div class="product-grid">

                        <?php foreach ($items as $a): 
                            $imageFile = strtolower(str_replace(' ', '_', $a['type'])) . ".png";
                            $imagePath = "/assets/images/appliances/" . $imageFile;
                            $room = strtolower($a['category']); 
                        ?>
                            <div class="product-card"
                                data-room="<?= $room ?>"
                                data-name="<?= strtolower($a['type']) ?>"
                                data-wattage="<?= $a['wattage'] ?>"
                                data-energy="<?= $a['energy_consumption'] ?>">

                                <div class="card-image">
                                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($a['type']) ?>">
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
                        <?php endforeach; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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

<?php require __DIR__ . '/../others/footer.php'; ?>
<script src="/assets/js/appliances.js"></script>