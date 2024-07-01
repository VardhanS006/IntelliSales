-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2023 at 05:42 PM
-- Server version: 5.7.44
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `superkartsoft_superkart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `image`, `parent_id`) VALUES
(3, 'Amul', 'Amul.png', 12),
(12, 'HP', 'HP.png', 20),
(13, 'Lenovo', 'Lenovo.png', 20),
(14, 'ROG', 'Rog.png', 20),
(15, 'Alienware', 'Alienware.png', 20),
(16, 'Boat', 'boat.jpg', 26),
(17, 'JBL', 'jbl.png', 26),
(18, 'XIAOMI', 'Xiaomi-logo.png', 26),
(19, 'Nutriorg', 'nutriorg.jpg', 21),
(20, 'Realme', 'realme.png', 26),
(21, 'Haier', 'Haier.svg', 22),
(22, 'Whirlpool', 'Whirlpool.png', 22),
(23, 'Bajaj', 'bajaj.jpg', 23),
(24, 'Philips', 'philips.png', 23),
(25, 'Livpure', 'livpure.png', 23),
(26, 'Prestige', 'prestige.png', 23),
(27, 'Pigeon', 'pigeon.png', 23);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer` int(191) NOT NULL,
  `product` int(191) NOT NULL,
  `product_code` int(191) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(191) NOT NULL,
  `total_price` double NOT NULL,
  `image` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `customer`, `product`, `product_code`, `price`, `quantity`, `total_price`, `image`) VALUES
