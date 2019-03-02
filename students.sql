-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 02 2019 г., 21:53
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `hash` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `balli` int(3) NOT NULL,
  `group_name` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `gender` enum('f','m') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`hash`, `id`, `name`, `surname`, `balli`, `group_name`, `email`, `gender`) VALUES
('46f648fdda4fbbe601c64b03f229877fcaf675e272c724526b39d3a21b0d6187', 17, 'Сергей', 'Жуковский', 70, 'фф1', 'asdweasdr@mail.ru', 'm'),
('972032c1a0f5b458a138567a59004c388968b93e81d62dcba91dad2b6314adbc', 18, 'Дарья', 'Ефремова', 123, 'фф4', 'sdfd@mail.ru', 'f'),
('f5638f7c039ebc105a5a16d2131601d43b17ee59e547a52ab93b3e4e9e8dc591', 19, 'Михаил', 'Зайцев', 123, 'фф1', 'dfg@mail.ru', 'm'),
('a31258b6c6a78b83423eb2f2ee1ea28e335d0804261cf437ff2776dd46054f9e', 20, 'Михаил', 'Зубков', 126, 'фф1', 'alek@mail.ru', 'm'),
('e6f7f46de16ca85de4425343e0f4a641f266fdfababbf152174616afaa15fa4f', 21, 'Михаил', 'Алиев', 234, 'фф2', 'asd@mail.ru', 'm'),
('72516057bc7a41a9e8d351c224b7de9b85c333cf199abf84a2b6c8a16ace7117', 22, 'Антон', 'Иванов', 267, 'аа1', 'sda3@mail.ru', 'm'),
('225917660732b8b7f040846afb04bbfc651c250f3bdc510e72fc939711187c32', 23, 'Антон', 'Белов', 256, 'аа2', 'asrtry@gmail.com', 'm'),
('0b51c9b14d3621107a581c94d03f9cce12eac98cae0604335be67f24b0d669f6', 24, 'Михаил', 'Калугин', 221, 'пп5', 'bvfg@example.com', 'm'),
('ad46f898191f4b207c6f6e18615b704a2e66bb0ce6e7b2e71a274093d2e42eb8', 25, 'Михаил', 'Дюма', 112, 'пп2', 'asdwer@example.com', 'm'),
('fabd753520e59c21d243cdf6d256c59d55cf7d312dd2c00a21d0bc313afd4caa', 26, 'Михаил', 'Зюганов', 123, 'аа2', 'example@example.com', 'm'),
('b00277897c83b4eadfafe063b8e75a360f8b49b91f8af388730ed9009be106bb', 28, 'Михаил', 'Фамилия', 231, 'фф1', 'asdwsadawdas@mail.ru', 'm'),
('d8dd6413eb4cc0e2cbca97cb89eb43afd11a669e43439dbca1674cdd4d87653d', 29, 'Михаил', 'фамилия', 234, 'фф1', 'adawas@mail.ru', 'm'),
('0a1c5c9f7c34aac76e32c372dd23556644afe33eaac59b8d71c7682831fe6459', 36, 'Гриша', 'Иванов', 123, 'фф1', 'asdasd@mail.ru', 'm'),
('affd9a13486cd51505ad88a0b00c8aa18ca9db405f59239a123745b8cf0e76ae', 37, 'asdwa', 'asd', 123, 'фф1', 'dasdawdwdad@mail.ru', 'm'),
('3a575111570f4cf3e07ab96dfbde315bdb808ac2d4604fdc67df190c9ec1b30d', 38, 'Сергей', 'выаыва', 300, 'фф2', 'asdaadsasd@mail.ru', 'm'),
('9051cf0be5cd069a8603676250076d0be2f998f38072b3f7a1de72d39afb4d0a', 39, 'фывв', 'asdwadas', 123, 'фф2', 'asdd@mail.ru', 'm'),
('ae3fc295609036a1d875605b55ff40b622dd929a939959838260913439cf3b06', 40, 'asdwawadsa', 'awdasd', 123, 'ф2', 'asdassdawad@mail.ru', 'f'),
('1ccb4c7b0c8a6200ac34467842c3c61de9c5fc0f7641510e0e372b0a2e9f762a', 41, 'фывцфв', 'фывф', 123, 'фф2', 'asdsssasd@mail.ru', 'm'),
('312c50d15d654f87ab5eca29d5d93e1f249ed7d0a08fd53610c0b105a6059131', 42, 'asdasd', 'фыв', 123, 'фф2', 'assadawdasd@mail.ru', 'm'),
('99073da1e74dea3b115cc1d7fb54f25908fa7ba179784ebbf70282e00a95166a', 43, 'as', 'asd', 122, 'фф1', 'asdassdwad@mail.ru', 'm');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hash` (`hash`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
