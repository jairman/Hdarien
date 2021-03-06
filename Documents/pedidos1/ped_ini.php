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

$day_url=$_GET['d'];
$month_url=$_GET['m'];
$year_url=$_GET['y'];
$order_url=$_GET['o'];
$ptov_url=$_GET['p'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$y = date ('Y');
$m = date ('m');
$d = date ('d');

$i = 0;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Reporte de Pedidos</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>

<style>
#year, #month, #day{
	/*display:inline-block;*/
	float:left;
	/*width:100%;*/
}
</style>

</head>

<body>
<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_year" value="<?php echo $y ?>">
<input type="hidden" id="tf_month" value="<?php echo $m ?>">
<input type="hidden" id="tf_day" value="<?php echo $d ?>">

<div id="dialog"></div>

<table width="95%" border="1" cellspacing="0" align="center">
	<tr>
    <td width="68%">
    <div id="menu">
      <ul>
      <li>
      <a href="../cotizaciones/coti_ini.php">Cotizaciones</a>
      </li>
      <li>
      <a  href="../pedidos/ped_ini.php" class='active'>Pedidos</a>
      </li>
      <li>
      <a  href="../compras/compras_ini.php">Compras</a>
      </li>
      </ul>
    </div>
    
    </td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="8%">
    <input type="image" src="../img/cot.png" alt="" width="48" height="48" border="0" 
    align="right"  title="Crear Cotización" id="bt_addp" style="cursor:pointer" >
    </td>
    <td width="8%">
    <input type="image" title="Imprimir" src="../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" > 
    </td>
    </tr>
</table>   
<div id="main">
&nbsp;
<div id="recargar2">
<table width="95%" align="center" border="1" cellspacing="0">
    <tr class="tittle">
    	<td colspan="4">Reporte de Pedidos</td>
    </tr>
    <tr>
        <td class="bold cont" align="right" width="20%">
        Punto de Venta
        </td>
        <td class="bold cont" align="right" width="30%">
        <?php
        if ($usuario2 == 'general'){
        ?>
        <select name="sl_ptov" id="sl_ptov" class="long" onChange="load0()">
        <option value="">Seleccione</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE `delete`=0 order by hacienda";
        $hac = mysql_query($query_hac, $conexion) or die(mysql_error());
        while ($row_hac = mysql_fetch_assoc($hac)){
        ?>
        <option value="<?php echo $row_hac['hacienda']?>"><?php echo $row_hac['hacienda1']?></option>
        <?php
        } 
        ?>
        </select>
        <?php 
        }else{
        ?>
        <input type="text" readonly id="tf_ptov" class="long" value="<?php echo $usuario2 ?>">
        <?php
        }
        ?>
        </td>
        <td class="bold cont" align="right" width="20%">
        Fecha
        </td>
        <td class="bold cont" align="right" width="30%"> 
        <div id="year" align="right">
            <select name="sl_year" id="sl_year" onChange="load2()" style="width:80px" >
            <option value="">Año</option>
            <?php
            //echo 'pru';
            mysql_select_db($database_conexion, $conexion);
            //echo 'yearq';
            if ($ptov_url == ''){
                $query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_pedidos` WHERE `delete`<>1
                ORDER BY YEAR(f_fact) DESC";
            }else{
                $query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_pedidos` WHERE `delete`<>1 AND `punto_venta`='$ptov_url'
                ORDER BY YEAR(f_fact) DESC";
            }
            
            $anos = mysql_query($query_anos, $conexion) or die(mysql_error());
            while($row_anos = mysql_fetch_assoc($anos)){
            ?>
            <option value="<?php echo $row_anos['YEAR(f_fact)']?>"><?php echo $row_anos['YEAR(f_fact)']?></option>
            <?php
            }
            ?>
            </select>
        </div>
        
        <div id="month" align="right">
        
            <select name="sl_month" id="sl_month" onChange="load3()" style="width:80px">
            <option value="">Mes</option>
            <?php
            //echo $year_url;
            mysql_select_db($database_conexion, $conexion);
            //echo 'monthq';
            if ($ptov_url == ''){
                $query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_pedidos` 
            	WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' ORDER BY MONTH(f_fact) DESC";
            }else{
                $query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_pedidos` 
            	WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND `punto_venta`='$ptov_url' ORDER BY MONTH(f_fact) DESC";
				
            }
            
            $mes = mysql_query($query_mes, $conexion) or die(mysql_error());
            echo $n = mysql_num_rows($mes);
            while($row_mes = mysql_fetch_assoc($mes)){
            ?>
            <option value="<?php echo $row_mes['MONTH(f_fact)']?>">
            <?php echo ucwords(strtolower($row_mes['MONTHNAME(f_fact)']))?>
            </option>
            <?php
            }
            ?>
            </select> 
        </div>   
        
        <div id="day" align="right">
            <select name="sl_day" id="sl_day" onChange="load4()" style="width:80px">
            <option value="">Día</option>
            <?php
            mysql_select_db($database_conexion, $conexion);
            //echo 'dayq';
            if ($ptov_url == ''){
                $query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_pedidos` 
				WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
				ORDER BY DAY(f_fact) ASC";
            
            }else{
				$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_pedidos` 
				WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
				AND `punto_venta`='$ptov_url' ORDER BY DAY(f_fact) ASC";
            }
            
            $dia = mysql_query($query_dia, $conexion) or die(mysql_error());
            while($row_dia = mysql_fetch_assoc($dia)){
            ?>
            <option value="<?php echo $row_dia['DAY(f_fact)']?>"><?php echo $row_dia['DAY(f_fact)']?></option>
            <?php
            } 
            ?>
            </select>
        </div>
        
        </td>
    </tr>
