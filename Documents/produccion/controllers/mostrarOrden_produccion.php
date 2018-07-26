<?php
require_once('joom.php');
require_once('../../Connections/conexion.php');
date_default_timezone_set('America/Bogota');
if ($acceso !='0'){
include ('../views/acceso.php');//vista que informa al user que debe estar logueado
}
else{
    if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
      if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
      }

      $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

      switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;    
        case "long":
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "double":
          $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
          break;
        case "date":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "defined":
          $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
          break;
      }
      return $theValue;
    }
    }

    $id=$_GET['id'];
    //echo $id;
	$query = "SELECT nombre,tb1.consecutivo,id_ficha,fecha_inicio,fecha_fin,cantidad,tb1.creado as creado FROM d89xz_orden_produccion as tb1,d89xz_ficha_tecnica as tb2 WHERE tb1.id = '$id' and id_ficha=tb2.consecutivo";
	//echo $query;
	$result = mysql_query($query) or die('error en la consulta');
	//echo mysql_num_rows($result);
	if (!mysql_num_rows($result)==0){
		$i=0;
		$datos = array();
		while ($rows = mysql_fetch_array($result)) {
			$nombre=$rows['nombre'];
			$consecutivo=$rows['consecutivo'];
			$id_ficha=$rows['id_ficha'];
			$fecha_inicio=$rows['fecha_inicio'];
			$fecha_fin=$rows['fecha_fin'];
			$cantidad=$rows['cantidad'];
			$fecha=$rows['creado'];
			$i++;
		}
		/*$json = json_encode($datos);
		echo $json;		*/
	}

include('../views/mostrarOrden_produccion.php');
}
?>