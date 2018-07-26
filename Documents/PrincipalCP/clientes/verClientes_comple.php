<?php require_once('joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); 
 


 $_GET['id'];
 
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

$colname_clien = "-1";
if (isset($_GET['id'])) {
  $colname_clien = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_clien = sprintf("SELECT * FROM d89xz_clientes WHERE id = %s", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ver Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
</head>

<body>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="../clientes/verClientes.php?id=<?php echo $colname_clien ?>" class='active'>Información del Cliente</a>
      </li>
      <li>
      <a  href="../clientes/client_histo.php?id=<?php echo $colname_clien ?>" >Historial de Facturación</a>
      </li>
      <li>
      <a  href="../../caja/dia_dia_pendiente_cliente.php?id=<?php echo $colname_clien ?>" >Cuentas Por Cobrar</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="left"><img  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('main')"/></td>
  </tr>
</table>
<div id="main">
&nbsp;

<table width="95%" align="center">
  <tr>
    <td  align="left" ><img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
  </tr>
</table>

<form  id="form1" method="post" name="form1">

<input type="hidden" name="registro" id="categoria" >

  <table width="95%"  align="center" >
  <tr>
    <td colspan="4" align="center" class="tittle" style="">Información registro de clientes</td>
    </tr>
  <tr>
    <td width="20%" class="bold">NIT</td>
    <td width="30%" class="cont"><label for="textfield"></label>
      <input name="registro" type="text"  required="required" id="cedula" style="width:98%" value="<?php echo $row_clien['cedula']; ?>" readonly="readonly"/></td>
    <td width="20%" class="bold">Nombre/Empresa</td>
    <td width="30%" class="cont"><input name="registro" type="text"  required="required" id="nombre" style="width:98%" value="<?php echo $row_clien['nombre']; ?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <td class="cont"><input name="registro" type="text" id="dir" style="width:98%" value="<?php echo $row_clien['dir']; ?>" readonly="readonly" /></td>
    <td class="bold">Ciudad</td>
    <td class="cont"><input name="registro" type="text" id="ciudad" style="width:98%" value="<?php echo $row_clien['ciudad']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Teléfono</td>
    <td class="cont"><input name="registro" type="text" id="telefono" style="width:98%" value="<?php echo $row_clien['telefono']; ?>" readonly="readonly" /></td>
    <td class="bold">Celular</td>
    <td class="cont"><input name="registro" type="text" id="cel" style="width:98%" value="<?php echo $row_clien['cel']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Categoría</td>
    <td class="cont"><input name="registro" type="text" id="contacto" style="width:98%" value="<?php echo $row_clien['categoria']; ?>" readonly="readonly" /></td>
    <td class="bold">E mail</td>
    <td class="cont"><input name="registro" type="text" id="mail" style="width:98%" value="<?php echo $row_clien['mail']; ?>" readonly="readonly"/></td>
  </tr>
<tr>
<td class="bold">Cumpleaños</td>
<td class="cont"><input name="contacto" type="text" id="contacto3" style="width:98%" value="<?php echo $row_clien['cumple']; ?>" readonly="readonly" /></td>
<td class="bold">Saldo a Favor</td>
<td class="cont"><input name="contacto2" type="text" id="contacto4" style="width:98%" value="<?php echo $row_clien['saldo_favor']; ?>" readonly="readonly" /></td>
</tr>
  <tr>
    <td colspan="4" align="center" >&nbsp;</td>
    </tr>
</table>


<!-- Finaliza el primer Div de personas  -->




  <table width="95%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="4" align="center" class="tittle" style="">Información De Contactos</td>
    </tr>
  <tr>
    <td width="20%" class="bold">Contacto 1</td>
    <td width="30%" class="cont"><label for="textfield"></label>
      <input name="registro" type="text" id="contacto1" style="width:98%" value="<?php echo $row_clien['contacto1']; ?>"  readonly="readonly" /></td>
    <td width="20%" class="bold">Contacto 2</td>
    <td width="30%" class="cont"><input name="registro" type="text" id="contacto2" style="width:98%" value="<?php echo $row_clien['contacto2']; ?>"  readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Cargo</td>
    <td class="cont"><input name="registro" type="text" id="cargoc1" style="width:98%" value="<?php echo $row_clien['cargoc1']; ?>"  readonly="readonly"/></td>
    <td class="bold">Cargo</td>
    <td class="cont"><input name="registro" type="text" id="cargoc2" style="width:98%" value="<?php echo $row_clien['cargoc2']; ?>"  readonly="readonly"/></td>
  </tr>
  <tr>
    <td class="bold">Teléfono</td>
    <td class="cont"><input name="registro" type="text" id="telefonoc1" style="width:98%" value="<?php echo $row_clien['telefonoc1']; ?>"  readonly="readonly"/></td>
    <td class="bold">Teléfono</td>
    <td class="cont"><input name="registro" type="text" id="telefonoc2" style="width:98%" value="<?php echo $row_clien['telefonoc2']; ?>"  readonly="readonly"/></td>
  </tr>
  <tr>
    <td class="bold">E mail</td>
    <td class="cont"><input  name="registro" type="text" id="mailc1" style="width:98%" value="<?php echo $row_clien['mailc1']; ?>"  readonly="readonly" /></td>
    <td class="bold">E mail</td>
    <td class="cont"><input name="registro" type="text" id="mailc2" style="width:98%" value="<?php echo $row_clien['mailc2']; ?>"  readonly="readonly"/></td>
  </tr>
</table>




<!--<div id="segundo" style="display:none" >-->


<table width="95%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="4" class="tittle">Información Bancaria</td>
    </tr>
  <tr>
    <td width="20%" class="bold">Número De Cuenta</td>
    <td width="30%" class="cont"><input name="registro" type="text" id="cuenta" style="width:98%" value="<?php echo $row_clien['cuenta']; ?>" readonly="readonly" /></td>
    <td width="18%" class="bold">Tipo  De Cuenta</td>
    <td width="32%" class="cont"><input name="registro" type="text" id="tipocuenta" style="width:98%" value="<?php echo $row_clien['tipocuenta']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Banco</td>
    <td class="cont"><input name="registro" type="text" id="banco" style="width:98%" value="<?php echo $row_clien['banco']; ?>" readonly="readonly" /></td>
    <td class="bold">Forma De Pago</td>
    <td class="cont"><input name="registro" type="text" id="formapago" style="width:98%" value="<?php echo $row_clien['formapago']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Periodo De Pago</td>
    <td class="cont"><input name="registro" type="text" id="periodopago" style="width:98%" value="<?php echo $row_clien['periodopago']; ?>" readonly="readonly" /></td>
    <td class="bold">Comentario</td>
    <td class="cont"><input name="registro" type="text" id="comentario" style="width:98%" value="<?php echo $row_clien['comentario']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input name="button5" type="submit" class="ext" id="button5" value="Insertar Registro" style="width:150px; display:none"   onclick="confirmacion(); return false"/>
      <input type="button" name="button1" id="button1" value="Cerrar"  onclick="javascript:window.close();" class="ext" style="width:150px"/></td>
    </tr>
</table>

<div id="dialog" >

</div>
 
</form>
</div>
<!-- Finaliza el primer Div de personas  segundo -->
<p>&nbsp;</p>
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

<!-- Fin  funciones cuadro de dialogo-->

<!-- Funcion para esconder el  segundo -->
function primero(){
	if($('#form1')[0].checkValidity()){
		$("#primero").slideUp(500)
			setTimeout(function(){
			$("#segundo").slideDown(500)
		 },500	)
	}else{
		 $('#form1')[0].find(':submit').click();
	}

	
}






<!-- Funcion para esconder el  primero con boton atras -->
function segundo(){
	//$("#button5").hide();
	$("#segundo").slideUp(500)
		setTimeout(function(){
		$("#primero").slideDown(500)
	 },500	)
	
}

function final(){
	

	$("#button1").hide();
	$("#button3").hide();
	$("#button4").hide();
	$("#primero").slideToggle();
	$("#button5").slideToggle();
	
}
///////////////////////////Funcion para Mandar datos de formulario /////////////////////////////////////////////////
function confirmacion(){
	//var id = $('#tf_id').val();
	overlay.show()
	$("#dialog").html('Desea Insertar Registro...? <br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="verificar();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function verificar(){
	var cedula = $('#cedula').val();
	$.ajax({
			type: "POST",
			url: "../base_conex.php",
			data: {'verifC': cedula},
			success: function(datos){ 
							 //console.log(datos)
							 	//console.log('d:'+datos);
					var res = datos.replace( /\s/g, "");
					res = $.trim(res);
					//console.log('r:'+res)
					if (res == 'existe'){
						//console.log('exitoso');
						cuadro();
						
					}
					if (res == 'noexiste'){
						//console.log('noexitoso');
						insertar();
					}
							 
				}
			});
	
}
function insertar(){
		
	var vals=[];
	var ids=[];
	$('[name="registro"]').each(function(index, element) {
                ids.push(element.id);
				vals.push(element.value);
       });
						//alert(vals)
						//console.log(ids)
						//console.log(vals)
		$.ajax({
			type: "POST",
			url: "../base_conex.php",
			data: {'insertarC': ids, 'vals': vals},
			success: function(datos){ 
							 console.log(datos)
							   
							$("#dialog").html("Registro Exitoso");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
									
									$("#dialog").dialog("close");
									  parent.location.reload();
									$('#tabla').load('kardex.php'  + ' #tabla ' )  
								}, 2000); 
					
					}
		})
}

function cuadro(){
	//console.log('cuadro');
	$("#dialog").html('&nbsp;&nbsp;&nbsp;Usuario Existente').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");		
	setTimeout(function () {
	   $("#dialog").dialog("close");
	   window.parent.Shadowbox.close();
	}, 2000);					
}

<!--select  de Categoria-->

function desb(){
	var lab=$('#sl_lab').val();
	if (lab==''){
		$('#tf_lab').removeAttr('disabled');
		
	}else{
		$("#tf_lab").attr('disabled','disabled');
	}
}

function desa(){
	var lab=$('#tf_lab').val();
	if (lab==''){
		$("#sl_lab").removeAttr('disabled');
		$('#categoria').val(sl_lab);
		console.log(categoria)
			}else{ 
		$("#sl_lab").attr('disabled','disabled');
	}
}

$('#tf_lab').bind('change keyup', function(){
		var lab1=$('#tf_lab').val();
		$('#categoria').val(lab1);
		
	}); 
	
   $("#sl_lab").change(function(){
		 var lab2=$('#sl_lab').val();
		$('#categoria').val(lab2);
		  console.log(categoria) 
        });	
	
//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
}
</script>




</body>
</html>
<?php
mysql_free_result($clien);
?>
