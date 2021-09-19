<?php

//datos.php

include('dbconect.php');

$column = array("idp", "personal_nombre", "personal_edad", "personal_salario", "estado");

$query = "SELECT `seguimiento`.`fecha` as `idp`, `usuario`.`nombre` as `personal_nombre`, `usuario`.`rol` as `personal_edad`, `salon`.`salon` as `personal_salario`, `seguimiento`.`estado` as `estado` FROM `seguimiento` LEFT JOIN `tarjeta` ON `seguimiento`.`idTarjeta` = `tarjeta`.`idTarjeta` LEFT JOIN `salon` ON `salon`.`idLector`= `seguimiento`.`idLector` LEFT JOIN `usuario` ON `usuario`.`cedula` = `tarjeta`.`cedula` ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE `usuario`.`nombre` LIKE "%'.$_POST["search"]["value"].'%" 
 OR `usuario`.`rol` LIKE "%'.$_POST["search"]["value"].'%" 
 OR `salon`.`salon` LIKE "%'.$_POST["search"]["value"].'%" 
 OR `seguimiento`.`fecha` LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY idp desc ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['idp'];
 $sub_array[] = $row['personal_nombre'];
 $sub_array[] = $row['personal_edad'];
 $sub_array[] = $row['personal_salario'];
 $sub_array[] = $row['estado'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM personal";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

echo json_encode($output);

?>
