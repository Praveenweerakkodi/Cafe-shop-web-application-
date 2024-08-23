<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="about_us_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="popup_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Gallery Cafe About Us Page</title>
    <style>
        .main-about {
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .banner-about {
           
           
        }
        .banner-video {
            
            width: 100%;
            height: 1000px;
         
            
            
        }
        .banner-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            font-size: 2rem;
        }
        .title2 a {
            text-decoration: none;
            color: #000;
        }
        .title2 {
            margin: 20px 0;
        }
        .show-post-about {
            padding: 20px;
            background: #f4f4f4;
            border-radius: 8px;
        }
        .heading {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .box-container-about {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .box-box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s;
        }
        .box-box:hover {
            transform: scale(1.05);
        }
        .box-box img {
            width: 100%;
            height: auto;
        }
        .box-box h3 {
            font-size: 1.5rem;
            margin: 15px 0;
        }
        .box-box p {
            padding: 0 15px 15px;
            color: #777;
        }
        .services, .events {
            margin: 40px 0;
        }
        .service, .event {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .service-icon, .event-icon {
            font-size: 2rem;
            margin-right: 10px;
        }
      /* Add the following CSS to style the reasons list */
        .reasons-list {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
            text-align: center;
            color: #555;
        }

        .reasons-list li {
            margin: 10px 0;
            font-size: 1rem;
            position: center;
            padding-left: 20px;
        }

        .reasons-list li::before {
            content: '\2713'; /* Checkmark */
            position: center;
            left: 0;
            color: #4caf50;
        }

        
        
        /* Popup CSS */
        .popup {
            display: none;
            position: fixed;
            z-index: 999;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }
        .popup-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            text-align: center;
        }
        .popup-content h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include '../components/user_header.php'; ?>

    <div class="main-about">
        <div class="banner-about">
            <video autoplay muted loop class="banner-video">
                <source src="../videos/banner-video1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="banner-content">
                <h1 class="animate__animated animate__fadeInDown">Welcome to Gallery Cafe</h1>
                <p class="animate__animated animate__fadeInUp">Your perfect place to relax and enjoy.</p>
            </div>
        </div>
        <div class="title2">
            <a href="dashboard.php">Dashboard</a><span> / About Us</span>
        </div>

        <section class="show-post-about">

            <h2 class="heading">About Us</h2>
            <div class="box-container-about">
                <div class="box-box animate__animated animate__fadeInUp">
                    <img src="../img/img4.jpg" alt="Cafe Image">
                    <h3>Our Story</h3>
                    <p>Gallery Cafe was founded with the vision of creating a cozy place for people to enjoy quality coffee and art. Our cafe is more than just a place to drink coffee; it's a place to experience culture and community.</p>
                </div>
                <div class="box-box animate__animated animate__fadeInUp">
                    <img src="../img/IMG5.jpg" alt="Mission Image">
                    <h3>Our Mission</h3>
                    <p>Our mission is to provide a welcoming environment where everyone feels at home. We are committed to serving the best coffee and offering a platform for local artists to showcase their work.</p>
                </div>   
                <div class="box-box animate__animated animate__fadeInUp">
                    <img src="../img/img10.jpg" alt="Mission Image">
                     <h3>Why Guests Choose Us</h3>
                         <ul class="reasons-list">
                             <li>Exceptional Quality Food</li>
                             <li>Cozy and Inviting Atmosphere</li>
                             <li>Friendly and Professional Staff</li>
                             <li>Variety of Unique Dishes</li>
                             <li>Regular Special Events</li>
                             <li>Convenient Location</li>
                         </ul>
                </div>

     
        <!-- Team Section -->
        <section class="team">
            <h2>Meet Our Team</h2>
            <div class="team-container">
                <div class="team-member">
                    <img src="../img/chef1.jpg" alt="Team Member 1" class="team-image">
                    <h3>Nayanatara</h3>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="../img/chef.jpeg" alt="Team Member 2" class="team-image">
                    <h3>Jane Mendis</h3>
                    <p>Head Chef</p>
                </div>
                <div class="team-member">
                    <img src="../img/chef2.jpeg" alt="Team Member 3" class="team-image">
                    <h3>Kumar Jason</h3>
                    <p>Operations Manager</p>
                </div>
                <div class="team-member">
                    <img src="../img/chef3.jpeg" alt="Team Member 4" class="team-image">
                    <h3>Jason Mendis</h3>
                    <p>Marketing Head</p>
                </div>
            </div>
        </section>
        
 </section>
</div>
    <?php include 'footer.php'; ?>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script>
       
    </script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
