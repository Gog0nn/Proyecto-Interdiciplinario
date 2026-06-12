# Sistema de Gestión Interna - Club Atlético Sacachispas

Este proyecto consiste en el desarrollo de un sistema web para la gestión interna de jugadores y actividades deportivas del **Club Atlético Sacachispas** de la ciudad de Encarnación. El sistema está orientado a centralizar la información de los menores de edad que participan en el club, sus tutores, categorías y seguimiento físico.

## � Escenario del Proyecto

El club necesita resolver la dispersión de información causada por registros manuales. El sistema permite:

- **Gestión de Jugadores y Tutores:** Registro de jugadores (menores de edad) asociados obligatoriamente a sus tutores responsables.
- **Categorías Deportivas:** Definidas por género y edad tope, con asignación dinámica según fecha de nacimiento y aptitud deportiva.
- **Entrenadores:** Asociación de un entrenador responsable por cada categoría.
- **Actividades:** Registro y planificación de entrenamientos y partidos (fecha, hora, lugar y categoría).
- **Seguimiento Físico:** Historial de evolución del jugador (peso y altura en diferentes fechas).
- **Estado del Jugador:** Control de jugadores activos e inactivos.

## 📊 Modelo de Datos

```text
  +-----------------------+              +-----------------------+
  |        GENERO         |              |       TUTORES         |
  +-----------------------+              +-----------------------+
  | id_genero (PK)        |              | id_tutor (PK)         |
  | descripcion           |              | apellido              |
  +-----------------------+              | nombre                |
              ^                          | contacto              |
              | (1:N)                    | id_jugador (FK)       |
              |                          +-----------------------+
  +-----------------------+                          |
  |       JUGADORES       |                          | (N:1)
  +-----------------------+                          |
  | id_jugador (PK)       | <------------------------+
  | apellido              |
  | nombre                |              +-----------------------+
  | CI                    | (1:N)        |      SEGUIMIENTO      |
  | fecha_nac             |------------> +-----------------------+
  | nro_contacto          |              | id_seguimiento (PK)   |
  | genero (FK)           |              | id_jugador (FK)       |
  | activo                |              | fecha_seguimiento     |
  | direccion             |              | edad                  |
  | lugar_nac             |              | peso                  |
  | foto                  |              | altura                |
  | tipo_sangre           |              | observacion           |
  | alergias              |              +-----------------------+
  | enfermedades_base     |
  +-----------------------+
    |           |
    | (1:N)     | (1:N)                  +-----------------------+
    v           |                        |     ENTRENADORES      |
  +-------------+---------+              +-----------------------+
  |      ASISTENCIA       |              | id_entrenador (PK)    |
  +-----------------------+              | apellido              |
  | id_asistencia (PK)    |              | nombre                |
  | id_actividad (FK)     |              | fecha_nac             |
  | id_jugador (FK)       |              | nro_contacto          |
  | presente              |              | telefono              |
  |                       |              | CI                    |
  |                       |              | foto                  |
  +-----------------------+              +-----------------------+
    |                                                |
    | (N:1)                                          | (1:N)
    v                                                v
  +-----------------------+              +-----------------------+
  |       ACTIVIDAD       |              |     ASIGNACIONES      |
  +-----------------------+              +-----------------------+
  | id_actividad (PK)     | (N:1)        | id_entrenador (PK)(FK)|
  | nombre                |------------> | id_categoria (PK)(FK) |
  | descripcion           |              | id_genero (PK)(FK)    |
  | fecha                 |              +-----------------------+
  | hora                  |                          ^
  | lugar                 |                          | (N:1)
  | id_genero (FK)        |                          |
  | id_categoria (FK) ----+--------------------------+
  | id_tipo (FK) ---------+
  +-----------------------+ | (N:1)
    ^                       v
    |            +-----------------------+
    | (N:1)      |     TIPOACTIVIDAD     |
    |            +-----------------------+
    |            | id_tipo (PK)          |
    |            | descripcion           |
    |            +-----------------------+
  +-+---------------------+
  |        DET_JG         |
  +-----------------------+
  | id_jugador (PK)(FK)   |
  | id_actividad (PK)(FK) |
  | posicion              |
  | fecha                 |
  +-----------------------+

```
Basado en el diagrama de entidad-relación, la base de datos se estructura en las siguientes tablas principales:

- **jugadores:** Almacena datos personales (apellido, nombre, CI, fecha de nacimiento, contacto, dirección, lugar de nacimiento, foto, nro_ficha, tipo_sangre, alergias, enfermedades_base e id_pais). Relacionado con `genero`.
- **tutores:** Almacena información de contacto de los responsables vinculados a un `jugador_id`.
- **seguimiento:** Historial físico vinculado a un `jugador_id` (fecha, edad, peso, altura).
- **categoria:** Define los grupos deportivos por descripción, edad y género. Incluye un `entrenador_id`. El sistema permite la promoción de jugadores por aptitud deportiva.
- **entrenadores:** Datos de los responsables de cada categoría (apellido, nombre, fecha de nacimiento, contacto, CI, foto).
- **actividad:** Registro de eventos (entrenamientos/partidos) con fecha, hora, lugar, categoría y `tipoactividad_id`. (Nota: La asistencia no se contabiliza en esta versión).
- **genero** y **tipoactividad:** Tablas maestras para clasificar información.

## 🛠️ Tecnologías Utilizadas

- **Lenguaje:** PHP 8.x
- **Base de Datos:** MariaDB 10.11
- **Frontend:** HTML5, CSS3, Bootstrap 5, Bootstrap Icons
- **Entorno de Desarrollo:** Docker, Dev Containers, WSL 2
- **Herramientas:** phpMyAdmin

## ⚙️ Requisitos e Instalación

### Requisitos
- Docker Desktop
- Extensión "Dev Containers" para VS Code (Recomendado)

### Instalación con Dev Containers
1. Clonar el repositorio:
   ```bash
   git clone https://github.com/Gog0nn/Proyecto-Interdiciplinario.git
   ```
2. Abrir la carpeta en VS Code.
3. Al aparecer el mensaje "Reopen in Container", hacer clic en él.
4. El sistema configurará automáticamente Apache, PHP y la base de datos MariaDB.
5. Acceder vía navegador:
   - **Sistema:** [http://localhost:8090](http://localhost:8090)
   - **phpMyAdmin:** [http://localhost:8091](http://localhost:8091) (Usuario: `root` / Pass: `root`)

## 🚀 Funcionalidades del Sistema

El sistema ofrece una solución integral para la administración deportiva, organizada en los siguientes módulos:

1.  **Gestión Integral de Jugadores:**
    *   **Ficha Técnica Completa:** Registro de datos personales, contacto, dirección y documentos de identidad.
    *   **Información Médica:** Control de tipos de sangre, alergias y enfermedades de base para garantizar la seguridad del deportista.
    *   **Categorización Automática:** El sistema calcula la edad del jugador y lo asigna automáticamente a la categoría correspondiente (U13, U15, etc.).
    *   **Control de Estado:** Posibilidad de dar de alta o baja a jugadores (Activos/Inactivos) según su participación actual.

2.  **Vinculación con Tutores Responsables:**
    *   Registro obligatorio de un adulto responsable por cada jugador menor de edad.
    *   Acceso rápido a datos de contacto para emergencias o comunicaciones institucionales.

3.  **Seguimiento Físico y Evolutivo:**
    *   **Historial Biométrico:** Registro periódico de peso y altura para monitorear el crecimiento y desarrollo físico.
    *   **Observaciones Técnicas:** Espacio para notas sobre el desempeño o necesidades específicas detectadas en cada control.
    *   **Visualización Cronológica:** Listado histórico de mediciones para analizar la evolución del deportista en el tiempo.

4.  **Organización de Categorías y Staff Técnico:**
    *   **Gestión de Entrenadores:** Registro de perfiles profesionales encargados de los grupos.
    *   **Configuración de Categorías:** Definición de rangos de edad y géneros para organizar los equipos del club.

5.  **Planificación de Actividades:**
    *   **Agenda Deportiva:** Registro y organización de entrenamientos y partidos.
    *   **Gestión de Espacios:** Control de lugares, fechas y horarios para evitar superposiciones en el uso de las instalaciones.

6.  **Filtros y Búsqueda Inteligente:**
    *   Herramientas de filtrado por categoría y género para localizar rápidamente grupos específicos de jugadores o actividades programadas.

## 🎓 Enfoque Pedagógico

El proyecto se desarrolla bajo la metodología de **Aprendizaje Basado en Proyectos (ABP)** para la materia Diseño II, integrando conceptos de:
- Formularios y validaciones.
- Relaciones entre entidades y operaciones CRUD.
- Consultas a bases de datos y organización modular.
