-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2014 at 08:59 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u546737951_ccci`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name_first`, `name_middle`, `name_last`, `name_ext`, `nickname`, `birthday`, `sex`, `password`, `contact`, `email`, `img_url`, `img_caption`, `permission`, `date_created`, `date_modified`, `status`) VALUES
(1, 'qtgye122', 'Jayson', 'Flores', 'Buquia', '', '', '01 January 1970', 'm', '$2a$12$lNppc6n0WR88xS24tlFAnO/WUN6Zl7X2qQKEDwtBo7wz5SWiHlLXe', '09997650211', 'buquia_jace@yahoo.com', 'http://localhost/test/ccciweb-admin.2fh.com/public/img/photos/2726_Dingdong_Dantes_profile.jpg', '', '1', '', '1417741840', 'active'),
(15, 'qtgye123', 'User 03', 'dfsdfsd', 'sdfsdf', NULL, NULL, '1415003420', 'm', '$2a$12$UoLBd4AcrBS5IM3YVLITc.FNsoJM2AgDnZ1S0WXd5j0DugpCnDgpq', '1234567', 'sfsdf@sfdsf.com', NULL, NULL, '3', '', '', 'active'),
(16, 'qtgye125', 'Jayson', 'Flores', 'Buquia', '', '', '01 January 1970', 'm', '', '09997650211', 'buquia.jace@gmail.com', '', '', '2', '', '1416883147', 'active'),
(86, 'qtgye160', 'Jayson', '', 'Buquia', NULL, NULL, '596995200', 'm', '$2a$12$lNppc6n0WR88xS24tlFAnO/WUN6Zl7X2qQKEDwtBo7wz5SWiHlLXe', '09997650211', 'isi.jaysonbuquia@gmail.com', NULL, NULL, '3', '1417679572', '1417679724', 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
