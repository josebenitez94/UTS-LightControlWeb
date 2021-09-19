<?php
include_once('PDF.php');
include_once('credenciales.php');

$pdf = new PDF();
 
$pdf->AddPage();

$pdf->SetTitle('Reporte de Accesos');
$pdf->SetAuthor('josebenitez94@github.com');
$pdf->SetCreator('FPDF Maker');

$pdf->Image('../images/uts.jpg', null, null, 40);
$pdf->renderTitle('                    Reporte PDF de Accesos');


$miCabecera = array('Fecha', 'Nombre', 'Rol', 'Salon', 'Estado');

$conexion=conectDB("lightcontroldb");
$consulta="SELECT `seguimiento`.`fecha` as `idp`, `usuario`.`nombre` as `personal_nombre`, `usuario`.`rol` as `personal_edad`, `salon`.`salon` as `personal_salario`, `seguimiento`.`estado` as `estado` FROM `seguimiento` LEFT JOIN `tarjeta` ON `seguimiento`.`idTarjeta` = `tarjeta`.`idTarjeta` LEFT JOIN `salon` ON `salon`.`idLector`= `seguimiento`.`idLector` LEFT JOIN `usuario` ON `usuario`.`cedula` = `tarjeta`.`cedula` where 1 order by `seguimiento`.`fecha` desc";
$resultado=(mysqli_query($conexion, $consulta));


$misDatos = array();
while($row = mysqli_fetch_row($resultado)){
    array_push($misDatos, array('fecha' => $row[0], 'nombre' => $row[1], 'rol' => $row[2], 'salon' => $row[3], 'estado' => $row[4]));
}

/*
$misDatos = array(
            array('nombre' => 'Hugo', 'apellido' => 'Martínez', 'matricula' => '20420423'),
            array('nombre' => 'Araceli', 'apellido' => 'Morales', 'matricula' =>  '204909'),
            array('nombre' => 'Georgina', 'apellido' => 'Galindo', 'matricula' =>  '2043442'),
            array('nombre' => 'Luis', 'apellido' => 'Dolores', 'matricula' => '20411122'),
            array('nombre' => 'Mario', 'apellido' => 'Linares', 'matricula' => '2049990'),
            array('nombre' => 'Viridiana', 'apellido' => 'Badillo', 'matricula' => '20418855'),
            array('nombre' => 'Yadira', 'apellido' => 'García', 'matricula' => '20443335')
            );
 */
$pdf->tablaHorizontal($miCabecera, $misDatos);
 
$pdf->Output(); //Salida al navegador
?>