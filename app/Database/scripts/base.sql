CREATE DATABASE TIENDITA;
USE TIENDITA;

-- ubigeo/*
CREATE TABLE departamentos (
  id      CHAR(2) PRIMARY KEY,
  name    VARCHAR(100) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

CREATE TABLE provincias (
  id              CHAR(4) PRIMARY KEY,
  departamento_id CHAR(2) NOT NULL,
  name            VARCHAR(100) NOT NULL,
  FOREIGN KEY (departamento_id) REFERENCES departamentos(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

CREATE TABLE distritos (
  id           CHAR(6) PRIMARY KEY,
  provincia_id CHAR(4) NOT NULL,
  name         VARCHAR(120) NOT NULL,
  FOREIGN KEY (provincia_id) REFERENCES provincias(id)
) ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;
-- */ubigeo

-- mantenimiento/*
CREATE TABLE tipo_doi(
	id					BIGINT AUTO_INCREMENT PRIMARY KEY,
	nombre			VARCHAR(70) NOT NULL,
	num_digitos 	INT NOT NULL,
	created_at		DATETIME NULL,
	updated_at		DATETIME NULL,
	deleted_at		DATETIME NULL
)ENGINE=INNODB;

CREATE TABLE cat_productos(
	id					BIGINT AUTO_INCREMENT PRIMARY KEY,
	nombre 		 	VARCHAR(70) NOT NULL,
	descripcion		TEXT NULL,
	created_at		DATETIME NULL,
	updated_at		DATETIME NULL,
	deleted_at		DATETIME NULL
)ENGINE=INNODB;
-- */mantenimiento

CREATE TABLE usuarios(
	id              BIGINT AUTO_INCREMENT PRIMARY KEY,
	UUID            CHAR(36) NULL,
	nombres         VARCHAR(255) NOT NULL,
	apellidos       VARCHAR(255) NOT NULL,
	username        VARCHAR(70) NOT NULL,
	userpass        VARCHAR(255) NOT NULL,
	premium         BOOLEAN DEFAULT FALSE,
	rol             ENUM('CLIENTE', 'VENDEDOR'),
	created_at      DATETIME NULL,
	updated_at      DATETIME NULL,
	deleted_at      DATETIME NULL
) ENGINE=INNODB;

CREATE TABLE clientes(
	id					BIGINT AUTO_INCREMENT PRIMARY KEY,
	UUID 				CHAR(36) NULL,
	usuario_id  	BIGINT NOT NULL,
	email 			VARCHAR(70) NOT NULL,
  	telefono    	VARCHAR(12) NULL,
  	tipo_doi_id 	BIGINT NOT NULL, 
  	num_doi 			VARCHAR(45) NOT NULL,
  	saldo 			DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  	created_at		DATETIME NULL,
	updated_at		DATETIME NULL,
	deleted_at		DATETIME NULL,
  	FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
   FOREIGN KEY (tipo_doi_id) REFERENCES tipo_doi(id)
)ENGINE=INNODB;

CREATE TABLE vendedores(
	id						BIGINT AUTO_INCREMENT PRIMARY KEY,
	UUID 					CHAR(36) NULL,
	usuario_id  		BIGINT NOT NULL,
	email 				VARCHAR(70) NOT NULL,
	ruc					CHAR(11) NOT NULL,
	telefono    		VARCHAR(12) NULL,
	nombre_tienda 		VARCHAR(255) NOT NULL,
	descripcion 		TEXT NOT NULL,
  	created_at			DATETIME NULL,
	updated_at			DATETIME NULL,
	deleted_at			DATETIME NULL,
	FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)ENGINE=INNODB;

CREATE TABLE direcciones(
	id					BIGINT AUTO_INCREMENT PRIMARY KEY,
	cliente_id		BIGINT NULL,
	vendedor_id    BIGINT NULL,
	ubigeo		   CHAR(6) NOT NULL,
	direccion		TEXT NOT NULL,
	referencia		TEXT NULL,
	lat 				DECIMAL(10,8) NULL,
	lng 				DECIMAL(11,8) NULL, 
	created_at		DATETIME NULL,
	updated_at		DATETIME NULL,
	deleted_at		DATETIME NULL,
	FOREIGN KEY (ubigeo) REFERENCES distritos(id),
	FOREIGN KEY (cliente_id) REFERENCES clientes(id),
	FOREIGN KEY (vendedor_id) REFERENCES vendedores(id)
)ENGINE=INNODB;

CREATE TABLE productos(
	id 				BIGINT AUTO_INCREMENT PRIMARY KEY,
	nombre 			VARCHAR(150) NOT NULL,
	imagen 			TEXT NULL,
	descripcion 	TEXT NOT NULL,
	precio 			DECIMAL(7,2) NOT NULL,
	descuento 		INT NULL,
	categoria_id	BIGINT NOT NULL,
	vendedor_id    BIGINT NOT NULL,
	created_at		DATETIME NULL,
	updated_at		DATETIME NULL,
	deleted_at		DATETIME NULL,
	FOREIGN KEY (categoria_id) REFERENCES cat_productos(id),
	FOREIGN KEY (vendedor_id) REFERENCES vendedores(id)
)ENGINE=INNODB;

CREATE TABLE ventas (
    id              BIGINT AUTO_INCREMENT PRIMARY KEY,
    cliente_id      BIGINT NOT NULL,
    direccion_id    BIGINT NOT NULL,
    total           DECIMAL(10,2) NOT NULL,
    created_at      DATETIME NULL,
    updated_at      DATETIME NULL,
    deleted_at      DATETIME NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (direccion_id) REFERENCES direcciones(id)
) ENGINE=INNODB;

/* Nota: No es necesario los campos de auditoria en una tabla de detalle, 
	pues están ligadas a una cabereca (Ventas) quien ya tiene campos de auditoria (created_at, updated_at, deleted_at)
	
	A menos de que se traté de un proyecto muy riguroso, los campos de autoria en la tabla detalle_venta podrian setearse
	dependiendo del comportamiento que tenga el carrito de compras, asi sabriamos:
	- Cuando un cliente agregó un producto a su carrito
	- Cuando actualizó la cantidad de un producto
	- Cuando retiro un producto de su carrito
	
	Detalle meticulosos que quizás sirvan en un proyecto con mayor trazabilidad.
*/
CREATE TABLE detalle_venta (
    id              BIGINT AUTO_INCREMENT PRIMARY KEY,
    venta_id        BIGINT NOT NULL,
    producto_id     BIGINT NOT NULL,
    cantidad        INT NOT NULL,
    precio_unitario DECIMAL(7,2) NOT NULL,
    subtotal        DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (venta_id) REFERENCES ventas(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
) ENGINE=INNODB;