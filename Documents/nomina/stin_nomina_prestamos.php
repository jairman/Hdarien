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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="../css/clean.css" />
<link rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript">
Shadowbox.init({	 
    handleOversize: "drag",
    modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
	onClose: function(){
		//recarga_tabla();
	}
});
</script>
<script type="text/javascript" src="js/format_table.js"></script>
<script src="../js/printThis.js" type="text/javascript"></script>
<link href="css/format_table.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style>
#overlay {
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.8;
    filter: alpha(opacity=80);
    z-index:50;
	display:none;
}
</style>


</head>

<body>
      <table width="90%" border="0" align="center">
        <tr align="center">
          <td>
            <p>
              <select name="prest_sel" id="prest_sel" onchange="cam_pres()" class="cont" style="width:250px">
                <option value="historial"> Historial Prestamos</option>
                <option value="nuevo" selected="selected">Nuevo Prestamo</option>
              </select>          
          </td>
        </tr>
      </table>
      <br />
      <div id="tb_pres">
      <form id="form_pres" method="post">
<table width="65%" border="1" cellspacing="0" cellpadding="0"  align="center">
<tr  >
		  <td rowspan="5"><img src="../img/Logo.png" width="200" height="90"  alt=""/></td>
          <td class="bold" colspan="">Sucursal</td>
          
        
    <td class="cont" colspan="2">    
 <?php
	if($usuario=='general'){
		$rs_usus=mysql_query("SELECT DISTINCT hacienda FROM d89xz_hacienda WHERE `delete`=0",$conexion);	
		
	?>
    
       <select name="filtro" id="filtro"  onchange="recarga_tabla()" class="long" required="required" >
       <option value="">Sucursal</option>
      <?php
	  while($row_rs_usus=mysql_fetch_assoc($rs_usus)){
	  ?>
      <option value="<?php echo $row_rs_usus['hacienda'] ?>"><?php echo $row_rs_usus['hacienda'] ?></option>
      <?php
	  }		  
	  ?>
      </select>      
     <?php
	}else{
	 ?> 
     <input type="text" readonly="readonly" value="<?php echo $usuario ?>" id="filtro" class="long" />
     <?php
	}
	 ?>
