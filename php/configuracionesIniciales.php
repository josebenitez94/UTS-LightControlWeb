<?php 
require("credenciales.php");

$jsondata=array();
$salones=array();
$jsondata['HTMLResponse']="<option value='Seleccione'>Seleccione el Rol del Usuario</option>";

$conexion=conectDB("dbtarjeteros");
$consulta="SELECT `Salon` FROM `salones`";
$resultado=mysqli_query($conexion, $consulta);
$i=0;
while($resultado_=mysqli_fetch_row($resultado)){
	$salones[$i]="<option value='$resultado_[0]'>$resultado_[0]</option>";
	$i++;
}

mysqli_close($conexion);

$jsondata['HTMLResponse']=$salones;
echo(json_encode($jsondata));
?>