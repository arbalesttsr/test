
/* List of core Tables from Synapsis (Online Documents Management System) */

/* 1. Tables only for system users */

/* 1.1. Table with system users */

drop table if exists "adm_user";
create table "adm_user" 
(
  "id"				bigserial unique not null,
  "username"			varchar(255) not null unique,
  "password_hash"		varchar(255) not null,
  "ad_username"			varchar(45) null,
  "idnp"			varchar(13) null,
  "certificate_path"		varchar(255) null,
  "status_id"			integer DEFAULT 0 NOT NULL,
  "sql_user"                    integer DEFAULT 0 NOT NULL,
  "penalization"		varchar(500) null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);

insert into "adm_user" ("id", "username", "password_hash", "ad_username", "idnp", "certificate_path", "penalization", "status_id","sql_user" , "create_user_id", "create_datetime", "update_user_id", "update_datetime") VALUES
(1, 'admin', '$2a$13$Aa.TKuJT6dGQnVURENhHfOi94n.O4LeI9jg2ra8aXx91BK/htkCcK', '', '2001001339151', 'admin.crt', NULL, 0,0, 1, current_timestamp, NULL, NULL),
(9223372036854775807, 'sa', '$2a$13$TDRWyKon7TsIisH.B/9/JOzpo5xpTyb1onl57Hcqdu1weCGs9Sche', '', NULL, NULL, NULL, 1,0, 1, current_timestamp, NULL, NULL);

SELECT pg_catalog.setval('adm_user_id_seq', 2, true);


/* 1.2. Table with system users profiles */

drop table if exists "adm_profile";
create table "adm_profile" 
(
  "id"				bigserial unique not null,
  "user_id"			bigint not null,
  "idnp"			varchar(13) null,
  "email"			varchar(64) null,
  "firstname"			varchar(45) null,
  "lastname"			varchar(45) null,
  "patronymic"			varchar(45) null,
  "gender"			int default 0,
  "birthday"			date null,
  "about"			text,
  "post_id"			bigint null,
  "department_id"		bigint null,
  "subsidiary_id"		bigint null,
  "locality_id"			bigint null,
  "phone"			varchar(45) null,
  "mobile"			varchar(45) null,
  "avatar"			varchar(200) null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "adm_user" ("id") on delete cascade on update cascade
); 


insert into "adm_profile" ("id", "user_id", "idnp", "email", "firstname", "lastname", "patronymic", "gender", "birthday", "about", "post_id", "department_id", "subsidiary_id", "locality_id", "phone", "mobile", "avatar", "update_datetime") values
(1, 1, '0000000000000', 'admin@mail.com', 'Admin', 'Synapsis', NULL, 1, '1988-11-11', 'About Admin.', null, null, null, null, '022123456', '079132456', null, null),
(9223372036854775807, 9223372036854775807, '9999999999999', 'sa@mail.com', 'System', 'Administrator', NULL, 0, '2014-11-30', 'About Super Admin.', null, null, null, null, null, null, null, null);

SELECT pg_catalog.setval('adm_profile_id_seq', 2, true);


/* 1.3. Table with system users profiles additional data */

drop table if exists "adm_profile_additional";
create table "adm_profile_additional" 
(
  "id"				bigserial unique not null,
  "user_id"			bigint not null,
  "start_page"			varchar(255) null,
  primary key ("id"),
  foreign key ("user_id") references "adm_user" ("id") on delete cascade on update cascade
);

insert into "adm_profile_additional" ("id", "user_id","start_page") VALUES
(1, 1,''),
(9223372036854775807, 9223372036854775807,'');

SELECT pg_catalog.setval('adm_profile_additional_id_seq', 2, true);


/* 1.4. Table with system users settings */