(51, 8, 1, 42, 756984, 14000, 1, 14000, 'w_machine.jpg'),
(55, 6, 2, 4, 5456357, 50, 1, 50, 'Butter.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(6) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `parent_id` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `parent_id`) VALUES
(4, 'Grocery', 'grocery.webp', 0),
(5, 'Electronics', 'Electronics.webp', 0),
(7, 'Home & Furniture', 'Home & Furniture.webp', 0),
(8, 'Appliances', 'Appliances.webp', 0),
(12, 'Dairy Products', 'Dairy Products.webp', 4),
(20, 'PC & Laptops', 'electronics.jpg', 5),
(21, 'Fruits & Vegetables', 'vvff.webp', 4),
(22, 'Large Appliances', 'l_app.jpg', 8),
(23, 'Kitchen Appliances', 'k_app.jpg', 8),
(24, 'Furnitures', 'furnitures.avif', 7),
(25, 'Home Improvements', 'home_improve.png', 7),
(26, 'Electronic Accessories', 'e_acc.avif', 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `phone`, `image`, `email`) VALUES
(1, 'Steve', 'USA', '236428372', 'Mask Group 9.png', 'steve@gmail.com'),
(2, 'thor', 'Asgard', '23764872', '', 'godofthunder@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `category` int(191) NOT NULL,
  `brand` varchar(191) NOT NULL,
  `sub_category` int(191) NOT NULL,
  `cost_price` double NOT NULL,
  `discount_price` double NOT NULL,
  `discount` double NOT NULL,
  `selling_price` double NOT NULL,
  `manufacturing` date NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_alert` int(11) NOT NULL,
  `expiry` date NOT NULL,
  `image` varchar(191) NOT NULL,
  `warehouse` int(20) NOT NULL,
  `product_code` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `category`, `brand`, `sub_category`, `cost_price`, `discount_price`, `discount`, `selling_price`, `manufacturing`, `stock`, `stock_alert`, `expiry`, `image`, `warehouse`, `product_code`, `status`) VALUES
(3, 'Curd', 4, '3', 12, 20, 5, 25, 15, '2023-08-29', 46, 5, '2023-11-29', 'curd.jpg', 1, '646556', 'enabled'),
(4, 'Butter', 4, '3', 12, 55, 5, 9.090909090909092, 50, '2023-08-30', 94, 3, '2023-12-29', 'Butter.jpeg', 1, '5456357', 'enabled'),
(21, 'Alienware x14 R2 Gaming Laptop', 5, '15', 20, 250000, 5000, 2, 245000, '2023-09-17', 78, 3, '2030-11-26', 'Alienware x14.avif', 1, '97546846', 'enabled'),
(22, 'Alienware m16 Gaming Laptop', 5, '15', 20, 252989, 6000, 2.371644616959631, 246989, '2023-09-17', 70, 3, '2030-08-20', 'alienware-m16.avif', 1, '5165513', 'enabled'),
(23, 'ASUS ROG Zephyrus Duo 16', 5, '14', 20, 470000, 49000, 10.425531914893616, 421000, '2023-09-17', 89, 2, '2029-11-21', 'zephyrus.jpg', 1, '5652686', 'enabled'),
(24, 'ASUS ROG Strix G15', 5, '14', 20, 100000, 5000, 5, 95000, '2023-09-17', 90, 3, '2029-10-24', 'G15.jpg', 1, '2374576', 'enabled'),
(25, 'IdeaPad Slim 3 Gen 8', 5, '13', 20, 50000, 5000, 10, 45000, '2023-09-11', 100, 4, '2030-10-15', 'Ideapad-slim3.webp', 1, '6565135', 'enabled'),
(26, 'ThinkPad E16', 5, '13', 20, 70000, 8500, 12.142857142857142, 61500, '2023-09-17', 99, 3, '2030-07-27', 'thinkpad.avif', 1, '2746278', 'enabled'),
(27, 'Hp Pavilion X360 11Th Gen ', 5, '12', 20, 63362, 9562, 15.091064044695559, 53800, '2023-09-17', 80, 2, '2030-10-30', 'pavilion x360.jpg', 1, '236545', 'enabled'),
(28, ' HP Laptop 15s', 5, '12', 20, 78000, 6800, 8.717948717948717, 71200, '2023-09-13', 70, 2, '2030-07-31', 'hp-15s.jpg', 1, '1243434', 'enabled'),
(29, 'Apples', 4, '19', 21, 100, 15, 15, 85, '2023-09-16', 50, 5, '2023-09-30', 'apple.jpeg', 1, '654596', 'enabled'),
(30, 'Bananas', 4, '19', 21, 50, 5, 10, 45, '2023-09-16', 68, 5, '2023-09-30', 'banana.jpg', 1, '654658', 'enabled'),
(31, 'Realme 150W Super Flash Charge Power Adapter', 5, '20', 26, 1799, 399, 22.17898832684825, 1400, '2023-09-11', 120, 3, '2031-06-10', 'Realme-charger.jpg', 1, '465487', 'enabled'),
(32, 'Cherry', 4, '19', 21, 85, 7, 8.235294117647058, 78, '2023-09-15', 87, 3, '2023-09-29', 'cherry.webp', 1, '988754', 'enabled'),
(33, 'MI Power Bank 3i', 5, '18', 26, 2199, 50, 2.2737608003638017, 2149, '2023-09-17', 90, 5, '2029-10-23', 'Mi-pb.jpg', 1, '765834', 'enabled'),
(34, 'Potato', 4, '19', 21, 30, 5, 16.666666666666668, 25, '2023-09-16', 100, 10, '2023-10-08', 'potato.webp', 1, '656477', 'enabled'),
(35, 'JBL Tune 230NC TWS', 5, '17', 26, 7999, 2999, 37.49218652331542, 5000, '2023-09-17', 150, 3, '2029-10-15', 'jbl airpod.jpg', 1, '782343', 'enabled'),
(36, 'Onion', 4, '19', 21, 80, 3, 3.75, 77, '2023-09-13', 150, 15, '2023-10-06', 'onion.jpg', 1, '456975', 'enabled'),
(37, 'boAt Immortal IM1000D', 5, '16', 26, 5990, 2990, 49.91652754590985, 3000, '2023-09-17', 129, 5, '2030-10-15', 'Boat.jpg', 1, '374628', 'enabled'),
(38, 'Haier 190L Refrigerator', 8, '21', 22, 21000, 5600, 26.666666666666668, 15400, '2023-07-06', 30, 3, '2030-11-29', 'h_fridge.jpg', 4, '784466', 'enabled'),
(39, 'Whirlpool 207L Refrigerator', 8, '22', 22, 25000, 8700, 34.8, 16300, '2023-09-01', 24, 4, '2031-10-23', 'w_fridge.jpg', 4, '564798', 'enabled'),
(40, 'Bajaj HM-01 250W Hand Blender', 8, '23', 23, 2800, 1401, 50.035714285714285, 1399, '2023-09-17', 90, 3, '2030-10-15', 'bajaj blender.jpg', 4, '732683', 'enabled'),
(41, 'Prestige 1.2 Litres Electric Kettle', 8, '26', 23, 1000, 280, 28, 720, '2023-09-17', 80, 4, '2029-11-21', 'prestige kettle.jpg', 4, '326347', 'enabled'),
(42, '6.5Kg Washing Machine', 8, '22', 22, 18000, 4000, 22.22222222222222, 14000, '2023-09-16', 48, 5, '2028-10-11', 'w_machine.jpg', 4, '756984', 'enabled'),
(43, 'Pigeon by Stovekraft Cruise ', 8, '27', 23, 3100, 1600, 51.61290322580645, 1500, '2023-09-17', 100, 4, '2030-06-04', 'Pigeon Induction.jpg', 4, '728362', 'enabled'),
(44, 'Philips Viva Collection HR1863/20 ', 8, '24', 23, 12999, 3000, 23.078698361412417, 9999, '2023-09-17', 80, 3, '2030-10-07', 'philips juicer.jpg', 4, '237687', 'enabled'),
(45, 'Livpure Bolt+ Water Purifier', 8, '25', 23, 17990, 2990, 16.62034463590884, 15000, '2023-09-03', 70, 2, '2029-06-11', 'Livpure wp.jpg', 4, '238758', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `p_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `supplier` int(191) NOT NULL,
  `warehouse` int(191) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double NOT NULL,
  `total_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `customer` int(11) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_status` varchar(191) NOT NULL,
  `amount` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `user_id`, `date`, `customer`, `payment_mode`, `payment_status`, `amount`) VALUES
(1, 6, '2023-09-17', 1, 'CASH', 'PENDING', '440300â‚¹'),
(2, 6, '2023-09-17', 2, 'CASH', 'PENDING', '138â‚¹'),
(3, 6, '2023-09-17', 2, 'CASH', 'PENDING', '45â‚¹'),
(4, 6, '2023-09-17', 2, 'CASH', 'PENDING', '14000â‚¹'),
(5, 6, '2023-09-18', 1, 'CASH', 'PENDING', '306500â‚¹'),
(6, 6, '2023-09-18', 1, 'CASH', 'PENDING', '245000â‚¹'),
(7, 6, '2023-09-21', 1, 'CASH', 'PENDING', '156â‚¹'),
(8, 6, '2023-09-21', 1, 'ONLINE', 'PENDING', '50â‚¹'),
(9, 6, '2023-09-21', 1, 'ONLINE', 'PENDING', '14050â‚¹'),
(10, 6, '2023-09-21', 1, 'ONLINE', 'PENDING', '50â‚¹');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `sale_id` int(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `product` int(191) NOT NULL,
  `quantity` int(191) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`sale_id`, `image`, `product`, `quantity`, `total_price`) VALUES
(1, 'Boat.jpg', 37, 1, 3000),
(1, 'zephyrus.jpg', 23, 1, 421000),
(1, 'w_fridge.jpg', 39, 1, 16300),
(2, 'curd.jpg', 3, 1, 15),
(2, 'banana.jpg', 30, 1, 45),
(2, 'cherry.webp', 32, 1, 78),
(3, 'banana.jpg', 30, 1, 45),
(4, 'w_machine.jpg', 42, 1, 14000),
(5, 'Alienware x14.avif', 21, 1, 245000),
(5, 'thinkpad.avif', 26, 1, 61500),
(6, 'Alienware x14.avif', 21, 1, 245000),
(7, 'cherry.webp', 32, 2, 156),
(8, 'Butter.jpeg', 4, 1, 50),
(9, 'w_machine.jpg', 42, 1, 14000),
(9, 'Butter.jpeg', 4, 1, 50),
(10, 'Butter.jpeg', 4, 1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `phone`, `image`, `email`) VALUES
(2, 'Jethalal Champaklal Gada', 'Mumbai', '21342423', 'supplier.jpeg', 'Gadaelectronics@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `image`, `password`, `role`) VALUES
(4, 'UTKARSH', 'anonymous6599123@gmail.com', '1234567890', 'Mask Group 10.png', '$2y$10$G1SwppRwY9Uax9/Pva.U5uaOwD.ic1F2oLtMO1YjWqK8AvJvzOyle', 1),
(6, 'Stark', 'ironman@gmail.com', '324234234', 'Mask Group 10.png', '$2y$10$Y7GRPV3cr2NQnZk7j/1bmuhniqNFxR6y6dkrGF2vuFAdfy9N2U0Zy', 2),
(7, 'ABC', 'abc@gmail.com', '666666666', 'Mask Group 10.png', '$2y$10$TVBQ.HTzur8LzwCA3ZiKbe1hG/z44rCcqzhWl9ECJTFHyC3rtwuWi', 2),
(8, 'Test-user', 'testid@gmail.com', '9999999999', 'Mask Group 9.png', '$2y$10$gjSOkuQOCQsIc4j.05SO7OB9pixuHgCtfaBQnIyyz2.vIBn5taWFa', 2);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `address`, `image`) VALUES
(1, 'Warehouse 1', 'Aliganj, Lucknow', 'ware1.jpg'),
(4, 'Warehouse 2', 'Indira Nagar, Lucknow', 'ware2.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
