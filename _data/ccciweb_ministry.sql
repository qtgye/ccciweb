-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2015 at 02:30 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccciweb`
--

--
-- Dumping data for table `ministry`
--

INSERT INTO `ministry` (`id`, `date_created`, `date_modified`, `user_id`, `status`, `title`, `title_abbr`, `description`, `content`, `local_church`, `date_established`, `coordinator`, `asst_coordinator`, `treasurer`, `auditor`, `pro`, `adviser`, `mission`, `vision`, `history`, `social`, `img_url`, `img_caption`) VALUES
(2, 1430542745, 1430542745, 1, 'published', 'Chosen Vessel Youth Ministry', 'CVYM', NULL, '<p>Youth Group</p>', NULL, 1383235200, 0, 0, 0, 0, 0, 0, '', '', '', NULL, 'http://ccciweb.org/public/img/photos/809136_1430542610_Chosen_Vessel_Youth_Ministry.jpg', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
