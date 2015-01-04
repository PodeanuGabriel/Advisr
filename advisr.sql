-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04 Ian 2015 la 16:11
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
  `app_id` int(10) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_secret` varchar(255) NOT NULL,
  `data_url` varchar(255) NOT NULL,
  `userid` int(10) NOT NULL,
  `rating_type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `apps`
--

INSERT INTO `apps` (`app_id`, `app_name`, `app_secret`, `data_url`, `userid`, `rating_type`) VALUES
(1, 'TEST', 'TEST', 'asd', 6, 'unary');

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

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'frigider'),
(2, 'haine');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
`id` int(10) unsigned NOT NULL,
  `app_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `rating` float NOT NULL,
  `category` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Salvarea datelor din tabel `preferences`
--

INSERT INTO `preferences` (`id`, `app_id`, `user_id`, `item_id`, `rating`, `category`) VALUES
(2, 1, 1, 1, 2.3, 1),
(3, 1, 1, 2, 2.5, 1),
(4, 1, 1, 3, 4, 2),
(5, 1, 2, 2, 5, 1),
(6, 1, 3, 1, 4, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'test', 'lucian.radu91@gmail.com', '$2y$10$7ydcVAyF3Sx1ZKQ3t6iLfOoc9cHNgGAsfNF5XUtEBmvX6BFE70cBy', 'AeH3pg02qK8iuhaDOBZkZsxJj4ww11fPZW1UtS0gNDlGmEIMxYB9EZSggIyo', '2014-10-26 15:41:36', '2014-10-26 16:36:50');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user_mappings`
--

CREATE TABLE IF NOT EXISTS `user_mappings` (
  `user_id` varchar(100) NOT NULL,
  `user_id_int` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `user_mappings`
--

INSERT INTO `user_mappings` (`user_id`, `user_id_int`) VALUES
('123wdes', 2),
('324dfs', 3),
('asdasd', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
 ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_mappings`
--
ALTER TABLE `user_mappings`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
MODIFY `app_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
