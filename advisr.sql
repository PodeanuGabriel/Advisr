-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Ian 2015 la 19:55
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `advisr`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `apps`
--

CREATE TABLE IF NOT EXISTS `apps` (
`id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `appkey` varchar(255) NOT NULL,
  `appsecret` varchar(255) NOT NULL,
  `data_url` varchar(255) NOT NULL,
  `userid` int(10) NOT NULL,
  `rating_type` varchar(20) NOT NULL DEFAULT 'unary',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `apps`
--

INSERT INTO `apps` (`id`, `name`, `appkey`, `appsecret`, `data_url`, `userid`, `rating_type`, `created_at`, `updated_at`) VALUES
(1, 'TEST', 'tzHi0cjekWjz4pZM', '33ddd040-96b8-11e4-8548-ed0829daaebf', 'http://www.google.ro', 7, 'unary', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `app_categories`
--

CREATE TABLE IF NOT EXISTS `app_categories` (
  `id_app` int(10) unsigned NOT NULL,
  `id_category` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `app_categories`
--

INSERT INTO `app_categories` (`id_app`, `id_category`, `created_at`, `updated_at`) VALUES
(1, 1, '2015-01-07 18:33:47', '2015-01-07 18:33:47'),
(1, 2, '2015-01-07 18:33:47', '2015-01-07 18:33:47');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Salvarea datelor din tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'frigider', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'haine', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(10) unsigned NOT NULL,
  `url` varchar(512) NOT NULL,
  `category` int(10) unsigned NOT NULL,
  `name` varchar(256) NOT NULL,
  `photo_url` varchar(512) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Salvarea datelor din tabel `items`
--

INSERT INTO `items` (`id`, `url`, `category`, `name`, `photo_url`) VALUES
(2, 'http://localhost/test_js2.html', 2, '', ''),
(4, 'http://localhost/test_js.html', 2, 'itemshmen', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQdWU51VMKb1vZBZENSVHEXsg03CNV6WNpjaWyGZu0phA1mjOcn');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `user_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `preferences`
--

INSERT INTO `preferences` (`user_id`, `item_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 2),
(4, 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'test', 'lucian.radu91@gmail.com', '$2y$10$7ydcVAyF3Sx1ZKQ3t6iLfOoc9cHNgGAsfNF5XUtEBmvX6BFE70cBy', 'bcqM6qt3B9VlfuiBavvrltxyBJGfBsEsvTWSW6yzJ36e17Cqxb4j8jhRe15v', '2014-10-26 15:41:36', '2015-01-04 18:41:41'),
(7, 'luci', 'lucian.radu91@gmail.com2', '$2y$10$YiHyLlaENsd8y08akRMJlOw9s2N3GSNfVaQyeYKt2il2WgqX8pYaK', 'o7qVNKpXcwdvFkODYoiOTaLj1ZDNUf7DvtePv2lmTACABrdKjxn37H8Up7JR', '2015-01-04 18:42:14', '2015-01-04 18:43:17');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user_mappings`
--

CREATE TABLE IF NOT EXISTS `user_mappings` (
  `user_id` varchar(100) NOT NULL,
`user_id_int` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Salvarea datelor din tabel `user_mappings`
--

INSERT INTO `user_mappings` (`user_id`, `user_id_int`) VALUES
('asdasd', 1),
('123wdes', 2),
('324dfs', 3),
('bbpj5rk9', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_categories`
--
ALTER TABLE `app_categories`
 ADD PRIMARY KEY (`id_app`,`id_category`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
 ADD PRIMARY KEY (`user_id`,`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_mappings`
--
ALTER TABLE `user_mappings`
 ADD PRIMARY KEY (`user_id_int`), ADD UNIQUE KEY `user_id_int` (`user_id_int`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_mappings`
--
ALTER TABLE `user_mappings`
MODIFY `user_id_int` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
