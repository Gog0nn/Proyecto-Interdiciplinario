-- ============================================================
--  SISTEMA DE GESTIÓN DEPORTIVA
--  Proyecto Integración de Sistemas - UNAE 2026
--  Área: Base de Datos
-- ============================================================

CREATE DATABASE IF NOT EXISTS gestion_deportiva
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE gestion_deportiva;

-- ============================================================
--  TABLAS BASE (sin dependencias externas)
-- ============================================================

CREATE TABLE Categoria (
    id_categoria  INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    descripcion   VARCHAR(100)    NOT NULL,
    edad          TINYINT UNSIGNED NOT NULL COMMENT 'Límite de edad de la categoría (máx 99)',
    PRIMARY KEY (id_categoria)
) ENGINE=InnoDB;

CREATE TABLE Genero (
    id_genero    INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    descripcion  VARCHAR(50)   NOT NULL,
    PRIMARY KEY (id_genero)
) ENGINE=InnoDB;

CREATE TABLE TipoActividad (
    id_tipo      INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    descripcion  VARCHAR(100)  NOT NULL COMMENT 'Ej: Práctica, Partido',
    PRIMARY KEY (id_tipo)
) ENGINE=InnoDB;

-- ============================================================
--  PERSONAL
-- ============================================================

CREATE TABLE Entrenadores (
    id_entrenador  INT UNSIGNED   NOT NULL AUTO_INCREMENT,
    apellido       VARCHAR(100)   NOT NULL,
    nombre         VARCHAR(100)   NOT NULL,
    fecha_nac      DATE           NOT NULL,
    nro_contacto   VARCHAR(20)    NOT NULL,
    CI             VARCHAR(20)    NOT NULL UNIQUE,
    foto           LONGBLOB       NULL     COMMENT 'Imagen almacenada en binario',
    PRIMARY KEY (id_entrenador)
) ENGINE=InnoDB;

