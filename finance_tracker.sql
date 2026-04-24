-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for finance_tracker
CREATE DATABASE IF NOT EXISTS `finance_tracker` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `finance_tracker`;

-- Dumping structure for table finance_tracker.tbl_team
CREATE TABLE IF NOT EXISTS `tbl_team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` varchar(155) DEFAULT NULL,
  `username` varchar(155) DEFAULT NULL,
  `useremail` varchar(150) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `remarks` varchar(155) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table finance_tracker.tbl_team: ~13 rows (approximately)
INSERT INTO `tbl_team` (`team_id`, `rank`, `username`, `useremail`, `phone`, `remarks`, `is_active`) VALUES
	(1, 'T/SGT', 'Manish Tamang', NULL, NULL, NULL, 'Y'),
	(2, 'T/SGT', 'Sushan Stha', NULL, NULL, NULL, 'Y'),
	(3, 'T/W01', 'Kamala Stha', NULL, NULL, NULL, 'Y'),
	(4, 'T/W02', 'Shantosh Hengaju', NULL, NULL, NULL, 'Y'),
	(5, 'T/W02', 'Uttam Khatri', NULL, NULL, NULL, 'Y'),
	(6, 'T/W02', 'Pankaj Chaudhary', NULL, NULL, NULL, 'Y'),
	(7, 'T/W01', 'Arun Mehta', NULL, NULL, NULL, 'Y'),
	(8, 'T/W02', 'Krishna Raut', NULL, NULL, NULL, 'Y'),
	(9, 'T/W02', 'Sanjay Hari Stha', NULL, NULL, NULL, 'Y'),
	(10, 'T/W02', 'Prakash Shah', NULL, NULL, NULL, 'Y'),
	(11, 'T/W02', 'Rajat Khadka', NULL, NULL, NULL, 'Y'),
	(12, 'T/LT', 'Om Bahadur Chhetri', NULL, NULL, NULL, 'Y'),
	(13, 'Other User', 'Other User', NULL, NULL, NULL, 'Y');

-- Dumping structure for table finance_tracker.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `personnel` varchar(255) NOT NULL,
  `topic` varchar(100) DEFAULT 'Mission',
  `amount` decimal(10,2) NOT NULL,
  `type` enum('income','expense') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table finance_tracker.transactions: ~13 rows (approximately)
INSERT INTO `transactions` (`id`, `team_id`, `title`, `personnel`, `topic`, `amount`, `type`, `created_at`) VALUES
	(8, 0, 'Coffe', '', 'Logistics', 702.00, 'expense', '2026-03-13 05:52:06'),
	(10, 0, 'Chocolate', '', 'Logistics', 311.00, 'expense', '2026-03-13 05:53:02'),
	(12, 0, 'Amount Collection of Promotion Lt.', '', 'Promotion', 1740.00, 'income', '2026-03-13 05:55:48'),
	(13, 0, 'Promotion of Pra.ama', '', 'Promotion', 215.00, 'income', '2026-03-13 06:30:26'),
	(14, 0, 'T/Lt. OM Bahadur Chettri, T/Lt. Santosh Thapa, T/Lt. Krishna k. Thakur, T/Lt. Hari Khadka, T/WO1 Kamala Shrestha, T/WO2 Santosh Hengaju, T/WO2 Krishna Raut(200), T/WO2 Rajat Khadka, T/WO2 Sanjayhari Shrestha, T/WO2 Prakash Shah, T/CPL Sushant Shrestha', '', 'Logistics', 1200.00, 'income', '2026-03-30 10:39:09'),
	(18, 0, 'T/W02 Uttam Khatri', 'T/W02 Uttam Khatri', 'Logistics', 100.00, 'income', '2026-04-01 06:17:38'),
	(20, 0, 'T/Lt. Santosh Ghimire', '', '', 100.00, 'income', '2026-04-05 05:32:52'),
	(21, 0, 'BILL Expenses 2082-12-17', '', 'Logistics', 1254.00, 'expense', '2026-04-05 05:33:55'),
	(22, 0, 'T/LT. Pushpa Thapa', '', 'Logistics', 100.00, 'income', '2026-04-05 05:39:23'),
	(23, 0, 'Ramesh Pr. Kurmi', 'T/LT Om Bahadur Chhetri', 'Promotion', 100.00, 'income', '2026-04-05 05:42:26'),
	(24, 0, 'T/W01 Arun Mehata', 'T/W01 Arun Mehta', 'Logistics', 100.00, 'income', '2026-04-07 09:38:57'),
	(25, 1, 'office1', 'T/SGT Manish Tamang', '', 1248.00, 'expense', '2026-04-15 10:04:56'),
	(38, 0, 'TSGT Promotion ', 'T/SGT Manish Tamang', 'Promotion', 370.00, 'income', '2026-04-23 09:35:41');

-- Dumping structure for table finance_tracker.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table finance_tracker.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'manish', '$2y$12$bUlJrdl5ibp1S0/sJ6RB3e8Q.iX2ZKHuUZb8JcmYbfaqusKDj8jxK'),
	(2, 'sushan', '$2y$12$bUlJrdl5ibp1S0/sJ6RB3e8Q.iX2ZKHuUZb8JcmYbfaqusKDj8jxK');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
