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

    public function getFiltered($id_categoria, $id_tipo) {
    $where = [];
    if ($id_categoria) $where[] = "id_categoria = $id_categoria";
    if ($id_tipo) $where[] = "id_tipo = $id_tipo";
    $sql = "SELECT * FROM Actividad";
    if ($where) $sql .= " WHERE " . implode(" AND ", $where);
    return $this->db->query($sql);
    }
    const FECHA_MIN = '2020-01-01';

    public static function fechaMax(): string {
        return date('Y-m-d', strtotime('+5 years'));
    }

    public static function validar(array $d): array {
        $errores = [];

        $nombre = trim($d['nombre'] ?? '');
        if ($nombre === '' || mb_strlen($nombre) > 100) {
            $errores[] = 'El nombre es obligatorio y no puede superar los 100 caracteres.';
        }

        $descripcion = trim($d['descripcion'] ?? '');
            if ($descripcion === '' || mb_strlen($descripcion) > 100) {
            $errores[] = 'La descripción es obligatoria y no puede superar los 100 caracteres.';
        }

    // Fecha: formato real y dentro de un rango razonable
        $fecha = $d['fecha'] ?? '';
        $f = DateTime::createFromFormat('Y-m-d', $fecha);
        if (!$f || $f->format('Y-m-d') !== $fecha) {
            $errores[] = 'La fecha no es válida.';
        } elseif ($fecha < self::FECHA_MIN || $fecha > self::fechaMax()) {
            $errores[] = 'La fecha debe estar entre ' . self::FECHA_MIN . ' y ' . self::fechaMax() . '.';
        }

    // Hora (opcional)
        $hora = $d['hora'] ?? '';
        if ($hora !== '' && !preg_match('/^([01]\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/', $hora)) {
            $errores[] = 'La hora no es válida.';
        }

        if (mb_strlen($d['lugar'] ?? '') > 191) {
            $errores[] = 'El lugar no puede superar los 191 caracteres.';
        }

    // Los selects también se pueden manipular
        if (!in_array((int)($d['id_genero'] ?? 0), [1, 2, 3], true))    $errores[] = 'Género no válido.';
        if (!in_array((int)($d['id_categoria'] ?? 0), [1, 2, 3, 4, 5], true)) $errores[] = 'Categoría no válida.';
        if (!in_array((int)($d['id_tipo'] ?? 0), [1, 2], true))         $errores[] = 'Tipo no válido.';

        return $errores;
    }
}    

?>