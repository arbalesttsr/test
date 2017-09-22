drop table if exists "reg_configuration_registers";
CREATE TABLE reg_configuration_registers
(
  id 			bigserial unique not null,
  reg_name character varying(255),
  model_name character varying(255),
  reg_field character varying(255),
  model_field character varying(255),
  create_user_id bigint,
  create_datetime timestamp without time zone DEFAULT now(),
  update_user_id bigint,
  update_datetime timestamp without time zone,
  primary key ("id")
);
