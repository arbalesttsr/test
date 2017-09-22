/*function for users */

CREATE FUNCTION create_user(p_login text, p_password text) RETURNS boolean
    LANGUAGE plpgsql SECURITY DEFINER
    AS $$
DECLARE
    schemas CURSOR FOR select schema_name from information_schema.schemata where schema_name <> 'information_schema' and schema_name = '^pg_';
    v_login TEXT := quote_ident( p_login );
    v_old TEXT;
BEGIN
    SELECT rolname INTO v_old FROM pg_roles where rolname = v_login;
    IF NOT FOUND THEN
	EXECUTE 'CREATE USER ' || v_login || ' WITH PASSWORD ' || quote_literal( p_password );
	FOR schima IN schemas LOOP
		EXECUTE 'GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA ' || schima.schema_name || ' TO ' || v_login;
		EXECUTE 'GRANT USAGE ON SCHEMA ' || schima.schema_name || ' TO ' || v_login;
		EXECUTE 'GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA ' || schima.schema_name || ' TO ' || v_login;
	END LOOP;		                                                 
        RETURN true;                                               
    END IF;                                                        
    RETURN false; 
END;
$$;


ALTER FUNCTION public.create_user(p_login text, p_password text) OWNER TO public_root;


CREATE FUNCTION delete_user(p_login text) RETURNS boolean
    LANGUAGE plpgsql SECURITY DEFINER
    AS $$
DECLARE
schemas CURSOR FOR select schema_name from information_schema.schemata where schema_name <> 'information_schema' and schema_name = '^pg_';
v_login TEXT := quote_ident( p_login );
v_old TEXT;
BEGIN
SELECT rolname INTO v_old FROM pg_roles where rolname = v_login;
IF FOUND THEN
FOR schima IN schemas LOOP
EXECUTE 'REVOKE USAGE ON SCHEMA ' || schima.schema_name || ' FROM ' || v_login;
EXECUTE 'REVOKE SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA ' || schima.schema_name || ' FROM ' || v_login;
EXECUTE 'REVOKE ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA ' || schima.schema_name || ' FROM ' || v_login;
END LOOP;	
EXECUTE 'DROP USER ' || v_login;	
RETURN true; 
END IF; 
RETURN false;
END;
$$;


ALTER FUNCTION public.delete_user(p_login text) OWNER TO public_root;


CREATE FUNCTION update_user(p_login text, new_password text) RETURNS boolean
    LANGUAGE plpgsql SECURITY DEFINER
    AS $$
DECLARE
v_login TEXT := quote_ident( p_login );
v_old TEXT;
BEGIN
SELECT rolname INTO v_old FROM pg_roles where rolname = v_login;
IF FOUND THEN
EXECUTE 'ALTER USER ' || v_login || ' WITH PASSWORD ' || quote_literal(new_password);	
RETURN true; 
END IF; 
RETURN false;
END;
$$;


ALTER FUNCTION public.update_user(p_login text, new_password text) OWNER TO public_root;