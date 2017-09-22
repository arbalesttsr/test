drop table if exists "sys_base_configs";
create table "sys_base_configs"
(
  "id"				bigserial unique not null,
  "config_label"			varchar(200) not null,
  "config_value"		varchar(300) not null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);