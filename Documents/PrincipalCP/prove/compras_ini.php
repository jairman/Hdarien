<?php require_once('joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); 

 $_GET['id'];
 
  ?>

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

@$day_url=$_GET['d'];
@$month_url=$_GET['m'];
@$year_url=$_GET['y'];
@$ptov_url=$_GET['p'];
@$forma_url=$_GET['f'];
@$idc_url=$_GET['id'];

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

@$y = date ('Y');
@$m = date ('m');
@$d = date ('d');

$i = 0;

mysql_select_db($database_conexion, $conexion);
@$query_clien = sprintf("SELECT * FROM d89xz_prove WHERE id='$idc_url'", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);

$c_ced = $row_clien['cedula'];
$c_nombre = $row_clien['nombre'];
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Reporte Compras</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>

<style>
#year, #month, #day{
	/*display:inline-block;*/
	float:left;
	/*width:100%;*/
}
</style>

</head>

<body>
<p>
<input type="hidden" id="tf_idclient" value="<?php echo $idc_url ?>">
</p>
<p>
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_year" value="<?php echo $y ?>">
<input type="hidden" id="tf_month" value="<?php echo $m ?>">
<input type="hidden" id="tf_day" value="<?php echo $d ?>">

</p>
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
      <a  href="../prove/compras_ini.php?id=<?php echo $idc_url ?>" class='active'>Historial de Facturación</a>
      </li>
      <li> <a href="../../caja/dia_dia_pendiente_prove.php?id=<?php echo $idc_url ?>"  >Cuentas Por Pagar</a> </li>

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
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="95%" border="1" cellspacing="0" align="center">
	<tr>
    <td><img src="../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
    </tr>
</table>


<table width="95%" align="center" border="1" cellspacing="0">
	<tr  class="tittle">