drop table if exists "adm_user_settings";
create table "adm_user_settings" (
  "id"				bigserial unique not null,
  "user_id"			bigint NOT NULL,
  "time_limit"			character varying(20) NOT NULL,
  "restricted_id"		integer NOT NULL,
  "restricted_days"		character varying(50),
  "restricted_date"		character varying(255),
  "restricted_interval"		character varying(255),
  "date_start"			timestamp without time zone,
  "start_time"			character varying(10),
  "end_time"			character varying(10),
  "holiday_enable"		integer default 0,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "adm_user" ("id") on delete cascade on update cascade
);
INSERT INTO adm_user_settings VALUES (1, 1, '0', 0, NULL, NULL, NULL, '2010-01-01 00:00:00', '08:30:00', '17:30:00', 0, 1, current_timestamp, null, null);
INSERT INTO adm_user_settings VALUES (9223372036854775807, 9223372036854775807, '0', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, current_timestamp, null, null);

SELECT pg_catalog.setval('adm_user_settings_id_seq', 2, true);


/* 1.5. Table with system users last activity */

drop table if exists "adm_users_activity";
create table "adm_users_activity" (
  "id"				bigserial unique not null,
  "user_id"			bigint NOT NULL,
  "last_activity"		timestamp null,
  "last_url"		    varchar(300) null,
  primary key ("id"),
  foreign key ("user_id") references "adm_user" ("id") on delete cascade on update cascade
);


/* 1.6. Table with system users holidays */

drop table if exists "adm_holidays";
create table "adm_holidays" (
  "id"				bigserial unique not null,
  "holiday_date"		timestamp null,
  "description"			varchar(255) null,
  "holiday_enable"		integer not null default 0,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);


/* 1.7. Table with system users dashboards configs */

drop table if exists "adm_dashboardconfig";
create table "adm_dashboardconfig" (
  "id"				bigserial unique not null,
  "user_id"			bigint NOT NULL,
  "dashboard_config"		text null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "adm_user" ("id") on delete cascade on update cascade
);


/* 1.8. Table with system users chat messages */

drop table if exists "adm_chatmessage";
create table "adm_chatmessage" (
  "id"				bigserial unique not null,
  "msg"				text NOT NULL,
  "date"			timestamp not null,
  "from"			bigint not null,
  "to"				bigint null,
  "type"			varchar(100) not null,
  "readed"			integer null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);


/* 1.9. Table with system users certificates info */

drop table if exists "adm_cert_certificate_info";
create table "adm_cert_certificate_info" (
  "id"				bigserial unique not null,
  "user_id"			bigint not null,
  "country_name"		varchar(3) not null,
  "state_or_province_name"	varchar(255) not null,
  "locality_name"		varchar(255) not null,
  "organization_name"		varchar(255) not null,
  "organizational_unit_name"	varchar(255) not null,
  "common_name"			varchar(255) not null,
  "email_address"		varchar(255) not null,
  "passphrase"			varchar(100) not null,
  "cert_crt"			text null,
  "cert_key"			text null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "adm_user" ("id") on delete cascade on update cascade
);


/* 1.10. Table with users ldap settings */

drop table if exists "adm_ldap_settings";
create table "adm_ldap_settings" (
  "id"				bigserial unique not null,
  "ldap_host"			varchar(150) not null,
  "ldap_port"			varchar(10) not null,
  "ldap_dc"			varchar(255) not null,
  "ldap_ou"			varchar(255) not null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);


/* 1.11. Table with users ldap relations */

drop table if exists "adm_ldap_user_relation";
create table "adm_ldap_user_relation" (
  "id"				bigserial unique not null,
  "user_id"			bigint not null,
  "ldap_setting_id"		bigint not null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "adm_user" ("id") on delete cascade on update cascade,
  foreign key ("ldap_setting_id") references "adm_ldap_settings" ("id") on delete cascade on update cascade
);



/* 2. Tables only for clients */

/* 2.1. Table with clients */

drop table if exists "cli_user";
create table "cli_user" 
(
  "id"				bigserial unique not null,
  "username"			varchar(255) not null unique,
  "password_hash"		varchar(255) not null,
  "ad_username"			varchar(45) null,
  "idnp"			varchar(13) null,
  "certificate_path"		varchar(255) null,
  "status_id"			integer DEFAULT 0 NOT NULL,
  "confirmation"			integer DEFAULT 0,
  "regle"			integer DEFAULT 0,
  "sql_user"                    integer DEFAULT 1 NOT NULL,
  "penalization"		varchar(500) null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);

