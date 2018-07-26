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

date_default_timezone_set('America/Bogota');
$c_date = date('Y-m-d');

mysql_select_db($database_conexion, $conexion);
$drio1 = mysql_query("SELECT * FROM `h01sg_inventario_detalle` 
WHERE `delete`<>1 AND `mov`='t' ORDER BY `consec` DESC" , $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);			
$factura1= $row_drio1['consec'];
if($factura1!=''){
	$factura2=$factura1;
	
}else{
	$factura2=0;	
}
$factura=$factura2 + 1;

$i = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Movimientos de Inventarios</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>
</head>

<body>

<div id="dialog"></div>

<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_i" value="<?php echo $i?>">
<input type="hidden" id="tf_consecf" >
<input type="hidden" id="tf_exist" >

<form id="form1" name="form1">
<table width="98%" align="center" id="table_header">
    <tr>
      <td align="left" >
      <img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
    </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
  <tr class="tittle">
    <td colspan="4">Movimientos de Inventario</td>
  </tr>
  <tr>
    <td class="bold" width="15%">Consecutivo</td>
    <td width="35%" align="center" class="cont">
    <label class="red" id="lb_consec"><?php echo $factura?></label>
    </td>
    <td class="bold" width="15%">Fecha</td>
    <td width="35%" align="center" class="cont"><label id="lb_fecha"><?php echo $c_date?></label></td>
  </tr>
  <tr>
    <td class="bold">Tipo Movimiento</td>
    <td class="cont">
    <select name="sl_tipo" id="sl_tipo" class="long">
        <option value="">Seleccione</option>
        <option value="Devolucion">Devolución</option>
        <option value="Inventario Inicial">Traslado</option>
        <option value="Traslado">Traslado entre Tiendas</option>
    </select>
    </td>
    <td class="bold" width="15%">Origen</td>
    <td class="cont" width="35%">
	<?php
    if ($usuario2 == 'general'){
    ?>
        <select name="sl_ptov" id="sl_ptov" class="long">
	    <option value="">Seleccione</option>
    <?php
		mysql_select_db($database_conexion, $conexion);
		$query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
		`d89xz_hacienda` WHERE `delete`=0 order by hacienda";
		$hac = mysql_query($query_hac, $conexion) or die(mysql_error());
		while ($row_hac = mysql_fetch_assoc($hac)){
    ?>
    	<option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
    <?php
    } 
    ?>
    	</select>
    <?php 
    }else{
    ?>
    	<input type="text" readonly id="tf_ptov" class="long" value="Bodega">
    <?php
    }
    ?>
    </td>
  </tr>
  <tr>
  	<td class="bold">Destino</td>
    <td class="cont">
        <select name="sl_ptovd" id="sl_ptovd" class="long">
	    <option value="">Seleccione</option>
    <?php
		mysql_select_db($database_conexion, $conexion);
		$query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
		`d89xz_hacienda` WHERE `delete`=0 order by hacienda";
		$hac = mysql_query($query_hac, $conexion) or die(mysql_error());
		while ($row_hac = mysql_fetch_assoc($hac)){
    ?>
    	<option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
    <?php
    } 
    ?>
    	</select>
    </td>
    <td class="bold" >Observaciones</td>
    <td class="cont">
    <input name="tf_obs" type="text" id="tf_obs" style="width:85%" >&nbsp;
    <img src="../img/add.png" alt="" width="25" height="25" border="0" align="right" 
    title="Agregrar Detalle" style="cursor:pointer" id="bt_add" />
    </td>
  </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0" id="tb_detail">
  <tr class="stittle" id="tittle">
    <!--<td width="15%">Cod. Barras</td>-->
    <td width="20%">Referencia</td>
    <td width="17%">Marca</td>
    <td width="38%">Descripcion</td>
    <td width="15%">Cantidad</td>
    <td width="10%">&nbsp;</td>
  </tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
	<td align="center">
    <input name="bt_ok" type="submit" id="bt_ok" value="Aceptar" class="ext">
    &nbsp;
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.close()">
    </td>
</table>

</form>

</body>
<script>
$(document).ready(function() {
	
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			//return false;
		}
	});
	
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	$("#form1").validate({
		rules: {
			sl_tipo: { required: true },
			sl_ptov: { required: true },
			sl_ptovd: { required: true },
		},
		messages: {
			sl_tipo: "<br>* Por favor seleccione una opción",
			sl_ptov: "<br>* Por favor seleccione una opción",
			sl_ptovd: "<br>* Por favor seleccione una opción",
		},
	   submitHandler: function(form) {
			var value = $('#form1').valid();
			//console.log(value);
			if (value) {
				cuadro();
			} else {
				//console.log("form isnt valid");	
			}	
	   }
	});
	
	$('#bt_add').hide();
	
	var user = $('#tf_user').val();
	if ( user != 'general'){
		$('#bt_add').show();
	}
	
	$('#sl_ptov').bind('change', function (){
		var origen = $('#sl_ptov').val();
		if (origen != ''){
			$('#bt_add').show();
		}else{
			$('#bt_add').hide();
		}	
	});
	
	$('#sl_tipo').bind('change', function(){
		var tipo = $(this).val();
		if (tipo == ''){
			$('#sl_ptov').removeAttr('disabled');
			$('#sl_ptov').val('');
			var origen = $('#sl_ptov').val();
			if (origen != ''){
				$('#bt_add').show();
			}else{
				$('#bt_add').hide();
			}	
		}
		if (tipo == 'Devolucion'){
			$('#sl_ptov').removeAttr('disabled');
			$('#sl_ptov').val('');
			var origen = $('#sl_ptov').val();
			if (origen != ''){
				$('#bt_add').show();
			}else{
				$('#bt_add').hide();
			}
		}
		if (tipo == 'Inventario Inicial'){
			$('#sl_ptov').val('Bodega');
			$('#sl_ptov').attr("disabled", "disabled");
			$('#bt_add').show();
			var origen = $('#sl_ptov').val();
			if (origen != ''){
				$('#bt_add').show();
			}else{
				$('#bt_add').hide();
			}
		}
		if (tipo == 'Traslado'){
			$('#sl_ptov').removeAttr('disabled');
			$('#sl_ptov').val('');
			var origen = $('#sl_ptov').val();
			if (origen != ''){
				$('#bt_add').show();
			}else{
				$('#bt_add').hide();
			}
		}
			
	});
	
	$('#bt_add').bind('click', function (){
		agregarFila();
	});
	
});

