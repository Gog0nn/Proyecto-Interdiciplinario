<?php
include("../../conex.php");
$con = Conex(); 

$id=$_GET["id"];
$sql="DELETE FROM TipoActividad WHERE id_tipo=$id";
$query=mysqli_query($con, $sql);

if($query){
    header("Location: index.php");
}
?>
