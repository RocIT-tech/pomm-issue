-- EXTENSIONS
CREATE EXTENSION IF NOT EXISTS hstore;

-- ===============
-- SCHEMA CONFIG
-- ===============
CREATE SCHEMA pomm;

-- CREATE TABLES
CREATE TABLE IF NOT EXISTS pomm.country
(
    country_id SERIAL     NOT NULL
        CONSTRAINT pomm_country_pk
            PRIMARY KEY,
    name       VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS pomm.province
(
    province_id SERIAL      NOT NULL
        CONSTRAINT pomm_province_pk
            PRIMARY KEY,
    name        VARCHAR(50) NOT NULL,
    country_id  INTEGER     NOT NULL
        CONSTRAINT pomm_province_country_country_id_fk
            REFERENCES pomm.country
            ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS pomm.city
(
    city_id     SERIAL      NOT NULL
        CONSTRAINT pomm_city_pk
            PRIMARY KEY,
    name        VARCHAR(50) NOT NULL,
    province_id INTEGER     NOT NULL
        CONSTRAINT pomm_city_province_province_id_fk
            REFERENCES pomm.province
            ON DELETE CASCADE
);
