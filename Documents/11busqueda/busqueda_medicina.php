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
$query_tipom = "SELECT tipo FROM d89xz_tipo_medininas";
$tipom = mysql_query($query_tipom, $conexion) or die(mysql_error());
$row_tipom = mysql_fetch_assoc($tipom);
$totalRows_tipom = mysql_num_rows($tipom);

$colname_medi = "-1";
if (isset($_POST['tipo'])) {
  $colname_medi = $_POST['tipo'];
}
mysql_select_db($database_conexion, $conexion);
$query_medi = sprintf("SELECT * FROM d89xz_total_medicinas WHERE tipo = %s", GetSQLValueString($colname_medi, "text"));
$medi = mysql_query($query_medi, $conexion) or die(mysql_error());
$row_medi = mysql_fetch_assoc($medi);
$totalRows_medi = mysql_num_rows($medi);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#form1 table tr th {
	color: #FFF;
}
</style>
</head>

<body>
<a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" border="0" align="right" /></a>

<DIV ID="seleccion">
<p><img src="idsolutions--este.png" width="162" height="59" /></p>
<form id="form1" name="form1" method="post" action="">
  <table width="535" border="1">
    <tr>
      <td colspan="3" bgcolor="#4D68A2">&nbsp;</td>
    </tr>
    <tr>
      <td>Seleccione  Tipo de  Medicina</td>
      <td><label for="tipo"></label>
        <select name="tipo" id="tipo">
          <option value="">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_tipom['tipo']?>"><?php echo $row_tipom['tipo']?></option>
          <?php
} while ($row_tipom = mysql_fetch_assoc($tipom));
  $rows = mysql_num_rows($tipom);
  if($rows > 0) {
      mysql_data_seek($tipom, 0);
	  $row_tipom = mysql_fetch_assoc($tipom);
  }
?>
      </select></td>
      <th><input type="submit" name="button" id="button" value="Enviar" /></th>
    </tr>
  </table>
  <table width="535" border="1">
    <tr>
      <th width="87" bgcolor="#4D68A2">Tipo</th>
      <th width="143" bgcolor="#4D68A2">Nombre</th>
      <th width="74" bgcolor="#4D68A2"> Contenido </th>
      <th width="109" bgcolor="#4D68A2"> Marca </th>
      <th width="88" bgcolor="#4D68A2">Total</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_medi['tipo']; ?></td>
        <td><?php echo $row_medi['nombre']; ?></td>
        <td align="center"><?php echo $row_medi['cont']; ?></td>
        <td><?php echo $row_medi['mark']; ?></td>
        <td align="center"><strong><?php if($colname_medi!=0){ echo round(($row_medi['dosis']/$row_medi['cont']),2); }?></strong></td>
        
      </tr>
      <?php } while ($row_medi = mysql_fetch_assoc($medi)); ?>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($tipom);

mysql_free_result($medi);
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