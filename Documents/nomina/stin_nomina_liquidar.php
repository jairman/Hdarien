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
$id=$_GET['id'];
$filtro=$_GET['filtro'];
mysql_select_db($database_conexion, $conexion);
$query_nomi = "SELECT * FROM nomina_valle WHERE id='$id' and `delete`=0";
$nomi = mysql_query($query_nomi, $conexion) or die(mysql_error());
$row_nomi = mysql_fetch_assoc($nomi);
$totalRows_nomi = mysql_num_rows($nomi);

mysql_select_db($database_conexion, $conexion);
$query_fijos = "SELECT * FROM nomina_fijos_valle WHERE hacienda='$filtro'";
$fijos = mysql_query($query_fijos, $conexion) or die(mysql_error());
$row_fijos = mysql_fetch_assoc($fijos);
$totalRows_fijos = mysql_num_rows($fijos);

$rs_empre=mysql_query("SELECT * FROM d89xz_empresa");
$row_empre=mysql_fetch_assoc($rs_empre);
$hoy= date("Y/m/d"); 
list($ano, $mes, $dia) = explode("/", $hoy);


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
	
});
</script>

<title>Documento sin título</title>
</head>

<body>
<table width="88%" align="center">
  <tr>
    <td align="right"><img src="../img/worker.png" style="cursor:pointer" width="40" height="40" title="Ver  Registro De Asistencia"  
	onclick="mostrarq('<?php echo $id ?>')" /></td>
  </tr>
