-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 13 2022 г., 15:03
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
  `time` varchar(10) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creator_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Davlat xizmatchilari uchun');

-- --------------------------------------------------------

--
-- Структура таблицы `pay`
--

CREATE TABLE `pay` (
  `id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_id` int(11) NOT NULL DEFAULT 0,
  `consept_id` int(11) DEFAULT NULL,
  `check_file` varchar(255) DEFAULT NULL,
  `ads` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Структура таблицы `pay_status`
--

CREATE TABLE `pay_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `pay_status`
--

INSERT INTO `pay_status` (`id`, `name`) VALUES
(1, 'Yangi to\'lov'),
(2, 'Tasdiqlangan'),
(3, 'Rad qilingan');

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
  `phone` varchar(255) DEFAULT NULL,
  `phone_parent` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Loyihalar';

-- --------------------------------------------------------

--
-- Структура таблицы `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` bigint(20) NOT NULL,
  `group_id` int(11) NOT NULL,
  `person_id` bigint(20) NOT NULL,
  `social_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creator_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Filial menejeri', '/bmanager/', 1),
(3, 'Buxgalter', '/bux/', 1),
(4, 'Direktor', '/director/', 1),
(5, 'Menejer', '/manager/', 1),
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

--
-- Индексы сохранённых таблиц
--

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
-- Индексы таблицы `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pay_student_id` (`student_id`),
  ADD KEY `FK_pay_branch_id` (`branch_id`),
  ADD KEY `FK_pay_payment_id` (`payment_id`),
  ADD KEY `FK_pay_user_id` (`user_id`),
  ADD KEY `FK_pay_consept_id` (`consept_id`),
  ADD KEY `FK_pay_status_id` (`status_id`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pay_status`
--
ALTER TABLE `pay_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `person_social`
--
ALTER TABLE `person_social`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `FK_student_creator_id` (`creator_id`);

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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cource`
--
ALTER TABLE `cource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `group_day`
--
ALTER TABLE `group_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `group_status`
--
ALTER TABLE `group_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `group_type`
--
ALTER TABLE `group_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `pay`
--
ALTER TABLE `pay`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pay_status`
--
ALTER TABLE `pay_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `person`
--
ALTER TABLE `person`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `person_social`
--
ALTER TABLE `person_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Ограничения внешнего ключа сохраненных таблиц
--

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
-- Ограничения внешнего ключа таблицы `pay`
--
ALTER TABLE `pay`
  ADD CONSTRAINT `FK_pay_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pay_consept_id` FOREIGN KEY (`consept_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pay_payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pay_status_id` FOREIGN KEY (`status_id`) REFERENCES `pay_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pay_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pay_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_student_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_social_id` FOREIGN KEY (`social_id`) REFERENCES `person_social` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
