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
	$usuario= $userx->usertype;
	$usuario_nivel=$userx->usertype2;
	$usuario_name=$userx->username;
	$usuario_resp= $userx->name;
	$acceso= $userx->caja;
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
}if (!function_exists("GetSQLValueString")) {
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
$mess= date("m"); // Year (2003)
mysql_select_db($database_conexion, $conexion);
$query_v = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess'";
$v = mysql_query($query_v, $conexion) or die(mysql_error());
$row_v = mysql_fetch_assoc($v);
$totalRows_v = mysql_num_rows($v);mysql_select_db($database_conexion, $conexion);
///////////////////////////////////////////////////////////////////////////////////////////////////////
mysql_query("SET lc_time_names = 'es_CO'");
mysql_select_db($database_conexion, $conexion);
$query_hac = "SELECT DISTINCT YEAR(fecha) as ano1, YEAR(fecha) as ano2 FROM d89xz_diario ";
//$query_hac = "SELECT DISTINCT MONTHNAME(fecha) as mes, MONTH(fecha) as mes2 FROM d89xz_diario ";
$hac = mysql_query($query_hac, $conexion) or die(mysql_error());
$row_hac = mysql_fetch_assoc($hac);
$totalRows_hac = mysql_num_rows($hac);
$colname_lot = "-1";
if (isset($_POST['ubica'])) {
  $colname_lot = $_POST['ubica'];
  
}
mysql_select_db($database_conexion, $conexion);
$query_lot = sprintf("SELECT DISTINCT MONTHNAME(fecha) as mes, MONTH(fecha) as mes2 FROM d89xz_diario WHERE  YEAR(fecha) = %s order by mes2", GetSQLValueString($colname_lot, "text"));
$lot = mysql_query($query_lot, $conexion) or die(mysql_error());
$row_lot = mysql_fetch_assoc($lot);
$totalRows_lot = mysql_num_rows($lot);
$query_v = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess'";
$v = mysql_query($query_v, $conexion) or die(mysql_error());
$row_v = mysql_fetch_assoc($v);
$totalRows_v = mysql_num_rows($v);
//total Ventas

$result = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND concep = 'Ingreso' and estado!='Cancelada' and estado!='Pendiente'"); 
		 
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			@$ventas =  number_format($row[total]);
			//echo $ventas;
				
				$result22 = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND concep = 'Ingreso'  and estado='Pago'"); 
			 
				$row22 = mysql_fetch_array($result22, MYSQL_ASSOC);
				@$ventasT = $row22[total];
			
				
//total Compras

$result1 = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND concep = 'Egreso' and estado!='Cancelada' and estado!='Pendiente' "); 
		 
			$row1 = mysql_fetch_array($result1, MYSQL_ASSOC);
			@$egreso =  number_format($row1[total]);
			//echo $ventas;
				$result11 = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' AND concep = 'Egreso' and estado='Pago'"); 
			 
				$row11 = mysql_fetch_array($result11, MYSQL_ASSOC);
				@$egresoT =  $row11[total];
				
	$final = $ventasT + $egresoT;
	
	$finalT= number_format($final);
	
				
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true
});
// </script>
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

Shadowbox.open({
content: url,
player: "iframe",
options: {  modal: true	
}})
}

</script>
</head><body>
<table width="80%" border="1" align="center" cellspacing="0">
  <tr align="center" bgcolor="#4D68A2">
    <td colspan="4" align="left" bgcolor="#FFFFFF"><img src="img/Logo SAGA sin texto.png" width="200" height="70" /></td>
  </tr>
  <tr align="center" bgcolor="#4D68A2">
    <td bgcolor="#FFFFFF"><input name="button4" type="submit" class="ext" id="button4"   onclick="agre1()" value="Facturas Anuladas"/></td>
    <td bgcolor="#FFFFFF"><input name="button3" type="submit" class="ext" id="button3"   onclick="agre()" value="Reportes De Ventas"/></td>
    <td bgcolor="#FFFFFF"><input name="button2" type="submit" class="ext" id="button2"  onclick="pendi()" value="Reportes De Compras" /></td>
    <th bgcolor="#FFFFFF"><input name="button" type="submit" class="ext" id="button"    onclick="histo()" value="Reporte Mensual Caja"/></th>
  </tr>
