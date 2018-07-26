<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php') ?>

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

$i_url= $_GET['i']; 
$p_url= $_GET['p']; 
$id_url= $_GET['id']; 
$order_url=$_GET['o'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Busqueda de Productos</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>
</head>
<body>
<input type="hidden" id="tf_i" value="<?php echo $i_url?>">
<input type="hidden" id="tf_p" value="<?php echo $p_url?>">
<input type="hidden" id="tf_ref" >
<div id="dialog"></div>

<table width="90%" align="center" id="table_header">
    <tr>
    	<td colspan="4" class="tittle">
       <label style="font-size:18px">Busqueda</label> 
       </td>
    </tr>
</table>

<table width="90%" align="center" >
  <tr>
    <td align="right" width="20%">&nbsp;</td>
    <td width="30%" align="center">&nbsp;</td>
    <td align="right" class="bold" width="20%">Referencia</td>
    <td width="30%" align="center" class="cont">
      <input type="text" name="tf_idr" id="tf_idr" class="long" onKeyUp="load1()">
    </td>
  </tr>
</table>
<div id="d_table">
<table width="90%" border="1" align="center">
  <tr class="stittle">
    <td width="15%" onClick="orden_bus('h01sg_producto.ref')" style="cursor:pointer" title="Ordenar por Referencia">Referencia</td>
    <td width="15%" onClick="orden_bus('h01sg_producto.marca')" style="cursor:pointer" title="Ordenar por Marca">Marca</td>
    <td width="20%" onClick="orden_bus('h01sg_producto.desc')" style="cursor:pointer" title="Ordenar por Descripción">Descripción</td>
    <td width="10%" onClick="orden_bus('h01sg_inventario.cant_final')" style="cursor:pointer" title="Ordenar por Cantidad">Cantidad</td>
    <td width="10%" onClick="orden_bus('h01sg_producto.costo_und')" style="cursor:pointer" title="Ordenar por Costo">Costo</td>
    <td width="15%" onClick="orden_bus('h01sg_producto.precio_und')" style="cursor:pointer" title="Ordenar por P. al Detal">Precio Al Detal</td>
    <td width="15%" onClick="orden_bus('h01sg_producto.precio_mayo')" style="cursor:pointer" title="Ordenar por P. por Mayor">Precio por Mayor</td>
  </tr>
  <?php
  $i = 0;
  mysql_select_db($database_conexion, $conexion);
  	if ($id_url == ''){
		$query_search = "SELECT * FROM `h01sg_inventario` LEFT JOIN  `h01sg_producto`
			ON h01sg_inventario.ref=h01sg_producto.ref
			WHERE h01sg_inventario.delete <>1 AND h01sg_producto.delete<>1 $order_url";  
  	}else{
		$query_search = "SELECT * FROM `h01sg_inventario` LEFT JOIN  `h01sg_producto`
			ON h01sg_inventario.ref=h01sg_producto.ref
			WHERE h01sg_inventario.delete <>1 AND h01sg_producto.delete<>1 AND h01sg_inventario.ref LIKE '%".mysql_real_escape_string($id_url)."%'
			$order_url";
	}
  
  $search = mysql_query($query_search, $conexion) or die(mysql_error());
  while($row_search = mysql_fetch_assoc($search)){
  	$ref = $row_search['ref'];
	mysql_select_db($database_conexion, $conexion);
	$query_invent = "SELECT * FROM `h01sg_inventario` WHERE `delete`<>1 AND `punto_venta`='$p_url' 
	AND `ref`='$ref' ";
	$inventario = mysql_query($query_invent, $conexion) or die(mysql_error());
	$row_inv = mysql_fetch_assoc($inventario);
	$inv = $row_inv['cant_final'];
	if ($inv > 0){
  ?>
  <tr class="row" id="fila_<?php echo $i?>">
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', '<?php echo $i?>')">
	<?php echo $ref?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', '<?php echo $i?>')">
	<?php echo $row_search['marca']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', '<?php echo $i?>')">
	<?php echo $row_search['desc']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', '<?php echo $i?>')"> 
	<?php echo $inv ?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', '<?php echo $i?>')">
	<?php echo $row_search['costo_und']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', '<?php echo $i?>')">
	<?php echo $row_search['precio_und']?></td>
    <td align="center"
    onclick="insertprod('<?php echo $ref ?>', '<?php echo $i?>')">
	<?php echo $row_search['precio_mayo']?></td>
  </tr>
  <?php
  $i++;
	}
  }
  ?>
</table>
<table align="center" width="90%" border="1">
	<tr>
    <td align="center">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.parent.Shadowbox.close()">
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
	var i = $('#tf_i').val();
	var p = $('#tf_p').val();
	var id = $('#tf_idr').val();
	var o = '';
	//console.log('id:'+id+' i:'+i)
	$('#d_table').load('invent_search.php?id=' + id.replace(/ /g,"+") + '&i=' + i.replace(/ /g,"+") + '&p=' + p.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") + ' #d_table ' );	
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY '+tipo+' '+ord
	load2(order);
}

function load2(order){
	var i = $('#tf_i').val();
	var p = $('#tf_p').val();
	var id = $('#tf_idr').val();
	//console.log('id:'+id+' i:'+i)
	$('#d_table').load('invent_search.php?id=' + id.replace(/ /g,"+") + '&i=' + i.replace(/ /g,"+") + '&p=' + p.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") + ' #d_table ' );	
}

function insertprod(ref, x){
	//var ref = $('#tf_ref').val();
	var i = $('#tf_i').val();
	//console.log('r:'+ref+' i:'+i);
	parent.$('#tf_ref'+i).val(ref);
	parent.checkref(i);
	var v = parent.$('#tf_exist').val();
	$('#fila_'+x).hide('slow');
	//console.log('v:'+v+' i:'+i);
	if (v == false || v == 'false'){
		i++;
		//console.log('ni:'+i)
		$('#tf_i').val(i);
	}
	setTimeout(function () {
	   //window.parent.Shadowbox.close();
	}, 500);
	
}

function idCheck(ref){
	//console.log('r:'+ref)
	$('#tf_ref').val(ref)
	overlay.show()
	$("#dialog").html('Desea Agregar la Referencia: ' + ref + " a inventario?<br>").css('text-align','center');
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
	  //position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
    });
})


</script>
</html>
<?php
}
?>