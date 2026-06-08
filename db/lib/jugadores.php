<?php
class jugadores {

    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getALL() {
        $sql = "SELECT j.*, 
                       c.nombre AS categoria_nombre,
                       c.edad_min AS categoria_orden,
                       TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) AS edad
                FROM `Jugadores` j
                LEFT JOIN `Categoria` c 
                    ON TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) BETWEEN c.edad_min AND c.edad_max
                ORDER BY c.edad_min ASC, j.genero ASC, j.apellido ASC";
        return $this->db->query($sql);
    }

    public function getByID($dato) {
        $id  = (int)$dato;
        $sql = "SELECT * FROM `Jugadores` WHERE `id_jugador` = $id";
        return $this->db->query($sql);
    }

    public function insert($datos) {
        $apellido     = $this->db->real_escape_string($datos['apellido']     ?? '');
        $nombre       = $this->db->real_escape_string($datos['nombre']       ?? '');
        $CI           = $this->db->real_escape_string($datos['CI']           ?? '');
        $fecha_nac    = $this->db->real_escape_string($datos['fecha_nac']    ?? '');
        $nro_contacto = $this->db->real_escape_string($datos['nro_contacto'] ?? '');
        $genero       = (int)($datos['genero']                               ?? 0);
        $direccion    = $this->db->real_escape_string($datos['direccion']    ?? '');
        $lugar_nac    = $this->db->real_escape_string($datos['lugar_nac']    ?? '');
        $tipo_sangre  = $this->db->real_escape_string($datos['tipo_sangre']  ?? '');

        $sql = "INSERT INTO `Jugadores` 
                    (`apellido`, `nombre`, `CI`, `fecha_nac`, `nro_contacto`, `genero`, `direccion`, `lugar_nac`, `tipo_sangre`) 
                VALUES 
                    ('$apellido', '$nombre', '$CI', '$fecha_nac', '$nro_contacto', $genero, '$direccion', '$lugar_nac', '$tipo_sangre')";

        return $this->db->query($sql);
    }

    public function update($datos) {
        $apellido     = $this->db->real_escape_string($datos['apellido']     ?? '');
        $nombre       = $this->db->real_escape_string($datos['nombre']       ?? '');
        $CI           = $this->db->real_escape_string($datos['CI']           ?? '');
        $fecha_nac    = $this->db->real_escape_string($datos['fecha_nac']    ?? '');
        $nro_contacto = $this->db->real_escape_string($datos['nro_contacto'] ?? '');
        $genero       = (int)($datos['genero']                               ?? 0);
        $activo       = (int)($datos['activo']                               ?? 1);
        $direccion    = $this->db->real_escape_string($datos['direccion']    ?? '');
        $lugar_nac    = $this->db->real_escape_string($datos['lugar_nac']    ?? '');
        $tipo_sangre  = $this->db->real_escape_string($datos['tipo_sangre']  ?? '');
        $id_jugador   = (int)($datos['id_jugador']                           ?? 0);

        $sql = "UPDATE `Jugadores` SET 
                    `apellido`     = '$apellido',
                    `nombre`       = '$nombre',
                    `CI`           = '$CI',
                    `fecha_nac`    = '$fecha_nac',
                    `nro_contacto` = '$nro_contacto',
                    `genero`       = $genero,
                    `activo`       = $activo,
                    `direccion`    = '$direccion',
                    `lugar_nac`    = '$lugar_nac',
                    `tipo_sangre`  = '$tipo_sangre'
                WHERE `id_jugador` = $id_jugador";

        return $this->db->query($sql);
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

        $sql = "SELECT id_categoria, nombre FROM `Categoria` 
            WHERE $edad BETWEEN edad_min AND edad_max 
            LIMIT 1";

        $rs  = $this->db->query($sql);
        $row = $rs ? $rs->fetch_assoc() : null;

        if (!$row) return ['id' => 0, 'nombre' => 'Sin categoría'];

        return ['id' => (int)$row['id_categoria'], 'nombre' => $row['nombre']];
    }

    public function getGeneroSlug($genero) {
        switch ((int)$genero) {
            case 1: return 'masculino';
            case 2: return 'femenino';
            case 3: return 'mixto';
            default: return 'sin-genero';
        }
    }
}
?>