-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018 年 12 月 17 日 10:53
-- 伺服器版本: 10.1.34-MariaDB
-- PHP 版本： 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `practice`
--

--
-- 資料表的匯出資料 `chat`
--

INSERT INTO `chat` (`id`, `product_id`, `author`, `message`, `created_at`, `updated_at`) VALUES
(24, 3, 1, '這支很全面，挺不錯打的', '2018-11-10 13:54:09', '2018-11-10 13:54:09'),
(26, 1, 1, '這支球拍打起來很順手，反拍特別有力', '2018-11-10 14:48:44', '2018-11-10 14:48:44'),
(27, 1, 1, '因為反拍有做破風所以打起來特別有力，我買了以後反拍長球感覺明顯變強許多', '2018-11-10 14:49:59', '2018-11-10 14:49:59'),
(28, 1, 1, '不錯不錯', '2018-11-10 15:01:45', '2018-11-10 15:01:45'),
(29, 2, 1, '這個包包的顏色還滿好看的耶', '2018-11-10 15:59:27', '2018-11-10 15:59:27'),
(30, 2, 1, '如果便宜一點我就買XD', '2018-11-10 15:59:42', '2018-11-10 15:59:42'),
(31, 1, 5, '我也有用這支，我也覺得很好打!!', '2018-11-10 16:28:57', '2018-11-10 16:28:57'),
(32, 1, 6, '為什麼我只覺得很貴阿...', '2018-11-10 16:30:08', '2018-11-10 16:30:08'),
(33, 1, 7, '樓上窮到連一支球拍都買不起喔?', '2018-11-10 16:31:06', '2018-11-10 16:31:06'),
(34, 1, 1, '這麼兇喔XDD', '2018-11-11 06:31:10', '2018-11-11 06:31:10'),
(35, 2, 8, '好吧看在你長的帥的份上，就幫你打五折', '2018-11-11 13:13:35', '2018-11-11 13:13:35'),
(36, 2, 5, 'gan~~五折也太多惹吧', '2018-11-11 13:14:14', '2018-11-11 13:14:14'),
(37, 4, 1, '感覺很棒耶\n感覺很棒耶\n感覺很棒耶\n感覺很棒耶\n感覺很棒耶\n感覺很棒耶\n感覺很棒耶\n感覺很棒耶感覺很棒耶感覺很棒耶感覺很棒耶\n感覺很棒耶\n感覺很棒耶\n感覺很棒耶\n感覺很棒耶', '2018-11-11 13:25:32', '2018-11-11 13:25:32'),
(38, 4, 1, '感覺很棒耶 \\n /n\n感覺很棒耶', '2018-11-11 13:26:22', '2018-11-11 13:26:22'),
(39, 4, 1, '感覺很棒耶<br>感覺很棒耶', '2018-11-11 13:26:32', '2018-11-11 13:26:32');

--
-- 資料表的匯出資料 `filters`
--

INSERT INTO `filters` (`id`, `product_class`, `filter_class`, `filter_name`, `sequence`, `created_at`, `updated_at`) VALUES
(5, 'racket', 'series', '亮劍', 0, '2018-11-04 15:19:30', '2018-11-08 15:58:42'),
(7, 'footwear', 'category', '速度系列', 0, '2018-11-04 15:20:01', '2018-11-06 16:50:05'),
(9, 'racket', 'series', '極速系列', 1, '2018-11-08 16:57:33', '2018-11-08 16:57:33'),
(10, 'racket', 'series', '脈動系列', 2, '2018-11-08 16:57:47', '2018-11-08 16:57:47'),
(11, 'racket', 'category', '速度', 0, '2018-11-08 17:10:27', '2018-11-08 17:10:27'),
(12, 'racket', 'category', '進攻', 1, '2018-11-08 17:10:36', '2018-11-08 17:10:36'),
(13, 'racket', 'category', '全面', 3, '2018-11-08 17:10:44', '2018-11-08 17:11:01');

