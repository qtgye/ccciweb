
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2015 at 11:08 PM
-- Server version: 5.1.61
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u137518590_ccci`
--

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `img_url`, `img_caption`, `content`, `date_created`, `date_modified`, `user_id`, `status`) VALUES
(86, 'Mission', 'Vision Statement of CCCI', '', '', '<p>And He (Jesus) said to them, Go into all the world and preach the Gospel <br />to the whole creation.&nbsp; In my name they will cast out demons; <br />they will speak in new tongues;&nbsp; they will lay their hands on the sick, <br />and they will recover.&nbsp; And they went forth and preached everywhere, while the Lord worked with them and confirmed the message <br />by the signs that attended it.&nbsp; Amen.<br />(Mark 16:15-20)<br /><br />We are called by God to preach and teach the whole counsel of God in Word and in deed; but not with enticing words of mens wisdom, <br />but by demonstration of the Spirit and power. &nbsp;<br />In the Name of Jesus Christ who will have all men to be save <br />and come to the knowledge of the truth.<br />(1 Cor. 2:4; Acts 20:27; Phil. 4:9; 1 Tim. 2:4-5)</p>', 1417776119, 1417776119, 1, 'published'),
(87, 'Vision', 'Vision Statement of CCCI', '', '', '<p>All men to be saved and come to the knowledge of truth till He (JESUS) comes<br /><br /><br />OUR VISION STATEMENTS:<br /><br />1.We, envision that the Kingdom of Christ and Kingdom of the Gospel may establish in every individual behaviors, a total change life, submitted and committed to God.&nbsp; "The Lord will establish you as a people holy to Himself."<br /><br />2.We, envision that each believers life is influencer of Christ Jesus in their household and community.&nbsp; A church (individual) which made not to isolate their life away from sinners but friend of them in order to win them and to be part of the family of God.&nbsp; "so that Christ may dwell in your hearts through faith--that you, being rooted and grounded in love,"<br /><br />3.We, envision that every believers who are doers of Gods Word and prosperous in their financial and material possession responding to the call of God to have a ministry of giving, help on all ministry endeavor of the church.&nbsp; "And all these blessings shall come upon you and overtake you, if you obey the voice of the LORD your God"<br /><br />4.We, envision to trained more servants and handmaids all over the world.&nbsp; In order to become workers of JESUS CHRIST who are aggressive, enthusiastic, excited, very passionate to love Jesus and passionate to love the lost souls, passionate to pray and become intercessor and watchmen.<br /><br />5.We, envision that every believer should be a winner, victorious and no room for being a loser.&nbsp; "The LORD will cause your enemies who rise against you to be defeated before you. They shall come out against you one way and flee before you seven ways."<br /><br />Deuteronomy 28:1-14, 1Timothy 2:4-5, Ephesians 3:14-21</p>', 1417776166, 1417776166, 1, 'published'),
(88, 'Brief History', '', '', '', '<p>It was in the year 1979 that God through the Holy Spirit let the residents of Barrio Magsaysay felt what the Word of God describes as the regeneration of the human heart commonly known as the Born Again experience (John 3:3, 6).&nbsp; A home Bible Study was then held in order to fill the fervent desire of the new believers to be fully enlightened with the all powerful and life&nbsp; giving Word of God.&nbsp; Their confession of what was promised by the Word that I will be with thee always even unto the end of the ages (Matthew 28:20), was fulfilled because a lot of people also experienced the mighty moving of the Holy Spirit through some faithful workers of Christ who bravely preached the Word.<br /><br />The believers, in faithful obedience to God, answered the need for an organized fellowship because of their increasing number.&nbsp; On July 10, 1979, the group was named Christian Challenge Center.&nbsp; Through the regular visits of some of the students of FEAST, which are: Sister Rodelyn Lasquite, Sister Monica Sayang and Sister Lilia Tan, the fellowship grew and prospered.&nbsp; As they heartily and conscientiously studied, understood and acted upon the Word of God, they created different ministries to boost the Work of God namely, Sunday School, Music Ministry, Christ Ambassador of the Young People, Mens Fellowship, Womens Fellowship.<br /><br />In June 1982, the FEAST student left to minister in the provinces, nevertheless, GOD called three of His sons with eager desire to serve Him and be a workman not ashamed and who correctly handles the&nbsp; Word of Truth, (2 Timothy 4:15) to enter the Bible School to be equipped with the task they were told to do.&nbsp; Ernesto Ellado, Rodolfo Guintu, Nolasco Apolonio headed the Spirits conviction.&nbsp; God did not really abandon them, in fact, with their situation God taught them to use their own effort for the ministry of the Lord.<br /><br />Truly the Lord was with them.&nbsp; He added more souls to the Church.&nbsp; The members assiduously attended seminars about this wonderful life in the Spirit which consequently generated prayer meetings, Bible Studies and other Fellowships.<br /><br />Having the firm assurance and guidance of Gods Word as a Lamp unto my feet and a light unto my path (Psalm 119:105), thirteen of the active members formed and originated the CHRISTIAN CHALLENGE CHURCH, INC.&nbsp; The Securities and Exchange Commission (SEC) recognized the official registration and granted the approval of the organization on January 24, 1984.&nbsp; As elected: Chairman - Ernesto Ellado, Vice Chairman&nbsp; Amado Serrano, Secretary&nbsp; Rodolfo Guintu, Treasurer&nbsp; Gloria Ellado, and Auditor&nbsp; Corazon Serrano.<br /><br />Under the able cooperation of the leaders as well as the members, the work of the Lord grew and prospered continuously.&nbsp; All these work hand in hand in delivering the message of salvation to this world and lead the lost souls to Christ&nbsp; the everlasting Saviour.</p>', 1417777002, 1417777002, 1, 'published');

--
-- Dumping data for table `pastors`
--

INSERT INTO `pastors` (`id`, `name_first`, `name_middle`, `name_last`, `name_ext`, `sex`, `birthday`, `nickname`, `contact`, `email`, `social`, `biography`, `img_url`, `img_caption`, `date_created`, `date_modified`, `user_id`, `status`) VALUES
(14, 'Joel', '', 'Serrano', '', 'm', 796665600, '', NULL, '', NULL, '<p>This is just a sample entry. Please replace all the information.</p>', 'http://www.balita.com/wp-content/uploads/2014/03/01dingdong.jpg', '', 1428241388, 1428241388, 1, 'published');

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `date_created`, `date_modified`, `user_id`, `status`, `name`, `title`, `content`, `description`) VALUES
(1, 1419931481, 1422928841, 1, '', 'site_title', 'Site Title', 'CCCI Website', ''),
(3, 1421716128, 1422928841, 1, '', 'site_short_title', 'Short Title', 'CCCI Web', NULL),
(4, 0, 1422928841, 1, '', 'site_status', 'Site Status', '1', 'Sets whether the site is active for visiting, or inactive due to maintenance.');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name_first`, `name_middle`, `name_last`, `name_ext`, `nickname`, `birthday`, `sex`, `password`, `contact`, `email`, `img_url`, `img_thumbnail`, `img_caption`, `permission`, `date_created`, `date_modified`, `status`) VALUES
(1, 'qtgye122', 'Jayson', 'Flores', 'Buquia', '', '', '596995200', 'm', '$2a$12$1txy5LtYRJkW4RmgYZbeY.ZQAGaSJ.ntP6kh1HyPtrqTRqsxn1Vd6', '9997650211', 'buquia_jace@yahoo.com', 'http://ccciweb.2fh.co/public/img/photos/648625_1420293979_01hi.png', NULL, '', '1', '', '1421758728', 'active'),
(113, 'jacelysh', 'mary grace', NULL, 'buquia', NULL, NULL, '588528000', 'f', '$2a$12$1YplPT9T5IzCpsX65iyLuuXNZzHHsrL1lMA41GBTRnp6T8wcFXsA6', NULL, 'paglinawan_mgrace@yahoo.com', NULL, NULL, NULL, '3', '1421758938', '1421758938', 'active'),
(114, 'qtgye005', 'Jayson', NULL, 'Buquia', NULL, NULL, '596995200', 'm', '$2a$12$To2d5gxAs33a5w7IooEwCuFCBrd7olXeNkJPF6tLTD0N7uGKj/5fa', NULL, 'isi.jaysonbuquia@gmail.com', NULL, NULL, NULL, '3', '1427951847', '1427951847', 'waiting');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
