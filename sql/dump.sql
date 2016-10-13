--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.usuarios_datos DROP CONSTRAINT usuarios_datos_perfil_id_fkey;
ALTER TABLE ONLY public.mantenimientos_equipos DROP CONSTRAINT mantenimientos_equipos_ubicacion_id_fkey;
ALTER TABLE ONLY public.mantenimientos_equipos DROP CONSTRAINT mantenimientos_equipos_gerencia_id_fkey;
ALTER TABLE ONLY public.mantenimientos_equipos DROP CONSTRAINT mantenimientos_equipos_empresa_id_fkey;
ALTER TABLE ONLY public.mantenimientos_checklist DROP CONSTRAINT mantenimientos_checklist_equipo_id_fkey;
ALTER TABLE ONLY public.mantenimientos_checklist DROP CONSTRAINT mantenimientos_checklist_actividad_id_fkey;
ALTER TABLE ONLY public.mantenimientos_actividades DROP CONSTRAINT mantenimientos_actividades_so_id_fkey;
ALTER TABLE ONLY public.usuarios_perfiles DROP CONSTRAINT usuarios_perfiles_pkey;
ALTER TABLE ONLY public.usuarios_perfiles DROP CONSTRAINT usuarios_perfiles_perfil_nombre_key;
ALTER TABLE ONLY public.usuarios_datos DROP CONSTRAINT usuarios_datos_usuario_indicador_key;
ALTER TABLE ONLY public.usuarios_datos DROP CONSTRAINT usuarios_datos_pkey;
ALTER TABLE ONLY public.mantenimientos_ubicaciones DROP CONSTRAINT ubucaciones_pkey;
ALTER TABLE ONLY public.mantenimientos_ubicaciones DROP CONSTRAINT ubucaciones_nombre_key;
ALTER TABLE ONLY public.mantenimientos_gerencias DROP CONSTRAINT pk_gerencias;
ALTER TABLE ONLY public.mantenimientos_equipos DROP CONSTRAINT mantenimientos_equipos_pkey;
ALTER TABLE ONLY public.mantenimientos_equipos DROP CONSTRAINT mantenimientos_equipos_equipo_nombre_key;
ALTER TABLE ONLY public.mantenimientos_checklist DROP CONSTRAINT mantenimientos_checklist_pkey;
ALTER TABLE ONLY public.mantenimientos_actividades DROP CONSTRAINT mantenimientos_actividades_pkey;
ALTER TABLE ONLY public.mantenimientos_gerencias DROP CONSTRAINT gerencias_nombre_key;
ALTER TABLE ONLY public.mantenimientos_empresas DROP CONSTRAINT empresas_pkey;
ALTER TABLE ONLY public.mantenimientos_empresas DROP CONSTRAINT empresas_nombre_key;
ALTER TABLE ONLY public.mantenimientos_sos DROP CONSTRAINT "Sistemas_operativos_pkey";
ALTER TABLE public.usuarios_perfiles ALTER COLUMN perfil_id DROP DEFAULT;
ALTER TABLE public.usuarios_datos ALTER COLUMN usuario_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_ubicaciones ALTER COLUMN ubicacion_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_sos ALTER COLUMN so_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_gerencias ALTER COLUMN gerencia_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_equipos ALTER COLUMN ubicacion_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_equipos ALTER COLUMN gerencia_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_equipos ALTER COLUMN empresa_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_equipos ALTER COLUMN equipo_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_empresas ALTER COLUMN empresa_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_checklist ALTER COLUMN actividad_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_checklist ALTER COLUMN equipo_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_checklist ALTER COLUMN checklist_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_actividades ALTER COLUMN so_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_actividades ALTER COLUMN actividad_id DROP DEFAULT;
DROP VIEW public.vista_usuarios_perfiles;
DROP SEQUENCE public.usuarios_perfiles_id_seq;
DROP TABLE public.usuarios_perfiles;
DROP SEQUENCE public.usuarios_datos_id_seq;
DROP TABLE public.usuarios_datos;
DROP SEQUENCE public.ubucaciones_id_seq;
DROP TABLE public.mantenimientos_ubicaciones;
DROP SEQUENCE public.mantenimientos_equipos_ubicacion_id_seq;
DROP SEQUENCE public.mantenimientos_equipos_gerencia_id_seq;
DROP SEQUENCE public.mantenimientos_equipos_equipo_id_seq;
DROP SEQUENCE public.mantenimientos_equipos_empresa_id_seq;
DROP TABLE public.mantenimientos_equipos;
DROP SEQUENCE public.mantenimientos_checklist_equipo_id_seq;
DROP SEQUENCE public.mantenimientos_checklist_checklist_id_seq;
DROP SEQUENCE public.mantenimientos_checklist_actividad_id_seq;
DROP TABLE public.mantenimientos_checklist;
DROP SEQUENCE public.mantenimientos_actividades_so_id_seq;
DROP SEQUENCE public.mantenimientos_actividades_actividad_id_seq;
DROP TABLE public.mantenimientos_actividades;
DROP SEQUENCE public.gerencias_id_seq;
DROP TABLE public.mantenimientos_gerencias;
DROP SEQUENCE public.empresas_id_seq;
DROP TABLE public.mantenimientos_empresas;
DROP SEQUENCE public."Sistemas_operativos_so_id_seq";
DROP TABLE public.mantenimientos_sos;
DROP DOMAIN public.observacion;
DROP DOMAIN public.nombre_largo;
DROP DOMAIN public.nombre_corto;
DROP EXTENSION adminpack;
DROP EXTENSION plpgsql;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: mantenimiento
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO mantenimiento;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: mantenimiento
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET search_path = public, pg_catalog;

