
--
-- Table structure for table `authassignment`
--
drop table if exists `authassignment`;
create table `authassignment` (
  `itemname` 		varchar(64) COLLATE utf8_bin NOT NULL,
  `userid` 		varchar(64) COLLATE utf8_bin NOT NULL,
  `bizrule` 		text COLLATE utf8_bin,
  `data` 		text COLLATE utf8_bin,
  primary key (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--
drop table if exists `authitem`;
create table `authitem` (
  `name` 		varchar(64) COLLATE utf8_bin NOT NULL,
  `type` 		int(11) NOT NULL,
  `description` 	text COLLATE utf8_bin,
  `bizrule` 		text COLLATE utf8_bin,
  `data` 		text COLLATE utf8_bin,
  primary key (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--
drop table if exists `authitemchild`;
create table `authitemchild` (
  `parent` 		varchar(64) COLLATE utf8_bin NOT NULL,
  `child` 		varchar(64) COLLATE utf8_bin NOT NULL,
  primary key (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
