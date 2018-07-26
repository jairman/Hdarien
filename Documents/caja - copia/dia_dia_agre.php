<?php require_once('joom.php'); ?>
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
}

/*mysql_select_db($database_conexion, $conexion);
$query_drio = "SELECT * FROM d89xz_diario WHERE  YEAR(fecha) = '$anoss' AND MONTH(fecha) = '$mess' ORDER BY id DESC";
$drio = mysql_query($query_drio, $conexion) or die(mysql_error());
$row_drio = mysql_fetch_assoc($drio);
$totalRows_drio = mysql_num_rows($drio);*/

mysql_select_db($database_conexion, $conexion);
$query_cli = "SELECT * FROM d89xz_clientes where  `delete`= '0'";
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);
$totalRows_cli = mysql_num_rows($cli);

mysql_select_db($database_conexion, $conexion);
$query_prove = "SELECT * FROM d89xz_prove where  `delete`= '0'";
$prove = mysql_query($query_prove, $conexion) or die(mysql_error());
$row_prove = mysql_fetch_assoc($prove);
$totalRows_prove = mysql_num_rows($prove);

mysql_select_db($database_conexion, $conexion);
$query_centro = "SELECT * FROM d89xz_costos where  `delete` = '0'";
$centro = mysql_query($query_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);
$totalRows_centro = mysql_num_rows($centro);

$fecha=date("Y-m-d");
//echo $fecha;
$date = strtotime($fecha);


$i = 1;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Caja</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/jquery.mask.js" type="text/javascript"></script>

</head>

<body>
<DIV ID="seleccion">
  
   <blockquote>
   
   <input type="hidden" id="tf_i" value="<?php echo $i?>">
   <input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
    <input type="hidden" id="factura" value="">
   
   
   
     <form id="formulario" name="formulario" method="post" action="">
       <p>&nbsp;</p>
       <table width="95%" border="1" align="center" cellspacing="0" class="a">
         <tr>
           <td colspan="6" align="center"  class="tittle">Detalle Factura </td>
         </tr>
         <tr id="tittle">
           <th width="124" align="left" class="bold">Punto De Venta</th>
           <th width="275" align="center" class="cont">
            <label for="concepto"></label>
<?php
        if ($usuario2 == 'general'){
        ?>
<select name="sl_hac" id="sl_hac" style="width:98%" required="required" >
<option value="Todo">Todas</option>
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
<input type="text" readonly="readonly" id="tf_hac" name="tf_hac" style="width:98%" value="<?php echo $usuario2 ?>" />
<?php
        }
        ?></th>
           <td width="82" align="left" class="bold">Concepto</td>
           <td class="cont">
             <label for="estado">
<select name="concepto" style="width:98%" id="concepto" required="required" >
<option>Seleccione</option>
<option value="Egreso">Egreso</option>
<option value="Ingreso">Ingreso</option>
<option value="Base">Base</option>
</select>
</label></td>
<td width="143" class="bold">Estado</td>
<td class="cont"><select name="estado" id="estado"   style="width:98%"  required="required"  >
<option value="">Seleccione</option>
<option value="Pago">Pago</option>
<option value="Pendiente">Pendiente</option>
<option value="Base">Base</option>
</select></td>
  </tr>
         <tr >
           <th align="left"  class="bold"><label id="lb_c1">Cliente:</label></th>
           <th align="center" class="cont"><input type="text" name="tf_resp" id="tf_resp" style="width:95%"></th>
           <td align="left" class="bold">Cedula / NIT</td>
           <td class="cont">
             <input type="text" name="tf_cedula" id="tf_cedula" 
        style="width:98%" align="center"
        required="required" 
        />
           </td>
           <td class="bold">&nbsp;</td>
           <td class="cont">&nbsp;</td>
         </tr>
         <tr >
           <th align="left" class="bold">Forma De Pago</th>
           <th align="center" class="cont">
            <label for="centro">
