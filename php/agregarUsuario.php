<?php 
require("credenciales.php");

$identificacion=$_POST['identificacion'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];
$direccion=$_POST['direccion'];
$correo=$_POST['correo'];
$carrera=$_POST['carrera'];
$rol=$_POST['rol'];

$jsondata=array();
$jsondata['HTMLResponse']="";

$conexion=conectDB("lightcontroldb");
$consulta="SELECT count(*) FROM `usuario` WHERE `cedula`='$identificacion'";
$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));
if($resultado[0]==0){
	$consulta="INSERT INTO `usuario`(`cedula`, `nombre`, `telefono`, `direccion`, `correo`, `carrera`, `rol`) VALUES ('$identificacion','$nombre','$telefono','$direccion','$correo','$carrera','$rol')";
	$resultado=mysqli_query($conexion, $consulta);
	$jsondata['HTMLResponse']="ok";
}
else{
	$jsondata['HTMLResponse']="error";
}

mysqli_close($conexion);

echo(json_encode($jsondata));
?>