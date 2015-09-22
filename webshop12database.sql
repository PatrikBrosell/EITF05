-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2015 at 03:34 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webshop12database`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `nbrInStore` int(10) NOT NULL,
  `imageURL` varchar(200) NOT NULL,
  `price` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `nbrInStore`, `imageURL`, `price`) VALUES
(1, 'Pizza', 'This tasty piece of food can be eaten.', 20, '', 75),
(2, 'Computer', 'A gaming rig of never before seen powerful components.', 2, '', 10000),
(3, 'Pen', 'A pen for drawing. Works forever.', 5323, '', 10),
(4, 'Cookie', 'A krusty cookie.', 21, '-', 16),
(5, 'Thing', 'A mysterious object.', 242, '-', 199);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userName` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `homeAddress` varchar(50) NOT NULL,
  `nbrFailedLogin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userName`, `password`, `homeAddress`, `nbrFailedLogin`) VALUES
('admin', '$2y$10$yoPo9hfwtMDbrOlqLMiKcOiEHgMztYbL1u0opX7yzdPnavGs3p9hK', 'Lund', 0),
('hash', '$2y$10$xYTxN1do1h8XqOGWZ8OCje8.PxssiCf.3Ly6x5f3lcEalB5hgtzYS', 'Lund', 0),
('minh', '$2y$10$n3WkQUanA55.s4mTUaJ3SOQvPhenG.I0JVmC.Z89eQT.PMk0HssPa', 'Helsingborg', 0),
('test', '$2y$10$KXIwQf6S85v0kh6XFKCGU.5QYHVz5kHkPN/ZZRlTwgvrE4q4iyPzm', 'Lund', 0),
('test3', '$2y$10$dIyFz0rM6p17rM.Kc/r2OuUCPaThQab8mlMX3wU7z2XLdw15vzvIa', 'Lund', 0),
('test4', '$2y$10$DmGhcftJGscSZ3xzyecxI.SFGfvAuH.9A2X6OVINfctEfHTaTNyh6', 'Lund', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
