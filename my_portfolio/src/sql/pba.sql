-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-10-13 15:34:08
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
-- テーブルの構造 `activity_management`
--

CREATE TABLE `activity_management` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `activity` varchar(1000) DEFAULT NULL,
  `evaluated` tinyint(10) DEFAULT NULL,
  `activity_management_assessment` varchar(1000) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `create_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '属性はon update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `activity_management`
--

INSERT INTO `activity_management` (`id`, `user_id`, `registration_date`, `activity`, `evaluated`, `activity_management_assessment`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(1, 1, '2020-10-11', 'ベンチプレス　50kg 10×3\r\nデッドリフト　100kg 9×2', 7, 'いつもより力が出なかった。\r\nおそらく食事量がいつもより足りていないから', 0, '2020-10-11 19:34:47', '2020-10-12 15:15:31'),
(3, 1, '2020-10-12', '散歩', 1, '健康にいいぞぉ！運動した感あんまないけど', 1, '2020-10-12 21:57:49', '2020-10-12 21:58:07');

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

-- --------------------------------------------------------

--
-- テーブルの構造 `meal_management`
--

CREATE TABLE `meal_management` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `breakfast` varchar(1000) DEFAULT NULL,
  `lunch` varchar(1000) DEFAULT NULL,
  `dinner` varchar(1000) DEFAULT NULL,
  `evaluated` tinyint(10) DEFAULT NULL,
  `meal_management_assessment` varchar(1000) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `create_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '属性はon update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `meal_management`
--

INSERT INTO `meal_management` (`id`, `user_id`, `registration_date`, `breakfast`, `lunch`, `dinner`, `evaluated`, `meal_management_assessment`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(1, 1, '2020-10-10', 'プロテイン', 'バナナ', 'カレー', 1, '黄色いもんばっかやんけ', 0, '2020-10-10 22:30:51', '2020-10-11 11:13:02'),
(4, 1, '2020-10-11', 'バナナ', 'カレーうどん', 'プロテイン', 1, '食生活むちゃくちゃやわ', 0, '2020-10-11 11:03:28', '2020-10-11 11:03:28');

-- --------------------------------------------------------

--
-- テーブルの構造 `sleep_management`
--

CREATE TABLE `sleep_management` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `bedtime` datetime DEFAULT current_timestamp(),
  `wake_up_time` datetime DEFAULT current_timestamp(),
  `feeling_of_deep_sleep` tinyint(10) DEFAULT NULL,
  `sleep_management_assessment` varchar(1000) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `create_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '属性はon update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `sleep_management`
--

INSERT INTO `sleep_management` (`id`, `user_id`, `registration_date`, `bedtime`, `wake_up_time`, `feeling_of_deep_sleep`, `sleep_management_assessment`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(3, 1, '2020-10-11', '2020-10-10 03:00:00', '2020-10-11 11:00:00', 3, 'アニメ見すぎた', 0, '2020-10-11 12:10:17', '2020-10-11 12:10:17'),
(5, 1, '2020-10-11', '2020-10-08 00:46:00', '2020-10-09 07:46:00', 1, '早寝早起き☆', 0, '2020-10-11 12:55:51', '2020-10-12 14:55:44'),
(6, 1, '2020-10-12', '2020-10-12 03:16:00', '2020-10-12 11:40:00', 1, '寝すぎた', 0, '2020-10-12 13:37:41', '2020-10-12 13:37:41'),
(10, 1, '2020-10-13', '2020-10-13 03:06:00', '2020-10-13 11:07:00', 7, '良く寝た', 0, '2020-10-13 15:07:17', '2020-10-13 15:07:17');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail_address` varchar(256) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `create_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '属性はon update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `mail_address`, `pass`, `user_name`, `is_deleted`, `create_date_time`, `update_date_time`) VALUES
(1, 'k_tsuru@miraino-katachih2.co.jp', '$2y$10$NeWZlUhjOQWCu5bUQMmwwe/ra2cdPWJKePg.SEJBOO4P0oDyGluu.', 'カブト', 0, '2020-10-02 14:52:35', '2020-10-02 14:52:35');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `activity_management`
--
ALTER TABLE `activity_management`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `health_management`
--
ALTER TABLE `health_management`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `meal_management`
--
ALTER TABLE `meal_management`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `sleep_management`
--
ALTER TABLE `sleep_management`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `activity_management`
--
ALTER TABLE `activity_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `health_management`
--
ALTER TABLE `health_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルのAUTO_INCREMENT `meal_management`
--
ALTER TABLE `meal_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルのAUTO_INCREMENT `sleep_management`
--
ALTER TABLE `sleep_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
