<?php 
include '../components/connection.php';


// Add product to the database
if (isset($_POST['publish'])) {
    
    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $members = $_POST['members'];
    $members = filter_var($members, FILTER_SANITIZE_NUMBER_INT);

    $date = $_POST['date'];
    $date = filter_var($date, FILTER_SANITIZE_STRING);

    $note = $_POST['note'];
    $note = filter_var($note, FILTER_SANITIZE_STRING);

    $status = 'active';

    $insert_product = $conn->prepare("INSERT INTO `table_resev` (id, name, email, members, date, note) 
    VALUES(?,?,?,?,?,?)");
    $insert_product->execute([$id, $name, $email, $members, $date, $note]);
    $success_msg[] = 'Table reservation successfully added!';
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
    <title>Gallery Cafe Admin Panel - Add Products Page</title>
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
            <a href="dashboard.php">Dashboard</a><span> / Table Reservation</span>
        </div>
        <section class="form-container">
            <h1 class="heading">Table Reservation</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <label>Name <sup>*</sup></label>
                    <input type="text" name="name" maxlength="100" required placeholder="Add customer name">
                </div>
                <div class="input-field">
                    <label>Email <sup>*</sup></label>
                    <input type="email" name="email" maxlength="100" required placeholder="Add email">
                </div>
                <div class="input-field">
                    <label>Members <sup>*</sup></label>
                    <input type="number" name="members" maxlength="100" required placeholder="Add members">
                </div>
                <div class="input-field">
                    <label>Date <sup>*</sup></label>
                    <input type="date" name="date" required>
                </div> 
                <div class="input-field">
                    <label>Feedback <sup>*</sup></label>
                    <input type="text" name="note" maxlength="100" required placeholder="Add feedback">
                </div> 
                <div class="flex-btn">
                    <button type="submit" name="publish" class="btn">Submit</button>
                    <button type="submit" name="draft" class="btn">Save as Draft</button>
                </div> 
            </form>                
        </section>
    </div>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    <script type="text/javascript" src="script.js"></script> 

    <!-- Alert -->
    <?php include '../components/alert.php'; ?>
</body>
</html>