</td>
</tr>
<tr  >
		<td class="bold " colspan=""><strong>Nombre</strong></td>
          
          <td class="cont" colspan="2">
          <div id="carga_noms">
          <?php
		  	if(isset($_GET['hda'])){
				$hda=$_GET['hda'];
				$rs_emples=mysql_query("SELECT * FROM nomina_valle WHERE hacienda='$hda' and `delete`=0");
			}
		  ?>
           <select name="emple" id="emple"   onchange="carga_datos()" required="required" class="long" >
       <option value="">Empleado</option>
       <?php
	   while($row_emples=mysql_fetch_assoc($rs_emples)){
	   ?>
       <option value="<?php echo $row_emples['cedula'] ?>"><?php echo $row_emples['nombre'] ?></option>
       <?php
	   }
	   ?>
       </select>
          </div>
          </td>
       
      </tr>
        <tr >
        <td class="bold" colspan=""><strong>Cédula</strong></td>
          <td class="cont" colspan="2">
          <div id="carga_data">
          <?php
          if(isset($_GET['empleado'])){
				$hda=$_GET['hda'];
				$empleado=$_GET['empleado'];
				//echo $empleado;
				$rs_info=mysql_query("SELECT cedula, rfid FROM nomina_valle WHERE cedula='$empleado'");
				$row_rs_info=mysql_fetch_assoc($rs_info);
		  }
		?>
           <input type="hidden" id="rfid_emple" value="<?php echo $row_rs_info['rfid'] ?>" />
          <input type="text" id="cedula" value="<?php echo $row_rs_info['cedula'] ?>" readonly="readonly" class="long"/>
          </div></td>
        </tr>
        <tr >
        <td class="bold" colspan=""><strong>Cargo</strong></td>
          <td class="cont" colspan="2"><div id="carga_data2">
          <?php
          if(isset($_GET['empleado'])){
				$hda=$_GET['hda'];
				$empleado=$_GET['empleado'];
				//echo $empleado;
				$rs_info=mysql_query("SELECT cargo FROM nomina_valle WHERE cedula='$empleado'");
				$row_rs_info=mysql_fetch_assoc($rs_info);
		  }
		?>
          <input type="text" id="cargo" value="<?php echo $row_rs_info['cargo'] ?>" readonly="readonly" class="long"/>
          </div></td>
        </tr>
        <tr >
        <td class="bold" colspan=""><strong>Salario</strong></td>
          <td class="cont" colspan="2"><div id="carga_data3">
          <?php
          if(isset($_GET['empleado'])){
				$hda=$_GET['hda'];
				$empleado=$_GET['empleado'];
				//echo $empleado;
				$rs_info=mysql_query("SELECT salario FROM nomina_valle WHERE cedula='$empleado'");
				$row_rs_info=mysql_fetch_assoc($rs_info);
		  }
		?>
          <input type="text" id="salario" value="<?php echo number_format($row_rs_info['salario']) ?>" readonly="readonly" class="long"/>
          </div></td>
        </tr>

  <tr  >
    <th class="bold"><label for="pres_pres">Préstamo</label></th>
    <td class="cont">
      <input type="text" name="pres_pres" id="pres_pres" style="width:100px" onkeyup="verifica_num(this)" required="required" class="cont" /></td>
    <th class="bold"><label for="cuota_pres">Cuotas Quincenales</label></th>
    <td class="cont">
      <input type="text" name="cuota_pres" id="cuota_pres" style="width:100px" onkeyup="verifica_num(this)" required="required" class="cont" /></td>
    </tr>
  <tr >
    <th class="bold"><label for="concep_pres">Comentarios</label></th>
    <td colspan="3" class="cont">
      <textarea name="concep_pres" id="concep_pres" style="height:50px; " class="long"></textarea></td>
    </tr>
  <tr>
    <td colspan="2" align="right"><input type="submit" name="guardar_pres" id="guardar_pres" value="Aceptar" onclick="revisar_prestamos(this);return false" class="ext" style="margin-right:25px"  /></td>
    <td align="left" colspan="2"><input type="button" name="cancelar_pres" id="cancelar_pres" value="Cancelar" onclick="cancelar_prestamo()" class="ext" style="margin-left:25px"  /></td>
    </tr>
