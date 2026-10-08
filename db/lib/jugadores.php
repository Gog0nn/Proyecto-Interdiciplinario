<?php
class jugadores {

    private $db;

    public function __construct($conn) {
        $this->db =$conn;
    }

    public function getALL() {
        $sql = "SELECT j.*,
                       c.nombre AS categoria_nombre,
                       c.edad_min AS categoria_orden,
                       TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) AS edad
                FROM `Jugadores` j
                LEFT JOIN `Categoria` c
                    ON TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) >= c.edad_min
                    AND TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) <= c.edad_max
                ORDER BY c.edad_min ASC, j.genero ASC, j.apellido ASC";
        return $this->db->query($sql);
    }

    public function getByID($dato) {
        $id  = (int)$dato;
        $sql = "SELECT * FROM `Jugadores` WHERE `id_jugador` = $id";
        return $this->db->query($sql);
    }

    public function insert($datos) {$sql = "INSERT INTO `Jugadores` 
                (`apellido`, `nombre`, `CI`, `fecha_nac`, `nro_contacto`, `genero`, `activo`, `direccion`, `lugar_nac`, `foto`, `tipo_sangre`, `alergias`, `enfermedades_base`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $foto =$datos['foto'] ?? null;
        $null = null; // Variable auxiliar para el parametro BLOB

        $stmt->bind_param("sssssiissbsss", 
            $datos['apellido'], 
            $datos['nombre'],$datos['CI'], 
            $datos['fecha_nac'],$datos['nro_contacto'], 
            $datos['genero'],$datos['activo'], 
            $datos['direccion'],$datos['lugar_nac'], 
            $null,$datos['tipo_sangre'], 
            $datos['alergias'],$datos['enfermedades_base']
        );

        if ($foto !== null) {
            $stmt->send_long_data(9,$foto);
        }

        return $stmt->execute();
    }

    public function update($datos) {
        $foto =$datos['foto'] ?? null;
        $incluye_foto =$foto !== null;
        $foto_sql =$incluye_foto ? ', `foto` = ?' : '';
        
        $sql = "UPDATE `Jugadores` SET
                `apellido` = ?, `nombre` = ?, `CI` = ?, `fecha_nac` = ?,
                `nro_contacto` = ?, `genero` = ?, `direccion` = ?,
                `lugar_nac` = ?, `tipo_sangre` = ?, `alergias` = ?,
                `enfermedades_base` = ?$foto_sql
                WHERE `id_jugador` = ?";

        $stmt = $this->db->prepare($sql);

        if ($incluye_foto) {$null = null;
            // 13 parámetros: 11 campos + 1 foto (b) + 1 id_jugador (i)
            // Tipos: s s s s s i s s s s s b i
            $stmt->bind_param("sssssisssssbi", 
                $datos['apellido'], 
                $datos['nombre'],$datos['CI'], 
                $datos['fecha_nac'],$datos['nro_contacto'], 
                $datos['genero'],$datos['direccion'], 
                $datos['lugar_nac'],$datos['tipo_sangre'], 
                $datos['alergias'],$datos['enfermedades_base'], 
                $null,$datos['id_jugador']
            );
            
            // Indice 11 correspondiente al parametro 'b' de foto
            $stmt->send_long_data(11,$foto);
        } else {
            // 12 parámetros: 11 campos + 1 id_jugador (i)
            // Tipos: s s s s s i s s s s s i
            $stmt->bind_param("sssssisssssi", 
                $datos['apellido'],$datos['nombre'], 
                $datos['CI'],$datos['fecha_nac'], 
                $datos['nro_contacto'],$datos['genero'], 
                $datos['direccion'],$datos['lugar_nac'], 
                $datos['tipo_sangre'],$datos['alergias'], 
                $datos['enfermedades_base'],$datos['id_jugador']
            );
        }

        return $stmt->execute();
    }

    public function delete($dato) {
        $id  = (int)$dato;
        $sql = "DELETE FROM `Jugadores` WHERE `id_jugador` = $id";
        return $this->db->query($sql);
    }

    public function cambiarEstado($id,$estado) {
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
    if (empty($fecha_nac)) {
        return ['id' => 0, 'nombre' => 'Sin categoría'];
    }

    $fecha = new DateTime($fecha_nac);
    $hoy   = new DateTime();$edad  = (int)$hoy->diff($fecha)->y;

    // Se agregan espacios claros entre variables y palabras clave de SQL
    $sql = "SELECT id_categoria, nombre 
            FROM `Categoria`
            WHERE ? >= edad_min AND ? <= edad_max
            ORDER BY edad_min ASC
            LIMIT 1";

    $stmt =$this->db->prepare($sql);$stmt->bind_param("ii", $edad,$edad);
    $stmt->execute();$rs  = $stmt->get_result();$row = $rs ? $rs->fetch_assoc() : null;

    if (!$row) {
        return ['id' => 0, 'nombre' => 'Sin categoría'];
    }

    return ['id' => (int)$row['id_categoria'], 'nombre' =>$row['nombre']];
}

    public function getGeneroSlug($genero) {
        switch ((int)$genero) {
            case 1: return 'masculino';
            case 2: return 'femenino';
            case 3: return 'mixto';
            default: return 'sin-genero';
        }
    }

    public function getFiltered($id_categoria, $id_genero) {$where = [];
        if ($id_genero) {
            $where[] = "j.genero = $id_genero";
        }

        $sql = "SELECT j.*,
                    c.nombre AS categoria_nombre,
                    c.edad_min AS categoria_orden,
                    TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) AS edad
                    FROM `Jugadores` j
                    LEFT JOIN `Categoria` c
                    ON TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) >= c.edad_min
                    AND TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) <= c.edad_max";

        if ($id_categoria) {
            $where[] = "c.id_categoria = $id_categoria";
        }

        if ($where) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " ORDER BY c.edad_min ASC, j.genero ASC, j.apellido ASC";
        return $this->db->query($sql);
    }
}
?>