-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 05:31 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ds_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` int(10) UNSIGNED NOT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depart` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packages` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `itinerary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `release` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `number`, `destination`, `depart`, `return`, `school`, `packages`, `icon`, `itinerary`, `release`, `message`, `created_at`, `updated_at`) VALUES
(6, 1703, 'London, UK', '05/10/2017', '05/20/2017', 'St. Mary\'s Academy', '[{"name":"Single","cost":"1800.00"},{"name":"Double","cost":"2500.00"},{"name":"Triple","cost":"3200.00"}]', 'storage/icons/londonTIME1508635516EXT.jpg', 'storage/itineraries/1703/dragaudcustomsojourns-1703-itinerary.doc', 'storage/releases/1703/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:30:57', '2017-10-23 11:30:57'),
(5, 1702, 'Athens, GR', '04/05/2017', '04/15/2017', 'Ellison Academy', '[{"name":"Single","cost":"2600.00"},{"name":"Double","cost":"3200.00"}]', 'storage/icons/greeceTIME1508635519EXT.jpg', 'storage/itineraries/1702/dragaudcustomsojourns-1702-itinerary.doc', 'storage/releases/1702/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:28:11', '2017-10-23 11:28:11'),
(4, 1701, 'New York, NY', '03/01/2017', '03/11/2017', 'East Dallas High School', '[{"name":"Single","cost":"2200.00"},{"name":"Double","cost":"2600.00"},{"name":"Triple","cost":"3200.00"}]', 'storage/icons/libertyTIME1508638128EXT.jpg', 'storage/itineraries/1701/dragaudcustomsojourns-1701-itinerary.doc', 'storage/releases/1701/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:25:02', '2017-10-23 11:25:02'),
(7, 1704, 'Paris, FR', '06/14/2017', '07/19/2017', 'East Dallas High School', '[{"name":"Single","cost":"2500.00"},{"name":"Double","cost":"2800.00"},{"name":"Triple","cost":"3500.00"}]', 'storage/icons/parisTIME1508638089EXT.jpg', 'storage/itineraries/1804/dragaudcustomsojourns-1804-itinerary.doc', 'storage/releases/1804/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:32:03', '2017-10-23 11:32:03'),
(8, 1705, 'Rome, IT', '07/26/2017', '08/03/2017', 'Austin Central High', '[{"name":"Single","cost":"5000.00"},{"name":"Double","cost":"6500.00"},{"name":"Triple","cost":"7200.00"}]', 'storage/icons/romeTIME1508639751EXT.jpg', 'storage/itineraries/1705/dragaudcustomsojourns-1705-itinerary.doc', 'storage/releases/1705/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:35:01', '2017-10-23 11:35:01'),
(9, 1706, 'Tokyo, JP', '08/31/2017', '09/07/2017', 'Journey Academy', '[{"name":"Single","cost":"3500.00"},{"name":"Double","cost":"4100.00"}]', 'storage/icons/japanTIME1508639411EXT.jpg', 'storage/itineraries/1706/dragaudcustomsojourns-1706-itinerary.doc', 'storage/releases/1706/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:36:25', '2017-10-23 11:36:25'),
(10, 1707, 'London, UK', '09/21/2017', '09/29/2017', 'East Dallas High School', '[{"name":"Single","cost":"2200.00"},{"name":"Double","cost":"2600.00"},{"name":"Triple","cost":"3200.00"}]', 'storage/icons/londonTIME1508635516EXT.jpg', 'storage/itineraries/1707/dragaudcustomsojourns-1707-itinerary.doc', 'storage/releases/1707/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:37:45', '2017-10-23 11:37:45'),
(11, 1708, 'Honolulu, HI', '10/10/2017', '10/20/2017', 'St. Mary\'s Academy', '[{"name":"Single","cost":"2800.00"},{"name":"Double","cost":"3400.00"},{"name":"Triple","cost":"4100.00"}]', 'storage/icons/hawaiiTIME1508640679EXT.jpg', 'storage/itineraries/1708/dragaudcustomsojourns-1708-itinerary.doc', 'storage/releases/1708/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:41:00', '2017-10-23 11:41:00'),
(12, 1709, 'St. Petersburg, RU', '11/08/2017', '11/15/2017', 'Austin Central High', '[{"name":"Single","cost":"5600.00"},{"name":"Double","cost":"6200.00"}]', 'storage/icons/russiaTIME1508641078EXT.jpg', 'storage/itineraries/1709/dragaudcustomsojourns-1709-itinerary.doc', 'storage/releases/1709/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:43:30', '2017-10-23 11:43:30'),
(13, 1710, 'Dubai, UA', '12/01/2017', '12/13/2017', 'Ellison Academy', '[{"name":"Single","cost":"2600.00"},{"name":"Double","cost":""}]', 'storage/icons/dubaiTIME1508651014EXT.jpg', 'storage/itineraries/1710/dragaudcustomsojourns-1710-itinerary.doc', 'storage/releases/1710/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:44:58', '2017-10-23 11:44:58'),
(14, 1801, 'Rio De Janeiro, BR', '01/18/2018', '01/23/2018', 'Ellison Academy', '[{"name":"Single","cost":"2800.00"},{"name":"Double","cost":"3200.00"},{"name":"Triple","cost":""}]', 'storage/icons/rioTIME1508638079EXT.jpg', 'storage/itineraries/1801/dragaudcustomsojourns-1801-itinerary.doc', 'storage/releases/1801/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:47:19', '2017-10-23 11:47:19'),
(15, 1802, 'New York, NY', '02/08/2018', '02/14/2018', 'St. Mary\'s Academy', '[{"name":"Single","cost":"2200.00"},{"name":"Double","cost":"2600.00"},{"name":"Triple","cost":"3200.00"}]', 'storage/icons/newyorkTIME1508638044EXT.jpg', 'storage/itineraries/1802/dragaudcustomsojourns-1802-itinerary.doc', 'storage/releases/1802/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 11:49:54', '2017-10-23 11:49:54'),
(16, 1803, 'San Francisco, CA', '04/20/2018', '04/30/2018', 'Journey Academy', '[{"name":"Single","cost":"2500.00"},{"name":"Double","cost":"3000.00"},{"name":"Triple","cost":"3550.00"}]', 'storage/icons/sanfranTIME1508638886EXT.jpg', 'storage/itineraries/1803/dragaudcustomsojourns-1803-itinerary.doc', 'storage/releases/1803/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 12:04:22', '2017-10-23 12:04:22'),
(17, 1804, 'Washington DC', '05/04/2018', '05/12/2018', 'East Dallas High School', '[{"name":"Single","cost":"2500.00"},{"name":"Double","cost":"3200.00"}]', 'storage/icons/wash-dcTIME1508718884EXT.jpg', 'storage/itineraries/1804/dragaudcustomsojourns-1804-itinerary.doc', 'storage/releases/1804/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 12:06:12', '2017-10-23 12:06:12'),
(18, 1805, 'London, UK', '05/31/2018', '06/20/2018', 'Ellison Academy', '[{"name":"Single","cost":"2500.00"},{"name":"Double","cost":"2800.00"},{"name":"Triple","cost":"3500.00"}]', 'storage/icons/londonTIME1508635516EXT.jpg', 'storage/itineraries/1805/dragaudcustomsojourns-1805-itinerary.doc', 'storage/releases/1805/dragaudcustomsojourns-terms-of-agreement.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', '2017-10-23 12:07:13', '2017-10-23 12:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_09_25_084433_create_travelers_table', 1),
(4, '2017_10_10_224426_create_groups_table', 1),
(5, '2017_10_11_015829_create_trips_table', 1),
(6, '2017_10_14_014934_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `paypal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `amount` decimal(13,2) NOT NULL,
  `fee` decimal(13,2) NOT NULL,
  `balance` decimal(13,2) NOT NULL,
  `verification` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `paypal_id`, `method`, `user_id`, `trip_id`, `amount`, `fee`, `balance`, `verification`, `created_at`, `updated_at`) VALUES
