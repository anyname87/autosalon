-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 09 2013 г., 19:56
-- Версия сервера: 5.5.32
-- Версия PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `a_auto`
--
CREATE DATABASE IF NOT EXISTS `a_auto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `a_auto`;

-- --------------------------------------------------------

--
-- Структура таблицы `a_action`
--

CREATE TABLE IF NOT EXISTS `a_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор акции',
  `group_action_id` int(11) NOT NULL COMMENT 'Идентификатор группы акции',
  `second_id` int(11) NOT NULL COMMENT 'Идентификатор внешнего ключа',
  `date_expire` date NOT NULL COMMENT 'Дата истечения',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Видимость',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица с акциями' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_city`
--

CREATE TABLE IF NOT EXISTS `a_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор города',
  `country_id` int(11) NOT NULL COMMENT 'Идентификатор страны',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок города',
  `code_phone` varchar(10) DEFAULT NULL COMMENT 'Код телефона города',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список городов' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_country`
--

CREATE TABLE IF NOT EXISTS `a_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор страны',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок страны',
  `code_phone` varchar(10) DEFAULT NULL COMMENT 'Код телефона страны',
  `picture` varchar(200) DEFAULT NULL COMMENT 'Изображение страны',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список стран' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_gallery`
--

CREATE TABLE IF NOT EXISTS `a_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор галлереи',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок галлереи',
  `description` varchar(5000) NOT NULL COMMENT 'Описание галлереи',
  `is_visible` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Видимость галлереи',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список галлерей' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_group`
--

CREATE TABLE IF NOT EXISTS `a_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор группы',
  `value` int(5) DEFAULT '50' COMMENT 'Вес группы',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок группы',
  `description` varchar(5000) DEFAULT NULL COMMENT 'Описание группы',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список групп' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_group_action`
--

CREATE TABLE IF NOT EXISTS `a_group_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор группы акций',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок группы акций',
  `for_table` varchar(50) DEFAULT NULL COMMENT 'Таблица источник акций',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список групп акций' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_mark`
--

CREATE TABLE IF NOT EXISTS `a_mark` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор марки',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок марки',
  `description` varchar(5000) DEFAULT NULL COMMENT 'Описание марки',
  `small_img` varchar(200) DEFAULT NULL COMMENT 'Малая картинка',
  `full_img` varchar(200) DEFAULT NULL COMMENT 'Полная картинка',
  `group_cars_id` int(11) DEFAULT NULL COMMENT 'Идентификатор группы машин',
  `gallery_id` int(11) DEFAULT NULL COMMENT 'Идентификатор галлереи',
  `priority` int(11) NOT NULL COMMENT 'Приоритет марки',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Видимость',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список марок автомобилей' AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_model`
--

CREATE TABLE IF NOT EXISTS `a_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор модели',
  `group_id` int(11) NOT NULL COMMENT 'Идентификатор группы',
  `gallery_id` int(11) DEFAULT NULL COMMENT 'Идентификатор галлереи',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок модели',
  `description` varchar(5000) DEFAULT NULL COMMENT 'Описание модели',
  `price` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL COMMENT 'Приоритет модели',
  `full_img` varchar(200) DEFAULT NULL,
  `is_index_page` tinyint(1) DEFAULT '0' COMMENT 'Отображать на главной странице',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Видимость',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список марок автомобилей' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_photo`
--

CREATE TABLE IF NOT EXISTS `a_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор фотографии',
  `gallery_id` int(11) NOT NULL COMMENT 'Идентификатор галлереи',
  `title` varchar(50) DEFAULT NULL COMMENT 'Заголовок фотографии',
  `description` varchar(5000) DEFAULT NULL COMMENT 'Описание фотографии',
  `src` varchar(200) NOT NULL COMMENT 'Адрес фотографии',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Видимость',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список фотографий' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_user`
--

CREATE TABLE IF NOT EXISTS `a_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор пользователя',
  `group_id` int(5) DEFAULT NULL COMMENT 'Идентификатор группы',
  `email` varchar(50) NOT NULL COMMENT 'E-mail (Login)',
  `password` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'Пароль',
  `firstname` varchar(30) DEFAULT NULL COMMENT 'Фамилия',
  `lastname` varchar(30) DEFAULT NULL COMMENT 'Имя',
  `patronimico` varchar(30) DEFAULT NULL COMMENT 'Отчество',
  `phone` varchar(50) DEFAULT NULL COMMENT 'Телефон',
  `work_phone` varchar(50) DEFAULT NULL COMMENT 'Рабочий телефон',
  `country` int(5) DEFAULT NULL COMMENT 'Идентификатор страны',
  `city` int(5) DEFAULT NULL COMMENT 'Идентификатор города',
  `skype` varchar(50) DEFAULT NULL COMMENT 'Skype',
  `icq` varchar(15) DEFAULT NULL COMMENT 'ICQ',
  `description` varchar(5000) DEFAULT NULL COMMENT 'Описание',
  `photo` varchar(200) DEFAULT NULL COMMENT 'Адрес изображения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей' AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
