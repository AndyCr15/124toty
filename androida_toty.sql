-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2018 at 09:04 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `androida_toty`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `red` int(50) NOT NULL,
  `blue` int(50) NOT NULL,
  `green` int(50) NOT NULL,
  `yellow` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `description`, `red`, `blue`, `green`, `yellow`) VALUES
(1, 'Multimedia Training', 'Clearing all overdues!', 3, 1, 5, 2),
(2, 'Rotation Spot Checks', 'Score points for completing the most, lose points for teams partners failing checks.', 8, 12, 0, 17),
(3, 'Diary Notes', '', 10, 3, 7, 3),
(4, 'New Partners', 'Getting photo\'s on the wall and signed up to Google and Facebook', 10, 2, 1, 8),
(5, 'BONUS: Guessing Sales', 'For correctly guessing the sales and then opening the bonus announcement.', 0, 5, 0, 0),
(6, 'BONUS: Social Media', 'For their continued input on both Facebook and Google Plus', 0, 0, 5, 0),
(11, 'AGM Attendance', 'For number of Partners attending the 2018 AGM.', 10, 10, 5, 7),
(12, 'Rotation checks WC 18/3', '', 5, -1, 2, 0),
(13, 'Rotation Spot Checks w/c 25/3', '', 0, 2, 5, 0),
(14, 'Partner Search - First two weeks', '', 0, 1, 3, 0),
(15, 'Diary Notes March', '', 4, 5, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`) VALUES
(1, 'Yogurts'),
(2, 'Ready Meals'),
(3, 'Cheese'),
(4, 'Deli'),
(5, 'Ambient'),
(6, 'Food To Go'),
(7, 'Meat'),
(8, 'Pizza'),
(9, 'Soups'),
(10, 'Pasta'),
(11, 'Butter'),
(12, 'Kosher'),
(13, 'Fresh Juice'),
(14, 'Milk'),
(15, 'Active Health Drinks'),
(16, 'Cream'),
(17, 'FRV');

-- --------------------------------------------------------

--
-- Table structure for table `bagchecks`
--

CREATE TABLE `bagchecks` (
  `id` int(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `partner` int(8) NOT NULL,
  `result` varchar(4) NOT NULL,
  `discussion` varchar(140) NOT NULL,
  `manager` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagchecks`
--

INSERT INTO `bagchecks` (`id`, `time`, `partner`, `result`, `discussion`, `manager`) VALUES
(11, '2018-03-19 17:32:26', 82478627, 'pass', '', 71251502),
(10, '2018-03-19 17:32:11', 83299386, 'pass', '', 76630137),
(9, '2018-03-15 17:31:52', 81753985, 'pass', '', 80475132),
(7, '2018-03-15 17:30:47', 80475132, 'pass', '', 76630137),
(8, '2018-03-15 17:31:04', 75595745, 'pass', '', 76630137),
(12, '2018-03-20 17:32:51', 83299386, 'pass', '', 76630137),
(13, '2018-03-20 17:33:04', 82827435, 'pass', '', 76630137),
(14, '2018-03-20 17:33:22', 75285487, 'pass', '', 80809170),
(15, '2018-03-21 17:33:34', 75818418, 'pass', '', 71251502),
(16, '2018-03-21 17:33:48', 83172785, 'pass', '', 71251502),
(17, '2018-03-21 17:34:12', 82851352, 'pass', 'Bottle of water. Conor had tried to sign bottle and couldn\'t. Just scribble on bar code. ', 71251502),
(18, '2018-03-21 17:34:34', 75285487, 'pass', '', 71251502),
(19, '2018-03-23 17:34:50', 77155599, 'pass', '', 71488286),
(20, '2018-03-26 17:35:11', 83305076, 'fail', 'Need to have product (cigarettes) and receipt signed.', 80119921),
(21, '2018-03-26 17:35:30', 70834024, 'pass', '', 80119921),
(22, '2018-03-26 17:35:46', 71488286, 'pass', '', 80119921),
(23, '2018-03-30 17:36:09', 75684012, 'pass', '', 80809170),
(24, '2018-03-31 17:36:26', 75862255, 'fail', 'Ensure cigarettes are signed', 80809170),
(25, '2018-04-02 11:05:35', 75595745, 'pass', '', 80562884),
(26, '2018-04-02 15:46:50', 81529031, 'pass', '', 80562884),
(27, '2018-04-02 15:47:01', 83299386, 'pass', '', 80562884),
(28, '2018-04-04 11:06:36', 81781881, 'pass', '', 80809170),
(31, '2018-04-04 12:59:52', 71488286, 'pass', '', 80562884),
(30, '2018-04-04 11:07:00', 75595745, 'pass', '', 80809170),
(32, '2018-04-04 16:04:38', 76630137, 'pass', '', 80809170),
(33, '2018-04-05 12:21:47', 83305076, 'pass', '', 80809170),
(34, '2018-04-05 13:33:34', 83299386, 'pass', '', 80682529),
(35, '2018-04-05 19:58:41', 75862255, 'pass', 'No issues.', 80119921);

-- --------------------------------------------------------

--
-- Table structure for table `diarynotes`
--

CREATE TABLE `diarynotes` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `partner` int(8) NOT NULL,
  `discussion` varchar(200) NOT NULL,
  `agreement` varchar(200) NOT NULL,
  `manager` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diarynotes`
--

INSERT INTO `diarynotes` (`id`, `time`, `partner`, `discussion`, `agreement`, `manager`) VALUES
(5, '2018-04-04 12:10:30', 83140107, 'Getting changed 10 minutes before his shift ended.', 'Not to happen again.', 80809170),
(6, '2018-04-04 12:12:20', 82902860, 'Carlo had got changed ready to leave the branch 10 minutes before his shift was ending.', 'Carlo will not get ready before his shift ends.', 80809170),
(7, '2018-04-04 12:50:54', 83174079, 'Signed Welcome Desk Coffee Machine Paperwork when machine not opened as engineer repairing machine.', 'Said she wasnâ€™t paying attention when she signed paperwork, I reiterated that Florentina must pay attention to what she is signing and read the paperwork.', 75285487),
(8, '2018-04-04 14:33:33', 81305141, 'Late for shift on Wednesday 04-04-18, rota stated 6-3, contacted branch and spoke to Terri at a couple of minutes to 8 asking when he was working.  When he was told he should have been in at 8am asked', 'Was asked to make up time and complete full shift today Wed 04 April, finishing at 5pm.', 75285487),
(9, '2018-04-04 15:41:19', 82827435, 'Left cage of rubbish on the shop floor on 03/04 whilst he went for lunch.', 'Work in a tidy manner at all times.', 80119921);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `employee` int(8) NOT NULL DEFAULT '0',
  `firstname` varchar(23) DEFAULT NULL,
  `surname` varchar(14) DEFAULT NULL,
  `carreg` varchar(8) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `team` varchar(6) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '10',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `canrotationcheck` tinyint(1) NOT NULL DEFAULT '0',
  `canuniformcheck` tinyint(1) NOT NULL DEFAULT '0',
  `canbagcheck` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1' COMMENT 'Are they still employed at 124',
  `lastvisit` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`employee`, `firstname`, `surname`, `carreg`, `phone`, `team`, `level`, `admin`, `canrotationcheck`, `canuniformcheck`, `canbagcheck`, `email`, `picture`, `active`, `lastvisit`) VALUES
(82922985, 'Norhan', 'Abdelaziz', '', '', 'Red', 10, 0, 0, 0, 0, '82922985@waitrose.co.uk', '', 1, ''),
(82227829, 'Mareya', 'Ali Khan', '', '', 'Yellow', 10, 0, 0, 0, 0, '82227829@waitrose.co.uk', '', 1, ''),
(83099840, 'Michael', 'Amara', '', '', 'Green', 10, 0, 0, 0, 0, '83099840@waitrose.co.uk', '', 1, ''),
(83305076, 'Holly', 'Appleyard', 'PF05TWG', '', 'Yellow', 10, 0, 0, 0, 0, '83305076@waitrose.co.uk', '', 1, ''),
(82618577, 'Amy', 'Applin', '', '', 'Red', 10, 0, 0, 0, 0, '82618577@waitrose.co.uk', '', 1, ''),
(82478627, 'Andy', 'Ayers', '', '', 'Red', 10, 0, 0, 0, 0, '82478627@waitrose.co.uk', '', 1, ''),
(80478255, 'Jafer', 'Bahcevangil', '', '', 'Red', 10, 0, 0, 0, 0, '80478255@waitrose.co.uk', '', 1, ''),
(83220887, 'Fifi', 'Banin', '', '', 'Red', 10, 0, 0, 0, 0, '83220887@waitrose.co.uk', '', 1, ''),
(81350384, 'Tim', 'Barrett', '', '', 'Green', 10, 0, 0, 0, 0, '81350384@waitrose.co.uk', '', 1, ''),
(77464966, 'Matt', 'Beal', 'LO16CYG', '07465947794', 'Blue', 10, 0, 0, 0, 0, '77464966@waitrose.co.uk', '', 1, ''),
(83108815, 'Nula', 'Bealby', 'LA07 FXX', '', 'Red', 10, 0, 0, 0, 0, '83108815@waitrose.co.uk', '', 1, ''),
(82997543, 'Evey', 'Becker', '', '', 'Red', 10, 0, 0, 0, 0, '82997543@waitrose.co.uk', '', 1, ''),
(81343949, 'Richard', 'Bell', 'LK06CME', '', 'Yellow', 10, 0, 0, 0, 0, '81343949@waitrose.co.uk', '', 1, ''),
(82844321, 'Victoria', 'Beverstock', '', '', 'Green', 10, 0, 0, 0, 0, '82844321@waitrose.co.uk', '', 1, ''),
(82394180, 'Finnley', 'Blake', '', '', 'Green', 10, 0, 0, 0, 0, '82394180@waitrose.co.uk', '', 1, ''),
(81089805, 'Valentina', 'Bogris', 'EF55FPY', '', 'Green', 10, 0, 0, 0, 0, '81089805@waitrose.co.uk', '', 1, ''),
(82902860, 'Carlo', 'Bonito', '', '', 'Red', 10, 0, 0, 0, 0, '82902860@waitrose.co.uk', '', 1, ''),
(81302126, 'Luke', 'Bonito', '', '', 'Blue', 10, 0, 0, 0, 0, '81302126@waitrose.co.uk', '', 1, ''),
(82856397, 'Sam', 'Brazier', '', '', 'Red', 10, 0, 0, 0, 0, '82856397@waitrose.co.uk', '', 1, ''),
(82718644, 'Emma', 'Broderick', '', '', 'Yellow', 10, 0, 0, 0, 0, '82718644@waitrose.co.uk', '', 1, ''),
(75610752, 'Paul', 'Canton', '', '', 'Yellow', 10, 0, 0, 0, 0, '75610752@waitrose.co.uk', '', 1, ''),
(83299386, 'Jordana', 'Carbis', '', '', 'Red', 10, 0, 0, 0, 0, '83299386@waitrose.co.uk', '', 1, ''),
(81529031, 'Lorraine', 'Carbis', 'GVO9OML', '', 'Yellow', 10, 0, 0, 0, 0, '81529031@waitrose.co.uk', '', 1, ''),
(81979290, 'Shelby', 'Carling', '', '', 'Blue', 10, 0, 0, 0, 0, '81979290@waitrose.co.uk', '', 1, ''),
(82737010, 'Elsa', 'Cerimi', '', '', 'Yellow', 10, 0, 0, 0, 0, '82737010@waitrose.co.uk', '', 1, ''),
(82846065, 'Jermaine', 'Chambers', '', '', 'Blue', 10, 0, 0, 0, 0, '82846065@waitrose.co.uk', '', 1, ''),
(82744459, 'James', 'Clark', '', '', 'Blue', 10, 0, 0, 0, 0, '82744459@waitrose.co.uk', '', 0, ''),
(81090064, 'Hannah', 'Clifford', '', '', 'Blue', 10, 0, 0, 0, 0, '81090064@waitrose.co.uk', '', 1, ''),
(80367305, 'Alexis', 'Constantas', '', '', 'Green', 10, 0, 0, 0, 0, '80367305@waitrose.co.uk', '', 1, ''),
(82306826, 'India', 'Cooper', 'YJ03WHX', '', 'Yellow', 10, 0, 0, 0, 0, '82306826@waitrose.co.uk', '', 1, ''),
(82847266, 'Christian', 'Cotterill', '', '', 'Blue', 10, 0, 0, 0, 0, '82847266@waitrose.co.uk', '', 1, ''),
(83172793, 'Isabelle', 'Coughlan', '', '', 'Red', 10, 0, 0, 0, 0, '83172793@waitrose.co.uk', '', 1, ''),
(71143769, 'John', 'Crisford', '', '', 'Blue', 10, 0, 0, 0, 0, '71143769@waitrose.co.uk', '', 1, ''),
(82968500, 'Beth', 'Cronin', '', '', 'Yellow', 10, 0, 0, 0, 0, '82968500@waitrose.co.uk', '', 1, ''),
(81841876, 'Aaron', 'Cross', '', '', 'Green', 10, 0, 0, 0, 0, '81841876@waitrose.co.uk', '', 1, ''),
(81576285, 'Cameron', 'Daee', '', '', 'Blue', 10, 0, 0, 0, 0, '81576285@waitrose.co.uk', '', 1, ''),
(81004087, 'Eleanor', 'Daulby', '', '', 'Yellow', 10, 0, 1, 1, 0, '81004087@waitrose.co.uk', '', 1, '2018-04-04 18:38:06'),
(81268270, 'Louise', 'Daulby', '', '', 'Green', 10, 0, 1, 1, 0, '81268270@waitrose.co.uk', '', 1, '2018-04-05 08:19:42'),
(82903999, 'Adam', 'Daulby', '', '', 'Red', 10, 0, 0, 0, 0, '82903999@waitrose.co.uk', '', 1, ''),
(71670343, 'Jamie', 'Dempsey', '', '', 'Blue', 10, 0, 0, 0, 0, '71670343@waitrose.co.uk', '', 1, ''),
(81841787, 'Payal', 'Depala', '', '', 'Blue', 10, 0, 0, 0, 0, '81841787@waitrose.co.uk', '', 1, ''),
(82827435, 'Parag', 'Depala', '', '', 'Green', 10, 0, 0, 0, 0, '82827435@waitrose.co.uk', '', 1, ''),
(82918627, 'Yash', 'Depala', '', '', 'Yellow', 10, 0, 0, 0, 0, '82918627@waitrose.co.uk', '', 1, ''),
(76028666, 'Naina', 'Depala', '', '', 'Red', 10, 0, 0, 0, 0, '76028666@waitrose.co.uk', '', 1, ''),
(70834741, 'Panna', 'Depala', '', '', 'Red', 10, 0, 0, 0, 0, '70834741@waitrose.co.uk', '', 1, ''),
(82602832, 'Dario', 'Devine', '', '', 'Green', 10, 0, 0, 0, 0, '82602832@waitrose.co.uk', '', 1, ''),
(75862255, 'Paul', 'Dingley', '', '', 'Red', 10, 0, 0, 0, 0, '75862255@waitrose.co.uk', '', 1, ''),
(80882161, 'Harrison', 'England-Shaikh', '', '', 'Blue', 10, 0, 0, 0, 0, '80882161@waitrose.co.uk', '', 1, ''),
(76123928, 'Beth', 'Finnigan', '', '', 'Blue', 10, 0, 0, 0, 0, '76123928@waitrose.co.uk', '', 1, ''),
(82816050, 'Joanna', 'Foley', 'WR60SBX', '', 'Red', 10, 0, 1, 1, 0, '82816050@waitrose.co.uk', '', 1, '2018-04-04 12:43:29'),
(82516863, 'Sharon', 'Foley', '', '', 'Green', 10, 0, 0, 0, 0, '82516863@waitrose.co.uk', '', 1, ''),
(82993556, 'Jonathan', 'Fox', 'LN64WRJ', '', 'Red', 10, 0, 0, 0, 0, '82993556@waitrose.co.uk', '', 1, ''),
(82851352, 'Maddie', 'Gill', '', '', 'Green', 10, 0, 0, 0, 0, '82851352@waitrose.co.uk', '', 1, ''),
(75400197, 'Elaine', 'Gillings', 'WM14WML', '', 'Blue', 10, 0, 0, 0, 0, '75400197@waitrose.co.uk', '', 1, ''),
(80786731, 'June', 'Greenwood', '', '', 'Yellow', 10, 0, 0, 0, 0, '80786731@waitrose.co.uk', '', 1, ''),
(83220852, 'Zara', 'Hadi', '', '', 'Yellow', 10, 0, 0, 0, 0, '83220852@waitrose.co.uk', '', 1, ''),
(81305141, 'Joe', 'Hall', 'LO65HJJ', '', 'Blue', 10, 0, 0, 0, 0, '81305141@waitrose.co.uk', '', 1, ''),
(77341007, 'Naomi', 'Halliday', '', '', 'Blue', 10, 0, 0, 0, 0, '77341007@waitrose.co.uk', '', 1, ''),
(83102019, 'Lewis', 'Henry', '', '', 'Red', 10, 0, 0, 0, 0, '83102019@waitrose.co.uk', '', 1, ''),
(71216774, 'Pauline', 'Holmes', 'MAZ6550', '', 'Green', 10, 0, 0, 0, 0, '71216774@waitrose.co.uk', '', 1, ''),
(71591567, 'Sue', 'Howlett', '', '', 'Yellow', 10, 0, 0, 0, 0, '71591567@waitrose.co.uk', '', 1, ''),
(81781881, 'B', 'Ince', 'LR56PWY', '', 'Red', 10, 0, 0, 0, 0, '81781881@waitrose.co.uk', '', 1, ''),
(83198830, 'Sophie', 'Inthinathan', '', '', 'Red', 10, 0, 0, 0, 0, '83198830@waitrose.co.uk', '', 1, ''),
(83140107, 'Curtis', 'Jackson', '', '', 'Green', 10, 0, 0, 0, 0, '83140107@waitrose.co.uk', '', 1, ''),
(71121757, 'Rajni', 'Jagani', '', '', 'Blue', 10, 0, 0, 0, 0, '71121757@waitrose.co.uk', '', 1, ''),
(80700357, 'Tong', 'Jieamtarvorn', '', '', 'Yellow', 10, 0, 0, 0, 0, '80700357@waitrose.co.uk', '', 1, ''),
(82906459, 'Wendy', 'Jones', 'PK51SOC', '', 'Blue', 10, 0, 1, 0, 0, '82906459@waitrose.co.uk', '', 1, ''),
(77539621, 'Bhumita', 'Joshi', 'OE52GYJ ', '', 'Yellow', 10, 0, 0, 0, 0, '77539621@waitrose.co.uk', '', 1, ''),
(82844348, 'Matthew', 'Kennard', '', '', 'Blue', 10, 0, 0, 0, 0, '82844348@waitrose.co.uk', '', 1, ''),
(75595745, 'Jon', 'Knight', 'LT62URL', '', 'Blue', 10, 0, 0, 0, 0, '75595745@waitrose.co.uk', '', 1, ''),
(83222278, 'Kabilan', 'Kunasegaran', '', '', 'Green', 10, 0, 0, 0, 0, '83222278@waitrose.co.uk', '', 1, ''),
(82214786, 'Hanife', 'Kussan', '', '', 'Green', 10, 0, 0, 0, 0, '82214786@waitrose.co.uk', '', 1, ''),
(80157521, 'Lee-Kenny', 'Langham', '', '', 'Red', 10, 0, 0, 0, 0, '80157521@waitrose.co.uk', '', 1, ''),
(82372861, 'Alex', 'Larranaga', 'SC13JNU', '', 'Green', 10, 0, 1, 0, 0, '82372861@waitrose.co.uk', '', 1, '2018-04-04 18:04:25'),
(83174087, 'Edward', 'Lemmon', 'HN14EKE', '', 'Blue', 10, 0, 0, 0, 0, '83174087@waitrose.co.uk', '', 1, ''),
(81001746, 'Vjollca', 'Loshi', '', '', 'Blue', 10, 0, 0, 0, 0, '81001746@waitrose.co.uk', '', 1, ''),
(83220860, 'Amir', 'Makwana', '', '', 'Blue', 10, 0, 0, 0, 0, '83220860@waitrose.co.uk', '', 1, ''),
(83206965, 'Adam', 'Mansaf', '', '', 'Red', 10, 0, 0, 0, 0, '83206965@waitrose.co.uk', '', 1, ''),
(81611943, 'Richard', 'Matthews', '', '', 'Blue', 10, 0, 0, 0, 0, '81611943@waitrose.co.uk', '', 1, ''),
(81753985, 'Amy', 'McGrath', '', '', 'Green', 10, 0, 0, 0, 0, '81753985@waitrose.co.uk', '', 1, ''),
(76633055, 'Nicky', 'McInerney', '', '07960864097', 'Yellow', 10, 0, 0, 0, 0, '76633055@waitrose.co.uk', '', 1, ''),
(83172785, 'Vicky', 'McInerney', '', '', 'Yellow', 10, 0, 0, 0, 0, '83172785@waitrose.co.uk', '', 1, ''),
(82307717, 'Aoife', 'McNulty', '', '', 'Yellow', 10, 0, 0, 0, 0, '82307717@waitrose.co.uk', '', 1, ''),
(83220879, 'Abi', 'Medway-Smith', '', '', 'Green', 10, 0, 0, 0, 0, '83220879@waitrose.co.uk', '', 1, ''),
(71121706, 'Sarah', 'Mensah', '', '', 'Green', 10, 0, 0, 0, 0, '71121706@waitrose.co.uk', '', 1, ''),
(82766436, 'Rayo', 'Meshioye', '', '', 'Green', 10, 0, 0, 0, 0, '82766436@waitrose.co.uk', '', 1, ''),
(82937745, 'Arian', 'Mohammadzadeh', '', '', 'Green', 10, 0, 0, 0, 0, '82937745@waitrose.co.uk', '', 1, ''),
(83227601, 'Daniel', 'Morley', '', '', 'Green', 10, 0, 0, 0, 0, '83227601@waitrose.co.uk', '', 1, ''),
(71121773, 'Brigid', 'Murphy', '', '', 'Yellow', 10, 0, 0, 0, 0, '71121773@waitrose.co.uk', '', 1, ''),
(82815585, 'Mursal', 'Nadeem', 'GJ10SFU', '', 'Green', 10, 0, 0, 0, 0, '82815585@waitrose.co.uk', '', 1, ''),
(82626065, 'Mohini', 'Nanjee', '', '', 'Yellow', 10, 0, 0, 0, 0, '82626065@waitrose.co.uk', '', 1, ''),
(82976961, 'Kim', 'Newby', '', '', 'Blue', 10, 0, 0, 0, 0, '82976961@waitrose.co.uk', '', 1, ''),
(81599846, 'Yaz', 'Nikkhouee', '', '', 'Blue', 10, 0, 0, 0, 0, '81599846@waitrose.co.uk', '', 1, ''),
(82907064, 'Kelly', 'O\'Driscoll', '', '', 'Red', 10, 0, 1, 0, 0, '82907064@waitrose.co.uk', '', 1, ''),
(70834024, 'Carol', 'Oliver', '', '', 'Red', 10, 0, 0, 0, 0, '70834024@waitrose.co.uk', '', 1, ''),
(82480834, 'Manish', 'Pabari', '', '', 'Yellow', 10, 0, 0, 0, 0, '82480834@waitrose.co.uk', '', 1, ''),
(82310904, 'Shrina', 'Parmar', 'PX60ZLO', '', 'Red', 10, 0, 0, 0, 0, '82310904@waitrose.co.uk', '', 1, ''),
(83098313, 'Priti', 'Parmar', 'PX60ZLO', '', 'Green', 10, 0, 0, 0, 0, '83098313@waitrose.co.uk', '', 1, ''),
(82766029, 'Dee', 'Patros', '', '', 'Red', 10, 0, 0, 0, 0, '82766029@waitrose.co.uk', '', 1, ''),
(70122067, 'Janet', 'Plimmer', '', '', 'Blue', 10, 0, 0, 0, 0, '70122067@waitrose.co.uk', '', 1, ''),
(75684012, 'Praba', 'Prabakaran', '', '', 'Green', 10, 0, 0, 0, 0, '75684012@waitrose.co.uk', '', 1, ''),
(83220844, 'Nadia', 'Puttock', '', '', 'Red', 10, 0, 0, 0, 0, '83220844@waitrose.co.uk', '', 1, ''),
(83039929, 'Nita', 'Rai', '', '', 'Yellow', 10, 0, 0, 0, 0, '83039929@waitrose.co.uk', '', 1, ''),
(82673594, 'Vijayen', 'Ramasamy', 'B7VJR RJ', '', 'Blue', 10, 0, 1, 0, 0, '82673594@waitrose.co.uk', '', 1, '2018-04-04 19:58:14'),
(81979312, 'Zaynab', 'Rashid', 'PE55NPZ', '', 'Yellow', 10, 0, 0, 0, 0, '81979312@waitrose.co.uk', '', 1, ''),
(81302169, 'Alex', 'Richardson', '', '', 'Yellow', 10, 0, 0, 0, 0, '81302169@waitrose.co.uk', '', 1, ''),
(71023615, 'Jean', 'Roser', '', '', 'Green', 10, 0, 0, 0, 0, '71023615@waitrose.co.uk', '', 1, ''),
(70898669, 'Lisa', 'Sartori', '', '', 'Red', 10, 0, 0, 0, 0, '70898669@waitrose.co.uk', '', 1, ''),
(83198822, 'Eva-Rose', 'Scriven', '', '', 'Blue', 10, 0, 0, 0, 0, '83198822@waitrose.co.uk', '', 1, ''),
(82920230, 'Niall', 'Sexton', '', '', 'Red', 10, 0, 0, 0, 0, '82920230@waitrose.co.uk', '', 1, ''),
(82689202, 'Romey', 'Sgambati', '', '', 'Blue', 10, 0, 0, 0, 0, '82689202@waitrose.co.uk', '', 1, ''),
(70362076, 'Bharti', 'Shah', '', '', 'Green', 10, 0, 0, 0, 0, '70362076@waitrose.co.uk', '', 1, ''),
(82568332, 'Poonam', 'Shah', '', '', 'Blue', 10, 0, 0, 0, 0, '82568332@waitrose.co.uk', '', 1, ''),
(82227810, 'Shakhil', 'Shah', 'VN13YDD', '', 'Red', 10, 0, 1, 1, 0, '82227810@waitrose.co.uk', '', 1, '2018-04-05 19:05:04'),
(77155599, 'Sunita', 'Shah', '', '', 'Red', 10, 0, 0, 0, 0, '77155599@waitrose.co.uk', '', 1, ''),
(76750302, 'Vanita', 'Shah', '', '', 'Yellow', 10, 0, 0, 0, 0, '76750302@waitrose.co.uk', '', 1, ''),
(83047646, 'Dylan', 'Shima', '', '', 'Red', 10, 0, 0, 0, 0, '83047646@waitrose.co.uk', '', 1, ''),
(82833044, 'Sophie', 'Symeou', '', '', 'Green', 10, 0, 0, 0, 0, '82833044@waitrose.co.uk', '', 1, ''),
(75818418, 'Usha', 'Tanna', '', '', 'Yellow', 10, 0, 0, 0, 0, '75818418@waitrose.co.uk', '', 1, ''),
(80686370, 'Christina', 'Therianou', '', '', 'Blue', 10, 0, 0, 0, 0, '80686370@waitrose.co.uk', '', 1, ''),
(70899312, 'Roz', 'Thomas', '', '', 'Yellow', 10, 0, 0, 0, 0, '70899312@waitrose.co.uk', '', 1, ''),
(80836771, 'Joel', 'Thompson', '', '', 'Red', 10, 0, 0, 0, 0, '80836771@waitrose.co.uk', '', 1, ''),
(83172777, 'Emily', 'Todd', '', '', 'Yellow', 10, 0, 0, 0, 0, '83172777@waitrose.co.uk', '', 1, ''),
(81854196, 'Lewis', 'Weekes', '', '', 'Red', 10, 0, 0, 0, 0, '81854196@waitrose.co.uk', '', 1, ''),
(83113754, 'Amanda', 'Yates', '', '', 'Green', 10, 0, 0, 0, 0, '83113754@waitrose.co.uk', '', 1, ''),
(83174079, 'Florentina', 'Yiannourides', '', '', 'Green', 10, 0, 0, 0, 0, '83174079@waitrose.co.uk', '', 1, ''),
(70288887, 'Dilip', 'Dattani', 'GU13HMO', '', 'Green', 8, 0, 1, 1, 1, '70288887.mail@waitrose.co.uk', '', 1, ''),
(71488286, 'Terri', 'Jones', 'EA12GGF', '', 'Yellow', 8, 0, 1, 1, 1, '71488286.mail@waitrose.co.uk', '', 1, '2018-04-04 22:25:43'),
(80682529, 'Donna', 'Lakey', 'PN55OVR', '', 'Red', 8, 0, 1, 1, 1, '80682529.mail@waitrose.co.uk', '', 1, '2018-04-04 10:44:52'),
(80809170, 'Conor', 'O\'Sullivan', 'BG60UVR', '', 'Blue', 8, 0, 1, 1, 1, '80809170.mail@waitrose.co.uk', '', 1, '2018-04-05 16:48:47'),
(71251502, 'Andy', 'Gaul', '', '', 'Green', 9, 0, 1, 1, 1, '71251502.mail@waitrose.co.uk', '', 1, '2018-04-03 22:21:10'),
(80475132, 'Dean', 'Hagger', 'DU64DVK', '', 'Blue', 9, 0, 1, 1, 1, '80475132.mail@waitrose.co.uk', '', 1, '2018-04-05 20:51:02'),
(75285487, 'Jacqui', 'Murrell', 'LD07YCK', '', 'Red', 9, 0, 1, 1, 1, '75285487.mail@waitrose.co.uk', '', 1, '2018-04-04 14:35:14'),
(80562884, 'Michaela', 'Pitrakou', 'YE17UTS', '', 'Yellow', 9, 0, 1, 1, 1, '80562884.mail@waitrose.co.uk', '', 1, '2018-04-05 14:44:03'),
(76630137, 'Andy', 'Crowther', 'AC10MUS', '07790050500', 'Purple', 7, 1, 1, 1, 1, '76630137.mail@waitrose.co.uk', '', 1, '2018-04-05 21:01:50'),
(80119921, 'Dom', 'Korobowicz', '', '', 'Brown', 6, 0, 1, 1, 1, '80119921.mail@waitrose.co.uk', '', 1, '2018-04-05 19:58:41'),
(11111111, 'Cleaners', NULL, '', '', 'White', 10, 0, 0, 0, 0, '11111111@waitrose.co.uk', '', 1, ''),
(22222222, 'Sushi Daily', NULL, 'HD06LPL', '', 'White', 10, 0, 0, 0, 0, '222222222@waitrose.co.uk', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `rotationchecks`
--

CREATE TABLE `rotationchecks` (
  `id` int(6) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `partner` int(8) DEFAULT NULL,
  `area` varchar(12) DEFAULT NULL,
  `result` varchar(4) DEFAULT NULL,
  `discussion` varchar(140) DEFAULT NULL,
  `manager` int(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rotationchecks`
--

INSERT INTO `rotationchecks` (`id`, `time`, `partner`, `area`, `result`, `discussion`, `manager`) VALUES
(1, '2018-03-23 12:12:04', 82737010, '2', 'pass', '', 80809170),
(2, '2018-03-23 12:16:46', 71670343, '4', 'pass', '', 71251502),
(3, '2018-03-23 12:17:25', 82478627, '3', 'pass', '', 71251502),
(4, '2018-03-23 12:17:47', 81004087, '3', 'pass', '', 71251502),
(5, '2018-03-23 12:18:06', 82744459, '13', 'pass', '', 71251502),
(6, '2018-03-23 12:18:22', 82918627, '5', 'pass', '', 70288887),
(7, '2018-03-23 12:19:16', 82602832, '17', 'pass', '', 70288887),
(8, '2018-03-23 12:19:33', 83198822, '5', 'pass', '', 70288887),
(9, '2018-03-23 12:19:54', 82737010, '14', 'pass', '', 70288887),
(10, '2018-03-23 12:20:13', 82737010, '5', 'pass', '', 70288887),
(11, '2018-03-23 12:20:31', 83102019, '4', 'pass', '', 82227810),
(12, '2018-03-23 12:20:50', 82816050, '4', 'pass', '', 82227810),
(13, '2018-03-23 12:21:12', 83039929, '2', 'pass', '', 82227810),
(14, '2018-03-23 12:21:27', 82227810, '5', 'pass', '', 75285487),
(15, '2018-03-23 12:21:40', 82618577, '4', 'pass', '', 82227810),
(16, '2018-03-23 12:21:57', 81781881, '14', 'pass', '', 82227810),
(17, '2018-03-23 12:22:12', 82618577, '4', 'pass', '', 82227810),
(18, '2018-03-23 12:22:32', 82827435, '7', 'pass', '', 82227810),
(19, '2018-03-23 12:22:49', 81576285, '1', 'pass', '', 82227810),
(20, '2018-03-23 12:23:06', 81979290, '1', 'pass', '', 82227810),
(21, '2018-03-23 12:23:25', 83174087, '13', 'fail', '', 82227810),
(22, '2018-03-24 12:23:39', 82744459, '13', 'fail', '', 82227810),
(38, '2018-03-29 18:55:17', 71670343, '1', 'pass', '', 82227810),
(37, '2018-03-29 18:46:00', 83174079, '3', 'pass', '', 82673594),
(36, '2018-03-29 18:44:13', 82618577, '1', 'pass', '', 82673594),
(35, '2018-03-29 18:43:52', 83113754, '1', 'pass', '', 82673594),
(39, '2018-03-31 17:40:56', 82568332, '3', 'pass', '', 70288887),
(40, '2018-03-31 17:41:08', 82906459, '3', 'pass', '', 70288887),
(41, '2018-03-31 17:41:21', 82902860, '17', 'pass', '', 70288887),
(42, '2018-03-31 17:41:33', 83206965, '1', 'pass', '', 70288887),
(44, '2018-04-02 13:56:42', 71251502, '9', 'fail', 'Had put new ones to the back, but didn\'t check others already on shelf', 76630137),
(45, '2018-04-02 19:11:57', 82227810, '5', 'pass', '', 82673594),
(46, '2018-04-02 20:33:09', 81979290, '1', 'pass', '', 80562884),
(47, '2018-04-04 13:26:37', 71670343, '4', 'pass', '', 80809170),
(48, '2018-04-04 13:27:45', 82478627, '13', 'pass', '', 80809170),
(49, '2018-04-04 13:29:33', 83174079, '3', 'pass', '', 80809170),
(50, '2018-04-04 13:29:55', 83140107, '3', 'pass', '', 80809170),
(51, '2018-04-05 13:23:11', 83102019, '3', 'pass', '', 82227810),
(52, '2018-04-05 13:23:29', 82815585, '4', 'pass', '', 82227810),
(53, '2018-04-05 13:33:04', 83039929, '1', 'fail', 'Passed 2/3 attempted but not perfect', 82227810),
(54, '2018-04-05 13:44:43', 82906459, '9', 'pass', '', 82227810);

-- --------------------------------------------------------

--
-- Table structure for table `uniformchecks`
--

CREATE TABLE `uniformchecks` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `partner` int(8) NOT NULL,
  `result` varchar(4) NOT NULL,
  `discussion` varchar(140) NOT NULL,
  `manager` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uniformchecks`
--

INSERT INTO `uniformchecks` (`id`, `time`, `partner`, `result`, `discussion`, `manager`) VALUES
(7, '2018-04-02 11:47:02', 75400197, 'pass', 'Has been recommended to wear her trainers. Look smart though. No coloured badge.', 76630137),
(8, '2018-04-02 11:47:58', 81089805, 'pass', 'Black Timberlands', 76630137),
(9, '2018-04-02 11:49:32', 82478627, 'fail', 'Incorrect shoes- has said he will get new shoes. \r\nNo name badge', 80562884),
(10, '2018-04-02 11:50:36', 82673594, 'fail', 'No name badge, shirt untucked', 76630137),
(11, '2018-04-02 11:52:14', 82902860, 'fail', 'Wearing vans', 82227810),
(12, '2018-04-02 11:52:52', 71670343, 'pass', 'No blue team badge', 80562884),
(13, '2018-04-02 11:53:24', 82816050, 'pass', '', 82227810),
(14, '2018-04-02 11:58:29', 77155599, 'fail', 'No name badge', 76630137),
(15, '2018-04-02 12:07:17', 76633055, 'pass', 'Black trainers but requested by doctor', 76630137),
(16, '2018-04-02 12:19:03', 82903999, 'pass', 'No red badge', 80562884),
(17, '2018-04-02 12:19:29', 82906459, 'pass', '', 80562884),
(18, '2018-04-02 12:24:57', 75684012, 'pass', '', 80562884),
(19, '2018-04-02 13:25:23', 71121773, 'pass', '', 76630137),
(22, '2018-04-03 15:06:26', 80836771, 'pass', '', 82227810),
(21, '2018-04-02 15:47:26', 82815585, 'fail', 'No name badge, wrong dress (correct one is at home) and team badge in pocket', 76630137),
(23, '2018-04-03 15:06:52', 83222278, 'pass', '', 82227810),
(24, '2018-04-03 16:03:48', 80478255, 'pass', '', 80562884),
(25, '2018-04-03 19:21:30', 71143769, 'pass', '', 76630137),
(26, '2018-04-04 05:53:35', 81841876, '', 'Testing discussion', 76630137),
(27, '2018-04-05 08:42:54', 70834024, 'fail', 'No name badge, or team badge', 76630137),
(28, '2018-04-05 08:46:07', 82480834, 'fail', 'No name badge and plimsolls. Will get new shoes this weekend.', 76630137),
(29, '2018-04-05 09:38:20', 83220879, 'pass', '\"Looks Quality Mate\"', 82227810),
(30, '2018-04-05 10:42:27', 71216774, 'pass', '', 71251502),
(31, '2018-04-05 10:43:33', 81781881, 'fail', 'No name badge. No team badge', 76630137),
(32, '2018-04-05 13:36:43', 81268270, 'pass', '', 82227810);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bagchecks`
--
ALTER TABLE `bagchecks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diarynotes`
--
ALTER TABLE `diarynotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`employee`);

--
-- Indexes for table `rotationchecks`
--
ALTER TABLE `rotationchecks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uniformchecks`
--
ALTER TABLE `uniformchecks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bagchecks`
--
ALTER TABLE `bagchecks`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `diarynotes`
--
ALTER TABLE `diarynotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rotationchecks`
--
ALTER TABLE `rotationchecks`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `uniformchecks`
--
ALTER TABLE `uniformchecks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