/*
<tr class="row" id="fila_'+i+'">
    <td class="cont"><input name="tf_codb'+i+'" type="text" id="tf_codb'+i+'" class="long"></td>
    <td class="cont"><input name="tf_ref'+i+'" type="text" id="tf_ref'+i+'" class="long">
	<img src="img/search.png" alt="Busqueda" name="bt_sproduct'+i+'" width="20" height="20" id="bt_sproduct'+i+'" style="cursor:pointer" title="Busqueda" onClick="searchp('+i+')" />
		</td>
    <td align="center"><label id="lb_marca'+i+'"></label></td>
    <td align="left"><label id="lb_desc'+i+'"></label></td>
    <td class="cont"><input name="tf_cant'+i+'" type="text" id="tf_cant'+i+'" style="width:45%"> 
	(max 
	<label id="lb_cant'+i+'" class="red" style="font-size:12px"></label>
	)</td>
    <td align="center">
    <img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;" >
    title="Eliminar"
    </td>
  </tr>
*/
//<td class="cont"><input name="tf_codb'+i+'" type="text" id="tf_codb'+i+'" class="long"></td>
function agregarFila(){
	var i = parseInt($('#tf_i').val());
	//console.log('i:'+i);
	$('#tb_detail tr:last').after('<tr class="row" id="fila_'+i+'"><td class="cont"><input name="tf_ref'+i+'" type="text" id="tf_ref'+i+'" style="width:80%" class="ref">&nbsp;<img src="../img/search.png" alt="Busqueda" name="bt_sproduct'+i+'" width="20" height="20" id="bt_sproduct'+i+'" style="cursor:pointer" title="Busqueda" onClick="searchp('+i+')" /></td><td align="center"><label id="lb_marca'+i+'"></label></td><td align="center"><label id="lb_desc'+i+'"></label></td><td class="cont" align="center"><input name="tf_cant'+i+'" type="text" id="tf_cant'+i+'" style="width:45%">(max <label id="lb_cant'+i+'" class="red" style="font-size:12px"></label> )</td><td align="center"><img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;"></td></tr>');
	//$('#tf_codb'+i).attr('onChange', 'prodsearch("'+i+'")');
	$('#tf_ref'+i).attr('onChange', 'checkref("'+i+'")');
	$('#tf_cant'+i).attr('onkeyup', 'compare("'+i+'")');
	$('#bt_img'+i).attr('onClick', 'quitar("'+i+'")');
	//$('#pso'+j).attr('onChange', 'checkValues();checkNum(this)');
	//$('#img'+j).attr('onClick', 'eliminarb("'+j+'")');
	/*$('#pso'+j).rules('add', {
		required: true,
		messages: {
			required: "Por Favor entre el peso"
		}
	});*/
	//$('#anml'+j).focus();
	i= i+1;
	//console.log('j:'+j);
	$('#tf_i').val(i);
}

