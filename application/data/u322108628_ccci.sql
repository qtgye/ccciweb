
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2015 at 09:55 PM
-- Server version: 5.1.61
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u322108628_ccci`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE IF NOT EXISTS `about` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `img_url` text,
  `img_caption` text,
  `content` text,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `img_url`, `img_caption`, `content`, `date_created`, `date_modified`, `user_id`, `status`) VALUES
(86, 'Mission', 'Vision Statement of CCCI', '', '', '<p>And He (Jesus) said to them, Go into all the world and preach the Gospel <br />to the whole creation.&nbsp; In my name they will cast out demons; <br />they will speak in new tongues;&nbsp; they will lay their hands on the sick, <br />and they will recover.&nbsp; And they went forth and preached everywhere, while the Lord worked with them and confirmed the message <br />by the signs that attended it.&nbsp; Amen.<br />(Mark 16:15-20)<br /><br />We are called by God to preach and teach the whole counsel of God in Word and in deed; but not with enticing words of mens wisdom, <br />but by demonstration of the Spirit and power. &nbsp;<br />In the Name of Jesus Christ who will have all men to be save <br />and come to the knowledge of the truth.<br />(1 Cor. 2:4; Acts 20:27; Phil. 4:9; 1 Tim. 2:4-5)</p>', 1417776119, 1417776119, 1, 'published'),
(87, 'Vision', 'Vision Statement of CCCI', '', '', '<p>All men to be saved and come to the knowledge of truth till He (JESUS) comes<br /><br /><br />OUR VISION STATEMENTS:<br /><br />1.We, envision that the Kingdom of Christ and Kingdom of the Gospel may establish in every individual behaviors, a total change life, submitted and committed to God.&nbsp; "The Lord will establish you as a people holy to Himself."<br /><br />2.We, envision that each believers life is influencer of Christ Jesus in their household and community.&nbsp; A church (individual) which made not to isolate their life away from sinners but friend of them in order to win them and to be part of the family of God.&nbsp; "so that Christ may dwell in your hearts through faith--that you, being rooted and grounded in love,"<br /><br />3.We, envision that every believers who are doers of Gods Word and prosperous in their financial and material possession responding to the call of God to have a ministry of giving, help on all ministry endeavor of the church.&nbsp; "And all these blessings shall come upon you and overtake you, if you obey the voice of the LORD your God"<br /><br />4.We, envision to trained more servants and handmaids all over the world.&nbsp; In order to become workers of JESUS CHRIST who are aggressive, enthusiastic, excited, very passionate to love Jesus and passionate to love the lost souls, passionate to pray and become intercessor and watchmen.<br /><br />5.We, envision that every believer should be a winner, victorious and no room for being a loser.&nbsp; "The LORD will cause your enemies who rise against you to be defeated before you. They shall come out against you one way and flee before you seven ways."<br /><br />Deuteronomy 28:1-14, 1Timothy 2:4-5, Ephesians 3:14-21</p>', 1417776166, 1417776166, 1, 'published'),
(88, 'Brief History', '', '', '', '<p>It was in the year 1979 that God through the Holy Spirit let the residents of Barrio Magsaysay felt what the Word of God describes as the regeneration of the human heart commonly known as the Born Again experience (John 3:3, 6).&nbsp; A home Bible Study was then held in order to fill the fervent desire of the new believers to be fully enlightened with the all powerful and life&nbsp; giving Word of God.&nbsp; Their confession of what was promised by the Word that I will be with thee always even unto the end of the ages (Matthew 28:20), was fulfilled because a lot of people also experienced the mighty moving of the Holy Spirit through some faithful workers of Christ who bravely preached the Word.<br /><br />The believers, in faithful obedience to God, answered the need for an organized fellowship because of their increasing number.&nbsp; On July 10, 1979, the group was named Christian Challenge Center.&nbsp; Through the regular visits of some of the students of FEAST, which are: Sister Rodelyn Lasquite, Sister Monica Sayang and Sister Lilia Tan, the fellowship grew and prospered.&nbsp; As they heartily and conscientiously studied, understood and acted upon the Word of God, they created different ministries to boost the Work of God namely, Sunday School, Music Ministry, Christ Ambassador of the Young People, Mens Fellowship, Womens Fellowship.<br /><br />In June 1982, the FEAST student left to minister in the provinces, nevertheless, GOD called three of His sons with eager desire to serve Him and be a workman not ashamed and who correctly handles the&nbsp; Word of Truth, (2 Timothy 4:15) to enter the Bible School to be equipped with the task they were told to do.&nbsp; Ernesto Ellado, Rodolfo Guintu, Nolasco Apolonio headed the Spirits conviction.&nbsp; God did not really abandon them, in fact, with their situation God taught them to use their own effort for the ministry of the Lord.<br /><br />Truly the Lord was with them.&nbsp; He added more souls to the Church.&nbsp; The members assiduously attended seminars about this wonderful life in the Spirit which consequently generated prayer meetings, Bible Studies and other Fellowships.<br /><br />Having the firm assurance and guidance of Gods Word as a Lamp unto my feet and a light unto my path (Psalm 119:105), thirteen of the active members formed and originated the CHRISTIAN CHALLENGE CHURCH, INC.&nbsp; The Securities and Exchange Commission (SEC) recognized the official registration and granted the approval of the organization on January 24, 1984.&nbsp; As elected: Chairman - Ernesto Ellado, Vice Chairman&nbsp; Amado Serrano, Secretary&nbsp; Rodolfo Guintu, Treasurer&nbsp; Gloria Ellado, and Auditor&nbsp; Corazon Serrano.<br /><br />Under the able cooperation of the leaders as well as the members, the work of the Lord grew and prospered continuously.&nbsp; All these work hand in hand in delivering the message of salvation to this world and lead the lost souls to Christ&nbsp; the everlasting Saviour.</p>', 1417777002, 1417777002, 1, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `tags` text,
  `title` text NOT NULL,
  `description` text,
  `date_custom` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `date_created`, `date_modified`, `user_id`, `status`, `tags`, `title`, `description`, `date_custom`) VALUES
(9, 1417770635, 1417770635, 1, 'published', 'dsf sfsf sfsafsd fsdf sdf ,sdf,sdf,sdf ,saf,dsaf,sadf,sda,fs,adf,saf', 'Nyahahaha', '', 0),
(1, 1418015407, 1418015407, 1, 'published', '', 'User Album', '', 0),
(11, 1420375524, 1420375524, 1, 'published', '', 'New Album', '1454428800', 0);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `author_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `church_meta`
--

