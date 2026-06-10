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
        $sql = "SELECT * FROM Tutores WHERE id_tutor = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function insert($datos){
        $sql = "INSERT INTO Tutores (nombre, apellido, contacto, id_jugador) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssi", 
            $datos['nombre'], 
            $datos['apellido'], 
            $datos['contacto'], 
            $datos['jugador_id']
        );
        return $stmt->execute();
    }
    public function update($datos){
        $sql = "UPDATE Tutores SET nombre = ?, apellido = ?, contacto = ?, id_jugador = ? WHERE id_tutor = ?";
        $stmt = $this->db->prepare($sql);
        $id_tutor = intval($datos['id_tutor'] ?? 0);
        $stmt->bind_param("sssii", 
            $datos['nombre'], 
            $datos['apellido'], 
            $datos['contacto'], 
            $datos['jugador_id'], 
            $id_tutor
        );
        return $stmt->execute();
    }
    public function delete($id){
        $sql = "DELETE FROM Tutores WHERE id_tutor = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}



?>