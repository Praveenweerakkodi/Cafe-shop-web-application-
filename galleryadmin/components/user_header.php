<header class="header">
    <div class="flex">
        <a href="dashboard.php" class="logo"><img src="../img/logo1.png"></a>
        <nav class="navbar">
            <a href="index.php">Products</a>
            <a href="wishlist.php">Wishlist</a>
            <div class="dropdown">
                <a href="#" class="dropbtn">Reservations</a>
                <div class="dropdown-content">
                    <a href="add_table.php">Table Reservations</a>
                    <a href="add_parking.php">Parking Reservations</a>
                    <a href="add_food_booking.php">Food Reservations</a>
                </div>
            </div>
            <a href="about_us.php">About us</a>
            <a href="contact_us.php">Contact us</a>
        </nav>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search...">
            <button  type="button" onclick="searchCuisine()"><i class="bx bx-search"></i></button>
            <div id="suggestions"></div>
        </div>
        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>
            <i class="bx bx-list-plus" id="menu-btn"></i>
        </div>

        <div class="profile-detail">
 
            <div class="profile">
            <img src="../img/dp1.png" class="logo-img">
                <p>Login as..</p>
                
                
            </div>

            <div class="flex-btn">
                <a href="user_login.php" class="btn">User</a>
                <a href="staff_login.php" class="btn">Staff</a>
                <a href="login.php" class="btn">Admin</a>
            </div>

        </div>
    </div>
</header>