</table>
</form>
</div>
<div id="hist_pres">
<?php if(isset($_GET['cedula'])){
	$cedula=$_GET['cedula'];
	$rs_infor=mysql_query("SELECT * FROM nomina_valle WHERE cedula='$cedula'");
	$row_rs_infor=mysql_fetch_assoc($rs_infor);
	$nombre=$row_rs_infor['nombre'];
	$hacienda=$row_rs_infor['hacienda'];
}?>
<table width="90%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr align="center" class="tittle">
    <td colspan="4" class="cont" style="width:44%">
      Sucursal
      <?php if($usuario=='general'){ ?>
      <select  id="hist_hda" class="long" onchange="busc_emples()" >
      <?php if(isset($_GET['cedula'])){
		  ?>
          <option value="<?php echo $hacienda ?>"><?php echo $hacienda ?></option>
          <?php }else{ ?>
          <option value="">Sucursal</option>         
      <?php  
		   } 
		  $rs_hdas=mysql_query("SELECT DISTINCT hacienda FROM d89xz_hacienda WHERE `delete`=0"); 
	  while($row_rs_hdas=mysql_fetch_assoc($rs_hdas)){
		  if($row_rs_hdas['hacienda']!=$hacienda){
	  ?>
      <option value="<?php echo $row_rs_hdas['hacienda'] ?>"><?php echo $row_rs_hdas['hacienda'] ?></option>
      <?php
		  }
	  }
	}else{
	 ?> 
     <input type="text" readonly="readonly" value="<?php echo $usuario ?>" id="hist_hda" class="long" />
     <?php
	}
	 ?>  
          
          
      </select></td>
    <td colspan="4" class="cont" style="width:44%">
    <div id="carga_emple_hist">
    Empleado<?php
		  	if(isset($_GET['hda'])){
				$hda=$_GET['hda'];
				$rs_emples=mysql_query("SELECT * FROM nomina_valle WHERE hacienda='$hda' and `delete`=0");
			}
		  ?>
           <select name="emple2" id="emple2"  onchange="carga_datos2()" required="required" class="long" >
       <option value="">Empleado</option>
       <?php
	   while($row_emples=mysql_fetch_assoc($rs_emples)){
	   ?>
       <option value="<?php echo $row_emples['cedula'] ?>"><?php echo $row_emples['nombre'] ?></option>
       <?php
	   }
	   ?>
       </select>
      </div></td>
    </tr>
  
  </table>
  <div id="rec_tabla_hist">
  <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr align="center" class="tittle">
  
    <td>Fecha</td>
    <td>Factura</td>
    <td>Prestamo</td>
    <td>Concepto</td>
    <td>Cuotas</td>
    <td>Abonos</td>
    <td>Estado</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  if(isset($_GET['emple'])){
	  $emple=$_GET['emple'];
	  $hda=$_GET['hda'];
  $rs_prest=mysql_query("SELECT * FROM nomina_prestamos WHERE hacienda='$hda' and `delete`=0 and cedula='$emple' and idp=0", $conexion)  or die(mysql_error());  
  while($row_rs_prest=mysql_fetch_assoc($rs_prest)){
	  $idp=$row_rs_prest['id'];
	  $rs_abonos=mysql_query("SELECT SUM(abono) as abonos FROM nomina_prestamos WHERE hacienda='$hda' and `delete`=0 and cedula='$emple' and factura='$row_rs_prest[factura]'", $conexion) ;
	  $row_rs_abonos=mysql_fetch_assoc($rs_abonos);
	  if($row_rs_prest['estado']=='Pago') $cuotas=$row_rs_prest['cuotas']-1;
	  else $cuotas=$row_rs_prest['cuotas'];
  ?>
  <tr align="center" style="font-weight:bold; background-color:#CCC; cursor:help"  >    
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo $row_rs_prest['fecha'] ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo $row_rs_prest['factura'] ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo number_format($row_rs_prest['prestamo']) ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php if($row_rs_prest['mercado']==1) echo 'Mercado'; else echo 'Efectivo'?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo $cuotas ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo number_format($row_rs_abonos['abonos'],2) ?></td>
    <td onclick="togliar('<?php echo $idp ?>')"><?php echo $row_rs_prest['estado'] ?></td>
    <td><img src="../img/eye.png" width="20" height="20"  alt="" onclick="verlo('<?php echo $idp ?>')" style="cursor:pointer"/></td>
  </tr>
  
  <?php
  $rs_deta=mysql_query("SELECT * FROM nomina_prestamos WHERE hacienda='$hda' and `delete`=0 and cedula='$emple' and factura='$row_rs_prest[factura]' and idp='$idp' and abono<>'0'", $conexion);
  while($row_rs_deta=mysql_fetch_assoc($rs_deta)){
  ?>
  
  <tr align="center" name="<?php echo $idp ?>" style="display:none" >    
    <td><?php echo $row_rs_deta['fecha'] ?></td>
    <td><?php echo $row_rs_deta['factura'] ?></td>
    <td><?php echo "" ?></td>
    <td><?php if($row_rs_prest['mercado']==1) echo 'Mercado'; else echo 'Efectivo'?></td>
    <td><?php echo "" ?></td>
    <td><?php echo number_format($row_rs_deta['abono'],2) ?></td>
    <td><?php "" ?></td>
    <td>&nbsp;</td>
  </tr>
  <?php
  }
  }
  }
  ?>
</table>
</div>
</div>


<div id="det_pres">
<div id="apDiv2"><input type="image" src="../img/imprimir.png"  width="36" height="35" border="0" style="float:right; margin-right:50px" id="printer" onclick="imprimir_esto('det_pres')" />
		</div>

      <br />
