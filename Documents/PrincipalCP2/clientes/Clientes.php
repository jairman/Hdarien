<?php require_once('joom.php'); ?>
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
$query_kar = "SELECT * FROM country  order by Name ";
$kar = mysql_query($query_kar, $conexion) or die(mysql_error());
$row_kar = mysql_fetch_assoc($kar);
$totalRows_kar = mysql_num_rows($kar);

@$city=$_GET['y'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrar Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../../js/jquery.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>


</head>

<body>
<form  id="form1" method="post" name="form1">
  
  <div  id="primero">
<p>
<!--
<select id="state2"></select>
	<select id="city2"></select>

<script>
	$("#state2").jCombo({url: "getStates.php" });
	$("#city2").jCombo({
		url: "getCities.php", 
		input_param: "id", 
		parent: "#state2", 
		onChange: function(newvalue) {
			$("#message").text("parent has changed to value " + newvalue)
			.fadeIn("fast",function() {
				$(this).fadeOut(3500);
			});
		}
	});
</script>-->


<input type="hidden" name="registro" id="categoria" >
</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<table width="98%" border="1">
<tr>
<td><img src="../../img/Logo.png" alt="" width="200" height="70" /></td>
</tr>
</table>

  <table width="90%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="5" align="center" class="tittle" style="">Información Básica</td>
    </tr>
  <tr>
    <td width="20%" class="bold">NIT</td>
    <td width="30%" class="cont">
      <input type="text" name="registro" id="cedula" style="width:85%"  required="required"/>
      <img src="" width="20" height="20" id="img_est2" style="display:none" />
      </td>
    <td width="20%" class="bold">Nombre</td>
    <td colspan="2" class="cont"><input type="text" name="registro" id="nombre" style="width:98%"  required="required"/></td>
  </tr>
    <tr>
  
  <td class="bold">Dirección</td>
  <td class="cont"><input type="text" name="registro" id="dir" style="width:98%" />
  
  
  </td>
  <td class="bold">Ciudad</td>
  <td width="15%" class="cont"><select name="registro" id="pais" style="width:99%" onChange="load1()">
  <?php
do {  
?>
  <option value="<?php echo $row_kar['Code']?>"><?php echo $row_kar['Name']?></option><?php
} while ($row_kar = mysql_fetch_assoc($kar));
  $rows = mysql_num_rows($kar);
  if($rows > 0) {
      mysql_data_seek($kar, 0);
	  $row_kar = mysql_fetch_assoc($kar);
  }
?>

 
      </select>
  
    </td>
  <td width="15%" class="cont"><div id="city" style="width:98%">
   
  <?php
		$city;
		mysql_select_db($database_conexion, $conexion);
		$query_ciu = "SELECT * FROM city where Country='$city'  order by 	Name";
		$ciu = mysql_query($query_ciu, $conexion) or die(mysql_error());
		$row_ciu = mysql_fetch_assoc($ciu);
		$totalRows_ciu = mysql_num_rows($ciu);
  ?>

           <select name="registro" id="ciudad" style="width:98%">
    <?php		                  
            do {  
     ?>
      <option value="<?php echo $row_ciu['Name']?>"><?php echo $row_ciu['Name']?></option>
      <?php
            } while ($row_ciu = mysql_fetch_assoc($ciu));
              $rows = mysql_num_rows($ciu);
				  if($rows > 0) {
					  mysql_data_seek($ciu, 0);
					  $row_ciu = mysql_fetch_assoc($ciu);
				  }
       ?>
    </select>
  </div>
  
  </td>
  
    </tr>
  
    <tr>
  
    <td class="bold">
    Telefono
    </td>
  
    <td class="cont">
    <input type="text" name="registro" id="telefono" style="width:98%" />
    </td>
  
    <td class="bold">
    Celular
    </td>
  
    <td colspan="2" class="cont">
    <input type="text" name="registro" id="cel" style="width:98%" />
    </td>
  
    </tr>
  
    <tr>
  
    <td class="bold">
    Categoría
    </td>
  
    <td class="cont">
    <input name="tf_lab" type="text" id="tf_lab" style="width:45%" onkeyup="desa()" />
  
    <select name="sl_lab" id="sl_lab" style="width:45%" onchange="desb()">
  
  <option value="">Seleccione Categoría.</option>
  <?php
        mysql_select_db($database_conexion, $conexion);
         $query_lab = "SELECT DISTINCT categoria FROM d89xz_clientes where categoria !='' and `delete` !='1' ORDER BY `categoria` ASC ";
        $lab = mysql_query($query_lab, $conexion) or die(mysql_error());
        while ($row_lab = mysql_fetch_assoc($lab)){
        ?>
  <option value="<?php echo ucwords(strtolower($row_lab['categoria']))?>"> <?php echo ucwords(strtolower($row_lab['categoria']))?></option>
  <?php
        } 
        ?>
</select>
  </td>

  <td class="bold">E mail</td>
  <td colspan="2" class="cont"><input type="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" autofocus="autofocus" placeholder="exemple@idsolutions-group.com" name="registro" id="mail" style="width:98%" />
    <!-- Escond-->
    <input type="hidden" name="registro" id="forma" style="width:98%" readonly="readonly" /></td>
</tr>
<tr>
<td class="bold">Cumpleaños</td>
<td class="cont"><input type="text" name="registro" id="cumple" style="width:98%" /></td>
<td class="bold">Tipo Cliente</td>
<td colspan="2" class="cont"><select name="registro" id="formapago" style="width:98%">
<option value="">Seleccione</option>
<option value="Credito">Credito</option>
<option value="Contado">Contado</option>
<option value="Contado">consignación</option>
</select></td>
</tr>
  <tr>
    <td colspan="5" align="center" >&nbsp;</td>
  </tr>
</table>

</div> 
<!-- Finaliza el primer Div de personas  -->

<!--<div id="segundo" style="display:none" >-->
<div  id="segundo"></div>


<!--<div id="tercero" style="display:none" >-->
<div id="tercero" >

<table width="90%" border="1" align="center" cellspacing="0">
  <tr>
    <td width="20%" >&nbsp;</td>
    <td width="48%" class="cont">
      <label for="select_raza2"></label></td>
    <td width="32%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="button1" type="submit" class="ext" id="button1" value="Aceptar" style="width:150px;"   onclick="primero(); return false"/> &nbsp;&nbsp;
    
    <input type="submit" name="button15" id="button15" value="Cancelar"  onclick="window.close();" class="ext" style="width:150px"/></td>
    </tr>
</table>

<div id="dialog" >

</div>
</div> 
</form>
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
		
					confirmacion()
		 
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
<!-- Funcion para esconder el  primero con boton atras -->
function cuarto(){
	//$("#button5").hide();
	$("#tercero").slideUp(500)
		setTimeout(function(){
		$("#segundo").slideDown(500)
	 },500	)
	
}
function tercero(){
	if($('#form1')[0].checkValidity()){
		$("#segundo").slideUp(500)
		setTimeout(function(){
		$("#tercero").slideDown(500)
	 },500	)
	}else{
		 $('#form1')[0].find(':submit').click();
	}
}

function final(){
	

	$("#button1").hide();
	$("#button3").hide();
	$("#button4").hide();
	$("#button6").hide();
	$("#button7").hide();
	$("#primero").slideToggle();
	$("#segundo").slideToggle();
	$("#button5").slideToggle();
	
}
///////////////////////////Funcion para Mandar datos de formulario /////////////////////////////////////////////////
function confirmacion(){
	//var id = $('#tf_id').val();
	overlay.show()
	$("#dialog").html('Insertar Registro <br>').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="50" height="50" style="cursor:pointer" onclick="insertar();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function verificar(){
	var cedula = $('#cedula').val();
	cuadro();
	$.ajax({
			type: "GET",
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
							// console.log(datos)
							   
							$("#dialog").html("Registro Exitoso");
							$("span.ui-dialog-title").text('Información Importante');
							$("#dialog").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>')
							$("#dialog").dialog("open");
											
								setTimeout(function () {
									
									$("#dialog").dialog("close");
									 parent.location.reload();
									 window.close()
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
		
//Buscar si existe ID /////////////////////77

	$('#cedula').bind('change', function () {
		//searchid($(this).val());
		$(this).attr('disabled','disabled');
		var id = $(this).val();
		searchid(id);
	});


	
function searchid(id){
	//console.log('search id:'+id);
	$.ajax({
		type: "GET",
		url: "../base_conex.php",
		data: "verifC="+id,
		success: function(datos){ 						
			//console.log(datos);
			var op = datos.replace(/ /g,'');
			op = $.trim(op);
		//	console.log(op);
			if(op=="noexiste"){
				//console.log('ifnoexiste');
				$('#img_est2').attr('src','../../img/good.png');
				//$('#nombre').attr("disabled", "disabled");
				$('#nombre').removeAttr('disabled');
				
			}
			if(op=="existe"){
				//console.log('ifexiste');
				$('#img_est2').attr('src','../../img/erase.png');
				//$('#nombre').removeAttr('disabled');
				$("#nombre").attr('disabled','disabled');
				$('#nombre').focus();
				$('#cedula').removeAttr('disabled');
				
			}
			$('#img_est2').show()
		},
	});	
}
function load1(){
	var y = $('#pais').val();
	//alert(y)

	$('#city').load('Clientes.php?y=' + y.replace(/ /g,"+") +' #city > *' );

	
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
	$( "#cumple").datepicker();
	$( "#tf_fecha2").datepicker();	
</script>
</body>
</html>
<?php
mysql_free_result($kar);

mysql_free_result($ciu);
?>