insert into "cli_user" ("id", "username", "password_hash", "ad_username", "idnp", "certificate_path", "penalization", "status_id","sql_user" , "create_user_id", "create_datetime", "update_user_id", "update_datetime") VALUES
(1000000000000, 'admin', '$2a$13$Aa.TKuJT6dGQnVURENhHfOi94n.O4LeI9jg2ra8aXx91BK/htkCcK', '', '0000000000000', 'admin.crt', NULL, 0,0, 1, current_timestamp, NULL, NULL);

SELECT pg_catalog.setval('cli_user_id_seq', 1000000000001, true);


/* 2.2. Table with clients profiles */

drop table if exists "cli_profile";
create table "cli_profile" 
(
  "id"				bigserial unique not null,
  "user_id"			bigint not null,
  "idnp"			varchar(13) null,
  "email"			varchar(64) null,
  "firstname"			varchar(45) null,
  "lastname"			varchar(45) null,
  "patronymic"			varchar(45) null,
  "gender"			int default 0,
  "birthday"			date null,
  "about"			text,
  "post_id"			bigint null,
  "department_id"		bigint null,
  "subsidiary_id"		bigint null,
  "locality_id"			bigint null,
  "phone"			varchar(45) null,
  "mobile"			varchar(45) null,
  "avatar"			varchar(200) null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "cli_user" ("id") on delete cascade on update cascade
); 


drop table if exists "tbl_instante";
CREATE TABLE "tbl_instante" (
    id bigserial unique NOT NULL,
    name text NOT NULL,
    dataexec timestamp NOT NULL,
    stare text NOT NULL,
    erori text NOT NULL,
    primary key ("id")
);



insert into "cli_profile" ("id", "user_id", "idnp", "email", "firstname", "lastname", "patronymic", "gender", "birthday", "about", "post_id", "department_id", "subsidiary_id", "locality_id", "phone", "mobile", "avatar", "update_datetime") values
(1000000000000, 1000000000000, '0000000000000', 'admin@mail.com', 'Admin', 'Synapsis', NULL, 1, '1988-11-11', 'About Admin.', null, null, null, null, '022123456', '079132456', null, null);

SELECT pg_catalog.setval('cli_profile_id_seq', 1000000000001, true);


/* 2.3. Table with system users profiles additional data */

drop table if exists "cli_profile_additional";
create table "cli_profile_additional" 
(
  "id"				bigserial unique not null,
  "user_id"			bigint not null,
  "start_page"			varchar(255) null,
  primary key ("id"),
  foreign key ("user_id") references "cli_user" ("id") on delete cascade on update cascade
);

insert into "cli_profile_additional" ("id", "user_id","start_page") VALUES
(1000000000000, 1000000000000,'');

SELECT pg_catalog.setval('cli_profile_additional_id_seq', 1000000000001, true);


/* 2.4. Table with clients settings */

drop table if exists "cli_user_settings";
create table "cli_user_settings" (
  "id"				bigserial unique not null,
  "user_id"			bigint NOT NULL,
  "time_limit"			character varying(20) NOT NULL,
  "restricted_id"		integer NOT NULL,
  "restricted_days"		character varying(50),
  "restricted_date"		character varying(255),
  "restricted_interval"		character varying(255),
  "date_start"			timestamp without time zone,
  "start_time"			character varying(10),
  "end_time"			character varying(10),
  "holiday_enable"		integer default 0,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "cli_user" ("id") on delete cascade on update cascade
);
INSERT INTO cli_user_settings VALUES (1000000000000, 1000000000000, '0', 0, NULL, NULL, NULL, '2010-01-01 00:00:00', '08:30:00', '17:30:00', 0, 1, current_timestamp, null, null);

SELECT pg_catalog.setval('cli_user_settings_id_seq', 1000000000001, true);


/* 2.5. Table with clients last activity */

drop table if exists "cli_users_activity";
create table "cli_users_activity" (
  "id"				bigserial unique not null,
  "user_id"			bigint NOT NULL,
  "last_activity"		timestamp null,
  "last_url"		    varchar(300) null,
  primary key ("id"),
  foreign key ("user_id") references "cli_user" ("id") on delete cascade on update cascade
);


