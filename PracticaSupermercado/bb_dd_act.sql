CREATE SCHEMA usuarios;
USE usuarios;

DROP TABLE usuarios;
CREATE TABLE usuarios (
usuario VARCHAR(8) PRIMARY KEY,
nombre VARCHAR(20) NOT NULL,
apellidos VARCHAR(40) NOT NULL,
fecha_naci DATE NOT NULL
);

SELECT * FROM usuarios;

CREATE SCHEMA db_videojuegos;
USE db_videojuegos;

CREATE TABLE videojuegos(
id_videojuego NUMERIC(8),
titulo VARCHAR(100) NOT NULL,
pegi VARCHAR(2) NOT NULL,
compania VARCHAR(50) NOT NULL,
CONSTRAINT chk_pegi CHECK (pegi IN ('3','7','12','16','18'))
);

SELECT * FROM videojuegos;

DROP TABLE videojuegos;


CREATE SCHEMA db_login;
USE db_login;
select * from usuarios;
drop table usuarios;

CREATE TABLE usuarios(
usuario VARCHAR(20) PRIMARY KEY,
contrasena varchar(255) NOT NULL
);


USE db_videojuegos;
ALTER TABLE videojuegos
	ADD COLUMN imagen VARCHAR(100);
    
    DELETE FROM videojuegos WHERE id_videojuegos <7;
    
    set SQL_SAFE_UPDATES =0;