-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2023 at 03:34 PM
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
-- Database: `ecommerce_v1`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateOrder` (IN `param1` INT, IN `param2` VARCHAR(150), IN `param3` VARCHAR(255), IN `param4` INT, IN `param5` DOUBLE)   BEGIN
    DECLARE order_id INT;
	DECLARE product_count INT;
    DECLARE total_payment DOUBLE;
    DECLARE total_price DOUBLE;
    
    SELECT COUNT(*) INTO product_count
    FROM carts WHERE UserId = param1;
    IF product_count > 0 THEN
    	-- Tìm tổng giá tiền toàn bộ đơn hàng
    	SELECT SUM(products.Discount * carts.Quantity) INTO total_price
        FROM carts
        JOIN products ON carts.ProductId = products.Id
        WHERE carts.UserId = param1;
    
        -- Tạo đơn hàng trong bảng orders
        INSERT INTO orders (UserId, Status, Fullname, Address, PhoneNumber, TotalPayment, TotalPrice, ShippingFee)
        VALUES (param1, 0, param2, param3, param4, param5 + total_price, total_price, param5);

        SET order_id = LAST_INSERT_ID();

        -- Thêm các sản phẩm từ giỏ hàng vào bảng orderproducts
        INSERT INTO orderproducts (OrderId, ProductId, Quantity)
        SELECT order_id, ProductId, Quantity
        FROM carts
        WHERE UserId = param1;

        -- Xóa các sản phẩm từ giỏ hàng sau khi thêm vào đơn hàng
        DELETE FROM carts
        WHERE UserId = param1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteOrder` (IN `param1` INT)   BEGIN
    -- Xóa các bản ghi trong bảng OrderProducts liên quan đến orderId
    DELETE FROM orderproducts WHERE OrderId = param1;

    -- Xóa bản ghi trong bảng Orders có orderId tương ứng
    DELETE FROM Orders WHERE Id = param1;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUser` (IN `param1` INT)   BEGIN
	DECLARE order_count INT;
    
    SELECT COUNT(*) INTO order_count
    FROM orders WHERE UserId = param1;
    IF order_count > 0 THEN
    	DELETE FROM orderproducts WHERE OrderId IN (SELECT Id FROM orders WHERE UserId = param1);
        -- Xóa các đơn hàng của user
        DELETE FROM orders WHERE UserId = param1;
    END IF;
    -- Xoá role user
    DELETE FROM userroles WHERE UserId = param1;
    -- Xóa user cuối cùng
    DELETE FROM users WHERE Id = param1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
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

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id`, `Name`, `Description`, `ParentCategoryId`, `Node`) VALUES
(1, 'Điện thoại', '', NULL, 1),
(2, 'Hãng', '', 1, 2),
(3, 'Iphone', '', 2, 3),
(4, 'Laptop', '', NULL, 1),
(5, 'Hãng', '', 4, 2),
(6, 'Mac', '', 5, 3),
(7, 'DELL', '', 5, 3),
(8, 'HP', '', 5, 3),
(9, 'ASUS', '', 5, 3),
(10, 'Nhu Cầu', '', 4, 2),
(11, 'Văn Phòng', '', 10, 3),
(12, 'Đồ Họa - Thiết Kế', '', 10, 3),
(13, 'Cảm Ứng', '', 10, 3),
(14, 'Gaming', '', 10, 3),
(15, 'SamSung', '', 2, 3),
(16, 'Oppo', '', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderproducts`
--

INSERT INTO `orderproducts` (`Id`, `ProductId`, `OrderId`, `Quantity`) VALUES
(1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Fullname` varchar(150) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `TotalPayment` double DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL,
  `ShippingFee` double DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `UserId`, `Status`, `Fullname`, `Address`, `PhoneNumber`, `TotalPayment`, `TotalPrice`, `ShippingFee`, `CreatedDate`) VALUES
