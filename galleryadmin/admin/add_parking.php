<?php 
include '../components/connection.php';


//add product in database

if (isset($_POST['publish'])) {
    
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $vehicle_no = $_POST['vehicle_no'];
    $vehicle_no = filter_var($vehicle_no, FILTER_SANITIZE_STRING);

    $type = $_POST['type'];
    $type = filter_var($type, FILTER_SANITIZE_STRING);

    $date = $_POST['date'];
    $date = filter_var($date, FILTER_SANITIZE_STRING);

    $status = 'active';

    $insert_product = $conn->prepare("INSERT INTO `parking_resev`(id, name, vehicle_no, type, date) 
    VALUES(?,?,?,?,?)");
    $insert_product->execute([$id, $name, $vehicle_no, $type, $date]);
    $success_msg[] = 'Parking reservation successfully added !';
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
            <a href="dashboard.php">Dashboard</a><span> / Parking Reservation</span>
        </div>
        <section class="form-container">
            <h1 class="heading">Parking Reservation</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <label>Name <sup>*</sup></label>
                    <input type="text" name="name" maxlength="100" required placeholder="add customer name">
                </div>
                <div class="input-field">
                    <label>Vehicle Number <sup>*</sup></label>
                    <input type="text" name="vehicle_no" maxlength="100" required placeholder="add vehicle no">
                </div>
                <div class="input-field">
                    <label>Vehicle Type <sup>*</sup></label>
                    <select name="type" required>
                        <option value="" disabled selected>Select vehicle type</option>
                        <option value="Car">Car</option>
                        <option value="Van">Van</option>
                        <option value="Bus">Bus</option>
                        <option value="Bike">Bike</option>
                        <option value="Threewheel">Threewheel</option>
                    </select>
                </div>
                <div class="input-field">
                    <label>Date <sup>*</sup></label>
                    <input type="date" name="date" required>
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
