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




DROP TABLE IF EXISTS students;

CREATE TABLE IF NOT EXISTS students(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL DEFAULT '',

  CONSTRAINT pk_students_id PRIMARY KEY (id)
)
ENGINE = InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci
COMMENT '';

INSERT INTO students VALUES
(1,'Pedro'),
(2,'Marcos'),
(3,'Pablo'),
(4,'Mario');





DROP TABLE IF EXISTS courses;

CREATE TABLE IF NOT EXISTS courses (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  subject_id INT UNSIGNED NOT NULL,
  student_id INT UNSIGNED NOT NULL,
  score TINYINT UNSIGNED NOT NULL DEFAULT 0,

  CONSTRAINT pk_courses_id PRIMARY KEY (id)
)
ENGINE = InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci
COMMENT '';

INSERT INTO courses VALUES
(1,1,1,5),
(2,1,2,3),
(3,1,6,7);

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

-- not in / in
-- Clientes que me han comprado

SELECT DISTINCT(client_id) FROM sales;

SELECT id AS 'No. cliente', name as 'Nombre cliente' FROM clients WHERE id NOT IN (SELECT DISTINCT(client_id) FROM sales);

SELECT id AS 'No. cliente', name as 'Nombre cliente' FROM clients WHERE id NOT IN (SELECT DISTINCT(client_id) FROM sales WHERE date >= '2018-02-01' AND date <= '2018-03-01');

SELECT id AS 'No. cliente', name as 'Nombre cliente' FROM clients WHERE id NOT IN (SELECT DISTINCT(client_id) FROM sales WHERE date >= '2018-02-01' AND date <= '2018-03-01') ORDER BY id ASC;

SELECT id, name FROM products WHERE status IN (0,1);

-- Productos no vendidos
SELECT id, name FROM products WHERE id NOT IN (SELECT product_id FROM detail_sales);

SELECT id, name FROM products WHERE id NOT IN (SELECT DISTINCT product_id FROM detail_sales);

SELECT id, name FROM products WHERE id NOT IN (SELECT DISTINCT product_id FROM detail_sales, sales WHERE detail_sales.sale_id = sales.id AND sales.date > '2018-01-01');

-- Between
SELECT date, client_id, total FROM sales WHERE date BETWEEN '2018-01-01' AND '2018-01-04';

SELECT date, client_id, total FROM sales WHERE date BETWEEN '2018-01-01' AND '2018-01-04';
SELECT date, client_id, total FROM sales WHERE date BETWEEN 2 AND 100;

-- LIKE for strings

SELECT id, detail, color FROM products
WHERE detail LIKE 'p';

-- LIKE meta caracteres

SELECT id, detail, color FROM products
WHERE detail LIKE 'ad%';

SELECT id, name, color FROM products
WHERE name LIKE 'ad%';

SELECT id, name, color FROM products
WHERE name LIKE '%ad';

SELECT id, name, color FROM products
WHERE name LIKE '%ad%';

SELECT id, name, color FROM products
WHERE name LIKE '_d%';

SELECT id, name, color FROM products
WHERE CONCAT(name, color) LIKE '%ad%';

-- JOIN = INNER JOIN

SELECT s.date, s.invoice, s.client_id, c.name, ds.product_id, p.name, p.provider_id, pr.name, ds.amount, ds.price, (ds.amount*ds.price) AS partial
FROM sales AS s
JOIN detail_sales AS ds ON ds.sale_id = s.id
JOIN products AS p ON p.id = ds.product_id
JOIN providers AS pr ON pr.id = p.provider_id
JOIN clients AS c ON c.id = s.client_id;

-- joins

SELECT s.name, c.id, c.subject_id, c.student_id, c.score
FROM students AS s
LEFT JOIN courses AS c ON c.student_id = s.id;

SELECT s.name, c.id, c.subject_id, c.student_id, c.score
FROM students AS s
JOIN courses AS c ON c.student_id = s.id;

SELECT s.id, s.name, c.id, c.subject_id, c.student_id, c.score
FROM students AS s
RIGHT JOIN courses AS c ON c.student_id = s.id;

-- FULL JOIN
SELECT s.id, s.name, c.id, c.subject_id, c.student_id, c.score
FROM students AS s
LEFT JOIN courses AS c ON c.student_id = s.id
UNION
SELECT s.id, s.name, c.id, c.subject_id, c.student_id, c.score
FROM students AS s
RIGHT JOIN courses AS c ON c.student_id = s.id;

SELECT id, name, IF(status=1, 'Habilitado','Deshabilitado') as status FROM products;

-- Funciones MySQL - IF - CASE, always case

SELECT
        id,
        name,
        CASE
              WHEN status = 0 THEN 'Habilitado'
              WHEN status = 1 THEN 'Deshabilitado'
              WHEN status = 2 THEN 'Otro estado'
              ELSE 'No deberia haber un else'
        END
AS status
FROM products;

SELECT
        id,
        name,
        CASE status
              WHEN 0 THEN 'Habilitado'
              WHEN 1 THEN 'Deshabilitado'
              WHEN 2 THEN 'Otro estado'
              ELSE 'No deberia haber un else'
        END
AS status
FROM products;

-- SUBSTRING

SELECT id, name, SUBSTR(name, 1, 1) start_width
FROM products;

SELECT id, name,  CASE SUBSTR(name, 1, 1)
                  WHEN 'A' THEN 'Letra A'
                  WHEN 'B' THEN 'Letra B'
                  END
FROM products;

SELECT id, name,  UCASE(  CASE SUBSTR(name, 1, 1)
                          WHEN 'A' THEN 'Letra A'
                          WHEN 'B' THEN 'Letra B'
                          END)
FROM products;

-- fECHAS

SELECT CURRENT_DATE;
SELECT CURRENT_TIME;
SELECT CURRENT_TIMESTAMP;
SELECT NOW();
SELECT DATABASE();
SELECT DATEDIFF('2018-06-01','2018-01-01');
SELECT DATEDIFF(NOW(),'2018-01-01');
SELECT DAYOFWEEK(NOW());

-- inserts

INSERT INTO students (name) VALUES ('Alumno 1');

INSERT IGNORE INTO table(column_list)
VALUES( value_list),
      ( value_list),

INSERT INTO table_name(c1)
VALUES(c1)
ON DUPLICATE KEY UPDATE c1 = VALUES(c1) + 1;

-- UPDATE

UPDATE

-- DELETE

DELETE

-- Traer fechas, números de facturas y monto total de las ventas

SELECT date, invoice, total FROM sales;

-- Traer los id de productos, cantidad y precio del detalle de ventas de los registros donde el precio sea mayor a cero

SELECT product_id, amount, price FROM detail_sales WHERE price > 0;

-- Traer el total vendido por fecha de factura

SELECT date, sum(total) as total FROM sales GROUP BY date;

-- Traer el total vendido por año y mes de factura
SELECT MONTH(date) as month, YEAR(date) as year, SUM(total) as total FROM sales GROUP BY month, year;

-- Traer los productos de la tabla productos que pertenezcan al proveedor 62
SELECT name, detail, color, status, price, stock, discount, provider_id FROM products WHERE provider_id=62;