--
-- Name: nombre_corto; Type: DOMAIN; Schema: public; Owner: mantenimiento
--

CREATE DOMAIN nombre_corto AS character varying(20);


ALTER DOMAIN nombre_corto OWNER TO mantenimiento;

--
-- Name: DOMAIN nombre_corto; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON DOMAIN nombre_corto IS 'Nombre usado para campos tipo string de hasta 20 de longitud';


--
-- Name: nombre_largo; Type: DOMAIN; Schema: public; Owner: mantenimiento
--

CREATE DOMAIN nombre_largo AS character varying(50);


ALTER DOMAIN nombre_largo OWNER TO mantenimiento;

--
-- Name: observacion; Type: DOMAIN; Schema: public; Owner: mantenimiento
--

CREATE DOMAIN observacion AS character varying(200);


ALTER DOMAIN observacion OWNER TO mantenimiento;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: mantenimientos_sos; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE mantenimientos_sos (
    so_id integer NOT NULL,
    so_nombre nombre_corto NOT NULL
);


ALTER TABLE mantenimientos_sos OWNER TO mantenimiento;

--
-- Name: TABLE mantenimientos_sos; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE mantenimientos_sos IS 'Tabla catalogo de los sistemas operativos';


--
-- Name: Sistemas_operativos_so_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE "Sistemas_operativos_so_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Sistemas_operativos_so_id_seq" OWNER TO mantenimiento;

--
-- Name: Sistemas_operativos_so_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE "Sistemas_operativos_so_id_seq" OWNED BY mantenimientos_sos.so_id;


--
-- Name: mantenimientos_empresas; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE mantenimientos_empresas (
    empresa_id integer NOT NULL,
    empresa_nombre nombre_corto NOT NULL,
    empresa_observacion observacion
);


ALTER TABLE mantenimientos_empresas OWNER TO mantenimiento;

--
-- Name: TABLE mantenimientos_empresas; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE mantenimientos_empresas IS 'Catálogo de las empresas';


--
-- Name: empresas_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE empresas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE empresas_id_seq OWNER TO mantenimiento;

--
-- Name: empresas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE empresas_id_seq OWNED BY mantenimientos_empresas.empresa_id;


--
-- Name: mantenimientos_gerencias; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE mantenimientos_gerencias (
    gerencia_id integer NOT NULL,
    gerencia_nombre nombre_corto NOT NULL,
    gerencia_observacion observacion
);


ALTER TABLE mantenimientos_gerencias OWNER TO mantenimiento;

--
-- Name: TABLE mantenimientos_gerencias; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE mantenimientos_gerencias IS 'Catálogo de las  gerencias';


--
-- Name: gerencias_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE gerencias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE gerencias_id_seq OWNER TO mantenimiento;

