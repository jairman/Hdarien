<?
$ruta_a_joomla = "/../../Sganadero/";

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
$query_ms = "SELECT * FROM d89xz_meses";
$ms = mysql_query($query_ms, $conexion) or die(mysql_error());
$row_ms = mysql_fetch_assoc($ms);
$totalRows_ms = mysql_num_rows($ms);

mysql_select_db($database_conexion, $conexion);
$query_ans = "SELECT * FROM d89xz_anos";
$ans = mysql_query($query_ans, $conexion) or die(mysql_error());
$row_ans = mysql_fetch_assoc($ans);
$totalRows_ans = mysql_num_rows($ans);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th p {
	color: #FFF;
}
</style>
</head>

<body>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">
<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<form id="form1" name="form1" method="post" action="">
  <table width="700" border="1">
    <tr>
      <th colspan="3" bgcolor="#4D68A2" style="color: #FFF">Informe Detallado Lechería</th>
    </tr>
    <tr>
      <th width="122">Ingrese Fecha</th>
      <td width="337"><label for="semana"></label>
        Semana
        <select name="semana" id="semana">
          <option>Seleccione</option>
          <option value="Semana1">Semana1</option>
          <option value="Semana2">Semana2</option>
          <option value="Semana3">Semana3</option>
          <option value="Semana4">Semana4</option>
        </select>
        M
        <label for="mes"></label>
        <select name="mes" id="mes">
          <option value="">M</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ms['meses']?>"><?php echo $row_ms['meses']?></option>
          <?php
} while ($row_ms = mysql_fetch_assoc($ms));
  $rows = mysql_num_rows($ms);
  if($rows > 0) {
      mysql_data_seek($ms, 0);
	  $row_ms = mysql_fetch_assoc($ms);
  }
?>
         


        </select> 
        A<span id="spryselect1">
        <label for="anos"></label>
        <select name="anos" id="anos">
          <option value="">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ans['anos']?>"><?php echo $row_ans['anos']?></option>
          <?php
} while ($row_ans = mysql_fetch_assoc($ans));
  $rows = mysql_num_rows($ans);
  if($rows > 0) {
      mysql_data_seek($ans, 0);
	  $row_ans = mysql_fetch_assoc($ans);
  }
?>
        </select>
        </span></td>
      <td width="62"><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<p>
  <?

$semana=$_POST["semana"];
$mes=$_POST['mes'];
$anos=$_POST['anos'];
?>

<?
if($anos !=0){
if($semana != Seleccione){
	
	$result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_detalle_leche where YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' AND semana = '$semana'"); 
 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$total= number_format ($row["total"]);
	
	echo "<table border = '1' width='700'> \n";
						echo "<tr> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Total Ingresos por Leche Semanal</b></td> \n";
									
						echo "<td align='center'> $total</td> \n";
						
					
				echo "</tr> \n";
	
	
					
					//$queEmp ="SELECT * FROM d89xz_detalle_leche where YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' AND semana = '$semana' ORDER BY vacuno DESC, semana ASC";
					
				$queEmp ="SELECT `vacuno`,SUM(`klos`) AS N_Kilos, SUM(`valor`) AS Valor_total FROM d89xz_detalle_leche  WHERE YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' AND semana = '$semana' GROUP BY `vacuno` DESC
 ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='700'> \n";
						echo "<tr> \n";	
							 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Total Kilos Semanales</b></td> \n";
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b> Valor Total Kilos Semanales($)</b></td> \n";
						
						

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							$kilos =number_format ($rowEmp[N_Kilos]);
							$valor_tal3 =number_format ($rowEmp[Valor_total]);
				echo "<tr> \n";

						echo "<td align='center'>$rowEmp[vacuno]</td> \n";
						
						echo "<td align='center'>$kilos</td> \n";
						
						echo "<td align='center'>$valor_tal3</td> \n";
						
					
				echo "</tr> \n";
										
						}
					}
						
						
				echo "</table> \n";	
		

					


}
if(($semana==Seleccione) && ($mes !=0)){
	$result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_detalle_leche WHERE MONTH(`fecha`) = $mes AND YEAR(fecha) = $anos "); 
 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
//echo $row["total"];
$total_2=number_format ($row[total]);


echo "<table border = '1' width='700'> \n";
						echo "<tr> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Total Ingresos por Leche Mensual</b></td> \n";						
						

						echo "<td align='center'>$total_2</td> \n";
						
					
				echo "</tr> \n";
	

					
					//$queEmp ="SELECT * FROM d89xz_detalle_leche where YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' ORDER BY vacuno DESC , semana ASC";
					
	$queEmp ="SELECT `vacuno`,SUM(`klos`) AS N_Kilos, SUM(`valor`) AS Valor_total FROM d89xz_detalle_leche  WHERE YEAR(fecha) = '$anos' AND MONTH(fecha) = '$mes' GROUP BY `vacuno` DESC
 ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='700'> \n";
						echo "<tr> \n";	
							 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Total Kilos Mensuales</b></td> \n";
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b> Valor Total Kilos Mensuales($)</b></td> \n";
						
						

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							$kilos =number_format ($rowEmp[N_Kilos]);
							$valor_tal3 =number_format ($rowEmp[Valor_total]);
				echo "<tr> \n";

						echo "<td align='center'>$rowEmp[vacuno]</td> \n";
						
						echo "<td align='center'>$kilos</td> \n";
						
						echo "<td align='center'>$valor_tal3</td> \n";
						
					
				echo "</tr> \n";
										
						}
					}
						
						
				echo "</table> \n";	
		

	
}


if(($semana==Seleccione) && ($mes ==0)){
	$result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_detalle_leche Where YEAR(fecha) = '$anos' "); 
 
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$tota3= number_format ($row[total]);


echo "<table border = '1' width='700'> \n";
						echo "<tr> \n";
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Total Ingresos por Leche Anual</b></td> \n";						
						

						echo "<td align='center'>$tota3</td> \n";
						
					
				echo "</tr> \n";
	

					
					$queEmp ="SELECT `vacuno`,SUM(`klos`) AS N_Kilos, SUM(`valor`) AS Valor_total FROM d89xz_detalle_leche  WHERE YEAR(fecha) = '$anos' GROUP BY `vacuno`
 ";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					
		 
		echo "<table border = '1' width='700'> \n";
						echo "<tr> \n";	
							 
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>ID</b></td> \n";
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b>Total Kilos Anuales</b></td> \n";
						
						echo "<td bgcolor='#4D68A2' style='color:#fff' align='center'><b> Valor Total Kilos Anuales($)</b></td> \n";
						
						

				echo "</tr> \n";

					if ($totEmp> 0) {
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
							//echo "<Vacuno>".$rowEmp['id_vacuno']."</strong><br>";
							$kilos =number_format ($rowEmp[N_Kilos]);
							$valor_tal3 =number_format ($rowEmp[Valor_total]);
				echo "<tr> \n";

						echo "<td align='center'>$rowEmp[vacuno]</td> \n";
						
						echo "<td align='center'>$kilos</td> \n";
						
						echo "<td align='center'>$valor_tal3</td> \n";
						
					
				echo "</tr> \n";
										
						}
					}
						
						
				echo "</table> \n";	
		


	
}

}

?>
</p>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_close($conexion);
mysql_free_result($ms);

mysql_free_result($ans);
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