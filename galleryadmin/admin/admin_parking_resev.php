<?php 
    include '../components/connection.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if (!isset($admin_id)) {
        header('location: login.php');
    }

    if (isset($_POST['delete'])) {
        $delete_id = $_POST['delete_id'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `parking_resev` WHERE id = ?");
        $verify_delete->execute([$delete_id]);

        if ($verify_delete->rowCount() > 0) {

            $delete_message = $conn->prepare("DELETE FROM `parking_resev` WHERE id = ?");
            $delete_message->execute([$delete_id]);
            $success_msg[] = 'Parking reservations deleted';
        }else{
            $warning_msg[] = 'parking reservations already deleted';
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
    <title>gallery cafe admin panel - Parking Reservation page</title>
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
            <a href="dashboard.php">Dashboard</a><span> / Parking Reservation</span>
        </div>
        <section class="accounts">
            <h1 class="heading">Parking Reservation</h1>
            <div class="box-container">
                <?php 
                    $select_message = $conn->prepare("SELECT * FROM `parking_resev` ");
                    $select_message->execute();

                    if ($select_message->rowCount() > 0) {
                        while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
                           

                ?>
                <div class="box">
                    <h3 class="name"><?= $fetch_message['name']; ?></h3>
                    <p><?= $fetch_message['vehicle_no']; ?></p>
                    <p><?= $fetch_message['type']; ?></p>
                    <p><?= $fetch_message['date']; ?></p>
                    <form action="" method="post" class="flex-btn" >
                        <input type="hidden" name="delete_id" value="<?= $fetch_message['id']; ?>" >
                        <button type="submit" name="delete" class="btn" onclick="return confirm
                        ('Delete this message')">Delete Reservation</button>
                    </form>
                </div> 
                <?php           
                        }
                    } else {
                        echo '
                    <div class="empty">
                        <p>No parking reservation yet</p>
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