</table>
<table width="80%" border="1" cellspacing="0" cellpadding="0"  align="center">
  <tr class="tittle">
    <td colspan="6" align="center" >Liquidación de Nómina</td>
  </tr>
  
  <?php $rs_datos=mysql_query("SELECT * FROM nomina_valle WHERE id='$id' and `delete`=0", $conexion);
	$row_rs_datos=mysql_fetch_assoc($rs_datos);
	 ?>
  <tr class="bold">
    <td colspan="2" align="center" class="cont">Nombre</td>
    <td colspan="2" align="center" ><input type="text" value="<?php echo $row_rs_datos['nombre']; ?>" class="long"/></td>
    <td align="center" >Cédula</td>
    <td align="left" ><input type="text" value="<?php echo $row_rs_datos['cedula']; ?>" /></td>
  </tr>
  <tr class="bold">
    <td colspan="2" align="center" class="cont">Teléfono</td>
    <td colspan="2" align="left" ><input type="text" value="<?php echo $row_rs_datos['telefono']; ?>" /></td>
    <td align="center" >Sucursal</td>
    <td align="left" ><input type="text" value="<?php echo $row_rs_datos['hacienda']; ?>" /></td>
  </tr>
  
  <tr align="center" class="stittle">
    <td colspan="3"  >Salario Básico</td>
    <td colspan="2"    >Deducciones</td>
    <td  >&nbsp;</td>
  </tr>
  <tr align="center" class="bold">
    <td  >Díá</td>
    <td  style="border-left:none; border-right:none">Quincena</td>
    <td >Transporte</td>
    <td  >Salud</td>
    <td >Pensión</td>
    <td >Subtotal</td>
  </tr>
  <tr align="center" class="bold cont" height="30">
    <td><input name="lugar_tra" type="hidden" value="<?php echo $row_nomi['lugar_trabajo'] ?>" id="lugar_tra"/>
      <input type="hidden" name="id" id="id" readonly="readonly" value="<?php echo $id ?>"/>
      <input type="hidden" name="cedula" id="cedula" readonly="readonly" value="<?php echo $row_rs_datos['cedula'] ?>"/>
    <input type="hidden" id="filtro" readonly="readonly" value="<?php echo $filtro ?>" style="width:100px"/>
    <input type="text" name="vals"  id="dia" value="<?php echo ($row_nomi['salario']/$row_fijos['dias_mes']) ?>" style="width:70px" onkeyup="checkit(this); totalizar()" onclick="borrar(this); totalizar()" onmouseout="restablecer(this)"  title="En Pesos"  />
    
    </td>
    <td><input type="text" name="vals"  id="quincena" value="<?php echo ($row_nomi['salario']/2) ?>" style="width:70px" onkeyup="checkit(this); totalizar()" onclick="borrar(this); totalizar()" onmouseout="restablecer(this)"  title="En Pesos"  />
      
    </td>
    <td>
    <input type="text" name="vals"  id="transporte" value="<?php echo ($row_fijos['transporte']/2) ?>" style="width:70px" onkeyup="checkit(this); totalizar()" onclick="borrar(this); totalizar()" onmouseout="restablecer(this)"  title="En Pesos"  />
    
    
    </td>
    <td>
    <input type="text" name="vals"  id="salud" value="<?php echo ($row_fijos['salud']) ?>" style="width:70px" onkeyup="checkit(this); totalizar()" onclick="borrar(this); totalizar()" onmouseout="restablecer(this)"  title="En Pesos"  />
    </td>
    <td>
    <input type="text" name="vals"  id="pension" value="<?php echo ($row_fijos['pension']) ?>" style="width:70px" onkeyup="checkit(this); totalizar()" onclick="borrar(this); totalizar()" onmouseout="restablecer(this)"  title="En Pesos"  />
    
    </td>
    <td><input type="text" name="total" id="total" readonly="readonly" value="<?php echo number_format($row_nomi['salario']/2 + $row_fijos['transporte']/2 - $row_fijos['pension'] - $row_fijos['salud']) ?>" alt="<?php echo $row_nomi['salario']/2 + $row_fijos['transporte']/2 - $row_fijos['pension'] - $row_fijos['salud'] ?>" style="width:90px; font-weight:bold" /></td>
  </tr>

  <tr align="center" class="stittle">
    <td colspan="6" >Horas Extras<img src="../img/database.png" width="20" height="20"  alt="" style=" margin-left:15px; cursor:pointer; background-color:" title="Traer Valores de la Base de Datos" onclick="traer()"/></td>
  </tr>
  <tr align="center" class="bold" >
    <td align="center"  >Domingos</td>
    <td class="cont"><input name="" type="hidden" id="hora_extra" value="<?php echo $row_fijos['hora_extra'] ?>" />
    <input name="" type="hidden" id="hora_extra_f" value="<?php echo $row_fijos['hora_extra_f'] ?>" />
    <input name="" type="hidden" id="hora_extra_t" value="<?php echo $row_fijos['hora_extra_t'] ?>" />
    
    
    <input type="text" name="vals" id="hst" value="0" style="width:70px" onkeyup="checkit(this); totalizar()" onclick="borrar(this)" onmouseout="restablecer(this)"  title="En Horas"  /></td>
    <td rowspan="2"  >Festivas</td>
    <td rowspan="2" colspan="2" align="left" class="cont"><input type="text" name="vals" id="hsf" value="0" style="width:70px" onkeyup="checkit(this); totalizar()" onclick="borrar(this)" onmouseout="restablecer(this)"  title="En Horas" /></td>
    <td rowspan="2" class="cont"><input type="text" name="total1" id="total1" readonly="readonly" value="0" style="width:90px; font-weight:bold" alt="0" /></td>
  </tr>
  <tr align="center" class="bold cont" style="" >
    <td  align="center"  style="" >Ordinarias</td>
    <td class="cont"><input type="text" name="vals" id="hs" value="0" style="width:70px" onkeyup="checkit(this); totalizar()" onclick="borrar(this)" onmouseout="restablecer(this)"  title="En Horas" /></td>
  </tr>
  <tr align="center" class="stittle" >
    <td colspan="6" >Festivos</td>
  </tr>
  <tr class="bold cont" style="">
    <td align="center"  style="">&nbsp;</td>
    <td align="center"  style="">&nbsp;</td>
    <td align="center"  style="">Días</td>
    <td align="center"  class="cont"><input name="f_festivo" type="hidden" value="<?php echo $row_fijos['festivo'] ?>" id="f_festivo" />
    <input type="text" name="dias_festivos" id="dias_festivos" value="0" style="width:70px" onkeyup="checkit(this); totalizar() " onclick="borrar(this)" onmouseout="restablecer(this)"  title="En Días"  /></td>
    <td align="center"  style="">&nbsp;</td>
    <td align="center"  style=""><input type="text" name="total2" id="total2" readonly="readonly" value="0" style="width:90px; font-weight:bold" alt="0" /></td>
  </tr>
  
  <tr align="center" class="stittle">
    <td colspan="6" >Otros</td>
  </tr>
  <tr class="bold" style="">
    <td align="center"  >Bonificación</td>
    <td align="center"  class="cont"><input type="text" name="bonificacion" id="bonificacion" value="0" style="width:70px" onclick="borrar(this)"onmouseout="restablecer(this)" onkeyup="checkit(this); totalizar()"  title="En Pesos"  /></td>
    <td align="center"  class="cont">Viajes</td>
    <td align="center"  class="cont"><input type="text" name="viajes" id="viajes" value="0" style="width:70px" onclick="borrar(this)"onmouseout="restablecer(this)" onkeyup="checkit(this); totalizar()"  title="En Pesos"  /></td>
    <td align="center"  class="cont">&nbsp;</td>
    <td align="center"  class="cont"><input type="text" name="total3" id="total3" value="0" style="width:90px; font-weight:bold " readonly="readonly" alt="0" /></td>
  </tr>

  <tr align="center" class="stittle">
    <td colspan="3" style="color: #FFF">Descuentos</td>
    <td style="color: #FFF" colspan="3">TOTAL PAGADO</td>
  </tr>
  <tr class="bold cont" style="">
    <td style=""  align="center">Prestamos</td>
  <?php
  $rs_lug=mysql_query("SELECT factura FROM nomina_prestamos WHERE estado='Pendiente' and cedula='$row_nomi[cedula]' and mercado='0' and hacienda='$filtro' ",$conexion);
  $cuota[0]=0;
  $title[0]='';
  $i=0;
  echo "hola".$rs_lug;
   if(mysql_num_rows($rs_lug)>0){
  		while($row_lug=mysql_fetch_assoc($rs_lug)){
		  $factura=$row_lug['factura'];
		  //valor del prestamo y numero de cuotas
  		  $rs_prest=mysql_query("SELECT  prestamo, cuotas, fecha  FROM nomina_prestamos WHERE estado='Pendiente' and cedula='$row_nomi[cedula]' and factura='$factura' and mercado='0' and hacienda='$filtro'",$conexion); 	  
		  $row_rs_prest=mysql_fetch_assoc($rs_prest);
		  //numero de abonos
		  $rs_num_ab=mysql_query("SELECT  abono FROM  nomina_prestamos WHERE cedula='$row_nomi[cedula]' and factura='$factura' and abono<>'' and mercado='0' and hacienda='$filtro' ",$conexion);   
		  //total en abonos  
		  $rs_cuota=mysql_query("SELECT SUM(abono) as abonos FROM nomina_prestamos WHERE cedula='$row_nomi[cedula]' and factura='$factura' and mercado='0' and hacienda='$filtro' ",$conexion);
		  $row_rs_cuota=mysql_fetch_assoc($rs_cuota);
		  //mira si es la ultima cuota
		  if($row_rs_prest['cuotas']-mysql_num_rows($rs_num_ab)==1){
			  $cuota[$i]=$row_rs_prest['prestamo']-$row_rs_cuota['abonos'];		 
		 }else{
		  	@$cuota[$i]=($row_rs_prest['prestamo']-$row_rs_cuota['abonos'])/@($row_rs_prest['cuotas']-mysql_num_rows($rs_num_ab))	;
		 }
		  $title[$i]='Prestamo Realizado en '.$row_rs_prest['fecha'].', Total Del Prestamo ' .number_format($row_rs_prest['prestamo']).' Pesos, Cuota Número '.(mysql_num_rows($rs_num_ab)+1).' de '.$row_rs_prest['cuotas'].', Abono de '. number_format($cuota[$i]).' Pesos, Saldo '.number_format($row_rs_prest['prestamo']-$row_rs_cuota['abonos']).' Pesos, Factura Número '.$factura;
//echo $title[$i];
		  $i=$i+1;
	  
  }
  }
  $tama=sizeof($title);
  $cuota_t= ceil(array_sum($cuota));
  ?>
    <td colspan="2" class="cont"><input type="text" name="vals" id="prestamos" value="<?php echo $cuota_t ?>" style="width:70px" onclick="borrar(this)"onmouseout="restablecer(this)" onkeyup="checkit(this); totalizar()"  alt="<?php echo $cuota_t ?>" title="<?php for($j=0;$j<$tama;$j++){ echo $title[$j].PHP_EOL; } ?>"  /></td>
    <td rowspan="3" colspan="3" align="center" class="cont"><input type="text" name="total4" id="total4"  style="width:80%; font-weight:bold; text-align:center" readonly="readonly" alt="" /></td>
   
  </tr>
  <tr class="bold cont" style="">
    <td style=";"  align="center"><span style="display:none">Mercado</span></td>
    
    
    <?php
  $rs_lug=mysql_query("SELECT factura FROM nomina_prestamos WHERE estado='Pendiente' and cedula='$row_nomi[cedula]' and mercado='1' and hacienda='$filtro' ",$conexion);
  unset($cuota); unset($title);
  $cuota[0]=0;
  $title[0]='';
  $i=0;
   if(mysql_num_rows($rs_lug)>0){
  		while($row_lug=mysql_fetch_assoc($rs_lug)){
		  $factura=$row_lug['factura'];
		  //valor del prestamo y numero de cuotas
  		  $rs_prest=mysql_query("SELECT  prestamo, cuotas, fecha  FROM nomina_prestamos WHERE estado='Pendiente' and cedula='$row_nomi[cedula]' and factura='$factura' and  mercado='1' and hacienda='$filtro'  ",$conexion); 	  
		  $row_rs_prest=mysql_fetch_assoc($rs_prest);
		  //numero de abonos
		  $rs_num_ab=mysql_query("SELECT  abono FROM  nomina_prestamos WHERE cedula='$row_nomi[cedula]' and factura='$factura' and abono<>'' and mercado='1' and hacienda='$filtro'",$conexion);   
		  //total en abonos  
		  $rs_cuota=mysql_query("SELECT SUM(abono) as abonos FROM nomina_prestamos WHERE cedula='$row_nomi[cedula]' and factura='$factura' and mercado='1' and hacienda='$filtro'",$conexion);
		  $row_rs_cuota=mysql_fetch_assoc($rs_cuota);
		  //mira si es la ultima cuota
		  if($row_rs_prest['cuotas']-mysql_num_rows($rs_num_ab)==1){
			  $cuota[$i]=$row_rs_prest['prestamo']-$row_rs_cuota['abonos'];		 
		 }else{
		  	@$cuota[$i]=($row_rs_prest['prestamo']-$row_rs_cuota['abonos'])/@($row_rs_prest['cuotas']-mysql_num_rows($rs_num_ab))	;
		 }
		  $title[$i]='Prestamo Realizado en '.$row_rs_prest['fecha'].', Total Del Prestamo ' .number_format($row_rs_prest['prestamo']).' Pesos, Cuota Número '.(mysql_num_rows($rs_num_ab)+1).' de '.$row_rs_prest['cuotas'].', Abono de '. number_format($cuota[$i]).' Pesos, Saldo '.number_format($row_rs_prest['prestamo']-$row_rs_cuota['abonos']).' Pesos, Factura Número '.$factura;
//echo $title[$i];
		  $i=$i+1;
	  
  }
  }
  $tama=sizeof($title);
  $cuota_t= ceil(array_sum($cuota));
  ?>
    <td colspan="2"><input type="text" name="vals" id="mercado" value="<?php echo $cuota_t ?>" style="width:70px; display:none" onclick="borrar(this)"onmouseout="restablecer(this)" onkeyup="checkit(this); totalizar()"  alt="<?php echo $cuota_t ?>" title="<?php for($j=0;$j<$tama;$j++){ echo $title[$j].PHP_EOL; } ?>"  /></td>
  </tr>
  <tr class="bold cont" style="">
    <td  style="" align="center">Días</td>
    <td colspan="2" class="cont"><input type="text" name="vals" id="d_dcto" value="0" style="width:70px" onclick="borrar(this)"onmouseout="restablecer(this)" onkeyup="checkit(this); totalizar()"   title="En Días"/></td>
  </tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="" align="center">
  <tr>
    <td align="right"><input type="submit" name="Enviar" id="enviar" value="Aceptar" align="middle" onclick="enviar()" class="ext" style="margin-right:15px"/></td>
    <td align="left"><input type="button" name="Enviar" id="cancela_li" value="Cancelar" align="middle"  onClick="window.close();"   class="ext" style="margin-left:15px"/></td>
  </tr>
