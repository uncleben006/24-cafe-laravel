-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 01 日 07:27
-- 伺服器版本: 10.1.26-MariaDB
-- PHP 版本： 7.1.9

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
(12, '1', '<style>\r\n  .hover-text {\r\n    margin: 15px 15px 0;\r\n    padding: 0;\r\n  }\r\n\r\n  .hover-text:last-child {\r\n    padding-bottom: 60px;\r\n  }\r\n\r\n  .hover-text::after {\r\n    content: \'\';\r\n    clear: both;\r\n    display: block;\r\n  }\r\n\r\n  .hover-text div span {\r\n    z-index: -1;\r\n    display: block;\r\n    width: 100%;\r\n    height: 0;\r\n    margin: 0;\r\n    padding: 0;\r\n    color: #444;\r\n    font-size: 18px;\r\n    text-decoration: none;\r\n    text-align: center;\r\n    -webkit-transition: .3s ease-in-out;\r\n    transition: .3s ease-in-out;\r\n    opacity: 0;\r\n    transform: translateY(-100%);\r\n  }\r\n\r\n  figure {\r\n    margin: 0;\r\n    padding: 0;\r\n    background: #fff;\r\n    overflow: hidden;\r\n    z-index: 2;\r\n  }\r\n\r\n  figure:hover+span {\r\n    opacity: 1;\r\n    height: auto;\r\n    margin-top: 0.5rem;\r\n    margin-bottom: 0.5rem;\r\n    transform: translateY(0);\r\n  }\r\n\r\n  /* Shine */\r\n  .hover-shine figure {\r\n    position: relative;\r\n  }\r\n\r\n  .hover-shine figure::before {\r\n    position: absolute;\r\n    top: 0;\r\n    left: -75%;\r\n    z-index: 2;\r\n    display: block;\r\n    content: \'\';\r\n    width: 50%;\r\n    height: 100%;\r\n    background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .3) 100%);\r\n    background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .3) 100%);\r\n    -webkit-transform: skewX(-25deg);\r\n    transform: skewX(-25deg);\r\n  }\r\n\r\n  .hover-shine figure:hover::before {\r\n    -webkit-animation: shine .75s;\r\n    animation: shine .75s;\r\n  }\r\n\r\n  @-webkit-keyframes shine {\r\n    100% {\r\n      left: 125%;\r\n    }\r\n  }\r\n\r\n  @keyframes shine {\r\n    100% {\r\n      left: 125%;\r\n    }\r\n  }\r\n</style>\r\n<div class=\"px-3 px-lg-5 spacing\">\r\n  <div class=\"row hover-shine hover-text\">\r\n    <div class=\"col-md-4\">\r\n      <figure><img src=\"https://picsum.photos/300/200?image=244\" /></figure>\r\n      <span>海鷗~</span>\r\n    </div>\r\n    <div class=\"col-md-4\">\r\n      <figure><img src=\"https://picsum.photos/300/200?image=1024\" /></figure>\r\n      <span>海鳥~</span>\r\n    </div>\r\n    <div class=\"col-md-4\">\r\n      <figure><img src=\"https://picsum.photos/300/200?image=611\" /></figure>\r\n      <span>白鷺鷥(?)</span>\r\n    </div>\r\n  </div>\r\n</div>', '2018-12-22 07:51:33', '2019-02-25 19:28:57'),
(13, '2', '<p>&lt;h2&gt;hihi&lt;/h2&gt;</p>', '2018-12-22 07:51:57', '2019-02-25 16:19:25'),
(14, '3', '<div>3</div>', '2018-12-22 07:53:40', '2018-12-22 08:04:24'),
(15, '4', '<p>4</p>', '2018-12-22 08:04:48', '2018-12-22 08:04:48'),
(16, '5', '<p>5</p>', '2018-12-22 08:04:54', '2018-12-22 08:04:54'),
(17, '6', '<p>6</p>', '2018-12-22 08:05:00', '2018-12-22 08:05:00'),
(18, '7', '<p>7</p>', '2018-12-22 08:05:06', '2018-12-22 08:05:06'),
(19, '8', '<p>8</p>', '2018-12-22 08:05:11', '2018-12-22 08:05:11'),
(20, '9', '<p>9</p>', '2018-12-22 08:05:16', '2018-12-22 08:05:16'),
(21, '10', '<p>10</p>', '2018-12-22 08:05:21', '2018-12-22 08:05:21'),
(22, '11', '<p>11</p>', '2018-12-22 10:24:17', '2018-12-22 10:24:17');

