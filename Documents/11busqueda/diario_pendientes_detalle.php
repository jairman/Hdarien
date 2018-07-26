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
$query_dias = "SELECT dias FROM d89xz_dias";
$dias = mysql_query($query_dias, $conexion) or die(mysql_error());
$row_dias = mysql_fetch_assoc($dias);
$totalRows_dias = mysql_num_rows($dias);

mysql_select_db($database_conexion, $conexion);
$query_meses = "SELECT meses FROM d89xz_meses";
$meses = mysql_query($query_meses, $conexion) or die(mysql_error());
$row_meses = mysql_fetch_assoc($meses);
$totalRows_meses = mysql_num_rows($meses);

mysql_select_db($database_conexion, $conexion);
$query_tareas = "SELECT * FROM d89xz_tareas ORDER BY fecha_ini DESC";
$tareas = mysql_query($query_tareas, $conexion) or die(mysql_error());
$row_tareas = mysql_fetch_assoc($tareas);
$totalRows_tareas = mysql_num_rows($tareas);

mysql_select_db($database_conexion, $conexion);
$query_anf = "SELECT * FROM d89xz_anos";
$anf = mysql_query($query_anf, $conexion) or die(mysql_error());
$row_anf = mysql_fetch_assoc($anf);
$totalRows_anf = mysql_num_rows($anf);

mysql_select_db($database_conexion, $conexion);
$query_raza = "SELECT raza FROM d89xz_razas";
$raza = mysql_query($query_raza, $conexion) or die(mysql_error());
$row_raza = mysql_fetch_assoc($raza);
$totalRows_raza = mysql_num_rows($raza);

mysql_select_db($database_conexion, $conexion);
$query_color = "SELECT color FROM d89xz_color_raza";
$color = mysql_query($query_color, $conexion) or die(mysql_error());
$row_color = mysql_fetch_assoc($color);
$totalRows_color = mysql_num_rows($color);

mysql_select_db($database_conexion, $conexion);
$query_hierro = "SELECT * FROM d89xz_hierros";
$hierro = mysql_query($query_hierro, $conexion) or die(mysql_error());
$row_hierro = mysql_fetch_assoc($hierro);
$totalRows_hierro = mysql_num_rows($hierro);

mysql_select_db($database_conexion, $conexion);

@$vacuna=$_GET['vacuna'];
@$hierro=$_GET['hierro'];
@$cmvac =$_GET['cmvac'];
@$resvac=$_GET['resvac'];

@$query_vac = "SELECT  `id_vacuno`,`raza` ,`color`,`clase`,`hierro`,`sexo`,`ubicasion` FROM d89xz_vacunos WHERE `cmvac` ='$cmvac' and `resvac` = '$resvac' and `vacuna` ='$vacuna' and `hierro`= '$hierro'";
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);

mysql_select_db($database_conexion, $conexion);
$query_ubc = "SELECT hacienda FROM d89xz_hacienda";
$ubc = mysql_query($query_ubc, $conexion) or die(mysql_error());
$row_ubc = mysql_fetch_assoc($ubc);
$totalRows_ubc = mysql_num_rows($ubc);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pendientes</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
.c {
	color: #FFF;
}
</style>
</head>

<body>

  
  <p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="308" align="center" bgcolor="#f0f0f0"><a href="diario_pendientes_agen.php?jpeso=<?php echo $jpeso; ?>&amp;hierro=<?php echo $hierro; ?>&amp;cmpes=<?php echo $cmpes; ?>&amp;respes=<?php echo $respon; ?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right" bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>

<DIV ID="seleccion">
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #000">
    <td colspan="8" bgcolor="#FFFFFF"><img src="idsolutions--este.png" alt="" width="162" height="59" /></td>
    </tr>
  <tr bgcolor="#4D68A2" style="color: #000">
    <th colspan="5">&nbsp;</th>
    <th colspan="3" bgcolor="#FFFFFF"><a href="vacunar_grupo.php?vacuna=<?php echo $vacuna; ?>&amp;cmvac=<?php echo $cmvac; ?>&amp;resvac=<?php echo $resvac; ?>">Vacunar Grupo</a></th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="12%">ID</th>
    <th width="12%">Raza</th>
    <th width="11%">Color</th>
    <th width="12%">Clase</th>
    <th width="12%">Hierro</th>
    <th width="11%">Sexo</th>
    <th width="20%">Ubicacion</th>
    <th width="10%">Vacunar</th>
  </tr>
  <?
  
@$vacuna=$_GET['vacuna'];



  ?>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_vac['id_vacuno']; ?></td>
      <td><?php echo $row_vac['raza']; ?></td>
      <td><?php echo $row_vac['color']; ?></td>
      <td><?php echo $row_vac['clase']; ?></td>
      <td><?php echo $row_vac['hierro']; ?></td>
      <td><?php echo $row_vac['sexo']; ?></td>
      <td><?php echo $row_vac['ubicasion']; ?></td>
      <td bgcolor="#0000FF"><a href="ajax1.php?id_vacuno=<?php echo $row_vac['id_vacuno']; ?>&amp;hacienda=<?php echo $row_vac['ubicasion']; ?>&amp;hierro=<?php echo $row_vac['hierro']; ?>&amp;cmvac=<?php echo $cmvac; ?>&amp;resvac=<?php echo $resvac; ?>&amp;vacuna=<?php echo $vacuna; ?>"><img src="vacunar.jpg" width="33" height="19" /></a></td>
    </tr>
    <?php } while ($row_vac = mysql_fetch_assoc($vac)); ?>
</table>
</DIV>
<script type="text/javascript">
var spryjamanield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dias);

mysql_free_result($meses);

mysql_free_result($tareas);

mysql_free_result($anf);

mysql_free_result($raza);

mysql_free_result($color);

//mysql_free_result($hierro);

mysql_free_result($vac);

mysql_free_result($ubc);
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






<?

mysql_close($conexion);
?> 