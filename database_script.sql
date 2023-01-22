/*
 Navicat Premium Data Transfer

 Source Server         : dbname@localhost
 Source Server Type    : PostgreSQL
 Source Server Version : 150001 (150001)
 Source Host           : localhost:5432
 Source Catalog        : dbname
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 150001 (150001)
 File Encoding         : 65001

 Date: 22/01/2023 16:38:47
*/


-- ----------------------------
-- Sequence structure for sessions_session_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."sessions_session_id_seq";
CREATE SEQUENCE "public"."sessions_session_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for table_name_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."table_name_id_seq";
CREATE SEQUENCE "public"."table_name_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for trips_id_trip_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."trips_id_trip_seq";
CREATE SEQUENCE "public"."trips_id_trip_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_details_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_details_id_seq";
CREATE SEQUENCE "public"."users_details_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS "public"."sessions";
CREATE TABLE "public"."sessions" (
  "session_id" int4 NOT NULL DEFAULT nextval('sessions_session_id_seq'::regclass),
  "user_id" int4 NOT NULL,
  "sessionGUID" varchar(36) COLLATE "pg_catalog"."default" NOT NULL,
  "dateGenerated" timestamp(6) NOT NULL DEFAULT now()
)
;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for single_expenses
-- ----------------------------
DROP TABLE IF EXISTS "public"."single_expenses";
CREATE TABLE "public"."single_expenses" (
  "id_trip" int4 NOT NULL,
  "place" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "amount" int4 NOT NULL,
  "category" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "expense_date" date NOT NULL,
  "notes" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of single_expenses
-- ----------------------------
INSERT INTO "public"."single_expenses" VALUES (1, 'Supermarket', 360, 'Jedzenie', '2023-01-18', '');
INSERT INTO "public"."single_expenses" VALUES (1, 'Hotel', 900, 'Nocleg', '2023-01-12', '');
INSERT INTO "public"."single_expenses" VALUES (1, 'Alama Restauracja', 260, 'Jedzenie', '2023-01-17', 'Kolacja');
INSERT INTO "public"."single_expenses" VALUES (2, 'Czeska Gospoda', 170, 'Jedzenie', '2023-01-09', 'Knedliczki');

-- ----------------------------
-- Table structure for trips
-- ----------------------------
DROP TABLE IF EXISTS "public"."trips";
CREATE TABLE "public"."trips" (
  "id_trip" int4 NOT NULL DEFAULT nextval('trips_id_trip_seq'::regclass),
  "title" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "start_date" date NOT NULL,
  "end_date" date NOT NULL,
  "created_at" date NOT NULL,
  "target_currency" varchar(3) COLLATE "pg_catalog"."default" NOT NULL,
  "sum_of_expenses" int4 NOT NULL DEFAULT 0,
  "id_author" int4 NOT NULL,
  "image" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of trips
-- ----------------------------
INSERT INTO "public"."trips" VALUES (1, 'Bali', '2023-01-12', '2023-01-19', '2023-01-19', 'IDR', 1670, 1, 'bali.jpg');
INSERT INTO "public"."trips" VALUES (2, 'Praga z Mamą', '2023-01-05', '2023-01-11', '2023-01-19', 'CZK', 170, 1, 'praga.jpg');
INSERT INTO "public"."trips" VALUES (3, 'Havana', '2023-01-05', '0202-01-12', '2023-01-21', 'USD', 0, 2, 'havana.jpg');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id" int4 NOT NULL DEFAULT nextval('table_name_id_seq'::regclass),
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "password" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "id_users_details" int4 NOT NULL
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (1, 'marek@op.pl', 'e061c9aea5026301e7b3ff09e9aca2cf', 1);
INSERT INTO "public"."users" VALUES (2, 'ania@op.pl', '5f59ac736640f43e61c6070284bf1c06', 2);

-- ----------------------------
-- Table structure for users_details
-- ----------------------------
DROP TABLE IF EXISTS "public"."users_details";
CREATE TABLE "public"."users_details" (
  "id" int4 NOT NULL DEFAULT nextval('users_details_id_seq'::regclass),
  "name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "surname" varchar(100) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of users_details
-- ----------------------------
INSERT INTO "public"."users_details" VALUES (1, 'Marek', 'Kowalski');
INSERT INTO "public"."users_details" VALUES (2, 'Anna', 'Nowak');

-- ----------------------------
-- Function structure for sum_of_expenses_calculate
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."sum_of_expenses_calculate"();
CREATE OR REPLACE FUNCTION "public"."sum_of_expenses_calculate"()
  RETURNS "pg_catalog"."trigger" AS $BODY$BEGIN
    update trips
        set sum_of_expenses = (select sum(amount)
                               from single_expenses
                               where id_trip=new.id_trip)
        where id_trip=new.id_trip;

    return new;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for uuid_generate_v1
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v1"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v1"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v1'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v1mc
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v1mc"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v1mc"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v1mc'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v3
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v3"("namespace" uuid, "name" text);
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v3"("namespace" uuid, "name" text)
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v3'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v4
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v4"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v4"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v4'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v5
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v5"("namespace" uuid, "name" text);
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v5"("namespace" uuid, "name" text)
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v5'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_nil
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_nil"();
CREATE OR REPLACE FUNCTION "public"."uuid_nil"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_nil'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_dns
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_dns"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_dns"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_dns'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_oid
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_oid"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_oid"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_oid'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_url
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_url"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_url"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_url'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_x500
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_x500"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_x500"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_x500'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."sessions_session_id_seq"
OWNED BY "public"."sessions"."session_id";
SELECT setval('"public"."sessions_session_id_seq"', 39, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."table_name_id_seq"
OWNED BY "public"."users"."id";
SELECT setval('"public"."table_name_id_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."trips_id_trip_seq"
OWNED BY "public"."trips"."id_trip";
SELECT setval('"public"."trips_id_trip_seq"', 2, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_details_id_seq"
OWNED BY "public"."users_details"."id";
SELECT setval('"public"."users_details_id_seq"', 2, true);

-- ----------------------------
-- Primary Key structure for table sessions
-- ----------------------------
ALTER TABLE "public"."sessions" ADD CONSTRAINT "sessions_pkey" PRIMARY KEY ("session_id");

-- ----------------------------
-- Triggers structure for table single_expenses
-- ----------------------------
CREATE TRIGGER "sum_of_expenses_trigger_insert" AFTER INSERT ON "public"."single_expenses"
FOR EACH ROW
EXECUTE PROCEDURE "public"."sum_of_expenses_calculate"();

-- ----------------------------
-- Primary Key structure for table trips
-- ----------------------------
ALTER TABLE "public"."trips" ADD CONSTRAINT "trips_pkey" PRIMARY KEY ("id_trip");

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_id_users_details_key" UNIQUE ("id_users_details");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "table_name_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table users_details
-- ----------------------------
ALTER TABLE "public"."users_details" ADD CONSTRAINT "users_details_id_key" UNIQUE ("id");

-- ----------------------------
-- Primary Key structure for table users_details
-- ----------------------------
ALTER TABLE "public"."users_details" ADD CONSTRAINT "users_details_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Keys structure for table sessions
-- ----------------------------
ALTER TABLE "public"."sessions" ADD CONSTRAINT "sessions_users_id_fk" FOREIGN KEY ("user_id") REFERENCES "public"."users" ("id") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table single_expenses
-- ----------------------------
ALTER TABLE "public"."single_expenses" ADD CONSTRAINT "single_expenses_trips_null_fk" FOREIGN KEY ("id_trip") REFERENCES "public"."trips" ("id_trip") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table trips
-- ----------------------------
ALTER TABLE "public"."trips" ADD CONSTRAINT "trips_users_id_fk" FOREIGN KEY ("id_author") REFERENCES "public"."users" ("id") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_users_details_id_fk" FOREIGN KEY ("id") REFERENCES "public"."users_details" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
