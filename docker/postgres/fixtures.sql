-- TRUNCATE
TRUNCATE TABLE pomm.city CASCADE;
TRUNCATE TABLE pomm.province CASCADE;
TRUNCATE TABLE pomm.country CASCADE;

-- INSERT
INSERT INTO pomm.country (country_id, name)
    VALUES
        (1, 'France')
;

INSERT INTO pomm.province (province_id, name, country_id)
    VALUES
        (1, 'Aquitaine', 1),
        (2, 'Ile de France', 1),
        (3, 'Bretagne', 1)
;

INSERT INTO pomm.city (city_id, name, province_id)
    VALUES
        (1, 'Bordeaux', 1),
        (2, 'Bergerac', 1)
;