--
-- Name: gerencias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE gerencias_id_seq OWNED BY mantenimientos_gerencias.gerencia_id;


--
-- Name: mantenimientos_actividades; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE mantenimientos_actividades (
    actividad_id integer NOT NULL,
    actividad_nombre nombre_corto NOT NULL,
    so_id integer NOT NULL
);


ALTER TABLE mantenimientos_actividades OWNER TO mantenimiento;

--
-- Name: TABLE mantenimientos_actividades; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE mantenimientos_actividades IS 'Tabla catálogo de las actividades de mantenimientos';


--
-- Name: mantenimientos_actividades_actividad_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_actividades_actividad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_actividades_actividad_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_actividades_actividad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_actividades_actividad_id_seq OWNED BY mantenimientos_actividades.actividad_id;


--
-- Name: mantenimientos_actividades_so_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_actividades_so_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_actividades_so_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_actividades_so_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_actividades_so_id_seq OWNED BY mantenimientos_actividades.so_id;


--
-- Name: mantenimientos_checklist; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE mantenimientos_checklist (
    checklist_id integer NOT NULL,
    equipo_id integer NOT NULL,
    actividad_id integer NOT NULL,
    checklist_status boolean
);


ALTER TABLE mantenimientos_checklist OWNER TO mantenimiento;

--
-- Name: TABLE mantenimientos_checklist; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE mantenimientos_checklist IS 'Registro de los mantenimientos';


--
-- Name: mantenimientos_checklist_actividad_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_checklist_actividad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_checklist_actividad_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_checklist_actividad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_checklist_actividad_id_seq OWNED BY mantenimientos_checklist.actividad_id;


--
-- Name: mantenimientos_checklist_checklist_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_checklist_checklist_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_checklist_checklist_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_checklist_checklist_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_checklist_checklist_id_seq OWNED BY mantenimientos_checklist.checklist_id;


--
-- Name: mantenimientos_checklist_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_checklist_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_checklist_equipo_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_checklist_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_checklist_equipo_id_seq OWNED BY mantenimientos_checklist.equipo_id;


--
-- Name: mantenimientos_equipos; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE mantenimientos_equipos (
    equipo_id integer NOT NULL,
    equipo_usuario_nombre nombre_largo,
    equipo_usuario_indicador nombre_corto,
    empresa_id integer NOT NULL,
    gerencia_id integer NOT NULL,
    equipo_nombre nombre_corto NOT NULL,
    equipo_etiqueta nombre_corto,
    ubicacion_id integer NOT NULL,
    equipo_observacion observacion
);


ALTER TABLE mantenimientos_equipos OWNER TO mantenimiento;

--
-- Name: TABLE mantenimientos_equipos; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE mantenimientos_equipos IS 'Tabla de equipos';


--
-- Name: mantenimientos_equipos_empresa_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_equipos_empresa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_equipos_empresa_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_equipos_empresa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_equipos_empresa_id_seq OWNED BY mantenimientos_equipos.empresa_id;


--
-- Name: mantenimientos_equipos_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_equipos_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_equipos_equipo_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_equipos_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_equipos_equipo_id_seq OWNED BY mantenimientos_equipos.equipo_id;


--
-- Name: mantenimientos_equipos_gerencia_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_equipos_gerencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_equipos_gerencia_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_equipos_gerencia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_equipos_gerencia_id_seq OWNED BY mantenimientos_equipos.gerencia_id;


--
-- Name: mantenimientos_equipos_ubicacion_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE mantenimientos_equipos_ubicacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mantenimientos_equipos_ubicacion_id_seq OWNER TO mantenimiento;

--
-- Name: mantenimientos_equipos_ubicacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE mantenimientos_equipos_ubicacion_id_seq OWNED BY mantenimientos_equipos.ubicacion_id;


--
-- Name: mantenimientos_ubicaciones; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE mantenimientos_ubicaciones (
    ubicacion_id integer NOT NULL,
    ubicacion_nombre nombre_corto NOT NULL,
    ubicacion_observacion observacion
);


ALTER TABLE mantenimientos_ubicaciones OWNER TO mantenimiento;

--
-- Name: TABLE mantenimientos_ubicaciones; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE mantenimientos_ubicaciones IS 'Catálogo de las ubicaciones';


