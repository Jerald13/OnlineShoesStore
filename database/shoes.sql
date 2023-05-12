-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023 年 05 月 09 日 03:53
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shoesstore`
--

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders`
(
    `id`         int(11)    NOT NULL,
    `userId`     int(11)    NOT NULL,
    `productId`  int(11)    NOT NULL,
    `complete`   tinyint(4) NOT NULL DEFAULT 0,
    `totalPrice` double     NOT NULL,
    `address`    text       NOT NULL,
    `created_at` timestamp  NULL     DEFAULT NULL,
    `updated_at` timestamp  NULL     DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `shoes`
--

CREATE TABLE `shoes`
(
    `id`         int(11)      NOT NULL,
    `name`       varchar(255) NOT NULL,
    `imageUrl`   varchar(255)      DEFAULT NULL,
    `quantity`   int(11)      NOT NULL,
    `price`      double       NOT NULL,
    `created_at` timestamp    NULL DEFAULT NULL,
    `updated_at` timestamp    NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- 傾印資料表的資料 `shoes`
--

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users`
(
    `id`         int(11)      NOT NULL,
    `username`   varchar(255) NOT NULL,
    `email`      varchar(255) NOT NULL,
    `password`   varchar(255) NOT NULL,
    `isAdmin`    tinyint(4)   NOT NULL DEFAULT 0,
    `point`      double       NOT NULL DEFAULT 0,
    `created_at` timestamp    NULL     DEFAULT NULL,
    `updated_at` timestamp    NULL     DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `isAdmin`, `point`, `created_at`, `updated_at`)
VALUES (1, 'admin', 'admin@gmail.com', '$2y$10$UKCofkGEf0RJk4ByunGdpep7xkeNRV/e8R4hdnkY0wI5ARdOXNCRS', 1, 100000, NULL,
        '2023-05-07 09:02:04');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`id`),
    ADD KEY `userId` (`userId`),
    ADD KEY `productId` (`productId`);

--
-- 資料表索引 `shoes`
--
ALTER TABLE `shoes`
    ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `username` (`username`),
    ADD UNIQUE KEY `email` (`email`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shoes`
--
ALTER TABLE `shoes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
    ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
    ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `shoes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
