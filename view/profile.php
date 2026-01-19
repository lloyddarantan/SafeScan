<?php $page = 'profile'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Scan - Profile</title>
    
    <link rel="stylesheet" href="../view/assets/css/index.css">
    <link rel="stylesheet" href="../view/assets/css/profile.css">

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- NAVIGATION BAR -->
    <?php include 'others/navigation.php'; ?>

<!-- switch windows -->
    <div class="dashboard-container">
        
        <aside class="sidebar">
            <a class="nav-item active" onclick="switchTab('profile', this)">My Profile</a>
            <a class="nav-item" onclick="switchTab('members', this)">Members</a>
            <a class="nav-item" onclick="switchTab('history', this)">History</a>
            <a class="nav-item danger" onclick="switchTab('delete', this)">Delete Account</a>
        </aside>

        <main class="main-content">

<!-- PROFILE SECTION -->
            <div id="section-profile" class="content-section active">
                <div class="header-row">
                    <span class="page-title">My Profile</span>
                    <span class="role-badge">ADMIN</span>
                </div>

                <div class="info-card">
                    <div class="profile-flex" style="justify-content: space-between;">
                        <div class="profile-flex">
                            <i class="fa-solid fa-circle-user avatar-icon"></i>
                            <span style="font-size: 1.1rem; font-weight: 500;">Lloyd Darantan</span>
                        </div>
                        <a href="#" class="edit-btn">Edit <i class="fa-solid fa-pen"></i></a>
                    </div>
                </div>

<!-- PERSONAL INFORMATION PART -->
                <div class="info-card">
                    <div class="card-header">
                        <h3 class="card-title">Personal Information</h3>
                        </div>
                    
                    <div class="data-grid">
                        <div class="data-group">
                            <label>First Name</label>
                            <div>Lloyd</div>
                        </div>
                        <div class="data-group">
                            <label>Last Name</label>
                            <div>Darantan</div>
                        </div>
                        <div class="data-group">
                            <label>Email Address</label>
                            <div>llloyd@gmail.com</div>
                        </div>
                        <div class="data-group">
                            <label>Password</label>
                            <div>********</div>
                        </div>
                        <div class="data-group">
                            <label>Contact Number</label>
                            <div>+63 999 999</div>
                        </div>
                    </div>
                </div>

<!-- ADDRESS PART -->
                <div class="info-card">
                    <div class="card-header">
                        <h3 class="card-title">Address</h3>
                        </div>

                    <div class="data-grid">
                        <div class="data-group">
                            <label>Street</label>
                            <div>1st Street</div>
                        </div>
                        <div class="data-group">
                            <label>City</label>
                            <div>Bacolod City</div>
                        </div>
                        <div class="data-group">
                            <label>Province</label>
                            <div>Negros Occidental</div>
                        </div>
                        <div class="data-group">
                            <label>Postal Code</label>
                            <div>6100</div>
                        </div>
                    </div>
                </div>

<!-- LOG OUT BUTTON -->
                <button class="logout-btn" onclick="openLogoutModal()">Log Out</button>
            </div>

<!-- MEMBER WINDOW -->
            <div id="section-members" class="content-section">
                
                <div style="margin-bottom: 10px;">
                    <h3 style="font-weight: 400; font-size: 1.1rem;">Member</h3>
                </div>

                <div class="member-grid">
                    
                    <div class="member-card">
                        <i class="fa-regular fa-circle-user member-avatar"></i>
                        
                        <div class="member-info">
                            <div class="member-name">
                                Lloyd Darantan 
                                <span class="badge-owner">Owner</span>
                            </div>
                            <span class="member-email">email@gmail.com</span>
                        </div>
                    </div>

                    <div class="member-card">
                        <i class="fa-regular fa-circle-user member-avatar"></i>
                        <div class="member-info">
                            <div class="member-name">Member 1</div>
                            <span class="member-email">member@gmail.com</span>
                        </div>
                    </div>

                    <div class="member-card">
                        <i class="fa-regular fa-circle-user member-avatar"></i>
                        <div class="member-info">
                            <div class="member-name">Member 1</div>
                            <span class="member-email">member@gmail.com</span>
                        </div>
                    </div>

                </div>
            </div>

<!-- HISTORY WINDOW -->
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
                        <tr>
                            <td>Air Conditioner</td>
                            <td>Panasonic 1HP</td>
                            <td>839 Watts</td>
                        </tr>
                        <tr>
                            <td>Refrigerator</td>
                            <td>Samsung Inverter</td>
                            <td>150 Watts</td>
                        </tr>
                        <tr>
                            <td>Television</td>
                            <td>Sony Bravia</td>
                            <td>120 Watts</td>
                        </tr>
                    </tbody>
                </table>
            </div>

<!-- DELETE ACCOUNT WINDOW -->
            <div id="section-delete" class="content-section">
                <h2 style="color: #ff4d4d; margin-bottom: 20px;">Delete Account</h2>
                <p>Are you sure you want to delete your account? This action cannot be undone and all your data will be lost.</p>
        
                <button class="logout-btn" style="background: #ff4d4d; color: white; margin-top: 20px;" onclick="openDeleteModal()">
                Delete My Account</button>
            </div>

        </main>
    </div>

<!-- EDIT MODAL -->
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
                        <input type="text" name="firstname" value="Lloyd">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lastname" value="Darantan">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="llloyd@gmail.com">
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="contact" value="+63 999 999">
                    </div>
                    <div class="form-group full-width">
                        <label>Street Address</label>
                        <input type="text" name="street" value="1st Street">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" value="Bacolod City">
                    </div>
                    <div class="form-group">
                        <label>Province</label>
                        <input type="text" name="province" value="Negros Occidental">
                    </div>
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" name="postal" value="6100">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

<!-- LOG OUT MODAL -->
    <div class="modal-overlay" id="logoutModal">
        <div class="modal-content" style="max-width: 400px;"> <div class="modal-header" style="justify-content: center; border-bottom: none; padding-bottom: 0;">
            <h3>Confirm Log Out</h3>
        </div>

        <div class="modal-body" style="text-align: center; color: var(--text-dark); margin-top: 10px;">
            <p>Are you sure you want to log out?</p>
        </div>

        <div class="modal-footer" style="justify-content: center; margin-top: 20px;">
            <button type="button" class="cancel-btn" onclick="closeLogoutModal()">Cancel</button>
    
            <a href="../login/universallogin.php" class="confirm-logout-btn">Log Out</a>
        </div>
        </div>
    </div>

<!-- DELETE ACCOUNT MODAL -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content" style="max-width: 400px;"> 
            
            <div class="modal-header" style="justify-content: center; border-bottom: none; padding-bottom: 0;">
                <h3 style="color: #ff4d4d;">Final Confirmation</h3>
            </div>

            <div class="modal-body" style="text-align: center; color: var(--text-dark); margin-top: 10px;">
                <p style="font-weight: 500;">You are about to permanently delete your account.</p>
                <p style="font-size: 0.9rem; color: #666; margin-top: 5px;">This action cannot be reversed.</p>
            </div>

            <div class="modal-footer" style="justify-content: center; margin-top: 20px;">
                <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                
                <form action="../login/universallogin.php" method="POST" style="display:inline;">
                    <button type="submit" class="confirm-logout-btn" style="background-color: #ff4d4d;">Yes, Delete</button>
                </form>
            </div>

        </div>
    </div>

<!-- JAVASCRIPT FILE -->
    <script src="../view/assets/js/profile.js"></script>
    
<!-- FOOTER -->
    <?php include 'others/footer.php'; ?>

</body>
</html>