<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if($acceso==0){
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
$fecha=$_GET['fecha'];
$filtro=$_GET['filtro'];
mysql_select_db($database_conexion, $conexion);
$query_lugar = "SELECT DISTINCT lugar_trabajo FROM nomina_liquidar WHERE estado='planilla' and fecha='$fecha' and hacienda='$filtro' and `delete`=0";
$lugar = mysql_query($query_lugar, $conexion) or die(mysql_error());
$totalRows_lugar = mysql_num_rows($lugar);
$rs_fijos=mysql_query("SELECT * FROM nomina_fijos_valle WHERE hacienda='$filtro'",$conexion);
$row_rs_fijos=mysql_fetch_assoc($rs_fijos);
$hora_extra_f=$row_rs_fijos['hora_extra_f'];
$hora_extra_t=$row_rs_fijos['hora_extra_t'];
$hora_extra=$row_rs_fijos['hora_extra'];
$dia_fest=$row_rs_fijos['festivo'];
$rs_empre=mysql_query("SELECT * FROM d89xz_empresa");
$row_empre=mysql_fetch_assoc($rs_empre);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<!--<link rel="stylesheet" href="css/clean.css" />-->
<link rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript">
Shadowbox.init({
	 onOpen: function() { 
$('#sb-body').prepend($('#sb-info'))},	 
 handleOversize: "drag",
 modal: true,
	
});
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

</head>

<body >
<table width="50%" border="0" cellspacing="0" cellpadding="0" align="right">
<tr>
 <td><div id="apDiv2"><a href="javascript:imprSelec('primir')" ><img src="../img/imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>
		</div></td>
</tr>
</table>

<div id="primir">
<table width="98%" border="1" cellspacing="0" cellpadding="0"align="center" style="font-size:12px !important">
<tr align="center" >
 <td colspan="2" rowspan="3" align="center"><span class="current" ><img src="../img/Logo.png" width="200" height="90" /></span></td>
 <td colspan="2" align="left"  style="font-weight:bold">Empresa</td>
 <td colspan="7" align="left"><?php echo $row_empre['empresa'] ?></td>
 </tr>
<tr align="center" >
  <td colspan="2" align="left"><span style="font-weight:bold">N.I.T</span></td>
  <td colspan="7" align="left"><?php echo $row_empre['nit'] ?></td>
</tr>
<tr align="center" >
  <td colspan="2" align="left"><span style="font-weight:bold">Teléfono</span></td>
  <td colspan="7" align="left"><?php echo $row_empre['telefono'] ?></td>
</tr>
<tr align="center" class="tittle" >
 <td colspan="11">Fecha de Planilla <?php echo $fecha; ?><input name="" type="hidden" id="filtro" value="<?php echo $filtro ?>" /></td>
</tr>

<tr align="center" class="tittle2" style="font-size:14px !important">
 <td colspan="2">Información Básica</td>
 <td colspan="2">Básico</td>
 <td colspan="2">Deducciones</td>
 <td colspan="5">Otros</td>
</tr>
<tr align="center" class="stittle" style="font-size:14px !important">
 <td>Nombre</td>
 <td>Cédula</td>
 <td>Quincena</td>
 <td>Transporte</td>
 <td>Salud</td>
 <td>Pensión</td>
 <td>Extras</td>
 <td>Bonificación</td>
 <td>Prestamos</td>
 <td>Dcto-Días</td>
 <td>Total</td>
</tr>
<?php
while($row_lugar = mysql_fetch_assoc($lugar)){
	$lugar_tra=$row_lugar['lugar_trabajo'];
	$query_ced = "SELECT * FROM nomina_liquidar WHERE lugar_trabajo='$lugar_tra' and estado='planilla' and fecha='$fecha' and hacienda='$filtro' and `delete`=0";
	$ced = mysql_query($query_ced, $conexion) or die(mysql_error());

	 $result = mysql_query("SELECT SUM(quincena) as quincena, SUM(transporte) as transporte, SUM(salud) as salud, SUM(pension) as pension, SUM(total) as total, SUM(hs) as hs, SUM(hst) as hst, SUM(hsf) as hsf, SUM(total1) as total1, SUM(dia_festivo) as dia_festivo, SUM(total2) as total2, SUM(bonificacion) as bonificacion, SUM(viajes) as viajes, SUM(total4) as total4, SUM(total4) as total4, SUM(hst) as hst, SUM(hsf) as hsf, SUM(prestamos) as prestamos, SUM(d_dcto) as d_dcto, SUM(mercado) as mercado FROM nomina_liquidar WHERE lugar_trabajo='$lugar_tra' and estado='planilla' and hacienda='$filtro' and `delete`=0 and fecha='$fecha'") or die(mysql_error());
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	
?>
<tr class="tittle2" style="text-align:left; font-size:14px !important; margin-right:15px" >
 <td colspan="11" height="25"><?php echo $row_lugar['lugar_trabajo'] ?></td>
</tr>
<?php 
	$tot_dias=0;
	while($row_ced = mysql_fetch_assoc($ced)){	
	$extras=$row_ced['hs']*$hora_extra+$row_ced['hst']*$hora_extra_t+$row_ced['hsf']*$hora_extra_f+$row_ced['dia_festivo']*$dia_fest;	
	?>
<tr align="center" onclick="mostrar(<?php echo $row_ced['id'] ?>)" onmouseover="dibujar(<?php echo $row_ced['id'] ?>)" onmouseout="desdibujar(<?php echo $row_ced['id'] ?>)" id="<?php echo $row_ced['id'] ?>">
 <td style="white-space:nowrap"><input name="id" type="hidden" value="<?php echo $row_ced['id_nomina'] ?>" id="<?php echo $row_ced['id_nomina'] ?>"/>

<input type="hidden" name="fecha" id="fecha" value="<?php echo $today ?>"/>
<input type="hidden" name="filtro" id="filtro" value="<?php echo $filtro ?>"/>
<?php
	$id=$row_ced['id_nomina'];
	$rs_datos=mysql_query("SELECT * FROM nomina_valle WHERE id='$id'",$conexion);
	$row_rs_datos=mysql_fetch_assoc($rs_datos);
	$nombre=$row_rs_datos['nombre'];
	$cedula=$row_rs_datos['cedula'];
	?>
 <?php echo $nombre ?></td>
 <td><?php echo $cedula ?></td>
 <td><?php echo @number_format($row_ced['quincena']) ?></td>
 <td><?php echo @number_format($row_ced['transporte']) ?></td>
 <td><?php echo @number_format($row_ced['salud']) ?></td>
 <td><?php echo @number_format($row_ced['pension']) ?></td>
 <td><?php echo @number_format($extras) ?></td>
 <td><?php echo @number_format($row_ced['bonificacion']) ?></td>
 <td><?php echo @number_format($row_ced['prestamos']) ?></td>
 <td><?php echo @number_format($row_ced['d_dcto']*$row_ced['dia']) ?></td>
 <td style="font-weight:bold"><?php echo @number_format($row_ced['total4']);?></td>
</tr>

<?php
$tot_dias+=$row_ced['d_dcto']*$row_ced['dia'];
$g_tot_dias+=$row_ced['d_dcto']*$row_ced['dia'];
}
?>
<tr align="center" class="bold">
 <td colspan="2">Totales</td>
 <td><?php echo number_format($row['quincena']) ?></td>
 <td><?php echo number_format($row['transporte']) ?></td>
 <td><?php echo number_format($row['salud']) ?></td>
 <td><?php echo number_format($row['pension']) ?></td>
 <?php
	$tot_extras=$row['hs']*$hora_extra+$row['hst']*$hora_extra_t+$row['hsf']*$hora_extra_f+$row['dia_festivo']*$dia_fest;
	?>
 <td><?php echo number_format($tot_extras) ?></td>
 <td><?php echo number_format($row['bonificacion']) ?></td>
 <td><?php echo number_format($row['prestamos']) ?></td>
 <td id="dias"><?php echo number_format($tot_dias) ?></td>
 <td><?php echo number_format($row['total4']) ?></td>
</tr>

<?php
}
$result = mysql_query("SELECT SUM(quincena) as quincena, SUM(transporte) as transporte, SUM(salud) as salud, SUM(pension) as pension, SUM(total) as total, SUM(hs) as hs, SUM(hst) as hst, SUM(hsf) as hsf, SUM(total1) as total1, SUM(dia_festivo) as dia_festivo, SUM(total2) as total2, SUM(bonificacion) as bonificacion, SUM(viajes) as viajes, SUM(total4) as total4, SUM(total4) as total4, SUM(hst) as hst, SUM(hsf) as hsf, SUM(prestamos) as prestamos, SUM(d_dcto) as d_dcto, SUM(mercado) as mercado FROM nomina_liquidar WHERE estado='planilla' and fecha='$fecha' and hacienda='$filtro' and `delete`=0") or die(mysql_error());
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$tot_extras=$row['hs']*$hora_extra+$row['hst']*$hora_extra_t+$row['hsf']*$hora_extra_f+$row['dia_festivo']*$dia_fest;
?>
 <tr class="tittle2" align="center" >
<td colspan="2" style="font-size:14px !important">GRAN TOTAL</td>
<td><?php echo number_format($row['quincena']) ?></td>
 <td><?php echo number_format($row['transporte']) ?></td>
 <td><?php echo number_format($row['salud']) ?></td>
 <td><?php echo number_format($row['pension']) ?></td>
 <td><?php echo number_format($tot_extras) ?></td>
 <td><?php echo number_format($row['bonificacion']) ?></td>
 <td><?php echo number_format($row['prestamos']) ?></td>
 <td><?php echo number_format($g_tot_dias) ?></td>
 <td><?php echo number_format($row['total4']) ?></td>
</tr>
</table>
</div>
<div id="dialog"></div>
<?php
}else{
	?>
<table width="70%" border="0" align="center">
<tr>
 <td><img src="../img/Logo_out.png" width="300" height="140" /></td>
</tr>
<tr>
 <td>&nbsp;</td>
</tr>
<tr>
 <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
</tr>
</table>
<?php
}
?>
</body>
<script>
function mostrar(id){
var filtro=$('#filtro').val()
var url = 'stin_nomina_liquidar_ver.php?id='+id+'&filtro='+filtro;
	window.open(url,'','width=1200,height=600').focus()
}
function imprSelec(nombre){
var ficha = document.getElementById(nombre);
var ventimp = window.open(' ', 'popimpr');
ventimp.document.write( ficha.innerHTML );
ventimp.document.close();
ventimp.print( );
ventimp.close();
}

function dibujar(fila){	
	document.getElementById(fila).style.backgroundColor = "#CCC"; 
	document.getElementById(fila).style.cursor="pointer";
	document.getElementById(fila).title = 'Ver Detalle';
}
function desdibujar(fila){	
	 document.getElementById(fila).style.backgroundColor = "#FFF"; 
	 document.getElementById(fila).style.cursor="auto";
	 
}
</script>
</html>