--
-- Name: ubucaciones_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE ubucaciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ubucaciones_id_seq OWNER TO mantenimiento;

--
-- Name: ubucaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE ubucaciones_id_seq OWNED BY mantenimientos_ubicaciones.ubicacion_id;


--
-- Name: usuarios_datos; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE usuarios_datos (
    usuario_nombre nombre_largo NOT NULL,
    usuario_indicador nombre_corto NOT NULL,
    usuario_clave nombre_largo NOT NULL,
    usuario_observacion observacion,
    usuario_id integer NOT NULL,
    perfil_id integer NOT NULL
);


ALTER TABLE usuarios_datos OWNER TO mantenimiento;

--
-- Name: TABLE usuarios_datos; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE usuarios_datos IS 'Tabla de datos de los usuarios';


--
-- Name: usuarios_datos_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE usuarios_datos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuarios_datos_id_seq OWNER TO mantenimiento;

--
-- Name: usuarios_datos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE usuarios_datos_id_seq OWNED BY usuarios_datos.usuario_id;


--
-- Name: usuarios_perfiles; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE usuarios_perfiles (
    perfil_id integer NOT NULL,
    perfil_nombre nombre_corto NOT NULL,
    perfil_observacion observacion
);


ALTER TABLE usuarios_perfiles OWNER TO mantenimiento;

--
-- Name: TABLE usuarios_perfiles; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE usuarios_perfiles IS 'Tabla de perfiles de usuarios';


--
-- Name: usuarios_perfiles_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE usuarios_perfiles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuarios_perfiles_id_seq OWNER TO mantenimiento;

--
-- Name: usuarios_perfiles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE usuarios_perfiles_id_seq OWNED BY usuarios_perfiles.perfil_id;


--
-- Name: vista_usuarios_perfiles; Type: VIEW; Schema: public; Owner: mantenimiento
--

CREATE VIEW vista_usuarios_perfiles AS
 SELECT d.usuario_id,
    d.usuario_nombre,
    d.usuario_indicador,
    d.usuario_clave,
    d.usuario_observacion,
    p.perfil_id,
    p.perfil_nombre
   FROM usuarios_datos d,
    usuarios_perfiles p
  WHERE (d.perfil_id = p.perfil_id);


ALTER TABLE vista_usuarios_perfiles OWNER TO mantenimiento;

--
-- Name: VIEW vista_usuarios_perfiles; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON VIEW vista_usuarios_perfiles IS 'Vista con los datos del usuario y el perfil.';


--
-- Name: actividad_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_actividades ALTER COLUMN actividad_id SET DEFAULT nextval('mantenimientos_actividades_actividad_id_seq'::regclass);


--
-- Name: so_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_actividades ALTER COLUMN so_id SET DEFAULT nextval('mantenimientos_actividades_so_id_seq'::regclass);


--
-- Name: checklist_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist ALTER COLUMN checklist_id SET DEFAULT nextval('mantenimientos_checklist_checklist_id_seq'::regclass);


--
-- Name: equipo_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist ALTER COLUMN equipo_id SET DEFAULT nextval('mantenimientos_checklist_equipo_id_seq'::regclass);


--
-- Name: actividad_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist ALTER COLUMN actividad_id SET DEFAULT nextval('mantenimientos_checklist_actividad_id_seq'::regclass);


--
-- Name: empresa_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_empresas ALTER COLUMN empresa_id SET DEFAULT nextval('empresas_id_seq'::regclass);


--
-- Name: equipo_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_equipos ALTER COLUMN equipo_id SET DEFAULT nextval('mantenimientos_equipos_equipo_id_seq'::regclass);


--
-- Name: empresa_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_equipos ALTER COLUMN empresa_id SET DEFAULT nextval('mantenimientos_equipos_empresa_id_seq'::regclass);


--
-- Name: gerencia_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_equipos ALTER COLUMN gerencia_id SET DEFAULT nextval('mantenimientos_equipos_gerencia_id_seq'::regclass);


--
-- Name: ubicacion_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_equipos ALTER COLUMN ubicacion_id SET DEFAULT nextval('mantenimientos_equipos_ubicacion_id_seq'::regclass);


