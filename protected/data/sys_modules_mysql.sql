SET FOREIGN_KEY_CHECKS=0;
--
-- Table structure for table `adm_profile`
--

drop table if exists `adm_profile`;

create table `adm_profile` 
(
  `id` 					bigint not null AUTO_INCREMENT,
  `user_id`             bigint not null,
  `email` 				varchar(64) null,
  `firstname` 			varchar(45) null,
  `lastname` 			varchar(45) null,
  `patronymic`			varchar(45) null,
  `gender` 				int default null,
  `birthday` 			date null,
  `about` 				tinytext,
  `post_id` 			bigint null,
  `departament_id` 		bigint null,
  `locality_id` 		bigint null,
  `phone` 				varchar(45) null,
  `mobile` 				varchar(45) null,
  `update_datetime` 	datetime null,
  primary key (`id`)
) engine InnoDB;

--
-- Dumping data for table `adm_profile`
--

insert into `adm_profile` (`id`, `user_id`, `email`, `firstname`, `lastname`, `patronymic`, `gender`, `birthday`, `about`, `post_id`, `departament_id`, `locality_id`, `phone`, `mobile`, `update_datetime`) values
(1, 1, 'admin@mail.com', 'Prenume', 'Nume', 'Patronimic', 1, '1988-11-11', 'About Admin.', 1, 1, 1, '022123456', '079132456', '2014-01-22 16:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `adm_profile_additional`
--

drop table if exists `adm_profile_additional`;

create table `adm_profile_additional` 
(
  `id` 					bigint not null,
  `user_id`             bigint not null,
  primary key (`id`),
  foreign key (`user_id`) references `adm_user` (`id`) on delete cascade on update cascade
) engine InnoDB;

--
-- Dumping data for table `adm_profile_additional`
--

insert into `adm_profile_additional` (`id`, `user_id`) values
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adm_user`
--

drop table if exists `adm_user`;

create table `adm_user` 
(
  `id` 					bigint not null AUTO_INCREMENT,
  `username` 			varchar(255) not null unique,
  `password_hash`		varchar(255) not null,
  `ad_username` 		varchar(45) not null,
  `idnp` 				varchar(13) null,
  `certificate_path` 	varchar(255) null,
  `create_user_id` 		bigint not null,
  `create_datetime` 	timestamp not null default CURRENT_TIMESTAMP,
  `update_user_id` 		bigint null,
  `update_datetime` 	datetime null,
  primary key (`id`)
) engine InnoDB;

--
-- Dumping data for table `adm_user`
--

insert into `adm_user` (`id`, `username`, `password_hash`, `ad_username`, `idnp`, `certificate_path`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) values
(1, 'admin', '$2a$13$Aa.TKuJT6dGQnVURENhHfOi94n.O4LeI9jg2ra8aXx91BK/htkCcK', '', 2001001339151, 'admin.crt', 1, '2013-12-03 13:06:28', 1, '2014-01-11 12:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `sys_modules`
--

drop table if exists `sys_modules`;

create table `sys_modules` 
(
  `id` 					bigint not null AUTO_INCREMENT,
  `name` 				varchar(150) COLLATE utf8_bin not null,
  `activ` 				int default '0',
  `dump_restore` 		int default '0',
  `parent_id` 			int default '0',
  `create_user_id` 		bigint not null,
  `create_datetime` 	datetime not null,
  `update_user_id` 		bigint null,
  `update_datetime` 	datetime null,
  primary key (`id`)
) engine InnoDB;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `sys_modulesdependence`
--

drop table if exists `sys_modulesdependence`;

create table `sys_modulesdependence` 
(
  `id` 					bigint not null AUTO_INCREMENT,
  `module_parent` 		bigint not null,
  `module_children` 	bigint not null,
  primary key (`id`)
) engine InnoDB;
SET FOREIGN_KEY_CHECKS=1;


-- --------------------------------------------------------

--
-- Table structure for table `sys_files_formats`
--

drop table if exists `sys_files_formats`;
create table `sys_files_formats`
(
  `id` 			bigint not null auto_increment,
  `title` 		varchar(100) not null,
  `extension` 		varchar(50) not null,
  `content_type` 	varchar(100) not null,
  `icon` 		varchar(100) not null,
  `status` 		int not null,
  `create_user_id` 	bigint not null,
  `create_datetime` 	datetime not null,
  `update_user_id` 	bigint null,
  `update_datetime` 	datetime null,
  primary key (`id`),
  UNIQUE KEY `UQ_sys_file_format_extension` (`extension`),
  UNIQUE KEY `UQ_sys_file_format_id` (`id`)
) engine InnoDB ;

insert into `sys_files_formats` (`id`, `title`, `extension`, `content_type`, `icon`, `status`,  `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(1, 'PDF', 'pdf', 'application/pdf', 'icons/objects/pdf.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
(2, 'GIF', 'gif', 'image/gif', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
(3, 'SQL', 'sql', 'text/plain', 'icons/objects/document.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
(4, 'JPEG', 'jpeg', 'image/jpeg', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
(5, 'JPG', 'jpg', 'image/jpeg', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
(6, 'PNG', 'png', 'image/png', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
(7, 'TIFF', 'tiff', 'image/tiff', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
(8, 'DOCX', 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'icons/objects/document.png', 1, 1, '2013-03-04 14:02:00', 1, '2013-03-21 10:22:10'),
(9, 'CRT', 'crt', 'text/plain', 'icons/objects/pdf.png', 1, 1, '2013-04-25 10:29:19', NULL, NULL),
(10, 'xades', 'xades', 'text/html', 'icons/objects/pdf.png', 1, 1, '2013-11-19 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_storage`
--

drop table if exists `sys_storage`;
create table `sys_storage`
(
  `id` 			bigint not null auto_increment,
  `name` 		varchar(100) not null,
  `path` 		varchar(100) not null,
  `create_user_id` 	bigint not null,
  `create_datetime` 	datetime not null,
  `update_user_id` 	bigint null,
  `update_datetime` 	datetime null,
  primary key (`id`),
  UNIQUE KEY `UQ_sys_storage_id` (`id`)
) engine InnoDB ;

insert into `sys_storage` (`id`, `name`, `path`, `create_user_id`, `create_datetime`, `update_user_id`, `update_datetime`) VALUES
(0, 'Temp', './storage/Temp/', 1, '2013-12-02 00:00:00', NULL, NULL);
