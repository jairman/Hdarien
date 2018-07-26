<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>
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
$query_nm = "SELECT * FROM d89xz_empleados";
$nm = mysql_query($query_nm, $conexion) or die(mysql_error());
$row_nm = mysql_fetch_assoc($nm);
$totalRows_nm = mysql_num_rows($nm);mysql_select_db($database_conexion, $conexion);
$query_nm = "SELECT * FROM d89xz_empleados";
$nm = mysql_query($query_nm, $conexion) or die(mysql_error());
$row_nm = mysql_fetch_assoc($nm);
$totalRows_nm = mysql_num_rows($nm);
$query_nm = "SELECT * FROM d89xz_empleados where esta !='no'";
$nm = mysql_query($query_nm, $conexion) or die(mysql_error());
$row_nm = mysql_fetch_assoc($nm);
$totalRows_nm = mysql_num_rows($nm);


//// aca



mysql_select_db($database_conexion, $conexion);
$query_em = "SELECT * FROM d89xz_empleados ";
$em = mysql_query($query_em, $conexion) or die(mysql_error());
$row_em = mysql_fetch_assoc($em);
$totalRows_em = mysql_num_rows($em);



mysql_select_db($database_conexion, $conexion);
$query_empl = "SELECT * FROM d89xz_empleados";
$empl = mysql_query($query_empl, $conexion) or die(mysql_error());
$row_empl = mysql_fetch_assoc($empl);
$totalRows_empl = mysql_num_rows($empl);

mysql_select_db($database_conexion, $conexion);
$query_met = "SELECT * FROM d89xz_metodo_pago";
$met = mysql_query($query_met, $conexion) or die(mysql_error());
$row_met = mysql_fetch_assoc($met);
$totalRows_met = mysql_num_rows($met);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/dia_dia.js" type="text/javascript"></script>

<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true,


});
// </script>
<script> 
/*function mano(a) { 
    if (navigator.appName=="Netscape") { 
        a.style.cursor='pointer'; 
    } else { 
        a.style.cursor='hand'; 
    } 
}*/ 
function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#C0C0C0';
}
 
// RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
function RestablecerFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#FFFFFF';
}
 
// CONVERTIR LAS FILAS EN LINKS
/*function CrearEnlace(url) {

Shadowbox.open({
content: url,
player: "iframe",
options: {  modal: true	
}})
}*/
</script>

<!-- aca -->
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>



 <style> 
a{text-decoration:none} 
</style>




<style type="text/css">
.x {
	color: #FFF;
}
#v {
	color: #000;
}
.n {
	color: #000;
}
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>

 <DIV ID="seleccion">
<table width="98%" border="1" align="center">
   <tr>
     <td width="91%">&nbsp;</td>
     <td width="9%" align="center"><img src="../../img/money.png" width="48" height="48" onclick="embajada('')" style="cursor:pointer"  title="Pagar Nomina"/></td>
   </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
  <tr  class="tittle">
    <th colspan="8" ><p>Empleados  A Pagar</p></th>
  </tr>
  <tr class="tittle" >
    <th width="129" >Cedula</th>
    <th width="223" >Nombre</th>
    <th width="224" >Apellido</th>
    <th width="131" >Funcion</th>
    <th width="114" >Salario</th>
    <th width="126" >Hacienda</th>
    <th width="67" >Pago</th>
    
  </tr>
  <?php do { ?>
   <tr align="center"  class="row" >
    
      <th><?php echo $row_nm['cedula']; ?></th>
      <td><?php echo $row_nm['nombre']; ?></td>
      <td><?php echo $row_nm['apellido']; ?></td>
      <td><?php echo $row_nm['funcion']; ?></td>
      <td><?php echo number_format ($row_nm['sueldo']); ?></td>
      <td><?php echo $row_nm['hacienda']; ?></td>
      
       
   <?php 
  if($row_nm['pago']=='Pago'){
	  
	  echo " <td bgcolor='#00CC00' title='Realizar Pago'> <a  href=\"generar_factu_logistica_eliminar.php?id=$row_nm[id]\" >  $row_nm[pago] </a></td>";
	 	}else{
		  				
			
		echo " <td title='Realizar Pago' ><a  href=\"generar_factu_logistica_agregar.php?id=$row_nm[id]\"  >  $row_nm[pago] </a></td>";
		}

?>
      
      
      
    </tr>
    <?php } while ($row_nm = mysql_fetch_assoc($nm)); ?>
