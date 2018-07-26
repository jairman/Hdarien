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

$maxRows_jornada = 10;
$pageNum_jornada = 0;
if (isset($_GET['pageNum_jornada'])) {
  $pageNum_jornada = $_GET['pageNum_jornada'];
}
$startRow_jornada = $pageNum_jornada * $maxRows_jornada;

mysql_select_db($database_conexion, $conexion);
$query_jornada = "SELECT * FROM d89xz_vacunasion ORDER BY fecha DESC";
$query_limit_jornada = sprintf("%s LIMIT %d, %d", $query_jornada, $startRow_jornada, $maxRows_jornada);
$jornada = mysql_query($query_limit_jornada, $conexion) or die(mysql_error());
$row_jornada = mysql_fetch_assoc($jornada);

if (isset($_GET['totalRows_jornada'])) {
  $totalRows_jornada = $_GET['totalRows_jornada'];
} else {
  $all_jornada = mysql_query($query_jornada);
  $totalRows_jornada = mysql_num_rows($all_jornada);
}
$totalPages_jornada = ceil($totalRows_jornada/$maxRows_jornada)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table border="1">
  <tr>
   
    <td>id_vacuno</td>
    <td>jornada</td>
    <td>diagnostico</td>
    <td>tratamiento</td>
    <td>observasion</td>
    <td>fecha</td>
  </tr>
  <?php do { ?>
    <tr>
     
      <td><?php echo $row_jornada['id_vacuno']; ?></td>
      <td><?php echo utf8_encode($row_jornada['jornada']); ?></td>
      <td><?php echo $row_jornada['diagnostico']; ?></td>
      <td><?php echo $row_jornada['tratamiento']; ?></td>
      <td><?php echo $row_jornada['observasion']; ?></td>
      <td><?php echo $row_jornada['fecha']; ?></td>
    </tr>
    <?php } while ($row_jornada = mysql_fetch_assoc($jornada)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($jornada);
?>
