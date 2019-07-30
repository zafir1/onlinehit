-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2017 at 10:53 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE IF NOT EXISTS `participants` (
`id` bigint(11) NOT NULL,
  `workshop_id` bigint(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `reg_confirm` int(1) NOT NULL DEFAULT '0',
  `reg_confirm_by` bigint(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reg_on` timestamp NULL DEFAULT NULL,
  `confirm_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `workshop_id`, `user_id`, `reg_confirm`, `reg_confirm_by`, `created`, `reg_on`, `confirm_on`) VALUES
(2, 1, 21, 0, 37, '2017-09-27 07:04:06', '2017-09-01 07:18:31', '2017-09-02 01:22:40'),
(3, 1, 22, 0, 37, '2017-09-27 07:03:08', '2017-08-28 00:30:10', '2017-09-01 07:17:22'),
(4, 1, 23, 0, 39, '2017-09-12 19:36:14', '2017-09-01 04:02:17', '2017-09-01 11:42:14'),
(5, 1, 200, 0, NULL, '2017-09-12 19:38:18', '2017-09-12 19:37:43', NULL),
(7, 2, 22, 0, 20, '2017-09-25 20:14:45', '2017-09-13 02:33:45', '2017-09-18 17:20:45'),
(8, 1, 39, 0, 20, '2017-09-27 07:04:17', '2017-09-18 14:48:44', '2017-09-18 16:37:31'),
(9, 1, 29, 0, 39, '2017-09-26 15:31:47', '2017-09-25 02:12:57', '2017-09-23 09:25:15'),
(10, 3, 20, 0, NULL, '2017-09-26 23:18:44', '2017-09-26 23:18:44', NULL),
(11, 2, 20, 1, 39, '2017-09-28 15:10:31', '2017-09-28 12:22:06', '2017-09-27 12:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE IF NOT EXISTS `workshop` (
`id` bigint(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `club` varchar(20) NOT NULL,
  `fee` int(5) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `payment_venue` varchar(750) NOT NULL,
  `workshop_venue` varchar(1024) DEFAULT NULL,
  `description` text,
  `eheading` varchar(150) NOT NULL,
  `etitle` varchar(250) NOT NULL,
  `reg_on` int(1) NOT NULL DEFAULT '1',
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reg_start_time` timestamp NULL DEFAULT NULL,
  `reg_end_time` timestamp NULL DEFAULT NULL,
  `hash` varchar(50) NOT NULL,
  `added_by` bigint(11) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `reg_off_by` bigint(11) DEFAULT NULL,
  `reg_off_time` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(11) DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL,
  `activity` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`id`, `name`, `club`, `fee`, `phone`, `email`, `payment_venue`, `workshop_venue`, `description`, `eheading`, `etitle`, `reg_on`, `create`, `reg_start_time`, `reg_end_time`, `hash`, `added_by`, `add_time`, `reg_off_by`, `reg_off_time`, `deleted_by`, `delete_time`, `activity`) VALUES
(1, 'Home Automation', 'iete', 400, 9835660347, 'ietehitoffice@gmail.com', 'IETE office', 'MBA seminar hall', '<p>This is the full body of the system. This is the first workshop</p>', 'Envelope heading of first workshop', 'Envelope Title of first workshop', 0, '2017-09-27 05:52:04', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 20, '2017-09-26 22:40:00', 20, '2017-09-26 23:11:31', 1),
(2, 'A CSI workshop', 'csi', 600, 7278288940, 'someone@gmail.com', 'MBA seminar Hall', 'Workshop Venue', '<p>This is the full body of the system.</p>\r\n', 'Envelope heading', 'Envelope Title', 1, '2017-09-25 20:56:37', NULL, NULL, '4fa7de61a3fdfb1ee1eb32d14e245efe', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 'Workshop on Home automation', 'iete', 500, 9835660347, 'someone@onlinehit.co.in', 'Pament venue', 'Workshop Venue', '\r\nBody\r\n\r\n', 'Club Wall Envelope Heading', ' Club Wall Envelope Title', 1, '2017-09-26 23:29:18', NULL, NULL, '01cefd049c28942327a42bd722b5d01f', 20, '2017-09-26 19:26:59', NULL, NULL, NULL, NULL, 0),
(6, 'Title of the workshop', 'iete', 500, 9835660347, 'someone@gmail.com', 'Payment Venue', 'Workshop Venue', '\r\nComplete description of workshop\r\n\r\n', 'Club Wall Envelope Heading', 'Club Wall Envelope Title', 1, '2017-09-26 23:31:21', NULL, NULL, 'b960d0dad398a0e5a44bbad1b6593f13', 20, '2017-09-26 19:31:08', NULL, NULL, NULL, NULL, 0),
(7, 'Title of the workshop', 'iete', 500, 9835660347, 'someone@gmail.com', 'Payment Venue', 'Workshop Venue', '<p><strong>Complete description of workshop</strong></p>\r\n', 'Club Wall Envelope Heading', 'Club Wall Envelope Title', 0, '2017-09-27 05:51:59', NULL, NULL, '5363004ee96cd29bce629ce8e99a7295', 20, '2017-09-26 19:31:49', 20, '2017-09-26 23:34:12', 20, '2017-09-26 23:34:19', 0),
(8, 'Title of the workshop', 'iete', 600, 9835660347, 'someone@gmail.com', 'Payment Venue ', 'Workshop Venue', '<p>This is the&nbsp;<em>Complete description of workshop</em></p>\r\n', 'Club Wall Envelope Heading ', 'Club Wall Envelope Title ', 0, '2017-09-27 05:42:26', NULL, NULL, '0bbd629b2a99ba22cb2febb6feb0b6be', 20, '2017-09-26 19:36:30', 20, '2017-09-27 03:28:00', 20, '2017-09-27 05:42:26', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
