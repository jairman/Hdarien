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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE d89xz_catego_prove SET categ=%s, `desc`=%s WHERE id=%s",
                       GetSQLValueString($_POST['categ'], "text"),
                       GetSQLValueString($_POST['desc'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "prove_kardex.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_cli = "-1";
if (isset($_GET['id'])) {
  $colname_cli = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_cli = sprintf("SELECT * FROM d89xz_catego_prove WHERE id = %s", GetSQLValueString($colname_cli, "int"));
$cli = mysql_query($query_cli, $conexion) or die(mysql_error());
$row_cli = mysql_fetch_assoc($cli);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="500" border="1" align="center">
    <tr valign="baseline">
      <td width="183" align="left" nowrap="nowrap" bgcolor="#4D68A2">Id</td>
      <td width="305" align="center" bgcolor="#4D68A2"><?php echo $row_cli['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#4D68A2"><span style="color: #FFF">Categoría</span></th>
      <td><input type="text" name="categ" value="<?php echo htmlentities($row_cli['categ'], ENT_COMPAT, 'utf-8'); ?>" size="50" /></td>
    </tr>
    <tr valign="baseline">
      <th align="left" nowrap="nowrap" bgcolor="#4D68A2"><span style="color: #FFF">Descripción</span></th>
      <td><input type="text" name="desc" value="<?php echo $row_cli['desc']; ?>" size="50" /></td>
    </tr>
    <tr align="left" valign="baseline" bgcolor="#4D68A2">
      <th colspan="2" align="center" nowrap="nowrap"><input type="submit" value="Actualizar registro" /></th>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_cli['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($cli);
?>
