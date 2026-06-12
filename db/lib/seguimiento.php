<?php 
class Seguimiento {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    public function getByJugador($id_jugador) {
        $sql = "SELECT
                    j.id_jugador,
                    s.id_seguimiento,
                    s.fecha AS fecha_seguimiento,
                    s.edad,
                    s.peso,
                    s.altura
                FROM Jugadores j
                LEFT JOIN Seguimiento s ON j.id_jugador = s.id_jugador
                WHERE j.id_jugador = ?
                ORDER BY s.fecha DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_jugador);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function getall(){
        $sql = "SELECT * FROM Seguimiento";
        $rs = $this->db->query($sql);
        return $rs;

    }
    public function getById($id){
        $id = (int)$id;
        $sql = "SELECT * FROM `Seguimiento` WHERE `id_seguimiento` = $id LIMIT 1";
        $rs = $this->db->query($sql);
        if (!$rs) return false;
        return $rs->num_rows ? $rs->fetch_assoc() : false;
    }
    public function insert($datos){
        $id_jugador = (int)($datos['id_jugador'] ?? 0);
        $fecha = $this->db->real_escape_string($datos['fecha'] ?? '');
        $edad = (int)($datos['edad'] ?? 0);
        $peso = (float)($datos['peso'] ?? 0);
        $altura = (float)($datos['altura'] ?? 0);

        $sql = "INSERT INTO `Seguimiento` (`id_jugador`, `fecha`, `edad`, `peso`, `altura`)
            VALUES ($id_jugador, '$fecha', $edad, $peso, $altura)";

        $rs = $this->db->query($sql);
        return $rs;
    }

    public function update($datos){
        $id_seguimiento = (int)($datos['id_seguimiento'] ?? 0);
        $id_jugador = (int)($datos['id_jugador'] ?? 0);
        $fecha = $this->db->real_escape_string($datos['fecha'] ?? '');
        $edad = (int)($datos['edad'] ?? 0);
        $peso = (float)($datos['peso'] ?? 0);
        $altura = (float)($datos['altura'] ?? 0);

        $sql = "UPDATE `Seguimiento` SET
            `id_jugador` = $id_jugador,
            `fecha` = '$fecha',
            `edad` = $edad,
            `peso` = $peso,
            `altura` = $altura
            WHERE `id_seguimiento` = $id_seguimiento";

        $rs = $this->db->query($sql);
        return $rs;
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "DELETE FROM `Seguimiento` WHERE `id_seguimiento` = $id";
        $rs = $this->db->query($sql);
        return $rs;
    }
}



?>