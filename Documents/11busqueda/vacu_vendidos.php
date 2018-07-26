<?
$ruta_a_joomla = "/../../Sganadero/";

define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).$ruta_a_joomla ));
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$userx = &JFactory::getUser();
	$usuario= $userx->username;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
?>
<?php require_once('Connections/conexion.php'); ?>
<?php
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

mysql_select_db($database_conexion, $conexion);
$query_vend = "SELECT id_vacuno, raza, sexo, hierro FROM d89xz_salidas_venta ORDER BY id DESC";
$vend = mysql_query($query_vend, $conexion) or die(mysql_error());
$row_vend = mysql_fetch_assoc($vend);
$totalRows_vend = mysql_num_rows($vend);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vacunos  Vendidos</title>

<style type="text/css">
.c {
	color: #FFF;
}
</style>
</head>

<body>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">
<img src="idsolutions--este.png" width="162" height="59" />
<table width="550" border="1">
  <tr class="c">
    <th bgcolor="#4D68A2">Vacuno</th>
    <th bgcolor="#4D68A2">Raza</th>
    <th bgcolor="#4D68A2">Sexo</th>
    <th bgcolor="#4D68A2">Hierro</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_vend['id_vacuno']; ?></td>
      <td><?php echo $row_vend['raza']; ?></td>
      <td><?php echo $row_vend['sexo']; ?></td>
      <td><?php echo $row_vend['hierro']; ?></td>
    </tr>
    <?php } while ($row_vend = mysql_fetch_assoc($vend)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($vend);
?>
</DIV> 

<script language="Javascript">

  function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 

</script> 