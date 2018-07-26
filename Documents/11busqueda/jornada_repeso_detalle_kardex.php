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
@$fecha=$_GET['fecha'];
@$respon=$_GET['respon'];
@$cmpes = $_GET['cmpes'];
@$hacien = $_GET['hacien'];
//echo "fcha: $fecha--Respon:$respon----Comen:$cmpes---Haciend:$hacien";

mysql_select_db($database_conexion, $conexion);
$query_pss = "SELECT * FROM d89xz_pesos WHERE fecha='$fecha' and respon='$respon' and cmpes ='$cmpes' and hacien ='$hcien'";
$pss = mysql_query($query_pss, $conexion) or die(mysql_error());
$row_pss = mysql_fetch_assoc($pss);
$totalRows_pss = mysql_num_rows($pss);

mysql_select_db($database_conexion, $conexion);
$query_pes = "SELECT * FROM d89xz_pesos WHERE fecha='$fecha' and respon='$respon' and cmpes ='$cmpes' and `hacien`='$hacien' ";
$pes = mysql_query($query_pes, $conexion) or die(mysql_error());
$row_pes = mysql_fetch_assoc($pes);
$totalRows_pes = mysql_num_rows($pes);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<DIV ID="seleccion">
  <table width="99%" border="0" align="center">
    <tr>
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="jornada_repeso_detalle.php?jpeso=<?php echo $jpeso; ?>&amp;hierro=<?php echo $hierro; ?>&amp;cmpes=<?php echo $cmpes; ?>&amp;respes=<?php echo $respon; ?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="99%" border="0" align="center">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="4" bgcolor="#4D68A2">&nbsp;</th>
    </tr>
    <DIV ID="seleccion">
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th colspan="4" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></th>
    </tr>
  <tr bgcolor="#f0f0f0" style="color: #000">
    <th colspan="4" bgcolor="#f0f0f0">Registro de Pesos</th>
    </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th width="220" align="left">Hacienda</th>
    <td width="328" align="left"><?php echo $row_pes['hacien']; ?></td>
    <th width="216" align="right">Ref N°</th>
    <td width="306" align="center"><?php echo $row_pes['fecha']; ?></td>
    </tr>
  <tr bgcolor="#f0f0f0" style="color: #000">
    <th align="left" bgcolor="#f0f0f0">Tipo  De Pesaje</th>
    <td colspan="3" align="left"><?php echo $row_pes['tipo_pesaje']; ?></td>
    </tr>
  <tr bgcolor="#FFFFFF" style="color: #000;">
    <th align="left">Responsable</th>
    <td align="left"><?php echo $row_pes['respon']; ?></td>
    <th align="left">&nbsp;</th>
    <th>&nbsp;</th>
    </tr>
  <tr bgcolor="#f0f0f0" style="color: #000">
    <th align="left">Comentario Jornada</th>
    <td colspan="3" align="left"><?php echo $row_pes['cmpes']; ?></td>
    </tr>
  <tr bgcolor="#FFFFFF" style="color: #000">
    <th align="left">&nbsp;</th>
    <th colspan="2">&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
</table>
<table width="99%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="16%">ID</th>
    <th width="18%">Hierro</th>
    <th width="17%">Peso (Kg)</th>
    <th width="49%">Comentario </th>
    </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_pes['id_vacuno']; ?></td>
      <td><?php echo $row_pes['hierro']; ?></td>
      <td><?php echo $row_pes['peso']; ?></td>
      <td><?php echo $row_pes['comind']; ?></td>
      </tr>
    <?php } while ($row_pes = mysql_fetch_assoc($pes)); ?>
</table>
</DIV>
</body>
</html>
<?php
mysql_free_result($pss);

mysql_free_result($pes);


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