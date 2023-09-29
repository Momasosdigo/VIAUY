DROP DATABASE Viauy;
CREATE DATABASE Viauy;
USE Viauy;

CREATE TABLE omnibus(
    matricula VARCHAR(10) PRIMARY KEY NOT NULL,
    numOmnibus INT(5) NOT NULL,
    cantidadAsientos INT(3) NOT NULL,
    marca VARCHAR(20),
    modelo VARCHAR(20),
    pisos INT(2) NOT NULL,
    activo BOOLEAN DEFAULT true
);

CREATE TABLE linea(
    nombreLinea VARCHAR(10) PRIMARY KEY NOT NULL,
    activo BOOLEAN DEFAULT true
);

CREATE TABLE asiento(
    idAsiento INT(2) NOT NULL,
    estado VARCHAR(10) NOT NULL,
    matriculaAsiento VARCHAR(10) NOT NULL,
    PRIMARY KEY (idAsiento, matriculaAsiento),
    CONSTRAINT FOREIGN KEY (matriculaAsiento) REFERENCES omnibus(matricula) ON UPDATE CASCADE
);

CREATE TABLE usuario(
    idUsuario VARCHAR(8) PRIMARY KEY NOT NULL,
    contraseña VARCHAR(64) NOT NULL
);

CREATE TABLE cliente(
    idUsuarioCliente VARCHAR(8) PRIMARY KEY NOT NULL,
    gmail VARCHAR(100) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    CONSTRAINT FOREIGN KEY (idUsuarioCliente) REFERENCES usuario(idUsuario)
);

CREATE TABLE backOffice(
    idUsuarioBack VARCHAR(8) PRIMARY KEY NOT NULL,
    nombreBack VARCHAR(30) NOT NULL,
    apellidoBack VARCHAR(30) NOT NULL,
    activo BOOLEAN DEFAULT true,
    CONSTRAINT FOREIGN KEY (idUsuarioBack) REFERENCES usuario(idUsuario) ON UPDATE CASCADE
);

CREATE TABLE administrador(
    idUsuarioAdmi VARCHAR(8) PRIMARY KEY NOT NULL,
    CONSTRAINT FOREIGN KEY (idUsuarioAdmi) REFERENCES usuario(idUsuario)
);

CREATE TABLE recorrido(
    idRecorrido VARCHAR(10) PRIMARY KEY NOT NULL,
    precioTotal INT(4) NOT NULL,
    activo BOOLEAN DEFAULT true
);

CREATE TABLE parada(
    idParada INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    coordenadas VARCHAR(100) NOT NULL
);

CREATE TABLE tramo(
    sube INT(5) NOT NULL,
    baja INT(5) NOT NULL,
    PRIMARY KEY (sube, baja),
    CONSTRAINT FOREIGN KEY (sube) REFERENCES parada(idParada) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (baja) REFERENCES parada(idParada) ON UPDATE CASCADE
);

CREATE TABLE calendario(
    fechaHora datetime NOT NULL PRIMARY KEY
);

CREATE TABLE obtiene(
    idAsientoObtiene INT(2) NOT NULL,
    idUsuarioObtiene VARCHAR(30) NOT NULL,
    fechaHoraObtiene datetime NOT NULL,
    PRIMARY KEY (idAsientoObtiene, idUsuarioObtiene, fechaHoraObtiene),
    CONSTRAINT FOREIGN KEY (idAsientoObtiene) REFERENCES asiento(idAsiento) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (idUsuarioObtiene) REFERENCES usuario(idUsuario) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (fechaHoraObtiene) REFERENCES calendario(fechaHora) 
);

CREATE TABLE tiene(
    idParadaTiene INT(10) NOT NULL,
    idRecorridoTiene VARCHAR(10) NOT NULL,
    tipo VARCHAR(15) NOT NULL,
    numeroParada int(3) NOT NULL, 
    PRIMARY KEY (idParadaTiene, idRecorridoTiene),
    CONSTRAINT FOREIGN KEY (idParadaTiene) REFERENCES parada(idParada) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (idRecorridoTiene) REFERENCES recorrido(idRecorrido) ON UPDATE CASCADE
);

CREATE TABLE recorre(
    nombreLineaRecorre VARCHAR(10) NOT NULL,
    idRecorridoRecorre VARCHAR(10) NOT NULL,
    PRIMARY KEY (nombreLineaRecorre, idRecorridoRecorre),
    CONSTRAINT FOREIGN KEY (nombreLineaRecorre) REFERENCES linea(nombreLinea) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (idRecorridoRecorre) REFERENCES recorrido(idRecorrido) ON UPDATE CASCADE
);

