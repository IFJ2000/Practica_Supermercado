CREATE SCHEMA supermercado;
use supermercado;

CREATE TABLE productos(
idProducto INTEGER(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
nombreProducto VARCHAR(50) NOT NULL,
precio NUMERIC(7,2) NOT NULL,
descripcion VARCHAR(300) NOT NULL,
cantidad NUMERIC(5) NOT NULL

);

CREATE TABLE usuarios(
usuario VARCHAR(12) NOT NULL,
contraseña VARCHAR(280) NOT NULL,
fechaNacimiento DATE NOT NULL

);

CREATE TABLE cestas(
idCestas INTEGER(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
usuario VARCHAR(12) NOT NULL,
precioTotal DATE NOT NULL


);

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
        ADD COLUMN rol VARCHAR(10);
    ALTER TABLE usuarios
        DROP COLUMN rol;

        /* EL ROL SERA ADMIN O CLIENTE */
        /* Cuando se registre un usuario, su rol sera siempre cliente */
        /* Manualmente modificaremos un usuario para que sea admin y unicamente ese usuario con rol podra ver la pagina de crear productos */

        /* IDEA:
        Cuando se logee un usuario, almacenar en $_SESSION el rol
        Preguntaremos en la pagina de crear usuarios si $_SESSION["rol"] == admin, si lo es dejamos ver la pagina,
        si no, redirigimos a la pagina principal */
    