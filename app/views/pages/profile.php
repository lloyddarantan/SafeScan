<?php 
    $page = 'profile';
    require __DIR__ . '/../others/navigation.php';
 ?>

<title>SafeScan</title>
<link rel="stylesheet" href="/assets/css/profile.css">

<div class="dashboard-container">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a class="nav-item active" onclick="switchTab('profile', this)">My Profile</a>
        <a class="nav-item" onclick="switchTab('members', this)">Members</a>
        <a class="nav-item" onclick="switchTab('history', this)">History</a>
        <a class="nav-item danger" onclick="switchTab('delete', this)">Delete Account</a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- PROFILE SECTION -->
        <div id="section-profile" class="content-section active">
            <div class="header-row">
                <span class="page-title">My Profile</span>
                <span class="role-badge">USER</span>
            </div>

            <div class="info-card">
                <div class="profile-flex" style="justify-content: space-between;">
                    <div class="profile-flex">
                        <i class="fa-solid fa-circle-user avatar-icon"></i>
                        <span style="font-size: 1.1rem; font-weight: 500;">
                            <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>
                        </span>
                    </div>
                    <a href="#" class="edit-btn" onclick="openModal()">
                        Edit <i class="fa-solid fa-pen"></i>
                    </a>
                </div>
            </div>

            <!-- PERSONAL INFORMATION -->
            <div class="info-card">
                <div class="card-header">
                    <h3 class="card-title">Personal Information</h3>
                </div>
                <div class="data-grid">
                    <div class="data-group">
                        <label>First Name</label>
                        <div><?= htmlspecialchars($user['first_name']); ?></div>
                    </div>
                    <div class="data-group">
                        <label>Last Name</label>
                        <div><?= htmlspecialchars($user['last_name']); ?></div>
                    </div>
                    <div class="data-group">
                        <label>Email Address</label>
                        <div><?= htmlspecialchars($user['email']); ?></div>
                    </div>
                    <div class="data-group">
                        <label>Password</label>
                        <div>********</div>
                    </div>
                    <div class="data-group">
                        <label>Contact Number</label>
                        <div><?= htmlspecialchars($user['phone']); ?></div>
                    </div>
                </div>
            </div>

            <!-- ADDRESS SECTION -->
            <div class="info-card">
                <div class="card-header">
                    <h3 class="card-title">Address</h3>
                </div>
                <div class="data-grid">
                    <div class="data-group">
                        <label>Street</label>
                        <div><?= htmlspecialchars($user['street']); ?></div>
                    </div>
                    <div class="data-group">
                        <label>City</label>
                        <div><?= htmlspecialchars($user['city'] ?? ''); ?></div>
                    </div>
                    <div class="data-group">
                        <label>Province</label>
                        <div><?= htmlspecialchars($user['province'] ?? ''); ?></div>
                    </div>
                    <div class="data-group">
                        <label>Postal Code</label>
                        <div><?= htmlspecialchars($user['country'] ?? ''); ?></div>
                    </div>
                </div>
            </div>

            <!-- LOGOUT BUTTON -->
            <button class="logout-btn" onclick="openLogoutModal()">Log Out</button>
        </div>

        <!-- MEMBERS SECTION -->
        <div id="section-members" class="content-section">
            <h3 style="font-weight: 400; margin-bottom: 10px;">Members</h3>
            <div class="member-grid">
                <!-- Example member card -->
                <div class="member-card">
                    <i class="fa-regular fa-circle-user member-avatar"></i>
                    <div class="member-info">
                        <div class="member-name">
                            <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>
                            <span class="badge-owner">Owner</span>
                        </div>
                        <span class="member-email"><?= htmlspecialchars($user['email']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- HISTORY SECTION -->
        <div id="section-history" class="content-section">
            <div class="table-header-row">
                <span class="section-heading">History</span>
                <button class="filter-btn"><i class="fa-solid fa-filter"></i> Filter</button>
            </div>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Appliances</th>
                        <th>Type</th>
                        <th>Watts</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data -->
                </tbody>
            </table>
        </div>

        <!-- DELETE ACCOUNT SECTION -->
        <div id="section-delete" class="content-section">
            <h2 style="color: #ff4d4d; margin-bottom: 20px;">Delete Account</h2>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <button class="logout-btn" style="background: #ff4d4d; color: white;" onclick="openDeleteModal()">
                Delete My Account
            </button>
        </div>

    </main>
</div>

<!-- EDIT PROFILE MODAL -->
<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Profile</h3>
            <span class="close-modal" onclick="closeModal()">&times;</span>
        </div>
        <form action="" method="POST" class="edit-form">
            <div class="form-grid">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" value="<?= htmlspecialchars($user['first_name']); ?>">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" value="<?= htmlspecialchars($user['last_name']); ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>">
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact" value="<?= htmlspecialchars($user['phone']); ?>">
                </div>
                <div class="form-group full-width">
                    <label>Street Address</label>
                    <input type="text" name="street" value="<?= htmlspecialchars($user['street']); ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                <button type="submit" class="save-btn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../others/footer.php'; ?>
<script src="/assets/js/profile.js"></script>
