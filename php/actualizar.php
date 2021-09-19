<?php 
require("credenciales.php");
date_default_timezone_set('America/Bogota');

$mac=$_GET['mac'];

$consulta="UPDATE `linestate` SET `status`='online' WHERE `mac`= '$mac'";
mysqli_query($conexion, $consulta);
?>