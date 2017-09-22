-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2013 at 08:02 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `base`
--

DELIMITER $$
-- --------------------------------------------------------

--
-- Table structure for table `adm_users`
--

CREATE TABLE IF NOT EXISTS `adm_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `ad_username` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_adm_users_id` (`id`),
  UNIQUE KEY `UQ_adm_users_login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=25 ;

--
-- Dumping data for table `adm_users`
--

INSERT INTO `adm_users` (`id`, `username`, `login`, `ad_username`, `password`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(1, 'Administrator', 'admin', 'admin', 'admin', 1, '2013-10-20 09:00:00', NULL, NULL),
(23, 'Administrator1', 'admin1', NULL, 'admin1', 1, '2013-11-05 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_bound`
--

CREATE TABLE IF NOT EXISTS `sys_bound` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `doc_source_id` bigint(20) NOT NULL,
  `doc_destination_id` bigint(20) NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_bound_id` (`id`),
  KEY `doc_destination_id` (`doc_destination_id`),
  KEY `doc_source_id` (`doc_source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_classifiers_history`
--

CREATE TABLE IF NOT EXISTS `sys_classifiers_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `update_user_id` bigint(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `action_id` bigint(20) NOT NULL,
  `classifier_type_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_classifiers_id` (`id`),
  KEY `action_id` (`action_id`),
  KEY `classifier_type_id` (`classifier_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_documents`
--

CREATE TABLE IF NOT EXISTS `sys_documents` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `file_format_id` bigint(20) DEFAULT NULL,
  `instance_id` bigint(20) DEFAULT NULL,
  `check_out_user_id` bigint(20) DEFAULT NULL,
  `file` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_documents_id` (`id`),
  KEY `file_format_id` (`file_format_id`),
  KEY `instance_id` (`instance_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=0 ;



-- --------------------------------------------------------

--
-- Table structure for table `sys_documents_deleted`
--

CREATE TABLE IF NOT EXISTS `sys_documents_deleted` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `file_format_id` bigint(20) DEFAULT NULL,
  `instance_id` bigint(20) DEFAULT NULL,
  `check_out_user_id` bigint(20) DEFAULT NULL,
  `file` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_documents_id` (`id`),
  KEY `file_format_id` (`file_format_id`),
  KEY `instance_id` (`instance_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sys_documents_types`
--

CREATE TABLE IF NOT EXISTS `sys_documents_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `route_id` bigint(20) NOT NULL,
  `instance_model_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `category_id` bigint(20) NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_document_type_id` (`id`),
  KEY `category_id` (`category_id`),
  KEY `route_id` (`route_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=0 ;


-- --------------------------------------------------------

--
-- Table structure for table `sys_document_action`
--

CREATE TABLE IF NOT EXISTS `sys_document_action` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) COLLATE utf8_bin NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_document_action_Description` (`description`),
  UNIQUE KEY `UQ_sys_document_action_id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `sys_document_action`
--

INSERT INTO `sys_document_action` (`id`, `description`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(1, 'Create', 1, '2013-03-04 13:25:00', NULL, NULL),
(2, 'Update', 1, '2013-03-04 13:25:00', NULL, NULL),
(3, 'Move to Operativ Storage', 1, '2013-03-04 13:25:00', NULL, NULL),
(4, 'Move to Arhiv', 1, '2013-03-04 13:25:00', NULL, NULL),
(5, 'Delete', 1, '2013-03-04 13:25:00', NULL, NULL),
(6, 'Add new Version', 1, '2013-05-27 00:00:00', NULL, NULL),
(7, 'Remove Version', 1, '2013-05-27 12:52:50', NULL, NULL),
(8, 'Download Document', 1, '2013-05-27 12:53:14', NULL, NULL),
(9, 'Preview Document', 1, '2013-05-27 12:55:27', NULL, NULL),
(10, 'Check Document', 1, '2013-06-13 00:00:00', NULL, NULL),
(11, 'Apostila Document', 1, '2013-06-13 00:00:00', NULL, NULL),
(12, 'Preview Document History', 1, '2013-06-13 00:00:00', NULL, NULL),
(13, 'Preview Bound Document', 1, '2013-06-13 00:00:00', NULL, NULL),
(14, 'Sign Document', 1, '2013-06-13 00:00:00', NULL, NULL),
(15, 'Get Sign Document', 1, '2013-06-13 00:00:00', NULL, NULL),
(16, 'Lock Document', 1, '2013-06-13 00:00:00', NULL, NULL),
(17, 'Restore Document', 1, '2013-06-14 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_folders`
--

CREATE TABLE IF NOT EXISTS `sys_folders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL,
  `route_id` bigint(20) DEFAULT NULL,
  `title` varchar(150) COLLATE utf8_bin NOT NULL,
  `folder_type_id` bigint(20) NOT NULL,
  `content_type_id` bigint(20) NOT NULL,
  `search_criteria` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `document_type_id` bigint(20) DEFAULT NULL,
  `ordering` int(2) NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_folders_id` (`id`),
  UNIQUE KEY `UQ_sys_folders_title` (`title`),
  KEY `content_type_id` (`content_type_id`),
  KEY `document_type_id` (`document_type_id`),
  KEY `folder_type_id` (`folder_type_id`),
  KEY `route_id` (`route_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=0 ;


-- --------------------------------------------------------

--
-- Table structure for table `sys_folders_contents`
--

CREATE TABLE IF NOT EXISTS `sys_folders_contents` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `folder_id` bigint(20) NOT NULL,
  `document_id` bigint(20) NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_folders_contents_id` (`id`),
  KEY `document_id` (`document_id`),
  KEY `folder_id` (`folder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_folders_contents_types`
--

CREATE TABLE IF NOT EXISTS `sys_folders_contents_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_bin NOT NULL,
  `icon` varchar(100) COLLATE utf8_bin NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_folder_content_type_code` (`code`),
  UNIQUE KEY `UQ_sys_folder_content_type_id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sys_folders_contents_types`
--

INSERT INTO `sys_folders_contents_types` (`id`, `code`, `icon`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(1, 'model', 'folder-model.png', 1, '2013-03-04 16:00:00', NULL, NULL),
(2, 'search', 'folder-search.png', 1, '2013-03-04 16:00:00', NULL, NULL),
(3, 'sample', 'folder-sample.png', 1, '2013-03-04 16:00:00', NULL, NULL),
(4, 'inbox', '16/inbox-folder.png', 1, '2013-03-18 14:38:12', NULL, NULL),
(5, 'oubox', '16/outbox-folder.png', 1, '2013-03-18 14:38:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_folders_types`
--

CREATE TABLE IF NOT EXISTS `sys_folders_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_bin NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_folder_type_code` (`code`),
  UNIQUE KEY `UQ_sys_folder_type_id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sys_folders_types`
--

INSERT INTO `sys_folders_types` (`id`, `code`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(3, 'system', 23, '2013-10-23 12:17:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_routes`
--

CREATE TABLE IF NOT EXISTS `sys_routes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_routes_id` (`id`),
  UNIQUE KEY `UQ_sys_routes_title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=0 ;


-- --------------------------------------------------------

--
-- Table structure for table `sys_storage_general_info`
--

CREATE TABLE IF NOT EXISTS `sys_storage_general_info` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `value` varchar(255) COLLATE utf8_bin NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_sys_storage_general_info_id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
