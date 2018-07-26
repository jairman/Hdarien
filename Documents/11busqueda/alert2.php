
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
$query_alt = "SELECT tarea, fecha_ini, fecha, estado FROM d89xz_tareas WHERE `fecha` >= CURDATE()   AND `fecha` <= DATE_ADD(CURDATE(), INTERVAL  2 DAY) ORDER BY fecha ASC";
$alt = mysql_query($query_alt, $conexion) or die(mysql_error());
$row_alt = mysql_fetch_assoc($alt);
$totalRows_alt = mysql_num_rows($alt);
?>


  
    Tareas pendientes por cumplir  con dos (2) días de anticipación
    
<? //echo "<br>";?> 
 
  <?php do { ?>
    <?php echo "Tarea:_" .$row_alt['tarea']; ?> <?php echo "_____Fecha Inicio:_" .$row_alt['fecha_ini']; ?>
   <? //echo "<br>";?> 
    <?php echo "Fecha Final:_" .$row_alt['fecha']; ?><?php echo "_____Estado:__" .$row_alt['estado']; ?>
   
    <?php } while ($row_alt = mysql_fetch_assoc($alt)); ?>

<?php
mysql_free_result($alt);
?>
