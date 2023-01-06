-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2023 at 12:26 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `role` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `role`, `email`, `password`, `status`, `date_created`) VALUES
(1, 'Sanjay', 'Super Admin', 'sanjay3412@gamil.com', 'Sanjay56@199', 1, '2022-12-12 05:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `batteries`
--

CREATE TABLE `batteries` (
  `id` int(11) NOT NULL,
  `brand` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `warranty` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `delivery_charges` text DEFAULT NULL,
  `fitting_charges` text DEFAULT NULL,
  `actual_price` text DEFAULT NULL,
  `final_price` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batteries`
--

INSERT INTO `batteries` (`id`, `brand`, `type`, `warranty`, `amount`, `delivery_charges`, `fitting_charges`, `actual_price`, `final_price`, `status`) VALUES
(1, 'Excel', 'Self start', '2', '1500', '50', '100', '1699', '1400', 1);

-- --------------------------------------------------------

--
-- Table structure for table `battery_bookings`
--

CREATE TABLE `battery_bookings` (
  `id` int(11) NOT NULL,
  `bike_name` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `product_id` int(11) DEFAULT 0,
  `name` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `size` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `battery_bookings`
--

INSERT INTO `battery_bookings` (`id`, `bike_name`, `type`, `product_id`, `name`, `price`, `size`) VALUES
(1, 'Duke 200', 'Self start', 1, 'Excel', '1426', '10');

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `id` int(11) NOT NULL,
  `bike_name` text DEFAULT NULL,
  `brand` text DEFAULT NULL,
  `cc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`id`, `bike_name`, `brand`, `cc`) VALUES
(1, 'Pulasar NS 160', 'Bajaj', '150 CC'),
(2, 'Yamaha R15 V4M', 'Yamaha', '200 CC');

-- --------------------------------------------------------

--
-- Table structure for table `bike_product_size`
--

CREATE TABLE `bike_product_size` (
  `id` int(11) NOT NULL,
  `bike_id` int(11) DEFAULT 0,
  `type` text DEFAULT NULL,
  `size` int(200) DEFAULT 0,
  `wheel` text DEFAULT NULL,
  `tyre_type` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bike_product_size`
--

INSERT INTO `bike_product_size` (`id`, `bike_id`, `type`, `size`, `wheel`, `tyre_type`, `status`) VALUES
(1, 2, 'Puncture', 90, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bike_services`
--

CREATE TABLE `bike_services` (
  `id` int(11) NOT NULL,
  `bike_id` int(11) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `price` text DEFAULT '0',
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bike_services`
--

INSERT INTO `bike_services` (`id`, `bike_id`, `type`, `price`, `status`) VALUES
(1, 1, 'General', '600', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booked_services`
--

CREATE TABLE `booked_services` (
  `id` int(11) NOT NULL,
  `bike_name` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `type` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booked_services`
--

INSERT INTO `booked_services` (`id`, `bike_name`, `date`, `time`, `type`, `price`, `status`) VALUES
(1, 'Yamaha R15 v3', '2022-11-25', '10:26:00', 'Emergency', '', 0),
(2, 'Pulsar NS160', '2022-01-12', '09:45:20', 'General', '1500', 0);

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
(4, 'Rods', 'upload/images/1659123088.7927.jpg', 1, '2022-12-13 06:13:22', '2022-07-29 18:18:36'),
(5, 'others', NULL, 1, '2022-12-13 05:57:28', '2022-12-13 05:57:02');

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
  `model` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `ratings` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `brand`, `model`, `price`, `description`, `image`, `ratings`) VALUES
(1, 5, 'Engine Oil', 'Racer', '', '', 'one of the best brand used by 1000+ customers', 'upload/products/1659114493.4682.jpg', 4.3333),
(6, 2, 'Handle Miror', 'jace', NULL, NULL, 'cdsce', 'upload/products/1659119349.1368.jpg', NULL),
(8, 3, 'Front tyre', 'MRF', 'Splender', '600', 'It is one of the best brand', 'upload/products/2225-2022-07-30.jpg', NULL);

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
-- Table structure for table `puncture_services`
--

CREATE TABLE `puncture_services` (
  `id` int(11) NOT NULL,
  `bike_id` int(11) DEFAULT NULL,
  `tyre_type` text DEFAULT NULL,
  `wheel` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `puncture_services`
--

INSERT INTO `puncture_services` (`id`, `bike_id`, `tyre_type`, `wheel`, `price`, `status`) VALUES
(1, 2, 'Tubeless-tyre', 'Rear', '1450', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `ratings` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `ratings`) VALUES
(1, 1, 1, 5),
(2, 1, 1, 5),
(3, 1, 1, 5),
(4, 1, 1, 5),
(5, 1, 1, 3),
(6, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id` int(11) NOT NULL,
  `vehicle_group` text DEFAULT NULL,
  `model` text DEFAULT NULL,
  `year_of_manufacture` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id`, `vehicle_group`, `model`, `year_of_manufacture`) VALUES
(1, 'Bajaj', 'Pulsar 150', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `rental_category`
--

CREATE TABLE `rental_category` (
  `id` int(11) NOT NULL,
  `brand` text DEFAULT NULL,
  `bike_name` text DEFAULT NULL,
  `cc` text DEFAULT NULL,
  `hills_price` text DEFAULT NULL,
  `normal_price` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rental_category`
--

INSERT INTO `rental_category` (`id`, `brand`, `bike_name`, `cc`, `hills_price`, `normal_price`) VALUES
(1, 'KTM', 'Duke 200', '160', '450', '600'),
(2, 'Hero Honda', 'Delux', '350', '200', '160');

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
-- Table structure for table `rental_showrooms`
--

CREATE TABLE `rental_showrooms` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rental_showrooms`
--

INSERT INTO `rental_showrooms` (`id`, `name`, `email`, `mobile`, `password`, `location`, `status`) VALUES
(1, 'sivam Rentals', 'sivamrent32@gmail.com', '9876543210', 'sivamrent@098', 'Thiruvanamalai', 0),
(2, 'test', 'example@gmail.com', '9876543234', 'jk123', 'Coimbatore', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rental_vehicles`
--

CREATE TABLE `rental_vehicles` (
  `id` int(11) NOT NULL,
  `rental_category_id` int(11) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rental_vehicles`
--

INSERT INTO `rental_vehicles` (`id`, `rental_category_id`, `pincode`, `image`, `status`) VALUES
(1, 2, '675894', 'upload/rentals/1663736961.0766.jpg', 1);

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
-- Table structure for table `showrooms`
--

CREATE TABLE `showrooms` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `showrooms`
--

INSERT INTO `showrooms` (`id`, `store_name`, `email_id`, `mobile`, `password`, `address`, `brand`, `latitude`, `longitude`) VALUES
(1, 'Hyundai', 'hyundai@gmail.com', '32535436', '34643636', '23242424', '3636346346', '4364363', '346346'),
(4, 'dfdf', 'fdfd', '1234', '234', NULL, NULL, NULL, NULL);

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
-- Table structure for table `tyreproduct_bookings`
--

CREATE TABLE `tyreproduct_bookings` (
  `id` int(11) NOT NULL,
  `bike_name` text DEFAULT NULL,
  `tyre_type` text DEFAULT NULL,
  `wheel` text DEFAULT NULL,
  `product_id` int(11) DEFAULT 0,
  `price` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tyreproduct_bookings`
--

INSERT INTO `tyreproduct_bookings` (`id`, `bike_name`, `tyre_type`, `wheel`, `product_id`, `price`, `name`, `size`, `status`) VALUES
(1, 'Hero Honda', 'Tube tyre', 'Front', 1, '1200', 'Miechlin', '24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tyrepuncture_bookings`
--

CREATE TABLE `tyrepuncture_bookings` (
  `id` int(11) NOT NULL,
  `bike_name` text DEFAULT NULL,
  `tyre_type` text DEFAULT NULL,
  `wheel` text DEFAULT NULL,
  `price` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tyrepuncture_bookings`
--

INSERT INTO `tyrepuncture_bookings` (`id`, `bike_name`, `tyre_type`, `wheel`, `price`) VALUES
(1, 'TVS', 'Tube-tyre', 'Front', '449');

-- --------------------------------------------------------

--
-- Table structure for table `tyre_products`
--

CREATE TABLE `tyre_products` (
  `id` int(11) NOT NULL,
  `brand` text DEFAULT NULL,
  `size` int(200) DEFAULT 0,
  `wheel` text DEFAULT NULL,
  `pattern` text DEFAULT NULL,
  `tyre_type` text DEFAULT NULL,
  `amount` int(200) DEFAULT 0,
  `delivery_charges` int(200) DEFAULT 0,
  `fitting_charges` int(200) DEFAULT 0,
  `actual_price` int(200) DEFAULT 0,
  `final_price` int(200) DEFAULT 0,
  `image` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tyre_products`
--

INSERT INTO `tyre_products` (`id`, `brand`, `size`, `wheel`, `pattern`, `tyre_type`, `amount`, `delivery_charges`, `fitting_charges`, `actual_price`, `final_price`, `image`, `status`) VALUES
(1, 'CEAT', 25, 'Front tyre', 'S-pattern', 'Tube', 5000, 50, 200, 5000, 2699, 'upload/images/9181-2022-12-13.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `used_vehicles`
--

CREATE TABLE `used_vehicles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `brand` text DEFAULT NULL,
  `bike_name` text NOT NULL,
  `model` text DEFAULT NULL,
  `km_driven` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `used_vehicles`
--

INSERT INTO `used_vehicles` (`id`, `user_id`, `brand`, `bike_name`, `model`, `km_driven`, `price`, `location`, `image`, `color`) VALUES
(1, 2, 'Yamaha', 'R15 V3M', '2022', '5000', '222000', 'Kattur,Trichy', '1670921154.1206.jpg', 'blue');

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batteries`
--
ALTER TABLE `batteries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `battery_bookings`
--
ALTER TABLE `battery_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bike_product_size`
--
ALTER TABLE `bike_product_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bike_services`
--
ALTER TABLE `bike_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_services`
--
ALTER TABLE `booked_services`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `puncture_services`
--
ALTER TABLE `puncture_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental_category`
--
ALTER TABLE `rental_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental_orders`
--
ALTER TABLE `rental_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rental_showrooms`
--
ALTER TABLE `rental_showrooms`
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
-- Indexes for table `showrooms`
--
ALTER TABLE `showrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tyreproduct_bookings`
--
ALTER TABLE `tyreproduct_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tyrepuncture_bookings`
--
ALTER TABLE `tyrepuncture_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tyre_products`
--
ALTER TABLE `tyre_products`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batteries`
--
ALTER TABLE `batteries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `battery_bookings`
--
ALTER TABLE `battery_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bike_product_size`
--
ALTER TABLE `bike_product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bike_services`
--
ALTER TABLE `bike_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booked_services`
--
ALTER TABLE `booked_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `puncture_services`
--
ALTER TABLE `puncture_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rental_category`
--
ALTER TABLE `rental_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rental_orders`
--
ALTER TABLE `rental_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rental_showrooms`
--
ALTER TABLE `rental_showrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rental_vehicles`
--
ALTER TABLE `rental_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `showrooms`
--
ALTER TABLE `showrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tyreproduct_bookings`
--
ALTER TABLE `tyreproduct_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tyrepuncture_bookings`
--
ALTER TABLE `tyrepuncture_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tyre_products`
--
ALTER TABLE `tyre_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
