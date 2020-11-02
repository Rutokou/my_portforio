-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-10-15 06:55:11
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `pba`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `health_management`
--

CREATE TABLE `health_management` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `body_temperature` decimal(3,1) DEFAULT NULL COMMENT '体温',
  `systolic_blood_pressure` tinyint(4) UNSIGNED DEFAULT NULL COMMENT '収縮期血圧（最高血圧）\r\n最大値は255',
  `diastolic_blood_pressure` tinyint(4) UNSIGNED DEFAULT NULL COMMENT '拡張期血圧（最低血圧）',
  `blood_pulse` tinyint(10) UNSIGNED DEFAULT NULL COMMENT '脈拍',
  `body_weight` decimal(4,1) DEFAULT NULL COMMENT '体重',
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `create_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '属性はon update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `health_management`
--

INSERT INTO `health_management` (`id`, `user_id`, `registration_date`, `body_temperature`, `systolic_blood_pressure`, `diastolic_blood_pressure`, `blood_pulse`, `body_weight`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(4, 1, '2020-10-13', '36.5', 137, 88, 70, '87.3', 0, '2020-10-13 14:43:37', '2020-10-13 14:43:54'),
(5, 1, '2020-10-13', '36.2', 130, 80, 90, '100.0', 1, '2020-10-13 15:01:11', '2020-10-13 15:11:11');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `health_management`
--
ALTER TABLE `health_management`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `health_management`
--
ALTER TABLE `health_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
