<?php
class Tutores{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getall(){
        $sql = "SELECT t.*, GROUP_CONCAT(jt.id_jugador) as jugador_ids
                FROM Tutores t
                LEFT JOIN jugador_tutor jt ON t.id_tutor = jt.id_tutor
                GROUP BY t.id_tutor";
        $rs = $this->db->query($sql);
        return $rs;
    }

    public function getbyid($id){
        $sql = "SELECT t.*, GROUP_CONCAT(jt.id_jugador) as jugador_ids
                FROM Tutores t
                LEFT JOIN jugador_tutor jt ON t.id_tutor = jt.id_tutor
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
