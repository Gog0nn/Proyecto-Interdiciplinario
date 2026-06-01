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
        //DELETE FROM `eventos` WHERE `eventos`.`id` = 7
         $sql="SELECT * FROM `Actividad` WHERE `Actividad`.`id_actividad` = ".$dato;
         $rs=$this->db->query($sql);
         return $rs;
     }
    public function insert($datos) {
        //INSERT INTO `eventos` (`id`, `titulo`, `fecha`, `hora`, `lugar`, `activo`) VALUES (NULL, 'Charla de FOrmularios', '2026-03-17', '20:45:44', 'Pasillo', '1');
        $sql="INSERT INTO `Actividad` (`nombre`, `descripcion`, `fecha`, `hora`, `lugar`, `id_genero`, `id_categoria`, `id_tipo`) VALUES ('".$datos['nombre']."', '".$datos['descripcion']."', '".$datos['fecha']."', '".$datos['hora']."', '".$datos['lugar']."', ".$datos['id_genero'].", ".$datos['id_categoria'].", ".$datos['id_tipo'].")";
        $rs=$this->db->query($sql);
    }
        public function update($datos) {
        //UPDATE `eventos` SET `titulo` = 'Taller de Introducción a JS', `fecha` = '2026-04-11', `hora` = '09:30:00', `lugar` = 'Aula Central UNAE ', `activo` = '0' WHERE `eventos`.`id` = 1;
        //$sql="INSERT INTO `eventos` (`titulo`, `fecha`, `hora`, `lugar`, `activo`) VALUES ('".$datos['titulo']."', '".$datos['fecha']."', '".$datos['hora']."', '".$datos['lugar']."', ".$datos['activo'].")";
        
        $sql="UPDATE `Actividad` SET `nombre` = '".$datos['nombre']."', `descripcion` = '".$datos['descripcion']."', `fecha` = '".$datos['fecha']."', `hora` = '".$datos['hora']."', `lugar` = '".$datos['lugar']."', `id_genero` = ".$datos['id_genero'].", `id_categoria` = ".$datos['id_categoria'].", `id_tipo` = ".$datos['id_tipo']." WHERE `Actividad`.`id_actividad` = ".$datos['id_actividad'];

        $rs=$this->db->query($sql);
    }    
     public function delete($dato) {
        //DELETE FROM `eventos` WHERE `eventos`.`id` = 7
         $sql="DELETE FROM `Actividad` WHERE `Actividad`.`id_actividad` = ".$dato;
         $rs=$this->db->query($sql);
     }
}
?>