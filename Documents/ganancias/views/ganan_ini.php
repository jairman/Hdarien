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

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$y = date ('Y');
$m = date ('m');
$d = date ('d');

$ptov_url=$_GET['p'];
$day_url=$_GET['d'];
$month_url=$_GET['m'];
$year_url=$_GET['y'];

$i = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Facturación</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/ganan_ini.js" type="text/javascript"></script>
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
<input type="hidden" id="tf_m" value="<?php echo $m ?>">
<input type="hidden" id="tf_y" value="<?php echo $y ?>">
<input type="hidden" id="tf_d" value="<?php echo $d ?>">

<div id="dialog"></div>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="84%" align="left">
    <div id="menu">
      <ul>
      <li>
      <a href="../../facturacion/views/fact_histo.php?r=<?php echo $ref_url ?>" >Reporte de Ventas</a>
      </li>
      <li>
      <a  href="../../facturacion/views/fact_crehisto.php?r=<?php echo $ref_url ?>"  >Reporte de Créditos</a>
      </li>
      <li>
      <a  href="ganan_ini.php" class='active' >Reporte de Utilidades</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="8%" align="left">
    <!--<img  title="Graficas" src="../img/chart.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="graficas()"/>-->
    </td>
    <td width="8%" align="left">
    <img  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')"/>
    </td>
  </tr>
</table>
<div id="recargar2">
<div id="main">
&nbsp;

