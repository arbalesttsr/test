drop table if exists "sys_default_errors";
create table "sys_default_errors"
(
  "id"				bigserial unique not null,
  "code"			integer,
  "type"		varchar(200),
  "error_code"		varchar(200),
  "message"		text,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);

insert into "sys_default_errors"("id", "code", "type", "error_code", "message", "create_user_id") values(1, 500, 'CDbException', '42', 'Eroare de executie a codului SQL', 1);