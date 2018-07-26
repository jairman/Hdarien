<?php require_once('joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); 
 
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kardex Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
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
<div id="tabla">
<p>

</p>
<table width="98%" align="center">
  <tr>
    <td align="right"><p class="s"> 
             <input name="search" id="search" type="search"  autocomplete="off" >
     </p></td>
<td width="6%" align="center"><img src="../../img/addpersonas.png" width="40" height="40" title="Agregar Nuevo" style="cursor:pointer"  onclick="agregar()"  /></td>
<td width="4%" align="center"><img src="../../img/Excell_Up.png" alt="" width="40" height="40" style="cursor:pointer" title="Agregar Excel"  onclick="agregar_excel()"  /></td>
    <td width="6%" align="center"><img  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0"  style="cursor:pointer" onclick="imprimir_esto('registros')"/></td>
  </tr>
</table>


 
   <?php
	mysql_select_db($database_conexion, $conexion);
	$query_kar = "SELECT * FROM d89xz_clientes where  `delete` !='1'  order by  nombre  ";
	$kar = mysql_query($query_kar, $conexion) or die(mysql_error());
	$row_kar = mysql_fetch_assoc($kar);
	$totalRows_kar = mysql_num_rows($kar);
?>
<div id='registros' >
<table width="98%" border="1" align="center">
<tr>
<td align="center" class="tittle">Listado de Clientes</td>
</tr>
</table>
<table width="98%" border="1" align="center" cellspacing="0">
 
  <tr align="center" class="tittle"  >
    <td width="10%" onClick="orden_bus('cedula')" style="cursor:pointer" title="Ordenar por NIT">NIT</td>
    <td width="24%" onClick="orden_bus('nombre')" style="cursor:pointer" title="Ordenar por Nombre">Nombre</td>
    <td width="8%" onClick="orden_bus('telefono')" style="cursor:pointer" title="Ordenar por Teléfono">Teléfono</td>
    <td width="10%" onClick="orden_bus('cel')" style="cursor:pointer" title="Ordenar por Celularl">Celular</td>
    <td width="9%" onClick="orden_bus('categoria')" style="cursor:pointer" title="Ordenar por Categoría
    ">Cumpleaños</td>
<td width="10%" onClick="orden_bus('ciudad')" style="cursor:pointer" title="Ordenar por Ciudad">Ciudad</td>
    <td width="25%" onClick="orden_bus('ciudad')" style="cursor:pointer" title="Ordenar por Ciudad">Email</td>
    <td colspan="3" >&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr class="row" title="Ver Detalle">
      <td align="right"  onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php echo $row_kar['cedula']; ?></td>
      <td align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php echo $row_kar['nombre']; ?></td>
      <td align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php echo $row_kar['telefono']; ?></td>
      <td align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php echo $row_kar['cel']; ?></td>
      <td align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php echo $row_kar['cumple']; ?></td>
<td align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');" ><?php echo $row_kar['ciudad']; ?></td>
      <td align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');" ><?php echo $row_kar['mail']; ?></td>
      <td width="2%" align="center" onClick="mostrar1('<?php echo $row_kar['id'];  ?>');">
     	<input name="imgb" type="image" src="../../img/edit.png" width="20" height="20"  style="cursor:pointer"
         title="Editar">
      
      </td>
   <?php if ($auto!=0){ ?>
   
        <td width="2%" align="center" onClick="eliminar('<?php echo $row_kar['id'];  ?>');">
        <input name="imgb" type="image" src="../../img/erase.png" width="20" height="20"  style="cursor:pointer"
          title="Eliminar"></td>
         
   <?php } ?>  
         
      <td width="0%" align="center">&nbsp;</td>
    </tr>
    <?php } while ($row_kar = mysql_fetch_assoc($kar)); ?>
    
   </table>
    
    
     
    
  </div>

