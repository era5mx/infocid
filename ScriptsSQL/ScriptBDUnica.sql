CREATE SEQUENCE "documento_pieimprenta_seq" start 1 increment 1 maxvalue 2147483647 minvalue 1 cache 1;

CREATE TABLE "alumno" (
   "numcarnet" varchar(10) NOT NULL,
   "nombre" varchar(20) NOT NULL,
   "apepat" varchar(20) NOT NULL,
   "apemat" varchar(20) NOT NULL,
   "especialidad" varchar(50) NOT NULL,
   "ciclo" varchar(2) NOT NULL,
   "direccion" varchar(100) NOT NULL,
   "telefono" varchar(8) NOT NULL,
   "sexo" char(1) NOT NULL,
   "ie" char(1) NOT NULL,
   "codlector" int8 NOT NULL,
   "activo" char(2) DEFAULT 'SI' NOT NULL,
   CONSTRAINT "alumno_pkey" PRIMARY KEY ("numcarnet")
);
CREATE  INDEX "alumno_numcarnet_key" ON "alumno" ("numcarnet");


CREATE TABLE "detdev" (
   "numdet" int8 NOT NULL,
   "coddev" int8 NOT NULL,
   "registro" varchar(6) NOT NULL,
   CONSTRAINT "detdev_pkey" PRIMARY KEY ("numdet")
);
CREATE  INDEX "detdev_numdet_key" ON "detdev" ("numdet");


CREATE TABLE "detprest" (
   "numdetalle" int8 NOT NULL,
   "codprest" int8 NOT NULL,
   "registro" varchar(6) NOT NULL,
   "devuelto" char(2) NOT NULL,
   "fechorprest" timestamp NOT NULL,
   CONSTRAINT "detprest_pkey" PRIMARY KEY ("numdetalle")
);
CREATE  INDEX "detprest_numdetalle_key" ON "detprest" ("numdetalle");


CREATE TABLE "devolucion" (
   "coddev" int8 NOT NULL,
   "codprest" int8 NOT NULL,
   "codusuario" int8 NOT NULL,
   "fechordev" timestamp NOT NULL,
   CONSTRAINT "devolucion_pkey" PRIMARY KEY ("coddev")
);
CREATE  INDEX "devolucion_coddev_key" ON "devolucion" ("coddev");


CREATE TABLE "documento" (
   "codigo" varchar(20) NOT NULL,
   "titulo" varchar(1000) NOT NULL,
   "autor" varchar(800) NOT NULL,
   "descriptor" varchar(1000) NOT NULL,
   "idioma" varchar(50) NOT NULL,
   "ubicacion" varchar(3) DEFAULT 'LTX' NOT NULL,
   "paginacion" varchar(5) NOT NULL,
   "pieimprenta" varchar(1000),
   "ingreso" varchar(100),
   "resumen" varchar(30000) DEFAULT '-',
   "observaciones" varchar(3500),
   "orden" int4
);
CREATE  INDEX "orden_documento_key" ON "documento" ("orden");


CREATE TABLE "estadistica" (
   "numero" int8 NOT NULL,
   "item" varchar(200) NOT NULL,
   "encont" int8 NOT NULL,
   "fecha" timestamp NOT NULL,
   "lector" varchar(10) DEFAULT '-',
   "criterio" varchar(25) DEFAULT '-',
   CONSTRAINT "estadistica_pkey" PRIMARY KEY ("numero")
);
CREATE  INDEX "estadistica_numero_key" ON "estadistica" ("numero");

CREATE TABLE "externo" (
   "dni" char(8) NOT NULL,
   "nombre" varchar(20) NOT NULL,
   "apemat" varchar(20) NOT NULL,
   "apepat" varchar(20) NOT NULL,
   "direccion" varchar(100) NOT NULL,
   "telefono" varchar(8) NOT NULL,
   "sexo" char(1) NOT NULL,
   "procedencia" varchar(50) NOT NULL,
   "codlector" int8 NOT NULL,
   "activo" char(2) DEFAULT 'SI' NOT NULL,
   CONSTRAINT "externo_pkey" PRIMARY KEY ("dni")
);
CREATE  INDEX "externo_dni_key" ON "externo" ("dni");


CREATE TABLE "interno" (
   "numcarnet" varchar(8) NOT NULL,
   "nombre" varchar(20) NOT NULL,
   "apemat" varchar(20) NOT NULL,
   "apepat" varchar(20) NOT NULL,
   "dependencia" varchar(20) NOT NULL,
   "anexo" varchar(3) NOT NULL,
   "sexo" char(1) NOT NULL,
   "codlector" int8 NOT NULL,
   "activo" char(2) DEFAULT 'SI' NOT NULL,
   CONSTRAINT "interno_pkey" PRIMARY KEY ("numcarnet")
);
CREATE  INDEX "interno_numcarnet_key" ON "interno" ("numcarnet");


