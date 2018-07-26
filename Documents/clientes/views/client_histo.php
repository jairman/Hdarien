<?php require_once('../controllers/joom.php'); ?>
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

@$day_url=$_GET['d'];
@$month_url=$_GET['m'];
@$year_url=$_GET['y'];
@$ptov_url=$_GET['p'];
@$idc_url=$_GET['id'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$y = date ('Y');
$m = date ('m');
$d = date ('d');

$i=1;

mysql_select_db($database_conexion, $conexion);
@$query_clien = sprintf("SELECT * FROM d89xz_clientes WHERE id='$idc_url'", GetSQLValueString($colname_clien, "int"));
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
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../.././../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/client_histo.js" type="text/javascript"></script>
<style>
#year, #month, #day{
	/*display:inline-block;*/
	float:left;
	/*width:100%;*/
}
</style>
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
      <a href="../views/verClientes.php?id=<?php echo $idc_url ?>" >Información del Cliente</a>
      </li>
      <li>
      <a  href="../views/client_histo.php?id=<?php echo $idc_url ?>" class='active'>Historial de Facturación</a>
      </li>
      <li>
      <a  href="../../caja/views/dia_dia_pendiente_cliente.php?id=<?php echo $idc_url ?>" >Cuentas Por Cobrar</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="left">&nbsp;</td>
  </tr>
</table>
<div id="recargar2">
<div id="main">
&nbsp;

<table width="95%" align="center">
<tr>
<td  align="left" ><img src="../../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
<td  align="center" ><input name="imgb" type="image"  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0" align="right" style="cursor:pointer" onClick="imprimir_esto('recargar2')"/></td>
</tr>
</table>
<table width="95%" align="center">
	<tr>
    <td colspan="4" align="center" class="tittle">Reporte de Ventas</td>
    </tr>
    <tr>
    <td class="bold">Nombre</td>
    <td class="cont bold"><input type="text" class="long" value="<?php echo $c_nombre?>" readonly></td>
    <td class="bold">Cédula</td>
    <td class="cont bold"><input type="text" class="long" value="<?php echo $c_ced?>" readonly></td>
    </tr>
	<tr>
	<td class="bold cont" width="19%">
    Punto de Venta
    </td>
    <td class="bold cont" width="31%">
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
	<td class="bold cont" align="left" width="12%">
    Fecha
    </td>
    <td class="bold cont" align="right" width="38%"> 
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
			$query_anos = "SELECT DISTINCT YEAR(fecha)  FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1 ORDER BY YEAR(fecha) DESC";
		}else{
			$query_anos = "SELECT DISTINCT YEAR(fecha)  FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1
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
    <select name="sl_month" id="sl_month" onChange="load3()" style="width:80px">
        <option value="">Mes</option>
        <?php
		//echo $year_url;
		mysql_select_db($database_conexion, $conexion);
		//echo 'monthq';
		if ($ptov_url == ''){
			$query_mes = "SELECT DISTINCT MONTH(fecha) , MONTHNAME(fecha) FROM `h01sg_venta` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(fecha)='$year_url' 
			ORDER BY MONTH(fecha) DESC";
		}else{
			$query_mes = "SELECT DISTINCT MONTH(fecha) , MONTHNAME(fecha) FROM `h01sg_venta` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(fecha)='$year_url' 
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
    <select name="sl_day" id="sl_day" onChange="load4()" style="width:80px">
        <option value="">Día</option>
        <?php
		mysql_select_db($database_conexion, $conexion);
		//echo 'dayq';
		if ($ptov_url == ''){
			$query_dia = "SELECT DISTINCT DAY(fecha)  FROM `h01sg_venta` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
			ORDER BY DAY(fecha) ASC";
		}else{
			$query_dia = "SELECT DISTINCT DAY(fecha)  FROM `h01sg_venta` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
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
    <tr class="tittle">
      <td width="13%">Fecha</td>
      <td width="18%">Factura No</td>
      <td width="25%">Origen</td>
      <td width="24%">Articulos</td>
      <td width="20%">Total</td> 
      </tr>
    <?php
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 1;
		if ($ptov_url == ''){
		$query_prod = "SELECT * FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1 ORDER BY `fecha` ASC ";
		}else{
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1 AND `punto_venta`='$ptov_url' ORDER BY `fecha` ASC ";
		}
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		//echo 3;
		if ($ptov_url == ''){
		$query_prod = "SELECT * FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1 
		AND YEAR(fecha) = '$year_url' ORDER BY `fecha` ASC";
		}else{
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1 
		AND YEAR(fecha) = '$year_url' AND `punto_venta`='$ptov_url' ORDER BY `fecha` ASC";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		//echo 5;
		if ($ptov_url == ''){
		$query_prod = "SELECT * FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1
		AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' ORDER BY `fecha` ASC";
		}else{
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1
		AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' AND `punto_venta`='$ptov_url' ORDER BY `fecha` ASC";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		//echo 7;
		if ($ptov_url == ''){
				//echo 71;
		$query_prod = "SELECT * FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1
		AND YEAR(fecha) = '$year_url'  ORDER BY `fecha` ASC";
		//AND YEAR(fecha) = '$year_url' AND MONTH(fecha) = '$month_url' AND DAY(fecha) = '$day_url' ORDER BY `fecha` ASC";
		}else{
				//echo 72;
			$query_prod = "SELECT * FROM `h01sg_venta` WHERE `ced`='$c_ced' AND `delete`<>1
		AND YEAR(fecha) = '$year_url'  AND `punto_venta`='$ptov_url' ORDER BY `fecha` ASC";
		}
		
	}
	$prod = mysql_query($query_prod, $conexion) or die(mysql_error()); 
	while($row_prod = mysql_fetch_assoc($prod)){
		$consec = $row_prod['consec'];
		$ptov = $row_prod['punto_venta'];
		$estado = $row_prod['delete'];
		if ($estado == 0){
	?>
    <tr class="row" onClick="mostrar('../../facturacion/views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
      <td align="center" ><?php echo $row_prod['fecha']?></td>
      <td align="center" ><?php echo $consec?></td>
      <td align="center" ><?php echo $ptov?></td>
      <td align="center" ><?php echo $row_prod['total_items']?></td>
      <td align="center" >
        <label id="lb_val<?php echo $i?>" class="val"><?php echo number_format($row_prod['valor_tot'], 2)?></label>
      </td>
      </tr>
    <?php 
		$i++;
		}
		if ($estado == 2){
	?>
    <tr class="row" onClick="mostrar('../../facturacion/views/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
      <td align="center" ><?php echo $row_prod['fecha']?></td>
      <td align="center" ><?php echo $consec?></td>
      <td align="center" ><?php echo $ptov?></td>
      <td align="center" ><?php echo $row_prod['total_items']?></td>
      <td align="center" >  
        <?php 
		mysql_select_db($database_conexion, $conexion);
		$factd = mysql_query("SELECT * FROM `h01sg_devoluciones` WHERE `consec`='$consec' AND `delete`<>1 ", $conexion) or die(mysql_error());
		$row_factd = mysql_fetch_assoc($factd);	
		?>
      
      <label id="lb_val<?php echo $i?>" class="val red"><?php echo number_format($row_factd['total'], 2)?></label></td>
    
      
    </tr>
    <?php 
		$i++;
		}
		
	}
	?>
    <td colspan="5">&nbsp;</td>
    <tr>
    <td colspan="4" align="right"><label class="red">Total</label></td>
    <td align="center"><label id="lb_tot" class="red"></label></td>
    </tr>
    <td colspan="5" align="center">
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




</script>

</html>
<?php
?>