<select name="formapago" id="formapago"   style="width:98%"  required="required"  >
<option value="">Seleccione</option>
<option value="Efectivo">Efectivo</option>
<option value="Pac">Pac</option>
<option value="Base">Base</option>
</select>
</label></th>
           <td align="left" class="bold">Fecha  Factura</td>
           <td width="182" class="cont"><input type="text" name="tf_fecha" id="tf_fecha"  value="<?php echo date ('Y-m-d') ?>" style="width:98%" /></td>
           <td class="bold">Fecha Pago</td>
           <td width="182" class="cont"><input type="text" name="tf_fecha2" id="tf_fecha2"   style="width:98%" /></td>
         </tr>
       </table>
       <p>&nbsp;</p>
       <table width="95%" border="1" align="center" cellspacing="0" class="a" id="tb_prod">
         <tr align="center" class="tittle">
           <td >Articulo</td>
           <td width="372" >Descripcion</td>
           <td>Valor Unitario</td>
           <td>Valor Total</td>
           <td bgcolor="#FFFFFF"><span class="cont"><img src="../img/add.png" alt="" width="20" height="20"  onclick="agregarFila()"/></span></td>
         </tr>
         
         
         <tr id="fila_<?php echo $i?>">
           <td width="135" align="center" class="bold"><?php echo $i ?></td>
           <td align="center" class="cont"><input name="descrip" type="text" id="descrip<?php echo $i?>"  style="width:98%"  class="a"/></td>
           <td width="183" class="cont"><input name="valor_unt" type="text" id="valor_unt<?php echo $i?>" style="width:98%" onKeyUp="checkNum(this),total('<?php echo $i?>')" /></td>
           <td width="305" class="cont"><input name="tal" type="text" id="tal<?php echo $i?>" readonly="readonly" style="width:98%" /></td>
           <td width="46" align="center" class="cont"><img src="../img/erase.png" id="bt_img<?php echo $i?>" width="20" height="20" 
    style="cursor:pointer;" onClick="quitar('<?php echo $i?>')"></td>
         </tr>
         
       
         
         
         
         
         
       </table>
       <p>&nbsp;</p>
       <table width="80%">
         <tr>
          <td align="center"><input name="button2" type="submit" class="ext" id="button2" value="Aceptar"  onclick="confirmar();  return false" style="width:100px" /> &nbsp;&nbsp;<input type="submit" name="button1" id="button1" value="Cancelar"  onclick="window.parent.Shadowbox.close();" class="ext" style="width:100px"/></td>
         </tr>
       </table>
       <div id="dialog" >

		</div>
     </form>
   </blockquote>
</DIV>

<script>
<!-- necesario para los cuadros de dialogo-->
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
overlay.click(function(){
	window.win.focus()
});
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
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})


$(document).ready(function(e) {
	$('#tf_fecha2').attr('disabled','disabled');
	
	$('#estado').bind('change', function () {
		//$(this).attr('disabled','disabled');
		var id = $(this).val();
		if(id =='Pendiente'){
			$('#tf_fecha2').removeAttr('disabled');
		}else{
			$('#tf_fecha2').attr('disabled','disabled');
		}
	
	}); 



 
});


