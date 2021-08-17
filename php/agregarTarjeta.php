<?php 
require("credenciales.php");

$identificacion=$_POST['identificacion'];
$tarjetas=$_POST['tarjetas'];

$jsondata=array();
$jsondata['HTMLResponse']="ID ERROR";

$conexion=conectDB("lightcontroldb");
$consulta="SELECT count(*) FROM `usuario` WHERE `cedula`='$identificacion'";
$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));
if($resultado[0] == 1){
	$consulta="SELECT count(*) FROM `tarjeta` WHERE `idTarjeta`='$tarjetas'";
	$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));
	if($resultado[0]==0){
		$consulta="INSERT INTO `tarjeta`(`idTarjeta`, `cedula`) VALUES ('$tarjetas','$identificacion')";
		mysqli_query($conexion, $consulta);
		$jsondata['HTMLResponse']="OK";
	}
	else{
		$jsondata['HTMLResponse']="TARJETA ERROR";
	}
}
else{
	$jsondata['HTMLResponse']="ID ERROR";
}

mysqli_close($conexion);

echo(json_encode($jsondata));
?>