<?
$ruta_a_joomla = "/../../Hdarien/";

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
@$cedula=$_GET['cedula'];
@$nombre=$_GET['nombre'];
@$apellido=$_GET['apellido'];
@$date= date("d/m/Y");
@$anoss= date("Y"); // Year (2003)
//echo $anoss;
//echo date("m"); // Month (12)
//echo date("d"); // day (14)

//crias hembra enero
/*
$sql = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_detalle_nomina WHERE  cedula LIKE'%$cedula%' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' ",$conexion);
$cria_hembra_enero = number_format ($row01m["total"]);
*/
$enerm = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' and tipo='Pago'",$conexion);
$row01m = mysql_fetch_array($enerm, MYSQL_ASSOC);
$cria_hembra_enero= number_format ($row01m["total"]);
$cria_hembra_enero1= $row01m["total"];


//crias hembra febrero
$febr = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' AND tipo='Pago'",$conexion);
$row02 = mysql_fetch_array($febr, MYSQL_ASSOC);
$cria_hembra_febrero= number_format ($row02["total"]);
$cria_hembra_febrero1= ($row02["total"]);

//crias hembra marzo

$marz = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' AND tipo='Pago' ",$conexion);
$row03 = mysql_fetch_array($marz, MYSQL_ASSOC);
$cria_hembra_marzo= number_format ($row03["total"]);
$cria_hembra_marzo1=($row03["total"]);

//crias hembra abril

$abri = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' AND tipo='Pago'",$conexion);

$row04 = mysql_fetch_array($abri, MYSQL_ASSOC);
$cria_hembra_abril= number_format ($row04["total"]);
$cria_hembra_abril1=($row04["total"]);

//crias hembra mayo

$mayo = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' AND tipo='Pago'",$conexion);
$row05 = mysql_fetch_array($mayo, MYSQL_ASSOC);
$cria_hembra_mayo= number_format ($row05["total"]);
$cria_hembra_mayo1= ($row05["total"]);

//crias hembra junio

$juni = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' AND tipo='Pago'",$conexion);
$row06 = mysql_fetch_array($juni, MYSQL_ASSOC);
$cria_hembrao_junio= number_format ($row06["total"]);
$cria_hembrao_junio1=($row06["total"]);

//crias hembra julio

$juli = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' AND tipo='Pago'",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_hembra_julio= number_format ($row07["total"]);
$cria_hembra_julio1= ($row07["total"]);

//crias hembra agosto

$agos = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' AND tipo='Pago'",$conexion);
$row08 = mysql_fetch_array($agos, MYSQL_ASSOC);
$cria_hembra_agosto= number_format ($row08["total"]);
$cria_hembra_agosto1= ($row08["total"]);


//crias hembra septiembre

$sept = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' AND tipo='Pago'",$conexion);
$row09 = mysql_fetch_array($sept, MYSQL_ASSOC);
$cria_hembra_septi= number_format ($row09["total"]);
$cria_hembra_septi1=  ($row09["total"]);

//crias hembra octubre

$octu = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' AND tipo='Pago'",$conexion);

$row10 = mysql_fetch_array($octu, MYSQL_ASSOC);
$cria_hembra_octubre= number_format ($row10["total"]);
$cria_hembra_octubre1=($row10["total"]);
//crias hembra noviembre

$novi = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' AND tipo='Pago'",$conexion);
$row11 = mysql_fetch_array($novi, MYSQL_ASSOC);
$cria_hembra_noviem= number_format ($row11["total"]);
$cria_hembra_noviem1= ($row11["total"]);
//crias hembra diciembre
$dici = mysql_query("SELECT SUM(`valor`) as total FROM  d89xz_detalle_nomina where cedula ='$cedula' and  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' AND tipo='Pago'",$conexion);
$row12 = mysql_fetch_array($dici, MYSQL_ASSOC);
$cria_hembra_dici= number_format ($row12["total"]);
$cria_hembra_dici1=  ($row12["total"]);



















/*//crias hembra febrero
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' ",$conexion);
$cria_hembra_febrero = mysql_num_rows($sql);
//crias hembra marzo
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula'and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' ",$conexion);
$cria_hembra_marzo = mysql_num_rows($sql);
//crias hembra abril
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' ",$conexion);
$cria_hembra_abril = mysql_num_rows($sql);
//crias hembra mayo
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' ",$conexion);
$cria_hembra_mayo = mysql_num_rows($sql);
//crias hembra junio
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' ",$conexion);
$cria_hembrao_junio = mysql_num_rows($sql);
//crias hembra julio
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' ",$conexion);
$cria_hembra_julio = mysql_num_rows($sql);
//crias hembra agosto
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' ",$conexion);
$cria_hembra_agosto = mysql_num_rows($sql);
//crias hembra septiembre
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' ",$conexion);
$cria_hembra_septi = mysql_num_rows($sql);
//crias hembra octubre
$sql = mysql_query("select * FROM  d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10'  ",$conexion);
$cria_hembra_octubre = mysql_num_rows($sql);
//crias hembra noviembre
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' ",$conexion);
$cria_hembra_noviem = mysql_num_rows($sql);
//crias hembra diciembre
$sql = mysql_query("select * FROM d89xz_detalle_nomina WHERE  cedula ='$cedula' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' ",$conexion);
$cria_hembra_dici = mysql_num_rows($sql);*/
?>
 <style> 
a{text-decoration:none} 
</style>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="399" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="3"><? echo" $nombre &nbsp; $apellido "; ?></th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="102">ID</th>
    <th width="151">Meses</th>
    <th>Transacciones</th>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">1</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=01&cedula=<? echo $cedula?>">Enero</a></td>
    <td width="124" style="font-weight: bold"><? echo $cria_hembra_enero ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">2</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=02&cedula=<? echo $cedula?>">Febrero</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_febrero ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">3</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=03&cedula=<? echo $cedula?>">Marzo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_marzo ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">4</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=04&cedula=<? echo $cedula?>">Abril</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_abril?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">5</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=05&cedula=<? echo $cedula?>">Mayo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_mayo ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">6</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=06&cedula=<? echo $cedula?>">Junio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembrao_junio?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">7</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=07&cedula=<? echo $cedula?>">Julio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_julio ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">8</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=08&cedula=<? echo $cedula?>">Agosto</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_agosto?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">9</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=09&cedula=<? echo $cedula?>">Septiembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_septi?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">10</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=10&cedula=<? echo $cedula?>">Octubre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_octubre ?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">11</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=11&cedula=<? echo $cedula?>">Noviembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_noviem?></td>
  </tr>
  <tr align="center">
    <td style="font-weight: bold">12</td>
    <td style="font-weight: bold"><a href="nomina_estesi_reporte_detalle.php?mes=12&cedula=<? echo $cedula?>">Diciembre</a></td>
    <td style="font-weight: bold"><? echo  $cria_hembra_dici?></td>
  </tr>
</table>

