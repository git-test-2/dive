-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 04 2022 г., 20:03
-- Версия сервера: 5.6.43
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dave_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `general_information`
--

CREATE TABLE `general_information` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `general_information`
--

INSERT INTO `general_information` (`id`, `username`, `job_title`, `tel`, `address`) VALUES
(148, 'Вася', 'тут', '+2 12345', 'АААААА');

-- --------------------------------------------------------

--
-- Структура таблицы `social_networks`
--

CREATE TABLE `social_networks` (
  `id` int(11) NOT NULL,
  `vk` varchar(255) NOT NULL,
  `telegram` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `social_networks`
--

INSERT INTO `social_networks` (`id`, `vk`, `telegram`, `instagram`) VALUES
(148, 'вк', 'тел ', 'инст');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_link` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `tags` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `work` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `email_link`, `password`, `role`, `tags`, `image`, `name`, `work`, `tel`, `address`, `status`) VALUES
(44, 'you@site.ru', '', '$2y$10$hhNE5ODyW1iwC5Ms7RG4kuKq0pzDIrf20WiDNSNIf9OUORNU0eeCm', 'admin', '', '', '', '', '', '', ''),
(45, 'you222@site.ru', '', '$2y$10$ytKQpKdJGDmdMmMYfwyVg.SGc5BfOtzW7yE5iKMHyjFPv8oG6ZIra', '', '', '', '', '', '', '', ''),
(46, 'you1@site.ru', '', '$2y$10$KTfHwXo/6d/vUuLYB45MnOAIBm9lW7LZJvlwdPOZNfduzhpm8DTnq', '', '', '', '', '', '', '', ''),
(47, 'you333@site.ru', '', '$2y$10$9iXDsAec0p1S.RFwLQL74uJct4b1.PFUv11dZhZLUiEOcqP30qJVG', '', '', '', '', '', '', '', ''),
(51, 'you777@site.ru', '', '$2y$10$PWddnvf2d3Gdap2vSEePwe8fmntSgZYoGb/QrsjJV7JVt4FpBTu2m', 'admin', '', '', '', '', '', '', ''),
(52, 'oliver.kopyov@smartadminwebapp.com', 'oliver.kopyov@smartadminwebapp.com', '', 'user', 'oliver kopyov', 'img/demo/avatars/avatar-b.png', 'Oliver Kopyov', 'IT Director, Gotbootstrap Inc.', '317-456-2564', '15 Charist St, Detroit, MI, 48212, USA', 'success'),
(54, 'Alita@smartadminwebapp.com', 'mailto:oliver.kopyov@smartadminwebapp.com', '', 'user', 'alita gray', 'img/demo/avatars/avatar-c.png', 'Alita Gray', 'Project Manager, Gotbootstrap Inc.', '+1 313-461-1347', '134 Hamtrammac, Detroit, MI, 48314, USA', 'warning'),
(55, 'john.cook@smartadminwebapp.com', 'mailto:oliver.kopyov@smartadminwebapp.com', '', 'user', 'dr john cook', 'img/demo/avatars/avatar-e.png', 'Dr. John Cook PhD', 'Human Resources, Gotbootstrap Inc.', '+1 313-779-1347', '55 Smyth Rd, Detroit, MI, 48341, USA', 'danger'),
(56, 'jim.ketty@smartadminwebapp.com', 'mailto:oliver.kopyov@smartadminwebapp.com', '', 'user', 'jim ketty', 'img/demo/avatars/avatar-k.png', 'Jim Ketty', 'Staff Orgnizer, Gotbootstrap Inc.', '+1 313-779-3314', '134 Tasy Rd, Detroit, MI, 48212, USA', 'success'),
(57, 'john.oliver@smartadminwebapp.com', 'mailto:oliver.kopyov@smartadminwebapp.com', '', 'user', 'aaron tellus', 'img/demo/avatars/avatar-g.png', 'Dr. John Oliver', 'Oncologist, Gotbootstrap Inc.', '+1 313-779-8134', '134 Gallery St, Detroit, MI, 46214, USA', 'success'),
(58, 'sarah.mcbrook@smartadminwebapp.com', 'mailto:oliver.kopyov@smartadminwebapp.com', '', 'user', 'sarah mcbrook', 'img/demo/avatars/avatar-h.png', 'Sarah McBrook', 'Xray Division, Gotbootstrap Inc.', '+1 313-779-7613', '13 Jamie Rd, Detroit, MI, 48313, USA', 'success'),
(59, 'jimmy.fallan@smartadminwebapp.com', 'mailto:oliver.kopyov@smartadminwebapp.com', '', 'user', 'jimmy fellan', 'img/demo/avatars/avatar-i.png', 'Jimmy Fellan', 'Accounting, Gotbootstrap Inc.', '+1 313-779-4314', '55 Smyth Rd, Detroit, MI, 48341, USA', 'success'),
(60, 'arica.grace@smartadminwebapp.com', 'mailto:oliver.kopyov@smartadminwebapp.com', '', 'user', 'arica grace', 'img/demo/avatars/avatar-j.png', 'Arica Grace', 'Accounting, Gotbootstrap Inc.', '+1 313-779-3347', '798 Smyth Rd, Detroit, MI, 48341, USA', 'success'),
(148, 'vas@site.ru', '', '$2y$10$8KKWcTUgZpHohmMSos4sPOV4H88NOMAy.gwzN.wdd8rnRJSJuEPj2', 'user', '', 'upload/629b8d4704ff4.jpg', '', '', '', '', 'danger');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `general_information`
--
ALTER TABLE `general_information`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_networks`
--
ALTER TABLE `social_networks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
