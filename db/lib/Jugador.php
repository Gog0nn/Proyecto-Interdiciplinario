<?php
class Jugador {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Consulta corregida usando los campos exactos de tu base de datos
    public function getAll() {
        $sql = "SELECT j.*, g.descripcion AS genero_texto 
                FROM jugadores j 
                LEFT JOIN Genero g ON j.genero = g.id_genero";
        return $this->db->query($sql);
    }

    // Actualización usando 'id_jugador'
    public function cambiarEstado($id, $estado) {
        $id = (int)$id;
        $estado = (int)$estado;
        $sql = "UPDATE jugadores SET activo = $estado WHERE id_jugador = $id";
        return $this->db->query($sql);
    }
}
?>