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
$query_pal = "SELECT * FROM d89xz_detalle_palpacion WHERE estado = 'VCN' and es !='2' ORDER BY f_palpa DESC";
$pal = mysql_query($query_pal, $conexion) or die(mysql_error());
$row_pal = mysql_fetch_assoc($pal);
$totalRows_pal = mysql_num_rows($pal);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
 <style> 
a{text-decoration:none} 
</style>
</head>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>

<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>


<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="index.php" >Agenda Mes</a>  </li>
  <li><a href="busqueda_jornada.php">B&uacute;squeda</a>  </li>
  <li><a href="jornada_palpacion.php" >Palpaci&oacute;n</a></li>
  <li><a href="inseminacion2_act.php" class="current">Inseminaci&oacute;n</a>  </li>
  <li><a href="diario_pendientes.php">Vacunas</a></li>
  <li><a href="jornada_peso1.php">Peso</a></li>
  <li><a href="traslado.php">Traslados</a></li>
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="inseminacion2_act.php" class="current">Inseminaci&oacute;n</a>  </li>
  <li><a href="inseminacion2_act_reporte.php">Reporte</a>  </li>
 
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="4" bgcolor="#FFFFFF" style="color: #FFF"><img src="idsolutions--este.png" width="177" height="61" /></td>
  </tr>
  <tr>
    <th colspan="4" bgcolor="#4D68A2" style="color: #FFF">Vacas Por  Inseminar</th>
  </tr>
  <tr>
    <th>Vaca</th>
    <th>Fecha Palpación</th>
    <th>Estado</th>
    <th>Inseminación</th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_pal['vaca']; ?></td>
      <td align="center"><?php echo $row_pal['f_palpa']; ?></td>
      <td align="center"><?php echo $row_pal['estado']; ?></td>
      <td align="center"><a href="inseminacion.php?id_vacuno=<?php echo $row_pal['vaca']; ?>&amp;id=<?php echo $row_pal['id']; ?>">Inseminación</a></td>
    </tr>
    <?php } while ($row_pal = mysql_fetch_assoc($pal)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($pal);
?>
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