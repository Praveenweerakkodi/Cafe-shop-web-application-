<?php
include '../components/connection.php';
session_start(); 

if (isset($_POST['publish'])) {
    // Your existing PHP code for handling adding to wishlist
}

if (isset($_POST['add_to_cart'])) {
    // Your existing PHP code for handling adding to cart
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <title>Gallery Cafe Admin Panel - All Products Page</title>
    <style>
        /* Add your CSS here */
        .events-header{
            padding: 1rem;
            margin-top: 1rem;
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
            background: #ff4500;
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
/*-------------------------------------------------------------review------------------------------------------------------------*/



    </style>
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
            <a href="dashboard.php">Discounted Products</a><span>  / All Products</span>
        </div>

        <section class="show-post">
            <h1 class="heading">Our Products</h1>
            <div class="box-container">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM products");
                    $select_products->execute();
                    $count = 0;

                    if ($select_products->rowCount() > 0) {
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                            $count++;
                            $hide_class = ($count > 6) ? 'hidden' : '';
                ?>        
                    <form action="" method="post" class="box <?= $hide_class ?>">
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
                        <input type="hidden" name="price" value="<?= $fetch_products['price'] ?>">
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" id="user_logged_in" value="<?= isset($_SESSION['user_id']) ? '1' : '0' ?>">

                        <?php if(!empty($fetch_products['image'])) { ?>
                            <img src="../image/<?= $fetch_products['image']; ?>" class="image">
                        <?php } ?>
                        <div class="status" style="color: <?php if($fetch_products['status'] == 'active') { echo "green"; } else { echo "red"; } ?>;">
                            <?= $fetch_products['status']; ?>
                        </div>

                        <div class="price">Rs. <?= $fetch_products['price']; ?>/-</div>
                        <div class="title"><?= $fetch_products['name']; ?></div>
                        <div class="type"><span class="ctype">Cuisine Type : </span><?= $fetch_products['cuisine_type']; ?></div>
                        <div class="flex-btn">
                            <a href="javascript:void(0);" class="btn" onclick="checkLogin('cart')"><i class='bx bx-heart'></i></a>
                            <a href="javascript:void(0);" class="btn" onclick="checkLogin('wishlist')"><i class='bx bx-cart'></i></a>
                            <a href="javascript:void(0);" class="btn" onclick="checkLogin('book')">Book</a>
                            <a href="user_read.php?post_id=<?= $fetch_products['id']; ?>" class="btn">View</a>
                        </div>
                    </form>
                <?php 
                        }
                    } else {
                        echo '<div class="empty"><p>No product added yet!</p></div>';
                    }
                ?>
            </div>
            <button id="viewMoreBtn" class="btn-btn">View More</button>
            <button id="showLessBtn" class="btn-btn hidden">Show Less</button>
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
            <p class="event-desc">Great service and ambiance! Loved the coffee.😊💕</p>
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
            <p class="event-desc">A wonderful place relax enjoy a cup of coffee.😉👌</p>
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
            <p class="event-desc">Great service and ambiance!.😍🙌</p>
            <div class="event-buttons">
                
            </div>
        </div>
    </div>
</div>


</div>


        <?php include 'footer.php'; ?>
    </div>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>   
    <script type="text/javascript" src="script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

            const viewMoreBtn = document.getElementById('viewMoreBtn');
            const showLessBtn = document.getElementById('showLessBtn');
            const boxes = document.querySelectorAll('.box.hidden');

            viewMoreBtn.addEventListener('click', () => {
                boxes.forEach(box => box.classList.remove('hidden'));
                viewMoreBtn.classList.add('hidden');
                showLessBtn.classList.remove('hidden');
            });

            showLessBtn.addEventListener('click', () => {
                boxes.forEach(box => box.classList.add('hidden'));
                viewMoreBtn.classList.remove('hidden');
                showLessBtn.classList.add('hidden');
            });
        });

        function checkLogin(action) {
            var isLoggedIn = document.getElementById('user_logged_in').value;
            if (isLoggedIn == '0') {
                swal('You need to login first as a User!');
            } else {
                swal('Logged in', 'Proceed with ' + action, 'success');
            }
        }

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