/* 2.6. Table with clients holidays */

drop table if exists "cli_holidays";
create table "cli_holidays" (
  "id"				bigserial unique not null,
  "holiday_date"		timestamp null,
  "description"			varchar(255) null,
  "holiday_enable"		integer not null default 0,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);


/* 2.7. Table with clients dashboards configs */

drop table if exists "cli_dashboardconfig";
create table "cli_dashboardconfig" (
  "id"				bigserial unique not null,
  "user_id"			bigint NOT NULL,
  "dashboard_config"		text null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "cli_user" ("id") on delete cascade on update cascade
);


/* 2.8. Table with system users chat messages */

drop table if exists "cli_chatmessage";
create table "cli_chatmessage" (
  "id"				bigserial unique not null,
  "msg"				text NOT NULL,
  "date"			timestamp not null,
  "from"			bigint not null,
  "to"				bigint null,
  "type"			varchar(100) not null,
  "readed"			integer null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);


/* 2.9. Table with clients certificates info */

drop table if exists "cli_cert_certificate_info";
create table "cli_cert_certificate_info" (
  "id"				bigserial unique not null,
  "user_id"			bigint not null,
  "country_name"		varchar(3) not null,
  "state_or_province_name"	varchar(255) not null,
  "locality_name"		varchar(255) not null,
  "organization_name"		varchar(255) not null,
  "organizational_unit_name"	varchar(255) not null,
  "common_name"			varchar(255) not null,
  "email_address"		varchar(255) not null,
  "passphrase"			varchar(100) not null,
  "cert_crt"			text null,
  "cert_key"			text null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("user_id") references "cli_user" ("id") on delete cascade on update cascade
);


/* 3. Universal tables (for system users and clients) */

/* 3.1. Table with system administrators ip accesses */

drop table if exists "adm_sa_access";
create table "adm_sa_access" (
  "id"				bigserial unique not null,
  "ip"				character varying(20) NOT NULL,
  primary key ("id")
);

insert into "adm_sa_access" VALUES (1, '::1');

SELECT pg_catalog.setval('adm_sa_access_id_seq', 2, false);


/* 3.2. Table with users certificates settings */

drop table if exists "adm_cert_settings";
create table "adm_cert_settings" (
  "id"				bigserial unique not null,
  "certificates_path"		varchar(255) not null,
  "key_path"			varchar(255) not null,
  "openssl_config_path"		varchar(255) not null,
  "digest_alg"			varchar(100) default 'sha512'::character varying not null,
  "private_key_bits"		bigint default (2048)::bigint not null,
  "private_key_type"		varchar(100) default 'OPENSSL_KEYTYPE_RSA'::character varying not null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  "default_id" integer,
  primary key ("id")
);


/* 3.3. Table with users CTS settings */

drop table if exists "adm_cts_settings";
create table "adm_cts_settings" (
  "id"				bigserial unique not null,
  "key" 			text not null,
  "certificate" 		text not null,
  "validate_response_key" 	text not null,
  "callback_url" 		varchar(255) not null,
  "login_url" 			varchar(255) default 'https://testmpass.gov.md/login/saml'::character varying not null,
  "logout_url" 			varchar(255) default 'https://testmpass.gov.md/logout/saml'::character varying not null,
  "asserationNS" 		varchar(255) default 'urn:oasis:names:tc:SAML:2.0:assertion'::character varying not null,
  "prefix" 			varchar(255) default 'ONELOGIN'::character varying NOT NULL,
  "issuer" 			varchar(255) not null,
  "is_default" 			integer default 0 not null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);
INSERT INTO adm_cts_settings VALUES (1, 'default_saml.key', 'default_saml.crt', 'default_testmpass.pem', '/User/site/login', 'https://testmpass.gov.md/login/saml','https://testmpass.gov.md/logout/saml','urn:oasis:names:tc:SAML:2.0:assertion', 'ONELOGIN', 'http://ghiseu.justice.gov.md/', 1, 9223372036854775807, '2015-02-20 11:49:49', 9223372036854775807, '2015-02-25 15:39:38');

