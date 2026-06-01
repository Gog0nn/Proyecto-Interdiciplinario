<?php
include "../../db/lib/conex.php"; // incluimos conexion
include "../../db/lib/Actividad.php";
$con = Conex(); // creamos la conexion a la db
$evento= new Actividad($con);
$rs=$evento->getALL();
?>
<?php include_once '../../template/parciales/templateStart.php'; ?>
             
<h3>   
<?php 

?>    
</h3>
  <?php 
  if (isset($_GET['ok']) && $_GET['ok'] == 1) {
      echo "<p style='color:green;'>Actividad insertada correctamente.</p>";
  }
  ?>
  <?php 
        if (isset($_GET['ok']) && $_GET['ok'] == 2) {
            echo "<p style='color:green;'>Actividad actualizada correctamente.</p>";
  }
  ?>
    <?php 
  if (isset($_GET['ok']) && $_GET['ok'] == 3) {
      echo "<p style='color:green;'>Actividad eliminada correctamente.</p>";
  }
  ?>
  <?php 
  if (isset($_GET['error']) && $_GET['error'] == 3) {
      echo "<p style='color:red;'>Error al eliminar la actividad.</p>";
  }
  ?>
<table class="table table-striped ">
<tr>
    <!--<th>id</th>-->
    <th>nombre</th>
    <th>descripcion</th>
    <th>fecha</th>
    <th>hora</th>
    <th>lugar</th>
    <th>Genero</th>
    <th>Categoria</th>
    <th>Tipo</th>
    <th colspan="2"><a href="nuevo.php" class="btn btn-outline-primary">Nueva actividad</a></th>

</tr>

<?php 
while ($fila= $rs->fetch_assoc()) //loop while que se ejecuta mientras haya fila en el array asociativo
    { ?> 
<tr>
    <input type="hidden" name="id_actividad" value="<?php echo $fila["id_actividad"]; ?>">
    <td> <?php echo $fila["nombre"]; ?></td>
    <td> <?php echo $fila["descripcion"]; ?></td>
    <td> <?php echo $fila["fecha"]; ?></td>
    <td> <?php echo $fila["hora"]; ?></td>
    <td> <?php echo $fila["lugar"]; ?></td>
    <td> <?php 
    switch($fila['id_genero']) {
        case 1: 
            echo '<i class="bi bi bi-gender-male text-success" title="Masculino"></i>Masculino'; 
            break;
        case 2: 
            echo '<i class="bi bi-gender-female text-success" title="Femenino"></i>Femenino'; 
            break;
        case 3: 
            echo '<i class="bi bi-gender-ambiguous text-success" title="Mixto"></i>Mixto'; 
            break;
    }
    ?></td>
    <td> <?php 
    switch($fila['id_categoria']) {
        case 1: 
            echo '<i class="bi bi-emoji-surprise text-success" title="Sub-10"></i>Sub-10'; 
            break;
        case 2: 
            echo '<i class="bi bi-emoji-grin text-success" title="Sub-13"></i>Sub-13'; 
            break;
        case 3: 
            echo '<i class="bi bi-emoji-sunglasses text-succes" title="Sub-15"></i>Sub-15'; 
             break;
            break;
        case 4: 
            echo '<i class="bi bi-emoji-smile-upside-down text-success" title="Sub-17"></i>Sub-17'; 
            break;
        case 5: 
            echo '<i class="bi bi-emoji-tear text-succes" title="Sub-20"></i>Sub-20'; 
             break;
    }
    ?></td>
    <td> <?php
    switch($fila['id_tipo']) {
        case 1: 
            echo '<i class="bi bi-circle-fill text-warning" title="Practica"></i>Practica'; 
            break;
        case 2: 
            echo '<i class="bi bi-circle-fill text-success" title="Partido"></i>Partido'; 
            break;
    }
    ?>
    </td>
    <td ><a href="editar.php?id_actividad=<?php echo $fila["id_actividad"]; ?>" class="btn btn-outline-warning">Editar</a></td>
    <td ><a href="borrar.php?id_actividad=<?php echo $fila["id_actividad"]; ?>" class="btn btn-outline-danger">Borrar</a></td>
</tr>


<?php   }
?>

</table>

<?php include_once '../../template/parciales/templateEnd.php'; ?>  