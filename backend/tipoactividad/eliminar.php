<?php
include("../../conex.php");
$con = Conex(); 

$id=$_GET["id"];
$sql="DELETE FROM tipo_actividad WHERE id=$id";
$query=mysqli_query($con, $sql);

if($query){
    header("Location: index.php");
}
?>
