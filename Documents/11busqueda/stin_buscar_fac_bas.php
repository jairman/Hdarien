
<?
 //session_start();
 
$ruta_a_joomla = "/../../agrotin/";

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
	

	//seguridad
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder a esta página sin estar logueado.");
$userx = JFactory::getUser();


?>
<?php require_once('../Connections/conexion.php'); 

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
$sol=$_GET['sol'];
$nom_hacienda=$_GET['hacienda'];
$nom_hacienda_m = strtoupper($nom_hacienda);
mysql_select_db($database_conexion, $conexion);
$query_fac = "SELECT * FROM d89xz_bascula WHERE solicitud='$sol' and cons_fac<>''";
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#factura_venta {	font-size: 30px;
	text-align:right
}
#apDiv5 {
	position:absolute;
	width:206px;
	height:43px;
	z-index:2;
	left: 1px;
	top: -20px;
}
#apDiv2 {
	position:absolute;
	width:38px;
	height:44px;
	z-index:2;
	left: 10px;
	top: 34px;
}
#tabla {
	position:absolute;
	width:867px;
	height:124px;
	z-index:2;
	left: 22px;
	top: 1172px;
}
</style>
</head>

<body>
<div id="apDiv2"><a href="javascript:imprSelec('recargar2')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>
</div>
<div id="apDiv5">
    <h3>Hacienda <? echo $nom_hacienda_m;?></h3>
</div>
<div id="recargar2">
  
  <h2 id="factura_venta" align="left"><img src="idsolutions--este.png" alt="idsol" width="177" height="61" /></h2>
  <h2><strong>FACTURA DE VENTA HACIENDA <? echo $nom_hacienda_m;?></strong></h2>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr bgcolor="#CCCCCC" style="font-size:16px">
      <td width="18%"><strong>Empresa</strong></td>
      <td width="31%"><? echo $row_fac['cliente'] ?></td>
      <td width="24%"><strong>Factura No</strong></td>
      <td width="27%" style="color:#F00"><? echo $row_fac['cons_fac'] ?>
        <input type="hidden" name="consecutivo" id="consecutivo" value="<? echo $row_cons['solicit'] ?>" /></td>
    </tr>
    <tr style="font-size:16px">
      <td><strong>Cedula/Nit</strong></td>
      <td><? echo $row_fac['cedula_cliente'] ?></td>
      <td><strong>Fecha</strong> DD/MM/AAAA</td>
      <td><? echo $row_fac['fecha_fac'] ?></td>
    </tr>
    <tr bgcolor="#CCCCCC" style="font-size:16px">
      <td><strong>Contacto</strong></td>
      <td><? echo $row_fac['cliente'] ?></td>
      <td><strong>Telefono</strong></td>
      <td><? echo $row_fac['tel_cliente'] ?></td>
    </tr>
  </table>
  <table width="886"   border="1" align="left">
    <tr align="center">
      <td width="170" bgcolor="#000000" style="color:#FFF; font-size:15" >Animal</td>
      <td width="192" bgcolor="#000000" style="color:#FFF; font-size:15">Peso(Kg)</td>
      <td width="183" bgcolor="#000000" style="color:#FFF; font-size:15" ><span style="color:#FFF ; font-size:13">Precio(Kg)</span></td>
      <td width="183" bgcolor="#000000" style="color:#FFF; font-size:15" >Precio Venta</td>
      <td width="133" bgcolor="#000000" style="color:#FFF; font-size:15" >Precio Entrada</td>
    </tr>
    <?
	mysql_select_db($database_conexion, $conexion);
$query_histo = "SELECT * FROM  d89xz_bascula where solicitud ='$sol' and cons_fac<>''" ;
$histo = mysql_query($query_histo, $conexion) or die(mysql_error());
$totalRows_histo = mysql_num_rows($histo);
while ($row_histo = mysql_fetch_assoc($histo)) {
	


	?>
    <tr align="center">
    <?
	$cos_entro=$row_histo['cos_entro'];
	if ($cos_entro==""){
		$cos_entro=0;
	}
	?>
      <td style="font-size:13"><? echo $row_histo['animal_no'] ?></td>
      <td style="font-size:13"><? echo $row_histo['animal_peso'] ?></td>
      <td style="font-size:13"><? echo number_format($row_histo['precio_x_k']) ?></td>
      <td style="font-size:13"><strong><? echo number_format($row_histo['precio_x_k']*$row_histo['animal_peso']) ?></strong></td>
      <td style="font-size:13"><? echo number_format($cos_entro); ?></td>
    </tr>
    <?
	  
} 
	  ?>
  </table>
  </p>

  <table width="886" border="1" cellspacing="1" cellpadding="0" style="font-size:16px">
    <?
	mysql_select_db($database_conexion, $conexion);
$query_fac = "SELECT * FROM d89xz_bascula WHERE solicitud='$sol' and cons_fac<>''";
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);
	?>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Descuentos</strong></td>
      <td width="42%"><strong>Subtota</strong>l</td>
      <td width="5%"><strong><? echo $row_fac['valor_total'] ?></strong></td>
    </tr>
    <tr>
      <td width="25%" bgcolor="#CCCCCC"><strong>B.N.A</strong></td>
      <td width="28%" bgcolor="#CCCCCC"><? echo number_format($row_fac['bna'] )?></td>
      <td colspan="2" align="center" bgcolor="#999"><strong>TOTALES</strong>
        </td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>Fomento</strong></td>
      <td bgcolor="#CCCCCC"><? echo number_format($row_fac['fomento']) ?></td>
      <td bgcolor="#999"><strong>Total-Descuentos</strong></td>
      <td bgcolor="#999"><strong><? echo $row_fac['total_desc'] ?></strong></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>Fletes</strong></td>
      <td bgcolor="#CCCCCC"><? echo number_format($row_fac['fletes']) ?></td>
      <td bgcolor="#999"><strong>Ganancia Neta</strong></td>
      <td bgcolor="#999"><strong><? echo $row_fac['neta'] ?></strong></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>Otros</strong></td>
      <td bgcolor="#CCCCCC"><? echo number_format($row_fac['otros']) ?></td>
      <td bgcolor="#999"><strong>Utilidad  </strong>
        <? echo $row_fac['porcentaje'] ?>
        <strong>%</strong></td>
      <td bgcolor="#999"><strong><? echo $row_fac['utilidad'] ?></strong></td>
    </tr>
  </table>

</div>
</body>
</html>
<?php
mysql_free_result($fac);
?>
<script>
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