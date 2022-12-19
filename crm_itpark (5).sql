-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 18 2022 г., 15:55
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crm_itpark`
--

-- --------------------------------------------------------

--
-- Структура таблицы `analytics`
--

CREATE TABLE `analytics` (
  `person_id` bigint(20) NOT NULL,
  `type_id` int(11) NOT NULL,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `analytics`
--

INSERT INTO `analytics` (`person_id`, `type_id`, `created`) VALUES
(9, 3, '2022-12-01 15:26:08'),
(11, 2, '2022-12-03 08:20:42'),
(12, 2, '2022-12-03 08:21:14'),
(15, 3, '2022-12-03 09:22:28'),
(16, 3, '2022-12-05 11:00:42'),
(17, 3, '2022-12-06 08:23:07'),
(18, 3, '2022-12-09 09:06:32'),
(19, 3, '2022-12-09 09:07:44'),
(21, 3, '2022-12-09 09:12:07'),
(22, 3, '2022-12-09 09:13:10'),
(36, 3, '2022-12-09 10:06:45'),
(37, 3, '2022-12-09 10:13:35'),
(38, 3, '2022-12-09 10:20:49'),
(39, 3, '2022-12-09 10:25:55'),
(40, 3, '2022-12-09 10:29:48'),
(41, 3, '2022-12-09 10:34:17');

-- --------------------------------------------------------

--
-- Структура таблицы `analytics_type`
--

CREATE TABLE `analytics_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `analytics_type`
--

