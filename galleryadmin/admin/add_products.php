<?php 
    include '../components/connection.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if (!isset($admin_id)) {
        header('location: login.php');
    }

    //add product in database

    if (isset($_POST['publish'])) {
        
        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $cuisine_type = $_POST['cuisine_type'];
        $cuisine_type = filter_var($cuisine_type, FILTER_SANITIZE_STRING);

        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);

        $status = 'active';

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../image/'.$image;

        $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ?");
        $select_image->execute([$image]);

        if (isset($image)) {
            if ($select_image->rowCount() > 0) {
                $warning_msg[] = 'image name repeated';
            }elseif ($image_size > 2000000){
                $warning_msg[] = 'image size is too large';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        }else{
            $image = '';
        }
        if ($select_image->rowCount() > 0 AND $image != '') {
            $warning_msg[] = 'Please rename your image';
        }else{
            $insert_product = $conn->prepare("INSERT INTO `products`(id, name, price, cuisine_type, image, product_detail, status) 
            VALUES(?,?,?,?,?,?,?)");
            $insert_product->execute([$id, $name, $price, $cuisine_type, $image, $content, $status]);
            $success_msg[] = 'Product inserted successfully !';
        }
    }
       
    //save product in database as draft

    if (isset($_POST['draft'])) {
        
        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);

        $cuisine_type = $_POST['cuisine_type'];
        $cuisine_type = filter_var($cuisine_type, FILTER_SANITIZE_STRING);

        $status = 'deactive';

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../image/'.$image;

        $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ?");
        $select_image->execute([$image]);

        if (isset($image)) {
            if ($select_image->rowCount() > 0) {
                $warning_msg[] = 'image name repeated';
            }elseif ($image_size > 2000000){
                $warning_msg[] = 'image size is too large';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        }else{
            $image = '';
        }
        if ($select_image->rowCount() > 0 AND $image != '') {
            $warning_msg[] = 'Please rename your image';
        }else{
            $insert_product = $conn->prepare("INSERT INTO `products`(id, name, price, cuisine_type, image, product_detail, status) 
            VALUES(?,?,?,?,?,?,?)");
            $insert_product->execute([$id, $name, $price, $cuisine_type, $image, $content, $status]);
            $success_msg[] = 'Product saved as draft successfully !';
        }
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
    <title>gallery cafe admin panel - Add products page</title>
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
            <a href="dashboard.php">Dashboard</a><span> / Add products</span>
        </div>
        <section class="form-container">
            <h1 class="heading">Add products</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <label>product name <sup>*</sup></label>
                    <input type="text" name="name" maxlength="100" required placeholder="add product name">
                </div>
                <div class="input-field">
                    <label>product price <sup>*</sup></label>
                    <input type="number" name="price" maxlength="100" required placeholder="add product price">
                </div>
                <div class="input-field">
                    <label>product detail <sup>*</sup></label>
                    <textarea name="content" required maxlength="10000" required 
                    placeholder="write product description"></textarea>
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
                    <label>product image <sup>*</sup></label>
                    <input type="file" name="image" accept="image/*" required >
                </div> 
                <div class="flex-btn">
                    <button type="submit" name="publish" class="btn">publish product</button>
                    <button type="submit" name="draft" class="btn">save as draft</button>
                </div> 
                </form>                
        </section>
    </div>
   

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    
    <script type="text/javascript" src="script.js"></script> 

    <!------------alert------------>
    <?php include '../components/alert.php'; ?>
</body>
</html>