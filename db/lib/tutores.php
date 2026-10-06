<?php
class Tutores{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getall(){
        $sql = "SELECT t.*, GROUP_CONCAT(DISTINCT relaciones.id_jugador) as jugador_ids
                FROM Tutores t
                LEFT JOIN (
                    SELECT id_tutor, id_jugador FROM jugador_tutor
                    UNION
                    SELECT id_tutor, id_jugador FROM Tutores WHERE id_jugador IS NOT NULL
                ) relaciones ON t.id_tutor = relaciones.id_tutor
                GROUP BY t.id_tutor";
        $rs = $this->db->query($sql);
        return $rs;
    }

    public function buscar($termino){
        $termino = '%' . $termino . '%';
        $sql = "SELECT id_tutor, nombre, apellido, contacto
                FROM Tutores
            WHERE nombre LIKE ? OR apellido LIKE ? OR contacto LIKE ?
                ORDER BY apellido, nombre
                LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $termino, $termino, $termino);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function obtenerRelacionesPorJugador($jugador_id){
        $sql = "SELECT t.id_tutor, t.nombre, t.apellido, t.contacto,
                   jt.tipo_relacion
                FROM Tutores t
                INNER JOIN jugador_tutor jt ON jt.id_tutor = t.id_tutor
                WHERE jt.id_jugador = ?
            ORDER BY t.apellido, t.nombre";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $jugador_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function guardarRelaciones($jugador_id, $relaciones){
        if (!is_array($relaciones) || count($relaciones) === 0) {
            throw new InvalidArgumentException('Debe asignar al menos un tutor.');
        }

        $delete = $this->db->prepare("DELETE FROM jugador_tutor WHERE id_jugador = ?");
        $delete->bind_param("i", $jugador_id);
        if (!$delete->execute()) {
            throw new RuntimeException('No se pudieron actualizar los tutores.');
        }

        $insert = $this->db->prepare(
            "INSERT INTO jugador_tutor
             (id_jugador, id_tutor, tipo_relacion)
             VALUES (?, ?, ?)"
        );
        foreach ($relaciones as $relacion) {
            $tutor_id = (int)($relacion['id_tutor'] ?? 0);
            $tipo_relacion = trim($relacion['tipo_relacion'] ?? '');
            if ($tutor_id <= 0 || $tipo_relacion === '') {
                throw new InvalidArgumentException('Cada tutor debe tener un parentesco válido.');
            }
            $insert->bind_param("iis", $jugador_id, $tutor_id, $tipo_relacion);
            if (!$insert->execute()) {
                throw new RuntimeException('No se pudieron guardar las relaciones.');
            }
        }
    }

    public function insertarRapido($datos){
        $sql = "INSERT INTO Tutores (nombre, apellido, contacto)
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "sss",
            $datos['nombre'],
            $datos['apellido'],
            $datos['contacto']
        );
        if (!$stmt->execute()) {
            throw new RuntimeException('No se pudo registrar el tutor.');
        }
        return $this->db->insert_id;
    }

    public function vincularTutor($jugador_id, $tutor_id, $tipo_relacion){
        $sql = "INSERT INTO jugador_tutor
                (id_jugador, id_tutor, tipo_relacion)
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "iis",
            $jugador_id,
            $tutor_id,
            $tipo_relacion
        );
        if (!$stmt->execute()) {
            throw new RuntimeException('No se pudo vincular el tutor.');
        }
    }

    public function getbyid($id){
        $sql = "SELECT t.*, GROUP_CONCAT(DISTINCT relaciones.id_jugador) as jugador_ids
                FROM Tutores t
                LEFT JOIN (
                    SELECT id_tutor, id_jugador FROM jugador_tutor
                    UNION
                    SELECT id_tutor, id_jugador FROM Tutores WHERE id_jugador IS NOT NULL
                ) relaciones ON t.id_tutor = relaciones.id_tutor
                WHERE t.id_tutor = ?
                GROUP BY t.id_tutor";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function insert($datos){
        $sql = "INSERT INTO Tutores (nombre, apellido, contacto) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss",
            $datos['nombre'],
            $datos['apellido'],
            $datos['contacto']
        );
        $result = $stmt->execute();

        if ($result) {
            $tutor_id = $this->db->insert_id;
            if (isset($datos['jugador_ids']) && is_array($datos['jugador_ids'])) {
                foreach ($datos['jugador_ids'] as $jugador_id) {
                    $this->asignarJugador($tutor_id, (int)$jugador_id);
                }
            }
        }
        return $result;
    }

    public function update($datos){
        $id_tutor = intval($datos['id_tutor'] ?? 0);
        $sql = "UPDATE Tutores SET nombre = ?, apellido = ?, contacto = ? WHERE id_tutor = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssi",
            $datos['nombre'],
            $datos['apellido'],
            $datos['contacto'],
            $id_tutor
        );
        $result = $stmt->execute();

        if ($result) {
            $this->db->query("DELETE FROM jugador_tutor WHERE id_tutor = $id_tutor");
            if (isset($datos['jugador_ids']) && is_array($datos['jugador_ids'])) {
                foreach ($datos['jugador_ids'] as $jugador_id) {
                    $this->asignarJugador($id_tutor, (int)$jugador_id);
                }
            }
        }
        return $result;
    }

    public function delete($id){
        $this->db->query("DELETE FROM jugador_tutor WHERE id_tutor = $id");
        $sql = "DELETE FROM Tutores WHERE id_tutor = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function asignarJugador($tutor_id, $jugador_id){
        $sql = "INSERT IGNORE INTO jugador_tutor (id_tutor, id_jugador) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $tutor_id, $jugador_id);
        return $stmt->execute();
    }

    public function obtenerTutoresPorJugador($jugador_id){
        $sql = "SELECT t.* FROM Tutores t
                INNER JOIN jugador_tutor jt ON t.id_tutor = jt.id_tutor
                WHERE jt.id_jugador = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $jugador_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}

?>
