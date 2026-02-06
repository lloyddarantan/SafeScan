<?php 
    // $page = 'appliances';
    require __DIR__ . '/../others/navigation.php';
?>

<title>Appliances - SafeScan</title>
<link rel="stylesheet" href="/assets/css/appliances.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="dashboard-container">

    <aside class="sidebar">
        <a class="nav-item active" onclick="switchTab('all', this)">All</a>
        <a class="nav-item" onclick="switchTab('kitchen', this)">Kitchen</a>
        <a class="nav-item" onclick="switchTab('living', this)">Living Room</a>
        <a class="nav-item" onclick="switchTab('bedroom', this)">Bedroom</a>
    </aside>

    <main class="main-content">

        <div class="header-row" style="justify-content: space-between; align-items: center; margin-bottom: 30px;">
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
                                <option value="az">Alphabetical (A &rarr; Z)</option>
                                <option value="za">Alphabetical (Z &rarr; A)</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Category</label>
                            <select id="typeFilter" onchange="filterAppliances()">
                                <option value="all">All Types</option>
                                <option value="ac">Air Conditioner</option>
                                <option value="tv">Television</option>
                                <option value="fridge">Refrigerator</option>
                                <option value="small">Small Appliances</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Wattage</label>
                            <select id="wattageFilter" onchange="filterAppliances()">
                                <option value="all">Any Wattage</option>
                                <option value="low">Low wattage (< 200W)</option>
                                <option value="high">High wattage (> 200W)</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Energy Consumption</label>
                            <select id="energyFilter" onchange="filterAppliances()">
                                <option value="all">Any Consumption</option>
                                <option value="low">Low (< 5kWh)</option>
                                <option value="high">High (> 5kWh)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="main-appliance-list">

            <div class="type-section" id="group-ac">
                <h3 class="type-title">Air Conditioner</h3>
                <div class="product-grid">
                    <div class="product-card" data-type="ac" data-room="bedroom" data-wattage="950" data-energy="8" data-name="Panasonic CW 1.0 HP">
                        <div class="card-image"><img src="https://placehold.co/300x200/png?text=AC+Unit" alt="AC"></div>
                        <div class="card-info">
                            <h4>Panasonic CW 1.0 HP</h4>
                            <span class="category-tag">Bedroom</span>
                            <div class="specs"><span><i class="fa-solid fa-bolt"></i> 950W</span><span><i class="fa-solid fa-plug"></i> 8kWh</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="type-section" id="group-tv">
                <h3 class="type-title">Television</h3>
                <div class="product-grid">
                    <div class="product-card" data-type="tv" data-room="living" data-wattage="140" data-energy="2" data-name="Sony Bravia 55">
                        <div class="card-image"><img src="https://placehold.co/300x200/png?text=Smart+TV" alt="TV"></div>
                        <div class="card-info">
                            <h4>Sony Bravia 55"</h4>
                            <span class="category-tag">Living Room</span>
                            <div class="specs"><span><i class="fa-solid fa-bolt"></i> 140W</span><span><i class="fa-solid fa-plug"></i> 2kWh</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="type-section" id="group-fridge">
                <h3 class="type-title">Refrigerator</h3>
                <div class="product-grid">
                    <div class="product-card" data-type="fridge" data-room="kitchen" data-wattage="120" data-energy="4" data-name="Samsung Inverter Ref">
                        <div class="card-image"><img src="https://placehold.co/300x200/png?text=Fridge" alt="Fridge"></div>
                        <div class="card-info">
                            <h4>Samsung Inverter Ref</h4>
                            <span class="category-tag">Kitchen</span>
                            <div class="specs"><span><i class="fa-solid fa-bolt"></i> 120W</span><span><i class="fa-solid fa-plug"></i> 4kWh</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="type-section" id="group-small">
                <h3 class="type-title">Small Appliances</h3>
                <div class="product-grid">
                    <div class="product-card" data-type="small" data-room="kitchen" data-wattage="300" data-energy="1" data-name="Oster Blender">
                        <div class="card-image"><img src="https://placehold.co/300x200/png?text=Blender" alt="Blender"></div>
                        <div class="card-info">
                            <h4>Oster Blender</h4>
                            <span class="category-tag">Kitchen</span>
                            <div class="specs"><span><i class="fa-solid fa-bolt"></i> 300W</span><span><i class="fa-solid fa-plug"></i> 1kWh</span></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
</div>

<?php require __DIR__ . '/../others/footer.php'; ?>
<script src="/assets/js/appliances.js"></script>