function compare(i){
	//console.log('compare')
	//console.log('i: '+i);
	var cant = new Number($('#tf_cant'+i).val());
	var limit = new Number($('#lb_cant'+i).text());
	//console.log('c:'+cant+' l:'+limit);	
	if (cant > limit){
		$('#tf_cant'+i).val(limit);
	}	
}

function quitar(i){
	//console.log('quitar: '+i);
	$("#fila_"+i ).remove();
}

function prodsearch(i){
	var code = $('#tf_codb'+i).val();
	//console.log("getbarcod="+code);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../inventario/invent_connect.php",
		data:"getbarcod="+code,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_ref'+i).val(data[0].ref);
				$('#lb_marca'+i).text(data[0].marca);
				$('#lb_desc'+i).text(data[0].desc);	
				//$('#tf_codb'+i).attr('readonly', true);
				$('#tf_ref'+i).attr('readonly', true);
				$('#bt_sproduct'+i).hide();
				getMax(i, data[0].ref);
				agregarFila();
			}else{
				$('#tf_codb'+i).val('');
				$('#tf_codb'+i).focus();
			}
		}
	}); 
}

function checkref(i){
	//console.log('checkref');
	var ref = $('#tf_ref'+i).val();
	var exist = '';
	var c = 0;
	//console.log('nr:'+ref+' i:'+i);
	var $table = $('#tb_detail tr:not(#tittle)').closest('table');  		
	$table.find('.ref').each(function() {
		var refc = $(this).val();
		var id = $(this).attr('id');
		//console.log('id: '+id);	
		var n = id.substr(6);
		n = $.trim(n);
		//console.log('ci:'+c)
		//console.log('i: '+i+' n: '+n);
		//console.log('r:'+ref+' rc:'+refc)
		if (ref == refc){
			c++;	
		}
		//console.log('c:'+c)
		if ( c > 1 ){
			exist = true;	
		}else{
			exist = false;	
		}	
		
	});
	
	if (exist == true){
		$('#tf_ref'+i).val('');
		$('#tf_ref'+i).focus();
		$('#tf_exist').val(exist);
	}
	
	if (exist == false){
		searchref(i);
		$('#tf_exist').val(exist);
	}
}

function searchref(i){
	//console.log('i:'+i)
	var ref = $('#tf_ref'+i).val();
	//console.log("getref="+ref);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../inventario/invent_connect.php",
		data:"getref="+ref,				
		success:function(data){
			//console.log(data);
			if (data[0] ){
				//console.log('d: '+data[0].cod_barra);
				//$('#tf_codb'+i).val(data[0].cod_barra);
				$('#lb_marca'+i).text(data[0].marca);
				$('#lb_desc'+i).text(data[0].desc);	
				//$('#tf_codb'+i).attr("disabled", "disabled");
				$('#tf_ref'+i).attr('readonly', true);
				$('#bt_sproduct'+i).hide();
				getMax(i, ref);
				agregarFila();
			}else{
				$('#tf_ref'+i).val('');
				$('#tf_ref'+i).focus();
			}
		}
	});	
}

function getMax(i, ref){
	var orig = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		orig = $('#tf_ptov').val();
	}else{
		orig = $('#sl_ptov').val();
	}
	//console.log('i: '+i+"getcantr="+ref+"&orig="+orig);
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../inventario/invent_connect.php",
		data:"getcantr="+ref+"&orig="+orig,				
		success:function(data){
			//console.log(data);
			if (data ){
				$('#lb_cant'+i).text(data.cant_final);
			}
		}
	});	
}

function crearinv(){
	
	$('#form1').find("input,button,textarea,select").attr("disabled", "disabled");
	$('#bt_ok').hide();
	$('#bt_close').hide();
	
	getconsec();
	
	//createinvent();
}

function getconsec(){
	var x = '';
	$.ajax({
		type: "GET",
		dataType: 'json',
		url:"../inventario/invent_connect.php",
		data:"getconsect="+x,				
		success:function(data){
			//console.log(data);
			if (data){
				//console.log('d: '+data[0].cod_barra);
				$('#tf_consecf').val(data);
				
				createinvent();
			}
		}
	}); 
}

