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

$id_url= $_GET['id']; 
$order_url=$_GET['o'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Busqueda de Clientes</title>
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
<input type="hidden" id="tf_consec" >
<input type="hidden" id="tf_puntov" >
<div id="dialog"></div>

<table width="90%" align="center" id="table_header">
    <tr>
    	<td colspan="4" class="tittle">
       <label style="font-size:18px">Listado de Facturas</label> 
       </td>
    </tr>
</table>

<table width="90%" align="center" >
  <tr>
    <td align="right" width="20%">&nbsp;</td>
    <td width="30%" align="center">&nbsp;</td>
    <td align="right" class="bold" width="20%">Factura No</td>
    <td width="30%" align="center" class="cont">
      <input type="text" name="tf_idr" id="tf_idr" class="long" onKeyUp="load1()">
    </td>
  </tr>
</table>
<div id="d_table">
<table width="90%" border="1" align="center">
  <tr class="tittle">
    
    <td width="20%" onClick="orden_bus('consec')" style="cursor:pointer" title="Ordenar por No de Factura">Consecutivo</td>
    <td width="15%" onClick="orden_bus('fecha')" style="cursor:pointer" title="Ordenar por Fecha">Fecha</td>
    <td width="15%" onClick="orden_bus('forma_pago')" style="cursor:pointer" title="Ordenar por Forma de Pago">Forma</td>
    <td width="15%" onClick="orden_bus('punto_venta')" style="cursor:pointer" title="Ordenar por Punto de Venta">Punto de Venta</td>
    <td width="15%" onClick="orden_bus('ced')" style="cursor:pointer" title="Ordenar por NIT">NIT</td>
    <td width="20%" onClick="orden_bus('cliente')" style="cursor:pointer" title="Ordenar por Nombre">Cliente</td>
    <td width="20%" onClick="orden_bus('tot_final')" style="cursor:pointer" title="Ordenar por Costo">Valor</td>
  </tr>
  <?php
  $i = 0;
  mysql_select_db($database_conexion, $conexion);
  	if( $usuario2 == 'general'){
		if ($id_url == ''){
			$query_search = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1 AND `forma_pago`='Contado' $order_url";  
		}else{
			$query_search = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1 AND `forma_pago`='Contado' 
			AND `consec` LIKE '%".mysql_real_escape_string($id_url)."%' $order_url";
		}
	}else{
		if ($id_url == ''){
			$query_search = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1 AND `forma_pago`='Contado' 
			AND `punto_venta`='$usuario2' $order_url";  
		}else{
			$query_search = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1 AND `punto_venta`='$usuario2' 
			AND `forma_pago`='Contado' AND `consec` LIKE '%".mysql_real_escape_string($id_url)."%' $order_url";
		}
	}
  
  $search = mysql_query($query_search, $conexion) or die(mysql_error());
  while($row_search = mysql_fetch_assoc($search)){
	  $estado = $row_search['delete'];
	  if ($estado != 9){
  ?>
  <tr class="row" id="fila_<?php echo $i?>">
    <td align="center"
    onclick="idCheck('<?php echo $row_search['consec'] ?>', '<?php echo $row_search['punto_venta']?>')">
	<?php echo $row_search['consec']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['consec'] ?>', '<?php echo $row_search['punto_venta']?>')">
	<?php echo $row_search['fecha']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['consec'] ?>', '<?php echo $row_search['punto_venta']?>')">
	<?php echo $row_search['forma_pago']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['consec'] ?>', '<?php echo $row_search['punto_venta']?>')">
	<?php echo $row_search['punto_venta']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['consec'] ?>', '<?php echo $row_search['punto_venta']?>')">
	<?php echo $row_search['ced']?></td>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['consec'] ?>', '<?php echo $row_search['punto_venta']?>')">
	<?php echo $row_search['cliente']?></td>
    <?php 
	if ($estado == 0){
	?>
    <td align="center"
    onclick="idCheck('<?php echo $row_search['consec'] ?>', '<?php echo $row_search['punto_venta']?>')">
	<?php echo number_format($row_search['tot_final'],2) ?></td>
    <?php 
	}
	if ($estado == 2){
		$consec = $row_search['consec'];
		mysql_select_db($database_conexion, $conexion);
		$factd = mysql_query("SELECT * FROM `h01sg_devoluciones` WHERE `consec`='$consec' AND `delete`<>1 ", $conexion) or die(mysql_error());
		$row_factd = mysql_fetch_assoc($factd);	
	?>	
    <td align="center"
    onclick="idCheck('<?php echo $row_search['consec'] ?>', '<?php echo $row_search['punto_venta']?>')">
	<label class="red"><?php echo number_format($row_factd['total'],2) ?></label></td>
    <?php
	}
	?>
  </tr>
  <?php
	  }
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
	var o = '';
	$('#d_table').load('dev_fsearch.php?id=' + id.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+")  + ' #d_table ' );
	
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY `'+tipo+'` '+ord;
	//console.log(order);
	load2(order)
}

function load2(order){
	var id = $('#tf_idr').val();
	//console.log('id:'+id)
	var o = '';
	$('#d_table').load('dev_fsearch.php?id=' + id.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+")  + ' #d_table ' );
	
}

function insertprod(){
	var cedula = $('#tf_consec').val();
	var puntov = $('#tf_puntov').val();
	//console.log('c:'+cedula);
	parent.$('#tf_consec').val(cedula);
	parent.$('#sl_ptov').val(puntov);
	parent.loadinfo();
	setTimeout(function () {
	   window.parent.Shadowbox.close();
	}, 500);
	
}

function idCheck(cedula, puntov){
	//console.log('r:'+cedula)
	$('#tf_consec').val(cedula)
	$('#tf_puntov').val(puntov)
	overlay.show()
	$("#dialog").html('&nbsp;Realizar devolución a la factura No '+cedula+" ?<br>").css('text-align','center');
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