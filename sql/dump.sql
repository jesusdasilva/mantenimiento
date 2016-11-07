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
ALTER TABLE ONLY public.mantenimientos_checklist DROP CONSTRAINT mantenimiento_checklist_equipo_id_fkey;
ALTER TABLE ONLY public.usuarios_perfiles DROP CONSTRAINT usuarios_perfiles_pkey;
ALTER TABLE ONLY public.usuarios_perfiles DROP CONSTRAINT usuarios_perfiles_perfil_nombre_key;
ALTER TABLE ONLY public.usuarios_datos DROP CONSTRAINT usuarios_datos_usuario_indicador_key;
ALTER TABLE ONLY public.usuarios_datos DROP CONSTRAINT usuarios_datos_pkey;
ALTER TABLE ONLY public.mantenimientos_ubicaciones DROP CONSTRAINT ubucaciones_pkey;
ALTER TABLE ONLY public.mantenimientos_ubicaciones DROP CONSTRAINT ubucaciones_nombre_key;
ALTER TABLE ONLY public.mantenimientos_gerencias DROP CONSTRAINT pk_gerencias;
ALTER TABLE ONLY public.mantenimientos_equipos DROP CONSTRAINT mantenimientos_equipos_pkey;
ALTER TABLE ONLY public.mantenimientos_equipos DROP CONSTRAINT mantenimientos_equipos_equipo_nombre_key;
ALTER TABLE ONLY public.mantenimientos_gerencias DROP CONSTRAINT gerencias_nombre_key;
ALTER TABLE ONLY public.mantenimientos_empresas DROP CONSTRAINT empresas_pkey;
ALTER TABLE ONLY public.mantenimientos_empresas DROP CONSTRAINT empresas_nombre_key;
ALTER TABLE ONLY public.mantenimientos_checklist DROP CONSTRAINT checklist_pkey;
ALTER TABLE public.usuarios_perfiles ALTER COLUMN perfil_id DROP DEFAULT;
ALTER TABLE public.usuarios_datos ALTER COLUMN usuario_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_ubicaciones ALTER COLUMN ubicacion_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_gerencias ALTER COLUMN gerencia_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_equipos ALTER COLUMN ubicacion_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_equipos ALTER COLUMN gerencia_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_equipos ALTER COLUMN empresa_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_equipos ALTER COLUMN equipo_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_empresas ALTER COLUMN empresa_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_checklist ALTER COLUMN checklist_nombre DROP DEFAULT;
ALTER TABLE public.mantenimientos_checklist ALTER COLUMN equipo_id DROP DEFAULT;
ALTER TABLE public.mantenimientos_checklist ALTER COLUMN checklist_id DROP DEFAULT;
DROP VIEW public.vista_usuarios_perfiles;
DROP VIEW public.vista_equipos;
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
DROP SEQUENCE public.gerencias_id_seq;
DROP TABLE public.mantenimientos_gerencias;
DROP SEQUENCE public.empresas_id_seq;
DROP TABLE public.mantenimientos_empresas;
DROP SEQUENCE public.checklist_equipo_id_seq;
DROP SEQUENCE public.checklist_checklist_nombre_seq;
DROP SEQUENCE public.checklist_checklist_id_seq;
DROP TABLE public.mantenimientos_checklist;
DROP DOMAIN public.observacion;
DROP DOMAIN public.nombre_largo;
DROP DOMAIN public.nombre_corto;
DROP EXTENSION adminpack;
DROP EXTENSION plpgsql;
DROP SCHEMA public;
--
-- Name: mantenimientoDB; Type: COMMENT; Schema: -; Owner: mantenimiento
--

COMMENT ON DATABASE "mantenimientoDB" IS 'Base de datos del sistema de mantenimiento de Estaciones de Trabajo de PDVSA';


--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
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
-- Name: mantenimientos_checklist; Type: TABLE; Schema: public; Owner: mantenimiento; Tablespace: 
--

CREATE TABLE mantenimientos_checklist (
    checklist_id integer NOT NULL,
    equipo_id integer NOT NULL,
    checklist_nombre nombre_largo NOT NULL,
    checklist_so nombre_corto,
    checklist_estatus boolean
);


ALTER TABLE mantenimientos_checklist OWNER TO mantenimiento;

--
-- Name: TABLE mantenimientos_checklist; Type: COMMENT; Schema: public; Owner: mantenimiento
--

COMMENT ON TABLE mantenimientos_checklist IS 'Tabla del checlist de Mantenimiento por Sistema Operativo';


--
-- Name: checklist_checklist_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE checklist_checklist_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE checklist_checklist_id_seq OWNER TO mantenimiento;

--
-- Name: checklist_checklist_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE checklist_checklist_id_seq OWNED BY mantenimientos_checklist.checklist_id;


