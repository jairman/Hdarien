<?php
require_once('joom.php');
require_once('../../Connections/conexion.php');
date_default_timezone_set('America/Bogota');

    $id=$_GET['id'];
	$query = "SELECT * FROM  d89xz_tareas WHERE id = '$id' and `delete`= '0'";
	$result = mysql_query($query) or die('error en la consulta');
	//echo mysql_num_rows($result);
	if (!mysql_num_rows($result)==0){
		$i=0;
		$datos = array();
		while ($rows = mysql_fetch_array($result)) {
			$fecha=$rows['fecha_actividad'];
			$hora_ini=$rows['hora_ini'];
			$hora_fin=$rows['hora_fin'];
			$hora_fin=$rows['hora_fin'];
			$actividad=$rows['actividad'];
			$descripcion=$rows['descripcion'];
			$comen=$rows['comen'];
			$lugar=$rows['lugar'];
			$punto_venta=$rows['punto_venta'];
			$responsable=$rows['responsable'];
			$destino=$rows['lugar'];
			$i++;
		}
		/*$json = json_encode($datos);
		echo $json;		*/
	}

include('../views/mostrar.php');
?>