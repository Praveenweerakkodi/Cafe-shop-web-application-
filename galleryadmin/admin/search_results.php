<?php
include '../components/connection.php';

if (isset($_GET['cuisine'])) {
    $cuisine = $_GET['cuisine'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE cuisine_type = ?");
    $stmt->execute([$cuisine]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $products = [];
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
    <title>Gallery Cafe Admin Panel - Search Results</title>
</head>
<body>
    <?php include '../components/user_header.php'; ?>

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
            <a href="dashboard.php">Discounted Products</a><span> / All products</span>
        </div>
        <section class="search-results">
            <h2 class="heading">Search Results for "<?php echo htmlspecialchars($cuisine); ?>"</h2>
            <?php if (count($products) > 0): ?>
            <div class="box-container">
                <?php foreach ($products as $product): ?>
                <div class="product">
                    <form action="" method="post" class="box">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="price" value="<?= $product['price'] ?>">
                        <input type="hidden" name="qty" value="1"> <!-- You can modify this to get dynamic qty -->

                        <?php if($product['image'] != ''): ?>
                            <img src="../image/<?= $product['image']; ?>" class="image">
                        <?php endif; ?>
                        <div class="status" style="color: <?= $product['status'] == 'active' ? 'green' : 'red'; ?>;">
                            <?= $product['status']; ?>
                        </div>
                        <div class="price">Rs. <?= $product['price']; ?>/-</div>
                        <div class="title"><?= $product['name']; ?></div>
                        <div class="type"><span class="ctype">Cuisine Type: </span><?= $product['cuisine_type']; ?></div>
                        <div class="flex-btn">
                            <button type="submit" name="add_to_wishlist" class="btn"><i class='bx bx-heart'></i></button>
                            <button type="submit" name="add_to_cart" class="btn"><i class='bx bx-cart'></i></button>
                            <button type="submit" name="buy_now" class="btn">Buy</button>
                            <a href="user_read.php?post_id=<?= $product['id']; ?>" class="btn">View</a>
                        </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="empty"><p>No products found for this cuisine type.</p></div>
            <?php endif; ?>
        </section>

    </div>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="script.js"></script> 

    <?php include '../components/alert.php'; ?>
</body>
</html>