</table>
 
<div id="dialog2" >
</div>
<div id="dialog" >
<select name="fecha1" id="fecha1" style="display:inline; width:90px" >
  <option value="ano" selected="selected">Año</option>
            <?php for($i=$ano+1;$i>=2010;$i--){ ?>
              <option value="<?php echo $i; ?>" ><?php echo $i ?></option>
              <?php } ?>
            </select>
</select>
<select name="fecha2" id="fecha2" disabled="disabled" style="width:130px" >
  <option value="mes" selected="selected">Mes</option>
  <option value="1" >Enero</option>
  <option value="2">Febrero</option>
  <option value="3">Marzo</option>
  <option value="4">Abril</option>
  <option value="5">Mayo</option>
  <option value="6">Junio</option>
  <option value="7">Julio</option>
  <option value="8">Agosto</option>
  <option value="9">Septiembre</option>
  <option value="10">Octubre</option>
  <option value="11">Noviembre</option>
  <option value="12">Diciembre</option>  
</select>
<select name="fecha3" id="fecha3" disabled="disabled" style="width:110px" >
  <option value="quincena" selected="selected">Quincena</option>
  <option value="1" >1</option>
  <option value="2">2</option>
    
</select><img id="imagen" src="../img/good.png" width="38" height="26" style="display:none; cursor: pointer; float:right; margin-right:15px" onclick="traer2()" title="Click Aquí Para Enviar"/></div>
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
window.onload=function(){
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	totalizar()
}
function traer(){
	overlay.show();
	$("span.ui-dialog-title").text('Valores de Base de Datos'); 
	$( "#dialog" ).dialog('open');
}
function traer2(){
	var ano = $("#fecha1").val();
	var mes = $("#fecha2").val();
	var qui = $("#fecha3").val();
	var cedula = $("#cedula").val()
	var filtro= $('#filtro').val(); 
	$.ajax({
        type: "GET",
        url: "stin_nomina_guardar.php",
        data: "traer="+filtro+"&ced="+cedula+ '&ano=' + ano + '&mes=' + mes + '&qui=' + qui,
        success: function(datos){
			var ord=datos.split("*")[0];
			var ext=datos.split("*")[1];
       			$("#hs").val(ext);
			//$("#hst").val(ext);
			totalizar();
			$( "#dialog" ).dialog('close');
      }
	})
	
}
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
$('#fecha3').change(function(){ 
	var fecha3= $('#fecha3').val();
	if(fecha3!="quincena"){
		$('#imagen').show()
	} else {
		$('#imagen').hide()
		}
})