</div>
</body>
<div id="dialog2">
</div>
<script>
$(document).ready(function(){
	$(function() {
		var dialogwidth=400
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
$("#search").keyup(function(e){
	if(e.keyCode==13){
	var searchbox = $(this).val();
	search_ins(searchbox,"nombre","ASC")
	}
})	







	
});
<!-- necesario para los cuadros de dialogo-->
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
overlay.click(function(){
	window.win.focus()
});

Shadowbox.init({
handleOversize: "drag",
modal: true,
onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},

onClose: function(){
		$('#seleccion1').load('kardex.php' + ' #seleccion1 ' );
				  }

});

/*function agregar(){
	
		var url = 'Clientes.php' ;
	Shadowbox.open({
		 content: url,
		 player: "iframe",
		 options: {                   
			  initialHeight: 1,
			  initialWidth: 1,
			  modal: true
		 }
	});	
}*/

function agregar(){
	var url = 'Clientes.php';
	var w = window.open(url,'','width=1270,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);	
}


function mostrar(id){
	var url = 'verClientes.php?id=' +  id;
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    	w.resizeTo(screen.width,screen.height);
	 }
	 
function mostrar1(id){
	var url = 'EditClientes.php?id=' +  id;
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    	w.resizeTo(screen.width,screen.height);
	 }
	 
	 




	function agregar_excel(){
		var url = '../../registro/excel.php';
		var w = window.open(url,'','width=1280,height=640,dependent=yes')
		window.win=w;
		overlay.show();
		checkChildWindow(w, function() {  } );
		w.moveTo(0,0);
				w.resizeTo(screen.width,screen.height);
}

function eliminar(idn){
	//alert(idn)
	overlay.show()
	$("#dialog2").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Eliminar Cliente &nbsp;&nbsp;&nbsp;&nbsp;    ').css('text-align','center');
	$("#dialog2").prepend('<img id="theImg2" src="../../img/warning.png" width="40" height="40"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog2").dialog("open");
	$("#dialog2").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/good.png" width="40" height="40" title="Aceptar" style="cursor:pointer" onclick="eliminar2('+idn+')"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../../img/erase.png" width="40" height="40" style="cursor:pointer" title="Cancelar" onclick="cerrar_dialogo2()"/>');
}
function eliminar2(id){
	//alert(id)

	$("#dialog2").dialog("close");
	$.ajax({
        type: "GET",
        url: "eliminar.php",
        data: "id="+id,
        success: function(datos){
			if(datos!='') alert(datos);
			$("#dialog2").html('&nbsp;&nbsp;&nbsp;Borrado Exitoso').css('text-align','center');
			$("#dialog2").prepend('<img id="theImg2" src="../../img/good.png" width="40" height="40"/>');
			$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
			$("#dialog2").dialog("open");
			//window.parent.Shadowbox.close(); 
			$('#tabla').load('kardex.php'  + ' #tabla ' )  
			setTimeout(function () {
			   $("#dialog2").dialog("close");
			   overlay.hide();
			}, 2000);
      }	  
	})
}

function cerrar_dialogo2(){
	
	
	overlay.hide()
	
	$("#dialog2").dialog("close");
}
$(function() {
    $( "#dialog2" ).dialog({
      autoOpen: false,
	  show: {effect: 'explode', duration: 500},
	  hide: {effect: 'explode', duration: 500},  
	  width: 380,
	  height: 150,
	  position: [400, 100],
	  toolbar: false,	     
    });
})
	 
	 
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
				
				
			
			$('#tabla').load('kardex.php' + ' #tabla ' );
		overlay.hide();
    }
}	 




/*function mostrar(url){
	//console.log(url);
	var w = window.open(url,'','width=1200,height=600')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);		 
}*/
overlay.click(function(){
	window.win.focus()
});

		//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
				 removebuttons:true       
	  });
}
<!-----------Busqueda  Valle-->
function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	valor=$('#search').val()
	search_ins(valor, tipo, ord)
	
}

function search_ins(value, tipo, ord){
	var valor=encodeURIComponent(value);	
	var data = {valor: valor, tipo:tipo, ord:ord};
	$.ajax({
		type: "POST",		
		url: "pal_search.php",
		data: data,
		success: function(datos){ 
			$('html,body').css('cursor','default');	
			$("#registros").html(datos) 
		},   
	})
}
<!---------------------------->



</script>



</html>
<?php
mysql_free_result($kar);
?>
<?php }else{ ?>


<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../../img/Logo SAGA sin texto.png" width="886" height="248" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>No puede acceder A este MENU sin estar HABILITADO... Consulte al Administrador....!!!</th>
  </tr>
</table>

<?php } ?>