(1, 2, 0, 'Thu Haf', 'BBBB', 98765432, 58030000, 58000000, 30000, '2023-08-15 12:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `productcomments`
--

CREATE TABLE `productcomments` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Avatar` text DEFAULT NULL,
  `Fullname` varchar(150) DEFAULT NULL,
  `Rank` int(11) NOT NULL,
  `Comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productcomments`
--

INSERT INTO `productcomments` (`Id`, `ProductId`, `UserId`, `Avatar`, `Fullname`, `Rank`, `Comment`) VALUES
(1, 1, 5, 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'Nguyễn Thị Lan', 5, 'Máy đẹp, pin khoẻ, nhanh nhạy, dịch vụ tốt, giá tốt'),
(2, 10, 11, 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'Lê Thị Điệp', 5, 'Macbook giá phải chăng và hiệu năng vượt cả mong đợi'),
(3, 1, 6, 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'Nguyễn Văn A', 5, 'Máy mượt, pin khoẻ, bàn phím nhẹ, loa to. Bản 256GB phù hợp với dân văn phòng. Giá sản phẩm cạnh tranh, nhân viên tư vấn nhiệt tình.'),
(4, 1, 10, 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'Nguyễn Văn B', 4, ' vừa mua chưa được 1 tuần thì thấy sale. tức thật'),
(5, 19, 15, 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'Nguyễn Thị Bảo', 5, 'Sản phẩm tốt. Pin trâu, chạy mượt gần như tất cả ứng dụng'),
(6, 19, 24, 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'Lê Thị Thu', 5, 'Ok lắm'),
(7, 7, 7, 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'Bình Trần', 5, 'Sản phẩm hay ạ');

--
-- Triggers `productcomments`
--
DELIMITER $$
CREATE TRIGGER `AddFullnameAndAvatarComment` AFTER INSERT ON `productcomments` FOR EACH ROW BEGIN
    DECLARE v_Fullname NVARCHAR(255);
    DECLARE v_Avatar TEXT;

    -- Lấy thông tin họ tên và hình đại diện từ bảng users dựa vào UserId
    SELECT Fullname INTO v_Fullname
    FROM users WHERE UserId = NEW.UserId;
    SELECT Avatar INTO v_Avatar
    FROM users WHERE UserId = NEW.UserId;

    -- Cập nhật thông tin vào bảng productcomment
    UPDATE productcomments
    SET Fullname = v_Fullname,
        Avatar = v_Avatar
    WHERE UserId = NEW.UserId AND Id = NEW.Id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateProductRank` AFTER INSERT ON `productcomments` FOR EACH ROW BEGIN
    DECLARE product_id INT;
    DECLARE total_rank INT; -- Sử dụng kiểu dữ liệu INT thay vì FLOAT
    DECLARE comment_count INT;

    SET product_id = NEW.ProductId;
    
    -- Tính tổng rank và số lượng bình luận có rank cho sản phẩm
    SELECT ROUND(SUM(Rank)) INTO total_rank
    FROM productcomments
    WHERE ProductId = product_id AND Rank IS NOT NULL;
    
	SELECT COUNT(*) INTO comment_count
    FROM productcomments
    WHERE ProductId = product_id AND Rank IS NOT NULL;
    -- Cập nhật rank của sản phẩm trong bảng products
    IF comment_count > 0 THEN
        UPDATE products
        SET Rank = ROUND(total_rank / comment_count)
        WHERE id = product_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productimages`
--

INSERT INTO `productimages` (`Id`, `ProductId`, `Value`) VALUES
(1, 1, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/t/_/t_m-iphone-14-pro-1_3.png'),
(2, 3, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/6/0/600_iphone-13-pro-256gb-xanh-la_5.jpg'),
(3, 2, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/3/_/3_224.jpg'),
(4, 4, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/4/_/4_185_2.jpg'),
(5, 5, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/2/_/2._l__2.jpg'),
(6, 6, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/x/n/xnnah_kas_3.png'),
(7, 7, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/t/r/tr_ng_5.jpg'),
(8, 8, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/d/_/d_ng_3.jpg'),
(9, 9, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/f/i/file_3_10.jpg'),
(10, 10, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/2/_/2_61_8_2_1_6.jpg'),
(11, 11, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/g/a/galaxy-z-fold-5-xanh-1_1_1_1.jpg'),
(12, 12, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/g/a/galaxy-z-fold-5-kem-1_3_2.jpg'),
(13, 13, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/s/a/samsung-kem_1.jpg'),
(14, 14, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/x/a/xamsm_1.jpg'),
(15, 15, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/h/i/hinh-anh-render-cua-oppo-reno-8t-5g-153957651_1.jpg'),
(16, 16, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/t/_/t_i_xu_ng_28__6.png'),
(17, 17, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/h/i/hinh-anh-render-cua-oppo-reno-8t-5g-153957651_1.jpg'),
(18, 18, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/m/a/macbook_air_m2_2_3.jpg'),
(19, 19, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/m/a/macbook_air_m2_4_2.jpg'),
(20, 20, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/m/a/macbook_air_m2_3_2.jpg'),
(21, 21, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/m/a/macbook-air-15-inch-midnight-2023.jpg'),
(22, 22, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/9/_/9_46_5.jpg'),
(23, 23, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/_/0/_0004_6a7pyl_tg3fsygq7gaezm9mjcews-fjj.jpg'),
(24, 24, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/l/a/laptop-dell-gaming-g15-5511-1.jpg'),
(25, 25, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/7/e/7efbd23a-5394-4002-9d67-8fad17c18121.jpg'),
(26, 26, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/d/o/download_2__3_3.jpg'),
(27, 27, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/2/6/26_1_105.jpg'),
(28, 28, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/1/_/1_472_1.png'),
(29, 29, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/_/0/_0005_screenshot_1__1.jpg'),
(30, 30, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/t/e/text_ng_n_2__2_25.png'),
(31, 31, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/_/0/_0005_21675_laptop_asus_x515ma_br481w_1.jpg'),
(32, 32, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/l/a/laptop-asus-tuf-gaming-f15-fx506hf-hn014w-1_1.png'),
(33, 33, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/l/a/laptop-asus-tuf-gaming-f15-fx506hf-hn014w-1_1.png'),
(34, 34, 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/t/e/text_ng_n_-_2023-06-08t001431.312_3.png'),
(35, 35, 'https://cdn2.cellphones.com.vn/x358,webp,q100/media/catalog/product/l/a/laptop-asus-rog-strix-g15-g513ih-hn015t-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `productlabels`
--

CREATE TABLE `productlabels` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productlabels`
--

INSERT INTO `productlabels` (`Id`, `ProductId`, `Type`) VALUES
(1, 1, 0),
(2, 1, 1);

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

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `CategoryId`, `Name`, `Description`, `Price`, `Discount`, `Rank`) VALUES
(1, 3, 'Iphone 14', 'best', 30000000, 29000000, '4'),
(2, 3, 'Iphone 12', '', 13000000, 12900000, '4'),
(3, 3, 'Iphone 13 Pro', '', 21000000, 1999000, '4'),
(4, 3, 'iPhone 12 Pro', '', 12000000, 10990000, '4'),
(5, 3, 'iPhone 12 Pro Max', '', 1500000, 14000000, '4'),
(6, 3, 'iPhone SE (2022)', '', 10000000, 990000, '4'),
(7, 3, 'iPhone 13', '', 22000000, 20000000, '5'),
(8, 3, 'iPhone 13 mini', '', 20000000, 18000000, '4'),
(9, 3, 'iPhone 13 Pro Max', '', 22000000, 20000000, '4'),
(10, 3, 'iPhone 14 Pro', '', 31000000, 30000000, '4'),
(11, 15, 'Samsung Galaxy Z Fold5 12GB 512GB', '', 39900000, 39000000, '4'),
(12, 15, 'Samsung Galaxy Z Flip5 512GB', '', 29000000, 28500000, '4'),
(13, 15, 'Samsung Galaxy S20 FE 256GB', '', 29900000, 29000000, '4'),
(14, 15, 'Samsung Galaxy Z Flip4 128GB', '', 19000000, 18500000, '4'),
(15, 16, 'OPPO Find N2 Flip', '', 29000000, 28000000, '4'),
(16, 16, 'OPPO A78 4G (8GB 256GB)', '', 10000000, 990000, '4'),
(17, 16, 'OPPO Find N2 Flip', '', 9000000, 8500000, '4'),
(18, 6, 'Apple Macbook Pro 13 M2 2022 8GB 256GB', '', 29000000, 28990000, '4'),
(19, 6, 'Apple Macbook Air M2 2022 8GB 256GB', '', 48000000, 47000000, '4'),
(20, 6, 'MacBook Pro 14 inch M2 Pro 2023 ', '', 31000000, 3990000, '4'),
(21, 6, 'Apple MacBook Pro 13 Touch Bar M1 256GB 2020', '', 28000000, 27000000, '4'),
(22, 7, 'Laptop Dell Inspiron 16 5620 N6I7110W1', '', 29000000, 28990000, '4'),
(23, 7, 'Laptop Dell Inspirion 15 3511 PDP3H', '', 48000000, 47000000, '4'),
(24, 7, 'Laptop Dell Vostro 3520', '', 29000000, 28990000, '4'),
(25, 7, 'Laptop Dell Latidude 7320 9PPWV', '', 41000000, 40000000, '4'),
(26, 7, 'Laptop Dell Inspiron 3511 5829BLK', '', 29000000, 28990000, '4'),
(27, 8, 'Laptop HP Pavilion x360 14 EK0056TU 6L294PA', '', 29000000, 28990000, '4'),
(28, 8, 'Laptop HP Gaming Victus 15-FA0115TX 7C0X1PA', '', 28000000, 27000000, '4'),
(29, 8, 'Laptop HP Pavilion 15-EG2037TX 6K783PA', '', 29000000, 28990000, '4'),
(30, 8, 'Laptop HP Gaming Victus 15-FA0031DX 6503849', '', 28000000, 27000000, '4'),
(31, 9, 'Laptop Asus TUF GAMING F15 FX506HF-HN014W', '', 29000000, 28990000, '4'),
(32, 8, 'Laptop ASUS X515MA-BR481W', '', 28000000, 27000000, '4'),
(33, 8, 'Laptop ASUS Gaming TUF FX506LHB-HN188W', '', 29000000, 28990000, '4'),
(34, 8, 'Laptop ASUS Gaming ROG Zephyrus G14 GA401QC-K2199W', '', 28000000, 27000000, '4'),
(35, 8, 'Laptop Asus Gaming Rog Strix G15 G513IH HN015W', '', 28000000, 27000000, '4');

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
-- Table structure for table `specificationproducts`
--

