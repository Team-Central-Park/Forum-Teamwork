-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране: 29 апр 2015 в 01:31
-- Версия на сървъра: 5.1.73-cll
-- Версия на PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `forum`
--

-- --------------------------------------------------------

--
-- Структура на таблица `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Схема на данните от таблица `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `title`, `group_id`, `author_id`, `created_at`, `updated_at`) VALUES
(16, 'PHP', 8, 6, '2015-04-27 17:03:53', '2015-04-27 17:03:53'),
(17, 'JavaScript', 8, 6, '2015-04-27 17:04:04', '2015-04-27 17:04:04'),
(18, 'Java', 8, 6, '2015-04-27 17:04:13', '2015-04-27 17:04:13'),
(19, 'C# and .NET', 8, 6, '2015-04-27 17:04:27', '2015-04-27 17:04:27'),
(20, 'Python', 8, 6, '2015-04-27 17:04:36', '2015-04-27 17:04:36'),
(21, 'HTML and CSS', 8, 6, '2015-04-27 17:04:50', '2015-04-27 17:04:50');

-- --------------------------------------------------------

--
-- Структура на таблица `forum_comments`
--

CREATE TABLE IF NOT EXISTS `forum_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

--
-- Схема на данните от таблица `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `body`, `group_id`, `category_id`, `thread_id`, `author_id`, `created_at`, `updated_at`) VALUES
(55, 'Commenting test', 0, 0, 25, 6, '2015-04-28 06:00:57', '2015-04-28 06:00:57'),
(56, 'Another commenting test', 0, 0, 25, 6, '2015-04-28 06:01:04', '2015-04-28 06:01:04'),
(58, 'ttsssssssssss', 0, 0, 23, 1, '2015-04-28 06:13:08', '2015-04-28 06:13:08'),
(59, '&lt;br&gt; &lt;style&gt;', 0, 0, 26, 6, '2015-04-28 07:23:13', '2015-04-28 07:23:13');

-- --------------------------------------------------------

--
-- Структура на таблица `forum_groups`
--

CREATE TABLE IF NOT EXISTS `forum_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Схема на данните от таблица `forum_groups`
--

INSERT INTO `forum_groups` (`id`, `title`, `author_id`, `created_at`, `updated_at`) VALUES
(8, 'Programming', 6, '2015-04-27 17:02:55', '2015-04-27 17:02:55');

-- --------------------------------------------------------

--
-- Структура на таблица `forum_threads`
--

CREATE TABLE IF NOT EXISTS `forum_threads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `visits_counter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Схема на данните от таблица `forum_threads`
--

INSERT INTO `forum_threads` (`id`, `title`, `body`, `group_id`, `category_id`, `author_id`, `created_at`, `updated_at`, `visits_counter`) VALUES
(23, 'Do you like PHP ?', 'It is a rhetorical question!', 0, 16, 6, '2015-04-27 19:11:30', '2015-04-28 06:15:27', 210),
(26, '&lt;br&gt;', '&lt;br&gt;', 0, 17, 6, '2015-04-28 07:23:00', '2015-04-28 07:23:13', 10);

-- --------------------------------------------------------

--
-- Структура на таблица `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_04_20_084310_create_users_table', 1),
('2015_04_20_084338_create_forum_groups_table', 1),
('2015_04_20_084418_create_forum_categories_table', 1),
('2015_04_20_084432_create_forum_threads_table', 1),
('2015_04_20_084444_create_forum_comments_table', 1),
('2015_04_20_084310_create_users_table', 1),
('2015_04_20_084338_create_forum_groups_table', 1),
('2015_04_20_084418_create_forum_categories_table', 1),
('2015_04_20_084432_create_forum_threads_table', 1),
('2015_04_20_084444_create_forum_comments_table', 1),
('2015_04_24_135525_create_tags_tablele', 2),
('2015_04_27_124802_add_email_to_users', 3),
('2015_04_27_162927_create_password_reminders_table', 4);

-- --------------------------------------------------------

