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

@$jorn=$_GET['jorn'];
@$tipo=$_GET['tipo'];
@$tarea=$_GET['tarea'];

mysql_select_db($database_conexion, $conexion);
$query_tar = "SELECT * FROM d89xz_tareas WHERE fecha='$jorn' and comen='$tipo' and tarea= '$tarea' and estado='Pendiente'";
$tar = mysql_query($query_tar, $conexion) or die(mysql_error());
$row_tar = mysql_fetch_assoc($tar);
$totalRows_tar = mysql_num_rows($tar);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<table width="99%" border="0" align="center">
  <tr>
    <td width="453" height="61" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></td>
    <td align="right"><a href="loco.php?fecha=<?php echo $row_tar['fecha']; ?>"><img src="last.png" alt="" width="29" height="31" /></a></td>
  </tr>
</table>
<table width="99%" align="center">
  <tr>
    <td colspan="4" bgcolor="#4D68A2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" style="font-weight: bold">&nbsp;</td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <td width="31%" style="font-weight: bold">Actividad</td>
    <td width="28%"><?php echo $row_tar['comen']; ?></td>
    <td width="22%" style="font-weight: bold">Ref. N°</td>
    <td width="19%"><strong><?php echo $row_tar['jorn']; ?></strong></td>
  </tr>
  <tr>
    <td style="font-weight: bold">Hacienda</td>
    <td><?php echo $row_tar['hac']; ?></td>
    <td style="font-weight: bold">Fecha Jornada</td>
    <td><?php echo $row_tar['fecha']; ?></td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <td bgcolor="#f0f0f0" style="font-weight: bold">Responsable  De La  Jornada</td>
    <td><?php echo $row_tar['respon']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Comentarios</strong></td>
    <td colspan="3"><?php echo $row_tar['tarea']; ?></td>
  </tr>
  <tr bgcolor="#f0f0f0">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Estado</strong></td>
    <th><?php echo $row_tar['estado']; ?></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#4D68A2">
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($tar);
?>
