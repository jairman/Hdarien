<?php
$ruta_a_joomla = "/../../../../wanitta/";
define( '_JEXEC', 1 );
define( 'JPATH_BASE', realpath(dirname(__FILE__).$ruta_a_joomla ));
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'configuration.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$userx = &JFactory::getUser();
 $usuario= $userx->username;
  $usuario2= $userx->usertype2;
	$acceso= $userx->clientes;
if (JFactory::getUser()->usertype == NULL)
   // JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();

require_once('../../Connections/conexion.php');

 
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
<title>Kardex Proveedores</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
</head>

<body>
<div id="tabla">
<p>

</p>
<table width="98%" align="center">
  <tr>
    <td width="84%" align="right"><p class="s"> 
             <input name="search" id="search" type="search"  autocomplete="off">
     </p></td>
    <td width="8%" align="center"><img src="../../img/addpersonas.png" width="40" height="40" title="Agregar Nuevo" style="cursor:pointer"  onclick="agregar()"  /></td>
    <td width="8%" align="center"><a href="javascript:imprSelec('tabla')" ><img src="../../img/imprimir.png" alt="" width="40" height="40" title="Imprimir"/></a></td>
  </tr>
</table>
   <?
	mysql_select_db($database_conexion, $conexion);
	$query_kar = "SELECT * FROM d89xz_prove where `delete` != '1' order by  nombre asc  "  ;
	$kar = mysql_query($query_kar, $conexion) or die(mysql_error());
	$row_kar = mysql_fetch_assoc($kar);
	$totalRows_kar = mysql_num_rows($kar);
?>
<table width="98%" border="1" align="center" cellspacing="0">
  <tr > 
    <th colspan="9" align="center"  class="tittle" >Listado de Proveedores</th>
    </tr>
 
  <tr align="center" class="tittle"  >
    <td width="13%">Cédula/NIT</td>
    <td width="15%" align="center">Marca</td>
    <td width="19%">Contacto</td>
    <td width="11%">Celular</td>
    <td width="16%">Categoría</td>
    <td width="19%">Tipo de Producto</td>
    <td colspan="3">&nbsp;</td>
  </tr>
   <?php do { ?>
        <tr class="row">
     	 <td width="13%" align="right"  onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php  echo  $row_kar['cedula']; ?></td>
     	 <td width="25%" align="left" onClick="mostrar('<?php echo $row_kar['id'];  ?>');">  &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_kar['nombre']; ?></td>
     	 <td width="9%" align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php echo $row_kar['contacto1']; ?></td>
      	<td  width="11%" align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php echo $row_kar['cel']; ?></td>
        <td width="16%" align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');"><?php echo $row_kar['categoria'];?></td>
      	
        
      	
      	<td  width="18%" align="center" onClick="mostrar('<?php echo $row_kar['id'];  ?>');" ><?php echo $row_kar['tipo']; ?></td>
        
      	<td width="2%" align="center" onClick="mostrar1('<?php echo $row_kar['id'];  ?>');"><img src="../../img/edit.png" alt="" width="20" height="20"      title="Editar"/></td>
        <td width="2%" align="center" onClick="eliminar('<?php echo $row_kar['id'];  ?>');"><img src="../../img/erase.png" alt="" width="20" height="20"  title="Eliminar"/></td>
        
        </tr>
    <?php } while ($row_kar = mysql_fetch_assoc($kar)); ?>
    
   </table>
    <div id='registros' >
  </div>

</div>
</body>
<div id="dialog2">
</div>
<script>
$(document).ready(function(){
	$("#search").delay(300).keyup(function() {
    var searchbox = $(this).val();
   // var hacienda = $("#hda").val();
    var letters = searchbox.split(" ");
    console.log(letters);
    var dataString = {arr: letters, searchword:searchbox, todos:''};
    if(searchbox=='') {
      dataString.todos = "todos";
      console.log(dataString.todos);
      $.ajax({
        type: "POST",
        url: "pal_search.php",
        data: dataString,
        cache: false,
        success: function(html) {
          $("#registros").fadeIn("slow").html(html).show();
        }
      });
    } else{
      $.ajax({
        type: "POST",
        url: "pal_search.php",
        data: dataString,
        cache: false,
        success: function(html) {
          console.log("html-> "+html);
          $("#registros").fadeIn("slow").html(html).show();
        }
      });
    }   
    return false; 
  });
	
});
<!-- necesario para los cuadros de dialogo-->
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
overlay.click(function(){
	window.win.focus()
});

Shadowbox.init({
handleOversize: "drag",
modal: true
});

function agregar(){
	
		var url = 'prove.php' ;
	Shadowbox.open({
		 content: url,
		 player: "iframe",
		 options: {                   
			  initialHeight: 1,
			  initialWidth: 1,
			  modal: true
		 }
	});	
}
function mostrar(id){
	var url = 'verProve.php?id=' +  id;
	var w = window.open(url,'','width=1280,height=640,dependent=yes')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    	w.resizeTo(screen.width,screen.height);
	 }

function mostrar1(id){
	var url = 'Editprove.php?id=' +  id;
	Shadowbox.open({
		 content: url,
		 player: "iframe",
		 options: {                   
			  initialHeight: 1,
			  initialWidth: 1,
			  modal: true
		 }
	});	
		
		
	 }		 



function eliminar(idn){
	//alert(idn)
	overlay.show()
	$("#dialog2").html('&nbsp;&nbsp;&nbsp;&nbsp;  Desea Eliminar Proveedor... ?    ').css('text-align','center');
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
		var ano= $('#ano').val();
		$('#tabla').load('stin_sanita2.php?ano=' + ano + ' #tabla ' );
		overlay.hide();
    }
}	 
// Imprimir
  function imprSelec(nombre)
  {
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
}

</script>



</html>

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