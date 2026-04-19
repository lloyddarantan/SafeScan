<?php 
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if (isset($_GET['logout'])) {
        require_once __DIR__ . '/../../controllers/AuthController.php'; 
        
        $auth = new AuthController();
        $auth->logout();
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: /login");
        exit;
    }

    require __DIR__ . '/../others/navigation.php';
?>

<title>SafeScan</title>
<link rel="stylesheet" href="/assets/css/outletmanagement.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="dashboard-container">
    <main class="main-content"> 
        <div id="section-outlet" class="content-section">
            <div class="section-header">
                <h3>Outlet Management</h3>
            </div>

            <div class="outlet-dashboard-grid" ondrop="removeAppliance(event)" ondragover="allowDrop(event)">
                
                <div class="outlet-work-area">
                    
                    <div class="outlet-controls">
                        <div class="control-header">
                            <div class="dropdown">
                                <button onclick="toggleDropdown()" class="control-btn dropbtn">
                                    <i class="fa-solid fa-gear"></i> Options <i class="fa-solid fa-caret-down"></i>
                                </button>
                                <div id="outletDropdown" class="dropdown-content">
                                    <a href="javascript:void(0)" onclick="setOutletMode(2)">
                                        <i class="fa-solid fa-plug"></i> 2 Sockets
                                    </a>
                                    <a href="javascript:void(0)" onclick="setOutletMode(3)">
                                        <i class="fa-solid fa-plug"></i> 3 Sockets
                                    </a>
                                    <div class="divider"></div>
                                    <a href="javascript:void(0)" onclick="clearOutlets()" class="danger-text">
                                        <i class="fa-solid fa-trash"></i> Clear All
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pagination-info">
                            Outlet Page: <span id="outlet-page" class="highlight-text">1</span>
                        </div>
                        
                        <div class="control-actions">
                            <button onclick="prevOutlet()" class="control-btn"><i class="fa-solid fa-chevron-left"></i> Prev</button>
                            <button onclick="nextOutlet()" class="control-btn">Next <i class="fa-solid fa-chevron-right"></i></button>
                            <button onclick="addOutlet()" class="control-btn btn-primary"><i class="fa-solid fa-plus"></i> New Outlet</button>
                            <button onclick="deleteOutlet()" class="control-btn btn-danger"><i class="fa-solid fa-trash-can"></i> Delete</button>
                        </div>

                        <div id="status-bar" class="status-bar safe">
                            <i class="fa-solid fa-circle-check"></i> <span id="status-text">System Normal</span>
                        </div>
                    </div>

                    <div class="outlet-plate-container">
                        <div class="wall-plate" id="socket-container">
                            <div class="socket-dropzone" ondrop="drop(event)" ondragover="allowDrop(event)" onclick="handleSocketClick(this)" id="socket-1">
                                <div class="socket-holes">
                                    <span></span><span></span><span></span>
                                </div>
                            </div>
                            <div class="socket-dropzone" ondrop="drop(event)" ondragover="allowDrop(event)" onclick="handleSocketClick(this)" id="socket-2">
                                <div class="socket-holes">
                                    <span></span><span></span><span></span>
                                </div>
                            </div>
                            <div class="socket-dropzone" ondrop="drop(event)" ondragover="allowDrop(event)" onclick="handleSocketClick(this)" id="socket-3">
                                <div class="socket-holes">
                                    <span></span><span></span><span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="outlet-details-row">
                        <div class="detail-card">
                            <h4><i class="fa-solid fa-link"></i> Connected Devices</h4>
                            <ul id="connection-list">
                                <li><span class="socket-label">Socket 1:</span> <span class="empty-slot">-</span></li>
                                <li><span class="socket-label">Socket 2:</span> <span class="empty-slot">-</span></li>
                                <li><span class="socket-label">Socket 3:</span> <span class="empty-slot">-</span></li>
                            </ul>
                        </div>
                        <div class="detail-card highlight-card">
                            <h4><i class="fa-solid fa-bolt"></i> Total Amperes</h4>
                            <div class="amp-display">
                                <span id="total-amps">0.00</span> <span class="unit">A</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="appliance-sidebar-panel" onclick="handleSidebarClick(this)">
                    <div class="sidebar-header">
                        <h4>
                            <a href="/profile#members" class="sidebar-link" onclick="event.stopPropagation();">
                                <i class="fa-solid fa-bookmark"></i> My Saved Appliances
                            </a>
                        </h4>
                        <p class="instruction-text">
                            <span class="desktop-text"><i class="fa-solid fa-hand-pointer"></i> Drag items to the outlet</span>
                            <span class="mobile-text"><i class="fa-solid fa-mobile-screen-button"></i> Tap item, then tap outlet to plug</span>
                        </p>
                    </div>
                    
                    <div class="draggable-list">
                        <?php if (!empty($savedAppliances)): ?>
                            <?php foreach ($savedAppliances as $row): ?>
                                <div class="draggable-item" 
                                    draggable="true" 
                                    ondragstart="drag(event)"
                                    onclick="handleApplianceClick(this)"
                                    data-name="<?= htmlspecialchars($row['type']) ?>" 
                                    data-brand="<?= htmlspecialchars($row['brand']) ?>"
                                    data-watts="<?= $row['wattage'] ?>"
                                    data-amps="<?= $row['amperes'] ?>"
                                    id="app-<?= $row['appliance_id'] ?>">
                                    
                                    <div class="drag-img">
                                        <img src="<?= $row['image'] ?>" alt="icon">
                                    </div>
                                    <div class="drag-info">
                                        <strong><?= htmlspecialchars($row['type']) ?></strong>
                                        <small><?= htmlspecialchars($row['brand']) ?></small>
                                        <span class="drag-specs">
                                            <i class="fa-solid fa-plug-circle-bolt"></i> <?= $row['wattage'] ?>W | <?= $row['amperes'] ?>A
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-items-container">
                                <div class="no-items-icon"><i class="fa-solid fa-box-open"></i></div>
                                <p class="no-items">No saved appliances.</p>
                                <a href="/appliances" class="save-appliance-btn">
                                    Save appliances now
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php require __DIR__ . '/../others/footer.php'; ?>
<script src="https://bernardo-castilho.github.io/DragDropTouch/DragDropTouch.js"></script>
<script src="/assets/js/outletmanagement.js"></script>
<div id="toast-container"></div>