<table width="80%" style="color:#000" align="center" border="1" cellspacing="0" cellpadding="0" class="border">
  <tr  >
    <th colspan="2" rowspan="6" ><img src="../img/Logo.png" width="200" height="90"  alt=""/></th>
    <th class="bold">Sucursal</th>
    <td id="imp_hda" class="cont"><?php echo $row_rs_info['hacienda'] ?></td>
  </tr>
  <tr  >
    <th class="bold">Nombre</th>
    <td id="imp_nom" class="cont"><?php echo $row_rs_info['nombre'] ?></td>
  </tr>
  <tr  >
    <th class="bold">Cédula</th>
    <td id="imp_ced" class="cont"><?php echo $row_rs_info['cedula'] ?></td>
  </tr>
  <tr  >
    <th class="bold"><strong>Cargo</strong></th>
    <td id="imp_cargo" class="cont"><?php echo $row_rs_info['cargo'] ?></td>
  </tr>
  <tr  >
    <th class="bold">Salario </th>
    <td id="imp_sal" class="cont"><?php echo number_format($row_rs_info['salario']) ?>
      <input name="sal_mens_hid" type="hidden" value="<?php echo ($row_rs_info['salario']+$row_rs_info2['transporte']-$row_rs_info2['salud']-$row_rs_info2['pension']) ?>" id="sal_mens_hid2" />
      <input name="sal_mensb_hid" type="hidden" value="<?php echo ($row_rs_info['salario']) ?>" id="sal_mensb_hid2" /></td>
  </tr>
  <tr  >
    <th class="bold">Fecha</th>
    <td id="fecha_pres1" class="cont" >&nbsp;</td>
  </tr>
  <tr  >
    <th class="bold">Prestamo</th>
    <td id="pres_pres1" class="cont">&nbsp;</td>
    <th class="bold">Cuotas Quincenales</th>
    <td id="cuota_pres1" class="cont">&nbsp;</td>
    </tr>
  <tr  >
    <th class="bold">Factura</th>
    <td id="fac_pres1" class="cont">&nbsp;</td>
    <th class="bold">Concepto</th>
    <td id="conc_pres1" class="cont">&nbsp;</td>
  </tr>
  <tr  >
    <th class="bold">Estado</th>
    <td colspan="3" class="cont" id="est_pres1">&nbsp;</td>
    </tr>
  <tr >
    <th class="bold">Comentarios</th>
    <td colspan="3" class="cont"  id="concep_pres1">&nbsp;</td>
      </tr>
  <tr>
    <td colspan="4" align="center"><input type="button" name="volver" id="volver" value="Aceptar" onclick="volver_tabla();return false" class="ext"  /></td>
    </tr>
</table>
</div>
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
<div id="dialog2">

<table width="70%"  align="center" >
  <tr>
  <td colspan="2" align="center">
  Deslice el Carné Para Finalizar la Transacción
  </td>
  </tr>
  <tr>
  <tr>
  <td colspan="2" align="center" class="cont">
  <input type="text" id="carne" value="" class="long" onchange="chao_focus(this)"  />
  </td>
  </tr>
  <tr>
    <td align="right"><input type="button" value="Aceptar" class="ext" style="margin-right:25px" onclick="verif_verif()" /></td>
    <td align="left"><input type="button" value="Cancelar" class="ext" style="margin-left:25px" onclick="cerrar_dialogo()" /></td>

  </tr>
</table>