CREATE TABLE pasa(
    horaPasa time NOT NULL,
    nombreLineaPasa VARCHAR(10) NOT NULL,
    idParadaPasa INT(10) NOT NULL,
    matriculaPasa VARCHAR(10) NOT NULL,
    PRIMARY KEY (idParadaPasa, horaPasa, matriculaPasa),
    CONSTRAINT FOREIGN KEY (nombreLineaPasa) REFERENCES linea(nombreLinea) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (matriculaPasa) REFERENCES omnibus(matricula) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (idParadaPasa) REFERENCES parada(idParada) ON UPDATE CASCADE
); 

CREATE TABLE elige(
    idUsuarioElige VARCHAR(8) NOT NULL,
    idAsientoElige INT(2) NOT NULL,
    fechaHoraElige datetime NOT NULL,
    subeElige INT(5) NOT NULL,
    bajaElige INT(5) NOT NULL,
    idRecorridoElige VARCHAR(10) NOT NULL,
    precioVariable INT(4) NOT NULL,
    PRIMARY KEY (idUsuarioElige, idAsientoElige, fechaHoraElige, subeElige, bajaElige, idRecorridoElige, precioVariable),
    CONSTRAINT FOREIGN KEY (idUsuarioElige, idAsientoElige, fechaHoraElige) REFERENCES obtiene(idUsuarioObtiene, idAsientoObtiene, fechaHoraObtiene),
    CONSTRAINT FOREIGN KEY (subeElige,bajaElige) REFERENCES tramo(sube, baja),
    CONSTRAINT FOREIGN KEY (idRecorridoElige) REFERENCES recorrido(idRecorrido) ON UPDATE CASCADE
);

CREATE TABLE gestiona(
    idUsuarioGestiona VARCHAR(8) NOT NULL,
    idRecorridoGestiona VARCHAR(10) NOT NULL,
    idParadaGestiona INT(10) NOT NULL,
    PRIMARY KEY (idUsuarioGestiona, idRecorridoGestiona, idParadaGestiona),
    CONSTRAINT FOREIGN KEY (idUsuarioGestiona) REFERENCES usuario(idUsuario),
    CONSTRAINT FOREIGN KEY (idRecorridoGestiona) REFERENCES recorrido(idRecorrido),
    CONSTRAINT FOREIGN KEY (idParadaGestiona) REFERENCES parada(idParada) 
);

CREATE TABLE admi(
    idUsuarioAdmi VARCHAR(8) NOT NULL,
    matriculaAdmi VARCHAR(10) NOT NULL,
    PRIMARY KEY (idUsuarioAdmi, matriculaAdmi),
    CONSTRAINT FOREIGN KEY (idUsuarioAdmi) REFERENCES usuario(idUsuario) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (matriculaAdmi) REFERENCES omnibus(matricula) ON UPDATE CASCADE
);

CREATE TABLE administra(
    idUsuarioAdministra VARCHAR(8) NOT NULL,
    nombreLineaAdministra VARCHAR(10) NOT NULL,
    PRIMARY KEY (idUsuarioAdministra, nombreLineaAdministra),
    CONSTRAINT FOREIGN KEY (idUsuarioAdministra) REFERENCES usuario(idUsuario) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (nombreLineaAdministra) REFERENCES linea(nombreLinea) ON UPDATE CASCADE
);

CREATE TABLE pertenece(
    matriculaPertenece VARCHAR(10) NOT NULL PRIMARY KEY,
    nombreLineaPertenece VARCHAR(10) NOT NULL,
    CONSTRAINT FOREIGN KEY (matriculaPertenece) REFERENCES omnibus(matricula) ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (nombreLineaPertenece) REFERENCES linea(nombreLinea) ON UPDATE CASCADE
);

INSERT INTO usuario(idUsuario, contraseña) VALUES ('root',SHA2('root',256));
INSERT INTO administrador (idUsuarioAdmi) VALUES ('root');