<td colspan="4" >Historial de Facturación</td>
</tr>
<tr >
<td class="bold cont" align="left">Nombre</td>
<td align="center"><?php echo $c_nombre ?></td>
<td class="bold cont" align="left">Cedula</td>
<td align="center"><?php echo $c_ced ?></td>
</tr>
<tr>
  <td class="bold cont" align="left" width="20%">
  Punto de Venta
  </td>
  <td  align="right" width="30%">
  <?php
        if ($usuario2 == 'general'){
        ?>
      <select name="sl_ptov" id="sl_ptov" class="long" onChange="load0()">
      <option value="">Seleccione</option>
      <?php
        mysql_select_db($database_conexion, $conexion);
        $query_hac = "SELECT DISTINCT `hacienda` as hacienda , `hacienda` as hacienda1 FROM 
        `d89xz_hacienda` WHERE  `delete`=0 order by hacienda";
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
   	<td class="bold cont" align="left" width="20%">Forma de Pago</td>
      <td  align="right" width="30%">
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
    <td  align="right" width="30%">&nbsp;</td>
    	<td class="bold cont" align="left" width="20%">
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
				$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
			ORDER BY YEAR(f_fact) DESC";
			}else{
				$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
				AND `forma_pago`='$forma_url' ORDER BY YEAR(f_fact) DESC";
			}
		}else{
			if ($forma_url == ''){
				$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
			AND `punto_venta`='$ptov_url' ORDER BY YEAR(f_fact) DESC";
			}else{
				$query_anos = "SELECT DISTINCT YEAR(f_fact)  FROM `h01sg_compra` WHERE `ced`='$c_ced' AND `delete`<>1
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
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' ORDER BY MONTH(f_fact) DESC";
			}else{
				$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
				WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND `forma_pago`='$forma_url' ORDER BY MONTH(f_fact) DESC";
			}
		}else{
			if ($forma_url == ''){
				$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND `punto_venta`='$ptov_url' ORDER BY MONTH(f_fact) DESC";
			}else{
				$query_mes = "SELECT DISTINCT MONTH(f_fact) , MONTHNAME(f_fact) FROM `h01sg_compra` 
				WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND `punto_venta`='$ptov_url' 
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
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
			ORDER BY DAY(f_fact) ASC";
			}else{
				$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
				WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
				AND `forma_pago`='$forma_url' ORDER BY DAY(f_fact) ASC";
			}
		}else{
			if ($forma_url == ''){
				$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
			WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
			AND `punto_venta`='$ptov_url' ORDER BY DAY(f_fact) ASC";
			}else{
				$query_dia = "SELECT DISTINCT DAY(f_fact)  FROM `h01sg_compra` 
				WHERE `ced`='$c_ced' AND `delete`<>1 AND YEAR(f_fact)='$year_url' AND MONTH(f_fact)='$month_url' 
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
<p>&nbsp;</p>
<p>&nbsp;</p>
    
    </td>
    </tr>
    
</table>

<div id="table" >
<table width="95%" border="1" align="center" cellspacing="0" id="tb_data">
  <tr class="tittle">
  	<td align="center" width="10%">Fecha</td>
    <td align="center" width="15%">No</td>
    <td align="center" width="17%">Punto de Venta</td>
    <td width="23%" align="center">Forma de Pago</td>
    <td align="center" width="15%">Items</td>
    <td align="center" width="12%">Costo</td>
    <td align="center" width="8%">&nbsp;</td>
  </tr>
  <?php
    //echo $year_url.'-'.$month_url.'-'.$day_url;
	mysql_select_db($database_conexion, $conexion);
	if($year_url=='' && $month_url=='' && $day_url==''){
		//echo 2;
		if ($ptov_url == ''){
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 ORDER BY `f_fact` DESC";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND `forma_pago`='$forma_url' 
				ORDER BY `f_fact` DESC";
			}
			
		}else{
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND `punto_venta`='$ptov_url' ORDER BY `f_fact` DESC";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND `punto_venta`='$ptov_url'
				AND `forma_pago`='$forma_url' ORDER BY `f_fact` DESC";
			}
			
		}
	
	}
	if($year_url!='' && $month_url=='' && $day_url==''){
		//echo 4;
		if ($ptov_url == ''){
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			ORDER BY `f_fact` DESC";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' ORDER BY `f_fact` DESC";
			}
		}else{
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND `punto_venta`='$ptov_url' ORDER BY `f_fact` DESC";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' AND `punto_venta`='$ptov_url' ORDER BY `f_fact` DESC";
			}
		}
	}
	if($year_url!='' && $month_url!='' && $day_url==''){
		//echo 6;
		if ($ptov_url == ''){
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' ORDER BY `f_fact` DESC";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' AND MONTH(f_fact) = '$month_url' ORDER BY `f_fact` DESC";
			}
		}else{
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND `punto_venta`='$ptov_url' ORDER BY `f_fact` DESC";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' AND MONTH(f_fact) = '$month_url' AND `punto_venta`='$ptov_url' ORDER BY `f_fact` DESC";
			}
		}
	}
	if($year_url!='' && $month_url!='' && $day_url!=''){
		//echo 8;
		if ($ptov_url == ''){
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' ORDER BY `f_fact` DESC";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND `forma_pago`='$forma_url' AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' ORDER BY `f_fact` DESC";
			}
		}else{
			if ($forma_url == ''){
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
			AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' AND `punto_venta`='$ptov_url' ORDER BY `f_fact` DESC";
			}else{
				$query_muerte = "SELECT * FROM `h01sg_compra` WHERE `ced`='$c_ced' AND 'delete'<>1 AND YEAR(f_fact) = '$year_url'
				AND MONTH(f_fact) = '$month_url' AND DAY(f_fact) = '$day_url' AND `punto_venta`='$ptov_url' 
				AND `forma_pago`='$forma_url' ORDER BY `f_fact` DESC";
			}
		}
	}
	$muerte = mysql_query($query_muerte, $conexion) or die(mysql_error());
	//echo $tm = mysql_num_rows($muerte);  
  while($row_muerte = mysql_fetch_assoc($muerte)){
	  $estado = $row_muerte['delete'];
	  if ($estado == 2){
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../../../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
    <td align="center" 
    onClick="mostrar('../../../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
    onClick="mostrar('../../../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?></td>
    <td align="center" 
    onClick="mostrar('../../../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['forma_pago']?></td>
    <td align="center" 
    onClick="mostrar('../../../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
    <td align="center" 
    onClick="mostrar('../../../compras/compras_fact1.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
    <td align="center" >Anulada</td>   
    
  </tr>
	<?php	
		$i++;  
	  }
	  if ($estado == 0){
  ?>
  <tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="puntov<?php echo $i?>" >
	<?php echo $row_muerte['punto_venta']?>
    </label></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['forma_pago']?></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo"><?php echo number_format($row_muerte['costo'], 2)?></label></td>
    <td align="center" >&nbsp;</td>   
    
  </tr>
  <?php
  		  $i++;
	  }
  	  if ($estado == 3){
	?>
	<tr  id="fila_<?php echo $i?>" class="row">
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['f_fact']?></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['forma_pago']?></td>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['cant']?></td>
    <?php 
	$consec = $row_muerte['consec'];
	mysql_select_db($database_conexion, $conexion);
	$factd = mysql_query("SELECT * FROM `h01sg_compras_devoluciones` WHERE `ced`='$c_ced' AND `consec`='$consec' AND `delete`<>1 ", $conexion) or die(mysql_error());
	$row_factd = mysql_fetch_assoc($factd);	
	?>
    <td align="center" 
    onClick="mostrar('../../compras/compras_fact2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<label id="lb_costo<?php echo $i?>" class="costo red"><?php echo number_format($row_muerte['costo']-$row_factd['total'], 2)?></label></td>
    <td align="center" >&nbsp;</td>   
    
  </tr>
	<?php	
		$i++; 
	  }
  }
  ?>
  <tr>
  <td height="23" colspan="7">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="5" align="right"><label class="red">Total</label></td>
  <td colspan="1" align="center"><label id="lb_tot" class="red"></label></td>
  <td>&nbsp;</td>
  </tr>
</table>
<table width="98%" border="1" align="center">
  <tr>
    <td align="center"><input type="button" name="button1" id="button1" value="Cerrar"  onclick="javascript:window.close();" class="ext" style="width:150px"/></td>
  </tr>
