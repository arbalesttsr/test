
--
-- Table structure for table `adm_user`
--

if exists (select * from sysobjects where name='adm_user' and xtype='U')
	drop table [adm_user];
	
create table [adm_user](
  [id] 				bigint identity not null,
  [username] 			varchar(255) not null,
  [password_hash] 		varchar(255) not null,
  [ad_username] 		varchar(45) null,
  [idnp] 			varchar(13) null,
  [certificate_path]            varchar(255) null,
  [create_user_id] 		bigint not null,
  [create_datetime]             datetime not null default GETDATE(),
  [update_user_id] 		bigint null,
  [update_datetime]             datetime null,
  primary key([id])
);


--
-- Dumping data for table `adm_user`
--

SET IDENTITY_INSERT [adm_user] ON; 
insert into [adm_user] ([id], [username], [password_hash], [ad_username], [idnp], [certificate_path], [create_user_id], [create_datetime], [update_user_id], [update_datetime]) values
(1, 'admin', '$2a$13$Aa.TKuJT6dGQnVURENhHfOi94n.O4LeI9jg2ra8aXx91BK/htkCcK', '', '2001001339151', 'admin.crt', 1, '2014-01-11 12:41:27', 1, '2014-01-11 12:41:27');
SET IDENTITY_INSERT [adm_user] OFF;

-- --------------------------------------------------------

--
-- Table structure for table `adm_profile`
--

if exists (select * from sysobjects where name='adm_profile' and xtype='U')
	drop table [adm_profile];
	
create table [adm_profile](
  [id] 				bigint identity not null,
  [user_id]                     bigint not null,
  [email] 			varchar(64) null,
  [firstname] 			varchar(45) null,
  [lastname] 			varchar(45) null,
  [patronymic]                  varchar(45) null,
  [gender] 			int default 0,
  [birthday] 			date null,
  [about] 			text,
  [post_id] 			bigint null,
  [departament_id] 		bigint null,
  [locality_id] 		bigint null,
  [phone] 			varchar(45) null,
  [mobile] 			varchar(45) null,
  [update_datetime] 	datetime null,
  primary key([id])
);
	
--
-- Dumping data for table `adm_profile`
--
set IDENTITY_INSERT [adm_profile] ON;	
insert into [adm_profile] ([id], [user_id], [email], [firstname], [lastname], [patronymic], [gender], [birthday], [about], [post_id], [departament_id], [locality_id], [phone], [mobile], [update_datetime]) values
(1, 1, 'admin@mail.com', 'Prenume', 'Nume', 'Patronimic', 1,'1988-11-11', 'About Admin.', 1, 1, 1, '022123456', '079132456', '2014-01-22 16:10:42');
set IDENTITY_INSERT [adm_profile] OFF;


-- --------------------------------------------------------

--
-- Table structure for table `adm_profile_additional`
--

if exists (select * from sysobjects where name='adm_profile_additional' and xtype='U')
	drop table [adm_profile_additional];
	
create table [adm_profile_additional](
  [id] 				bigint identity not null,
  [user_id] 			bigint null,
  primary key([id]),
  foreign key ([user_id]) references [adm_user] ([id]) on delete cascade on update cascade
);

--
-- Dumping data for table `adm_profile_additional`
--
SET IDENTITY_INSERT adm_profile_additional ON;	
insert into adm_profile_additional (id, user_id) values
(1, 1);
SET IDENTITY_INSERT adm_profile_additional OFF;

-- --------------------------------------------------------

--
-- Table structure for table `sys_modules`
--

if exists (select * from sysobjects where name='sys_modules' and xtype='U')
	drop table [sys_modules];
	
create table [sys_modules](
  [id] 				bigint identity not null,
  [name] 			varchar(150) not null,
  [activ] 			int not null default '0',
  [dump_restore] 		int not null default '0',
  [parent_id] 			int not null default '0',
  [create_user_id] 		bigint not null,
  [create_datetime]             datetime not null default GETDATE(),
  [update_user_id] 		bigint null,
  [update_datetime]             datetime null,
  primary key([id])
);


-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `sys_modulesdependence`
--

if exists (select * from sysobjects where name='sys_modulesdependence' and xtype='U')
	drop table [sys_modulesdependence];
	
create table [sys_modulesdependence](
  [id] 				bigint identity not null,
  [module_parent]               bigint not null,
  [module_children]             bigint not null,
  primary key([id])
);

-- --------------------------------------------------------

--
-- Table structure for table `sys_files_formats`
--

if exists (select * from sysobjects where name='sys_files_formats' and xtype='U')
	drop table [sys_files_formats];

create table [sys_files_formats]
(
  [id] 			bigint identity not null,
  [title] 		varchar(100) not null,
  [extension] 		varchar(50) not null,
  [content_type] 	varchar(100) not null,
  [icon] 		varchar(100) not null,
  [status] 		bigint not null,
  [create_user_id] 	bigint not null,
  [create_datetime] 	datetime not null default GETDATE(),
  [update_user_id] 	bigint null,
  [update_datetime] 	datetime null,
  primary key ([id])
);


insert into [sys_files_formats] ([title], [extension], [content_type], [icon], [status],  [create_user_id], [create_datetime], [update_user_id], [update_datetime]) VALUES
	('PDF', 'pdf', 'application/pdf', 'icons/objects/pdf.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
	('GIF', 'gif', 'image/gif', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
	('SQL', 'sql', 'text/plain', 'icons/objects/document.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
	('JPEG', 'jpeg', 'image/jpeg', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
	('JPG', 'jpg', 'image/jpeg', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
	('PNG', 'png', 'image/png', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
	('TIFF', 'tiff', 'image/tiff', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', NULL, NULL),
	('DOCX', 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'icons/objects/document.png', 1, 1, '2013-03-04 14:02:00', 1, '2013-03-21 10:22:10'),
	('CRT', 'crt', 'text/plain', 'icons/objects/pdf.png', 1, 1, '2013-04-25 10:29:19', NULL, NULL),
	('xades', 'xades', 'text/html', 'icons/objects/pdf.png', 1, 1, '2013-11-19 00:00:00', NULL, NULL);


-- --------------------------------------------------------

--
-- Table structure for table `sys_storage`
--

if exists (select * from sysobjects where name='sys_storage' and xtype='U')
	drop table [sys_storage];

create table [sys_storage]
(
  [id] 			bigint identity not null,
  [name] 		varchar(100) not null,
  [path] 		varchar(100) not null,
  [create_user_id] 	bigint not null,
  [create_datetime] 	datetime not null default GETDATE(),
  [update_user_id] 	bigint null,
  [update_datetime] 	datetime null,
  primary key ([id])
);

insert into [sys_storage] ([name], [path], [create_user_id], [create_datetime], [update_user_id], [update_datetime]) VALUES
	('Temp', './storage/Temp/', 1, '2013-12-02 00:00:00', NULL, NULL);
