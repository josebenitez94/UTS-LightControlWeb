<?php 
require("credenciales.php");
date_default_timezone_set('America/Bogota');

$correcto=false;
$numTarjeta=$_POST['ID'];
$salon=$_POST['lugar'];
$estado=$_POST['estado'];
$respuesta=array();

$conexion=conectDB("dbtarjeteros");
$consulta="select COUNT(*) from `usuario` where `ID_Tarjeta`='$numTarjeta'";
$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));

if($resultado[0]>0){
	$diaActual=date("Y-m-d");
	$consulta="SELECT `HorarioInicial`,`HorarioFinal`,`DiaSemana`,ELT(WEEKDAY('$diaActual')+1,'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo') FROM `horarioclase` WHERE ((`ID_Tarjeta`='$numTarjeta' AND `Salon`='$salon'))";
	$mensaje="Este salon no hace parte de sus itinerarios educativos";
	$resultado=mysqli_query($conexion, $consulta);
	while($resultado_=mysqli_fetch_row($resultado)){
		$horaIni=date("H:i:s",strtotime($resultado_[0]));
		$horaFin=date("H:i:s",strtotime($resultado_[1]));
		$horaActual=date("H:i:s");
		$diaSemana=$resultado_[2];
		$diaSemanaAct=$resultado_[3];

		if($horaActual>$horaIni && $horaActual<$horaFin && $diaSemana==$diaSemanaAct){
			$correcto=true;
		}
	}

	if($correcto==true){
		$consulta="SELECT `Nombre` FROM `usuario` WHERE `ID_Tarjeta`='$numTarjeta'";
		$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));
		if($estado=="Apagado"){
			$mensaje="Bienvenido a clases profe ".$resultado[0];
			$consulta="INSERT INTO `acceso`(`ID_Tarjeta`, `Estado`, `Salon`) VALUES ('$numTarjeta','Encendido','$salon')";
			mysqli_query($conexion, $consulta);
		}
		else{
			$mensaje="Adios profe ".$resultado[0]." Gracias por tus servicios!";
			$consulta="INSERT INTO `acceso`(`ID_Tarjeta`, `Estado`, `Salon`) VALUES ('$numTarjeta','Apagado','$salon')";
			mysqli_query($conexion, $consulta);
		}
		
	}
	else{
		$mensaje="No tiene clase ahorita en este salon!";
	}
	echo($mensaje);
}
else{
	echo("No Existe el usuario en la base de datos");
}


//echo("holita");

/*
$conexion=conectDB("dbtarjeteros");
$consulta="SELECT `Rol` FROM `usuario` WHERE `ID_Tarjeta`='$numTarjeta'";
$resultado=mysqli_query($conexion, $consulta);
$resultado_=mysqli_fetch_row($resultado);
$respuesta[0]=$resultado_[0];

if($respuesta[0]=='Docente'){
	echo("El inscrito es un docente");
	$respuesta[1]="50";
}
else{
	$consulta="INSERT INTO `acceso`(`ID_Tarjeta`, `Lugar`, `Estado`) VALUES ('$numTarjeta','$salon','Encendido')";
	mysqli_query($conexion, $consulta);
	echo("El inscrito es un estudidiante");
	$respuesta[1]="15";
}
echo("{Rol:".$respuesta[0].",timeLight:".$respuesta[1]."}");
mysqli_close($conexion);

SELECT 
FROM `horarioclase` 
WHERE ((`ID_Tarjeta`='ABC123') AND (`Salon`='3') AND (`DiaSemana`='Lunes') AND ('16:30:00' BETWEEN `HorarioInicial` AND `HorarioFinal`)) LIMIT 1
*/


/*
$jsondata=array();
$conexion=conectDB("dbtarjeteros");
$consulta="INSERT INTO `acceso`(`ID_Tarjeta`, `Lugar`, `Estado`) VALUES ('FFAABBCC','esp8266','Encendido')";
$resultado=mysqli_query($conexion, $consulta);
mysqli_close($conexion);
$jsondata['HTMLResponse']=":D";
echo(json_encode($jsondata));
*/
?>