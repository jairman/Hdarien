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

$colname_vc = "-1";
if (isset($_GET['vacuno'])) {
  $colname_vc = $_GET['vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_vc = sprintf("SELECT * FROM d89xz_detalle_leche WHERE vacuno = %s ORDER BY fecha DESC , semana DESC", GetSQLValueString($colname_vc, "text"));
$vc = mysql_query($query_vc, $conexion) or die(mysql_error());
$row_vc = mysql_fetch_assoc($vc);
$totalRows_vc = mysql_num_rows($vc);
@$vacuno=$_GET['vacuno'];
$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)

//crias hembra enero
$ener = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' ",$conexion);
$row01 = mysql_fetch_array($ener, MYSQL_ASSOC);
$cria_hembra_enero= number_format ($row01["total"]);

//crias hembra febrero
$febr = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' ",$conexion);
$row02 = mysql_fetch_array($febr, MYSQL_ASSOC);
$cria_hembra_febrero= number_format ($row02["total"]);


//crias hembra marzo

$marz = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' ",$conexion);
$row03 = mysql_fetch_array($marz, MYSQL_ASSOC);
$cria_hembra_marzo= number_format ($row03["total"]);


//crias hembra abril

$abri = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' ",$conexion);

$row04 = mysql_fetch_array($abri, MYSQL_ASSOC);
$cria_hembra_abril= number_format ($row04["total"]);


//crias hembra mayo

$mayo = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' ",$conexion);
$row05 = mysql_fetch_array($mayo, MYSQL_ASSOC);
$cria_hembra_mayo= number_format ($row05["total"]);


//crias hembra junio

$juni = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' ",$conexion);
$row06 = mysql_fetch_array($juni, MYSQL_ASSOC);
$cria_hembrao_junio= number_format ($row06["total"]);


//crias hembra julio

$juli = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' ",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_hembra_julio= number_format ($row07["total"]);


//crias hembra agosto

$agos = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' ",$conexion);
$row08 = mysql_fetch_array($agos, MYSQL_ASSOC);
$cria_hembra_agosto= number_format ($row08["total"]);


//crias hembra septiembre

$sept = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' ",$conexion);
$row09 = mysql_fetch_array($sept, MYSQL_ASSOC);
$cria_hembra_septi= number_format ($row09["total"]);


//crias hembra octubre

$octu = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' ",$conexion);

$row10 = mysql_fetch_array($octu, MYSQL_ASSOC);
$cria_hembra_octubre= number_format ($row10["total"]);

//crias hembra noviembre

$novi = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' ",$conexion);
$row11 = mysql_fetch_array($novi, MYSQL_ASSOC);
$cria_hembra_noviem= number_format ($row11["total"]);

//crias hembra diciembre
$dici = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno= '$vacuno' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' ",$conexion);
$row12 = mysql_fetch_array($dici, MYSQL_ASSOC);
$cria_hembra_dici= number_format ($row12["total"]);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.z {
	color: #FFF;
}
</style>
</head>

<body>

<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="kardex_paridas.php"><img src="last.png" width="32" height="34" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<table width="399" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="102">ID</th>
    <th width="151">Meses</th>
    <th bgcolor="#4D68A2">Litros</th>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">1</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=01&amp;vacuno=<?php echo $vacuno ?>">Enero</a></td>
    <td width="124" style="font-weight: bold"><? echo $cria_hembra_enero ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">2</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=02&amp;vacuno=<?php echo $vacuno ?>">Febrero</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_febrero ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">3</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=03&amp;vacuno=<?php echo $vacuno ?>">Marzo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_marzo ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">4</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=04&amp;vacuno=<?php echo $vacuno ?>">Abril</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_abril?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">5</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=05&amp;vacuno=<?php echo $vacuno ?>">Mayo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_mayo ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">6</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=06&amp;vacuno=<?php echo $vacuno ?>">Junio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembrao_junio?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">7</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=07&amp;vacuno=<?php echo $vacuno ?>">Julio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_julio ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">8</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=08&amp;vacuno=<?php echo $vacuno ?>">Agosto</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_agosto?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">9</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=09&amp;vacuno=<?php echo $vacuno ?>">Septiembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_septi?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">10</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=10&amp;vacuno=<?php echo $vacuno ?>">Octubre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_octubre ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">11</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=11&amp;vacuno=<?php echo $vacuno ?>">Noviembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_noviem?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">12</td>
    <td style="font-weight: bold"><a href="kardex_leche_indiv_detalle.php?mes=12&amp;vacuno=<?php echo $vacuno ?>">Diciembre</a></td>
    <td style="font-weight: bold"><? echo  $cria_hembra_dici?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="500" border="0" align="center" cellspacing="0">
  <tr>
    <th width="430" align="left" bgcolor="#4D68A2" style="color: #FFF">Desea Retirar  el Vacuno  De La Producción De Leche?</th>
    <th width="60" bgcolor="#f0f0f0"><a href="kardex_paridas_inven_Desagregar.php?id_vacuno=<?php echo $vacuno ?>" onclick="return confirm('Realmente Desea Retirar  el Vacuno  De La Producción De Leche?');">Si</a></th>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($vc);
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