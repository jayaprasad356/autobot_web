-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 12:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autobot`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(11) DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `last_updated`, `date_created`) VALUES
(1, 'Oil', 'upload/images/1658903944.2566.jpg', 1, '2022-07-27 07:23:27', '2022-07-27 05:49:11'),
(2, 'Spare parts', 'upload/images/1658903957.6194.jpg', 1, '2022-07-27 06:39:17', '2022-07-27 05:50:35'),
(3, 'tyres', 'upload/images/0582-2022-07-27.jpg', 1, '2022-07-29 17:22:45', '2022-07-27 06:41:35'),
(4, 'Rods', 'upload/images/1659123088.7927.jpg', 0, '2022-07-29 19:31:28', '2022-07-29 18:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `deliver_pincodes`
--

CREATE TABLE `deliver_pincodes` (
  `id` int(11) NOT NULL,
  `pincode` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliver_pincodes`
--

INSERT INTO `deliver_pincodes` (`id`, `pincode`) VALUES
(2, '621313');

-- --------------------------------------------------------

--
-- Table structure for table `mechanic`
--

CREATE TABLE `mechanic` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `district` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `pincode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`id`, `name`, `mobile`, `password`, `address`, `district`, `state`, `pincode`) VALUES
(1, 'Divakar', '7358832695', '1234567890', '2/42, Azhagapuri,R.T.Malai(Po)', 'Karur', 'Tamil Nadu', '621313'),
(2, 'Jaswanth', '8435728849', '12345', '1,Kontek reet', 'Trichy', 'Assam', '675894');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `model` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `model`) VALUES
(1, 'Yamaha'),
(2, 'KTM'),
(3, 'TVS'),
(4, 'Hero Honda'),
(5, 'Bajaj'),
(6, 'Suzuki'),
(7, 'Royal Enfield'),
(8, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`) VALUES
(1, 'payments', 'I can\'t pay through online payment');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pincode` text DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_variant_id` int(11) DEFAULT NULL,
  `model` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `mobile`, `name`, `address`, `pincode`, `product_id`, `product_variant_id`, `model`, `price`, `status`) VALUES
(1, 1, '7358832695', 'Henry', '1,Thayanur,Trichy', '643452', 6, 5, NULL, NULL, 1),
(2, 2, '8428225519', 'Divakar', '1,Thayanur,Trichy', '643452', 6, 5, 'Yamaha FZ', '500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` text DEFAULT NULL,
  `brand` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `brand`, `description`, `image`) VALUES
(1, 1, 'Engine Oil', 'Racer', 'one of the best brand used by 1000+ customers', 'upload/products/1659114493.4682.jpg'),
(6, 2, 'Handle Miror', 'jace', 'cdsce', 'upload/products/1659119349.1368.jpg'),
(8, 3, 'Front tyre', 'MRF', 'It is one of the best brand', 'upload/products/2225-2022-07-30.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `model` text DEFAULT NULL,
  `price` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`id`, `product_id`, `model`, `price`) VALUES
(1, 1, 'Yamaha', '700'),
(2, 1, 'KTM', '849'),
(4, 6, 'Yamaha', '67'),
(5, 6, 'Royal Enfield', '900'),
(8, 8, 'Hero Honda', '560'),
(9, 8, 'Yamaha', '789');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id` int(11) NOT NULL,
  `vehicle_no` text DEFAULT NULL,
  `vehicle_group` text DEFAULT NULL,
  `model` text DEFAULT NULL,
  `year_of_manufacture` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id`, `vehicle_no`, `vehicle_group`, `model`, `year_of_manufacture`) VALUES
