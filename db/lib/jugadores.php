<?php
class jugadores {

    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getALL() {
        $sql = "SELECT j.*,
                       c.descripcion AS categoria_nombre,
                       c.edad AS categoria_orden,
                       TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) AS edad
                FROM `Jugadores` j
                LEFT JOIN `Categoria` c
                    ON TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) <= c.edad
                ORDER BY c.edad ASC, j.genero ASC, j.apellido ASC";
        return $this->db->query($sql);
    }

    public function getByID($dato) {
        $id  = (int)$dato;
        $sql = "SELECT * FROM `Jugadores` WHERE `id_jugador` = $id";
        return $this->db->query($sql);
    }

    public function insert($datos) {
        $sql = "INSERT INTO `Jugadores` 
                (`apellido`, `nombre`, `CI`, `fecha_nac`, `nro_contacto`, `genero`, `activo`, `direccion`, `lugar_nac`, `foto`, `tipo_sangre`, `alergias`, `enfermedades_base`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssssiissssss", 
            $datos['apellido'], 
            $datos['nombre'], 
            $datos['CI'], 
            $datos['fecha_nac'], 
            $datos['nro_contacto'], 
            $datos['genero'], 
            $datos['activo'], 
            $datos['direccion'], 
            $datos['lugar_nac'], 
            $datos['foto'], 
            $datos['tipo_sangre'], 
            $datos['alergias'], 
            $datos['enfermedades_base']
        );
        return $stmt->execute();
    }

    public function update($datos) {
        $sql = "UPDATE `Jugadores` SET
                `apellido` = ?, `nombre` = ?, `CI` = ?, `fecha_nac` = ?,
                `nro_contacto` = ?, `genero` = ?, `direccion` = ?,
                `lugar_nac` = ?, `foto` = ?, `tipo_sangre` = ?, `alergias` = ?,
                `enfermedades_base` = ?
                WHERE `id_jugador` = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssssissssssi",
            $datos['apellido'],
            $datos['nombre'],
            $datos['CI'],
            $datos['fecha_nac'],
            $datos['nro_contacto'],
            $datos['genero'],
            $datos['direccion'],
            $datos['lugar_nac'],
            $datos['foto'],
            $datos['tipo_sangre'],
            $datos['alergias'],
            $datos['enfermedades_base'],
            $datos['id_jugador']
        );
        return $stmt->execute();
    }

    public function delete($dato) {
        $id  = (int)$dato;
        $sql = "DELETE FROM `Jugadores` WHERE `id_jugador` = $id";
        return $this->db->query($sql);
    }

    public function cambiarEstado($id, $estado) {
        $id = (int)$id;
        $estado = (int)$estado;
        $sql = "UPDATE `Jugadores` SET `activo` = $estado WHERE `id_jugador` = $id";
        return $this->db->query($sql);
    }

    public function getCategorias() {
        $sql = "SELECT * FROM `Categoria`";
        return $this->db->query($sql);
    }

    public function getCategoriaByEdad($fecha_nac) {
        $fecha = new DateTime($fecha_nac);
        $hoy = new DateTime();
        $edad = (int)$hoy->diff($fecha)->y;

        $sql = "SELECT id_categoria, descripcion FROM `Categoria`
            WHERE $edad <= edad
            ORDER BY edad ASC
            LIMIT 1";

        $rs  = $this->db->query($sql);
        $row = $rs ? $rs->fetch_assoc() : null;

        if (!$row) return ['id' => 0, 'nombre' => 'Sin categoría'];

        return ['id' => (int)$row['id_categoria'], 'nombre' => $row['descripcion']];
    }

    public function getGeneroSlug($genero) {
        switch ((int)$genero) {
            case 1: return 'masculino';
            case 2: return 'femenino';
            case 3: return 'mixto';
            default: return 'sin-genero';
        }
    }

    public function getFiltered($id_categoria, $id_genero) {
        $where = [];
        if ($id_genero) {
            $where[] = "j.genero = $id_genero";
        }

        $sql = "SELECT j.*,
                    c.descripcion AS categoria_nombre,
                    c.edad AS categoria_orden,
                    TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) AS edad
                    FROM `Jugadores` j
                    LEFT JOIN `Categoria` c
                    ON TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) <= c.edad";

        if ($id_categoria) {
            $where[] = "c.id_categoria = $id_categoria";
        }

        if ($where) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " ORDER BY c.edad ASC, j.genero ASC, j.apellido ASC";
        return $this->db->query($sql);
    }
}
?>