-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 09 2014 г., 23:22
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список городов' AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_comment`
--

CREATE TABLE IF NOT EXISTS `a_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_post` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_complect`
--

CREATE TABLE IF NOT EXISTS `a_complect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modify_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица комплектации авто' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_configure`
--

CREATE TABLE IF NOT EXISTS `a_configure` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `theme` varchar(50) DEFAULT NULL COMMENT 'Название темы по-умолчанию',
  `language` varchar(50) DEFAULT NULL COMMENT 'Название языка интерфейса Название темы по-умолчанию',
  `time_zone` varchar(10) DEFAULT NULL COMMENT 'Часовой пояс Название темы по-умолчанию',
  `row_count` int(11) DEFAULT '10' COMMENT 'Количество записей на странице',
  `yandex` varchar(1000) DEFAULT NULL COMMENT 'Счетчик Яндекс-метрики',
  `google` varchar(1000) DEFAULT NULL COMMENT 'Счетчик Google-аналитики',
  `liveinternet` varchar(1000) DEFAULT NULL COMMENT 'Счетчик LiveInternet',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица пользовательских настроек' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_counter`
--

CREATE TABLE IF NOT EXISTS `a_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `group_counter_id` int(11) NOT NULL COMMENT 'Идентификатор группы счетчика',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок',
  `description` varchar(1000) DEFAULT NULL COMMENT 'Описание',
  `code` varchar(1000) NOT NULL COMMENT 'Код счетчика',
  `url` varchar(1000) DEFAULT NULL COMMENT 'Внешний адрес',
  `login` varchar(50) DEFAULT NULL COMMENT 'Логин для доступа к счетчику',
  `password` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Пароль для доступа к счетчику',
  `is_visible` tinyint(1) DEFAULT '1' COMMENT 'Видимость',
  `create_date` datetime DEFAULT NULL COMMENT 'Дата создания',
  `modify_date` datetime DEFAULT NULL COMMENT 'Дата модификации',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица Яндекс-метрик' AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_counter_mark`
--

CREATE TABLE IF NOT EXISTS `a_counter_mark` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `counter_id` int(11) NOT NULL COMMENT 'Идентификатор счетчика',
  `mark_id` int(11) NOT NULL COMMENT 'Идентификатор марки авто',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица связи Many-to-Many для "Счетчиков-Марок"' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_counter_model`
--

CREATE TABLE IF NOT EXISTS `a_counter_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `counter_id` int(11) NOT NULL COMMENT 'Идентификатор счетчика',
  `model_id` int(11) NOT NULL COMMENT 'Идентификатор модели',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица связи Many-to-Many для "Счетчиков-Моделей"' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_counter_page`
--

CREATE TABLE IF NOT EXISTS `a_counter_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `counter_id` int(11) NOT NULL COMMENT 'Идентификатор счетчика',
  `page_id` int(11) NOT NULL COMMENT 'Идентификатор страницы',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица связи Many-to-Many для "Счетчиков-Страниц"' AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список стран' AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список галлерей' AUTO_INCREMENT=3 ;

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
-- Структура таблицы `a_group_counter`
--

CREATE TABLE IF NOT EXISTS `a_group_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `title` varchar(20) NOT NULL COMMENT 'Заголовок',
  `code` varchar(2) NOT NULL COMMENT 'Код счетчика',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица групп счетчиков' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_group_page`
--

CREATE TABLE IF NOT EXISTS `a_group_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица групп страниц' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_group_request`
--

CREATE TABLE IF NOT EXISTS `a_group_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица статусов заявок' AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список марок автомобилей' AUTO_INCREMENT=41 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список марок автомобилей' AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_modify`
--

