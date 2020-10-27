-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2017 at 10:08 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mfors`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'murja', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_made` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `customer_name`, `contact_number`, `address`, `email`, `total`, `status`, `date_made`) VALUES
(13, 'Wada', '08065463632', 'Wadagailcom', 'gg@gmail.com', '700', 'pending', '2016-12-31 15:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `customer_name`, `subject`, `email`, `message`) VALUES
(1, 'Adam Abdulrahman', 'Late Delivery', 'abdulflezy13@yahoo.com', 'Please ensure that your delivery guys deliver the meals at the required time because they are often late.'),
(2, 'Zainab Adamu', 'Late Delivery', 'Zee@yahoo.com', 'I need an email of the GM if possible');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_category` varchar(255) NOT NULL,
  `food_price` varchar(255) NOT NULL,
  `food_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `food_name`, `food_category`, `food_price`, `food_description`) VALUES
(1, 'spicyburger', 'lunch', '50.00', 'Vestibulum tortor quam feugiat vitae ultricies eget tempor sit amet ante Donec eu libero sit amet quam egestas semper Aenean ultricies mi vitae est Mauris placerat eleifend leo Quisque sit amet est et sapien ullamcorper pharetra Vestibulum erat wisi condimentum sed commodo vitae'),
(2, 'snailchoc', 'breakfast', '50.00', 'Vestibulum tortor quam feugiat vitae ultricies eget tempor sit amet ante Donec eu libero sit amet quam egestas semper Aenean ultricies mi vitae est Mauris placerat eleifend leo Quisque sit amet est et sapien ullamcorper pharetra Vestibulum erat wisi condimentum sed commodo vitae'),
(3, 'salad', 'lunch', '50.00', 'Vestibulum tortor quam feugiat vitae ultricies eget tempor sit amet ante Donec eu libero sit amet quam egestas semper Aenean ultricies mi vitae est Mauris placerat eleifend leo Quisque sit amet est et sapien ullamcorper pharetra Vestibulum erat wisi condimentum sed commodo vitae'),
(4, 'pizza', 'lunch', '350.00', 'Vestibulum tortor quam feugiat vitae ultricies eget tempor sit amet ante Donec eu libero sit amet quam egestas semper Aenean ultricies mi vitae est Mauris placerat eleifend leo Quisque sit amet est et sapien ullamcorper pharetra Vestibulum erat wisi condimentum sed commodo vitae'),
(5, 'shawarma', 'breakfast', '350.00', 'Vestibulum tortor quam feugiat vitae ultricies eget tempor sit amet ante Donec eu libero sit amet quam egestas semper Aenean ultricies mi vitae est Mauris placerat eleifend leo Quisque sit amet est et sapien ullamcorper pharetra Vestibulum erat wisi condimentum sed commodo vitae'),
(6, 'Rice', 'lunch', '50.00', 'This is a tasty meal i bet you dont want miss enjoying the yummy taste'),
(7, 'Jellyfish', 'dinner', '400', 'Try this delicay and i promise you will keep coming back for more'),
(8, 'Ice Cream', 'special', '4000', 'desc'),
(9, 'Pounded Yam', 'dinner', '800', 'This is one of our best meal and it is prepared deliciously for you'),
(10, 'Eba and Vegetable', 'dinner', '600', 'This is a very nice combination'),
(11, 'Somovita and Egusi soup', 'breakfast', '800', 'Semovita is one of the delicacies you definitely want to try for breakfast');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `food` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `order_id`, `food`, `qty`) VALUES
(1, '13', 'pizza', '2');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `reserve_id` int(11) NOT NULL,
  `no_of_guest` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `date_res` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `suggestions` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reserve_id`, `no_of_guest`, `email`, `phone`, `date_res`, `time`, `suggestions`) VALUES
(1, '2', 'abdulflezy13@yahoo.com', '09087676543', '2016-12-14', '15:00', 'suggestions suggestions suggestions'),
(2, '2', 'abdulflezy13@ymail.com', '09087676546', '2016-12-30', '18:00', 'suggestions suggestions suggestions');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserve_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
