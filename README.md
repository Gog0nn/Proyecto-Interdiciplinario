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

## 🗄️ Modelo de Datos (DER)

```text
┌─────────────────┐       ┌─────────────────┐       ┌─────────────────┐
│     GENERO      │       │    JUGADORES    │       │     TUTORES     │
├─────────────────┤       ├─────────────────┤       ├─────────────────┤
│ id (PK)         │◄────┐ │ id (PK)         │ ┌────►│ id (PK)         │
│ descripcion     │     └─┤ id_genero (FK)  │ │     │ id_jugador (FK) │
└─────────────────┘       │ nombre          │─┘     │ nombre          │
                          │ apellido        │       │ contacto        │
                          │ ci              │       └─────────────────┘
                          │ fecha_nac       │
          ┌───────────────┤ estado          │───────┐
          │               └─────────────────┘       │
          ▼                                         ▼
┌─────────────────┐       ┌─────────────────┐       ┌─────────────────┐
│   CATEGORIAS    │       │   ACTIVIDADES   │       │   SEGUIMIENTO   │
├─────────────────┤       ├─────────────────┤       ├─────────────────┤
│ id (PK)         │◄────┐ │ id (PK)         │       │ id (PK)         │
│ descripcion     │     └─┤ id_categoria(FK)│       │ id_jugador (FK) │◄──┘
│ id_entrenador(FK)─────┐ │ fecha           │       │ fecha           │
└─────────────────┘     │ │ lugar           │       │ peso            │
          ▲             │ └─────────────────┘       │ altura          │
          │             │          │                └─────────────────┘
┌─────────────────┐     │          ▼
│   ENTRENADORES  │     │ ┌─────────────────┐
├─────────────────┤     │ │ TIPO_ACTIVIDAD  │
│ id (PK)         │     │ ├─────────────────┤
│ nombre          │     └─┤ id (PK)         │
│ apellido        │       │ descripcion     │
└─────────────────┘       └─────────────────┘
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

## 🚀 Funcionalidades Principales (Backlog)

Basado en el plan de desarrollo, se han definido las siguientes áreas de trabajo:

1.  **Módulo de Jugadores:**
    *   CRUD (Crear, Leer, Actualizar, Borrar) de Jugadores.
    *   Gestión de estados (Activo/Inactivo).
2.  **Módulo de Tutores:**
    *   Registro y vinculación con jugadores.
3.  **Módulo de Entrenamiento y Categorías:**
    *   Gestión de categorías y asignación de entrenadores.
    *   Registro de actividades (Entrenamientos/Partidos).
4.  **Módulo de Seguimiento:**
    *   Control físico (Peso/Altura).
5.  **Consultas y Reportes:**
    *   Visualización de información centralizada y organizada.

## 🎓 Enfoque Pedagógico

El proyecto se desarrolla bajo la metodología de **Aprendizaje Basado en Proyectos (ABP)** para la materia Diseño II, integrando conceptos de:
- Formularios y validaciones.
- Relaciones entre entidades y operaciones CRUD.
- Consultas a bases de datos y organización modular.

