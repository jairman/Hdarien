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
	$query = "SELECT * FROM  d89xz_procesos WHERE id = '$id' and `delete`= '0'";
	$result = mysql_query($query) or die('error en la consulta');
	//echo mysql_num_rows($result);
	if (!mysql_num_rows($result)==0){
		$i=0;
		$datos = array();
		while ($rows = mysql_fetch_array($result)) {
			$nombre=$rows['nombre'];
			$descripcion=$rows['descripcion'];
			$codigo=$rows['codigo'];
			$i++;
		}
		/*$json = json_encode($datos);
		echo $json;		*/
	}

include('../views/mostrarProcesos.php');
}
?>