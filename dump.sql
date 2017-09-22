--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: adm_cert_certificate_info; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_cert_certificate_info (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    country_name character varying(3) NOT NULL,
    state_or_province_name character varying(255) NOT NULL,
    locality_name character varying(255) NOT NULL,
    organization_name character varying(255) NOT NULL,
    organizational_unit_name character varying(255) NOT NULL,
    common_name character varying(255) NOT NULL,
    email_address character varying(255) NOT NULL,
    passphrase character varying(100) NOT NULL,
    cert_crt text,
    cert_key text,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_cert_certificate_info OWNER TO postgres;

--
-- Name: adm_cert_certificate_info_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_cert_certificate_info_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_cert_certificate_info_id_seq OWNER TO postgres;

--
-- Name: adm_cert_certificate_info_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_cert_certificate_info_id_seq OWNED BY adm_cert_certificate_info.id;


--
-- Name: adm_cert_settings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_cert_settings (
    id bigint NOT NULL,
    certificates_path character varying(255) NOT NULL,
    key_path character varying(255) NOT NULL,
    openssl_config_path character varying(255) NOT NULL,
    digest_alg character varying(100) DEFAULT 'sha512'::character varying NOT NULL,
    private_key_bits bigint DEFAULT (2048)::bigint NOT NULL,
    private_key_type character varying(100) DEFAULT 'OPENSSL_KEYTYPE_RSA'::character varying NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone,
    default_id integer
);


ALTER TABLE public.adm_cert_settings OWNER TO postgres;

--
-- Name: adm_cert_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_cert_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_cert_settings_id_seq OWNER TO postgres;

--
-- Name: adm_cert_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_cert_settings_id_seq OWNED BY adm_cert_settings.id;


--
-- Name: adm_chatmessage; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_chatmessage (
    id bigint NOT NULL,
    msg text NOT NULL,
    date timestamp without time zone NOT NULL,
    "from" bigint NOT NULL,
    "to" bigint,
    type character varying(100) NOT NULL,
    readed integer,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_chatmessage OWNER TO postgres;

--
-- Name: adm_chatmessage_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_chatmessage_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_chatmessage_id_seq OWNER TO postgres;

--
-- Name: adm_chatmessage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_chatmessage_id_seq OWNED BY adm_chatmessage.id;


--
-- Name: adm_cts_settings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_cts_settings (
    id bigint NOT NULL,
    key text NOT NULL,
    certificate text NOT NULL,
    validate_response_key text NOT NULL,
    callback_url character varying(255) NOT NULL,
    login_url character varying(255) DEFAULT 'https://testmpass.gov.md/login/saml'::character varying NOT NULL,
    logout_url character varying(255) DEFAULT 'https://testmpass.gov.md/logout/saml'::character varying NOT NULL,
    "asserationNS" character varying(255) DEFAULT 'urn:oasis:names:tc:SAML:2.0:assertion'::character varying NOT NULL,
    prefix character varying(255) DEFAULT 'ONELOGIN'::character varying NOT NULL,
    issuer character varying(255) NOT NULL,
    is_default integer DEFAULT 0 NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_cts_settings OWNER TO postgres;

--
-- Name: adm_cts_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_cts_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_cts_settings_id_seq OWNER TO postgres;

--
-- Name: adm_cts_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_cts_settings_id_seq OWNED BY adm_cts_settings.id;


--
-- Name: adm_dashboardconfig; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_dashboardconfig (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    dashboard_config text,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_dashboardconfig OWNER TO postgres;

--
-- Name: adm_dashboardconfig_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_dashboardconfig_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_dashboardconfig_id_seq OWNER TO postgres;

--
-- Name: adm_dashboardconfig_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_dashboardconfig_id_seq OWNED BY adm_dashboardconfig.id;


--
-- Name: adm_holidays; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_holidays (
    id bigint NOT NULL,
    holiday_date timestamp without time zone,
    description character varying(255),
    holiday_enable integer DEFAULT 0 NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_holidays OWNER TO postgres;

--
-- Name: adm_holidays_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_holidays_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_holidays_id_seq OWNER TO postgres;

--
-- Name: adm_holidays_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_holidays_id_seq OWNED BY adm_holidays.id;


--
-- Name: adm_ldap_settings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_ldap_settings (
    id bigint NOT NULL,
    ldap_host character varying(150) NOT NULL,
    ldap_port character varying(10) NOT NULL,
    ldap_dc character varying(255) NOT NULL,
    ldap_ou character varying(255) NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_ldap_settings OWNER TO postgres;

--
-- Name: adm_ldap_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_ldap_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_ldap_settings_id_seq OWNER TO postgres;

--
-- Name: adm_ldap_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_ldap_settings_id_seq OWNED BY adm_ldap_settings.id;


--
-- Name: adm_ldap_user_relation; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_ldap_user_relation (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    ldap_setting_id bigint NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_ldap_user_relation OWNER TO postgres;

--
-- Name: adm_ldap_user_relation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_ldap_user_relation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_ldap_user_relation_id_seq OWNER TO postgres;

--
-- Name: adm_ldap_user_relation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_ldap_user_relation_id_seq OWNED BY adm_ldap_user_relation.id;


--
-- Name: adm_profile; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_profile (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    idnp character varying(13),
    email character varying(64),
    firstname character varying(45),
    lastname character varying(45),
    patronymic character varying(45),
    gender integer DEFAULT 0,
    birthday date,
    about text,
    post_id bigint,
    department_id bigint,
    subsidiary_id bigint,
    locality_id bigint,
    phone character varying(45),
    mobile character varying(45),
    avatar character varying(200),
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_profile OWNER TO postgres;

--
-- Name: adm_profile_additional; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_profile_additional (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    start_page character varying(255)
);


ALTER TABLE public.adm_profile_additional OWNER TO postgres;

--
-- Name: adm_profile_additional_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_profile_additional_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_profile_additional_id_seq OWNER TO postgres;

--
-- Name: adm_profile_additional_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_profile_additional_id_seq OWNED BY adm_profile_additional.id;


--
-- Name: adm_profile_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_profile_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_profile_id_seq OWNER TO postgres;

--
-- Name: adm_profile_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_profile_id_seq OWNED BY adm_profile.id;


--
-- Name: adm_sa_access; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_sa_access (
    id bigint NOT NULL,
    ip character varying(20) NOT NULL
);


ALTER TABLE public.adm_sa_access OWNER TO postgres;

--
-- Name: adm_sa_access_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_sa_access_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_sa_access_id_seq OWNER TO postgres;

--
-- Name: adm_sa_access_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_sa_access_id_seq OWNED BY adm_sa_access.id;


--
-- Name: adm_user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_user (
    id bigint NOT NULL,
    username character varying(255) NOT NULL,
    password_hash character varying(255) NOT NULL,
    ad_username character varying(45),
    idnp character varying(13),
    certificate_path character varying(255),
    status_id integer DEFAULT 0 NOT NULL,
    sql_user integer DEFAULT 0 NOT NULL,
    penalization character varying(500),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_user OWNER TO postgres;

--
-- Name: adm_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_user_id_seq OWNER TO postgres;

--
-- Name: adm_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_user_id_seq OWNED BY adm_user.id;


--
-- Name: adm_user_settings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_user_settings (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    time_limit character varying(20) NOT NULL,
    restricted_id integer NOT NULL,
    restricted_days character varying(50),
    restricted_date character varying(255),
    restricted_interval character varying(255),
    date_start timestamp without time zone,
    start_time character varying(10),
    end_time character varying(10),
    holiday_enable integer DEFAULT 0,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.adm_user_settings OWNER TO postgres;

--
-- Name: adm_user_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_user_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_user_settings_id_seq OWNER TO postgres;

--
-- Name: adm_user_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_user_settings_id_seq OWNED BY adm_user_settings.id;


--
-- Name: adm_users_activity; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adm_users_activity (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    last_activity timestamp without time zone,
    last_url character varying(300)
);


ALTER TABLE public.adm_users_activity OWNER TO postgres;

--
-- Name: adm_users_activity_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adm_users_activity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adm_users_activity_id_seq OWNER TO postgres;

--
-- Name: adm_users_activity_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adm_users_activity_id_seq OWNED BY adm_users_activity.id;


--
-- Name: authassignment; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authassignment (
    itemname character varying(64) NOT NULL,
    userid character varying(64) NOT NULL,
    bizrule text,
    data text
);


ALTER TABLE public.authassignment OWNER TO postgres;

--
-- Name: authitem; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authitem (
    name character varying(64) NOT NULL,
    type integer NOT NULL,
    description text,
    bizrule text,
    data text
);


ALTER TABLE public.authitem OWNER TO postgres;

--
-- Name: authitemchild; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE authitemchild (
    parent character varying(64) NOT NULL,
    child character varying(64) NOT NULL
);


ALTER TABLE public.authitemchild OWNER TO postgres;

--
-- Name: cl_acces_limitacces; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_acces_limitacces (
    id bigint NOT NULL,
    name character varying(100) NOT NULL,
    rule character varying(50),
    actions text,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_acces_limitacces OWNER TO postgres;

--
-- Name: cl_acces_limitacces_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_acces_limitacces_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_acces_limitacces_id_seq OWNER TO postgres;

--
-- Name: cl_acces_limitacces_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_acces_limitacces_id_seq OWNED BY cl_acces_limitacces.id;


--
-- Name: cl_address; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_address (
    id bigint NOT NULL,
    country bigint,
    region bigint,
    locality bigint,
    street character varying(150),
    postal_code character varying(20),
    organisation_id bigint,
    department_id bigint,
    subsidiary_id bigint,
    contact_id bigint,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_address OWNER TO postgres;

--
-- Name: cl_address_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_address_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_address_id_seq OWNER TO postgres;

--
-- Name: cl_address_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_address_id_seq OWNED BY cl_address.id;


--
-- Name: cl_bank_setings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_bank_setings (
    id bigint NOT NULL,
    state_tax character varying(50),
    service_tax character varying(50),
    configuration_code_state character varying(100),
    bank_fiscal_code_state character varying(50),
    bank_account_state character varying(50),
    treasury_account_name_state character varying(50),
    beneficiary_name_state character varying(500),
    treasury_account_state character varying(50),
    line_id_state character varying(50),
    reason_state character varying(500),
    configuration_code_service character varying(50),
    bank_fiscal_code_service character varying(50),
    bank_account_service character varying(50),
    beneficiary_name_servie character varying(500),
    treasury_account_name_servie character varying(50),
    treasury_account_service character varying(50),
    line_id_service character varying(50),
    reason_service character varying(500),
    organisation_id bigint,
    department_id bigint,
    subsidiary_id bigint,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_bank_setings OWNER TO postgres;

--
-- Name: cl_bank_setings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_bank_setings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_bank_setings_id_seq OWNER TO postgres;

--
-- Name: cl_bank_setings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_bank_setings_id_seq OWNED BY cl_bank_setings.id;


--
-- Name: cl_contacts_book; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_contacts_book (
    id bigint NOT NULL,
    name_surname character varying(150),
    idnp character varying(13),
    series character varying(9),
    email character varying(100),
    phone character varying(50),
    mobile character varying(50),
    organisation_id bigint,
    department_id bigint,
    subsidiary_id bigint,
    address_identity character varying(100),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_contacts_book OWNER TO postgres;

--
-- Name: cl_contacts_book_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_contacts_book_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_contacts_book_id_seq OWNER TO postgres;

--
-- Name: cl_contacts_book_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_contacts_book_id_seq OWNED BY cl_contacts_book.id;


--
-- Name: cl_countries; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_countries (
    id bigint NOT NULL,
    name character varying(100) NOT NULL,
    description character varying(300),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_countries OWNER TO postgres;

--
-- Name: cl_countries_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_countries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_countries_id_seq OWNER TO postgres;

--
-- Name: cl_countries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_countries_id_seq OWNED BY cl_countries.id;


--
-- Name: cl_department; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_department (
    id bigint NOT NULL,
    name character varying(150) NOT NULL,
    description text,
    organisation_id bigint NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_department OWNER TO postgres;

--
-- Name: cl_department_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_department_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_department_id_seq OWNER TO postgres;

--
-- Name: cl_department_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_department_id_seq OWNED BY cl_department.id;


--
-- Name: cl_locality; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_locality (
    id bigint NOT NULL,
    name character varying(100),
    description character varying(300),
    locality_type_id bigint NOT NULL,
    region_id bigint NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_locality OWNER TO postgres;

--
-- Name: cl_locality_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_locality_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_locality_id_seq OWNER TO postgres;

--
-- Name: cl_locality_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_locality_id_seq OWNED BY cl_locality.id;


--
-- Name: cl_locality_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_locality_type (
    id bigint NOT NULL,
    name character varying(100),
    description character varying(300),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_locality_type OWNER TO postgres;

--
-- Name: cl_locality_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_locality_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_locality_type_id_seq OWNER TO postgres;

--
-- Name: cl_locality_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_locality_type_id_seq OWNED BY cl_locality_type.id;


--
-- Name: cl_nationality; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_nationality (
    id bigint NOT NULL,
    name character varying(50),
    full_name character varying(100),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_nationality OWNER TO postgres;

--
-- Name: cl_nationality_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_nationality_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_nationality_id_seq OWNER TO postgres;

--
-- Name: cl_nationality_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_nationality_id_seq OWNED BY cl_nationality.id;


--
-- Name: cl_organisation; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_organisation (
    id bigint NOT NULL,
    name character varying(150) NOT NULL,
    description text,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_organisation OWNER TO postgres;

--
-- Name: cl_organisation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_organisation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_organisation_id_seq OWNER TO postgres;

--
-- Name: cl_organisation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_organisation_id_seq OWNED BY cl_organisation.id;


--
-- Name: cl_post; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_post (
    id bigint NOT NULL,
    name character varying(50),
    description character varying(300),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_post OWNER TO postgres;

--
-- Name: cl_post_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_post_id_seq OWNER TO postgres;

--
-- Name: cl_post_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_post_id_seq OWNED BY cl_post.id;


--
-- Name: cl_region; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_region (
    id bigint NOT NULL,
    country_id bigint NOT NULL,
    name character varying(100),
    description character varying(300),
    region_type_id bigint NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_region OWNER TO postgres;

--
-- Name: cl_region_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_region_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_region_id_seq OWNER TO postgres;

--
-- Name: cl_region_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_region_id_seq OWNED BY cl_region.id;


--
-- Name: cl_region_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_region_type (
    id bigint NOT NULL,
    name character varying(100),
    description character varying(300),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_region_type OWNER TO postgres;

--
-- Name: cl_region_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_region_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_region_type_id_seq OWNER TO postgres;

--
-- Name: cl_region_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_region_type_id_seq OWNED BY cl_region_type.id;


--
-- Name: cl_subsidiary; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cl_subsidiary (
    id bigint NOT NULL,
    name character varying(150) NOT NULL,
    description text,
    department_id bigint NOT NULL,
    organisation_id bigint NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cl_subsidiary OWNER TO postgres;

--
-- Name: cl_subsidiary_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cl_subsidiary_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cl_subsidiary_id_seq OWNER TO postgres;

--
-- Name: cl_subsidiary_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cl_subsidiary_id_seq OWNED BY cl_subsidiary.id;


--
-- Name: cli_cert_certificate_info; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_cert_certificate_info (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    country_name character varying(3) NOT NULL,
    state_or_province_name character varying(255) NOT NULL,
    locality_name character varying(255) NOT NULL,
    organization_name character varying(255) NOT NULL,
    organizational_unit_name character varying(255) NOT NULL,
    common_name character varying(255) NOT NULL,
    email_address character varying(255) NOT NULL,
    passphrase character varying(100) NOT NULL,
    cert_crt text,
    cert_key text,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cli_cert_certificate_info OWNER TO postgres;

--
-- Name: cli_cert_certificate_info_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_cert_certificate_info_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_cert_certificate_info_id_seq OWNER TO postgres;

--
-- Name: cli_cert_certificate_info_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_cert_certificate_info_id_seq OWNED BY cli_cert_certificate_info.id;


--
-- Name: cli_chatmessage; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_chatmessage (
    id bigint NOT NULL,
    msg text NOT NULL,
    date timestamp without time zone NOT NULL,
    "from" bigint NOT NULL,
    "to" bigint,
    type character varying(100) NOT NULL,
    readed integer,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cli_chatmessage OWNER TO postgres;

--
-- Name: cli_chatmessage_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_chatmessage_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_chatmessage_id_seq OWNER TO postgres;

--
-- Name: cli_chatmessage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_chatmessage_id_seq OWNED BY cli_chatmessage.id;


--
-- Name: cli_dashboardconfig; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_dashboardconfig (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    dashboard_config text,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cli_dashboardconfig OWNER TO postgres;

--
-- Name: cli_dashboardconfig_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_dashboardconfig_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_dashboardconfig_id_seq OWNER TO postgres;

--
-- Name: cli_dashboardconfig_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_dashboardconfig_id_seq OWNED BY cli_dashboardconfig.id;


--
-- Name: cli_holidays; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_holidays (
    id bigint NOT NULL,
    holiday_date timestamp without time zone,
    description character varying(255),
    holiday_enable integer DEFAULT 0 NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cli_holidays OWNER TO postgres;

--
-- Name: cli_holidays_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_holidays_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_holidays_id_seq OWNER TO postgres;

--
-- Name: cli_holidays_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_holidays_id_seq OWNED BY cli_holidays.id;


--
-- Name: cli_owncloud_config; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_owncloud_config (
    id bigint NOT NULL,
    name character varying(150),
    url character varying(255),
    admin_user character varying(255),
    password character varying(150),
    create_user_id bigint,
    create_datetime timestamp without time zone DEFAULT now(),
    update_user_id bigint,
    update_datetime timestamp without time zone,
    default_folder character varying(255)
);


ALTER TABLE public.cli_owncloud_config OWNER TO postgres;

--
-- Name: cli_owncloud_config_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_owncloud_config_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_owncloud_config_id_seq OWNER TO postgres;

--
-- Name: cli_owncloud_config_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_owncloud_config_id_seq OWNED BY cli_owncloud_config.id;


--
-- Name: cli_profile; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_profile (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    idnp character varying(13),
    email character varying(64),
    firstname character varying(45),
    lastname character varying(45),
    patronymic character varying(45),
    gender integer DEFAULT 0,
    birthday date,
    about text,
    post_id bigint,
    department_id bigint,
    subsidiary_id bigint,
    locality_id bigint,
    phone character varying(45),
    mobile character varying(45),
    avatar character varying(200),
    update_datetime timestamp without time zone
);


ALTER TABLE public.cli_profile OWNER TO postgres;

--
-- Name: cli_profile_additional; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_profile_additional (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    start_page character varying(255)
);


ALTER TABLE public.cli_profile_additional OWNER TO postgres;

--
-- Name: cli_profile_additional_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_profile_additional_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_profile_additional_id_seq OWNER TO postgres;

--
-- Name: cli_profile_additional_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_profile_additional_id_seq OWNED BY cli_profile_additional.id;


--
-- Name: cli_profile_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_profile_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_profile_id_seq OWNER TO postgres;

--
-- Name: cli_profile_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_profile_id_seq OWNED BY cli_profile.id;


--
-- Name: cli_user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_user (
    id bigint NOT NULL,
    username character varying(255) NOT NULL,
    password_hash character varying(255) NOT NULL,
    ad_username character varying(45),
    idnp character varying(13),
    certificate_path character varying(255),
    status_id integer DEFAULT 0 NOT NULL,
    confirmation integer DEFAULT 0,
    regle integer DEFAULT 0,
    sql_user integer DEFAULT 1 NOT NULL,
    penalization character varying(500),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cli_user OWNER TO postgres;

--
-- Name: cli_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_user_id_seq OWNER TO postgres;

--
-- Name: cli_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_user_id_seq OWNED BY cli_user.id;


--
-- Name: cli_user_settings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_user_settings (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    time_limit character varying(20) NOT NULL,
    restricted_id integer NOT NULL,
    restricted_days character varying(50),
    restricted_date character varying(255),
    restricted_interval character varying(255),
    date_start timestamp without time zone,
    start_time character varying(10),
    end_time character varying(10),
    holiday_enable integer DEFAULT 0,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.cli_user_settings OWNER TO postgres;

--
-- Name: cli_user_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_user_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_user_settings_id_seq OWNER TO postgres;

--
-- Name: cli_user_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_user_settings_id_seq OWNED BY cli_user_settings.id;


--
-- Name: cli_users_activity; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cli_users_activity (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    last_activity timestamp without time zone,
    last_url character varying(300)
);


ALTER TABLE public.cli_users_activity OWNER TO postgres;

--
-- Name: cli_users_activity_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cli_users_activity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_users_activity_id_seq OWNER TO postgres;

--
-- Name: cli_users_activity_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cli_users_activity_id_seq OWNED BY cli_users_activity.id;


--
-- Name: sys_base_configs; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_base_configs (
    id bigint NOT NULL,
    config_label character varying(200) NOT NULL,
    config_value character varying(300) NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.sys_base_configs OWNER TO postgres;

--
-- Name: sys_base_configs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_base_configs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_base_configs_id_seq OWNER TO postgres;

--
-- Name: sys_base_configs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_base_configs_id_seq OWNED BY sys_base_configs.id;


--
-- Name: sys_dashboard; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_dashboard (
    id bigint NOT NULL,
    name character varying(100) NOT NULL,
    is_folder integer,
    view_name character varying(100) NOT NULL,
    color character varying(50),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.sys_dashboard OWNER TO postgres;

--
-- Name: sys_dashboard_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_dashboard_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_dashboard_id_seq OWNER TO postgres;

--
-- Name: sys_dashboard_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_dashboard_id_seq OWNED BY sys_dashboard.id;


--
-- Name: sys_dbupdates; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_dbupdates (
    id bigint NOT NULL,
    filename character varying(200) NOT NULL,
    executed integer,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.sys_dbupdates OWNER TO postgres;

--
-- Name: sys_dbupdates_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_dbupdates_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_dbupdates_id_seq OWNER TO postgres;

--
-- Name: sys_dbupdates_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_dbupdates_id_seq OWNED BY sys_dbupdates.id;


--
-- Name: sys_default_errors; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_default_errors (
    id bigint NOT NULL,
    code integer,
    type character varying(200),
    error_code character varying(200),
    message text,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.sys_default_errors OWNER TO postgres;

--
-- Name: sys_default_errors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_default_errors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_default_errors_id_seq OWNER TO postgres;

--
-- Name: sys_default_errors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_default_errors_id_seq OWNED BY sys_default_errors.id;


--
-- Name: sys_files_formats; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_files_formats (
    id bigint NOT NULL,
    title character varying(100) NOT NULL,
    extension character varying(50) NOT NULL,
    content_type character varying(100) NOT NULL,
    icon character varying(100) NOT NULL,
    status character varying(2),
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.sys_files_formats OWNER TO postgres;

--
-- Name: sys_files_formats_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_files_formats_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_files_formats_id_seq OWNER TO postgres;

--
-- Name: sys_files_formats_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_files_formats_id_seq OWNED BY sys_files_formats.id;


--
-- Name: sys_login_exception; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_login_exception (
    id bigint NOT NULL,
    title character varying(100) NOT NULL,
    action character varying(100) NOT NULL,
    type character varying(100) NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.sys_login_exception OWNER TO postgres;

--
-- Name: sys_login_exception_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_login_exception_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_login_exception_id_seq OWNER TO postgres;

--
-- Name: sys_login_exception_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_login_exception_id_seq OWNED BY sys_login_exception.id;


--
-- Name: sys_modules; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_modules (
    id bigint NOT NULL,
    name character varying(150) NOT NULL,
    activ integer DEFAULT 0,
    dump_restore integer DEFAULT 0,
    parent_id integer DEFAULT 0,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone DEFAULT now() NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.sys_modules OWNER TO postgres;

--
-- Name: sys_modules_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_modules_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_modules_id_seq OWNER TO postgres;

--
-- Name: sys_modules_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_modules_id_seq OWNED BY sys_modules.id;


--
-- Name: sys_modulesdependence; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_modulesdependence (
    id bigint NOT NULL,
    module_parent bigint NOT NULL,
    module_children bigint NOT NULL
);


ALTER TABLE public.sys_modulesdependence OWNER TO postgres;

--
-- Name: sys_modulesdependence_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_modulesdependence_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_modulesdependence_id_seq OWNER TO postgres;

--
-- Name: sys_modulesdependence_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_modulesdependence_id_seq OWNED BY sys_modulesdependence.id;


--
-- Name: sys_storage; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sys_storage (
    id bigint NOT NULL,
    name character varying(100) NOT NULL,
    path character varying(100) NOT NULL,
    create_user_id bigint NOT NULL,
    create_datetime timestamp without time zone NOT NULL,
    update_user_id bigint,
    update_datetime timestamp without time zone
);


ALTER TABLE public.sys_storage OWNER TO postgres;

--
-- Name: sys_storage_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sys_storage_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sys_storage_id_seq OWNER TO postgres;

--
-- Name: sys_storage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sys_storage_id_seq OWNED BY sys_storage.id;


--
-- Name: tbl_instante; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_instante (
    id bigint NOT NULL,
    name text NOT NULL,
    dataexec timestamp without time zone NOT NULL,
    stare text NOT NULL,
    erori text NOT NULL
);


ALTER TABLE public.tbl_instante OWNER TO postgres;

--
-- Name: tbl_instante_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_instante_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_instante_id_seq OWNER TO postgres;

--
-- Name: tbl_instante_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_instante_id_seq OWNED BY tbl_instante.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_cert_certificate_info ALTER COLUMN id SET DEFAULT nextval('adm_cert_certificate_info_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_cert_settings ALTER COLUMN id SET DEFAULT nextval('adm_cert_settings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_chatmessage ALTER COLUMN id SET DEFAULT nextval('adm_chatmessage_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_cts_settings ALTER COLUMN id SET DEFAULT nextval('adm_cts_settings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_dashboardconfig ALTER COLUMN id SET DEFAULT nextval('adm_dashboardconfig_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_holidays ALTER COLUMN id SET DEFAULT nextval('adm_holidays_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_ldap_settings ALTER COLUMN id SET DEFAULT nextval('adm_ldap_settings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_ldap_user_relation ALTER COLUMN id SET DEFAULT nextval('adm_ldap_user_relation_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_profile ALTER COLUMN id SET DEFAULT nextval('adm_profile_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_profile_additional ALTER COLUMN id SET DEFAULT nextval('adm_profile_additional_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_sa_access ALTER COLUMN id SET DEFAULT nextval('adm_sa_access_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_user ALTER COLUMN id SET DEFAULT nextval('adm_user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_user_settings ALTER COLUMN id SET DEFAULT nextval('adm_user_settings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_users_activity ALTER COLUMN id SET DEFAULT nextval('adm_users_activity_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_acces_limitacces ALTER COLUMN id SET DEFAULT nextval('cl_acces_limitacces_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_address ALTER COLUMN id SET DEFAULT nextval('cl_address_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_bank_setings ALTER COLUMN id SET DEFAULT nextval('cl_bank_setings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_contacts_book ALTER COLUMN id SET DEFAULT nextval('cl_contacts_book_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_countries ALTER COLUMN id SET DEFAULT nextval('cl_countries_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_department ALTER COLUMN id SET DEFAULT nextval('cl_department_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_locality ALTER COLUMN id SET DEFAULT nextval('cl_locality_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_locality_type ALTER COLUMN id SET DEFAULT nextval('cl_locality_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_nationality ALTER COLUMN id SET DEFAULT nextval('cl_nationality_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_organisation ALTER COLUMN id SET DEFAULT nextval('cl_organisation_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_post ALTER COLUMN id SET DEFAULT nextval('cl_post_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_region ALTER COLUMN id SET DEFAULT nextval('cl_region_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_region_type ALTER COLUMN id SET DEFAULT nextval('cl_region_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_subsidiary ALTER COLUMN id SET DEFAULT nextval('cl_subsidiary_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_cert_certificate_info ALTER COLUMN id SET DEFAULT nextval('cli_cert_certificate_info_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_chatmessage ALTER COLUMN id SET DEFAULT nextval('cli_chatmessage_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_dashboardconfig ALTER COLUMN id SET DEFAULT nextval('cli_dashboardconfig_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_holidays ALTER COLUMN id SET DEFAULT nextval('cli_holidays_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_owncloud_config ALTER COLUMN id SET DEFAULT nextval('cli_owncloud_config_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_profile ALTER COLUMN id SET DEFAULT nextval('cli_profile_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_profile_additional ALTER COLUMN id SET DEFAULT nextval('cli_profile_additional_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_user ALTER COLUMN id SET DEFAULT nextval('cli_user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_user_settings ALTER COLUMN id SET DEFAULT nextval('cli_user_settings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_users_activity ALTER COLUMN id SET DEFAULT nextval('cli_users_activity_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_base_configs ALTER COLUMN id SET DEFAULT nextval('sys_base_configs_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_dashboard ALTER COLUMN id SET DEFAULT nextval('sys_dashboard_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_dbupdates ALTER COLUMN id SET DEFAULT nextval('sys_dbupdates_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_default_errors ALTER COLUMN id SET DEFAULT nextval('sys_default_errors_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_files_formats ALTER COLUMN id SET DEFAULT nextval('sys_files_formats_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_login_exception ALTER COLUMN id SET DEFAULT nextval('sys_login_exception_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_modules ALTER COLUMN id SET DEFAULT nextval('sys_modules_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_modulesdependence ALTER COLUMN id SET DEFAULT nextval('sys_modulesdependence_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sys_storage ALTER COLUMN id SET DEFAULT nextval('sys_storage_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_instante ALTER COLUMN id SET DEFAULT nextval('tbl_instante_id_seq'::regclass);


--
-- Data for Name: adm_cert_certificate_info; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_cert_certificate_info (id, user_id, country_name, state_or_province_name, locality_name, organization_name, organizational_unit_name, common_name, email_address, passphrase, cert_crt, cert_key, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: adm_cert_certificate_info_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_cert_certificate_info_id_seq', 1, false);


--
-- Data for Name: adm_cert_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_cert_settings (id, certificates_path, key_path, openssl_config_path, digest_alg, private_key_bits, private_key_type, create_user_id, create_datetime, update_user_id, update_datetime, default_id) FROM stdin;
\.


--
-- Name: adm_cert_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_cert_settings_id_seq', 1, false);


--
-- Data for Name: adm_chatmessage; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_chatmessage (id, msg, date, "from", "to", type, readed, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: adm_chatmessage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_chatmessage_id_seq', 1, false);


--
-- Data for Name: adm_cts_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_cts_settings (id, key, certificate, validate_response_key, callback_url, login_url, logout_url, "asserationNS", prefix, issuer, is_default, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	default_saml.key	default_saml.crt	default_testmpass.pem	/User/site/login	https://testmpass.gov.md/login/saml	https://testmpass.gov.md/logout/saml	urn:oasis:names:tc:SAML:2.0:assertion	ONELOGIN	http://ghiseu.justice.gov.md/	1	9223372036854775807	2015-02-20 11:49:49	9223372036854775807	2015-02-25 15:39:38
\.


--
-- Name: adm_cts_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_cts_settings_id_seq', 3, false);


--
-- Data for Name: adm_dashboardconfig; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_dashboardconfig (id, user_id, dashboard_config, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: adm_dashboardconfig_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_dashboardconfig_id_seq', 1, false);


--
-- Data for Name: adm_holidays; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_holidays (id, holiday_date, description, holiday_enable, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: adm_holidays_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_holidays_id_seq', 1, false);


--
-- Data for Name: adm_ldap_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_ldap_settings (id, ldap_host, ldap_port, ldap_dc, ldap_ou, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: adm_ldap_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_ldap_settings_id_seq', 1, false);


--
-- Data for Name: adm_ldap_user_relation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_ldap_user_relation (id, user_id, ldap_setting_id, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: adm_ldap_user_relation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_ldap_user_relation_id_seq', 1, false);


--
-- Data for Name: adm_profile; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_profile (id, user_id, idnp, email, firstname, lastname, patronymic, gender, birthday, about, post_id, department_id, subsidiary_id, locality_id, phone, mobile, avatar, update_datetime) FROM stdin;
1	1	0000000000000	admin@mail.com	Admin	Synapsis	\N	1	1988-11-11	About Admin.	\N	\N	\N	\N	022123456	079132456	\N	\N
9223372036854775807	9223372036854775807	9999999999999	sa@mail.com	System	Administrator	\N	0	2014-11-30	About Super Admin.	\N	\N	\N	\N	\N	\N	\N	\N
\.


--
-- Data for Name: adm_profile_additional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_profile_additional (id, user_id, start_page) FROM stdin;
1	1	
9223372036854775807	9223372036854775807	
\.


--
-- Name: adm_profile_additional_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_profile_additional_id_seq', 2, true);


--
-- Name: adm_profile_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_profile_id_seq', 2, true);


--
-- Data for Name: adm_sa_access; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_sa_access (id, ip) FROM stdin;
1	::1
2	192.168.16.228
\.


--
-- Name: adm_sa_access_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_sa_access_id_seq', 2, false);


--
-- Data for Name: adm_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_user (id, username, password_hash, ad_username, idnp, certificate_path, status_id, sql_user, penalization, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	admin	$2a$13$Aa.TKuJT6dGQnVURENhHfOi94n.O4LeI9jg2ra8aXx91BK/htkCcK		2001001339151	admin.crt	0	0	\N	1	2017-04-05 10:48:15.665614	\N	\N
9223372036854775807	sa	$2a$13$TDRWyKon7TsIisH.B/9/JOzpo5xpTyb1onl57Hcqdu1weCGs9Sche		\N	\N	1	0	\N	1	2017-04-05 10:48:15.665614	\N	\N
\.


--
-- Name: adm_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_user_id_seq', 2, true);


--
-- Data for Name: adm_user_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_user_settings (id, user_id, time_limit, restricted_id, restricted_days, restricted_date, restricted_interval, date_start, start_time, end_time, holiday_enable, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	1	0	0	\N	\N	\N	2010-01-01 00:00:00	08:30:00	17:30:00	0	1	2017-04-05 10:52:22.903655	\N	\N
9223372036854775807	9223372036854775807	0	0	\N	\N	\N	\N	\N	\N	0	1	2017-04-05 10:52:22.906229	\N	\N
\.


--
-- Name: adm_user_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_user_settings_id_seq', 2, true);


--
-- Data for Name: adm_users_activity; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adm_users_activity (id, user_id, last_activity, last_url) FROM stdin;
\.


--
-- Name: adm_users_activity_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adm_users_activity_id_seq', 1, false);


--
-- Data for Name: authassignment; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authassignment (itemname, userid, bizrule, data) FROM stdin;
\.


--
-- Data for Name: authitem; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authitem (name, type, description, bizrule, data) FROM stdin;
Client	1	Client	\N	N;
\.


--
-- Data for Name: authitemchild; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY authitemchild (parent, child) FROM stdin;
\.


--
-- Data for Name: cl_acces_limitacces; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_acces_limitacces (id, name, rule, actions, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_acces_limitacces_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_acces_limitacces_id_seq', 1, false);


--
-- Data for Name: cl_address; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_address (id, country, region, locality, street, postal_code, organisation_id, department_id, subsidiary_id, contact_id, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_address_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_address_id_seq', 1, false);


--
-- Data for Name: cl_bank_setings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_bank_setings (id, state_tax, service_tax, configuration_code_state, bank_fiscal_code_state, bank_account_state, treasury_account_name_state, beneficiary_name_state, treasury_account_state, line_id_state, reason_state, configuration_code_service, bank_fiscal_code_service, bank_account_service, beneficiary_name_servie, treasury_account_name_servie, treasury_account_service, line_id_service, reason_service, organisation_id, department_id, subsidiary_id, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_bank_setings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_bank_setings_id_seq', 1, false);


--
-- Data for Name: cl_contacts_book; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_contacts_book (id, name_surname, idnp, series, email, phone, mobile, organisation_id, department_id, subsidiary_id, address_identity, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_contacts_book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_contacts_book_id_seq', 1, false);


--
-- Data for Name: cl_countries; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_countries (id, name, description, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_countries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_countries_id_seq', 1, false);


--
-- Data for Name: cl_department; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_department (id, name, description, organisation_id, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_department_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_department_id_seq', 1, false);


--
-- Data for Name: cl_locality; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_locality (id, name, description, locality_type_id, region_id, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_locality_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_locality_id_seq', 1, false);


--
-- Data for Name: cl_locality_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_locality_type (id, name, description, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_locality_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_locality_type_id_seq', 1, false);


--
-- Data for Name: cl_nationality; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_nationality (id, name, full_name, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_nationality_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_nationality_id_seq', 1, false);


--
-- Data for Name: cl_organisation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_organisation (id, name, description, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_organisation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_organisation_id_seq', 1, false);


--
-- Data for Name: cl_post; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_post (id, name, description, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_post_id_seq', 1, false);


--
-- Data for Name: cl_region; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_region (id, country_id, name, description, region_type_id, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_region_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_region_id_seq', 1, false);


--
-- Data for Name: cl_region_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_region_type (id, name, description, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_region_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_region_type_id_seq', 1, false);


--
-- Data for Name: cl_subsidiary; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cl_subsidiary (id, name, description, department_id, organisation_id, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cl_subsidiary_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cl_subsidiary_id_seq', 1, false);


--
-- Data for Name: cli_cert_certificate_info; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_cert_certificate_info (id, user_id, country_name, state_or_province_name, locality_name, organization_name, organizational_unit_name, common_name, email_address, passphrase, cert_crt, cert_key, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cli_cert_certificate_info_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_cert_certificate_info_id_seq', 1, false);


--
-- Data for Name: cli_chatmessage; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_chatmessage (id, msg, date, "from", "to", type, readed, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cli_chatmessage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_chatmessage_id_seq', 1, false);


--
-- Data for Name: cli_dashboardconfig; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_dashboardconfig (id, user_id, dashboard_config, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cli_dashboardconfig_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_dashboardconfig_id_seq', 1, false);


--
-- Data for Name: cli_holidays; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_holidays (id, holiday_date, description, holiday_enable, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: cli_holidays_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_holidays_id_seq', 1, false);


--
-- Data for Name: cli_owncloud_config; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_owncloud_config (id, name, url, admin_user, password, create_user_id, create_datetime, update_user_id, update_datetime, default_folder) FROM stdin;
\.


--
-- Name: cli_owncloud_config_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_owncloud_config_id_seq', 1, false);


--
-- Data for Name: cli_profile; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_profile (id, user_id, idnp, email, firstname, lastname, patronymic, gender, birthday, about, post_id, department_id, subsidiary_id, locality_id, phone, mobile, avatar, update_datetime) FROM stdin;
1000000000000	1000000000000	0000000000000	admin@mail.com	Admin	Synapsis	\N	1	1988-11-11	About Admin.	\N	\N	\N	\N	022123456	079132456	\N	\N
\.


--
-- Data for Name: cli_profile_additional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_profile_additional (id, user_id, start_page) FROM stdin;
1000000000000	1000000000000	
\.


--
-- Name: cli_profile_additional_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_profile_additional_id_seq', 1000000000001, true);


--
-- Name: cli_profile_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_profile_id_seq', 1000000000001, true);


--
-- Data for Name: cli_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_user (id, username, password_hash, ad_username, idnp, certificate_path, status_id, confirmation, regle, sql_user, penalization, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1000000000000	admin	$2a$13$Aa.TKuJT6dGQnVURENhHfOi94n.O4LeI9jg2ra8aXx91BK/htkCcK		0000000000000	admin.crt	0	0	0	0	\N	1	2017-04-05 10:48:15.920686	\N	\N
\.


--
-- Name: cli_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_user_id_seq', 1000000000001, true);


--
-- Data for Name: cli_user_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_user_settings (id, user_id, time_limit, restricted_id, restricted_days, restricted_date, restricted_interval, date_start, start_time, end_time, holiday_enable, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1000000000000	1000000000000	0	0	\N	\N	\N	2010-01-01 00:00:00	08:30:00	17:30:00	0	1	2017-04-05 10:52:23.122831	\N	\N
\.


--
-- Name: cli_user_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_user_settings_id_seq', 1000000000001, true);


--
-- Data for Name: cli_users_activity; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cli_users_activity (id, user_id, last_activity, last_url) FROM stdin;
\.


--
-- Name: cli_users_activity_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cli_users_activity_id_seq', 1, false);


--
-- Data for Name: sys_base_configs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_base_configs (id, config_label, config_value, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	SYSTEM MAIL	yiiteste@gmail.com	1	2017-04-05 10:52:23.73659	\N	\N
2	SYSTEM NAME 	Synapsis	1	2017-04-05 10:52:23.739266	\N	\N
3	SYSTEM MAIL HOST	smtp.gmail.com	1	2017-04-05 10:52:23.741002	\N	\N
4	SYSTEM MAIL PORT	587	1	2017-04-05 10:52:23.74268	\N	\N
5	SYSTEM MAIL SECURE TLS	tls	1	2017-04-05 10:52:23.744396	\N	\N
6	SYSTEM MAIL PASSWORD	YIIteste1	1	2017-04-05 10:52:23.746152	\N	\N
\.


--
-- Name: sys_base_configs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_base_configs_id_seq', 1, false);


--
-- Data for Name: sys_dashboard; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_dashboard (id, name, is_folder, view_name, color, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	Calendar Personal	0	calendar	grape	1	2017-04-05 10:52:23.627637	\N	\N
2	Lista sarcini	0	tasks	inverse	1	2017-04-05 10:52:23.62961	\N	\N
3	Notificari	0	notifications	info	1	2017-04-05 10:52:23.631355	\N	\N
4	Folder	1	folder	success	1	2017-04-05 10:52:23.633096	\N	\N
5	Reports	1	reports	success	1	2017-04-05 10:52:23.634854	\N	\N
\.


--
-- Name: sys_dashboard_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_dashboard_id_seq', 6, true);


--
-- Data for Name: sys_dbupdates; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_dbupdates (id, filename, executed, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
\.


--
-- Name: sys_dbupdates_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_dbupdates_id_seq', 1, false);


--
-- Data for Name: sys_default_errors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_default_errors (id, code, type, error_code, message, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	500	CDbException	42	Eroare de executie a codului SQL	1	2017-04-05 10:52:23.674502	\N	\N
2	500	PHP warning	001	Ati accesat o adresa URL nevalida	1	2017-04-05 10:52:23.676569	\N	\N
\.


--
-- Name: sys_default_errors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_default_errors_id_seq', 3, true);


--
-- Data for Name: sys_files_formats; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_files_formats (id, title, extension, content_type, icon, status, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	PDF	pdf	application/pdf	icons/objects/pdf.png	1	1	2013-03-04 14:02:00	\N	\N
2	GIF	gif	image/gif	icons/objects/image.png	1	1	2013-03-04 14:02:00	\N	\N
3	SQL	sql	text/plain	icons/objects/document.png	1	1	2013-03-04 14:02:00	\N	\N
4	JPEG	jpeg	image/jpeg	icons/objects/image.png	1	1	2013-03-04 14:02:00	\N	\N
5	JPG	jpg	image/jpeg	icons/objects/image.png	1	1	2013-03-04 14:02:00	\N	\N
6	PNG	png	image/png	icons/objects/image.png	1	1	2013-03-04 14:02:00	\N	\N
7	TIFF	tiff	image/tiff	icons/objects/image.png	1	1	2013-03-04 14:02:00	\N	\N
8	DOCX	docx	application/vnd.openxmlformats-officedocument.wordprocessingml.document	icons/objects/document.png	1	1	2013-03-04 14:02:00	1	2013-03-21 10:22:10
9	CRT	crt	text/plain	icons/objects/pdf.png	1	1	2013-04-25 10:29:19	\N	\N
10	xades	xades	text/html	icons/objects/pdf.png	1	1	2013-11-19 00:00:00	\N	\N
\.


--
-- Name: sys_files_formats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_files_formats_id_seq', 10, true);


--
-- Data for Name: sys_login_exception; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_login_exception (id, title, action, type, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	Site login	site/login	1	1	2017-04-05 10:52:23.590115	\N	\N
2	Site Test	site/test	1	1	2017-04-05 10:52:23.592139	\N	\N
3	User Site Login	User/site/login	1	1	2017-04-05 10:52:23.593965	\N	\N
4	WebService Cmis Service	WebService/cmis/service	1	1	2017-04-05 10:52:23.595766	\N	\N
5	Site Index	site/index	1	1	2017-04-05 10:52:23.597554	\N	\N
6	Site Search Registers	site/searchRegisters	1	1	2017-04-05 10:52:23.599373	\N	\N
7	User Site Recovery Password	User/site/recoveryPassword	1	1	2017-04-05 10:52:23.601239	\N	\N
8	Site Logout	site/logout	1	1	2017-04-05 10:52:23.602974	\N	\N
9	Registration	Registration/index	1	1	2017-04-05 10:52:23.604787	\N	\N
10	Registration	Registration/index	2	1	2017-04-05 10:52:23.606702	\N	\N
11	Registration	Registration/captcha	2	1	2017-04-05 10:52:23.60849	\N	\N
12	User/site/loginAjax	User/site/loginAjax	2	1	2017-04-05 10:52:23.610304	\N	\N
\.


--
-- Name: sys_login_exception_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_login_exception_id_seq', 13, true);


--
-- Data for Name: sys_modules; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_modules (id, name, activ, dump_restore, parent_id, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
1	Clasificator	1	0	0	1	2017-04-05 10:52:23.327432	\N	\N
\.


--
-- Name: sys_modules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_modules_id_seq', 2, false);


--
-- Data for Name: sys_modulesdependence; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_modulesdependence (id, module_parent, module_children) FROM stdin;
\.


--
-- Name: sys_modulesdependence_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_modulesdependence_id_seq', 1, false);


--
-- Data for Name: sys_storage; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sys_storage (id, name, path, create_user_id, create_datetime, update_user_id, update_datetime) FROM stdin;
0	Temp	./storage/Temp/	1	2017-04-05 10:52:23.708377	\N	\N
1	Operativa	./storage/Operativa/	1	2017-04-05 10:52:23.710344	\N	\N
2	appStorage	./storage/appStorage/	1	2017-04-05 10:52:23.712078	\N	\N
4	Avatars	./storage/Avatars	1	2017-04-05 10:52:23.713882	\N	\N
11	Templates	./storage/Templates/	1	2017-04-05 10:52:23.71557	\N	\N
\.


--
-- Name: sys_storage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sys_storage_id_seq', 12, true);


--
-- Data for Name: tbl_instante; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_instante (id, name, dataexec, stare, erori) FROM stdin;
\.


--
-- Name: tbl_instante_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_instante_id_seq', 1, false);


--
-- Name: adm_cert_certificate_info_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_cert_certificate_info
    ADD CONSTRAINT adm_cert_certificate_info_pkey PRIMARY KEY (id);


--
-- Name: adm_cert_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_cert_settings
    ADD CONSTRAINT adm_cert_settings_pkey PRIMARY KEY (id);


--
-- Name: adm_chatmessage_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_chatmessage
    ADD CONSTRAINT adm_chatmessage_pkey PRIMARY KEY (id);


--
-- Name: adm_cts_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_cts_settings
    ADD CONSTRAINT adm_cts_settings_pkey PRIMARY KEY (id);


--
-- Name: adm_dashboardconfig_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_dashboardconfig
    ADD CONSTRAINT adm_dashboardconfig_pkey PRIMARY KEY (id);


--
-- Name: adm_holidays_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_holidays
    ADD CONSTRAINT adm_holidays_pkey PRIMARY KEY (id);


--
-- Name: adm_ldap_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_ldap_settings
    ADD CONSTRAINT adm_ldap_settings_pkey PRIMARY KEY (id);


--
-- Name: adm_ldap_user_relation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_ldap_user_relation
    ADD CONSTRAINT adm_ldap_user_relation_pkey PRIMARY KEY (id);


--
-- Name: adm_profile_additional_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_profile_additional
    ADD CONSTRAINT adm_profile_additional_pkey PRIMARY KEY (id);


--
-- Name: adm_profile_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_profile
    ADD CONSTRAINT adm_profile_pkey PRIMARY KEY (id);


--
-- Name: adm_sa_access_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_sa_access
    ADD CONSTRAINT adm_sa_access_pkey PRIMARY KEY (id);


--
-- Name: adm_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_user
    ADD CONSTRAINT adm_user_pkey PRIMARY KEY (id);


--
-- Name: adm_user_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_user_settings
    ADD CONSTRAINT adm_user_settings_pkey PRIMARY KEY (id);


--
-- Name: adm_user_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_user
    ADD CONSTRAINT adm_user_username_key UNIQUE (username);


--
-- Name: adm_users_activity_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adm_users_activity
    ADD CONSTRAINT adm_users_activity_pkey PRIMARY KEY (id);


--
-- Name: authassignment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authassignment
    ADD CONSTRAINT authassignment_pkey PRIMARY KEY (itemname, userid);


--
-- Name: authitem_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authitem
    ADD CONSTRAINT authitem_pkey PRIMARY KEY (name);


--
-- Name: authitemchild_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY authitemchild
    ADD CONSTRAINT authitemchild_pkey PRIMARY KEY (parent, child);


--
-- Name: cl_acces_limitacces_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_acces_limitacces
    ADD CONSTRAINT cl_acces_limitacces_pkey PRIMARY KEY (id);


--
-- Name: cl_address_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_address
    ADD CONSTRAINT cl_address_pkey PRIMARY KEY (id);


--
-- Name: cl_bank_setings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_bank_setings
    ADD CONSTRAINT cl_bank_setings_pkey PRIMARY KEY (id);


--
-- Name: cl_contacts_book_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_contacts_book
    ADD CONSTRAINT cl_contacts_book_pkey PRIMARY KEY (id);


--
-- Name: cl_countries_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_countries
    ADD CONSTRAINT cl_countries_pkey PRIMARY KEY (id);


--
-- Name: cl_department_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_department
    ADD CONSTRAINT cl_department_pkey PRIMARY KEY (id);


--
-- Name: cl_locality_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_locality
    ADD CONSTRAINT cl_locality_pkey PRIMARY KEY (id);


--
-- Name: cl_locality_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_locality_type
    ADD CONSTRAINT cl_locality_type_pkey PRIMARY KEY (id);


--
-- Name: cl_nationality_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_nationality
    ADD CONSTRAINT cl_nationality_pkey PRIMARY KEY (id);


--
-- Name: cl_organisation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_organisation
    ADD CONSTRAINT cl_organisation_pkey PRIMARY KEY (id);


--
-- Name: cl_post_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_post
    ADD CONSTRAINT cl_post_pkey PRIMARY KEY (id);


--
-- Name: cl_region_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_region
    ADD CONSTRAINT cl_region_pkey PRIMARY KEY (id);


--
-- Name: cl_region_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_region_type
    ADD CONSTRAINT cl_region_type_pkey PRIMARY KEY (id);


--
-- Name: cl_subsidiary_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cl_subsidiary
    ADD CONSTRAINT cl_subsidiary_pkey PRIMARY KEY (id);


--
-- Name: cli_cert_certificate_info_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_cert_certificate_info
    ADD CONSTRAINT cli_cert_certificate_info_pkey PRIMARY KEY (id);


--
-- Name: cli_chatmessage_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_chatmessage
    ADD CONSTRAINT cli_chatmessage_pkey PRIMARY KEY (id);


--
-- Name: cli_dashboardconfig_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_dashboardconfig
    ADD CONSTRAINT cli_dashboardconfig_pkey PRIMARY KEY (id);


--
-- Name: cli_holidays_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_holidays
    ADD CONSTRAINT cli_holidays_pkey PRIMARY KEY (id);


--
-- Name: cli_owncloud_config_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_owncloud_config
    ADD CONSTRAINT cli_owncloud_config_pkey PRIMARY KEY (id);


--
-- Name: cli_profile_additional_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_profile_additional
    ADD CONSTRAINT cli_profile_additional_pkey PRIMARY KEY (id);


--
-- Name: cli_profile_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_profile
    ADD CONSTRAINT cli_profile_pkey PRIMARY KEY (id);


--
-- Name: cli_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_user
    ADD CONSTRAINT cli_user_pkey PRIMARY KEY (id);


--
-- Name: cli_user_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_user_settings
    ADD CONSTRAINT cli_user_settings_pkey PRIMARY KEY (id);


--
-- Name: cli_user_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_user
    ADD CONSTRAINT cli_user_username_key UNIQUE (username);


--
-- Name: cli_users_activity_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cli_users_activity
    ADD CONSTRAINT cli_users_activity_pkey PRIMARY KEY (id);


--
-- Name: sys_base_configs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_base_configs
    ADD CONSTRAINT sys_base_configs_pkey PRIMARY KEY (id);


--
-- Name: sys_dashboard_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_dashboard
    ADD CONSTRAINT sys_dashboard_pkey PRIMARY KEY (id);


--
-- Name: sys_dbupdates_filename_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_dbupdates
    ADD CONSTRAINT sys_dbupdates_filename_key UNIQUE (filename);


--
-- Name: sys_dbupdates_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_dbupdates
    ADD CONSTRAINT sys_dbupdates_pkey PRIMARY KEY (id);


--
-- Name: sys_default_errors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_default_errors
    ADD CONSTRAINT sys_default_errors_pkey PRIMARY KEY (id);


--
-- Name: sys_files_formats_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_files_formats
    ADD CONSTRAINT sys_files_formats_pkey PRIMARY KEY (id);


--
-- Name: sys_login_exception_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_login_exception
    ADD CONSTRAINT sys_login_exception_pkey PRIMARY KEY (id);


--
-- Name: sys_modules_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_modules
    ADD CONSTRAINT sys_modules_pkey PRIMARY KEY (id);


--
-- Name: sys_modulesdependence_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_modulesdependence
    ADD CONSTRAINT sys_modulesdependence_pkey PRIMARY KEY (id);


--
-- Name: sys_storage_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sys_storage
    ADD CONSTRAINT sys_storage_pkey PRIMARY KEY (id);


--
-- Name: tbl_instante_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_instante
    ADD CONSTRAINT tbl_instante_pkey PRIMARY KEY (id);


--
-- Name: adm_cert_certificate_info_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_cert_certificate_info
    ADD CONSTRAINT adm_cert_certificate_info_user_id_fkey FOREIGN KEY (user_id) REFERENCES adm_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: adm_dashboardconfig_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_dashboardconfig
    ADD CONSTRAINT adm_dashboardconfig_user_id_fkey FOREIGN KEY (user_id) REFERENCES adm_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: adm_ldap_user_relation_ldap_setting_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_ldap_user_relation
    ADD CONSTRAINT adm_ldap_user_relation_ldap_setting_id_fkey FOREIGN KEY (ldap_setting_id) REFERENCES adm_ldap_settings(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: adm_ldap_user_relation_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_ldap_user_relation
    ADD CONSTRAINT adm_ldap_user_relation_user_id_fkey FOREIGN KEY (user_id) REFERENCES adm_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: adm_profile_additional_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_profile_additional
    ADD CONSTRAINT adm_profile_additional_user_id_fkey FOREIGN KEY (user_id) REFERENCES adm_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: adm_profile_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_profile
    ADD CONSTRAINT adm_profile_user_id_fkey FOREIGN KEY (user_id) REFERENCES adm_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: adm_user_settings_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_user_settings
    ADD CONSTRAINT adm_user_settings_user_id_fkey FOREIGN KEY (user_id) REFERENCES adm_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: adm_users_activity_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adm_users_activity
    ADD CONSTRAINT adm_users_activity_user_id_fkey FOREIGN KEY (user_id) REFERENCES adm_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: authassignment_itemname_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authassignment
    ADD CONSTRAINT authassignment_itemname_fkey FOREIGN KEY (itemname) REFERENCES authitem(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: authitemchild_child_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authitemchild
    ADD CONSTRAINT authitemchild_child_fkey FOREIGN KEY (child) REFERENCES authitem(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: authitemchild_parent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY authitemchild
    ADD CONSTRAINT authitemchild_parent_fkey FOREIGN KEY (parent) REFERENCES authitem(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_address_country_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_address
    ADD CONSTRAINT cl_address_country_fkey FOREIGN KEY (country) REFERENCES cl_countries(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_address_department_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_address
    ADD CONSTRAINT cl_address_department_id_fkey FOREIGN KEY (department_id) REFERENCES cl_department(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_address_locality_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_address
    ADD CONSTRAINT cl_address_locality_fkey FOREIGN KEY (locality) REFERENCES cl_locality(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_address_organisation_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_address
    ADD CONSTRAINT cl_address_organisation_id_fkey FOREIGN KEY (organisation_id) REFERENCES cl_organisation(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_address_region_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_address
    ADD CONSTRAINT cl_address_region_fkey FOREIGN KEY (region) REFERENCES cl_region(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_address_subsidiary_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_address
    ADD CONSTRAINT cl_address_subsidiary_id_fkey FOREIGN KEY (subsidiary_id) REFERENCES cl_subsidiary(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_bank_setings_department_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_bank_setings
    ADD CONSTRAINT cl_bank_setings_department_id_fkey FOREIGN KEY (department_id) REFERENCES cl_department(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_bank_setings_organisation_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_bank_setings
    ADD CONSTRAINT cl_bank_setings_organisation_id_fkey FOREIGN KEY (organisation_id) REFERENCES cl_organisation(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_bank_setings_subsidiary_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_bank_setings
    ADD CONSTRAINT cl_bank_setings_subsidiary_id_fkey FOREIGN KEY (subsidiary_id) REFERENCES cl_subsidiary(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_contacts_book_department_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_contacts_book
    ADD CONSTRAINT cl_contacts_book_department_id_fkey FOREIGN KEY (department_id) REFERENCES cl_department(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_contacts_book_organisation_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_contacts_book
    ADD CONSTRAINT cl_contacts_book_organisation_id_fkey FOREIGN KEY (organisation_id) REFERENCES cl_organisation(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_contacts_book_subsidiary_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_contacts_book
    ADD CONSTRAINT cl_contacts_book_subsidiary_id_fkey FOREIGN KEY (subsidiary_id) REFERENCES cl_subsidiary(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_department_organisation_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_department
    ADD CONSTRAINT cl_department_organisation_id_fkey FOREIGN KEY (organisation_id) REFERENCES cl_organisation(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_locality_locality_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_locality
    ADD CONSTRAINT cl_locality_locality_type_id_fkey FOREIGN KEY (locality_type_id) REFERENCES cl_locality_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_locality_region_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_locality
    ADD CONSTRAINT cl_locality_region_id_fkey FOREIGN KEY (region_id) REFERENCES cl_region(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_region_region_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_region
    ADD CONSTRAINT cl_region_region_type_id_fkey FOREIGN KEY (region_type_id) REFERENCES cl_region_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cl_subsidiary_department_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cl_subsidiary
    ADD CONSTRAINT cl_subsidiary_department_id_fkey FOREIGN KEY (department_id) REFERENCES cl_department(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cli_cert_certificate_info_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_cert_certificate_info
    ADD CONSTRAINT cli_cert_certificate_info_user_id_fkey FOREIGN KEY (user_id) REFERENCES cli_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cli_dashboardconfig_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_dashboardconfig
    ADD CONSTRAINT cli_dashboardconfig_user_id_fkey FOREIGN KEY (user_id) REFERENCES cli_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cli_profile_additional_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_profile_additional
    ADD CONSTRAINT cli_profile_additional_user_id_fkey FOREIGN KEY (user_id) REFERENCES cli_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cli_profile_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_profile
    ADD CONSTRAINT cli_profile_user_id_fkey FOREIGN KEY (user_id) REFERENCES cli_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cli_user_settings_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_user_settings
    ADD CONSTRAINT cli_user_settings_user_id_fkey FOREIGN KEY (user_id) REFERENCES cli_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cli_users_activity_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cli_users_activity
    ADD CONSTRAINT cli_users_activity_user_id_fkey FOREIGN KEY (user_id) REFERENCES cli_user(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

