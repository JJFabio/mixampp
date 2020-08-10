-- Tabla Usuarios 
CREATE TABLE usuarios(
ID INT (10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(75) NOT NULL,
password VARCHAR(100)NOT NULL,
last_IP VARCHAR(50) DEFAULT "0.0.0.0"
);

-- Usuarios 
-- john@hotmail.com 1234
-- fabio@hotmail.es 1234
-- pedro@predro.com 1234
-- juan@juanes.com 1234
-- tania@tanias.tic 1234
INSERT INTO `usuarios` (`ID`, `email`, `password`, `last_IP`) VALUES 
(NULL, 'john@hotmail.com', '1234', '0.0.0.0'), 
(NULL, 'fabio@hotmail.es', '1234', '0.0.0.0'), 
(NULL, 'pedro@predro.com', '1234', '0.0.0.0'), 
(NULL, 'tania@tanias.tic', '1234', '0.0.0.0');
-- Tabla Clientes
CREATE TABLE clientes(
ID 				 INT(10)	NOT NULL AUTO_INCREMENT PRIMARY KEY,
ID_usuario		 INT(10)		NOT NULL,
company_name	 VARCHAR(50)	NOT NULL,
company_addresss  VARCHAR(200),
company_phone	 VARCHAR(20),
company_NIF		 CHAR(9),
contact_name	 VARCHAR(100),
contact_phone	 VARCHAR(20),
contact_email	 VARCHAR(100),
created			 DATE,
FOREIGN KEY (ID_usuario) REFERENCES usuarios(ID) ON DELETE CASCADE ON UPDATE CASCADE
);



-- Tabla tickets
CREATE TABLE ticket(
ID 			 INT(10) 	NOT NULL AUTO_INCREMENT PRIMARY KEY,
ID_CLIENTE	 INT(10) 	NOT NULL,
sunto		 VARCHAR(50) NOT NULL,
estado		 ENUM('abierto', 'cerrado', 'conseguido', 'no conseguido'),
created		 DATE,
FOREIGN KEY (ID_cliente) REFERENCES clientes(ID) ON DELETE CASCADE
);

-- Tabla Acciones
CREATE TABLE acciones(
ID			 INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
ID_ticket	 INT(10) NOT NULL,
texto		 VARCHAR(140) NOT NULL,
created		 DATE,
FOREIGN KEY (ID_ticket) REFERENCES ticket(ID) ON DELETE CASCADE
);

-- Clave foranea
-- Clave principal

-- Mi primera vista de ejemplo
CREATE VIEW ejemplo AS SELECT email, password FROM usuarios;

-- Tickets abiertos 
CREATE VIEW tickets_abiertos AS SELECT ID_cliente, asunto, estado, created FROM ticket WHERE estado = "abierto";

-- Usuarios con clientes
CREATE VIEW usuarios_con_clientes AS SELECT ID, email, password FROM usuarios WHERE (SELECT COUNT(*)FROM clientes WHERE clientes.ID_usuario=usuarios.ID) > 0;

-- Usuarios sin clientes
CREATE VIEW usuarios_sin_clientes AS SELECT ID, email, password FROM usuarios WHERE (SELECT COUNT(*)FROM clientes WHERE clientes.ID_usuario=usuarios.ID) = 0;

-- Modificar tablas
ALTER TABLE usuarios ADD nombre_empresa VARCHAR(100) DEFAULT "Sin Nombre";

-- Agregar varias columnas
ALTER TABLE usuarios ADD cif VARCHAR(30), ADD pais VARCHAR(50) NOT NULL DEFAULT "España";

ALTER TABLE usuarios 
	MODIFY COLUMN nombre_empresa VARCHAR(150) DEFAULT "No name";

ALTER TABLE usuarios 
	MODIFY COLUMN cif VARCHAR(50),
	MODIFY COLUMN pais VARCHAR(100) NOT NULL DEFAULT "USA";

ALTER TABLE usuarios 
	DROP COLUMN nombre_empresa;

ALTER TABLE usuarios 
	DROP COLUMN cif, DROP COLUMN pais;

-- CREAR USUARIO

-- FORMA Básica
CREATE USER 'usuario1';

-- Indicándole "localhost"
CREATE USER 'usuario2'@'localhost';

-- Indicándole "%"
CREATE USER 'usuario3'@'%';
CREATE USER 'usuario3'@'localhost';

-- Usuario con contraseña
CREATE USER 'boluda'@'localhost' IDENTIFIED BY 'boludenses';
CREATE USER 'usuario4'@'145.121.12.20' IDENTIFIED BY '123456';

-- ELIMINAR USUARIOS
DROP USER 'usuario2'@'localhost';
DROP USER 'usuario4'@'localhost';
DROP USER 'usuario4'@'145.121.12.20';

-- PRIVILEGIOS 
GRANT USAGE 
	ON *.* TO 'boluda'@'%' 
	REQUIRE NONE 
	WITH 
		MAX_QUERIES_PER_HOUR 10 
		MAX_CONNECTIONS_PER_HOUR 10 
		MAX_UPDATES_PER_HOUR 0 
		MAX_USER_CONNECTIONS 5;




-- CREAR BASE DE DATOS
CREATE DATABASE keinas_prueba1;
CREATE DATABASE keinas_prueba1 CHARACTER SET utf8;

-- PRIVILEGIOS
-- GRANT SELECT ON base de datos.tabla TO 'USUARIO'@'localhost';
GRANT SELECT ON keinas.usuarios TO 'jaime'@'localhost';

GRANT SELECT, UPDATE ON keinas.usuarios TO 'jaime'@'localhost';

REVOKE UPDATE ON keinas.usuarios FROM 'jaime'@'localhost';

GRANT SELECT, UPDATE ON keinas.* TO 'jaime'@'localhost';

REVOKE ALL PRIVILEGES, GRANT OPTION FROM 'jaime'@'localhost';

-- Comando más usado
GRANT ALL PRIVILEGES ON keinas.* TO 'jaime'@'localhost';


-- COPIAS DE SEGURIDAD

-- mysqldump.exe --user usuario --password basededatos > copia.sql
mysqldump.exe --user fabio --password keinas > keinas_copia.sql

SELECT SUM(facturacion_mes) FROM clientes
SELECT SUM(facturacion_mes) as total_suma FROM clientes

SELECT SUM(facturacion_mes)*1.21 as total_suma FROM clientes
SELECT SUM(facturacion_mes)/1.21 as total_suma FROM clientes
SELECT SUM(facturacion_mes)+1.21 as total_suma FROM clientes
SELECT SUM(facturacion_mes)-1.21 as total_suma FROM clientes
-- ROUND
SELECT ROUND(223423,2)*1.21 as total_suma FROM clientes
SELECT ROUND(SUM(facturacion_mes)*1.21) as total_suma FROM clientes

-- SUMAR + WHERE
SELECT SUM(facturacion_mes) as total_suma FROM clientes WHERE ID_usuario=10

-- AVG
SELECT AVG(facturacion_mes) as media FROM clientes

-- COUNT 
SELECT COUNT(*) as total_filas FROM clientes

-- Subconsulta: Tiene algún cliente
SELECT ID, email, password FROM usuarios 
	WHERE (SELECT COUNT(*) FROM clientes WHERE ID_usuario=usuarios.ID ) > 0

-- Subconsulta: 700€
SELECT ID, email, password FROM usuarios 
	WHERE (SELECT SUM(facturacion_mes) FROM clientes WHERE ID_usuario=usuarios.ID)