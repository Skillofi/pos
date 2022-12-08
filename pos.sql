-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 09:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `email`, `company`, `address`, `city`, `state`, `postal_code`, `country`) VALUES
(1, 'salahuddin shaikh', '1234567890', NULL, NULL, '', '', '', '', ''),
(2, 'sufiyan khan', '1234567891', 'sufiyan.khan@skillofi.com', 'skillofi', 'address', 'city', 'state', 'code', 'country'),
(4, 'mm nn', '8909872425', '', '', '', '', '', '', ''),
(5, 'GPC', '4044907360', '', '', '', '', '', '', ''),
(6, 'zim hooda', '7703748489', 'cellpw@yahoo.com', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `online_setting`
--

CREATE TABLE `online_setting` (
  `id` tinyint(4) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `terms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `online_setting`
--

INSERT INTO `online_setting` (`id`, `fax`, `phone`, `email`, `address`, `terms`) VALUES
(1, '678-403-0362', '404-490-7360', 'info@georgiaphonecase.com', '5226 highway 78 Suit A Stone mountain GA 30087', 'Return & Refund Policy\r\nThanks for shopping with us\r\nIf you are not entirely satisfied with your purchase, we were here to help.\r\n\r\nReturns\r\nYou have 30 calendar days to return an item for exchange only from the date you have purchased.\r\nTo be eligible for a return, your item must be unused and in the same condition that you received it.\r\nYour item must be in the original packaging.\r\nYour item needs to have the receipt or proof of purchase.\r\n\r\nExchange\r\nOnce we receive your item, we will inspect it and notify you that we have received your returned\r\nitem. We will immediately notify you on the status of your exchange after inspecting the item.\r\nYou will receive the Store Credit or Exchange within a certain amount of days, depending on your card issuers policies.\r\n\r\nShipping\r\nYou will be responsible for paying for your own shipping costs for returning your item. Shipping\r\ncosts are nonrefundable.\r\n\r\nCREDIT ACCOUNT POLICY :\r\nAll Sales are subjected to our Terms & Conditions. All parts should be in the original condition in order to claim warranty. New parts\r\nhave a life time warranty. Invoice not payed within the due date are subject to a 3% per month (36% per annum) service charge. if the\r\naccount is placed for collection, an attorney fee and legal cost will be charged. Any dispute relating to products sold or services\r\nprovided shall be subjected to the laws & jurisdiction of the court within GEORGIA .\r\n\r\nRMA POLICY\r\nNO SIGNS OF INSTALLATION/IF ITS BROKEN .LIFE TIME WARRANTY ON ALL IPHONE LCDS\r\n14 WARRANTY OR EXCHANGE ON ACCESSORIES, BLUETOOTH.\r\n\r\nALL SALES ARE FINAL !!!\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_note` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `sales_id`, `amount`, `payment_method`, `payment_note`, `datetime`) VALUES
(12, 17, 10.38, 'Cash', '', '2022-12-02 00:00:00'),
(13, 24, 10, 'Cash', '', '2022-12-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `code`, `price`, `stock`) VALUES
(3, 'qwerty products', 'p11', 10, 1),
(4, 'qwerty products', 'p11', 10, 1),
(5, 'qwerty products', 'p11', 10, 1),
(6, 'qwerty products', 'p11', 10, 1),
(7, 'qwerty products', 'p11', 10, 1),
(8, 'qwerty products', 'p11', 10, 1),
(9, 'qwerty products', 'p11', 10, 1),
(11, 'qwerty products', 'p11', 10, 1),
(12, 'qwerty products', 'p11', 10, 1),
(13, 'hh', '12', 12, 1),
(14, 'new product', 'hh0', 23, 1),
(15, 'tt product', 'tt12', 56, 1),
(16, 'pp 2', 'pp2', 10, 2),
(17, 'LCD repair', '78987', 10, 1),
(18, 'lcd repair', '6546', 35, 1),
(19, 'lcd repair', '654654', 100, 1),
(20, '654546', 'repair', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `retail_setting`
--

CREATE TABLE `retail_setting` (
  `id` tinyint(4) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `terms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `retail_setting`
--

INSERT INTO `retail_setting` (`id`, `fax`, `phone`, `email`, `address`, `terms`) VALUES
(1, 'Cellphone World USA', '404-547-8786', 'info@cellphoneworldusa.com', '5226 Hwy 78, Suit A<br>\r\nStone Mountain Georgia 30087<br>\r\nUSA<br>', 'Any phone sold will be non-refundable. The phone has a 7-day exchange period if the phone is defective it has to be in original condition and packaging phone with water damage or physical ...');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_time` datetime DEFAULT current_timestamp(),
  `reference_no` varchar(255) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `tax` enum('0','6','7') NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT 0,
  `shipping` double NOT NULL DEFAULT 0,
  `grand_total` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `sale_note` text DEFAULT NULL,
  `staff_note` text DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `date_time`, `reference_no`, `warehouse`, `tax`, `discount`, `shipping`, `grand_total`, `status`, `payment_status`, `sale_note`, `staff_note`, `invoice`, `created_at`) VALUES
(4, 1, '2022-11-19 00:00:00', '12', 'Stone Mountain', '6', 1, 2, 23.38, 'Pending', 'Paid', '', '', 'public/invoice/4-invoice.pdf', '2022-11-19 17:49:01'),
(5, 1, '2022-11-09 12:00:00', '123', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', 'public/invoice/5-invoice.pdf', '2022-11-25 16:55:42'),
(6, 2, '2022-12-02 01:59:00', '65', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:29:49'),
(7, 2, '2022-12-02 02:01:00', '24', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:31:38'),
(8, 2, '2022-12-02 02:02:00', '65', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:32:23'),
(9, 2, '2022-12-02 02:02:00', '765', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:32:56'),
(10, 1, '2022-12-02 02:03:00', '2', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:34:09'),
(11, 1, '2022-12-02 02:03:00', '2', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:34:19'),
(12, 2, '2022-12-02 02:04:00', '24', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:35:01'),
(13, 2, '2022-12-02 02:04:00', '24', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:35:08'),
(14, 2, '2022-12-02 02:05:00', '234', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-02 12:35:45'),
(15, 2, '2022-12-02 02:06:00', '', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', 'public/invoice/15-invoice.pdf', '2022-12-02 12:36:37'),
(16, 1, '2022-12-02 02:14:00', '009', 'Stone Mountain', '6', 0, 0, 24.38, 'Pending', 'Pending', '', '', 'public/invoice/16-invoice.pdf', '2022-12-02 12:44:34'),
(17, 2, '2022-12-02 11:48:00', '123', 'Stone Mountain', '6', 0, 0, 24.38, 'Pending', 'Partial', '', '', 'public/invoice/17-invoice.pdf', '2022-12-02 22:20:03'),
(18, 1, '2022-12-03 10:19:00', '', 'Stone Mountain', '6', 5, 0, 5.6, 'Pending', 'Pending', '', '', 'public/invoice/18-invoice.pdf', '2022-12-03 20:49:36'),
(19, 1, '2022-12-03 10:20:00', '', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-03 20:50:22'),
(20, 1, '2022-12-03 10:20:00', '', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-03 20:50:38'),
(21, 1, '2022-12-03 10:20:00', '', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-03 20:51:06'),
(22, 2, '2022-12-03 10:21:00', '', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-03 20:53:08'),
(23, 1, '2022-12-03 10:23:00', '', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Pending', '', '', NULL, '2022-12-03 20:53:21'),
(24, 1, '2022-12-03 10:23:00', '', 'Stone Mountain', '6', 0, 0, 12.72, 'Pending', 'Partial', '', '', 'public/invoice/24-invoice.pdf', '2022-12-03 20:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`id`, `sales_id`, `product_id`, `price`, `qty`, `amount`) VALUES
(4, 4, 14, 23, 1, 23),
(5, 5, 13, 12, 1, 12),
(6, 6, 13, 12, 1, 12),
(7, 7, 13, 12, 1, 12),
(8, 8, 13, 12, 1, 12),
(9, 9, 13, 12, 1, 12),
(10, 10, 13, 12, 1, 12),
(11, 11, 13, 12, 1, 12),
(12, 12, 13, 12, 1, 12),
(13, 13, 13, 12, 1, 12),
(14, 14, 13, 12, 1, 12),
(15, 15, 13, 12, 1, 12),
(16, 16, 14, 23, 1, 23),
(17, 17, 14, 23, 1, 23),
(18, 18, 20, 10, 1, 10),
(19, 19, 13, 12, 1, 12),
(20, 20, 13, 12, 1, 12),
(21, 21, 13, 12, 1, 12),
(22, 22, 13, 12, 1, 12),
(23, 23, 13, 12, 1, 12),
(24, 24, 13, 12, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `system_setting`
--

CREATE TABLE `system_setting` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `system_setting`
--

INSERT INTO `system_setting` (`id`, `title`, `favicon`, `logo`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`) VALUES
(1, 'Georgia Phone Case', 'lms.png', 'logo_1.png', 'host', '23', 'username', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_setting`
--
ALTER TABLE `online_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_setting`
--
ALTER TABLE `retail_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_setting`
--
ALTER TABLE `system_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `online_setting`
--
ALTER TABLE `online_setting`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `retail_setting`
--
ALTER TABLE `retail_setting`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `system_setting`
--
ALTER TABLE `system_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
