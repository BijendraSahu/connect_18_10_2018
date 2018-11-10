-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2018 at 03:56 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCustomerLevel` (IN `id1` INT(11), OUT `p_customerLevel` VARCHAR(10))  BEGIN
    DECLARE creditlim double;
 
    SELECT creditlimit INTO creditlim
    FROM customers
    WHERE customerNumber = p_customerNumber;
 
    IF creditlim > 50000 THEN
 SET p_customerLevel = 'PLATINUM';
    ELSEIF (creditlim <= 50000 AND creditlim >= 10000) THEN
        SET p_customerLevel = 'GOLD';
    ELSEIF creditlim < 10000 THEN
        SET p_customerLevel = 'SILVER';
    END IF;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetFriendType` (IN `id1` INT(11), IN `id2` INT(11))  BEGIN
    DECLARE status_ VARCHAR(15);
    
    IF (select id from friends where status='pending' and user_id=id1 and friend_id=id2) > 0 THEN
        SET status_ = 'SENDER';
    ELSEIF ((select id from friends where status='pending' and user_id=id2 and friend_id=id1) > 0) THEN
        SET status_ = 'RECIEVER';
    ELSEIF ((select id from friends where status='friends' and user_id=id1 and friend_id=id2) > 0) THEN
        SET status_ = 'friends';
        ELSEIF ((select id from friends where status='friends' and user_id=id2 and friend_id=id1) > 0) THEN
        SET status_ = 'friends';
    ELSE
        SET status_ = 'NULL';
    END IF;
   select status_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLatestPost` (IN `user_id` INT)  select max(p.id) as id, p.description, (select t.name from timelines t where t.id=p.user_id) as name,
 p.user_id, p.created_at, (select u.profile_pic from users u where u.id=p.user_id) as profile_pic, (select u.id from users u where u.id=p.user_id) as user_id, p.active from posts p where  p.active = 1 and p.user_id=user_id or  p.user_id in  (select fr.user_id from friends fr where fr.status='friends' and fr.friend_id=user_id) or p.user_id in (select f.friend_id from friends f where f.status='friends' and f.user_id=user_id)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reg` (IN `fname` VARCHAR(50), IN `lname` VARCHAR(50), IN `email` VARCHAR(50), IN `contact` VARCHAR(12), IN `password` VARCHAR(50), IN `country_id` INT, IN `city` VARCHAR(50), IN `birthday` DATE, IN `name` VARCHAR(50), IN `otp` VARCHAR(10), IN `gender` VARCHAR(10), IN `rc` VARCHAR(50))  NO SQL
BEGIN
INSERT INTO timelines(name, fname, lname)VALUES(name,fname,lname);
INSERT INTO users(timeline_id,email,contact,password,country_id,city,birthday,otp,gender,rc)VALUES((SELECT MAX(id) FROM timelines),email,contact,password,country_id,city,birthday,otp,gender,rc);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_ads`
--

CREATE TABLE `admin_ads` (
  `id` int(11) NOT NULL,
  `ad_title` varchar(200) DEFAULT NULL,
  `ad_description` longtext,
  `ad_img` varchar(100) DEFAULT NULL,
  `is_slider` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_ads`
--

INSERT INTO `admin_ads` (`id`, `ad_title`, `ad_description`, `ad_img`, `is_slider`, `is_active`) VALUES
(1, 'dsc', 'gadfas', 'buysell/wSOhmO_ret.jpg', 0, 1),
(2, 'm', 'mk', 'buysell/Ba7nti_ret1.jpg', 1, 0),
(3, 'SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT', 'dsa', 'buysell/qrmjF7_Adver_img1.jpg', 1, 1),
(4, 'SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT', 'dsfa', 'buysell/wkD71X_NybWAe_slide2.png', 1, 1),
(5, 'Test2', 'djagsjhgfa', 'buysell/VMG22w_3834046-wallpaper-vector.jpg', 0, 1),
(6, 'Test3', 'dasfasd', 'buysell/RaEEpF_Adver_img1.jpg', 0, 1),
(7, 'Test4', 'fdsagfas', 'buysell/9NqGyj_NybWAe_slide2.png', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT 'images/Male_default.png',
  `designation` varchar(50) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`id`, `name`, `username`, `password`, `profile_pic`, `designation`, `is_active`) VALUES
(1, 'Ajay Goutam', 'admin', '202cb962ac59075b964b07152d234b70', 'profile/o4VuEE_17241-200.png', 'Engineer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `ad_title` text,
  `ad_description` longtext CHARACTER SET utf8mb4,
  `ad_category_id` int(11) DEFAULT NULL,
  `other_cat` text,
  `user_id` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `selling_cost` float DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `reject_reason` varchar(500) DEFAULT NULL,
  `is_approved` tinyint(4) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `ad_title`, `ad_description`, `ad_category_id`, `other_cat`, `user_id`, `city`, `selling_cost`, `email`, `contact`, `location`, `status`, `reject_reason`, `is_approved`, `is_active`, `created_time`) VALUES