CREATE TABLE "lector" (
   "codlector" int8 NOT NULL,
   "tipo" char(1) DEFAULT 'A' NOT NULL,
   CONSTRAINT "lector_pkey" PRIMARY KEY ("codlector")
);
CREATE  INDEX "lector_codlector_key" ON "lector" ("codlector");


CREATE TABLE "libro" (
   "registro" varchar(6) NOT NULL,
   "codigo" varchar(20) NOT NULL,
   "autor" varchar(200) NOT NULL,
   "titulo" varchar(600) NOT NULL,
   "descriptor" varchar(5000) NOT NULL,
   "resumen" varchar(20000) NOT NULL,
   "idioma" varchar(2) DEFAULT 'ES' NOT NULL,
   "prestado" varchar(2) DEFAULT 'NO' NOT NULL,
   "piedeimprenta" varchar(500) DEFAULT '-' NOT NULL,
   "isbn" varchar(30) DEFAULT '-' NOT NULL,
   "numpag" varchar(10) DEFAULT '0' NOT NULL,
   "precio" varchar(20) DEFAULT '0000.00' NOT NULL,
   "edicion" varchar(50) DEFAULT '-' NOT NULL,
   "fechaingreso" varchar(20) DEFAULT '00/00/00' NOT NULL,
   "numbc" varchar(20) DEFAULT '-' NOT NULL,
   "numingreso" varchar(20) DEFAULT '-' NOT NULL,
   "baja" varchar(2) DEFAULT 'NO' NOT NULL,
   "obs" varchar(500) DEFAULT '-' NOT NULL,
   "reservado" varchar(2) DEFAULT 'NO',
   "dilog" varchar(20),
   "pieedito" varchar(500) DEFAULT '-',
   "pieano" varchar(4) DEFAULT '-',
   CONSTRAINT "libro_pkey" PRIMARY KEY ("registro")
);
CREATE  INDEX "libro_registro_key" ON "libro" ("registro");
GRANT ALL ON "libro" TO "postgres";
--GRANT ALL ON "libro" TO "apache";


CREATE TABLE "parametro" (
   "numreg" int8 NOT NULL,
   "codlector" int8 NOT NULL,
   "nlibros" int8 NOT NULL,
   CONSTRAINT "parametro_pkey" PRIMARY KEY ("numreg")
);
CREATE  INDEX "parametro_codlector_key" ON "parametro" ("codlector");
CREATE  INDEX "parametro_numreg1_key" ON "parametro" ("numreg");
CREATE  UNIQUE INDEX "parametro_numreg_key" ON "parametro" ("codlector", "numreg");


CREATE TABLE "regprest" (
   "codprest" int8 NOT NULL,
   "codlector" int8 NOT NULL,
   "codusuario" int8 NOT NULL,
   CONSTRAINT "regprest_pkey" PRIMARY KEY ("codprest")
);
CREATE  INDEX "regprest_codprest_key" ON "regprest" ("codprest");


CREATE TABLE "usuario" (
   "codusuario" int8 NOT NULL,
   "login" varchar(30) NOT NULL,
   "identificacion" varchar(60) NOT NULL,
   "cargo" varchar(100) NOT NULL,
   "password" varchar(8) NOT NULL,
   "nseguridad" int4 NOT NULL,
   CONSTRAINT "usuario_pkey" PRIMARY KEY ("codusuario")
);
CREATE  INDEX "usuario_codusuario_key" ON "usuario" ("codusuario");


CREATE TABLE "video" (
   "registro" varchar(6) NOT NULL,
   "titulo" varchar(400) NOT NULL,
   "autor" varchar(200) NOT NULL,
   "fecha" varchar(20) DEFAULT '00/00/00' NOT NULL,
   "mesa" varchar(400) NOT NULL,
   "debate" varchar(400) NOT NULL,
   "entrevista" varchar(400) NOT NULL,
   "curso1" varchar(400) NOT NULL,
   "curso2" varchar(400) NOT NULL,
   "magazine" varchar(400) NOT NULL,
   "documental" varchar(400) NOT NULL,
   "duracion" varchar(400) NOT NULL,
   "resumen" varchar(3000) NOT NULL,
   "prestado" varchar(2) DEFAULT 'NO' NOT NULL,
   "obs" varchar(400) DEFAULT '-' NOT NULL,
   "activo" char(2) DEFAULT 'SI' NOT NULL,
   "operador" varchar(200) DEFAULT '-',
   CONSTRAINT "video_pkey" PRIMARY KEY ("registro")
);
CREATE  INDEX "video_registro_key" ON "video" ("registro");


