/**
 * Database schema required by CDbAuthManager.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */

--drop table if exists [AuthAssignment];
--drop table if exists [AuthItemChild];
--drop table if exists [AuthItem];

if exists (select * from sysobjects where name='authassignment' and xtype='U')
        drop table [authassignment];
if exists (select * from sysobjects where name='authitemchild' and xtype='U')
        drop table [authitemchild];
if exists (select * from sysobjects where name='authitem' and xtype='U')
        drop table [authitem];



create table [authitem]
(
   [name]                 varchar(64) not null,
   [type]                 integer not null,
   [description]          text null,
   [bizrule]              text null,
   [data]                 text null,
   primary key ([name])
);

create table [authitemchild]
(
   [parent]               varchar(64) not null,
   [child]                varchar(64) not null,
   primary key ([parent],[child]),
   foreign key ([parent]) references [authitem] ([name]) on delete no action on update no action,
   foreign key ([child]) references [authitem] ([name]) on delete no action on update no action
);

create table [authassignment]
(
   [itemname]             varchar(64) not null,
   [userid]               varchar(64) not null,
   [bizrule]              text null,
   [data]                 text null,
   primary key ([itemname],[userid]),
   foreign key ([itemname]) references [authitem] ([name]) on delete no action on update no action
);