INSERT INTO parada (coordenadas)
VALUES 
    ('Montevideo, Montevideo'),
    ('Empalme rutas 1 y 3, San José'),
    ('San José, San José'),
    ('Trinidad, Flores'),
    ('Andresito, Flores'),
    ('Young, Río Negro'),
    ('Paysandú, Paysandú'),
    ('Constancia, Paysandú'),
    ('Empalme Quebracho, Paysandú'),
    ('Termas de Guaviyú, Paysandú'),
    ('Libertad, San José'),
    ('Fray Bentos, Río Negro'),
    ('Rincón del Pino, San José'),
    ('Ecilda Paullier, San José'),
    ('Colonia Valdense, Colonia'),
    ('Empalme rutas 1 y 2, Colonia'),
    ('Rosario, Colonia'),
    ('Cardona, Soriano'),
    ('José Enrique Rodó, Soriano'),
    ('Palmitas, Soriano'),
    ('Mercedes, Soriano'),
    ('Rafael Perazza, San José'),
    ('Guichón, Paysandú'),
    ('Playa Pascual, San José'),
    ('Algorta, Paysandú'),
    ('Termas de Almirón, Paysandú'),
    ('Rivera, Rivera'),
    ('Florida, Florida'),
    ('Durazno, Durazno'),
    ('Paso de los Toros, Tacuarembó'),
    ('Tacuarembó, Tacuarembó'),
    ('Carlos Reyles, Durazno'),
    ('Peralta, Tacuarembó'),
    ('Curtina, Tacuarembó'),
    ('Punta del Este, Maldonado'),
    ('Maldonado, Maldonado'),
    ('Piriápolis, Maldonado'),
    ('Atlántida, Canelones'),
    ('Canelones, Canelones'),
    ('Santa Lucía, Canelones'),
    ('25 de agosto, Florida'),
    ('Colonia Etchepare, San José'),
    ('Ituzaingó, San José'),
    ('Empalme rutas 3 y 26, Paysandú'),
    ('Chapicuy, Paysandú'),
    ('Termas del Daymán, Salto'),
    ('Piedras Coloradas, Paysandú'),
    ('Merinos, Paysandú'),
    ('Tres Árboles, Río Negro'),
    ('Piedra Sola, Paysandú'),
    ('Tambores, Tacuarembó'),
    ('Dolores, Soriano'),
    ('Barker, Colonia'),
    ('Miguelete, Colonia'),
    ('Empalme rutas 12 y 55, Colonia'),
    ('Ombúes de Lavalle, Colonia'),
    ('Empalme rutas 12 y 96, Colonia'),
    ('Empalme rutas 12 y 54, Soriano'),
    ('Nueva Palmira, Colonia'),
    ('Tarariras, Colonia'),
    ('Carmelo, Colonia'),
    ('Empalme rutas 1 y 54, Colonia'),
    ('Empalme rutas 1 y 22, Colonia'),
    ('Sarandí Grande, Florida'),
    ('Manuel Díaz, Rivera'),
    ('Empalme rutas 5 y 30, Rivera'),
    ('Colonia, Colonia'),
    ('Bella Unión, Artigas'),
    ('Empalme Nuevo Berlín, Río Negro'),
    ('Migues, Canelones'),
    ('Tala, Canelones'),
    ('San Ramón, Canelones'),
    ('Gregorio Aznárez, Maldonado'),
    ('Empalme rutas 8 y 9, Canelones'),
    ('Zapicán, Lavalleja'),
    ('Pando, Canelones'),
    ('San Jacinto, Canelones'),
    ('Fray Marcos, Florida'),
    ('Casupá, Florida'),
    ('Reboledo, Florida'),
    ('José Batlle y Ordóñez, Lavalleja'),
    ('Empalme rutas 6 y 7, Canelones'),
    ('Las Piedras, Canelones'),
    ('Independencia, Florida'),
    ('Cardal, Florida'),
    ('25 de mayo, Florida'),
    ('Berrondo, Florida'),
    ('Puntas de Valdez, San José'),
    ('Empalme rutas 11 y 45, San José'),
    ('Villa Rodríguez, San José'),
    ('Artigas, Artigas'),
    ('Colonia Itapebí, Salto'),
    ('Puntas de Valentín, Salto'),
    ('Pueblo Lavalleja, Salto'),
    ('Sequeira, Artigas'),
    ('Paso Campamento, Artigas'),
    ('Nueva Helvecia, Colonia'),
    ('Piñera, Paysandú'),
    ('Aeropuerto Internacional de Carrasco, Canelones'),
    ('Jaureguiberry, Canelones'),
    ('Playa Hermosa, Maldonado'),
    ('Aeropuerto Internacional de Laguna del Sauce, Maldonado'),
    ('Punta Ballena, Maldonado'),
    ('Las Flores, Maldonado'),
    ('Araminda, Canelones'),
    ('Santa Lucía del Este, Canelones'),
    ('Cuchilla Alta, Canelones'),
    ('Santa Ana, Canelones'),
    ('Punta Negra, Maldonado'),
    ('Punta Colorada, Maldonado'),
    ('Laguna Garzón, Maldonado'),
    ('La Barra, Maldonado'),
    ('Manantiales, Maldonado'),
    ('José Ignacio, Maldonado'),
    ('Empalme rutas 5 y 43, Tacuarembó'),
    ('Tranqueras, Rivera'),
    ('Minas, Lavalleja'),
    ('Soca, Canelones'),
    ('Solís de Mataojo, Lavalleja'),
    ('Chuy, Rocha'),
    ('Pan de Azúcar, Maldonado'),
    ('San Carlos, Maldonado'),
    ('Garzón, Maldonado'),
    ('Rocha, Rocha'),
    ('19 de abril, Rocha'),
    ('Castillos, Rocha'),
    ('Empalme Punta del Diablo, Rocha'),
    ('Punta del Diablo, Rocha'),
    ('Fortaleza de Santa Teresa, Rocha'),
    ('La Coronilla, Rocha'),
    ('La Pedrera, Rocha'),
    ('La Paloma, Rocha'),
    ('Empalme Belén, Salto'),
    ('Tomás Gomensoro, Artigas'),
    ('Paso Farías, Artigas'),
    ('Javier de Viana, Artigas'),
    ('Termas del Arapey, Salto'),
    ('Baltasar Brum, Artigas'),
    ('Diego Lamas, Artigas'),
    ('Cuaró, Artigas'),
    ('Juan Soler, San José'),
    ('Ismael Cortinas, Flores'),
    ('Mal Abrigo, San José'),
    ('Cebollatí, Rocha'),
    ('Aiguá, Maldonado'),
    ('Velazquez, Rocha'),
    ('Lascano, Rocha'),
    ('San Luis, Rocha'),
    ('Treinta y Tres, Treinta y Tres'),
    ('Colón, Lavalleja'),
    ('Mariscala, Lavalleja'),
    ('Piraraja, Lavalleja'),
    ('José Pedro Varela, Lavalleja'),
    ('Río Branco, Cerro Largo'),
    ('Vergara, Treinta y Tres'),
    ('Rincón, Cerro Largo'),
    ('Buenos Aires, Buenos Aires'),
    ('Melo, Cerro Largo'),
    ('Cerro Colorado, Florida'),
    ('Valentines, Florida'),
    ('Cerro Chato, Florida'),
    ('Santa Clara, Treinta y Tres'),
    ('Tupambaé, Cerro Largo'),
    ('Fraile Muerto, Cerro Largo'),
    ('Vichadero, Rivera'),
    ('Empalme rutas 2 y 24, Río Negro'),
    ('Nuevo Berlín, Río Negro'),
    ('Empalme rutas 24 y 25, Río Negro'),
    ('Empalme rutas 3 y 24, Paysandú'),
    ('Caraguata, Tacuarembó'),
    ('Ansina, Tacuarembó'),
    ('San Gregorio, Tacuarembó'),
    ('Achar, Tacuarembó'),
    ('Barra del Chuy, Rocha'),
    ('18 de julio, Rocha'),
    ('Empalme rutas 15 y 19, Rocha'),
    ('Barra de Valizas, Rocha'),
    ('Cabo Polonio, Rocha'),
    ('Aguas Dulces, Rocha'),
    ('Empalme rutas 21 y 22, Colonia'),
    ('Empalme San Javier, Río Negro'),
    ('San Javier, Río Negro'),
    ('Biassini, Salto'),
    ('Empalme rutas 13 y 15, Lavalleja'),
    ('Masoller, Artigas'),
    ('Sarandí del Yí, Durazno'),
    ('San Gabriel, Florida'),
    ('Capilla del Sauce, Florida'),
    ('La Paloma, Durazno'),
    ('Blanquillo, Durazno'),
    ('km 329, Durazno'),
    ('km 319, Durazno'),
    ('Santa Rosa, Canelones'),
    ('Montes, Canelones'),
    ('Empalme rutas 6 y 26, Cerro Largo'),
    ('Salto, Salto');
