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

    // $page = 'profile';
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
                <!-- <span class="role-badge">USER</span> -->
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
		
<!-- LOGOUT MODAL -->
<div id="logoutModal" class="modal-overlay">
   	<div class="modal-content compact-modal" style="text-align: center; max-width: 400px;">
        
        <div class="modal-header" style="border-bottom: none; justify-content: flex-end;">
            <span class="close-modal" onclick="closeLogoutModal()">&times;</span>
        </div>

        <div class="logout-content">
            <div class="logout-icon-container">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </div>

            <h3>Sign Out</h3>
            
            <p class="logout-text">
                Are you sure you want to sign out of SafeScan?
            </p>
        </div>

        <div class="modal-footer" style="justify-content: center; gap: 10px; border-top: none; padding-top: 10px;">
            <button type="button" class="cancel-btn" onclick="closeLogoutModal()">
                Cancel
            </button>
            <a href="?logout=true" class="confirm-logout-btn">
                Log Out
            </a>
        </div>
    </div>
</div>

        <!-- APPLIANCES SECTION -->
        <div id="section-members" class="content-section">
            <h3 style="font-weight: 400; margin-bottom: 10px;">Appliances</h3>
            <div class="member-grid">
                <!-- ADD LIKED APPLIANCES HERE -->
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
            <p>Are you sure you want to delete your account? This action cannot be undone.</p> <br><br>
            <button class="logout-btn" style="background: #ff4d4d; color: white;" onclick="openDeleteModal()">
                Delete My Account
            </button>
        </div>

    </main>
</div>

<!-- EDIT PROFILE MODAL -->
<div id="editModal" class="modal-overlay">
    <div class="modal-content compact-modal">
        <div class="modal-header">
            <h3>Edit Profile</h3>
            <span class="close-modal" onclick="closeModal()">&times;</span>
        </div>
        <form action="/profile/update" method="POST" class="edit-form">
            <div class="form-grid">
                
                <div class="form-group full-width">
                    <h4 class="form-section-title">Personal Details</h4>
                </div>
                
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
                    <label>Contact</label>
                    <input type="text" name="contact" value="<?= htmlspecialchars($user['phone']); ?>">
                </div>

                <div class="form-group full-width" style="margin-top: 5px;">
                    <h4 class="form-section-title">Home Address</h4>
                </div>
                
                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" name="street" value="<?= htmlspecialchars($user['street']); ?>">
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" value="<?= htmlspecialchars($user['country'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" value="<?= htmlspecialchars($user['city'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>Province</label>
                    <input type="text" name="province" value="<?= htmlspecialchars($user['province'] ?? ''); ?>">
                </div>

                <div class="form-group full-width" style="margin-top: 5px;">
                    <h4 class="form-section-title">Security</h4>
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" placeholder="New password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm new password">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                <button type="submit" class="save-btn">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- delete account modal -->
    <div id="deleteModal" class="modal-overlay">
    <div class="modal-content compact-modal" style="text-align: center; max-width: 400px;">
        
        <div class="modal-header" style="border-bottom: none; justify-content: flex-end;">
            <span class="close-modal" onclick="closeDeleteModal()">&times;</span>
        </div>

        <div class="delete-content">
            <div class="danger-icon-container">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <h3>Delete Account?</h3>
            
            <p class="delete-warning-text">
                You are about to permanently delete your account. 
                This action <strong>cannot</strong> be undone.
            </p>
        </div>

        <form action="/profile/delete" method="POST">
            <div class="modal-footer" style="justify-content: center; gap: 10px; border-top: none; padding-top: 10px;">
                <button type="button" class="cancel-btn" onclick="closeDeleteModal()">
                    Keep Account
                </button>
                <button type="submit" class="delete-confirm-btn">
                    Yes, Delete
                </button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../others/footer.php'; ?>
<script src="/assets/js/profile.js"></script>