</table>

</div>
</div>
</div>

</body>
<script>

$(document).ready(function() {
    //se crea la variable con el estilo css overlay
	overlay = $('<div></div>').prependTo('body').attr('id', 'overlay');
	
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

function editar(c){
	overlay.show()
	$("#dialog").html('Desea Editar la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="red('+c+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function red(c){
	var url = '../compras/compras_edit.php?c='+c;
	mostrar(url);
}

function quitar(c,i){
	//console.log('c: '+c+' i: '+i);
	overlay.show()
	$("#dialog").html('Desea Anular la factura No: '+c+"?<br>").css('text-align','center');
	$("#dialog").prepend('<img id="theImg2" src="../img/warning.png" width="50" height="50"/>');
	$("span.ui-dialog-title").text('Información Importante').css("text-align", "center"); 
	$("#dialog").dialog("open");
	$("#dialog").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/good.png" width="50" height="50" style="cursor:pointer" onclick="anularfact('+c+','+i+');cerrar_dialogo();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="theImg2" src="../img/erase.png" width="50" height="50" style="cursor:pointer" onclick="cerrar_dialogo()"/>');
}

function anularfact(c,i){
	//console.log('c: '+c+' i: '+i);
	var user2 = $('#tf_user2').val();
	var p = $.trim($('#puntov'+i).text());
	//console.log('p: '+p);
	//console.log("consec="+c+"&user="+user2+"&action=anulfac")
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"consec="+c+"&user="+user2+"&action=anulfac",				
		success:function(data){
			//console.log(data);
			var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('inv: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				delDiario(c, p);
				delTarea(c, p);
				delprod(c,i);
			}else{
				//console.log('noexitoso');
				cuadroerror();
			}
		}
	});	
	
}

function delDiario(c, p){
	var user = $('#tf_user2').val();
	
	console.log("consec="+c+"&puntov="+p+"&user="+user+"&action=delDiario");
	
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"consec="+c+"&puntov="+p+"&user="+user+"&action=anulDiario",				
		success:function(data){
			console.log(data);
		}
	});	
}

function delTarea(c, p){
	var user = $('#tf_user2').val();
	
	//console.log("consec="+c+"&puntov="+p+"&user="+user+"&action=delTarea");
	
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"consec="+c+"&puntov="+p+"&user="+user+"&action=delTarea",				
		success:function(data){
			//console.log(data);
		}
	});
}

function delprod(c,i){
	//console.log('c: '+c+' i: '+i);
	var user2 = $('#tf_user2').val();
	//console.log("consec="+c+"&user="+user2+"&action=anulprod");
	$.ajax({
		type:"post",
		url:"../compras/compras_connect.php",
		data:"consec="+c+"&user="+user2+"&action=anulprod",				
		success:function(data){
			//console.log('a: '+data);
			load4();
			/*var res = data.replace( /\s/g, "");
			res = $.trim(res);
			//console.log('inv: '+res)
			if (res == 'exitoso'){
				//console.log('exitoso');
				delprod(c,i);
			}else{
				//console.log('noexitoso');
				cuadroerror();
			}*/
		}
	});	
}

function product_wind(){
	var url = '../inventario/invent_prod.php';
	console.log(url);
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

function dev_wind(){
	var url = '../devolucionesC/dev_ini.php';
	console.log(url);
	mostrar(url);
}

function regmulti_wind(){
	var url = '../inventario/invent_regmulti.php';
	//console.log(url),
	Shadowbox.open({
		content: url,
		player: "iframe",
		options: {                   
			initialHeight: 1,
			initialWidth: 1,
			modal: true		      		
		},
	})
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
	var f = $('#sl_fpago').val();
	var c = $('#tf_idclient').val();
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#year').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+")  + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #year' );
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var c = $('#tf_idclient').val();
	
	$('#month').hide();
	$('#day').hide();
	
	//console.log ('1y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#year').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #year' );
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	var f = $('#sl_fpago').val();
	var c = $('#tf_idclient').val();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#month').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #month ' );
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	var f = $('#sl_fpago').val();
	var c = $('#tf_idclient').val();
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	
	$('#day').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #day' );
	
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	var f = $('#sl_fpago').val();
	var c = $('#tf_idclient').val();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
	
	var p = '';
	var user = $('#tf_user').val();
	if ( user != 'general'){
		p = $('#tf_ptov').val();
	}else{
		p = $('#sl_ptov').val();
	}
	var f = $('#sl_fpago').val();
	var c = $('#tf_idclient').val();
	
	//console.log ('y:'+y+' m:'+m+' d:'+d+' p:'+p+' f:'+f);
	$('#table').load('compras_ini.php?y=' + y.replace(/ /g,"+") +
	'&m=' + m.replace(/ /g,"+") +'&d=' + d.replace(/ /g,"+") +'&p=' + p.replace(/ /g,"+") + '&f=' + f.replace(/ /g,"+")  +'&id=' + c.replace(/ /g,"+") +' #table ' , 
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
}
?>