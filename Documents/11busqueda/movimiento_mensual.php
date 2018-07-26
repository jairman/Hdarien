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
// Paridas
$sql1 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Vaca Parida'",$conexion);
$paridas = mysql_num_rows($sql1);
//crias macho
$sql2 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO'",$conexion);
$cria_macho = mysql_num_rows($sql2);
//crias hembra
$sql3 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA'",$conexion);
$cria_hembra = mysql_num_rows($sql3);
//crias horras
$sql4 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Vaca Horra'",$conexion);
$horras = mysql_num_rows($sql4);
//Novillas Vientre
$sql5 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Novilla Vientre'",$conexion);
$nv = mysql_num_rows($sql5);
//Hembas Levante 9-12 meses
$sql6 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Hembra  Levante' and edad >=9 and edad <= 12",$conexion);
$hl9_12 = mysql_num_rows($sql6);

//Hembas Levante 13-18 meses
$sql7 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Hembra  Levante' and edad >=13 and edad <= 18",$conexion);
$hl13_18 = mysql_num_rows($sql7);
//Hembas Levante 19-24 meses
$sql8 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Hembra  Levante' and edad >=19 and edad <= 24",$conexion);
$hl19_24 = mysql_num_rows($sql8);
//Hembas Levante 25-30 meses
$sql9 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Hembra  Levante' and edad >=25 and edad <= 30",$conexion);
$hl25_30 = mysql_num_rows($sql9);
///////////////////////////////// MACHOS  ////////////////////////////////////

//MACHOS Levante 9-12 meses
$sql61 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Macho Levante' and edad >=9 and edad <= 12",$conexion);
$ml9_12 = mysql_num_rows($sql61);

//MACHOS Levante 13-18 meses
$sql71 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Macho Levante' and edad >=13 and edad <= 18",$conexion);
$ml13_18 = mysql_num_rows($sql71);
//MACHOS Levante 19-24 meses
$sql81 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Macho Levante' and edad >=19 and edad <= 24",$conexion);
$ml19_24 = mysql_num_rows($sql81);
//MACHOS Levante 25-30 meses
$sql91 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Macho Levante' and edad >=25 and edad <= 30",$conexion);
$ml25_30 = mysql_num_rows($sql91);
////////////////////////////////  CEBA  /////////////////////////////

//Machos De Ceba
$sql10 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Macho Ceba'",$conexion);
$ms = mysql_num_rows($sql10);
//Hembra Ceba
$sql11 = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Hembra Ceba'",$conexion);
$hs = mysql_num_rows($sql11);

////////////////////////////////  TORETES ///////////////////////////////

//TORETES Levante 9-12 meses
$sql61T = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Torete' and edad >=9 and edad <= 12",$conexion);
$Tl9_12 = mysql_num_rows($sql61T);

//TORETES Levante 13-18 meses
$sql71T = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Torete' and edad >=13 and edad <= 18",$conexion);
$Tl13_18 = mysql_num_rows($sql71T);
//TORETES Levante 19-24 meses
$sql81T = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Torete' and edad >=19 and edad <= 24",$conexion);
$Tl19_24 = mysql_num_rows($sql81T);
//TORETES Levante 25-30 meses
$sql91T = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Torete' and edad >=25 and edad <= 30",$conexion);
$Tl25_30 = mysql_num_rows($sql91T);
/////////////////////////////////////////// TOROS ///////////////////////////////////////////////////
//Toros Venta
$sql11T = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Toro Venta'",$conexion);
$TV = mysql_num_rows($sql11T);
//Toro Finca
$sql11TF = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Toro Finca'",$conexion);
$TF = mysql_num_rows($sql11TF);
//Bueyes
$sql11B= mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Bueyes'",$conexion);
$BY = mysql_num_rows($sql11B);
//Desviados
$sql11D= mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Desviados'",$conexion);
$DS = mysql_num_rows($sql11D);
////////////////////////////////////////  HUERFANOS ////////////////////////////

