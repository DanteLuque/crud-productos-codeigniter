-- permitir insersión de datos mediante archivos locales
SHOW VARIABLES LIKE 'local_infile';
SET GLOBAL local_infile = 1;

-- insersión de DEPARTAMENTOS
LOAD DATA LOCAL INFILE 'C:/ubigeo/departamentos.csv'
INTO TABLE departamentos
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
IGNORE 1 LINES
(id, name);

-- insersión de PROVINCIAS
LOAD DATA LOCAL INFILE 'C:/ubigeo/provincias.csv'
INTO TABLE provincias
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
IGNORE 1 LINES
(id, name, departamento_id);

-- insersión de DISTRITOS
LOAD DATA LOCAL INFILE 'C:/ubigeo/distritos.csv'
INTO TABLE distritos
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
IGNORE 1 LINES
(id, name, provincia_id, @departamento_id);