CREATE TABLE IF NOT EXISTS `church_meta` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `time` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `local_churches`
--

CREATE TABLE IF NOT EXISTS `local_churches` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `img_caption` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `local_churches`
--

INSERT INTO `local_churches` (`id`, `date_created`, `date_modified`, `user_id`, `status`, `title`, `address`, `services`, `pastor_id`, `contact`, `email`, `social`, `bank`, `map_url`, `map_image`, `img_url`, `img_caption`) VALUES
(7, 1419246380, 1419320192, 1, 'published', 'Title only', 'tffgjgthh', '{"title":"Nyajahaja","time":"2:30 am","days":["Sunday","Sunday","Wednesday"]}||{"title":"hfddhhvb","time":"1:00 am","days":["Tuesday"]}||{"title":"Nyahaha","time":"8:30 am","days":["Monday","Sunday"]}', NULL, '', '', NULL, NULL, '', NULL, 'http://ccciweb.2fh.co/public/img/photos/IMG_20140119_080820.jpg', 'sample image...'),
(8, 1420020738, 1420020738, 1, 'published', 'hbvxcff', 'gvvggd', '{"title":"hdbd","time":"3:00 am","days":["Monday"]}', NULL, '', '', NULL, NULL, '', NULL, '', ''),
(9, 1420130597, 1421729435, 1, 'published', 'Another Local Xhurxh', 'hhffjccjvcv', '{"title":"hfdddhv","time":"3:00 am","days":["Sunday"]}', NULL, '', '', NULL, NULL, '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ministry`
--

CREATE TABLE IF NOT EXISTS `ministry` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `description` text,
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
  `img_caption` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ministry_officers`
--

CREATE TABLE IF NOT EXISTS `ministry_officers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `social` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `img_caption` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date_created`, `date_modified`, `user_id`, `status`, `title`, `description`, `summary`, `content`, `date_publish`, `tags`, `img_url`, `img_caption`) VALUES
(21, 1417770954, 1420812433, 1, 'published', 'Coming Soon', 'sdfsdfsdfsfsfsf sfsafsfsaf', '', '<p>sf s sf sdf sf</p>\r\n<p>&nbsp;s</p>\r\n<p>f</p>\r\n<p>s</p>\r\n<p>ds a</p>\r\n<p>sf</p>\r\n<p>saf</p>\r\n<p>sdf</p>\r\n<p>&nbsp;asf</p>', -28800, '', 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', 'dsfsd fsf sfs fsf sf s '),
(22, 1418441365, 1420715156, 1, 'published', 'fdsfs sf dsf s fsd fsda fsdf', ' dsfsd fds fs fsfas fs fs', '', '<p>s fds dsf ds fs fsf s</p>\r\n<p>f sd</p>\r\n<p>fds</p>\r\n<p>fsd fsd fsd fsaf</p>\r\n<p>saf</p>\r\n<p>sa</p>\r\n<p>f s</p>\r\n<p>&nbsp;f</p>\r\n<p>saf sfsf sfsafs</p>\r\n<p>fsd fds</p>', 1393948800, '', 'http://ccciweb.2fh.co/public/img/photos/IMG_20140119_080014.jpg', ''),
(25, 1420293992, 1421729453, 1, 'trash', 'Sample News made using mobile', 'djdhd djdbdjd jd dhd', '', '', 1341590400, '', 'http://ccciweb.2fh.co/public/img/photos/648625_1420293979_01hi.png', ''),
(26, 1420807134, 1420807134, 1, 'published', 'Sample News made using mobile', 'djdhd djdbdjd jd dhd', 'Summary', '<p>Conteny</p>', 1420807134, '', 'http://ccciweb.2fh.co/public/img/photos/648625_1420293979_01hi.png', ''),
(27, 1420807260, 1420807260, 1, 'published', 'Sample News made using mobile', 'djdhd djdbdjd jd dhd', 'Summary', '<p>Hvhh</p>', 1420807260, '', 'http://ccciweb.honor.es/public/img/photos/470195_1420807253_IMG_20130203_073329.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `outreaches`
--

CREATE TABLE IF NOT EXISTS `outreaches` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `img_caption` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `outreaches`
--

INSERT INTO `outreaches` (`id`, `date_created`, `date_modified`, `user_id`, `status`, `title`, `address`, `services`, `pastor_id`, `contact`, `email`, `social`, `bank`, `map_url`, `map_image`, `img_url`, `img_caption`) VALUES
(3, 1419309089, 1419309089, 1, 'published', 'Sample Outreach', 'jhgj hc v hc b v v vvjy gfdhkj jjgg', '{"title":"dfhdgffg gcc gcwv gvh v c x h c","time":"12:00 pm","days":["Sunday","Tuesday"]}||{"title":"dygv c v v g f ggbc cxvb v  v","time":"","days":[]}', 0, '09997650211,1234567', 'qt_gye@yahoo.com', NULL, NULL, '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pastors`
--

CREATE TABLE IF NOT EXISTS `pastors` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `img_thumbnail` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1783 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `date_created`, `date_modified`, `user_id`, `status`, `tags`, `img_url`, `img_title`, `img_caption`, `album_id`, `img_filename`, `img_thumbnail`) VALUES
(1702, 1418038195, 1418038195, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/IMG_20140119_075929.jpg', NULL, NULL, 1, 'IMG_20140119_075929.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/IMG_20140119_075929.jpg'),
(1703, 1418441323, 1418441323, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/IMG_20140119_080014.jpg', NULL, NULL, 1, 'IMG_20140119_080014.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/IMG_20140119_080014.jpg'),
(1704, 1419228923, 1419228923, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/IMG_20130616_182809.jpg', NULL, NULL, 1, 'IMG_20130616_182809.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/IMG_20130616_182809.jpg'),
(1705, 1419230392, 1419230392, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/1359898317971.jpg', NULL, NULL, 1, '1359898317971.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/1359898317971.jpg'),
(1706, 1419230417, 1419230417, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/IMG_20140119_172942.jpg', NULL, NULL, 1, 'IMG_20140119_172942.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/IMG_20140119_172942.jpg'),
(1707, 1419237514, 1419237514, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_892661_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_892661_Subscription_Monthly_M.jpg'),
(1708, 1419237517, 1419237517, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1709, 1419237520, 1419237520, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1710, 1419237623, 1419237623, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_892661_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_892661_Subscription_Monthly_M.jpg'),
(1711, 1419237626, 1419237626, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1712, 1419237630, 1419237630, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1713, 1419237633, 1419237633, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_16607267_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_16607267_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_16607267_Subscription_Monthly_XL.jpg'),
(1714, 1419237634, 1419237634, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_17063449_Subscription_Monthly_XXL.jpg', NULL, NULL, 9, 'Fotolia_17063449_Subscription_Monthly_XXL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_17063449_Subscription_Monthly_XXL.jpg'),
(1715, 1419237635, 1419237635, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_23259051_Subscription_Monthly_XXL.jpg', NULL, NULL, 9, 'Fotolia_23259051_Subscription_Monthly_XXL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_23259051_Subscription_Monthly_XXL.jpg'),
(1716, 1419237638, 1419237638, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_24875627_Subscription_Monthly_XXL.jpg', NULL, NULL, 9, 'Fotolia_24875627_Subscription_Monthly_XXL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_24875627_Subscription_Monthly_XXL.jpg'),
(1717, 1419237649, 1419237649, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_892661_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_892661_Subscription_Monthly_M.jpg'),
(1718, 1419237651, 1419237651, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_892661_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_892661_Subscription_Monthly_M.jpg'),
(1719, 1419237655, 1419237655, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1720, 1419237661, 1419237661, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1721, 1419237663, 1419237663, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_16607267_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_16607267_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_16607267_Subscription_Monthly_XL.jpg'),
(1722, 1419237666, 1419237666, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_17063449_Subscription_Monthly_XXL.jpg', NULL, NULL, 9, 'Fotolia_17063449_Subscription_Monthly_XXL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_17063449_Subscription_Monthly_XXL.jpg'),
(1723, 1419237669, 1419237669, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_23259051_Subscription_Monthly_XXL.jpg', NULL, NULL, 9, 'Fotolia_23259051_Subscription_Monthly_XXL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_23259051_Subscription_Monthly_XXL.jpg'),
(1724, 1419237784, 1419237784, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_892661_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_892661_Subscription_Monthly_M.jpg'),
(1725, 1419237788, 1419237788, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1726, 1419237792, 1419237792, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1727, 1419237794, 1419237794, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_16607267_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_16607267_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_16607267_Subscription_Monthly_XL.jpg'),
(1728, 1419237795, 1419237795, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_17063449_Subscription_Monthly_XXL.jpg', NULL, NULL, 9, 'Fotolia_17063449_Subscription_Monthly_XXL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_17063449_Subscription_Monthly_XXL.jpg'),
(1729, 1419237797, 1419237797, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_23259051_Subscription_Monthly_XXL.jpg', NULL, NULL, 9, 'Fotolia_23259051_Subscription_Monthly_XXL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_23259051_Subscription_Monthly_XXL.jpg'),
(1730, 1419237976, 1419237976, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_892661_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_892661_Subscription_Monthly_M.jpg'),
(1731, 1419237983, 1419237983, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1732, 1419237995, 1419237995, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_892661_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_892661_Subscription_Monthly_M.jpg'),
(1733, 1419237998, 1419237998, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1734, 1419238003, 1419238003, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1735, 1419238118, 1419238118, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1736, 1419238123, 1419238123, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1763, 1420293336, 1420293336, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/791272_1420293336_IMG_20130203_073329.jpg', 'IMG_20130203_073329.jpg', NULL, 1, '791272_1420293336_IMG_20130203_073329.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/791272_1420293336_IMG_20130203_073329.jpg'),
(1738, 1419238188, 1419238188, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1739, 1419238194, 1419238194, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1764, 1420293979, 1420293979, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/648625_1420293979_01hi.png', '01hi.png', NULL, 1, '648625_1420293979_01hi.png', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/648625_1420293979_01hi.png'),
(1741, 1419238242, 1419238242, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1742, 1419238247, 1419238247, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1744, 1419238280, 1419238280, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1745, 1419238285, 1419238285, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1746, 1419238294, 1419238294, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_25618825_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_25618825_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_25618825_Subscription_Monthly_M.jpg'),
(1747, 1419238305, 1419238305, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_892661_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_892661_Subscription_Monthly_M.jpg'),
(1748, 1419238309, 1419238309, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1749, 1419238314, 1419238314, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1750, 1419238601, 1419238601, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, NULL, 9, 'Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1751, 1419238605, 1419238605, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 9, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1752, 1419238612, 1419238612, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_25618825_Subscription_Monthly_M.jpg', NULL, NULL, 9, 'Fotolia_25618825_Subscription_Monthly_M.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_25618825_Subscription_Monthly_M.jpg'),
(1753, 1419238988, 1419238988, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, NULL, 1, 'Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1758, 1419308610, 1419308610, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/IMG_20140119_080820.jpg', NULL, NULL, 1, 'IMG_20140119_080820.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/IMG_20140119_080820.jpg'),
(1757, 1419246341, 1419246341, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/IMG_20140119_075938.jpg', NULL, NULL, 1, 'IMG_20140119_075938.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/IMG_20140119_075938.jpg'),
(1756, 1419246117, 1419246130, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/IMG_20140119_165419.jpg', NULL, 'Lalala', 9, 'IMG_20140119_165419.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/IMG_20140119_165419.jpg'),
(1759, 1420174304, 1420174304, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/132237_1420174303_Chrysanthemum.jpg', 'Chrysanthemum.jpg', NULL, 1, '132237_1420174303_Chrysanthemum.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/132237_1420174303_Chrysanthemum.jpg'),
(1760, 1420174514, 1420174514, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/484564_1420174514_Chrysanthemum.jpg', 'Chrysanthemum.jpg', NULL, 1, '484564_1420174514_Chrysanthemum.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/484564_1420174514_Chrysanthemum.jpg'),
(1761, 1420174548, 1420174548, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/830866_1420174548_Desert.jpg', 'Desert.jpg', NULL, 1, '830866_1420174548_Desert.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/830866_1420174548_Desert.jpg'),
(1762, 1420174575, 1420174575, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/831645_1420174575_Hydrangeas.jpg', 'Hydrangeas.jpg', NULL, 1, '831645_1420174575_Hydrangeas.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/831645_1420174575_Hydrangeas.jpg'),
(1765, 1420374074, 1420374074, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/436606_1420374074_IMG_20130203_073347.jpg', 'IMG_20130203_073347.jpg', NULL, 1, '436606_1420374074_IMG_20130203_073347.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/436606_1420374074_IMG_20130203_073347.jpg'),
(1766, 1420375598, 1420375614, 1, 'published', NULL, 'http://ccciweb.2fh.co/public/img/photos/964501_1420375598_IMG_20130203_091334.jpg', 'IMG_20130203_091334.jpg', 'A sample cat', 11, '964501_1420375598_IMG_20130203_091334.jpg', 'http://ccciweb.2fh.co/public/img/photos/_thumbnails/964501_1420375598_IMG_20130203_091334.jpg'),
(1767, 1420767163, 1420767163, 1, 'published', NULL, 'http://ccciweb.honor.es/public/img/photos/962948_1420767163_Fotolia_892661_Subscription_Monthly_M.jpg', 'Fotolia_892661_Subscription_Monthly_M.jpg', NULL, 1, '962948_1420767163_Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciweb.honor.es/public/img/photos/_thumbnails/962948_1420767163_Fotolia_892661_Subscription_Monthly_M.jpg'),
(1768, 1420807254, 1420807254, 1, 'published', NULL, 'http://ccciweb.honor.es/public/img/photos/470195_1420807253_IMG_20130203_073329.jpg', 'IMG_20130203_073329.jpg', NULL, 1, '470195_1420807253_IMG_20130203_073329.jpg', 'http://ccciweb.honor.es/public/img/photos/_thumbnails/470195_1420807253_IMG_20130203_073329.jpg'),
(1769, 1420807835, 1420807835, 1, 'published', NULL, 'http://ccciweb.honor.es/public/img/photos/529399_1420807835_229202_204486526258453_100000913214209_546189_5592157_a.jpg', '229202_204486526258453_100000913214209_546189_5592157_a.jpg', NULL, 1, '529399_1420807835_229202_204486526258453_100000913214209_546189_5592157_a.jpg', 'http://ccciweb.honor.es/public/img/photos/_thumbnails/529399_1420807835_229202_204486526258453_100000913214209_546189_5592157_a.jpg'),
(1770, 1421737574, 1421737574, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/233646_1421737574_Fotolia_892661_Subscription_Monthly_M.jpg', 'Fotolia_892661_Subscription_Monthly_M.jpg', NULL, 11, '233646_1421737574_Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/233646_1421737574_Fotolia_892661_Subscription_Monthly_M.jpg'),
(1771, 1421737612, 1421737612, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/298914_1421737612_Fotolia_892661_Subscription_Monthly_M.jpg', 'Fotolia_892661_Subscription_Monthly_M.jpg', NULL, 11, '298914_1421737612_Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/298914_1421737612_Fotolia_892661_Subscription_Monthly_M.jpg'),
(1772, 1421737623, 1421737623, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/731385_1421737622_Fotolia_959152_Subscription_Monthly_XL.jpg', 'Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, 11, '731385_1421737622_Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/731385_1421737622_Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1773, 1421737714, 1421737714, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/658257_1421737714_Fotolia_10538144_Subscription_Monthly_L.jpg', 'Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, 11, '658257_1421737714_Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/658257_1421737714_Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1774, 1421737725, 1421737725, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/857885_1421737725_Fotolia_892661_Subscription_Monthly_M.jpg', 'Fotolia_892661_Subscription_Monthly_M.jpg', NULL, 11, '857885_1421737725_Fotolia_892661_Subscription_Monthly_M.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/857885_1421737725_Fotolia_892661_Subscription_Monthly_M.jpg'),
(1775, 1421737731, 1421737731, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/437578_1421737731_Fotolia_959152_Subscription_Monthly_XL.jpg', 'Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, 11, '437578_1421737731_Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/437578_1421737731_Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1776, 1421737738, 1421737738, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/125019_1421737738_Fotolia_10538144_Subscription_Monthly_L.jpg', 'Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, 11, '125019_1421737738_Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/125019_1421737738_Fotolia_10538144_Subscription_Monthly_L.jpg'),
(1777, 1421737743, 1421737743, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/781346_1421737743_Fotolia_16607267_Subscription_Monthly_XL.jpg', 'Fotolia_16607267_Subscription_Monthly_XL.jpg', NULL, 11, '781346_1421737743_Fotolia_16607267_Subscription_Monthly_XL.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/781346_1421737743_Fotolia_16607267_Subscription_Monthly_XL.jpg'),
(1778, 1421737746, 1421737746, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/716416_1421737746_Fotolia_17063449_Subscription_Monthly_XXL.jpg', 'Fotolia_17063449_Subscription_Monthly_XXL.jpg', NULL, 11, '716416_1421737746_Fotolia_17063449_Subscription_Monthly_XXL.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/716416_1421737746_Fotolia_17063449_Subscription_Monthly_XXL.jpg'),
(1779, 1421737749, 1421737749, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/784036_1421737749_Fotolia_23259051_Subscription_Monthly_XXL.jpg', 'Fotolia_23259051_Subscription_Monthly_XXL.jpg', NULL, 11, '784036_1421737749_Fotolia_23259051_Subscription_Monthly_XXL.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/784036_1421737749_Fotolia_23259051_Subscription_Monthly_XXL.jpg'),
(1780, 1421737793, 1421737793, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/546701_1421737793_Fotolia_24875627_Subscription_Monthly_XXL.jpg', 'Fotolia_24875627_Subscription_Monthly_XXL.jpg', NULL, 11, '546701_1421737793_Fotolia_24875627_Subscription_Monthly_XXL.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/546701_1421737793_Fotolia_24875627_Subscription_Monthly_XXL.jpg'),
(1781, 1421737800, 1421737800, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/333878_1421737800_Fotolia_959152_Subscription_Monthly_XL.jpg', 'Fotolia_959152_Subscription_Monthly_XL.jpg', NULL, 11, '333878_1421737800_Fotolia_959152_Subscription_Monthly_XL.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/333878_1421737800_Fotolia_959152_Subscription_Monthly_XL.jpg'),
(1782, 1421737807, 1421737807, 1, 'published', NULL, 'http://ccciwebtest.honor.es/public/img/photos/711892_1421737806_Fotolia_10538144_Subscription_Monthly_L.jpg', 'Fotolia_10538144_Subscription_Monthly_L.jpg', NULL, 11, '711892_1421737806_Fotolia_10538144_Subscription_Monthly_L.jpg', 'http://ccciwebtest.honor.es/public/img/photos/_thumbnails/711892_1421737806_Fotolia_10538144_Subscription_Monthly_L.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `location_id` int(255) DEFAULT NULL,
  `sched` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date_created` int(255) NOT NULL,
  `date_modified` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `date_created`, `date_modified`, `user_id`, `status`, `name`, `title`, `content`, `description`) VALUES
(1, 1419931481, 1422928841, 1, '', 'site_title', 'Site Title', 'CCCI Website', ''),
(3, 1421716128, 1422928841, 1, '', 'site_short_title', 'Short Title', 'CCCI Web', NULL),
(4, 0, 1422928841, 1, '', 'site_status', 'Site Status', '1', 'Sets whether the site is active for visiting, or inactive due to maintenance.');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `img_caption` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `date_created`, `date_modified`, `date_publish`, `user_id`, `status`, `tags`, `title`, `summary`, `description`, `author_id`, `content`, `img_url`, `img_caption`) VALUES
(2, 1421033508, 1421033508, 1421033508, 1, 'published', '', 'Which Way Will You Choose?', 'In the flesh it is easy to take the broad path, but the end result is destruction. Emotions move us to take the easy way, to do what feels good for the moment. Wisdom moves us to take the hard way that leads to life. The question is: Which will we choose? ', 'by Joyce Meyer - posted January 11, 2015', NULL, '<p><em>Enter through the narrow gate; for wide is the gate and spacious and broad is the way that leads away to destruction, and many are those who are entering through it. But the gate is narrow (contracted by pressure) and the way is straitened and compressed that leads away to life, and few are those who find it. </em><br> â€”Matthew 7:13-14</p><p>Here in this passage, Jesus speaks of two different ways: the broad way that leads to destruction and the narrow way that leads to life. As I was meditating on this passage, the Lord spoke to my heart and said, <em>Joyce, on the broad way there is room for all kinds of fleshly things like bitterness and unforgiveness and resentment and vindictiveness. But on the narrow way there is only room for the Spirit.</em></p><p>In the flesh it is easy to take the broad path, but the end result is destruction. Emotions move us to take the easy way, to do what feels good for the moment. Wisdom moves us to take the hard way that leads to life. The question is: Which will we choose?</p><p>No matter what has happened to you in your lifetime, even if you have been abandoned by your spouse or abused by your parents or hurt by your children or others, if you''ll stay on that narrow path and leave all your excess baggage behind, sooner or later you will find the peace, joy, and fulfillment you seek.</p><p>Jesus is the Way, and He has shown us the way in which we are to walk. The Lord has sent upon us His Holy Spirit to lead and guide us in the way we are to go, the narrow way that leads to life and not the broad way that leads to destruction. We must keep walking in the ways of the Lord: <em>And let us not lose heart and grow weary and faint in acting nobly and doing right, for in due time and at the appointed season we shall reap, if we do not loosen and relax our courage and faint. </em>(Galatians 6:9)</p>', 'http://www.h3dwallpapers.com/wp-content/uploads/2014/11/Landscape_sunset.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_first` text NOT NULL,
  `name_last` text NOT NULL,
  `number` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name_first`, `name_middle`, `name_last`, `name_ext`, `nickname`, `birthday`, `sex`, `password`, `contact`, `email`, `img_url`, `img_thumbnail`, `img_caption`, `permission`, `date_created`, `date_modified`, `status`) VALUES
(1, 'qtgye122', 'Jayson', 'Flores', 'Buquia', '', '', '596995200', 'm', '$2a$12$1txy5LtYRJkW4RmgYZbeY.ZQAGaSJ.ntP6kh1HyPtrqTRqsxn1Vd6', '9997650211', 'buquia_jace@yahoo.com', 'http://ccciweb.2fh.co/public/img/photos/648625_1420293979_01hi.png', NULL, '', '1', '', '1421758728', 'active'),
(113, 'jacelysh', 'mary grace', NULL, 'buquia', NULL, NULL, '588528000', 'f', '$2a$12$1YplPT9T5IzCpsX65iyLuuXNZzHHsrL1lMA41GBTRnp6T8wcFXsA6', NULL, 'paglinawan_mgrace@yahoo.com', NULL, NULL, NULL, '3', '1421758938', '1421758938', 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
