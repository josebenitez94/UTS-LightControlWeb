<?php 
require("credenciales.php");

$mac=$_POST['mac'];
$salon=$_POST['salon'];

$jsondata=array();
$jsondata['HTMLResponse']="inicio";

$conexion=conectDB("lightcontroldb");
$consulta="SELECT count(*) FROM `salon` WHERE `idLector`='$mac'";
$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));

if($resultado[0] == 0){
	$consulta="INSERT INTO `salon`(`idLector`, `salon`) VALUES ('$mac','$salon')";
	mysqli_query($conexion, $consulta);
	$jsondata['HTMLResponse']="OK";
}
else{
	$jsondata['HTMLResponse']="NO";
}

echo(json_encode($jsondata));
mysqli_close($conexion);


?>