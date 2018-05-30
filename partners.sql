-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2018 at 02:24 AM
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
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `employee` int(8) NOT NULL DEFAULT '0',
  `firstname` varchar(23) DEFAULT NULL,
  `surname` varchar(14) DEFAULT NULL,
  `team` varchar(6) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '10',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `canrotationcheck` tinyint(1) NOT NULL DEFAULT '0',
  `canuniformcheck` tinyint(1) NOT NULL DEFAULT '0',
  `canbagcheck` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`employee`, `firstname`, `surname`, `team`, `level`, `admin`, `canrotationcheck`, `canuniformcheck`, `canbagcheck`, `email`, `picture`) VALUES
(82922985, 'Norhan', 'Abdelaziz', 'Red', 10, 0, 0, 0, 0, '82922985@waitrose.co.uk', ''),
(82227829, 'Mareya', 'Ali Khan', 'Yellow', 10, 0, 0, 0, 0, '82227829@waitrose.co.uk', ''),
(83099840, 'Michael', 'Amara', 'Green', 10, 0, 0, 0, 0, '83099840@waitrose.co.uk', ''),
(83305076, 'Holly Amanda', 'Appleyard', 'Yellow', 10, 0, 0, 0, 0, '83305076@waitrose.co.uk', ''),
(82618577, 'Amy', 'Applin', 'Red', 10, 0, 0, 0, 0, '82618577@waitrose.co.uk', ''),
(82478627, 'Andy', 'Ayers', 'Red', 10, 0, 0, 0, 0, '82478627@waitrose.co.uk', ''),
(80478255, 'Jafer', 'Bahcevangil', 'Red', 10, 0, 0, 0, 0, '80478255@waitrose.co.uk', ''),
(83220887, 'Fifi', 'Banin', 'Red', 10, 0, 0, 0, 0, '83220887@waitrose.co.uk', ''),
(81350384, 'Tim', 'Barrett', 'Green', 10, 0, 0, 0, 0, '81350384@waitrose.co.uk', ''),
(77464966, 'Matt', 'Beal', 'Blue', 10, 0, 0, 0, 0, '77464966@waitrose.co.uk', ''),
(83108815, 'Nula', 'Bealby', 'Red', 10, 0, 0, 0, 0, '83108815@waitrose.co.uk', ''),
(82997543, 'Evey', 'Becker', 'Red', 10, 0, 0, 0, 0, '82997543@waitrose.co.uk', ''),
(81343949, 'Richard Joseph', 'Bell', 'Yellow', 10, 0, 0, 0, 0, '81343949@waitrose.co.uk', ''),
(82844321, 'Victoria', 'Beverstock', 'Green', 10, 0, 0, 0, 0, '82844321@waitrose.co.uk', ''),
(82394180, 'Finnley', 'Blake', 'Green', 10, 0, 0, 0, 0, '82394180@waitrose.co.uk', ''),
(81089805, 'Valentina', 'Bogris', 'Green', 10, 0, 0, 0, 0, '81089805@waitrose.co.uk', ''),
(82902860, 'Carlo', 'Bonito', 'Red', 10, 0, 0, 0, 0, '82902860@waitrose.co.uk', ''),
(81302126, 'Luke', 'Bonito', 'Blue', 10, 0, 0, 0, 0, '81302126@waitrose.co.uk', ''),
(82856397, 'Sam', 'Brazier', 'Red', 10, 0, 0, 0, 0, '82856397@waitrose.co.uk', ''),
(82718644, 'Emma', 'Broderick', 'Yellow', 10, 0, 0, 0, 0, '82718644@waitrose.co.uk', ''),
(75610752, 'Paul Anthony', 'Canton', 'Yellow', 10, 0, 0, 0, 0, '75610752@waitrose.co.uk', ''),
(83299386, 'Jordana Leigh', 'Carbis', 'Red', 10, 0, 0, 0, 0, '83299386@waitrose.co.uk', ''),
(81529031, 'Lorraine', 'Carbis', 'Yellow', 10, 0, 0, 0, 0, '81529031@waitrose.co.uk', ''),
(81979290, 'Shelby Summer', 'Carling', 'Blue', 10, 0, 0, 0, 0, '81979290@waitrose.co.uk', ''),
(82737010, 'Elsa', 'Cerimi', 'Yellow', 10, 0, 0, 0, 0, '82737010@waitrose.co.uk', ''),
(82846065, 'Jay Or Jermaine Is Fine', 'Chambers', 'Blue', 10, 0, 0, 0, 0, '82846065@waitrose.co.uk', ''),
(82744459, 'James Charles', 'Clark', 'Blue', 10, 0, 0, 0, 0, '82744459@waitrose.co.uk', ''),
(81090064, 'Hannah Louise', 'Clifford', 'Blue', 10, 0, 0, 0, 0, '81090064@waitrose.co.uk', ''),
(80367305, 'Alexis', 'Constantas', 'Green', 10, 0, 0, 0, 0, '80367305@waitrose.co.uk', ''),
(82306826, 'India Louise', 'Cooper', 'Yellow', 10, 0, 0, 0, 0, '82306826@waitrose.co.uk', ''),
(82847266, 'Christian', 'Cotterill', 'Blue', 10, 0, 0, 0, 0, '82847266@waitrose.co.uk', ''),
(83172793, 'Isabelle', 'Coughlan', 'Red', 10, 0, 0, 0, 0, '83172793@waitrose.co.uk', ''),
(71143769, 'John', 'Crisford', 'Blue', 10, 0, 0, 0, 0, '71143769@waitrose.co.uk', ''),
(82968500, 'Beth', 'Cronin', 'Yellow', 10, 0, 0, 0, 0, '82968500@waitrose.co.uk', ''),
(81841876, 'Aaron', 'Cross', 'Green', 10, 0, 0, 0, 0, '81841876@waitrose.co.uk', ''),
(81576285, 'Cameron', 'Daee', 'Blue', 10, 0, 0, 0, 0, '81576285@waitrose.co.uk', ''),
(81004087, 'Eleanor', 'Daulby', 'Yellow', 10, 0, 0, 0, 0, '81004087@waitrose.co.uk', ''),
(81268270, 'Louise', 'Daulby', 'Green', 10, 0, 0, 0, 0, '81268270@waitrose.co.uk', ''),
(82903999, 'Adam', 'Daulby', 'Red', 10, 0, 0, 0, 0, '82903999@waitrose.co.uk', ''),
(71670343, 'James Patrick', 'Dempsey', 'Blue', 10, 0, 0, 0, 0, '71670343@waitrose.co.uk', ''),
(81841787, 'Payal', 'Depala', 'Blue', 10, 0, 0, 0, 0, '81841787@waitrose.co.uk', ''),
(82827435, 'Parag', 'Depala', 'Green', 10, 0, 0, 0, 0, '82827435@waitrose.co.uk', ''),
(82918627, 'Yash', 'Depala', 'Yellow', 10, 0, 0, 0, 0, '82918627@waitrose.co.uk', ''),
(76028666, 'Naina', 'Depala', 'Red', 10, 0, 0, 0, 0, '76028666@waitrose.co.uk', ''),
(70834741, 'Panna', 'Depala', 'Red', 10, 0, 0, 0, 0, '70834741@waitrose.co.uk', ''),
(82602832, 'Dario', 'Devine', 'Red', 10, 0, 0, 0, 0, '82602832@waitrose.co.uk', ''),
(75862255, 'Paul Jonathan', 'Dingley', 'Red', 10, 0, 0, 0, 0, '75862255@waitrose.co.uk', ''),
(80882161, 'Harrison', 'England-Shaikh', 'Blue', 10, 0, 0, 0, 0, '80882161@waitrose.co.uk', ''),
(76123928, 'Beth', 'Finnigan', 'Blue', 10, 0, 0, 0, 0, '76123928@waitrose.co.uk', ''),
(82816050, 'Joanna Jayne', 'Foley', 'Red', 10, 0, 0, 0, 0, '82816050@waitrose.co.uk', ''),
(82516863, 'Sharon', 'Foley', 'Green', 10, 0, 0, 0, 0, '82516863@waitrose.co.uk', ''),
(82993556, 'Jonathan Patrick', 'Fox', 'Red', 10, 0, 0, 0, 0, '82993556@waitrose.co.uk', ''),
(82851352, 'Maddie', 'Gill', 'Green', 10, 0, 0, 0, 0, '82851352@waitrose.co.uk', ''),
(75400197, 'Elaine', 'Gillings', 'Blue', 10, 0, 0, 0, 0, '75400197@waitrose.co.uk', ''),
(80786731, 'June', 'Greenwood', 'Yellow', 10, 0, 0, 0, 0, '80786731@waitrose.co.uk', ''),
(83220852, 'Zara', 'Hadi', 'Yellow', 10, 0, 0, 0, 0, '83220852@waitrose.co.uk', ''),
(81305141, 'Joe Michael', 'Hall', 'Blue', 10, 0, 0, 0, 0, '81305141@waitrose.co.uk', ''),
(77341007, 'Naomi Sharifa', 'Halliday', 'Blue', 10, 0, 0, 0, 0, '77341007@waitrose.co.uk', ''),
(83102019, 'Lewis Holloway', 'Henry', 'Red', 10, 0, 0, 0, 0, '83102019@waitrose.co.uk', ''),
(71216774, 'Pauline', 'Holmes', 'Green', 10, 0, 0, 0, 0, '71216774@waitrose.co.uk', ''),
(71591567, 'Sue', 'Howlett', 'Yellow', 10, 0, 0, 0, 0, '71591567@waitrose.co.uk', ''),
(81781881, 'B', 'Ince', 'Red', 10, 0, 0, 0, 0, '81781881@waitrose.co.uk', ''),
(83198830, 'Sophie', 'Inthinathan', 'Red', 10, 0, 0, 0, 0, '83198830@waitrose.co.uk', ''),
(83140107, 'Curtis Rhys', 'Jackson', 'Green', 10, 0, 0, 0, 0, '83140107@waitrose.co.uk', ''),
(71121757, 'Rajni', 'Jagani', 'Blue', 10, 0, 0, 0, 0, '71121757@waitrose.co.uk', ''),
(80700357, 'Tong', 'Jieamtarvorn', 'Yellow', 10, 0, 0, 0, 0, '80700357@waitrose.co.uk', ''),
(82906459, 'Wendy Violet', 'Jones', 'Blue', 10, 0, 0, 0, 0, '82906459@waitrose.co.uk', ''),
(77539621, 'Bhumita', 'Joshi', 'Yellow', 10, 0, 0, 0, 0, '77539621@waitrose.co.uk', ''),
(82844348, 'Matthew', 'Kennard', 'Blue', 10, 0, 0, 0, 0, '82844348@waitrose.co.uk', ''),
(75595745, 'Jon', 'Knight', 'Blue', 10, 0, 0, 0, 0, '75595745@waitrose.co.uk', ''),
(83222278, 'Kabilan', 'Kunasegaran', 'Green', 10, 0, 0, 0, 0, '83222278@waitrose.co.uk', ''),
(82214786, 'Hanife Kupra', 'Kussan', 'Green', 10, 0, 0, 0, 0, '82214786@waitrose.co.uk', ''),
(80157521, 'Lee-Kenny', 'Langham', 'Red', 10, 0, 0, 0, 0, '80157521@waitrose.co.uk', ''),
(82372861, 'Alex', 'Larranaga', 'Green', 10, 0, 0, 0, 0, '82372861@waitrose.co.uk', ''),
(83174087, 'Edward', 'Lemmon', 'Blue', 10, 0, 0, 0, 0, '83174087@waitrose.co.uk', ''),
(81001746, 'Vjollca', 'Loshi', 'Blue', 10, 0, 0, 0, 0, '81001746@waitrose.co.uk', ''),
(83220860, 'Amir', 'Makwana', 'Blue', 10, 0, 0, 0, 0, '83220860@waitrose.co.uk', ''),
(83206965, 'Adam', 'Mansaf', 'Red', 10, 0, 0, 0, 0, '83206965@waitrose.co.uk', ''),
(81611943, 'Richard', 'Matthews', 'Blue', 10, 0, 0, 0, 0, '81611943@waitrose.co.uk', ''),
(81753985, 'Amy', 'McGrath', 'Green', 10, 0, 0, 0, 0, '81753985@waitrose.co.uk', ''),
(76633055, 'Nicky', 'McInerney', 'Yellow', 10, 0, 0, 0, 0, '76633055@waitrose.co.uk', ''),
(83172785, 'Vicky', 'McInerney', 'Yellow', 10, 0, 0, 0, 0, '83172785@waitrose.co.uk', ''),
(82307717, 'Aoife', 'McNulty', 'Yellow', 10, 0, 0, 0, 0, '82307717@waitrose.co.uk', ''),
(83220879, 'Abi', 'Medway-Smith', 'Green', 10, 0, 0, 0, 0, '83220879@waitrose.co.uk', ''),
(71121706, 'Sarah', 'Mensah', 'Green', 10, 0, 0, 0, 0, '71121706@waitrose.co.uk', ''),
(82766436, 'Rayo', 'Meshioye', 'Green', 10, 0, 0, 0, 0, '82766436@waitrose.co.uk', ''),
(82937745, 'Arian', 'Mohammadzadeh', 'Green', 10, 0, 0, 0, 0, '82937745@waitrose.co.uk', ''),
(83227601, 'Daniel James', 'Morley', 'Green', 10, 0, 0, 0, 0, '83227601@waitrose.co.uk', ''),
(71121773, 'Brigid', 'Murphy', 'Yellow', 10, 0, 0, 0, 0, '71121773@waitrose.co.uk', ''),
(82815585, 'Mursal', 'Nadeem', 'Green', 10, 0, 0, 0, 0, '82815585@waitrose.co.uk', ''),
(82626065, 'Mohini', 'Nanjee', 'Yellow', 10, 0, 0, 0, 0, '82626065@waitrose.co.uk', ''),
(82976961, 'Kim Victoria', 'Newby', 'Blue', 10, 0, 0, 0, 0, '82976961@waitrose.co.uk', ''),
(81599846, 'Yaz', 'Nikkhouee', 'Blue', 10, 0, 0, 0, 0, '81599846@waitrose.co.uk', ''),
(82907064, 'Kelly', 'O\'Driscoll', 'Red', 10, 0, 0, 0, 0, '82907064@waitrose.co.uk', ''),
(70834024, 'Carol', 'Oliver', 'Red', 10, 0, 0, 0, 0, '70834024@waitrose.co.uk', ''),
(82480834, 'Manish', 'Pabari', 'Yellow', 10, 0, 0, 0, 0, '82480834@waitrose.co.uk', ''),
(82310904, 'Shrina', 'Parmar', 'Red', 10, 0, 0, 0, 0, '82310904@waitrose.co.uk', ''),
(83098313, 'Priti Dipak', 'Parmar', 'Green', 10, 0, 0, 0, 0, '83098313@waitrose.co.uk', ''),
(82766029, 'Dee', 'Patros', 'Red', 10, 0, 0, 0, 0, '82766029@waitrose.co.uk', ''),
(70122067, 'Janet Ann', 'Plimmer', 'Blue', 10, 0, 0, 0, 0, '70122067@waitrose.co.uk', ''),
(75684012, 'Praba', 'Prabakaran', 'Green', 10, 0, 0, 0, 0, '75684012@waitrose.co.uk', ''),
(83220844, 'Nadia', 'Puttock', 'Red', 10, 0, 0, 0, 0, '83220844@waitrose.co.uk', ''),
(83039929, 'Nini', 'Rai', 'Yellow', 10, 0, 0, 0, 0, '83039929@waitrose.co.uk', ''),
(82673594, 'Vijayen', 'Ramasamy', 'Blue', 10, 0, 0, 0, 0, '82673594@waitrose.co.uk', ''),
(81979312, 'Zaynab', 'Rashid', 'Yellow', 10, 0, 0, 0, 0, '81979312@waitrose.co.uk', ''),
(81302169, 'Alex Jackie', 'Richardson', 'Yellow', 10, 0, 0, 0, 0, '81302169@waitrose.co.uk', ''),
(71023615, 'Jean', 'Roser', 'Green', 10, 0, 0, 0, 0, '71023615@waitrose.co.uk', ''),
(70898669, 'Lisa', 'Sartori', 'Red', 10, 0, 0, 0, 0, '70898669@waitrose.co.uk', ''),
(83198822, 'Eva-Rose', 'Scriven', 'Blue', 10, 0, 0, 0, 0, '83198822@waitrose.co.uk', ''),
(82920230, 'Niall', 'Sexton', 'Red', 10, 0, 0, 0, 0, '82920230@waitrose.co.uk', ''),
(82689202, 'Romey Petite', 'Sgambati', 'Blue', 10, 0, 0, 0, 0, '82689202@waitrose.co.uk', ''),
(70362076, 'Bharti', 'Shah', 'Green', 10, 0, 0, 0, 0, '70362076@waitrose.co.uk', ''),
(82568332, 'Poonam', 'Shah', 'Blue', 10, 0, 0, 0, 0, '82568332@waitrose.co.uk', ''),
(82227810, 'Shakhil', 'Shah', 'Red', 10, 0, 0, 0, 0, '82227810@waitrose.co.uk', ''),
(77155599, 'Sunita', 'Shah', 'Red', 10, 0, 0, 0, 0, '77155599@waitrose.co.uk', ''),
(76750302, 'Vanita', 'Shah', 'Yellow', 10, 0, 0, 0, 0, '76750302@waitrose.co.uk', ''),
(83047646, 'Dylan', 'Shima', 'Red', 10, 0, 0, 0, 0, '83047646@waitrose.co.uk', ''),
(82833044, 'Sophie', 'Symeou', 'Green', 10, 0, 0, 0, 0, '82833044@waitrose.co.uk', ''),
(75818418, 'Usha', 'Tanna', 'Yellow', 10, 0, 0, 0, 0, '75818418@waitrose.co.uk', ''),
(80686370, 'Christina', 'Therianou', 'Blue', 10, 0, 0, 0, 0, '80686370@waitrose.co.uk', ''),
(70899312, 'Roz', 'Thomas', 'Yellow', 10, 0, 0, 0, 0, '70899312@waitrose.co.uk', ''),
(80836771, 'Joel', 'Thompson', 'Red', 10, 0, 0, 0, 0, '80836771@waitrose.co.uk', ''),
(83172777, 'Emily Clare', 'Todd', 'Yellow', 10, 0, 0, 0, 0, '83172777@waitrose.co.uk', ''),
(81854196, 'Lewis', 'Weekes', 'Red', 10, 0, 0, 0, 0, '81854196@waitrose.co.uk', ''),
(83113754, 'Amanda', 'Yates', 'Green', 10, 0, 0, 0, 0, '83113754@waitrose.co.uk', ''),
(83174079, 'Florentina', 'Yiannourides', 'Green', 10, 0, 0, 0, 0, '83174079@waitrose.co.uk', ''),
(70288887, 'Dilip Morarji', 'Dattani', NULL, 10, 0, 0, 0, 0, '70288887@waitrose.co.uk', ''),
(71488286, 'Terri Louise', 'Jones', NULL, 10, 0, 0, 0, 0, '71488286@waitrose.co.uk', ''),
(80682529, 'Donna Joanne', 'Lakey', NULL, 10, 0, 0, 0, 0, '80682529@waitrose.co.uk', ''),
(80809170, 'Conor', 'O\'Sullivan', NULL, 10, 0, 0, 0, 0, '80809170@waitrose.co.uk', ''),
(71251502, 'Andy', 'Gaul', NULL, 10, 0, 0, 0, 0, '71251502@waitrose.co.uk', ''),
(80475132, 'Dean', 'Hagger', NULL, 10, 0, 0, 0, 0, '80475132@waitrose.co.uk', ''),
(75285487, 'Jacqui', 'Murrell', NULL, 10, 0, 0, 0, 0, '75285487@waitrose.co.uk', ''),
(80562884, 'Michaela Georgina', 'Pitrakou', NULL, 10, 0, 0, 0, 0, '80562884@waitrose.co.uk', ''),
(76630137, 'Andy', 'Crowther', 'Purple', 7, 1, 1, 1, 1, '76630137.mail@waitrose.co.uk', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`employee`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
