<?php

/*

este es el archivo es controlador de la vista para mostrar los eventos no repetidos, el cual se encarga de llamar 
las vistas de html las cuales contienen la informacion a mostrar en el navegador.

desing by  Fredis Vergara
*/
require_once('joom.php');
require_once('../../Connections/conexion.php');

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

    include('../views/procesos.php');//esta vista muestra el resto de informacion del formulario
}