INSERT INTO `analytics_type` (`id`, `name`, `status`) VALUES
(1, 'Televideniya orqali', 1),
(2, 'Radio orqali', 1),
(3, 'Telegram kanallari orqali', 1),
(4, 'Instagram', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `attendance`
--

CREATE TABLE `attendance` (
  `date_class` date NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `group_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `attendance`
--

INSERT INTO `attendance` (`date_class`, `student_id`, `status`, `group_id`, `teacher_id`) VALUES
('2022-12-12', 26, 1, 11, 10),
('2022-12-12', 27, 0, 11, 10),
('2022-12-12', 28, 1, 11, 10),
('2022-12-12', 29, 1, 11, 10),
('2022-12-12', 30, 1, 11, 10),
('2022-12-12', 31, 0, 11, 10),
('2022-12-12', 32, 0, 11, 10),
('2022-12-12', 33, 0, 11, 10),
('2022-12-12', 34, 0, 11, 10),
('2022-12-12', 35, 0, 11, 10),
('2022-12-12', 36, 0, 11, 10),
('2022-12-13', 26, 0, 11, 10),
('2022-12-13', 27, 1, 11, 10),
('2022-12-13', 28, 1, 11, 10),
('2022-12-13', 29, 0, 11, 10),
('2022-12-13', 30, 1, 11, 10),
('2022-12-13', 31, 1, 11, 10),
('2022-12-13', 32, 1, 11, 10),
('2022-12-13', 33, 0, 11, 10),
('2022-12-13', 34, 1, 11, 10),
('2022-12-13', 35, 0, 11, 10),
('2022-12-13', 36, 0, 11, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(500) DEFAULT NULL,
  `target` varchar(500) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `branch`
--

INSERT INTO `branch` (`id`, `name`, `address`, `target`, `location`, `phone`, `code`, `created`, `updated`, `status`) VALUES
(3, 'Xiva shaxar RTOM', 'Xiva shaxar', 'Xiva shaxar', NULL, '+998998075138', 100, '2022-12-01 15:15:57', '2022-12-01 15:15:57', 1),
(4, 'Xonqa tuman RTOM', 'Xonqa tuman', 'Xonqa tuman', NULL, '+998902070869', 102, '2022-12-01 15:37:46', '2022-12-01 15:37:46', 1),
(5, 'Bog`ot tuman RTOM', 'Bog`ot tuman', 'Bog`ot tuman', NULL, '+998919121101', 103, '2022-12-01 15:38:25', '2022-12-01 15:38:25', 1),
(6, 'Yangiariq tuman RTOM', 'Yangiariq', 'Yangiariq', NULL, '+998976073535', 104, '2022-12-01 15:39:07', '2022-12-01 15:39:07', 1),
(7, 'Yangibozor tuman', 'Yangibozor tuman', 'Yangibozor tuman', NULL, '+998998075138', 105, '2022-12-05 15:05:08', '2022-12-05 15:05:08', 1),
(8, 'Tuproqqala tumani', 'Tuproqqala tumani', 'Tuproqqala tumani', NULL, '+998998075138', 106, '2022-12-05 15:05:36', '2022-12-05 15:05:36', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cource`
--

CREATE TABLE `cource` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT 1,
  `price` int(11) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lesson_time` int(11) DEFAULT 2,
  `duration_type` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cource`
--

INSERT INTO `cource` (`id`, `name`, `status`, `price`, `duration`, `created`, `updated`, `lesson_time`, `duration_type`) VALUES
(3, 'Kompyuter savodxonligi', 1, 200000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 2),
(4, 'Frotend Dasturlash', 1, 50000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 2),
(5, 'Backend dasturlash', 1, 300000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 2),
(6, 'IT English', 1, 200000, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `branch_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT 1,
  `start_date` date DEFAULT NULL,
  `day_id` int(11) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creator_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT 1,
  `duration_type` int(11) DEFAULT 2,
  `lesson_time` int(11) DEFAULT 2,
  `end_date` date DEFAULT NULL,
  `why_before` text DEFAULT NULL,
  `state` int(11) DEFAULT 0,
  `consept_id` int(11) DEFAULT NULL,
  `code_id` int(11) NOT NULL DEFAULT 0,
  `is_full_paid` int(11) DEFAULT NULL,
  `is_send_sert` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `branch_id`, `course_id`, `status_id`, `start_date`, `day_id`, `time`, `type_id`, `price`, `created`, `updated`, `creator_id`, `room_id`, `duration`, `duration_type`, `lesson_time`, `end_date`, `why_before`, `state`, `consept_id`, `code_id`, `is_full_paid`, `is_send_sert`) VALUES
(5, '102/2022-1', 4, 3, 1, NULL, 1, '09:00 - 11:00', 1, 200000, '2022-12-05 10:59:08', '2022-12-05 10:59:08', 8, 4, 1, 2, 2, NULL, NULL, 0, NULL, 1, NULL, NULL),
(6, '104/2022-1', 6, 4, 2, '2022-01-01', 1, '09:00 - 11:00', 1, 50000, '2022-12-05 11:01:42', '2022-12-05 11:02:14', 9, NULL, 1, 2, 2, NULL, NULL, 0, NULL, 1, NULL, NULL),
(7, '105/2022-1', 7, 6, 2, '2022-10-01', 2, '16:00 - 18:00', 1, 200000, '2022-12-05 15:13:01', '2022-12-05 15:13:19', 12, NULL, 1, 2, 2, NULL, NULL, 0, NULL, 1, NULL, NULL),
(8, '105/2022-2', 7, 4, 1, NULL, 1, '16:00 - 18:00', 1, 50000, '2022-12-05 15:13:54', '2022-12-05 15:13:54', 12, NULL, 1, 2, 2, NULL, NULL, 0, NULL, 2, NULL, NULL),
(9, '105/2022-3', 7, 3, 1, NULL, 2, '14:00 - 16:00', 1, 200000, '2022-12-05 15:14:25', '2022-12-05 15:14:25', 12, NULL, 1, 2, 2, NULL, NULL, 0, NULL, 3, NULL, NULL),
(10, '100/2022-1', 3, 4, 1, '2022-11-23', 1, '14:00 - 16:00', 1, 50000, '2022-12-09 09:15:02', '2022-12-09 16:42:13', 6, 3, 1, 2, 2, NULL, NULL, 0, NULL, 1, NULL, NULL),
(11, '100/2022-2', 3, 3, 2, '2022-11-03', 2, '14:00 - 16:00', 1, 200000, '2022-12-09 09:52:02', '2022-12-12 17:25:38', 6, 3, 1, 2, 2, NULL, NULL, 0, NULL, 2, NULL, NULL),
(12, '103/2022-1', 5, 3, 1, NULL, 3, '09:00 - 11:00', 2, 200000, '2022-12-09 10:00:34', '2022-12-09 10:01:15', 7, 9, 1, 2, 2, NULL, NULL, 0, NULL, 1, NULL, NULL),
(13, '103/2022-2', 5, 4, 1, NULL, 1, '14:00 - 16:00', 1, 50000, '2022-12-09 10:02:00', '2022-12-09 10:02:00', 7, 8, 1, 2, 2, NULL, NULL, 0, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `group_class`
--

CREATE TABLE `group_class` (
  `teacher_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date_class` date NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `group_class`
--

INSERT INTO `group_class` (`teacher_id`, `group_id`, `date_class`, `status`) VALUES
(10, 11, '2022-12-12', '2'),
(10, 11, '2022-12-13', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `group_day`
--

CREATE TABLE `group_day` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='oquv darslari kunlari';

--
-- Дамп данных таблицы `group_day`
--

INSERT INTO `group_day` (`id`, `name`) VALUES
(1, 'Toq kunlari'),
(2, 'Juft kunlari'),
(3, 'Har kuni');

-- --------------------------------------------------------

--
-- Структура таблицы `group_status`
--

CREATE TABLE `group_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `group_status`
--

INSERT INTO `group_status` (`id`, `name`) VALUES
(1, 'Yangi guruh'),
(2, 'Jarayonda'),
(3, 'Tugallangan');

-- --------------------------------------------------------

--
-- Структура таблицы `group_teacher`
--

CREATE TABLE `group_teacher` (
  `teacher_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 1,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `group_teacher`
--

INSERT INTO `group_teacher` (`teacher_id`, `group_id`, `status`, `created`, `updated`) VALUES
(10, 11, 1, '2022-12-12 17:25:38', '2022-12-12 17:25:38');

-- --------------------------------------------------------

--
-- Структура таблицы `group_type`
--

CREATE TABLE `group_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `group_type`
--

INSERT INTO `group_type` (`id`, `name`) VALUES
(1, 'Oddiy'),
(2, 'Malaka oshirish');

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `persent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `name`, `persent`) VALUES
(1, 'Naqd', '0'),
(2, 'Payme', '1.5'),
(3, 'Bank o\'tkazmasi naqd', '0'),
(4, 'Bank o\'tkazmasi kartadan', '0'),
(5, 'Bank o\'tkazmasi (Prechesleniya)', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `person`
--

CREATE TABLE `person` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `pnfl` varchar(255) DEFAULT NULL,
  `inn` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `gender` int(1) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_parent` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `person`
--

INSERT INTO `person` (`id`, `name`, `pnfl`, `inn`, `birthday`, `gender`, `phone`, `phone_parent`, `created`, `updated`, `branch_id`) VALUES
(9, 'Jumaniyozov Umidbek', NULL, NULL, '1995-12-28', 1, '+998911347773', '+998911347773', '2022-12-01 15:26:08', '2022-12-01 15:26:08', 3),
(10, 'Samandarov Doston', NULL, NULL, '1995-03-29', 1, '919926191', '', '2022-12-03 08:20:14', '2022-12-03 08:20:14', 4),
(11, 'Samandarov Doston', NULL, NULL, '1995-03-29', 1, '919926191', '', '2022-12-03 08:20:42', '2022-12-03 08:20:42', 4),
(12, '', '', '', '1995-03-29', 1, '919926191', '', '2022-12-03 08:21:14', '2022-12-05 11:00:05', 4),
(13, '', '', '', '', 0, '', '', '2022-12-03 08:51:03', '2022-12-03 09:13:26', 3),
(14, 'Iskandarova Mahliyo Yusufboy qizi', '', '', '2006-09-14', 0, '977531656', '977531656', '2022-12-03 09:19:42', '2022-12-03 09:20:10', 3),
(15, 'Mrzabayev Boyto\'re Ilxom o\'g\'li', NULL, NULL, '2012-10-09', 1, '977531656', '977531656', '2022-12-03 09:22:28', '2022-12-03 09:22:28', 3),
(16, 'Abdiyozov Akmal', NULL, NULL, '2007-09-13', 1, '+998975158273', '+998975158273', '2022-12-05 11:00:42', '2022-12-05 11:00:42', 6),
(17, 'РћСЂС‚РёРєРѕРІ РЈРјСЂР±РµРє ', NULL, NULL, '', 1, '', '', '2022-12-06 08:23:07', '2022-12-06 08:23:07', 8),
(18, 'Matyaqubova Mahliyo Alisher qizi', NULL, NULL, '2000-03-14', 0, '904313531', '904313531', '2022-12-09 09:06:32', '2022-12-09 09:06:32', 3),
(19, 'Jabbarova Fotima Ravshonbek qizi', NULL, NULL, '2004-12-22', 0, '999944260', '999944260', '2022-12-09 09:07:44', '2022-12-09 09:07:44', 3),
(20, 'Iskandarova Mahliyo Yusufboy qizi', '', '', '2006-09-14', 0, '977531656', '977531656', '2022-12-09 09:10:27', '2022-12-09 09:11:11', 3),
(21, 'Mrzabayev Boyto\'re Ilxom o\'g\'li', NULL, NULL, '2012-10-09', 1, '977531656', '977531656', '2022-12-09 09:12:07', '2022-12-09 09:12:07', 3),
(22, 'Ganjayeva Shukurjon Jo\'rabek qizi', NULL, NULL, '2011-01-11', 0, '977531656', '977531656', '2022-12-09 09:13:10', '2022-12-09 09:13:10', 3),
(23, 'Abduraxmonov Murodbek O\'ktamboy o\'g\'li', NULL, NULL, '2009-03-29', 1, '977531656', '977531656', '2022-12-09 09:13:53', '2022-12-09 09:13:53', 3),
(24, 'Nurulbekov Dilmurod Sardor o\'g\'li', NULL, NULL, '2009-03-03', 1, '977531656', '977531656', '2022-12-09 09:14:31', '2022-12-09 09:14:31', 3),
(25, 'Sanatbekova Komila San\'atbek qizi', NULL, NULL, '2003-09-07', 0, '97 221 60 65', '97 221 60 65', '2022-12-09 09:24:50', '2022-12-09 09:24:50', 3),
(26, 'Ismailov Mirzobek Jaxongir o\'g\'li', NULL, NULL, '2008-10-04', 1, '90 079 36 30', '91 995 82 32', '2022-12-09 09:25:59', '2022-12-09 09:25:59', 3),
(27, 'Raximov Ilyosbek Islombek o\'g\'li', NULL, NULL, '2007-11-03', 1, '90 648 82 06', '91 997 24 06', '2022-12-09 09:27:16', '2022-12-09 09:27:16', 3),
(28, 'Qadamov Zufarbek Inomjon o\'g\'li', NULL, NULL, '2010-11-08', 1, '91 421 43 08', '99 963 30 84', '2022-12-09 09:30:09', '2022-12-09 09:30:09', 3),
(29, 'Sadullayev Temurbek Otabek o\'g\'li', NULL, NULL, '2008-08-09', 1, '90 433 79 90', '90 433 79 90', '2022-12-09 09:32:51', '2022-12-09 09:32:51', 3),
(30, 'Bekchanova Dilnura Matvapa qizi', NULL, NULL, '2002-03-08', 0, '91 421 83 53', '90 713 19 85', '2022-12-09 09:33:55', '2022-12-09 09:33:55', 3),
(31, 'Ravshanbekov Mustafo Omonboy o\'g\'li', NULL, NULL, '2012-09-27', 1, '90 648 45 61', '90 648 45 61', '2022-12-09 09:34:39', '2022-12-09 09:34:39', 3),
(32, 'Rajabboyev Jahongir G\'ayrat o\'g\'li', NULL, NULL, '2005-01-19', 1, '99 800 78 81', '99 568 47 64', '2022-12-09 09:36:00', '2022-12-09 09:36:00', 3),
(33, 'Qasimova Nilufar Sanatbek qizi', NULL, NULL, '2005-01-02', 0, '88 512 53 13', '88 512 53 13', '2022-12-09 09:39:42', '2022-12-09 09:39:42', 3),
(34, 'Rahimova Malika Davlatnazarovna', '', '123456789', '1980-11-03', 0, '99 551 03 80', '99 551 03 80', '2022-12-09 09:40:51', '2022-12-12 18:13:08', 3),
(35, 'Yo\'ldoshboyev Suxrob Alisher o\'g\'li', '12345678911131', '123123123', '2003-11-14', 1, '91 997 57 55', '91 997 57 55', '2022-12-09 09:41:54', '2022-12-12 18:12:56', 3),
(36, 'Bekchanov Dostonbek Xudaybergan o\'g\'li', '30506977100059', '', '1997-06-05', 1, '+998932866009', '', '2022-12-09 10:06:45', '2022-12-09 10:08:24', 5),
(37, 'Ro\'zmetov Rajabboy Raximovich', '33010663070010', '', '1966-10-30', 1, '+998999632267', '', '2022-12-09 10:13:35', '2022-12-09 10:14:47', 5),
(38, 'Qutlimuradov Zohidjon Umid o\'g\'li', '32109926450012', '', '1992-09-21', 1, '+998990957956', '', '2022-12-09 10:20:49', '2022-12-09 10:27:58', 5),
(39, 'Razzaqova Iqboljon SHokirovna', '40105777100057', '', '1977-05-01', 0, '+998973611028', '', '2022-12-09 10:25:55', '2022-12-09 10:28:32', 5),
(40, 'Hasanova Nasiba Ro\'zimbayevna', '42203873070062', '', '1987-03-22', 0, '+998935648789', '', '2022-12-09 10:29:48', '2022-12-09 10:30:19', 5),
(41, 'Qurbonov Baxtiyor Qobulovich', '32508673070061', '', '1967-08-25', 1, '+998997536701', '', '2022-12-09 10:34:17', '2022-12-09 10:35:06', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `person_social`
--

CREATE TABLE `person_social` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ijtimoiy statusi';

--
-- Дамп данных таблицы `person_social`
--

INSERT INTO `person_social` (`id`, `name`) VALUES
(1, 'Yo\'q'),
(2, 'Temir daftar'),
(3, 'Ayollar daftari'),
(4, 'Yoshlar daftari'),
(5, 'Mehribonlik uyi tarbiyalanuvchisi'),
(6, 'Nogironligi mavjud');

-- --------------------------------------------------------

--
-- Структура таблицы `person_wish`
--

CREATE TABLE `person_wish` (
  `person_id` bigint(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `day_id` int(11) DEFAULT NULL,
  `time` varchar(20) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `person_wish`
--

INSERT INTO `person_wish` (`person_id`, `course_id`, `day_id`, `time`, `created`, `branch_id`) VALUES
(9, 3, 1, '09:00 - 11:00', '2022-12-01 15:26:43', 3),
(9, 4, 2, '16:00 - 18:00', '2022-12-01 15:26:08', 3),
(11, 3, 1, '09:00 - 11:00', '2022-12-03 08:20:42', 4),
(14, 4, 1, '14:00 - 16:00', '2022-12-03 09:20:27', 3),
(15, 4, 1, '14:00 - 16:00', '2022-12-03 09:22:28', 3),
(16, 4, 1, '11:00 - 13:00', '2022-12-05 11:00:42', 6),
(17, 4, 1, '14:00 - 16:00', '2022-12-06 08:23:07', 8),
(18, 4, 1, '14:00 - 16:00', '2022-12-09 09:06:32', 3),
(19, 4, 1, '09:00 - 11:00', '2022-12-09 09:07:44', 3),
(21, 4, 1, '14:00 - 16:00', '2022-12-09 09:12:07', 3),
(22, 4, 1, '14:00 - 16:00', '2022-12-09 09:13:10', 3),
(23, 4, 1, '14:00 - 16:00', '2022-12-09 09:13:53', 3),
(24, 4, 1, '14:00 - 16:00', '2022-12-09 09:14:31', 3),
(36, 3, 1, '09:00 - 11:00', '2022-12-09 10:06:45', 5),
(37, 3, 1, '09:00 - 11:00', '2022-12-09 10:13:35', 5),
(38, 3, 1, '09:00 - 11:00', '2022-12-09 10:21:35', 5),
(39, 3, 1, '09:00 - 11:00', '2022-12-09 10:26:00', 5),
(40, 3, 1, '09:00 - 11:00', '2022-12-09 10:29:52', 5),
(41, 3, 1, '09:00 - 11:00', '2022-12-09 10:34:17', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `person_wish_history`
--

CREATE TABLE `person_wish_history` (
  `id` bigint(20) NOT NULL,
  `person_id` bigint(20) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `day_id` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT current_timestamp(),
  `ads` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `person_wish_history`
--

INSERT INTO `person_wish_history` (`id`, `person_id`, `course_id`, `day_id`, `time`, `branch_id`, `created`, `updated`, `ads`) VALUES
(1, 12, 4, 1, '09:00 - 11:00', 4, '2022-12-03 08:21:34', '2022-12-05 10:59:37', ''),
(2, 12, 3, 1, '09:00 - 11:00', 4, '2022-12-03 08:21:14', '2022-12-05 10:59:41', '');

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT 1,
  `persent` int(11) DEFAULT 0,
  `other_company` int(11) DEFAULT 0,
  `company_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Loyihalar';

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `name`, `status`, `persent`, `other_company`, `company_id`) VALUES
(1, 'Yo\'q', 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `room`
--

INSERT INTO `room` (`id`, `branch_id`, `name`) VALUES
(1, 1, '103 xona'),
(2, 3, '101 WEB Dasturlash xona'),
(3, 3, '102 Savodxonlik Xona'),
(4, 4, 'Dasturchilar xonasi'),
(5, 4, 'Robotatexnika xonasi'),
(6, 3, '103 IT-ENGLISH'),
(7, 4, 'Kibersport xonasi'),
(8, 5, '1-Dasturlash xonasi '),
(9, 5, '2-kompyuter savodxonligi xonasi'),
(10, 5, '3-IT English xonasi');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `code_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `person_id` bigint(20) NOT NULL,
  `social_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` date DEFAULT NULL,
  `creator_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `type_id` int(11) DEFAULT 1,
  `student_social_id` int(11) DEFAULT 1,
  `is_full_paid` int(11) DEFAULT 0,
  `other_company` int(11) DEFAULT 0,
  `company_id` bigint(20) DEFAULT NULL,
  `has_discount` int(11) DEFAULT 0,
  `discount` int(11) DEFAULT 0,
  `discount_file` varchar(255) DEFAULT NULL,
  `discount_status` int(11) NOT NULL DEFAULT 0,
  `discount_consept_id` int(11) DEFAULT NULL,
  `sert_code` varchar(255) DEFAULT NULL,
  `sert_number` int(11) DEFAULT NULL,
  `is_send_sert` int(11) DEFAULT 0,
  `is_sert_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `code`, `code_id`, `group_id`, `person_id`, `social_id`, `project_id`, `created`, `updated`, `end_date`, `creator_id`, `branch_id`, `status`, `type_id`, `student_social_id`, `is_full_paid`, `other_company`, `company_id`, `has_discount`, `discount`, `discount_file`, `discount_status`, `discount_consept_id`, `sert_code`, `sert_number`, `is_send_sert`, `is_sert_date`) VALUES
(26, '22/100-1', 1, 11, 25, 1, 1, '2022-12-09 20:49:27', '2022-12-10 16:44:12', NULL, 6, 3, 1, 1, 1, 1, 0, NULL, 1, 20, '1670600967.5201.pdf', 0, NULL, NULL, NULL, 0, NULL),
(27, '22/100-2', 2, 11, 26, 1, 1, '2022-12-10 16:37:03', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(28, '22/100-3', 3, 11, 27, 1, 1, '2022-12-10 16:37:05', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(29, '22/100-4', 4, 11, 28, 1, 1, '2022-12-10 16:37:06', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(30, '22/100-5', 5, 11, 29, 1, 1, '2022-12-10 16:37:08', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(31, '22/100-6', 6, 11, 30, 1, 1, '2022-12-10 16:37:09', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(32, '22/100-7', 7, 11, 31, 1, 1, '2022-12-10 16:37:10', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(33, '22/100-8', 8, 11, 32, 1, 1, '2022-12-10 16:37:12', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(34, '22/100-9', 9, 11, 33, 1, 1, '2022-12-10 16:37:14', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(35, '22/100-10', 10, 11, 34, 1, 1, '2022-12-10 16:37:15', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL),
(36, '22/100-11', 11, 11, 35, 1, 1, '2022-12-10 16:37:17', '2022-12-10 16:38:04', NULL, 6, 3, 1, 1, 1, 0, 0, NULL, 0, 0, '', 0, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `student_pay`
--

CREATE TABLE `student_pay` (
  `student_id` bigint(20) NOT NULL,
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `pay_date` date DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_real` float DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `consept_id` int(11) DEFAULT NULL,
  `check_file` varchar(255) DEFAULT NULL,
  `ads` text DEFAULT NULL,
  `status_id` int(11) DEFAULT 1,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `student_pay`
--

INSERT INTO `student_pay` (`student_id`, `id`, `code`, `pay_date`, `price`, `price_real`, `paid_date`, `payment_id`, `branch_id`, `user_id`, `consept_id`, `check_file`, `ads`, `status_id`, `created`, `updated`) VALUES
(26, 0, '22/100-1', '2022-11-07', 200000, NULL, '2022-12-10', 1, 3, 6, 16, '1670672300.46.pdf', '', 3, '2022-12-09 20:49:27', '2022-12-12 17:25:38'),
(27, 0, '22/100-2', '2022-11-07', 200000, NULL, '2022-12-10', 1, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:03', '2022-12-12 17:25:38'),
(28, 0, '22/100-3', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:05', '2022-12-12 17:25:38'),
(29, 0, '22/100-4', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:06', '2022-12-12 17:25:38'),
(30, 0, '22/100-5', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:08', '2022-12-12 17:25:38'),
(31, 0, '22/100-6', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:09', '2022-12-12 17:25:38'),
(32, 0, '22/100-7', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:10', '2022-12-12 17:25:38'),
(33, 0, '22/100-8', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:12', '2022-12-12 17:25:38'),
(34, 0, '22/100-9', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:14', '2022-12-12 17:25:38'),
(35, 0, '22/100-10', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:15', '2022-12-12 17:25:38'),
(36, 0, '22/100-11', '2022-11-07', 200000, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 1, '2022-12-10 16:37:17', '2022-12-12 17:25:38');

-- --------------------------------------------------------

--
-- Структура таблицы `student_pay_status`
--

CREATE TABLE `student_pay_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `student_pay_status`
--

INSERT INTO `student_pay_status` (`id`, `name`, `class`) VALUES
(1, 'To\'lanmagan', ''),
(2, 'Tasdiqlanishi kutilmoqda', ''),
(3, 'To\'langan', ''),
(4, 'O\'qimagan', ''),
(5, 'Rad qilingan', '');

-- --------------------------------------------------------

--
-- Структура таблицы `student_social`
--

CREATE TABLE `student_social` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `student_social`
--

INSERT INTO `student_social` (`id`, `name`) VALUES
(1, 'Maktab o`quvchisi'),
(2, 'Kollej/Litsey'),
(3, 'Talaba'),
(4, 'Ishchi hodim'),
(5, 'Ishsiz fuqaro');

-- --------------------------------------------------------

--
-- Структура таблицы `student_type`
--

CREATE TABLE `student_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `student_type`
--

INSERT INTO `student_type` (`id`, `name`) VALUES
(1, 'Yo\'q'),
(2, 'Davlat tashikiloti'),
(3, 'Xo\'jalik tashkiloti');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `code_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_id` int(11) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `state` int(11) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `is_user` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `code`, `code_id`, `name`, `detail`, `creator_id`, `created`, `updated`, `status_id`, `deadline`, `state`, `user_id`, `is_user`) VALUES
(1, '1-2022', 1, 'asd', 'asd', 17, '2022-12-17 19:45:17', '2022-12-17 19:45:17', 1, '2022-12-22 00:00:00', 1, 17, 0),
(2, '2-2022', 2, 'asd', 'asd', 17, '2022-12-17 19:45:48', '2022-12-17 19:45:48', 1, '2022-12-21 00:00:00', 1, 17, 0),
(3, '3-2022', 3, 'asd', 'asd', 17, '2022-12-17 19:46:37', '2022-12-17 19:46:37', 1, '2022-12-15 00:00:00', 1, 17, 0),
(4, '4-2022', 4, 'asdasd', 'asdasd', 17, '2022-12-17 19:48:28', '2022-12-17 19:48:28', 1, '2022-12-14 00:00:00', 1, 17, 0),
(5, '5-2022', 5, 'asd', 'asd', 17, '2022-12-17 19:48:58', '2022-12-17 19:48:58', 1, '2022-12-17 00:00:00', 1, 17, 0),
(6, '6-2022', 6, 'asd', 'asd', 17, '2022-12-17 19:49:31', '2022-12-17 19:49:31', 1, '2022-12-17 00:00:00', 1, 17, 0),
(7, '7-2022', 7, 'asd', 'asd', 17, '2022-12-17 19:51:07', '2022-12-17 19:51:07', 1, '2022-12-17 00:00:00', 1, 17, 0),
(8, '8-2022', 8, 'asd', 'asd', 17, '2022-12-17 19:51:35', '2022-12-17 19:51:35', 1, '2022-12-17 00:00:00', 1, 17, 0),
(9, '9-2022', 9, 'asd', 'asd', 17, '2022-12-17 19:51:55', '2022-12-17 19:51:55', 1, '2022-12-17 00:00:00', 1, 17, 0),
(10, '10-2022', 10, 'asd', 'asd', 17, '2022-12-17 19:52:09', '2022-12-17 19:52:09', 1, '2022-12-17 00:00:00', 1, 17, 0),
(11, '11-2022', 11, 'sdf', 'sdf', 17, '2022-12-17 19:54:22', '2022-12-17 19:54:22', 1, NULL, 1, 17, 0),
(12, '12-2022', 12, 'sdf', 'sdf', 17, '2022-12-17 19:56:16', '2022-12-17 19:56:16', 1, NULL, 1, 17, 0),
(13, '13-2022', 13, 'sdf', 'sdf', 17, '2022-12-17 19:58:30', '2022-12-17 19:58:30', 1, NULL, 1, 17, 0),
(14, '14-2022', 14, 'sdf', 'sdf', 17, '2022-12-17 20:00:50', '2022-12-17 20:00:50', 1, NULL, 1, 17, 0),
(15, '15-2022', 15, 'df', 'sdf', 17, '2022-12-17 20:02:05', '2022-12-17 20:02:05', 1, NULL, 1, 17, 0),
(16, '16-2022', 16, 'df', 'sdf', 17, '2022-12-17 20:02:16', '2022-12-17 20:02:16', 1, NULL, 1, 17, 0),
(17, '17-2022', 17, 'df', 'sdf', 17, '2022-12-17 20:03:13', '2022-12-17 20:03:13', 1, NULL, 1, 17, 0),
(18, '18-2022', 18, 'asd', 'asd', 17, '2022-12-17 20:03:29', '2022-12-17 20:03:29', 1, '2022-12-08 00:00:00', 1, 17, 0),
(19, '19-2022', 19, 'sdf', 'sdf', 17, '2022-12-17 20:04:09', '2022-12-17 20:04:09', 1, '2022-12-20 00:00:00', 1, 17, 0),
(20, '20-2022', 20, 'sdf', 'sdf', 17, '2022-12-17 20:06:45', '2022-12-17 20:06:45', 1, '2022-12-20 00:00:00', 1, 17, 0),
(21, '21-2022', 21, '', '', 17, '2022-12-17 20:07:09', '2022-12-17 20:07:09', 1, NULL, 1, 17, 0),
(22, '22-2022', 22, '', '', 17, '2022-12-17 20:07:29', '2022-12-17 20:07:29', 1, NULL, 1, 17, 0),
(23, '23-2022', 23, '', '', 17, '2022-12-17 20:07:43', '2022-12-17 20:07:43', 1, NULL, 1, 17, 0),
(24, '24-2022', 24, '', '', 17, '2022-12-17 20:07:59', '2022-12-17 20:07:59', 1, NULL, 1, 17, 0),
(25, '25-2022', 25, '', '', 17, '2022-12-17 20:08:12', '2022-12-17 20:08:12', 1, NULL, 1, 17, 0),
(26, '26-2022', 26, '', '', 17, '2022-12-17 20:08:33', '2022-12-17 20:08:33', 1, NULL, 1, 17, 0),
(27, '27-2022', 27, '', '', 17, '2022-12-17 20:08:38', '2022-12-17 20:08:38', 1, NULL, 1, 17, 0),
(28, '28-2022', 28, '', '', 17, '2022-12-17 20:25:32', '2022-12-17 20:25:32', 1, '2022-12-28 00:00:00', 1, 17, 0),
(29, '29-2022', 29, 'asdasd', 'asdasdasd', 17, '2022-12-18 19:43:18', '2022-12-18 19:43:18', 1, '2022-12-24 00:00:00', 1, 17, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `task_answer`
--

CREATE TABLE `task_answer` (
  `task_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `detail` text DEFAULT NULL,
  `id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `confirm_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `task_answer_file`
--

CREATE TABLE `task_answer_file` (
  `task_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `task_answer_status`
--

CREATE TABLE `task_answer_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `task_answer_status`
--

INSERT INTO `task_answer_status` (`id`, `name`, `icon`) VALUES
(1, 'Yangi', NULL),
(2, 'Ko\'rildi', NULL),
(3, 'Qabul qilindi', NULL),
(4, 'Rad qilindi', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `task_file`
--

CREATE TABLE `task_file` (
  `task_id` bigint(20) NOT NULL,
  `id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `task_file`
--

INSERT INTO `task_file` (`task_id`, `id`, `file`, `user_id`, `created`, `updated`) VALUES
(28, 1, '1671290732.21811.pdf', 17, '2022-12-17 20:25:32', '2022-12-17 20:25:32'),
(28, 2, '1671290732.22142.pdf', 17, '2022-12-17 20:25:32', '2022-12-17 20:25:32'),
(28, 3, '1671290732.2233.pdf', 17, '2022-12-17 20:25:32', '2022-12-17 20:25:32'),
(29, 1, '1671374598.07361.pdf', 17, '2022-12-18 19:43:18', '2022-12-18 19:43:18'),
(29, 2, '1671374598.07772.pdf', 17, '2022-12-18 19:43:18', '2022-12-18 19:43:18');

-- --------------------------------------------------------

--
-- Структура таблицы `task_status`
--

CREATE TABLE `task_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `task_status`
--

INSERT INTO `task_status` (`id`, `name`, `icon`) VALUES
(1, 'Qoralama', 'bg-info'),
(2, 'Rahbar tasdiqlashi kutilmoqda', 'bg-info'),
(3, 'Jarayonda', 'bg-warning'),
(4, 'Bajarilgan', 'bg-success'),
(5, 'Topshiriq bekor qilingan', 'bg-danger');

-- --------------------------------------------------------

--
-- Структура таблицы `task_type`
--

CREATE TABLE `task_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `task_type`
--

INSERT INTO `task_type` (`id`, `name`, `icon`) VALUES
(1, 'Ijro uchun', NULL),
(2, 'Ma\'lumot uchun', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `task_user`
--

CREATE TABLE `task_user` (
  `task_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `exec_id` int(11) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) DEFAULT NULL,
  `sms_status` int(11) DEFAULT 0,
  `deadline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `task_user`
--

INSERT INTO `task_user` (`task_id`, `user_id`, `type_id`, `exec_id`, `created`, `updated`, `status_id`, `sms_status`, `deadline`) VALUES
(1, 17, 1, 8, '2022-12-17 19:45:17', '2022-12-17 19:45:17', 1, 0, '2022-12-22 00:00:00'),
(2, 17, 1, 7, '2022-12-17 19:45:48', '2022-12-17 19:45:48', 1, 0, '2022-12-21 00:00:00'),
(3, 17, 1, 7, '2022-12-17 19:46:37', '2022-12-17 19:46:37', 1, 0, '2022-12-15 00:00:00'),
(4, 17, 1, 7, '2022-12-17 19:48:28', '2022-12-17 19:48:28', 1, 0, '2022-12-14 00:00:00'),
(4, 17, 1, 8, '2022-12-17 19:48:28', '2022-12-17 19:48:28', 1, 0, '2022-12-14 00:00:00'),
(29, 17, 1, 8, '2022-12-18 19:43:18', '2022-12-18 19:43:18', 1, 0, '2022-12-24 00:00:00'),
(29, 17, 1, 9, '2022-12-18 19:43:18', '2022-12-18 19:43:18', 1, 0, '2022-12-24 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `task_user_status`
--

CREATE TABLE `task_user_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `task_user_status`
--

INSERT INTO `task_user_status` (`id`, `name`, `icon`) VALUES
(1, 'Yangi', NULL),
(2, 'Ko\'rildi', NULL),
(3, 'Jarayonda', NULL),
(4, 'Bajarilgan', NULL),
(5, 'Rad qilingan', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(500) NOT NULL DEFAULT '',
  `branch_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 1,
  `state` int(11) DEFAULT 1,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `branch_id`, `role_id`, `status`, `state`, `type_id`) VALUES
(1, 'Umidbek Jumaniyazov', 'umidbek', '$2y$13$4u.r5VAziP98/.6U2SN4eueEXa/jbPz1kDjnalh3TcGM6mPQiTeVq', NULL, 7, 1, 1, 2),
(6, 'Polvonov Xudayshukur', 'xivash', '$2y$13$Y2ib8NoOTKo49WXnlTb9b.VX6Qj6pZHYLsmtnDXRNj8TqTdweIrNm', 3, 2, 1, 1, 2),
(7, 'Satimov Mansur', 'bogott', '$2y$13$ArHXBUwREvremquEmSqBiOwG0B6Xi5Wz/l8PqVK1QzH5odIqtHde2', 5, 2, 1, 1, 2),
(8, 'Samandarov Doston', 'xonqat', '$2y$13$cXOyik2hWOhH2z5Rs1W1A.nDXbFvJH8Zw20Ywc1scvS0l48nkfQKG', 4, 2, 1, 1, 2),
(9, 'Otaboyev Ibrat', 'yangiariqt', '$2y$13$3ibejT0uHyHfoZANeflQUu1jZloW.KYEqD1GxIJYw5Wzy5AhikJfm', 6, 2, 1, 1, 2),
(10, 'Aminjonova Ozoda', 'ozodaxivash', '$2y$13$47LgH8x7Nqb0v7wx3gdQeO6SY0jk1f3yzaRC3FJA0NVltdYBjXdwq', 3, 1, 1, 1, 2),
(11, 'Matnazarov Furqat', 'xonqa', '$2y$13$qov1JdGFJ/DOzVSRFSXyKecQdciZ6sPlsymKUOt9TiAtYAijXNv8K', 4, 1, 1, 1, 2),
(12, 'Jumamurodov Akrom', 'yangibozort', '$2y$13$Psh/VYx/RvnYlWpb5/84cOFGhAZSC4SILvLFIuAbF5Rr/3emAo.gm', 7, 2, 1, 1, 2),
(13, 'Ibragimov Anvar', 'tuproqqalat', '$2y$13$iBKn8psvdvCZLiLuARG5n.Y0nbQXgjHSF3VlBE2aAjgWJ.s1.UAGW', 8, 2, 1, 1, 2),
(14, 'Raxmonov Dilshod Murodovich', 'Deelshod', '$2y$13$h6nC.jPrTdVC.fHi3l.3V.ute7c7ZCqMTtHMYYS7gSRJo.adHKOY6', 7, 1, 1, 1, 2),
(15, 'Palvonov Xudayshukur Ismoil o\'g\'li', 'Xudayshukur', '$2y$13$9Jvge3vDIOxEewQp6xQA3e0Kwg5iLhkisbheB/ruVVEu1blXIg0Sy', 3, 1, 1, 1, 2),
(16, 'bux', 'bux', '$2y$13$RZ0CJnrBp2pnM3Z.iZ06QeSC.0/PIAIcXaPoA1F2Cshrbs4.HxNfm', NULL, 3, 1, 1, 2),
(17, 'Bekchanov Farruh', 'farruh', '$2y$13$TWD5p4/ZoqIEAp/jCNTWCOeuPqFqbRyRSztFHUFpBKI7bhK8lCLl6', NULL, 5, 1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `name`, `url`, `status`) VALUES
(1, 'O\'qituvchi', '/teacher/', 1),
(2, 'Filial menejeri', '/manager/', 1),
(3, 'Buxgalter', '/bux/', 1),
(4, 'Direktor', '/director/', 1),
(5, 'Menejer', '/bmanager/', 1),
(6, 'Marketing', '/marketing/', 1),
(7, 'Admin', '/cp/', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Shartnoma asosida'),
(2, 'Shtat birligi');

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `view_student`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `view_student` (
`group_name` varchar(255)
,`group_id` int(11)
,`person_id` bigint(20)
,`person_name` varchar(50)
,`person_phone` varchar(255)
,`person_parent_phone` varchar(255)
,`id` bigint(20)
,`code` varchar(255)
,`social_id` int(11)
,`project_id` int(11)
,`created` datetime
,`updated` datetime
,`branch_id` int(11)
,`status` int(11)
);

-- --------------------------------------------------------

--
-- Структура таблицы `work_type`
--

CREATE TABLE `work_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `work_type`
--

INSERT INTO `work_type` (`id`, `name`) VALUES
(1, 'Yo\'q'),
(2, 'Davlat boshqaruv organi'),
(3, 'Xo\'jalik yurutuvchi subyekt');

-- --------------------------------------------------------

--
-- Структура для представления `view_student`
--
DROP TABLE IF EXISTS `view_student`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_student`  AS SELECT `groups`.`name` AS `group_name`, `groups`.`id` AS `group_id`, `person`.`id` AS `person_id`, `person`.`name` AS `person_name`, `person`.`phone` AS `person_phone`, `person`.`phone_parent` AS `person_parent_phone`, `student`.`id` AS `id`, `student`.`code` AS `code`, `student`.`social_id` AS `social_id`, `student`.`project_id` AS `project_id`, `student`.`created` AS `created`, `student`.`updated` AS `updated`, `student`.`branch_id` AS `branch_id`, `student`.`status` AS `status` FROM ((`student` join `person` on(`student`.`person_id` = `person`.`id`)) join `groups` on(`student`.`group_id` = `groups`.`id`))  ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`person_id`,`type_id`),
  ADD KEY `FK_analytics_type_id` (`type_id`);

--
-- Индексы таблицы `analytics_type`
--
ALTER TABLE `analytics_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`date_class`,`student_id`,`group_id`,`teacher_id`),
  ADD KEY `FK_attendance_student_id` (`student_id`);

--
-- Индексы таблицы `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cource`
--
ALTER TABLE `cource`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_group_branch_id` (`branch_id`),
  ADD KEY `FK_group_course_id` (`course_id`),
  ADD KEY `FK_group_status_id2` (`status_id`),
  ADD KEY `FK_group_day_id` (`day_id`),
  ADD KEY `FK_group_type_id` (`type_id`),
  ADD KEY `FK_group_creator_id` (`creator_id`),
  ADD KEY `FK_group_room_id` (`room_id`);

--
-- Индексы таблицы `group_class`
--
ALTER TABLE `group_class`
  ADD PRIMARY KEY (`teacher_id`,`group_id`,`date_class`);

--
-- Индексы таблицы `group_day`
--
ALTER TABLE `group_day`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `group_status`
--
ALTER TABLE `group_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `group_teacher`
--
ALTER TABLE `group_teacher`
  ADD PRIMARY KEY (`teacher_id`,`group_id`),
  ADD KEY `FK_group_teacher_group_id` (`group_id`);

--
-- Индексы таблицы `group_type`
--
ALTER TABLE `group_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_person_branch_id` (`branch_id`);

--
-- Индексы таблицы `person_social`
--
ALTER TABLE `person_social`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `person_wish`
--
ALTER TABLE `person_wish`
  ADD PRIMARY KEY (`person_id`,`course_id`),
  ADD KEY `FK_person_wish_course_id` (`course_id`),
  ADD KEY `FK_person_wish_day_id` (`day_id`),
  ADD KEY `FK_person_wish_branch_id` (`branch_id`);

--
-- Индексы таблицы `person_wish_history`
--
ALTER TABLE `person_wish_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_person_wish_history_person_id` (`person_id`),
  ADD KEY `FK_person_wish_history_course_id` (`course_id`),
  ADD KEY `FK_person_wish_history_day_id` (`day_id`),
  ADD KEY `FK_person_wish_history_branch_id` (`branch_id`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_student_group_id` (`group_id`),
  ADD KEY `FK_student_person_id` (`person_id`),
  ADD KEY `FK_student_social_id` (`social_id`),
  ADD KEY `FK_student_project_id` (`project_id`),
  ADD KEY `FK_student_creator_id` (`creator_id`),
  ADD KEY `FK_student_branch_id` (`branch_id`),
  ADD KEY `FK_student_student_social_id` (`student_social_id`),
  ADD KEY `FK_student_type_id` (`type_id`);

--
-- Индексы таблицы `student_pay`
--
ALTER TABLE `student_pay`
  ADD PRIMARY KEY (`student_id`,`id`),
  ADD KEY `FK_person_pay_status_id` (`status_id`),
  ADD KEY `FK_student_pay_payment_id` (`payment_id`),
  ADD KEY `FK_student_pay_branch_id` (`branch_id`),
  ADD KEY `FK_student_pay_user_id` (`user_id`),
  ADD KEY `FK_student_pay_consept_id` (`consept_id`);

--
-- Индексы таблицы `student_pay_status`
--
ALTER TABLE `student_pay_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_social`
--
ALTER TABLE `student_social`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_type`
--
ALTER TABLE `student_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `FK_task_creator_id` (`creator_id`),
  ADD KEY `FK_task_status_id` (`status_id`),
  ADD KEY `FK_task_user_id` (`user_id`);

--
-- Индексы таблицы `task_answer`
--
ALTER TABLE `task_answer`
  ADD PRIMARY KEY (`task_id`,`user_id`,`id`),
  ADD KEY `FK_task_answer_status_id` (`status_id`),
  ADD KEY `FK_task_answer_user_id` (`user_id`),
  ADD KEY `FK_task_answer_confirm_id` (`confirm_id`);

--
-- Индексы таблицы `task_answer_file`
--
ALTER TABLE `task_answer_file`
  ADD PRIMARY KEY (`id`,`user_id`,`task_id`),
  ADD KEY `FK_task_answer_file_task_id` (`task_id`),
  ADD KEY `FK_task_answer_file_user_id` (`user_id`);

--
-- Индексы таблицы `task_answer_status`
--
ALTER TABLE `task_answer_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task_file`
--
ALTER TABLE `task_file`
  ADD PRIMARY KEY (`task_id`,`id`),
  ADD KEY `FK_task_file_creator_id` (`user_id`);

--
-- Индексы таблицы `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task_type`
--
ALTER TABLE `task_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`task_id`,`user_id`,`exec_id`),
  ADD KEY `FK_task_user_user_id` (`user_id`),
  ADD KEY `FK_task_user_type_id` (`type_id`),
  ADD KEY `FK_task_user_exec_id` (`exec_id`),
  ADD KEY `FK_task_user_status_id` (`status_id`);

--
-- Индексы таблицы `task_user_status`
--
ALTER TABLE `task_user_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_branch_id` (`branch_id`),
  ADD KEY `FK_user_role_id` (`role_id`),
  ADD KEY `FK_user_type_id` (`type_id`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `work_type`
--
ALTER TABLE `work_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `analytics_type`
--
ALTER TABLE `analytics_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `cource`
--
ALTER TABLE `cource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `group_day`
--
ALTER TABLE `group_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `group_status`
--
ALTER TABLE `group_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `group_type`
--
ALTER TABLE `group_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `person`
--
ALTER TABLE `person`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `person_social`
--
ALTER TABLE `person_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `person_wish_history`
--
ALTER TABLE `person_wish_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `student_pay_status`
--
ALTER TABLE `student_pay_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `student_social`
--
ALTER TABLE `student_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `student_type`
--
ALTER TABLE `student_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `task_answer_status`
--
ALTER TABLE `task_answer_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `task_type`
--
ALTER TABLE `task_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `task_user_status`
--
ALTER TABLE `task_user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `work_type`
--
ALTER TABLE `work_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `analytics`
--
ALTER TABLE `analytics`
  ADD CONSTRAINT `FK_analytics_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_analytics_type_id` FOREIGN KEY (`type_id`) REFERENCES `analytics_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `FK_attendance_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `FK_group_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_group_course_id` FOREIGN KEY (`course_id`) REFERENCES `cource` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_group_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_group_day_id` FOREIGN KEY (`day_id`) REFERENCES `group_day` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_group_room_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_group_status_id` FOREIGN KEY (`status_id`) REFERENCES `group_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_group_type_id` FOREIGN KEY (`type_id`) REFERENCES `group_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `group_teacher`
--
ALTER TABLE `group_teacher`
  ADD CONSTRAINT `FK_group_teacher_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_group_teacher_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `FK_person_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `person_wish`
--
ALTER TABLE `person_wish`
  ADD CONSTRAINT `FK_person_wish_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_person_wish_course_id` FOREIGN KEY (`course_id`) REFERENCES `cource` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_person_wish_day_id` FOREIGN KEY (`day_id`) REFERENCES `group_day` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_person_wish_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `person_wish_history`
--
ALTER TABLE `person_wish_history`
  ADD CONSTRAINT `FK_person_wish_history_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_person_wish_history_course_id` FOREIGN KEY (`course_id`) REFERENCES `cource` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_person_wish_history_day_id` FOREIGN KEY (`day_id`) REFERENCES `group_day` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_person_wish_history_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_student_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_social_id` FOREIGN KEY (`social_id`) REFERENCES `person_social` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_student_social_id` FOREIGN KEY (`student_social_id`) REFERENCES `student_social` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_type_id` FOREIGN KEY (`type_id`) REFERENCES `work_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `student_pay`
--
ALTER TABLE `student_pay`
  ADD CONSTRAINT `FK_student_pay_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_pay_consept_id` FOREIGN KEY (`consept_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_pay_payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_pay_status_id` FOREIGN KEY (`status_id`) REFERENCES `student_pay_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_pay_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_pay_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_task_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_status_id` FOREIGN KEY (`status_id`) REFERENCES `task_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `task_answer`
--
ALTER TABLE `task_answer`
  ADD CONSTRAINT `FK_task_answer_confirm_id` FOREIGN KEY (`confirm_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_answer_status_id` FOREIGN KEY (`status_id`) REFERENCES `task_answer_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_answer_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_answer_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `task_answer_file`
--
ALTER TABLE `task_answer_file`
  ADD CONSTRAINT `FK_task_answer_file_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_answer_file_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `task_file`
--
ALTER TABLE `task_file`
  ADD CONSTRAINT `FK_task_file_creator_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_file_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `task_user`
--
ALTER TABLE `task_user`
  ADD CONSTRAINT `FK_task_user_exec_id` FOREIGN KEY (`exec_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_user_status_id` FOREIGN KEY (`status_id`) REFERENCES `task_user_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_user_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_user_type_id` FOREIGN KEY (`type_id`) REFERENCES `task_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_task_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_type_id` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
