-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2014 at 10:45 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `adm_profile`
--

CREATE TABLE IF NOT EXISTS `adm_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `gender` enum('m','f') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `about` tinytext,
  `post_id` bigint(20) DEFAULT NULL,
  `departament_id` bigint(20) DEFAULT NULL,
  `locality_id` bigint(20) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profile_function` (`post_id`),
  KEY `fk_profile_division` (`departament_id`),
  KEY `fk_profile_locality` (`locality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adm_profile`
--

INSERT INTO `adm_profile` (`id`, `email`, `firstname`, `lastname`, `gender`, `birthday`, `about`, `post_id`, `departament_id`, `locality_id`, `phone`, `mobile`, `update_datetime`) VALUES
(1, 'admin@mail.com', 'Prenume', 'Nume', 'm', '1988-11-11', 'About Admin.', 1, 1, 1, '022123456', '079132456', '2014-01-22 16:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `adm_profile_additional`
--

CREATE TABLE IF NOT EXISTS `adm_profile_additional` (
  `id` bigint(20) NOT NULL COMMENT 'Id of user.',
  `phone` int(11) DEFAULT '70000000' COMMENT 'numberField',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adm_profile_additional`
--

INSERT INTO `adm_profile_additional` (`id`, `phone`) VALUES
(1, 78499737);

-- --------------------------------------------------------

--
-- Table structure for table `adm_user`
--

CREATE TABLE IF NOT EXISTS `adm_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `ad_username` varchar(45) NOT NULL,
  `idnp` bigint(13) DEFAULT NULL,
  `certificate_path` varchar(255) DEFAULT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_adm_users_id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adm_user`
--

INSERT INTO `adm_user` (`id`, `username`, `password_hash`, `ad_username`, `idnp`, `certificate_path`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(1, 'admin', '$2a$13$Aa.TKuJT6dGQnVURENhHfOi94n.O4LeI9jg2ra8aXx91BK/htkCcK', '', 2001001339151, 'admin.crt', 1, '2013-12-03 13:06:28', 1, '2014-01-11 12:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `sys_modules`
--

CREATE TABLE IF NOT EXISTS `sys_modules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_bin NOT NULL,
  `activ` int(11) DEFAULT '0',
  `dump_restore` int(11) DEFAULT '0',
  `parent_id` int(11) DEFAULT '0',
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=0 ;

--
-- Structura de tabel pentru tabelul `sys_modulesdependence`
--

CREATE TABLE IF NOT EXISTS `sys_modulesdependence` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `module_parent` bigint(20) NOT NULL,
  `module_children` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=0 ;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adm_profile_additional`
--
ALTER TABLE `adm_profile_additional`
  ADD CONSTRAINT `fk_profile_additional_user` FOREIGN KEY (`id`) REFERENCES `adm_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
