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
$query_cr = "SELECT * FROM d89xz_vacunos WHERE clasificasion = 'CRIA MACHO'";
$cr = mysql_query($query_cr, $conexion) or die(mysql_error());
$row_cr = mysql_fetch_assoc($cr);
$totalRows_cr = mysql_num_rows($cr);

$query_cr = "SELECT * FROM d89xz_vacunos WHERE clasificasion = 'CRIA MACHO' ORDER BY edad DESC";
$cr = mysql_query($query_cr, $conexion) or die(mysql_error());
$row_cr = mysql_fetch_assoc($cr);
$totalRows_cr = mysql_num_rows($cr);

$date= date("d/m/Y");
$anoss= date("Y"); // Year (2003)
//echo $anoss;
//echo date("m"); // Month (12)
//echo date("d"); // day (14)

//	++++++++++++++++++++++++++++++					MACHOS				++++++++++++++++++++++++++++++++++++++++++++++++++++
//crias macho enero
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '01' ",$conexion);
$cria_macho_enero = mysql_num_rows($sql);
//crias macho febrero
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '02' ",$conexion);
$cria_macho_febrero = mysql_num_rows($sql);
//crias macho marzo
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '03' ",$conexion);
$cria_macho_marzo = mysql_num_rows($sql);
//crias macho abril
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '04' ",$conexion);
$cria_macho_abril = mysql_num_rows($sql);
//crias macho mayo
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '05' ",$conexion);
$cria_macho_mayo = mysql_num_rows($sql);
//crias macho junio
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '06' ",$conexion);
$cria_macho_junio = mysql_num_rows($sql);
//crias macho julio
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '07' ",$conexion);
$cria_macho_julio = mysql_num_rows($sql);
//crias macho agosto
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '08' ",$conexion);
$cria_macho_agosto = mysql_num_rows($sql);
//crias macho septiembre
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '09' ",$conexion);
$cria_macho_septi = mysql_num_rows($sql);
//crias macho octubre
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '10' ",$conexion);
$cria_macho_octubre = mysql_num_rows($sql);
//crias macho noviembre
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '11' ",$conexion);
$cria_macho_noviem = mysql_num_rows($sql);
//crias macho diciembre
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA MACHO' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '12' ",$conexion);
$cria_macho_dici = mysql_num_rows($sql);



//	++++++++++++++++++++++++++++++					HEMBRAS				++++++++++++++++++++++++++++++++++++++++++++++++++++



//crias hembra enero
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '01' ",$conexion);
$cria_hembra_enero = mysql_num_rows($sql);
//crias hembra febrero
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '02' ",$conexion);
$cria_hembra_febrero = mysql_num_rows($sql);
//crias hembra marzo
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '03' ",$conexion);
$cria_hembra_marzo = mysql_num_rows($sql);
//crias hembra abril
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '04' ",$conexion);
$cria_hembra_abril = mysql_num_rows($sql);
//crias hembra mayo
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '05' ",$conexion);
$cria_hembra_mayo = mysql_num_rows($sql);
//crias hembra junio
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '06' ",$conexion);
$cria_hembrao_junio = mysql_num_rows($sql);
//crias hembra julio
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '07' ",$conexion);
$cria_hembra_julio = mysql_num_rows($sql);
//crias hembra agosto
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '08' ",$conexion);
$cria_hembra_agosto = mysql_num_rows($sql);
//crias hembra septiembre
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '09' ",$conexion);
$cria_hembra_septi = mysql_num_rows($sql);
//crias hembra octubre
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '10' ",$conexion);
$cria_hembra_octubre = mysql_num_rows($sql);
//crias hembra noviembre
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '11' ",$conexion);
$cria_hembra_noviem = mysql_num_rows($sql);
//crias hembra diciembre
$sql = mysql_query("select * FROM d89xz_vacunos WHERE `tp_rep` ='CRIA HEMBRA' and  YEAR(f_ingreso) = '$anoss' AND MONTH(f_ingreso) = '12' ",$conexion);
$cria_hembra_dici = mysql_num_rows($sql);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<style type="text/css">
#seleccion #form1 table tr th {
	color: #FFF;
}
#c {
	color: #FFF;
}
#form2 table tr th {
	color: #FFF;
}
</style>
 <style> 
