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
@$mess=$_GET['mes'];
@$reporte =$_GET['repor'];


mysql_select_db($database_conexion, $conexion);
$query_pd = "SELECT DISTINCT `vacuno`,hierro, raza FROM d89xz_detalle_leche where vacuno !='' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ";
$pd = mysql_query($query_pd, $conexion) or die(mysql_error());
$row_pd = mysql_fetch_assoc($pd);
$totalRows_pd = mysql_num_rows($pd);

//////////////////////////////////  Semana 1///////////////////////7
mysql_select_db($database_conexion, $conexion);
$quesen1 = "SELECT DISTINCT `vacuno`,hierro, raza FROM d89xz_detalle_leche where vacuno !='' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' and semana ='1'  ";
$pd1 = mysql_query($quesen1, $conexion) or die(mysql_error());
$totalva1 = mysql_num_rows($pd1);

//////////////////////////////////  Semana 2///////////////////////7
mysql_select_db($database_conexion, $conexion);
$quesen2 = "SELECT DISTINCT `vacuno`,hierro, raza FROM d89xz_detalle_leche where vacuno !='' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' and semana ='2'  ";
$pd2 = mysql_query($quesen2, $conexion) or die(mysql_error());
$totalva2 = mysql_num_rows($pd2);

//////////////////////////////////  Semana 3///////////////////////7
mysql_select_db($database_conexion, $conexion);
$quesen3 = "SELECT DISTINCT `vacuno`,hierro, raza FROM d89xz_detalle_leche where vacuno !='' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' and semana ='3'  ";
$pd3 = mysql_query($quesen3, $conexion) or die(mysql_error());
$totalva3 = mysql_num_rows($pd3);

//////////////////////////////////  Semana 4///////////////////////7
mysql_select_db($database_conexion, $conexion);
$quesen4 = "SELECT DISTINCT `vacuno`,hierro, raza FROM d89xz_detalle_leche where vacuno !='' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' and semana ='4'  ";
$pd4 = mysql_query($quesen4, $conexion) or die(mysql_error());
$totalva4 = mysql_num_rows($pd4);

//////////////////////////////////  Semana 5///////////////////////7
mysql_select_db($database_conexion, $conexion);
$quesen5 = "SELECT DISTINCT `vacuno`,hierro, raza FROM d89xz_detalle_leche where vacuno !='' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' and semana ='5'  ";
$pd5 = mysql_query($quesen5, $conexion) or die(mysql_error());
$totalva5 = mysql_num_rows($pd5);


//aca
mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

mysql_select_db($database_conexion, $conexion);
$query_cli = "SELECT * FROM d89xz_clientes";
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>




<style type="text/css">
.a {
	color: #FFF;
}
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>


<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="121" align="left" bgcolor="#f0f0f0">&nbsp;</td>
    <td width="308" align="center" bgcolor="#f0f0f0"><a href="kardex_paridas_histor.php"><img src="last.png" alt="" width="29" height="31" /></a></td>
    <td width="239" align="right" bgcolor="#f0f0f0"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a></td>
  </tr>
</table>
<DIV ID="seleccion">