function totalizar(){
	$("[name=vals]").each(function(index, element) {
        if(element.value==''){
			$('#'+element.id).val(0);
		}
		if(element.value[0]==0&&element.value.length>1){
			$('#'+element.id).val(element.value.substring(1));
		}
    });
	var quincena=parseInt($('#quincena').val())
	var transporte=parseInt($('#transporte').val())
	var salud=parseInt($('#salud').val())
	var pension=parseInt($('#pension').val())
	var hora_extra=parseInt($('#hora_extra').val())
	var hs=parseInt($('#hs').val())
	var hora_extra_t=parseInt($('#hora_extra_t').val())
	var hst=parseInt($('#hst').val())
	var hora_extra_f=parseInt($('#hora_extra_f').val())
	var hsf=parseInt($('#hsf').val())
	var f_festivos=parseInt($('#f_festivo').val())
	var festivo=parseInt($('#dias_festivos').val())
	var bonificacion=parseInt($('#bonificacion').val())
	var viajes=parseInt($('#viajes').val())
	var prestamos=parseInt($('#prestamos').val())
	var mercado=parseInt($('#mercado').val())
	var dia=parseInt($('#dia').val())
	var d_dcto=parseInt($('#d_dcto').val())
	var total=parseInt(quincena+transporte-salud-pension);
	var total1=parseInt(hora_extra_t*hst+hora_extra_f*hsf+hora_extra*hs)
	var total2=parseInt(f_festivos*festivo);
	var total3=parseInt(bonificacion+viajes)
	var total4=parseInt(total+total1+total2+total3-prestamos-mercado-dia*d_dcto)
	$('#total').val(numberWithCommas(total))
	$('#total1').val(numberWithCommas(total1))
	$('#total2').val(numberWithCommas(total2))
	$('#total3').val(numberWithCommas(total3))
	$('#total4').val(numberWithCommas(total4))

}
function checkit(itm){
	//var id_itm=itm.id;
	var valor=itm.value;
	var itm_id=itm.id;
	//entero	
		while(isNaN(valor)||valor.match(' ')||valor.match(/\,/g)){
			var tamano = valor.length;
			var valor=valor.substring(0,valor.length-1);
			$("#"+itm_id).val(valor);		
		}	
}

