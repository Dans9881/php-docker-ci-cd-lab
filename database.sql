-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2026 at 05:12 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user', '$2y$10$TH4UuQnMYrB/lR1ATV1or.4MKb2V9GuSkNikNLEVUtJT0Qidu84dO'),
(2, 'said', '$2y$10$/UFgVaM5w42YA6ESrba4COcKuUXOaG0U2HpsraILM0hkRTLnwqwO2'),
(3, 'abdan', '$2y$10$zjkj8xMsSuflMNzcYT7zh.ksqdypjjvSUGj5.UjxG/sxwvIKDehfS'),
(4, 'syakur', '$2y$10$hwSbqJz1OieG9TSErehHeOjPNEbJ5v5p7LlW6H2KDdB8KU3Xgvr1S'),
(5, 'sadan', '$2y$10$5Pp5wHLuhaPX95ad7tCPduMArs4LwEdd9wYn.nYAtwv6nm6M2aeHm'),
(6, 'sadar', '$2y$10$/zT2KixMBA09W2X6VHAWSuA5Chq5ezlZ2vXGl0tEdwZGoUFGRedgO'),
(7, 'sabun', '$2y$10$cKeb1G7OTmhv0os/LmeSVOHgScVDC9Y8xjpOQQUPRxsuSmqGLwD3O'),
(8, 'anjay', '$2y$10$nzXnWxwTKpw5wAFzeSuKeObldOJrca2zbS.uF8UzuG6exRqU.nMLG'),
(9, 'path', '$2y$10$dwISl8yzrikVtZvLb8gzBe8vOVzn8Qh.ZItn1qqU4wg2fQn8T1ExK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
