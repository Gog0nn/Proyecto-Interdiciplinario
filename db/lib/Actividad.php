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
}
?>