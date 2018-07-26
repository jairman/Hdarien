<?php 
$ruta_a_joomla = "/../../../administrativo/";
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
	$acceso= $userx->devoluciones;
if (JFactory::getUser()->usertype == NULL)
    //JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
 
require_once('../Connections/conexion.php') ?>

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

$id_url= $_GET['id']; 

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Busqueda de Clientes</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
</head>
<body>
<input type="hidden" id="tf_cliente" >
<div id="dialog"></div>

<table width="90%" align="center" id="table_header">
    <tr>
    	<td colspan="4" class="tittle">
       <label style="font-size:18px">Listado de Clientes</label> 
       </td>
    </tr>
</table>

<table width="90%" align="center" >
  <tr>
    <td align="right" width="20%">&nbsp;</td>
    <td width="30%" align="center">&nbsp;</td>
    <td align="right" class="bold" width="20%">Cedula/Nit</td>
    <td width="30%" align="center" class="cont">
      <input type="text" name="tf_idr" id="tf_idr" class="long" onKeyUp="load1()">
    </td>
  </tr>
</table>
<div id="d_table">
<table width="90%" border="1" align="center">
  <tr class="tittle">
    <td width="30%">Cedula</td>
    <td width="40%">Nombre</td>
    <td width="30%">Telefono</td>
  </tr>
  <?php
  $i = 0;
  mysql_select_db($database_conexion, $conexion);
  	if ($id_url == ''){
		$query_search = "SELECT * FROM `d89xz_clientes` WHERE `delete`<>1 ORDER BY `cedula` ASC";  
  	}else{
		$query_search = "SELECT * FROM `d89xz_clientes` WHERE `delete`<>1 AND `cedula` LIKE '%".mysql_real_escape_string($id_url)."%'
		ORDER BY `cedula` ASC";
	}
  
  $search = mysql_query($query_search, $conexion) or die(mysql_error());
  while($row_search = mysql_fetch_assoc($search)){
  ?>
  <tr class="row" id="fila_<?php echo $i?>">
    <td align="center"
    onclick="idCheck('<?php echo $row_search['cedula'] ?>','<?php echo $row_search['nombre'] ?>')">
	<?php echo $row_search['cedula']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['cedula'] ?>','<?php echo $row_search['nombre'] ?>')">
	<?php echo $row_search['nombre']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['cedula'] ?>','<?php echo $row_search['nombre'] ?>')">
	<?php echo $row_search['telefono']?></td>
  </tr>
  <?php
  $i++;
  }
  ?>
</table>
<table align="center" width="90%" border="1">
	<tr>
    <td align="center">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cancelar" onclick="window.parent.Shadowbox.close()">
    </td>
    </tr>
</table>
</div>
</body>
<script>

$(document).ready(function() {
    overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
});

function load1(){
	var id = $('#tf_idr').val();
	//console.log('id:'+id)
	$('#d_table').load('fact_csearch.php?id=' + id.replace(/ /g,"+")  + ' #d_table ' );
	
}

function insertprod(){
	var cedula = $('#tf_cliente').val();
	//console.log('c:'+cedula);
	parent.$('#tf_nit').val(cedula);
	parent.getClient(cedula);
	setTimeout(function () {
	   window.parent.Shadowbox.close();
	}, 500);
	
}

function idCheck(cedula, nombre){
	//console.log('r:'+cedula+' n: '+nombre)
	$('#tf_cliente').val(cedula)
	overlay.show()
	$("#dialog").html('Desea agregar al cliente ' + nombre + " a la factura ?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="insertprod();cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
	
}

//funcion para cerrar el cuadro de dialogo
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


</script>
</html>
<?php
}
?>