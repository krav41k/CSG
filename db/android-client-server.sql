-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 04 2019 г., 10:46
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `android-client-server`
--

-- --------------------------------------------------------

--
-- Структура таблицы `duel`
--

CREATE TABLE IF NOT EXISTS `duel` (
  `firstPlayer` int(2) NOT NULL,
  `secondPlayer` int(2) NOT NULL,
  `firstScore` int(1) NOT NULL,
  `secondScore` int(1) NOT NULL,
  `firstA` tinyint(1) NOT NULL,
  `secondA` tinyint(1) NOT NULL,
  `rightA` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `duel`
--

INSERT INTO `duel` (`firstPlayer`, `secondPlayer`, `firstScore`, `secondScore`, `firstA`, `secondA`, `rightA`) VALUES
(1, 5, 0, 0, 2, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `round` int(2) NOT NULL,
  `time` int(4) NOT NULL,
  `eventTime` int(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `joker` varchar(2) NOT NULL,
  `day` varchar(2) NOT NULL,
  `Qstage` int(2) NOT NULL,
  `Qnumber` int(2) NOT NULL,
  `Gstage` int(2) NOT NULL,
  `Gnumber` int(2) NOT NULL,
  `Qstatus` tinyint(1) NOT NULL,
  `orientation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `game`
--

INSERT INTO `game` (`round`, `time`, `eventTime`, `status`, `joker`, `day`, `Qstage`, `Qnumber`, `Gstage`, `Gnumber`, `Qstatus`, `orientation`) VALUES
(0, 0, 60, 1, '1', '1', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `floatName` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `score` tinyint(2) NOT NULL,
  `view` tinyint(1) NOT NULL,
  `password` varchar(4) NOT NULL,
  `answer` varchar(20) NOT NULL,
  `shadow` varchar(10) NOT NULL,
  `background` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `players`
--

INSERT INTO `players` (`id`, `name`, `floatName`, `nickname`, `score`, `view`, `password`, `answer`, `shadow`, `background`) VALUES
(1, 'test', 'test', ' ', 1, 0, '1790', '', 'white', 7),
(2, 'Варфоломей', '', ' ', 0, 0, '2068', '', 'white', 2),
(3, '123', '', ' ', 0, 0, '8067', '', 'white', 3),
(4, 'player4', '', ' ', 0, 0, '8171', '', 'white', 4),
(5, 'player5', '', ' ', 0, 0, '3125', '', 'white', 5),
(6, 'Алексей', '', 'hahaha', 9, 0, '8628', '', 'white', 6),
(7, 'bug5layer', 'bug5layer', ' ', 0, 0, '5912', '', 'white', 7),
(8, 'player8', '', ' ', 0, 0, '7902', '', 'white', 8),
(9, 'player9', '', ' ', 0, 0, '8098', '', 'white', 9),
(10, 'player10', '', ' ', 0, 0, '6803', '', 'white', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `Qnumber` tinyint(2) NOT NULL,
  `Qstage` tinyint(2) NOT NULL,
  `Qtype` varchar(4) NOT NULL,
  `Qdata` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `Atype` varchar(4) NOT NULL,
  `Adata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`Qnumber`, `Qstage`, `Qtype`, `Qdata`, `status`, `Atype`, `Adata`) VALUES
(1, 1, 'text', 'Сколько ног у сороконожки?', '1', 'text', '40'),
(2, 1, 'text', 'Как звали убийцу королей?', '1', 'text', 'Джофри.'),
(3, 1, 'text', 'Что общего у ёжика и молока?', '1', 'text', 'Сворачивание.'),
(1, 2, 'text', 'В каком городе жил Дракула?', '1', 'text', 'Трансильвания.'),
(2, 2, 'text', 'Язык программирования логотипом которого есть чашка с чаем.', '0', 'text', 'Java');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
