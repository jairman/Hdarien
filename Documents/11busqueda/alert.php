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
$query_alt = "SELECT tarea, fecha_ini, fecha, estado FROM d89xz_tareas WHERE `fecha` >= CURDATE()   AND `fecha` <= DATE_ADD(CURDATE(), INTERVAL  2 DAY) ORDER BY fecha ASC";
$alt = mysql_query($query_alt, $conexion) or die(mysql_error());
$row_alt = mysql_fetch_assoc($alt);
$totalRows_alt = mysql_num_rows($alt);

mysql_select_db($database_conexion, $conexion);
$query_caja = "SELECT concep, descrip, estado, v_tal,cliente,f_alarma,factura FROM d89xz_diario WHERE estado='Pendiente' AND `f_alarma` >= CURDATE()   AND `f_alarma` <= DATE_ADD(CURDATE(), INTERVAL  2 DAY) ORDER BY f_alarma ASC";
$caja = mysql_query($query_caja, $conexion) or die(mysql_error());
$row_caja = mysql_fetch_assoc($caja);
$totalRows_caja = mysql_num_rows($caja);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.c {
	color: #FFF;
}
#v {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>

  
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="alert.php" class="current">Alertas</a>    </li>
    <li><a href="diario.php">Pendientes</a></li>
    <li><a href="editar_diario.php" >Editar Pendientes</a>    </li>
</ul>
  <p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <th colspan="4" bgcolor="#4D68A2"><span class="c">Tareas pendientes por cumplir  con dos (2) días de anticipación</span></th>
  </tr>
  <tr>
    <th width="400" bgcolor="#4D68A2"><span class="c">Tarea</span></th>
    <th width="97" bgcolor="#4D68A2"><span class="c"> Fecha Inicio </span></th>
    <th width="97" bgcolor="#4D68A2"><span class="c"> Fecha Final </span></th>
    <th width="78" bgcolor="#4D68A2"><span class="c"> Estado </span></th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_alt['tarea']; ?></td>
      <td><?php echo $row_alt['fecha_ini']; ?></td>
      <td><?php echo $row_alt['fecha']; ?></td>
      <td><?php echo $row_alt['estado']; ?></td>
    </tr>
    <?php } while ($row_alt = mysql_fetch_assoc($alt)); ?>
</table>
<table width="100%" border="1" cellspacing="0">
  <tr bgcolor="#4D68A2">
    <th colspan="6" bgcolor="#FFFFFF">&nbsp;</th>
  </tr>
  <tr bgcolor="#4D68A2">
    <th colspan="6"><span class="c">Pendientes Caja   con dos (2) días de anticipación</span></th>
    </tr>
  <tr bgcolor="#4D68A2" id="v">
    <th width="85">Factura</th>
    <th width="203">Descripción</th>
    <th width="84">Estado</th>
    <th width="73">Valor</th>
    <th width="119">Cliente</th>
    <th width="96">Fecha  Límite</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_caja['factura']; ?></td>
      <td><?php echo $row_caja['descrip']; ?></td>
      <td><?php echo $row_caja['estado']; ?></td>
      <td><?php echo number_format ($row_caja['v_tal']); ?></td>
      <td><?php echo $row_caja['cliente']; ?></td>
      <td><?php echo $row_caja['f_alarma']; ?></td>
    </tr>
    <?php } while ($row_caja = mysql_fetch_assoc($caja)); ?>
</table>
</DIV>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($alt);

mysql_free_result($caja);


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