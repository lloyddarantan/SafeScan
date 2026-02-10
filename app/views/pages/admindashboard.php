<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeScan Admin</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='orange' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M4 8V6a2 2 0 0 1 2-2h2'/%3E%3Cpath d='M4 16v2a2 2 0 0 0 2 2h2'/%3E%3Cpath d='M16 4h2a2 2 0 0 1 2 2v2'/%3E%3Cpath d='M16 20h2a2 2 0 0 0 2-2v-2'/%3E%3Cline x1='4' y1='12' x2='20' y2='12'/%3E%3C/svg%3E">
</head>
<body>

    <header class="header">
        <div class="header-left">
            <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 8V6a2 2 0 0 1 2-2h2"></path>
                <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                <path d="M16 20h2a2 2 0 0 0 2-2v-2"></path>
                <line x1="4" y1="12" x2="20" y2="12"></line>
            </svg>
            <h1>SafeScan Admin</h1>
        </div>
        <a href="/logout" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </header>

    <nav class="nav-tabs">
        <div class="tab-link active" onclick="switchTab('admin', this)">Dashboard</div>
        <div class="tab-link" onclick="switchTab('users', this)">User Management</div>
        <div class="tab-link" onclick="switchTab('appliances', this)">Appliances</div>
    </nav>

    <div id="admin" class="view-section active">
        <div class="dashboard-grid">
            <div class="main-content">
                
                <div class="card profile-card">
                    <div class="profile-left">
                        <img src="https://api.dicebear.com/9.x/initials/svg?seed=<?php echo $data['admin']['first_name']; ?>" class="avatar">
                        <div class="profile-details">
                            <div class="data-group">
                                <label>Name</label>
                                <span><?php echo $data['admin']['first_name'] . ' ' . $data['admin']['last_name']; ?></span>
                            </div>
                            <div class="data-group">
                                <label>Email</label>
                                <span><?php echo $data['admin']['email']; ?></span>
                            </div>
                            <div class="data-group">
                                <label>Phone</label>
                                <span><?php echo $data['admin']['phone'] ?? 'Not Set'; ?></span>
                            </div>
                        </div>
                    </div>
                    <button class="btn-edit" onclick="openModal('modalProfile')">Edit Profile</button>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Recent Registrations</h2>
                        <a href="#" class="btn-text" onclick="switchTab('users', document.querySelectorAll('.tab-link')[1])">
                            View All Users <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead><tr><th>User Name</th><th>Location</th><th>Date Joined</th></tr></thead>
                            <tbody>
                                <?php if(!empty($data['recentUsers'])): ?>
                                    <?php foreach($data['recentUsers'] as $user): ?>
                                    <tr>
                                        <td><strong><?php echo $user['name']; ?></strong></td>
                                        <td><?php echo $user['loc']; ?></td>
                                        <td><?php echo $user['joined']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="3" style="text-align:center; color:#94a3b8;">No recent registrations.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <div class="card stat-card">
                    <h3>Total Users</h3>
                    <div class="stat-val"><?php echo $data['stats']['users'] ?? 0; ?></div>
                </div>
                <div class="card stat-card">
                    <h3>Appliances Logged</h3>
                    <div class="stat-val"><?php echo $data['stats']['appliances'] ?? 0; ?></div>
                </div>
            </div>
        </div>
    </div>

    <div id="users" class="view-section">
        <div class="card user-card">
            <div class="card-header">
                <h2 class="card-title">User Management</h2>

                <div class="header-controls">
                    <select id="userRoleFilter" class="filter-select" onchange="filterUsers()">
                        <option value="">All Roles</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>

                    <select id="userSort" class="filter-select" onchange="sortUsers()">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="az">Name (A-Z)</option>
                        <option value="za">Name (Z-A)</option>
                    </select>

                    <div class="search-wrapper">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="userSearch" class="search-box" placeholder="Search users..." onkeyup="filterUsers()">
                    </div>
                </div>
                </div>

            <div class="table-container">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Location</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <?php if(!empty($data['users'])): ?>
                            <?php foreach($data['users'] as $u): ?>
                                <tr class="user-row" 
                                    data-name="<?= strtolower($u['name']) ?>" 
                                    data-role="<?= $u['role'] ?>"
                                    data-timestamp="<?= strtotime($u['joined']) ?>">

                                    <td><strong><?= $u['name'] ?></strong></td>
                                    <td>
                                        <span class="badge badge-<?= strtolower($u['role']) ?>">
                                            <?= $u['role'] ?>
                                        </span>
                                    </td>
                                    <td><?= $u['loc'] ?></td>
                                    <td><?= $u['joined'] ?></td>
                                    <td>
                                        <button class="btn-action" onclick="openRoleModal(this, '<?php echo $u['user_id'] ?? ''; ?>')">
                                            <i class="fa-solid fa-user-pen"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="appliances" class="view-section">
        <div class="card appliance-card">
            <div class="card-header">
                <h2 class="card-title">Appliances Database</h2>

                <div class="header-controls">
                    <select id="filterBrand" class="filter-select" onchange="filterApps()">
                        <option value="">All Brands</option>
                    </select>
                    
                    <select id="filterGroup" class="filter-select" onchange="filterApps()">
                        <option value="">All Groups</option>
                    </select>

                    <div class="search-wrapper">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="appSearch" class="search-box" placeholder="Search model..." onkeyup="filterApps()">
                    </div>
                    <button class="btn-add" onclick="openModal('modalAppliance')">
                        <i class="fa-solid fa-plus"></i> New
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Group</th>
                        <th>Model</th>
                        <th>Watts</th>
                        <th>Consumption</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['appliances'] as $app): ?>
                            <tr class="app-row" 
                                data-brand="<?= $app['brand'] ?>" 
                                data-group="<?= $app['group'] ?>"
                                data-search="<?= strtolower($app['brand'] . ' ' . $app['group'] . ' ' . $app['type']) ?>">
                                
                                <td><strong><?= $app['brand'] ?></strong></td>
                                <td><?= $app['group'] ?></td>
                                <td><?= $app['type'] ?></td>
                                <td><?= $app['watt'] ?>W</td>
                                <td><?= $app['cons'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalProfile" class="modal-overlay" onclick="handleOutsideClick(event, 'modalProfile')">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Profile</h3>
                <i class="fa-solid fa-xmark close-modal" onclick="closeModal('modalProfile')"></i>
            </div>
            <form action="/admin/update_profile" method="POST">
				<div class="form-grid">
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="first_name" value="<?php echo $data['admin']['first_name']; ?>" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="last_name" value="<?php echo $data['admin']['last_name']; ?>" required>
					</div>

					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" value="<?php echo $data['admin']['phone'] ?? ''; ?>">
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" value="<?php echo $data['admin']['email']; ?>" required>
					</div>
				</div>

				<div class="modal-actions">
					<button type="button" class="btn-cancel" onclick="closeModal('modalProfile')">Cancel</button>
					<button type="submit" class="btn-add">Save Changes</button>
				</div>
			</form>
        </div>
    </div>

    <div id="modalAppliance" class="modal-overlay" onclick="handleOutsideClick(event, 'modalAppliance')">
        <div class="modal-content">
            <div class="modal-header"><h3>Add Appliance</h3><i class="fa-solid fa-xmark close-modal" onclick="closeModal('modalAppliance')"></i></div>
            <form action="/admin/add_appliance" method="POST">
                <div class="form-grid">
                    <div class="form-group"><label>Brand</label><input type="text" name="brand" required></div>
                    <div class="form-group"><label>Category</label>
                        <select name="group">
                            <option value="Air Conditioner">Air Conditioner</option>
                            <option value="Refrigerator">Refrigerator</option>
                            <option value="TV">TV</option>
                            <option value="Fan">Fan</option>
                        </select>
                    </div>
                    <div class="form-group full-width"><label>Model</label><input type="text" name="type" required></div>
                    <div class="form-group"><label>Watts</label><input type="number" name="watt" required></div>
                    <div class="form-group"><label>Consumption (kWh)</label><input type="text" name="cons" required></div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal('modalAppliance')">Cancel</button>
                    <button type="submit" class="btn-add">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalRole" class="modal-overlay" onclick="handleOutsideClick(event, 'modalRole')">
        <div class="modal-content" style="max-width: 450px;">
            <div class="modal-header">
                <h3>Edit User Role</h3>
                <i class="fa-solid fa-xmark close-modal" onclick="closeModal('modalRole')"></i>
            </div>
            <form action="/admin/update_role" method="POST">
                <input type="hidden" name="user_id" id="roleUserId">
                
                <div class="form-group">
                    <label>Select New Role</label>
                    <select name="role" class="filter-select" style="width: 100%;">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal('modalRole')">Cancel</button>
                    <button type="submit" class="btn-add">Update Role</button>
                </div>
            </form>
        </div>
    </div>

    <script src="/assets/js/admin.js"></script>
</body>
</html>