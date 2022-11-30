-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 30 2022 г., 16:31
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 8.1.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `analytics_type`
--

CREATE TABLE `analytics_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `group_id` int(11) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date_class` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `branch`
--

INSERT INTO `branch` (`id`, `name`, `address`, `target`, `location`, `phone`, `code`, `created`, `updated`, `status`) VALUES
(1, 'Urganch shahar Raqamli texnologiyalari markazi', '-', '-', NULL, '-', 100, '2022-11-19 15:55:35', '2022-11-19 15:55:35', 1),
(2, 'Xonqa tuman Raqamli texnologiyalari o\'quv markazi', '-', '-', NULL, '-', 101, '2022-11-19 19:54:35', '2022-11-19 19:54:35', 1);

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
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `cource`
--

INSERT INTO `cource` (`id`, `name`, `status`, `price`, `duration`, `created`, `updated`) VALUES
(1, 'Kompyuter savodxonligi', 1, 200000, 3, '2022-11-19 19:11:09', '2022-11-19 19:11:09'),
(2, 'test', 1, 123123, 1, '2022-11-19 19:36:49', '2022-11-19 19:36:49');

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
  `duration_type` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `branch_id`, `course_id`, `status_id`, `start_date`, `day_id`, `time`, `type_id`, `price`, `created`, `updated`, `creator_id`, `room_id`, `duration`, `duration_type`) VALUES
