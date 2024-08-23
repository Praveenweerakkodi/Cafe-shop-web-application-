<?php 
    include '../components/connection.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if (!isset($admin_id)) {
        header('location: login.php');
    }

    //delete product

    if (isset($_POST['delete'])) {

        $p_id = $_POST['product_id'];
        $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ? ");
        $delete_product->execute([$p_id]);

        $success_msg[] = 'product deleted succussfully !';
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
    <title>gallery cafe staff panel - All products page</title>
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
            <a href="dashboard.php">Dashboard</a><span>  / All products</span>
        </div>
        <section class="show-post">
            <h1 class="heading">All products</h1>
            <div class="box-container">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `products`");
                    $select_products->execute();
                    
                    if ($select_products->rowCount() > 0) {
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC))
                        {

                    ?>        
                    <form action="" method="post" class="box">
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
                        <?php if($fetch_products['image']!= '') { ?>
                            <img src="../image/<?= $fetch_products['image']; ?>" class="image">
                        <?php } ?>
                        <div class="status" style="color: <?php if($fetch_products['status']=='active')
                        {echo "green";}else{echo "red";} ?>;"><?= $fetch_products['status']; ?>
                        </div>

                    <div class="price">Rs. <?= $fetch_products['price']; ?>/-</div>
                    <div class="title"><?= $fetch_products['name']; ?></div>
                    <div class="type"><span class="ctype">Cuisine Type : </span><?= $fetch_products['cuisine_type']; ?></div>
                    <div class="flex-btn">

                    </div>
                    </form>
            <?php 
                }
            }else{
                echo '
                    <div class="empty">
                        <p>no product added yet! <br> 
                    </div>';
            }
            ?>
                        
                
                

            </div>            
        </section>
    </div>
   

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    
    <script type="text/javascript" src="script.js"></script> 

    <!------------alert------------>
    <?php include '../components/alert.php'; ?>
</body>
</html>