--
-- Name: checklist_checklist_nombre_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE checklist_checklist_nombre_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE checklist_checklist_nombre_seq OWNER TO mantenimiento;

--
-- Name: checklist_checklist_nombre_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE checklist_checklist_nombre_seq OWNED BY mantenimientos_checklist.checklist_nombre;


--
-- Name: checklist_equipo_id_seq; Type: SEQUENCE; Schema: public; Owner: mantenimiento
--

CREATE SEQUENCE checklist_equipo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE checklist_equipo_id_seq OWNER TO mantenimiento;

--
-- Name: checklist_equipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mantenimiento
--

ALTER SEQUENCE checklist_equipo_id_seq OWNED BY mantenimientos_checklist.equipo_id;


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
    ubicacion_nombre nombre_largo NOT NULL,
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
-- Name: vista_equipos; Type: VIEW; Schema: public; Owner: mantenimiento
--

CREATE VIEW vista_equipos AS
 SELECT equipos.equipo_id,
    equipos.equipo_nombre,
    empresas.empresa_nombre,
    gerencias.gerencia_nombre,
    ubicaciones.ubicacion_nombre,
    checklist.checklist_so
   FROM ((((mantenimientos_equipos equipos
     JOIN mantenimientos_empresas empresas ON ((equipos.empresa_id = empresas.empresa_id)))
     JOIN mantenimientos_gerencias gerencias ON ((equipos.gerencia_id = gerencias.gerencia_id)))
     JOIN mantenimientos_ubicaciones ubicaciones ON ((equipos.ubicacion_id = ubicaciones.ubicacion_id)))
     JOIN mantenimientos_checklist checklist ON ((equipos.equipo_id = checklist.equipo_id)))
  GROUP BY equipos.equipo_id, equipos.equipo_nombre, empresas.empresa_nombre, gerencias.gerencia_nombre, ubicaciones.ubicacion_nombre, checklist.checklist_so;


ALTER TABLE vista_equipos OWNER TO mantenimiento;

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
-- Name: checklist_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist ALTER COLUMN checklist_id SET DEFAULT nextval('checklist_checklist_id_seq'::regclass);


--
-- Name: equipo_id; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist ALTER COLUMN equipo_id SET DEFAULT nextval('checklist_equipo_id_seq'::regclass);


--
-- Name: checklist_nombre; Type: DEFAULT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist ALTER COLUMN checklist_nombre SET DEFAULT nextval('checklist_checklist_nombre_seq'::regclass);


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
-- Name: checklist_checklist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('checklist_checklist_id_seq', 378, true);


--
-- Name: checklist_checklist_nombre_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('checklist_checklist_nombre_seq', 1, false);


--
-- Name: checklist_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('checklist_equipo_id_seq', 1, false);


--
-- Name: empresas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('empresas_id_seq', 5, true);


--
-- Name: gerencias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('gerencias_id_seq', 3, true);


