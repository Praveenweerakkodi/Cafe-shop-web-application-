<?php
// Adjust the include path according to your file structure
include '../components/connection.php';

// Start the session to access session variables
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location: user_login.php");
}

// Handle add to wishlist action
if (isset($_POST['add_to_wishlist'])) {
    $id = unique_id();

    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_STRING);

    $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
    $verify_wishlist->execute([$user_id, $product_id]);

    $cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $cart_num->execute([$user_id, $product_id]);

    if ($verify_wishlist->rowCount() > 0) {
        $warning_msg[] = 'Product already exists in your wishlist';
    } elseif ($cart_num->rowCount() > 0) {
        $warning_msg[] = 'Product already exists in your cart';
    } else {
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $price = $fetch_price['price'];

        if ($price !== null) {
            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
            $insert_wishlist->execute([$id, $user_id, $product_id, $price]);
            $success_msg[] = 'Product added to wishlist!';
        } else {
            $warning_msg[] = 'Product price not found!';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>Gallery Cafe User Panel - All Products Page</title>
</head>
<body>
    <?php include '../components/after_user_login_header.php'; ?>

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
            <a href="after_user_login.php">Home</a><span> / Wishlist</span>
        </div>
        <section class="show-post-wish">
            <h1 class="heading">Product added in wishlist</h1>
            <div class="box-container-wish">
                <?php
                    $grand_total = 0;
                    $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                    $select_wishlist->execute([$user_id]);
                    if ($select_wishlist->rowCount() > 0) {
                        while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
                            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                            $select_products->execute([$fetch_wishlist['product_id']]);
                            if ($select_products->rowCount() > 0) {
                                $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <form method="post" action="" class="box-wish">
                                <input type="hidden" name="wishlist_id" value="<?=$fetch_wishlist['id']; ?>">
                                <img src="../image/<?=$fetch_products['image']; ?>"class="image" >
                                <div class="flex-btn">
                                    <a href="after_user_login_read.php?pid=<?php echo $fetch_products['id']; ?>" class="btn">View</a>
                                    <button class="btn" type="submit" name="delete_item" onclick="return confirm('Delete this item?');">
                                         <i class="bx bx-trash"></i>
                                    </button>
                                    <a href="add_food_booking.php?get_id=<?=$fetch_products['id']; ?>" class="btn">Book</a>
                                </div>  
                                <h3 class="name"><?=$fetch_products['name']; ?></h3>
                                <input type="hidden" name="product_id" value="<?=$fetch_products['id']; ?>">
                                <div class="price">Rs. <?= $fetch_products['price']; ?>/-</div>
                             
                            </form>
                            <?php
                                $grand_total += $fetch_wishlist['price'];
                            }
                        }
                    } else {
                        echo '<p class="empty">No products</p>';
                    }
                ?>
            </div>            
        </section>
        <?php include 'footer.php'; ?>
    </div>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    <script type="text/javascript" src="script.js"></script> 

    <?php include '../components/alert.php'; ?>
</body>
</html>
