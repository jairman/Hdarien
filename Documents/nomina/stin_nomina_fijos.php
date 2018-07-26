<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if($acceso==0){
	?>
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
$filtro=$_GET['filtro'];
mysql_select_db($database_conexion, $conexion);
$query_fijos = "SELECT * FROM nomina_fijos_valle WHERE hacienda='$filtro'";
$fijos = mysql_query($query_fijos, $conexion) or die(mysql_error());
$row_fijos = mysql_fetch_assoc($fijos);
$totalRows_fijos = mysql_num_rows($fijos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="../css/clean.css" />
<link rel="stylesheet" href="../css/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p>&nbsp;</p>
<table width="80%" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
  <tr >
    <th align="right">
      <input type="image" src="../img/edit.png" id="editar" title="Editar Valore Fijos" width="40" height="40"/>
    </th>
  </tr>
  </table>
  <table width="80%" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
  <tr >
    <th colspan="4" class="tittle"><strong style="color: #FFF">VALORES FIJOS
      <input type="hidden" id="filtro" value="<?php echo $filtro ?>" />
    </strong></th>
  </tr>
  <tr class="bold">
    <td><strong>Incremento    salarial (%)</strong></td>
    <td ><input name="incremento" type="text" id="incremento" readonly="readonly" value="<?php echo $row_fijos['incremento'] ?>" style="width:60%"/></td>
    <td ><strong>Salario Mínimo Mes 2013</strong></td>
    <td ><input name="minimo" type="text" id="minimo" readonly="readonly" value="<?php echo @number_format($row_fijos['minimo']) ?>" alt="<?php echo $row_fijos['minimo'] ?>" onkeyup="dividir()" style="width:60%"/></td>
  </tr>
  <tr class="bold">
    <td><strong>Días del Mes</strong></td>
    <td ><input name="dias_mes" type="text" id="dias_mes" readonly="readonly" value="<?php echo $row_fijos['dias_mes'] ?>" onkeyup="dividir()" style="width:60%"/></td>
    <td ><strong>Horas Semanales</strong></td>
    <td ><input name="horas_semana" type="text" id="horas_semana" readonly="readonly" value="<?php echo $row_fijos['horas_semana'] ?>" style="width:60%"/></td>
  </tr>
  <tr class="bold">
  <?php error_reporting(E_ERROR | E_PARSE); ?>
    <td><strong>Diario Mes</strong></td>
    <td ><input name="diario_mes" type="text" id="diario_mes" readonly="readonly" value="<?php echo @number_format(@$row_fijos['minimo']/ @$row_fijos['dias_mes']) ?>" alt="<?php echo @$row_fijos['minimo']/ @$row_fijos['dias_mes'] ?>" style="width:60%"/></td>
    <td ><strong>Horas Diarias</strong></td>
    <td ><input name="horas_dia" type="text" id="horas_dia" readonly="readonly" value="<?php echo $row_fijos['horas_dia'] ?>" onkeyup="dividir()" style="width:60%"/></td>
  </tr>
  <tr class="bold">
    <td><strong>Precio Hora Diaria</strong></td>
    <td ><input name="precio_dia" type="text" id="precio_dia" readonly="readonly" value="<?php echo @number_format(($row_fijos['minimo']/ $row_fijos['dias_mes'])/$row_fijos['horas_dia'],2 )?>" alt="<?php echo @($row_fijos['minimo']/ $row_fijos['dias_mes'])/$row_fijos['horas_dia']?>" style="width:60%"/></td>
    <td ><strong>Auxilio Transporte por Mes</strong></td>
    <td ><input name="transporte" type="text" id="transporte" readonly="readonly" value="<?php echo @number_format($row_fijos['transporte']) ?>" alt="<?php echo $row_fijos['transporte'] ?>" style="width:60%"/></td>
  </tr>
  <tr class="bold">
    <td><strong>Salud (Quincena)</strong></td>
    <td ><input name="salud" type="text" id="salud" readonly="readonly" value="<?php echo @number_format($row_fijos['salud']) ?>" alt="<?php echo $row_fijos['salud'] ?>" style="width:60%"/></td>
    <td ><strong>Pensión (Quincena)</strong></td>
    <td ><input name="pension" type="text" id="pension" readonly="readonly" value="<?php echo @number_format($row_fijos['pension']) ?>" alt="<?php echo $row_fijos['pension'] ?>" style="width:60%"/></td>
  </tr>
  <tr class="bold">
    <td><strong>Hora Extra Festiva</strong></td>
    <td ><input name="hora_extra_f" type="text" id="hora_extra_f" readonly="readonly" value="<?php echo @number_format($row_fijos['hora_extra_f']) ?>" alt="<?php echo $row_fijos['hora_extra_f'] ?>" style="width:60%"/></td>
    <td ><strong>Hora Domingo</strong></td>
    <td ><input name="hora_extra_t" type="text" id="hora_extra_t" readonly="readonly" value="<?php echo @number_format($row_fijos['hora_extra_t']) ?>" alt="<?php echo $row_fijos['hora_extra_t'] ?>" style="width:60%"/></td>
  </tr>
  <tr class="bold">
    <td><strong>Hora Extra Ordinaria</strong></td>
    <td ><input name="hora_extra" type="text" id="hora_extra" readonly="readonly" value="<?php echo @number_format($row_fijos['hora_extra']) ?>" alt="<?php echo $row_fijos['hora_extra'] ?>" style="width:60%"/></td>
    <td ><strong>Día Festivo</strong></td>
    <td ><input name="festivo" type="text" id="festivo" readonly="readonly" value="<?php echo @number_format($row_fijos['festivo']) ?>" alt="<?php echo $row_fijos['festivo'] ?>" style="width:60%"/></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="guardar" id="guardar" value="Aceptar"  style="display:none" class="ext"/>
    </td>
  </tr>
  
</table>

<table id="nota" style="display:none" width="300px" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
<tr>
    <td   align="center"><strong>Nota</strong>: No escriba puntos ni comas en los valores.</td>
  </tr>
</table>
<div id="dialog" ></div>
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
</html>
<script>
$('#guardar').click(function(){
	var filtro=$('#filtro').val();
	var incremento=$('#incremento').val();
	var minimo=$('#minimo').val();
	var dias_mes=$('#dias_mes').val();	
	var horas_semana=$('#horas_semana').val();
	var horas_dia=$('#horas_dia').val();
	var transporte=$('#transporte').val();
	var salud=$('#salud').val();
	var pension=$('#pension').val();
	var hora_extra_f=$('#hora_extra_f').val();
	var hora_extra_t=$('#hora_extra_t').val();
	var hora_extra=$('#hora_extra').val();
	var festivo=$('#festivo').val();
	$.ajax({
        type: "GET",
        url: "stin_nomina_guardar.php",
        data: "editar3="+incremento+"&minimo="+minimo+ '&dias_mes=' + dias_mes + '&horas_semana=' + horas_semana + '&horas_dia=' + horas_dia + '&transporte=' + transporte + '&salud=' + salud + '&pension=' + pension + '&hora_extra=' + hora_extra  + '&festivo=' + festivo + '&hora_extra_f=' + hora_extra_f + '&hora_extra_t=' + hora_extra_t + '&filtro=' + filtro,
        success: function(html){
       		mostrar(html, "reg", "fin")
      }
});
})

function mostrar(html, tipo, datos){
	$("#dialog").html(html);
	$("span.ui-dialog-title").text('Información de Actualización'); 
	if(tipo=="error"){
	$("#dialog").prepend('<img id="theImg" src="../img/warning.png" width="53" height="41"/>')
	} else {
	$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="53" height="41"/>')
	}
    $( "#dialog" ).dialog( "open" );
	   setTimeout(function () {
		   if(datos=="fin" && html!="El Empleado Ya Existe"){		   		
				$('#guardar').hide();
				$('#editar').show("slow");	
				window.parent.Shadowbox.close();			
	 		}
			
	   }, 2000)
}
function dividir(){
	var minimo=$('#minimo').val();
	var dias_mes=$('#dias_mes').val();	
	var horas_dia=$('#horas_dia').val();	
	var total=minimo/dias_mes;
	var total2=total/horas_dia;
	$('#diario_mes').val(total)
	$('#precio_dia').val(total2)	
}
$('#editar').click(function(){
	$("span.ui-dialog-title").text('Modo Edición'); 
	$("#dialog").html("Ahora Está en Modo Edición");
	$("#dialog").prepend('<img id="theImg" src="../img/warning.png" width="53" height="41"/>')
	$('#editar').hide();
	$( "#dialog" ).dialog( "open" );
	 setTimeout(function () {
		$('#guardar').show("slow");
		$('#nota').show("slow");
				
		$("#dialog").dialog("close");
	 },2000)
	 $('#incremento').removeAttr("readonly");
	$('#minimo').removeAttr("readonly");
	$('#dias_mes').removeAttr("readonly");
	$('#horas_semana').removeAttr("readonly");
	$('#horas_dia').removeAttr("readonly");
	$('#transporte').removeAttr("readonly");
	$('#salud').removeAttr("readonly");
	$('#hora_extra_f').removeAttr("readonly");
	$('#hora_extra_t').removeAttr("readonly");
	$('#hora_extra').removeAttr("readonly");
	$('#festivo').removeAttr("readonly");
	$('#pension').removeAttr("readonly");
	
	document.getElementById("transporte").value=document.getElementById("transporte").alt
	document.getElementById("precio_dia").value=document.getElementById("precio_dia").alt
	document.getElementById("diario_mes").value=document.getElementById("diario_mes").alt
	document.getElementById("minimo").value=document.getElementById("minimo").alt
	document.getElementById("salud").value=document.getElementById("salud").alt
	document.getElementById("pension").value=document.getElementById("pension").alt
	document.getElementById("hora_extra").value=document.getElementById("hora_extra").alt
	document.getElementById("hora_extra_f").value=document.getElementById("hora_extra_f").alt
	document.getElementById("hora_extra_t").value=document.getElementById("hora_extra_t").alt
	document.getElementById("festivo").value=document.getElementById("festivo").alt
})
$(function() {
	var dialogwidth=400
    $( "#dialog" ).dialog({
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