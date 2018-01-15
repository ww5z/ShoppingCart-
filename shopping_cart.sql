-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15 يناير 2018 الساعة 14:30
-- إصدار الخادم: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- بنية الجدول `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_price` varchar(30) NOT NULL,
  `product_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_image`) VALUES
(1, 1, 'ASUS Laptop 1500', '799.00', 'asus-laptop.jpg'),
(2, 1, 'Microsoft Surface Pro 3', '898.00', 'surface-pro.jpg'),
(3, 1, 'Samsung EVO 32GB', '12.00', 'samsung-sd-card.jpg'),
(4, 1, 'Desktop Hard Drive', '50.00', 'computer-hard-disk.jpg'),
(5, 1, 'External Hard Drive', '80.00', 'external-hard-disk.jpg'),
(6, 2, 'Crock-Pot Oval Slow Cooker', '34.00', 'crok-pot-cooker.jpg'),
(7, 2, 'Magic Blender System', '80.00', 'blender.jpg'),
(8, 2, 'Cordless Hand Vacuum', '40.00', 'vaccum-cleaner.jpg'),
(9, 2, 'Dishwasher Detergent', '15.00', 'detergent-powder.jpg'),
(10, 2, 'Essential Oil Diffuser', '20.00', 'unpower-difuser.jpg'),
(11, 3, 'Medical Personalized', '11.00', 'hand-bag.jpg'),
(12, 3, 'Best Bridle Leather Belt', '64.00', 'mens-belt.jpg'),
(13, 3, 'HANDMADE Bow set', '24.00', 'pastal-colors.jpg'),
(14, 3, 'Ceramic Coffee Mug', '18.00', 'coffee-mug.jpg'),
(15, 3, 'Wine Birthday Glass', '18.00', 'wine-glass.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PostalCode` varchar(200) NOT NULL,
  `Country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `tbl_customer`
--

INSERT INTO `tbl_customer` (`CustomerID`, `CustomerName`, `Address`, `City`, `PostalCode`, `Country`) VALUES
(1, 'AbuOmar', 'Address', 'City', '11', 'Country');

-- --------------------------------------------------------

--
-- بنية الجدول `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `creation_date` varchar(200) NOT NULL,
  `order_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `creation_date`, `order_status`) VALUES
(1, 1, '2018-01-15', 'pending'),
(2, 1, '2018-01-15', 'pending'),
(3, 1, '2018-01-15', 'pending'),
(4, 1, '2018-01-15', 'pending'),
(5, 1, '2018-01-15', 'pending'),
(6, 1, '2018-01-15', 'pending');

-- --------------------------------------------------------

--
-- بنية الجدول `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `id_tbl_order_details` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_price` varchar(200) NOT NULL,
  `product_quantity` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`id_tbl_order_details`, `order_id`, `product_name`, `product_price`, `product_quantity`) VALUES
(12, 5, 'Samsung J2 Pro', '100.00', '1'),
(13, 5, 'HP Notebook', '299.00', '1'),
(14, 5, 'Panasonic T44 Lite', '125.00', '2'),
(15, 6, 'Samsung J2 Pro', '100.00', '2'),
(16, 6, 'HP Notebook', '299.00', '99');

-- --------------------------------------------------------

--
-- بنية الجدول `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `barcode` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `barcode`, `name`, `image`, `price`) VALUES
(1, 11, 'Samsung J2 Pro', '1.jpg', 100.00),
(2, 22, 'HP Notebook', '2.jpg', 299.00),
(3, 33, 'Panasonic T44 Lite', '3.jpg', 125.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`id_tbl_order_details`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id_tbl_order_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
