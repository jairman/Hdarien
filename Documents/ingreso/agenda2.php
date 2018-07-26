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

<title>Historial</title>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
</head>

<body>
<table width="98%" border="0" align="center" cellspacing="0">
  <tr >
    <td width="858" align="left" ><div id="menu">
      <ul >
        <ul>
          <li> <a href="basc_hist2.php" >Historial Colectivo</a> </li>
           <li> <a  href="agenda2.php" class='active' >Historial Individual</a></li>
           
         
        
          </ul>
        </ul>
    </div>     </td>
    <td width="94" align="center" >&nbsp;</td>
    <td width="58" align="left" >&nbsp;</td>
  </tr>
</table>
<div id="main">


<table width="98%">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="98%" align="center" class="tittle" >
 
  <tr align="center" >
    <td width="39%" align="right"   style="font-family: 'Arial Black', Gadget, sans-serif"> <label for="filtro"></label>
    <?php 
	if($usuario=='general'){
		$rs_usus=mysql_query("SELECT  hacienda FROM d89xz_hacienda where `delete` ='0'",$conexion);	
		
	?>
    <select name="filtro" id="filtro" style="float:left; margin-left:15px; width:300px" onchange="recarga_tabla()" class="cont">
       <option value="">Seleccione Sucursal</option>
      <?php 
	  while($row_rs_usus=mysql_fetch_assoc($rs_usus)){
	  ?>
      <option value="<?php  echo $row_rs_usus['hacienda'] ?>"><?php  echo $row_rs_usus['hacienda'] ?></option>
      <?php 
	  }		  
	  ?>
      </select>      
     <?php 
	}else{
	 ?> 
     <input type="hidden" value="<?php  echo $usuario ?>" id="filtro" />
     <?php 
	}
	 ?></td>
    <td width="61%" align="left"   height="60"> 
    Listado De Empleados</td>
    </tr>
    </table>
<div id="recargar">
  <table width="98%" border="1" cellspacing="0" cellpadding="0" style="border-right:none; border-top:none; border-bottom:none; font-size: 12px; font-family: Arial;" id="t_formato">
      <thead>
      
 
    
    
 
    
  <tr align="center" >
<td colspan="5" style="font-family: 'Arial Black', Gadget, sans-serif">&nbsp;</td>
</tr>
<tr align="center" class="tittle">
  <td width="376" style="font-family: 'Arial Black', Gadget, sans-serif">Nombre</td>
  <td width="142" style="font-family: 'Arial Black', Gadget, sans-serif">Cédula</td>
  <td width="158" style="font-family: 'Arial Black', Gadget, sans-serif">Cargo</td>
  <td style="font-family: 'Arial Black', Gadget, sans-serif">Salario</td>
  <th width="145" style="border-right:none; border-top:none; border-bottom:none; margin-left:15px" align="center" >&nbsp;</th>
</tr>
  </thead>
  
     
   
      <?php 
@$filtro = stripslashes(trim($_GET["filtro"]));
$query_lugar = "SELECT DISTINCT lugar_trabajo FROM nomina_valle WHERE hacienda='$filtro' and `delete`=0 ORDER BY lugar_trabajo ASC";
$lugar = mysql_query($query_lugar, $conexion) or die(mysql_error());
$totalRows_lugar = mysql_num_rows($lugar);

