<?php 
    include '../components/connection.php';

    if (isset($_POST['register'])) {
        
        $id = unique_id();

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $cpass = sha1($_POST['cpassword']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_admin->execute([$email]);

        if ($select_admin->rowCount() > 0) {
            $warning_msg[] = 'User email already exists';
        } else {
            if ($pass != $cpass) {
                $warning_msg[] = 'Confirm password does not match';
            } else {
                $insert_admin = $conn->prepare("INSERT INTO `users`(id, name, email, password) VALUES(?, ?, ?, ?)");
                $insert_admin->execute([$id, $name, $email, $pass]);
                
                if ($insert_admin->rowCount() > 0) {
                    $success_msg[] = 'New user registered';
                } else {
                    $error_msg[] = 'User not registered. Please try again.';
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>Gallery Cafe User Panel - Register Page</title>
</head>
<body>

    <div class="main">
    <div class="title5">
                <h2>Register Now as User</h2>
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
                        <label>User Name <sup>*</sup></label>
                        <input type="text" name="name" maxlength="20" required placeholder="Enter your username" oninput="this.value = this.value.replace(/\s/g, '')">
                    </div>

                    <div class="input-field">
                        <label>User Email <sup>*</sup></label>
                        <input type="email" name="email" maxlength="20" required placeholder="Enter your email" oninput="this.value = this.value.replace(/\s/g, '')">
                    </div>

                    <div class="input-field">
                        <label>User Password <sup>*</sup></label>
                        <input type="password" name="password" maxlength="20" required placeholder="Enter your password" oninput="this.value = this.value.replace(/\s/g, '')">
                    </div>

                    <div class="input-field">
                        <label>Confirm Password <sup>*</sup></label>
                        <input type="password" name="cpassword" maxlength="20" required placeholder="Confirm password" oninput="this.value = this.value.replace(/\s/g, '')">
                    </div>

                    <button type="submit" name="register" class="btn">Register Now</button>
                    <p>Already have an account? <a href="user_login.php">Login Now</a></p>
                    <a href="index.php"> Go to home<i class="fas fa-home"></i></a>
                </form>
            </div>
        </section>
    </div>
   
    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    <script type="text/javascript" src="script.js"></script> 

    <!-- Alert -->
    <?php include '../components/alert.php'; ?>
</body>
</html>
