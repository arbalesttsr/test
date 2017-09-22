
--
-- Table structure for table `adm_ldap_settings`
--

CREATE TABLE IF NOT EXISTS `adm_ldap_settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ldap_host` varchar(150) NOT NULL,
  `ldap_port` varchar(10) NOT NULL,
  `ldap_dc` varchar(255) NOT NULL,
  `ldap_ou` varchar(255) NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adm_ldap_settings`
--

INSERT INTO `adm_ldap_settings` (`id`, `ldap_host`, `ldap_port`, `ldap_dc`, `ldap_ou`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(1, '192.168.14.101', '389', 'nippon.local', 'Users', 1, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `adm_ldap_user_relation`
--

CREATE TABLE IF NOT EXISTS `adm_ldap_user_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ldap_setting_id` bigint(20) NOT NULL,
  `create_user_id` bigint(20) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` bigint(20) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `adm_ldap_user_relation`
--

INSERT INTO `adm_ldap_user_relation` (`id`, `user_id`, `ldap_setting_id`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(1, 2, 1, 9223372036854775807, '2014-10-15 16:51:46', NULL, NULL),
(3, 1, 1, 9223372036854775807, '2014-10-16 15:27:54', NULL, NULL);

-- --------------------------------------------------------
