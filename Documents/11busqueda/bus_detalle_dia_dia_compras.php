<?
$ruta_a_joomla = "/../../Hdarien/";

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
if (JFactory::getUser()->usertype == NULL)
    JError::raiseError(1,"No puede acceder A esta Aplicación sin estar logueado... Consulte al Administrador....!!!");
$userx = JFactory::getUser();
?>
<?php require_once('Connections/conexion.php'); ?>
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

mysql_select_db($database_conexion, $conexion);
$query_dia = "SELECT dias FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT meses FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT anos FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="dia_dia.php" >Registro Diario</a>  </li>
  <li><a href="dia_dia_pendiente.php" >Facturas  Pendientes</a> </li>
  <li><a href="bus_detalle_dia_dia.php" class="current">Reportes</a>  </li>
  <li><a href="dia_dia_histo.php" >Historial</a> </li>

 
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="bus_detalle_dia_dia.php" >Reportes De Ventas</a>  </li>
  <li><a href="bus_detalle_dia_dia_compras.php" class="current">Reportes De Compras</a></li>
  <li><a href="bus_detalle_dia_dia_caja.php">Reporte Mensual Caja</a></li>
</ul>
<p>&nbsp;</p>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0">
    <tr>
      <th colspan="3" bgcolor="#4D68A2" style="color: #FFF">Reporte  De Compras</th>
    </tr>
    <tr>
      <th width="145">Ingrese Fecha</th>
      <th width="333">D
        <label for="dia"></label>
        <select name="dia" id="dia">
          <option value="">D</option>
          <?php
do {  
?>
          <option value="<?php echo $row_dia['dias']?>"><?php echo $row_dia['dias']?></option>
          <?php
} while ($row_dia = mysql_fetch_assoc($dia));
  $rows = mysql_num_rows($dia);
  if($rows > 0) {
      mysql_data_seek($dia, 0);
	  $row_dia = mysql_fetch_assoc($dia);
  }
?>
        </select>
        M
        <label for="mes"></label>
        <select name="mes" id="mes">
          <option value="">M</option>
          <?php
do {  
?>
          <option value="<?php echo $row_mes['meses']?>"><?php echo $row_mes['meses']?></option>
          <?php
} while ($row_mes = mysql_fetch_assoc($mes));
  $rows = mysql_num_rows($mes);
  if($rows > 0) {
      mysql_data_seek($mes, 0);
	  $row_mes = mysql_fetch_assoc($mes);
  }
?>
        </select>
        A<span id="spryselect1">
        <label for="anos"></label>
        <select name="anos" id="anos">
          <option value="">A</option>
          <?php
do {  
?>
          <option value="<?php echo $row_anos['anos']?>"><?php echo $row_anos['anos']?></option>
          <?php
} while ($row_anos = mysql_fetch_assoc($anos));
  $rows = mysql_num_rows($anos);
  if($rows > 0) {
      mysql_data_seek($anos, 0);
	  $row_anos = mysql_fetch_assoc($anos);
  }
?>
        </select>
        </span></th>
      <th width="100"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" /></th>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprysejamect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($anos);
?>



  <?

@$dia=$_POST['dia'];
@$dia2=1;
@$mes=$_POST['mes'];
@$anos=$_POST['anos'];
$fechaEsp=$anos.'-'.$mes.'-'.$dia;
$fechaEsp1=$anos.'-'.$mes.'-'.$dia2;


?>
<DIV ID="seleccion">


<?

if($anos !=0){
	$prueba = strftime("Dia %d Mes %B Año %Y ", strtotime($fechaEsp));
	$prueba1 = strftime("Mes %B Año %Y ", strtotime($fechaEsp1));
	
if($dia != ''){
	
$result = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' AND DAY(fecha) = '$dia' AND concep = 'Egreso'"); 
		 
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			@$dia1 =  number_format($row[total]);
			
			echo "<table border = '1' width='100%' cellspacing='0'> \n";
								echo "<tr> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Reporte Ventas  $prueba</b></td> \n";
									
						echo "<td align='center'><b>$dia1</b></td> \n";
						
					
			echo "</tr> \n";
			
						
$queEmp ="SELECT * FROM d89xz_diario where  YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' AND concep = 'Egreso' and DAY(fecha) = '$dia'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='100%' cellspacing='0'> \n";
						echo "<tr> \n";	
						
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Factura</b></td> \n"; 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Descripción</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Estado</b></td> \n";					
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Cantidad</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Valor U.</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Valor Total</b></td> \n";
						
						

		echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							@$v_unit = number_format ($rowEmp['v_unit']);
						@$v_tal1 = abs ($rowEmp['v_tal']);
						@$v_tal=number_format($v_tal1);
							
				echo "<tr> \n";
						
						echo "<td>$rowEmp[factura]</td> \n";
						echo "<td>$rowEmp[descrip]</td> \n";
						echo "<td>$rowEmp[estado]</td> \n";
						echo "<td align='center'>$rowEmp[cantid]</td> \n";
						echo "<td align='center'>$v_unit</td> \n";
						echo "<td align='center'>$v_tal</td> \n";
						
					
				echo "</tr> \n";
										
						}
					}
						
						
				echo "</table> \n";	
}