CREATE TABLE IF NOT EXISTS `a_modify` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок',
  `description` varchar(5000) DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT '1' COMMENT 'Видимость',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_page`
--

CREATE TABLE IF NOT EXISTS `a_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `group_page_id` int(11) DEFAULT NULL COMMENT 'Идентификатор группы',
  `title` varchar(200) NOT NULL COMMENT 'Заголовок',
  `text` mediumtext NOT NULL COMMENT 'Содержаниеску',
  `is_visible` tinyint(1) DEFAULT '1' COMMENT 'Видимость',
  `create_date` datetime DEFAULT NULL COMMENT 'Дата создания',
  `modify_date` datetime DEFAULT NULL COMMENT 'Дата модификации',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица со страницами' AUTO_INCREMENT=47 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список фотографий' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_post`
--

CREATE TABLE IF NOT EXISTS `a_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_author` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_request`
--

CREATE TABLE IF NOT EXISTS `a_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор таблицы',
  `group_request_id` int(11) DEFAULT '1' COMMENT 'Идентификатор статуса заявки',
  `title` varchar(50) DEFAULT 'Online-кредит Автосалон.РФ' COMMENT 'Заголовок',
  `name` varchar(50) DEFAULT NULL COMMENT 'ФИО пользователя',
  `firstname` varchar(50) DEFAULT NULL COMMENT 'Фамилия  пользователя',
  `lastname` varchar(50) DEFAULT NULL COMMENT 'Имя пользователя',
  `patronymic` varchar(50) DEFAULT NULL COMMENT 'Отчество пользователя',
  `age` varchar(20) DEFAULT NULL COMMENT 'Возраст пользователя',
  `phone` varchar(20) NOT NULL COMMENT 'Контактный телефон пользователя',
  `work_phone` varchar(20) DEFAULT NULL COMMENT 'Рабочий телефон пользователя',
  `home_phone` varchar(20) DEFAULT NULL COMMENT 'Домашний телефон пользователя',
  `country_id` int(11) DEFAULT '1' COMMENT 'Страна пользователя',
  `city_id` int(11) DEFAULT '1' COMMENT 'Город пользователя',
  `address` varchar(100) DEFAULT NULL COMMENT 'Адрес пользователя',
  `work_name` varchar(50) DEFAULT NULL COMMENT 'Название организации пользователя',
  `profit` varchar(50) DEFAULT NULL COMMENT 'Доход пользователя',
  `experience` varchar(20) DEFAULT NULL COMMENT 'Опыт работы пользователя',
  `passport` varchar(20) DEFAULT NULL COMMENT 'Номер паспорта пользователя',
  `driver_license` varchar(20) DEFAULT NULL COMMENT 'Номер водительского удостоверения пользователя',
  `is_kasko` tinyint(1) DEFAULT '0' COMMENT 'КАСКО',
  `type_auto` varchar(20) DEFAULT 'Новая' COMMENT 'Тип автомобиля (б\\у или новая)',
  `mark_id` int(11) NOT NULL COMMENT 'Идентификатор марки автомобиля',
  `model_id` int(11) NOT NULL COMMENT 'Идентификатор модели автомобиля',
  `compl` varchar(100) DEFAULT NULL COMMENT 'Комплектация автомобиля',
  `create_date` datetime DEFAULT NULL COMMENT 'Дата создания заявки',
  `modify_date` datetime DEFAULT NULL COMMENT 'Дата обновления заявки',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица online-автокредитов' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_tag`
--

CREATE TABLE IF NOT EXISTS `a_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_tag_page`
--

CREATE TABLE IF NOT EXISTS `a_tag_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `tag_id` int(11) NOT NULL COMMENT 'Идентификатор тегов',
  `page_id` int(11) NOT NULL COMMENT 'Идентификатор страниц',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица тегов' AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Структура таблицы `a_user`
--

CREATE TABLE IF NOT EXISTS `a_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор пользователя',
  `group_id` int(5) DEFAULT NULL COMMENT 'Идентификатор группы',
  `theme_id` int(11) DEFAULT NULL COMMENT 'Идентификатор темы',
  `language_id` int(11) DEFAULT NULL COMMENT 'Идентификатор языка интерфейса',
  `time_zone_id` int(11) DEFAULT NULL COMMENT 'Идентификатор часового пояса',
  `row_count` int(11) DEFAULT '10' COMMENT 'Количество записей на странице',
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