</table>

<div id="dialog" ></div>
<div id="dialog3" title="Abono Factura">
<form action="" id="formulario" method="post">
<table align="center" width="90%">
<tr>
	<th align="right" class="bold" width="20%">Fecha</th>
	<td colspan="2" align="right" class="bold"><input  name="tf_fecha3" type="text" id="tf_fecha3" style="width:95%"  value="<?= date('Y-m-d') ?>" class="long" /></td>
    </tr>
<tr>
  <td colspan="2" align="center">
    <img id="theImg" src="../../img/good.png" width="48" height="48" 
    style="cursor:pointer" onclick="emba();return false" title="Aceptar"/>
    </td>
  <td width="51%" align="center">
    <img src="../../img/erase.png" width="48" height="48" 
    style="cursor:pointer" onclick="cerrar_dialogo3()" title="Pago en Tarjeta" />
    
    </td>
</tr>
</table>
</form>
</div>



</body>
</html>
<?php
mysql_free_result($nm);




mysql_free_result($em);



mysql_free_result($empl);

mysql_free_result($met);


?>
</DIV> 

<script language="Javascript">

// JavaScript Document
$(document).ready(function(){
		<!-- necesario para los cuadros de dialogo-->
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});
	
	//totcosto()


	//configurando el datepicker para las fechas
	$.datepicker.setDefaults({ 
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero de', 'Febrero de', 'Marzo de', 'Abril de', 'Mayo de', 'Junio de', 
					  'Julio de', 'Agosto de', 'Septiembre de', 'Octubre de', 
					  'Noviembre de', 'Diciembre de'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});
	
	//hace que los campos desplieguen un datepicker
	
	$( "#tf_fecha3").datepicker();
	


	
});



function embajada(){	
	//overlay.hide()
	$("span.ui-dialog-title").text('Fecha de Pago').css("text-align", "center");
	$("#dialog3").dialog("open");
} 



function cerrar_dialogo(){	
	overlay.hide()
	$("#dialog").dialog("close");
}
function cerrar_dialogo2(){	
	//overlay.hide()
	$("#dialog2").dialog("close");
}
function cerrar_dialogo3(){	
	//overlay.hide()
	$("#dialog3").dialog("close");
}
//funcion para inicializar el cuadro de dialogo
var dialogwidth=400
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})
//funcion para inicializar el cuadro de dialogo
var dialogwidth=600
$(function() {
    $( "#dialog2" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  //position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { /*overlay.hide()*/ }, 	     
    });
})
var dialogwidth=400
$(function() {
    $( "#dialog3" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  //position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { /*overlay.hide()*/ }, 	     
    });
})
function agre(){
	var url = 'mostrar_nomina_agre.php';
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}
function emba(){
		console.log('embajada')
		var tf_fecha =  $('#tf_fecha3').val();	
		console.log(tf_fecha)	
		
		$("#dialog3").dialog("close");	
		
		$.ajax({
			type: "post",
			url: "mostrar_nomina_agre_c.php",
			data:"tf_fecha="+tf_fecha,	
			success: function(datos){ 
						// console.log(datos)
				$("#dialog").html("&nbsp;&nbsp;Registro Exitoso");
				$("span.ui-dialog-title").text('Información Importante');
				$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
				$("#dialog").dialog("open");
								
					setTimeout(function () {
					
						$("#dialog").dialog("close");
						 parent.location.reload();
						//$('#tabla').load('dia_dia_pendiente.php'  + ' #tabla ' )  
					}, 2000); 
					
				}
		})
}
</script>