</div>
<div id="dialog"></div>
</body>
<script>
window.onload=function(){
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	if($("#filtro").attr('type')=='text'){
		var hda=$("#filtro").val()
		$("#cedula, #cargo, #salario").val('');
		$('#carga_noms').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+")  + ' #carga_noms ' );
	}
	if($("#hist_hda").attr('type')=='text'){
		var hda=$("#hist_hda").val()
		$("#cedula, #cargo, #salario").val('');
		$('#carga_emple_hist').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+")  + ' #carga_emple_hist ')
	}
	$("#tb_pres").show()
	$("#hist_pres").hide()
	$("#det_pres").hide('')
}
function carga_datos2(){
	var hda=$("#hist_hda").val()
	var emple=$("#emple2").val()
	$('#rec_tabla_hist').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+") + '&emple=' + emple.replace(/ /g,"+") + ' #rec_tabla_hist ' );
}
function busc_emples(){
	var hda=$("#hist_hda").val()
	$('#carga_emple_hist').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+")  + ' #carga_emple_hist ')
	$('#rec_tabla_hist').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+") + '&emple='  + ' #rec_tabla_hist ' );
}
function revisar_prestamos(){
	if($('#form_pres')[0].checkValidity()){
		mostrar_verif()		
	}else{
		$('#form_pres')[0].find(':submit').click()
		//$('#formInscripcion')[0].submit();
	}	
}
function mostrar_verif(){
	overlay.show();
	$("#carne").val("")
	$("#carne").removeAttr('disabled');
	$("span.ui-dialog-title").text('Información Necesaria').css("text-align", "center"); 
	$("#dialog2").dialog("open");
}
function verif_verif(){
	var ing=$("#carne").val()
	var orig=$("#rfid_emple").val()
	if(ing!=orig){
		error()
	}else{
		guardar_prestamos();	
	}
}
function borrar(){
	$("#carne").val("")
}
function chao_focus(itm){
	itm.blur()
	$("#carne").attr('disabled','disabled');
}
function error(){
	overlay.show();
	$("#dialog").html('El Número de Carné no Coincide con la Información del Empleado').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Error!').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><input type="button" value="Aceptar" class="ext"  onclick="cerrar_dialogo()" /></td></tr></table>');
}

