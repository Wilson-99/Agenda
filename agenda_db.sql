-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 09, 2022 at 06:43 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agenda_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
CREATE TABLE IF NOT EXISTS `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(150) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id_fk` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactos`
--

INSERT INTO `contactos` (`id`, `nome`, `email`, `telefone`, `foto`, `usuario_id`) VALUES
(1, 'wil', 'camunda@gmail.com', '8755426963', '6319d6d04815c.png', 1),
(2, 'Jandira', 'jandira@mail.com', '931152640', '6319d718358ce.png', 2),
(3, 'mara', 'mara_marques@gmail.com', '854796332', '6319d74c62a1b.png', 6),
(4, 'wilson', 'wilson@outlook.com', '927800963', '6319d80d5900c.jpg', 2),
(5, 'wil ju', 'camunda@gmail.com', '(875) 542-6963', '6319dc33b627e.png', 6),
(7, 'test everything', 'test@mail.com', '1234567898', '6319dcfe6619c.jpg', 2),
(9, 'Aldina Lucombo', 'aldina@mail.com', '924000000', '6319dd7b03133.jpg', 1),
(10, 'Marcia Justin', 'marcia@mail.com', '931152640', '6319dde83eef7.jpg', 1),
(11, 'Arnaldo Justino', 'camunda@gmail.com', '78335640', '6319de7b0aa91.jpg', 1),
(12, 'Esmeralda Pimentel', 'rina@outlook.com', '924511487', '6319df1ac1241.jpg', 2),
(13, 'wilson', 'wilson@outlook.com', '(875) 542-6963', '6319e39ea99c3.png', 1),
(14, 'Kiri A', 'kiri@kiki.com', '222 336 114', '6319e55ccf78e.jpg', 2),
(15, 'test', 'test@gmail.com', '1234567898', '6319efab4c1bc.png', 1),
(16, 'wil', 'camunda@gmail.com', '8755426963', '631b12a846e6e.jpg', 1),
(17, 'test', 'test@gmail.com', '1234567898', '631b735192862.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `foto` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `foto`) VALUES
(1, 'test all', 'test@mail.com', 'MTIz', '6319ca8e633c4.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
