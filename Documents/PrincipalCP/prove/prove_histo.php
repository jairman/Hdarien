<?
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
	$acceso= $userx->proveedores;
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();


 $_GET['id'];
 
  ?>
<?php require_once('../../Connections/conexion.php'); ?>
<?php
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
$idc_url=$_GET['id'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$y = date ('Y');
$m = date ('m');
$d = date ('d');

$i=1;

mysql_select_db($database_conexion, $conexion);
$query_clien = sprintf("SELECT * FROM d89xz_prove WHERE id='$idc_url'", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);

$c_ced = $row_clien['cedula'];
$c_nombre = $row_clien['nombre'];

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Historial de Facturación</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
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
<input type="hidden" id="tf_idclient" value="<?php echo $idc_url ?>">
<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_year" value="<?php echo $y ?>">
<input type="hidden" id="tf_month" value="<?php echo $m ?>">
<input type="hidden" id="tf_day" value="<?php echo $d ?>">
<div id="dialog"></div>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="../prove/verProve.php?id=<?php echo $idc_url ?>" >Información del Provedor</a>
      </li>
      <li>
      <a  href="../prove/prove_histo.php?id=<?php echo $idc_url ?>" class='active'>Historial de Facturación</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="left"><img  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')"/>
</td>
  </tr>
</table>
<div id="recargar2">
<div id="main">
&nbsp;

<table width="95%" align="center">
	<tr>
    <td colspan="4" align="center" class="tittle">Reporte de Ventas</td>
    </tr>
    <tr>
    <td class="bold">Cédula</td>
    <td class="cont bold"><input type="text" class="long" value="<?php echo $c_ced?>" readonly></td>
    <td class="bold">Nombre</td>
    <td class="cont bold"><input type="text" class="long" value="<?php echo $c_nombre?>" readonly></td>
    </tr>
	<tr>
	<td class="bold cont" width="20%">
    Punto de Venta
    </td>
    <td class="bold cont" width="30%">
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
    <select name="sl_year" id="sl_year" onChange="load2()" style="width:80px" >
        <option value="">Año</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		//echo 'yearq';
		if ($ptov_url == ''){
			$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1 ORDER BY YEAR(f_fact) DESC";
		}else{
			$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
			AND `punto_venta`='$ptov_url' ORDER BY YEAR(f_fact) DESC";
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
    <?php
    //echo 'month';
	?>
    <select name="sl_month" id="sl_month" onChange="load3()" style="width:80px">
        <option value="">Mes</option>
        <?php
		//echo $year_url;
		mysql_select_db($database_conexion, $conexion);
		//echo 'monthq';
		if ($ptov_url == ''){
			$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' 
			ORDER BY MONTH(f_fact) DESC";
		}else{
			$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' 
			AND `punto_venta`='$ptov_url' ORDER BY MONTH(f_fact) DESC";
		}
		$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
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
    <?php
    //echo 'day';
	?>
    <select name="sl_day" id="sl_day" onChange="load4()" style="width:80px">
        <option value="">Día</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		//echo 'dayq';
		if ($ptov_url == ''){
			$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url'
			ORDER BY DAY(f_fact) ASC";
		}else{
			$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url'
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
<div id="d_table">
<table width="95%" align="center" id="table_detail">
    <tr class="tittle">
      <td width="13%">Fecha</td>
      <td width="12%">Consecutivo</td>
      <td width="15%">Provedor</td>
      <td width="15%">Nit</td>
      <td width="10%">Origen</td>
      <td width="10%">Artículos</td>
      <td width="10%">Total</td> 
      <td width="15%">Notas</td>      
    </tr>
    <?php
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 1;
		if ($ptov_url == ''){
		$query_prod = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1 ORDER BY `f_fact` ASC ";
		}else{
			$query_prod = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1 AND `punto_venta`='$ptov_url' ORDER BY `f_fact` ASC ";
		}
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		//echo 3;
		if ($ptov_url == ''){
		$query_prod = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1 
		AND YEAR(f_fact) = '$year_url' ORDER BY `f_fact` ASC";
		}else{
			$query_prod = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1 
		AND YEAR(f_fact) = '$year_url' AND `punto_venta`='$ptov_url' ORDER BY `f_fact` ASC";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		//echo 5;
		if ($ptov_url == ''){
		$query_prod = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
		AND YEAR(f_fact) = '$year_url' AND MONTH(f_fact) = '$month_url' ORDER BY `f_fact` ASC";
		}else{
			$query_prod = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
		AND YEAR(f_fact) = '$year_url' AND MONTH(f_fact) = '$month_url' AND `punto_venta`='$ptov_url' ORDER BY `f_fact` ASC";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		//echo 7;
		if ($ptov_url == ''){
		$query_prod = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
		AND YEAR(f_fact) = '$year_url' AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' ORDER BY `f_fact` ASC";
		}else{
			$query_prod = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
		AND YEAR(f_fact) = '$year_url' AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' AND `punto_venta`='$ptov_url' ORDER BY `f_fact` ASC";
		}
		
	}
	$prod = mysql_query($query_prod, $conexion) or die(mysql_error()); 
	while($row_prod = mysql_fetch_assoc($prod)){
		$consec = $row_prod['consec'];
		$ptov = $row_prod['punto_venta'];
		$estado = $row_prod['delete'];
		if ($estado == 0){
	?>
    <tr class="row" onClick="mostrar('../../compras/compras_fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
      <td align="center" ><?php echo $row_prod['f_fact']?></td>
      <td align="center" ><?php echo $consec?></td>
      <td align="center" ><?php echo $row_prod['cliente']?></td>
      <td align="center" ><?php echo $row_prod['ced']?></td>
      <td align="center" ><?php echo $ptov?></td>
      <td align="center" ><?php echo $row_prod['f_fact']?></td>
      <td align="center" >
      <label id="lb_val<?php echo $i?>" class="val"><?php echo number_format($row_prod['costo'], 2)?></label>
      </td>
      <td>&nbsp;</td>
    </tr>
    <?php 
		$i++;
		}
		if ($estado == 2){
	?>
    <tr class="row" onClick="mostrar('../../compras/compras_fact1.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
      <td align="center" ><?php echo $row_prod['fecha']?></td>
      <td align="center" ><?php echo $consec?></td>
      <td align="center" ><?php echo $row_prod['cliente']?></td>
      <td align="center" ><?php echo $row_prod['ced']?></td>
      <td align="center" ><?php echo $ptov?></td>
      <td align="center" ><?php echo $row_prod['f_fact']?></td>
      <td align="center" >
      <label id="lb_val<?php echo $i?>" class="val"><?php echo number_format($row_prod['costo'], 2)?></label>
      </td>
      <td align="center"><label class="red">Anulada</label></td>
    </tr>
    <?php 
		$i++;
		}
		
	}
	?>
    <td colspan="8">&nbsp;</td>
    <tr>
    <td colspan="6" align="right"><label class="red">Total</label></td>
    <td align="center" colspan="2"><label id="lb_tot" class="red"></label></td>
    </tr>
    <td colspan="8" align="center">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.close();">
    </td>
    
</table>
&nbsp;
</div>
</div>
</div>

</body>

<script>

$(document).ready(function() {
    $('#month').hide();
	$('#day').hide();
	load1();
	//console.log('priueba')
	$('#sl_ptov').bind('change', function (){
		load0();	
	});
});

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
	var c = $('#tf_idclient').val();
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#year').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #year' );
	
	$('#month').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #d_table ' , 
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
	var d = $('#tf_day').val();
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var c = $('#tf_idclient').val();
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#year').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #year' );
	
	$('#month').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #d_table ' , 
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
	var c = $('#tf_idclient').val();
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#month').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #d_table ', 
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
	var c = $('#tf_idclient').val();
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);	
	$('#day').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#d_table').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #d_table ' , 
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
	var c = $('#tf_idclient').val();
		
	//console.log ('r:'+r+' y:'+y+' m:'+m+' d:'+d);
	$('#d_table').load('prove_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&id=' + c.replace(/ /g,"+") +' #d_table ' , 
	function(response, status, xhr){
		//console.log('r:'+response+' s:'+status+' x: '+xhr);
		//console.log(status);	
		if (status == 'success'){
			totcosto();
		}
	});
	
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
overlay.click(function(){
	window.win.focus()
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
?>