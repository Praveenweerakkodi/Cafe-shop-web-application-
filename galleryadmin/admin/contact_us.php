<?php 
include '../components/connection.php';

// Add product to the database
if (isset($_POST['publish'])) {
    
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    $insert_product = $conn->prepare("INSERT INTO `message` (id, name, email, message) 
    VALUES(?,?,?,?)");
    $insert_product->execute([$id, $name, $email, $message]);
    $success_msg[] = 'Message sent successfully !';
}

?>

<section class="show-post">
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="about_us_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="popup_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>Gallery Cafe About Us Page</title>
</head>
<body>
    <?php include '../components/user_header.php'; ?>

    <div class="main-contact">
        <div class="banner-contact">
            <video autoplay muted loop class="banner-video">
                <source src="../videos/banner-video1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="banner-content">
                <h1>Contact Us</h1>
                <p>We'd love to hear from you!</p>
            </div>
        </div>

        <div class="contact-form-section">
            <div class="form-container-contact">
                <h2>Get in Touch</h2>
                <form id="contactForm" method="POST" action="">
                    <div class="input-group">
                        <i class='bx bx-user'></i>
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="input-group">
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="input-group">
                        <i class='bx bx-message'></i>
                        <input type="text" name="message" placeholder="Your Message" required>
                    </div>
                    <button type="submit" name="publish" class="btn-contact">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="contact_us_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
