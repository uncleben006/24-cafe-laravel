-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018 年 11 月 10 日 10:38
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

INSERT INTO `chat` (`id`, `author`, `message`, `created_at`, `updated_at`) VALUES
(12, 1, '嗨嗨嗨', '2018-11-10 01:34:22', '2018-11-10 01:34:22'),
(13, 1, '妳好', '2018-11-10 01:34:24', '2018-11-10 01:34:24'),
(14, 1, '我覺得今天天氣不錯', '2018-11-10 01:34:31', '2018-11-10 01:34:31');

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
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `class`, `description`, `category`, `series`, `rank`, `brand`, `created_at`, `updated_at`) VALUES
(1, 'Durax 10', 3000, 'racket', '好打', '力量', '亮劍', '專業', 'Yonax', '2018-11-04 12:28:16', '2018-11-04 12:28:16'),
(2, 'PG8801 JC', 1000, 'bag', '好背實用', NULL, NULL, NULL, 'VICTOR', '2018-11-08 14:19:33', '2018-11-08 14:19:33'),
(3, 'Durax 10', 4500, 'racket', '很全面的一支球拍', '全面', '亮劍', '專業', 'Yonax', '2018-11-08 14:20:18', '2018-11-08 14:20:18');

--
-- 資料表的匯出資料 `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `class`, `filename`, `created_at`, `updated_at`) VALUES
(1, 1, 'racket', '57d0e5a5-591b-46bf-ad90-6d0659f13107.jpg', '2018-11-04 12:28:16', '2018-11-04 12:28:16'),
(2, 1, 'racket', '204b913e-8254-4569-bbbf-40b51f18f972.jpg', '2018-11-04 12:28:16', '2018-11-04 12:28:16'),
(3, 1, 'racket', '02103489-4e98-405b-93f0-53dc2157c2e2.jpg', '2018-11-04 12:28:16', '2018-11-04 12:28:16'),
(4, 2, 'bag', 'PG8801 JC.jpg', '2018-11-08 14:19:34', '2018-11-08 14:19:34'),
(5, 3, 'racket', '57d0e5a5-591b-46bf-ad90-6d0659f13107.jpg', '2018-11-08 14:20:18', '2018-11-08 14:20:18'),
(6, 3, 'racket', '204b913e-8254-4569-bbbf-40b51f18f972.jpg', '2018-11-08 14:20:18', '2018-11-08 14:20:18'),
(7, 3, 'racket', '02103489-4e98-405b-93f0-53dc2157c2e2.jpg', '2018-11-08 14:20:18', '2018-11-08 14:20:18');

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `authority`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ben', 'uncleben006@gmail.com', '$2y$10$UTqt76hj0caaxtC9i92TPeCc.f8WoA7sj/nF5bTlahCV9qQjFNOM.', NULL, '2018-11-04 12:20:12', '2018-11-04 12:20:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
