<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php') ?>

<?php

if ($acceso !='0'){
?>
<table width="70%" border="0" align="center">
  <tr>
    <td><img src="../../img/Logo.png" width="886" height="248" /></td>
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

$ref_url = $_GET['r']; 
$day_url=$_GET['d'];
$month_url=$_GET['m'];
$year_url=$_GET['y'];
$order_url=$_GET['o'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

mysql_select_db($database_conexion, $conexion);
$query_prod = "SELECT `id`, `ref`, `img_id`, `fecha`, `cod_barra`, `rfid`, `marca`, `desc`, `precio_und`, `costo_und`, `user`, `tiem`, `delete` FROM `h01sg_producto` WHERE `ref`='$ref_url' AND `delete`<>1 ";
$prod = mysql_query($query_prod, $conexion) or die(mysql_error()); 
$row_prod = mysql_fetch_assoc($prod);

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Historial de movimientos</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/invent_mov.js" type="text/javascript"></script>

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
<input type="hidden" id="tf_ref" value="<?php echo $ref_url ?>">
<div id="dialog"></div>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="invent_ficha.php?r=<?php echo $ref_url ?>" >Información del Producto</a>
      </li>
      <li>
      <a  href="invent_mov.php?r=<?php echo $ref_url ?>" class='active'>Historial de Entradas</a>
      </li>
      <li>
      <a  href="../../facturacion/views/fact_phisto.php?r=<?php echo $ref_url ?>" >Historial de Salidas</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="left">
    <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" >
	</td>
  </tr>
</table>
<div id="recargar2">
<div id="main">

&nbsp;
<table width="95%" align="center" id="table_header">
    <tr>
      <td align="left" >
      <img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" />
      </td>
    </tr>
</table>
<table width="95%" align="center">
	<tr>
    <td width="20%" class="bold">Referencia</td>
    <td width="30%" class="cont">
    <input name="tf_ref" type="text" class="long red" id="tf_ref" 
    readonly="readonly" value="<?php echo $row_prod['ref']?>">
    </td>
    <td width="20%" class="bold">Descripción</td>
    <td width="30%" class="cont">
    <input name="tf_desc" type="text" class="long" id="tf_desc" 
    readonly="readonly" value="<?php echo $row_prod['desc']?>">
    </td>
    </tr>
    <tr>
    <td class="bold">Talla</td>
    <td class="cont">
    <input name="tf_talla" type="text" class="long" id="tf_talla" 
    readonly="readonly" value="<?php echo $row_prod['talla']?>" >
    </td>
    <td class="bold">Marca</td>
    <td class="cont">
    <input name="tf_marca" type="text" class="long" id="tf_marca" 
    readonly="readonly" value="<?php echo $row_prod['marca']?>">
    </td>
    </tr>
    <tr>
    <td class="bold">Precio</td>
    <td class="cont">
    <input name="tf_precio" type="text" class="long" id="tf_precio" 
    readonly="readonly" value="<?php echo $row_prod['precio_und']?>" >
    </td>
    <td class="bold">&nbsp;</td>
    <td class="cont">&nbsp;</td>
    </tr>
</table>
<table width="95%" align="center">
	<tr>
        <td class="tittle" align="center" colspan="2">
		Historial de Movimientos
        </td>
    </tr>
	<tr>	
        <td class="bold cont" align="right" width="50%">
    Seleccione una Fecha:
    	</td>
        <td class="bold cont" align="right" width="50%"> 
    <div id="year" align="right">
    <?php
    //echo 'year';
	?>
    <select name="sl_year" id="sl_year" onChange="load2()" style="width:100px" >
        <option value="">Año</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		//echo 'yearq';
			$query_anos = "SELECT DISTINCT YEAR(fecha)  FROM `h01sg_inventario_detalle` WHERE `delete`<>1
			AND `ref`= '$ref_url' ORDER BY YEAR(fecha) DESC";
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
    <select name="sl_month" id="sl_month" onChange="load3()" style="width:100px">
        <option value="">Mes</option>
        <?php
		//echo $year_url;
		mysql_select_db($database_conexion, $conexion);
		//echo 'monthq';
			$query_mes = "SELECT DISTINCT MONTH(fecha) , MONTHNAME(fecha) FROM `h01sg_inventario_detalle` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' 
			AND `ref`='$ref_url' ORDER BY MONTH(fecha) DESC";
		
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
    <select name="sl_day" id="sl_day" onChange="load4()" style="width:100px">
        <option value="">Día</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		//echo 'dayq';
			$query_dia = "SELECT DISTINCT DAY(fecha)  FROM `h01sg_inventario_detalle` 
			WHERE `delete`<>1 AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
			AND `ref`='$ref_url' ORDER BY DAY(fecha) ASC";
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
      <td onClick="orden_bus('fecha')" style="cursor:pointer" title="Ordenar por Fecha" >Fecha</td>
      <td onClick="orden_bus('mov')" style="cursor:pointer" title="Ordenar por Forma" >Forma</td>
      <td onClick="orden_bus('punto_ini')" style="cursor:pointer" title="Ordenar por Origen" >Origen</td>
      <td onClick="orden_bus('punto_venta')" style="cursor:pointer" title="Ordenar por Destino" >Destino</td>
      <td onClick="orden_bus('tipo_mov')" style="cursor:pointer" title="Ordenar por Tipo de Movimiento" >Tipo</td>
      <td onClick="orden_bus('cant')" style="cursor:pointer" title="Ordenar por Cantidad" >Cantidad</td>      
    </tr>
    <?php
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 1;
		$query_prod = "SELECT * FROM `h01sg_inventario_detalle` WHERE `ref`='$ref_url' AND `delete`<>1 $order_url ";
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		//echo 3;
		$query_prod = "SELECT * FROM `h01sg_inventario_detalle` WHERE `ref`='$ref_url' AND `delete`<>1 
		AND YEAR(fecha) = '$year_url' $order_url";
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		//echo 5;
		$query_prod = "SELECT * FROM `h01sg_inventario_detalle` WHERE `ref`='$ref_url' AND `delete`<>1
		AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' $order_url";
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		//echo 7;
		$query_prod = "SELECT * FROM `h01sg_inventario_detalle` WHERE `ref`='$ref_url' AND `delete`<>1
		AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' $order_url";
		
	}
	$prod = mysql_query($query_prod, $conexion) or die(mysql_error()); 
	while($row_prod = mysql_fetch_assoc($prod)){
	?>
    <tr>
      <td align="center" ><?php echo $fecha=$row_prod['fecha']?></td>
      <td align="center" ><?php 
	  $con = $row_prod['mov'];
	  $consec = $row_prod['consec'];
		if ($con == 't'){
			echo 'Traslados';  
		}
		if($con == 'd'){
			echo 'Despachos'; 
		}
		if ($con == 'c'){
			$q1 = "SELECT * FROM `h01sg_compra` WHERE `consec`='$consec' AND `delete`<>1";
			$q1 = mysql_query($q1, $conexion) or die(mysql_error()); 
			$row_q1 = mysql_fetch_assoc($q1);
			echo 'Compras'.' - '.$row_q1['f_pago']; 
		}
		if ($con == 'ci'){
			echo 'Cierre de Inventario'; 
		}
	  ?>
      </td>
      <td align="center" ><?php echo $row_prod['punto_ini']?></td>
      <td align="center" ><?php echo $row_prod['punto_venta']?></td>
      <td align="center" ><?php echo $row_prod['tipo_mov']?></td>
      <td align="center" ><?php echo $row_prod['cant']?></td>
    </tr>
    <?php
	}
	?>
    <tr>
    <td colspan="6" align="center">
    <input name="bt_close" type="button" class="ext" id="bt_close"
    value="Cerrar" onclick="window.close();">
    </td>
  </tr>
</table>
&nbsp;
</div>
</div>
</div>
</body>

</html>
<?php
}
?>