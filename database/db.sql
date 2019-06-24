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
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  sale_id BIGINT(20) UNSIGNED NOT NULL DEFAULT 0,
  product_id MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0,
  amount MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  CONSTRAINT pk_detail_sales_id PRIMARY KEY(id),
  KEY ik_detail_sales_sale_id (sale_id),
  KEY ik_detail_sales_product_id (product_id)
)
ENGINE = InnoDB
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci
COMMENT ''; -- 55013