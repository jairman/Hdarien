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
<script langiage="javascript" type="text/javascript">


function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
}

// RESALTAR LAS FILAS AL PASAR EL MOUSE
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
function CrearEnlace(url) {
    location.href=url;
}
</script>
<?
@$vacuno=$_GET['vacuno'];
$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)

//	++++++++++++++++++++++++++++++					MACHOS				++++++++++++++++++++++++++++++++++++++++++++++++++++
//crias hembra enero
$ener = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' ",$conexion);
$row01 = mysql_fetch_array($ener, MYSQL_ASSOC);
$cria_macho_enero= number_format ($row01["total"]);

//crias hembra febrero
$febr = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' ",$conexion);
$row02 = mysql_fetch_array($febr, MYSQL_ASSOC);
$cria_macho_febrero= number_format ($row02["total"]);


//crias hembra marzo

$marz = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' ",$conexion);
$row03 = mysql_fetch_array($marz, MYSQL_ASSOC);
$cria_macho_marzo= number_format ($row03["total"]);


//crias hembra abril

$abri = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' ",$conexion);

$row04 = mysql_fetch_array($abri, MYSQL_ASSOC);
$cria_macho_abril= number_format ($row04["total"]);


//crias hembra mayo

$mayo = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' ",$conexion);
$row05 = mysql_fetch_array($mayo, MYSQL_ASSOC);
$cria_macho_mayo= number_format ($row05["total"]);


//crias hembra junio

$juni = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' ",$conexion);
$row06 = mysql_fetch_array($juni, MYSQL_ASSOC);
$cria_macho_junio= number_format ($row06["total"]);


//crias hembra julio

$juli = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' ",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_macho_julio= number_format ($row07["total"]);


//crias hembra agosto

$agos = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' ",$conexion);
$row08 = mysql_fetch_array($agos, MYSQL_ASSOC);
$cria_macho_agosto= number_format ($row08["total"]);


//crias hembra septiembre

$sept = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' ",$conexion);
$row09 = mysql_fetch_array($sept, MYSQL_ASSOC);
$cria_macho_septi= number_format ($row09["total"]);


//crias hembra octubre

$octu = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' ",$conexion);

$row10 = mysql_fetch_array($octu, MYSQL_ASSOC);
$cria_macho_octubre= number_format ($row10["total"]);

//crias hembra noviembre

$novi = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' ",$conexion);
$row11 = mysql_fetch_array($novi, MYSQL_ASSOC);
$cria_macho_noviem= number_format ($row11["total"]);

//crias hembra diciembre
$dici = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu = 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' ",$conexion);
$row12 = mysql_fetch_array($dici, MYSQL_ASSOC);
$cria_macho_dici= number_format ($row12["total"]);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//crias hembra enero
$ener = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '01' ",$conexion);
$row01 = mysql_fetch_array($ener, MYSQL_ASSOC);
$cria_hembra_enero= number_format ($row01["total"]);

//crias hembra febrero
$febr = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '02' ",$conexion);
$row02 = mysql_fetch_array($febr, MYSQL_ASSOC);
$cria_hembra_febrero= number_format ($row02["total"]);


//crias hembra marzo

$marz = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '03' ",$conexion);
$row03 = mysql_fetch_array($marz, MYSQL_ASSOC);
$cria_hembra_marzo= number_format ($row03["total"]);


//crias hembra abril

$abri = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '04' ",$conexion);

$row04 = mysql_fetch_array($abri, MYSQL_ASSOC);
$cria_hembra_abril= number_format ($row04["total"]);


//crias hembra mayo

$mayo = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '05' ",$conexion);
$row05 = mysql_fetch_array($mayo, MYSQL_ASSOC);
$cria_hembra_mayo= number_format ($row05["total"]);


//crias hembra junio

$juni = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '06' ",$conexion);
$row06 = mysql_fetch_array($juni, MYSQL_ASSOC);
$cria_hembrao_junio= number_format ($row06["total"]);


//crias hembra julio

$juli = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '07' ",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_hembra_julio= number_format ($row07["total"]);


//crias hembra agosto

