<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if ($acceso =='0'){
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
$filtro=$_GET['filtro'];

date_default_timezone_set('America/Bogota');
$today = date("Y-m-d");
mysql_select_db($database_conexion, $conexion);
$query_lugar = "SELECT DISTINCT lugar_trabajo FROM nomina_valle WHERE hacienda='$filtro' and `delete`=0 ";
$lugar = mysql_query($query_lugar, $conexion) or die(mysql_error());
$rs_fijos=mysql_query("SELECT * FROM nomina_fijos_valle WHERE hacienda='$filtro'",$conexion);
$row_rs_fijos=mysql_fetch_assoc($rs_fijos);
$hora_extra_f=$row_rs_fijos['hora_extra_f'];
$hora_extra_t=$row_rs_fijos['hora_extra_t'];
$hora_extra=$row_rs_fijos['hora_extra'];
$dia_fest=$row_rs_fijos['festivo'];


$totalRows_lugar = mysql_num_rows($lugar);
$hoy= date("Y/m/d"); 
list($ano, $mes, $dia) = explode("/", $hoy);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

<link rel="stylesheet" href="../css/clean.css"/>
<link rel="stylesheet" href="../css/style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="98%" border="1" cellspacing="0" cellpadding="0"  style="font-size:12px">
  <tr align="center" class="tittle" >
    <td colspan="11"  ><?php echo $filtro; ?></td>
    <td  >Fecha de Planilla</td>
    <td colspan="2"  ><?php echo $today; ?></td>
  </tr>
  <tr align="center" class="stittle">
    <td colspan="2"  style="" >Información Básica</td>
    <td colspan="3"  style="" >Básico</td>
    <td colspan="2"   style="">Deducciones</td>
    <td  style="" >&nbsp;</td>
    <td colspan="6"  style="" >Otros</td>
  </tr>
  <tr align="center" class="bold">
    <td  style="; border-right:none" >Nombre</td>
    <td  style="; border-left:none;" >Cédula</td>
    <td  style="; border-right:none" >Día</td>
    <td  style="; border-right:none; border-left:none" >Quincena</td>
    <td  style="; border-left:none" >Transporte</td>
    <td  style="; border-right:none" >Salud</td>
    <td  style="; border-left:none" >Pensión</td>
    <td  style="" >Total</td>
    <td  style="; border-right:none" >Extras</td>
    <td  style=";  border-right:none; border-left:none" >Bonificación</td>
    <td  style="; border-right:none; border-left:none" >Viajes</td>
    <td  style=";  border-right:none; border-left:none" >Prestamos</td>
    <td  style="; border-left:none " >Dcto-Días</td>
    <td  style="; font-size:16px">Total</td>
  </tr>
  <?php
  while($row_lugar = mysql_fetch_assoc($lugar)){
	  $lugar_tra=$row_lugar['lugar_trabajo'];
	  $query_ced = "SELECT * FROM nomina_liquidar WHERE lugar_trabajo='$lugar_tra' and estado='ok' and hacienda='$filtro' and `delete`=0";
	  $ced = mysql_query($query_ced, $conexion) or die(mysql_error());
	  
	  $result = mysql_query("SELECT SUM(quincena) as quincena, SUM(transporte) as transporte, SUM(salud) as salud, SUM(pension) as pension, SUM(total) as total, SUM(hs) as hs, SUM(hst) as hst, SUM(hsf) as hsf, SUM(total1) as total1, SUM(dia_festivo) as dia_festivo, SUM(total2) as total2, SUM(bonificacion) as bonificacion, SUM(viajes) as viajes, SUM(total4) as total4, SUM(total4) as total4, SUM(hst) as hst, SUM(hsf) as hsf, SUM(prestamos) as prestamos, SUM(mercado) as mercado, SUM(d_dcto) as d_dcto   FROM nomina_liquidar WHERE lugar_trabajo='$lugar_tra' and estado='ok' and hacienda='$filtro' and `delete`=0");   
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	  
  ?>
  <tr  style="text-align:left">
    <td colspan="14" height="25" style="font-weight:bold"><?php echo $row_lugar['lugar_trabajo'] ?></td>
  </tr>
  <?php 
  $tot_dias=0;
  	   while($row_ced = mysql_fetch_assoc($ced)){	
	   		$extras=$row_ced['hs']*$hora_extra+$row_ced['hst']*$hora_extra_t+$row_ced['hsf']*$hora_extra_f+$row_ced['dia_festivo']*$dia_fest;	
	  ?>
  <tr align="center" class="bold">
    <td><input name="id" type="hidden" value="<?php echo $row_ced['id_nomina'] ?>" id="<?php echo $row_ced['id_nomina'] ?>"/>
      
        <input type="hidden" name="fecha" id="fecha" value="<?php echo $today ?>"/>
        <input type="hidden" name="filtro" id="filtro" value="<?php echo $filtro ?>"/>
      <?php
	  $id=$row_ced['id_nomina'];
	  $rs_datos=mysql_query("SELECT * FROM nomina_valle WHERE id='$id' and `delete`=0",$conexion);
	  $row_rs_datos=mysql_fetch_assoc($rs_datos);
	  $nombre=$row_rs_datos['nombre'];
	  $cedula=$row_rs_datos['cedula'];
	  ?>
    <?php echo $nombre ?></td>
    <td><?php echo $cedula ?></td>
    <td><?php echo @number_format($row_ced['dia']) ?></td>
    <td><?php echo @number_format($row_ced['quincena']) ?></td>
    <td><?php echo @number_format($row_ced['transporte']) ?></td>
    <td><?php echo @number_format($row_ced['salud']) ?></td>
    <td><?php echo @number_format($row_ced['pension']) ?></td>
    <td style="font-weight:bold"><?php echo @number_format($row_ced['total']) ?></td>
    <td><?php echo @number_format($extras) ?></td>
    <td><?php echo @number_format($row_ced['bonificacion']) ?></td>
    <td><?php echo @number_format($row_ced['viajes']) ?></td>
    <td><?php echo @number_format($row_ced['prestamos']) ?></td>
    <td><?php echo @number_format($row_ced['d_dcto']*$row_ced['dia']) ?></td>
    <td style="font-weight:bold"><?php   echo @number_format($row_ced['total4']);  ?></td>
  </tr>
 
  <?php
  $tot_dias+=$row_ced['d_dcto']*$row_ced['dia'];
  $g_tot_dias+=$row_ced['d_dcto']*$row_ced['dia'];
  }
  ?>
  <?php
  //sumar
	
  ?>
   <tr align="center" class="bold" style="font-size:14px">
    <td colspan="3">Subtotal</td>
    <td><?php echo number_format($row['quincena']) ?></td>
    <td><?php echo number_format($row['transporte']) ?></td>
    <td><?php echo number_format($row['salud']) ?></td>
    <td><?php echo number_format($row['pension']) ?></td>
    <td><?php echo number_format($row['total']) ?></td>
    <?php
	$tot_extras=$row['hs']*$hora_extra+$row['hst']*$hora_extra_t+$row['hsf']*$hora_extra_f+$row['dia_festivo']*$dia_fest;
	?>
    <td><?php echo number_format($tot_extras) ?></td>
    <td><?php echo number_format($row['bonificacion']) ?></td>
    <td><?php echo number_format($row['viajes']) ?></td>
    <td><?php echo number_format($row['prestamos']) ?></td>
    <td><?php echo number_format($tot_dias) ?></td>
    <td><?php echo number_format($row['total4']) ?></td>
  </tr>
   
  <?php
  }
   $result = mysql_query("SELECT SUM(quincena) as quincena, SUM(transporte) as transporte, SUM(salud) as salud, SUM(pension) as pension, SUM(total) as total, SUM(hs) as hs, SUM(hst) as hst, SUM(hsf) as hsf, SUM(total1) as total1, SUM(dia_festivo) as dia_festivo, SUM(total2) as total2, SUM(bonificacion) as bonificacion, SUM(viajes) as viajes, SUM(total4) as total4, SUM(total4) as total4, SUM(hst) as hst, SUM(hsf) as hsf, SUM(prestamos) as prestamos, SUM(mercado) as mercado, SUM(d_dcto) as d_dcto   FROM nomina_liquidar WHERE  estado='ok' and hacienda='$filtro' and `delete`=0");   
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$tot_extras=$row['hs']*$hora_extra+$row['hst']*$hora_extra_t+$row['hsf']*$hora_extra_f+$row['dia_festivo']*$dia_fest;
  ?>
 <tr class="tittle" align="center" style="font-size:14px">
     <td colspan="3">TOTAL</td>
     <td><?php echo number_format($row['quincena']) ?></td>
    <td><?php echo number_format($row['transporte']) ?></td>
    <td><?php echo number_format($row['salud']) ?></td>
    <td><?php echo number_format($row['pension']) ?></td>
    <td><?php echo number_format($row['total']) ?></td>
    <td><?php echo number_format($tot_extras) ?></td>
    <td><?php echo number_format($row['bonificacion']) ?></td>
    <td><?php echo number_format($row['viajes']) ?></td>
    <td><?php echo number_format($row['prestamos']) ?></td>
    <td><?php echo number_format($g_tot_dias) ?></td>
    <td><?php echo number_format($row['total4']) ?></td>
   </tr>
</table>
<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><img src="../img/save.png"  title="Guardar Planilla" style="cursor:pointer" onclick="guardar2()" /></td>
  </tr>
</table>
<p>&nbsp;</p>
<div id="dialog"></div>
<span style=""></span>
<div id="dialog2" >
<select name="fecha1" id="fecha1" style="display:inline; width:90px" >
  <option value="ano" selected="selected">Año</option>
            <?php for($i=$ano+1;$i>=2010;$i--){ ?>
              <option value="<?php echo $i; ?>" ><?php echo $i ?></option>
              <?php } ?>
            </select>
</select>
<select name="fecha2" id="fecha2" disabled="disabled" style="width:130px" >
  <option value="mes" selected="selected">Mes</option>
  <option value="Enero" >Enero</option>
  <option value="Febrero">Febrero</option>
  <option value="Marzo">Marzo</option>
  <option value="Abri">Abril</option>
  <option value="Mayo">Mayo</option>
  <option value="Junio">Junio</option>
  <option value="Julio">Julio</option>
  <option value="Agosto">Agosto</option>
  <option value="Septiembre">Septiembre</option>
  <option value="Octubre">Octubre</option>
  <option value="Noviembre">Noviembre</option>
  <option value="Diciembre">Diciembre</option>  
</select>
<select name="fecha3" id="fecha3" disabled="disabled" style="width:110px" >
  <option value="quincena" selected="selected">Quincena</option>
  <option value="1" >1</option>
  <option value="2">2</option>
    
</select></div>



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
function guardar2(){
	$("span.ui-dialog-title").text('Quincena que Desea Liquidar');
	$( "#dialog2" ).dialog( "open" );
	$('#enviar').hide("slow");
	$("#dialog2").append('<img id="imagen" src="../img/good.png" width="38" height="26" style="display:none; cursor: pointer" onclick="guardar()" title="Click Aquí Para Enviar"/>')
}


$('#fecha3').change(function(){ 
	var fecha3= $('#fecha3').val();
	if(fecha3!="quincena"){
		$('#imagen').show()
	} else {
		$('#imagen').hide()
		}
})
$('#fecha1').change(function(){ 
	var fecha1= $('#fecha1').val();
	if(fecha1!="ano"){
		document.getElementById("fecha2").disabled="";
	} else {
		document.getElementById("fecha2").disabled="disabled";
		document.getElementById("fecha3").disabled="disabled";
		document.getElementById("fecha2").value="mes";
		document.getElementById("fecha3").value="quincena";
	}
})
$('#fecha2').change(function(){ 
	var fecha2= $('#fecha2').val();
	if(fecha2!="mes"){
		document.getElementById("fecha3").disabled="";
	} else {
		document.getElementById("fecha3").disabled="disabled";
		document.getElementById("fecha3").value="quincena";
	}
})

function guardar(){
	$('#imagen').hide();
	var filtro=$('#filtro').val()
	var size = document.getElementsByName("id").length;
	
	var fecha1= $('#fecha1').val();
	var fecha2= $('#fecha2').val();
	var fecha3= $('#fecha3').val();
	var fecha= fecha1 + '-' + fecha2 + '-' + fecha3;
	var id=[];
	for(x=0;x<size;x++){
		id[x]=document.getElementsByName("id").item(x).id		
	}
	$.ajax({
        type: "GET",
        url: "stin_nomina_guardar.php",
        data: "planilla="+id+"&fecha="+fecha+"&filtro="+filtro,
        success: function(html){
       		mostrar(html)
      }
});
}
function mostrar(html){
	$( "#dialog" ).dialog("open");
	$("#dialog").html(html);
	$("span.ui-dialog-title").text("Información de Planilla"); 		
	$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="53" height="41"/>')	;	
	   setTimeout(function () {	
	   		window.opener.recarga_tabla();	   
			window.close();		 
		   $("#dialog").dialog("close");
		}, 3000);	   
}
var dialogwidth=450
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 120,
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'}, 
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false,  	     
    });
})

$(function() {
    $( "#dialog2" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 120,
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},
	  toolbar: false,  	     
    });
})
</script>
</html>