(1, 'Komp sav 1', 1, 1, 3, '2022-11-18', 1, '09:00 - 11:00', 1, 200000, '2022-11-19 20:48:13', '2022-11-29 14:55:36', 2, 1, 3, 2),
(2, 'sdfg', 1, 1, 3, NULL, 1, '09:00 - 11:00', 2, 200000, '2022-11-20 18:40:19', '2022-11-30 14:09:15', 2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `group_day`
--

CREATE TABLE `group_day` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='oquv darslari kunlari';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `group_type`
--

CREATE TABLE `group_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `name`) VALUES
(1, 'Naqd'),
(2, 'Payme'),
(3, 'Bank o\'tkazmasi naqd'),
(4, 'Bank o\'tkazmasi kartadan');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `person`
--

INSERT INTO `person` (`id`, `name`, `pnfl`, `inn`, `birthday`, `gender`, `phone`, `phone_parent`, `created`, `updated`, `branch_id`) VALUES
(5, 'Shohruh', '', '', '2022-11-10', 0, '34', '234', '2022-11-19 19:37:53', '2022-11-23 19:23:22', 1),
(6, 'Abdullayev Suxrob', '', '', '2022-11-26', 0, '345', '345', '2022-11-20 16:50:59', '2022-11-23 19:23:11', 1),
(7, 'Allabergenov Dilmurod', '', '', '2022-11-18', 0, 'sdf', 'sdf', '2022-11-20 18:27:57', '2022-11-23 19:22:52', 1),
(8, 'Umidbek Jumaniyazov', '', '', '2022-11-20', 0, 'sdf', 'sdf', '2022-11-20 19:29:52', '2022-11-23 19:22:43', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `person_social`
--

CREATE TABLE `person_social` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ijtimoiy statusi';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `person_wish`
--

INSERT INTO `person_wish` (`person_id`, `course_id`, `day_id`, `time`, `created`, `branch_id`) VALUES
(6, 2, 1, '09:00 - 11:00', '2022-11-28 17:46:31', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT 1,
  `persent` int(11) DEFAULT 0,
  `other_company` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Loyihalar';

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `name`, `status`, `persent`, `other_company`) VALUES
(1, 'Yo\'q', 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `room`
--

INSERT INTO `room` (`id`, `branch_id`, `name`) VALUES
(1, 1, '103 xona');

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
  `is_full_paid` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `code`, `code_id`, `group_id`, `person_id`, `social_id`, `project_id`, `created`, `updated`, `end_date`, `creator_id`, `branch_id`, `status`, `type_id`, `student_social_id`, `is_full_paid`) VALUES
(21, '22/100-1', 1, 1, 5, 1, 1, '2022-11-23 19:42:59', '2022-11-29 14:55:36', '2022-11-29', 2, 1, 3, 1, 1, 0),
(22, '22/100-2', 2, 1, 6, 1, 1, '2022-11-23 19:43:01', '2022-11-29 14:55:36', '2022-11-29', 2, 1, 3, 1, 1, 0),
(23, '22/100-3', 3, 1, 7, 1, 1, '2022-11-23 19:43:02', '2022-11-29 14:55:36', '2022-11-29', 2, 1, 3, 1, 1, 0),
(24, '22/100-4', 4, 1, 8, 1, 1, '2022-11-23 19:43:04', '2022-11-29 14:55:36', '2022-11-29', 2, 1, 3, 1, 1, 0),
(25, '22/100-5', 5, 2, 6, 1, 1, '2022-11-30 14:09:05', '2022-11-30 14:09:15', '2022-11-30', 2, 1, 3, 1, 4, 0);

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
  `paid_date` date DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `consept_id` int(11) DEFAULT NULL,
  `check_file` varchar(255) DEFAULT NULL,
  `ads` text DEFAULT NULL,
  `status_id` int(11) DEFAULT 1,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `other_company` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `student_pay`
--

INSERT INTO `student_pay` (`student_id`, `id`, `code`, `pay_date`, `price`, `paid_date`, `payment_id`, `branch_id`, `user_id`, `consept_id`, `check_file`, `ads`, `status_id`, `created`, `updated`, `other_company`) VALUES
(21, 0, '22/100-1', '2022-11-22', 200000, '2022-11-23', 1, 1, 2, 5, '1669218606.343.pdf', 'asdasd', 3, '2022-11-23 19:47:41', '2022-11-23 22:00:37', 0),
(21, 1, '22/100-1', '2022-12-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(21, 2, '22/100-1', '2023-01-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(22, 0, '22/100-2', '2022-11-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(22, 1, '22/100-2', '2022-12-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(22, 2, '22/100-2', '2023-01-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(23, 0, '22/100-3', '2022-11-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(23, 1, '22/100-3', '2022-12-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(23, 2, '22/100-3', '2023-01-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(24, 0, '22/100-4', '2022-11-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(24, 1, '22/100-4', '2022-12-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(24, 2, '22/100-4', '2023-01-22', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-23 19:47:41', '2022-11-23 19:47:41', 0),
(25, 0, '22/100-5', '2022-12-04', 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-30 14:09:05', '2022-11-30 14:09:11', 0),
(25, 1, '22/100-5', NULL, 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-30 14:09:05', '2022-11-30 14:09:05', 0),
(25, 2, '22/100-5', NULL, 200000, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2022-11-30 14:09:05', '2022-11-30 14:09:05', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `student_pay_status`
--

CREATE TABLE `student_pay_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `student_type`
--

INSERT INTO `student_type` (`id`, `name`) VALUES
(1, 'Yo\'q'),
(2, 'Davlat tashikiloti'),
(3, 'Xo\'jalik tashkiloti');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `branch_id`, `role_id`, `status`, `state`, `type_id`) VALUES
(1, 'Umidbek Jumaniyazov', 'umidbek', '$2y$13$4u.r5VAziP98/.6U2SN4eueEXa/jbPz1kDjnalh3TcGM6mPQiTeVq', NULL, 7, 1, 1, 2),
(2, 'Urganch shahar', 'urganchsh', '$2y$13$4NbAU/.5EvUzDrziG/BtL.fV/wXBjZkSuU2JjYJ4l3miCIzPbiWKO', 1, 2, 1, 1, 2),
(3, 'O\'qituvchi', 'teacher', '$2y$13$LqYmPTIkI7QSU5gnGnFMQuT.42w9VJFABNqeldFfifhEbM2Rz4Z/.', 1, 1, 0, 0, 1),
(4, 'xonqa', 'xonqa', '$2y$13$OwtnxlL8HAP9XhBIMOn.EOBybhIEVaEtXyvf/ZfQXKRRA.e7fc4f.', 2, 2, 1, 1, 2),
(5, 'Buxgalter', 'bux', '$2y$13$5q9882OHPBIGWn31pIRDVuCXA93u/yZtTvdO6SbfMTSjL57bGF4qm', NULL, 3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`group_id`,`student_id`,`teacher_id`,`date_class`),
  ADD KEY `FK_attendance_student_id` (`student_id`),
  ADD KEY `FK_attendance_teacher_id` (`teacher_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `cource`
--
ALTER TABLE `cource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `person`
--
ALTER TABLE `person`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `person_social`
--
ALTER TABLE `person_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `person_wish_history`
--
ALTER TABLE `person_wish_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `FK_attendance_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_attendance_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_attendance_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
