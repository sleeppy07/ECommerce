SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users`(
      `id` text NOT NULL,
      `username` char(50) NOT NULL,
      `fullname` char(50) NOT NULL,
      `email` char(50) NOT NULL,
      `phonenumber` char(20) NOT NULL,
      `passwordhash` text NOT NULL,
      `createddate` timestamp NOT NULL DEFAULT current_timestamp(),
      `lastmodifieddate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

