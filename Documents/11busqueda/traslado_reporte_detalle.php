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

@$resp=$_GET['resp'];
@$finca=$_GET['finca'];
@$fecha=$_GET['fecha'];


mysql_select_db($database_conexion, $conexion);
$query_RE = sprintf("SELECT * FROM d89xz_traslados WHERE fecha = '$fecha' and respon ='$resp' and finca_esta='$finca' ");
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
 <li><a href="traslado1.php" >Traslados</a></li>
  <li><a href="traslado_reporte.php" class="current" >Reportes</a></li>
</ul>
<p>&nbsp;</p>
<table width="99%" border="0" align="center">
  <tr>
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="traslado_reporte.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<table width="99%" border="0" align="center">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="4" bgcolor="#4D68A2">&nbsp;</th>
  </tr>
  <tr>
    <td><DIV ID="seleccion"></td>
  </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th colspan="4" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></th>
  </tr>
  <tr bgcolor="#f0f0f0" style="color: #000">
    <th colspan="4" bgcolor="#f0f0f0">Registro De Traslado</th>
  </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th width="220" align="left">&nbsp;</th>
    <td width="328" align="left">&nbsp;</td>
    <th width="216" align="right">Ref N°</th>
    <td width="306" align="center"><?php echo $row_RE['fecha']; ?></td>
  </tr>
  <tr bgcolor="#f0f0f0" style="color: #000">
    <th align="left" bgcolor="#f0f0f0">Responsable</th>
    <td colspan="3" align="left"><?php echo $row_RE['respon']; ?></td>
  </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th align="left">&nbsp;</th>
    <th colspan="2">&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
</table>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="17%">ID</th>
    <th width="35%">Hacienda Inicial</th>
    <th width="34%">Hacienda Final</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_RE['id_vacuno']; ?></td>
      <td><?php echo $row_RE['finca_esta']; ?></td>
      <td><?php echo $row_RE['finca_va']; ?></td>
    </tr>
    <?php } while ($row_RE = mysql_fetch_assoc($RE)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($RE);
?>
