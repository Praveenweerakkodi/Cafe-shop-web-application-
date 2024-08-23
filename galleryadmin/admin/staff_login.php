<?php 
    include '../components/connection.php';

    session_start();

    if (isset($_POST['login'])) {
        

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);


        $select_admin = $conn->prepare("SELECT * FROM `staff` WHERE email = ? AND password = ?");
        $select_admin->execute([$email, $pass]);

        if ($select_admin->rowCount() > 0) {

            $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin_id'] = $fetch_admin_id['id'];
            $_SESSION['login_success'] = 'Staff Login successfully'; // Set the session variable
            header('location:staff_dashboard.php');
        }else{
            $warning_msg[] = 'incorrect username or password';
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>gallery cafe staff panel - Login page</title>
</head>
<body>

    <div class="main">
    <div class="title5">
                
                <h2>Login Now as Staff</h2>
                <br>
            </div>
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
    <section class="form-container" id="admin-login">
            <div class="title5">
                <img src="../img/logo1.png" >
            </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <label class="lable">User email <sup>*</sup></label>
                        <input class="input" type="email" name="email" maxlength="20" required placeholder="Enter your email" oninput="this.value.replace(/\s/g,'')">
                    </div>

                    <div class="input-field">
                        <label>User password <sup>*</sup></label>
                        <input type="password" name="password" maxlength="20" required placeholder="Enter your password" oninput="this.value.replace(/\s/g,'')">
                    </div>

                    <button type="submit" name="login" class="btn">Login now</button>
                    <p>Did not have an account ? <a href="">Register now</a></p>
                    <a href="index.php"> Go to home<i class="fas fa-home"></i></a>
                </form>
            </div>
        </section>
    </div>
   

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    
    <script type="text/javascript" src="script.js"></script> 

    <!------------alert------------>
    <?php include '../components/alert.php'; ?>
</body>
</html>