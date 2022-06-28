-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 28, 2022 at 01:44 PM
-- Server version: 5.7.31
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony_third_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220428162134', '2022-04-28 16:22:22', 555),
('DoctrineMigrations\\Version20220429065858', '2022-04-29 07:01:07', 267),
('DoctrineMigrations\\Version20220429294345', '2022-04-29 07:23:19', 120);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `firstname`, `lastname`, `birthdate`, `city`, `email`, `phone`) VALUES
(1, 'Slobodan', 'Cvetkovic', '1995-09-09', 'Subotica', 'slobodan@mail.com', '+3816239849285'),
(2, 'Marko', 'Markovic', '1988-07-27', 'Novi Sad', 'marko@mail.com', '+309401092'),
(3, 'Nikolina', 'Nikolic', '2003-04-21', 'Beograd', 'nikolina@mail.com', '+321435245'),
(4, 'Marina', 'Marinkovic', '1976-11-01', 'Kraljevo', 'marina@mail.com', '+30590590342'),
(5, 'Stoja', 'Stojankovic', '1970-01-01', 'Vrsac', 'stoja@mail.com', '+358298592385925');

-- --------------------------------------------------------

--
-- Table structure for table `driver_vehicle`
--

DROP TABLE IF EXISTS `driver_vehicle`;
CREATE TABLE IF NOT EXISTS `driver_vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `date_reserved` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DE7F80E6C3423909` (`driver_id`),
  KEY `IDX_DE7F80E6545317D1` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver_vehicle`
--

INSERT INTO `driver_vehicle` (`id`, `driver_id`, `vehicle_id`, `date_reserved`) VALUES
(1, 1, 1, '2023-03-04'),
(2, 2, 2, '2022-05-06'),
(3, 1, 2, '2023-01-07'),
(4, 1, 2, '2022-07-08'),
(5, 1, 1, '2022-04-04'),
(6, 1, 3, '2022-07-09'),
(7, 1, 2, '2022-10-08'),
(8, 1, 1, '2022-01-01'),
(9, 1, 2, '2022-09-10'),
(10, 1, 3, '2022-09-10'),
(11, 1, 4, '2022-09-09'),
(12, 3, 1, '2022-01-01'),
(13, 4, 3, '2022-01-09'),
(14, 5, 5, '2022-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `brand`, `model`, `purchase_date`, `description`) VALUES
(1, 'Yugo', '55', '1999-03-16', ''),
(2, 'Skoda', 'Octavia', '2014-01-01', ''),
(3, 'Zastava', 'Fico', '1980-01-01', ''),
(4, 'Fiat', 'Stilo', '2005-04-04', 'Fiat Stilo za dostave'),
(5, 'Zastava', 'Stojadin', '1985-04-03', 'Zastava Stojko je zakon');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver_vehicle`
--
ALTER TABLE `driver_vehicle`
  ADD CONSTRAINT `FK_DE7F80E6545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`),
  ADD CONSTRAINT `FK_DE7F80E6C3423909` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
