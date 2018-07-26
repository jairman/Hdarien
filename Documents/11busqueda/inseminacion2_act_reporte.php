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
<?

$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)
//echo $anoss;
//echo date("m"); // Month (12)
//echo date("d"); // day (14)

//crias hembra enero
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '01' ",$conexion);
$cria_hembra_enero = mysql_num_rows($sql);
//crias hembra febrero
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '02' ",$conexion);
$cria_hembra_febrero = mysql_num_rows($sql);
//crias hembra marzo
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '03' ",$conexion);
$cria_hembra_marzo = mysql_num_rows($sql);
//crias hembra abril
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '04' ",$conexion);
$cria_hembra_abril = mysql_num_rows($sql);
//crias hembra mayo
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '05' ",$conexion);
$cria_hembra_mayo = mysql_num_rows($sql);
//crias hembra junio
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '06' ",$conexion);
$cria_hembrao_junio = mysql_num_rows($sql);
//crias hembra julio
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '07' ",$conexion);
$cria_hembra_julio = mysql_num_rows($sql);
//crias hembra agosto
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '08' ",$conexion);
$cria_hembra_agosto = mysql_num_rows($sql);
//crias hembra septiembre
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '09' ",$conexion);
$cria_hembra_septi = mysql_num_rows($sql);
//crias hembra octubre
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '10' ",$conexion);
$cria_hembra_octubre = mysql_num_rows($sql);
//crias hembra noviembre
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '11' ",$conexion);
$cria_hembra_noviem = mysql_num_rows($sql);
//crias hembra diciembre
$sql = mysql_query("select * FROM d89xz_detalle_inseminacion WHERE YEAR(f_serv) = '$anoss' AND MONTH(f_serv) = '12' ",$conexion);
$cria_hembra_dici = mysql_num_rows($sql);



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
 <li><a href="inseminacion2_act.php" >Inseminaci&oacute;n</a>  </li>
  <li><a href="inseminacion2_act_reporte.php" class="current">Reporte</a>  </li>
 
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="399" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="102">ID</th>
    <th width="151">Meses</th>
    <th>Inseminaciones</th>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">1</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=01">Enero</a></td>
    <td width="124" style="font-weight: bold"><? echo $cria_hembra_enero ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">2</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=02">Febrero</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_febrero ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">3</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=03">Marzo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_marzo ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">4</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=04">Abril</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_abril?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">5</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=05">Mayo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_mayo ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">6</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=06">Junio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembrao_junio?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">7</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=07">Julio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_julio ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">8</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=08">Agosto</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_agosto?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">9</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=09">Septiembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_septi?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">10</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=10">Octubre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_octubre ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">11</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=11">Noviembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_noviem?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">12</td>
    <td style="font-weight: bold"><a href="inseminacion2_act_reporte_detalle.php?mes=12">Diciembre</a></td>
    <td style="font-weight: bold"><? echo  $cria_hembra_dici?></td>
  </tr>
</table>
</body>
</html>