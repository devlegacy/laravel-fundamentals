 ADD in docs

 mysqldump -u root -p laravel_fundamentals > /var/www/html/laravel-fundamentals/database/backup.sql

CREATE DATABASE IF NOT EXISTS laravel_fundamentals CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- TODO: DROP TABLE IF exists reviewsables;
-- create table reviewsables(
-- 	id integer,
--     tablename varchar(255),
--     user_id integer unsigned,
--     museum_id integer unsigned,
--     product_id integer unsigned,
--     review_id integer unsigned
-- );

DROP TABLE IF EXISTS clients;

CREATE TABLE IF NOT EXISTS clients(
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL,
  rfc VARCHAR(60) NULL DEFAULT NULL,
  email VARCHAR(200) NOT NULL DEFAULT '',
  status CHAR DEFAULT 'a' COMMENT 'Estado del clienta a=activo, b=banned, c=cancelado, la letras son mas mnemónicas',
  gob_doc VARCHAR(100) NOT NULL COMMENT 'Documento emitido por un gobierno como IFE, documento, CURP, etc.',
  country_id TINYINT UNSIGNED NOT NULL,
  province_id SMALLINT UNSIGNED NOT NULL,
  location_id MEDIUMINT UNSIGNED NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,


  CONSTRAINT pk_clients_id PRIMARY KEY(id),
  CONSTRAINT uk_gob_doc UNIQUE (gob_doc),
  -- KEY es un sinonimo de INDEX
  KEY ik_clients_country_id (country_id),
  KEY ik_clients_province_id (province_id),
  KEY ik_clients_location_id (location_id),
  INDEX ik_clients_country_province_location (country_id,province_id,location_id)

)
ENGINE = InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci
COMMENT 'Tabla de clientes';

ALTER TABLE clients CHANGE email email VARCHAR(250) NOT NULL DEFAULT '';
ALTER TABLE clients CHANGE email email VARCHAR(200) NOT NULL DEFAULT '' AFTER status;
ALTER TABLE clients CHANGE email email VARCHAR(200) NOT NULL DEFAULT '' AFTER rfc;




DROP TABLE IF EXISTS providers;
CREATE TABLE IF NOT EXISTS providers (
  id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  CONSTRAINT pk_providers_id PRIMARY KEY(id)
)
ENGINE = InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci
COMMENT '';




DROP TABLE IF EXISTS products;

CREATE TABLE IF NOT EXISTS products (
  id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id de Producto, Numero generado Automaticamente ante cada INSERT',
  name VARCHAR(60) NOT NULL,
  detail TEXT NOT NULL COMMENT 'Descripción del Producto', -- TEXT no puede tener valores por default
  color VARCHAR(20) NOT NULL DEFAULT '' COMMENT 'Color del Producto',
  status TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Estado del Producto 1=Habilitado, 0=Deshabilitado',
  price decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT 'Precio del Producto',
  stock INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '',
  discount INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '',
  provider_id INT(10) DEFAULT 0 COMMENT 'Id del Proveedor de ese Producto',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  CONSTRAINT pk_products_id PRIMARY KEY(id),
  KEY ik_products_provider_id (provider_id)
)
ENGINE = InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci
COMMENT '';




DROP TABLE IF EXISTS sales;

CREATE TABLE IF NOT EXISTS sales (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  date DATE NOT NULL,
  invoice MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0,
  neto DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  iva DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  total DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  client_id MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  CONSTRAINT pk_sales_id PRIMARY KEY(id),
  KEY ik_sales_client_id (client_id)
)
ENGINE = InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci
COMMENT '';




DROP TABLE IF EXISTS detail_sales;

