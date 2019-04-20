-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2019 at 08:39 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitterclone`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_feeds`
--

CREATE TABLE `activity_feeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` int(11) NOT NULL,
  `followingID` int(11) NOT NULL,
  `tweetID` int(11) NOT NULL,
  `activity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_feeds`
--

INSERT INTO `activity_feeds` (`id`, `userID`, `followingID`, `tweetID`, `activity`, `created_at`, `updated_at`) VALUES
(1, 9, 8, 6, 'like', '2019-04-20 13:02:53', NULL),
(2, 2, 1, 3, 'like', '2019-04-20 13:02:53', NULL),
(3, 10, 2, 7, 'like', '2019-04-20 13:02:53', '2019-04-20 13:02:53'),
(4, 9, 11, 6, 'mention', '2019-04-20 13:02:53', NULL),
(5, 10, 0, 14, 'tweeted', '2019-04-20 13:20:54', '2019-04-20 13:20:54'),
(6, 10, 0, 15, 'tweeted', '2019-04-20 13:22:45', '2019-04-20 13:22:45'),
(7, 8, 0, 16, 'tweeted', '2019-04-20 13:23:06', '2019-04-20 13:23:06'),
(8, 8, 0, 17, 'tweeted', '2019-04-20 13:23:17', '2019-04-20 13:23:17'),
(9, 8, 1, 17, 'mention', '2019-04-20 13:25:38', '2019-04-20 13:25:38'),
(10, 10, 0, 18, 'tweeted', '2019-04-20 13:30:43', '2019-04-20 13:30:43'),
(11, 10, 2, 12, 'mention', '2019-04-20 13:43:20', '2019-04-20 13:43:20'),
(12, 1, 0, 3, 'tweeted', NULL, NULL),
(13, 1, 0, 3, 'tweeted', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` int(11) NOT NULL,
  `followerID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `userID`, `followerID`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2019-04-17 07:23:27', '2019-04-17 07:23:27'),
(2, 8, 9, '2019-04-17 07:24:20', '2019-04-17 07:24:20'),
(3, 2, 1, '2019-04-17 07:24:49', '2019-04-17 07:24:49'),
(5, 9, 10, '2019-04-20 09:49:02', '2019-04-20 09:49:02'),
(9, 2, 10, '2019-04-20 10:31:01', '2019-04-20 10:31:01'),
(10, 11, 9, '2019-04-20 10:31:01', '2019-04-20 10:31:01'),
(11, 1, 8, '2019-04-20 13:24:21', '2019-04-20 13:24:21'),
(12, 8, 10, '2019-04-20 13:28:15', '2019-04-20 13:28:15'),
(13, 10, 8, '2019-04-20 13:44:37', '2019-04-20 13:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `mentions`
--

CREATE TABLE `mentions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` int(11) NOT NULL,
  `mentionedUserID` int(11) NOT NULL,
  `tweetID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mentions`
--

INSERT INTO `mentions` (`id`, `userID`, `mentionedUserID`, `tweetID`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, '2019-04-19 14:21:24', '2019-04-19 14:21:24'),
(2, 8, 1, 3, '2019-04-19 14:21:24', '2019-04-19 14:21:24'),
(3, 8, 1, 3, '2019-04-19 14:21:24', '2019-04-19 14:21:24'),
(4, 10, 9, 7, '2019-04-20 10:54:13', '2019-04-20 10:54:13'),
(5, 8, 1, 17, '2019-04-20 13:25:38', '2019-04-20 13:25:38'),
(6, 10, 2, 12, '2019-04-20 13:43:20', '2019-04-20 13:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_04_16_172213_create_followers_table', 2),
(6, '2019_04_17_145954_create_tweets_table', 3),
(7, '2019_04_17_164452_create_tweets_likes_table', 4),
(8, '2019_04_19_160618_create_mentions_table', 5),
(9, '2019_04_20_104235_create_social_facebook_accounts_table', 6),
(10, '2019_04_20_143218_create_activity_feeds_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_facebook_accounts`
--

CREATE TABLE `social_facebook_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_facebook_accounts`
--

INSERT INTO `social_facebook_accounts` (`user_id`, `provider_user_id`, `provider`, `created_at`, `updated_at`) VALUES
(9, '10161640166105293', 'facebook', '2019-04-20 08:50:48', '2019-04-20 08:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` int(11) NOT NULL,
  `tweet` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `userID`, `tweet`, `created_at`, `updated_at`) VALUES
(1, 2, 'ssidjifjjdn nkjdkfjkdf kjdfkdufdfdfdf', '2019-04-17 13:19:39', '2019-04-17 13:19:39'),
(3, 1, 'Tweet 2', '2019-04-17 13:19:39', '2019-04-17 13:19:39'),
(4, 3, 'ssidjifjjdn nkjdkfjkdf kjdfkdufdfdfdf', '2019-04-18 04:41:15', '2019-04-18 04:41:15'),
(5, 2, 'tweet 7', '2019-04-19 10:10:14', '2019-04-19 10:10:14'),
(6, 8, 'tweet 9', '2019-04-19 10:16:11', '2019-04-19 10:16:11'),
(7, 2, 'tweet 10', '2019-04-20 09:26:34', '2019-04-20 09:26:34'),
(10, 10, 'tweet 100', '2019-04-20 10:29:37', '2019-04-20 10:29:37'),
(11, 10, 'tweet 100', '2019-04-20 10:29:40', '2019-04-20 10:29:40'),
(12, 9, 'tweet 100', '2019-04-20 10:29:40', '2019-04-20 10:29:40'),
(17, 8, 'tweeted to mention someone', '2019-04-20 13:23:17', '2019-04-20 13:23:17'),
(18, 10, 'my tweet', '2019-04-20 13:30:43', '2019-04-20 13:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `tweets_likes`
--

CREATE TABLE `tweets_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tweetID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tweets_likes`
--

INSERT INTO `tweets_likes` (`id`, `tweetID`, `userID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-04-17 15:02:07', '2019-04-17 15:02:07'),
(2, 1, 2, '2019-04-17 15:02:21', '2019-04-17 15:02:21'),
(3, 6, 9, '2019-04-19 10:19:26', '2019-04-19 10:19:26'),
(6, 8, 10, '2019-04-20 09:45:40', '2019-04-20 09:45:40'),
(9, 1, 2, '2019-04-17 15:02:07', '2019-04-17 15:02:07'),
(13, 7, 10, '2019-04-20 13:02:53', '2019-04-20 13:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `api_token`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sandra2', 'sandra.estafanous2@gmail.com', NULL, '', '$2y$10$qwkAu3./7RpBXZOE/rUGreJR6JNnf8l9wYhNbzIyTQxGYeSAFyl/C', NULL, '2019-04-16 08:40:05', '2019-04-16 15:56:58'),
(2, 'sandra', 'sandra.estafanous@gmail.com', NULL, 'wZCqgunsgN75fBDODVHcpQaoyoZAe6ngZqo10KTlC5ZoiaztuTecPHgVZuLr', '$2y$10$qwkAu3./7RpBXZOE/rUGreJR6JNnf8l9wYhNbzIyTQxGYeSAFyl/C', NULL, '2019-04-16 08:40:05', '2019-04-20 13:18:07'),
(8, 'sandra 3', 'sandra.estafanous3@gmail.com', NULL, 'NLIC74ktNp9Fs8YB6BodT8kBdhA7VM9121cbc1v5ZPWcVwZNVedu3CRemzx6', '$2y$10$gntSJfADXssIZM.spK3CeOea82KcW84OaIzKgNY1zupscsQgscLOe', NULL, '2019-04-19 15:03:34', '2019-04-20 13:44:06'),
(9, 'Sandra Seif', 'nanosh_girl@hotmail.com', NULL, NULL, '1454ca2270599546dfcd2a3700e4d2f1', NULL, '2019-04-20 08:50:47', '2019-04-20 08:50:47'),
(10, 'sandra 4', 'sandra.estafanous4@gmail.com', NULL, 'mrbqcpeifmJ3qCqGeUzdFdVMRZoK2bcyFYAH0FtdVddJMQbvi5WxVXCVVehR', '$2y$10$XPhRKBVa4BYTMlH2Csv2hOkR8IDJvF4dGL8twzN1yDZYm5FinDdDK', NULL, '2019-04-20 09:39:33', '2019-04-20 13:26:33'),
(11, 'hello', 'hello@email.com', NULL, 'NULL', '$2y$10$qwkAu3./7RpBXZOE/rUGreJR6JNnf8l9wYhNbzIyTQxGYeSAFyl/C', NULL, '2019-04-20 08:50:47', '2019-04-20 08:50:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_feeds`
--
ALTER TABLE `activity_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentions`
--
ALTER TABLE `mentions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets_likes`
--
ALTER TABLE `tweets_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_feeds`
--
ALTER TABLE `activity_feeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `mentions`
--
ALTER TABLE `mentions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tweets_likes`
--
ALTER TABLE `tweets_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