(1, 'TN65AJ8940', 'Bajaj', 'Pulsar 150', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `rental_orders`
--

CREATE TABLE `rental_orders` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `rental_vehicles_id` text DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rental_orders`
--

INSERT INTO `rental_orders` (`id`, `name`, `mobile`, `rental_vehicles_id`, `start_time`, `end_time`, `status`) VALUES
(1, 'Divakar', '8975463738', '1', '2022-08-30', '2022-08-31', '2');

-- --------------------------------------------------------

--
-- Table structure for table `rental_vehicles`
--

CREATE TABLE `rental_vehicles` (
  `id` int(11) NOT NULL,
  `category` text DEFAULT NULL,
  `brand` text DEFAULT NULL,
  `bike_name` text DEFAULT NULL,
  `price_per_hour` int(11) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rental_vehicles`
--

INSERT INTO `rental_vehicles` (`id`, `category`, `brand`, `bike_name`, `price_per_hour`, `pincode`, `image`, `status`) VALUES
(1, 'City Booking', 'KTM', 'Duke 200', 40, '621313', 'upload/rentals/0069-2022-08-28.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 DEFAULT NULL,
  `store_name` text CHARACTER SET utf8 DEFAULT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `email` text CHARACTER SET utf8 DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `balance` int(50) NOT NULL DEFAULT 0,
  `store_url` text CHARACTER SET utf8 DEFAULT NULL,
  `logo` text CHARACTER SET utf8 DEFAULT NULL,
  `store_description` text CHARACTER SET utf8 DEFAULT NULL,
  `street` text CHARACTER SET utf8 DEFAULT NULL,
  `pincode_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pincode_text` varchar(100) NOT NULL,
  `city_text` varchar(100) NOT NULL,
  `state` text CHARACTER SET utf8 DEFAULT NULL,
  `categories` text CHARACTER SET utf8 DEFAULT NULL,
  `account_number` text CHARACTER SET utf8 DEFAULT NULL,
  `bank_ifsc_code` text CHARACTER SET utf8 DEFAULT NULL,
  `account_name` text CHARACTER SET utf8 DEFAULT NULL,
  `bank_name` text CHARACTER SET utf8 DEFAULT NULL,
  `commission` int(11) DEFAULT 0,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `require_products_approval` tinyint(2) NOT NULL DEFAULT 0,
  `fcm_id` text CHARACTER SET utf8 DEFAULT NULL,
  `national_identity_card` text CHARACTER SET utf8 DEFAULT NULL,
  `address_proof` text CHARACTER SET utf8 DEFAULT NULL,
  `pan_number` text CHARACTER SET utf8 DEFAULT NULL,
  `tax_name` text CHARACTER SET utf8 DEFAULT NULL,
  `tax_number` text CHARACTER SET utf8 DEFAULT NULL,
  `customer_privacy` tinyint(4) DEFAULT 0,
  `latitude` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `longitude` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `forgot_password_code` varchar(256) DEFAULT NULL,
  `view_order_otp` tinyint(2) DEFAULT 0,
  `assign_delivery_boy` tinyint(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `store_name`, `slug`, `email`, `mobile`, `password`, `balance`, `store_url`, `logo`, `store_description`, `street`, `pincode_id`, `city_id`, `pincode_text`, `city_text`, `state`, `categories`, `account_number`, `bank_ifsc_code`, `account_name`, `bank_name`, `commission`, `status`, `last_updated`, `date_created`, `require_products_approval`, `fcm_id`, `national_identity_card`, `address_proof`, `pan_number`, `tax_name`, `tax_number`, `customer_privacy`, `latitude`, `longitude`, `forgot_password_code`, `view_order_otp`, `assign_delivery_boy`) VALUES
(1, 'Divakar A', 'gold', NULL, 'example@gmail.com', '9876543210', 'e807f1fcf82d132f9bb018ca6738a19f', 0, NULL, '1661624684.1169.jpg', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, '2022-08-27 18:24:44', 0, NULL, '1661624684.1189.jpg', '1661624684.1199.jpg', 'SMD787R4G', 'dentenf', '12345678', 0, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `model` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `service_type` text DEFAULT NULL,
  `category` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `model`, `mobile`, `service_type`, `category`) VALUES
(1, 'Pulsar NS160', '2017', '7358832695', 'Puncture', 'Emergency'),
(2, 'Yamaha', '2018', '8765757667', 'Breakdown', 'general');

-- --------------------------------------------------------

--
-- Table structure for table `showroom`
--

CREATE TABLE `showroom` (
  `id` int(11) NOT NULL,
  `showroom_name` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `alternate_mobile` text DEFAULT NULL,
  `brand` text DEFAULT NULL,
  `working_hours` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pincode` text DEFAULT NULL,
  `gst_tin` text DEFAULT NULL,
  `account_no` text DEFAULT NULL,
  `ifsc_code` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `showroom`
--

INSERT INTO `showroom` (`id`, `showroom_name`, `mobile`, `password`, `alternate_mobile`, `brand`, `working_hours`, `address`, `pincode`, `gst_tin`, `account_no`, `ifsc_code`, `status`) VALUES
(1, 'Yamaha', '8428225519', '1234567890', '7358832695', 'yamaha-fz', '9.00AM-8.00PM', 'Karur', '620008', '12345', '54321', 'SBI124', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `image`, `status`) VALUES
(2, 'shop', 'upload/slides/3595-2022-07-28.jpg', 1),
(3, 'home', 'upload/slides/0232-2022-07-29.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `used_vehicles`
--

CREATE TABLE `used_vehicles` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `brand` text DEFAULT NULL,
  `bike_name` text NOT NULL,
  `model` text DEFAULT NULL,
  `vehicle_no` text DEFAULT NULL,
  `km_driven` text DEFAULT NULL,
  `insurance` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `fuel` varchar(255) DEFAULT NULL,
  `owner` int(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `used_vehicles`
--

INSERT INTO `used_vehicles` (`id`, `seller_id`, `brand`, `bike_name`, `model`, `vehicle_no`, `km_driven`, `insurance`, `price`, `location`, `image`, `color`, `fuel`, `owner`) VALUES
(1, 1, 'KTM', 'KTM RC200', '2022', 'YN65AJ6789', '3400', 'Yes', '220000', 'Karur', 'upload/vehicles/1662277842.6152.jpg', 'Orange', 'Petrol', 2);

-- --------------------------------------------------------

--
-- Table structure for table `used_vehicle_orders`
--

CREATE TABLE `used_vehicle_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `used_vehicles_id` int(11) DEFAULT NULL,
  `price` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `used_vehicle_orders`
--

INSERT INTO `used_vehicle_orders` (`id`, `user_id`, `used_vehicles_id`, `price`, `description`, `status`) VALUES
(1, 2, 1, '50000', 'Hi Vehicle', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `status`) VALUES
(1, 'Divakar', '1234567890', '0'),
(2, 'Senthilganesh', '9876543234', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliver_pincodes`
--
ALTER TABLE `deliver_pincodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mechanic`
--
ALTER TABLE `mechanic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental_orders`
--
ALTER TABLE `rental_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental_vehicles`
--
ALTER TABLE `rental_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showroom`
--
ALTER TABLE `showroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `used_vehicles`
--
ALTER TABLE `used_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `used_vehicle_orders`
--
ALTER TABLE `used_vehicle_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deliver_pincodes`
--
ALTER TABLE `deliver_pincodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rental_orders`
--
ALTER TABLE `rental_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rental_vehicles`
--
ALTER TABLE `rental_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `showroom`
--
ALTER TABLE `showroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `used_vehicles`
--
ALTER TABLE `used_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `used_vehicle_orders`
--
ALTER TABLE `used_vehicle_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
