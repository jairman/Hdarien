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

$maxRows_hacienda = 10;
$pageNum_hacienda = 0;
if (isset($_GET['pageNum_hacienda'])) {
  $pageNum_hacienda = $_GET['pageNum_hacienda'];
}
$startRow_hacienda = $pageNum_hacienda * $maxRows_hacienda;

mysql_select_db($database_conexion, $conexion);
$query_hacienda = "SELECT empresa, nit, telefono, hacienda, departamento, municipio, extension, latitud, longitud, temperatura FROM d89xz_hacienda";
$query_limit_hacienda = sprintf("%s LIMIT %d, %d", $query_hacienda, $startRow_hacienda, $maxRows_hacienda);
$hacienda = mysql_query($query_limit_hacienda, $conexion) or die(mysql_error());
$row_hacienda = mysql_fetch_assoc($hacienda);

if (isset($_GET['totalRows_hacienda'])) {
  $totalRows_hacienda = $_GET['totalRows_hacienda'];
} else {
  $all_hacienda = mysql_query($query_hacienda);
  $totalRows_hacienda = mysql_num_rows($all_hacienda);
}
$totalPages_hacienda = ceil($totalRows_hacienda/$maxRows_hacienda)-1;

$maxRows_empre = 10;
$pageNum_empre = 0;
if (isset($_GET['pageNum_empre'])) {
  $pageNum_empre = $_GET['pageNum_empre'];
}
$startRow_empre = $pageNum_empre * $maxRows_empre;

mysql_select_db($database_conexion, $conexion);
$query_empre = "SELECT empresa, nit, telefono FROM d89xz_empresa";
$query_limit_empre = sprintf("%s LIMIT %d, %d", $query_empre, $startRow_empre, $maxRows_empre);
$empre = mysql_query($query_limit_empre, $conexion) or die(mysql_error());
$row_empre = mysql_fetch_assoc($empre);

if (isset($_GET['totalRows_empre'])) {
  $totalRows_empre = $_GET['totalRows_empre'];
} else {
  $all_empre = mysql_query($query_empre);
  $totalRows_empre = mysql_num_rows($all_empre);
}
$totalPages_empre = ceil($totalRows_empre/$maxRows_empre)-1;
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
</style>
</head>

<body>

<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">
<img src="idsolutions--este.png" width="162" height="59" />
<table width="700" border="1">
  <tr class="c">
    <th bgcolor="#4D68A2"><strong>Empresa</strong></th>
     <th bgcolor="#4D68A2"><strong>Nit</strong></th>
     <th bgcolor="#4D68A2"><strong>Telefono</strong></th>
   
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_empre['empresa']; ?></td>
      <td><?php echo $row_empre['nit']; ?></td>
      <td><?php echo $row_empre['telefono']; ?></td>
    </tr>
    <?php } while ($row_empre = mysql_fetch_assoc($empre)); ?>
</table>

<?
echo "</br> \n";	
?>
<DIV ID="seleccion">

<table width="990" border="1">
  <tr>
 
    <th width="125" bgcolor="#4D68A2" style="color: #FFF"><strong>Hacienda</strong></th>
    <th width="120" bgcolor="#4D68A2" style="color: #FFF"><strong>Telefono</strong></th>
    <th width="155" bgcolor="#4D68A2" style="color: #FFF"><strong>Depto.</strong></th>
    <th width="129" bgcolor="#4D68A2" style="color: #FFF"><strong>Municipio</strong></th>
    <th width="128" bgcolor="#4D68A2" style="color: #FFF"><strong>Ext.</strong></th>
    <th width="108" bgcolor="#4D68A2" style="color: #FFF"><strong>Latitud</strong></th>
    <th width="119" bgcolor="#4D68A2" style="color: #FFF"><strong>Longitud</strong></th>
    <th width="52" bgcolor="#4D68A2" style="color: #FFF">Eliminar</th>
  </tr>
  <?php do { ?>
    <tr>
  
      <td><?php echo $row_hacienda['hacienda']; ?></td>
      <td><?php echo $row_hacienda['telefono']; ?></td>
      <td><?php echo $row_hacienda['departamento']; ?></td>
      <td><?php echo $row_hacienda['municipio']; ?></td>
      <td><?php echo $row_hacienda['extension']; ?></td>
      <td><?php echo $row_hacienda['latitud']; ?></td>
      <td><?php echo $row_hacienda['longitud']; ?></td>
      <td align="center">Eliminar</td>
    </tr>
    <?php } while ($row_hacienda = mysql_fetch_assoc($hacienda)); ?>
</table>

</DIV>



</body>
</html>
<?php
mysql_free_result($hacienda);

mysql_free_result($empre);
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