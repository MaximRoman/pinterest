-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 18 2022 г., 21:22
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
-- База данных: `pinterest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `category`, `image_url`, `created_at`) VALUES
('634eddb37e406', 'wallpapers', 'pictures/634eddb37e4062.jpg', 1666112947),
('634eddbd8ccb1', 'wallpapers', 'pictures/634eddbd8ccb14.jpg', 1666112957),
('634edde4cb847', 'anime', 'pictures/634edde4cb84757aa3a7f900cc15670f48266.png', 1666112996),
('634eddf37858a', 'games', 'pictures/634eddf37858aвфтеу.jpg', 1666113011),
('634ede0290996', 'art', 'pictures/634ede0290996sovremennye-kartiny-maslom-6.jpg', 1666113026),
('634ede0d33f0c', 'art', 'pictures/634ede0d33f0cvp363.jpg', 1666113037),
('634ede1b625fb', 'games', 'pictures/634ede1b625fbdmc-devil-may-cry-devil-may-cry-3-dante-s-awakening-devil-may-cry-2-playstation-all-stars-battle-royale-playstation-3-png-favpng-ErLHtPzbDwBaYg4ivvXNkBLcz.jpg', 1666113051),
('634ede30d3de7', 'wallpapers', 'pictures/634ede30d3de71723891150_preview_9a8855a6565cb60ceeeb96a45f18c405.jpg', 1666113072),
('634ede4cba21a', 'anime', 'pictures/634ede4cba21a1572343936_1.jpg', 1666113100),
('634ede79c0ba9', 'wallpapers', 'pictures/634ede79c0ba9fonstola.ru_79339.jpg', 1666113145),
('634edf25a01ba', 'wallpapers', 'pictures/634edf25a01ba5.jpg', 1666113317);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