<table width="100%" border="1" align="center" cellspacing="0">
  <tr class="a">
    <td colspan="8" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" /></td>
  </tr>
  <tr class="a">
    <th colspan="3" rowspan="2" bgcolor="#4D68A2" style="font-size: 24px">Vaca</th>
    <th colspan="3" bgcolor="#4D68A2" style="font-size: 24px">Producción (Kg)  </th>
    <th bgcolor="#4D68A2" style="font-size: 24px">Mes</th>
    <th bgcolor="#4D68A2" style="font-size: 24px"><? echo $reporte;  ?></th>
  </tr>
  <tr class="a">
    <th colspan="5" bgcolor="#4D68A2" style="font-size: 24px">Semanas</th>
  </tr>
  <tr class="a">
    <th width="128" bgcolor="#4D68A2">ID</th>
    <th width="65" bgcolor="#4D68A2">Hierro</th>
    <th width="55" bgcolor="#4D68A2">Raza</th>
    <th width="157" bgcolor="#4D68A2">1</th>
    <th width="190" bgcolor="#4D68A2">2</th>
    <th width="188" bgcolor="#4D68A2">3</th>
    <th width="137" bgcolor="#4D68A2">4</th>
    <th width="128" bgcolor="#4D68A2">5</th>
  </tr>
  <?php do { ?>
    <tr align="center" style="font-size: 14px">
      <td><?php echo $row_pd['vacuno'];?></td>
      <td><?php echo $row_pd['hierro']; ?></td>
      <td><?php echo $row_pd['raza']; ?></td>
      <td><?
$sem1 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno = '$row_pd[vacuno]' and semana='1'  and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ",$conexion);

$row01 = mysql_fetch_array($sem1, MYSQL_ASSOC);
$seman1= number_format ($row01["total"]);
      echo $seman1;
      
      
      ?></td>
      <td><?
$sem2 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno = '$row_pd[vacuno]' and semana='2' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ",$conexion);

$row02 = mysql_fetch_array($sem2, MYSQL_ASSOC);
$seman2= number_format ($row02["total"]);
      echo $seman2;
      
      ?></td>
      <td><?
$sem3 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno = '$row_pd[vacuno]' and semana='3' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ",$conexion);

$row03 = mysql_fetch_array($sem3, MYSQL_ASSOC);
$seman3= number_format ($row03["total"]);
      echo $seman3;
      
      ?></td>
      <td><?
$sem4 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno = '$row_pd[vacuno]' and semana='4' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess'",$conexion);

$row04 = mysql_fetch_array($sem4, MYSQL_ASSOC);
$seman4= number_format ($row04["total"]);
      echo $seman4;
      
      ?></td>
      <td><?
$sem5 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE vacuno = '$row_pd[vacuno]' and semana='5' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess'",$conexion);

$row05 = mysql_fetch_array($sem5, MYSQL_ASSOC);
$seman5= number_format ($row05["total"]);
      echo $seman5;
      
      ?></td>
    </tr>
    <?php } while ($row_pd = mysql_fetch_assoc($pd)); ?>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>&nbsp;</th>
    <th colspan="5" style="font-size: 24px">Semanas</th>
  </tr>
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th>&nbsp;</th>
    <th> 1</th>
    <th>2</th>
    <th> 3</th>
    <th>4</th>
    <th> 5</th>
  </tr>
  <tr>
    <th width="25%">Total</th>
    <th width="14%"><?
$tsem1 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and semana='1' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ",$conexion);
$tsemm1 = mysql_fetch_array($tsem1, MYSQL_ASSOC);
$totalsem1= number_format ($tsemm1["total"]);
echo $totalsem1;

?></th>
    <th width="18%"><?
$tsem2 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and semana='2' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ",$conexion);
$tsemm2 = mysql_fetch_array($tsem2, MYSQL_ASSOC);
$totalsem2= number_format ($tsemm2["total"]);
echo $totalsem2;

?></th>
    <th width="18%"><?
$tsem3 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and semana='3' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ",$conexion);
$tsemm3 = mysql_fetch_array($tsem3, MYSQL_ASSOC);
$totalsem3= number_format ($tsemm3["total"]);
echo $totalsem3;

?></th>
    <th width="13%"><?
$tsem4 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and semana='4' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ",$conexion);
$tsemm4 = mysql_fetch_array($tsem4, MYSQL_ASSOC);
$totalsem4= number_format ($tsemm4["total"]);
echo $totalsem4;

?></th>
    <th width="12%"><?
$tsem5 = mysql_query("SELECT SUM(`klos`) as total FROM d89xz_detalle_leche WHERE dedu != 'si' and semana='5' and YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ",$conexion);
$tsemm5 = mysql_fetch_array($tsem5, MYSQL_ASSOC);
$totalsem5= number_format ($tsemm5["total"]);
echo $totalsem5;

?></th>
  </tr>
  <tr>
    <th>Promedio</th>
    <th><? 
	if ($totalva1 ==0){
		echo $totalva1;
		
	}else{
	
	$prom1=number_format (($totalsem1/$totalva1),2) ;
			echo @$prom1;
	};
	
	?></th>
    <th><? 
	if ($totalva2 ==0){
		echo $totalva2;
		
	}else{
	$prom2=number_format (($totalsem2/$totalva2),2) ;
			echo @$prom2;
	};
	
	?></th>
    <th><? 
	if ($totalva3 ==0){
		echo $totalva3;
		
	}else{
	
	$prom3=number_format (($totalsem3/$totalva3),2) ;
			echo @$prom3;
	};
	
	?></th>
    <th><? 
	if ($totalva4 ==0){
		echo $totalva4;
		
	}else{
	
	$prom4=number_format ((@$totalsem4/@$totalva4),2) ;
			echo @$prom4;
	};		
	
	?></th>
    <th><? 
	if ($totalva5 ==0){
		echo $totalva5;
		
	}else{
	
	$prom5=number_format (($totalsem5/$totalva5),2) ;
			echo @$prom5;
	};
	
	?></th>
  </tr>
</table>
<p>&nbsp;</p>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>


</body>
</html>
<?php
mysql_free_result($mes);

mysql_free_result($anos);

mysql_free_result($cli);
mysql_free_result($pd);
mysql_free_result($pd1);
mysql_free_result($pd2);
mysql_free_result($pd3);
mysql_free_result($pd4);
mysql_free_result($pd5);
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