SELECT pg_catalog.setval('adm_cts_settings_id_seq', 3, false);





/* 4. RBAC Tables */

/* 4.1. Table authitem */

drop table if exists "authitem";
create table "authitem"
(
   "name"			varchar(64) not null,
   "type"			integer not null,
   "description"		text,
   "bizrule"			text,
   "data"			text,
   primary key ("name")
);

/* 4.2. Table authitemchild */

drop table if exists "authitemchild";
create table "authitemchild"
(
   "parent"			varchar(64) not null,
   "child"			varchar(64) not null,
   primary key ("parent","child"),
   foreign key ("parent") references "authitem" ("name") on delete cascade on update cascade,
   foreign key ("child") references "authitem" ("name") on delete cascade on update cascade
);


/* 4.3. Table authassignment */

drop table if exists "authassignment";
create table "authassignment"
(
   "itemname"			varchar(64) not null,
   "userid"			varchar(64) not null,
   "bizrule"			text,
   "data"			text,
   primary key ("itemname","userid"),
   foreign key ("itemname") references "authitem" ("name") on delete cascade on update cascade
);

/* 5. System tables */

/* 5.1. Table with system Modules */

drop table if exists "sys_modules";
create table "sys_modules" 
(
  "id"				bigserial unique not null,
  "name"			varchar(150) not null,
  "activ"			int default 0,
  "dump_restore"		int default 0,
  "parent_id"			int default 0,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);

/* includerea modulului Clasificator */

INSERT INTO sys_modules VALUES (1, 'Clasificator', 1, 0, 0, 1, current_timestamp, null, null);

SELECT pg_catalog.setval('sys_modules_id_seq', 2, false);

drop table if exists "cl_bank_setings";
drop table if exists "cl_contacts_book";
drop table if exists "cl_address";
drop table if exists "cl_subsidiary";
drop table if exists "cl_department";
drop table if exists "cl_organisation";

/* 5.1.1. Table with organisations of users (part of clasificator module */

create table "cl_organisation"
(
  "id"				bigserial unique not null,
  "name"			varchar(150) not null,
  "description"			text null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);

/* 5.1.2. Table with departments of users (part of clasificator module */

create table "cl_department"
(
  "id"				bigserial unique not null,
  "name"			varchar(150) not null,
  "description"			text null,
  "organisation_id"		bigint not null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("organisation_id") references "cl_organisation" ("id") on delete cascade on update cascade
);

/* 5.1.3. Table with subsidiaries of users (part of clasificator module */

create table "cl_subsidiary"
(
  "id"				bigserial unique not null,
  "name"			varchar(150) not null,
  "description"			text null,
  "department_id"		bigint not null,
  "organisation_id"	bigint not null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id"),
  foreign key ("department_id") references "cl_department" ("id") on delete cascade on update cascade
);

create table "cl_bank_setings" (
  "id" 			bigserial unique not null,
  "state_tax" 		varchar(50) null,
  "service_tax" 		varchar(50) null,
  "configuration_code_state" 		varchar(100) null,
  "bank_fiscal_code_state" 		varchar(50) null,
  "bank_account_state" 		varchar(50) null,
  "treasury_account_name_state" 		varchar(50) null,
  "beneficiary_name_state" 		varchar(500) null,
  "treasury_account_state" 		varchar(50) null,
  "line_id_state" 		varchar(50) null,
  "reason_state" 		varchar(500) null,
  "configuration_code_service" 		varchar(50) null,
  "bank_fiscal_code_service" 		varchar(50) null,
  "bank_account_service" 		varchar(50) null,
  "beneficiary_name_servie" 		varchar(500) null,
  "treasury_account_name_servie" 		varchar(50) null,
  "treasury_account_service" 		varchar(50) null,
  "line_id_service" 		varchar(50) null,
  "reason_service" 		varchar(500) null,
  "organisation_id" 		bigint null,
  "department_id" 		bigint null,
  "subsidiary_id" 		bigint null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id"),
  foreign key ("organisation_id") references "cl_organisation" ("id") on delete cascade on update cascade,
  foreign key ("department_id") references "cl_department" ("id") on delete cascade on update cascade,
  foreign key ("subsidiary_id") references "cl_subsidiary" ("id") on delete cascade on update cascade
);

