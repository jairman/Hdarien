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

$colname_pen = "-1";
if (isset($_GET['fecha'])) {
  $colname_pen = $_GET['fecha'];
}
mysql_select_db($database_conexion, $conexion);
$query_pen = sprintf("SELECT * FROM d89xz_tareas WHERE estado ='Pendiente' and fecha = %s", GetSQLValueString($colname_pen, "date"));
$pen = mysql_query($query_pen, $conexion) or die(mysql_error());
$row_pen = mysql_fetch_assoc($pen);
$totalRows_pen = mysql_num_rows($pen);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <th align="center" bgcolor="#f0f0f0"><a href="index.php"><img src="last.png" alt="" width="29" height="31" /></a></th>
  </tr>
</table>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <td colspan="4" bgcolor="#FFFFFF"><img src="idsolutions--este.png" alt="" width="162" height="59" /></td>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="4">Resumen  Programación  Jornadas</th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="13%">Jornada</th>
    <th width="23%">Tipo De  Jornada</th>
    <th width="59%">Comentario</th>
    <th width="5%">&nbsp;</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_pen['jorn']; ?></td>
      <td><?php echo $row_pen['comen']; ?></td>
      <td><?php echo $row_pen['tarea']; ?></td>
      <td><a href="loco_detalle.php?jorn=<?php echo $row_pen['fecha']; ?>&amp;tipo=<?php echo $row_pen['comen']; ?>&amp;tarea=<?php echo $row_pen['tarea']; ?>"><img src="buscar.jpg" width="27" height="27" border="0" /></a></td>
    </tr>
    <?php } while ($row_pen = mysql_fetch_assoc($pen)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($pen);
?>
