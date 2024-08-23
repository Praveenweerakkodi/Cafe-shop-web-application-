-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 06:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile`) VALUES
(1, 'Praveen Nuwanjana', 'praveen@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a766923c29305a16ce461b2ae54f4c68.jpg'),
(3, 'hi', 'kamala@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'chef3.png'),
(4, 'Nirodha Saman', 'Saman@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'R.jpeg'),
(5, 'Patric Cleo', 'patric@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '9731022f0be7c965e880505461643850.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(20) NOT NULL,
  `qty` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_booking`
--

CREATE TABLE `food_booking` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ctype` varchar(100) NOT NULL,
  `ftype` varchar(200) NOT NULL,
  `qty` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_booking`
--

INSERT INTO `food_booking` (`id`, `name`, `ctype`, `ftype`, `qty`, `date`, `time`) VALUES
(1, 'kamal', 'chinese', 'rice', 2, '2024-07-26', '10.20'),
(2, 'kamal', 'chinese', 'rice', 2, '2024-07-26', '10.20'),
(3, 'kamal', 'chinese', 'rice', 2, '2024-07-26', '10.20'),
(4, 'praveen', 'italian', 'rice', 2, '2024-08-21', '10.20'),
(5, 'Nimal', 'indian', 'rice', 2, '2024-08-30', '13.00'),
(6, 'Praveen Nuwanjana', 'srilankan', 'Fried rice', 5, '2024-08-19', '10.20'),
(7, 'Nirmal', 'chinese', 'Chiken kottu', 1, '2024-08-22', '07.00');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `message`) VALUES
(2, 'praveen', 'praveen@gmail.com', 'Hello there..😊🙌'),
(3, 'kamal', 'kamal@gmail.com', 'Hello there..😊🙌'),
(4, 'Patric Leos', 'patric@gmail.com', 'I&#39;m waiting for you 🤞😉');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_type` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(20) NOT NULL,
  `qty` varchar(5) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL,
  `payment_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_resev`
--

CREATE TABLE `parking_resev` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `type` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_resev`
--