--
-- Name: gerencia_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_gerencias ALTER COLUMN gerencia_id SET DEFAULT nextval('gerencias_id_seq'::regclass);


--
-- Name: so_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_sos ALTER COLUMN so_id SET DEFAULT nextval('"Sistemas_operativos_so_id_seq"'::regclass);


--
-- Name: ubicacion_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_ubicaciones ALTER COLUMN ubicacion_id SET DEFAULT nextval('ubucaciones_id_seq'::regclass);


--
-- Name: usuario_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY usuarios_datos ALTER COLUMN usuario_id SET DEFAULT nextval('usuarios_datos_id_seq'::regclass);


--
-- Name: perfil_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY usuarios_perfiles ALTER COLUMN perfil_id SET DEFAULT nextval('usuarios_perfiles_id_seq'::regclass);


--
-- Name: Sistemas_operativos_so_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('"Sistemas_operativos_so_id_seq"', 1, false);


--
-- Name: empresas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('empresas_id_seq', 3, true);


--
-- Name: gerencias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('gerencias_id_seq', 2, true);


--
-- Data for Name: mantenimientos_actividades; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--



--
-- Name: mantenimientos_actividades_actividad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_actividades_actividad_id_seq', 1, false);


--
-- Name: mantenimientos_actividades_so_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_actividades_so_id_seq', 1, false);


--
-- Data for Name: mantenimientos_checklist; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--



--
-- Name: mantenimientos_checklist_actividad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_checklist_actividad_id_seq', 1, false);


--
-- Name: mantenimientos_checklist_checklist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_checklist_checklist_id_seq', 1, false);


--
-- Name: mantenimientos_checklist_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_checklist_equipo_id_seq', 1, false);


--
-- Data for Name: mantenimientos_empresas; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO mantenimientos_empresas VALUES (2, 'PETROPIAR', 'Empresa Mixta');
INSERT INTO mantenimientos_empresas VALUES (3, 'PETROMONAGAS', 'Empresa Mixta');


--
-- Data for Name: mantenimientos_equipos; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--



--
-- Name: mantenimientos_equipos_empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_equipos_empresa_id_seq', 1, false);


--
-- Name: mantenimientos_equipos_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_equipos_equipo_id_seq', 1, false);


--
-- Name: mantenimientos_equipos_gerencia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_equipos_gerencia_id_seq', 1, false);


--
-- Name: mantenimientos_equipos_ubicacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_equipos_ubicacion_id_seq', 1, false);


--
-- Data for Name: mantenimientos_gerencias; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO mantenimientos_gerencias VALUES (2, 'ESTUDIOS INTEGRADOS', 'gerencia de estudios integrados ');


--
-- Data for Name: mantenimientos_sos; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--



--
-- Data for Name: mantenimientos_ubicaciones; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--



--
-- Name: ubucaciones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('ubucaciones_id_seq', 1, false);


--
-- Data for Name: usuarios_datos; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO usuarios_datos VALUES ('FDGS DFG', 'dfgdfg', 'e10adc3949ba59abbe56e057f20f883e', 'df dfgdfgdfgd', 18, 3);
INSERT INTO usuarios_datos VALUES ('JESÚS MANUEL DASILVA BARRETO', 'dasilvajm', '202cb962ac59075b964b07152d234b70', 'Usuario desarrollador de la aplicación', 19, 1);
INSERT INTO usuarios_datos VALUES ('PEPE PPQWEQ', 'pepe', 'e10adc3949ba59abbe56e057f20f883e', 'xcascda', 21, 2);


--
-- Name: usuarios_datos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('usuarios_datos_id_seq', 21, true);


--
-- Data for Name: usuarios_perfiles; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO usuarios_perfiles VALUES (1, 'administrador', 'Administrador del sistema');
INSERT INTO usuarios_perfiles VALUES (2, 'usuario', 'Usuario sin privilegios');
INSERT INTO usuarios_perfiles VALUES (3, 'consulta', 'Usuario de consulta de reportes');


--
-- Name: usuarios_perfiles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('usuarios_perfiles_id_seq', 3, true);


--
-- Name: Sistemas_operativos_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_sos
    ADD CONSTRAINT "Sistemas_operativos_pkey" PRIMARY KEY (so_id);