-- --------------------------------------------------------

--
-- Table structure for table `cl_contacts_book`
--


create table "cl_contacts_book" (
  "id" 			bigserial unique not null,
  "name_surname" 		varchar(150) null,
  "idnp" 		varchar(13) null,
  "series" 		varchar(9) null,
  "email" 		varchar(100) null,
  "phone" 		varchar(50) null,
  "mobile" 		varchar(50) null,
  "organisation_id" 		bigint null,
  "department_id" 		bigint null,
  "subsidiary_id" 		bigint null,
  "address_identity" 	varchar(100) null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id"),
  foreign key ("organisation_id") references "cl_organisation" ("id") on delete cascade on update cascade,
  foreign key ("department_id") references "cl_department" ("id") on delete cascade on update cascade,
  foreign key ("subsidiary_id") references "cl_subsidiary" ("id") on delete cascade on update cascade
);

--
-- Table structure for table `cl_countries`
--

drop table if exists cl_countries;
create table cl_countries (
  "id" 			bigserial unique not null,
  "name" 		varchar(100) not null,
  "description" 	varchar(300) null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id")
);

-- --------------------------------------------------------

--
-- Table structure for table `cl_locality_type`
--

drop table if exists cl_locality;
drop table if exists cl_locality_type;
create table cl_locality_type (
  "id" 			bigserial unique not null,
  "name" 		varchar(100) null,
  "description" 	varchar(300) null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id")
);

-- --------------------------------------------------------

--
-- Table structure for table `cl_region_type`
--

drop table if exists "cl_region";
drop table if exists "cl_region_type";
create table "cl_region_type" (
  "id" 			bigserial unique not null,
  "name" 		varchar(100) null,
  "description" 	varchar(300) null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id")
);

-- --------------------------------------------------------

--
-- Table structure for table `cl_region`
--

create table "cl_region" (
  "id" 			bigserial unique not null,
  "country_id" bigint NOT NULL,
  "name" 		varchar(100) null,
  "description" 	varchar(300) null,
  "region_type_id" 	bigint not null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id"),
  foreign key ("region_type_id") references "cl_region_type" ("id") on delete cascade on update cascade
);

-- --------------------------------------------------------

--
-- Table structure for table `cl_locality`
--

create table cl_locality (
  "id" 			bigserial unique not null,
  "name" 		varchar(100) null,
  "description" 	varchar(300) null,
  "locality_type_id" 	bigint not null,
  "region_id" 		bigint not null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id"),
  foreign key ("locality_type_id") references "cl_locality_type" ("id") on delete cascade on update cascade,
  foreign key ("region_id") references "cl_region" ("id") on delete cascade on update cascade
);

-- --------------------------------------------------------

--
-- Table structure for table `cl_nationality`
--

drop table if exists "cl_nationality";
create table "cl_nationality" (
  "id" 			bigserial unique not null,
  "name" 		varchar(50) null,
  "full_name" 		varchar(100) null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id")
);

-- --------------------------------------------------------

--
-- Table structure for table `cl_post`
--

drop table if exists "cl_post";
create table "cl_post" (
  "id" 			bigserial unique not null,
  "name" 		varchar(50) null,
  "description" 	varchar(300) null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id")
);



-- --------------------------------------------------------

--
-- Table structure for table `cl_address`
--


create table "cl_address" (
  "id" 			bigserial unique not null,
  "country" 		bigint null,
  "region" 		bigint null,
  "locality" 		bigint null,
  "street" 		varchar(150) null,
  "postal_code" 		varchar(20) null,
  "organisation_id" 		bigint null,
  "department_id" 		bigint null,
  "subsidiary_id" 		bigint null,
  "contact_id" 	 		bigint null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id"),
  foreign key ("country") references "cl_countries" ("id") on delete cascade on update cascade,
  foreign key ("region") references "cl_region" ("id") on delete cascade on update cascade,
  foreign key ("locality") references "cl_locality" ("id") on delete cascade on update cascade,
  foreign key ("organisation_id") references "cl_organisation" ("id") on delete cascade on update cascade,
  foreign key ("department_id") references "cl_department" ("id") on delete cascade on update cascade,
  foreign key ("subsidiary_id") references "cl_subsidiary" ("id") on delete cascade on update cascade
);