(4, '1508745534378', 'credit', 1, 4, '50.00', '10.00', '2100.00', 1508745534, '2017-10-23 13:58:54', '2017-10-23 13:58:54'),
(5, '1508745579294', 'paypal', 1, 4, '500.00', '0.00', '1600.00', 1508745579, '2017-10-23 13:59:39', '2017-10-23 13:59:39'),
(6, '1508745778060', 'paypal', 1, 4, '800.00', '0.00', '800.00', 1508745778, '2017-10-23 14:02:58', '2017-10-23 14:02:58'),
(7, '1508745800783', 'credit', 1, 4, '800.00', '20.00', '0.00', 1508745800, '2017-10-23 14:03:20', '2017-10-23 14:03:20'),
(8, '1508745871776', 'paypal', 1, 5, '1650.00', '0.00', '950.00', 1508745871, '2017-10-23 14:04:31', '2017-10-23 14:04:31'),
(9, '1508745890454', 'credit', 1, 5, '950.00', '20.00', '0.00', 1508745890, '2017-10-23 14:04:50', '2017-10-23 14:04:50'),
(10, '1508746024371', 'credit', 1, 7, '2200.00', '20.00', '4300.00', 1508746024, '2017-10-23 14:07:04', '2017-10-23 14:07:04'),
(11, '1508746038149', 'paypal', 1, 6, '1500.00', '0.00', '3500.00', 1508746038, '2017-10-23 14:07:18', '2017-10-23 14:07:18'),
(12, '1508746077892', 'paypal', 1, 7, '2550.00', '0.00', '1750.00', 1508746078, '2017-10-23 14:07:58', '2017-10-23 14:07:58'),
(13, '1508746201573', 'credit', 1, 7, '1750.00', '20.00', '0.00', 1508746201, '2017-10-23 14:10:01', '2017-10-23 14:10:01'),
(14, '1508746226448', 'paypal', 1, 6, '3500.00', '0.00', '0.00', 1508746226, '2017-10-23 14:10:26', '2017-10-23 14:10:26'),
(15, '1508746512221', 'paypal', 2, 9, '1600.00', '0.00', '1600.00', 1508746512, '2017-10-23 14:15:12', '2017-10-23 14:15:12'),
(16, '1508746538141', 'credit', 2, 8, '1300.00', '20.00', '1300.00', 1508746538, '2017-10-23 14:15:38', '2017-10-23 14:15:38'),
(17, '1508746556363', 'paypal', 2, 9, '1600.00', '0.00', '0.00', 1508746556, '2017-10-23 14:15:56', '2017-10-23 14:15:56'),
(18, '1508746586278', 'credit', 2, 8, '700.00', '20.00', '600.00', 1508746586, '2017-10-23 14:16:26', '2017-10-23 14:16:26'),
(19, '1508746599932', 'paypal', 2, 8, '600.00', '0.00', '0.00', 1508746600, '2017-10-23 14:16:40', '2017-10-23 14:16:40'),
(20, '1508746628798', 'paypal', 2, 11, '600.00', '0.00', '2600.00', 1508746628, '2017-10-23 14:17:09', '2017-10-23 14:17:09'),
(21, '1508746645979', 'paypal', 2, 10, '500.00', '0.00', '2300.00', 1508746646, '2017-10-23 14:17:26', '2017-10-23 14:17:26'),
(22, '1508746820480', 'paypal', 3, 13, '1600.00', '0.00', '1800.00', 1508746820, '2017-10-23 14:20:20', '2017-10-23 14:20:20'),
(23, '1508746833320', 'paypal', 3, 12, '1800.00', '0.00', '1600.00', 1508746833, '2017-10-23 14:20:33', '2017-10-23 14:20:33'),
(24, '1508746843846', 'paypal', 3, 13, '1800.00', '0.00', '0.00', 1508746844, '2017-10-23 14:20:44', '2017-10-23 14:20:44'),
(25, '1508746861149', 'paypal', 3, 12, '1200.00', '0.00', '400.00', 1508746861, '2017-10-23 14:21:01', '2017-10-23 14:21:01'),
(26, '1508746944146', 'credit', 3, 14, '1750.00', '20.00', '1450.00', 1508746944, '2017-10-23 14:22:24', '2017-10-23 14:22:24'),
(27, '1508747163701', 'paypal', 4, 15, '1740.00', '0.00', '760.00', 1508747163, '2017-10-23 14:26:03', '2017-10-23 14:26:03'),
(28, '1508747192247', 'credit', 4, 16, '1600.00', '20.00', '1200.00', 1508747192, '2017-10-23 14:26:32', '2017-10-23 14:26:32'),
(29, '1508747208204', 'paypal', 4, 15, '760.00', '0.00', '0.00', 1508747208, '2017-10-23 14:26:48', '2017-10-23 14:26:48'),
(30, '1508747245396', 'paypal', 4, 16, '1200.00', '0.00', '0.00', 1508747245, '2017-10-23 14:27:25', '2017-10-23 14:27:25'),
(31, '1508747306815', 'paypal', 4, 17, '600.00', '0.00', '2600.00', 1508747307, '2017-10-23 14:28:27', '2017-10-23 14:28:27'),
(32, '1508747330109', 'credit', 4, 18, '950.00', '20.00', '2250.00', 1508747330, '2017-10-23 14:28:50', '2017-10-23 14:28:50'),
(33, '1508747407633', 'credit', 4, 20, '1100.00', '20.00', '1500.00', 1508747407, '2017-10-23 14:30:07', '2017-10-23 14:30:07'),
(34, '1508747433442', 'paypal', 4, 20, '1500.00', '0.00', '0.00', 1508747433, '2017-10-23 14:30:33', '2017-10-23 14:30:33'),
(35, '1508747472076', 'credit', 4, 19, '680.00', '20.00', '1520.00', 1508747472, '2017-10-23 14:31:12', '2017-10-23 14:31:12'),
(36, '1508747488789', 'paypal', 4, 19, '1500.00', '0.00', '20.00', 1508747488, '2017-10-23 14:31:28', '2017-10-23 14:31:28'),
(37, '1508747532603', 'paypal', 4, 19, '20.00', '0.00', '0.00', 1508747532, '2017-10-23 14:32:12', '2017-10-23 14:32:12'),
(38, '1508748017674', 'paypal', 5, 22, '1500.00', '0.00', '1100.00', 1508748017, '2017-10-23 14:40:17', '2017-10-23 14:40:17'),
(39, '1508748049980', 'credit', 5, 21, '550.00', '20.00', '2050.00', 1508748050, '2017-10-23 14:40:50', '2017-10-23 14:40:50'),
(40, '1508748084258', 'paypal', 5, 22, '600.00', '0.00', '500.00', 1508748084, '2017-10-23 14:41:24', '2017-10-23 14:41:24'),
(41, '1508748094096', 'paypal', 5, 21, '550.00', '0.00', '1500.00', 1508748094, '2017-10-23 14:41:34', '2017-10-23 14:41:34'),
(42, '1508748236265', 'paypal', 5, 25, '650.00', '0.00', '2550.00', 1508748236, '2017-10-23 14:43:56', '2017-10-23 14:43:56'),
(43, '1508748249748', 'paypal', 5, 24, '900.00', '0.00', '1900.00', 1508748249, '2017-10-23 14:44:09', '2017-10-23 14:44:09'),
(44, '1508748277114', 'credit', 5, 23, '900.00', '20.00', '2300.00', 1508748277, '2017-10-23 14:44:37', '2017-10-23 14:44:37'),
(45, '1508748517266', 'paypal', 6, 26, '2200.00', '0.00', '1300.00', 1508748517, '2017-10-23 14:48:37', '2017-10-23 14:48:37'),
(46, '1508748527709', 'paypal', 6, 27, '1750.00', '0.00', '1750.00', 1508748527, '2017-10-23 14:48:47', '2017-10-23 14:48:47'),
(47, '1508748544699', 'credit', 6, 27, '1700.00', '20.00', '50.00', 1508748544, '2017-10-23 14:49:04', '2017-10-23 14:49:04'),
(48, '1508748560013', 'paypal', 6, 26, '1300.00', '0.00', '0.00', 1508748560, '2017-10-23 14:49:20', '2017-10-23 14:49:20'),
(49, '1508748579193', 'paypal', 6, 27, '0.02', '0.00', '49.98', 1508748579, '2017-10-23 14:49:39', '2017-10-23 14:49:39'),
(50, '1508748593014', 'paypal', 6, 27, '49.00', '0.00', '0.98', 1508748593, '2017-10-23 14:49:53', '2017-10-23 14:49:53'),
(51, '1508748610248', 'paypal', 6, 27, '0.98', '0.00', '0.00', 1508748610, '2017-10-23 14:50:10', '2017-10-23 14:50:10'),
(52, '1508748622331', 'paypal', 6, 29, '600.00', '0.00', '2950.00', 1508748622, '2017-10-23 14:50:22', '2017-10-23 14:50:22'),
(53, '1508748631999', 'paypal', 6, 28, '550.00', '0.00', '2450.00', 1508748632, '2017-10-23 14:50:32', '2017-10-23 14:50:32'),
(54, '1508748815617', 'credit', 7, 30, '950.00', '20.00', '850.00', 1508748815, '2017-10-23 14:53:35', '2017-10-23 14:53:35'),
(55, '1508748825044', 'paypal', 7, 30, '850.00', '0.00', '0.00', 1508748825, '2017-10-23 14:53:45', '2017-10-23 14:53:45'),
(56, '1508749231661', 'paypal', 8, 33, '4400.00', '0.00', '1800.00', 1508749231, '2017-10-23 15:00:31', '2017-10-23 15:00:31'),
(57, '1508749242441', 'paypal', 8, 32, '3600.00', '0.00', '2600.00', 1508749242, '2017-10-23 15:00:42', '2017-10-23 15:00:42'),
(58, '1508749261569', 'paypal', 8, 33, '1800.00', '0.00', '0.00', 1508749261, '2017-10-23 15:01:01', '2017-10-23 15:01:01'),
(59, '1508749305599', 'credit', 8, 32, '590.00', '20.00', '2010.00', 1508749305, '2017-10-23 15:01:45', '2017-10-23 15:01:45'),
(60, '1508749316177', 'paypal', 8, 32, '100.00', '0.00', '1910.00', 1508749316, '2017-10-23 15:01:56', '2017-10-23 15:01:56'),
(61, '1508749329924', 'paypal', 8, 31, '3200.00', '0.00', '2400.00', 1508749330, '2017-10-23 15:02:10', '2017-10-23 15:02:10'),
(62, '1508749902931', 'paypal', 9, 35, '2500.00', '0.00', '0.00', 1508749903, '2017-10-23 15:11:43', '2017-10-23 15:11:43'),
(63, '1508749912330', 'paypal', 9, 34, '3400.00', '0.00', '0.00', 1508749912, '2017-10-23 15:11:52', '2017-10-23 15:11:52'),
(64, '1508749931376', 'paypal', 9, 37, '550.00', '0.00', '1650.00', 1508749931, '2017-10-23 15:12:11', '2017-10-23 15:12:11'),
(65, '1508749940819', 'paypal', 9, 36, '650.00', '0.00', '1550.00', 1508749941, '2017-10-23 15:12:21', '2017-10-23 15:12:21'),
(66, '1508750253915', 'credit', 10, 40, '3500.00', '20.00', '0.00', 1508750254, '2017-10-23 15:17:34', '2017-10-23 15:17:34'),
(67, '1508750275872', 'credit', 10, 39, '2800.00', '20.00', '0.00', 1508750276, '2017-10-23 15:17:56', '2017-10-23 15:17:56'),
(68, '1508750284900', 'paypal', 10, 38, '2500.00', '0.00', '0.00', 1508750285, '2017-10-23 15:18:05', '2017-10-23 15:18:05'),
(69, '1508750389401', 'paypal', 11, 41, '2600.00', '0.00', '0.00', 1508750389, '2017-10-23 15:19:49', '2017-10-23 15:19:49'),
(70, '1508750563421', 'paypal', 12, 43, '3600.00', '0.00', '3600.00', 1508750563, '2017-10-23 15:22:43', '2017-10-23 15:22:43'),
(71, '1508750572561', 'paypal', 12, 43, '1800.00', '0.00', '1800.00', 1508750572, '2017-10-23 15:22:52', '2017-10-23 15:22:52'),
(72, '1508750588642', 'credit', 12, 43, '1800.00', '20.00', '0.00', 1508750588, '2017-10-23 15:23:08', '2017-10-23 15:23:08'),
(73, '1508750772213', 'paypal', 13, 46, '2500.00', '0.00', '0.00', 1508750772, '2017-10-23 15:26:12', '2017-10-23 15:26:12'),
(74, '1508750788529', 'credit', 13, 45, '2250.00', '20.00', '1850.00', 1508750788, '2017-10-23 15:26:28', '2017-10-23 15:26:28'),
(75, '1508750801591', 'paypal', 13, 45, '1850.00', '0.00', '0.00', 1508750801, '2017-10-23 15:26:41', '2017-10-23 15:26:41'),
(76, '1508750811705', 'paypal', 13, 44, '2600.00', '0.00', '0.00', 1508750811, '2017-10-23 15:26:51', '2017-10-23 15:26:51'),
(77, '1508750951665', 'credit', 14, 47, '2200.00', '20.00', '0.00', 1508750951, '2017-10-23 15:29:11', '2017-10-23 15:29:11'),
(78, '1508751083814', 'paypal', 15, 49, '600.00', '0.00', '5000.00', 1508751084, '2017-10-23 15:31:24', '2017-10-23 15:31:24'),
(79, '1508751094735', 'paypal', 15, 48, '880.00', '0.00', '4720.00', 1508751094, '2017-10-23 15:31:34', '2017-10-23 15:31:34'),
(80, '1508751291849', 'paypal', 16, 50, '2200.00', '0.00', '0.00', 1508751292, '2017-10-23 15:34:52', '2017-10-23 15:34:52'),
(81, '1508751302627', 'paypal', 16, 51, '5950.00', '0.00', '250.00', 1508751302, '2017-10-23 15:35:02', '2017-10-23 15:35:02'),
(82, '1508751326555', 'credit', 16, 52, '2500.00', '20.00', '1000.00', 1508751326, '2017-10-23 15:35:26', '2017-10-23 15:35:26'),
(83, '1508751335861', 'paypal', 16, 52, '1000.00', '0.00', '0.00', 1508751336, '2017-10-23 15:35:36', '2017-10-23 15:35:36'),
(84, '1508751465621', 'credit', 17, 53, '5600.00', '20.00', '0.00', 1508751465, '2017-10-23 15:37:45', '2017-10-23 15:37:45'),
(85, '1508751591946', 'paypal', 18, 54, '1800.00', '0.00', '1400.00', 1508751592, '2017-10-23 15:39:52', '2017-10-23 15:39:52'),
(86, '1508751616121', 'paypal', 18, 54, '1400.00', '0.00', '0.00', 1508751616, '2017-10-23 15:40:16', '2017-10-23 15:40:16'),
(87, '1508751776500', 'credit', 19, 56, '2600.00', '20.00', '0.00', 1508751776, '2017-10-23 15:42:56', '2017-10-23 15:42:56'),
(88, '1508751784668', 'paypal', 19, 55, '2600.00', '0.00', '0.00', 1508751784, '2017-10-23 15:43:04', '2017-10-23 15:43:04'),
(89, '1508751962581', 'paypal', 20, 58, '1800.00', '0.00', '0.00', 1508751962, '2017-10-23 15:46:02', '2017-10-23 15:46:02'),
(90, '1508751977811', 'credit', 20, 57, '2500.00', '20.00', '0.00', 1508751978, '2017-10-23 15:46:18', '2017-10-23 15:46:18'),
(91, '1508772875028', 'paypal', 21, 59, '900.00', '0.00', '1900.00', 1508772875, '2017-10-23 21:34:35', '2017-10-23 21:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `travelers`
--

CREATE TABLE `travelers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travelers`
--

INSERT INTO `travelers` (`id`, `name`, `gender`, `relationship`, `emerg_name`, `emerg_phone`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Dean Martin', 'Male', 'Other', 'Cindy Lauper', '(808)888-8888', 1, '2017-10-22 09:15:19', '2017-10-22 09:15:19'),
(2, 'Josh Van Natta', 'Male', 'Myself', 'Marianne Van Natta', '(555)555-5555', 1, '2017-10-22 09:15:19', '2017-10-22 09:15:19'),
(3, 'Gregory Gonzales', 'Male', 'Family', 'Rose Gonzales', '(898)158-1888', 2, '2017-10-23 14:12:49', '2017-10-23 14:12:49'),
(4, 'Trevor Gonzales', 'Male', 'Family', 'Rose Gonzales', '(561)658-5551', 2, '2017-10-23 14:12:49', '2017-10-23 14:12:49'),
(5, 'Stacy Johson', 'Female', 'Spouse', 'Irma Johnson', '(809)805-6105', 3, '2017-10-23 14:19:07', '2017-10-23 14:19:07'),
(6, 'Ted Johnson', 'Male', 'Myself', 'Irma Johnson', '(123)513-1381', 3, '2017-10-23 14:19:07', '2017-10-23 14:19:07'),
(7, 'Tracy Johson', 'Female', 'Family', 'Ted Johnson', '(848)165-5188', 3, '2017-10-23 14:21:34', '2017-10-23 14:21:34'),
(8, 'Fred Wilson', 'Male', 'Family', 'Gina Wilson', '(809)120-5085', 4, '2017-10-23 14:23:54', '2017-10-23 14:23:54'),
(9, 'Roger Wilson', 'Male', 'Family', 'Gina Wilson', '(808)080-8505', 4, '2017-10-23 14:23:54', '2017-10-23 14:23:54'),
(10, 'Steven O\'Neal', 'Male', 'Family', 'Patricia O\'Neal', '(125)051-8050', 5, '2017-10-23 14:37:55', '2017-10-23 14:37:55'),
(11, 'Patricia O\'Neal', 'Female', 'Myself', 'Al O\'Neal', '(505)818-0555', 5, '2017-10-23 14:37:55', '2017-10-23 14:37:55'),
(12, 'Phillip Glass', 'Male', 'Spouse', 'Al O\'Neal', '(150)885-0889', 5, '2017-10-23 14:37:55', '2017-10-23 14:37:55'),
(13, 'Hugh Nguyen', 'Male', 'Family', 'Danielle Nguyen', '(500)801-5015', 6, '2017-10-23 14:46:50', '2017-10-23 14:46:50'),
(14, 'Selena Nguyen', 'Female', 'Family', 'Danielle Nguyen', '(123)550-8088', 6, '2017-10-23 14:46:50', '2017-10-23 14:46:50'),
(15, 'Trevor Wise', 'Male', 'Family', 'Robert Wise', '(805)088-0555', 7, '2017-10-23 14:52:55', '2017-10-23 14:52:55'),
(16, 'Janice Dickenson', 'Female', 'Myself', 'Tandy Dickenson', '(805)150-8088', 8, '2017-10-23 14:58:42', '2017-10-23 14:58:42'),
(17, 'Spiro Dickenson', 'Male', 'Family', 'Ian Spears', '(805)058-0888', 8, '2017-10-23 14:58:42', '2017-10-23 14:58:42'),
(18, 'Clara Dickenson', 'Female', 'Family', 'Ian Spears', '(805)058-0888', 8, '2017-10-23 14:58:42', '2017-10-23 14:58:42'),
(19, 'Gary Palmer', 'Female', 'Family', 'Sam Palmer', '(722)050-8085', 9, '2017-10-23 15:04:15', '2017-10-23 15:04:15'),
(20, 'Glen Palmer', 'Male', 'Family', 'Sam Palmer', '(722)080-8050', 9, '2017-10-23 15:04:15', '2017-10-23 15:04:15'),
(21, 'Stanley Marlowe', 'Male', 'Family', 'Hugh Marlowe', '(805)556-0900', 10, '2017-10-23 15:15:27', '2017-10-23 15:15:27'),
(22, 'Ben Marlowe', 'Male', 'Family', 'Hugh Marlowe', '(855)508-0590', 10, '2017-10-23 15:15:27', '2017-10-23 15:15:27'),
(23, 'Hugh Marlowe', 'Male', 'Myself', 'Hugh Marlowe', '(808)505-9098', 10, '2017-10-23 15:15:27', '2017-10-23 15:15:27'),
(24, 'Ashley North', 'Female', 'Other', 'Edmond North', '(805)080-4877', 11, '2017-10-23 15:19:22', '2017-10-23 15:19:22'),
(25, 'Edmond North', 'Male', 'Myself', 'Cindy North', '(809)909-5002', 11, '2017-10-23 15:20:24', '2017-10-23 15:20:24'),
(26, 'Kathy Sherwood', 'Female', 'Myself', 'Glenn Sherwood', '(808)528-5555', 12, '2017-10-23 15:22:15', '2017-10-23 15:22:15'),
(27, 'Sandy Manson', 'Female', 'Other', 'Maurice Manson', '(805)909-0950', 13, '2017-10-23 15:25:20', '2017-10-23 15:25:20'),
(28, 'Marilyn Manson', 'Other', 'Other', 'Lucifer', '(666)666-6666', 13, '2017-10-23 15:25:20', '2017-10-23 15:25:20'),
(29, 'Harambe', 'Female', 'Other', 'Crocadile Dundee', '(809)990-0098', 14, '2017-10-23 15:28:42', '2017-10-23 15:28:42'),
(30, 'John Ross', 'Male', 'Spouse', 'Art Ross', '(850)848-1855', 15, '2017-10-23 15:30:43', '2017-10-23 15:30:43'),
(31, 'Arthur Ross', 'Male', 'Myself', 'Harambe', '(889)592-9090', 15, '2017-10-23 15:30:43', '2017-10-23 15:30:43'),
(32, 'Bill Almond', 'Male', 'Spouse', 'Granny Almond', '(805)580-8884', 16, '2017-10-23 15:33:51', '2017-10-23 15:33:51'),
(33, 'Phil Almond', 'Male', 'Spouse', 'Granny Almond', '(852)584-1111', 16, '2017-10-23 15:33:51', '2017-10-23 15:33:51'),
(34, 'Gil Almond', 'Male', 'Spouse', 'Granny Almond', '(805)591-0911', 16, '2017-10-23 15:33:51', '2017-10-23 15:33:51'),
(35, 'Tim Morrow', 'Male', 'Family', 'Jeff Morrow', '(805)508-0848', 17, '2017-10-23 15:37:07', '2017-10-23 15:37:07'),
(36, 'Smee Snowden', 'Male', 'Myself', 'Leigh Snowden', '(780)805-5880', 18, '2017-10-23 15:39:08', '2017-10-23 15:39:08'),
(37, 'Samantha Jeffe', 'Female', 'Spouse', 'Hugh Jeffe', '(580)800-9990', 19, '2017-10-23 15:41:58', '2017-10-23 15:41:58'),
(38, 'Sam Jeffe', 'Female', 'Myself', 'Smitty Jeffe', '(879)481-8155', 19, '2017-10-23 15:41:58', '2017-10-23 15:41:58'),
(39, 'Denise Gray', 'Female', 'Family', 'Billy Gray', '(498)108-0898', 20, '2017-10-23 15:45:13', '2017-10-23 15:45:13'),
(40, 'Gilly Gray', 'Female', 'Family', 'Billy Gray', '(805)256-0911', 20, '2017-10-23 15:45:13', '2017-10-23 15:45:13'),
(41, 'Hugo Bohue', 'Male', 'Family', 'James Bohue', '(808)555-5555', 21, '2017-10-23 21:34:06', '2017-10-23 21:34:06'),
(42, 'James Bohue', 'Male', 'Myself', 'Samantha Bohue', '(303)333-3333', 21, '2017-10-23 21:34:06', '2017-10-23 21:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `traveler_id` int(11) NOT NULL,
  `insurance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(13,2) NOT NULL,
  `paid` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `group_id`, `user_id`, `traveler_id`, `insurance`, `package`, `total`, `paid`, `created_at`, `updated_at`) VALUES
(6, 8, 1, 1, 'Yes', 'Single', '5000.00', '5000.00', '2017-10-23 14:05:29', '2017-10-23 14:10:26'),
(5, 4, 1, 2, 'Yes', 'Double', '2600.00', '2600.00', '2017-10-23 14:04:19', '2017-10-23 14:04:50'),
(4, 4, 1, 1, 'Yes', 'Single', '2200.00', '2200.00', '2017-10-23 11:27:58', '2017-10-23 14:03:20'),
(7, 8, 1, 2, 'No', 'Double', '6500.00', '6500.00', '2017-10-23 14:06:12', '2017-10-23 14:10:01'),
(8, 5, 2, 3, 'No', 'Single', '2600.00', '2600.00', '2017-10-23 14:13:24', '2017-10-23 14:16:40'),
(9, 5, 2, 4, 'Yes', 'Double', '3200.00', '3200.00', '2017-10-23 14:13:45', '2017-10-23 14:15:56'),
(10, 14, 2, 3, 'Yes', 'Single', '2800.00', '500.00', '2017-10-23 14:14:16', '2017-10-23 14:17:26'),
(11, 14, 2, 4, 'Yes', 'Double', '3200.00', '600.00', '2017-10-23 14:14:55', '2017-10-23 14:17:09'),
(12, 11, 3, 5, 'Yes', 'Double', '3400.00', '3000.00', '2017-10-23 14:19:46', '2017-10-23 14:21:01'),
(13, 11, 3, 6, 'Yes', 'Double', '3400.00', '3400.00', '2017-10-23 14:20:06', '2017-10-23 14:20:44'),
(14, 15, 3, 7, 'Yes', 'Triple', '3200.00', '1750.00', '2017-10-23 14:21:54', '2017-10-23 14:22:24'),
(15, 7, 4, 8, 'Yes', 'Single', '2500.00', '2500.00', '2017-10-23 14:24:23', '2017-10-23 14:26:48'),
(16, 7, 4, 9, 'Yes', 'Double', '2800.00', '2800.00', '2017-10-23 14:24:38', '2017-10-23 14:27:25'),
(17, 17, 4, 8, 'Yes', 'Double', '3200.00', '600.00', '2017-10-23 14:25:15', '2017-10-23 14:28:27'),
(18, 17, 4, 9, 'Yes', 'Double', '3200.00', '950.00', '2017-10-23 14:25:33', '2017-10-23 14:28:50'),
(19, 10, 4, 8, 'Yes', 'Single', '2200.00', '2200.00', '2017-10-23 14:29:18', '2017-10-23 14:32:12'),
(20, 10, 4, 9, 'Yes', 'Double', '2600.00', '2600.00', '2017-10-23 14:29:36', '2017-10-23 14:30:33'),
(21, 13, 5, 10, 'Yes', 'Single', '2600.00', '1100.00', '2017-10-23 14:39:33', '2017-10-23 14:41:34'),
(22, 13, 5, 11, 'Yes', 'Single', '2600.00', '2100.00', '2017-10-23 14:40:02', '2017-10-23 14:41:24'),
(23, 14, 5, 10, 'Yes', 'Double', '3200.00', '900.00', '2017-10-23 14:42:30', '2017-10-23 14:44:37'),
(24, 14, 5, 11, 'Yes', 'Single', '2800.00', '900.00', '2017-10-23 14:42:59', '2017-10-23 14:44:09'),
(25, 14, 5, 12, 'Yes', 'Double', '3200.00', '650.00', '2017-10-23 14:43:28', '2017-10-23 14:43:56'),
(26, 9, 6, 13, 'Yes', 'Single', '3500.00', '3500.00', '2017-10-23 14:47:22', '2017-10-23 14:49:20'),
(27, 9, 6, 14, 'Yes', 'Single', '3500.00', '3500.00', '2017-10-23 14:47:44', '2017-10-23 14:50:10'),
(28, 16, 6, 13, 'Yes', 'Double', '3000.00', '550.00', '2017-10-23 14:48:02', '2017-10-23 14:50:32'),
(29, 16, 6, 14, 'Yes', 'Triple', '3550.00', '600.00', '2017-10-23 14:48:23', '2017-10-23 14:50:22'),
(30, 6, 7, 15, 'No', 'Single', '1800.00', '1800.00', '2017-10-23 14:53:15', '2017-10-23 14:53:45'),
(31, 12, 8, 16, 'Yes', 'Single', '5600.00', '3200.00', '2017-10-23 14:59:17', '2017-10-23 15:02:10'),
(32, 12, 8, 17, 'Yes', 'Double', '6200.00', '4290.00', '2017-10-23 14:59:58', '2017-10-23 15:01:56'),
(33, 12, 8, 18, 'Yes', 'Double', '6200.00', '6200.00', '2017-10-23 15:00:16', '2017-10-23 15:01:01'),
(34, 11, 9, 19, 'Yes', 'Double', '3400.00', '3400.00', '2017-10-23 15:05:09', '2017-10-23 15:11:52'),
(35, 6, 9, 20, 'Yes', 'Double', '2500.00', '2500.00', '2017-10-23 15:05:32', '2017-10-23 15:11:43'),
(36, 15, 9, 19, 'Yes', 'Single', '2200.00', '650.00', '2017-10-23 15:05:49', '2017-10-23 15:12:21'),
(37, 15, 9, 20, 'Yes', 'Single', '2200.00', '550.00', '2017-10-23 15:06:06', '2017-10-23 15:12:11'),
(38, 7, 10, 23, 'Yes', 'Single', '2500.00', '2500.00', '2017-10-23 15:15:55', '2017-10-23 15:18:05'),
(39, 7, 10, 21, 'No', 'Double', '2800.00', '2800.00', '2017-10-23 15:16:53', '2017-10-23 15:17:56'),
(40, 7, 10, 22, 'No', 'Triple', '3500.00', '3500.00', '2017-10-23 15:17:16', '2017-10-23 15:17:34'),
(41, 13, 11, 24, 'Yes', 'Single', '2600.00', '2600.00', '2017-10-23 15:19:41', '2017-10-23 15:19:49'),
(42, 13, 11, 25, 'No', 'Single', '2600.00', '0.00', '2017-10-23 15:20:37', '2017-10-23 15:20:37'),
(43, 8, 12, 26, 'Yes', 'Triple', '7200.00', '7200.00', '2017-10-23 15:22:35', '2017-10-23 15:23:08'),
(44, 4, 13, 27, 'No', 'Double', '2600.00', '2600.00', '2017-10-23 15:25:33', '2017-10-23 15:26:51'),
(45, 9, 13, 28, 'No', 'Double', '4100.00', '4100.00', '2017-10-23 15:25:46', '2017-10-23 15:26:41'),
(46, 17, 13, 28, 'Yes', 'Single', '2500.00', '2500.00', '2017-10-23 15:26:00', '2017-10-23 15:26:12'),
(47, 15, 14, 29, 'Yes', 'Single', '2200.00', '2200.00', '2017-10-23 15:28:57', '2017-10-23 15:29:11'),
(48, 12, 15, 31, 'No', 'Single', '5600.00', '880.00', '2017-10-23 15:31:00', '2017-10-23 15:31:34'),
(49, 12, 15, 30, 'No', 'Single', '5600.00', '600.00', '2017-10-23 15:31:13', '2017-10-23 15:31:24'),
(50, 10, 16, 33, 'No', 'Single', '2200.00', '2200.00', '2017-10-23 15:34:07', '2017-10-23 15:34:52'),
(51, 12, 16, 32, 'Yes', 'Double', '6200.00', '5950.00', '2017-10-23 15:34:23', '2017-10-23 15:35:02'),
(52, 7, 16, 34, 'Yes', 'Triple', '3500.00', '3500.00', '2017-10-23 15:34:42', '2017-10-23 15:35:36'),
(53, 12, 17, 35, 'Yes', 'Single', '5600.00', '5600.00', '2017-10-23 15:37:30', '2017-10-23 15:37:45'),
(54, 14, 18, 36, 'Yes', 'Double', '3200.00', '3200.00', '2017-10-23 15:39:32', '2017-10-23 15:40:16'),
(55, 4, 19, 37, 'Yes', 'Double', '2600.00', '2600.00', '2017-10-23 15:42:27', '2017-10-23 15:43:04'),
(56, 4, 19, 38, 'Yes', 'Double', '2600.00', '2600.00', '2017-10-23 15:42:41', '2017-10-23 15:42:56'),
(57, 6, 20, 39, 'Yes', 'Double', '2500.00', '2500.00', '2017-10-23 15:45:33', '2017-10-23 15:46:18'),
(58, 6, 20, 40, 'Yes', 'Single', '1800.00', '1800.00', '2017-10-23 15:45:53', '2017-10-23 15:46:02'),
(59, 14, 21, 41, 'Yes', 'Single', '2800.00', '900.00', '2017-10-23 21:34:24', '2017-10-23 21:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `cell`, `home`, `street`, `zip`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Josh Van Natta', '(720)412-2575', NULL, '123 Main St', 73301, 'jjvannatta88@gmail.com', '$2y$10$pyKEswzxypI3eWYzG9IhmOqjaepbYQYYTZwMzRcxpFayRQs5MX60m', 'ChbCEahbAppcDnZwYEyVuSHtTj6SmZirNvZY6GB1l9X5S8GDIuTPkWRYDJyg', '2017-10-22 09:15:19', '2017-10-22 09:15:19'),
(2, 'Rose Gonzales', '(800)599-5508', NULL, '9578 Shub Farm Avenue', 27511, 'rgonzales@gmail.com', '$2y$10$uB4INUOufmE8K/aMeQjkX.Qnk6s51/0qD78cpTCeUPkq.nIrZtTLG', 'Pr6RzwoyhzWAyalMN3mzWRU6xpBOL7b92gzTrhivYaKk95vCDfjfcTOUItar', '2017-10-23 14:12:49', '2017-10-23 14:12:49'),
(3, 'Ted Johnson', '(555)555-5555', NULL, '8705 S. Birch Hill Avenue', 45342, 'tjohnson@yahoo.com', '$2y$10$qdnZIH3dsbr5AR5WmB//5u/4WadqxZfiMCviLnZkfh3vxHaDzPbMy', 'wkMDkRV1JnS00YALtSzV43ezsKMgL7UI7Kx6KP49KLcTDJdxqyawFnb8Saut', '2017-10-23 14:19:07', '2017-10-23 14:19:07'),
(4, 'Gina Wilson', '(881)560-5881', NULL, '8927 East Oak Ave.', 60102, 'gwilson@msn.com', '$2y$10$U6sfa92DgdD.ZjlFWfxJWecYi0LuW2cOCQwMfhTDEd90PSd0ZmFK6', 'jdSqpZSbof6m04H5O145jTIDCw8IlVVkCBpfkg2502YPgYy6TnXKocGQeacz', '2017-10-23 14:23:54', '2017-10-23 14:23:54'),
(5, 'Patricia O\'Neal', '(808)555-5505', NULL, '57 West Golden Star St.', 12601, 'patoneal@gmail.com', '$2y$10$ajn/xUGjr8ZNlE6V1VmDF./lpRmOfnEhcaZUPJglhLkofGZSpgQG6', 'nUw50eZGswkEQ6rUuz1ujVLdawD9Tme9cqxwdMVn1AiPtSmN4XvbOjB63RSw', '2017-10-23 14:37:55', '2017-10-23 14:37:55'),
(6, 'Danielle Nguyen', '(505)555-0655', NULL, '8927 East Oak Ave.', 60102, 'dnguyen@gmail.com', '$2y$10$EQl8Ymd.aFdyjV37x.XFXOBJb15G6nG8ZhJd62zx09EKzYFMN/mF2', 'oLM1g0fvXs0zJBV5tet2cBz1sREVOgMIdqGOKzRE7KReiAJEFW0nknuxV8Ee', '2017-10-23 14:46:50', '2017-10-23 14:46:50'),
(7, 'Robert Wise', '(800)598-0555', NULL, '9990 Inverness Drive', 21144, 'robwise55@gmail.com', '$2y$10$HP1n8fj44DNFwbweFEv/1uPSgXdWhUjVvXveUJCMdrS/Bmt86jINi', 'ggmtjZ5XqjgTjloNOTFG2vyi9CUGjaWT69OnxvJMSTYe8huhevw3gPIc7CDG', '2017-10-23 14:52:54', '2017-10-23 14:52:54'),
(8, 'Janice Dickenson', '(505)518-1280', NULL, '203 Kingston St.', 60091, 'jdickenson@yahoo.com', '$2y$10$AJFcfKjUdU1sHKdXzk2RuuyBDOzBcQVnnM6BEHWvG2UNcH0nbcwTe', 'XrcF2KWZMqmS2eprIMNBtiWRBHyVxexNDJSbLNkuMRryxvULnjojFZJ2WQ0R', '2017-10-23 14:58:42', '2017-10-23 14:58:42'),
(9, 'Sam Palmer', '(508)090-5080', NULL, '68 Swanson Street', 60181, 'spalmer@gmail.com', '$2y$10$RAw.zzNnmoJv6DCDNhH2GemU.4uYcCVWzI/T3vOF3Iv6V3bjmeAbu', 'OPhQ3QKALP9ZXcgm3ijIvDqKPZcz5RqYov5YrwK8Rbs1DzUjBjmkhhRslAhe', '2017-10-23 15:04:15', '2017-10-23 15:04:15'),
(10, 'Hugh Marlowe', '(805)550-6098', NULL, '49 Brickell Court', 77016, 'hmarlow88@gmail.com', '$2y$10$x/Ostf7t/jotlM.xGq4eBO3YQnIfh99uo8spIX93L/Ql2VCGDKpkS', 'bym5ZEanbMmeIf63WrpTU7JYwRVcgJPZwo9kMA6A8xx5NDt0cNS2kvXg05na', '2017-10-23 15:15:27', '2017-10-23 15:15:27'),
(11, 'Edmond North', '(805)560-9895', NULL, '203 Kingston St.', 60091, 'enorth@aol.com', '$2y$10$pwOdizzq1Ijx2S8b04Vsb.gjd85PVb9w7P77cOY1oyK5uacwWsq6W', 'rxyJ9IvZEl1NVLYlPMEB4yZfN5jD06sVSYjvZsfXBUWK3IUOh7iEosRvLEMO', '2017-10-23 15:19:21', '2017-10-23 15:19:21'),
(12, 'Kathy Sherwood', '(090)550-8096', NULL, '9524 Gregory Street', 32174, 'ksherwood@cnn.com', '$2y$10$9S9uHiCvr0IiCWpHQNKvbuaWXJ8Fx.wmd9W7oBPA0OI.ZDPJ1Vvwq', 'm5AF5QO2xCjqXHJ591584wuWIKxqaOqHNV8F2Ue3B2sVDVlykkoA17tIGbwH', '2017-10-23 15:22:15', '2017-10-23 15:22:15'),
(13, 'Maurice Manson', '(805)568-9888', NULL, '68 Swanson Street', 8205, 'mammymanson@gmail.com', '$2y$10$9Obja5nrhaOaFGXZmOxkV.oGcQNw10SWQa16fZdpr4ClC3ZiM/.Y6', 'ZSaDu7rvIrpSlrh33Ep6IHuYoIvMAYb59gTZdxgF9hSNCFLh5K4cB10WHypT', '2017-10-23 15:25:20', '2017-10-23 15:25:20'),
(14, 'Gregg Palmer', '(805)080-5580', NULL, '642 Center Rd.', 60181, 'gpalmer@gmail.com', '$2y$10$Ck/Y3FLp/ZkiWuHNXv9oxuScR.8aUy92E9tCfiS7N8igHDqeggS4y', 'byqlSTLBHuH2Vcxj5Pro8D7V6sjm0PMNBJfghxAbeVzPJbAulizVAQWDuZIJ', '2017-10-23 15:28:41', '2017-10-23 15:28:41'),
(15, 'Arthur Ross', '(899)004-6468', NULL, '515 Riverview St.', 1545, 'artross_090@gmail.com', '$2y$10$ekB6Of338poTVYKWsMS0L.VHBBQNfauDxvKd5bxZCqJUHBbrI6u/q', 'PwwEKWLJbDY2e0mpUlWvHZb4Vm5EaxADBD3OYmDAAVqsyo2gmTArkVqTio9m', '2017-10-23 15:30:43', '2017-10-23 15:30:43'),
(16, 'Will Almond', '(805)562-9091', NULL, '85 Longbranch Street', 44039, 'will_almond@gmail.com', '$2y$10$DmT0lGgyOBX5n5I0la6KeOSSp3jpuol55ACqLPuc1hMc.A0obixfW', 'OWJMdVqFrj3sYL5mKAnSRPdlzWByMPLWYJlxHmy2N95mr8or0GTXHHAJUpOx', '2017-10-23 15:33:51', '2017-10-23 15:33:51'),
(17, 'Jeff Morrow', '(805)599-5941', NULL, '82 Church St.', 73301, 'jeff.morrow@gmail.com', '$2y$10$U1vsc64Dww.KWQRnlrnn2uPDs129aqy1hrivq4IxdwcLobuCaHy/O', '8A0u0p6wf2yPWxADkef2MGR3CSyOoSV7DoSg2BQluGCB98vYnhfdPXOGMiL1', '2017-10-23 15:37:07', '2017-10-23 15:37:07'),
(18, 'Leigh Snowden', '(879)455-5444', NULL, '98 Glenwood Ave.', 77505, 'leigh.snowden@msn.com', '$2y$10$QYH.d4JZXrz8FBaHBhv6RuwOTYQvf9bBTCoyXk2lG0Hko9d.rFE86', '5W4eYvjX8NIkpjk5olTUW70Eso1fAlfwn3KbPB10uWrKCYEuPLkx0coBqUpJ', '2017-10-23 15:39:08', '2017-10-23 15:39:08'),
(19, 'Sam Jeffe', '(554)499-1919', NULL, '152 West Court', 77808, 'sam.jeffe88@gmail.com', '$2y$10$2irGV99.B0ksn09O32YHiemsrI5ehCd6jPl2Zxn19WxmaB4CR8/AK', 'rX1CzhrvW5WfIZKbcIbcWZgJcl7YyeqYflDvF7sbzrBGiKce4PC1HNpcZADL', '2017-10-23 15:41:58', '2017-10-23 15:41:58'),
(20, 'Billy Gray', '(805)090-9044', NULL, '523 N. Piper Lane', 29640, 'billy.gray@fox.com', '$2y$10$Tux/4WiTUapSGpSrsqw8wOYxsOaaEogrqi0r01G5ZrAzNR/.fJgfK', 'YzeSj2Nn4wseeW4R5m3VYa3wWLfP1o0GJduiS7vFTnuj9p9H7fpq6lkRAHte', '2017-10-23 15:45:13', '2017-10-23 15:45:13'),
(21, 'James Bohue', '(808)555-5555', '(505)888-8888', '123 Main St', 73301, 'jimbo@gmail.com', '$2y$10$TesU9xEoZnqAQgVNKO6AaeKWRtn0aPm9nHJYumm5EAD4FIv1FEbV2', NULL, '2017-10-23 21:34:06', '2017-10-23 21:34:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_number_unique` (`number`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_paypal_id_unique` (`paypal_id`);

--
-- Indexes for table `travelers`
--
ALTER TABLE `travelers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `travelers`
--
ALTER TABLE `travelers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
