<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php
if($acceso==0){
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
$filtro=$_GET['filtro'];
if (isset($_GET['id'])){
	$id=$_GET['id'];
	$query_liqui = "SELECT * FROM nomina_liquidar WHERE id='$id' and estado='planilla' and `delete`=0";
} else {
$id=$_GET['id_mira'];
$query_liqui = "SELECT * FROM nomina_liquidar WHERE id_nomina='$id' and estado='ok' and `delete`=0";

}
$rs_empre=mysql_query("SELECT * FROM d89xz_empresa");
$row_empre=mysql_fetch_assoc($rs_empre);
$liqui = mysql_query($query_liqui, $conexion) or die(mysql_error());

$totalRows_liqui = mysql_num_rows($liqui);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../js/printThis.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="../css/clean.css" />
<link rel="stylesheet" href="css/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body style="font-size:13px !important">
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
<?php
$row_liqui=mysql_fetch_assoc($liqui);
?>

<div id="primir">
  <?php
$pieces = explode("-", $row_liqui['fecha']);
$id=$row_liqui['id_nomina'];
$ano= $pieces[0]; 
$mes= $pieces[1];
$quincena= $pieces[2];
?>
  
  
  
  <table width="80%" border="1" cellspacing="0" cellpadding="0"  align="center" >
  <tr >
    <td rowspan="4" align="left"  >&nbsp;</td>
  </td>
   <td><?php
if (!isset($_GET['id'])){
?>
<img src="../img/recycler.png" width="30" height="30"  alt="" style="float:right; margin-right:20px; cursor:pointer"  name="eliminar" onclick="eliminar_liqui(<?php echo $id ?>)" title="Eliminar Liquidación" id="eliminar"/>
<?php }else{ ?>

<div id="apDiv2">
<input type="image" src="../img/imprimir.png"  width="36" height="35" border="0" style="float:right; margin-right:25px" id="printer" onclick="imprimir_esto('primir')" />
		</div>
        <?php } ?></td> 
   </tr>
   </table>
   <table width="80%" border="1" cellspacing="0" cellpadding="0"  align="center" >
   <tr class="tittle">
     
    <td align="center" >Liquidación de Planilla</td>
    </tr>
    </table>
<table width="80%" border="1" cellspacing="0" cellpadding="0"  align="center" >
  <?php $rs_datos=mysql_query("SELECT * FROM nomina_valle WHERE id='$id' and `delete`=0", $conexion);
	$row_rs_datos=mysql_fetch_assoc($rs_datos);
	 ?>
   <tr class="bold">
     <td colspan="2" rowspan="2" align="center" style="background-color:#FFF"><img src="../img/Logo_out.png" width="200" height="90"  alt="" style="margin-left:30px"/></td>
     <td align="center" class="cont">Empresa</td>
     <td colspan="2" align="center" ><input type="text" value="<?php echo $row_empre['empresa'] ?>" readonly="readonly" /></td>
     <td align="center" >NIT</td>
     <td align="left" ><input type="text" value="<?php echo $row_empre['nit'] ?>" readonly="readonly"/></td>
   </tr>
   <tr class="bold">
     <td align="center" class="cont">Teléfono</td>
     <td colspan="2" align="center" ><input type="text" value="<?php echo $row_empre['telefono'] ?>" readonly="readonly"/></td>
     <td align="center" ><?php
if (isset($_GET['id'])){
	
?>Fecha Planilla<?php } ?></td>
     <td align="left" ><?php
if (isset($_GET['id'])){
	
?><input type="text" value="<?php echo 'Quincena '.$quincena.' /'.$mes.' /'.$ano; ?>" readonly="readonly"/><?php } ?></td>
   </tr>
   </table>
   <table width="80%" border="1" cellspacing="0" cellpadding="0"  align="center" >
   <tr class="bold">
     <td align="center" class="cont">Nombre</td>
     <td colspan="3" align="center" class="cont"><input type="text" value="<?php echo $row_rs_datos['nombre']; ?>" class="long" readonly="readonly"/></td>
     <td colspan="2" align="center" ><span class="cont">Cédula</span></td>
    <td colspan="2" align="center" ><input type="text" value="<?php echo $row_rs_datos['cedula']; ?>" readonly="readonly"/></td>
    </tr>
  <tr class="bold">
    <td align="center" class="cont">Teléfono</td>
    <td colspan="3" align="center" class="cont"><input type="text" value="<?php echo $row_rs_datos['telefono']; ?>" readonly="readonly"/></td>
    <td colspan="2" align="center" ><span class="cont">Sucursal</span></td>
    <td colspan="2" align="center" ><input type="text" value="<?php echo $row_rs_datos['hacienda']; ?>" readonly="readonly"/></td>
    </tr> 
 </table>  
 <table width="80%" border="1" cellspacing="0" cellpadding="0"  align="center" >
  <tr align="center" class="tittle3" >
    <td colspan="3"  ><strong>Salario Básico</strong></td>
    <td colspan="4"   ><strong>Deducciones</strong></td>
    <td >&nbsp;</td>
  </tr>
  <tr align="center" class="bold" >
    <td  style="border-right:none"  ><strong>Díá</strong></td>
    <td  style="border-right:none; border-left:none" ><strong>Quincena</strong></td>
    <td  style="border-left:none" ><strong>Transporte</strong></td>
    <td colspan="3"  style="border-right:none" ><strong>Salud</strong></td>
    
    <td  style="border-left:none" ><strong>Pensión</strong></td>
    <td   ><strong>Total</strong></td>
  </tr>
  <tr align="center" class="bold">
    <td ><input type="text" name="dia" id="dia" readonly="readonly" value="<?php echo number_format($row_liqui['dia']) ?>"  style="width:80px; text-align:center" /></td>
    <td ><input type="text" name="quincena" id="quincena" readonly="readonly" value="<?php echo number_format($row_liqui['quincena']) ?>" style="width:80px; text-align:center"  /></td>
    <td ><input type="text" name="transporte" id="transporte" readonly="readonly" value="<?php echo number_format($row_liqui['transporte']) ?>" style="width:80px; text-align:center"  /></td>
    <td colspan="3" ><input type="text" name="salud" id="salud" readonly="readonly" value="<?php echo number_format($row_liqui['salud']) ?>" style="width:80px; text-align:center"  /></td>
    
    <td ><input type="text" name="pension" id="pension" readonly="readonly" value="<?php echo number_format($row_liqui['pension']) ?>" style="width:80px; text-align:center"  /></td>
    <td ><input type="text" name="total" id="total" readonly="readonly" value="<?php echo number_format($row_liqui['total']) ?>" style="width:90px; text-align:center; font-weight:bold" /></td>
  </tr>

  <tr align="center" class="tittle3">
    <td colspan="8" >Horas Extras</td>
  </tr>
  <tr align="center" class="bold" style="border:none;">
    <td align="center"  style="border:none"><strong>Temporal</strong></td>
    <td><input type="text" name="hst" id="hst" value="<?php echo $row_liqui['hst'] ?>" style="width:90px; text-align:center" readonly="readonly" /></td>
    <td rowspan="2"  style="border:none"><strong>Festiva</strong></td>
    <td rowspan="2" colspan="4" align="left"><input type="text" name="hsf" id="hsf" value="<?php echo $row_liqui['hsf'] ?>" style="width:90px; text-align:center" readonly="readonly" /></td>
    <td rowspan="2"><input type="text" name="total1" id="total1" readonly="readonly" value="<?php echo number_format($row_liqui['total1']) ?>" style="width:90px; text-align:center; font-weight:bold"  /></td>
  </tr>
 
  <tr align="center" class="bold" style="border:none">
    <td align="center"  style="border:none"><strong>Diurnas</strong></td>
    <td align="center"><input type="text" name="hs" id="hs" value="<?php echo $row_liqui['hs'] ?>" style="width:90px; text-align:center" readonly="readonly" /></td>
    </tr>
  <tr align="center" class="tittle3"  >
    <td colspan="8"  >Festivos</td>
  </tr>
  <tr class="bold" style="border:none">
    <td colspan="2" align="center"  style="border:none" ><strong>Días</strong></td>
    <td colspan="5" align="left" style="border:none"><input type="text" name="festivos" id="festivos" value="<?php echo $row_liqui['dia_festivo'] ?>" style="width:90px; text-align:center" readonly="readonly" /></td>
    <td align="center"><input type="text" name="total2" id="total2" readonly="readonly" value="<?php echo number_format($row_liqui['total2']) ?>" style="width:90px; text-align:center; font-weight:bold" alt="0" /></td>
  </tr>
  <tr align="center" class="tittle3"  >
    <td colspan="8"  >Otros</td>
  </tr>
  <tr class="bold" style="border:none">
    <td colspan="2" align="center"  style="border:none"><strong>Bonificación</strong></td>
    <td colspan="5" align="left"><input type="text" name="bonificacion" id="bonificacion" value="<?php echo number_format($row_liqui['bonificacion']) ?>" style="width:90px; text-align:center" readonly="readonly" /></td>
    <td rowspan="2" align="center"><input type="text" name="total3" id="total3" value="<?php echo number_format($row_liqui['total3']) ?>" style="width:90px; text-align:center; font-weight:bold" readonly="readonly" /></td>
  </tr>
  <tr class="bold" style="border:none">
    <td colspan="2" align="center"  style="border:none"><strong>Viajes</strong></td>
    <td colspan="5" align="left"><input type="text" name="viajes" id="viajes" value="<?php echo number_format($row_liqui['viajes']) ?>" style="width:90px; text-align:center" readonly="readonly" /></td>
  </tr>

  <tr align="center" class="tittle3"   >
    <td colspan="3" >Descuentos</td>
    <td  colspan="5">TOTAL PAGADO</td>
  </tr>
  <tr align="center" class="bold" style="border:none" >
    <td>Prestamos</td>
    <td colspan="2"><input type="text" name="prestamos" id="prestamos" value="<?php echo number_format($row_liqui['prestamos']) ?>" style="width:90px; text-align:center" readonly="readonly" /></td>
    <td rowspan="3" colspan="5" ><input type="text" name="total4" id="total4" value="<?php echo number_format($row_liqui['total4']) ?>" style="width:80%; font-weight:bold; text-align:center" readonly="readonly"   /></td>
   
  </tr>
  <tr align="center" class="bold" style="border:none" >
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr align="center" class="bold" style="border:none" >
    <td>Días</td>
    <td colspan="2"><input type="text" name="prestamos2" id="prestamos2" value="<?php echo number_format($row_liqui['d_dcto']) ?>" style="width:90px; text-align:center" readonly="readonly" /></td>
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
<div id="dialog"></div>
</body>
</html>
<script>
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');

function eliminar_liqui(idn){
	overlay.show()
	$("#eliminar").hide()
	$("#dialog").html('Eliminar Liquidación?').css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="43" height="31"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('<br />')
	$("#dialog").append("<br>");	
	$("#dialog").append('<table><tr><td align="center"><img id="theImg2" src="../img/good.png" width="53" height="41" style="cursor:pointer; margin-right:20px"onclick="eliminar2(\''+idn+'\')"/></td><td align="center"><img id="theImg2" src="../img/erase.png" width="53" height="41" style="cursor:pointer;margin-left:20px" onclick="cerrar_dialogo2()"/></td></tr></table>');
}
function eliminar2(idn){
	$("#dialog").dialog("close");
	$.ajax({
        type: "GET",
        url: "stin_nomina_guardar.php",
        data: "eliminar_liqui="+idn,
        success: function(datos){
			console.log(datos)
			$("#dialog").html('&nbsp;&nbsp;&nbsp;Borrado Exitoso').css('text-align','center');
			$("#dialog").prepend('<img id="theImg2" src="../img/good.png" width="43" height="31"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog").dialog("open");
			
			setTimeout(function () {
			   $("#dialog").dialog("close");
			   window.parent.Shadowbox.close();
			   overlay.hide()
			}, 2000);
      }
	  
	})
}

function cerrar_dialogo2(){
	overlay.hide()
	$("#eliminar").show("slow")
	$("#dialog").dialog("close");
}
function imprSelec(nombre){
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
  }
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
	  close: function() { overlay.hide(); $("#eliminar").show("slow")  }, 	     
    });
})
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
} 
</script>
<?php
mysql_free_result($liqui);
?>

