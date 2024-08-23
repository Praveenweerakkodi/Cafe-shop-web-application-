<?php 
include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: login.php');
    exit;
}

// Check if 'post_id' is set in the $_GET array
if (isset($_GET['post_id'])) {
    $get_id = $_GET['post_id'];
} else {
    // Redirect or handle the missing 'post_id' key appropriately
    echo 'No product selected.';
    exit;
}

// Delete product
if (isset($_POST['delete'])) {
    $p_id = $_POST['product_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $delete_image->execute([$p_id]);

    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image['image'] != '') {
        unlink('../image/'.$fetch_delete_image['image']);
    }
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$p_id]);
    
    header('location:view_products.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <title>Gallery Cafe Admin Panel - Read Products Page</title>
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

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
            <a href="dashboard.php">Dashboard</a><span> / Read Products</span>
        </div>
        <section class="read-post">
            <h1 class="heading">Read Product</h1>
            <?php
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                $select_products->execute([$get_id]);

                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" method="post">
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">

                        <div class="status" style="color: <?php if($fetch_products['status']=='active') {echo "green";} else {echo "red";} ?>"><?= $fetch_products['status']; ?></div>
                        <?php if ($fetch_products['image'] != '') { ?>
                            <img src="../image/<?= $fetch_products['image']; ?>" class="image" >
                        <?php } ?>
                        <div class="price">Rs. <?= $fetch_products['price']; ?>/-</div>
                        <div class="title"><?= $fetch_products['name']; ?> </div>
                        <div class="content"><?= $fetch_products['product_detail']; ?> </div>
                        <div class="flex-btn">
                            <a href="edit_products.php?id=<?= $fetch_products['id']; ?>" class="btn">Edit</a>
                            <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this product?');">Delete</button>
                            <a href="view_products.php" class="btn">Go back</a>
                        </div>
                    </form>
                <?php
                    }
                } else {
                    echo '
                    <div class="empty">
                        <p>No product added yet! <br> <a href="add_products.php" style="margin-top: 1.5rem;" class="btn">Add Product</a></p>
                    </div>';
                }
            ?>
        </section>
    </div>
   
    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    <script type="text/javascript" src="script.js"></script> 

    <!-- Alert -->
    <?php include '../components/alert.php'; ?>
</body>
</html>
