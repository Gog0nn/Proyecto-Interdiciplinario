<?php 
class Entrenadores{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }
    public function getall(){
        $sql = "SELECT * FROM Entrenadores";
        $rs = $this->db->query($sql);
        return $rs;

    }
    public function getbyid($id){
        $sql = "SELECT * FROM Entrenadores WHERE id_entrenador = $id";
        $rs = $this->db->query($sql);
        return $rs;
    }
    public function insert($datos){
    $sql = "INSERT INTO Entrenadores (apellido, nombre, fecha_nac, nro_contacto, CI, foto) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ssssss",
        $datos['apellido'],
        $datos['nombre'],
        $datos['fecha_nac'],
        $datos['nro_contacto'],
        $datos['CI'],
        $datos['foto']
    );
    return $stmt->execute();
}
    public function update($datos){
    $sql = "UPDATE Entrenadores SET 
            apellido=?, nombre=?, fecha_nac=?, nro_contacto=?, CI=?, foto=?
            WHERE id_entrenador=?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ssssssi",
        $datos['apellido'],
        $datos['nombre'],
        $datos['fecha_nac'],
        $datos['nro_contacto'],
        $datos['CI'],
        $datos['foto'],
        $datos['id_entrenador']
    );
    return $stmt->execute();
}
    public function delete($id){
        $sql = "DELETE FROM Entrenadores WHERE id_entrenador = $id";
        $rs = $this->db->query($sql);
        return $rs;
    }
}



?>