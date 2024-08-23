<?php
include '../components/connection.php';
session_start();

if (isset($_SESSION['login_success'])) {
    echo "<script>
        alert('" . $_SESSION['login_success'] . "');
    </script>";
    unset($_SESSION['login_success']); // Unset the session variable after displaying the message
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location: user_login.php");
}

if (isset($_POST['add_to_wishlist'])) {
    $id = unique_id();
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_STRING);
    $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
    $verify_wishlist->execute([$user_id, $product_id]);
    $cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $cart_num->execute([$user_id, $product_id]);

    if ($verify_wishlist->rowCount() > 0) {
        $warning_msg[] = 'Product already exist in your wishlist';
    } elseif ($cart_num->rowCount() > 0) {
        $warning_msg[] = 'Product already exist in your cart';
    } else {
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);
        $price = $fetch_price['price'];

        if ($price !== null) {
            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
            $insert_wishlist->execute([$id, $user_id, $product_id, $price]);
            $success_msg[] = 'Product added to wishlist!';
        } else {
            $warning_msg[] = 'Product price not found!';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>Gallery Cafe User Panel - All Products Page</title>
    <style>
        .hidden { display: none; }
       
        /* Add your CSS here */
        .events-header{
            padding: 1rem;
            margin-top: 2rem;
            color: #fff;
            text-align: center;
        }
        .events-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .event-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            position: relative;
            transition: transform 0.3s;
            width: calc(33.333% - 20px);
        }
        .event-box:hover {
            transform: translateY(-10px);
        }
        .event-image {
            height: 350px;
            overflow: hidden;
        }
        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .event-content {
            padding: 20px;
        }
        .event-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .event-desc {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .event-buttons {
            display: flex;
            justify-content: space-between;
        }
        .event-buttons a {
            background: #212121;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .event-buttons a:hover {
            background: #0056b3;
        }
        @media (max-width: 768px) {
            .event-box {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .event-box {
                width: 100%;
            }
        }
         /*---------------------------message--------------------------------*/
 .reviews-container {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
}

.reviews-title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

.input-box {
    position: relative;
    margin-bottom: 20px;
}

.input-box input,
.input-box textarea {
    width: 100%;
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: 0.3s;
}

.input-box input:focus,
.input-box textarea:focus {
    border-color: #0056b3;
}

.input-box label {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #999;
    pointer-events: none;
    transition: 0.3s;
}

.input-box input:focus + label,
.input-box input:not(:placeholder-shown) + label,
.input-box textarea:focus + label,
.input-box textarea:not(:placeholder-shown) + label {
    top: -5px;
    left: 10px;
    color: #0056b3;
    font-size: 12px;
}

.input-box i {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    color: #999;
}

.btn-animated {
    background: #212121;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-animated:hover {
    background: #0056b3;
}

   
    </style>
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

        <div class="events-header">
    <h2 class="events-title">Our Exciting Events</h2>
    <br>
    <p class="events-subtitle">Stay updated with our latest offers and special events</p>
</div>

<div class="events-container">
    <div class="event-box">
        <div class="event-image">
            <img src="../img/of3.png" alt="Event Image">
        </div>
        <div class="event-content">
            <h3 class="event-title">Special Events</h3>
            <p class="event-desc">Join us for a special event exclusive coffee blends.</p>
            <div class="event-buttons">
                <a href="#">Learn More</a>
                <a href="#">Book Now</a>
            </div>
        </div>
    </div>
    <div class="event-box">
        <div class="event-image">
            <img src="../img/of2.png" alt="Event Image">
        </div>
        <div class="event-content">
            <h3 class="event-title">Upcoming Offer</h3>
            <p class="event-desc">Don't miss our upcoming offer on all pastries. Get 20% off this weekend!</p>
            <div class="event-buttons">
                <a href="#">Learn More</a>
                <a href="#">Shop Now</a>
            </div>
        </div>
    </div>
    <div class="event-box">
        <div class="event-image">
            <img src="../img/of4.png" alt="Event Image">
        </div>
        <div class="event-content">
            <h3 class="event-title">Promotion</h3>
            <p class="event-desc">Enjoy a free drink with every purchase of our new summer beverages.</p>
            <div class="event-buttons">
                <a href="#">Learn More</a>
                <a href="#">Redeem Now</a>
            </div>
        </div>
    </div>
</div>

        <div class="title2">
            <a href="dashboard.php">Discounted Products</a><span> / All Products</span>
        </div>
        <section class="show-post-boxx">
            <h1 class="heading">Our Products</h1>
            <div class="box-container-boxx">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                $total_products = $select_products->rowCount();

                if ($total_products > 0) {
                    $counter = 0;
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        $counter++;
                ?>
                <form action="" method="post" class="boxx <?php echo $counter > 6 ? 'hidden' : ''; ?>">
                    <div class="formm">   
                        <img src="../image/<?= $fetch_products['image']; ?>" class="image">                   
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                        <h3 class="name"><?= $fetch_products['name']; ?></h3>
                        <div class="prize">Rs. <?= $fetch_products['price']; ?> /-</div>
                        <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                        <div class="type-boxx"><?= $fetch_products['cuisine_type']; ?></div>
                        <div class="flex-btn-boxx">
                            <button class="btn-boxx" type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                            <a href="after_user_login_read.php?pid=<?= $fetch_products['id']; ?>" class="btn-boxx">View</a>
                            <a href="add_food_booking.php?get_id=<?= $fetch_products['id']; ?>" class="btn-boxx">Book</a>
                        </div>  
                    </div>              
                </form>
                <?php 
                    }
                } else {
                    echo '<div class="empty"><p>No product added yet!</p></div>';
                }
                ?>
            </div>
            <button id="view-more-btn" class="btn-bttn">View More</button>
            <button id="show-less-btn" class="btn-bttn hidden">Show Less</button>
        </section>

    

    
    <div class="events-header">
    <h2 class="events-title">Customer Reviews</h2>
    <br>
    <p class="events-subtitle">Stay updated with our latest offers and special events</p>
</div>

<div class="events-container">
    <div class="event-box">
        <div class="event-image">
            <img src="../img/c1.png" alt="Event Image">
        </div>
        <div class="event-content">
            <h3 class="event-title">Meri Jane</h3>
            <p class="event-desc">Great service and ambiance! Loved the coffee.😍🙌</p>
            <div class="event-buttons">
                
            </div>
        </div>
    </div>
    <div class="event-box">
        <div class="event-image">
            <img src="../img/c3.jpeg" alt="Event Image">
        </div>
        <div class="event-content">
            <h3 class="event-title">Dhammika Mendis</h3>
            <p class="event-desc">A wonderful place relax enjoy a cup of coffee.🤞🤩</p>
            <div class="event-buttons">
               
            </div>
        </div>
    </div>
    <div class="event-box">
        <div class="event-image">
            <img src="../img/c5.jpg" alt="Event Image">
        </div>
        <div class="event-content">
            <h3 class="event-title">Patric Jeo</h3>
            <p class="event-desc">Great service and ambiance!.💕😉</p>
            <div class="event-buttons">
                
            </div>
        </div>
    </div>
</div>


</div>

        <?php include 'footer.php'; ?>
    </div>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>   
    <script type="text/javascript" src="script.js"></script> 

    <script>
            document.getElementById('view-more-btn').addEventListener('click', function() {
            var hiddenProducts = document.querySelectorAll('.boxx.hidden');
            hiddenProducts.forEach(function(product) {
                product.classList.remove('hidden');
            });
            document.getElementById('view-more-btn').classList.add('hidden');
            document.getElementById('show-less-btn').classList.remove('hidden');
        });

        document.getElementById('show-less-btn').addEventListener('click', function() {
            var allProducts = document.querySelectorAll('.boxx');
            allProducts.forEach(function(product, index) {
                if (index >= 6) {
                    product.classList.add('hidden');
                }
            });
            document.getElementById('view-more-btn').classList.remove('hidden');
            document.getElementById('show-less-btn').classList.add('hidden');
        });yy

        //message

        document.getElementById('messageForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const description = document.getElementById('description').value;
        const image = document.getElementById('image').files[0];

        if (name && email && description) {
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('description', description);
            if (image) {
                formData.append('image', image);
            }

            fetch('your_server_endpoint', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal('Message Sent!', 'Thank you for your feedback.', 'success');
                    document.getElementById('messageForm').reset();
                } else {
                    swal('Error', 'Something went wrong. Please try again.', 'error');
                }
            })
            .catch(error => {
                swal('Error', 'Something went wrong. Please try again.', 'error');
            });
        } else {
            swal('Error', 'Please fill out all fields.', 'error');
        }
    });




    </script>

    <?php include '../components/alert.php'; ?>
</body>
</html>

