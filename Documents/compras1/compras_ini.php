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
$forma_url=$_GET['f'];
$order_url=$_GET['o'];

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
<title>Reporte Compras</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>
<script src="js/compras_ini.js" type="text/javascript"></script>

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

<table width="95%" align="center">
	<tr>
    <td width="68%">
    <div id="menu">
      <ul>
      <li>
      <a href="../cotizaciones/coti_ini.php" >Cotizaciones</a>
      </li>
      <li>
      <a  href="../pedidos/ped_ini.php">Pedidos</a>
      </li>
      <li>
      <a  href="../compras/compras_ini.php" class='active'>Compras</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="8%">
    <input type="image" src="../img/config.png" alt="" width="48" height="48" border="0" 
    align="right"  title="Configuración Formularios" id="bt_conf" style="cursor:pointer"> 
    </td>
    <td width="8%">
    <input type="image" src="../img/dev1.png" alt="" width="48" height="48" border="0" 
    align="right"  title="Devolución de Compras" id="bt_dev" style="cursor:pointer">    
    </td>
    <td width="8%">
    <input type="image" src="../img/add2.png" alt="" width="48" height="48" border="0" 
    align="right"  title="Registro de Compra" id="bt_addp" style="cursor:pointer" >    
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
<table width="95%" align="center">
	<tr class="tittle">
    <td colspan="4">Reporte de Compras</td>
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
    	<td class="bold cont" align="right" width="20%">Forma de Pago</td>
        <td class="bold cont" align="right" width="30%">
        <select name="sl_fpago" id="sl_fpago" class="long" align="center" onChange="load5()">
        <option value="">Seleccione</option>
        <option value="Contado">Contado</option>
        <option value="Consignación">Consignación</option>
        <option value="Credito">Credito</option>
        </select>
        </td>
    </tr>
    <tr>
    <td class="bold cont" align="right" width="20%">&nbsp;</td>
    <td class="bold cont" align="right" width="30%">&nbsp;</td>
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
			if ($forma_url == ''){
				$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `delete`<>1
			ORDER BY YEAR(f_fact) DESC";
			}else{
				$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `delete`<>1
				AND `forma_pago`='$forma_url' ORDER BY YEAR(f_fact) DESC";
			}
		}else{
			if ($forma_url == ''){
				$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `delete`<>1
			AND `punto_venta`='$ptov_url' ORDER BY YEAR(f_fact) DESC";
			}else{
				$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `delete`<>1
				AND `forma_pago`='$forma_url' AND `punto_venta`='$ptov_url' ORDER BY YEAR(f_fact) DESC";
			}
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
			if ($forma_url == ''){
				$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
			WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' ORDER BY MONTH(f_fact) DESC";
			}else{
				$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
				WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND `forma_pago`='$forma_url' ORDER BY MONTH(f_fact) DESC";
			}
		}else{
			if ($forma_url == ''){
				$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
			WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND `punto_venta`='$ptov_url' ORDER BY MONTH(f_fact) DESC";
			}else{
				$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
				WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND `punto_venta`='$ptov_url' 
				AND `forma_pago`='$forma_url' ORDER BY MONTH(f_fact) DESC";
			}
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
			if ($forma_url == ''){
				$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
			WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
			ORDER BY DAY(f_fact) ASC";
			}else{
				$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
				WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
				AND `forma_pago`='$forma_url' ORDER BY DAY(f_fact) ASC";
			}
		}else{
			if ($forma_url == ''){
				$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
			WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
			AND `punto_venta`='$ptov_url' ORDER BY DAY(f_fact) ASC";
			}else{
				$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
				WHERE `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
				AND `forma_pago`='$forma_url' AND `punto_venta`='$ptov_url' ORDER BY DAY(f_fact) ASC";
			}
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
<table width="95%" align="center" id="tb_data">
  <tr class="stittle">
  	<td align="center" width="10%" onClick="orden_bus('f_fact')" style="cursor:pointer" title="Ordenar por Fecha">Fecha</td>
    <td align="center" width="10%" onClick="orden_bus('consec')" style="cursor:pointer" title="Ordenar por No. de Factura">No</td>
    <td align="center" width="15%" onClick="orden_bus('punto_venta')" style="cursor:pointer" title="Ordenar por Punto de Venta">Punto de Venta</td>
    <td align="center" width="10%" onClick="orden_bus('ped')" style="cursor:pointer" title="Ordenar por No. de Pedido">Pedido No</td>
    <td align="center" width="15%" onClick="orden_bus('cliente')" style="cursor:pointer" title="Ordenar por Proveedor">Provedor</td>
    <td align="center" width="10%" onClick="orden_bus('forma_pago')" style="cursor:pointer" title="Ordenar por Forma de Pago">Forma de Pago</td>
    <td align="center" width="10%" onClick="orden_bus('cant')" style="cursor:pointer" title="Ordenar por No. de Items">Items</td>
    <td align="center" width="12%" onClick="orden_bus('costo')" style="cursor:pointer" title="Ordenar por Costo">Costo</td>
    <td align="center" width="8%">&nbsp;</td>
  </tr>
  <?php
  	//echo $order_url;
    //echo $year_url.'-'.$month_url.'-'.$day_url;
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 2;
		if ($ptov_url == ''){
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 $order_url";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND `forma_pago`='$forma_url' 
				$order_url";
			}
			
		}else{
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND `punto_venta`='$ptov_url' $order_url";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND `punto_venta`='$ptov_url'
				AND `forma_pago`='$forma_url' $order_url";
			}
			
		}
	
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		//echo 4;
		if ($ptov_url == ''){
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				$order_url";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' $order_url";
			}
		}else{
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND `punto_venta`='$ptov_url' $order_url";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' AND `punto_venta`='$ptov_url' $order_url";
			}
		}
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		//echo 6;
		if ($ptov_url == ''){
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' $order_url";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' AND MONTH(f_fact) = '$month_url' $order_url";
			}
		}else{
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND `punto_venta`='$ptov_url' $order_url";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' AND MONTH(f_fact) = '$month_url' AND `punto_venta`='$ptov_url' $order_url";
			}
		}
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		//echo 8;
		if ($ptov_url == ''){
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' $order_url";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' $order_url";
			}
		}else{
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' AND `punto_venta`='$ptov_url' $order_url";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' AND `punto_venta`='$ptov_url' 
				AND `forma_pago`='$forma_url' $order_url";
			}
		}
	}
	$muerte = mysql_query($query_muerte, $conexion) or die(mysql_error());
	//echo $tm = mysql_num_rows($muerte);  
  while($row_muerte = mysql_fetch_assoc($muerte)){
	  $estado = $row_muerte['delete'];
	  $ped = $row_muerte['ped'];
	  
	  /*
	  ----------------
	  Estados
	  ----------------
	  0 = Activa
	  1 = Eliminada
	  2 = Anulada
	  3 = Devolución
	  9 = Factura a Credito Pagada
	  */
	  
	  if ($estado == 9){
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $ped?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cliente']?></td>
    <td align="center"
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['forma_pago']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
    <td align="center" >Cancelada</td>    
  </tr>
	<?php	
		$i++;  
	  }
	  
	  if ($estado == 2){
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $ped?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cliente']?></td>
    <td align="center"
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['forma_pago']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
    <td align="center" >Anulada</td>   
  </tr>
	<?php	
		$i++;  
	  }
	  if ($estado == 0 && $ped != ''){
  ?>
  <tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="puntov<?php echo $i?>" >
	<?php echo $row_muerte['punto_venta']?>
    </label></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $ped?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cliente']?></td>
    <td align="center"
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['forma_pago']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
    <td align="center" >
    &nbsp;
    <input name="imgb" type="image" id="imgc <?php echo $i; ?>" 
      src="../img/erase.png" width="20" height="20" class="bt_c" style="cursor:pointer" title="Anular"
      onClick="quitar('<?php echo $row_muerte['consec']?>','<?php echo $i; ?>')" >
      
    </td>   
  </tr>
  <?php
  		  $i++;
	  }
	  if ($estado == 0 && $ped == ''){
  ?>
  <tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="puntov<?php echo $i?>" >
	<?php echo $row_muerte['punto_venta']?>
    </label></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $ped?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cliente']?></td>
    <td align="center"
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['forma_pago']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
    <td align="center" >
    <input name="imgb" type="image" id="img<?php echo $i; ?>" 
      src="../img/edit.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Editar"
      onClick="editar('<?php echo $row_muerte['consec'] ?>')" >
    &nbsp;
    <input name="imgb" type="image" id="imgc <?php echo $i; ?>" 
      src="../img/erase.png" width="20" height="20" class="bt_c" style="cursor:pointer" title="Anular"
      onClick="quitar('<?php echo $row_muerte['consec']?>','<?php echo $i; ?>')" >
    </td>   
  </tr>
  <?php
  		  $i++;
	  }
  	  if ($estado == 3){
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $ped?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cliente']?></td>
    <td align="center"
    onClick="mostrar('../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['forma_pago']?></td>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
    <?php 
	$consec = $row_muerte['consec'];
	mysql_select_db($database_conexion, $conexion);
	$factd = mysql_query("SELECT * FROM `h01sg_compras_devoluciones` WHERE `consec`='$consec' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_factd = mysql_fetch_assoc($factd);	
	?>
    <td align="center" 
    onClick="mostrar('../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo red"><?php echo number_format($row_muerte['costo']-$row_factd['total'], 2)?></label></td>
    <td align="center" >
    <input name="imgb" type="image" id="imgc <?php echo $i; ?>" 
      src="../img/erase.png" width="20" height="20" class="bt_c" style="cursor:pointer" title="Anular"
      onClick="quitar('<?php echo $row_muerte['consec']?>','<?php echo $i; ?>')" >
    </td>   
  </tr>
	<?php	
		$i++; 
	  }
  }
  ?>
  <tr>
  <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="7" align="right"><label class="red">Total</label></td>
  <td colspan="1" align="center"><label id="lb_tot" class="red"></label></td>
  <td>&nbsp;</td>
  </tr>
</table>
</div>
</div>
&nbsp;
</div>
</body>
<script>


</script>
</html>
<?php
}
?>