-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.0.57
-- Время создания: Ноя 27 2022 г., 06:31
-- Версия сервера: 5.7.37-40
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `RD-ADMIN`
--

CREATE TABLE `RD-ADMIN` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `error` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `RD-ADMIN`
--

INSERT INTO `RD-ADMIN` (`id`, `login`, `password`, `error`, `ip`) VALUES
(1, 'test', 'test', 0, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `RD-BCCONSOLE`
--

CREATE TABLE `RD-BCCONSOLE` (
  `id` int(11) NOT NULL,
  `cmd` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-CATEGORY`
--

CREATE TABLE `RD-CATEGORY` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Site by vk.com/lucifer2033',
  `pos` int(11) NOT NULL DEFAULT '1',
  `server` varchar(255) NOT NULL DEFAULT 'Site by vk.com/lucifer2033'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-DONAT`
--

CREATE TABLE `RD-DONAT` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Site by vk.com/lucifer2033',
  `price` int(11) NOT NULL DEFAULT '10',
  `command` varchar(255) NOT NULL DEFAULT 'me Site by vk.com/lucifer2033',
  `doplata` tinyint(1) NOT NULL DEFAULT '0',
  `pos` int(11) NOT NULL DEFAULT '1',
  `category` varchar(255) NOT NULL DEFAULT 'Site by vk.com/lucifer2033',
  `server` varchar(255) NOT NULL DEFAULT 'Site by vk.com/lucifer2033',
  `lockup` tinyint(1) NOT NULL DEFAULT '0',
  `amount` varchar(255) NOT NULL DEFAULT '*'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-ODERS`
--

CREATE TABLE `RD-ODERS` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `base64` varchar(255) NOT NULL,
  `sha256` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-PAGES`
--

CREATE TABLE `RD-PAGES` (
  `id` int(11) NOT NULL,
  `idname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-PAYMENT`
--

CREATE TABLE `RD-PAYMENT` (
  `id` int(11) NOT NULL,
  `nick` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `namedonat` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `server` varchar(255) NOT NULL,
  `give` int(11) NOT NULL DEFAULT '0',
  `base64` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-PROMOCODE`
--

CREATE TABLE `RD-PROMOCODE` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-RCONDATA`
--

CREATE TABLE `RD-RCONDATA` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL DEFAULT 'Site by vk.com/lucifer2033',
  `port` int(11) NOT NULL,
  `rconport` int(255) NOT NULL DEFAULT '25575',
  `password` varchar(255) NOT NULL DEFAULT 'me Site by vk.com/lucifer2033',
  `server` varchar(255) NOT NULL DEFAULT 'Site by vk.com/lucifer2033',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-SILKA`
--

CREATE TABLE `RD-SILKA` (
  `id` int(11) NOT NULL,
  `silka` varchar(255) NOT NULL,
  `header` tinyint(1) NOT NULL,
  `footer` tinyint(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `RD-UCONSOLE`
--

CREATE TABLE `RD-UCONSOLE` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `error` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `Anarchy` tinyint(1) NOT NULL DEFAULT '0',
  `SkyBlock` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `RD-ADMIN`
--
ALTER TABLE `RD-ADMIN`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-BCCONSOLE`
--
ALTER TABLE `RD-BCCONSOLE`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-CATEGORY`
--
ALTER TABLE `RD-CATEGORY`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-DONAT`
--
ALTER TABLE `RD-DONAT`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-ODERS`
--
ALTER TABLE `RD-ODERS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-PAGES`
--
ALTER TABLE `RD-PAGES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-PAYMENT`
--
ALTER TABLE `RD-PAYMENT`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-PROMOCODE`
--
ALTER TABLE `RD-PROMOCODE`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-RCONDATA`
--
ALTER TABLE `RD-RCONDATA`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-SILKA`
--
ALTER TABLE `RD-SILKA`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `RD-UCONSOLE`
--
ALTER TABLE `RD-UCONSOLE`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `RD-ADMIN`
--
ALTER TABLE `RD-ADMIN`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `RD-BCCONSOLE`
--
ALTER TABLE `RD-BCCONSOLE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-CATEGORY`
--
ALTER TABLE `RD-CATEGORY`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-DONAT`
--
ALTER TABLE `RD-DONAT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-ODERS`
--
ALTER TABLE `RD-ODERS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-PAGES`
--
ALTER TABLE `RD-PAGES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-PAYMENT`
--
ALTER TABLE `RD-PAYMENT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-PROMOCODE`
--
ALTER TABLE `RD-PROMOCODE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-RCONDATA`
--
ALTER TABLE `RD-RCONDATA`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-SILKA`
--
ALTER TABLE `RD-SILKA`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `RD-UCONSOLE`
--
ALTER TABLE `RD-UCONSOLE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
