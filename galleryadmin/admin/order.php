<?php 
    include '../components/connection.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if (!isset($admin_id)) {
        header('location: login.php');
    }
    //delete order
    if (isset($_POST['order_id'])) {

        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
        $verify_delete->execute([$order_id]);

        if ($verify_delete->rowCount() > 0) {

            $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
            $delete_order->execute([$order_id]);
            $success_msg[] = 'Order deleted';
        }else{
            $warning_msg[] = 'Order already deleted';
        }
    }

    //update order
    if (isset($_POST['update_order'])) {

        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

        $update_payment = $_POST['update_payment'];
        $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);

        $update_pay = $conn->prepare("UPDATE `orders` SET payment_status = ?  WHERE id = ?");
        $update_pay->execute([$update_payment, $order_id]);

        $success_msg[] = 'order upadated';
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
    <title>gallery cafe admin panel - Unread message's page</title>
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
            <a href="dashboard.php">Dashboard</a><span> / Order placed</span>
        </div>
        <section class="order-container">
            <h1 class="heading">Total order placed</h1>
            <div class="box-container">
                <?php 
                    $select_orders = $conn->prepare("SELECT * FROM `orders`");
                    $select_orders->execute();

                    if ($select_orders->rowCount() > 0) {
                        while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                    
                    ?>
                    <div class="box">
                    <div class="status" style="color: <?php if($fetch_orders['status']=='in progress')
                         {echo "green";}else{echo "red";} ?>"><?= $fetch_orders['status']; ?>
                    </div>
                    <div class="detail">
                        <p>User name : <span><?=$fetch_orders['name']; ?></span> </p>
                        <p>User id : <span><?= $fetch_orders['id']; ?></span> </p>
                        <p>Placed on : <span><?= $fetch_orders['date']; ?></span> </p>
                        <p>User number : <span><?= $fetch_orders['number']; ?></span> </p>
                        <p>User email : <span><?= $fetch_orders['email']; ?></span> </p>
                        <p>Total price : <span><?= $fetch_orders['price']; ?></span> </p>
                        <p>Method : <span><?= $fetch_orders['method']; ?></span> </p>
                        <p>address : <span><?= $fetch_orders['address']; ?></span> </p>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                        <select name="update_payment">
                            <option disabled selected><?= $fetch_orders['payment_status']; ?></option>
                            <option value="pending">Pending</option>
                            <option value="complete">Complete</option>
                        </select>
                        <div class="flex-btn">
                            <button type="submit" name="update_order" class="btn">Update Payment</button>
                            <button type="submit" name="delete_order" class="btn">Delete order</button>
                        </div>
                        
                    </form>
               </div>
                    <?php           
                        }
                    } else {
                        echo '
                    <div class="empty">
                        <p>No order takes placed yet</p>
                    </div>';
                    }
                ?>
                
                </div>
            </div>
        </section>
    </div>
   

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    
    <script type="text/javascript" src="script.js"></script> 

    <!------------alert------------>
    <?php include '../components/alert.php'; ?>
</body>
</html>