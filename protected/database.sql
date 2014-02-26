-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 19 2013 г., 20:29
-- Версия сервера: 5.5.28
-- Версия PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `fs-rfe`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--
-- Создание: Июл 18 2013 г., 14:47
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `airport`
--
-- Создание: Июл 18 2013 г., 14:47
--

DROP TABLE IF EXISTS `airport`;
CREATE TABLE IF NOT EXISTS `airport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventid` int(11) NOT NULL,
  `icao` varchar(4) NOT NULL,
  `name` varchar(128) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `airportdb`
--
-- Создание: Июл 19 2013 г., 16:26
--

DROP TABLE IF EXISTS `airportdb`;
CREATE TABLE IF NOT EXISTS `airportdb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iata` varchar(3) DEFAULT NULL,
  `icao` varchar(4) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `country_iso` varchar(2) DEFAULT NULL,
  `lat` varchar(32) DEFAULT NULL,
  `lon` varchar(32) DEFAULT NULL,
  `elevation` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9379 ;

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--
-- Создание: Июл 18 2013 г., 14:47
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `flightid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--
-- Создание: Июл 18 2013 г., 14:47
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET latin1 NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `flight`
--
-- Создание: Июл 18 2013 г., 14:47
--

DROP TABLE IF EXISTS `flight`;
CREATE TABLE IF NOT EXISTS `flight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `airportid` int(11) NOT NULL,
  `fromicao` varchar(4) NOT NULL,
  `toicao` varchar(4) NOT NULL,
  `fromtime` time NOT NULL,
  `totime` time NOT NULL,
  `arrival` int(11) NOT NULL,
  `aircraft` varchar(4) NOT NULL,
  `gate` varchar(5) DEFAULT NULL,
  `airline` varchar(3) DEFAULT NULL,
  `flightnumber` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `slot`
--
-- Создание: Июл 18 2013 г., 20:00
--

DROP TABLE IF EXISTS `slot`;
CREATE TABLE IF NOT EXISTS `slot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `airportid` int(11) NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `slotreserve`
--
-- Создание: Июл 18 2013 г., 19:52
--

DROP TABLE IF EXISTS `slotreserve`;
CREATE TABLE IF NOT EXISTS `slotreserve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `slotid` int(11) NOT NULL,
  `airport` varchar(4) NOT NULL,
  `arrival` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `turnaround`
--
-- Создание: Июл 18 2013 г., 14:47
--

DROP TABLE IF EXISTS `turnaround`;
CREATE TABLE IF NOT EXISTS `turnaround` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flttoid` int(11) NOT NULL,
  `fltfromid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--
-- Создание: Июл 18 2013 г., 14:47
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(72) NOT NULL,
  `vid` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `rating` int(11) NOT NULL,
  `ratingatc` int(11) NOT NULL,
  `ratingpilot` int(11) NOT NULL,
  `division` varchar(2) NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `adminlog`
--
CREATE TABLE IF NOT EXISTS `adminlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `isadmin` int(11) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `url` varchar(1024) DEFAULT NULL,
  `result` varchar(32) DEFAULT NULL,
  `message` varchar(8192) DEFAULT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