CREATE TABLE IF NOT EXISTS detail_sales (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  price DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  cost DECIMAL(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  sale_id BIGINT(20) UNSIGNED NOT NULL DEFAULT 0,
  product_id MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0,
  amount MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  CONSTRAINT pk_detail_sales_id PRIMARY KEY(id),
  KEY ik_detail_sales_sale_id (sale_id),
  KEY ik_detail_sales_product_id (product_id)
)
ENGINE = InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci
COMMENT '';

-- SELECT

-- Performance issue
SELECT * FROM clients;

-- Best practice

SELECT id FROM clients;
-- Extends SELECT with WHERE
SELECT id FROM clients WHERE id > 10;

SELECT name, price FROM products WHERE price > 0;

SELECT name, price
FROM products
WHERE price > 0 AND status > 0;

SELECT name, price, status, provider_id
FROM products
WHERE price > 0 AND (status =0 OR (status=1 AND provider_id=97));

SELECT date, client_id, total
FROM sales
WHERE date > '2018-01-03' AND date < '2018-01-10' AND client_id != 1 AND total > 1000;

-- ORDER BY
SELECT * FROM clients ORDER BY name ASC;
SELECT * FROM clients ORDER BY name DESC;

SELECT * FROM products ORDER BY STATUS ASC, price DESC;

SELECT * FROM datil_sales AS ds, products AS p
WHERE ds.product_id = p.id
ORDER BY p.provider_id DESC

-- FUNCTION
-- SUM
SELECT SUM(total) AS total FROM sales;
-- SUM, MONTH, YEAR
SELECT SUM(total) AS total FROM sales WHERE MONTH(date) = 1 AND YEAR(date) = 2018;
-- COUNT, MONTH, YEAR
SELECT COUNT(id) AS count from sales WHERE MONTH(date) = 1 AND YEAR(date) = 2018;
SELECT MAX(total) AS 'Venta máxima' from sales WHERE MONTH(date) = 1 AND YEAR(date) = 2018;

-- MIN
SELECT MIN(total) AS 'Venta minima' from sales WHERE MONTH(date) = 1 AND YEAR(date) = 2018;
-- AVG - Promedio
SELECT AVG(total) AS 'Venta minima' from sales WHERE MONTH(date) = 1 AND YEAR(date) = 2018;
-- GROUP BY
-- SELECT @@sql_mode;
-- SELECT @@global.time_zone;
-- SELECT @@lc_time_names;
-- SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY,',''));
-- SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY,',''));
-- SET @@global.time_zone = '+00:00';

SELECT date, total FROM sales GROUP BY date;
SELECT date, SUM(total) as total FROM sales GROUP BY date;
SELECT  YEAR(date) as year,
        MONTH(date) as month,
        DAY(date) as day,
        SUM(total) as total
from sales
GROUP BY year, month;
SELECT  YEAR(date) as year,
        MONTH(date) as month,
        DAY(date) as day,
        MAX(total) as maximo
from sales
GROUP BY year, month;
SELECT  YEAR(date) as year,
        MONTH(date) as month,
        -- DAY(date) as day,
        MIN(total) as minimo
from sales
GROUP BY year, month;

SELECT  YEAR(date) as year,
        MONTH(date) as month,
        -- DAY(date) as day,
        AVG(total) as promedio
from sales
GROUP BY year, month;

SELECT  YEAR(date) as year,
        MONTH(date) as month,
        -- DAY(date) as day,
        sum(total) as total
from sales
WHERE client_id = 1
GROUP BY year, month;

@SET lc_time_names = 'es_ES';
SELECT  YEAR(date) as year,
        MONTH(date) as month,
        MONTHNAME(date) as monthname,
        -- DAY(date) as day,
        sum(total) as total,
        MAX(total) as maximo,
        MIN(total) as minimo,
        AVG(total) as promedio,
        COUNT(id) as operaciones
from sales
WHERE client_id = 1
GROUP BY year, month;

-- JOIN
-- Implicit JOIN
-- Desventaja si falta un dato, el registro no se muestra completo
-- Siempre se recomienda los JOINS
SELECT s.date, s.invoice, s.client_id, c.name, s.total
FROM sales AS s, clients AS c
WHERE s.client_id = c.id;

SELECT
        s.date AS Fecha,
        s.invoice AS Factura,
        s.client_id AS Cliente,
        c.name AS `Nombre de cliente`,
        s.total AS total
FROM sales AS s, clients AS c
WHERE s.client_id = c.id
LIMIT 10;

SELECT  s.client_id AS Cliente,
        c.name AS `Nombre de cliente`,
        s.invoice AS Factura,
        s.date AS fecha,
        ds.product_id,
        p.name AS `Nombre de producto`,
        p.color AS color,
        ds.amount AS cantidad,
        ds.price AS precio,
        pr.name as `Nombre de proveedor`
FROM clients AS c, sales AS s, detail_sales as ds, products AS p, providers AS pr
WHERE     s.client_id   = c.id
      AND ds.product_id = p.id
      AND ds.sale_id   = s.id
      AND p.provider_id = pr.id;

SHOW VARIABLES LIKE "secure_file_priv";
SELECT  s.client_id AS Cliente,
        c.name AS `Nombre de cliente`,
        s.invoice AS Factura,
        s.date AS fecha,
        ds.product_id,
        p.name AS `Nombre de producto`,
        p.color AS color,
        ds.amount AS cantidad,
        ds.price AS precio,
        pr.name as `Nombre de proveedor`
FROM clients AS c, sales AS s, detail_sales as ds, products AS p, providers AS pr
WHERE     s.client_id   = c.id
      AND ds.product_id = p.id
      AND ds.sale_id   = s.id
      AND p.provider_id = pr.id
INTO OUTFILE '/var/lib/mysql-files/my-select.csv' FIELDS TERMINATED BY ','LINES TERMINATED BY '\n';
sudo cat /var/lib/mysql-files/my-select.csv
