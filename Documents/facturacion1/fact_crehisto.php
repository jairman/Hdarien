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
$ptov_url=$_GET['p'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$y = date ('Y');
$m = date ('m');
$d = date ('d');

$i=1;

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Historial de Facturación</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
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
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="84%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="../facturacion/fact_histo.php?r=<?php echo $ref_url ?>" >Reporte de Ventas</a>
      </li>
      <li>
      <a  href="../facturacion/fact_crehisto.php?r=<?php echo $ref_url ?>" class='active' >Reporte de Creditos</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="8%" align="left">
    <!--<img  title="Graficas" src="../img/chart.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="graficas()"/>-->
    </td>
    <td width="8%" align="left">
    <img  title="Imprimir" src="../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')"/>
    </td>
  </tr>
</table>
<div id="recargar2">
<div id="main">
&nbsp;

<table width="95%" align="center">
	<tr>
    <td colspan="4" align="right">&nbsp;</td>
    </tr>
	<tr>
    <td colspan="4" align="center" class="tittle">Reporte de Creditos</td>
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
    <?php
    //echo 'year';
	?>
    <select name="sl_year" id="sl_year" onChange="load2()" style="width:90px" >
        <option value="">Año</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		//echo 'yearq';
		if ($ptov_url == ''){
			$query_anos = "SELECT DISTINCT YEAR(fecha)  FROM `h01sg_venta` WHERE `delete`<>1 ORDER BY YEAR(fecha) DESC";
		}else{
			$query_anos = "SELECT DISTINCT YEAR(fecha)  FROM `h01sg_venta` WHERE `delete`<>1
			AND `punto_venta`='$ptov_url' ORDER BY YEAR(fecha) DESC";
			}
		$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
		while($row_anos = mysql_fetch_assoc($anos)){
		?>
        <option value="<?php echo $row_anos['YEAR(fecha)']?>"><?php echo $row_anos['YEAR(fecha)']?></option>
        <?php
		}
		?>
       
    </select>
    </div>
    <div id="month" align="right">
    <?php
    //echo 'month';
	?>
    <select name="sl_month" id="sl_month" onChange="load3()" style="width:90px">
        <option value="">Mes</option>
        <?php
		//echo $year_url;
		mysql_select_db($database_conexion, $conexion);
		//echo 'monthq';
		if ($ptov_url == ''){
			$query_mes = "SELECT DISTINCT MONTH(fecha) , MONTHNAME(fecha) FROM `h01sg_venta` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' 
			ORDER BY MONTH(fecha) DESC";
		}else{
			$query_mes = "SELECT DISTINCT MONTH(fecha) , MONTHNAME(fecha) FROM `h01sg_venta` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' 
			AND `punto_venta`='$ptov_url' ORDER BY MONTH(fecha) DESC";
		}
		$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
		while($row_mes = mysql_fetch_assoc($mes)){
        ?>
        <option value="<?php echo $row_mes['MONTH(fecha)']?>">
		<?php echo ucwords(strtolower($row_mes['MONTHNAME(fecha)']))?>
        </option>
        <?php
		}
        ?>
	</select> 
    </div>   
    <div id="day" align="right">
    <?php
    //echo 'day';
	?>
    <select name="sl_day" id="sl_day" onChange="load4()" style="width:90px">
        <option value="">Día</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		//echo 'dayq';
		if ($ptov_url == ''){
			$query_dia = "SELECT DISTINCT DAY(fecha)  FROM `h01sg_venta` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
			ORDER BY DAY(fecha) ASC";
		}else{
			$query_dia = "SELECT DISTINCT DAY(fecha)  FROM `h01sg_venta` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
			AND `punto_venta`='$ptov_url' ORDER BY DAY(fecha) ASC";
		}
		$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
		while($row_dia = mysql_fetch_assoc($dia)){
        ?>
        <option value="<?php echo $row_dia['DAY(fecha)']?>"><?php echo $row_dia['DAY(fecha)']?></option>
        <?php
        } 
        ?>
    </select>
    </div>
    </td>
    </tr>
</table>
<div id="d_table">
<table width="95%" align="center" id="table_detail">
    <tr class="stittle">
      <td width="12%">Fecha</td>
      <td width="10%">Consecutivo</td>
      <td width="18%">Cliente</td>
      <td width="10%">Nit</td>
      <td width="12%">Origen</td>
      <td width="10%">Articulos</td>
      <td width="10%">Descuento</td>
      <td width="10%">Total</td> 
      <td width="8%">Estado</td> 
           
    </tr>
    <?php
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 1;
		if ($ptov_url == ''){
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1 AND `forma_pago`='Credito' ORDER BY `fecha` DESC ";
		}else{
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1 AND `punto_venta`='$ptov_url' AND `forma_pago`='Credito'
			ORDER BY `fecha` DESC ";
		}
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		//echo 3;
		if ($ptov_url == ''){
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1 
			AND YEAR(fecha) = '$year_url' AND `forma_pago`='Credito' ORDER BY `fecha` DESC";
		}else{
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1 
			AND YEAR(fecha) = '$year_url' AND `punto_venta`='$ptov_url' AND `forma_pago`='Credito' ORDER BY `fecha` DESC";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		//echo 5;
		if ($ptov_url == ''){
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1
			AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' AND `forma_pago`='Credito' ORDER BY `fecha` DESC";
		}else{
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1
			AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' AND `punto_venta`='$ptov_url' AND `forma_pago`='Credito' 
			ORDER BY `fecha` DESC";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		//echo 7;
		if ($ptov_url == ''){
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1
			AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND `forma_pago`='Credito'
			ORDER BY `fecha` DESC";
		}else{
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `delete`<>1
			AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND `punto_venta`='$ptov_url' 
			AND `forma_pago`='Credito' ORDER BY `fecha` DESC";
		}
		
	}
	$prod = mysql_query($query_prod, $conexion) or die(mysql_error()); 
	while($row_prod = mysql_fetch_assoc($prod)){
		$consec = $row_prod['consec'];
		$ptov = $row_prod['punto_venta'];
		$estado = $row_prod['delete'];
		
		/*
		----------------
		Estados
		----------------
		0 = Activa
		1 = Eliminada
		2 = Devolución
		3 = Anulada
		9 = Factura a Credito Pagada
		*/
		
		if ($estado == 0){
	?>
    <tr class="row">
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['fecha']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $consec?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['cliente']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['ced']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $ptov?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['total_items']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['dscto']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
      <label id="lb_val<?php echo $i?>" class="val"><?php echo number_format($row_prod['valor_tot'], 2)?></label>
      </td>
      <td align="center"><input name="imgb" type="image" id="img<? echo $i; ?>" 
      src="../img/edit.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Editar"
      onClick="editar1('<?php echo $consec ?>', '<?php echo $ptov?>')" ></td>
    </tr>
    <?php 
		$i++;
		}
		if ($estado == 2){
	?>
    <tr class="row" >
      <td align="center" onClick="mostrar('../facturacion/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['fecha']?></td>
      <td align="center" onClick="mostrar('../facturacion/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $consec?></td>
      <td align="center" onClick="mostrar('../facturacion/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['cliente']?></td>
      <td align="center" onClick="mostrar('../facturacion/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['ced']?></td>
      <td align="center" onClick="mostrar('../facturacion/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $ptov?></td>
      <td align="center" onClick="mostrar('../facturacion/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['total_items']?></td>
      <td align="center" onClick="mostrar('../facturacion/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['dscto']?></td>
      <?php 
		mysql_select_db($database_conexion, $conexion);
		$factd = mysql_query("SELECT * FROM `h01sg_devoluciones` WHERE `consec`='$consec' AND `delete`<>1 ", $conexion) or die(mysql_error());
		$row_factd = mysql_fetch_assoc($factd);	
		?>
      <td align="center" onClick="mostrar('../facturacion/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
      <label id="lb_val<?php echo $i?>" class="val red"><?php echo number_format($row_factd['total'], 2)?></label>
      </td>
      <td align="center"><label class="red">Pendiente</label></td>
    </tr>
    <?php 
		$i++;
		}
		if ($estado == 9){
	?>
    <tr class="row">
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['fecha']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $consec?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['cliente']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['ced']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $ptov?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['total_items']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['dscto']?></td>
      <td align="center" onClick="mostrar('../facturacion/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
      <label id="lb_val<?php echo $i?>" class="val"><?php echo number_format($row_prod['valor_tot'], 2)?></label>
      </td>
      <td align="center">Cancelada</td>
    </tr>
    <?php 
		$i++;
		}
	}
	?>
    <td colspan="10">&nbsp;</td>
    <tr>
    <td colspan="7" align="right"><label class="red">Total</label></td>
    <td align="center" colspan="3"><label id="lb_tot" class="red"></label></td>
    </tr>
    
</table>
&nbsp;
</div>
</div>
</div>
</body>

<script>

$(document).ready(function() {
	//se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
	overlay.click(function(){
		window.win.focus()
	});
	
    $('#month').hide();
	$('#day').hide();
	load1();
	//console.log('priueba')
	$('#sl_ptov').bind('change', function (){
		load0();	
	});
});

function editar1(c, p){
	p= $.trim(p);
	//console.log('1:'+c+p);
	overlay.show()
	$("#dialog").html('Editar la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="red(\''+c+'\',\''+p+'\');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function red(c, p){
	//console.log(c+p);
	var url = '../facturacion/fact_cred1.php?c='+c+'&p='+p;
	mostrar(url);
}

function graficas(){
	var url = '../facturacion/fact_grap.php';
	mostrar(url);
	/*Shadowbox.open({
		content: url,
		player: "iframe",
		options: {                   
			initialHeight: 1,
			initialWidth: 1,
			modal: true		      		
		},
	})*/
}

function editar1(c, p){
	p= $.trim(p);
	//console.log('1:'+c+p);
	overlay.show()
	$("#dialog").html('Editar la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="red(\''+c+'\',\''+p+'\');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function red(c, p){
	//console.log(c+p);
	var url = '../facturacion/fact_cred1.php?c='+c+'&p='+p;
	mostrar(url);
}

function editar2(c, p){
	p= $.trim(p);
	//console.log('1:'+c+p);
	overlay.show()
	$("#dialog").html('Editar la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="red2(\''+c+'\',\''+p+'\');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function red2(c, p){
	//console.log(c+p);
	var url = '../facturacion/fact_cre2.php?c='+c+'&p='+p;
	mostrar(url);
}

function totcosto(){
	//console.log('totcosto');
	var total = new Number();
	var $table = $('#table_detail tr:not(#tittle)').closest('table');  		
	$table.find('.val').each(function() {
		//var cant = new Number($.trim($(this).text()));
		var id = $(this).attr('id');	
		var n = id.substr(6);
		//console.log('n:'+n);
		n = $.trim('lb_val'+n);
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

function load0(){
	var y = '';
	$('#sl_year').val('');
	var m = '';
	$('#sl_month').val('');
	var d = '';
	$('#sl_day').val('');
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#year').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #year' );
	
	$('#month').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();	
		}
	});
	

}

function load1(){
	var y = $('#tf_year').val();
	var m = $('#tf_month').val();
	var d = '';//$('#tf_day').val();
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#year').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #year' );
	
	$('#month').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' , 
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
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#month').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ', 
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
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);	
	$('#day').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' , 
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
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#d_table').load('fact_crehisto.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +' #d_table ' , 
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
	  position: [($(window).width() / 2) - (dialogwidth / 2), 150],
	  toolbar: false, 
	  close: function() { overlay.hide() }, 	     
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
		load4();
       	clearTimeout(t);
		overlay.hide();
    }
}

function mostrar(url){
	console.log(url);
	var w = window.open(url,'','width=1200,height=600')
	window.win=w;
	overlay.show();
	checkChildWindow(w, function() {  } );
	w.moveTo(0,0);
    w.resizeTo(screen.width,screen.height);		 
}

//funcion para iniciar el shadowbox
Shadowbox.init({
	handleOversize: "drag",
	modal: true,
	onOpen: function() {
		$('#sb-info').after($('#sb-wrapper-inner'));
		$('#sb-wrapper-inner').after($('#sb-title'));
	},
	onClose: function(){ 
	
	}
});

//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
} 

</script>

</html>
<?php
}
?>