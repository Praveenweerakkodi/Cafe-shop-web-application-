// cart.php
<?php
include 'components/connection.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="user_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>Cart</title>
</head>
<body>
    <?php include 'components/user_header.php'; ?>

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
        <section class="cart">
            <h1 class="heading">Cart Items</h1>
            <div class="box-container">
                <?php
                $user_id = $_SESSION['user_id'];
                $select_cart = $conn->prepare("SELECT products.* FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($product = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <img src="path_to_product_image/<?= $product['image']; ?>" alt="<?= $product['name']; ?>">
                    <h3><?= $product['name']; ?></h3>
                    <p><?= $product['description']; ?></p>
                    <span>$<?= $product['price']; ?></span>
                </div>
                <?php
                    }
                } else {
                    echo '<p>No items in cart</p>';
                }
                ?>
            </div>
        </section>
    </div>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    <script type="text/javascript" src="script.js"></script> 

    <?php include 'components/alert.php'; ?>
</body>
</html>
