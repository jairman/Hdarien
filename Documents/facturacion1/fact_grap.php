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

date_default_timezone_set('America/Bogota');
mysql_query("SET lc_time_names = 'es_CO'");

$i=1;

$y = date ('Y');
$m = date ('m');
$d = date ('d');

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Graficas de Facturación</title>
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/chart.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script src="../js/printThis.js" type="text/javascript"></script>
<script src="js/fact_grap.js" type="text/javascript"></script>


<style>
#d_datos{
	display:inline-block;
	margin:0;
	padding:0
}
#d_datos2{
	display:inline-block;
	margin:0;
	padding:0
}
#d_help{
	display:inline-block;
	margin:0;
	padding:0
}
</style>
</head>

<body>
<input type="hidden" id="tf_user" value="<?php echo $usuario2 ?>">
<input type="hidden" id="tf_user2" value="<?php echo $usuario ?>">
<input type="hidden" id="tf_i" value="<?php echo $i ?>">
<input type="hidden" id="tf_year" value="<?php echo $y ?>">


<div id="dialog"></div>
<div id="recargar2">
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="84%" align="left"><img src="../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
    <td width="8%" align="left">&nbsp;</td>
    <td width="8%" align="left">
     <input type="image" title="Imprimir" src="../img/imprimir.png" alt="" 
    width="48" height="48" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('recargar2')" >
    </td>
  </tr>
</table>

<table width="95%" align="center">
	<tr>
    <td colspan="4" align="center" class="tittle">Graficas</td>
    </tr>
</table>
<table width="95%" align="center" id="tb_graph">
	<tr>
    	<td colspan="2" align="center" class="bold">
        Punto de Venta  
        <?php
        if ($usuario2 == 'general'){
        ?>
        <select name="sl_ptov" id="sl_ptov" style="width:30%">
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
        <input type="text" readonly id="tf_ptov" style="width:30%" value="<?php echo $usuario2 ?>">
        <?php
        }
        ?>
        </td>
    </tr>
	<tr>
    <td align="center" id="td_datos" >
    
    <div id="d_datos">
    	<p>Periodo Actual: Meses</p><br>
    </div>
    </td>
    <td align="center" id="td_datos2">
    
    <div id="d_datos2">
    	<p>Periodos Pasados: Años</p><br>
    </div>
    </td>
    </tr>
    <tr>
    <td align="center" colspan="2" >
    <div id="canvasContainer">
    <canvas id="myChart" width="1100" height="450"></canvas>
    </div>
    </td>
    </tr>
    <tr>
    <td colspan="2" align="center" id="td_help">
    <div id="d_help">
    </div>
    </td>
    </tr>

</table>
</div>
</body>
</html>
<?php
}
?>