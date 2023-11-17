CREATE SCHEMA supermercado;
use supermercado;

CREATE TABLE productos(
idProducto INTEGER(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
nombreProducto VARCHAR(50) NOT NULL,
precio NUMERIC(7,2) NOT NULL,
descripcion VARCHAR(300) NOT NULL,
cantidad NUMERIC(5) NOT NULL,
imagen VARCHAR(100) NOT NULL
);
DROP TABLE productos;

CREATE TABLE usuarios(
usuario VARCHAR(12) NOT NULL,
contraseña VARCHAR(280) NOT NULL,
fechaNacimiento DATE NOT NULL

);
SELECT * FROM usuarios;
DROP TABLE cestas;
SELECT * FROM usuarios;
INSERT INTO usuarios (usuario, contraseña, fechaNacimiento, rol) VALUES('paco','$2y$10$ES1i8CUhCTXFTjkIMhmCjuYNvTOAj0A9kotYoGAtDJhmtieFG63Uq','200-02-02','admin');

CREATE TABLE cestas(
idCesta INTEGER(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
usuario VARCHAR(12) NOT NULL,
precioTotal  NUMERIC(7,2) NOT NULL


);
DROP TABLE cestas;

CREATE TABLE productosCestas(
idProducto INT,
idCesta INT,
cantidad NUMERIC(2),
CONSTRAINT pk_productosCestas
	PRIMARY KEY (idProducto, idCesta),
CONSTRAINT fk_productosCestas_productos
	FOREIGN KEY (idProducto)
    REFERENCES productos(idProducto),
    CONSTRAINT fk_productosCestas_cestas
    FOREIGN KEY (idCesta)
    REFERENCES cestas(idCesta)
);



/* ESOT NO TIENE NADA QUE VER ES PARA METER LA IMAGEN


USE db_videojuegos;
ALTER TABLE videojuegos
	ADD COLUMN imagen VARCHAR(100);
    
    DELETE FROM videojuegos WHERE id_videojuegos <7;
    
    set SQL_SAFE_UPDATES =0; */


    

    /* AÑADIR ROLES */
    ALTER TABLE usuarios 
        ADD COLUMN rol VARCHAR(10) DEFAULT "cliente";
    ALTER TABLE usuarios
        DROP COLUMN rol;
        
        UPDATE usuarios SET rol = 'admin' WHERE usuario = 'ignacio'; 
SELECT * FROM usuarios;
        /* EL ROL SERA ADMIN O CLIENTE */
        /* Cuando se registre un usuario, su rol sera siempre cliente */
        /* Manualmente modificaremos un usuario para que sea admin y unicamente ese usuario con rol podra ver la pagina de crear productos */

        /* IDEA:
        Cuando se logee un usuario, almacenar en $_SESSION el rol
        Preguntaremos en la pagina de crear usuarios si $_SESSION["rol"] == admin, si lo es dejamos ver la pagina,
        si no, redirigimos a la pagina principal */
    