//Cria Huerfana Macho
$sql11HM= mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Cria Huerfana Macho'",$conexion);
$HM= mysql_num_rows($sql11HM);
//Cria Huerfana Hembra
$sql11HH= mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='Cria Huerfana Hembra'",$conexion);
$HH= mysql_num_rows($sql11HH);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex.php" >Inventario Vacuno</span></a>  </li>
    <li><a href="edit_reproduc_machos.php">Machos</a></li>
  <li><a href="busqueda_reproductoras.php">Hembras</a></li>
  <li><a href="kardex_paridas_inven.php">Paridas</a></li>
  <li><a href="paritorio.php">Paritorio</a></li>
  <li><a href="movimiento_mensual.php" class="current">Movimientos</a></li>
   <li><a href="agregar_lotes_princi.php">Lotes</a></li>
</ul>
 <p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td><img src="idsolutions--este.png" width="177" height="61" /></td>
  </tr>
  <tr>
    <th bgcolor="#4D68A2" style="color: #FFF">MOVIMIENTO MENSUAL DE GANADO</th>
  </tr>
</table>

<table width="100%" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="9%">HACIENDA</td>
    <td width="17%">&nbsp;</td>
    <td width="23%">TIPO DE GANADO</td>
    <td width="19%">&nbsp;</td>
    <td width="7%">MES</td>
    <td width="12%">&nbsp;</td>
    <td width="4%">AÑO</td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <th width="35%" rowspan="2">DESCRIPCIÓN</th>
    <th width="8%" rowspan="2" align="center">Existencia Inicial</th>
    <th colspan="3">ENTRADAS</th>
    <th colspan="3">SALIDAS</th>
    <th width="8%" rowspan="2">Existencia Final</th>
  </tr>
  <tr>
    <td align="center">Nacimientos</td>
    <td align="center">Compras</td>
    <td align="center">Reclasificación</td>
    <td align="center">Muertes</td>
    <td align="center">Ventas</td>
    <td align="center">Reclasificación</td>
  </tr>
  <tr>
    <td>Vacas Paridas</td>
    <th><? echo $paridas;?></th>
    <td width="8%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="9%">&nbsp;</td>
    <td width="7%">&nbsp;</td>
    <td width="9%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Crías Machos</td>
    <th><? echo $cria_macho;?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Crías Hembras</td>
    <th><? echo $cria_hembra; ?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Crías Huérfanas   Machos </td>
    <th><? echo $HM ?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Crías Huérfanas   Hembras </td>
    <th><? echo $HH ?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Vacas Horras</td>
    <th><? echo $horras?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Novillas De Vientre</td>
    <th><? echo $nv?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Hembras De Levante 9-12 meses</td>
    <th><? echo $hl9_12?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Hembras De Levante 13-18 meses</td>
    <th><? echo $hl13_18?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Hembras De Levante 19-24 meses</td>
    <th><? echo $hl19_24?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Hembras De Levante 25-30 meses</td>
    <th><? echo $hl25_30?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Machos  De Levante 9-12 meses</td>
    <th><? echo $ml9_12?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Machos  De Levante 13-18 meses</td>
    <th><? echo $ml13_18?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Machos  De Levante 19-24 meses</td>
    <th><? echo $ml19_24?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Machos  De Levante 25-30 meses</td>
    <th><? echo $ml25_30?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Machos De Ceba</td>
    <th><? echo $ms?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Hembras De Ceba</td>
    <th><? echo $hs?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Toretes  9 – 12 meses</td>
    <th><? echo $Tl9_12?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Toretes  13 – 18 meses</td>
    <th><? echo $Tl13_18?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Toretes  19 – 24 meses</td>
    <th><? echo $Tl19_24?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Toretes  25 – 30 meses</td>
    <th><? echo $Tl25_30?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Toros Venta</td>
    <th><? echo $TV?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Toros Finca</td>
    <th><? echo $TF?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Bueyes</td>
    <th><? echo $BY?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Desviados</td>
    <th><? echo $DS?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>TOTAL</strong></td>
    <th><? echo number_format (($paridas + $cria_hembra + $cria_macho + $HM + $HH + $horras + $nv + $hl9_12 + $hl13_18 + $hl19_24 + $hl25_30 + $ml9_12 + $ml13_18 + $ml19_24 + $ml25_30 + $ms + $hs + $Tl9_12 + $Tl13_18 + $Tl19_24 + $Tl25_30 + $TV + $TF + $BY + $DS))?></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
</script> 
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>