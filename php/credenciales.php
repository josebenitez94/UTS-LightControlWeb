<?php
function conectDB($dbtarjeteros){

$db_host="localhost";
$db_usuario="root";
$db_contra="";

if(!($conexion=mysqli_connect($db_host, $db_usuario, $db_contra))){
	echo "error conectando a db";
	exit();
}

if(!(mysqli_select_db($conexion, $dbtarjeteros))){
		echo "error seleccionando base de datos";
		exit();
	}
return($conexion);
}

?>

