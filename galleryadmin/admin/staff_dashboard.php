<?php 
    include '../components/connection.php';

    // Assuming you have a session started and user ID stored in the session
    session_start();
    $staff_id = $_SESSION['staff_id'] ?? null;

    if (isset($_SESSION['login_success'])) {
        echo "<script>
            alert('" . $_SESSION['login_success'] . "');
        </script>";
        unset($_SESSION['login_success']); // Unset the session variable after displaying the message
    }

    // Fetch profile information if user ID is available
    if ($staff_id) {
        $stmt = $conn->prepare("SELECT * FROM `staff` WHERE id = ?");
        $stmt->execute([$staff_id]);
        $fetch_profile = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $fetch_profile = null;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>Gallery Cafe Staff Panel - Dashboard Page</title>
</head>
<body>
    <?php include '../components/staff_header.php'; ?>

    <div class="main">
    <div class="banner-login">
        <video autoplay muted loop class="banner-video">
                <source src="../videos/banner-video1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="banner-content-login">
                <h1>Welcome to Gallery Cafe</h1>
                <p>Experience the best coffee in town</p>
                <div class="banner-buttons">
                    <a href="#products" class="btn-animated">Explore Now</a>
                    <a href="#about" class="btn-animated">Learn More</a>
                </div>
            </div>
        </div>
        <div class="title2">
            <a href="dashboard.php">Home</a><span> / Dashboard</span>
        </div>
        <section class="dashboard">
            <h1 class="heading">Dashboard</h1>
            <div class="box-container">
                <div class="box">
                    <h3>Welcome!</h3>
                    <p><?= $fetch_profile['name'] ?? 'To The Staff'; ?></p>
                    <a href="staff_profile.php" class="btn">Profile</a>
                </div>
                <div class="box">
                    <?php
                        $select_product = $conn->prepare("SELECT * FROM `products`");
                        $select_product->execute();
                        $num_of_products = $select_product->rowCount();
                    ?>
                    <h3><?= $num_of_products; ?></h3>
                    <p>Product added</p>
                    <a href="view_staff_foods.php" class="btn">View added foods</a>
                </div>  
                <div class="box">
                    <?php
                        $select_active_product = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
                        $select_active_product->execute(['active']);
                        $num_of_active_products = $select_active_product->rowCount();
                    ?>
                    <h3><?= $num_of_active_products; ?></h3>
                    <p>Total active foods</p>
                    <a href="view_staff_foods.php" class="btn">View active products</a>
                </div>
                <div class="box">
                    <?php
                        $select_deactive_product = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
                        $select_deactive_product->execute(['deactive']);
                        $num_of_deactive_products = $select_deactive_product->rowCount();
                    ?>
                    <h3><?= $num_of_deactive_products; ?></h3>
                    <p>Total deactive foods</p>
                    <a href="view_staff_foods.php" class="btn">View active foods</a>
                </div> 
                <div class="box">
                    <?php
                        $select_message = $conn->prepare("SELECT * FROM `parking_resev`");
                        $select_message->execute();
                        $num_of_message = $select_message->rowCount();
                    ?>
                    <h3><?= $num_of_message; ?></h3>
                    <p>Parking Reservations</p>
                    <a href="staff_parking_resev.php" class="btn">View reservations</a>
                </div> 
                <div class="box">
                    <?php
                        $select_message = $conn->prepare("SELECT * FROM `table_resev`");
                        $select_message->execute();
                        $num_of_message = $select_message->rowCount();
                    ?>
                    <h3><?= $num_of_message; ?></h3>
                    <p>Table Reservations</p>
                    <a href="staff_table_resev.php" class="btn">View reservations</a>
                </div>  
                <div class="box">
                    <?php
                        $select_orders = $conn->prepare("SELECT * FROM `orders`");
                        $select_orders->execute();
                        $num_of_orders = $select_orders->rowCount();
                    ?>
                    <h3><?= $num_of_orders; ?></h3>
                    <p>Total orders placed</p>
                    <a href="order.php" class="btn">View orders</a>
                </div>  
                <div class="box">
                    <?php
                        $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
                        $select_confirm_orders->execute(['in progress']);
                        $num_of_confirm_orders = $select_confirm_orders->rowCount();
                    ?>
                    <h3><?= $num_of_confirm_orders; ?></h3>
                    <p>Total confirm orders</p>
                    <a href="order.php" class="btn">View confirm orders</a>
                </div>  
                <div class="box">
                    <?php
                        $select_cenceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
                        $select_cenceled_orders->execute(['canceled']);
                        $num_of_cenceled_orders = $select_cenceled_orders->rowCount();
                    ?>
                    <h3><?= $num_of_cenceled_orders; ?></h3>
                    <p>Total canceled orders</p>
                    <a href="order.php" class="btn">View canceled orders</a>
                </div>  
            </div>            
        </section>
        <?php include 'footer.php'; ?>
    </div>
   
    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    <script type="text/javascript" src="script.js"></script> 
    <!------------alert------------>
    <?php include '../components/alert.php'; ?>
</body>
</html>
