drop table if exists "sys_dbupdates";
create table "sys_dbupdates"
(
  "id"				bigserial unique not null,
  "filename"			varchar(200) not null unique,
  "executed"		integer,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);