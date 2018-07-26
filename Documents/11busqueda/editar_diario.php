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
$query_edt = "SELECT * FROM d89xz_tareas ORDER BY fecha_ini DESC";
$edt = mysql_query($query_edt, $conexion) or die(mysql_error());
$row_edt = mysql_fetch_assoc($edt);
$totalRows_edt = mysql_num_rows($edt);mysql_select_db($database_conexion, $conexion);
$query_edt = "SELECT * FROM d89xz_tareas ORDER BY fecha_ini DESC";
$edt = mysql_query($query_edt, $conexion) or die(mysql_error());
$row_edt = mysql_fetch_assoc($edt);
$totalRows_edt = mysql_num_rows($edt);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.x {
	color: #FFF;
}
</style>
 <style> 
a{text-decoration:none} 
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>

  
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="alert.php" >Alertas</a>    </li>
    <li><a href="diario.php">Pendientes</a></li>
    <li><a href="editar_diario.php" class="current">Editar Pendientes</a>    </li>
</ul>
  <p>&nbsp;</p>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr class="x">
  
    <th width="347" bgcolor="#4D68A2">Tarea</th>
    <th width="91" bgcolor="#4D68A2">Fecha Inicio</th>
    <th width="91" bgcolor="#4D68A2">Fecha Final</th>
    <th width="78" bgcolor="#4D68A2">Estado</th>
    <th colspan="2" bgcolor="#4D68A2">Operaciones</th>
  </tr>
  <?php do { ?>
    <tr>
      
      <td><?php echo $row_edt['tarea']; ?></td>
      <td><?php echo $row_edt['fecha_ini']; ?></td>
      <td><?php echo $row_edt['fecha']; ?></td>
      <td><?php echo $row_edt['estado']; ?></td>
      <?php $idedt= $row_edt['id']; ?>
      <td width="59"><a href="actua_estado_tareas.php?id=<?php echo $row_edt['id']; ?>">Modificar</a></td>
      <td width="59"><a href="borrar_tarea.php?id=<?php echo $row_edt['id']; ?>">Eliminar</a></td>
    </tr>
    <?php } while ($row_edt = mysql_fetch_assoc($edt)); ?>
</table>
<form id="form1" name="form1" method="post" action="">
  <input name="hiddenField" type="hidden" id="hiddenField" value="{edt.id}" />
</form>
</body>
</html>
<?php
mysql_free_result($edt);
?>