</table>

<div id="table" >
<table width="95%" border="1" align="center" cellspacing="0" id="tb_data">
  <tr class="stittle">
  	<td align="center" width="15%" onClick="orden_bus('f_fact')" style="cursor:pointer" title="Ordenar por Fecha">Fecha</td>
    <td align="center" width="15%" onClick="orden_bus('consec')" style="cursor:pointer" title="Ordenar por No. de Pedido">No</td>
    <td align="center" width="15%" onClick="orden_bus('cot')" style="cursor:pointer" title="Ordenar por No. de Cotización">Cotización No</td>
    <td align="center" width="15%" onClick="orden_bus('cliente')" style="cursor:pointer" title="Ordenar por Proveedor">Provedor</td>
    <td align="center" width="15%" onClick="orden_bus('cant')" style="cursor:pointer" title="Ordenar por No. de Items">Items</td>
    <td align="center" width="15%" onClick="orden_bus('costo')" style="cursor:pointer" title="Ordenar por Costo">Costo</td>
    <td align="center" width="10%">&nbsp;</td>
  </tr>
  <?php
  	//echo $order_url;
    //echo $year_url.'-'.$month_url.'-'.$day_url;
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 2;
		if ($ptov_url == ''){
			$query_muerte = "SELECT * FROM `h01sg_pedidos` WHERE 'delete'<>1 $order_url";
		}else{
			$query_muerte = "SELECT * FROM `h01sg_pedidos` WHERE 'delete'<>1 AND `punto_venta`='$ptov_url' $order_url";
		}
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		//echo 4;
		if ($ptov_url == ''){
			$query_muerte = "SELECT * FROM `h01sg_pedidos` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			$order_url";
		}else{
			$query_muerte = "SELECT * FROM `h01sg_pedidos` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
		 	AND `punto_venta`='$ptov_url' $order_url";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		//echo 6;
		if ($ptov_url == ''){
			$query_muerte = "SELECT * FROM `h01sg_pedidos` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' $order_url";
		}else{
			$query_muerte = "SELECT * FROM `h01sg_pedidos` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND `punto_venta`='$ptov_url' $order_url";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		//echo 8;
		if ($ptov_url == ''){
			$query_muerte = "SELECT * FROM `h01sg_pedidos` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' $order_url";
		}else{
			$query_muerte = "SELECT * FROM `h01sg_pedidos` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' AND `punto_venta`='$ptov_url' $order_url";
		}		
	}
	$muerte = mysql_query($query_muerte, $conexion) or die(mysql_error());
	//echo $tm = mysql_num_rows($muerte);  
	while($row_muerte = mysql_fetch_assoc($muerte)){
		$estado = $row_muerte['delete'];
		$cot = $row_muerte['cot'];
		if ($estado == 0 && $cot == ''){
		
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label class="red"><?php echo $row_muerte['cot']?></label></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cliente']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
	<td align="center" >
    <input name="imgp" type="image" id="img2<? echo $i; ?>" 
	src="../img/next.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Entrar Compra"
	onClick="pedir('<?php echo $row_muerte['consec'] ?>')" >
    &nbsp;
	<input name="imgb" type="image" id="img<? echo $i; ?>" 
	src="../img/edit.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Editar Cotización"
	onClick="editar('<?php echo $row_muerte['consec'] ?>')" >
	</td>   
	</tr>
	<?php	
			$i++; 
		}
		if ($estado == 0 && $cot != ''){
		
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label class="red"><?php echo $row_muerte['cot']?></label></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cliente']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
	<td align="center" >
    <input name="imgp" type="image" id="img2<? echo $i; ?>" 
	src="../img/next.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Entrar Compra"
	onClick="pedir('<?php echo $row_muerte['consec'] ?>')" >
    
	</td>   
	</tr>
	<?php	
			$i++; 
		}
		if ($estado == 2 ){
		
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label class="red"><?php echo $row_muerte['cot']?></label></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cliente']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
	<td align="center" 
	onClick="mostrar('../pedidos/ped_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
	<td align="center" >
    <label class="red">Recibido</label>
	</td>   
	</tr>
	<?php	
			$i++; 
		}
	}
	?>
	<tr>
  <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="4" align="right"><label class="red">Total</label></td>
  <td align="center"><label id="lb_tot" class="red"></label></td>
  <td>&nbsp;</td>
  </tr>
</table>
</div>
</div>
&nbsp;
</div>
</body>
<script>
// JavaScript Document
$(document).ready(function() {
    //se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	overlay.click(function(){
		window.win.focus()
	});

	$('#month').hide();
	$('#day').hide();
	//console.log('prueba');
	load1();
	
	$('#bt_addp').bind('click', function(){
		//console.log(1);
		product_wind();
	});
	
	$('#bt_regmul').bind('click', function(){
		//console.log(1);
		regmulti_wind();
	});
	
	$('#bt_dev').bind('click', function(){
		//console.log(1);
		dev_wind();
	});
	
	$('#sl_ptov').bind('change', function (){
		load0();	
	});
	
});