-- Tabla intermedia: asigna entrenadores a una categoría + género
CREATE TABLE EntCatGen (
    id_entrenador  INT UNSIGNED  NOT NULL,
    id_categoria   INT UNSIGNED  NOT NULL,
    id_genero      INT UNSIGNED  NOT NULL,
    PRIMARY KEY (id_entrenador, id_categoria, id_genero),
    CONSTRAINT fk_ecg_entrenador  FOREIGN KEY (id_entrenador) REFERENCES Entrenadores (id_entrenador) ON DELETE CASCADE,
    CONSTRAINT fk_ecg_categoria   FOREIGN KEY (id_categoria)  REFERENCES Categoria    (id_categoria)  ON DELETE CASCADE,
    CONSTRAINT fk_ecg_genero      FOREIGN KEY (id_genero)     REFERENCES Genero       (id_genero)     ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
--  JUGADORES
-- ============================================================

CREATE TABLE Jugadores (
    id_jugador          INT UNSIGNED   NOT NULL AUTO_INCREMENT,
    apellido            VARCHAR(100)   NOT NULL,
    nombre              VARCHAR(100)   NOT NULL,
    CI                  VARCHAR(20)    NOT NULL UNIQUE,
    fecha_nac           DATE           NOT NULL,
    nro_contacto        VARCHAR(20)    NOT NULL,
    genero              INT UNSIGNED   NOT NULL,
    direccion           VARCHAR(200)   NOT NULL,
    lugar_nac           VARCHAR(100)   NOT NULL,
    foto                LONGBLOB       NULL,
    tipo_sangre         VARCHAR(5)     NULL     COMMENT 'Ej: A+, O-, AB+',
    alergias            VARCHAR(255)   NULL,
    enfermedades_base   VARCHAR(255)   NULL,
    PRIMARY KEY (id_jugador),
    CONSTRAINT fk_jug_genero FOREIGN KEY (genero) REFERENCES Genero (id_genero)
) ENGINE=InnoDB;

CREATE TABLE Tutores (
    id_tutor    INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    apellido    VARCHAR(100)  NOT NULL,
    nombre      VARCHAR(100)  NOT NULL,
    contacto    VARCHAR(20)   NOT NULL,
    id_jugador  INT UNSIGNED  NOT NULL,
    PRIMARY KEY (id_tutor),
    CONSTRAINT fk_tut_jugador FOREIGN KEY (id_jugador) REFERENCES Jugadores (id_jugador) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
--  ACTIVIDADES
-- ============================================================

CREATE TABLE Actividad (
    id_actividad  INT UNSIGNED   NOT NULL AUTO_INCREMENT,
    nombre        VARCHAR(50)    NOT NULL,
    descripcion   VARCHAR(150)   NOT NULL,
    fecha         DATE           NOT NULL,
    hora          TIME           NOT NULL,
    lugar         VARCHAR(150)   NOT NULL,
    id_genero     INT UNSIGNED   NOT NULL,
    id_categoria  INT UNSIGNED   NOT NULL,
    id_tipo       INT UNSIGNED   NOT NULL COMMENT 'FK a TipoActividad',
    PRIMARY KEY (id_actividad),
    CONSTRAINT fk_act_genero    FOREIGN KEY (id_genero)    REFERENCES Genero        (id_genero)    ON DELETE RESTRICT,
    CONSTRAINT fk_act_categoria FOREIGN KEY (id_categoria) REFERENCES Categoria     (id_categoria) ON DELETE RESTRICT,
    CONSTRAINT fk_act_tipo      FOREIGN KEY (id_tipo)      REFERENCES TipoActividad (id_tipo)      ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Jugadores que participan en una actividad y su posición
CREATE TABLE Det_Jg (
    id_jugador    INT UNSIGNED  NOT NULL,
    id_actividad  INT UNSIGNED  NOT NULL,
    posicion      VARCHAR(50)   NOT NULL,
    fecha         DATE          NOT NULL,
    PRIMARY KEY (id_jugador, id_actividad),
    CONSTRAINT fk_detjg_jugador   FOREIGN KEY (id_jugador)   REFERENCES Jugadores (id_jugador)   ON DELETE CASCADE,
    CONSTRAINT fk_detjg_actividad FOREIGN KEY (id_actividad) REFERENCES Actividad (id_actividad) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Asistencia (
    id_asistencia  INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    id_actividad   INT UNSIGNED  NOT NULL,
    id_jugador     INT UNSIGNED  NOT NULL,
    presente       TINYINT(1)    NOT NULL DEFAULT 0 COMMENT '1 = presente, 0 = ausente',
    PRIMARY KEY (id_asistencia),
    UNIQUE KEY uq_asistencia (id_actividad, id_jugador),
    CONSTRAINT fk_asis_actividad FOREIGN KEY (id_actividad) REFERENCES Actividad (id_actividad) ON DELETE CASCADE,
    CONSTRAINT fk_asis_jugador   FOREIGN KEY (id_jugador)   REFERENCES Jugadores (id_jugador)   ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
--  SEGUIMIENTO FÍSICO
-- ============================================================

CREATE TABLE Seguimiento (
    id_seguimiento  INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    id_jugador      INT UNSIGNED     NOT NULL,
    fecha           DATE             NOT NULL,
    edad            TINYINT UNSIGNED NOT NULL,
    peso            FLOAT            NOT NULL COMMENT 'En kilogramos',
    altura          FLOAT            NOT NULL COMMENT 'En metros',
    PRIMARY KEY (id_seguimiento),
    CONSTRAINT fk_seg_jugador FOREIGN KEY (id_jugador) REFERENCES Jugadores (id_jugador) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
--  DATOS DE PRUEBA
-- ============================================================

INSERT INTO Genero (descripcion) VALUES
    ('Masculino'),
    ('Femenino'),
    ('Mixto');

INSERT INTO Categoria (descripcion, edad) VALUES
    ('Sub-10',  10),
    ('Sub-13',  13),
    ('Sub-15',  15),
    ('Sub-17',  17),
    ('Sub-20',  20);

INSERT INTO TipoActividad (descripcion) VALUES
    ('Práctica'),
    ('Partido');

INSERT INTO Entrenadores (apellido, nombre, fecha_nac, nro_contacto, CI) VALUES
    ('González', 'Carlos',  '1985-03-12', '0981123456', '3456789'),
    ('Ramírez',  'Laura',   '1990-07-25', '0982234567', '4567890'),
    ('Mendoza',  'Miguel',  '1978-11-05', '0983345678', '5678901');

-- Asignaciones: entrenador → categoría + género
INSERT INTO EntCatGen (id_entrenador, id_categoria, id_genero) VALUES
    (1, 1, 1),  -- González: Sub-10 Masculino
    (1, 2, 1),  -- González: Sub-13 Masculino
    (2, 1, 2),  -- Ramírez:  Sub-10 Femenino
    (3, 3, 3);  -- Mendoza:  Sub-15 Mixto

INSERT INTO Jugadores (apellido, nombre, CI, fecha_nac, nro_contacto, genero, direccion, lugar_nac, tipo_sangre) VALUES
    ('López',   'Andrés', '6123456', '2014-06-10', '0984111222', 1, 'Av. Principal 123', 'Encarnación', 'O+'),
    ('Benítez', 'Sofía',  '6234567', '2013-09-22', '0984222333', 2, 'Calle 5 de Mayo 45', 'Encarnación', 'A+'),
    ('Torres',  'Diego',  '6345678', '2012-01-15', '0984333444', 1, 'San Roque 78', 'Posadas', 'B+');

INSERT INTO Tutores (apellido, nombre, contacto, id_jugador) VALUES
    ('López',   'Roberto', '0985111000', 1),
    ('Benítez', 'María',   '0985222000', 2),
    ('Torres',  'Jorge',   '0985333000', 3);

INSERT INTO Actividad (nombre, descripcion, fecha, hora, lugar, id_genero, id_categoria, id_tipo) VALUES
    ('Práctica Técnica',  'Entrenamiento de técnica individual',    '2026-05-10', '08:00:00', 'Cancha A', 1, 1, 1),
    ('Partido Amistoso',  'Partido de preparación inter-categorías','2026-05-15', '10:00:00', 'Estadio Central', 3, 2, 2),
    ('Práctica Táctica',  'Trabajo en bloque defensivo',            '2026-05-20', '09:00:00', 'Cancha B', 1, 3, 1);

INSERT INTO Asistencia (id_actividad, id_jugador, presente) VALUES
    (1, 1, 1),
    (1, 2, 0),
    (2, 1, 1),
    (2, 3, 1),
    (3, 2, 1);

INSERT INTO Seguimiento (id_jugador, fecha, edad, peso, altura) VALUES
    (1, '2026-05-01', 11, 38.5, 1.42),
    (2, '2026-05-01', 12, 41.0, 1.48),
    (3, '2026-05-01', 14, 55.0, 1.60);
