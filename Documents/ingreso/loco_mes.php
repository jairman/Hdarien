<?
$ruta_a_joomla = "/../../../carnesdana/";
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
  $usuario2= $userx->usertype2;
	$acceso= $userx->agenda;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();

?>
<?php require_once('../Connections/conexion.php'); ?>
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

$colname_asis = "-1";
if (isset($_GET['fecha'])) {
  $colname_asis = $_GET['fecha'];
}
mysql_select_db($database_conexion, $conexion);
$query_asis = sprintf("SELECT * FROM nomina_ingreso WHERE fecha = %s ORDER BY inicio ASC", GetSQLValueString($colname_asis, "date"));
$asis = mysql_query($query_asis, $conexion) or die(mysql_error());
$row_asis = mysql_fetch_assoc($asis);
$totalRows_asis = mysql_num_rows($asis);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control Ingreso</title>

<link href="../ingreso/css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../ingreso/css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../ingreso/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../ingreso/js/shadowbox.js" type="text/javascript"></script>
<script src="../ingreso/js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,


});
// </script>
</head>
<body>

<DIV ID="seleccion">
<table width="98%" border="0" align="center">
  <tr>
    <td width="50%" rowspan="3"><img src="img/logo3.png" width="250" height="100" /></td>
    <td width="50%" ><a href="javascript:imprSelec('seleccion')" ><img src="img/imprimir.png" alt="" width="40" height="40" border="0" align="right" /></a></td>
  </tr>
  <tr>
    <td style="font-size: 24px" class="tittle">HOJA DE HORARIOS</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <td class="bold">Medellín  Antioquia </td>
  </tr>
  <tr>
    <td class="bold">(034) 354 05 26 </td>
    <td class="bold">Fecha: <?php echo $row_asis['fecha']; ?></td>
  </tr>
  <tr>
    <td> </td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="98%" border="0" align="center">
  <tr align="center" class="tittle">
    <td width="5%" class="row" style="font-size: 9px">Cedula</td>
    <td width="24%" class="row" style="font-size: 9px">Nombre</td>
    <td width="5%" class="row" style="font-size: 9px">Hora Inicio</td>
    <td width="6%" class="row" style="font-size: 9px">Hora Final</td>
    <td width="7%" class="row" style="font-size: 9px"><p>Almuerzo</p></td>
    <td width="7%" class="row" style="font-size: 9px">Horas Normales</td>
    <td width="6%" class="row" style="font-size: 9px">Horas Extra</td>
    <td width="7%" class="row" style="font-size: 9px">Horas Totales</td>
    <td width="7%" class="row" style="font-size: 9px">Horas Permiso    </td>
    <td width="10%" class="row" style="font-size: 9px">Horas Incapacidad</td>
    <td width="16%" class="row" style="font-size: 9px"><p>Comentario</p></td>
  </tr>
  <?php do { ?>
    <tr class="row">
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['cedula']; ?></td>
      <td class="row" style="font-size: 9px"><?
			 mysql_select_db($database_conexion, $conexion);
			$query_cot1 = "SELECT * FROM nomina_valle WHERE rfid = '$row_asis[cedula]'";
			$cot1 = mysql_query($query_cot1, $conexion) or die(mysql_error());
			$row_cot1 = mysql_fetch_assoc($cot1);
			$totalRows_cot1 = mysql_num_rows($cot1);	
			echo $rfid=$row_cot1['nombre'];
			  
	  ?></td>
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['inicio']; ?></td>
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['final']; ?></td>
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['entalmuer']?></td>
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['hnormales']; ?></td>
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['hextras']; ?></td>
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['htotales']; ?></td>
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['permisos']; ?></td>
      <td align="right" class="row" style="font-size: 9px"><?php echo $row_asis['incapacidad']; ?></td>
      <td align="center" class="row" style="font-size: 9px"><?php echo $row_asis['comen']; ?></td>
    </tr>
    <?php } while ($row_asis = mysql_fetch_assoc($asis)); ?>
    <tr class="row">
      <td colspan="4" align="right" class="row bold"><strong>TOTALES  DIARIAS:</strong></td>
      <td align="right" class="row">&nbsp;</td>
      <td align="right" class="row">
        <?
	   $resultc = mysql_query("SELECT SUM(`hnormales`) as hnormales,SUM(`hextras`) as hextras,SUM(`htotales`) as htotales FROM nomina_ingreso WHERE fecha ='$_GET[fecha]' "); 
		$rowc = mysql_fetch_array($resultc, MYSQL_ASSOC);	
		 echo number_format($hnormales=$rowc["hnormales"]);

      ?>
      </td>
      <td align="right" class="row"><? echo number_format($hnormales=$rowc["hextras"]); ?></td>
      <td align="right" class="row"><? echo number_format($hnormales=$rowc["htotales"]); ?></td>
      <td align="right" class="row">&nbsp;</td>
      <td align="right" class="row">&nbsp;</td>
      <td align="right" class="row">&nbsp;</td>
    </tr>
    
</table>
</DIV>
</body>
<?php
mysql_free_result($asis);
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