function totcosto(){
	//console.log('totcosto');
	var total = new Number();
	var $table = $('#tb_data tr:not(#tittle)').closest('table');  		
	$table.find('.costo').each(function() {
		//var cant = new Number($.trim($(this).text()));
		var id = $(this).attr('id');	
		var n = id.substr(8);
		//console.log('n:'+n);
		n = $.trim('lb_costo'+n);
		//console.log(n);
		var costo = parseFloat($.trim(($('#'+n).text()).replace(/\,/g, '')));
		//console.log('co: '+costo);
		//console.log(typeof(costo));
		total = costo + parseFloat(total);
	});
	
	$('#lb_tot').text(commaSeparateNumber(total));
}

function commaSeparateNumber(val){
	while (/(\d+)(\d{3})/.test(val.toString())){
		val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
	}
	return val;
}

function product_wind(){
	var url = '../pedidos/ped_form.php';
	//console.log(url);
	mostrar(url);
	
}

function editar(c){
	overlay.show()
	$("#dialog").html('&nbsp;Editar el pedido No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="red('+c+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function pedir(c){
	overlay.show()
	$("#dialog").html('&nbsp;Entrar la compra del pedido No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="blue('+c+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function red(c){
	var url = '../pedidos/ped_edit.php?c='+c;
	mostrar(url);
}

function blue(c){
	var url = '../compras/comp_ped_form.php?c='+c;
	mostrar(url);
}

function load0(){
	var y = '';
	$('#sl_year').val('');
	var m = '';
	$('#sl_month').val('');
	var d = '';
	$('#sl_day').val('')
	var o = '';
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#year').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #year' );
	
	$('#month').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #day' );
	
	$('#table').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
}

function load1(){
	//console.log('prueba')
	
	var y = $('#tf_year').val();
	var m = $('#tf_month').val();
	var d = $('#tf_day').val();
	var o = '';
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('1y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#year').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #year' );
	
	$('#month').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #day' );
	
	$('#table').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
}

function load2(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var o = '';
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#month').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #day' );
	
	$('#table').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
	if (y == ''){
		//console.log('y:'+y);
		$('#month').hide();
		$('#day').hide();
		$('#sl_month').val('');
		$('#sl_day').val('');
			
	}else{
		//console.log('y:'+y);
		$('#month').show();
		$('#day').hide();			
	}
}

function load3(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var o = '';
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#day').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +' #day' );
	
	$('#table').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
	
	if (m == ''){
		//console.log('m:'+m);
		$('#day').hide();
		$('#sl_day').val('');
	}else{
		//console.log('m:'+m);
		$('#day').show();
	}	
}

function load4(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var o = '';
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
}

function load5(){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var o = '';
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('ped_ini.php?y=' + y.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") + '&o=' + o.replace(/ /g,"+")  +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY `'+tipo+'` '+ord
	//console.log(order)
	load6(order)
}

function load6(order){
	var y = $('#sl_year').val();
	var m = $('#sl_month').val();
	var d = $('#sl_day').val();
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('ped_ini.php?y=' + y.replace(/ /g,"+")  +'&p=' + p.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") + '&o=' + order.replace(/ /g,"+") +' #table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
				
		}
	});
}

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

//funcion para iniciar el shadowbox
Shadowbox.init({
	handleOversize: "drag",
	modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
	onClose: function(){ 
		load4();
		
	}
});

//se crea la variable con el estilo css overlay
overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
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
		
		load4();
		
       	clearTimeout(t);
		overlay.hide();
    }
}

function mostrar(url){
	//console.log(url);
	var w = window.open(url,'','width=1200,height=600')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);		 
}


//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false,
		 removebuttons:true        
	  });
}
</script>
</html>
<?php
}
?>