(1, 'SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor\r\n                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud\r\n                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, NULL, 2, 'Jabalpur', NULL, NULL, NULL, NULL, 'Approved', NULL, 1, 1, '2018-03-05 12:48:38'),
(2, 'add title', 'gfdsa', 1, NULL, 2, 'Jabalpur', NULL, NULL, NULL, NULL, 'Rejected', 'fdgdfgfd', 1, 1, '2018-03-05 12:48:38'),
(3, 'ads', 'dsada', 2, NULL, 2, 'Jabalpur', NULL, NULL, NULL, NULL, 'Rejected', NULL, 0, 1, '2018-03-05 12:48:38'),
(4, NULL, NULL, 1, NULL, 2, NULL, NULL, NULL, NULL, NULL, 'Rejected', 'sgfgdfgdf', 0, 1, '2018-03-13 10:17:07'),
(5, NULL, NULL, 1, NULL, 2, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, 0, 0, '2018-03-13 10:22:22'),
(6, '.net Developer', 'asdasdasdasd', 3, NULL, 2, 'Jabalpur', NULL, NULL, NULL, NULL, 'Rejected', 'c', 1, 1, '2018-03-13 10:24:57'),
(7, 'New Advertisation', 'dfdfdsf', 5, NULL, 2, 'Jabalpur', NULL, NULL, NULL, NULL, 'Rejected', 'jh', 0, 1, '2018-03-13 10:25:48'),
(8, 'Test', 'safaf', 1, NULL, 4, 'Jabalpur', NULL, NULL, NULL, NULL, 'Rejected', ';klo\'[', 0, 0, '2018-04-06 09:23:21'),
(9, NULL, NULL, 2, NULL, 2, NULL, NULL, NULL, NULL, NULL, 'Approved', NULL, 1, 1, '2018-04-09 06:51:23'),
(10, 'ytrwy', 'fdasg', 3, NULL, 2, 'Jabalpur', NULL, NULL, NULL, NULL, 'Pending', NULL, 1, 1, '2018-04-09 08:48:25'),
(11, 'Test Title', 'Test Description', 1, NULL, 39, 'Jabalpur City', NULL, NULL, NULL, NULL, 'Pending', NULL, 0, 1, '2018-04-17 13:10:04'),
(12, 'test', 'das', 1, NULL, 4, 'dsa', NULL, NULL, NULL, NULL, 'Pending', NULL, 0, 1, '2018-08-08 11:44:18'),
(13, 'ad title', 'Ad des', NULL, 'dfca', 2, 'Jabalpur', NULL, NULL, NULL, NULL, 'Pending', NULL, 0, 1, '2018-10-13 11:07:04'),
(14, 'ad title', 'Ad des', NULL, 'dfca', 2, 'Jabalpur', NULL, NULL, NULL, NULL, 'Pending', NULL, 0, 1, '2018-10-13 11:07:53'),
(15, '5898989892', 'dsa', 1, NULL, 4, 'Jabalpur', 1000, 'bijendrasahu888@gmail.com', NULL, 'dsa', 'Pending', NULL, 0, 1, '2018-11-10 07:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `ads_clicked`
--

CREATE TABLE `ads_clicked` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `click_count` int(11) DEFAULT NULL,
  `clicked_date` date DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads_clicked`
--

INSERT INTO `ads_clicked` (`id`, `user_id`, `ad_id`, `click_count`, `clicked_date`, `is_active`) VALUES
(1, 39, 1, 3, '2018-05-18', 1),
(2, 39, 5, 3, '2018-05-18', 1),
(3, 39, 6, 3, '2018-05-18', 1),
(4, 39, 7, 3, '2018-05-18', 1),
(5, 2, 1, 46, '2018-11-09', 1),
(6, 2, 5, 46, '2018-11-09', 1),
(7, 2, 6, 46, '2018-11-09', 1),
(8, 2, 7, 46, '2018-11-09', 1),
(9, 4, 1, 54, '2018-11-10', 1),
(10, 4, 5, 54, '2018-11-10', 1),
(11, 4, 6, 54, '2018-11-10', 1),
(12, 4, 7, 54, '2018-11-10', 1),
(13, 10, 1, 2, '2018-08-17', 1),
(14, 10, 5, 2, '2018-08-17', 1),
(15, 10, 6, 2, '2018-08-17', 1),
(16, 10, 7, 2, '2018-08-17', 1),
(17, 26, 1, 1, '2018-05-18', 1),
(18, 26, 5, 1, '2018-05-18', 1),
(19, 26, 6, 1, '2018-05-18', 1),
(20, 26, 7, 1, '2018-05-18', 1),
(21, 3, 1, 8, '2018-08-17', 1),
(22, 3, 5, 8, '2018-08-17', 1),
(23, 3, 6, 8, '2018-08-17', 1),
(24, 3, 7, 8, '2018-08-17', 1),
(25, 1, 1, 2, '2018-08-09', 1),
(26, 1, 5, 2, '2018-08-09', 1),
(27, 1, 6, 2, '2018-08-09', 1),
(28, 1, 7, 2, '2018-08-09', 1),
(29, 5, 1, 2, '2018-08-17', 1),
(30, 5, 5, 2, '2018-08-17', 1),
(31, 5, 6, 2, '2018-08-17', 1),
(32, 5, 7, 2, '2018-08-17', 1),
(33, 7, 1, 2, '2018-06-18', 1),
(34, 7, 5, 2, '2018-06-18', 1),
(35, 7, 6, 2, '2018-06-18', 1),
(36, 7, 7, 2, '2018-06-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ad_category`
--

CREATE TABLE `ad_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `icon_url` varchar(100) DEFAULT 'cat_icon/car.png',
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_category`
--

INSERT INTO `ad_category` (`id`, `category`, `icon_url`, `is_active`) VALUES
(1, 'Car', 'cat_icon/car.png', 1),
(2, 'Bike', 'cat_icon/bike.png', 1),
(3, 'Property', 'cat_icon/property.png', 1),
(4, 'Furniture', 'cat_icon/furniture.png', 1),
(5, 'Mobile', 'cat_icon/mobile.png', 1),
(6, 'Electronics', 'cat_icon/electronics.png', 1),
(7, 'Jobs', 'cat_icon/jobs.png', 1),
(8, 'Fashion', 'cat_icon/fashion.png', 1),
(9, 'Services', 'cat_icon/services.png', 1),
(10, 'Other', 'cat_icon/other.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ad_images`
--

CREATE TABLE `ad_images` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `image_url` varchar(80) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_images`
--

INSERT INTO `ad_images` (`id`, `ad_id`, `image_url`, `is_active`) VALUES
(1, 1, 'buysell/Adver_img1.jpg', 1),
(2, 2, 'buysell/NybWAe_slide2.png', 1),
(3, 3, 'buysell/3TyuI1_table.png', 1),
(4, 6, 'buysell/vevyfZ_slider-1.jpg', 1),
(5, 7, 'buysell/KfXMkN_slide3.jpg', 1),
(6, 8, 'buysell/lK2Pof_igezqr_post_user_id_2_b1.jpg', 1),
(7, 11, 'buysell/ssvWMU_igezqr_post_user_id_2_b1.jpg', 1),
(8, 12, 'buysell/N0AcgY_banner_slider5.jpg', 1),
(9, 13, 'buysell/1539428824.png', 1),
(10, 14, 'buysell/1539428873.png', 1),
(11, 15, 'buysell/o6sF08png', 1),
(12, 15, 'buysell/qJCHzWpng', 1),
(13, 15, 'buysell/LBiKMopng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` int(11) NOT NULL,
  `affiliate_link` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `affiliate_link`) VALUES
(2, '<div data-WRID=\"WRID-153172365051957453\" data-widgetType=\"staticBanner\"\r\n                                                     data-responsive=\"yes\" data-class=\"affiliateAdsByFlipkart\"\r\n                                                     height=\"250\"\r\n                                                     width=\"300\"></div>\r\n                                                <script async\r\n                                                        src=\"//affiliate.flipkart.com/affiliate/widgets/FKAffiliateWidgets.js\"></script>');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `CID` int(11) NOT NULL,
  `State` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`CID`, `State`, `City`) VALUES
(1, 'Andaman and Nicobar', NULL),
(2, 'Andaman and Nicobar', 'North and Middle Andaman'),
(3, 'Andaman and Nicobar', 'South Andaman'),
(4, 'Andaman and Nicobar', 'Nicobar'),
(5, 'Andhra Pradesh', NULL),
(6, 'Andhra Pradesh', 'Adilabad'),
(7, 'Andhra Pradesh', 'Anantapur'),
(8, 'Andhra Pradesh', 'Chittoor'),
(9, 'Andhra Pradesh', 'East Godavari'),
(10, 'Andhra Pradesh', 'Guntur'),
(11, 'Andhra Pradesh', 'Hyderabad'),
(12, 'Andhra Pradesh', 'Kadapa'),
(13, 'Andhra Pradesh', 'Karimnagar'),
(14, 'Andhra Pradesh', 'Khammam'),
(15, 'Andhra Pradesh', 'Krishna'),
(16, 'Andhra Pradesh', 'Kurnool'),
(17, 'Andhra Pradesh', 'Mahbubnagar'),
(18, 'Andhra Pradesh', 'Medak'),
(19, 'Andhra Pradesh', 'Nalgonda'),
(20, 'Andhra Pradesh', 'Nellore'),
(21, 'Andhra Pradesh', 'Nizamabad'),
(22, 'Andhra Pradesh', 'Prakasam'),
(23, 'Andhra Pradesh', 'Rangareddi'),
(24, 'Andhra Pradesh', 'Srikakulam'),
(25, 'Andhra Pradesh', 'Vishakhapatnam'),
(26, 'Andhra Pradesh', 'Vizianagaram'),
(27, 'Andhra Pradesh', 'Warangal'),
(28, 'Andhra Pradesh', 'West Godavari'),
(29, 'Arunachal Pradesh', NULL),
(30, 'Arunachal Pradesh', 'Anjaw'),
(31, 'Arunachal Pradesh', 'Changlang'),
(32, 'Arunachal Pradesh', 'East Kameng'),
(33, 'Arunachal Pradesh', 'Lohit'),
(34, 'Arunachal Pradesh', 'Lower Subansiri'),
(35, 'Arunachal Pradesh', 'Papum Pare'),
(36, 'Arunachal Pradesh', 'Tirap'),
(37, 'Arunachal Pradesh', 'Dibang Valley'),
(38, 'Arunachal Pradesh', 'Upper Subansiri'),
(39, 'Arunachal Pradesh', 'West Kameng'),
(40, 'Assam', NULL),
(41, 'Assam', 'Barpeta'),
(42, 'Assam', 'Bongaigaon'),
(43, 'Assam', 'Cachar'),
(44, 'Assam', 'Darrang'),
(45, 'Assam', 'Dhemaji'),
(46, 'Assam', 'Dhubri'),
(47, 'Assam', 'Dibrugarh'),
(48, 'Assam', 'Goalpara'),
(49, 'Assam', 'Golaghat'),
(50, 'Assam', 'Hailakandi'),
(51, 'Assam', 'Jorhat'),
(52, 'Assam', 'Karbi Anglong'),
(53, 'Assam', 'Karimganj'),
(54, 'Assam', 'Kokrajhar'),
(55, 'Assam', 'Lakhimpur'),
(56, 'Assam', 'Marigaon'),
(57, 'Assam', 'Nagaon'),
(58, 'Assam', 'Nalbari'),
(59, 'Assam', 'North Cachar Hills'),
(60, 'Assam', 'Sibsagar'),
(61, 'Assam', 'Sonitpur'),
(62, 'Assam', 'Tinsukia'),
(63, 'Bihar', NULL),
(64, 'Bihar', 'Araria'),
(65, 'Bihar', 'Aurangabad'),
(66, 'Bihar', 'Banka'),
(67, 'Bihar', 'Begusarai'),
(68, 'Bihar', 'Bhagalpur'),
(69, 'Bihar', 'Bhojpur'),
(70, 'Bihar', 'Buxar'),
(71, 'Bihar', 'Darbhanga'),
(72, 'Bihar', 'Purba Champaran'),
(73, 'Bihar', 'Gaya'),
(74, 'Bihar', 'Gopalganj'),
(75, 'Bihar', 'Jamui'),
(76, 'Bihar', 'Jehanabad'),
(77, 'Bihar', 'Khagaria'),
(78, 'Bihar', 'Kishanganj'),
(79, 'Bihar', 'Kaimur'),
(80, 'Bihar', 'Katihar'),
(81, 'Bihar', 'Lakhisarai'),
(82, 'Bihar', 'Madhubani'),
(83, 'Bihar', 'Munger'),
(84, 'Bihar', 'Madhepura'),
(85, 'Bihar', 'Muzaffarpur'),
(86, 'Bihar', 'Nalanda'),
(87, 'Bihar', 'Nawada'),
(88, 'Bihar', 'Patna'),
(89, 'Bihar', 'Purnia'),
(90, 'Bihar', 'Rohtas'),
(91, 'Bihar', 'Saharsa'),
(92, 'Bihar', 'Samastipur'),
(93, 'Bihar', 'Sheohar'),
(94, 'Bihar', 'Sheikhpura'),
(95, 'Bihar', 'Saran'),
(96, 'Bihar', 'Sitamarhi'),
(97, 'Bihar', 'Supaul'),
(98, 'Bihar', 'Siwan'),
(99, 'Bihar', 'Vaishali'),
(100, 'Bihar', 'Pashchim Champaran'),
(101, 'Chandigarh', NULL),
(102, 'Chhattisgarh', NULL),
(103, 'Chhattisgarh', 'Bastar'),
(104, 'Chhattisgarh', 'Bilaspur'),
(105, 'Chhattisgarh', 'Dantewada'),
(106, 'Chhattisgarh', 'Dhamtari'),
(107, 'Chhattisgarh', 'Durg'),
(108, 'Chhattisgarh', 'Jashpur'),
(109, 'Chhattisgarh', 'Janjgir-Champa'),
(110, 'Chhattisgarh', 'Korba'),
(111, 'Chhattisgarh', 'Koriya'),
(112, 'Chhattisgarh', 'Kanker'),
(113, 'Chhattisgarh', 'Kawardha'),
(114, 'Chhattisgarh', 'Mahasamund'),
(115, 'Chhattisgarh', 'Raigarh'),
(116, 'Chhattisgarh', 'Rajnandgaon'),
(117, 'Chhattisgarh', 'Raipur'),
(118, 'Chhattisgarh', 'Surguja'),
(119, 'Dadra and Nagar Haveli', NULL),
(120, 'Daman and Diu', NULL),
(121, 'Daman and Diu', 'Diu'),
(122, 'Daman and Diu', 'Daman'),
(123, 'Delhi', NULL),
(124, 'Delhi', 'Central Delhi'),
(125, 'Delhi', 'East Delhi'),
(126, 'Delhi', 'New Delhi'),
(127, 'Delhi', 'North Delhi'),
(128, 'Delhi', 'North East Delhi'),
(129, 'Delhi', 'North West Delhi'),
(130, 'Delhi', 'South Delhi'),
(131, 'Delhi', 'South West Delhi'),
(132, 'Delhi', 'West Delhi'),
(133, 'Goa', NULL),
(134, 'Goa', 'North Goa'),
(135, 'Goa', 'South Goa'),
(136, 'Gujarat', NULL),
(137, 'Gujarat', 'Ahmedabad'),
(138, 'Gujarat', 'Amreli District'),
(139, 'Gujarat', 'Anand'),
(140, 'Gujarat', 'Banaskantha'),
(141, 'Gujarat', 'Bharuch'),
(142, 'Gujarat', 'Bhavnagar'),
(143, 'Gujarat', 'Dahod'),
(144, 'Gujarat', 'The Dangs'),
(145, 'Gujarat', 'Gandhinagar'),
(146, 'Gujarat', 'Jamnagar'),
(147, 'Gujarat', 'Junagadh'),
(148, 'Gujarat', 'Kutch'),
(149, 'Gujarat', 'Kheda'),
(150, 'Gujarat', 'Mehsana'),
(151, 'Gujarat', 'Narmada'),
(152, 'Gujarat', 'Navsari'),
(153, 'Gujarat', 'Patan'),
(154, 'Gujarat', 'Panchmahal'),
(155, 'Gujarat', 'Porbandar'),
(156, 'Gujarat', 'Rajkot'),
(157, 'Gujarat', 'Sabarkantha'),
(158, 'Gujarat', 'Surendranagar'),
(159, 'Gujarat', 'Surat'),
(160, 'Gujarat', 'Vadodara'),
(161, 'Gujarat', 'Valsad'),
(162, 'Haryana', NULL),
(163, 'Haryana', 'Ambala'),
(164, 'Haryana', 'Bhiwani'),
(165, 'Haryana', 'Faridabad'),
(166, 'Haryana', 'Fatehabad'),
(167, 'Haryana', 'Gurgaon'),
(168, 'Haryana', 'Hissar'),
(169, 'Haryana', 'Jhajjar'),
(170, 'Haryana', 'Jind'),
(171, 'Haryana', 'Karnal'),
(172, 'Haryana', 'Kaithal'),
(173, 'Haryana', 'Kurukshetra'),
(174, 'Haryana', 'Mahendragarh'),
(175, 'Haryana', 'Mewat'),
(176, 'Haryana', 'Panchkula'),
(177, 'Haryana', 'Panipat'),
(178, 'Haryana', 'Rewari'),
(179, 'Haryana', 'Rohtak'),
(180, 'Haryana', 'Sirsa'),
(181, 'Haryana', 'Sonepat'),
(182, 'Haryana', 'Yamuna Nagar'),
(183, 'Haryana', 'Palwal'),
(184, 'Himachal Pradesh', NULL),
(185, 'Himachal Pradesh', 'Bilaspur'),
(186, 'Himachal Pradesh', 'Chamba'),
(187, 'Himachal Pradesh', 'Hamirpur'),
(188, 'Himachal Pradesh', 'Kangra'),
(189, 'Himachal Pradesh', 'Kinnaur'),
(190, 'Himachal Pradesh', 'Kulu'),
(191, 'Himachal Pradesh', 'Lahaul and Spiti'),
(192, 'Himachal Pradesh', 'Mandi'),
(193, 'Himachal Pradesh', 'Shimla'),
(194, 'Himachal Pradesh', 'Sirmaur'),
(195, 'Himachal Pradesh', 'Solan'),
(196, 'Himachal Pradesh', 'Una'),
(197, 'Jammu and Kashmir', NULL),
(198, 'Jammu and Kashmir', 'Anantnag'),
(199, 'Jammu and Kashmir', 'Badgam'),
(200, 'Jammu and Kashmir', 'Bandipore'),
(201, 'Jammu and Kashmir', 'Baramula'),
(202, 'Jammu and Kashmir', 'Doda'),
(203, 'Jammu and Kashmir', 'Jammu'),
(204, 'Jammu and Kashmir', 'Kargil'),
(205, 'Jammu and Kashmir', 'Kathua'),
(206, 'Jammu and Kashmir', 'Kupwara'),
(207, 'Jammu and Kashmir', 'Leh'),
(208, 'Jammu and Kashmir', 'Poonch'),
(209, 'Jammu and Kashmir', 'Pulwama'),
(210, 'Jammu and Kashmir', 'Rajauri'),
(211, 'Jammu and Kashmir', 'Srinagar'),
(212, 'Jammu and Kashmir', 'Samba'),
(213, 'Jammu and Kashmir', 'Udhampur'),
(214, 'Jharkhand', NULL),
(215, 'Jharkhand', 'Bokaro'),
(216, 'Jharkhand', 'Chatra'),
(217, 'Jharkhand', 'Deoghar'),
(218, 'Jharkhand', 'Dhanbad'),
(219, 'Jharkhand', 'Dumka'),
(220, 'Jharkhand', 'Purba Singhbhum'),
(221, 'Jharkhand', 'Garhwa'),
(222, 'Jharkhand', 'Giridih'),
(223, 'Jharkhand', 'Godda'),
(224, 'Jharkhand', 'Gumla'),
(225, 'Jharkhand', 'Hazaribagh'),
(226, 'Jharkhand', 'Koderma'),
(227, 'Jharkhand', 'Lohardaga'),
(228, 'Jharkhand', 'Pakur'),
(229, 'Jharkhand', 'Palamu'),
(230, 'Jharkhand', 'Ranchi'),
(231, 'Jharkhand', 'Sahibganj'),
(232, 'Jharkhand', 'Seraikela and Kharsawan'),
(233, 'Jharkhand', 'Pashchim Singhbhum'),
(234, 'Jharkhand', 'Ramgarh'),
(235, 'Karnataka', NULL),
(236, 'Karnataka', 'Bidar'),
(237, 'Karnataka', 'Belgaum'),
(238, 'Karnataka', 'Bijapur'),
(239, 'Karnataka', 'Bagalkot'),
(240, 'Karnataka', 'Bellary'),
(241, 'Karnataka', 'Bangalore Rural District'),
(242, 'Karnataka', 'Bangalore Urban District'),
(243, 'Karnataka', 'Chamarajnagar'),
(244, 'Karnataka', 'Chikmagalur'),
(245, 'Karnataka', 'Chitradurga'),
(246, 'Karnataka', 'Davanagere'),
(247, 'Karnataka', 'Dharwad'),
(248, 'Karnataka', 'Dakshina Kannada'),
(249, 'Karnataka', 'Gadag'),
(250, 'Karnataka', 'Gulbarga'),
(251, 'Karnataka', 'Hassan'),
(252, 'Karnataka', 'Haveri District'),
(253, 'Karnataka', 'Kodagu'),
(254, 'Karnataka', 'Kolar'),
(255, 'Karnataka', 'Koppal'),
(256, 'Karnataka', 'Mandya'),
(257, 'Karnataka', 'Mysore'),
(258, 'Karnataka', 'Raichur'),
(259, 'Karnataka', 'Shimoga'),
(260, 'Karnataka', 'Tumkur'),
(261, 'Karnataka', 'Udupi'),
(262, 'Karnataka', 'Uttara Kannada'),
(263, 'Karnataka', 'Ramanagara'),
(264, 'Karnataka', 'Chikballapur'),
(265, 'Karnataka', 'Yadagiri'),
(266, 'Kerala', NULL),
(267, 'Kerala', 'Alappuzha'),
(268, 'Kerala', 'Ernakulam'),
(269, 'Kerala', 'Idukki'),
(270, 'Kerala', 'Kollam'),
(271, 'Kerala', 'Kannur'),
(272, 'Kerala', 'Kasaragod'),
(273, 'Kerala', 'Kottayam'),
(274, 'Kerala', 'Kozhikode'),
(275, 'Kerala', 'Malappuram'),
(276, 'Kerala', 'Palakkad'),
(277, 'Kerala', 'Pathanamthitta'),
(278, 'Kerala', 'Thrissur'),
(279, 'Kerala', 'Thiruvananthapuram'),
(280, 'Kerala', 'Wayanad'),
(281, 'Lakshadweep', NULL),
(282, 'Madhya Pradesh', NULL),
(283, 'Madhya Pradesh', 'Alirajpur'),
(284, 'Madhya Pradesh', 'Anuppur'),
(285, 'Madhya Pradesh', 'Ashok Nagar'),
(286, 'Madhya Pradesh', 'Balaghat'),
(287, 'Madhya Pradesh', 'Barwani'),
(288, 'Madhya Pradesh', 'Betul'),
(289, 'Madhya Pradesh', 'Bhind'),
(290, 'Madhya Pradesh', 'Bhopal'),
(291, 'Madhya Pradesh', 'Burhanpur'),
(292, 'Madhya Pradesh', 'Chhatarpur'),
(293, 'Madhya Pradesh', 'Chhindwara'),
(294, 'Madhya Pradesh', 'Damoh'),
(295, 'Madhya Pradesh', 'Datia'),
(296, 'Madhya Pradesh', 'Dewas'),
(297, 'Madhya Pradesh', 'Dhar'),
(298, 'Madhya Pradesh', 'Dindori'),
(299, 'Madhya Pradesh', 'Guna'),
(300, 'Madhya Pradesh', 'Gwalior'),
(301, 'Madhya Pradesh', 'Harda'),
(302, 'Madhya Pradesh', 'Hoshangabad'),
(303, 'Madhya Pradesh', 'Indore'),
(304, 'Madhya Pradesh', 'Jabalpur'),
(305, 'Madhya Pradesh', 'Jhabua'),
(306, 'Madhya Pradesh', 'Katni'),
(307, 'Madhya Pradesh', 'Khandwa'),
(308, 'Madhya Pradesh', 'Khargone'),
(309, 'Madhya Pradesh', 'Mandla'),
(310, 'Madhya Pradesh', 'Mandsaur'),
(311, 'Madhya Pradesh', 'Morena'),
(312, 'Madhya Pradesh', 'Narsinghpur'),
(313, 'Madhya Pradesh', 'Neemuch'),
(314, 'Madhya Pradesh', 'Panna'),
(315, 'Madhya Pradesh', 'Rewa'),
(316, 'Madhya Pradesh', 'Rajgarh'),
(317, 'Madhya Pradesh', 'Ratlam'),
(318, 'Madhya Pradesh', 'Raisen'),
(319, 'Madhya Pradesh', 'Sagar'),
(320, 'Madhya Pradesh', 'Satna'),
(321, 'Madhya Pradesh', 'Sehore'),
(322, 'Madhya Pradesh', 'Seoni'),
(323, 'Madhya Pradesh', 'Shahdol'),
(324, 'Madhya Pradesh', 'Shajapur'),
(325, 'Madhya Pradesh', 'Sheopur'),
(326, 'Madhya Pradesh', 'Shivpuri'),
(327, 'Madhya Pradesh', 'Sidhi'),
(328, 'Madhya Pradesh', 'Singrauli'),
(329, 'Madhya Pradesh', 'Tikamgarh'),
(330, 'Madhya Pradesh', 'Ujjain'),
(331, 'Madhya Pradesh', 'Umaria'),
(332, 'Madhya Pradesh', 'Vidisha'),
(333, 'Maharashtra', NULL),
(334, 'Maharashtra', 'Ahmednagar'),
(335, 'Maharashtra', 'Akola'),
(336, 'Maharashtra', 'Amrawati'),
(337, 'Maharashtra', 'Aurangabad'),
(338, 'Maharashtra', 'Bhandara'),
(339, 'Maharashtra', 'Beed'),
(340, 'Maharashtra', 'Buldhana'),
(341, 'Maharashtra', 'Chandrapur'),
(342, 'Maharashtra', 'Dhule'),
(343, 'Maharashtra', 'Gadchiroli'),
(344, 'Maharashtra', 'Gondiya'),
(345, 'Maharashtra', 'Hingoli'),
(346, 'Maharashtra', 'Jalgaon'),
(347, 'Maharashtra', 'Jalna'),
(348, 'Maharashtra', 'Kolhapur'),
(349, 'Maharashtra', 'Latur'),
(350, 'Maharashtra', 'Mumbai City'),
(351, 'Maharashtra', 'Mumbai suburban'),
(352, 'Maharashtra', 'Nandurbar'),
(353, 'Maharashtra', 'Nanded'),
(354, 'Maharashtra', 'Nagpur'),
(355, 'Maharashtra', 'Nashik'),
(356, 'Maharashtra', 'Osmanabad'),
(357, 'Maharashtra', 'Parbhani'),
(358, 'Maharashtra', 'Pune'),
(359, 'Maharashtra', 'Raigad'),
(360, 'Maharashtra', 'Ratnagiri'),
(361, 'Maharashtra', 'Sindhudurg'),
(362, 'Maharashtra', 'Sangli'),
(363, 'Maharashtra', 'Solapur'),
(364, 'Maharashtra', 'Satara'),
(365, 'Maharashtra', 'Thane'),
(366, 'Maharashtra', 'Wardha'),
(367, 'Maharashtra', 'Washim'),
(368, 'Maharashtra', 'Yavatmal'),
(369, 'Manipur', NULL),
(370, 'Manipur', 'Bishnupur'),
(371, 'Manipur', 'Churachandpur'),
(372, 'Manipur', 'Chandel'),
(373, 'Manipur', 'Imphal East'),
(374, 'Manipur', 'Senapati'),
(375, 'Manipur', 'Tamenglong'),
(376, 'Manipur', 'Thoubal'),
(377, 'Manipur', 'Ukhrul'),
(378, 'Manipur', 'Imphal West'),
(379, 'Meghalaya', NULL),
(380, 'Meghalaya', 'East Garo Hills'),
(381, 'Meghalaya', 'East Khasi Hills'),
(382, 'Meghalaya', 'Jaintia Hills'),
(383, 'Meghalaya', 'Ri-Bhoi'),
(384, 'Meghalaya', 'South Garo Hills'),
(385, 'Meghalaya', 'West Garo Hills'),
(386, 'Meghalaya', 'West Khasi Hills'),
(387, 'Mizoram', NULL),
(388, 'Mizoram', 'Aizawl'),
(389, 'Mizoram', 'Champhai'),
(390, 'Mizoram', 'Kolasib'),
(391, 'Mizoram', 'Lawngtlai'),
(392, 'Mizoram', 'Lunglei'),
(393, 'Mizoram', 'Mamit'),
(394, 'Mizoram', 'Saiha'),
(395, 'Mizoram', 'Serchhip'),
(396, 'Nagaland', NULL),
(397, 'Nagaland', 'Dimapur'),
(398, 'Nagaland', 'Kohima'),
(399, 'Nagaland', 'Mokokchung'),
(400, 'Nagaland', 'Mon'),
(401, 'Nagaland', 'Phek'),
(402, 'Nagaland', 'Tuensang'),
(403, 'Nagaland', 'Wokha'),
(404, 'Nagaland', 'Zunheboto'),
(405, 'Orissa', NULL),
(406, 'Orissa', 'Angul'),
(407, 'Orissa', 'Boudh'),
(408, 'Orissa', 'Bhadrak'),
(409, 'Orissa', 'Bolangir'),
(410, 'Orissa', 'Bargarh'),
(411, 'Orissa', 'Baleswar'),
(412, 'Orissa', 'Cuttack'),
(413, 'Orissa', 'Debagarh'),
(414, 'Orissa', 'Dhenkanal'),
(415, 'Orissa', 'Ganjam'),
(416, 'Orissa', 'Gajapati'),
(417, 'Orissa', 'Jharsuguda'),
(418, 'Orissa', 'Jajapur'),
(419, 'Orissa', 'Jagatsinghpur'),
(420, 'Orissa', 'Khordha'),
(421, 'Orissa', 'Kendujhar'),
(422, 'Orissa', 'Kalahandi'),
(423, 'Orissa', 'Kandhamal'),
(424, 'Orissa', 'Koraput'),
(425, 'Orissa', 'Kendrapara'),
(426, 'Orissa', 'Malkangiri'),
(427, 'Orissa', 'Mayurbhanj'),
(428, 'Orissa', 'Nabarangpur'),
(429, 'Orissa', 'Nuapada'),
(430, 'Orissa', 'Nayagarh'),
(431, 'Orissa', 'Puri'),
(432, 'Orissa', 'Rayagada'),
(433, 'Orissa', 'Sambalpur'),
(434, 'Orissa', 'Subarnapur'),
(435, 'Orissa', 'Sundargarh'),
(436, 'Puducherry', NULL),
(437, 'Puducherry', 'Karaikal'),
(438, 'Puducherry', 'Mahe'),
(439, 'Puducherry', 'Puducherry'),
(440, 'Puducherry', 'Yanam'),
(441, 'Punjab', NULL),
(442, 'Punjab', 'Amritsar'),
(443, 'Punjab', 'Bathinda'),
(444, 'Punjab', 'Firozpur'),
(445, 'Punjab', 'Faridkot'),
(446, 'Punjab', 'Fatehgarh Sahib'),
(447, 'Punjab', 'Gurdaspur'),
(448, 'Punjab', 'Hoshiarpur'),
(449, 'Punjab', 'Jalandhar'),
(450, 'Punjab', 'Kapurthala'),
(451, 'Punjab', 'Ludhiana'),
(452, 'Punjab', 'Mansa'),
(453, 'Punjab', 'Moga'),
(454, 'Punjab', 'Mukatsar'),
(455, 'Punjab', 'Nawan Shehar'),
(456, 'Punjab', 'Patiala'),
(457, 'Punjab', 'Rupnagar'),
(458, 'Punjab', 'Sangrur'),
(459, 'Rajasthan', NULL),
(460, 'Rajasthan', 'Ajmer'),
(461, 'Rajasthan', 'Alwar'),
(462, 'Rajasthan', 'Bikaner'),
(463, 'Rajasthan', 'Barmer'),
(464, 'Rajasthan', 'Banswara'),
(465, 'Rajasthan', 'Bharatpur'),
(466, 'Rajasthan', 'Baran'),
(467, 'Rajasthan', 'Bundi'),
(468, 'Rajasthan', 'Bhilwara'),
(469, 'Rajasthan', 'Churu'),
(470, 'Rajasthan', 'Chittorgarh'),
(471, 'Rajasthan', 'Dausa'),
(472, 'Rajasthan', 'Dholpur'),
(473, 'Rajasthan', 'Dungapur'),
(474, 'Rajasthan', 'Ganganagar'),
(475, 'Rajasthan', 'Hanumangarh'),
(476, 'Rajasthan', 'Juhnjhunun'),
(477, 'Rajasthan', 'Jalore'),
(478, 'Rajasthan', 'Jodhpur'),
(479, 'Rajasthan', 'Jaipur'),
(480, 'Rajasthan', 'Jaisalmer'),
(481, 'Rajasthan', 'Jhalawar'),
(482, 'Rajasthan', 'Karauli'),
(483, 'Rajasthan', 'Kota'),
(484, 'Rajasthan', 'Nagaur'),
(485, 'Rajasthan', 'Pali'),
(486, 'Rajasthan', 'Pratapgarh'),
(487, 'Rajasthan', 'Rajsamand'),
(488, 'Rajasthan', 'Sikar'),
(489, 'Rajasthan', 'Sawai Madhopur'),
(490, 'Rajasthan', 'Sirohi'),
(491, 'Rajasthan', 'Tonk'),
(492, 'Rajasthan', 'Udaipur'),
(493, 'Sikkim', NULL),
(494, 'Sikkim', 'East Sikkim'),
(495, 'Sikkim', 'North Sikkim'),
(496, 'Sikkim', 'South Sikkim'),
(497, 'Sikkim', 'West Sikkim'),
(498, 'Tamil Nadu', NULL),
(499, 'Tamil Nadu', 'Ariyalur'),
(500, 'Tamil Nadu', 'Chennai'),
(501, 'Tamil Nadu', 'Coimbatore'),
(502, 'Tamil Nadu', 'Cuddalore'),
(503, 'Tamil Nadu', 'Dharmapuri'),
(504, 'Tamil Nadu', 'Dindigul'),
(505, 'Tamil Nadu', 'Erode'),
(506, 'Tamil Nadu', 'Kanchipuram'),
(507, 'Tamil Nadu', 'Kanyakumari'),
(508, 'Tamil Nadu', 'Karur'),
(509, 'Tamil Nadu', 'Madurai'),
(510, 'Tamil Nadu', 'Nagapattinam'),
(511, 'Tamil Nadu', 'The Nilgiris'),
(512, 'Tamil Nadu', 'Namakkal'),
(513, 'Tamil Nadu', 'Perambalur'),
(514, 'Tamil Nadu', 'Pudukkottai'),
(515, 'Tamil Nadu', 'Ramanathapuram'),
(516, 'Tamil Nadu', 'Salem'),
(517, 'Tamil Nadu', 'Sivagangai'),
(518, 'Tamil Nadu', 'Tiruppur'),
(519, 'Tamil Nadu', 'Tiruchirappalli'),
(520, 'Tamil Nadu', 'Theni'),
(521, 'Tamil Nadu', 'Tirunelveli'),
(522, 'Tamil Nadu', 'Thanjavur'),
(523, 'Tamil Nadu', 'Thoothukudi'),
(524, 'Tamil Nadu', 'Thiruvallur'),
(525, 'Tamil Nadu', 'Thiruvarur'),
(526, 'Tamil Nadu', 'Tiruvannamalai'),
(527, 'Tamil Nadu', 'Vellore'),
(528, 'Tamil Nadu', 'Villupuram'),
(529, 'Tripura', NULL),
(530, 'Tripura', 'Dhalai'),
(531, 'Tripura', 'North Tripura'),
(532, 'Tripura', 'South Tripura'),
(533, 'Tripura', 'West Tripura'),
(534, 'Uttarakhand', NULL),
(535, 'Uttarakhand', 'Almora'),
(536, 'Uttarakhand', 'Bageshwar'),
(537, 'Uttarakhand', 'Chamoli'),
(538, 'Uttarakhand', 'Champawat'),
(539, 'Uttarakhand', 'Dehradun'),
(540, 'Uttarakhand', 'Haridwar'),
(541, 'Uttarakhand', 'Nainital'),
(542, 'Uttarakhand', 'Pauri Garhwal'),
(543, 'Uttarakhand', 'Pithoragharh'),
(544, 'Uttarakhand', 'Rudraprayag'),
(545, 'Uttarakhand', 'Tehri Garhwal'),
(546, 'Uttarakhand', 'Udham Singh Nagar'),
(547, 'Uttarakhand', 'Uttarkashi'),
(548, 'Uttar Pradesh', NULL),
(549, 'Uttar Pradesh', 'Agra'),
(550, 'Uttar Pradesh', 'Allahabad'),
(551, 'Uttar Pradesh', 'Aligarh'),
(552, 'Uttar Pradesh', 'Ambedkar Nagar'),
(553, 'Uttar Pradesh', 'Auraiya'),
(554, 'Uttar Pradesh', 'Azamgarh'),
(555, 'Uttar Pradesh', 'Barabanki'),
(556, 'Uttar Pradesh', 'Badaun'),
(557, 'Uttar Pradesh', 'Bagpat'),
(558, 'Uttar Pradesh', 'Bahraich'),
(559, 'Uttar Pradesh', 'Bijnor'),
(560, 'Uttar Pradesh', 'Ballia'),
(561, 'Uttar Pradesh', 'Banda'),
(562, 'Uttar Pradesh', 'Balrampur'),
(563, 'Uttar Pradesh', 'Bareilly'),
(564, 'Uttar Pradesh', 'Basti'),
(565, 'Uttar Pradesh', 'Bulandshahr'),
(566, 'Uttar Pradesh', 'Chandauli'),
(567, 'Uttar Pradesh', 'Chitrakoot'),
(568, 'Uttar Pradesh', 'Deoria'),
(569, 'Uttar Pradesh', 'Etah'),
(570, 'Uttar Pradesh', 'Kanshiram Nagar'),
(571, 'Uttar Pradesh', 'Etawah'),
(572, 'Uttar Pradesh', 'Firozabad'),
(573, 'Uttar Pradesh', 'Farrukhabad'),
(574, 'Uttar Pradesh', 'Fatehpur'),
(575, 'Uttar Pradesh', 'Faizabad'),
(576, 'Uttar Pradesh', 'Gautam Buddha Nagar'),
(577, 'Uttar Pradesh', 'Gonda'),
(578, 'Uttar Pradesh', 'Ghazipur'),
(579, 'Uttar Pradesh', 'Gorkakhpur'),
(580, 'Uttar Pradesh', 'Ghaziabad'),
(581, 'Uttar Pradesh', 'Hamirpur'),
(582, 'Uttar Pradesh', 'Hardoi'),
(583, 'Uttar Pradesh', 'Mahamaya Nagar'),
(584, 'Uttar Pradesh', 'Jhansi'),
(585, 'Uttar Pradesh', 'Jalaun'),
(586, 'Uttar Pradesh', 'Jyotiba Phule Nagar'),
(587, 'Uttar Pradesh', 'Jaunpur District'),
(588, 'Uttar Pradesh', 'Kanpur Dehat'),
(589, 'Uttar Pradesh', 'Kannauj'),
(590, 'Uttar Pradesh', 'Kanpur Nagar'),
(591, 'Uttar Pradesh', 'Kaushambi'),
(592, 'Uttar Pradesh', 'Kushinagar'),
(593, 'Uttar Pradesh', 'Lalitpur'),
(594, 'Uttar Pradesh', 'Lakhimpur Kheri'),
(595, 'Uttar Pradesh', 'Lucknow'),
(596, 'Uttar Pradesh', 'Mau'),
(597, 'Uttar Pradesh', 'Meerut'),
(598, 'Uttar Pradesh', 'Maharajganj'),
(599, 'Uttar Pradesh', 'Mahoba'),
(600, 'Uttar Pradesh', 'Mirzapur'),
(601, 'Uttar Pradesh', 'Moradabad'),
(602, 'Uttar Pradesh', 'Mainpuri'),
(603, 'Uttar Pradesh', 'Mathura'),
(604, 'Uttar Pradesh', 'Muzaffarnagar'),
(605, 'Uttar Pradesh', 'Pilibhit'),
(606, 'Uttar Pradesh', 'Pratapgarh'),
(607, 'Uttar Pradesh', 'Rampur'),
(608, 'Uttar Pradesh', 'Rae Bareli'),
(609, 'Uttar Pradesh', 'Saharanpur'),
(610, 'Uttar Pradesh', 'Sitapur'),
(611, 'Uttar Pradesh', 'Shahjahanpur'),
(612, 'Uttar Pradesh', 'Sant Kabir Nagar'),
(613, 'Uttar Pradesh', 'Siddharthnagar'),
(614, 'Uttar Pradesh', 'Sonbhadra'),
(615, 'Uttar Pradesh', 'Sant Ravidas Nagar'),
(616, 'Uttar Pradesh', 'Sultanpur'),
(617, 'Uttar Pradesh', 'Shravasti'),
(618, 'Uttar Pradesh', 'Unnao'),
(619, 'Uttar Pradesh', 'Varanasi'),
(620, 'West Bengal', NULL),
(621, 'West Bengal', 'Birbhum'),
(622, 'West Bengal', 'Bankura'),
(623, 'West Bengal', 'Bardhaman'),
(624, 'West Bengal', 'Darjeeling'),
(625, 'West Bengal', 'Dakshin Dinajpur'),
(626, 'West Bengal', 'Hooghly'),
(627, 'West Bengal', 'Howrah'),
(628, 'West Bengal', 'Jalpaiguri'),
(629, 'West Bengal', 'Cooch Behar'),
(630, 'West Bengal', 'Kolkata'),
(631, 'West Bengal', 'Malda'),
(632, 'West Bengal', 'Midnapore'),
(633, 'West Bengal', 'Murshidabad'),
(634, 'West Bengal', 'Nadia'),
(635, 'West Bengal', 'North 24 Parganas'),
(636, 'West Bengal', 'South 24 Parganas'),
(637, 'West Bengal', 'Purulia'),
(638, 'West Bengal', 'Uttar Dinajpur');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `description2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `description`, `description2`, `user_id`, `is_active`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(2, 1, 'dsada', NULL, 2, 1, NULL, NULL, NULL, NULL),
(3, 1, 'dasda', NULL, 2, 1, NULL, NULL, NULL, NULL),
(4, 1, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(5, 2, 'as', NULL, 2, 1, NULL, NULL, NULL, NULL),
(6, 2, 'dasc', NULL, 2, 1, NULL, NULL, NULL, NULL),
(7, 2, 'vds', NULL, 2, 1, NULL, NULL, NULL, NULL),
(8, 2, 'dvsvsv', NULL, 2, 1, NULL, NULL, NULL, NULL),
(9, 2, 'cad', NULL, 2, 1, NULL, NULL, NULL, NULL),
(10, 2, 'csa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(11, 1, 'csa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(12, 3, 'sca', NULL, 2, 1, NULL, NULL, NULL, NULL),
(13, 3, 'asc', NULL, 2, 1, NULL, NULL, NULL, NULL),
(14, 3, 'sca', NULL, 2, 1, NULL, NULL, NULL, NULL),
(15, 3, 'csa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(16, 3, 'csacsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(17, 6, 'd', NULL, 2, 1, NULL, NULL, NULL, NULL),
(18, 10, 'x', NULL, 2, 1, NULL, NULL, NULL, NULL),
(19, 10, 'ghhg', NULL, 2, 1, NULL, NULL, NULL, NULL),
(20, 16, 'asa', NULL, 3, 1, NULL, NULL, NULL, NULL),
(21, 16, 'dsada', NULL, 3, 1, NULL, NULL, NULL, NULL),
(22, 16, 'dsada😄', NULL, 3, 1, NULL, NULL, NULL, NULL),
(23, 15, 'faes😍', NULL, 3, 1, NULL, NULL, NULL, NULL),
(24, 14, 'fsafda', NULL, 3, 1, NULL, NULL, NULL, NULL),
(25, 15, 'fsadfddas', NULL, 3, 1, NULL, NULL, NULL, NULL),
(26, 15, 'dsa', NULL, 3, 1, NULL, NULL, NULL, NULL),
(27, 15, 'sacf', NULL, 3, 1, NULL, NULL, NULL, NULL),
(28, 15, 'cfsa', NULL, 3, 1, NULL, NULL, NULL, NULL),
(29, 16, 'sacf', NULL, 3, 1, NULL, NULL, NULL, NULL),
(30, 16, 'SDA', NULL, 3, 1, NULL, NULL, NULL, NULL),
(31, 16, 'csaf', NULL, 3, 1, NULL, NULL, NULL, NULL),
(32, 15, 'fadsfa', NULL, 3, 1, NULL, NULL, NULL, NULL),
(33, 14, 'fasdfa', NULL, 3, 1, NULL, NULL, NULL, NULL),
(34, 14, 'fadsfa', NULL, 3, 1, NULL, NULL, NULL, NULL),
(35, 13, 'fsdadfas😃', NULL, 3, 1, NULL, NULL, NULL, NULL),
(36, 15, 'sadffda😍', NULL, 3, 1, NULL, NULL, NULL, NULL),
(37, 16, 'fdeaed😃', NULL, 3, 1, NULL, NULL, NULL, NULL),
(38, 16, 'fads', NULL, 3, 1, NULL, NULL, NULL, NULL),
(39, 16, 'cfdasf', NULL, 3, 1, NULL, NULL, NULL, NULL),
(40, 16, 'sdafda', NULL, 3, 1, NULL, NULL, NULL, NULL),
(41, 16, 'sdafda', NULL, 3, 1, NULL, NULL, NULL, NULL),
(42, 16, 'sdafda', NULL, 3, 1, NULL, NULL, NULL, NULL),
(43, 16, 'dcasf', NULL, 3, 1, NULL, NULL, NULL, NULL),
(44, 15, 'sda', NULL, 3, 1, NULL, NULL, NULL, NULL),
(45, 15, 'dsa😆', NULL, 3, 1, NULL, NULL, NULL, NULL),
(46, 16, '😬', NULL, 3, 1, NULL, NULL, NULL, NULL),
(47, 12, '😍', NULL, 2, 1, NULL, NULL, NULL, NULL),
(48, 11, 'bjh', NULL, 2, 1, NULL, NULL, NULL, NULL),
(49, 12, 'kjlj', NULL, 2, 1, NULL, NULL, NULL, NULL),
(50, 12, 'bhj', NULL, 2, 1, NULL, NULL, NULL, NULL),
(51, 12, 'bhj', NULL, 2, 1, NULL, NULL, NULL, NULL),
(52, 12, 'bhj', NULL, 2, 1, NULL, NULL, NULL, NULL),
(53, 12, 'iuoh', NULL, 2, 1, NULL, NULL, NULL, NULL),
(54, 12, 'iuoh', NULL, 2, 1, NULL, NULL, NULL, NULL),
(55, 11, '😂', NULL, 2, 1, NULL, NULL, NULL, NULL),
(56, 11, '😂', NULL, 2, 1, NULL, NULL, NULL, NULL),
(57, 12, '😄', NULL, 2, 1, NULL, NULL, NULL, NULL),
(58, 9, '😍😃', NULL, 2, 1, NULL, NULL, NULL, NULL),
(59, 9, 'uiyiuy', NULL, 2, 1, NULL, NULL, NULL, NULL),
(60, 9, 'jiuiouj', NULL, 2, 1, NULL, NULL, NULL, NULL),
(61, 9, 'jiuiouj', NULL, 2, 1, NULL, NULL, NULL, NULL),
(62, 12, NULL, NULL, 2, 1, NULL, NULL, NULL, NULL),
(63, 12, 'cdsafs', NULL, 2, 1, NULL, NULL, NULL, NULL),
(64, 12, 'cdsafs', NULL, 2, 1, NULL, NULL, NULL, NULL),
(65, 12, 'mj', NULL, 2, 1, NULL, NULL, NULL, NULL),
(66, 11, 'cdxz😄', NULL, 2, 1, NULL, NULL, NULL, NULL),
(67, 19, 'dsfdsfsdfsdf😃sdfsdfsdf', NULL, 2, 1, NULL, NULL, NULL, NULL),
(68, 19, 'dsfsdfsdfsdf😍sdfdsf', NULL, 2, 1, NULL, NULL, NULL, NULL),
(69, 12, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(70, 28, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(71, 29, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(72, 29, 'dsada', NULL, 2, 1, NULL, NULL, NULL, NULL),
(73, 29, 'GFRGSDG', NULL, 2, 1, NULL, NULL, NULL, NULL),
(74, 28, 'fdfdsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(75, 29, 'sadf', NULL, 2, 1, NULL, NULL, NULL, NULL),
(76, 33, 'sdfdsfsdfsdf', NULL, 2, 1, NULL, NULL, NULL, NULL),
(77, 35, 'dwa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(78, 35, 'dsadad', NULL, 2, 1, NULL, NULL, NULL, NULL),
(79, 35, 'csa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(80, 35, 'dsada', NULL, 2, 1, NULL, NULL, NULL, NULL),
(81, 33, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(82, 34, 'dsada', NULL, 2, 1, NULL, NULL, NULL, NULL),
(83, 36, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(84, 37, 'fase', NULL, 2, 1, NULL, NULL, NULL, NULL),
(85, 38, 'fase', NULL, 2, 1, NULL, NULL, NULL, NULL),
(86, 38, 'dgvsf', NULL, 2, 1, NULL, NULL, NULL, NULL),
(87, 37, 'dsg', NULL, 2, 1, NULL, NULL, NULL, NULL),
(88, 36, 'dgvz', NULL, 2, 1, NULL, NULL, NULL, NULL),
(89, 37, 'dsg', NULL, 2, 1, NULL, NULL, NULL, NULL),
(90, 37, 'dsg', NULL, 2, 1, NULL, NULL, NULL, NULL),
(91, 36, 'dgvz', NULL, 2, 1, NULL, NULL, NULL, NULL),
(92, 36, 'dsfgbs', NULL, 2, 1, NULL, NULL, NULL, NULL),
(93, 36, 'fbxdb', NULL, 2, 1, NULL, NULL, NULL, NULL),
(94, 30, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(95, 40, 'sda', NULL, 2, 1, NULL, NULL, NULL, NULL),
(96, 40, 'sdac', NULL, 2, 1, NULL, NULL, NULL, NULL),
(97, 40, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(98, 42, 'cas', NULL, 2, 1, NULL, NULL, NULL, NULL),
(99, 43, 'csa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(100, 43, 'dsa', NULL, 2, 1, NULL, NULL, NULL, NULL),
(101, 44, 'fds', NULL, 2, 1, NULL, NULL, NULL, NULL),
(102, 41, 'dasx', NULL, 2, 1, NULL, NULL, NULL, NULL),
(103, 45, 'sd', NULL, 2, 1, NULL, NULL, NULL, NULL),
(104, 40, 'vcds', NULL, 3, 1, NULL, NULL, NULL, NULL),
(105, 50, 'jhgff:grin:', NULL, 2, 1, NULL, NULL, NULL, NULL),
(106, 50, 'hgdf:blush:', NULL, 2, 1, NULL, NULL, NULL, NULL),
(107, 48, 'nbc:meat_on_bone:', NULL, 2, 1, NULL, NULL, NULL, NULL),
(108, 59, 'dsadfa', NULL, 4, 1, NULL, NULL, NULL, NULL),
(109, 58, 'dsadfa', NULL, 4, 1, NULL, NULL, NULL, NULL),
(110, 59, 'saxsdcasa:grinning::grin::smiley::smile:', NULL, 4, 1, NULL, NULL, NULL, NULL),
(111, 59, 'test😟😔😕☹', NULL, 4, 1, NULL, NULL, NULL, NULL),
(112, 59, 'asd☹😕😔😟😄😃😂😆🤓🤑', NULL, 4, 1, NULL, NULL, NULL, NULL),
(113, 59, '😟', NULL, 4, 1, NULL, NULL, NULL, NULL),
(114, 59, '😟', NULL, 4, 1, NULL, NULL, NULL, NULL),
(115, 59, 'dsada😟😟🤓', NULL, 4, 1, NULL, NULL, NULL, NULL),
(116, 60, 'dsadf😉🙃😋', NULL, 4, 1, NULL, NULL, NULL, NULL),
(117, 60, 'sad😅', NULL, 4, 1, NULL, NULL, NULL, NULL),
(118, 60, 'sadgggh%F0%9F%98%80%F0%9F%98%80%F0%9F%98%80%F0%9F%98%AC😁😁😄😃', NULL, 4, 1, NULL, NULL, NULL, NULL),
(119, 60, 'saddsa😁', NULL, 4, 1, NULL, NULL, NULL, NULL),
(120, 60, 'dsad😁😁😄😃', NULL, 4, 1, NULL, NULL, NULL, NULL),
(121, 60, '%F0%9F%A4%91%F0%9F%98%8C%F0%9F%98%8D', NULL, 4, 1, NULL, NULL, NULL, NULL),
(122, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(123, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(124, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(125, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(126, 60, '????????????????????', NULL, 4, 1, NULL, NULL, NULL, NULL),
(127, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(128, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(129, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(130, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(131, 60, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL),
(132, 60, '????????????????????', NULL, 4, 1, NULL, NULL, NULL, NULL),
(133, 60, '😙😶😐😝😝', NULL, 4, 1, NULL, NULL, NULL, NULL),
(134, 60, 'dsada😙😶😐😝😝', NULL, 4, 1, NULL, NULL, NULL, NULL),
(135, 60, 'vzcvcx🙂🙂', NULL, 2, 1, NULL, NULL, NULL, NULL),
(136, 62, '🤒😪😩😩test', NULL, 2, 1, NULL, NULL, NULL, NULL),
(137, 60, 'csacas😜😙😚😚', NULL, 4, 1, NULL, NULL, NULL, NULL),
(138, 67, 'fda:grimacing::grimacing::smiley::smiley::smiley::smiley:', NULL, 4, 1, NULL, NULL, NULL, NULL),
(139, 82, 'dfas', 'dfas', 4, 1, NULL, NULL, NULL, NULL),
(140, 82, 'AS', 'AS', 4, 1, NULL, NULL, NULL, NULL),
(141, 82, 'dsa', 'dsa', 4, 1, NULL, NULL, NULL, NULL),
(142, 105, 'fdsa', 'fdsa', 4, 1, NULL, NULL, NULL, NULL),
(143, 105, 'sa', 'sa', 4, 1, NULL, NULL, NULL, NULL),
(144, 105, 'dsad', 'dsad', 4, 1, NULL, NULL, NULL, NULL),
(145, 105, 'dsa', 'dsa', 4, 1, NULL, NULL, NULL, NULL),
(146, 105, 'dsafdas', 'dsafdas', 4, 1, NULL, NULL, NULL, NULL),
(147, 105, 'fdsagfas', 'fdsagfas', 4, 1, NULL, NULL, NULL, NULL),
(148, 106, 'fdsafas', 'fdsafas', 4, 1, NULL, NULL, NULL, NULL),
(149, 106, 'dfsa', 'dfsa', 4, 1, NULL, NULL, NULL, NULL),
(150, 105, 'cdasvcds', 'cdasvcds', 4, 1, NULL, NULL, NULL, NULL),
(151, 106, 'dfasf', 'dfasf', 4, 1, NULL, NULL, NULL, NULL),
(152, 107, 'fdsa', 'fdsa', 4, 1, NULL, NULL, NULL, NULL),
(153, 107, 'dsa', 'dsa', 4, 1, NULL, NULL, NULL, NULL),
(154, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(155, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(156, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(157, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(158, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(159, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(160, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(161, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(162, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(163, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(164, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(165, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(166, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(167, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(168, 115, 'test', 'test', 1, 1, NULL, NULL, NULL, NULL),
(169, 114, 'hi', 'hi', 2, 1, NULL, NULL, NULL, NULL),
(170, 114, 'cvxvc', 'cvxvc', 2, 1, NULL, NULL, NULL, NULL),
(173, NULL, '', NULL, 4, 1, NULL, NULL, NULL, NULL),
(175, 126, 'dsfsffs:smiley::innocent::sweat_smile::sweat_smile::sweat_smile:dsfsfs', 'dsfsffs😃😇😅😅😅dsfsfs', 4, 1, NULL, NULL, NULL, NULL),
(176, 126, 'fdsa', 'fdsa', 4, 1, NULL, NULL, NULL, NULL),
(179, 126, 'dsfa', 'dsfa', 4, 1, NULL, NULL, NULL, NULL),
(180, 125, 'dsfa', 'dsfa', 4, 1, NULL, NULL, NULL, NULL),
(182, 126, 'dsafds', 'dsafds', 4, 1, NULL, NULL, NULL, NULL),
(183, 126, 'dsa:stuck_out_tongue_winking_eye::stuck_out_tongue_winking_eye::stuck_out_tongue_winking_eye::relaxed::relaxed::relaxed::relaxed::relaxed:', 'dsa😜😜😜☺☺☺☺☺', 4, 1, NULL, NULL, NULL, NULL),
(184, 127, 'mnvjhgjhv', 'mnvjhgjhv', 4, 1, NULL, NULL, NULL, NULL),
(186, 127, 'sdad', 'sdad', 4, 1, NULL, NULL, NULL, NULL),
(187, 127, 'fddsfsdfdsfdsfdf', 'fddsfsdfdsfdsfdf', 4, 1, NULL, NULL, NULL, NULL),
(188, 127, 'asdasdasd:heart_eyes:asdad:money_mouth:..', 'asdasdasd😍asdad🤑..', 4, 1, NULL, NULL, NULL, NULL),
(189, 127, 'tytrytyry:stuck_out_tongue_closed_eyes:hjghjhgjhgj', 'tytrytyry😝hjghjhgjhgj', 4, 1, NULL, NULL, NULL, NULL),
(190, 127, 'sdfdsfsdf', 'sdfdsfsdf', 4, 1, NULL, NULL, NULL, NULL),
(191, 125, 'sdfdshfhjdsjhfdhsf', 'sdfdshfhjdsjhfdhsf', 4, 1, NULL, NULL, NULL, NULL),
(192, 124, 'gfhddgdfgdfg', 'gfhddgdfgdfg', 4, 1, NULL, NULL, NULL, NULL),
(193, 124, 'dfdsfs', 'dfdsfs', 4, 1, NULL, NULL, NULL, NULL),
(195, 127, 'dsadsa', 'dsadsa', 2, 1, NULL, NULL, NULL, NULL),
(196, 127, 'sdf', 'sdf', 2, 1, NULL, NULL, NULL, NULL),
(197, 116, 'fbxcbfx:stuck_out_tongue:', 'fbxcbfx😛', 4, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coms`
--

CREATE TABLE `coms` (
  `id` int(10) UNSIGNED NOT NULL,
  `ChildID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ParentID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Com` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SourceID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coms`
--

INSERT INTO `coms` (`id`, `ChildID`, `ParentID`, `Com`, `SourceID`, `CreatedOn`) VALUES
(1, NULL, '1', '0.5', '2', '2018-06-02 13:37:09'),
(2, NULL, '2', '0.5', '3', '2018-06-02 13:37:27'),
(3, NULL, '1', '0.25', '3', '2018-06-02 13:37:27'),
(4, NULL, '3', '0.5', '4', '2018-06-02 13:38:05'),
(5, NULL, '2', '0.25', '4', '2018-06-02 13:38:05'),
(6, NULL, '1', '0.125', '4', '2018-06-02 13:38:05'),
(7, NULL, '4', '0.5', '5', '2018-06-02 13:51:08'),
(8, NULL, '3', '0.25', '5', '2018-06-02 13:51:08'),
(9, NULL, '2', '0.125', '5', '2018-06-02 13:51:09'),
(10, NULL, '1', '0.0625', '5', '2018-06-02 13:51:09'),
(11, NULL, '5', '0.5', '6', '2018-06-02 13:57:02'),
(12, NULL, '4', '0.25', '6', '2018-06-02 13:57:02'),
(13, NULL, '3', '0.125', '6', '2018-06-02 13:57:02'),
(14, NULL, '2', '0.0625', '6', '2018-06-02 13:57:02'),
(15, NULL, '1', '0.03125', '6', '2018-06-02 13:57:02'),
(16, NULL, '5', '0.5', '7', '2018-10-13 06:18:23'),
(17, NULL, '4', '0.1', 'Ads', '2018-11-09 13:58:12'),
(18, NULL, '4', '0.2', 'Ads', '2018-11-09 13:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `status` enum('pending','friends') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `status`) VALUES
(13, 1, 2, 'friends'),
(15, 39, 4, 'friends'),
(16, 39, 26, 'friends'),
(19, 3, 2, 'friends'),
(20, 4, 3, 'friends');

-- --------------------------------------------------------

--
-- Table structure for table `item_master`
--

CREATE TABLE `item_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext,
  `usage` longtext,
  `specifcation` longtext,
  `image` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `delivery` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `created_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_master`
--

INSERT INTO `item_master` (`id`, `name`, `description`, `usage`, `specifcation`, `image`, `price`, `delivery`, `is_active`, `meta_tag`, `meta_keyword`, `meta_description`, `created_time`) VALUES
(1, 'Test Product', 'Chana New dfk iofd as das asf fsa', 'dsha hadsfi h', 'yufd s fiyuhf ia fa', 'images/about_image.jpg', 500, '2 days On Order', 1, 'Chana', 'Chana', 'Chana', '2018-06-21 12:05:45'),
(2, 'Test Product', NULL, NULL, NULL, 'images/5v1nCO_level.png', 100, NULL, 1, NULL, NULL, NULL, '2018-07-09 15:25:32'),
(3, 'sca', NULL, NULL, NULL, 'images/0D44M2_level.png', 100, NULL, 1, NULL, NULL, NULL, '2018-07-11 13:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_02_15_082811_create_coms_table', 1),
(2, '2016_12_03_000000_create_payu_payments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notification` text,
  `image` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notification`, `image`, `created_by`, `is_active`) VALUES
(1, 'tempor incididunt ut labore et dolore magna aliqua.', 'notification/rJix1s_13 jan.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED DEFAULT NULL,
  `timeline_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `notified_by` int(10) UNSIGNED NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `post_id`, `timeline_id`, `user_id`, `notified_by`, `seen`, `description`, `type`, `link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 2, 4, 0, 'Bijendra is following you', 'follow', NULL, '2017-11-28 10:46:30', '2017-11-28 10:46:30', NULL),
(3, 3, 2, 2, 2, 0, 'Bijendra is following you', 'follow', NULL, '2017-11-28 10:46:37', '2017-11-28 10:46:37', NULL),
(4, 4, 2, 2, 4, 0, 'ashish is following you', 'follow', NULL, '2017-11-28 10:47:23', '2017-11-28 12:15:40', NULL),
(5, NULL, 10, 4, 5, 0, 'Himani is following you', 'follow', NULL, '2017-11-28 11:05:19', '2017-11-28 12:15:40', NULL),
(6, NULL, 10, 4, 3, 1, 'Manish is following you', 'follow', NULL, '2017-11-28 12:10:30', '2017-11-28 12:15:40', NULL),
(7, NULL, 10, 4, 1, 1, 'Admin is following you', 'follow', NULL, '2017-11-28 12:11:56', '2017-11-28 12:15:40', NULL),
(8, 1, 2, 2, 4, 1, 'Bijendra liked your post', 'follow', NULL, '2017-11-28 10:46:30', '2017-11-28 10:46:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_clicked`
--

CREATE TABLE `notification_clicked` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `click_count` int(11) DEFAULT NULL,
  `clicked_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_clicked`
--

INSERT INTO `notification_clicked` (`id`, `user_id`, `click_count`, `clicked_date`) VALUES
(1, 4, 50, '2018-11-10'),
(2, 2, 14, '2018-11-09'),
(3, 3, 1, '2018-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `order_description`
--

CREATE TABLE `order_description` (
  `id` int(11) NOT NULL,
  `order_master_id` int(11) DEFAULT NULL,
  `item_master_id` int(11) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `unit_price` decimal(12,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `is_cancelled` tinyint(4) NOT NULL DEFAULT '0',
  `is_return` tinyint(4) DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `order_no` varchar(50) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `delivery_charge` float DEFAULT NULL,
  `is_cancelled` tinyint(4) NOT NULL DEFAULT '0',
  `is_cod` tinyint(4) NOT NULL DEFAULT '1',
  `is_return` tinyint(4) DEFAULT '0',
  `status` enum('Ordered','Packed','Shipped','Delivered') DEFAULT 'Ordered',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `updated_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`id`, `order_no`, `order_date`, `total`, `user_id`, `address_id`, `delivery_charge`, `is_cancelled`, `is_cod`, `is_return`, `status`, `is_active`, `updated_time`) VALUES
(1, '98547564', '2018-06-27 11:22:11', NULL, 1, 1, 50, 0, 1, 0, 'Packed', 1, '2018-06-27 11:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `panic_contact`
--

CREATE TABLE `panic_contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `c1` varchar(15) DEFAULT NULL,
  `c1_name` varchar(30) DEFAULT NULL,
  `c2` varchar(15) DEFAULT NULL,
  `c2_name` varchar(30) DEFAULT NULL,
  `c3` varchar(15) DEFAULT NULL,
  `c3_name` varchar(30) DEFAULT NULL,
  `c4` varchar(15) DEFAULT NULL,
  `c4_name` varchar(30) DEFAULT NULL,
  `c5` varchar(15) DEFAULT NULL,
  `c5_name` varchar(30) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paytm`
--

CREATE TABLE `paytm` (
  `Id` int(200) NOT NULL,
  `Status` varchar(1000) DEFAULT NULL,
  `RESPCODE` varchar(1000) DEFAULT NULL,
  `RESPMSG` varchar(1000) DEFAULT NULL,
  `MID` varchar(1000) DEFAULT NULL,
  `TXNAMOUNT` varchar(100) DEFAULT NULL,
  `ORDERID` varchar(100) DEFAULT NULL,
  `TXNID` varchar(100) DEFAULT NULL,
  `CHECKSUMHASH` varchar(1000) DEFAULT NULL,
  `UserID` varchar(100) DEFAULT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paytm`
--

INSERT INTO `paytm` (`Id`, `Status`, `RESPCODE`, `RESPMSG`, `MID`, `TXNAMOUNT`, `ORDERID`, `TXNID`, `CHECKSUMHASH`, `UserID`, `CreatedAt`) VALUES
(1, 'TXN_FAILURE', 'Looks like you cancelled the payment. You can try again now or if you faced any issues in completing the payment, please contact us', '142', 'CONNEC22503236330948', '1.00', 'ORDS66748902', '70000810796', '3qJtTqz8XZg7jsMsj56tPDaeyiucJTza8h0j9awExlI/H81kZp2C7SobYCI3W4qTwhigYnkuH1PCbPz9d8e1HIk1I54h8xZ+Femanf4Vhos=', '', '2018-04-09 20:25:21'),
(2, '', '', '', '', '', '', '', '', '', '2018-04-09 20:25:23'),
(3, '', '', '', '', '', '', '', '', '', '2018-04-09 20:25:24'),
(4, 'TXN_FAILURE', 'Payment has been cancelled by you. If needed, you can retry after 15 minutes', '141', 'CONNEC22503236330948', '10.00', 'ORDS31039663', '70000867095', 'nzbu4tHhI7VGn8TC7MZpFuj/qBR4RpT2Kqw3mcKT4Scrg/UoIK84RYwFFVlkH5VZB4e+eRTrtyPzyoRPlsc+Y9it9ENRBaMYHghY++7FG/E=', '', '2018-05-02 16:21:09'),
(5, 'TXN_FAILURE', 'Mandatory Param is Empty TXN_AMOUNT', '806', 'CONNEC22503236330948', '', 'ORDS55713233', '', '', '', '2018-05-02 16:24:53'),
(6, 'TXN_FAILURE', 'Mandatory Param is Empty TXN_AMOUNT', '806', 'CONNEC22503236330948', '', 'ORDS7949379', '', '', '', '2018-05-02 17:29:04'),
(7, 'TXN_FAILURE', 'Mandatory Param is Empty TXN_AMOUNT', '806', 'CONNEC22503236330948', '', 'ORDS50114463', '', '', '', '2018-05-05 12:21:38'),
(8, 'TXN_FAILURE', 'Paytm does not allow multiple withdrawls within a minute. Please try to withdraw after some time.', '269', 'CONNEC22503236330948', '1.00', 'ORDS39781339', '70000873444', 'rewuEru4xTVsx4sO9GP/PjBosze4g43NLVdc1Scr/c4j6i8XCGDD3wjhQ0vOrwlDFiR+ZPeYC/4Geu/hytoXeUMXZmvkF/uBk1lQjzvjz50=', '', '2018-05-05 12:23:33'),
(9, 'TXN_SUCCESS', 'Txn Successful.', '01', 'CONNEC22503236330948', '1.00', 'ORDS8759223', '70000873450', '4Bc0xYlaUpyvyfU94D5P8k3RKTrb8KZ7+s5I/ayN/kLI+Y3+sAn86GCKf8FaVv2m14xcaoJm2ZTAcPxFIfRah1OV0AUlKeEtdwqtm0I2eBI=', '', '2018-05-05 12:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `paytm_link`
--

CREATE TABLE `paytm_link` (
  `id` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paytm_link`
--

INSERT INTO `paytm_link` (`id`, `link`) VALUES
(1, 'http://p-y.tm/ParYObI3w');

-- --------------------------------------------------------

--
-- Table structure for table `payu_payments`
--

CREATE TABLE `payu_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payable_id` int(10) UNSIGNED DEFAULT '0',
  `payable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txnid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mihpayid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `discount` double NOT NULL,
  `net_amount_debit` double NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unmappedstatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ref_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cardnum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_on_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issuing_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payu_payments`
--

INSERT INTO `payu_payments` (`id`, `payable_id`, `payable_type`, `txnid`, `mihpayid`, `firstname`, `lastname`, `email`, `phone`, `amount`, `discount`, `net_amount_debit`, `data`, `status`, `unmappedstatus`, `mode`, `bank_ref_num`, `bankcode`, `cardnum`, `name_on_card`, `issuing_bank`, `card_type`, `created_at`, `updated_at`) VALUES
(1, 0, '', 'b8401f1dd4e8513d4a86', '186023234', 'Amit Sharma', NULL, 'amit@gmail.com', '9540788885', 1, 0, 0, '', 'failure', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `description2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `timeline_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `post_created_by` int(11) DEFAULT NULL COMMENT 'This id is known to be a previous user id who created this post',
  `checkin` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_privacy` enum('public','friends') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'public',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `soundcloud_title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `soundcloud_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_video_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `description`, `description2`, `timeline_id`, `user_id`, `posted_by`, `post_created_by`, `checkin`, `post_privacy`, `active`, `soundcloud_title`, `soundcloud_id`, `youtube_title`, `youtube_video_id`, `location`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '😃sada', NULL, 2, 2, 2, NULL, NULL, 'friends', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-21 08:31:51', NULL, NULL),
(3, 'csa', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-21 09:28:24', NULL, NULL),
(5, 'fas😆', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 09:47:02', NULL, NULL),
(6, 'csaccsa😂', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 10:35:50', NULL, NULL),
(7, '😆das', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 10:42:43', NULL, NULL),
(8, 'dsa😃', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 10:56:30', NULL, NULL),
(9, 'h😄', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 11:00:14', NULL, NULL),
(10, 's', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 11:01:26', NULL, NULL),
(11, 'kl😆', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 11:05:32', NULL, NULL),
(12, 'zvcx', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 11:06:03', NULL, NULL),
(13, '😃', NULL, 3, 3, 3, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 12:46:48', NULL, NULL),
(14, 'dsasa😄😍', NULL, 3, 3, 3, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 13:09:31', NULL, NULL),
(15, 'bvcb😆', NULL, 3, 3, 3, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 13:19:56', NULL, NULL),
(16, 'fagfda😍', NULL, 3, 3, 3, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 13:20:58', NULL, NULL),
(17, 'sadf', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:28:12', NULL, NULL),
(18, 'hgdt', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:28:43', NULL, NULL),
(19, 'ujh', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:29:15', NULL, NULL),
(20, 'dsg', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:30:38', NULL, NULL),
(21, 'fes', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:31:30', NULL, NULL),
(22, 'grs', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:31:57', NULL, NULL),
(23, 'csa😂', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:44:36', NULL, NULL),
(24, 'bcxvds😃', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:45:05', NULL, NULL),
(25, 'dfa😆', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:46:45', NULL, NULL),
(26, 'fvda', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:47:35', NULL, NULL),
(27, 'vdasgsa😆😃😂', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:48:25', NULL, NULL),
(28, 'fads😆', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:49:20', NULL, NULL),
(29, ':smile:dcsa:fire:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 09:52:31', NULL, NULL),
(30, 'fgrrd😆', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 11:54:08', NULL, NULL),
(31, 'bfsdbhds:grimacing::relieved::smiley:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 12:03:45', NULL, NULL),
(32, 'dfsafsa:laughing::relieved::laughing:greg', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 12:04:50', NULL, NULL),
(33, ':grin::joy::smiley::smile::sweat_smile::laughing::innocent::kissing_heart::heart_eyes::relieved::yum::relaxed::upside_down::slight_smile::blush::wink::kissing::kissing_smiling_eyes::stuck_out_tongue_closed_eyes::yum::relieved::relieved::relieved::relaxed::relaxed::yum:uiiuiu:relieved::heart_eyes::kissing_heart::kissing_heart::kissing_heart::kissing_heart:uiui:kissing_heart:ui:kissing_heart::kissing_heart::kissing_heart::kissing_heart::kissing_heart::kissing_heart::kissing_heart:ui:kissing_heart::kissing_heart::kissing_heart::kissing_heart::kissing_heart::kissing_heart::kissing_heart:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 12:06:54', NULL, NULL),
(34, 'dfgdfgdfg dfjkgbdf gdf gd f g df  g df g   df g df g   df g dfgdfgdfgdfg dfg dfg dfg fdgdfgfdg gdfgdfg df gd fgdfgfdg fg df g dfg df gd fg df g dfg d g df gdf g dgg df gfd gfdgfdggfdgfdg dfgdfgfdg df gfd gfdgfff:relaxed::kissing_smiling_eyes::sweat_smile:dfgdf:relieved:gfd:relieved:gfdg:relaxed:fdg:upside_down:gf:laughing:gfgfdgfdg:upside_down:fdgfd:stuck_out_tongue_winking_eye:g', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 12:24:16', NULL, NULL),
(35, 'hgjhgjghj:kissing_heart::upside_down:hgjghjghjhgjhgj:grin:ghjghjhgj:smiley:hgjhgj:stuck_out_tongue_closed_eyes:hgj:yum:jh:relieved:jghjhgj:kissing_heart:hj:kissing_heart:hgjhjhgjhg:blush:jhgj:slight_smile:hgjhg:upside_down:j:upside_down:ghjhgjhgjhgj', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 12:25:35', NULL, NULL),
(36, 'sdwfda:kissing_heart:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 12:42:39', NULL, NULL),
(37, 'fewefw:slight_smile:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 12:44:05', NULL, NULL),
(38, 'fdas', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 12:45:03', NULL, NULL),
(39, ':upside_down::blush:fdsa', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 13:06:01', NULL, NULL),
(40, 'fhfdas:slight_smile::slight_smile:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 13:06:47', NULL, NULL),
(41, 'sca:upside_down:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 13:57:46', NULL, NULL),
(44, 'dsfs:slight_smile:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 14:11:33', NULL, NULL),
(45, ':kissing_heart:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-24 05:57:51', NULL, NULL),
(46, 'vf🙃😘🙃', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 06:57:05', NULL, NULL),
(47, 'csafcad<img alt=\"🙃\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f643.png\"/><img alt=\"😌\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f60c.png\"/><img alt=\"🙂\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f642.png\"/>', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 08:39:09', NULL, NULL),
(48, 'csaca<img alt=\"🙂\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f642.png\"/><img alt=\"😌\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f60c.png\"/><img alt=\"🙃\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f643.png\"/>', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 08:39:21', NULL, NULL),
(49, 'csac<img alt=\"🙃\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f643.png\"/><img alt=\"😌\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f60c.png\"/><img alt=\"🙂\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f642.png\"/><img alt=\"😘\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f618.png\"/><img alt=\"😊\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f60a.png\"/><img alt=\"😋\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f60b.png\"/><img alt=\"😝\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f61d.png\"/><img alt=\"😃\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f603.png\"/><img alt=\"😁\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f601.png\"/><img alt=\"😅\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f605.png\"/><img alt=\"😂\" class=\"emojioneemoji\" src=\"https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/png/1f602.png\"/>', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 08:39:43', NULL, NULL),
(50, 'nbv:sweat_smile:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-28 12:13:45', NULL, NULL),
(51, ':grin:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-31 11:34:56', NULL, NULL),
(52, 'bfd:joy:', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-13 06:55:21', NULL, NULL),
(53, 'fdsa', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-25 12:08:32', NULL, NULL),
(54, 'fdsaf', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-25 12:08:39', NULL, NULL),
(55, 'das', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-25 12:12:51', NULL, NULL),
(56, 'dsadadsad', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-25 12:13:20', NULL, NULL),
(57, 'asca', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-25 12:14:49', NULL, NULL),
(58, NULL, NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-25 12:15:04', NULL, NULL),
(59, 'gre', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-25 12:26:57', NULL, NULL),
(60, 'retwtw🤓😟🤑😆😂😃😄😔😕😉😊😙😝🤑🤓😝😧😤😡😩😩😮😮😷😴😹😺👻👻🤖😺😹👹👹💀💀👁🖕☝☝👆👇👈👉👂👅', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-14 06:22:04', NULL, NULL),
(61, 'retwtw🤓😟🤑😆😂😃😄😔😕😉😊😙😝🤑🤓😝😧😤😡😩😩😮😮😷😴😹😺👻😊😊☺☺😌😌', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-17 10:00:02', NULL, NULL),
(63, '😃😅😙🙂🤓😆😆😌😆😂', NULL, 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-17 12:06:04', NULL, NULL),
(64, '😬saca', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-18 08:17:55', NULL, NULL),
(65, '😀sda', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-18 08:18:53', NULL, NULL),
(66, 'dsdfs😀🙃😃😃☺', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 07:17:10', NULL, NULL),
(67, 'sca:relaxed::upside_down::smiley::grinning::relaxed::upside_down:', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 07:20:41', NULL, NULL),
(68, 'sadas<img class=\"emojione\" alt=\"&#x1f601;\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f601.png\"/><img class=\"emojione\" alt=\"&#x1f601;\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f601.png\"/><img class=\"emojione\" alt=\"&#x1f602;\" title=\":joy:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f602.png\"/><img class=\"emojione\" alt=\"&#x1f602;\" title=\":joy:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f602.png\"/>', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:19:34', NULL, NULL),
(69, 'dsada<img class=\"emojione\" alt=\"&#x1f603;\" title=\":smiley:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f603.png\"/><img class=\"emojione\" alt=\"&#x1f601;\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f601.png\"/><img class=\"emojione\" alt=\"&#x1f602;\" title=\":joy:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f602.png\"/><img class=\"emojione\" alt=\"&#x1f603;\" title=\":smiley:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f603.png\"/><img class=\"emojione\" alt=\"&#x1f601;\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f601.png\"/><img class=\"emojione\" alt=\"&#x1f602;\" title=\":joy:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f602.png\"/><img class=\"emojione\" alt=\"&#x1f603;\" title=\":smiley:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f603.png\"/><img class=\"emojione\" alt=\"&#x1f60b;\" title=\":yum:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f60b.png\"/><img class=\"emojione\" alt=\"&#x1f60b;\" title=\":yum:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f60b.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/>', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:19:48', NULL, NULL),
(70, 'dsada:smiley::grin::joy::smiley::grin::joy::smiley::yum::yum::upside_down::upside_down::upside_down::upside_down::upside_down::upside_down::money_mouth::money_mouth::money_mouth::money_mouth:', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:20:36', NULL, NULL),
(71, 'dsada<img class=\"emojione\" alt=\"&#x1f603;\" title=\":smiley:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f603.png\"/><img class=\"emojione\" alt=\"&#x1f60b;\" title=\":yum:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f60b.png\"/><img class=\"emojione\" alt=\"&#x1f60b;\" title=\":yum:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f60b.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/>', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:23:15', NULL, NULL),
(72, 'rew<img class=\"emojione\" alt=\"&#x1f60b;\" title=\":yum:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f60b.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/>', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:25:01', NULL, NULL),
(73, '<img class=\"emojione\" alt=\"&#x1f60b;\" title=\":yum:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f60b.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f643;\" title=\":upside_down:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f643.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/><img class=\"emojione\" alt=\"&#x1f911;\" title=\":money_mouth:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f911.png\"/>', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:25:10', NULL, NULL),
(74, 'dsa:grimacing::grin::grin::grin::grin::grin::grin::grin::grin::grin::grin::grin::grin::grin::grin::yum::yum::yum::yum::yum:', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:30:29', NULL, NULL),
(75, 'dsada🤑😬😁😋😬', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:45:09', NULL, NULL),
(76, 'dsada:money_mouth::grin::upside_down::yum::grimacing::money_mouth::grin::upside_down::yum::grimacing::money_mouth:', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:45:46', NULL, NULL),
(77, 'dsada:grin::upside_down::yum:', 'dsada😁🙃😋', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 08:51:10', NULL, NULL),
(78, 'edafs:upside_down::grimacing::money_mouth::grin::yum::upside_down::grimacing:', 'edafs🙃😬🤑😁😋🙃😬', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-23 07:11:03', NULL, NULL),
(79, 'dh:yum::upside_down::grimacing::yum:', 'dh😋🙃😬😋', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-23 07:45:34', NULL, NULL),
(80, 'acdas:smiley::smile::grin::sweat_smile::smiley::kissing_heart::kissing_heart::sunglasses::sunglasses:ssscdscsac', 'acdas😃😄😁😅😃😘😘😎😎ssscdscsac', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-24 11:29:29', NULL, NULL),
(81, 'hgf', 'hgf', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-24 12:53:50', NULL, NULL),
(82, 'vcx', 'vcx', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-26 10:01:28', NULL, NULL),
(83, 'test', 'test', 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-08 11:08:34', NULL, NULL),
(85, 'sa', 'sa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-08 11:29:47', NULL, NULL),
(86, 'asd', 'asd', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-11 11:20:51', NULL, NULL),
(87, 'sxa', 'sxa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-11 11:21:13', NULL, NULL),
(88, 'hf', 'hf', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-11 14:07:41', NULL, NULL),
(89, 'fewtrw', 'fewtrw', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-11 14:08:35', NULL, NULL),
(90, '', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-14 08:10:37', NULL, NULL),
(91, 'Video Post Testing', 'Video Post Testing', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-14 08:17:38', NULL, NULL),
(92, 'Video Post Testing', 'Video Post Testing', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-14 08:17:55', NULL, NULL),
(93, 'Testklhcdas', 'Testklhcdas', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-14 12:14:11', NULL, NULL),
(94, '1 mb', '1 mb', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-14 13:36:58', NULL, NULL),
(95, 'xcaz', 'xcaz', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-16 08:04:34', NULL, NULL),
(96, 'dsa', 'dsa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-16 08:05:31', NULL, NULL),
(97, 'dsa', 'dsa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-16 08:05:35', NULL, NULL),
(98, 'dsafds', 'dsafds', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-16 08:05:53', NULL, NULL),
(99, 'dsafds', 'dsafds', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-16 08:08:13', NULL, NULL),
(100, 'cdasf', 'cdasf', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-16 08:08:25', NULL, NULL),
(101, 'dsadfa', 'dsadfa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-16 08:12:36', NULL, NULL),
(103, '', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-16 11:08:51', NULL, NULL),
(104, 'uiogugf', 'uiogugf', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-17 06:16:43', NULL, NULL),
(105, 'xsa', 'xsa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-22 13:48:16', NULL, NULL),
(106, 'fds', 'fds', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-25 05:50:53', NULL, NULL),
(107, 'fsda', 'fsda', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-25 05:51:33', NULL, NULL),
(108, 'fdsfds', 'fdsfds', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-25 07:57:42', NULL, NULL),
(109, 'dsafdas', 'dsafdas', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-13 06:15:26', NULL, NULL),
(110, 'cxdzvcdz', 'cxdzvcdz', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-13 06:20:58', NULL, NULL),
(111, 'dsadsfa', 'dsadsfa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-13 06:21:23', NULL, NULL),
(112, 'jbkjlb', 'jbkjlb', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-13 06:24:14', NULL, NULL),
(113, 'kjh', 'kjh', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-13 06:24:36', NULL, NULL),
(114, 'yur', 'yur', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-13 06:29:06', NULL, NULL),
(115, 'dfcsfas', 'dfcsfas', 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-13 06:30:10', NULL, NULL),
(116, 'fds', 'fds', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 09:56:40', NULL, NULL),
(117, 'dsa', 'dsa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 09:58:54', NULL, NULL),
(121, '', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 10:35:05', NULL, NULL),
(122, 'tre', 'tre', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 10:36:19', NULL, NULL),
(123, 'cas', 'cas', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 11:04:49', NULL, NULL),
(124, 'dsa', 'dsa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 11:05:45', NULL, NULL),
(125, 'dasdsada', 'dasdsada', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 11:06:31', NULL, NULL),
(126, 'csa', 'csa', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 11:07:26', NULL, NULL),
(127, 'fds', 'fds', 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-01 11:09:15', NULL, NULL),
(128, 'dasasdas', 'dasasdas', 2, 2, 2, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-09 10:36:20', NULL, NULL),
(159, '', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-10 14:42:09', NULL, NULL),
(162, '', NULL, 4, 4, 4, NULL, NULL, 'public', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-10 14:53:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_follows`
--

CREATE TABLE `post_follows` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 12, 2, '2018-05-23 08:39:42', NULL),
(4, 29, 2, '2018-05-23 10:01:00', NULL),
(5, 59, 4, '2018-06-27 13:30:45', NULL),
(180, 79, 4, '2018-07-24 11:07:06', NULL),
(186, 81, 4, '2018-08-14 10:08:24', NULL),
(194, 92, 4, '2018-08-16 05:34:29', NULL),
(195, 90, 4, '2018-08-16 05:34:35', NULL),
(197, 105, 4, '2018-08-25 05:38:49', NULL),
(198, 106, 4, '2018-08-25 05:50:59', NULL),
(200, 107, 4, '2018-08-25 05:51:43', NULL),
(201, 114, 2, '2018-10-03 08:29:48', NULL),
(216, 112, 4, '2018-10-05 14:17:35', NULL),
(223, 114, 4, '2018-10-17 07:41:05', NULL),
(224, 115, 4, '2018-10-17 07:41:22', NULL),
(225, 115, 2, '2018-10-17 07:50:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_media`
--

CREATE TABLE `post_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `media_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_type` enum('img','vd') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'img',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_media`
--

INSERT INTO `post_media` (`id`, `post_id`, `is_deleted`, `media_url`, `media_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 0, 'userposts/2/2iVQrW_post_user_id_2_Adver_mainimg4.jpg', 'img', NULL, NULL, NULL),
(2, 45, 0, 'userposts/2/yrLg7H_post_user_id_2_250.gif', 'img', NULL, NULL, NULL),
(3, 56, 0, 'userposts/2/tZi2JR_post_user_id_2_123.jpg', 'img', NULL, NULL, NULL),
(4, 56, 0, 'userposts/2/BYTZjb_post_user_id_2_234.png', 'img', NULL, NULL, NULL),
(5, 56, 0, 'userposts/2/G4MwUS_post_user_id_2_Admin_pic.jpg', 'img', NULL, NULL, NULL),
(6, 56, 0, 'userposts/2/6TY0oI_post_user_id_2_banner_organic.jpg', 'img', NULL, NULL, NULL),
(7, 56, 0, 'userposts/2/e8Kmc1_post_user_id_2_banner_slider1.jpg', 'img', NULL, NULL, NULL),
(8, 56, 0, 'userposts/2/wostmU_post_user_id_2_banner_slider2.jpg', 'img', NULL, NULL, NULL),
(9, 56, 0, 'userposts/2/kuu68f_post_user_id_2_banner_slider3.jpg', 'img', NULL, NULL, NULL),
(10, 56, 0, 'userposts/2/6mGA8u_post_user_id_2_banner_slider4.jpg', 'img', NULL, NULL, NULL),
(11, 56, 0, 'userposts/2/gaea46_post_user_id_2_banner_slider5.jpg', 'img', NULL, NULL, NULL),
(12, 56, 0, 'userposts/2/32lj1h_post_user_id_2_banner6.jpg', 'img', NULL, NULL, NULL),
(13, 57, 0, 'userposts/2/7UC5Ko_post_user_id_2_Admin_pic.jpg', 'img', NULL, NULL, NULL),
(14, 65, 0, 'userposts/4/TZSlyh_post_user_id_4_0D44M2_level.png', 'img', NULL, NULL, NULL),
(15, 65, 0, 'userposts/4/4nOWlI_post_user_id_4_5b4330ea7a924_img.Adver_mainimg3.jpg', 'img', NULL, NULL, NULL),
(16, 81, 0, 'userposts/4/vaZqT3_post_user_id_4_imagename.png', 'img', NULL, NULL, NULL),
(17, 81, 0, 'userposts/4/RAI4jg_post_user_id_4_smcl (1).png', 'img', NULL, NULL, NULL),
(18, 81, 0, 'userposts/4/iQmwWm_post_user_id_4_smcl.png', 'img', NULL, NULL, NULL),
(19, 82, 0, 'userposts/4/tYvWDh_post_user_id_4_5b4330ff98e93_img.Adver_mainimg3.jpg', 'img', NULL, NULL, NULL),
(20, 84, 0, 'userposts/4/OxLeNQ_post_user_id_4_banner_slider1.jpg', 'img', NULL, NULL, NULL),
(21, 86, 0, 'userposts/4/NYLPT3_post_user_id_4_banner_organic.jpg', 'img', NULL, NULL, NULL),
(22, 86, 0, 'userposts/4/mfJ2B5_post_user_id_4_banner_slider1.jpg', 'img', NULL, NULL, NULL),
(23, 90, 0, 'userposts/4/jdt2lp_post_user_id_4_SampleVideo_1280x720_1mb.mp4', 'vd', NULL, NULL, NULL),
(24, 92, 0, 'userposts/4/K3Jcdw_post_user_id_4_SampleVideo_1280x720_1mb.mp4', 'vd', NULL, NULL, NULL),
(25, 94, 0, 'userposts/4/Tcr8Og_post_user_id_4_SampleVideo_1280x720_1mb.mp4', 'vd', NULL, NULL, NULL),
(26, 101, 0, 'userposts/4/g8syk4_post_user_id_4_JGOF4544.JPG', 'img', NULL, NULL, NULL),
(27, 102, 0, 'userposts/4/K3GqBC_post_user_id_4_SampleVideo_1280x720_10mb.mp4', 'vd', NULL, NULL, NULL),
(28, 103, 0, 'userposts/4/SfwXQs_post_user_id_4_SampleVideo_1280x720_1mb.mp4', 'vd', NULL, NULL, NULL),
(29, 104, 0, 'userposts/4/RBneFO_post_user_id_4_SampleVideo_1280x720_10mb.mp4', 'vd', NULL, NULL, NULL),
(30, 105, 0, 'userposts/4/fcswaZ_post_user_id_4_0D44M2_level.png', 'img', NULL, NULL, NULL),
(31, 105, 0, 'userposts/4/6MIyKc_post_user_id_4_5b4330ea7a924_img.Adver_mainimg3.jpg', 'img', NULL, NULL, NULL),
(32, 105, 0, 'userposts/4/4pTGYx_post_user_id_4_5b4330ff98e93_img.Adver_mainimg3.jpg', 'img', NULL, NULL, NULL),
(33, 105, 0, 'userposts/4/cz0LZC_post_user_id_4_5b4331147b960_img.Adver_mainimg3.jpg', 'img', NULL, NULL, NULL),
(34, 105, 0, 'userposts/4/KxLY1g_post_user_id_4_5v1nCO_level.png', 'img', NULL, NULL, NULL),
(35, 105, 0, 'userposts/4/QlmZiP_post_user_id_4_about_image.jpg', 'img', NULL, NULL, NULL),
(36, 105, 0, 'userposts/4/yNEbbV_post_user_id_4_acknowledgement.jpg', 'img', NULL, NULL, NULL),
(37, 105, 0, 'userposts/4/MTmp3P_post_user_id_4_Adver_img1.jpg', 'img', NULL, NULL, NULL),
(38, 105, 0, 'userposts/4/YWUgJ6_post_user_id_4_Adver_img2.jpg', 'img', NULL, NULL, NULL),
(39, 105, 0, 'userposts/4/WEZ47B_post_user_id_4_Adver_img3.jpg', 'img', NULL, NULL, NULL),
(40, 106, 0, 'userposts/4/9z9FNo_post_user_id_4_0D44M2_level.png', 'img', NULL, NULL, NULL),
(41, 108, 0, 'userposts/4/05GzWu_post_user_id_4_SampleVideo_1280x720_5mb.mp4', 'vd', NULL, NULL, NULL),
(42, 117, 0, 'userposts/4/TCJEjU_post_user_id_4_image-1.jpg', 'img', NULL, NULL, NULL),
(43, 117, 0, 'userposts/4/0hfuVS_post_user_id_4_image-2.jpg', 'img', NULL, NULL, NULL),
(44, 117, 0, 'userposts/4/OhJlWj_post_user_id_4_image-3.jpg', 'img', NULL, NULL, NULL),
(45, 118, 0, 'userposts/4/DXIAQu_post_user_id_4_image-1.jpg', 'img', NULL, NULL, NULL),
(46, 119, 0, 'userposts/4/dJ5djZ_post_user_id_4_image-1.jpg', 'img', NULL, NULL, NULL),
(47, 120, 0, 'userposts/4/eI23GT_post_user_id_4_image-1.jpg', 'img', NULL, NULL, NULL),
(48, 120, 0, 'userposts/4/G3vlOQ_post_user_id_4_mfJ2B5_post_user_id_4_banner_slider1.jpg', 'img', NULL, NULL, NULL),
(49, 121, 0, 'userposts/4/Nfmtl5_post_user_id_4_4nOWlI_post_user_id_4_5b4330ea7a924_img.Adver_mainimg3.jpg', 'img', NULL, NULL, NULL),
(50, 129, 0, 'userposts/4/g3Qzl7png', 'img', NULL, NULL, NULL),
(51, 129, 0, 'userposts/4/qncI0gpng', 'img', NULL, NULL, NULL),
(52, 130, 0, 'userposts/4/97pzZB.png', 'img', NULL, NULL, NULL),
(53, 130, 0, 'userposts/4/m7sVQn.png', 'img', NULL, NULL, NULL),
(54, 131, 0, 'userposts/4/24cG28.png', 'img', NULL, NULL, NULL),
(55, 131, 0, 'userposts/4/bSsbIl.png', 'img', NULL, NULL, NULL),
(56, 132, 0, 'userposts/4/KqaCPb.png', 'img', NULL, NULL, NULL),
(57, 132, 0, 'userposts/4/vxicQc.png', 'img', NULL, NULL, NULL),
(58, 135, 0, 'userposts/4/oQMl9U.png', 'img', NULL, NULL, NULL),
(59, 136, 0, 'userposts/4/qDTCyf.png', 'img', NULL, NULL, NULL),
(60, 136, 0, 'userposts/4/UIntIv.png', 'img', NULL, NULL, NULL),
(61, 136, 0, 'userposts/4/XZQMz6.png', 'img', NULL, NULL, NULL),
(62, 137, 0, 'userposts/4/IuxPU2.png', 'img', NULL, NULL, NULL),
(63, 137, 0, 'userposts/4/5R8d3s.png', 'img', NULL, NULL, NULL),
(64, 138, 0, 'userposts/4/rHNCUr.png', 'img', NULL, NULL, NULL),
(65, 138, 0, 'userposts/4/ehksKv.png', 'img', NULL, NULL, NULL),
(66, 138, 0, 'userposts/4/4xyL8n.png', 'img', NULL, NULL, NULL),
(67, 138, 0, 'userposts/4/KcyRhp.png', 'img', NULL, NULL, NULL),
(68, 139, 0, 'userposts/4/it3OJC.png', 'img', NULL, NULL, NULL),
(69, 139, 0, 'userposts/4/yMxPA7.png', 'img', NULL, NULL, NULL),
(70, 140, 0, 'userposts/4/qPKKoW.png', 'img', NULL, NULL, NULL),
(71, 140, 0, 'userposts/4/LRuShk.png', 'img', NULL, NULL, NULL),
(72, 141, 0, 'userposts/4/xggWy2.jpeg', 'img', NULL, NULL, NULL),
(73, 141, 0, 'userposts/4/gVUEeb.jpeg', 'img', NULL, NULL, NULL),
(74, 142, 0, 'userposts/4/DkQnYA.jpeg', 'img', NULL, NULL, NULL),
(75, 143, 0, 'userposts/4/0W9Dzj.png', 'img', NULL, NULL, NULL),
(76, 144, 0, 'userposts/4/T8JdPh.jpeg', 'img', NULL, NULL, NULL),
(77, 145, 0, 'userposts/4/Sbwkul.png', 'img', NULL, NULL, NULL),
(78, 146, 0, 'userposts/4/tXlV2F.png', 'img', NULL, NULL, NULL),
(79, 147, 0, 'userposts/4/35eQ37.png', 'img', NULL, NULL, NULL),
(80, 148, 0, 'userposts/4/VkXTVY.png', 'img', NULL, NULL, NULL),
(81, 149, 0, 'userposts/4/imAC8b.png', 'img', NULL, NULL, NULL),
(82, 150, 0, 'userposts/4/xIciUg.png', 'img', NULL, NULL, NULL),
(83, 151, 0, 'userposts/4/jGOv0Y.jpeg', 'img', NULL, NULL, NULL),
(84, 153, 0, 'userposts/4/i8VzKc.jpeg', 'img', NULL, NULL, NULL),
(85, 155, 0, 'userposts/4/E6jI9H.jpeg', 'img', NULL, NULL, NULL),
(86, 156, 0, 'userposts/4/M9X0TK.png', 'img', NULL, NULL, NULL),
(87, 157, 0, 'userposts/4/HIcjgA.png', 'img', NULL, NULL, NULL),
(88, 157, 0, 'userposts/4/FBCHcO.png', 'img', NULL, NULL, NULL),
(89, 158, 0, 'userposts/4/nzPUF5.png', 'img', NULL, NULL, NULL),
(90, 158, 0, 'userposts/4/nj4cR0.png', 'img', NULL, NULL, NULL),
(91, 161, 0, 'userposts/4/ca54J4.png', 'img', NULL, NULL, NULL),
(92, 162, 0, 'userposts/4/SrVuxT.png', 'img', NULL, NULL, NULL),
(93, 162, 0, 'userposts/4/uGWJmX.png', 'img', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_spam`
--

CREATE TABLE `post_spam` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_spam`
--

INSERT INTO `post_spam` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(57, 113, 4, '2018-10-05 14:06:14'),
(59, 112, 4, '2018-10-05 14:17:32'),
(35, 111, 4, '2018-10-05 13:58:19'),
(36, 110, 4, '2018-10-05 13:58:34'),
(42, 108, 4, '2018-10-05 14:00:46'),
(85, 116, 4, '2018-10-16 14:05:07'),
(86, 117, 4, '2018-10-16 14:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_unlike`
--

CREATE TABLE `post_unlike` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_unlike`
--

INSERT INTO `post_unlike` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(8, 115, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `redeem_masters`
--

CREATE TABLE `redeem_masters` (
  `id` int(200) NOT NULL,
  `ac_number` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `user_id` int(200) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `reject_reason` varchar(200) DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redeem_masters`
--

INSERT INTO `redeem_masters` (`id`, `ac_number`, `amount`, `user_id`, `status`, `reject_reason`, `created_time`) VALUES
(1, '2', '5', 24, 'Pending', NULL, '2018-04-19 07:34:35'),
(3, '223', '2', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(4, '2233', '23', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(5, '2233', '23', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(6, '2233', '23', 26, 'Approved', NULL, '2018-04-19 07:34:35'),
(7, 'www', '21', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(8, '212', '5', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(9, '212', '1000', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(10, '212', '90', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(11, '21234', '55', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(12, '2123456', '344', 26, 'Pending', NULL, '2018-04-19 07:34:35'),
(13, '133', '100', 39, 'Pending', NULL, '2018-04-19 07:34:35'),
(14, '133', '200', 39, 'Approved', NULL, '2018-04-19 07:34:35'),
(16, '564564564564', '100', 2, 'Rejected', 'dvsa', '2018-04-19 07:56:20'),
(17, '123456', '100', 4, 'Pending', NULL, '2018-04-19 14:05:52'),
(18, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 07:58:49'),
(19, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 07:58:51'),
(20, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 07:58:51'),
(21, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 07:58:52'),
(22, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 07:58:55'),
(23, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:07:00'),
(24, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:29'),
(25, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:30'),
(26, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:33'),
(27, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:33'),
(28, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:34'),
(29, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:34'),
(30, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:34'),
(31, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:38'),
(32, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:45'),
(33, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:17:56'),
(34, NULL, NULL, 2, 'Pending', NULL, '2018-05-17 08:18:35'),
(35, 'sca', NULL, 2, 'Pending', NULL, '2018-05-17 08:20:01'),
(36, 'dsf', '100', 2, 'Pending', NULL, '2018-05-17 08:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `child_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PaymentStatus` int(11) NOT NULL DEFAULT '1',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Gateway` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Transaction Id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`id`, `parent_id`, `child_id`, `PaymentStatus`, `CreatedAt`, `Gateway`, `t_id`) VALUES
(1, '0', '49', 1, '2018-08-01 06:32:52', NULL, NULL),
(2, '0', '50', 1, '2018-08-07 12:59:02', NULL, NULL),
(3, '0', '51', 1, '2018-08-07 13:03:34', NULL, NULL),
(4, '0', '51', 1, '2018-08-07 13:03:37', NULL, NULL),
(5, '0', '51', 1, '2018-08-07 13:03:41', NULL, NULL),
(6, '0', '51', 1, '2018-08-07 13:03:46', NULL, NULL),
(7, '0', '51', 1, '2018-08-07 13:03:49', NULL, NULL),
(8, '0', '51', 1, '2018-08-07 13:03:52', NULL, NULL),
(9, '0', '51', 1, '2018-08-07 13:03:55', NULL, NULL),
(10, '0', '51', 1, '2018-08-07 13:03:58', NULL, NULL),
(11, '0', '51', 1, '2018-08-07 13:04:01', NULL, NULL),
(12, '0', '51', 1, '2018-08-07 13:04:04', NULL, NULL),
(13, '0', '51', 1, '2018-08-07 13:04:07', NULL, NULL),
(14, '0', '51', 1, '2018-08-07 13:04:10', NULL, NULL),
(15, '0', '51', 1, '2018-08-07 13:04:31', NULL, NULL),
(16, '0', '64', 1, '2018-08-07 13:42:32', NULL, NULL),
(17, '0', '64', 1, '2018-08-07 13:42:35', NULL, NULL),
(18, '0', '64', 1, '2018-08-07 13:42:37', NULL, NULL),
(19, '0', '51', 1, '2018-08-07 13:52:06', NULL, NULL),
(20, '0', '51', 1, '2018-08-07 13:54:49', NULL, NULL),
(21, '0', '51', 1, '2018-08-07 13:54:52', NULL, NULL),
(22, '0', '51', 1, '2018-08-07 13:54:55', NULL, NULL),
(23, '0', '71', 1, '2018-08-13 12:04:31', NULL, NULL),
(24, '0', '72', 1, '2018-08-13 12:08:05', NULL, NULL),
(25, 'refer1234', '7', 1, '2018-10-13 06:17:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `survey_amount` float DEFAULT '1',
  `no_of_user` int(11) DEFAULT '1',
  `total_distributed` float NOT NULL DEFAULT '0',
  `question` longtext CHARACTER SET utf8mb4,
  `question_type` enum('2','3','4') NOT NULL DEFAULT '2' COMMENT '2-yes/no,3-options(a,b,c),4-options(a,b,c,d)',
  `option1` varchar(100) DEFAULT NULL,
  `option2` varchar(100) DEFAULT NULL,
  `option3` varchar(100) DEFAULT NULL,
  `option4` varchar(100) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `survey_amount`, `no_of_user`, `total_distributed`, `question`, `question_type`, `option1`, `option2`, `option3`, `option4`, `is_active`) VALUES
(1, 2, 20, 0.1, 'क्या अयोध्या में राम की मूर्ति से मान जाएंगे नाराज साधु-संत?', '2', 'Yes', 'No', NULL, NULL, 1),
(2, 4, 20, 0.2, 'क्या अयोध्या में राम की मूर्ति से मान जाएंगे नाराज साधु-संत?', '3', 'Yes', 'No', 'Complecated', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_count`
--

CREATE TABLE `survey_count` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `option1_count` int(11) DEFAULT '0',
  `option2_count` int(11) DEFAULT '0',
  `option3_count` int(11) DEFAULT '0',
  `option4_count` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_count`
--

INSERT INTO `survey_count` (`id`, `survey_id`, `option1_count`, `option2_count`, `option3_count`, `option4_count`) VALUES
(1, 1, 0, 1, 0, 0),
(2, 2, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `timelines`
--

CREATE TABLE `timelines` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8_unicode_ci,
  `avatar_id` int(10) UNSIGNED DEFAULT NULL,
  `cover_id` int(10) UNSIGNED DEFAULT NULL,
  `cover_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('user','page','group') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timelines`
--

INSERT INTO `timelines` (`id`, `username`, `name`, `fname`, `lname`, `about`, `avatar_id`, `cover_id`, `cover_position`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 'Amit Sharma', 'Amit', 'Sharma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 'Anshu Jain', 'Anshu', 'Jain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 'Devansh Diwan', 'Devansh', 'Diwan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 'Manish Jain', 'Manish', 'Jain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'Kamal Patel', 'Kamal', 'Patel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 'Nikhil Sahu', 'Nikhil', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 'Bijendra1 Sahu', 'Bijendra1', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, 'Bijendra123 Sahu', 'Bijendra123', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 'a b', 'a', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, 'Test Name last Name', 'Test Name', 'last Name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, NULL, 'Bijendra1233 Sahu', 'Bijendra1233', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, NULL, 'Virendra Jain', 'Virendra', 'Jain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, NULL, 'Test user', 'Test', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, NULL, 'fdsaf fdsa', 'fdsaf', 'fdsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, NULL, 'fname lname', 'fname', 'lname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, 'dfas fda', 'dfas', 'fda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, NULL, 'Naveen Sahu', 'Naveen', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, 'Naveen Sahu', 'Naveen', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, 'Bijendra Sahu', 'Bijendra', 'Sahu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, 'csacsa ', 'csacsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, NULL, 'cdas dsa', 'cdas', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, 'fdf fdfd', 'fdf', 'fdfd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, 'fdf fdfd', 'fdf', 'fdfd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, NULL, 'fdf fdfd', 'fdf', 'fdfd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, NULL, 'xvcxcv xcvxc', 'xvcxcv', 'xcvxc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, NULL, 'Naveen rr', 'Naveen', 'rr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, 'Naveen rr', 'Naveen', 'rr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, 'Naveen rr', 'Naveen', 'rr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, NULL, 'Naveen das', 'Naveen', 'das', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, NULL, 'Naveen dsa', 'Naveen', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_pic` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/Male_default.png',
  `otp` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timeline_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verification_code` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `birthday` date DEFAULT NULL,
  `state` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_privacy` enum('public','private','friends') COLLATE utf8_unicode_ci DEFAULT 'public',
  `profession` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profession_other` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_type` enum('free','paid') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `last_logged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `theme_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_colour` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `affiliate_id` int(10) UNSIGNED DEFAULT NULL,
  `language` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_pic`, `otp`, `rc`, `timeline_id`, `email`, `verification_code`, `verified`, `email_verified`, `remember_token`, `password`, `balance`, `birthday`, `state`, `city`, `country_id`, `gender`, `contact`, `contact_privacy`, `profession`, `profession_other`, `member_type`, `active`, `last_logged`, `theme_img`, `header_colour`, `address`, `created_time`, `token`, `affiliate_id`, `language`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'images/Male_default.png', '946205', 'rc1234', 1, 'bijendra@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-07', NULL, 'jbp', 99, 'male', '8989892827', 'public', 'Doctor', NULL, 'paid', 1, '2018-10-30 08:29:14', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'profile/1534513255.png', '974209', 'rc4321', 2, 'amit@gmail.com', NULL, 1, NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 0.00, '1992-02-03', NULL, 'Jabalpur', 99, 'male', '8989892897', 'public', 'Doctor', NULL, 'paid', 1, '2018-10-17 07:53:46', 'http://localhost:1000/images/theme_img_up2.jpg', '#000000', NULL, '2018-07-17 11:21:53', 'dctvAW9VK_Q:APA91bGBtNy2WbEUoM8eA0nyrjSAD2OHKCf63taxfLv71ByzO748xIJQsJU0r0GNYPEx6mVFsTY2jzPijnM4Lr-5njHAInTITdayYYd5_7k4mGaURVxFisrdHOMp6sCPGIbSLLplhwgc', NULL, NULL, NULL, NULL, NULL),
(3, 'images/Male_default.png', '763859', 'refer1235', 3, 'anshu@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-05', NULL, 'Jabalpur', 99, 'female', '8989892828', 'private', 'Engineer', NULL, 'paid', 1, '2018-07-23 10:24:24', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'images/Male_default.png', '463145', 'refer1236', 4, 'devansh@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-07', 'Madhya Pradesh', 'Jabalpur', NULL, 'female', '8989892866', 'private', 'Other', NULL, 'paid', 1, '2018-11-06 10:17:51', NULL, '#000000', NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'images/Male_default.png', '842492', 'refer1234', 5, 'manish@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-05', NULL, 'Jbp', 99, 'male', '9876543210', 'public', 'Engineer', NULL, 'paid', 1, '2018-06-04 07:16:31', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'images/Male_default.png', '442297', 'dasf', 6, 'kaml@gmail.com', NULL, 0, NULL, NULL, '7f58341b9dceb1f1edca80dae10b92bc', 0.00, '2018-02-14', NULL, 'Jabalpur', 99, 'male', '9876543210', 'public', 'Engineer', NULL, 'paid', 1, '2018-06-02 13:57:02', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'images/Male_default.png', '907695', 'cdsaf', 7, 'ni@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-07', NULL, 'Jabalpur', 99, 'male', '9876543210', 'public', 'Engineer', NULL, 'paid', 1, '2018-10-13 06:17:34', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'images/Male_default.png', '271668', 'refer1237', 8, 'amit1@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-14', NULL, 'Jabalpur', 99, 'male', '8989892827', 'public', 'Engineer', NULL, 'free', 1, '2018-06-02 13:27:50', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'images/Male_default.png', '280419', 'rc1239', 9, 'b@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-19', NULL, 'Jabalpur', 99, 'male', '9876543210', 'public', 'Engineer', NULL, 'free', 1, '2018-06-04 06:59:45', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'images/Male_default.png', '431780', NULL, 10, 'a@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-23', NULL, 'Jabalpur', 99, 'male', '8989892827', 'public', 'Doctor', NULL, 'free', 1, '2018-02-23 06:33:02', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'images/Male_default.png', '212299', NULL, 11, 'testname@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-02-26', NULL, 'jabalpur', 99, 'female', '9876543210', 'public', 'Doctor', NULL, 'free', 1, '2018-03-05 12:12:39', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'images/Male_default.png', '541952', NULL, 12, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Engineer', NULL, 'free', 1, '2018-03-22 10:21:36', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'images/Male_default.png', '543263', NULL, 13, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Engineer', NULL, 'free', 1, '2018-03-22 10:21:38', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'images/Male_default.png', '421160', NULL, 14, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Engineer', NULL, 'free', 1, '2018-03-22 10:21:40', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'images/Male_default.png', '311927', NULL, 15, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Engineer', NULL, 'free', 1, '2018-03-22 10:21:51', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'images/Male_default.png', '735318', NULL, 16, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Engineer', NULL, 'free', 1, '2018-03-22 10:21:43', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'images/Male_default.png', '804194', NULL, 17, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Engineer', NULL, 'free', 1, '2018-03-22 10:21:45', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'images/Male_default.png', '440492', NULL, 18, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Engineer', NULL, 'free', 1, '2018-03-22 10:21:47', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'images/Male_default.png', '569332', NULL, 19, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Engineer', NULL, 'free', 1, '2018-03-22 10:21:49', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'images/Male_default.png', '398925', NULL, 20, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', 'Others', NULL, 'free', 1, '2018-05-22 06:12:25', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'images/Male_default.png', '804740', NULL, 21, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', NULL, NULL, 'free', 1, '2018-03-07 12:36:23', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'images/Male_default.png', '583189', NULL, 22, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', NULL, NULL, 'free', 1, '2018-03-07 12:36:24', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'images/Male_default.png', '478326', NULL, 23, 'amit123@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-03-07', NULL, 'Jabalpur', 99, 'male', '54464564', 'public', NULL, NULL, 'free', 1, '2018-03-07 12:36:24', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'images/Male_default.png', '424165', 'rc28331397', 24, 'virendra@gmail.com', NULL, 1, NULL, NULL, 'c85a8f28c9d29d0a26d3f581b505e347', 0.00, '2018-04-10', NULL, 'Jabalpur', 99, 'male', '8989892897', 'public', NULL, NULL, 'free', 1, '2018-05-16 12:36:35', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'images/Male_default.png', '544047', 'rc47194058', 25, 'dshhfa@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-04-14', NULL, 'Jabalpur', 99, 'female', '8989892897', 'public', NULL, NULL, 'free', 1, '2018-04-14 06:12:03', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'images/Male_default.png', '259896', 'rc64874026', 26, 'abbb@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-04-14', NULL, 'Jabalpur', 99, 'male', '8989892897', 'public', NULL, NULL, 'free', 1, '2018-05-29 05:45:13', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'images/Male_default.png', '548512', 'rc53104028', 39, 'bijendrasahu888@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-04-17', NULL, 'Jabalpur', 99, 'male', '8989892897', 'public', 'Engineer', NULL, 'paid', 1, '2018-05-28 11:30:10', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'images/Male_default.png', '478462', 'rc92683665', 47, 'retinodes.bijendra1@gmail.com', NULL, 1, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-05-23', NULL, 'Jabalpur', 99, 'male', '9765483210', 'public', NULL, NULL, 'free', 1, '2018-05-31 12:13:00', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'images/Male_default.png', '794597', 'rc92172888', 48, 'retinodes.bijendra2@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '2018-05-31', NULL, 'Jabalpur', 99, 'male', '9876543210', 'public', NULL, NULL, 'free', 1, '2018-08-01 06:32:40', NULL, NULL, NULL, '2018-07-17 11:21:53', NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'images/Male_default.png', '684170', 'rc45874049', 49, 'retinodes.bijendra@gmail.com', NULL, 0, NULL, NULL, '202cb962ac59075b964b07152d234b70', 0.00, '1993-10-06', NULL, 'Jabalpur', 99, 'male', '8989892897', 'public', NULL, NULL, 'free', 1, '2018-08-01 06:32:51', NULL, NULL, NULL, '2018-08-01 06:32:51', NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'images/Male_default.png', '188917', 'rc41830203', 50, NULL, NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2018-08-07', NULL, 'https://hostingfacts.com/domai', 99, 'male', NULL, 'public', NULL, NULL, 'free', 1, '2018-08-07 12:59:01', NULL, NULL, NULL, '2018-08-07 12:59:01', NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'images/Male_default.png', '610292', 'rc42815914', 51, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:03:33', NULL, NULL, NULL, '2018-08-07 13:03:33', NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'images/Male_default.png', '256168', 'rc64624710', 52, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:03:37', NULL, NULL, NULL, '2018-08-07 13:03:37', NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'images/Male_default.png', '479636', 'rc12108316', 53, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:03:40', NULL, NULL, NULL, '2018-08-07 13:03:40', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'images/Male_default.png', '878546', 'rc96338455', 54, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:03:43', NULL, NULL, NULL, '2018-08-07 13:03:43', NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'images/Male_default.png', '486340', 'rc42278727', 55, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:03:48', NULL, NULL, NULL, '2018-08-07 13:03:48', NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'images/Male_default.png', '898715', 'rc46972036', 56, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:03:51', NULL, NULL, NULL, '2018-08-07 13:03:51', NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'images/Male_default.png', '382084', 'rc56225960', 57, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:03:54', NULL, NULL, NULL, '2018-08-07 13:03:54', NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'images/Male_default.png', '481736', 'rc95159124', 58, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:03:57', NULL, NULL, NULL, '2018-08-07 13:03:57', NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'images/Male_default.png', '366857', 'rc24761432', 59, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:04:00', NULL, NULL, NULL, '2018-08-07 13:04:00', NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'images/Male_default.png', '359194', 'rc68973204', 60, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:04:03', NULL, NULL, NULL, '2018-08-07 13:04:03', NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'images/Male_default.png', '342300', 'rc39191075', 61, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:04:06', NULL, NULL, NULL, '2018-08-07 13:04:06', NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'images/Male_default.png', '584022', 'rc98459144', 62, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:04:09', NULL, NULL, NULL, '2018-08-07 13:04:09', NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'images/Male_default.png', '433539', 'rc77896051', 63, 'naveen@gmail.com', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-04', NULL, 'Jabalpur', 99, 'male', '8989898989', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:04:30', NULL, NULL, NULL, '2018-08-07 13:04:30', NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'images/Male_default.png', '170713', 'rc98970959', 64, 'fdff', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-07', NULL, 'Jabalpur', 99, 'male', '1111111111', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:42:31', NULL, NULL, NULL, '2018-08-07 13:42:31', NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'images/Male_default.png', '867458', 'rc85525631', 65, 'fdff', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-07', NULL, 'Jabalpur', 99, 'male', '1111111111', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:42:34', NULL, NULL, NULL, '2018-08-07 13:42:34', NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'images/Male_default.png', '871662', 'rc74304917', 66, 'fdff', NULL, 0, NULL, NULL, '5e543256c480ac577d30f76f9120eb74', 0.00, '2000-08-07', NULL, 'Jabalpur', 99, 'male', '1111111111', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:42:36', NULL, NULL, NULL, '2018-08-07 13:42:36', NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'images/Male_default.png', '994948', 'rc62154653', 67, 'naveen@gmail.com', NULL, 0, NULL, NULL, 'c1619d2ad66f7629c12c87fe21d32a58', 0.00, '2000-08-07', NULL, 'Jabalpur', 99, 'male', '6666666666', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:52:10', NULL, NULL, NULL, '2018-08-07 13:52:05', NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'images/Male_default.png', '555550', 'rc99235273', 68, 'naveen@gmail.com', NULL, 0, NULL, NULL, '8a4488c177d9dc8c3da7c745c89ca214', 0.00, '2018-08-07', NULL, 'Jabalpur', 99, 'male', '5656565656', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:54:43', NULL, NULL, NULL, '2018-08-07 13:54:43', NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'images/Male_default.png', '221536', 'rc53678288', 69, 'naveen@gmail.com', NULL, 0, NULL, NULL, '8a4488c177d9dc8c3da7c745c89ca214', 0.00, '2018-08-07', NULL, 'Jabalpur', 99, 'male', '5656565656', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:54:51', NULL, NULL, NULL, '2018-08-07 13:54:51', NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'images/Male_default.png', '865342', 'rc59486574', 70, 'naveen@gmail.com', NULL, 0, NULL, NULL, '8a4488c177d9dc8c3da7c745c89ca214', 0.00, '2000-08-02', NULL, 'Jabalpur', 99, 'male', '5656565656', 'public', NULL, NULL, 'free', 1, '2018-08-07 13:54:54', NULL, NULL, NULL, '2018-08-07 13:54:54', NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'images/Male_default.png', '486353', 'rc35681677', 71, 'naveen126@gmail.com', NULL, 0, NULL, NULL, '9015885d30edf76768e1421f06cd494d', 0.00, '2000-08-13', NULL, 'Jabalpur', 99, 'male', '8564567487', 'public', NULL, NULL, 'free', 1, '2018-08-13 12:04:27', NULL, NULL, NULL, '2018-08-13 12:04:27', NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'images/Male_default.png', '884901', 'rc30886813', 72, 'naveen41@gmail.com', NULL, 0, NULL, NULL, '91aa6e0112084db1fa4febf08366c708', 0.00, '2000-08-13', NULL, 'Jabalpur', 99, 'male', '5345345454', 'public', NULL, NULL, 'free', 1, '2018-08-13 12:08:05', NULL, NULL, NULL, '2018-08-13 12:08:05', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` longtext,
  `address2` longtext,
  `zip` varchar(20) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `name`, `contact`, `email`, `address`, `address2`, `zip`, `city_id`, `state_id`, `is_active`, `created_time`) VALUES
(1, 4, 'Bijendra', '9876543211', 'bijendra@gmail.com', 'address', 'address2', '482003', 99, 85, 1, '2018-06-11 13:13:21'),
(2, 16, 'Bijendra', '7894561230', 'bijendra1@gmail.com', 'Jabalpur Garha', NULL, NULL, NULL, NULL, 1, '2018-06-19 07:10:41'),
(3, 4, 'lpkj', 'jk', NULL, 'hnkj', 'jk', 'kjbj', 12, 63, 1, '2018-07-02 07:19:18'),
(4, 4, 'Anshul', '9876543210', NULL, 'Garha', 'Jabalpur', '482003', 6, 1, 1, '2018-07-02 07:27:21'),
(5, 4, 'Test', '9876543210', NULL, 'Garha', 'Jabalpur', '482003', 336, 18, 1, '2018-07-02 07:31:11'),
(6, 4, 'Test', '9876543210', NULL, 'Garha', 'Jabalpur', '482003', 336, 18, 1, '2018-07-02 07:43:41'),
(8, 1, 'abc', '9876543210', 'abc@gmail.com', 'garha', 'jbp', '482003', 304, 99, 1, '2018-07-04 10:08:47'),
(9, 4, 'sda', 'dsa', 'dsa@fasd', 'dsa', NULL, NULL, 552, NULL, 1, '2018-07-14 06:51:34'),
(10, 4, 'Aditya', '8989898989', 'aditya@gmail.com', 'Garha Jabalpur', NULL, '898998', 304, 304, 1, '2018-08-10 07:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_bank_details`
--

CREATE TABLE `user_bank_details` (
  `Id` int(200) NOT NULL,
  `account_holder` varchar(50) DEFAULT NULL,
  `ac_number` varchar(50) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `aadhar_pan` varchar(50) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_future_use` tinyint(1) DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ifsc_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_bank_details`
--

INSERT INTO `user_bank_details` (`Id`, `account_holder`, `ac_number`, `bank`, `aadhar_pan`, `is_active`, `is_future_use`, `user_id`, `created_at`, `ifsc_code`) VALUES
(21, '1', '2', '3', '5', 1, 0, '26', '2018-04-17 09:15:19', '5'),
(22, '2', '22', '2', '2', 1, 0, '26', '2018-04-17 09:15:47', '2'),
(23, '2', '223', '2', '2', 1, 0, '26', '2018-04-17 09:16:36', '2'),
(24, '2', '2233', '2', '2', 1, 0, '26', '2018-04-17 09:16:54', '2'),
(25, 'w', 'www', '1', '12', 1, 0, '26', '2018-04-17 09:20:01', '1'),
(26, '1', '212', '3', 'dgfd', 1, 1, '26', '2018-04-17 09:22:46', '4'),
(27, '1', '21234', '3', 'dgfd', 1, 1, '26', '2018-04-17 09:27:03', '4'),
(28, '1', '2123456', '3', 'dgfd', 1, 1, '26', '2018-04-17 09:27:51', '4'),
(29, 'Test', '133', 'SBI', '123456789321456', 1, 1, '39', '2018-04-18 06:23:15', 'gfshg454'),
(30, NULL, NULL, NULL, NULL, 1, 0, '39', '2018-04-18 06:27:19', NULL),
(31, 'Amit Singh', '564564564564', 'SBI', '5645645646456', 1, 1, '2', '2018-04-19 07:56:19', 'SBI1234'),
(32, 'Devansh', '123456', 'sbi', NULL, 1, 1, '4', '2018-04-19 14:05:52', 'sbi12345'),
(33, NULL, NULL, NULL, NULL, 1, 0, '2', '2018-05-17 07:58:49', NULL),
(34, 'csa', 'sca', NULL, NULL, 1, 0, '2', '2018-05-17 08:20:01', NULL),
(35, 'dasc', 'dsf', 'fdas', 'fdas', 1, 0, '2', '2018-05-17 08:24:04', 'fsa');

-- --------------------------------------------------------

--
-- Table structure for table `user_comm`
--

CREATE TABLE `user_comm` (
  `com_id` int(11) NOT NULL,
  `com_first` int(11) NOT NULL,
  `com_sec` int(11) NOT NULL,
  `com_call` int(11) NOT NULL DEFAULT '0' COMMENT 'o for no call 1 for call',
  `com_call_rec` int(11) NOT NULL DEFAULT '0' COMMENT '0 for not on call 1 on call',
  `com_call_inis` int(11) DEFAULT NULL COMMENT '0 for no call and id  of call initiater   ',
  `com_call_window_opend` int(11) NOT NULL DEFAULT '0' COMMENT 'o for no  call 1 for call window opend'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_comm`
--

INSERT INTO `user_comm` (`com_id`, `com_first`, `com_sec`, `com_call`, `com_call_rec`, `com_call_inis`, `com_call_window_opend`) VALUES
(1, 5, 2, 0, 0, 0, 0),
(2, 5, 3, 0, 0, 0, 0),
(3, 5, 4, 0, 0, 0, 0),
(4, 5, 1, 0, 0, 0, 0),
(5, 2, 1, 0, 0, 1, 1),
(6, 2, 3, 1, 0, 2, 0),
(7, 6, 1, 0, 0, 0, 0),
(8, 6, 2, 0, 0, 0, 0),
(9, 7, 6, 0, 0, 0, 0),
(10, 7, 3, 0, 0, 0, 0),
(11, 7, 4, 0, 0, 0, 0),
(12, 1, 3, 0, 0, 0, 0),
(13, 2, 4, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_setting`
--

CREATE TABLE `user_setting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_privacy` enum('everyone','friends') DEFAULT 'everyone',
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_survey_amount`
--

CREATE TABLE `user_survey_amount` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amt` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_survey_amount`
--

INSERT INTO `user_survey_amount` (`id`, `survey_id`, `user_id`, `amt`) VALUES
(1, 1, 4, 0.1),
(2, 2, 4, 0.2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_ads`
--
ALTER TABLE `admin_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads_clicked`
--
ALTER TABLE `ads_clicked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_category`
--
ALTER TABLE `ad_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_images`
--
ALTER TABLE `ad_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_likes_user_id_foreign` (`user_id`),
  ADD KEY `comment_likes_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `coms`
--
ALTER TABLE `coms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_master`
--
ALTER TABLE `item_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_post_id_foreign` (`post_id`),
  ADD KEY `notifications_timeline_id_foreign` (`timeline_id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_notified_by_foreign` (`notified_by`);

--
-- Indexes for table `notification_clicked`
--
ALTER TABLE `notification_clicked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_description`
--
ALTER TABLE `order_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panic_contact`
--
ALTER TABLE `panic_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paytm`
--
ALTER TABLE `paytm`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `paytm_link`
--
ALTER TABLE `paytm_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payu_payments`
--
ALTER TABLE `payu_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_timeline_id_foreign` (`timeline_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_follows`
--
ALTER TABLE `post_follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_follows_post_id_foreign` (`post_id`),
  ADD KEY `post_follows_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_likes_post_id_foreign` (`post_id`),
  ADD KEY `post_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_media`
--
ALTER TABLE `post_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_media_post_id_foreign` (`post_id`),
  ADD KEY `post_media_media_id_foreign` (`media_url`);

--
-- Indexes for table `post_spam`
--
ALTER TABLE `post_spam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tags_post_id_foreign` (`post_id`),
  ADD KEY `post_tags_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_unlike`
--
ALTER TABLE `post_unlike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem_masters`
--
ALTER TABLE `redeem_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_count`
--
ALTER TABLE `survey_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `timelines_username_unique` (`username`),
  ADD KEY `timelines_avatar_id_foreign` (`avatar_id`),
  ADD KEY `timelines_cover_id_foreign` (`cover_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_timeline_id_foreign` (`timeline_id`),
  ADD KEY `users_affiliate_id_foreign` (`affiliate_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bank_details`
--
ALTER TABLE `user_bank_details`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_comm`
--
ALTER TABLE `user_comm`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `user_setting`
--
ALTER TABLE `user_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_survey_amount`
--
ALTER TABLE `user_survey_amount`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_ads`
--
ALTER TABLE `admin_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_master`
--
ALTER TABLE `admin_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ads_clicked`
--
ALTER TABLE `ads_clicked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ad_category`
--
ALTER TABLE `ad_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ad_images`
--
ALTER TABLE `ad_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coms`
--
ALTER TABLE `coms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `item_master`
--
ALTER TABLE `item_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification_clicked`
--
ALTER TABLE `notification_clicked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_description`
--
ALTER TABLE `order_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `panic_contact`
--
ALTER TABLE `panic_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paytm`
--
ALTER TABLE `paytm`
  MODIFY `Id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `paytm_link`
--
ALTER TABLE `paytm_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payu_payments`
--
ALTER TABLE `payu_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `post_follows`
--
ALTER TABLE `post_follows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `post_media`
--
ALTER TABLE `post_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `post_spam`
--
ALTER TABLE `post_spam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_unlike`
--
ALTER TABLE `post_unlike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `redeem_masters`
--
ALTER TABLE `redeem_masters`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_count`
--
ALTER TABLE `survey_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timelines`
--
ALTER TABLE `timelines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_bank_details`
--
ALTER TABLE `user_bank_details`
  MODIFY `Id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_comm`
--
ALTER TABLE `user_comm`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_setting`
--
ALTER TABLE `user_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_survey_amount`
--
ALTER TABLE `user_survey_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