function confirmacion(){
	//var id = $('#tf_id').val();
	overlay.show()
	$("#dialog").html('Agregar Registro<br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="factura();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

//------------------Validar Formulario --------------------------------
	function confirmar(){
	//	$("#formulario").submit();
		
			if($('#formulario')[0].checkValidity()){
				
				confirmacion();
			}else{
					
				$('#formulario')[0].find(':submit').click()			
			}
	}

//FUNCION DECIMALES
function numberWithCommas(n) {
		var parts=n.toString().split(".");
		return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
	}

// Funcion para cambiar cliente o proveedor
	$('#concepto').bind('change', function () {
		var tipo = $('#concepto').val();
		//alert(tipo)
		if (tipo == 'Egreso'){
			$('#lb_f1').text('Fecha Entrada: ');
			$('#lb_c1').text('Proveedor: ');
			
			$("#formapago").removeAttr("disabled");
			$("#estado").removeAttr("disabled");
			$("#tf_resp").removeAttr("disabled");
			$("#tf_cedula").removeAttr("disabled");
			

		}
		
		if (tipo == 'Ingreso'){
			$('#lb_f1').text('Fecha Salida: ');
			$('#lb_c1').text('Cliente: ');
			
			$("#formapago").removeAttr("disabled");
			$("#estado").removeAttr("disabled");
			$("#tf_resp").removeAttr("disabled");
			$("#tf_cedula").removeAttr("disabled");
						
		}
		
		if (tipo == 'Base'){
						
			$('#formapago').val('Base');
			$("#formapago").prop('disabled', 'true');
			
			$('#estado').val('Base');
			$("#estado").prop('disabled', 'true');
			
			$('#tf_resp').val('Base');
			$("#tf_resp").prop('disabled', 'true');
			
			$('#tf_cedula').val('Base');
			$("#tf_cedula").prop('disabled', 'true');
			
			
			$('#lb_c1').text('Cliente: ');
						
		}		
	});
	
//funcion autocomplete para el responsable
	$("#tf_resp").autocomplete({
		minLength: 1,
		source: getCliente,
		select: function(event, ui) {
			getCedula(ui.item.value);
		}
	});
//funcion para buscar la cedula del cliente
	$("#tf_cliente").bind('change', function(){
		getCedula($(this).val());	
	});

function getCliente(request, response) {
	var tipo = $('#concepto').val();
	if (tipo == 'Ingreso'){
		$.ajax({
			type:"post",
			url: 'connect.php',
			dataType: "json",
			data: "cliente="+request.term+"&action=getCliente",
			success: function(data) {				
				//console.log(data);
				var array = new Array();
				var j = 0;
				$.each(data, function(i, item) {
					var nombre = data[i].nombre;
					if (nombre != null ){
						array[j]=nombre;	
						j++;
					}
					i++;
				});
				response(array);
				return;
			},
		});
	}
	if (tipo == 'Egreso'){
		$.ajax({
			type:"post",
			url: 'connect.php',
			dataType: "json",
			data: "cliente="+request.term+"&action=getProveedor",
			success: function(data) {				
				//console.log(data);
				var array = new Array();
				var j = 0;
				$.each(data, function(i, item) {
					var nombre = data[i].nombre;
					if (nombre != null ){
						array[j]=nombre;	
						j++;
					}
					i++;
				});
				response(array);
				return;
			},
		});	
		
	}
}

//funcion para traer la cedula del cliente
function getCedula(cliente) {
	var tipo = $('#concepto').val();
	if (tipo == 'Ingreso'){
		$.ajax({
			type:"post",
			url: 'connect.php',
			dataType: "json",
			data: "cliente="+cliente+"&action=getCedulaC",
			success: function(data) {				
				console.log(data);
				$('#tf_cedula').val(data[0]);
				$('#tf_tel').val(data[1]);
			}
		});
	}
	if (tipo == 'Egreso'){
		$.ajax({
			type:"post",
			url: 'connect.php',
			dataType: "json",
			data: "cliente="+cliente+"&action=getCedulaP",
			success: function(data) {				
				console.log(data);
				$('#tf_cedula').val(data[0]);
				$('#tf_tel').val(data[1]);
			}
		});
	
	}
}

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
	$( "#tf_fecha").datepicker();
	$( "#tf_fecha2").datepicker();
	
//-------------------------------------- Agragar Fila ----------------------------------------------------



/*  <tr id="fila_'+i+'">
           <td width="108" align="center" class="bold">'+i+'</td>
           <td align="center" class="cont"><input name="descrip" type="text" id="descrip'+i+'"  style="width:98%" /></td>
           <td width="140" class="cont"><input name="valor_unt2" type="text" id="valor_unt'+i+'" style="width:98%" /></td>
           <td width="139" class="cont"><input name="tal2" type="text" id="tal'+i+'" readonly="readonly" style="width:98%" /></td>
           <img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" 
    style="cursor:pointer;" onClick="quitar('+i+')"/></td>
         </tr>
         */

function agregarFila(){
	var i = parseInt($('#tf_i').val());
	i= i+1;
	//console.log('i:'+i);
	$('#tb_prod tr:last').after(' <tr id="fila_'+i+'"><td width="108" align="center" class="bold">'+i+'</td><td align="center" class="cont"><input name="descrip" type="text" id="descrip'+i+'"  style="width:98%" class="a" /></td><td width="140" class="cont"><input name="valor_unt2" type="text" id="valor_unt'+i+'" style="width:98%" onKeyUp="checkNum(this),total('+i+')" /></td><td width="139" class="cont"><input name="tal" type="text" id="tal'+i+'" readonly="readonly"style="width:98%" /></td><td width="139" class="cont"><img src="../img/erase.png" id="bt_img'+i+'" width="20" height="20" style="cursor:pointer;" onClick="quitar('+i+')"/></td></tr>');
	//$('#tf_ref'+i).attr('onChange', 'getProd("'+i+'")');
	//$('#lb_val'+i).attr('onChange', 'getdcto("'+i+'")');
	//$('#bt_sproduct'+i).attr('onClick', 'searchProd("'+i+'")');
	//$('#tf_cant'+i).attr('onkeyup', 'compare("'+i+'")');
	//$('#tf_cant'+i).attr('onkeyup', 'total("'+i+'")');
	//$('#tf_cant'+i).attr('onChange', 'checkNum(this)');
	//$('#bt_img'+i).attr('onClick', 'quitar("'+i+'")');
	
	$('#tf_i').val(i);
}	
//-------------------------------------- Eliminar Fila ----------------------------------------------------
function quitar(i){
	//console.log('quitar: '+i);
	$("#fila_"+i ).remove();
	
}



//--------------------------------funcion para validar que el input es un numero decimal------------------------
function checkNum(itm){
	var itm=itm.id
	var costo_u=$("#"+itm).val();
	//console.log('quitar: '+i);	
	while(isNaN(costo_u)||costo_u.match(' ')||costo_u.match(/\,/g)){
		var tamano = costo_u.length;
		var costo_u=costo_u.substring(0,costo_u.length-1);
		$("#"+itm).val(costo_u);
		
	}
}
//--------------------------------totalizar------------------------
function total(i){
	//console.log('total:'+i);
	var total = new Number($('#valor_unt'+i).val());
	
	var tal = numberWithCommas(total);
	
	$('#tal'+i).val(tal);
	
}

//------------------------------------------Insertar----------------------------------------

function insert(){
	//alert('insert')
	var i = 1;
	var x = 0;
	
		var user = $('#tf_user').val();
		//var ptov = '';
		if ( user != 'general'){
			sucursal = $('#tf_hac').val();
		}else{
			sucursal = $('#sl_hac').val();
		}
		
		var estado = 	$('#estado').val();
		var concepto =  $('#concepto').val();
		var cliente =   $('#tf_resp').val();		
		var cedula = 	$('#tf_cedula').val();
		var fecha = 	$('#tf_fecha').val();
		var fechapago = $('#tf_fecha2').val();
		var formapago = $('#formapago').val(); 
		var factura = 	$('#factura').val();

	
	var $table = $('#tb_prod tr:not(#tittle)').closest('table');   		
	$table.find('.a').each(function() {
		
		var ref = $(this).val();
		var id = $(this).attr('id');
		console.log('id: '+id);	
		var n = id.substr(7);
		n = $.trim(n);
		//console.log('i: '+n);
	
		var descrip =  $('#descrip'+n).val();
		var valor_unt =    $('#valor_unt'+n).val();
		
		
		//console.log("cliente="+cliente+"&fecha="+fecha+"&sucursal="+sucursal+"&estado="+estado+"&concepto="+concepto+"&action=pedido" + "&cedula="+cedula+ "&fechapago="+fechapago+ "&formapago="+formapago+ "&descrip="+descrip+ "&valor_unt="+valor_unt+ "&factura="+factura);
	
	
	
	$.ajax({
			type: "post",
			url: "connect.php",
			data:"cliente="+cliente+"&fecha="+fecha+"&sucursal="+sucursal+"&estado="+estado+"&concepto="+concepto+"&action=pedido" + "&cedula="+cedula+ "&fechapago="+fechapago+ "&formapago="+formapago+ "&descrip="+descrip+ "&valor_unt="+valor_unt+ "&factura="+factura,	
			success: function(datos){ 
						// console.log(datos)
							   
							$("#dialog").html("Registro Exitoso");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
								
									$("#dialog").dialog("close");
									 parent.location.reload();
									$('#tabla').load('dia_dia.php'  + ' #tabla ' )  
								}, 2000); 
					
				}
		})
		
		x++;
		i++;
    });	
}