/* 5.2. Table with interdependence of system Modules */

drop table if exists "sys_modulesdependence";
create table "sys_modulesdependence" 
(
  "id"				bigserial unique not null,
  "module_parent"		bigint not null,
  "module_children"		bigint not null,
  primary key ("id")
);


/* 5.3. Table with system exceptions of login */

drop table if exists "sys_login_exception";
create table "sys_login_exception" 
(
  "id"				bigserial unique not null,
  "title"			varchar(100) not null,
  "action"			varchar(100) not null,
  "type"			varchar(100) not null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);

INSERT INTO sys_login_exception VALUES (1, 'Site login', 'site/login', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (2, 'Site Test', 'site/test', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (3, 'User Site Login', 'User/site/login', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (4, 'WebService Cmis Service', 'WebService/cmis/service', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (5, 'Site Index', 'site/index', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (6, 'Site Search Registers', 'site/searchRegisters', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (7, 'User Site Recovery Password', 'User/site/recoveryPassword', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (8, 'Site Logout', 'site/logout', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (9, 'Registration', 'Registration/index', '1', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (10, 'Registration', 'Registration/index', '2', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (11, 'Registration', 'Registration/captcha', '2', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_login_exception VALUES (12, 'User/site/loginAjax', 'User/site/loginAjax', '2', 1, current_timestamp, NULL, NULL);

SELECT pg_catalog.setval('sys_login_exception_id_seq', 13, true);



/* 5.4. Table with system dashboards */

drop table if exists "sys_dashboard";
create table "sys_dashboard" 
(
  "id"				bigserial unique not null,
  "name"			varchar(100) not null,
  "is_folder"			integer null,
  "view_name"			varchar(100) not null,
  "color"			varchar(50) null,
  "create_user_id"		bigint not null,
  "create_datetime"		timestamp not null default current_timestamp,
  "update_user_id"		bigint null,
  "update_datetime"		timestamp null,
  primary key ("id")
);

INSERT INTO sys_dashboard VALUES (1, 'Calendar Personal', 0, 'calendar', 'grape', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_dashboard VALUES (2, 'Lista sarcini', 0, 'tasks', 'inverse', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_dashboard VALUES (3, 'Notificari', 0, 'notifications', 'info', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_dashboard VALUES (4, 'Folder', 1, 'folder', 'success', 1, current_timestamp, NULL, NULL);
INSERT INTO sys_dashboard VALUES (5, 'Reports', 1, 'reports', 'success', 1, current_timestamp, NULL, NULL);

SELECT pg_catalog.setval('sys_dashboard_id_seq', 6, true);



/* 5.5. Table with system db updates */

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



/* 5.6. Table with system default errors */

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

insert into "sys_default_errors" values(1, 500, 'CDbException', '42', 'Eroare de executie a codului SQL', 1, current_timestamp, NULL, NULL);
insert into "sys_default_errors" values(2, 500, 'PHP warning', '001', 'Ati accesat o adresa URL nevalida', 1, current_timestamp, NULL, NULL);

SELECT pg_catalog.setval('sys_default_errors_id_seq', 3, true);

-- --------------------------------------------------------

--
-- Table structure for table `sys_files_formats`
--

drop table if exists "sys_files_formats";
create table "sys_files_formats" (
  "id" 			bigserial unique not null,
  "title" 		varchar(100) not null,
  "extension" 		varchar(50) not null,
  "content_type" 	varchar(100) not null,
  "icon" 		varchar(100) not null,
  "status" 		varchar(2),
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id")
);

--
-- Dumping data for table `sys_files_formats`
--

insert into "sys_files_formats" (title, extension, content_type, icon, status,  create_user_id, create_datetime, update_user_id, update_datetime) VALUES
('PDF', 'pdf', 'application/pdf', 'icons/objects/pdf.png', 1, 1, '2013-03-04 14:02:00', null, null),
('GIF', 'gif', 'image/gif', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', null, null),
('SQL', 'sql', 'text/plain', 'icons/objects/document.png', 1, 1, '2013-03-04 14:02:00', null, null),
('JPEG', 'jpeg', 'image/jpeg', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', null, null),
('JPG', 'jpg', 'image/jpeg', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', null, null),
('PNG', 'png', 'image/png', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', null, null),
('TIFF', 'tiff', 'image/tiff', 'icons/objects/image.png', 1, 1, '2013-03-04 14:02:00', null, null),
('DOCX', 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'icons/objects/document.png', 1, 1, '2013-03-04 14:02:00', 1, '2013-03-21 10:22:10'),
('CRT', 'crt', 'text/plain', 'icons/objects/pdf.png', 1, 1, '2013-04-25 10:29:19', null, null),
('xades', 'xades', 'text/html', 'icons/objects/pdf.png', 1, 1, '2013-11-19 00:00:00', null, null);

-- --------------------------------------------------------

--
-- Table structure for table `sys_storage`
--

drop table if exists "sys_storage";
create table "sys_storage" (
  "id" 			bigserial unique not null,
  "name" 		varchar(100) not null,
  "path" 		varchar(100) not null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id")
);

--
-- Dumping data for table `sys_storage`
--

INSERT INTO sys_storage VALUES (0, 'Temp', './storage/Temp/', 1, current_timestamp, null, null);
INSERT INTO sys_storage VALUES (1, 'Operativa', './storage/Operativa/', 1, current_timestamp, null, null);
INSERT INTO sys_storage VALUES (2, 'appStorage', './storage/appStorage/', 1, current_timestamp, null, null);
INSERT INTO sys_storage VALUES (4, 'Avatars', './storage/Avatars', 1, current_timestamp, null, null);
INSERT INTO sys_storage VALUES (11, 'Templates', './storage/Templates/', 1, current_timestamp, null, null);

SELECT pg_catalog.setval('sys_storage_id_seq', 12, true);

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

INSERT INTO sys_base_configs VALUES (1, 'SYSTEM MAIL', 'yiiteste@gmail.com', 1, current_timestamp, null, null);
INSERT INTO sys_base_configs VALUES (2, 'SYSTEM NAME ', 'Synapsis', 1, current_timestamp, null, null);
INSERT INTO sys_base_configs VALUES (3, 'SYSTEM MAIL HOST', 'smtp.gmail.com', 1, current_timestamp, null, null);
INSERT INTO sys_base_configs VALUES (4, 'SYSTEM MAIL PORT', '587', 1, current_timestamp, null, null);
INSERT INTO sys_base_configs VALUES (5, 'SYSTEM MAIL SECURE TLS', 'tls', 1, current_timestamp, null, null);
INSERT INTO sys_base_configs VALUES (6, 'SYSTEM MAIL PASSWORD', 'YIIteste1', 1, current_timestamp, null, null);

CREATE TABLE cli_owncloud_config
(
  "id"				bigserial unique not null,
  name character varying(150),
  url character varying(255),
  admin_user character varying(255),
  password character varying(150),
  create_user_id bigint,
  create_datetime timestamp without time zone DEFAULT now(),
  update_user_id bigint,
  update_datetime timestamp without time zone,
  default_folder character varying(255),
  primary key ("id")
);

--
-- Table structure for table `cl_acces_limitacces`
--

drop table if exists cl_acces_limitacces;
create table cl_acces_limitacces (
  "id"			bigserial unique not null,
  "name"		varchar(100) not null,
  "rule"		varchar(50) null,
  "actions"		text null,
  "create_user_id" 	bigint not null,
  "create_datetime" 	timestamp not null default current_timestamp,
  "update_user_id" 	bigint null,
  "update_datetime" 	timestamp null,
  primary key ("id")
);


INSERT INTO authitem(
            name, type, description, bizrule, data)
    VALUES ('Client', 1, 'Client', null, 'N;');