?>
   
  <?php 
  while($row_lugar = mysql_fetch_assoc($lugar)){
	  $lugar_tra=$row_lugar['lugar_trabajo'];
  ?>
  <tr align="center" class="bold">
    <td colspan="5" align="left" style="font-family: 'Arial Black', Gadget, sans-serif; border:none" class="row" ><strong><?php  echo $row_lugar['lugar_trabajo'] ?></strong></td>
    </tr>
  <?php  
		  mysql_select_db($database_conexion, $conexion);
		$query_lista = "SELECT * FROM nomina_valle WHERE lugar_trabajo='$lugar_tra' and hacienda='$filtro' and `delete`=0  order by nombre";
		$lista = mysql_query($query_lista, $conexion) or die(mysql_error());
		$totalRows_lista = mysql_num_rows($lista);
  while ($row_lista = mysql_fetch_assoc($lista)){ ?>
  <tr align="center" name="filas" onmouseover="dibujar('<?php  echo $row_lista['id']?>','<?php  echo $row_lista['cedula'] ?>')"  onmouseout= "desdibujar('<?php  echo $row_lista['id']?>','<?php  echo $row_lista['cedula'] ?>')" id="<?php  echo $row_lista['id'] ?>" style="background-image:none; border-right:none" class="row"> 
    <td align="left" style="font-family: Arial"   onclick="mostrar(<?php  echo $row_lista['id']?>)"><?php  echo $row_lista['nombre'] ?></td>
    <td style="font-family: Arial" align="center"  onclick="mostrar(<?php  echo $row_lista['id']?>)"><?php  echo $row_lista['cedula'] ?></td>
    <td style="font-family: Arial" align="center" onclick="mostrar(<?php  echo $row_lista['id']?>)"><?php  echo $row_lista['cargo'] ?></td>
    <td align="center" style="font-family: Arial" onclick="mostrar(<?php  echo $row_lista['id']?>)"><?php  echo @number_format($row_lista['salario']) ?>    </td>
    <td align="center" style="font-family: Arial" onclick="mostrar(<?php  echo $row_lista['cedula']?>)">&nbsp;</td>
     
	
<?php  }  }  ?>
  </td>
  </tr>
  </tbody>
</table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
</div>
<div id="dialog" align="center">
</div>

<?php 
}else{
	?>
    <table width="70%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo2.png" width="918" height="718" /></td>
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
<script>
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
window.onload=function(){
	//recarga_tabla()
	
	
	//formato("t_formato")

};

function recarga_tabla(){
	var filtro=$("#filtro").val();
		$('#recargar').load('agenda2.php?filtro=' + filtro.replace(/ /g,"+") + ' #recargar ' );
				  }
function seguir(){ 
	$("#dialog").dialog("close");
	var filtro=$("#filtro").val();
	var url = 'stin_nomina_planilla.php?filtro='+filtro;
	window.open(url,'Planilla','width=1200,height=600').focus()
}
function cancela(){ 
	$("#dialog").dialog("close");
}


function cerrar_dialogo2(){
	overlay.hide()
	$("#dialog").dialog("close");
}
function dibujar(fila, ced){	
	document.getElementById(fila).style.backgroundColor = "#CCC"; 
	
	document.getElementById(fila).style.color = "#fff"; 
	document.getElementById(fila).style.cursor="pointer";
	document.getElementById(fila).title = 'Ver Detalle';
}
function desdibujar(fila, ced){	
	document.getElementById(fila).style.color = "#000"; 
	 document.getElementById(fila).style.backgroundColor = "#FFF"; 
	 document.getElementById(fila).style.cursor="auto";
	 
}

function mostrar(id){
	
var url = 'basc_hist.php?id=' + id;
	var w = window.open(url,'','width=1270,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	
}
function checkChildWindow(win, onclose) {
    var w = win;
    var cb = onclose;
    var t = setTimeout(function() { checkChildWindow(w, cb); }, 500);
    var closing = false;
    try {
        if (win.closed || win.top == null) //happens when window is closed in FF/Chrome/Safari
        closing = true;        
    } catch (e) { //happens when window is closed in IE        
        closing = true;
    }
    if (closing) {
        clearTimeout(t);
			//$('#seleccion1').load('dia_dia.php' + ' #seleccion1 ' );
			//var ano= $('#ano').val();
		
		overlay.hide();
    }
}
overlay.click(function(){
	window.win.focus()
});



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
</script>
</html>
<?php
@mysql_free_result(@$estado);
@mysql_free_result($lista);
?>