<table width="95%" align="center">
	<tr>
    <td colspan="4" align="center" class="tittle">Reporte Utilidad</td>
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
    <select name="sl_year" id="sl_year" onChange="load2()" style="width:80px" >
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
    <select name="sl_month" id="sl_month" onChange="load3()" style="width:80px">
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
    <select name="sl_day" id="sl_day" onChange="load4()" style="width:80px">
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
<table width="95%" align="center">
	<tr>
    <td align="right" width="40%" class="bold">Facturado</td>
    <?php 
	//echo 'p:'.$ptov_url.' y:'.$year_url.' m:'.$month_url.' d:'.$day_url;
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		if ($ptov_url == ''){
			//echo '1'.'-'.$ptov_url.'-';
			$query_fact = "SELECT sum(tot_final) as totalsuma FROM `h01sg_venta` WHERE `delete`<>1 ";
			$query_consec = "SELECT `consec`, `punto_venta` FROM `h01sg_venta` WHERE `delete`=2 ";
			$query_prod = "SELECT DISTINCT `ref` FROM `h01sg_venta_detalle` WHERE `delete`<>1 ";
		}else{
			//echo '2'.'-'.$ptov_url.' ';
			$query_fact = "SELECT sum(tot_final) as totalsuma FROM `h01sg_venta` WHERE `delete`<>1 AND `punto_venta`='$ptov_url' ";
			$query_consec = "SELECT `consec`, `punto_venta` FROM `h01sg_venta` WHERE `delete`=2 AND `punto_venta`='$ptov_url' ";
			$query_prod = "SELECT DISTINCT `ref` FROM `h01sg_venta_detalle` WHERE `delete`<>1 AND `punto_venta`='$ptov_url'";
		}
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		if ($ptov_url == ''){
			//echo '3'.'-'.$ptov_url.' ';
			$query_fact = "SELECT sum(tot_final) as totalsuma FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND `delete`<>1 ";
			$query_consec = "SELECT `consec`, `punto_venta` FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url'  AND `delete`=2 ";
			$query_prod = "SELECT DISTINCT `ref` FROM `h01sg_venta_detalle` WHERE YEAR(fecha)='$year_url' AND `delete`<>1 ";
		}else{
			//echo '4'.'-'.$ptov_url.' ';
			$query_fact = "SELECT sum(tot_final) as totalsuma FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' 
			AND `delete`<>1 AND `punto_venta`='$ptov_url' ";
			$query_consec = "SELECT `consec`, `punto_venta` FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url'
			AND `delete`=2 AND `punto_venta`='$ptov_url' ";
			$query_prod = "SELECT DISTINCT `ref` FROM `h01sg_venta_detalle` WHERE YEAR(fecha)='$year_url' 
			AND `delete`<>1 AND `punto_venta`='$ptov_url'";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		if ($ptov_url == ''){
			//echo '5'.'-'.$ptov_url.' ';
			$query_fact = "SELECT sum(tot_final) as totalsuma FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			AND `delete`<>1 ";
			$query_consec = "SELECT `consec`, `punto_venta` FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			AND `delete`=2 ";
			$query_prod = "SELECT DISTINCT `ref` FROM `h01sg_venta_detalle` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
			AND `delete`<>1 ";
		}else{
			//echo '6'.'-'.$ptov_url.' ';
			$query_fact = "SELECT sum(tot_final) as totalsuma FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			AND `delete`<>1 AND `punto_venta`='$ptov_url' ";
			$query_consec = "SELECT `consec`, `punto_venta` FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			AND `delete`=2 AND `punto_venta`='$ptov_url' ";
			$query_prod = "SELECT DISTINCT `ref` FROM `h01sg_venta_detalle` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
			AND `delete`<>1 AND `punto_venta`='$ptov_url' ";
		}
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		if ($ptov_url == ''){
			//echo '7'.'-'.$ptov_url.' ';
			$query_fact = "SELECT sum(tot_final) as totalsuma FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			AND DAY(fecha)='$day_url' AND `delete`<>1 ";
			$query_consec = "SELECT `consec`, `punto_venta` FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			AND DAY(fecha)='$day_url' AND `delete`=2 ";
			$query_prod = "SELECT DISTINCT `ref` FROM `h01sg_venta_detalle` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
			AND DAY(fecha)='$day_url' AND `delete`<>1 ";
		}else{
			//echo '8'.'-'.$ptov_url.' ';
			$query_fact = "SELECT sum(tot_final) as totalsuma FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			AND DAY(fecha)='$day_url' AND `delete`<>1 AND `punto_venta`='$ptov_url' ";
			$query_consec = "SELECT `consec`, `punto_venta` FROM `h01sg_venta` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' 
			AND DAY(fecha)='$day_url' AND `delete`=2 AND `punto_venta`='$ptov_url' ";
			$query_prod = "SELECT DISTINCT `ref` FROM `h01sg_venta_detalle` WHERE YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'
			AND DAY(fecha)='$day_url' AND `delete`<>1 AND `punto_venta`='$ptov_url' ";
		}
	}
	
	$costo = 0;
	
	$prod = mysql_query($query_prod, $conexion) or die(mysql_error()); 
	while($row_prod = mysql_fetch_assoc($prod)){
		$ref = $row_prod['ref'];
		if($year_url=='' && $month_url=='' && $day_url==''){
			if ($ptov_url == ''){
				$query_cant = "SELECT sum(cant) as totalcant FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `delete`<>1 ";
				$query_dev = "SELECT sum(cant_dev) as totaldev FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `delete`<>1 ";
				
			}else{
				$query_cant = "SELECT sum(cant) as totalcant FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND `punto_venta`='$ptov_url' ";
				$query_dev = "SELECT sum(cant_dev) as totaldev FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND `punto_venta`='$ptov_url'";
				
			}
		}
		if($year_url!='' && $month_url=='' && $day_url==''){
			if ($ptov_url == ''){
				$query_cant = "SELECT sum(cant) as totalcant FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' ";
				$query_dev = "SELECT sum(cant_dev) as totaldev FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url'";
				
			}else{
				$query_cant = "SELECT sum(cant) as totalcant FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND `punto_venta`='$ptov_url' ";
				$query_dev = "SELECT sum(cant_dev) as totaldev FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND `punto_venta`='$ptov_url' ";
				
			}
		}
		if($year_url!='' && $month_url!='' && $day_url==''){
			if ($ptov_url == ''){
				$query_cant = "SELECT sum(cant) as totalcant FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' ";
				$query_dev = "SELECT sum(cant_dev) as totaldev FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url'";
				
			}else{
				$query_cant = "SELECT sum(cant) as totalcant FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' AND `punto_venta`='$ptov_url' ";
				$query_dev = "SELECT sum(cant_dev) as totaldev FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' AND `punto_venta`='$ptov_url'";
				
			}
		}
		if($year_url!='' && $month_url!='' && $day_url!=''){
			if ($ptov_url == ''){
				$query_cant = "SELECT sum(cant) as totalcant FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' AND DAY(fecha)='$day_url' ";
				$query_dev = "SELECT sum(cant_dev) as totaldev FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' AND DAY(fecha)='$day_url'";
				
			}else{
				$query_cant = "SELECT sum(cant) as totalcant FROM `h01sg_venta_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' AND DAY(fecha)='$day_url' AND `punto_venta`='$ptov_url' ";
				$query_dev = "SELECT sum(cant_dev) as totaldev FROM `h01sg_devoluciones_detalle` WHERE `ref`='$ref' AND `delete`<>1 
				AND YEAR(fecha)='$year_url' AND MONTH(fecha)='$month_url' AND DAY(fecha)='$day_url' AND `punto_venta`='$ptov_url' ";
				
			}
		}
		$cant = mysql_query($query_cant, $conexion) or die(mysql_error()); 
		$dev = mysql_query($query_dev, $conexion) or die(mysql_error()); 
		$row_cant = mysql_fetch_assoc($cant);
		$row_dev = mysql_fetch_assoc($dev);	
		$cant = $row_cant['totalcant'];
		$dev = $row_dev['totaldev'];
		$vent = $cant-$dev;
		$query_price = "SELECT `costo_und` FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1  ";
		$price = mysql_query($query_price, $conexion) or die(mysql_error()); 
		$row_price = mysql_fetch_assoc($price);
		$precio = $row_price['costo_und'];
		
		$costo = $costo + ($vent * $precio);
	}
	
	$fact = mysql_query($query_fact, $conexion) or die(mysql_error()); 
	$consec = mysql_query($query_consec, $conexion) or die(mysql_error()); 
	$row_fact = mysql_fetch_assoc($fact);
	$devo_t = 0;
	//echo ' n:'.mysql_num_rows($consec).'-';
	while($row_consec = @mysql_fetch_assoc($consec)){
		$c = $row_consec['consec'];
		$p = $row_consec['punto_venta'];
		if ($p == ''){
			$query_sdevo = "SELECT sum(s_favor) as sum FROM `h01sg_devoluciones` WHERE  `consec`='$c' AND `delete`<>1";
			$sdevo = mysql_query($query_sdevo, $conexion) or die(mysql_error()); 
			$row_sdevo = mysql_fetch_assoc($sdevo);
			$saldo = $row_sdevo['sum'];
			$devo_t = $devo_t + $saldo;
		}else{
			$query_sdevo = "SELECT `s_favor` FROM `h01sg_devoluciones` WHERE `consec`='$c' AND `delete`<>1 
			AND `punto_venta`='$p'";
			$sdevo = mysql_query($query_sdevo, $conexion) or die(mysql_error());
			$row_sdevo = mysql_fetch_assoc($sdevo);
			$saldo = $row_sdevo['s_favor']; 
			$devo_t = $devo_t + $saldo;
		}
		//echo 'x';
	}
	//echo $devo_t;
	
	$t = $row_fact['totalsuma'] - $devo_t;
	$sub = $t / 1.16; 
	$i = $t - $sub;
	$u = ($t - $i) - $costo; 
	?>
    <td align="center" class="cont"><label class="red"><?php echo number_format($t, 2)?></label></td>
  </tr>
    <tr>
    <td align="right" class="bold">IVA</td>
    <td align="center" class="cont"><label class="red"><?php echo number_format($i, 2)?></label></td>
  </tr>
    <tr>
    <td align="right" class="bold">Costo</td>
    <td align="center" class="cont"><label class="red"><?php echo number_format($costo, 2)?></label></td>
  </tr>
    <tr>
    <td align="right" class="bold">Utilidad</td>
    <td align="center" class="cont"><label class="red"><?php echo number_format($u, 2)?></label></td>
  </tr>
</table>
&nbsp;
</div>
</div>
</div>
</body>
<script>

</script>
</html>
<?php
}
?>