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
$query_pp = "SELECT * FROM d89xz_vacunos WHERE estrepr = 'PP'";
$pp = mysql_query($query_pp, $conexion) or die(mysql_error());
$row_pp = mysql_fetch_assoc($pp);
$totalRows_pp = mysql_num_rows($pp);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
 <style> 
a{text-decoration:none} 
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>


<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php">B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php" class="current">Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="jornada_peso1.php">Peso</a></li>
  <li><a href="traslado.php">Traslados</a></li>
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="jornada_palpacion.php" >Agenda / Grupo</a>  </li>
  <li><a href="palpacion2.php" >Individual</a></li>
  <li><a href="palpacion_pp.php"  class="current">Confirmar  (PP)</a></li>
  <li><a href="jornada_palpacion_detalle.php">Reportes</a>  </li>
 
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>ID</th>
    <th>Hierro</th>
    <th>Raza</th>
    <th>Edad</th>
    <th>E. Fisiol.</th>
    <th>E. Repr.</th>
    <th>Ubicacion</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_pp['id_vacuno']; ?></td>
      <td align="center"><?php echo $row_pp['hierro']; ?></td>
      <td align="center"><?php echo $row_pp['raza']; ?></td>
      <td align="center"><?php echo $row_pp['edad']; ?></td>
      <td align="center"><?php echo $row_pp['tp_rep']; ?></td>
      <td align="center"><a href="palpacion_paraPP.php?vaca=<?php echo $row_pp['id_vacuno']; ?>&amp;id_vacuno=<?php echo $row_pp['id_vacuno']; ?>"><?php echo $row_pp['estrepr']; ?></a></td>
      <td align="center"><?php echo $row_pp['ubicasion']; ?></td>
    </tr>
    <?php } while ($row_pp = mysql_fetch_assoc($pp)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($pp);
?>