CREATE TABLE `specificationproducts` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `SpecificationId` int(11) NOT NULL,
  `Value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specificationproducts`
--

INSERT INTO `specificationproducts` (`Id`, `ProductId`, `SpecificationId`, `Value`) VALUES
(1, 1, 1, '6.7 inches'),
(2, 1, 2, '6 GB'),
(3, 1, 3, '128 GB'),
(4, 1, 4, '2 SIM (nano‑SIM và eSIM)'),
(5, 1, 5, 'iOS 16'),
(6, 1, 6, '2796 x 1290-pixel'),
(7, 1, 7, 'Apple A16 Bionic 6-core'),
(8, 1, 8, 'Camera chính: 48 MP, f/1.8, 24mm, 1.22µm, PDAF, OIS\r\nCamera góc siêu rộng: 12 MP, f/2.2, 13mm, 120˚, 1.4µm, PDAF\r\nCamera tele: 12 MP, f/2.8, 77mm (telephoto), PDAF, OIS, 3x optical zoom\r\nCảm biến độ sâu TOF 3D LiDAR'),
(9, 1, 9, 'Camera selfie: 12 MP, f/1.9, 23mm, 1/3.6\", PDAF'),
(10, 1, 14, '4.323 mAh'),
(11, 19, 10, 'LPDDR4'),
(12, 19, 11, 'GPU 7 nhân, 16 nhân Neural Engine'),
(13, 19, 12, '13.3 inches'),
(14, 19, 13, '2 cổng Thunderbolt / USB 4'),
(15, 19, 14, '49.9-watt lithium-polymer, củ sạc công suất 30W'),
(16, 19, 15, '256GB SSD'),
(17, 19, 16, '8GB'),
(18, 19, 5, 'macOS Big Sur'),
(19, 19, 6, '2560 x 1600 pixels (2K)');

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE `specifications` (
  `Id` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specifications`
--

INSERT INTO `specifications` (`Id`, `Title`) VALUES
(1, 'Kích thước màn hình'),
(2, 'Dung lượng RAM'),
(3, 'Bộ nhớ trong'),
(4, 'Thẻ SIM'),
(5, 'Hệ điều hành'),
(6, 'Độ phân giải màn hình'),
(7, 'Chipset'),
(8, 'Camera sau'),
(9, 'Camera trước'),
(10, 'Loại RAM'),
(11, 'Loại card đồ họa'),
(12, 'Kích thước màn hình'),
(13, 'Cổng giao tiếp'),
(14, ' Pin'),
(15, 'Ổ cứng'),
(16, 'Dung lượng RAM');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`Id`, `UserId`, `RoleId`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 1, 2),
(4, 1, 3),
(5, 3, 3),
(6, 4, 3),
(7, 5, 3),
(8, 6, 3),
(9, 7, 3),
(10, 8, 3),
(11, 9, 3),
(12, 10, 3),
(13, 11, 3),
(14, 12, 3),
(15, 13, 3),
(16, 15, 3),
(17, 16, 3),
(18, 17, 3),
(19, 18, 3),
(20, 19, 3),
(21, 20, 3),
(22, 21, 3),
(23, 22, 3),
(24, 23, 3),
(25, 24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` char(50) NOT NULL,
  `Password` char(50) NOT NULL,
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

INSERT INTO `users` (`Id`, `Username`, `Password`, `Fullname`, `Email`, `PhoneNumber`, `Address`, `Avatar`, `Cover`, `Bio`, `Gender`, `DOB`, `CreatedDate`, `LastModifiedDate`) VALUES
(1, 'admin', '', 'admin', 'admin@gmail.com', 999000001, NULL, NULL, NULL, NULL, 0, '1981-08-13', '2023-08-02 18:54:25', '2023-08-03 01:54:25'),
(2, 'employeeA', '', 'employeeA', 'employeeA@gmail.com', 999000002, NULL, NULL, NULL, NULL, 0, '1992-08-17', '2023-08-04 18:54:25', '2023-08-10 21:25:35'),
(3, 'employeeB', '123456', 'employeeB', 'employeeB@gmail.com', 999888777, '', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1992-08-17', '2023-08-12 04:00:41', '2023-08-12 11:00:41'),
(4, 'employee C', '123459', 'Employee C', 'employeeC@gail.com', 123456756, 'Hà Nội', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1998-05-19', '2023-08-14 03:00:00', '2023-08-12 10:00:00'),
(5, 'Nguyễn Lan', '123459', 'Nguyễn Thị Lan', 'nguyenthilan@gmail.com', 123456756, 'Hà Nội', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1998-05-19', '2023-08-14 03:00:00', '2023-08-12 10:00:00'),
(6, 'Nguyễn Văn A', '678908', 'Nguyễn Văn A', 'nguyenvana@gmail.com', 987654321, 'Đà Nẵng', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1985-03-20', '2023-08-14 04:00:00', '2023-08-12 11:00:00'),
(7, 'Bình Trần', 'tb2345', 'Trần Thị Bình', 'tranthibinh@gmail.com', 555555555, 'Hải Phòng', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1993-02-10', '2023-08-14 06:00:00', '2023-08-12 13:00:00'),
(8, 'Lê Văn Cường', 'lvc123', 'Lê Văn Cường', 'levancuong@gmail.com', 777777777, 'Cần Thơ', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1988-07-05', '2023-08-14 07:00:00', '2023-08-12 14:00:00'),
(9, 'Phạm Thị Hoa', '654337', 'Phạm Thị Hoa', 'phamthihoa@gmail.com', 888888888, 'Nha Trang', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1995-11-22', '2023-08-14 08:00:00', '2023-08-12 15:00:00'),
(10, 'Nguyễn Văn B', '234561', 'Nguyễn Văn B', 'nguyenvanb@gmail.com', 999999999, 'Vũng Tàu', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1997-04-17', '2023-08-14 09:00:00', '2023-08-12 16:00:00'),
(11, 'Lê Thị Điệp', 'dl4572', 'Lê Thị Điệp', 'lethidiep@gmail.com', 111111111, 'Đà Lạt', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1983-09-02', '2023-08-14 10:00:00', '2023-08-12 17:00:00'),
(12, 'Trần Văn Đức', '4g667', 'Trần Văn Đức', 'tranvanduc@gmail.com', 222222222, 'Quảng Ninh', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1991-12-08', '2023-08-14 11:00:00', '2023-08-12 18:00:00'),
(13, 'Nguyễn Thành Long', 'gf3456', 'Nguyễn Thành Long', 'nguyenthanhlong@gmail.com', 333333333, 'Cà Mau', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1989-06-30', '2023-08-14 12:00:00', '2023-08-12 19:00:00'),
(15, 'Nguyễn Thị Bảo', 'Nguyenbao11', 'Nguyễn Thị Bảo', 'nguyenthibao@gmail.com', 444444444, 'Thanh Hóa', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1997-08-12', '2023-08-14 13:00:00', '2023-08-12 20:00:00'),
(16, 'Trần Văn Dũng', 'dung456', 'Trần Văn Dũng', 'tranvandung@gmail.com', 555555555, 'Bình Định', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1990-11-25', '2023-08-14 14:00:00', '2023-08-12 21:00:00'),
(17, 'Lê Thị Mai', 'Lemai234', 'Lê Thị Mai', 'lethimai@gmail.com', 666666666, 'Quảng Bình', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1986-04-18', '2023-08-14 15:00:00', '2023-08-12 22:00:00'),
(18, 'Nguyễn Văn Minh', 'minhnguyen14', 'Nguyễn Văn Minh', 'nguyenvanminh@gmail.com', 777777777, 'Hải Dương', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1993-06-14', '2023-08-14 16:00:00', '2023-08-12 23:00:00'),
(19, 'Phạm Thanh Hằng', 'Hang231', 'Phạm Thanh Hằng', 'phamthanhhang@gmail.com', 888888888, 'Long An', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1994-09-05', '2023-08-14 17:00:00', '2023-08-13 00:00:00'),
(20, 'Trần Văn Tuấn', '56716', 'Trần Văn Tuấn', 'tranvantuan@gmail.com', 999999999, 'Sài Gòn', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1988-01-30', '2023-08-14 18:00:00', '2023-08-13 01:00:00'),
(21, 'Vũ Thị Lan', 'lann17', 'Vũ Thị Lan', 'vuthilan@gmail.com', 111111111, 'Hưng Yên', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1991-03-08', '2023-08-14 19:00:00', '2023-08-13 02:00:00'),
(22, 'Hoàng Minh Đức', 'duc18', 'Hoàng Minh Đức', 'hoangminhduc@gmail.com', 222222222, 'Bình Thuận', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1984-07-22', '2023-08-14 20:00:00', '2023-08-13 03:00:00'),
(23, 'Nguyễn Văn Hùng', 'hung19', 'Nguyễn Văn Hùng', 'nguyenvanhung@gmail.com', 333333333, 'Đồng Nai', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 1, '1996-12-10', '2023-08-14 21:00:00', '2023-08-13 04:00:00'),
(24, 'Lê Thị Thu', 'thule20', 'Lê Thị Thu', 'lethithu@gmail.com', 444444444, 'Phú Yên', 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg', 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg', '', 0, '1999-02-27', '2023-08-14 22:00:00', '2023-08-13 05:00:00');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `AddUserRole` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    INSERT INTO userroles (UserId, RoleId)
    VALUES (NEW.Id, 3);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateAvatarAndFullnameComment` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
    -- Cập nhật thông tin họ tên và hình đại diện vào bảng productcomments
    UPDATE productcomments
    SET Fullname = NEW.Fullname,
        Avatar = NEW.Avatar
    WHERE UserId = NEW.Id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

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
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `productcomments`
--
ALTER TABLE `productcomments`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `productlabels`
--
ALTER TABLE `productlabels`
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
-- Indexes for table `specificationproducts`
--
ALTER TABLE `specificationproducts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `SpecificationId` (`SpecificationId`);

--
-- Indexes for table `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RoleId` (`RoleId`),
  ADD KEY `UserId` (`UserId`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `productcomments`
--
ALTER TABLE `productcomments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `productlabels`
--
ALTER TABLE `productlabels`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specificationproducts`
--
ALTER TABLE `specificationproducts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);

--
-- Constraints for table `productcomments`
--
ALTER TABLE `productcomments`
  ADD CONSTRAINT `productcomments_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`),
  ADD CONSTRAINT `productcomments_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);

--
-- Constraints for table `productimages`
--
ALTER TABLE `productimages`
  ADD CONSTRAINT `productimages_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`);

--
-- Constraints for table `productlabels`
--
ALTER TABLE `productlabels`
  ADD CONSTRAINT `productlabels_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `categories` (`Id`);

--
-- Constraints for table `specificationproducts`
--
ALTER TABLE `specificationproducts`
  ADD CONSTRAINT `specificationproducts_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`),
  ADD CONSTRAINT `specificationproducts_ibfk_2` FOREIGN KEY (`SpecificationId`) REFERENCES `specifications` (`Id`);

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`),
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`RoleId`) REFERENCES `roles` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
