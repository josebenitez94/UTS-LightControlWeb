<?php 
require("credenciales.php");

$identificacion=$_POST['identificacion'];
$salon=$_POST['salon'];
$diaSemana=$_POST['diaSemana'];
$horaInit=$_POST['horaInit'];
$horaFin=$_POST['horaFin'];

$jsondata=array();
$jsondata['HTMLResponse']="";

$conexion=conectDB("dbtarjeteros");
$consulta="SELECT count(*) FROM `usuario` WHERE `Cedula`='$identificacion'";
$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));
if($resultado[0]>0){
	$consulta="SELECT `ID_Tarjeta` FROM `usuario` WHERE `Cedula`='$identificacion' LIMIT 1";
	$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));
	$consulta="INSERT INTO `horarioclase`(`ID_Tarjeta`, `Salon`, `HorarioInicial`, `HorarioFinal`, `DiaSemana`) VALUES ('$resultado[0]','$salon','$horaInit','$horaFin','$diaSemana')";
	$resultado=mysqli_query($conexion, $consulta);
	$jsondata['HTMLResponse']="datos guardados exitosamente";
}
else{
	$jsondata['HTMLResponse']="la identificación no esta asociada a ninguna base de datos del sistema";
}

mysqli_close($conexion);

echo(json_encode($jsondata));
?>