if(($dia=='') && ($mes !=0)){
	


$result = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' AND concep = 'Egreso' "); 
 
$row1 = mysql_fetch_array($result, MYSQL_ASSOC);
//echo $row["total"];
@$mensual =  number_format($row1[total]);
	
	echo "<table border = '1' width='100%' cellspacing='0'> \n";
						echo "<tr> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Reporte Ventas  $prueba1</b></td> \n";
									
						echo "<td align='center'><b>$mensual</b></td> \n";
						
					
				echo "</tr> \n";
	
	
					
					$queEmp ="SELECT * FROM d89xz_diario where YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' AND concep = 'Egreso' ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='100%' cellspacing='0'> \n";
						echo "<tr> \n";	
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Factura</b></td> \n"; 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Descripción</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Estado</b></td> \n";					
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Cantidad</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Valor U.</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Valor Total</b></td> \n";
						

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							@$v_unit = number_format ($rowEmp['v_unit']);
					@$v_tal1 = abs ($rowEmp['v_tal']);
						@$v_tal=number_format($v_tal1);
							
				echo "<tr> \n";
						
						echo "<td>$rowEmp[factura]</td> \n";
						echo "<td>$rowEmp[descrip]</td> \n";
						echo "<td>$rowEmp[estado]</td> \n";
						echo "<td align='center'>$rowEmp[cantid]</td> \n";
						echo "<td align='center'>$v_unit</td> \n";
						echo "<td align='center'>$v_tal</td> \n";
					
				echo "</tr> \n";
										
						}
					}
					//	mysql_close($conexion);
						
				echo "</table> \n";	
					


}


if(($dia == 0) &&  ($mes == 0)){
	
	$result = mysql_query("SELECT SUM(`v_tal`) as total FROM d89xz_diario where YEAR(fecha) = '$anos'  AND concep = 'Egreso'"); 
 
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	@$anual1 =  abs($row[total]);
	@$anual=number_format($anual1);
	
	echo "<table border = '1' width='100%' cellspacing='0'> \n";
						echo "<tr> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Reporte Ventas  $anos</b></td> \n";
									
						echo "<td align='center' ><b> $anual</b></td> \n";
						
					
				echo "</tr> \n";
	

					
					$queEmp ="SELECT * FROM d89xz_diario where YEAR(fecha) = '$anos' AND concep = 'Egreso' order by fecha";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='100%' cellspacing='0'> \n";
						echo "<tr> \n";	
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Factura</b></td> \n"; 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Descripción</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Estado</b></td> \n";					
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Cantidad</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Valor U.</b></td> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Valor Total</b></td> \n";
						

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							@$v_unit = number_format ($rowEmp['v_unit']);
						@$v_tal1 = abs ($rowEmp['v_tal']);
						@$v_tal=number_format($v_tal1);
							
				echo "<tr> \n";
						
					echo "<td>$rowEmp[factura]</td> \n";
						echo "<td>$rowEmp[descrip]</td> \n";
						echo "<td>$rowEmp[estado]</td> \n";
						echo "<td align='center'>$rowEmp[cantid]</td> \n";
						echo "<td align='center'>$v_unit</td> \n";
						echo "<td align='center'>$v_tal</td> \n";
					
				echo "</tr> \n";
										
						}
					}
						//
						
				echo "</table> \n";	
}

}

mysql_close($conexion);
?>




</DIV> 

<script language="Javascript">

  function imprSelec(nombre)

  {

  var ficha = document.getElementById(nombre);

  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );

  ventimp.document.close();

  ventimp.print( );

  ventimp.close();

  } 

</script>