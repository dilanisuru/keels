-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 08:31 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keelss`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyproducts`
--

CREATE TABLE `buyproducts` (
  `ID` int(11) NOT NULL,
  `itemName` varchar(200) NOT NULL,
  `Qty` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyproducts`
--

INSERT INTO `buyproducts` (`ID`, `itemName`, `Qty`) VALUES
(1, 'Papaya', '50Kg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `ID` int(11) NOT NULL,
  `userID` varchar(200) NOT NULL,
  `sendersName` varchar(200) NOT NULL,
  `Message` varchar(200) NOT NULL,
  `Tags` varchar(200) NOT NULL,
  `reply` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`ID`, `userID`, `sendersName`, `Message`, `Tags`, `reply`) VALUES
(1, '1', 'Name1', 'im buy now papaya', 'Papaya_2', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `userID` varchar(200) NOT NULL,
  `farmerName` varchar(200) NOT NULL,
  `farmerAddress` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Type` varchar(200) NOT NULL,
  `itemName` varchar(200) NOT NULL,
  `Qty` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `contactNumber` varchar(200) NOT NULL,
  `report` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `status` varchar(200) NOT NULL,
  `flag` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `userID`, `farmerName`, `farmerAddress`, `City`, `Type`, `itemName`, `Qty`, `price`, `contactNumber`, `report`, `image`, `status`, `flag`) VALUES
(2, '1', 'Damith Harshana', '123/B , Temple ROad , Homagama.', 'Colombo', 'Fruit', 'Papaya', '50Kg', '3000.00', '07189741632', 'I have papaya 50Kg for sale. 1Kg is only 60.00LKR. please contact me', 'https://firebasestorage.googleapis.com/v0/b/images-9f28a.appspot.com/o/papaya1.jpg?alt=media&token=b2430c4b-ac8a-4555-a48a-9c8315ae949a', 'Accepted', '1'),
(3, '1', 'Damith Harshana', '123/B , Temple ROad , Homagama.', 'Colombo', 'Fruit', 'Mango', '5Kg', '650.00', '07189741632', 'I have mango. 1Kg is only 60.00LKR. please contact me', 'https://firebasestorage.googleapis.com/v0/b/images-9f28a.appspot.com/o/istockphoto-1008183290-612x612.jpg?alt=media&token=9e4dc8aa-bf1c-4029-926d-097c6f1d041e', 'Accepted', '2'),
(4, '1', 'Damith Harshana', '123/B , Temple ROad , Homagama.', 'Colombo', 'Fruit', 'BAnana', '5Kg', '80.00', '07189741632', 'I have banana. 1Kg is for 80 LKR only', 'https://firebasestorage.googleapis.com/v0/b/images-9f28a.appspot.com/o/intro-1596497583.jpg?alt=media&token=4e74aa66-df02-4bdc-bcdf-7aa7b29d5675', 'Accepted', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Username` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Address`, `Username`, `Password`, `Type`) VALUES
(1, 'Name1', 'Address1', 'NIC', 'n.456', 'farmer'),
(2, 'Name1', 'Address1', 'nic', 'n.456', 'farmer'),
(3, 'Name1', 'Address1', 'nic', 'n.456', 'farmer'),
(4, 'Name1', 'Address1', 'awd', 'a.456', 'farmer'),
(5, 'Keels1', 'Colombo', 'keels1', 'k.456', 'Keels'),
(6, 'Name1', 'ergtheergwrg', 'keels1', 'dd', 'Keels'),
(7, 'Name1', 'ergtheergwrg', 'd', 'd', 'DoA'),
(8, 'f', 'f', 'f', 'f', 'farmer');

-- --------------------------------------------------------

--
-- Table structure for table `wasteditems`
--

CREATE TABLE `wasteditems` (
  `ID` int(11) NOT NULL,
  `ItemName` varchar(200) NOT NULL,
  `Qty` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wasteditems`
--

INSERT INTO `wasteditems` (`ID`, `ItemName`, `Qty`) VALUES
(1, 'Papaya', '25Kg'),
(2, ' Papaya', '25Kg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyproducts`
--
ALTER TABLE `buyproducts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wasteditems`
--
ALTER TABLE `wasteditems`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyproducts`
--
ALTER TABLE `buyproducts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wasteditems`
--
ALTER TABLE `wasteditems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