function enviar(){
	$('#enviar').hide("slow");
	$('#cancela_li').hide("slow");
	var filtro= $('#filtro').val();
	var id= $('#id').val();
	var dia=$('#dia').val()
	var quincena=$('#quincena').val()
	var transporte=$('#transporte').val()
	var salud=$('#salud').val()
	var pension=$('#pension').val()
	var total=$('#total').val().replace(/,/g, "")
	var hora_extra=$('#hora_extra').val()
	var hs=$('#hs').val()
	var hst=$('#hst').val()
	var hsf=$('#hsf').val()
	var total1=$('#total1').val().replace(/,/g, "")
	var festivo=$('#dias_festivos').val()
	var total2=$('#total2').val().replace(/,/g, "");
	var bonificacion=$('#bonificacion').val()
	var viajes=$('#viajes').val()
	var total3=$('#total3').val().replace(/,/g, "");
	var prestamos=$('#prestamos').val()
	var mercado=$('#mercado').val()
	var d_dcto=$('#d_dcto').val()
	var total4=$('#total4').val().replace(/,/g, "");	
	var lugar_tra= $('#lugar_tra').val();
	var cedula = $("#cedula").val()
	
	$.ajax({
        type: "GET",
        url: "stin_nomina_guardar.php",
        data: "liquidar="+filtro+"&id="+id+ '&dia=' + dia + '&quincena=' + quincena + '&transporte=' + transporte + '&salud=' + salud + '&pension=' + pension + '&total=' + total + '&hst=' + hst + '&hsf=' + hsf + '&hs=' + hs +  '&total1=' + total1 + '&festivos=' + festivo + '&total2=' + total2 + '&bonificacion=' + bonificacion + '&viajes=' + viajes + '&total3=' + total3 + '&prestamo=' + prestamos  + '&d_dcto=' + d_dcto + '&total4=' + total4   + '&lugar_tra=' + lugar_tra + '&cedula=' + cedula + '&mercado=' + mercado ,
        success: function(html){
       		mostrar(html, "reg", "fin")
			
      }
});
	
}