a{text-decoration:none} 
</style>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<link rel="stylesheet" type="text/css" href="shadowbox.css">

<script type="text/javascript" src="shadowbox.js"></script>

<script type="text/javascript"><!--

Shadowbox.init({
    handleOversize:     "drag",
    displayNav:         false,
    handleUnsupported:  "remove",
});

// --></script>
<body>



<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="kardex.php" >Inventario Vacuno</span></a>  </li>
    <li><a href="edit_reproduc_machos.php">Machos</a></li>
  <li><a href="busqueda_reproductoras.php">Hembras</a></li>
  <li><a href="kardex_paridas_inven.php">Lecher&iacute;a</a></li>
  <li><a href="paritorio.php" class="current">Paritorio</a></li>
   <li><a href="movimiento_mensual.php">Movimientos</a></li>
</ul>
 <p>&nbsp;</p>
 <ul id="MenuBar1" class="MenuBarHorizontal">
   <li><a href="paritorio_vacas_proxi_parir.php"> Próximas A Parir</a></li>
    <li><a href="paritorio_vacas_prenadas.php"  > Preñadas</a></li>
 
   <li><a href="paritorio_vacas_nacimientos.php"  class="current"> Nacimientos</a></li>
    <li><a href="paritorio_vacas_abortos.php"> Abortos</a></li>
  
</ul>
 <p>&nbsp;</p>

<td width="32%">&nbsp;</td>

  <table width="535" border="1" align="center" cellspacing="0">
    <tr bgcolor="#4D68A2" style="color: #FFF">
      <th width="102" rowspan="2">ID</th>
      <th width="151" rowspan="2">Meses</th>
      <th colspan="2">Nacimientos</th>
    </tr>
    <tr>
      <th bgcolor="#4D68A2" style="color: #FFF">Crías Hembras</th>
      <th bgcolor="#4D68A2" style="color: #FFF">Crías  Machos</th>
    </tr>
    
    <tr align="center">
        <td style="font-weight: bold">1</td>
        <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=01">Enero</a></td>
        <td width="124" style="font-weight: bold"><? echo $cria_hembra_enero ?></td>
        <th width="130"><? echo $cria_macho_enero ?></th>
      </tr>
    <tr align="center">
      <td style="font-weight: bold">2</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=02">Febrero</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_febrero ?></td>
      <th><? echo $cria_macho_febrero ?></th>
      </tr>
    <tr align="center">
      <td style="font-weight: bold">3</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=03">Marzo</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_marzo ?></td>
      <th><? echo $cria_macho_marzo ?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">4</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=04">Abril</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_abril?></td>
      <th><? echo $cria_macho_abril ?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">5</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=05">Mayo</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_mayo ?></td>
      <th><? echo $cria_macho_mayo ?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">6</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=06">Junio</a></td>
      <td style="font-weight: bold"><? echo $cria_hembrao_junio?></td>
      <th><? echo $cria_macho_junio ?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">7</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=07">Julio</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_julio ?></td>
      <th><? echo $cria_macho_julio ?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">8</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=08">Agosto</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_agosto?></td>
      <th><? echo $cria_macho_agosto ?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">9</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=09">Septiembre</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_septi?></td>
      <th><? echo $cria_macho_septi ?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">10</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=10">Octubre</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_octubre ?></td>
      <th><? echo $cria_macho_octubre?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">11</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=11">Noviembre</a></td>
      <td style="font-weight: bold"><? echo $cria_hembra_noviem?></td>
      <th><? echo $cria_macho_noviem ?></th>
    </tr>
    <tr align="center">
      <td style="font-weight: bold">12</td>
      <td style="font-weight: bold"><a href="paritorio_vacas_nacimientos_machos.php?mes=12">Diciembre</a></td>
      <td style="font-weight: bold"><? echo  $cria_hembra_dici?></td>
      <th><? echo $cria_macho_dici ?></th>
    </tr>
      
  </table>


</body>
</html>
<?php
mysql_free_result($cr);
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
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>