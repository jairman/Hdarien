<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php') ?>
<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>
<?php
}else{
	
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


$config = mysql_query("SELECT * FROM `h01sg_compras_config` WHERE `delete`<>1") 
or die(mysql_error());
$row_conf = @mysql_fetch_assoc($config);

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Configuración Entrada de Compras</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>

</head>

<body>
<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">


<div id="dialog"></div>
<?php 
if ($usuario2 == 'general'){
?>
<table width="80%" align="center">
	<tr>
    <td align="left">
    <img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
    </td>
    </tr>
</table>
<div id="main">
&nbsp;
<table width="80%" align="center">
	<tr class="tittle">
    <td align="center" colspan="4">Configuración Campos de Compras</td>
    </tr>
    <tr>
    <td colspan="4"><label class="sub">* Elija los campos que desea que tenga adicionales el registro de sus productos</label></td>
    </tr>
    <tr class="bold">
    <td width="25%">Cod. de Barras &nbsp;
    <input type="checkbox" name="radio" value="cod_barra" id="cb_codb" <?php echo ($row_conf['cod_barra']==1 ? 'checked' : '');?> ></td>
    <td width="25%">RFID &nbsp;
    <input type="checkbox" name="radio" value="rfid" id="cb_rfid" <?php echo ($row_conf['rfid']==1 ? 'checked' : '');?> ></td>
    <td width="25%">Marca &nbsp;
    <input type="checkbox" name="radio" value="marca" id="cb_marca" <?php echo ($row_conf['marca']==1 ? 'checked' : '');?> ></td>
    <td width="25%">Talla &nbsp;
    <input type="checkbox" name="radio" value="talla" id="cb_talla" <?php echo ($row_conf['talla']==1 ? 'checked' : '');?> ></td>
    </tr>
    <tr class="bold">
    
    <td>Color &nbsp;
    <input type="checkbox" name="radio" value="color" id="cb_color" <?php echo ($row_conf['color']==1 ? 'checked' : '');?> ></td>
    <td>Categoria &nbsp;
    <input type="checkbox" name="radio" value="categoria" id="cb_cat" <?php echo ($row_conf['categoria']==1 ? 'checked' : '');?> ></td>
    <td>Sub-categoia &nbsp;
    <input type="checkbox" name="radio" value="sub_cat" id="cb_cat" <?php echo ($row_conf['sub_cat']==1 ? 'checked' : '');?> ></td>
    <td>Precio Mayorista &nbsp;
      <input type="checkbox" name="radio" value="precio_mayo" id="cb_prem" <?php echo ($row_conf['precio_mayo']==1 ? 'checked' : '');?> ></td>
    </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
    <td align="center" colspan="4">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext" onClick="save()">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar"  onclick="window.parent.Shadowbox.close()">
    </td>
    </tr>
</table>
&nbsp;
</div>
<?php 
}else{
?>
<table width="80%" align="center">
	<tr>
    <td align="left">
    <img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
    </td>
    </tr>
</table>
<div id="main">
&nbsp;
<table width="80%" align="center">
	<tr class="tittle">
    <td colspan="4">Configuración Campos de Compras</td>
    </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
    <td align="left" colspan="4"><label class="red">* Solo Super-Usuarios pueden cambiar esta configuración</label></td>
    </tr>
    <tr class="bold">
    <td width="25%">Cod. de Barras &nbsp;
    <input type="checkbox" name="radio" value="cod_barra" id="cb_codb" <?php echo ($row_conf['cod_barra']==1 ? 'checked' : '');?> disabled ></td>
    <td width="25%">RFID &nbsp;
    <input type="checkbox" name="radio" value="rfid" id="cb_rfid" <?php echo ($row_conf['rfid']==1 ? 'checked' : '');?> disabled></td>
    <td width="25%">Marca &nbsp;
    <input type="checkbox" name="radio" value="marca" id="cb_marca" <?php echo ($row_conf['marca']==1 ? 'checked' : '');?> disabled></td>
    <td width="25%">Talla &nbsp;
    <input type="checkbox" name="radio" value="talla" id="cb_talla" <?php echo ($row_conf['talla']==1 ? 'checked' : '');?> disabled></td>
    </tr>
    <tr class="bold">
    
    <td>Color &nbsp;
    <input type="checkbox" name="radio" value="color" id="cb_color" <?php echo ($row_conf['color']==1 ? 'checked' : '');?> disabled></td>
    <td>Categoria &nbsp;
    <input type="checkbox" name="radio" value="categoria" id="cb_cat" <?php echo ($row_conf['categoria']==1 ? 'checked' : '');?> disabled></td>
    <td>Sub-categoia &nbsp;
    <input type="checkbox" name="radio" value="sub_cat" id="cb_cat" <?php echo ($row_conf['sub_cat']==1 ? 'checked' : '');?> disabled></td>
    <td>Precio Mayorista &nbsp;
      <input type="checkbox" name="radio" value="precio_mayo" id="cb_prem" <?php echo ($row_conf['precio_mayo']==1 ? 'checked' : '');?> disabled></td>
    </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
    <td align="center" colspan="4">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar"  onclick="window.parent.Shadowbox.close()">
    </td>
    </tr>
    </tr>
</table>
&nbsp;
</div>
<?php 
}
?>
</body>
<script>

$(document).ajaxStop(function(){
    // Executed when all ajax requests are done.
	console.log('d:'+fconfig)
	//console.log('-----Finish------')
	
	
	if (fconfig == true){
		 //console.log('eureka');	
		 setTimeout(function () {
		   window.parent.Shadowbox.close()
		   console.log('10000ms');
		}, 1000);
	}
});

var fconfig = false;

$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
    
});

function save(){
	overlay.show()
	$("#dialog").html('&nbsp;Guardar Configuración? <br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="reg();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function reg(){
	var arr = new Array()
	if(($('[name="radio"]').filter(':checked').length)>0){
		$('[name="radio"]').filter(':checked').each(function() {
			var checkbox = $(this).val();
			var id=this.id;
			arr.push(checkbox);	
		});
	}
	console.log(arr);
	var l = arr.length;
	var user2 = $('#tf_user2').val();
	
	if (l==0){
		arr[0]=0;
		l=1;	
	}
	
	
	console.log({campos: arr, tam_env:l, user:user2});
	
	$.ajax({
		type: "POST",		
		url: "../compras_config/compras_connect.php",
		//dataType: "json",
		data: {campos: arr, tam_env:l, user:user2},
		success: function(datos){ 
			console.log(datos);
			
		},		
	}).done(fconfig = true);	
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
	  //position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})

function cerrar_dialogo(){	
	overlay.hide()
	$("#dialog").dialog("close");
}

</script>
</html>
<?php
}
?>