function restablecer(ele){
	if(document.getElementById(ele.id).value=="")
	document.getElementById(ele.id).value=0
	document.getElementById(ele.id).onkeyup;
}
function borrar(ele){
	if(document.getElementById(ele.id).value==0)
	document.getElementById(ele.id).value=""
}
//funciones predefinidas
	function numberWithCommas(n) {
		var parts=n.toString().split(".");
		return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
	}

var dialogwidth=450
$(function() {
    $( "#dialog2" ).dialog({
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
function mostrar(html, tipo, datos){
	overlay.show()
	$("#dialog2").html(html);
	$("span.ui-dialog-title").text('Información de Liquidación'); 
	if(html=="La Liquidación Fué Anteriormente Generada"){
	$("#dialog2").prepend('<img id="theImg" src="../img/warning.png" width="53" height="41"/>')
	
	} else {
	$("#dialog2").prepend('<img id="theImg2" src="../img/good.png" width="53" height="41"/>')
	}
	
    $( "#dialog2" ).dialog('open');
	   setTimeout(function () {	
	   		window.opener.recarga_tabla();		   			   
			window.close();		 
		}, 3000);	   
}

$(function() {
	var dialogwidth=450
    $( "#dialog" ).dialog({
      autoOpen: false,
	  width: dialogwidth,
	  height: 120,
	  show: {effect: 'explode'},
	  hide: {effect: 'explode'}, 
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function(){ overlay.hide() } 	     
    });
})

function mostrarq(id){
	
	
	var url = '../ingreso/basc_hist.php?id='+id ;
	
	Shadowbox.open({
     content: url,
     player: "iframe",
     
     options: {                   
          initialHeight: 1,
          initialWidth: 1,
          modal: true		  
    }})
}


</script>
<?php
mysql_free_result($nomi);

mysql_free_result($fijos);
?>
