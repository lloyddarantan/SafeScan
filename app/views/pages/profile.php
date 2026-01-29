<?php $page = 'profile'; ?>
<?php require __DIR__ . '/../others/navigation.php'; ?>

<link rel="stylesheet" href="../app/views/assets/css/profile.css">

<div class="dashboard-container">

    <div class="info-card">
        <div class="profile-flex">
            <i class="fa-solid fa-circle-user avatar-icon"></i>
            <span><?= $user['firstname'] . ' ' . $user['lastname']; ?></span>
        </div>
    </div>

    <div class="data-grid">
        <div class="data-group">
            <label>First Name</label>
            <div><?= $user['firstname']; ?></div>
        </div>
        <div class="data-group">
            <label>Last Name</label>
            <div><?= $user['lastname']; ?></div>
        </div>
        <div class="data-group">
            <label>Email</label>
            <div><?= $user['email']; ?></div>
        </div>
        <div class="data-group">
            <label>Contact</label>
            <div><?= $user['contact']; ?></div>
        </div>
        <div class="data-group">
            <label>Street</label>
            <div><?= $user['street']; ?></div>
        </div>
        <div class="data-group">
            <label>City</label>
            <div><?= $user['city']; ?></div>
        </div>
        <div class="data-group">
            <label>Province</label>
            <div><?= $user['province']; ?></div>
        </div>
        <div class="data-group">
            <label>Postal</label>
            <div><?= $user['postal']; ?></div>
        </div>
    </div>

</div>

<?php require __DIR__ . '/../others/footer.php'; ?>
