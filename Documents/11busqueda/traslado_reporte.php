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
$query_RE = "SELECT DISTINCT  finca_esta, respon, fecha FROM d89xz_traslados";
$RE = mysql_query($query_RE, $conexion) or die(mysql_error());
$row_RE = mysql_fetch_assoc($RE);
$totalRows_RE = mysql_num_rows($RE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>
 <style> 
a{text-decoration:none} 
</style>
</head>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>


<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php" >B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php">Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="jornada_peso1.php" >Peso</a></li>
  <li><a href="traslado.php" class="current">Traslados</a></li>
</ul>

<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="traslado1.php">Traslados</a></li>
  <li><a href="traslado_reporte.php" class="current" >Reportes</a></li>
</ul>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>Hacienda</th>
    <th>Responsable</th>
    <th>Fecha</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><a href="traslado_reporte_detalle.php?fecha=<?php echo $row_RE['fecha']; ?>&amp;resp=<?php echo $row_RE['respon']; ?>&amp;finca=<?php echo $row_RE['finca_esta']; ?>"><?php echo $row_RE['finca_esta']; ?></a></td>
      <td><?php echo $row_RE['respon']; ?></td>
      <td><?php echo $row_RE['fecha']; ?></td>
    </tr>
    <?php } while ($row_RE = mysql_fetch_assoc($RE)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($RE);
?>