INSERT INTO `parking_resev` (`id`, `name`, `vehicle_no`, `type`, `date`) VALUES
(1, 'Saman', 'NB-2525', 'Car', '2024-07-19'),
(2, 'Kamal', 'BAI-1212', 'Bike', '2024-07-29'),
(3, 'Peter Parker', 'ND-1010', 'Bus', '2024-07-17'),
(4, 'Pawan', 'ABE-2510', 'Bike', '2024-07-20'),
(5, 'Nuwan', 'BAE - 8001', 'Bike', '2024-08-15'),
(6, 'PRAVEEN ', 'DG54855', 'Bus', '2024-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(50) NOT NULL,
  `cuisine_type` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_detail` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `cuisine_type`, `image`, `product_detail`, `status`) VALUES
(1, 'Keyoso', 1800, 'Chinese', 'dim sum.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(4, 'Plomo', 850, 'Italian', 'R (2).png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(6, 'leo', 1950, 'Chinese', 'soymilk drink.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(9, 'Chicken Kottu', 1550, 'Sri Lankan', 'R (1).png', 'Kottu roti, fresh vegetables, and wholesome eggs, and expertly combined with succulent chicken. Strictly from MSG or stock powder.', 'active'),
(10, 'Chicken Fried Rice', 1080, 'Sri Lankan', 'Image-8-4.png', 'Served with fried egg, chilli paste and prawn crackers\r\n', 'active'),
(11, 'Italian Chicken Pizza ', 2040, 'Italian', 'OIF-removebg-preview.png', 'Medium Sized pizza with 8 Slices', 'active'),
(12, 'Seafood Pizza', 2120, 'Sri Lankan', 'pngtree-a-pizza-with-seafood-png-image_9072764.png', 'Medium Sized pizza with 8 Slices', 'active'),
(13, 'Lamprais ', 2100, 'Sri Lankan', 'Lumprais-removebg-preview.png', 'The rice is the heart of a good lamprais dish. And I vehemently insist on using Sri Lankan short grain samba rice and fresh homemade stock whenever possible. Follow the recipe for ghee rice here. You may substitute ghee with butter and omit the coconut milk if you wish and throw in half a stalk of lemongrass for added flavor and aroma.', 'active'),
(14, 'Mutton Curry', 3580, 'Sri Lankan', 'Mutton-Red-curry-1-removebg-preview.png', 'It&#39;s a proper hearty & comforting curry fit for any occasion. Sri Lankan mutton curry comes in few different versions & this reduced curry recipe is my favourite. This mutton curry nicely goes with steamed rice also brilliant with toasted garlic bread', 'active'),
(15, 'Red Pork Curry', 2130, 'Sri Lankan', 'Pork-red-curry-removebg-preview.png', 'The secret of this red pork curry is freshly made curry powder and longer cooking until the fat renders. Slow cooking makes the pork pieces more tender and flavorful too. I like to buy pork shoulder chop for this recipe since it has a good ratio of fat and meat. But you can choose any pork piece you like.', 'deactive'),
(20, 'Mutton Biriyani Family Sawan (6 Pax)', 10850, 'Sri Lankan', '[removal.ai]_9515491b-a9f5-4a12-af38-d56b8779e591-mutton-biriyani-2-2046x2048.png', 'Served with Whole Roast Chicken, Spicy mutton Gravy, Cashew and Green Pea Curry, Malay Pickle, Raita, Maldives fish sambal and choice of Dessert', 'active'),
(21, 'Butterscotch Fudge Cake', 5620, 'Sri Lankan', '[removal.ai]_873525bb-e045-4fd3-ab01-fdd2d9af8996-butterscoch-fudge-cake.png', 'Our Butterscotch Fudge Cake features layers of moist sponge cake generously filled and frosted with creamy butterscotch fudge. With every bite, you`ll experience the perfect balance of sweetness and richness, complemented by the irresistible crunch of butterscotch bits sprinkled throughout. Whether you`re celebrating a special occasion or simply treating yourself to a moment of indulgence, our Butterscotch Fudge Cake is sure to impress.', 'active'),
(22, 'Red Velvet Cake (1.2kg)', 7420, 'Sri Lankan', '[removal.ai]_147b9218-2901-4350-ac8b-a6c1212dce45-red-velvet-cake-1.png', 'Bake a modern classic with this fabulous red velvet cake. This chocolatey sponge is perfect for a celebration, or halve for smaller crowd', 'active'),
(23, 'Black Forest (1.2 kg)', 6820, 'Sri Lankan', '[removal.ai]_41921112-643a-4dfd-8a9d-484bf5e5d407-black-forest-cake-3.png', 'Savor the elegance of our black forest cake with moist chocolate sponge embraces layers of ethereal whipping cream and chocolate mousse with a rich sweet dark cherry compote. Coated and garnished with whipped cream and dark chocolate and sweet dark cherries', 'active'),
(24, 'Watalappam', 1280, 'Sri Lankan', '[removal.ai]_d5739bae-77b1-4b67-bc67-ebc400cf7f0d-watalappam-1.png', 'Though Watalappan is very popular amoung Muslims and is a part of traditional Ramadan celebrations, Sri Lankan Watalappan is loved by many all over the world. There are many ways to make this amazing dessert with different ingredients.', 'active'),
(25, 'Pot Biriyani – Chicken', 4820, 'Indian', '[removal.ai]_6e26a09e-f276-40a2-8a0d-e2e5b8d32f27-chicken-biriyani-1-scaled.png', 'This one-pot chicken biryani is a quick version of the classic Indian biryani. Basmati rice, Indian spices, and caramelized onions in a yogurt-based marinade keep this chicken tender and juicy', 'active'),
(26, 'Pakora', 1340, 'Indian', '[removal.ai]_ff587f2e-af5c-4d35-8dfb-d1fb4f5bf5b7-india-food-chicken-pakora-1120x732.png', 'Pakora is a savory, deep-fried Indian snack made with chunks of vegetables such as potato, cauliflower and eggplant, or meat of choice, which is then dipped in chickpea flour, seasoned with turmeric, salt, chili, or other spices, and deep-fried in ghee.', 'active'),
(28, 'Idli', 860, 'Indian', '[removal.ai]_f1cdb1d3-ca68-4115-ae80-8638881d880d-india-food-paratha-1120x732.png', 'Idli is a traditional, savory Indian cake that is a popular breakfast item in many South Indian households, although it can be found throughout the country. It is made with a batter consisting of fermented lentils and rice, which is then steamed. These savory cakes are commonly served hot and consumed on their own, dipped into sambar or chutneys, or seasoned with a range of spices.', 'active'),
(30, 'Tender chicken', 3500, 'Indian', '[removal.ai]_1bc0ce45-9fc3-44e8-abf4-3a39ba9d09c5_india-food-butter-chicken-1120x732.png', 'A dish of tender chicken in a mildly spiced tomato sauce. It’s traditionally cooked in a tandoor (a cylindrical clay oven). The gravy is always made first by boiling down fresh tomato, garlic, and cardamom into a bright red pulp. This pulp is then pureed after cooling. Butter, various spices, and khoa (dried whole milk) is then added. The dish originated in Delhi during the 1950s.', 'active'),
(31, 'Dal Tadka', 450, 'Indian', '[removal.ai]_972198eb-08b4-459a-ad5a-930799c26a29-india-food-dal-tadka-1120x732.png', 'This classic lentil-based dish originates from the northern parts of India. Although there are variations, the dish is usually prepared with toor dal (split yellow peas), garlic, ginger, onions, tomatoes, garam masala, red chili peppers, ghee, cumin, coriander, turmeric, and fenugreek leaves. Once prepared, dal tadka is usually garnished with coriander leaves and served hot with jeera rice and roti on the side.', 'active'),
(33, 'Sambar ', 1520, 'Indian', '[removal.ai]_0a282c64-702a-443f-8337-81852e553017-india-food-sambar-1120x732.png', 'Sambar is a tamarind-based broth, prepared with lentils and vegetables. It originates from Tamil Nadu, but it is also very popular throughout South India. The dish is traditionally served with steamed rice or various Indian flatbreads.', 'active'),
(34, 'Dal Makhani', 1820, 'Indian', '[removal.ai]_3f816e70-51fd-484d-b05d-d9dc5ab48b80-india-food-dal-makani-1120x732.png', 'Although it originated in Punjab, dal makhani has become a favorite Indian lentil dish all over the country. It consists of black beans or red kidney beans and whole black lentils, called ‘urad’. The dish is prepared with plenty of ghee and seasonings such as ginger, garlic paste, and chili, and it is slowly cooked in a rich, tomato-based sauce.', 'active'),
(35, 'Shahi Paneer', 2420, 'Indian', '[removal.ai]_d4e5c49a-018b-468b-b808-036e64afd5fd-india-food-shahi-paneer-1120x732.png', 'Originating from India’s Mughlai cuisine, shahi paneer is a rich, hearty and nutritious cheese curry, prepared with paneer cheese, onions, almond paste, and a rich, spicy tomato-cream sauce. The dish is typically accompanied by Indian breads such as naan, roti, or puri, and garnished with coriander leaves.', 'active'),
(36, 'Rogan josh', 3420, 'Indian', '[removal.ai]_072b8882-57f2-4f6a-ba7d-099392b0bc01-india-food-rogan-josh-1120x732.png', 'Rogan josh is a staple of Kashmiri cuisine. It consists of braised lamb chunks cooked with gravy made from browned onions, yogurt, garlic, ginger, and aromatic spices. Known for its brilliant red color, a classic rogan josh uses liberal amounts of dried Kashmiri chilis.', 'active'),
(37, 'Tandoori chicken', 3460, 'Indian', '[removal.ai]_358b6e36-ea94-49f2-9ba0-afcfcdb29157-india-food-tandoori-chicken-1120x732-1.png', 'Tandoori chicken is one of the most famous Indian dishes. It is made by marinating chicken meat in yogurt, and is seasoned with tandoori masala, nutmeg, and cumin, before being placed on skewers. Traditionally, it is cooked at very high temperatures in cylindrical clay ovens called tandoor, resulting in succulent meat with a smokey flavor.\r\n\r\n', 'active'),
(38, 'Biriyani ', 2860, 'Indian', '[removal.ai]_67f04f4c-a889-4707-aed0-1926e7747506-india-food-biriyani-1120x732.png', 'Biriyani dates back to the Mughal Empire. The main ingredients are basmati rice, spices, a base of meat, eggs, or vegetables, and many optional ingredients such as dried fruits, nuts, and yogurt. It is believed that Mumtaz Mahal – Emperor Shah Jahan’s queen for whom the Taj Mahal was built as a tomb for – inspired the dish in the 1600s.', 'active'),
(39, ' Bolognese', 560, 'Italian', 'R.png', 'Italian’s are horrified that we Brits put Spaghetti with Bolognese sauce.', 'active'),
(40, 'Pasta', 650, 'Italian', 'pasata-removebg-preview.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(41, 'Nasi', 950, 'Chinese', 'Chinese fried rice.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(42, 'Nasi', 950, 'Italian', 'food-png--1242.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(43, 'Horono', 750, 'Italian', 'food-png-restaurant-food-dish-png-image-2951-443.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(97, 'Gonimo', 790, 'Italian', 'food-png-fast-food-png-most-popular-fast-food-snacks-in-your-area-and-most-image-540.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(98, 'Pizza', 1520, 'Italian', 'Ma Po Tofu.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(99, 'Nori', 795, 'Chinese', 'hotpot.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(100, 'Hotmot', 950, 'Chinese', 'Kung Pao Chicken.png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active'),
(101, 'Keso', 240, 'Chinese', 'sesame balls .png', 'Prawns on a bed of lettuce with avocado, tomato, and croutons finished with cocktail sauce, lime wedge, and parsley.', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `password`, `profile`) VALUES
(8, 'Coffee Heart', 'aba@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'c1.png'),
(9, 'Praveen', 'praveen@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'c3.jpeg'),
(10, 'Nuwan', 'kamal@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'c4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `table_resev`
--

CREATE TABLE `table_resev` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `members` int(20) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_resev`
--

INSERT INTO `table_resev` (`id`, `name`, `email`, `members`, `date`, `note`) VALUES
(1, 'Sunil', 'sunil@gmail.com', 2, '2024-07-16', 'Waiting ...😊👌'),
(2, 'Bandara', 'banda@gmail.com', 4, '2024-07-17', 'Meet soon...😍🙌'),
(3, 'Andare', 'ad@gmail.com', 3, '2024-07-23', 'Waiting ...😊👌'),
(7, 'Andare', 'ad@gmail.com', 3, '2024-07-23', 'Waiting ...😊👌'),
(8, 'Nuwan', 'kamala@gmail.com', 5, '2024-08-21', 'Waiting ...😊👌'),
(9, 'praveen', 'praveen@gmail.com', 6, '2024-08-08', 'Meet soon...😍🙌'),
(10, 'Praveen Nuwanjana', 'anemanda200207@gmail.com', 2, '2024-08-21', 'Waiting 🤩💕');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'jeo', 'jeo@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'dd', 'dd@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(4, 'ss', 'ss@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(6, 'praveen', 'praveen@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(7, 'Hello', 'hello@gmmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `price`) VALUES
(97, '', '1', 100),
(98, '', '2', 20),
(99, '', '3', 25),
(100, '', '4', 22),
(101, '', '5', 3620),
(102, '', '6', 6470),
(103, '', '10', 1080),
(104, '', '14', 3580);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_booking`
--
ALTER TABLE `food_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_resev`
--
ALTER TABLE `parking_resev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_resev`
--
ALTER TABLE `table_resev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_booking`
--
ALTER TABLE `food_booking`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parking_resev`
--
ALTER TABLE `parking_resev`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `table_resev`
--
ALTER TABLE `table_resev`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