--
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `class`, `introduction`, `category`, `series`, `rank`, `brand`, `created_at`, `updated_at`) VALUES
(1, 'Durax 10', 5180, 'racket', '雙面式的設計，全面提升球員能力，達到進攻與防守兼具的效果', '力量', '亮劍', '專業', 'Yonax', '2018-11-04 12:28:16', '2019-03-01 05:01:50'),
(2, 'PG8801 JC', 1000, 'bag', '好背實用的VICTOR藍色包包', NULL, NULL, NULL, 'VICTOR', '2018-11-08 14:19:33', '2018-11-11 13:17:49'),
(3, 'MX-80', 3000, 'racket', '中桿硬，適合攻擊', '攻擊', '尖峰', '專業', 'VICTOR', '2018-11-08 14:20:18', '2018-11-11 13:33:27'),
(4, 'JS-10 C', 4900, 'racket', '低調墨色消光漆底，襯托細緻內斂塗裝，帶給消費者視覺和手感都與眾不凡的極致享受。', '速度', '極速系列', NULL, NULL, '2018-11-11 13:24:32', '2018-11-11 13:24:32'),
(5, 'SH-A960 DF', 2300, 'footwear', '紅色的鞋子', NULL, NULL, NULL, 'VICTOR', '2018-11-11 15:45:46', '2018-11-11 15:45:46'),
(6, 'SH-P9200-BA 藏青-珠光白', 2500, 'footwear', '青色的鞋子', NULL, NULL, NULL, 'VICTOR', '2018-11-11 15:46:24', '2018-11-11 15:48:06'),
(7, 'P8510-CX 黑-亮金', 2100, 'footwear', '黑色的鞋子', NULL, NULL, NULL, 'VICTOR', '2018-11-11 15:46:52', '2018-11-11 15:51:08'),
(8, 'PG8801 MC', 1300, 'bag', '藍色包包', NULL, NULL, NULL, 'VICTOR', '2018-11-11 15:52:02', '2018-11-11 15:52:02');

--
-- 資料表的匯出資料 `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `class`, `filename`, `created_at`, `updated_at`) VALUES
(4, 2, 'bag', 'PG8801 JC.jpg', '2018-11-08 14:19:34', '2018-11-11 13:17:49'),
(10, 1, 'racket', '57d0e5a5-591b-46bf-ad90-6d0659f13107.jpg', '2018-11-11 12:54:13', '2019-03-01 05:01:50'),
(11, 1, 'racket', '204b913e-8254-4569-bbbf-40b51f18f972.jpg', '2018-11-11 12:54:14', '2019-03-01 05:01:50'),
(12, 1, 'racket', '02103489-4e98-405b-93f0-53dc2157c2e2.jpg', '2018-11-11 12:54:14', '2019-03-01 05:01:50'),
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
(1, 1, 'Ben', 'uncleben006@gmail.com', '$2y$10$UTqt76hj0caaxtC9i92TPeCc.f8WoA7sj/nF5bTlahCV9qQjFNOM.', 'NL2eQBYv3ZJ7cqjDzATvMDUF3iZM2xsa4QYmf6HtsbChkS0qdwNhsm5mybG0', '2018-11-04 12:20:12', '2018-11-04 12:20:12'),
(5, 0, 'Jeff', 'jeff@gmail.com', '$2y$10$oGF4qgqS5xUl7dBp/yHbeOC9QlCGYWh///zCDB7n2S4nu6TqBjTd.', 'hD2lP88iI08tBeyMzSzcX08cpVvGg4elwE67h2cH4LI5z3tnorJQg3mxPVuh', '2018-11-10 16:28:17', '2018-11-10 16:28:17'),
(6, 0, 'Oscar', 'oscar@gmail.com', '$2y$10$GTL3vf20o/YtqO7APNwwbefs.YGmOCJ8Sn8R0Sv2iVAj1iZmzEKza', 'YwhAcpbaHPjc3NMpEHPYAB3F9AZY4Kt0JMEE5rZ39BlLhDbSQykVW2DCXIOE', '2018-11-10 16:29:26', '2018-11-10 16:29:26'),
(7, 0, 'Victor', 'victor@gmail.com', '$2y$10$Y7iVoshEqdXzGt1hn692h.a4i/RrJiHr9Hc99JrbBGbQEg4xtMj8e', 'Qk8mElc28ZTukfAGwNZ5cqCKlxs6On5igwTXb73Faa5c5xyjRyxE7X9Nixnl', '2018-11-10 16:29:35', '2018-11-10 16:29:35'),
(8, 0, '24 Caf\'e', '24cafe@gmail.com', '$2y$10$5HX5cdZ1qL7YUr/nC45DUOel1ITiDBa5K0eeha8eXkLfwGbvWk/W6', 'F836qAenbckluN9LMWqf8SXVL7Pg73Wj4KbXwquiFLVZXqUAUTlOlDHMsASp', '2018-11-11 13:12:29', '2018-11-11 13:12:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
