-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-06-20 08:27:57
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `finaldb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `ID` varchar(9) NOT NULL,
  `pID` int(11) NOT NULL,
  `cID` int(11) NOT NULL,
  `cText` varchar(100) NOT NULL,
  `cTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `comment`
--

INSERT INTO `comment` (`ID`, `pID`, `cID`, `cText`, `cTime`) VALUES
('072214188', 37, 26, 'nice pic :D', '2020-06-19 01:40:42'),
('072214188', 36, 27, 'DOPE', '2020-06-19 01:40:54'),
('082214199', 39, 28, 'lol', '2020-06-19 01:51:17'),
('082214199', 38, 29, 'probably.', '2020-06-19 01:51:27'),
('082214199', 35, 30, 'WTF?', '2020-06-19 01:51:35'),
('082214199', 35, 32, 'WTF?', '2020-06-19 01:53:02'),
('072214117', 40, 36, 'COOL!', '2020-06-19 04:31:55');

-- --------------------------------------------------------

--
-- 資料表結構 `posts`
--

CREATE TABLE `posts` (
  `ID` varchar(9) NOT NULL,
  `pID` int(11) NOT NULL,
  `pText` varchar(100) NOT NULL,
  `pPic` varchar(50) NOT NULL,
  `pTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `posts`
--

INSERT INTO `posts` (`ID`, `pID`, `pText`, `pPic`, `pTime`) VALUES
('072214199', 35, 'asdlkfj;<br />\r\nasdl;fj;', 'NULL', '2020-06-06 16:41:32'),
('072214199', 36, '123', 'upload_pic/36.jpg', '2020-06-07 16:13:07'),
('072214199', 37, '22', 'upload_pic/37.JPG', '2020-06-07 16:37:32'),
('072214188', 38, 'I\'m so cuteeeee', 'NULL', '2020-06-19 01:40:11'),
('072214188', 39, 'check out my cute face', 'upload_pic/39.JPG', '2020-06-19 01:40:30'),
('082214199', 40, 'This restaurant is delicious!!!', 'upload_pic/40.JPG', '2020-06-19 01:52:38'),
('072214177', 47, 'Hello world!', 'NULL', '2020-06-19 04:40:56');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `Uname` varchar(10) NOT NULL,
  `ID` varchar(9) NOT NULL,
  `Pwd` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`Uname`, `ID`, `Pwd`, `Email`, `Photo`) VALUES
('072214117', '072214117', 'a09110931', 'adfs@afsd', 'upload/072214117.JPG'),
('CP SU', '072214177', 'a09110931', 'momosu0417@gmail.com', 'upload/072214177.JPG'),
('Chloe', '072214188', 'a09110931', 'asdljflk@gmail.com', 'upload/072214188.JPG'),
('Su', '072214199', 'a09110931', 'mouse99966123@gmail.com', 'upload/072214199.jpg'),
('Apple', '082214199', 'a09110931', 'momosu0417@gmail.com', 'upload/082214199.JPG');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cID`),
  ADD KEY `fk_pid` (`pID`),
  ADD KEY `fk_id2` (`ID`);

--
-- 資料表索引 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`pID`),
  ADD KEY `fk_id` (`ID`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `cID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `posts`
--
ALTER TABLE `posts`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_id2` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `fk_pid` FOREIGN KEY (`pID`) REFERENCES `posts` (`pID`);

--
-- 資料表的限制式 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
