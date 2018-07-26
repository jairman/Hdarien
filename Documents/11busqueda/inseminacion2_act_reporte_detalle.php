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

$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)
@$mes=$_GET['mes'];
//echo $mes.'-'.$anoss;
@$dia2=1;
$fechaEsp1=$anoss.'-'.$mes.'-'.$dia2;
$prueba1 = strftime("Mes %B Del %Y ", strtotime($fechaEsp1));
//echo $prueba1;


mysql_select_db($database_conexion, $conexion);
$query_in = "SELECT * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '$mes'";
$in = mysql_query($query_in, $conexion) or die(mysql_error());
$row_in = mysql_fetch_assoc($in);
$totalRows_in = mysql_num_rows($in);


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
    <td width="308" align="center"><a href="inseminacion2_act_reporte.php?jpeso=<?php echo $jpeso; ?>&amp;hierro=<?php echo $hierro; ?>&amp;cmpes=<?php echo $cmpes; ?>&amp;respes=<?php echo $respon; ?>"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>

<DIV ID="seleccion">

  <table width="99%" border="0" align="center">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th colspan="4" bgcolor="#4D68A2">&nbsp;</th>
    </tr>
    <tr bgcolor="#FFFFFF" style="color: #000">
      <th colspan="4" align="left"><img src="idsolutions--este.png" alt="" width="162" height="59" /></th>
    </tr>
    <tr bgcolor="#f0f0f0" style="color: #000">
      <th colspan="4" bgcolor="#f0f0f0">Registro DeInseminación</th>
    </tr>
    <tr bgcolor="#FFFFFF" style="color: #000">
      <th width="220" align="left">&nbsp;</th>
      <th width="544" colspan="2">&nbsp;</th>
      <th width="306">&nbsp;</th>
    </tr>
  </table>
  <table width="99%" border="1" align="center" cellspacing="0">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th>ID</th>
      <th>Toro Usado</th>
      <th>Tipo de Servicio</th>
      <th>Fecha de Servicio</th>
    </tr>
    <?php do { ?>
      <tr align="center">
        <td><?php echo $row_in['vaca']; ?></td>
        <td><?php echo $row_in['toro']; ?></td>
        <td><?php echo $row_in['t_serv']; ?></td>
        <td><?php echo $row_in['f_serv']; ?></td>
      </tr>
      <?php } while ($row_in = mysql_fetch_assoc($in)); ?>
  </table>
<table width="99%" border="1" align="center" cellspacing="0">
</table>
</DIV>
</body>
</html>
<?php
mysql_free_result($in);


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