//------------------------------------Funcion Traer Consecutivo Factura -------------------------------------------------------
function factura() {
	//alert('hola')
	
		var user = $('#tf_user').val();
		//console.log(user);
		if ( user != 'general'){
			sucursal = $('#tf_hac').val();
		}else{
			sucursal = $('#sl_hac').val();
		}
			//console.log(sucursal);
	
		$.ajax({
			type:"GET",
			url: 'connect.php',
			//dataType: "json",
			data: "sucursal="+sucursal,
			success: function(data) {				
				//console.log(data);
				$('#factura').val(data);
				//$('#tf_tel').val(data[1]);
				insert()
			}
		});
	

}
</script>
</body>
</html>




<?php
//mysql_free_result($drio);
/*
mysql_free_result($cli);

mysql_free_result($prove);

mysql_free_result($centro);

@$descrip =$_POST['descrip'];
@$concepto =$_POST['concepto'];
@$estado =$_POST['estado'];
@$cantidad =$_POST['cantidad'];
@$valor_unt =$_POST['valor_unt'];
@$cliente =$_POST['tf_cedula'];
@$provedor=$_POST['tf_cedula'];
@$coment=$_POST['obser'];
$f_pago=$_POST['tf_fecha2'];
@$f_factu=$_POST['tf_fecha'];
@$centro=$_POST['centro'];
@$clientee=$_POST['tf_resp'];
@$prevee=$_POST['tf_resp'];
///////////////////////////////////////Hacienda/////////////////////////////////////////////////////////////////////

if($usuario2=='general'){
	$hacienda=$_POST['sl_hac'];
}else{
	$hacienda=$_POST['tf_hac'];
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
mysql_select_db($database_conexion, $conexion);
$query_drio1 = "SELECT * FROM d89xz_diario where hacienda='$hacienda'  ORDER BY factura DESC";
$drio1 = mysql_query($query_drio1, $conexion) or die(mysql_error());
$row_drio1 = mysql_fetch_assoc($drio1);
$totalRows_drio1 = mysql_num_rows($drio1);
		if($descrip){
			$factura1= $row_drio1['factura'];
			if($factura1!=''){
				$factura2=$factura1;
				
			}else{
				$factura2=1000000;	
			}
		}

$factura=$factura2 + 1;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($valor_unt!= 0){
	
	
if ($concepto == Egreso){	
echo "<script type=''>
		alert('Registro Exitoso');
	</script>";

$valor_t = $valor_unt *  -1;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$valor_t}','{$f_factu}','{$prevee}','{$factura}','{$provedor}','{$f_pago}','{$usuario_resp}','{$hacienda}')",$conexion);
////  2 


///////////////////////------------------------------------------------------------------------------///////////////////////////////////////
//////////////////////-------------------------------------------------------------------------------//////////////////////////////////////
if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,hac,user) VALUES ('{$f_pago}','{$estado}','Compra Pendiente Pago de Factura N°.$factura','Compra De Caja ','{$hacienda}','{$usuario_resp}')",$conexion);
		}
		
		
		
echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";
		
}
///+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//



if ($concepto == Ingreso){	
echo "<script type=''>
		alert('Registro Exitoso');
	</script>";

$valor_t = $valor_unt ;

///////////////////////------------------------------------------------------------------------------/////////////////
		
$insertar = mysql_query("INSERT INTO d89xz_diario(`concep`,`comentario`,`estado`,`valor`,`fecha`,`cliente`,`factura`,`cedula`,`f_alarma`,`user`,`hacienda`) VALUES ('{$concepto}','{$descrip}','{$estado}','{$valor_t}','{$f_factu}','{$prevee}','{$factura}','{$provedor}','{$f_pago}','{$usuario_resp}','{$hacienda}')",$conexion);



///////////////////////------------------------------------------------------------------------------///////////////////////////////////////
//////////////////////-------------------------------------------------------------------------------//////////////////////////////////////
	if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`,jorn,hac,user) VALUES ('{$f_pago}','{$estado}','Venta Pendiente Pago de Factura N°.$factura','Venta De Caja ','{$f_pago}','{$hacienda}','{$usuario_resp}')",$conexion);
		
		
		}


echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";
}


}
mysql_close($conexion);*/
?>

