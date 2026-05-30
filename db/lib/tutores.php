<?php 
class Tutores{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    public function getall(){
        $sql = "SELECT * FROM Tutores";
        $rs = $this->db->query($sql);
        return $rs;

    }
    public function getbyid($id){
        $sql = "SELECT * FROM Tutores WHERE id_tutor = $id";
        $rs = $this->db->query($sql);
        return $rs;
    }
    public function insert($datos){
        $sql = "INSERT INTO Tutores (nombre, apellido, contacto, id_jugador) 
        VALUES ('".$datos['nombre']."', '".$datos['apellido']."', '".$datos['contacto']."', '".$datos['jugador_id']."')";
        $rs = $this->db->query($sql);
        return $rs;
    }
    public function update($datos){
        $sql = "UPDATE `Tutores` SET 
                `nombre` = '" . $datos['nombre'] . "', 
                `apellido` = '" . $datos['apellido'] . "', 
                `contacto` = '" . $datos['contacto'] . "', 
                `id_jugador` = '" . $datos['jugador_id'] . "' 
                WHERE `id_tutor` = " . $datos['id_tutor'];
        $rs = $this->db->query($sql);
        return $rs;
    }
    public function delete($id){
        $sql = "DELETE FROM Tutores WHERE id_tutor = $id";
        $rs = $this->db->query($sql);
        return $rs;
    }
}



?>