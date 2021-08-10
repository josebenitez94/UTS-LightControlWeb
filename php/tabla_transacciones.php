<?php 
require("credenciales.php");

$jsondata=array();

$conexion=conectDB("dbtarjeteros");
$consulta="SELECT a.Fecha,u.Cedula,concat(u.Nombre,' ',u.Apellido),h.salon,a.Estado,h.HorarioInicial,h.HorarioFinal FROM horarioclase h left join acceso a on a.ID_Tarjeta=h.ID_Tarjeta left join usuario u on u.ID_Tarjeta=h.ID_Tarjeta GROUP by fecha order by fecha DESC";
$resultado=mysqli_query($conexion, $consulta);

$tabla="<table width='100%' cellspacing='0'>".
        "<thead>".
        "<tr>".
        "<th>Fecha</th>".
        "<th>Cedula</th>".
        "<th>Nombre</th>".
        "<th>Salon</th>".
        "<th>Operacion</th>".
        "<th>Nota</th>".
        "</tr>".
        "</thead>".
        "<tfoot>".
        "<tr>".
        "<th>Fecha</th>".
        "<th>Cedula</th>".
        "<th>Nombre</th>".
        "<th>Salon</th>".
        "<th>Operacion</th>".
        "<th>Nota</th>".
        "</tr>".
        "</tfoot>".
        "<tbody>";

while($resultado_=mysqli_fetch_row($resultado)){
$fecha=$resultado_[0];
$cedula=$resultado_[1];
$nombre=$resultado_[2];
$salon=$resultado_[3];
$estado=$resultado_[4];
$horaIni=$resultado_[5];
$horaFin=$resultado_[6];
$ejecutar=false;
$nota="probando";
if($fecha==""){
  $estado="nulo";
  $ejecutar=true;
  $nota="No accedio";
  $fecha="NA";
}

if($estado=="Encendido"){
  $horaAcceso=date("H:i:0",strtotime($fecha));
  $horaClase=date("H:i:0",strtotime($horaIni));
  if($horaAcceso>$horaClase){
    $nota="Retraso";
    $ejecutar=true;
  }
}
if($estado=="Apagado"){
  $horaAcceso=date("H:i:0",strtotime($fecha));
  $horaClase=date("H:i:0",strtotime($horaFin));
  if($horaAcceso<$horaClase){
    $nota="Inclumplido";
    $ejecutar=true;
  }
}


if($ejecutar==true){
  $tabla=$tabla.  
       "<tr>".
       "<td>".$fecha."</td>".
       "<td>".$cedula."</td>".
       "<td>".$nombre."</td>".
       "<td>".$salon."</td>".
       "<td>".$estado."</td>".
       "<td>".$nota."</td>".
       "</tr>";
}
}

$tabla=$tabla."</body>";
mysqli_close($conexion);

$jsondata['tabla']=$tabla;
echo(json_encode($jsondata));
?>