</table>

<form id="form2" name="form2" method="post" action="">
<table width="80%" border="1" align="center" cellspacing="0">
    <tr class="tittle">
    <th colspan="2" >&nbsp;</th>
  </tr>
  <tr>
    <td width="50%" align="center" class="bold">Seleccione Año</td>
    <td width="50%" class="cont"> <label for="ubica"></label>
      <select name="ubica" id="ubica" onchange="submit()" style="width:300px">
        <option value="">Seleccione Año</option>
        <?php
do {  
?>
        <option value="<?php echo $row_hac['ano2']?>"><?php echo $row_hac['ano1']?></option>
        <?php
} while ($row_hac = mysql_fetch_assoc($hac));
  $rows = mysql_num_rows($hac);
  if($rows > 0) {
      mysql_data_seek($hac, 0);
	  $row_hac = mysql_fetch_assoc($hac);
  }
?>
      </select>
    </td>
  </tr>
</table>
<table width="80%" border="1" align="center" cellspacing="0">
  <tr bgcolor="#4D68A2" style="color: #FFF">
    <th colspan="4" align="left" bgcolor="#FFFFFF">&nbsp;</th>
  </tr>
  <tr >
    <td colspan="4" align="center"  class="tittle">Historial  De Caja  Año <?php echo $colname_lot ?></td>
  </tr>
  <tr align="center" class="tittle" >
    <td width="30%" >ID</td>
    <td >MESES</td>
    <td >Ventas</td>
    <td >Compras</td>
  </tr>
  <?php do { ?>
  <tr align="center" class="row" id="fila_<? echo $row_lot['mes']; ?>" onclick="CrearEnlace('dia_dia_histo1.php?mes=<?php echo $row_lot['mes2']; ?>&amp;ano=<?php echo  $colname_lot ?>');" onmouseover="ResaltarFila('fila_<? echo $row_lot['mes']; ?>');mano(this);"  onmouseout="RestablecerFila('fila_<? echo $row_lot['mes']; ?>')">
    <td class="row"><?php echo $row_lot['mes2']; ?></td>
    <td class="row"><?php echo strtoupper($row_lot['mes']); ?></td>
    <td class="row"><?
	
	$juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$colname_lot' AND MONTH(fecha) = '$row_lot[mes2]' AND concep = 'Ingreso' and estado!='Cancelada' and estado!='Pendiente'",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_hembra_julio= number_format ($row07["total"]);
$cria_hembra_julio1= ($row07["total"]);
echo $cria_hembra_julio;
	
	
    ?></td>
    <td class="row"><?
    $juli = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where  YEAR(fecha) = '$colname_lot' AND MONTH(fecha) = '$row_lot[mes2]' AND concep = 'Egreso'and estado!='Cancelada' and estado!='Pendiente'",$conexion);
$row07 = mysql_fetch_array($juli, MYSQL_ASSOC);
$cria_macho_julio= number_format ($row07["total"]);
$cria_macho_julio1=($row07["total"]);
echo $cria_macho_julio;
	?></td>
  </tr>
  <?php } while ($row_lot = mysql_fetch_assoc($lot)); ?>
</table>
</form>
</body>
</html>
<?php
mysql_free_result($v);

mysql_free_result($lot);
mysql_free_result($hac);
?>

</DIV> 

<script language="Javascript">

function agre(){
	var url = 'bus_detalle_dia_dia.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function agre1(){
	var url = 'bus_detalle_dia_dia_anuladas.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}

function pendi(){
	var url = 'bus_detalle_dia_dia_compras.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}

function histo(){
	var url = 'bus_detalle_dia_dia_caja.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}

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