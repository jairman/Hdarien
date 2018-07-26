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
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/fact_crehisto.js" type="text/javascript"></script>

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
      <a href="fact_histo.php?r=<?php echo $ref_url ?>" >Reporte de Ventas</a>
      </li>
      <li>
      <a  href="fact_crehisto.php?r=<?php echo $ref_url ?>" class='active' >Reporte de Créditos</a>
      </li>
      <li>
      <a  href="../../ganancias/views/ganan_ini.php" class='active' >Reporte de Utilidades</a>
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
    <td colspan="4" align="right">&nbsp;</td>
    </tr>
	<tr>
    <td colspan="4" align="center" class="tittle">Reporte de Créditos</td>
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
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['fecha']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $consec?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['cliente']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['ced']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $ptov?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['total_items']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['dctof']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
      <label id="lb_val<?php echo $i?>" class="val"><?php echo number_format($row_prod['valor_tot'], 2)?></label>
      </td>
      <td align="center"><input name="imgb" type="image" id="img<? echo $i; ?>" 
      src="../../img/edit.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Editar"
      onClick="editar1('<?php echo $consec ?>', '<?php echo $ptov?>')" ></td>
    </tr>
    <?php 
		$i++;
		}
		if ($estado == 2){
	?>
    <tr class="row" >
      <td align="center" onClick="mostrar('../views/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['fecha']?></td>
      <td align="center" onClick="mostrar('../views/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $consec?></td>
      <td align="center" onClick="mostrar('../views/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['cliente']?></td>
      <td align="center" onClick="mostrar('../views/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['ced']?></td>
      <td align="center" onClick="mostrar('../views/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $ptov?></td>
      <td align="center" onClick="mostrar('../views/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['total_items']?></td>
      <td align="center" onClick="mostrar('../views/factd.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['dctof']?></td>
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
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['fecha']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $consec?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['cliente']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['ced']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $ptov?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['total_items']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')"><?php echo $row_prod['dctof']?></td>
      <td align="center" onClick="mostrar('../views/fact.php?c=<?php echo $consec ?>&p=<?php echo $ptov ?>')">
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

</html>
<?php
}
?>