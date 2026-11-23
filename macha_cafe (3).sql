-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2026 at 01:50 PM
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
-- Database: `macha_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'May', 'admin@gmail.com', '$2y$10$09h2H62hDIBdgkm4ZGkzWOqelZTwYXDyv7PJjHfHuTtgln8A7cPIG', '2026-11-19 14:58:22'),
(2, 'Hein', 'Hein@gmail.com', '$2y$10$EeK9BJquY5cH8ggQLkNVz.kYyvoAFxGQVtqetKXJttPiCGQ/EICCu', '2026-11-22 13:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Matcha Drinks'),
(2, 'Cakes'),
(3, 'Food'),
(4, 'Smoothies'),
(5, 'Desserts'),
(6, 'Specials');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `region` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `status` enum('Pending','Processing','Completed','Cancelled') DEFAULT 'Pending',
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `phone`, `region`, `address`, `total`, `status`, `order_date`) VALUES
(1, 1, '09736729752', 'Shan', 'shan', 11500.00, 'Pending', '2026-11-13 20:30:17'),
(2, 1, '09736729752', 'Kayin', 'kayin', 15000.00, 'Pending', '2026-11-13 20:40:04'),
(3, 1, '09736729752', 'Yangon', 'insein', 5500.00, 'Pending', '2026-11-13 21:00:17'),
(4, 1, '09736729752', 'Yangon', 'hlaing', 25500.00, 'Pending', '2026-11-13 21:01:51'),
(5, 1, '09736729752', 'Yangon', 'insein', 15000.00, 'Pending', '2026-11-15 21:34:36'),
(6, 1, '09736729752', 'Yangon', 'insein', 5500.00, 'Pending', '2026-11-16 11:18:22'),
(7, 1, '09736729752', 'Yangon', 'khg', 5500.00, 'Pending', '2026-11-16 11:22:42'),
(8, 4, '09736729752', 'Yangon', 'insein', 5500.00, 'Pending', '2026-11-19 20:09:37'),
(9, 4, '09356726868', 'Mandalay', 'street 1', 46000.00, 'Pending', '2026-11-22 18:45:50'),
(10, 4, '09356726868', 'Mandalay', 'strlafrf', 5500.00, 'Pending', '2026-11-23 11:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `subtotal`) VALUES
(1, 1, 2, 'Green Tea', 6000.00, 1, 6000.00),
(2, 1, 1, 'Matcha Latte', 5500.00, 1, 5500.00),
(3, 2, 5, 'Strawberry Dream Combo ', 15000.00, 1, 15000.00),
(4, 3, 1, 'Matcha Latte', 5500.00, 1, 5500.00),
(5, 4, 1, 'Matcha Latte', 5500.00, 1, 5500.00),
(6, 4, 3, 'Expresso', 5000.00, 1, 5000.00),
(7, 4, 4, 'Minibentbox', 15000.00, 1, 15000.00),
(8, 5, 5, 'Strawberry Dream Combo ', 15000.00, 1, 15000.00),
(9, 6, 1, 'Matcha Latte', 5500.00, 1, 5500.00),
(10, 7, 1, 'Matcha Latte', 5500.00, 1, 5500.00),
(11, 8, 1, 'Matcha Latte', 5500.00, 1, 5500.00),
(12, 9, 3, 'Expresso', 5000.00, 3, 15000.00),
(13, 9, 7, 'Latte', 9000.00, 2, 18000.00),
(14, 9, 14, 'black tea1', 13000.00, 1, 13000.00),
(15, 10, 1, 'Matcha Latte', 5500.00, 1, 5500.00);

-- --------------------------------------------------------

--
-- Table structure for table `popular_products`
--

CREATE TABLE `popular_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popular_products`
--

INSERT INTO `popular_products` (`id`, `product_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 61);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `image`, `category_id`) VALUES
(1, 'Matcha Latte', 5500, 'classic matcha lattle.jpg', 1),
(2, 'Green Tea', 6000, 'green tea2.jpg', 1),
(3, 'Expresso', 5000, '68483ca714678_expresso.jpg', 1),
(4, 'Minibentbox', 15000, '68522cd047d43_minibentbox.jpg', 3),
(5, 'Strawberry Dream Combo ', 15000, '68522d2931c08_StrawberryDreamComboSet.jpg', 2),
(6, 'Choco', 18000, '68522da8a3787_Choco Mood Set.jpg', 2),
(7, 'Latte', 9000, '68594a7f672f4_LatteLullaby.jpg', 1),
(8, 'Date Se', 18000, '6852388586c5a_dateSet.jpg', 2),
(9, 'AlmondCroissant', 14000, 'AlmondCroissant.jpg', 5),
(10, 'Amondflourwaffle', 10000, 'amondflourwaffle.jpg', 5),
(11, 'AvocadoToastwithEgg', 12000, 'avocadoToastwithEgg.jpg', 3),
(12, 'BakedFalafelBowl', 20000, 'bakedFalafelBowl.jpg', 3),
(13, 'BakedsweetpotatoFries', 20000, 'bakedsweetpotatoFries.jpg', 3),
(14, 'black tea1', 13000, 'black tea1.jpg', 1),
(15, 'Cafe', 13000, 'cafe01.jpg', 1),
(16, 'Cappuccino', 6000, 'cappuccino.jpg', 1),
(17, 'Carrot cake muffins', 18000, 'carrot cake muffins.jpg', 2),
(18, 'Chocolate Cake', 15000, 'chocolate cake.jpg', 2),
(19, 'Chocolateloverswaffle', 22000, 'chocolateloverswaffle.jpg', 2),
(20, 'CinemonRolls', 15000, 'cinemonRolls.jpg', 2),
(21, 'Coconut Vanilla Slice', 6000, 'coconutVanillaSlice.jpg', 2),
(22, 'Kombucha', 8000, 'Kombucha.jpg', 1),
(23, 'leamon tea', 6000, 'leamon tea 1.jpg', 1),
(24, 'Macha', 9000, 'macha1.jpg', 1),
(25, 'Matcha loverset', 18000, 'matchaloverset.jpg', 6),
(26, 'Respberry Tea', 10000, 'respberry tea.jpg', 1),
(27, 'Tarts', 14000, 'tarts 1.jpg', 2),
(28, 'Matcha Vanilla', 8000, 'matcha vinnila.jpg', 1),
(29, 'Ice Matcha', 7000, 'ice matcha.jpg', 1),
(30, 'Strawberry Matcha', 8000, 'strawberry matcha.jpg', 1),
(31, 'Matcha Espresso', 10000, 'matcha espresso.jpg', 1),
(32, 'Mango Matcha', 12000, 'mangodrink.jpg', 1),
(33, 'Choco', 11000, 'CoconutWater.jpg', 1),
(34, 'Honey Matcha Latte', 9000, 'honey matcha.jpg', 1),
(35, 'Matcha Milk Tea', 12000, 'matcha milk tea.jpg', 1),
(36, 'Matcha Cake', 8000, 'macha cake1.jpg', 2),
(37, 'Cupcake', 7000, 'cupcake.jpg', 2),
(38, 'Cheesecake', 8000, 'cheesecake.jpg', 2),
(39, 'Chiffon Cake', 15000, 'chiffon cake.jpg', 2),
(40, 'Vanilla Cheesecake', 14000, 'vanilla cheesecake.jpg', 2),
(41, 'Matcha Roll Cak', 15000, 'matcha roll cake.jpg', 2),
(42, 'Vanilla Cheesecake', 14000, 'vanilla cheesecake.jpg', 2),
(43, 'Chocolate Tiramisu<', 12000, 'chocolate tiramisu.jpg', 2),
(44, 'Cottage Cheese Brownies<', 8000, 'cottage cheese brownies.jpg', 2),
(45, 'Cookies', 20000, 'cookies.jpg', 2),
(46, 'Croissant', 13000, 'AlmondCroissant.jpg', 2),
(47, 'Donut', 13000, 'matcha donut.jpg', 2),
(48, 'Carrot cake muffins', 18000, 'carrot cake muffins.jpg', 2),
(49, 'Chocolate Cake', 15000, 'chocolate cake.jpg', 2),
(50, 'Chocolateloverswaffle', 22000, 'chocolateloverswaffle.jpg', 2),
(51, 'CinemonRolls', 15000, 'cinemonRolls.jpg', 2),
(52, 'Matcha loverset', 18000, 'matchaloverset.jpg', 2),
(53, 'Matcha Muffins', 18000, 'matcha muffins.jpg', 2),
(54, 'Hot Chicken Burger', 10000, 'hot chicken.jpg', 3),
(55, 'Dilly Chicken Sandwish', 12000, 'dilly chicken sandwish.jpg', 3),
(56, 'Pesto Chicken Salad Sandwish', 8000, 'pesto chicken salad sandwish.jpg', 3),
(57, 'Spicy Arrabbiata Pasta', 15000, 'spicy arrabbiata pasta.jpg', 3),
(58, 'Egg Salad Sandwish ', 10000, 'egg salad sandwish.jpg', 3),
(59, 'Chicken Katsu Sando', 15000, 'chicken katsu sando.jpg', 3),
(60, 'Avocado Toast', 18000, 'avocado toast.jpg', 3),
(61, 'Tuna Sandwish', 15000, 'tuna sandwish.jpg', 3),
(62, 'Chicken Nuggests<', 20000, 'chicken nuggets.jpg', 3),
(63, 'Japanese Curry ', 20000, 'japanese curry rice.jpg', 3),
(64, 'Chicken Katsu Curry', 20000, 'chicken katsu rice.jpg', 3),
(65, 'Happy Hour Mini Set', 23000, '685238a67db66_happyhourminiset.jpg', 3),
(66, 'Bakedsweet PotatoFries<', 13000, 'bakedsweetpotatoFries.jpg', 3),
(67, 'Mango Banana Smoothies', 8500, 'mango banana smoothies.jpg', 4),
(68, 'Berry Reef Smoothies', 10000, 'berry reef smoothies.jpg', 4),
(69, 'Pineapple Mango Smoothies', 7000, 'pineapple mango smoothies.jpg', 4),
(70, 'Mango Smoothies', 10000, 'mango smoothies.jpg', 4),
(71, 'Carrot Cake Smoothies', 12000, 'carrot cake smoothies.jpg', 4),
(72, 'StrawBerry Smoothies', 15000, 'strawberry smoothies.jpg', 4),
(73, 'Chocolate Smoothies', 9000, 'chocolate smoothies.jpg', 4),
(74, 'Matcha Banana Smoothies', 18000, 'macha banana smoothies.jpg', 4),
(75, 'Smoothies', 15000, 'smooties.jpg', 4),
(76, 'Smoothies Bowls', 15000, 'smoothies bowls.jpg', 4),
(77, 'chocolate and Waffles', 12000, 'chocolate and waffles.jpg', 5),
(78, 'Ice Cream Waffle Sandwiches', 15000, 'ice cream waffle sandwiches.jpg', 5),
(79, 'Banana Split', 15000, 'banana split.jpg', 5),
(80, 'Banana Pudding', 15000, 'banana pudding.jpg', 5),
(81, 'Strawberry Pudding', 15000, 'strawberry pudding.jpg', 5),
(82, 'Matcha Pudding', 15000, 'matcha pudding.jpg', 5),
(83, 'Mix Mochi', 20000, 'mix mochi.jpg', 5),
(84, 'Matcha Mochi<', 10000, 'matcha mochi.jpg', 5),
(85, 'Fruits Moch', 18000, 'fruits mochi.jpg', 5),
(86, 'Green Tea Parfait', 18000, 'green tea parfait.jpg', 5),
(87, 'Lava Cake', 15000, 'lava cake.jpg', 5),
(88, 'Mousse', 12000, 'mousse.jpg', 5),
(89, 'Pancake', 15000, 'almondflourpancake.jpg', 5),
(90, 'Amondflourwaffle', 12000, 'amondflourwaffle.jpg', 5),
(91, 'Matcha whiteChocolate CakePop', 18000, 'matchawhiteChocolateCakePop.jpg', 6),
(92, 'Matcha', 16000, 'matcha.jpg', 6),
(93, 'Matcha GreenTeaSlice', 15000, 'MatchaGreenTeaSlice.jpg', 6),
(94, 'Matcha limefizz', 12000, 'matchalimefizz.jpg', 6),
(95, 'Matcha Mochi Waffle', 18000, 'matchamochiwaffle.jpg', 6),
(96, 'Matcha Mousse CakeSlice', 12000, 'matchaMousseCakeSlice.jpg', 6),
(97, 'Matcha Protein Pancake', 16000, 'matchaProteinPancake.jpg', 6),
(98, 'Matcha White ChocoCookie', 10000, 'matchawhitechococookies.jpg', 6),
(99, 'Opera', 20000, 'matcha opera.jpg', 6),
(100, 'Crepes', 23000, 'matcha crepes.jpg', 6),
(101, 'Matcha Red Bean Latte', 17000, 'Matcha Red Bean Latte.jpg', 6),
(102, 'Matcha White Chocolate', 20000, 'matcha white chocolate.jpg', 6),
(103, 'Matcha Affogoto', 16000, 'matcha affogota.jpg', 6),
(104, 'strawberry matcha cloud latte', 16000, 'strawberry matcha cloud latte.jpg', 6),
(105, 'Matcha Mochi<', 12000, 'matcha mochi.jpg', 6),
(107, 'Bakery', 8000, 'images/product_6b000d0d6b9421.71417050.jpg', 5),
(108, 'Avocado Edamame Tost', 15000, 'images/product_6b027d570c5c33.69983076.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `created_at`) VALUES
(1, 'Htet', 'h@gmail.com', '12345678', '2026-11-04 10:44:25'),
(2, 'HHH', 'hhh@gmail.com', '123456789', '2026-11-18 14:41:12'),
(3, 'Hein Min', 'heinmin@gmail.com', '$2y$10$6cNdwEv4pSgLP8NNiRE9ROhQSTtxZG/MlnpCQ621Mq8aI.U0xlx6K', '2026-11-18 15:16:33'),
(4, 'leo', 'leo@gmail.com', '$2y$10$Kba5HOEREbZJ6BOzsUT3POQmUOIZCxvFegMs40lABZpmQDaGuEk.S', '2026-11-19 13:38:00'),
(5, 'may', 'may@gmail.com', '$2y$10$JbPTnKrwiVDQ4QRSgridK.yHv.ABMtv469foXGN3codJLwbo9W0MS', '2026-11-20 08:55:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `popular_products`
--
ALTER TABLE `popular_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `popular_products`
--
ALTER TABLE `popular_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `popular_products`
--
ALTER TABLE `popular_products`
  ADD CONSTRAINT `popular_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