$agos = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '08' ",$conexion);
$row08 = mysql_fetch_array($agos, MYSQL_ASSOC);
$cria_hembra_agosto= number_format ($row08["total"]);


//crias hembra septiembre

$sept = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '09' ",$conexion);
$row09 = mysql_fetch_array($sept, MYSQL_ASSOC);
$cria_hembra_septi= number_format ($row09["total"]);


//crias hembra octubre

$octu = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '10' ",$conexion);

$row10 = mysql_fetch_array($octu, MYSQL_ASSOC);
$cria_hembra_octubre= number_format ($row10["total"]);

//crias hembra noviembre

$novi = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '11' ",$conexion);
$row11 = mysql_fetch_array($novi, MYSQL_ASSOC);
$cria_hembra_noviem= number_format ($row11["total"]);

//crias hembra diciembre
$dici = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '12' ",$conexion);
$row12 = mysql_fetch_array($dici, MYSQL_ASSOC);
$cria_hembra_dici= number_format ($row12["total"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
<li><a href="kardex_paridas.php" >Lechería</a></li>
  <li><a href="kardex_paridas_dedus.php">Deducciones</a>  </li>
  <li><a href="kardex_paridas_semanal_total_leche.php">Generar Factura</a></li>
  <li><a href="kardex_paridas_histor.php" class="current">Historial</a></li>
</ul>
<p>&nbsp;</p>

<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="308" align="center" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="239" align="right" bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">
<table width="535" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th width="102" rowspan="2">ID</th>
    <th width="151" rowspan="2">Meses</th>
    <th colspan="2">Consolidado Anual Lechería</th>
  </tr>
  <tr>
    <th bgcolor="#4D68A2" style="color: #FFF">Total</th>
    <th bgcolor="#4D68A2" style="color: #FFF">Deducciones</th>
  </tr>
 <tr align="center" id="fila_1" onMouseOver="ResaltarFila('fila_1');mano(this);"  onMouseOut="RestablecerFila('fila_1')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=01&repor=Enero');">
    <td style="font-weight: bold">1</td>
    <td style="font-weight: bold">Enero</td>
    <td width="124" style="font-weight: bold"><? echo $cria_hembra_enero ?></td>
    <th width="130"><? echo $cria_macho_enero ?></th>
  </tr>
  <tr align="center" id="fila_2" onMouseOver="ResaltarFila('fila_2');mano(this);"  onMouseOut="RestablecerFila('fila_2')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=02&repor=Febrero');">
    <td  style="font-weight: bold">2</td>
    <td  style="font-weight: bold">Febrero</td>
    <td  style="font-weight: bold"><? echo $cria_hembra_febrero ?></td>
    <th ><? echo $cria_macho_febrero ?></th>
  </tr>
 <tr align="center" id="fila_3" onMouseOver="ResaltarFila('fila_3');mano(this);"  onMouseOut="RestablecerFila('fila_3')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=03&repor=Marzo');">
    <td style="font-weight: bold">3</td>
    <td style="font-weight: bold">Marzo</td>
    <td style="font-weight: bold"><? echo $cria_hembra_marzo ?></td>
    <th><? echo $cria_macho_marzo ?></th>
  </tr>
<tr align="center" id="fila_4" onMouseOver="ResaltarFila('fila_4');mano(this);"  onMouseOut="RestablecerFila('fila_4')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=04&repor=Abril');">
    <td style="font-weight: bold">4</td>
    <td  style="font-weight: bold">Abril</a></td>
    <td  style="font-weight: bold"><? echo $cria_hembra_abril?></td>
    <th ><? echo $cria_macho_abril ?></th>
  </tr>
<tr align="center" id="fila_5" onMouseOver="ResaltarFila('fila_5');mano(this);"  onMouseOut="RestablecerFila('fila_5')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=05&repor=Mayo');">
    <td style="font-weight: bold">5</td>
    <td style="font-weight: bold">Mayo</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_mayo ?></td>
    <th><? echo $cria_macho_mayo ?></th>
  </tr>
   <tr align="center" id="fila_6" onMouseOver="ResaltarFila('fila_6');mano(this);"  onMouseOut="RestablecerFila('fila_6')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=06&repor=Junio');">
    <td  style="font-weight: bold">6</td>
    <td  style="font-weight: bold">Junio</a></td>
    <td  style="font-weight: bold"><? echo $cria_hembrao_junio?></td>
    <th ><? echo $cria_macho_junio ?></th>
  </tr>
   <tr align="center" id="fila_7" onMouseOver="ResaltarFila('fila_7');mano(this);"  onMouseOut="RestablecerFila('fila_7')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=07&repor=Julio');">
    <td style="font-weight: bold">7</td>
    <td style="font-weight: bold">Julio</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_julio ?></td>
    <th><? echo $cria_macho_julio ?></th>
  </tr>
  <tr align="center" id="fila_8" onMouseOver="ResaltarFila('fila_8');mano(this);"  onMouseOut="RestablecerFila('fila_8')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=08&repor=Agosto');">
    <td  style="font-weight: bold">8</td>
    <td  style="font-weight: bold">Agosto</a></td>
    <td  style="font-weight: bold"><? echo $cria_hembra_agosto?></td>
    <th ><? echo $cria_macho_agosto ?></th>
  </tr>
 <tr align="center" id="fila_9" onMouseOver="ResaltarFila('fila_9');mano(this);"  onMouseOut="RestablecerFila('fila_9')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=09&repor=Septiembre');">
    <td style="font-weight: bold">9</td>
    <td style="font-weight: bold">Septiembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_septi?></td>
    <th><? echo $cria_macho_septi ?></th>
  </tr>
<tr align="center" id="fila_10" onMouseOver="ResaltarFila('fila_10');mano(this);"  onMouseOut="RestablecerFila('fila_10')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=10&repor=Octubre');">
    <td  style="font-weight: bold">10</td>
    <td  style="font-weight: bold">Octubre</a></td>
    <td  style="font-weight: bold"><? echo $cria_hembra_octubre ?></td>
    <th ><? echo $cria_macho_octubre?></th>
  </tr>
   <tr align="center" id="fila_11" onMouseOver="ResaltarFila('fila_11');mano(this);"  onMouseOut="RestablecerFila('fila_11')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=11&repor=Noviembre');">
    <td style="font-weight: bold">11</td>
    <td style="font-weight: bold">Noviembre</a></td>
    <td style="font-weight: bold"><? echo $cria_hembra_noviem?></td>
    <th><? echo $cria_macho_noviem ?></th>
  </tr>
  <!--<tr align="center">-->
  
   <tr align="center" id="fila_12" onMouseOver="ResaltarFila('fila_12');mano(this);"  onMouseOut="RestablecerFila('fila_12')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=12&repor=Diciembre');">
   <td  style="font-weight: bold">12</td>
    <td  style="font-weight: bold">Diciembre</a></td>
    <td  style="font-weight: bold"><? echo  $cria_hembra_dici?></td>
    <th ><? echo $cria_macho_dici ?></th>
  </tr>
   <tr align="center" onMouseOver="ResaltarFila('fila_12');mano(this);"  onMouseOut="RestablecerFila('fila_12')" onClick="CrearEnlace('kardex_paridas_planilla_semanal.php?mes=12&repor=Diciembre');">
     <td colspan="2"  style="font-weight: bold"><p>Total Anual</p></td>
     <td  style="font-weight: bold"><? 
$talAnual= number_format ($cria_hembra_enero + $cria_hembra_febrero + $cria_hembra_marzo + $cria_hembra_abril + $cria_hembra_mayo + $cria_hembrao_junio + $cria_hembra_julio + $cria_hembra_agosto + $cria_hembra_septi + $cria_hembra_octubre + $cria_hembra_noviem + $cria_hembra_dici);
 
  echo  $talAnual;   
	 
	 ?></td>
     <th ><?
$totalDeduc =number_format ($cria_macho_enero + $cria_macho_febrero + $cria_macho_marzo + $cria_macho_abril + $cria_macho_mayo + $cria_macho_junio + $cria_macho_julio + $cria_macho_agosto + $cria_macho_septi + $cria_macho_octubre + $cria_macho_noviem + $cria_macho_dici);
    echo $totalDeduc; 
	 ?></th>
   </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
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



