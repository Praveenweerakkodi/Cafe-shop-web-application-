<header class="header">
    <div class="flex">
        <a href="dashboard.php" class="logo"><img src="../img/logo1.png" ></a>
        <nav class="navbar">
            <a href="dashboard.php">Dashboard</a>
            <a href="add_products.php">Add products</a>
            <a href="view_products.php">View products</a>
            <a href="register.php">Register a Admin</a>
            <div class="dropdown">
                <a href="#" class="dropbtn">Accounts</a>
                <div class="dropdown-content">
                    <a href="admin_account.php">Registered Admins</a>
                    <a href="staff_account.php">Registered Staff members</a>
                    <a href="user_account.php">Registered users</a>
                    <a href="staff_register.php">Register a staff</a>
                    
                </div>
            </div>
        </nav>
        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>
            <i class="bx bx-list-plus" id="menu-btn"></i>
        </div>
        <div class="profile-detail">
           
           <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);

            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            
            ?>
            <div class="profile">
                <img src="../image/<?= $fetch_profile['profile']; ?>" class="logo-img">
                <p><?= $fetch_profile['name']; ?></p>
            </div>
            <div class="flex-btn">
                <a href="admin_profile.php" class="btn">profile</a>
                <a href="../components/admin_logout.php" onclick="return confirm('logout from this website');" 
                class="btn">logout </a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</header>