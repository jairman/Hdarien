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
$fecha=$_GET['fecha'];
$respon=$_GET['respon'];
$hcien = $_GET['hacien'];
$comen=$_GET['comen'];
$query_vac = "SELECT * FROM d89xz_vacunasion WHERE fecha='$fecha' and respon='$respon' and hacien ='$hcien' and comen= '$comen'";
$vac = mysql_query($query_vac, $conexion) or die(mysql_error());
$row_vac = mysql_fetch_assoc($vac);
$totalRows_vac = mysql_num_rows($vac);
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
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="jornada_vacuna_detalle.php?jpeso=<?php echo $jpeso; ?>&amp;hierro=<?php echo $hierro; ?>&amp;cmpes=<?php echo $cmpes; ?>&amp;respes=<?php echo $respon; ?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>

<DIV ID="seleccion">

  <table width="99%" border="0" align="center">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="4" bgcolor="#4D68A2">&nbsp;</th>
    </tr>
    <tr>
      
    </tr>
    <tr bgcolor="#FFFFFF" style="color: #000">
      <th colspan="4" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></th>
    </tr>
    <tr bgcolor="#f0f0f0" style="color: #000">
      <th colspan="4" bgcolor="#f0f0f0">Registro De Vacunación</th>
    </tr>
    <tr bgcolor="#FFFFFF" style="color: #000">
      <th width="220" align="left">Hacienda</th>
      <td width="328" align="left"><?php echo $row_vac['hacien']; ?></td>
      <th width="216" align="right">Ref N°</th>
      <td width="306" align="center"><?php echo $row_vac['fecha']; ?></td>
    </tr>
    <tr bgcolor="#f0f0f0" style="color: #000">
      <th align="left" bgcolor="#f0f0f0">Responsable</th>
      <td colspan="3" align="left"><?php echo $row_vac['respon']; ?></td>
    </tr>
    <tr bgcolor="#FFFFFF" style="color: #000">
      <th align="left">Comentario Jornada</th>
      <td colspan="3" align="left"><?php echo $row_vac['comen']; ?></td>
    </tr>
    <tr bgcolor="#FFFFFF" style="color: #000">
      <th align="left">&nbsp;</th>
      <th colspan="2">&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
  </table>
  <table width="99%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="116">ID</th>
    <th width="84">Hierro</th>
    <th width="234">Tratamiento</th>
    <th width="173">Nombre</th>
    <th width="172">Dosis</th>
    <th width="269">Observación</th>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_vac['id_vacuno']; ?></td>
      <td><?php echo $row_vac['hierro']; ?></td>
      <td><?php echo $row_vac['jornada']; ?></td>
      <td><?php echo $row_vac['diagnostico']; ?></td>
      <td width="172"><?php echo $row_vac['tratamiento']; ?></td>
      <td><?php echo $row_vac['observasion']; ?></td>
    </tr>
    <?php } while ($row_vac = mysql_fetch_assoc($vac)); ?>
</table>
</DIV>
</body>
</html>
<?php
mysql_free_result($vac);
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