--
-- 資料表的匯出資料 `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(3, 'first post', '<p>dsc1a53c13asd1c35ac</p>', '2018-12-11 09:33:17', '2018-12-11 09:33:17'),
(7, 'hihihihih', '<p>ihhihihi</p>', '2018-12-17 09:44:37', '2018-12-17 09:44:37'),
(8, 'jsdlkjsdlkj', '<p style=\"text-align: center;\"><strong>dcdscsdcdscsdcdscdscsdcs</strong></p>\r\n<p style=\"text-align: center;\"><strong>dscdscsd</strong></p>', '2018-12-17 09:48:42', '2018-12-17 09:48:42'),
(9, 'sdvdsvsdcsdc', '<p style=\"text-align: center;\"><strong>sdcsdcsdcsdcsdcsd</strong></p>\r\n<p style=\"text-align: center;\"><strong>dscsdcsd</strong></p>\r\n<p style=\"text-align: center;\"><strong>dscsdcccccccccccccc', '2018-12-17 09:49:43', '2018-12-17 09:49:43'),
(11, 'sdfsdcfdscdsc', '<p style=\"text-align: center;\"><strong>sdcsdcdscds</strong></p>\r\n<p style=\"text-align: center;\"><strong>dscdscs</strong></p>\r\n<p style=\"text-align: center;\"><strong>sdcsdcsdcsdcsd</strong></p', '2018-12-17 09:50:49', '2018-12-17 09:50:49');

--
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `class`, `introduction`, `category`, `series`, `rank`, `brand`, `created_at`, `updated_at`) VALUES
(1, 'Durax 10', 5180, 'racket', '雙面式的設計，全面提升球員能力，達到進攻與防守兼具的效果', '力量', '亮劍', '專業', 'Yonax', '2018-11-04 12:28:16', '2018-11-11 12:54:13'),
(2, 'PG8801 JC', 1000, 'bag', '好背實用的VICTOR藍色包包', NULL, NULL, NULL, 'VICTOR', '2018-11-08 14:19:33', '2018-11-11 13:17:49'),
(3, 'MX-80', 3000, 'racket', '中桿硬，適合攻擊', '攻擊', '尖峰', '專業', 'VICTOR', '2018-11-08 14:20:18', '2018-11-11 13:33:27'),
(4, 'JS-10 C', 4900, 'racket', '低調墨色消光漆底，襯托細緻內斂塗裝，帶給消費者視覺和手感都與眾不凡的極致享受。', '速度', '極速系列', NULL, NULL, '2018-11-11 13:24:32', '2018-11-11 13:24:32'),
(5, 'SH-A960 DF', 2300, 'footwear', '紅色的鞋子', NULL, NULL, NULL, 'VICTOR', '2018-11-11 15:45:46', '2018-11-11 15:45:46'),
(6, 'SH-P9200-BA 藏青-珠光白', 2500, 'footwear', '青色的鞋子', NULL, NULL, NULL, 'VICTOR', '2018-11-11 15:46:24', '2018-11-11 15:48:06'),
(7, 'P8510-CX 黑-亮金', 2100, 'footwear', '黑色的鞋子', NULL, NULL, NULL, 'VICTOR', '2018-11-11 15:46:52', '2018-11-11 15:51:08'),
(8, 'PG8801 MC', 1300, 'bag', '藍色包包', NULL, NULL, NULL, 'VICTOR', '2018-11-11 15:52:02', '2018-11-11 15:52:02');

--
-- 資料表的匯出資料 `product_contents`
--

INSERT INTO `product_contents` (`id`, `detail`, `topSection`, `middleSection`, `created_at`, `updated_at`) VALUES
(1, '正拍採用<b>盒式</b>設計增加整體穩定度，\r\n<br>反拍採用<b>破風</b>設計增加回球速度，\r\n<br>能夠全面提升球員能力，達到進攻與防守兼具的效果', NULL, NULL, '2018-11-04 12:28:16', '2018-11-11 12:54:13'),
(2, '好背實用的VICTOR藍色包包', NULL, NULL, '2018-11-08 14:19:33', '2018-11-11 13:17:49'),
(3, '在經典高端拍MX-80的基礎上增加強芯填充技術，優化球拍操控性能，精准掌控每一個落點，盡享揮拍時優越手感。', NULL, NULL, '2018-11-08 14:20:18', '2018-11-11 13:33:27'),
(4, 'VICTOR兩大尖端材料「PYROFIL 三菱百洛碳素纖維」與「NANO FORTIFY 增韌奈米碳管」技術，搭載特殊小拍面及細中管設計，賦予JETSPEED S 10輕快銳利的紮實打感。低調墨色消光漆底，襯托細緻內斂塗裝，帶給消費者視覺和手感都與眾不凡的極致享受。', NULL, NULL, '2018-11-11 13:24:32', '2018-11-11 13:24:32'),
(5, '紅色的鞋子', NULL, NULL, '2018-11-11 15:45:46', '2018-11-11 15:45:46'),
(6, '青色的鞋子', NULL, NULL, '2018-11-11 15:46:24', '2018-11-11 15:48:06'),
(7, '黑色的鞋子', NULL, NULL, '2018-11-11 15:46:52', '2018-11-11 15:51:08'),
(8, '藍色包包', NULL, NULL, '2018-11-11 15:52:02', '2018-11-11 15:52:02');

--
-- 資料表的匯出資料 `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `class`, `filename`, `created_at`, `updated_at`) VALUES
(4, 2, 'bag', 'PG8801 JC.jpg', '2018-11-08 14:19:34', '2018-11-11 13:17:49'),
(10, 1, 'racket', '57d0e5a5-591b-46bf-ad90-6d0659f13107.jpg', '2018-11-11 12:54:13', '2018-11-11 12:54:13'),
(11, 1, 'racket', '204b913e-8254-4569-bbbf-40b51f18f972.jpg', '2018-11-11 12:54:14', '2018-11-11 12:54:14'),
(12, 1, 'racket', '02103489-4e98-405b-93f0-53dc2157c2e2.jpg', '2018-11-11 12:54:14', '2018-11-11 12:54:14'),
(13, 3, 'racket', '2017101715115545848.jpg', '2018-11-11 13:17:06', '2018-11-11 13:33:27'),
(14, 3, 'racket', '2017101715115614531.jpg', '2018-11-11 13:17:06', '2018-11-11 13:33:27'),
(15, 3, 'racket', '2017101715115726939.jpg', '2018-11-11 13:17:06', '2018-11-11 13:33:27'),
(16, 3, 'racket', '2017101715115780360.jpg', '2018-11-11 13:17:06', '2018-11-11 13:33:27'),
(17, 3, 'racket', '2017101715115877546.jpg', '2018-11-11 13:17:06', '2018-11-11 13:33:27'),
(18, 4, 'racket', '2014111018295831992.jpg', '2018-11-11 13:24:34', '2018-11-11 13:24:34'),
(19, 4, 'racket', '2014111018295839040.jpg', '2018-11-11 13:24:34', '2018-11-11 13:24:34'),
(20, 4, 'racket', '2014111018295871386 (1).jpg', '2018-11-11 13:24:35', '2018-11-11 13:24:35'),
(21, 4, 'racket', '2014111018295871386.jpg', '2018-11-11 13:24:35', '2018-11-11 13:24:35'),
(22, 4, 'racket', '2014111018295879245.jpg', '2018-11-11 13:24:35', '2018-11-11 13:24:35'),
(23, 5, 'footwear', 'SH-A960 DF 01.jpg', '2018-11-11 15:45:46', '2018-11-11 15:45:46'),
(24, 5, 'footwear', 'SH-A960 DF 02.jpg', '2018-11-11 15:45:46', '2018-11-11 15:45:46'),
(25, 5, 'footwear', 'SH-A960 DF 03.jpg', '2018-11-11 15:45:46', '2018-11-11 15:45:46'),
(32, 6, 'footwear', 'SH-P9200-BA-1.jpg', '2018-11-11 15:48:07', '2018-11-11 15:48:07'),
(33, 6, 'footwear', 'SH-P9200-BA-2.jpg', '2018-11-11 15:48:07', '2018-11-11 15:48:07'),
(38, 7, 'footwear', 'P8510-CX-1.jpg', '2018-11-11 15:50:58', '2018-11-11 15:51:08'),
(39, 7, 'footwear', 'P8510-CX-2.jpg', '2018-11-11 15:50:59', '2018-11-11 15:51:08'),
(40, 8, 'bag', 'PG8801 MC.jpg', '2018-11-11 15:52:03', '2018-11-11 15:52:03');

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `authority`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ben', 'uncleben006@gmail.com', '$2y$10$UTqt76hj0caaxtC9i92TPeCc.f8WoA7sj/nF5bTlahCV9qQjFNOM.', 'AIYl9YxPlpk8aFBBpFi5cmeJ2oIQIs8tN9PfkNdtwQyRWDRsXr147mdTZePa', '2018-11-04 12:20:12', '2018-11-04 12:20:12'),
(5, 0, 'Jeff', 'jeff@gmail.com', '$2y$10$oGF4qgqS5xUl7dBp/yHbeOC9QlCGYWh///zCDB7n2S4nu6TqBjTd.', 'hD2lP88iI08tBeyMzSzcX08cpVvGg4elwE67h2cH4LI5z3tnorJQg3mxPVuh', '2018-11-10 16:28:17', '2018-11-10 16:28:17'),
(6, 0, 'Oscar', 'oscar@gmail.com', '$2y$10$GTL3vf20o/YtqO7APNwwbefs.YGmOCJ8Sn8R0Sv2iVAj1iZmzEKza', 'YwhAcpbaHPjc3NMpEHPYAB3F9AZY4Kt0JMEE5rZ39BlLhDbSQykVW2DCXIOE', '2018-11-10 16:29:26', '2018-11-10 16:29:26'),
(7, 0, 'Victor', 'victor@gmail.com', '$2y$10$Y7iVoshEqdXzGt1hn692h.a4i/RrJiHr9Hc99JrbBGbQEg4xtMj8e', 'Qk8mElc28ZTukfAGwNZ5cqCKlxs6On5igwTXb73Faa5c5xyjRyxE7X9Nixnl', '2018-11-10 16:29:35', '2018-11-10 16:29:35'),
(8, 0, '24 Caf\'e', '24cafe@gmail.com', '$2y$10$5HX5cdZ1qL7YUr/nC45DUOel1ITiDBa5K0eeha8eXkLfwGbvWk/W6', 'F836qAenbckluN9LMWqf8SXVL7Pg73Wj4KbXwquiFLVZXqUAUTlOlDHMsASp', '2018-11-11 13:12:29', '2018-11-11 13:12:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
