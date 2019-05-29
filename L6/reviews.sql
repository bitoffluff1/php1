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
(5, 'Alex', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eaque facere fugiat, harum iste neque nobis officiis omnis repellendus soluta.', '2019-05-19 14:44:44', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