function createinvent(){
	var consec = $('#lb_consec').text();
	var fecha = $('#lb_fecha').text();
	var tipo = $('#sl_tipo').val();
	var mov = '';
	if (tipo == 'Devolucion'){
		mov = 'Salida';
	}else{
		mov = 'Entrada';
	}
	var obs = $('#tf_obs').val();
	var user2 = $('#tf_user2').val();
	var user = $('#tf_user').val();
	var puntov = '';
	if ( user == 'general'){
		puntov = $('#sl_ptov').val();
	} else {
		puntov = $('#tf_ptov').val();	
	}
	var puntovd = $('#sl_ptovd').val();
	var i = 1;
	var pre = 't';
	$('#tb_detail tr:not(#tittle)').each(function(){
		var ref = $('#tf_ref'+i).val();
		var cant = $('#tf_cant'+i).val();
		
		//console.log("ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&puntovd="+puntovd+"&user="+user2+"&cant="+cant+"&action=new_inventreg2");
				
		$.ajax({
			type:"post",
			url:"../inventario/invent_connect.php",
			data:"ref="+ref+"&consec="+consec+"&fecha="+fecha+"&tipo="+tipo+"&mov="+mov+"&obs="+obs+"&puntov="+puntov+"&puntovd="+puntovd+"&user="+user2+"&cant="+cant+"&pre="+pre+"&action=new_inventreg2",				
			success:function(data){
				//console.log('d:'+data);
				var res = data.replace( /\s/g, "");
				res = $.trim(res);
				//console.log('ci:'+res)
				if (res == 'exitoso'){
					//console.log('exitoso');
					createcant(ref, cant, puntov, puntovd, mov, user2, tipo);	
				}
				if (res == 'noexitoso'){
					//console.log('noexitoso');
					cuadroerror();
				}
			}
		});	
		
		i++;
	});
	setTimeout(function () {
	   cuadrook()
	   //console.log('close');
	}, 200);
}

function createcant(ref, cant, puntov, puntovd, mov, user, tipo){
	
	//console.log("ref="+ref+"&mov="+mov+"&puntov="+puntov+"&puntovd="+puntovd+"&tipo="+tipo+"&user="+user+"&cant="+cant+"&action=new_cantreg2");
	
	$.ajax({
		type:"post",
		url:"../inventario/invent_connect.php",
		data:"ref="+ref+"&mov="+mov+"&puntov="+puntov+"&puntovd="+puntovd+"&tipo="+tipo+"&user="+user+"&cant="+cant+"&action=new_cantreg2",				
		success:function(data){
			//console.log('d:'+data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('cc:'+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				
			}
			if (res == 'noexitoso'){
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	});	
}

function cuadrook(){
	//console.log('cuadro');
	$("#dialog").html('&nbsp;&nbsp;&nbsp;Registro Exitoso').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");		
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.close()
	}, 3000);					
}

function cuadroerror(){
	var url = '../inventario/invent_reg.php';
	$("#dialog").dialog("open");
	$("#dialog").html("&nbsp;No se pudo crear el registro de traslado").css("text-align", "center");
	$("span.ui-dialog-title").text('Alerta!').css("text-align", "center");
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>')
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.location.href = url;
	}, 3000);
}

function cuadro(){
	var consec = $('#lb_consec').text()
	overlay.show()
	$("#dialog").html('&nbsp;Registrar el traslado con el consecutivo: '+consec+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="crearinv();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
}

function cerrar_dialogo(){	
	overlay.hide()
	$("#dialog").dialog("close");
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


function searchp(i){
	
	var user2 = $('#tf_user2').val();
	var user = $('#tf_user').val();
	var p = '';
	if ( user == 'general'){
		p = $('#sl_ptov').val();
	} else {
		p = $('#tf_ptov').val();	
	}
	
	//console.log('../inventario/invent_search.php?i='+i+'&p='+p)
	var url = '../inventario/invent_search.php?i='+i+'&p='+p;
	Shadowbox.open({
		content: url,
		player: "iframe",
		options: {                   
			initialHeight: 1,
			initialWidth: 1,
			modal: true		      		
		},
	})
}

//funcion para iniciar el shadowbox
Shadowbox.init({
	handleOversize: "drag",
	modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
	onClose: function(){ 
	
	}
});

//funcion para validar que el input es un numero decimal
function checkNum(itm){
	var itm=itm.id
	var costo_u=$("#"+itm).val();	
	while(isNaN(costo_u)||costo_u.match(' ')||costo_u.match(/\,/g)){
		var tamano = costo_u.length;
		var costo_u=costo_u.substring(0,costo_u.length-1);
		$("#"+itm).val(costo_u);		
	}
}

</script>
</html>
<?php
}
?>