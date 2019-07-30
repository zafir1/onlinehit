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
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`id` bigint(11) NOT NULL,
  `from` bigint(11) NOT NULL,
  `to` bigint(11) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fromv` int(1) NOT NULL DEFAULT '1',
  `tov` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `from`, `to`, `message`, `time`, `fromv`, `tov`) VALUES
(1, 20, 21, 'Hello', '2017-09-14 06:40:35', 1, 1),
(2, 21, 20, 'Hello How are you??????', '2017-09-25 03:40:27', 1, 1),
(3, 20, 38, 'Hello sir how are you? And what is going on. This time I am building a web based chat application. I hope Everything will be fine. Very Soon every problem will be resolved. ', '2017-09-14 07:04:58', 1, 1),
(4, 20, 21, 'Hello bhai', '2017-09-16 06:12:57', 1, 1),
(5, 20, 39, 'HIIII', '2017-09-15 19:58:38', 1, 1),
(6, 20, 38, 'Hello Tilak sir', '2017-09-15 19:57:55', 1, 1),
(7, 20, 39, 'Hello HOD sir', '2017-09-15 19:57:55', 1, 1),
(8, 21, 20, 'Hello bhai', '2017-09-15 19:58:24', 1, 1),
(9, 21, 38, 'Hello Sir Good morning', '2017-09-18 18:37:18', 1, 1),
(10, 20, 39, 'Hello good morning', '2017-09-20 01:21:39', 1, 1),
(11, 20, 21, 'HI bhai kaise ho?', '2017-09-20 01:24:11', 1, 1),
(12, 20, 39, 'Good morning sir how are you?', '2017-09-20 01:26:42', 1, 1),
(13, 21, 20, 'Haan bhai achhe hain....', '2017-09-20 01:37:58', 1, 1),
(14, 21, 20, 'and how are you?', '2017-09-20 01:41:49', 1, 1),
(15, 20, 21, 'Good morning', '2017-09-20 10:10:45', 1, 1),
(21, 21, 38, 'Hi, Good morning', '2017-09-20 11:27:42', 1, 1),
(22, 21, 38, 'I think this is working.....', '2017-09-20 11:31:21', 1, 1),
(23, 20, 21, 'This is a testing message', '2017-09-20 11:38:48', 1, 1),
(24, 21, 20, 'Hello bhai kaise ho?', '2017-09-20 11:49:15', 1, 1),
(25, 20, 21, 'Hmm main achha hun aur tum batao', '2017-09-20 11:49:37', 1, 1),
(26, 20, 21, 'Kya kar rahe ho?', '2017-09-20 11:50:20', 1, 1),
(27, 21, 20, 'Just building a web-chat application........', '2017-09-20 11:51:03', 1, 1),
(28, 21, 20, 'I hope everything will be fine.......', '2017-09-20 11:51:23', 1, 1),
(29, 20, 21, 'Hmmmmm', '2017-09-20 11:51:31', 1, 1),
(30, 38, 21, 'Hello', '2017-09-20 11:55:03', 1, 1),
(31, 21, 38, 'Hello sir,', '2017-09-20 11:58:58', 1, 1),
(32, 21, 38, 'wow, This is working and it is awsome.......', '2017-09-20 11:59:19', 1, 1),
(33, 38, 21, 'Hmm, yeah.......... This is working......', '2017-09-20 12:01:10', 1, 1),
(34, 38, 21, 'Great, Now we are having our own real time chatting application......', '2017-09-20 12:01:53', 1, 1),
(35, 38, 20, 'Hmm nice....', '2017-09-20 12:11:39', 1, 1),
(36, 38, 20, 'Great work man....... It is working.....', '2017-09-20 12:12:07', 1, 1),
(37, 20, 38, 'I think some It can be improved much more....', '2017-09-20 12:12:33', 1, 1),
(38, 38, 20, 'hmmmm', '2017-09-20 12:12:40', 1, 1),
(39, 21, 38, 'I also think .... about some more Improvement......', '2017-09-20 12:14:31', 1, 1),
(40, 38, 21, 'Yup, It is necessary....', '2017-09-20 12:15:15', 1, 1),
(41, 20, 21, 'Hi', '2017-09-20 14:24:06', 1, 1),
(42, 20, 21, 'I am just testing the message box..... I hope everything will be fine', '2017-09-20 14:24:48', 1, 1),
(43, 20, 21, 'Color checking', '2017-09-20 14:39:24', 1, 1),
(44, 21, 20, 'Hello bahi ', '2017-09-20 15:05:03', 1, 1),
(45, 20, 21, 'HI kaise ho', '2017-09-20 15:05:11', 1, 1),
(46, 20, 21, 'aaj chalo aala party dega tum bola th bhai ka bhu me hua th tb', '2017-09-20 15:05:57', 1, 1),
(47, 20, 21, 'hi', '2017-09-20 15:37:04', 1, 1),
(48, 20, 37, 'Hi', '2017-09-20 16:05:03', 1, 1),
(49, 37, 20, 'hello hioojl', '2017-09-20 16:06:01', 1, 1),
(50, 20, 38, 'Hello sir how a', '2017-09-20 16:17:48', 1, 1),
(51, 38, 20, 'hiii', '2017-09-20 16:17:56', 1, 1),
(52, 20, 38, 'hiiiiii.....', '2017-09-21 04:52:12', 1, 1),
(53, 20, 21, 'Hello bhai kaise ho?', '2017-09-22 02:33:55', 1, 1),
(54, 20, 38, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi doloribus eum officiis voluptatum, provident reiciendis, facilis, voluptatibus necessitatibus dolorum non et suscipit incidunt autem ad? Odit optio quod nemo fugiat expedita unde quasi quas, error deleniti dolore non necessitatibus laborum, iure neque quisquam reiciendis placeat corporis? Veniam nisi vel autem atque id excepturi, natus at inventore reprehenderit magni similique, dolore.', '2017-09-23 16:05:16', 1, 1),
(55, 38, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi doloribus eum officiis voluptatum, provident reiciendis, facilis, voluptatibus necessitatibus dolorum non et suscipit incidunt autem ad? Odit optio quod nemo fugiat expedita unde quasi quas, error deleniti dolore non necessitatibus laborum, iure neque quisquam reiciendis placeat corporis? Veniam nisi vel autem atque id excepturi, natus at inventore reprehenderit magni similique, dolore.\\\\n\\\\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi doloribus eum officiis voluptatum, provident reiciendis, facilis, voluptatibus necessitatibus dolorum non et suscipit incidunt autem ad? Odit optio quod nemo fugiat expedita unde quasi quas, error deleniti dolore non necessitatibus laborum, iure neque quisquam reiciendis placeat corporis? Veniam nisi vel autem atque id excepturi, natus at inventore reprehenderit magni similique, dolore.', '2017-09-23 16:06:43', 1, 1),
(56, 20, 37, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi doloribus eum officiis voluptatum, provident reiciendis, facilis, voluptatibus necessitatibus dolorum non et suscipit incidunt autem ad? Odit optio quod nemo fugiat expedita unde quasi quas, error deleniti dolore non necessitatibus laborum, iure neque quisquam reiciendis placeat corporis? Veniam nisi vel autem atque id excepturi, natus at inventore reprehenderit magni similique, dolore.', '2017-09-23 16:29:08', 1, 1),
(57, 20, 37, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi doloribus eum officiis voluptatum, provident reiciendis, facilis, voluptatibus necessitatibus dolorum non et suscipit incidunt autem ad? Odit optio quod nemo fugiat expedita unde quasi quas, error deleniti dolore non necessitatibus laborum, iure neque quisquam reiciendis placeat corporis? Veniam nisi vel autem atque id excepturi, natus at inventore reprehenderit magni similique, dolore. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi doloribus eum officiis voluptatum, provident reiciendis, facilis, voluptatibus necessitatibus dolorum non et suscipit incidunt autem ad? Odit optio quod nemo fugiat expedita unde quasi quas, error deleniti dolore non necessitatibus laborum, iure neque quisquam reiciendis placeat corporis? Veniam nisi vel autem atque id excepturi, natus at inventore reprehenderit magni similique, dolore.', '2017-09-23 16:31:14', 1, 1),
(58, 20, 37, 'Hello sir how are you', '2017-09-24 23:52:50', 1, 1),
(59, 37, 20, 'I am fine.... nd whats abt you???', '2017-09-24 23:53:06', 1, 1),
(60, 20, 37, 'Hiiii', '2017-09-25 02:17:09', 1, 1),
(61, 37, 20, 'Hello', '2017-09-25 02:17:16', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
