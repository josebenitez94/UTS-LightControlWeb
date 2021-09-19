<?php 
require("credenciales.php");
date_default_timezone_set('America/Bogota');

$jsondata=array();

$conexion=conectDB("lightcontroldb");
$consulta="SELECT `seguimiento`.`fecha`, `usuario`.`nombre`, `usuario`.`rol`, `salon`.`salon`, `seguimiento`.`estado` FROM `seguimiento` LEFT JOIN `tarjeta` ON `seguimiento`.`idTarjeta` = `tarjeta`.`idTarjeta` LEFT JOIN `salon` ON `salon`.`idLector`= `seguimiento`.`idLector` LEFT JOIN `usuario` ON `usuario`.`cedula` = `tarjeta`.`cedula` WHERE 1 ORDER BY `seguimiento`.`fecha` DESC";
$resultado=mysqli_query($conexion, $consulta);

$tabla="<table width='100%'>".
        "<thead>".
        "<tr>".
        "<th>FECHA</th>".
        "<th>NOMBRE</th>".
        "<th>ROL</th>".
        "<th>SALON</th>".
        "<th>Estado</th>".
        "<th>CONECTIVIDAD</th>".
        "</tr>".
        "</thead>".
        "<tfoot>".
        "<tr>".
        "<th>FECHA</th>".
        "<th>NOMBRE</th>".
        "<th>ROL</th>".
        "<th>SALON</th>".
        "<th>Estado</th>".
        "<th>CONECTIVIDAD</th>".
        "</tr>".
        "</tfoot>".
        "<tbody>";

$color="gray";

while($resultado_ = mysqli_fetch_row($resultado)){
  /*
  if($resultado_[2]=="Encendido"){
    $color="green";
  }
  else{
    $color="gray";
  }
*/
  $tabla=$tabla.  
       "<tr>".
       "<td style='background:".$color.";color: red;'>".$resultado_[0]."</td>".
       "<td style='background:".$color.";color: red;'>".$resultado_[1]."</td>".
       "<td style='background:".$color.";color: red;'>".$resultado_[2]."</td>".
       "<td style='background:".$color.";color: red;'>".$resultado_[3]."</td>".
       "<td style='background:".$color.";color: red;'>".$resultado_[4]."</td>".
       "</tr>";
}

$tabla=$tabla."</body>";
mysqli_close($conexion);

$jsondata['tabla']=$tabla;
echo(json_encode($jsondata));
?>