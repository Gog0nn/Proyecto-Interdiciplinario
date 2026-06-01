//$fila= $rs->fetch_assoc()
<?php
include "../../db/lib/conex.php"; // incluimos conexion
include "../../db/lib/Actividad.php";
$con = Conex(); // conectamos a la db
$actividad = new Actividad($con);
if (isset($_GET['id_actividad']))
     {
    $rs=$actividad->getByID($_GET['id_actividad']);
    $fila= $rs->fetch_assoc();
     }   
$target="actualizar.php";
$titulo_form="Editar Actividad";   
?>
<?php include_once '../../template/parciales/templateStart.php';

include "_form.php";
include_once '../../template/parciales/templateEnd.php';
 ?>