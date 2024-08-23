<?php 
include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: login.php');
    exit;
}

// Check if 'id' is set in the $_GET array
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    // Redirect or handle the missing 'id' key appropriately
    echo 'No product selected.';
    exit;
}

// Update product
if (isset($_POST['update'])) {
    $post_id = $_GET['id'];

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $cuisine_type = $_POST['cuisine_type'];
    $cuisine_type = filter_var($cuisine_type, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $status = filter_var($status, FILTER_SANITIZE_STRING);
    } else {
        $status = ''; // Or handle this case as needed
    }

    // Update product
    $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, cuisine_type = ?, product_detail = ?, status = ? WHERE id = ?");
    $update_product->execute([$name, $price, $cuisine_type, $content, $status, $post_id]);

    $success_msg[] = 'Product updated';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../image/'.$image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ?");
    $select_image->execute([$image]);

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'image size is too large';
        } elseif ($select_image->rowCount() > 0 AND $image != '') {
            $warning_msg[] = 'please rename your image';
        } else {
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $post_id]);
            move_uploaded_file($image_tmp_name, $image_folder);

            if ($old_image != $image AND $old_image != '') {
                unlink('../image/'.$old_image);
            }
            $success_msg[] = 'image updated';
        }
    }
}

// Delete product
if (isset($_POST['delete'])) {
    $p_id = $_POST['product_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ? ");
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
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>Gallery Cafe Admin Panel - Edit Products Page</title>
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
            <a href="dashboard.php">Dashboard</a><span> / Edit Products</span>
        </div>
        <section class="edit-post">
            <h1 class="heading">Edit Product</h1>
            <?php
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                $select_product->execute([$post_id]);

                if ($select_product->rowCount() > 0) {
                    while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
             ?>
             <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                    <div class="input-field">
                        <label>Update status</label>
                        <select name="status">
                            <option selected disabled value="<?= $fetch_product['status'] ?>"><?= $fetch_product['status'] ?></option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>Product Name</label>
                        <input type="text" name="name" value="<?= $fetch_product['name'] ?>">
                    </div>
                    <div class="input-field">
                        <label>Product Price</label>
                        <input type="number" name="price" value="<?= $fetch_product['price'] ?>">
                    </div>
                    <div class="input-field">
                    <label>Cuisine Type <sup>*</sup></label>
                    <select name="cuisine_type" required>
                        <option value="" disabled selected>Select cuisine type</option>
                        <option value="Sri Lankan">Sri Lankan</option>
                        <option value="Indian">Indian</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Italian">Italian</option>
                    </select>
                </div>
                    <div class="input-field">
                        <label>Product description</label>
                        <textarea name="content"><?= $fetch_product['product_detail'] ?></textarea>   
                    </div>
                    <div class="input-field">
                        <label>Product image</label>
                        <input type="file" name="image" accept="image/*">
                        <img src="../image/<?= $fetch_product['image']; ?>">   
                    </div>
                    <div class="flex-btn">
                        <button type="submit" name="update" class="btn">Update product</button>
                        <a href="view_products.php" class="btn">Go back</a>
                        <button type="submit" name="delete" class="btn" onclick="return confirm(
                            'Delete this product');">Delete</button>
                        
                    </div>
                </form>
             </div>
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
