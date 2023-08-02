-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 09:14 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `RegisterDefault` (`p_username` CHAR, `p_email` CHAR, `p_phoneNumber` CHAR, `p_password` CHAR, `p_gender` INT, `p_dob` DATE)   BEGIN
	DECLARE account_count INT;
    DECLARE account_id INT;
    
    SELECT COUNT(*) INTO account_count
    FROM accounts 
    WHERE Username = Username OR Email = Email OR PhoneNumber = PhoneNumber;
    IF account_count = 0 THEN
    	INSERT INTO accounts (Username, Email, PhoneNumber, Password) VALUES (p_username, p_email, p_phoneNumber, p_password);
        SET account_id = LAST_INSERT_ID();
        INSERT INTO accountroles (AccountId, RoleId) VALUES(account_id, 3);
        INSERT INTO users (AccountId, Username, Fullname, Email, PhoneNumber, Gender, DOB)
        SELECT Id, Username, Username, Email, PhoneNumber, p_gender, p_DOB
        FROM accounts WHERE Id = account_id;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accountroles`
--

CREATE TABLE `accountroles` (
  `Id` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accountroles`
--

INSERT INTO `accountroles` (`Id`, `AccountId`, `RoleId`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Id` int(11) NOT NULL,
  `Username` char(50) NOT NULL,
  `Email` char(100) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `Password` char(50) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastModifiedDate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Id`, `Username`, `Email`, `PhoneNumber`, `Password`, `CreatedDate`, `LastModifiedDate`) VALUES
(1, 'admin', 'admin@gmail.com', 999000001, 'sPKZoFiMuz', '2023-08-02 18:50:18', '2023-08-03 01:50:18'),
(2, 'employeeA', 'employeeA@gmail.com', 999000002, 'QxfhhY6d2i', '2023-08-02 18:50:18', '2023-08-03 01:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `IsChoice` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `ParentCategoryId` int(11) DEFAULT NULL,
  `Node` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `TotalPayment` double DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL,
  `ShippingFee` double DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productcomments`
--

CREATE TABLE `productcomments` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Avatar` text NOT NULL,
  `Fullname` varchar(150) NOT NULL,
  `Rank` int(11) NOT NULL,
  `Comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productlabels`
--

CREATE TABLE `productlabels` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productproperties`
--

CREATE TABLE `productproperties` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Value` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` double DEFAULT NULL,
  `Discount` double DEFAULT NULL,
  `Rank` char(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Id` int(11) NOT NULL,
  `Name` char(255) NOT NULL,
  `NormalizedName` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Id`, `Name`, `NormalizedName`) VALUES
(1, 'role_admin', 'ROLE_ADMIN'),
(2, 'role_employee', 'ROLE_EMPLOYEE'),
(3, 'role_user', 'ROLE_USER');

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE `specifications` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `Username` char(50) NOT NULL,
  `Fullname` varchar(150) NOT NULL,
  `Email` char(100) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Avatar` text DEFAULT NULL,
  `Cover` text DEFAULT NULL,
  `Bio` varchar(100) DEFAULT NULL,
  `Gender` int(11) NOT NULL,
  `DOB` date DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastModifiedDate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `AccountId`, `Username`, `Fullname`, `Email`, `PhoneNumber`, `Address`, `Avatar`, `Cover`, `Bio`, `Gender`, `DOB`, `CreatedDate`, `LastModifiedDate`) VALUES
(1, 1, 'admin', 'admin', 'admin@gmail.com', 999000001, NULL, NULL, NULL, NULL, 0, '1981-08-13', '2023-08-02 18:54:25', '2023-08-03 01:54:25'),
(2, 2, 'employeeA', 'employeeA', 'employeeA@gmail.com', 999000002, NULL, NULL, NULL, NULL, 0, '1992-08-17', '2023-08-02 18:54:25', '2023-08-03 01:54:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountroles`
--
ALTER TABLE `accountroles`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AccountId` (`AccountId`),
  ADD KEY `RoleId` (`RoleId`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ParentCategoryId` (`ParentCategoryId`);

--
-- Indexes for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `productcomments`
--
ALTER TABLE `productcomments`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `productlabels`
--
ALTER TABLE `productlabels`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `productproperties`
--
ALTER TABLE `productproperties`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `AccountId` (`AccountId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountroles`
--
ALTER TABLE `accountroles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productcomments`
--
ALTER TABLE `productcomments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productlabels`
--
ALTER TABLE `productlabels`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productproperties`
--
ALTER TABLE `productproperties`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountroles`
--
ALTER TABLE `accountroles`
  ADD CONSTRAINT `accountroles_ibfk_1` FOREIGN KEY (`AccountId`) REFERENCES `accounts` (`Id`),
  ADD CONSTRAINT `accountroles_ibfk_2` FOREIGN KEY (`RoleId`) REFERENCES `roles` (`Id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`ParentCategoryId`) REFERENCES `categories` (`Id`);

--
-- Constraints for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD CONSTRAINT `orderproducts_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`),
  ADD CONSTRAINT `orderproducts_ibfk_2` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`Id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);

--
-- Constraints for table `productcomments`
--
ALTER TABLE `productcomments`
  ADD CONSTRAINT `productcomments_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`),
  ADD CONSTRAINT `productcomments_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);

--
-- Constraints for table `productlabels`
--
ALTER TABLE `productlabels`
  ADD CONSTRAINT `productlabels_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`);

--
-- Constraints for table `productproperties`
--
ALTER TABLE `productproperties`
  ADD CONSTRAINT `productproperties_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `categories` (`Id`);

--
-- Constraints for table `specifications`
--
ALTER TABLE `specifications`
  ADD CONSTRAINT `specifications_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`AccountId`) REFERENCES `accounts` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
