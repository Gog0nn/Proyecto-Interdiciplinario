<?php
// importar conex 
class Actividad {

    private $db;
    public function __construct($conn)
    {
        $this->db=$conn;
    }
    public function getALL()
        {
        $sql="select * from Actividad"; // creamos una consulta 
        $rs=$this->db->query($sql); // ejecutamos la consulta
        return $rs;
        }
    public function getByID($dato) {

         $sql="SELECT * FROM `Actividad` WHERE `Actividad`.`id_actividad` = ".$dato;
         $rs=$this->db->query($sql);
         return $rs;
     }
    public function insert($datos) {

        $sql="INSERT INTO `Actividad` (`nombre`, `descripcion`, `fecha`, `hora`, `lugar`, `id_genero`, `id_categoria`, `id_tipo`) VALUES ('".$datos['nombre']."', '".$datos['descripcion']."', '".$datos['fecha']."', '".$datos['hora']."', '".$datos['lugar']."', ".$datos['id_genero'].", ".$datos['id_categoria'].", ".$datos['id_tipo'].")";
        $rs=$this->db->query($sql);
    }
        public function update($datos) {

        
        $sql="UPDATE `Actividad` SET `nombre` = '".$datos['nombre']."', `descripcion` = '".$datos['descripcion']."', `fecha` = '".$datos['fecha']."', `hora` = '".$datos['hora']."', `lugar` = '".$datos['lugar']."', `id_genero` = ".$datos['id_genero'].", `id_categoria` = ".$datos['id_categoria'].", `id_tipo` = ".$datos['id_tipo']." WHERE `Actividad`.`id_actividad` = ".$datos['id_actividad'];

        $rs=$this->db->query($sql);
    }    
     public function delete($dato) {
         $sql="DELETE FROM `Actividad` WHERE `Actividad`.`id_actividad` = ".$dato;
         $rs=$this->db->query($sql);
     }
    public function getByCategoria($id_categoria) {
    $id = (int)$id_categoria;
    $sql = "SELECT * FROM Actividad WHERE id_categoria = $id";
    return $this->db->query($sql);
     }
    public function getFiltered($id_categoria, $id_tipo) {
    $where = [];
    if ($id_categoria) $where[] = "id_categoria = $id_categoria";
    if ($id_tipo) $where[] = "id_tipo = $id_tipo";
    $sql = "SELECT * FROM Actividad";
    if ($where) $sql .= " WHERE " . implode(" AND ", $where);
    return $this->db->query($sql);
}
}    

?>