--
-- Name: empresas_nombre_key; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_empresas
    ADD CONSTRAINT empresas_nombre_key UNIQUE (empresa_nombre);


--
-- Name: empresas_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_empresas
    ADD CONSTRAINT empresas_pkey PRIMARY KEY (empresa_id);


--
-- Name: gerencias_nombre_key; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_gerencias
    ADD CONSTRAINT gerencias_nombre_key UNIQUE (gerencia_nombre);


--
-- Name: mantenimientos_actividades_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_actividades
    ADD CONSTRAINT mantenimientos_actividades_pkey PRIMARY KEY (actividad_id);


--
-- Name: mantenimientos_checklist_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_checklist
    ADD CONSTRAINT mantenimientos_checklist_pkey PRIMARY KEY (checklist_id);


--
-- Name: mantenimientos_equipos_equipo_nombre_key; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_equipos
    ADD CONSTRAINT mantenimientos_equipos_equipo_nombre_key UNIQUE (equipo_nombre);


--
-- Name: mantenimientos_equipos_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_equipos
    ADD CONSTRAINT mantenimientos_equipos_pkey PRIMARY KEY (equipo_id);


--
-- Name: pk_gerencias; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_gerencias
    ADD CONSTRAINT pk_gerencias PRIMARY KEY (gerencia_id);


--
-- Name: ubucaciones_nombre_key; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_ubicaciones
    ADD CONSTRAINT ubucaciones_nombre_key UNIQUE (ubicacion_nombre);


--
-- Name: ubucaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_ubicaciones
    ADD CONSTRAINT ubucaciones_pkey PRIMARY KEY (ubicacion_id);


--
-- Name: usuarios_datos_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY usuarios_datos
    ADD CONSTRAINT usuarios_datos_pkey PRIMARY KEY (usuario_id);


--
-- Name: usuarios_datos_usuario_indicador_key; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY usuarios_datos
    ADD CONSTRAINT usuarios_datos_usuario_indicador_key UNIQUE (usuario_indicador);


--
-- Name: usuarios_perfiles_perfil_nombre_key; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY usuarios_perfiles
    ADD CONSTRAINT usuarios_perfiles_perfil_nombre_key UNIQUE (perfil_nombre);


--
-- Name: usuarios_perfiles_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY usuarios_perfiles
    ADD CONSTRAINT usuarios_perfiles_pkey PRIMARY KEY (perfil_id);


--
-- Name: mantenimientos_actividades_so_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_actividades
    ADD CONSTRAINT mantenimientos_actividades_so_id_fkey FOREIGN KEY (so_id) REFERENCES mantenimientos_sos(so_id);


--
-- Name: mantenimientos_checklist_actividad_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist
    ADD CONSTRAINT mantenimientos_checklist_actividad_id_fkey FOREIGN KEY (actividad_id) REFERENCES mantenimientos_actividades(actividad_id);


--
-- Name: mantenimientos_checklist_equipo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist
    ADD CONSTRAINT mantenimientos_checklist_equipo_id_fkey FOREIGN KEY (equipo_id) REFERENCES mantenimientos_equipos(equipo_id);


--
-- Name: mantenimientos_equipos_empresa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_equipos
    ADD CONSTRAINT mantenimientos_equipos_empresa_id_fkey FOREIGN KEY (empresa_id) REFERENCES mantenimientos_empresas(empresa_id);


--
-- Name: mantenimientos_equipos_gerencia_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_equipos
    ADD CONSTRAINT mantenimientos_equipos_gerencia_id_fkey FOREIGN KEY (gerencia_id) REFERENCES mantenimientos_gerencias(gerencia_id);


--
-- Name: mantenimientos_equipos_ubicacion_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_equipos
    ADD CONSTRAINT mantenimientos_equipos_ubicacion_id_fkey FOREIGN KEY (ubicacion_id) REFERENCES mantenimientos_ubicaciones(ubicacion_id);


--
-- Name: usuarios_datos_perfil_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY usuarios_datos
    ADD CONSTRAINT usuarios_datos_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES usuarios_perfiles(perfil_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: mantenimiento
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM mantenimiento;
GRANT ALL ON SCHEMA public TO mantenimiento;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

