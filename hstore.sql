-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 09, 2024 at 02:53 PM
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
-- Database: `hstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `CartItemID` int(11) NOT NULL,
  `CartID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `Name`, `Description`) VALUES
(1, 'Electronics', 'Electronic devices such as smart devices, and related products.'),
(2, 'Appliances', 'Home appliances including refrigerators, dryers, heaters, and air conditioners.'),
(3, 'Kitchen Gadgets', 'Small kitchen appliances like coffee makers, air fryers, and other culinary tools.'),
(4, 'television', 'A ubiquitous electronic device that broadcasts audiovisual content, serving as a primary source of entertainment, news, and information for viewers worldwide.');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `CheckoutID` int(11) NOT NULL,
  `CartID` int(11) DEFAULT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `CheckoutDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `DiscountID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `PercentageOff` decimal(5,2) NOT NULL,
  `ValidFrom` date DEFAULT NULL,
  `ValidTo` date DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `CartID` int(11) DEFAULT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `CheckoutDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `OriginalPrice` decimal(10,2) NOT NULL,
  `Discount` int(11) DEFAULT NULL,
  `Picture` varchar(45) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `Stock` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `Brand` varchar(100) DEFAULT NULL,
  `Origin` varchar(100) DEFAULT NULL,
  `Display` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Price`, `OriginalPrice`, `Discount`, `Picture`, `CategoryID`, `Stock`, `Description`, `Brand`, `Origin`, `Display`) VALUES
(1, 'Samsung, 65 inch QLED screen, ultra clear, smart, 100Hz,QA65Q70CAUXSA', 2500.00, 2500.00, NULL, '/project/images/samsungtv.jpg', 1, 20, NULL, NULL, NULL, NULL),
(2, 'Skyworth 50 Inch QLED Ultra HD 4K (HDR 10+) Smart Google Tv 50SUE9520', 1500.00, 3000.00, 50, '/project/images/tvv.png', 1, 30, 'A 50 inch QLED Ultra HD 4K Smart Google TV offering HDR 10+ support.', NULL, NULL, NULL),
(3, 'General Supreme Oil Electric Heater, 13 Fins, 2800 Watt Distribution Fan GSHO13FM', 225.00, 499.00, 45, '/project/images/od.png', 2, 75, 'An oil electric heater with 13 fins and 2800 Watt power for efficient heating.', NULL, NULL, NULL),
(4, 'General Supreme 80*60CM, 5 Burners Gas Cooker, Full Safety, Steel GS8650FS', 1399.00, 1589.00, 12, '/project/images/ovenhp.png', 2, 40, 'A large 80*60 cm gas cooker with 5 burners and full safety features.', NULL, NULL, NULL),
(5, 'General Supreme Air Fryer 4L, Digital, 1500 Watts, Black, GSAF476BM', 199.00, 379.00, 47, '/project/images/oilp.png', 3, 100, 'A 4-liter digital air fryer with 1500 Watts power in a sleek black design.', NULL, NULL, NULL),
(6, 'General Supreme Single Door Showcase Refrigerator (92 Ltrs), Black GS132', 799.00, 1699.00, 53, '/project/images/door.png', 2, 60, 'A compact single-door showcase refrigerator with a 92-liter capacity.', NULL, NULL, NULL),
(7, 'Hitachi Refrigerator Top mount 2 doors (510 Ltrs, 18.0 Cu.Ft) Inverter White R-V660PS7KTWH', 3229.00, 4529.00, 29, '/project/images/frudhi.png', 2, 25, 'A large two-door top-mount refrigerator with 510 liters capacity and inverter technology.', NULL, NULL, NULL),
(8, 'General Supreme Coffee Maker, 0.75 Liter Capacity, Rapid Heating System, 650 Watts Black, GSDC03', 69.00, 120.00, 47, '/project/images/cofmake.png', 3, 80, 'A rapid heating coffee maker with a 0.75-liter capacity and 650 watts power.', NULL, NULL, NULL),
(18, 'Skyworth 50 Inch OLED Ultra HD 4K (HDR 10+) Smart Google Tv 50SUE9520', 1500.00, 3000.00, 50, '/project/images/tvv.png', 4, 15, '50-inch OLED display with Ultra HD 4K resolution, HDR 10+ support, and integrated smart Google TV features.', 'SKYWORTH', 'China', 'OLED'),
(19, 'TCL 58 Smart LED TV Inch UHD 4K (HDR10) Google Tv,58T635', 1599.00, 0.00, NULL, '/project/images/Tcltv.jpg', 4, 20, 'TCL 58-inch UHD 4K smart LED TV featuring HDR10 and Google TV for enhanced picture quality and smart viewing options.', 'TCL', 'China', 'LED'),
(20, 'LG 43-inch, Ultra HD, Smart ThinQ AI, 60 Hz, 43UQ70006LB', 1499.00, 2499.00, 40, '/project/images/LGtv.jpg', 4, 25, 'Compact 43-inch LG Ultra HD TV with Smart ThinQ AI technology and a refresh rate of 60 Hz, ideal for various home entertainment scenarios.', 'LG', 'Korea', 'LCD'),
(21, 'General Supreme 50 inch, Ultra HD (4K-UHD), Smart TV, WebOS, Magic Remote, GS50WOST', 1399.00, 2899.00, 52, '/project/images/suprmetv.jpg', 4, 30, '50 inch General Supreme Ultra HD TV with Smart WebOS interface and Magic Remote included for easy navigation.', 'Supreme', 'China', 'LCD'),
(22, 'Samsung 65-inch OLED screen, UHD 4K, smart, 120 Hz, QA65S90CAUXSA', 7999.00, 20999.00, 62, '/project/images/samsungtv2.jpg', 4, 8, 'Premium Samsung 65-inch OLED TV with UHD 4K resolution, smart capabilities, and a high 120 Hz refresh rate for ultimate performance.', 'SAMSUNG', 'Korea', 'OLED\r\n'),
(23, 'LG 77 inch OLED TV, WebOS Smart, 120Hz, QA65S90CAUXSA', 9999.00, 0.00, NULL, '/project/images/LGtv2.jpg', 4, 5, 'Large 77-inch LG OLED TV with WebOS, smart features, and a smooth 120Hz refresh rate for superior viewing quality.', 'LG', 'Korea', 'OLED'),
(24, 'Skyworth 75 inch mini LED screen, smart Google TV, 120 Hz, 75SUF9660', 5299.00, 0.00, NULL, '/project/images/skyworthtv2.jpg', 4, 12, 'Skyworth 75 inch mini LED TV featuring smart Google TV technology and a high refresh rate of 120 Hz for excellent motion clarity.', 'SKYWORTH', 'China', 'LED'),
(25, 'General Supreme Dryer Front Load 8 KG, Condenser, Dark Steel GS807SS', 1629.00, 2000.00, 37, '/project/images/dryy.png', 2, 50, 'A high-efficiency dryer with 8 KG capacity and condenser technology.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `Address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`CartItemID`),
  ADD KEY `CartID` (`CartID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`CheckoutID`),
  ADD KEY `CartID` (`CartID`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`DiscountID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CartID` (`CartID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `CartItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `CheckoutID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `DiscountID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`),
  ADD CONSTRAINT `cartitem_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
