<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php') ?>

<?php
//echo $acceso.'-'.$usuario2.'-'.$usuario;
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
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>
<script src="../js/cierre_histo.js" type="text/javascript"></script>

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
      <a href="../../inventario/views/invent_ini.php" >Reporte de Inventario</a>
      </li>
      <li>
      <a  href="../../inventario/views/invent_ini2.php">Reporte de Productos Vendidos</a>
      </li>
      <li>
      <a  href="cierre_histo.php" class='active'>Cierre de Inventario</a>
      </li>
      </ul>
    </div>  
    </td>
    <td width="8%">&nbsp;
        
    </td>
    <td width="8%">
    <input type="image" src="../../img/cierre.png" alt="" width="48" height="48" border="0" align="right" 
    title="Cierre de Inventario" id="bt_cierrei" style="cursor:pointer" >
    </td>
    <td width="8%">
    <input type="image" title="Imprimir" src="../../img/imprimir.png" alt="" 
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
    <select name="sl_year" id="sl_year" onChange="load2()" style="width:100px" >
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
    
    <select name="sl_month" id="sl_month" onChange="load3()" style="width:100px">
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
    <select name="sl_day" id="sl_day" onChange="load4()" style="width:100px">
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
    onClick="mostrar('../views/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
    <?php echo $row_muerte['fecha']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['marca']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['prove']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre.php?c=<?php echo $row_muerte['consec'] ?>')">
    <?php echo $row_muerte['obs']?>
    </td>
    <td align="center" >
    <input name="imgb" type="image" id="img<? echo $i; ?>" 
      src="../../img/edit.png" width="20" height="20" class="bt_x" style="cursor:pointer" title="Editar"
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
    onClick="mostrar('../views/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
    <?php echo $row_muerte['fecha']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['consec']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['punto_venta']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['marca']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
	<?php echo $row_muerte['prove']?>
    </td>
    <td align="center" 
    onClick="mostrar('../views/cierre2.php?c=<?php echo $row_muerte['consec'] ?>')">
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

</html>
<?php
}
?>