--
-- Структура на таблица `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `password_reminders`
--

INSERT INTO `password_reminders` (`email`, `token`, `created_at`) VALUES
('svetlozark@gmail.com', '7d92201e5f76dac7f6f0a08301fc797944032edb', '2015-04-27 14:55:44'),
('svetlozark@gmail.com', 'cbe5f92c02eadb65fc40adc00d667865c96cc01d', '2015-04-27 14:56:06'),
('svetlozark@gmail.com', '87a8d892acae52d2dd48a5c34d204b60bc72bb60', '2015-04-27 14:58:09'),
('svetlozark@gmail.com', '2442d22fb694d006c69de54301e214fa8fa44fd7', '2015-04-27 15:03:04'),
('svetlozark@gmail.com', '71eef6d6ad2779355d3c7472ee515dd19c6e7047', '2015-04-27 15:07:12'),
('svetlozark@gmail.com', '2e435ab17ccfe72b37a18e502ac752cef277e15f', '2015-04-27 15:07:27'),
('svetlozark@gmail.com', 'd6f9a238ba54d828ef64afed08307843aed9a7f7', '2015-04-27 17:00:27'),
('fc_cska@yahoo.com', '7815f06b24188b5d7816c4b2385436fca0e0af04', '2015-04-27 17:02:34'),
('fc_cska@yahoo.com', '1ea29c890c4aef4730ab10d4c7236eba90669a71', '2015-04-27 17:10:13'),
('fc_cska@yahoo.com', '79b273c5b1787249a7c7813f52512b917d9efe93', '2015-04-27 17:10:35'),
('svetlozark@gmail.com', 'ce9f0939d99a412db1aafd616313cfe6ba5f28db', '2015-04-27 17:17:31'),
('svetlozark@gmail.com', 'da5c8f603b126cd668f91d5e34788ec9b003ae9a', '2015-04-27 17:19:55'),
('svetlozark@gmail.com', 'd7a18b7d4574e60dd02f6ca3885fcd70868a4dcd', '2015-04-27 17:20:41'),
('svetlozark@gmail.com', 'cc902df2e85975964d28de0bd635a0420d5c57a9', '2015-04-27 17:21:12'),
('svetlozark@gmail.com', 'b2bf3c4b35d59aef1e1edd141b9aece2e54c9ee6', '2015-04-27 18:58:54'),
('svetlozark@gmail.com', '9e3566ce2fcf25a69b43c564dabce527d83c7059', '2015-04-27 18:59:33'),
('fc_cska@yahoo.com', 'd15d53e96f451745e8f68cce76c595baf86de633', '2015-04-27 22:35:24'),
('fc_cska@yahoo.com', '0bae4eb20adb681e496515f6ba978c9e0951e21d', '2015-04-28 12:54:06');

-- --------------------------------------------------------

--
-- Структура на таблица `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `thread_id` int(10) unsigned NOT NULL,
  `tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`thread_id`,`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `tags`
--

INSERT INTO `tags` (`thread_id`, `tag`) VALUES
(26, '&lt;br&gt;');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageURL` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isAdmin`, `remember_token`, `created_at`, `updated_at`, `email`, `imageURL`) VALUES
(1, 'testov', '$2y$10$n2QKhGbIuZi/PdYsZ/3RHuoiU.OvifFX2mdmKwqxiraSgwuG8lP7u', '1', 'MaVINDhjjIjuizxw6MN2AVkui0izcdX23Ovth4rDAzn8Iq9hObnar5XJy7WZ', '2015-04-21 21:35:29', '2015-04-28 12:53:58', '', 'http://nashdentalcare.com/wp-content/themes/theme49498/images/empty-avatar.gif'),
(6, 'svetlozar_kirkov', '$2y$10$gLHlnpPT4cALIvKthf.EU.NnRbByhpTwPaBKp3vmv4Hq0x93kogiS', '1', 'LajKhTaOKLceprMJkTYaRBMMGOcV3bZjadiZOAaa18k51rtOxRQyzMirFkly', '2015-04-27 17:00:16', '2015-04-28 12:44:56', 'svetlozark@gmail.com', 'http://nashdentalcare.com/wp-content/themes/theme49498/images/empty-avatar.gif'),
(7, 'aaaaaa', '$2y$10$3Uy2ugdErI2VlFwg1RMN9O12YWRkJ5ACOgPPg1guvpPK3JJazTvmu', '0', '', '2015-04-27 17:02:24', '2015-04-27 17:02:24', 'fc_cska@yahoo.com', 'http://nashdentalcare.com/wp-content/themes/theme49498/images/empty-avatar.gif'),
(8, 'blabla', '$2y$10$E6O.Cc.AFbfnew8z/3BUQeaufCiFal4jBsDfvCF64g9fI8eht.YUK', '0', 'kSTZ8FUpZux4vMsJ4hAPEoTG4VRM5l7jOvzLJIa9h7dO4DOcDDQBRghmy8PU', '2015-04-28 19:23:48', '2015-04-28 19:28:34', 'test@gmail.com', 'http://nashdentalcare.com/wp-content/themes/theme49498/images/empty-avatar.gif');

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `forum_threads` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
