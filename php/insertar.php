<?php 
require("credenciales.php");
date_default_timezone_set('America/Bogota');

$id=$_GET['id'];
$mac=$_GET['mac'];
$tipo=$_GET['tipo'];

$jsondata=array();

$conexion=conectDB("lightcontroldb");
if($id!="" && $mac!="" && $tipo!=""){
	$consulta="SELECT count(*) FROM `tarjeta` WHERE `idTarjeta`='$id'";
	$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));
	if($resultado[0] > 0){
		$consulta="SELECT count(*) FROM `salon` WHERE `idLector`='$mac'";
		$resultado=mysqli_fetch_row(mysqli_query($conexion, $consulta));
		if($resultado[0] > 0){
			$fechaActual = date('Y-m-d H:i:s');

			$consulta = "SELECT usuario.rol FROM `seguimiento` INNER JOIN `tarjeta` ON `seguimiento`.`idTarjeta` = `tarjeta`.`idTarjeta` INNER JOIN `usuario` ON `tarjeta`.`cedula` = `usuario`.`cedula` WHERE seguimiento.idTarjeta = '$id' limit 1";
			$resultadoRolActual=mysqli_fetch_row(mysqli_query($conexion, $consulta));

			$consulta = "SELECT `usuario`.`rol` FROM `seguimiento` INNER JOIN `tarjeta` ON `seguimiento`.`idTarjeta` = `tarjeta`.`idTarjeta` INNER JOIN `usuario` ON `tarjeta`.`cedula` = `usuario`.`cedula`WHERE `idLector`='24:62:AB:D7:63:50' ORDER BY fecha DESC LIMIT 1";
			$resultadoRolAnterior=mysqli_fetch_row(mysqli_query($conexion, $consulta));

			$consulta = "SELECT `seguimiento`.`idTarjeta` FROM `seguimiento` INNER JOIN `tarjeta` ON `seguimiento`.`idTarjeta` = `tarjeta`.`idTarjeta`WHERE `idLector`='24:62:AB:D7:63:50' ORDER BY fecha DESC LIMIT 1";
			$resultadoIdAnterior=mysqli_fetch_row(mysqli_query($conexion, $consulta));

			$consulta="SELECT `estado` FROM `seguimiento` WHERE `idLector`='$mac' ORDER BY fecha DESC LIMIT 1";
			$resultadoEstado=mysqli_fetch_row(mysqli_query($conexion, $consulta));


			if($resultadoEstado=="apagado" || $resultadoEstado=="apagadoAuto"){
				$nextStatus = "encendido";
				$consulta="INSERT INTO `seguimiento`(`idTarjeta`, `idLector`, `fecha`, `estado`) VALUES ('$id','$mac','$fechaActual','$nextStatus')";
				if($resultadoRolActual[0] == "estudiante"){
					mysqli_query($conexion, $consulta);
					echo("15");
				}
				else if($resultadoRolActual[0] == "docente"){
					mysqli_query($conexion, $consulta);
					echo("90");
				}
				else if($resultadoRolActual[0] == "laboratorista"){
					mysqli_query($conexion, $consulta);
					echo("120");
				}
				else if($resultadoRolActual[0] == "coordinador"){
					mysqli_query($conexion, $consulta);
					echo("90");
				}
				else
					echo "0";	
			}

			if($resultadoRolActual[0] == "laboratorista" || $resultadoRolActual[0] == "coordinador"){
				$resultadoRolActual[0] = "docente";
				
			}

			if($resultadoEstado=="encendido" && $tipo=="normal")´{
				if($resultadoRolActual[0]=="estudiante"){
					if($resultadoRolAnterior[0] == "estudiante"){
						$nextStatus = "apagado";
						$consulta="INSERT INTO `seguimiento`(`idTarjeta`, `idLector`, `fecha`, `estado`) VALUES ('$id','$mac','$fechaActual','$nextStatus')";
						mysqli_query($conexion, $consulta);
						echo "0";
					}
					if($resultadoRolAnterior[0] == "docente"){
						echo "NADA";
					}
				}
				if($resultadoRolActual[0]=="docente"){
					if($resultadoRolAnterior[0] == "estudiante"){
						$nextStatus = "apagado";
						$consulta="INSERT INTO `seguimiento`(`idTarjeta`, `idLector`, `fecha`, `estado`) VALUES ('$id','$mac','$fechaActual','$nextStatus')";
						mysqli_query($conexion, $consulta);
						echo "0";
					}
					if($resultadoRolAnterior[0] == "docente" && $resultadoIdAnterior==$id){
						$fechaActualConsulta = date('H');
						if($fechaActualConsulta>=6 && $fechaActualConsulta<=5){
							echo "SLEEP";
						}
						else{
							$nextStatus = "apagado";
							$consulta="INSERT INTO `seguimiento`(`idTarjeta`, `idLector`, `fecha`, `estado`) VALUES ('$id','$mac','$fechaActual','$nextStatus')";
							mysqli_query($conexion, $consulta);
							echo "0";
						}
					}
					else{
						echo "NADA";
					}

				} 	
			}

			if($resultadoEstado=="encendido" && $tipo=="auto"){
				$nextStatus = "apagadoAuto";
				$consulta="INSERT INTO `seguimiento`(`idTarjeta`, `idLector`, `fecha`, `estado`) VALUES ('$id','$mac','$fechaActual','$nextStatus')";
				mysqli_query($conexion, $consulta);
				echo "0";
			}

			if($resultadoEstado=="encendido" && $tipo=="sleep" && $resultadoIdAnterior==$id){
				$nextStatus = "apagado";
				$consulta="INSERT INTO `seguimiento`(`idTarjeta`, `idLector`, `fecha`, `estado`) VALUES ('$id','$mac','$fechaActual','$nextStatus')";
				mysqli_query($conexion, $consulta);
				echo "0";
			}
		}
		else{
			echo("LECTOR_ERROR");
		}
	}
	else{
		echo("TARJETA_ERROR");
	}
}
else{
	echo("DATOS_ERROR");
}

mysqli_close($conexion);
?>