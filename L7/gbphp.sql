-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 24 2019 г., 15:23
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

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
(1, 'img/product-1.jpg', 'Mango People T-shirt', '52', 2),
(2, 'img/product-2.jpg', 'Mango People Dress', '152', 2),
(3, 'img/product-3.jpg', 'Mango People Jacket', '42', 6),
(4, 'img/product-4.jpg', 'Mango People Top', '52', 2),
(5, 'img/product-5.jpg', 'Mango People Acces', '50', 0),
(6, 'img/product-6.jpg', 'Mango People Blazer', '52', 0),
(7, 'img/product-7.jpg', 'Mango People Pant', '102', 1),
(8, 'img/product-8.jpg', 'Mango People Sweater', '52', 0),
(19, 'img/product-like1.jpg', 'Mango People T-shirt', '42', 0),
(20, 'img/product-like2.jpg', 'Mango People T-shirt', '87', 0),
(24, 'img/product-like3.jpg', 'Mango People T-shirt', '45', 0),
(26, 'img/product-like4.jpg', 'Mango People T-shirt', '104', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'дата получения отзыва',
  `id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `text`, `date`, `id_product`) VALUES
(1, 'Ann', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.', '2019-05-19 13:15:43', NULL),
(2, 'Alex', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.', '2019-05-19 13:21:57', NULL),
(3, 'Max', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', '2019-05-19 14:38:04', 2),
(4, 'Ivan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', '2019-05-19 14:42:34', 2),
(5, 'Alex', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta.', '2019-05-19 14:44:44', 2),
(6, 'Nic', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta. Aperiam libero quibusdam quisquam. Minima!', '2019-05-23 21:58:10', 1),
(7, 'Sam', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor excepturi id numquam praesentium quas', '2019-05-23 22:33:19', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(50) NOT NULL DEFAULT 'anonim',
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'дата регистрации',
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `password`, `date`, `role`) VALUES
(1, 'anonim', 'Alex', '123', '2019-05-18 09:56:51', NULL),
(4, 'Vasya Pupkin', 'Vasya', '123123', '2019-05-18 09:58:22', NULL),
(8, 'anonim', 'Ann', '12341234', '2019-05-18 10:39:08', NULL),
(11, 'anonim', 'admin', '81f63ec6f29d7d53bdce841ee7ffec6b', '2019-05-23 17:11:09', 'isAdmin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
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
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