CREATE VIEW "vpresta" AS SELECT detprest.numdetalle, detprest.codprest, detprest.registro, detprest.devuelto, detprest.fechorprest, regprest.codlector, regprest.codusuario FROM detprest, regprest WHERE (regprest.codprest = detprest.codprest);
CREATE VIEW "vprestalum" AS SELECT alumno.nombre, alumno.apepat, alumno.apemat, alumno.sexo, vpresta.codlector FROM alumno, vpresta WHERE (vpresta.codlector = alumno.codlector);
CREATE VIEW "vprestint" AS SELECT interno.nombre, interno.apemat, interno.apepat, interno.sexo, libro.autor, libro.titulo, vpresta.registro, vpresta.devuelto, vpresta.fechorprest, vpresta.codlector FROM interno, libro, vpresta WHERE ((vpresta.codlector = interno.codlector) AND (vpresta.registro = libro.registro));


CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22404" AFTER INSERT OR UPDATE ON "alumno" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_check_ins" ('<unnamed>', 'alumno', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22406" AFTER DELETE ON "lector" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_del" ('<unnamed>', 'alumno', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22408" AFTER UPDATE ON "lector" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_upd" ('<unnamed>', 'alumno', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22436" AFTER INSERT OR UPDATE ON "externo" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_check_ins" ('<unnamed>', 'externo', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22438" AFTER DELETE ON "lector" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_del" ('<unnamed>', 'externo', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22440" AFTER UPDATE ON "lector" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_upd" ('<unnamed>', 'externo', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22467" AFTER INSERT OR UPDATE ON "interno" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_check_ins" ('<unnamed>', 'interno', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22469" AFTER DELETE ON "lector" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_del" ('<unnamed>', 'interno', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22471" AFTER UPDATE ON "lector" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_upd" ('<unnamed>', 'interno', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22515" AFTER INSERT OR UPDATE ON "parametro" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_check_ins" ('<unnamed>', 'parametro', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22517" AFTER DELETE ON "lector" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_del" ('<unnamed>', 'parametro', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22519" AFTER UPDATE ON "lector" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_upd" ('<unnamed>', 'parametro', 'lector', 'UNSPECIFIED', 'codlector', 'codlector');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22562" AFTER INSERT OR UPDATE ON "detprest" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_check_ins" ('<unnamed>', 'detprest', 'regprest', 'UNSPECIFIED', 'codprest', 'codprest');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22564" AFTER DELETE ON "regprest" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_del" ('<unnamed>', 'detprest', 'regprest', 'UNSPECIFIED', 'codprest', 'codprest');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22566" AFTER UPDATE ON "regprest" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_upd" ('<unnamed>', 'detprest', 'regprest', 'UNSPECIFIED', 'codprest', 'codprest');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22587" AFTER INSERT OR UPDATE ON "devolucion" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_check_ins" ('<unnamed>', 'devolucion', 'regprest', 'UNSPECIFIED', 'codprest', 'codprest');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22589" AFTER DELETE ON "regprest" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_del" ('<unnamed>', 'devolucion', 'regprest', 'UNSPECIFIED', 'codprest', 'codprest');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22591" AFTER UPDATE ON "regprest" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_upd" ('<unnamed>', 'devolucion', 'regprest', 'UNSPECIFIED', 'codprest', 'codprest');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22593" AFTER INSERT OR UPDATE ON "devolucion" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_check_ins" ('<unnamed>', 'devolucion', 'usuario', 'UNSPECIFIED', 'codusuario', 'codusuario');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22595" AFTER DELETE ON "usuario" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_del" ('<unnamed>', 'devolucion', 'usuario', 'UNSPECIFIED', 'codusuario', 'codusuario');
CREATE CONSTRAINT TRIGGER "RI_ConstraintTrigger_22597" AFTER UPDATE ON "usuario" NOT DEFERRABLE INITIALLY IMMEDIATE FOR EACH ROW EXECUTE PROCEDURE "RI_FKey_noaction_upd" ('<unnamed>', 'devolucion', 'usuario', 'UNSPECIFIED', 'codusuario', 'codusuario');





CREATE TABLE "libroinv" (
   "registro" varchar(6) NOT NULL,
   "codigo" varchar(12) NOT NULL,
   "autor" varchar(150) NOT NULL,
   "titulo" varchar(255) NOT NULL,
   "numbc" varchar(14) NOT NULL,
   "numingreso" varchar(17) NOT NULL,
   "fechaingreso" varchar(10) NOT NULL,
   "piedeimprenta" varchar(100) NOT NULL,
   "precio" varchar(10) NOT NULL,
   "prestado" varchar(2) NOT NULL,
   "operador" varchar(3) NOT NULL,
   "fechoringreso" timestamp NOT NULL,
   "dilog" varchar(20),
   CONSTRAINT "libroinv_pkey" PRIMARY KEY ("registro")
);
CREATE  INDEX "libroinv_registro_key" ON "libroinv" ("registro");