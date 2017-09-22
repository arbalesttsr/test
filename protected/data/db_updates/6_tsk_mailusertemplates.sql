drop table if exists "tsk_mailusertemplates";
create table "tsk_mailusertemplates"
(
  "id"				bigserial unique not null,
  "title"			varchar(200) not null,
  "user_id"		varchar(200) not null,
  "code"      text,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);