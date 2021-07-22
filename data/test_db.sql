-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 22 2021 г., 19:48
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_db`
--
CREATE DATABASE IF NOT EXISTS `test_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `test_db`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `created`, `modified`) VALUES
(1, 'Деловые', '2021-07-11 16:58:13', '2021-07-11 16:58:13'),
(2, 'Детские', '2021-07-11 16:58:27', '2021-07-11 16:58:27'),
(3, 'Дизайн', '2021-07-11 16:58:33', '2021-07-11 16:58:33'),
(4, 'Разработка', '2021-07-11 16:58:39', '2021-07-11 16:58:39'),
(6, 'Саморазвитие', '2021-07-13 02:06:34', '2021-07-13 02:20:18');

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE `links` (
  `id_link` int NOT NULL,
  `id_material` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id_link`, `id_material`, `name`, `link`, `created`, `modified`) VALUES
(1, 1, 'Google', 'https://www.google.com', '2021-07-20 15:22:47', '2021-07-22 16:05:46'),
(4, 2, 'Яндекс', 'https://yandex.ru', '2021-07-20 20:42:09', '2021-07-22 16:05:50');

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `id_material` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sub_category` int NOT NULL,
  `id_type` int NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(4096) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id_material`, `name`, `id_sub_category`, `id_type`, `author`, `description`, `created`, `modified`) VALUES
(1, 'Путь джедая', 19, 1, 'Максим Дорофеев', '', '2021-07-13 02:23:20', '2021-07-18 13:56:07'),
(2, 'Полное руководство по Yii 2.0', 11, 4, 'Александр Макаров', '', '2021-07-13 02:24:43', '2021-07-18 13:56:11');

-- --------------------------------------------------------

--
-- Структура таблицы `materials_tags`
--

CREATE TABLE `materials_tags` (
  `id_material` int NOT NULL,
  `id_tag` int NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `materials_tags`
--

INSERT INTO `materials_tags` (`id_material`, `id_tag`, `created`, `modified`) VALUES
(1, 18, '2021-07-22 13:17:22', '2021-07-22 13:17:22'),
(1, 20, '2021-07-22 13:17:23', '2021-07-22 13:17:23'),
(2, 23, '2021-07-22 16:04:58', '2021-07-22 16:04:58');

-- --------------------------------------------------------

--
-- Структура таблицы `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id_sub_category` int NOT NULL,
  `id_category` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sub_categories`
--

INSERT INTO `sub_categories` (`id_sub_category`, `id_category`, `name`, `created`, `modified`) VALUES
(1, 1, 'Бизнес-процессы', '2021-07-12 03:05:54', '2021-07-13 00:22:47'),
(2, 1, 'Найм', '2021-07-12 23:54:21', '2021-07-12 23:54:21'),
(3, 1, 'Реклама', '2021-07-12 23:54:36', '2021-07-12 23:54:36'),
(4, 1, 'Управление бизнесом', '2021-07-12 23:55:08', '2021-07-12 23:55:08'),
(5, 1, 'Управление людьми', '2021-07-12 23:55:17', '2021-07-12 23:55:17'),
(6, 1, 'Управление проектами', '2021-07-12 23:55:25', '2021-07-12 23:55:25'),
(7, 2, 'Воспитание', '2021-07-12 23:56:01', '2021-07-12 23:56:01'),
(8, 3, 'Общее', '2021-07-12 23:56:14', '2021-07-12 23:56:14'),
(9, 3, 'Logo', '2021-07-12 23:56:23', '2021-07-12 23:56:23'),
(10, 3, 'Web дизайн', '2021-07-12 23:56:29', '2021-07-12 23:56:29'),
(11, 4, 'PHP', '2021-07-12 23:56:42', '2021-07-12 23:56:42'),
(12, 4, 'HTML и CSS', '2021-07-12 23:56:48', '2021-07-12 23:56:48'),
(13, 4, 'Проектирование', '2021-07-12 23:56:52', '2021-07-12 23:56:52'),
(19, 6, 'Личная эффективность', '2021-07-13 02:20:35', '2021-07-13 02:20:35');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id_tag` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id_tag`, `name`, `created`, `modified`) VALUES
(18, 'Рекомендации', '2021-07-10 21:36:37', '2021-07-22 16:03:09'),
(20, 'Новое', '2021-07-10 21:40:02', '2021-07-22 16:03:19'),
(23, 'Популярное', '2021-07-18 15:13:15', '2021-07-22 16:04:34'),
(24, 'Последний материал', '2021-07-18 15:13:17', '2021-07-22 16:03:44');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `id_type` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id_type`, `name`, `created`, `modified`) VALUES
(1, 'Книга', '2021-07-18 13:57:17', '2021-07-18 13:57:17'),
(2, 'Статья', '2021-07-18 13:57:17', '2021-07-18 13:57:17'),
(3, 'Видео', '2021-07-18 13:57:17', '2021-07-18 13:57:17'),
(4, 'Сайт/Блог', '2021-07-18 13:57:17', '2021-07-18 13:57:17'),
(5, 'Подборка', '2021-07-18 13:57:17', '2021-07-18 13:57:17'),
(6, 'Ключевые идеи книги', '2021-07-18 13:57:17', '2021-07-18 13:57:17');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id_link`),
  ADD KEY `fk_material_link` (`id_material`);

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id_material`);

--
-- Индексы таблицы `materials_tags`
--
ALTER TABLE `materials_tags`
  ADD KEY `material_tag` (`id_material`),
  ADD KEY `tag_material` (`id_tag`);

--
-- Индексы таблицы `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id_sub_category`),
  ADD KEY `fk_category_sub` (`id_category`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `links`
--
ALTER TABLE `links`
  MODIFY `id_link` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id_material` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id_sub_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `id_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `fk_material_link` FOREIGN KEY (`id_material`) REFERENCES `materials` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `materials_tags`
--
ALTER TABLE `materials_tags`
  ADD CONSTRAINT `material_tag` FOREIGN KEY (`id_material`) REFERENCES `materials` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_material` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `fk_category_sub` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
