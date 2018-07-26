<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php') ?>

<?php
//echo $acceso.'-'.$usuario2.'-'.$usuario;
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
$order_url=$_GET['o'];
$i = 0;

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$c_date = date('Y-m-d');

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Historial de Cierre</title>
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

<div id="dialog"></div>

<table width="90%" align="center" id="table_header">
  <tr>
    <td width="76%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="../inventario/invent_ini.php" >Reporte de Inventario</a>
      </li>
      <li>
      <a  href="../inventario/invent_ini2.php">Reporte de Productos Vendidos</a>
      </li>
      <li>
      <a  href="../cierre/cierre_histo.php" class='active'>Cierre de Inventario</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="8%">
    &nbsp;    
    </td>
    <td width="8%">
    <input type="image" src="../img/cierre.png" alt="" width="48" height="48" border="0" align="right" 
    title="Cierre de Inventario" id="bt_cierrei" style="cursor:pointer" >
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
<table width="90%" align="center">
    <tr class="tittle">
    <td>Historial de Cierre</td>
    </tr>
</table>
<table width="90%" align="center" >
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
		echo 'pru';
		mysql_select_db($database_conexion, $conexion);
		echo 'yearq';
		if ($ptov_url == ''){
			$query_anos = "SELECT DISTINCT YEAR(fecha)  FROM `h01sg_inventario_cierre` WHERE `delete`<>1
			ORDER BY YEAR(fecha) DESC";
			
		}else{
			$query_anos = "SELECT DISTINCT YEAR(fecha)  FROM `h01sg_inventario_cierre` WHERE `delete`<>1
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
    
    <select name="sl_month" id="sl_month" onChange="load3()" style="width:80px">
        <option value="">Mes</option>
        <?php
		echo $year_url;
		mysql_select_db($database_conexion, $conexion);
		echo 'monthq';
		if ($ptov_url == ''){
			$query_mes = "SELECT DISTINCT MONTH(fecha) , MONTHNAME(fecha) FROM `h01sg_inventario_cierre` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' ORDER BY MONTH(fecha) DESC";
		}else{
			$query_mes = "SELECT DISTINCT MONTH(fecha) , MONTHNAME(fecha) FROM `h01sg_inventario_cierre` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' AND `punto_venta`='$ptov_url' ORDER BY MONTH(fecha) DESC";
		}
		
		$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
		echo $n = mysql_num_rows($mes);
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
    <select name="sl_day" id="sl_day" onChange="load4()" style="width:80px">
        <option value="">Día</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		echo 'dayq';
		if ($ptov_url == ''){
			$query_dia = "SELECT DISTINCT DAY(fecha)  FROM `h01sg_inventario_cierre` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			ORDER BY DAY(fecha) ASC";
		}else{
			$query_dia = "SELECT DISTINCT DAY(fecha)  FROM `h01sg_inventario_cierre` 
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
<div id="table" >
<table width="90%" border="1" align="center" cellspacing="0" id="tb_data">
  <tr class="stittle">
  	<td align="center" width="14%" onClick="orden_bus('fecha')" style="cursor:pointer" title="Ordenar por Fecha">Fecha</td>
    <td align="center" width="12%" onClick="orden_bus('consec')" style="cursor:pointer" title="Ordenar por No Consecutivo">No</td>
    <td align="center" width="14%" onClick="orden_bus('punto_venta')" style="cursor:pointer" title="Ordenar por Punto de Venta">Punto de Venta</td>
    <td align="center" width="14%" onClick="orden_bus('marca')" style="cursor:pointer" title="Ordenar por marca">Marca</td>
    <td align="center" width="14%" onClick="orden_bus('prove')" style="cursor:pointer" title="Ordenar por marca">Provedor</td>
    <td align="center" width="22%" onClick="orden_bus('obs')" style="cursor:pointer" title="Ordenar por Observaciones">Observaciones</td>
    <td align="center" width="8%">&nbsp;</td>
  </tr>
  <?php
    //echo $year_url.'-'.$month_url.'-'.$day_url;
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 2;
		if ($ptov_url == ''){
			$query_muerte = "SELECT * FROM `h01sg_inventario_cierre` WHERE 'delete'<>1 $order_url";
		}else{
			$query_muerte = "SELECT * FROM `h01sg_inventario_cierre` WHERE 'delete'<>1 AND `punto_venta`='$ptov_url' $order_url";
		}
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		//echo 4;
		if ($ptov_url == ''){
			$query_muerte = "SELECT * FROM `h01sg_inventario_cierre` WHERE 'delete'<>1 AND YEAR(fecha) = '$year_url'
			$order_url";
		}else{
			$query_muerte = "SELECT * FROM `h01sg_inventario_cierre` WHERE 'delete'<>1 AND YEAR(fecha) = '$year_url'
			AND `punto_venta`='$ptov_url' $order_url";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		//echo 6;
		if ($ptov_url == ''){
			$query_muerte = "SELECT * FROM `h01sg_inventario_cierre` WHERE 'delete'<>1 AND YEAR(fecha) = '$year_url'
			AND MONTH(fecha) = '$month_url' $order_url";
		}else{
			$query_muerte = "SELECT * FROM `h01sg_inventario_cierre` WHERE 'delete'<>1 AND YEAR(fecha) = '$year_url'
			AND MONTH(fecha) = '$month_url' AND `punto_venta`='$ptov_url' $order_url";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		//echo 8;
		if ($ptov_url == ''){
			$query_muerte = "SELECT * FROM `h01sg_inventario_cierre` WHERE 'delete'<>1 AND YEAR(fecha) = '$year_url'
			AND MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' $order_url";	
		}else{
			$query_muerte = "SELECT * FROM `h01sg_inventario_cierre` WHERE 'delete'<>1 AND YEAR(fecha) = '$year_url'
			AND MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' AND `punto_venta`='$ptov_url' $order_url";
		}
	}
	$muerte = mysql_query($query_muerte, $conexion) or die(mysql_error());
	//echo $tm = mysql_num_rows($muerte);  
  while($row_muerte = mysql_fetch_assoc($muerte)){
	  $estado = $row_muerte['delete'];
	  if ($estado == 0){
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../cierre/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
    <?php echo $row_muerte['fecha']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['marca']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['prove']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
    <?php echo $row_muerte['obs']?>
    </td>
    <td align="center" >
    <input name="imgb" type="image" id="img<? echo $i; ?>" 
      src="../img/edit.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Editar"
      onClick="editar('<?php echo $row_muerte['consec'] ?>')" >
    </td>   
    
  </tr>
  <?php
  $i++;
	  }
	  if ($estado == 2){
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../cierre/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
    <?php echo $row_muerte['fecha']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['marca']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['prove']?>
    </td>
    <td align="center" 
    onClick="mostrar('../cierre/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
    <?php echo $row_muerte['obs']?>
    </td>
    <td align="center" >&nbsp;</td>   
    
  </tr>
  <?php
  $i++;
	  }
  }
  ?>
</table>
</div>
&nbsp;
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
	//console.log('prueba');
	load1();
	
	$('#bt_addi').bind('click', function(){
		//console.log(2)
		invent_wind();
	});
	$('#bt_cierrei').bind('click', function(){
		//console.log(2)
		invent_close();
	});
	
	$('#sl_ptov').bind('change', function (){
		load0();	
	});
	
});

function editar(c){
	overlay.show()
	$("#dialog").html('&nbsp;Editar el Cierre No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="red('+c+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function red(c){
	var url = '../cierre/cierre_edit.php?c='+c;
	mostrar(url);
}

function invent_wind(){
	var url = '../inventario/invent_reg.php'
	//console.log(url);
	mostrar(url);
}

function invent_close(){
	var url = '../cierre/invent_cierre.php'
	//console.log(url);
	mostrar(url);
}

function load0(){
	var y = ''//$('#sl_year').val('');
	var m = ''//$('#sl_month').val('');
	var d = ''//$('#sl_day').val('');
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var o = '';
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('0y:'+y+' m:'+m+' d:'+d+' p:'+p);
	$('#year').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #year' );
	
	$('#month').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #month ' );
	
	$('#day').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #day' );
	
	$('#table').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+") +' #table ' );
}

function load1(){
	//console.log('prueba')
	
	var y = ''//$('#sl_year').val();
	var m = ''//$('#sl_month').val();
	var d = ''//$('#sl_day').val();
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var o = '';
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('1y:'+y+' m:'+m+' d:'+d+' p:'+p);
	
	$('#year').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #year' );
	
	$('#month').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #month ' );
	
	$('#day').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #day' );
	
	$('#table').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+") +' #table ' );
	
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
	var o = '';
	
	//console.log ('2y:'+y+' m:'+m+' d:'+d+' p:'+p);
	
	$('#month').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #month ' );
	
	$('#day').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #day' );
	
	$('#table').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+") +' #table ' );
	
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
	var o = '';
	//console.log ('3y:'+y+' m:'+m+' d:'+d+' p:'+p);
	
	$('#day').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  +' #day' );
	
	$('#table').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+") +' #table ' );
	
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
	var o = '';	
	//console.log ('4y:'+y+' m:'+m+' d:'+d+' p:'+p);
	$('#table').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+")  +' #table ' );
}

function load5(){
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
	var o = '';
	
	//console.log ('5y:'+y+' m:'+m+' d:'+d+' p:'+p);
	$('#table').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&o=' + o.replace(/ /g,"+")  +' #table ' );
}

function orden_bus(tipo){
	window.band2=!window.band2;
	if(window.band2==true) ord='ASC';
	else ord='DESC'
	var order = 'ORDER BY '+tipo+' '+ord
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
	var o = '';
	
	//console.log ('5y:'+y+' m:'+m+' d:'+d+' p:'+p);
	$('#table').load('cierre_histo.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") +'&o=' + order.replace(/ /g,"+")  +' #table ' );
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
         removeInline: false       
	  });
}

</script>
</html>
<?php
}
?>