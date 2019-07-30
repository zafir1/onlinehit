-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2017 at 10:42 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lr`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE IF NOT EXISTS `book_list` (
`book_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `semester` int(1) NOT NULL DEFAULT '0',
  `department` varchar(6) NOT NULL DEFAULT 'ece',
  `quantity` int(11) NOT NULL,
  `total_rating` int(6) NOT NULL DEFAULT '0',
  `raters` int(6) NOT NULL DEFAULT '0',
  `avg_rating` float NOT NULL DEFAULT '0',
  `shelf_number` int(6) NOT NULL,
  `rack_number` int(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` bigint(11) NOT NULL,
  `add_time` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(11) NOT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(11) NOT NULL,
  `hidden` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`book_id`, `book_name`, `author`, `subject`, `subject_code`, `publisher`, `semester`, `department`, `quantity`, `total_rating`, `raters`, `avg_rating`, `shelf_number`, `rack_number`, `time`, `added_by`, `add_time`, `updated_by`, `updated_time`, `deleted_by`, `hidden`) VALUES
(1, 'Numerical Methods', 'S. Arumugum', '', 'MCS301', 'schitech', 3, 'ece', 5, 100, 10, 3, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(2, '	Numerical Methods in Engineering & Science', 'K. Sankara Rao', '', 'MCS301', 'eee', 3, 'ece', 6, 100, 20, 5, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(3, 'Networks and systems', 'D. Roy Choudhary', '', 'EC301', 'TMH', 0, 'ece', 1, 0, 0, 0, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(4, 'Circuital theory', 'T. Mukherjee', '', 'EC301', 'schitech', 3, 'ece', 10, 0, 0, 0, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(5, 'Numerical Mathematical Analysis.', 'J.B.Scarborough', '', 'MCS301', 'bpb', 2, 'ece', 5, 0, 0, 4, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(6, 'Higher Engineering Mathematics', 'Grewal B S', '', 'M302', 'Khanna publishers', 3, 'ece', 6, 0, 0, 0, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(7, 'A.B.Carlson-Circuits', 'A.B.Carlson', '', 'EC301', 'Cenage Learning', 3, 'ece', 6, 0, 0, 0, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(8, 'Electronics Devices and Circuits', 'Milman, Halkias & Jit', '', 'EC302', 'TMH', 3, 'ece', 0, 0, 0, 0, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(9, 'Signals and Systems', 'C-T Chen', '', 'EC303', 'Oxford', 3, 'ece', 8, 0, 0, 0, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(10, 'Microelectronic Circuits', 'Sedra & Smith', '', 'EC304', 'Oxford', 3, 'ece', 9, 0, 0, 0, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0),
(11, 'Design with Operational Amplifiers & Analog Integrated Circuits', 'Franco', '', 'EC304', 'TMH', 3, 'ece', 5, 0, 0, 0, 0, 0, '2017-09-05 04:42:42', 0, NULL, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `club_news`
--

CREATE TABLE IF NOT EXISTS `club_news` (
`id` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `group_name` varchar(10) NOT NULL,
  `heading` varchar(75) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `slug` varchar(32) NOT NULL,
  `generated` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `hidden` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_news`
--

INSERT INTO `club_news` (`id`, `posted_by`, `group_name`, `heading`, `title`, `body`, `slug`, `generated`, `created`, `updated`, `updated_by`, `deleted`, `deleted_by`, `hidden`) VALUES
(2, 20, 'ieee', 'Second testing header!', 'Second post for IETE from onlineHIT', 'Welcome to the second post for IETE from OnlineHIT.', '5f3829b2f35a661b07f08b6fa7550830', NULL, '2017-08-23 21:51:33', NULL, NULL, NULL, NULL, 0),
(8, 20, 'ieee', 'Second testing header!', 'Second post for IETE from onlineHIT', 'Welcome to the second post for IETE from OnlineHIT.', '5f3829b2f35a661b07f08b6fa7550830', NULL, '2017-08-23 21:51:33', NULL, NULL, NULL, NULL, 0),
(9, 20, 'needs', 'Needs Header at OnlineHIT', 'Every Life is worthy', 'Welcome to the Message of NEEDS', 'bfe8e1d2f6245e2bf5d8511e988c0a74', '2017-07-18 06:36:14', '2017-08-23 21:51:33', NULL, NULL, NULL, NULL, 0),
(14, 22, 'needs', 'Needs News', 'New news from NEEDS', '<h2><strong><em>1.&nbsp; I&#39;m selfish, impatient and a little insecure. I make mistakes, I am out of control and at times hard to handle. But if you can&#39;t handle me at my worst, then you sure as hell don&#39;t deserve me at my best.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </em></strong></h2>\r\n\r\n<h3><strong><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ~</em></strong>Marilyn Monroe</h3>\r\n', '2068817b085e76b9bd8ca6a35d07cd51', NULL, '2017-08-23 21:51:33', NULL, NULL, NULL, NULL, 0),
(16, 20, 'iete', 'Time testing', 'Time testing of generated, created, updated', '<p>I hope this will be successful.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>updated</p>\r\n', '180fcb83879292150cd5745cb429707c', '2017-07-19 23:18:20', '2017-08-23 21:55:51', '2017-08-23 21:55:32', 20, '2017-08-23 21:55:51', 20, 1),
(17, 34, 'asphalt', 'Asphalt', 'Asphalt welcomes OnlineHIT', '<h3>Hello Friends,</h3>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We welcome OnlineHIT and we are also appriciating the work done by the team members.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Thank You.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2f1d566f9bcd98b81458834cb4a20875', '2017-07-19 23:31:00', '2017-08-23 21:51:33', NULL, NULL, NULL, NULL, 0),
(18, 20, 'iete', 'Another Testing page', 'We are constantly checking different pages', '<h2>OnlineHIT</h2>\r\n\r\n<p>Hello Friends,</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Just for checking purposes I am&nbsp; adding these pages. I hope everything will be fine and OnlineHIT will be live on real server very soon.</p>\r\n\r\n<p>Thank you.</p>\r\n\r\n<p><a href="https://www.facebook.com/zafirzan"><img alt="zafir" src="https://scontent.fpat1-1.fna.fbcdn.net/v/t1.0-0/s480x480/20156054_1942436802704721_5504777628498350069_n.jpg?oh=e3b9b7ec64c3f51d7fdbb31db8091ad0&amp;oe=5A00DF3A" style="border-style:solid; border-width:2px; height:178px; margin-left:120px; margin-right:120px; width:231px" /></a></p>\r\n\r\n<p><a href="https://www.facebook.com/zafirzan">~Zafir Ahmad</a></p>\r\n\r\n<p>modified AGAIN and again</p>\r\n', '0cc4d10b0238a13a2bffc5858825f1c5', '2017-07-20 02:45:05', '2017-08-26 21:50:52', '2017-08-26 21:50:52', 20, '2017-07-20 20:19:16', 20, 0),
(23, 20, 'iete', 'Testing Header', 'Testing Title', '<p>Testing body</p>\r\n\r\n<p>mODIFIED</p>\r\n', 'fe8c0a91f883738a77b148eb2ca9d2ca', '2017-08-09 11:37:32', '2017-08-26 21:49:06', '2017-08-26 21:49:06', 20, NULL, NULL, 0),
(24, 20, 'iete', 'IETE testing header', 'testing title', '<p>Hello Onlinehit</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>akljdsfk</p>\r\n\r\n<p>modified again</p>\r\n\r\n<p>&nbsp;</p>\r\n', '46e327f1fb76d6fc459b89c1028abc90', '2017-08-15 22:53:13', '2017-08-23 21:56:55', '2017-08-23 21:56:55', 20, '2017-08-23 21:50:00', 20, 0),
(25, 20, 'iete', 'The Story of the Blue Jackal', 'A story just for Kids', '<p>Once, there lived a jackal named Chandarava.&nbsp;<br />\r\n&nbsp;<br />\r\nOne day he was very hungry, and could not find any food.&nbsp;</p>\r\n\r\n<p><img alt="Story Of The Blue Jackal - Panchatantra Story Picture" src="http://www.talesofpanchatantra.com/common/panchatantra-story-blue-jackal_01.png" /></p>\r\n\r\n<p>So, he wandered into a nearby village in search of food.&nbsp;<br />\r\n&nbsp;<br />\r\nThe dogs in the village saw the jackal, and a group of dogs surrounded him, barking and attacking with their sharp teeth.&nbsp;<br />\r\n&nbsp;<br />\r\nThe jackal started running to save itself, but the dogs chased.&nbsp;<br />\r\n&nbsp;<br />\r\nIn an attempt to flee from the dogs, he ran into a house, which belonged to a washerman.&nbsp;<br />\r\n&nbsp;<br />\r\nThere was a big vat of blue dye inside.&nbsp;<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt="Story Of The Blue Jackal - Panchatantra Story Picture" src="http://www.talesofpanchatantra.com/common/panchatantra-story-blue-jackal_02.png" /></p>\r\n\r\n<p>As he jumped without knowing, his entire body was dyed in blue colour. He no longer looked like a jackal.&nbsp;<br />\r\n&nbsp;<br />\r\nFrustrated, he came out. When the dogs saw him again, they were unable to recognize him anymore. Fearing that it was an unknown animal, they became terrified and ran off in all directions.&nbsp;<br />\r\n&nbsp;<br />\r\nThe disappointed jackal went back to the jungle, but the blue dye would not come off.&nbsp;<br />\r\n&nbsp;<br />\r\nWhen the other animals in the jungle saw this blue-coloured jackal, they ran away in terror. They said to themselves, &quot;This is an unknown animal, and we don&#39;t know the strength of this new animal. It is better to run away.&quot;&nbsp;<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt="Story Of The Blue Jackal - Panchatantra Story Picture" src="http://www.talesofpanchatantra.com/common/panchatantra-story-blue-jackal_03.png" /></p>\r\n\r\n<p>When the jackal realized that all the animals were running away. He called back at the frightened animals and said, &quot;Hey animals! Why are you running away? Don&#39;t be afraid. Brahma, the Lord of all creations, has me made me himself, with his own hands. Brahma said to me, &#39;The animals in the jungle do not have a proper king. Go to the jungle and protect the animals.&#39;&quot;&nbsp;<br />\r\n&nbsp;<br />\r\n&quot;That is the reason I have come here&quot;, he continued, &quot;Come and live in peace in my kingdom and under my protection. I have been crowned the King of all three worlds (Heaven, Earth and Hell)&nbsp;<br />\r\n&nbsp;<br />\r\nThe other animals were convinced, and they surrounded him as his subjects, and said &quot;O Master, we await your commands. Please let us know whatever you want&quot;.&nbsp;<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt="Story Of The Blue Jackal - Panchatantra Story Picture" src="http://www.talesofpanchatantra.com/common/panchatantra-story-blue-jackal_04.png" /></p>\r\n\r\n<p>The &#39;blue&#39; jackal assigned specific responsibilities to every animal. They were mostly on how to serve him. But he did not have anything to do with the other jackals, and did not want to come near them in fear of being recognized. So, the jackals of the jungle were chased away.&nbsp;<br />\r\n&nbsp;<br />\r\nAnd so it went, while the smaller animals would serve him with his other needs, the lions and the tigers would go out to hunt for prey, and place them before the jackal every day.&nbsp;<br />\r\n&nbsp;<br />\r\nHe would then distribute the food amongst other animals, and himself.&nbsp;<br />\r\n&nbsp;<br />\r\nIn this manner, he discharged his royal duties, for all the animals under his kingdom.&nbsp;<br />\r\n&nbsp;<br />\r\nQuite some time elapsed in this way, and there was peace between animals.&nbsp;<br />\r\n&nbsp;<br />\r\nOne evening, the &#39;blue&#39; jackal heard a pack of jackals howling at a distance.&nbsp;<br />\r\n&nbsp;<br />\r\nUnable to overcome his natural instinct, he was so spellbound that he was filled with tears of joy. He immediately sat up, and began to howl like every other jackal.&nbsp;<br />\r\n&nbsp;</p>\r\n\r\n<p><img alt="Story Of The Blue Jackal - Panchatantra Story Picture" src="http://www.talesofpanchatantra.com/common/panchatantra-story-blue-jackal_05.png" /></p>\r\n\r\n<p>When the lion and the other animals heard this, they realized how he was only a jackal and how they have been fooled all the time.&nbsp;<br />\r\n&nbsp;<br />\r\nThey held their heads down in shame, but only for a moment - because, they became very angry on the jackal for fooling them.&nbsp;<br />\r\n&nbsp;<br />\r\nThey angrily said to each other, &quot;This jackal has fooled us. We will not let him live anymore. He should be punished.&quot;&nbsp;<br />\r\n&nbsp;<br />\r\nWhen the jackal realized, he tried to flee from them. But the animals got hold of him and he got severely beaten by them.&nbsp;<br />\r\n&nbsp;<br />\r\nThe wise indeed say:<br />\r\n<strong><em>One, who treats his own people with scorn, shall surely suffer a bitter end.</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><em>modified again</em></strong></p>\r\n', '93f3bec4035a048039c0e28396b62486', '2017-08-23 22:01:38', '2017-08-26 00:01:56', '2017-08-26 00:01:56', 20, NULL, NULL, 0),
(26, 20, 'iete', 'Testing heading agian', 'testing version of title', '<p>body</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>modified</p>\r\n', 'dae04a703377e902fdb673c839de79d8', '2017-08-26 00:03:19', '2017-08-26 00:14:21', '2017-08-26 00:04:38', 20, '2017-08-26 00:14:21', 20, 1),
(27, 20, 'iete', 'Just another testing header', 'It is another testing title', '<p>It is also another testing title.</p>\r\n\r\n<p>CHANGED</p>\r\n', 'c2d9f2a79172f3b0c7844be296ae834d', '2017-08-26 00:15:23', '2017-08-26 21:47:08', '2017-08-26 21:46:47', 20, '2017-08-26 21:47:08', 20, 1),
(28, 20, 'iete', 'Artificial Inteligence', 'AI is coming. Is it boon or ban?', '<p>Thought-capable artificial beings have appeared as storytelling devices since antiquity.<a href="https://en.wikipedia.org/wiki/Artificial_intelligence#cite_note-AI_in_myth-19">[19]</a></p>\r\n\r\n<p>The implications of a constructed machine exhibiting artificial intelligence have been a persistent theme in&nbsp;<a href="https://en.wikipedia.org/wiki/Science_fiction">science fiction</a>&nbsp;since the twentieth century. Early stories typically revolved around intelligent robots. The word &quot;robot&quot; itself was coined by&nbsp;<a href="https://en.wikipedia.org/wiki/Karel_%C4%8Capek">Karel ÄŒapek</a>&nbsp;in his 1921 play&nbsp;<em><a href="https://en.wikipedia.org/wiki/R.U.R.">R.U.R.</a></em>, the title standing for &quot;<a href="https://en.wikipedia.org/wiki/Rossum%27s_Universal_Robots">Rossum&#39;s Universal Robots</a>&quot;. Later, the SF writer&nbsp;<a href="https://en.wikipedia.org/wiki/Isaac_Asimov">Isaac Asimov</a>&nbsp;developed the&nbsp;<a href="https://en.wikipedia.org/wiki/Three_Laws_of_Robotics">Three Laws of Robotics</a>&nbsp;which he subsequently explored in a long series of robot stories. Asimov&#39;s laws are often brought up during layman discussions of machine ethics;<a href="https://en.wikipedia.org/wiki/Artificial_intelligence#cite_note-279">[279]</a>&nbsp;while almost all artificial intelligence researchers are familiar with Asimov&#39;s laws through popular culture, they generally consider the laws useless for many reasons, one of which is their ambiguity.<a href="https://en.wikipedia.org/wiki/Artificial_intelligence#cite_note-280">[280]</a></p>\r\n\r\n<p>The novel&nbsp;<em><a href="https://en.wikipedia.org/wiki/Do_Androids_Dream_of_Electric_Sheep%3F">Do Androids Dream of Electric Sheep?</a></em>, by&nbsp;<a href="https://en.wikipedia.org/wiki/Philip_K._Dick">Philip K. Dick</a>, tells a science fiction story about Androids and humans clashing in a futuristic world. Elements of artificial intelligence include the empathy box, mood organ, and the androids themselves. Throughout the novel, Dick portrays the idea that human subjectivity is altered by technology created with artificial intelligence.<a href="https://en.wikipedia.org/wiki/Artificial_intelligence#cite_note-281">[281]</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href="http://bestanimations.com/Nature/nature-waterfall-animated-gif-7.gif" target="_blank"><img alt="cascading waterfall beautiful nature animated gif" src="http://bestanimations.com/Nature/nature-waterfall-animated-gif-7.gif" style="border-style:solid; border-width:1px; height:75%; width:75%" /></a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nowadays AI is firmly rooted in popular culture; intelligent robots appear in innumerable works.&nbsp;<a href="https://en.wikipedia.org/wiki/HAL_9000">HAL</a>, the murderous computer in charge of the spaceship in&nbsp;<em><a href="https://en.wikipedia.org/wiki/2001:_A_Space_Odyssey">2001: A Space Odyssey</a></em>(1968), is an example of the common &quot;robotic rampage&quot; archetype in science fiction movies.&nbsp;<em><a href="https://en.wikipedia.org/wiki/The_Terminator">The Terminator</a></em>&nbsp;(1984) and&nbsp;<em><a href="https://en.wikipedia.org/wiki/The_Matrix">The Matrix</a></em>&nbsp;(1999) provide additional widely familiar examples. In contrast, the rare loyal robots such as Gort from&nbsp;<em><a href="https://en.wikipedia.org/wiki/The_Day_the_Earth_Stood_Still">The Day the Earth Stood Still</a></em>&nbsp;(1951) and Bishop from&nbsp;<em><a href="https://en.wikipedia.org/wiki/Aliens_(film)">Aliens</a></em>&nbsp;(1986) are less prominent in popular culture.<a href="https://en.wikipedia.org/wiki/Artificial_intelligence#cite_note-282">[282]</a></p>\r\n', 'fcd0b1904495b36f01afa7359e279ab1', '2017-09-12 21:53:21', '2017-09-12 22:05:14', '2017-09-12 22:05:14', 20, NULL, NULL, 0),
(29, 20, 'iete', 'aaaaaa', 'aaa', '<p><strong>C:Users\ZAFIRAppDataRoamingSublime Text 3Packages</strong></p>\r\n', '08447056afc3ab7284e89d8e23e50694', '2017-09-14 07:15:58', '2017-09-25 00:02:05', NULL, NULL, '2017-09-25 00:02:05', 20, 1),
(30, 20, 'iete', 'This is new post', 'This is a title of this new post', '<p>Hello OnlineHIT</p>\r\n\r\n<p>MOdified version.......</p>\r\n', '08f5e2d6dda633dcaa6ffad84ad57571', '2017-09-25 00:02:42', '2017-09-26 22:01:19', '2017-09-26 22:01:19', 20, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_detail_list`
--

CREATE TABLE IF NOT EXISTS `faculty_detail_list` (
`id` bigint(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` bigint(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_detail_list`
--

INSERT INTO `faculty_detail_list` (`id`, `email`, `mobile`) VALUES
(1, 'arfun_nisha@gmail.com', 9835660347),
(2, 'faiyaz@gmail.com', 9721037498);

-- --------------------------------------------------------

--
-- Table structure for table `page_request`
--

CREATE TABLE IF NOT EXISTS `page_request` (
`id` int(11) NOT NULL,
  `tpr` bigint(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_request`
--

INSERT INTO `page_request` (`id`, `tpr`) VALUES
(1, 160);

-- --------------------------------------------------------

--
-- Table structure for table `student_detail_list`
--

CREATE TABLE IF NOT EXISTS `student_detail_list` (
`id` bigint(11) NOT NULL,
  `university_roll` bigint(20) DEFAULT NULL,
  `university_reg` bigint(20) DEFAULT NULL,
  `college_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_detail_list`
--

INSERT INTO `student_detail_list` (`id`, `university_roll`, `university_reg`, `college_id`) VALUES
(1, 10300315120, 31500315120, '003-15-0112'),
(2, 10300315121, 31500315121, '003-15-0113'),
(3, 10300315122, 31500315122, '003-15-0311'),
(4, 10300315126, 31500315126, '003-15-0511');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
`teacher_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `branch` varchar(40) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `detail_link` varchar(80) NOT NULL DEFAULT 'onlinehit.tk',
  `raters` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `average` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `branch`, `designation`, `contact_number`, `email`, `detail_link`, `raters`, `rating`, `average`) VALUES
(1, 'Tilak mukherjee', 'ece', 'Professor', '9988776655', 'tilakmukherjee@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Tilak_Mukherjee.htm', 2, 50, 9),
(2, 'Mrs. Somdutta Sinha', 'ece', 'Assistance Professor', '9988776656', 'somdutta.sinha.ecehit@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Somdutta_Sinha.htm', 2, 12, 6),
(3, 'Pinaki Satpathi', 'ece', 'Assistance Proffessor', '8877554411', 'pinakisatpathi@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Pinaki_Satpathy.htm', 2, 18, 9),
(4, 'Malay Kumar Pandit', 'ECE', 'Professor', '03224-252900', 'mkp10011@yahoo.com', 'http://hithaldia.in/faculty/ece_faculty/Malay_Kumar_Pandit.htm', 2, 12, 6),
(5, 'Dr. Jaydeb Bhaumik', 'ECE', 'Professor & Head', '03224-252900', 'hod.ecehit@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Jaydeb_Bhaumik.htm', 0, 0, 0),
(6, 'Sri Asim Kumar Jana', 'ECE', 'Associate Professor', '03224-252900', 'asimkjana@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Asim_Kumar_Jana.htm', 0, 0, 0),
(7, 'Sri Kushal Roy', 'ECE', 'Asst. Professor', '03224-252900', 'kushalroy1979@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Kushal_Roy.htm', 0, 0, 0),
(8, 'Sri Amit Bhattacharyya', 'ECE', 'Asst. Professor', '03224-252900', 'amit_elec06@yahoo.com', 'http://hithaldia.in/faculty/ece_faculty/Amit_Bhattacharyya.htm', 0, 0, 0),
(9, 'Sri Jagannath Samanta', 'ECE', 'Assistant Professor', '03224-252900', 'jagannath19060@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Jagannath_Samanta.htm', 0, 0, 0),
(10, 'Sri Suman Paul', 'ECE', 'Assistant Professor', '03224-252900', 'paulsuman999@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Suman_Paul.htm', 0, 0, 0),
(11, 'Mr. Raj Kumar Maity', 'ECE', 'Assistant Professor', '03224-252900', 'hitece.raj@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Raj_Kumar_Maity.htm', 1, 2, 2),
(12, 'Mr. Tirthadip Sinha', 'ECE', 'Assistant Professor', '03224-252900', 'tirthadip_sinha@yahoo.co.in', 'http://hithaldia.in/faculty/ece_faculty/Tirthadip_Sinha.htm', 0, 0, 0),
(13, 'Sri Banibrata Bag', 'ECE', 'Assistance Professor', '03224-252900', 'bani305@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Banibrata_Bag.htm', 0, 0, 0),
(14, 'Mr. Surajit Mukherjee', 'ECE', 'Assistance Professor', '03224-252900', 'ece.surajit@yahoo.com', 'http://hithaldia.in/faculty/ece_faculty/Surajit_Mukherjee.htm', 0, 0, 0),
(15, 'Mr. Akinchan Das', 'ECE', 'Assistant Professor', '03224-252900', 'aki_06das@yahoo.co.in', 'http://hithaldia.in/faculty/ece_faculty/Akinchan_Das.htm', 0, 0, 0),
(16, 'Sri Dibyendu Chowdhury', 'ECE', 'Assistance Professor', '03224-252900', 'dc.ecehit@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Dibyendu_Chowdhury.htm', 0, 0, 0),
(17, 'Dr. Bishnu Prasad De', 'ECE', 'Assistant Professor', '03224-252900', 'bishnu.ece@gmail.com', 'http://hithaldia.in/faculty/ece_faculty/Bishnu_Prasad_De.htm', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers_post`
--

CREATE TABLE IF NOT EXISTS `teachers_post` (
`id` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `year` int(1) NOT NULL,
  `department` varchar(10) NOT NULL,
  `batch` int(1) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `slug` varchar(35) NOT NULL,
  `pwid` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `generated` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `deleted` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `hidden` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers_post`
--

INSERT INTO `teachers_post` (`id`, `posted_by`, `year`, `department`, `batch`, `heading`, `title`, `body`, `slug`, `pwid`, `created`, `generated`, `updated`, `deleted`, `deleted_by`, `hidden`) VALUES
(23, 37, 2, 'cse', 9, 'Testing Header for Assignment', 'Testing title for Assignment', '<p>It is a testing body.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Modified</p>\r\n', 'cea5c7fd30a1a3b10d896e1b4ffc1b66', 'fc9e07964f8dddeb95fc584cd96', '2017-08-07 14:59:26', '2017-07-27 22:09:34', '2017-08-07 14:59:26', '2017-07-28 16:06:00', 37, 0),
(24, 38, 2, 'cse', 9, 'Another testing header for CSE students', 'Testing title for CSE students', '<p>This is also a testing body.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>I hope Everything will be fine.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thank you....</p>\r\n', '5ab827772e1ac6ad3c334d95499ff3d6', '71bce93e200c36f7cd9dfd0e5de', '2017-07-28 16:07:07', '2017-07-27 22:11:15', NULL, '2017-07-27 22:13:18', 38, 0),
(25, 38, 2, 'cse', 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget ex vestibulum, ornare eros in,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget ex vestibulum, ornare eros in, luctus mauris. Vivamus fringilla tempus purus ut viverra. Nulla facilisis vestibulum vestibulum. Integer aliquam lorem mauris, sit amet sollicitudin mauris ultricies ac. Integer eget sem et velit tempor rhoncus sed et mauris. Cras et aliquet elit. Nam turpis elit, mattis non vulputate id, porttitor eget elit. Aliquam vitae ipsum quis nunc pretium aliquam.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget ex vestibulum, ornare eros in, luctus mauris. Vivamus fringilla tempus purus ut viverra. Nulla facilisis vestibulum vestibulum. Integer aliquam lorem mauris, sit amet sollicitudin mauris ultricies ac. Integer eget sem et velit tempor rhoncus sed et mauris. Cras et aliquet elit. Nam turpis elit, mattis non vulputate id, porttitor eget elit. Aliquam vitae ipsum quis nunc pretium aliquam.</p>\r\n', '4a7fd503301c8dba9557ee44c5f938dc', '71bce93e200c36f7cd9dfd0e5de', '2017-07-27 22:14:29', '2017-07-27 22:14:29', NULL, NULL, NULL, 0),
(26, 37, 9, 'ece', 9, 'This is the a header for all students of the selected department', 'This is the universal title of this new for ECE students', '<p>This is a 3rd body</p>\r\n', '25d1089d3c8053ebc1fb8c64fb8db8b4', 'fc9e07964f8dddeb95fc584cd96', '2017-07-28 16:06:56', '2017-07-28 13:02:36', NULL, '2017-07-28 13:06:19', 37, 0),
(27, 37, 2, 'cse', 9, 'This is a heading for all ECE students of HIT', 'This is also a testing title.', '<p>Testing body</p>\r\n', '092627539493fe8b27c2bed93274655e', 'fc9e07964f8dddeb95fc584cd96', '2017-07-28 20:24:40', '2017-07-28 20:23:04', '2017-07-28 20:24:40', NULL, NULL, 0),
(28, 37, 2, 'ece', 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget ex vestibulum, ornare eros in, luctus mauris. Vivamus fringilla tempus purus ut viverra.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget ex vestibulum, ornare eros in, luctus mauris. Vivamus fringilla tempus purus ut viverra. Nulla facilisis vestibulum vestibulum. Integer aliquam lorem mauris, sit amet sollicitudin mauris ultricies ac. Integer eget sem et velit tempor rhoncus sed et mauris. Cras et aliquet elit. Nam turpis elit, mattis non vulputate id, porttitor eget elit. Aliquam vitae ipsum quis nunc pretium aliquam.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget ex vestibulum, ornare eros in, luctus mauris. Vivamus fringilla tempus purus ut viverra. Nulla facilisis vestibulum vestibulum. Integer aliquam lorem mauris, sit amet sollicitudin mauris ultricies ac. Integer eget sem et velit tempor rhoncus sed et mauris. Cras et aliquet elit. Nam turpis elit, mattis non vulputate id, porttitor eget elit. Aliquam vitae ipsum quis nunc pretium aliquam.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget ex vestibulum, ornare eros in, luctus mauris. Vivamus fringilla tempus purus ut viverra. Nulla facilisis vestibulum vestibulum. Integer aliquam lorem mauris, sit amet sollicitudin mauris ultricies ac. Integer eget sem et velit tempor rhoncus sed et mauris. Cras et aliquet elit. Nam turpis elit, mattis non vulputate id, porttitor eget elit. Aliquam vitae ipsum quis nunc pretium aliquam.</p>\r\n', '3c76d532e4412a53ffcfc785e59064e0', 'fc9e07964f8dddeb95fc584cd96', '2017-07-29 11:51:54', '2017-07-28 20:26:53', '2017-07-29 11:51:54', NULL, NULL, 0),
(29, 37, 9, 'ece', 9, 'The Story of An Hour', 'By Kate Chopin', '<pre>\r\n<em><small>This story was first published in 1894 as <em>The Dream of an Hour</em> before being republished under this title in 1895. We encourage students and teacher to use our <a href="https://americanliterature.com/the-story-of-an-hour-study-guide">The Story of An Hour - Study Guide</a> to learn more about the story and <a href="https://americanliterature.com/feminist-literature-study-guide">Feminist Literature - Study Guide</a> for more on the genre.</small></em></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Knowing that Mrs. Mallard was afflicted with a heart trouble, great care was taken to break to her as gently as possible the news of her husband&#39;s death.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>It was her sister Josephine who told her, in broken sentences; veiled hints that revealed in half concealing. Her husband&#39;s friend Richards was there, too, near her. It was he who had been in the newspaper office when intelligence of the railroad disaster was received, with Brently Mallard&#39;s name leading the list of &quot;killed.&quot; He had only taken the time to assure himself of its truth by a second telegram, and had hastened to forestall any less careful, less tender friend in bearing the sad message. <img alt="another story" src="https://assets.americanliterature.com/al/images/story/the-story-of-an-hour.jpg" style="float:right; height:133px; width:125px" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>She did not hear the story as many women have heard the same, with a paralyzed inability to accept its significance. She wept at once, with sudden, wild abandonment, in her sister&#39;s arms. When the storm of grief had spent itself she went away to her room alone. She would have no one follow her.</p>\r\n\r\n<p>There stood, facing the open window, a comfortable, roomy armchair. Into this she sank, pressed down by a physical exhaustion that haunted her body and seemed to reach into her soul.</p>\r\n\r\n<p>She could see in the open square before her house the tops of trees that were all aquiver with the new spring life. The delicious breath of rain was in the air. In the street below a peddler was crying his wares. The notes of a distant song which someone was singing reached her faintly, and countless sparrows were twittering in the eaves.</p>\r\n\r\n<p>There were patches of blue sky showing here and there through the clouds that had met and piled one above the other in the west facing her window.</p>\r\n\r\n<p>She sat with her head thrown back upon the cushion of the chair, quite motionless, except when a sob came up into her throat and shook her, as a child who has cried itself to sleep continues to sob in its dreams.</p>\r\n\r\n<p>She was young, with a fair, calm face, whose lines bespoke repression and even a certain strength. But now there was a dull stare in her eyes, whose gaze was fixed away off yonder on one of those patches of blue sky. It was not a glance of reflection, but rather indicated a suspension of intelligent thought.</p>\r\n\r\n<p>There was something coming to her and she was waiting for it, fearfully. What was it? She did not know; it was too subtle and elusive to name. But she felt it, creeping out of the sky, reaching toward her through the sounds, the scents, the color that filled the air.</p>\r\n\r\n<p>Now her bosom rose and fell tumultuously. She was beginning to recognize this thing that was approaching to possess her, and she was striving to beat it back with her will--as powerless as her two white slender hands would have been. When she abandoned herself a little whispered word escaped her slightly parted lips. She said it over and over under the breath: &quot;free, free, free!&quot; The vacant stare and the look of terror that had followed it went from her eyes. They stayed keen and bright. Her pulses beat fast, and the coursing blood warmed and relaxed every inch of her body.</p>\r\n\r\n<p>She did not stop to ask if it were or were not a monstrous joy that held her. A clear and exalted perception enabled her to dismiss the suggestion as trivial. She knew that she would weep again when she saw the kind, tender hands folded in death; the face that had never looked save with love upon her, fixed and gray and dead. But she saw beyond that bitter moment a long procession of years to come that would belong to her absolutely. And she opened and spread her arms out to them in welcome.</p>\r\n\r\n<p>There would be no one to live for during those coming years; she would live for herself. There would be no powerful will bending hers in that blind persistence with which men and women believe they have a right to impose a private will upon a fellow-creature. A kind intention or a cruel intention made the act seem no less a crime as she looked upon it in that brief moment of illumination.</p>\r\n\r\n<p>And yet she had loved him--sometimes. Often she had not. What did it matter! What could love, the unsolved mystery, count for in the face of this possession of self-assertion which she suddenly recognized as the strongest impulse of her being!</p>\r\n\r\n<p>&quot;Free! Body and soul free!&quot; she kept whispering.</p>\r\n\r\n<p>Josephine was kneeling before the closed door with her lips to the keyhole, imploring for admission. &quot;Louise, open the door! I beg; open the door--you will make yourself ill. What are you doing, Louise? For heaven&#39;s sake open the door.&quot;</p>\r\n\r\n<p>&quot;Go away. I am not making myself ill.&quot; No; she was drinking in a very elixir of life through that open window.</p>\r\n\r\n<p>Her fancy was running riot along those days ahead of her. Spring days, and summer days, and all sorts of days that would be her own. She breathed a quick prayer that life might be long. It was only yesterday she had thought with a shudder that life might be long.</p>\r\n\r\n<p>She arose at length and opened the door to her sister&#39;s importunities. There was a feverish triumph in her eyes, and she carried herself unwittingly like a goddess of Victory. She clasped her sister&#39;s waist, and together they descended the stairs. Richards stood waiting for them at the bottom.</p>\r\n\r\n<p>Someone was opening the front door with a latchkey. It was Brently Mallard who entered, a little travel-stained, composedly carrying his grip-sack and umbrella. He had been far from the scene of the accident, and did not even know there had been one. He stood amazed at Josephine&#39;s piercing cry; at Richards&#39; quick motion to screen him from the view of his wife.</p>\r\n\r\n<p>When the doctors came they said she had died of heart disease--of the joy that kills.</p>\r\n\r\n<hr />\r\n<p><cite><strong>The Story of An Hour</strong></cite>&nbsp;was featured as&nbsp;<a href="https://americanliterature.com/short-story-of-the-day"><strong>The Short Story of the Day</strong></a>&nbsp;on&nbsp;<strong>Mon, Apr 17, 2017</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n', 'd90c50893bea22826521305478d3a186', 'fc9e07964f8dddeb95fc584cd96', '2017-07-30 19:11:27', '2017-07-30 19:11:27', NULL, NULL, NULL, 0),
(30, 39, 2, 'ece', 9, 'This is the very first heading.', 'This is the title.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget ex vestibulum, ornare eros in, luctus mauris. Vivamus fringilla tempus purus ut viverra. Nulla facilisis vestibulum vestibulum. Integer aliquam lorem mauris, sit amet sollicitudin mauris ultricies ac. Integer eget sem et velit tempor rhoncus sed et mauris. Cras et aliquet elit. Nam turpis elit, mattis non vulputate id, porttitor eget elit. Aliquam vitae ipsum quis nunc pretium aliquam.</p>\r\n\r\n<p>Vestibulum porta pharetra urna eget bibendum. Pellentesque non vehicula dui. Duis eu mattis nunc, at sollicitudin tellus. Quisque aliquet mi eu consectetur dapibus. Pellentesque ultricies varius quam, id ornare quam accumsan eget. Integer lobortis, est at cursus luctus, sem justo convallis odio, quis maximus neque lacus nec tortor. Nam auctor mi elit, sed euismod arcu faucibus eget. Nullam ac lectus pulvinar, tincidunt nulla in, pulvinar felis. Fusce turpis augue, tincidunt sit amet urna et, pharetra gravida magna. Donec at convallis ante. Nunc malesuada ex vitae est feugiat, nec posuere dolor porttitor. Phasellus ut dui mauris.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Edited</p>\r\n', 'e77c5969e783a7d63575c128a983d843', 'd8ab4f4c10bf22aa353e2787913', '2017-08-13 21:11:33', '2017-08-02 11:24:30', '2017-08-13 21:11:33', NULL, NULL, 0),
(31, 37, 9, 'ece', 2, 'heading', 'title', '<p>Once upon a time, a boy was walking through a wood and he thought he could hear a sad cry,<strong>&nbsp;as though someone was crying while singing</strong>. Following the sound he came to a big, round, mysterious, grey fountain. The sad sobbing seemed to be coming from the fountain pool.<strong>&nbsp;The boy swept aside the pool&#39;s dirty surface water and saw a group of grey fish swimming in a slow circle through the pond</strong>. With each lap they made, their little voices opened and out came the sobbing sound.</p>\r\n\r\n<table align="center" border="1" cellpadding="1" cellspacing="1" style="width:90%" summary="It is summary of the table.">\r\n	<caption>Few parts of family</caption>\r\n	<tbody>\r\n		<tr>\r\n			<td>NAZIR AHMAD</td>\r\n			<td>ARFUN NISHA</td>\r\n			<td>ZAFIR AHMAD</td>\r\n			<td>NASIR AHMAD</td>\r\n			<td>ARSI KHATOON</td>\r\n		</tr>\r\n		<tr>\r\n			<td>FAIYAZ AHMAD</td>\r\n			<td>FAISAL AHMAD</td>\r\n			<td>FERHAN AHMAD</td>\r\n			<td>FAHAD AHMAD</td>\r\n			<td>HABIBUN NISHA</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Amused by this,<strong>&nbsp;the boy tried to catch one of these incredible talking fish</strong>. But when he stuck his arm into the water it turned grey right up to the elbow. As this happened, a huge sadness entered into him, and he suddenly understood how sorrowful the fish was feeling. He felt just like the earth on his arm; dirty and contaminated.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href="https://images.pexels.com/photos/257360/pexels-photo-257360.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb" target="_blank"><img alt="Nature" src="https://images.pexels.com/photos/257360/pexels-photo-257360.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb" style="border-style:solid; border-width:1px; float:right; height:167px; width:250px" /></a></p>\r\n\r\n<p><strong>He quickly pulled his arm out of the water</strong>, and ran from that place. But the arm stayed grey, and the boy continued feeling sad.<strong>&nbsp;He tried so many times to cheer himself up</strong>, but nothing worked. That was, until he realised that if he were to make the Earth happy then that happiness would be, in turn, transmitted back to him, through the earth on his arm.</p>\r\n\r\n<p><strong>From then on he set about looking after the countryside</strong>. He cared for the plants, he did what he could to keep the water from being polluted, and he encouraged others to do the same. He was so successful that his hand started to recover its normal colour.<strong>&nbsp;When the grey had disappeared completely</strong>, he started feeling happy again, and he decided to go and visit the fountain. When he was still some way from the fountain he could hear the fish singing happy hymns, and he heard them joyfully splashing in the crystal clear waters of that magic fountain.</p>\r\n\r\n<p>It was plain to see that the Earth had returned to its original happiness; and the boy felt even happier at the sight.</p>\r\n', '22417c1ae18b098fd78f27c455473f9c', 'fc9e07964f8dddeb95fc584cd96', '2017-08-06 21:24:54', '2017-08-02 18:43:39', '2017-08-06 21:24:54', NULL, NULL, 0),
(32, 37, 2, 'ece', 2, 'Testing header', 'title', '<p>bodyyyyyyyyyyyyyyyyyyyy</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>dited</p>\r\n', 'f6a6f4753d6b2f96844101a63742fb80', 'fc9e07964f8dddeb95fc584cd96', '2017-08-07 13:23:57', '2017-08-06 22:40:58', '2017-08-07 13:23:57', NULL, NULL, 0),
(33, 39, 2, 'ece', 2, 'testing heading', 'testing title', '<h2>Onlinehit</h2>\r\n\r\n<p>testing body</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>.....</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>modified</p>\r\n', 'b0a0065914e318cda4fe7ae806efdcdc', 'd8ab4f4c10bf22aa353e2787913', '2017-08-08 18:31:56', '2017-08-08 18:29:32', '2017-08-08 18:31:56', NULL, NULL, 0),
(34, 40, 2, 'cse', 1, 'Testing heading for cse', 'testing title', '<p>body</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>modified</p>\r\n', '15d5a48a55c597e7b7b02134d519bd3c', '5920e395fedad7bbbed0eca3fe2', '2017-08-10 16:31:34', '2017-08-10 16:29:36', '2017-08-10 16:31:34', NULL, NULL, 0),
(35, 41, 2, 'cse', 9, 'jgyguy', 'jkjhhj', '<p>jhgjhg&lt;i/frame&gt;&lt;/p&gt;</p>\r\n', '87ba263ea60304c87d29a889ba4dbdf8', '6a75f4cea9109507cacd8e2f2ae', '2017-08-10 16:59:48', '2017-08-10 16:57:35', '2017-08-10 16:59:48', NULL, NULL, 0),
(36, 39, 2, 'ece', 9, 'This is a heading', 'this is another testing title', '<p>Hello,</p>\r\n\r\n<p>It is also a testing body</p>\r\n', '2fd9dc5adc81a616874e9494bec58b36', 'd8ab4f4c10bf22aa353e2787913', '2017-09-18 14:42:48', '2017-09-18 14:42:48', NULL, NULL, NULL, 0),
(37, 39, 4, 'ece', 9, 'This is a testing header for 4th year', 'Thsi is also a testing title just for 4th year', '<p>This is also a testing body for 4th year</p>\r\n', '91dfbbf0cede60bb973fb722dd44dc7a', 'd8ab4f4c10bf22aa353e2787913', '2017-09-18 14:44:11', '2017-09-18 14:44:11', NULL, NULL, NULL, 0),
(38, 37, 2, 'ece', 9, 'Some Heading', 'Some title for this post', '<p>Body</p>\r\n', '917c35fa24fa2d86b7f07bc557837b0f', 'fc9e07964f8dddeb95fc584cd96', '2017-09-23 15:06:05', '2017-09-23 15:06:05', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_personal_data`
--

CREATE TABLE IF NOT EXISTS `teacher_personal_data` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `office_address` varchar(250) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `detail_link` varchar(100) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `details_filled` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_personal_data`
--

INSERT INTO `teacher_personal_data` (`id`, `user_id`, `department`, `office_address`, `contact_number`, `designation`, `detail_link`, `time`, `details_filled`) VALUES
(5, 37, 'Electronics And Communication Engg.', 'First floor, ECE department, Room number-9', '9898656525', 'Assistant Professor', NULL, '2017-07-31 22:15:43', 1),
(6, 39, 'Electronics and communication engineering', 'Ground floor, Ece department, Room number-5', '9475658525', 'Head of the department', NULL, '2017-08-02 00:03:38', 1),
(7, 41, 'computer science', 'jfal akjdf  ', '9835660347', 'hod', NULL, '2017-08-10 16:25:00', 1),
(9, 38, 'Electronics And Communication Engg.', 'First floor, ECE department, Room number-9', '9898656525', 'Assistant Professor', NULL, '2017-07-31 22:15:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE IF NOT EXISTS `testing` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testing`
--

INSERT INTO `testing` (`id`, `name`) VALUES
(1, 'zafir'),
(2, 'nasir');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `email_code` varchar(32) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '0',
  `department` varchar(5) NOT NULL,
  `member` varchar(20) DEFAULT NULL,
  `year` int(1) NOT NULL,
  `uni_roll` bigint(20) DEFAULT NULL,
  `uni_reg` bigint(20) DEFAULT NULL,
  `college_id` varchar(20) DEFAULT NULL,
  `course_duration` int(2) NOT NULL,
  `batch` int(1) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `allow_email` int(1) NOT NULL DEFAULT '1',
  `profile` varchar(55) NOT NULL,
  `details` int(1) NOT NULL DEFAULT '0',
  `faculty` int(1) NOT NULL DEFAULT '0',
  `joined_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `email_code`, `active`, `type`, `department`, `member`, `year`, `uni_roll`, `uni_reg`, `college_id`, `course_duration`, `batch`, `gender`, `allow_email`, `profile`, `details`, `faculty`, `joined_on`) VALUES
(20, 'zafir_ahmad', '5f4dcc3b5aa765d61d8327deb882cf99', 'Zafir', 'Ahmad', 'ahmadzafir01@outlook.com', '27a7f90341f3e05a85c495219f17edbd', 1, 'admin', 'ece', 'iete', 2, 10300315126, NULL, NULL, 15, 2, 'm', 1, 'images/profile/aed0563e45.jpg', 1, 0, '2017-09-25 20:21:53'),
(21, 'nasir_zafir', '5f4dcc3b5aa765d61d8327deb882cf99', 'Nasir', 'ahmad', 'mdnasirzan@gmail.com', '34de6195907877863692c52ee941174b', 1, 'moderator', 'cse', NULL, 2, 10300315125, NULL, NULL, 16, 1, '', 0, '', 1, 0, '2017-09-17 07:39:51'),
(22, 'zafir', '5f4dcc3b5aa765d61d8327deb882cf99', 'Zafir!', 'ahmad', 'someone@gmail.com', 'fe4d1da6906125bb830677f197243531', 1, 'admin', 'ece', 'csi', 3, NULL, NULL, NULL, 15, 2, 'm', 1, '', 1, 0, '2017-09-12 20:27:42'),
(23, 'saddam_hit', '5f4dcc3b5aa765d61d8327deb882cf99', 'saddam', 'hussain', 'hussainsaddam@gmail.com', 'a67de500aee953a2fb6713585b4c9aad', 0, '0', 'ece', NULL, 3, NULL, NULL, NULL, 0, 2, 'm', 1, '', 1, 0, '2017-07-27 11:52:00'),
(34, 'zafir123', '5f4dcc3b5aa765d61d8327deb882cf99', 'zafir123', 'ahmad', 'ahmadzafir01@gmail.com', '3ff81a17fccc2d92d3d708721848671b', 1, '0', 'ece', 'asphalt', 3, NULL, NULL, NULL, 15, 2, '', 1, '', 1, 0, '2017-08-22 21:00:21'),
(35, 'nasir123', '5f4dcc3b5aa765d61d8327deb882cf99', 'Nasir', 'Ahmad', 'nasir@gmail.com', 'aabf0b9ba7453a4e595b163a48e06fdc', 1, '0', '', NULL, 0, NULL, NULL, NULL, 0, 0, '', 1, '', 0, 0, '2017-07-22 15:58:32'),
(36, 'saad', '5f4dcc3b5aa765d61d8327deb882cf99', 'saad', 'ahmad', 'saad@onlinehit.co.in', 'e9bc492f48e951f7a828e9091c72fa66', 1, '0', 'me', NULL, 1, NULL, NULL, NULL, 17, 1, 'm', 1, '', 1, 0, '2017-07-27 11:52:05'),
(37, 'tilak', '5f4dcc3b5aa765d61d8327deb882cf99', 'Tilak', 'Mukherjee', 'mukherjeetilak@gmail.com', 'c75bdc054050ab247ed35f5bd4d54951', 1, '0', 'ece', NULL, 9, NULL, NULL, NULL, 12, 2, '', 1, '', 1, 1, '2017-07-27 12:48:47'),
(38, 'surojit', '5f4dcc3b5aa765d61d8327deb882cf99', 'Surojit', 'Mukherjee', 'Surojitmukherjee@gmail.com', 'a0f004fe59ed60c2cc649175c355e46b', 1, '0', 'ece', NULL, 9, NULL, NULL, NULL, 12, 2, '', 1, '', 1, 1, '2017-08-21 23:47:25'),
(39, 'jaydeb', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jaydeb', 'Bhaumik', 'bhaumikjaydeb@gmail.com', 'c8c9f73a257dd837e3132d92258aea7a', 1, 'hod', 'ece', NULL, 9, NULL, NULL, NULL, 12, 2, '', 1, '', 1, 1, '2017-08-22 21:00:08'),
(41, 'csehod', '5f4dcc3b5aa765d61d8327deb882cf99', 'sahanwaz', 'ahmad', 'csehod@gmail.com', '93fec40ea1512274a7d287c182f9a189', 1, 'hod', 'cse', NULL, 9, NULL, NULL, NULL, 12, 2, '', 1, '', 1, 1, '2017-08-10 16:24:18'),
(42, 'nazir', '5f4dcc3b5aa765d61d8327deb882cf99', 'Nazir', 'Ahmad', 'nazir@onlinehit.co.in', '107f01aee583c413b3ffe8bc62723111', 1, '0', 'ece', NULL, 0, NULL, NULL, NULL, 0, 0, 'm', 1, '', 0, 0, '2017-09-21 04:09:54'),
(44, 'a', 'c44a471bd78cc6c2fea32b9fe028d30a', 'sdf', 'afdsas', 'arfun_nisha@gmail.com', 'e43130967c8bc62813d4277557c15188', 0, '0', '', NULL, 0, NULL, NULL, NULL, 0, 0, '', 1, '', 0, 0, '2017-08-12 13:31:00'),
(45, 'bpdey', '5f4dcc3b5aa765d61d8327deb882cf99', 'Bishnu', 'prashd', 'bpdey@onlinehit.co.in', 'b15a3c52cfa82a27ecfda0a0eada0e5f', 0, '0', '', NULL, 0, NULL, NULL, NULL, 0, 0, '', 1, '', 0, 0, '2017-08-19 22:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_ip_combo`
--

CREATE TABLE IF NOT EXISTS `user_ip_combo` (
`id` bigint(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_ip_combo`
--

INSERT INTO `user_ip_combo` (`id`, `user_id`, `user_ip`, `flag`) VALUES
(1, 20, '::1', 0),
(2, 20, '255.255.255.255', 1),
(3, 21, '255.255.0.1', 0),
(5, 20, '127.0.0.1', 0),
(6, 21, '::1', 0),
(7, 37, '127.0.0.1', 0),
(8, 37, '::1', 0),
(9, 38, '::1', 0),
(10, 39, '::1', 0),
(11, 39, '127.0.0.1', 0),
(12, 21, '127.0.0.1', 0),
(13, 34, '127.0.0.1', 0),
(14, 40, '::1', 0),
(15, 41, '::1', 0),
(16, 40, '127.0.0.1', 0),
(17, 42, '127.0.0.1', 0),
(18, 43, '::1', 0),
(19, 43, '127.0.0.1', 0),
(20, 38, '127.0.0.1', 0),
(21, 20, '103.255.255.0.1', 0),
(22, 22, '127.0.0.1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_list`
--
ALTER TABLE `book_list`
 ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `club_news`
--
ALTER TABLE `club_news`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_detail_list`
--
ALTER TABLE `faculty_detail_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_request`
--
ALTER TABLE `page_request`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_detail_list`
--
ALTER TABLE `student_detail_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
 ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teachers_post`
--
ALTER TABLE `teachers_post`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_personal_data`
--
ALTER TABLE `teacher_personal_data`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testing`
--
ALTER TABLE `testing`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_ip_combo`
--
ALTER TABLE `user_ip_combo`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `club_news`
--
ALTER TABLE `club_news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `faculty_detail_list`
--
ALTER TABLE `faculty_detail_list`
MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `page_request`
--
ALTER TABLE `page_request`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_detail_list`
--
ALTER TABLE `student_detail_list`
MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `teachers_post`
--
ALTER TABLE `teachers_post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `teacher_personal_data`
--
ALTER TABLE `teacher_personal_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `user_ip_combo`
--
ALTER TABLE `user_ip_combo`
MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
