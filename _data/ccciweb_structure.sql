-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2015 at 12:17 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccciweb`
--
CREATE DATABASE IF NOT EXISTS `ccciweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ccciweb`;

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int(255) NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `img_url` text,
  `img_caption` text,
  `content` text,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `tags` text,
  `title` text NOT NULL,
  `description` text,
  `date_custom` int(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `date_publish` int(11) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `tags` text,
  `title` text NOT NULL,
  `summary` text,
  `description` text,
  `verse` text,
  `img_url` text,
  `img_caption` text,
  `content` text NOT NULL,
  `author_id` int(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `church_meta`
--

DROP TABLE IF EXISTS `church_meta`;
CREATE TABLE IF NOT EXISTS `church_meta` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `tags` text,
  `title` text NOT NULL,
  `summary` text,
  `description` text NOT NULL,
  `content` text,
  `location` text NOT NULL,
  `img_url` text,
  `img_caption` text,
  `event_date` int(255) NOT NULL,
  `time` text
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `local_churches`
--

DROP TABLE IF EXISTS `local_churches`;
CREATE TABLE IF NOT EXISTS `local_churches` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `address` text,
  `services` text,
  `pastor_id` int(255) DEFAULT NULL,
  `contact` text,
  `email` text,
  `social` text,
  `bank` text,
  `map_url` text,
  `map_image` text,
  `img_url` text,
  `img_caption` text
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ministry`
--

DROP TABLE IF EXISTS `ministry`;
CREATE TABLE IF NOT EXISTS `ministry` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `title_abbr` varchar(255) NOT NULL,
  `description` text,
  `content` text NOT NULL,
  `local_church` int(255) DEFAULT NULL,
  `date_established` int(4) DEFAULT NULL,
  `coordinator` int(255) DEFAULT NULL,
  `asst_coordinator` int(255) DEFAULT NULL,
  `treasurer` int(255) DEFAULT NULL,
  `auditor` int(255) DEFAULT NULL,
  `pro` int(255) DEFAULT NULL,
  `adviser` int(255) DEFAULT NULL,
  `mission` text,
  `vision` text,
  `history` text,
  `social` text,
  `img_url` text,
  `img_caption` text
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ministry_officers`
--

DROP TABLE IF EXISTS `ministry_officers`;
CREATE TABLE IF NOT EXISTS `ministry_officers` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `name_first` text NOT NULL,
  `name_middle` text,
  `name_last` text NOT NULL,
  `sex` text NOT NULL,
  `img_url` text,
  `img_caption` text,
  `birthday` int(255) DEFAULT NULL,
  `contact` text,
  `social` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `summary` text NOT NULL,
  `content` text,
  `date_publish` int(255) DEFAULT NULL,
  `tags` text,
  `img_url` text,
  `img_caption` text
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outreaches`
--

DROP TABLE IF EXISTS `outreaches`;
CREATE TABLE IF NOT EXISTS `outreaches` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `address` text,
  `services` text,
  `pastor_id` int(255) DEFAULT NULL,
  `contact` text,
  `email` text,
  `social` text,
  `bank` text,
  `map_url` text,
  `map_image` text,
  `img_url` text,
  `img_caption` text
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pastors`
--

DROP TABLE IF EXISTS `pastors`;
CREATE TABLE IF NOT EXISTS `pastors` (
  `id` int(255) NOT NULL,
  `name_first` text NOT NULL,
  `name_middle` text,
  `name_last` text NOT NULL,
  `name_ext` text,
  `sex` varchar(4) NOT NULL,
  `birthday` int(4) DEFAULT NULL,
  `nickname` text,
  `contact` text,
  `email` text,
  `social` text,
  `biography` text,
  `img_url` text,
  `img_caption` text,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `tags` text,
  `img_url` text NOT NULL,
  `img_title` text,
  `img_caption` text,
  `album_id` int(255) NOT NULL,
  `img_filename` text NOT NULL,
  `img_thumbnail` text
) ENGINE=MyISAM AUTO_INCREMENT=1783 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `location_id` int(255) DEFAULT NULL,
  `sched` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `description` text
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(255) NOT NULL,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `date_publish` int(11) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `tags` text,
  `title` text NOT NULL,
  `summary` text,
  `description` text,
  `author_id` int(255) DEFAULT NULL,
  `content` text NOT NULL,
  `img_url` text,
  `img_caption` text
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(255) NOT NULL,
  `name_first` text NOT NULL,
  `name_last` text NOT NULL,
  `number` int(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL,
  `username` text NOT NULL,
  `name_first` text NOT NULL,
  `name_middle` text,
  `name_last` text NOT NULL,
  `name_ext` text,
  `nickname` text,
  `birthday` varchar(255) DEFAULT NULL,
  `sex` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `contact` text,
  `email` text,
  `img_url` text,
  `img_thumbnail` text,
  `img_caption` text,
  `permission` text NOT NULL,
  `date_created` text NOT NULL,
  `date_modified` text NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `church_meta`
--
ALTER TABLE `church_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_churches`
--
ALTER TABLE `local_churches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ministry`
--
ALTER TABLE `ministry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ministry_officers`
--
ALTER TABLE `ministry_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outreaches`
--
ALTER TABLE `outreaches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pastors`
--
ALTER TABLE `pastors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `church_meta`
--
ALTER TABLE `church_meta`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `local_churches`
--
ALTER TABLE `local_churches`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ministry`
--
ALTER TABLE `ministry`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ministry_officers`
--
ALTER TABLE `ministry_officers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `outreaches`
--
ALTER TABLE `outreaches`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pastors`
--
ALTER TABLE `pastors`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1783;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
