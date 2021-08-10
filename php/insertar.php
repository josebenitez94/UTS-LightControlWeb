<?php 
require("credenciales.php");
date_default_timezone_set('America/Bogota');

$numTarjeta=$_POST['ID'];
$salon=$_POST['lugar'];
$estado=$_POST['estado'];

$jsondata=array();

$conexion=conectDB("dbtarjeteros");
$consulta="INSERT INTO `acceso`(`ID_Tarjeta`, `Lugar`, `Estado`) VALUES ('FFAABBCC','esp8266','Encendido')";
$resultado=mysqli_query($conexion, $consulta);

mysqli_close($conexion);

$jsondata['HTMLResponse']=":D";
echo(json_encode($jsondata));
?>