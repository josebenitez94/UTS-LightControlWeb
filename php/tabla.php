<?php 
require("credenciales.php");

$jsondata=array();

$conexion=conectDB("dbtarjeteros");
$consulta="select * from (select * from acceso group by `Fecha` DESC) as a group by a.`Salon`";
$resultado=mysqli_query($conexion, $consulta);

$tabla="<table width='100%' cellspacing='0'>".
        "<thead>".
        "<tr>".
        "<th>Fecha</th>".
        "<th>ID de Tarjeta</th>".
        "<th>Salon</th>".
        "<th>Estado de luz</th>".
        "</tr>".
        "</thead>".
        "<tfoot>".
        "<tr>".
        "<th>Fecha</th>".
        "<th>ID de Tarjeta</th>".
        "<th>Salon</th>".
        "<th>Estado de luz</th>".
        "</tr>".
        "</tfoot>".
        "<tbody>";

$color="Apagado";
while($resultado_=mysqli_fetch_row($resultado)){
  if($resultado_[2]=="Encendido"){
    $color="green";
  }
  else{
    $color="gray";
  }

  $tabla=$tabla.  
       "<tr>".
       "<td style='background:".$color.";color: white;'>".$resultado_[0]."</td>".
       "<td style='background:".$color.";color: white;'>".$resultado_[1]."</td>".
       "<td style='background:".$color.";color: white;'>".$resultado_[3]."</td>".
       "<td style='background:".$color.";color: white;'>".$resultado_[2]."</td>".
       "</tr>";
}

$tabla=$tabla."</body>";
mysqli_close($conexion);

$jsondata['tabla']=$tabla;
echo(json_encode($jsondata));
?>