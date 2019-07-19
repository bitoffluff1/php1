-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.iwu:3306
-- Время создания: Май 19 2019 г., 17:50
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.iwu.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gbphp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `address` varchar(30) NOT NULL COMMENT 'путь к картинке',
  `name` varchar(40) NOT NULL DEFAULT 'Mango People T-shirt' COMMENT 'название товара',
  `price` decimal(10,0) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0 COMMENT 'Количество просмотров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `address`, `name`, `price`, `count`) VALUES
(1, 'img/product-iwu.jpg', 'Mango People T-shirt', '52', 2),
(2, 'img/product-2.jpg', 'Mango People Dress', '152', 2),
(3, 'img/product-3.jpg', 'Mango People Jacket', '42', 6),
(4, 'img/product-4.jpg', 'Mango People Top', '52', 2),
(5, 'img/product-5.jpg', 'Mango People Acces', '50', 0),
(6, 'img/product-6.jpg', 'Mango People Blazer', '52', 0),
(7, 'img/product-7.jpg', 'Mango People Pant', '102', 1),
(8, 'img/product-8.jpg', 'Mango People Sweater', '52', 0),
(19, 'img/product-like1.jpg', 'Mango People T-shirt', '42', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
