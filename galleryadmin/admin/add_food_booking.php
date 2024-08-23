<?php 
include '../components/connection.php';


//add product in database

if (isset($_POST['publish'])) {
    
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $ctype = $_POST['ctype'];
    $ctype = filter_var($ctype, FILTER_SANITIZE_STRING);

    $ftype = $_POST['ftype'];
    $ftype = filter_var($ftype, FILTER_SANITIZE_STRING);

    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $date = $_POST['date'];
    $date = filter_var($date, FILTER_SANITIZE_STRING);

    $time = $_POST['time'];
    $time = filter_var($time, FILTER_SANITIZE_STRING);


    $insert_product = $conn->prepare("INSERT INTO `food_booking`(id, name, ctype, ftype, qty, date, time) 
    VALUES(?,?,?,?,?,?,?)");
    $insert_product->execute([$id, $name, $ctype, $ftype, $qty, $date, $time]);
    $success_msg[] = 'Order Booking successfully !';
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
            <a href="dashboard.php">Dashboard</a><span> / Booking Reservation</span>
        </div>
        <section class="form-container">
            <h1 class="heading">Booking Reservation</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <label>Name <sup>*</sup></label>
                    <input type="text" name="name" maxlength="100" required placeholder="add customer name">
                </div>
                <div class="input-field">
                    <label>Cuisine Type <sup>*</sup></label>
                    <select name="ctype" required>
                        <option value="" disabled selected>Select cuisine type</option>
                        <option value="srilankan">Sri Lankan</option>
                        <option value="italian">Italian</option>
                        <option value="indian">Indian</option>
                        <option value="chinese">Chinese</option>
                    </select>
                </div>
                <div class="input-field">
                    <label>Food Type <sup>*</sup></label>
                    <input type="text" name="ftype" maxlength="100" required placeholder="add food name">
                </div>
                <div class="input-field">
                    <label>Quentity<sup>*</sup></label>
                    <input type="number" name="qty" maxlength="100" required placeholder="add quentity">
                </div>
                <div class="input-field">
                    <label>Date <sup>*</sup></label>
                    <input type="date" name="date" required>
                </div> 
                <div class="input-field">
                    <label>Time <sup>*</sup></label>
                    <input type="text" name="time" maxlength="100" required placeholder="add time">
                </div>
                <div class="flex-btn">
                    <button type="submit" name="publish" class="btn">Submit</button>
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