--
-- Data for Name: mantenimientos_checklist; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO mantenimientos_checklist VALUES (19, 4, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (20, 4, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (21, 4, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (22, 4, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (23, 4, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (24, 4, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (25, 4, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (26, 4, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (27, 4, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (28, 4, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (29, 4, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (30, 4, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (31, 4, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (32, 4, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (33, 4, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (34, 4, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (35, 4, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (36, 4, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (37, 5, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (38, 5, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (39, 5, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (40, 5, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (41, 5, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (42, 5, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (43, 5, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (44, 5, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (45, 5, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (46, 5, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (47, 5, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (48, 5, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (49, 5, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (50, 5, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (51, 5, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (52, 5, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (53, 5, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (54, 5, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (55, 6, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (56, 6, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (57, 6, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (58, 6, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (59, 6, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (60, 6, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (61, 6, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (62, 6, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (63, 6, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (64, 6, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (65, 6, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (66, 6, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (67, 6, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (68, 6, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (69, 6, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (70, 6, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (71, 6, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (72, 6, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (73, 7, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (74, 7, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (75, 7, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (76, 7, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (77, 7, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (78, 7, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (79, 7, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (80, 7, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (81, 7, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (82, 7, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (83, 7, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (84, 7, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (85, 7, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (86, 7, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (87, 7, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (88, 7, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (89, 7, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (90, 7, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (91, 8, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (92, 8, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (93, 8, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (94, 8, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (95, 8, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (96, 8, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (97, 8, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (98, 8, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (99, 8, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (100, 8, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (101, 8, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (102, 8, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (103, 8, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (104, 8, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (105, 8, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (106, 8, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (107, 8, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (108, 8, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (109, 9, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (110, 9, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (111, 9, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (112, 9, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (113, 9, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (114, 9, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (115, 9, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (116, 9, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (117, 9, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (118, 9, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (119, 9, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (120, 9, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (121, 9, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (122, 9, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (123, 9, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (124, 9, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (125, 9, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (126, 9, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (127, 10, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (128, 10, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (129, 10, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (130, 10, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (131, 10, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (132, 10, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (133, 10, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (134, 10, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (135, 10, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (136, 10, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (137, 10, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (138, 10, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (139, 10, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (140, 10, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (141, 10, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (142, 10, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (143, 10, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (144, 10, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (145, 11, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (146, 11, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (147, 11, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (148, 11, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (149, 11, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (150, 11, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (151, 11, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (152, 11, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (153, 11, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (154, 11, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (155, 11, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (156, 11, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (157, 11, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (158, 11, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (159, 11, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (160, 11, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (161, 11, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (162, 11, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (163, 12, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (164, 12, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (165, 12, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (166, 12, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (167, 12, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (168, 12, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (169, 12, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (170, 12, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (171, 12, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (172, 12, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (173, 12, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (174, 12, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (175, 12, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (176, 12, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (177, 12, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (178, 12, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (179, 12, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (180, 12, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (181, 13, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (182, 13, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (183, 13, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (184, 13, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (185, 13, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (186, 13, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (187, 13, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (188, 13, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (189, 13, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (190, 13, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (191, 13, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (192, 13, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (193, 13, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (194, 13, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (195, 13, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (196, 13, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (197, 13, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (198, 13, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (199, 14, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (200, 14, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (201, 14, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (202, 14, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (203, 14, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (204, 14, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (205, 14, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (206, 14, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (207, 14, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (208, 14, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (209, 14, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (210, 14, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (211, 14, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (212, 14, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (213, 14, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (214, 14, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (215, 14, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (216, 14, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (217, 15, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (218, 15, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (219, 15, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (220, 15, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (221, 15, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (222, 15, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (223, 15, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (224, 15, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (225, 15, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (226, 15, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (227, 15, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (228, 15, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (229, 15, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (230, 15, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (231, 15, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (232, 15, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (233, 15, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (234, 15, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (235, 16, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (236, 16, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (237, 16, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (238, 16, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (239, 16, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (240, 16, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (241, 16, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (242, 16, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (243, 16, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (244, 16, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (245, 16, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (246, 16, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (247, 16, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (248, 16, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (249, 16, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (250, 16, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (251, 16, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (252, 16, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (253, 17, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (254, 17, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (255, 17, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (256, 17, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (257, 17, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (258, 17, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (259, 17, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (260, 17, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (261, 17, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (262, 17, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (263, 17, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (264, 17, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (265, 17, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (266, 17, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (267, 17, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (268, 17, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (269, 17, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (270, 17, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (271, 18, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (272, 18, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (273, 18, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (274, 18, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (275, 18, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (276, 18, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (277, 18, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (278, 18, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (279, 18, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (280, 18, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (281, 18, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (282, 18, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (283, 18, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (284, 18, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (285, 18, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (286, 18, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (287, 18, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (288, 18, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (289, 19, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (290, 19, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (291, 19, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (292, 19, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (293, 19, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (294, 19, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (295, 19, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (296, 19, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (297, 19, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (298, 19, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (299, 19, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (300, 19, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (301, 19, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (302, 19, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (303, 19, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (304, 19, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (305, 19, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (306, 19, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (307, 20, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (308, 20, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (309, 20, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (310, 20, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (311, 20, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (312, 20, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (313, 20, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (314, 20, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (315, 20, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (316, 20, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (317, 20, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (318, 20, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (319, 20, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (320, 20, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (321, 20, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (322, 20, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (323, 20, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (324, 20, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (325, 21, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (326, 21, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (327, 21, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (328, 21, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (329, 21, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (330, 21, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (331, 21, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (332, 21, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (333, 21, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (334, 21, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (335, 21, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (336, 21, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (337, 21, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (338, 21, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (339, 21, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (340, 21, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (341, 21, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (342, 21, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (343, 22, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (344, 22, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (345, 22, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (346, 22, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (347, 22, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (348, 22, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (349, 22, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (350, 22, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (351, 22, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (352, 22, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (353, 22, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (354, 22, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (355, 22, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (356, 22, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (357, 22, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (358, 22, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (359, 22, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (360, 22, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (361, 23, 'Revisión del nombre del equipo.', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (362, 23, 'Aplicar las políticas de PDVSA', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (363, 23, 'Revisión del Estado de Hibernación del equipo', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (364, 23, 'Setear la memoria virtual a la unidad D:', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (365, 23, 'Tamaño de la memoria Virtual a 10 GB', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (366, 23, 'Sufijos DNS configurado', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (367, 23, 'Servidor PLCGUA03 mapeada en unidad G:ppl', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (368, 23, 'Servidor PLCGUA03 mapeada en unidad I:dataplic', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (369, 23, 'Programas instalados en la unidad C', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (370, 23, 'Data de usuario en Unidad D', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (371, 23, 'Integridad del Disco Duro', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (372, 23, 'Perfil de usuarios en D:Users', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (373, 23, 'Licencias en Variables de Sistemas', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (374, 23, 'Licencias en Variables de Usuario', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (375, 23, 'Variables de Oracle en el Path del Sistema', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (376, 23, 'Instalar Microsoft Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (377, 23, 'Actualizar el Framenwork NET 4', 'Windows XP 32bits', false);
INSERT INTO mantenimientos_checklist VALUES (378, 23, 'Revisar el estado del Antivirus', 'Windows XP 32bits', false);


--
-- Data for Name: mantenimientos_empresas; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO mantenimientos_empresas VALUES (2, 'PETROPIAR', 'Empresa Mixta');
INSERT INTO mantenimientos_empresas VALUES (3, 'PETROMONAGAS', 'Empresa Mixta sfsdf');
INSERT INTO mantenimientos_empresas VALUES (4, 'PETROMIRANDA', 'empresa mixta');
INSERT INTO mantenimientos_empresas VALUES (5, 'NINGUNA', '');


--
-- Data for Name: mantenimientos_equipos; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO mantenimientos_equipos VALUES (4, NULL, NULL, 5, 3, 'WWWW', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (5, NULL, NULL, 5, 3, 'DDDD', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (6, NULL, NULL, 5, 3, 'QQQQ', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (7, NULL, NULL, 5, 3, 'RRRRRRRRRR', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (8, NULL, NULL, 5, 3, 'FFFFFFFFFFF', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (9, NULL, NULL, 5, 3, 'FFFFFFFFUUU', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (10, NULL, NULL, 5, 3, 'YYYYYYYYY', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (11, NULL, NULL, 5, 3, 'ERWER', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (12, NULL, NULL, 5, 3, 'ZZZZZZZZ', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (13, NULL, NULL, 5, 3, 'OOOO', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (14, NULL, NULL, 5, 3, 'JJJJJJJJJJJJJHHHHHHH', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (15, NULL, NULL, 5, 3, 'QWER', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (16, NULL, NULL, 5, 3, 'QWERF', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (17, NULL, NULL, 5, 3, 'WERT', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (18, NULL, NULL, 5, 3, 'KKKK', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (19, NULL, NULL, 5, 3, 'UUUU', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (20, NULL, NULL, 5, 3, 'TUTRUT', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (21, NULL, NULL, 5, 3, 'YUYTU', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (22, NULL, NULL, 5, 3, 'EWRWER', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (23, NULL, NULL, 5, 3, 'SDFSDF', NULL, 21, NULL);
INSERT INTO mantenimientos_equipos VALUES (24, NULL, NULL, 5, 3, '', NULL, 21, NULL);


--
-- Name: mantenimientos_equipos_empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_equipos_empresa_id_seq', 1, false);


--
-- Name: mantenimientos_equipos_equipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('mantenimientos_equipos_equipo_id_seq', 24, true);


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

INSERT INTO mantenimientos_gerencias VALUES (2, 'ESTUDIOS INTEGRADOS', 'gerencia de estudios integrados  jhjhjk');
INSERT INTO mantenimientos_gerencias VALUES (3, 'NINGUNA', '');


--
-- Data for Name: mantenimientos_ubicaciones; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO mantenimientos_ubicaciones VALUES (21, 'NINGUNA', '');
INSERT INTO mantenimientos_ubicaciones VALUES (22, 'EDIFICIO CBP, PISO 1, ALA SUR', 'Edificio Centro Bahia de Pozuelos');
INSERT INTO mantenimientos_ubicaciones VALUES (23, 'EDIFICIO CBP, TORRE CD, PISO 3, ALA NORTE.', '');


--
-- Name: ubucaciones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mantenimiento
--

SELECT pg_catalog.setval('ubucaciones_id_seq', 23, true);


--
-- Data for Name: usuarios_datos; Type: TABLE DATA; Schema: public; Owner: mantenimiento
--

INSERT INTO usuarios_datos VALUES ('JESÚS MANUEL DASILVA BARRETO', 'dasilvajm', '202cb962ac59075b964b07152d234b70', 'Usuario desarrollador de la aplicación', 19, 1);


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
-- Name: checklist_pkey; Type: CONSTRAINT; Schema: public; Owner: mantenimiento; Tablespace: 
--

ALTER TABLE ONLY mantenimientos_checklist
    ADD CONSTRAINT checklist_pkey PRIMARY KEY (checklist_id);


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
-- Name: mantenimiento_checklist_equipo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mantenimiento
--

ALTER TABLE ONLY mantenimientos_checklist
    ADD CONSTRAINT mantenimiento_checklist_equipo_id_fkey FOREIGN KEY (equipo_id) REFERENCES mantenimientos_equipos(equipo_id);


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
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

