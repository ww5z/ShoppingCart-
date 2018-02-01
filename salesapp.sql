-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01 فبراير 2018 الساعة 12:36
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
-- Database: `salesapp`
--

-- --------------------------------------------------------

--
-- بنية الجدول `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='المنتجات';

-- --------------------------------------------------------

--
-- بنية الجدول `taxes`
--

CREATE TABLE `taxes` (
  `id_Taxes` int(11) NOT NULL,
  `NameTaxes` varchar(250) DEFAULT NULL COMMENT 'اسم الضريبة',
  `ratio` double DEFAULT NULL COMMENT 'نسبة الضريبة'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='الضرائب';

-- --------------------------------------------------------

--
-- بنية الجدول `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(250) DEFAULT NULL COMMENT 'اسم العميل',
  `Address` varchar(250) DEFAULT NULL COMMENT 'عنوان العميل',
  `City` varchar(45) DEFAULT NULL COMMENT 'مدينة العميل',
  `PostalCode` varchar(45) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL COMMENT 'المنطقة'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='العملاء';

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
  `customer_id` int(11) DEFAULT NULL COMMENT 'رقم العميل',
  `creation_date` varchar(255) DEFAULT NULL COMMENT 'تاريخ الطلب',
  `order_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='الطلبات';

--
-- إرجاع أو استيراد بيانات الجدول `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `creation_date`, `order_status`) VALUES
(1, 1, NULL, NULL),
(2, 1, '2018-02-01', 'pending'),
(3, 1, '2018-02-01', 'pending'),
(4, 1, '2018-02-01', 'pending'),
(5, 1, '2018-02-01', 'pending');

-- --------------------------------------------------------

--
-- بنية الجدول `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `id_tbl_order_details` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`id_tbl_order_details`, `order_id`, `product_name`, `product_price`, `product_quantity`) VALUES
(1, 2, 'HP Notebook', 299, 1),
(2, 2, 'Ø¨Ø±ØªÙ‚Ø§Ù„', 35.25, 1),
(3, 4, 'Samsung J2 Pro', 100, 1),
(4, 4, 'HP Notebook', 299, 1),
(5, 5, 'Samsung J2 Pro', 100, 1),
(6, 5, 'HP Notebook', 299, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `barcode` varchar(200) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `VAT` double DEFAULT NULL COMMENT 'ضريبة القيمة المضافة'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `barcode`, `name`, `image`, `price`, `VAT`) VALUES
(1, '11', 'Samsung J2 Pro', '1.jpg', '100.00', 0.05),
(2, '22', 'HP Notebook', '2.jpg', '299.00', 0),
(3, '33', 'Panasonic T44 Lite', '3.jpg', '125.50', 0),
(4, '44', 'برتقال', '', '35.25', 0.05),
(5, '55', 'test55', '', '500.00', 0.05);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id_Taxes`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_tbl_order_tbl_customer_idx` (`customer_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`id_tbl_order_details`),
  ADD KEY `fk_tbl_order_details_tbl_order1_idx` (`order_id`);

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id_Taxes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id_tbl_order_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `fk_tbl_order_tbl_customer` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`CustomerID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- القيود للجدول `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `fk_tbl_order_details_tbl_order1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