function guardar_prestamos(){
	var valor=$('#pres_pres').val();
	var cuotas=$('#cuota_pres').val();
	var concepto= $('#concep_pres').val();
	var nombre= $('#emple option:selected').text();
	var filtro= $('#filtro').val();
	var cedula=$('#cedula').val()
	$('html,body').css('cursor','wait');
	$.ajax({
		type: "GET",
		url: "stin_nomina_guardar.php",
		data: "guardar_pres="+nombre+"&ced="+cedula+"&valor="+valor+"&cuotas="+cuotas+"&concep="+concepto+'&filtro='+filtro,
		success: function(datos){ 	
			$("#dialog2").dialog("close");
			$("#emple, #cedula, #cargo, #salario, #pres_pres, #cuota_pres, #concep_pres").val('');					
			$("#dialog").html('Registro Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="43" height="31"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog").dialog("open");
			setTimeout(function () {
				$("#dialog").dialog("close");
				$("#prest_sel").val('historial');
				cam_pres();
				$('#hist_pres').load('stin_nomina_prestamos.php?cedula=' + cedula.replace(/ /g,"+")  + ' #hist_pres ', function(response, status, xhr){
					if(status=='success'){
						$('#carga_emple_hist').load('stin_nomina_prestamos.php?hda=' + filtro.replace(/ /g,"+")  + ' #carga_emple_hist ', function(response, status, xhr){
						if(status=='success'){
							$("#emple2").val(cedula);
							$("#cedula, #cargo, #salario, #emple, #pres_pres, #cuota_pres, #concep_pres").val('');
							$('#rec_tabla_hist').load('stin_nomina_prestamos.php?hda=' + filtro.replace(/ /g,"+") + '&emple=' + cedula.replace(/ /g,"+") + ' #rec_tabla_hist ', function(response, status, xhr){  
								$('html,body').css('cursor','default');
							});				
						}
					 });
					}
				});
				
				overlay.hide()
			}, 2000);
		},   
	})
}
function cerrar_dialogo(){
	overlay.hide()
	$("#dialog, #dialog2").dialog("close");
}
function cancelar_prestamo(){
	overlay.show()
	$("#dialog").html('Cancelar Prestamo?').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append('<table><tr><td align="center"><img id="theImg2" src="../img/good.png" width="53" height="41" style="cursor:pointer; margin-right:20px" onclick="cancelar_prestamo2()"/></td><td align="center"><img id="theImg2" src="../img/erase.png" width="53" height="41" style="cursor:pointer;margin-left:20px" onclick="cerrar_dialogo()"/></td></tr></table>');
}
function cancelar_prestamo2(){
	$("#emple, #cedula, #cargo, #salario, #pres_pres, #cuota_pres, #concep_pres").val('');
	$("#dialog").dialog("close");
	overlay.hide()
}
function verifica_num(itm){
	//var id_itm=itm.id;
	var valor=itm.value;
	var itm_id=itm.id;
	if(itm_id!='cuota_pres'){
		while(isNaN(valor)||valor.match(' ')||valor.match(/\,/g)){
			var tamano = valor.length;
			var valor=valor.substring(0,valor.length-1);
			$("#"+itm_id).val(valor);		
		}	
	}else{
		while(isNaN(valor)||valor.match(' ')||valor.match(/\,/g)||/\./.test(valor)||valor.length>=3){
			var tamano = valor.length;
			var valor=valor.substring(0,valor.length-1);
			$("#"+itm_id).val(valor);		
		}
	}
}
function togliar(idp){
	$("[name="+idp+"]").animate({
    height:'toggle' })
}
function recarga_tabla(){
	var hda=$("#filtro").val()
	$("#cedula, #cargo, #salario").val('');
	$('#carga_noms').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+")  + ' #carga_noms ' );	
}
function carga_datos(){
	var hda=$("#filtro").val()
	var emple=$("#emple").val()
	$('#carga_data').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+") + '&empleado=' + emple.replace(/ /g,"+") + ' #carga_data ' );
	$('#carga_data2').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+") + '&empleado=' + emple.replace(/ /g,"+") + ' #carga_data2 ' );
	$('#carga_data3').load('stin_nomina_prestamos.php?hda=' + hda.replace(/ /g,"+") + '&empleado=' + emple.replace(/ /g,"+") + ' #carga_data3 ' );
}
function cam_pres(){
	var valor=$("#prest_sel").val();
	if(valor!='historial'){
		 $("#tb_pres").show('slow')
		 $("#hist_pres").hide('fast')	 
	}
	else	{
		$("#tb_pres").hide('fast')
		$("#hist_pres").show('slow')
	}	
}
function verlo(idp){
	$("#hist_pres").hide('fast')
	$("#prest_sel").hide('fast')
	$("#det_pres").show('slow')	
	$('html,body').css('cursor','wait');
	$.ajax({
		type: "POST",
		url: "stin_nomina_guardar.php",
		dataType: "json",
		data: "revisar_prestamo="+idp,
		success: function(datos){ 
			$.each( datos, function( key, value ) {
  				$("#pres_pres1").html(datos['prestamo']);
				$("#cuota_pres1").html(datos['cuotas']);
				$("#fac_pres1").html(datos['factura']);
				$("#conc_pres1").html(datos['concepto']);
				$("#est_pres1").html(datos['estado']);
				$("#concep_pres1").html(datos['comentarios']);
				$("#imp_hda").html(datos['hda'])
				$("#imp_nom").html(datos['nombre'])
				$("#imp_ced").html(datos['cedula'])
				$("#imp_cargo").html(datos['cargo'])
				$("#fecha_pres1").html(datos['fecha'])
				var sal = numberWithCommas(datos['salario'])
				$("#imp_sal").html(sal)
			});
		$('html,body').css('cursor','default')
		}
	})
}
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         loadCSS: "css/style.css", 
         pageTitle: "",             
         removeInline: false       
	  });
}
function volver_tabla(){
	$("#hist_pres").show('slow')
	$("#det_pres").hide('fast')
	$("#prest_sel").show('slow')
}
$(function() {
	var dialogwidth=400
    $( "#dialog, #dialog2" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 'auto',
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'},	  
	  position: [($(window).width() / 2) - (dialogwidth / 2), 100],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})
function numberWithCommas(n) {
		var parts=n.toString().split(".");
		return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
}
</script>