<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php');

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

$colname_clien = "-1";
if (isset($_GET['id'])) {
  $colname_clien = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_clien = sprintf("SELECT * FROM d89xz_prove WHERE id = %s", GetSQLValueString($colname_clien, "int"));
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrar Clientes</title>
<link href="../../css/clean.css" rel="stylesheet" type="text/css" />
<link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<link href="../../css/shadowbox.css" rel="stylesheet" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../../js/shadowbox.js" type="text/javascript"></script>
<script src="../../js/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/printThis.js" type="text/javascript"></script>

<!--<script src="../js/kardex.js" type="text/javascript"></script>-->
<script src="../js/edit_prove.js" type="text/javascript"></script>
</head>

<body>
<form  id="form1" method="post" name="form1">
  <div  id="primero">

   <p>
<input type="hidden" name="registro" id="categoria" >
<input type="hidden" name="registro" id="tipo" >

  </p>
<p>&nbsp;</p>
<table width="98%" border="1">
<tr>
<td><img src="../../../img/Logo.png" alt="" width="200" height="70" /></td>
</tr>
</table>
<p>&nbsp;</p>
<table width="90%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="4" align="center" class="tittle" style="">Editar Proveedores</td>
    </tr>
  <tr>
    <td width="20%" class="bold">Cedula/NIT</td>
    <td width="30%" class="cont"><label for="textfield"></label>
      <input name="registro" type="text"  required="required" id="cedula" style="width:98%" value="<?php echo $row_clien['cedula']; ?>" readonly="readonly"/></td>
    <td width="20%" class="bold">Marca</td>
    <td width="30%" class="cont"><input name="registro" type="text"  required="required" id="nombre" style="width:98%" value="<?php echo $row_clien['nombre']; ?>"/></td>
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <td class="cont"><input name="registro" type="text" id="dir" style="width:98%" value="<?php echo $row_clien['dir']; ?>" /></td>
    <td class="bold">Ciudad</td>
    <td class="cont"><input name="registro" type="text" id="ciudad" style="width:98%" value="<?php echo $row_clien['ciudad']; ?>" /></td>
  </tr>
  <tr>
    <td class="bold">Telefono</td>
    <td class="cont"><input name="registro" type="text" id="telefono" style="width:98%" value="<?php echo $row_clien['telefono']; ?>" /></td>
    <td class="bold">Celular</td>
    <td class="cont"><input name="registro" type="text" id="cel" style="width:98%" value="<?php echo $row_clien['cel']; ?>" /></td>
  </tr>
  <tr>
    <td class="bold">Categoria</td>
    <td class="cont"><input name="tf_lab" type="text" id="tf_lab" style="width:46%" onkeyup="desa()" value="<?php echo $row_clien['categoria']; ?>" />
      <select name="sl_lab" id="sl_lab" style="width:46%" onchange="desb()">
        <option value="">Seleccione Categoria.</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_lab = "SELECT DISTINCT categoria FROM d89xz_prove where categoria !='' and `delete` !='1' ORDER BY `categoria` ASC ";
        $lab = mysql_query($query_lab, $conexion) or die(mysql_error());
        while ($row_lab = mysql_fetch_assoc($lab)){
        ?>
        <option value="<?php echo ucwords(strtolower($row_lab['categoria']))?>"> <?php echo ucwords(strtolower($row_lab['categoria']))?></option>
        <?php
        } 
        ?>
      </select></td>
    <td class="bold">E mail</td>
    <td class="cont"><input name="registro" type="text" id="mail" style="width:98%" value="<?php echo $row_clien['mail']; ?>"/></td>
  </tr>
  <tr>
    <td class="bold">Forma</td>
    <td class="cont"><select name="registro" id="forma" style="width:98%" >
      <option value="" <?php if (!(strcmp("", $row_clien['user']))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
      <option value="Consignación" <?php if (!(strcmp("Consignación", $row_clien['forma']))) {echo "selected=\"selected\"";} ?>>Consignación</option>
      <option value="Crédito" <?php if (!(strcmp("Crédito", $row_clien['forma']))) {echo "selected=\"selected\"";} ?>>Crédito</option>
      <option value="Contado" <?php if (!(strcmp("Contado", $row_clien['forma']))) {echo "selected=\"selected\"";} ?>>Contado</option>
    </select></td>
    <td class="bold">Tipo de Producto</td>
    <td class="cont"><input name="tf_lab2" type="text" id="tf_lab2" style="width:45%" onkeyup="desa1()" value="<?php echo $row_clien['tipo']; ?>" />
      <select name="sl_lab2" id="sl_lab2" style="width:45%" onchange="desb1()">
        <option value="">Tipo de Producto.</option>
        <?php
        mysql_select_db($database_conexion, $conexion);
        $query_lab2 = "SELECT DISTINCT tipo FROM d89xz_prove where tipo !='' and `delete` !='1' ORDER BY `categoria` ASC ";
        $lab2 = mysql_query($query_lab2, $conexion) or die(mysql_error());
        while ($row_lab2 = mysql_fetch_assoc($lab2)){
        ?>
        <option value="<?php echo ucwords(strtolower($row_lab2['tipo']))?>"> <?php echo ucwords(strtolower($row_lab2['tipo']))?></option>
        <?php
        } 
        ?>
      </select></td>
  </tr>
  <tr>
    <td colspan="4" align="center" >&nbsp;</td>
    </tr>
</table>




  <table width="90%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="4" align="center" class="tittle" style="">Información De Contactos</td>
  </tr>
  <tr>
    <td width="20%" class="bold">Contacto 1</td>
    <td width="30%" class="cont"><label for="textfield"></label>
      <input name="registro" type="text" id="contacto1" style="width:98%" value="<?php echo $row_clien['contacto1']; ?>"  /></td>
    <td width="20%" class="bold">Contacto 2</td>
    <td width="30%" class="cont"><input name="registro" type="text" id="contacto2" style="width:98%" value="<?php echo $row_clien['contacto2']; ?>"  /></td>
  </tr>
  <tr>
    <td class="bold">Cargo</td>
    <td class="cont"><input name="registro" type="text" id="cargoc1" style="width:98%" value="<?php echo $row_clien['cargoc1']; ?>" /></td>
    <td class="bold">Cargo</td>
    <td class="cont"><input name="registro" type="text" id="cargoc2" style="width:98%" value="<?php echo $row_clien['cargoc2']; ?>" /></td>
  </tr>
  <tr>
    <td class="bold">Telefono</td>
    <td class="cont"><input name="registro" type="text" id="telefonoc1" style="width:98%" value="<?php echo $row_clien['telefonoc1']; ?>" /></td>
    <td class="bold">Telefono</td>
    <td class="cont"><input name="registro" type="text" id="telefonoc2" style="width:98%" value="<?php echo $row_clien['telefonoc2']; ?>" /></td>
  </tr>
  <tr>
    <td class="bold">E mail</td>
    <td class="cont"><input name="registro" type="text" autofocus="autofocus" id="mailc1" placeholder="exemple@idsolutions-group.com" style="width:98%" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" value="<?php echo $row_clien['mailc1']; ?>" /></td>
    <td class="bold">E mail</td>
    <td class="cont"><input name="registro" type="text" autofocus="autofocus" id="mailc2" placeholder="exemple@idsolutions-group.com" style="width:98%" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" value="<?php echo $row_clien['mailc2']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>



<table width="90%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="4" class="tittle">Información Bancaria</td>
</tr>
  <tr>
    <td width="20%" class="bold">Número De Cuenta</td>
    <td width="30%" class="cont"><input name="registro" type="text" id="cuenta" style="width:98%" value="<?php echo $row_clien['cuenta'];?>"/></td>
    <td width="18%" class="bold">Tipo  De Cuenta</td>
    <td width="32%" class="cont">  <select name="registro" id="tipocuenta" style="width:98%">
      <option value="" <?php if (!(strcmp("", $row_clien['tipocuenta']))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
      <option value="Ahorros" <?php if (!(strcmp("Ahorros", $row_clien['tipocuenta']))) {echo "selected=\"selected\"";} ?>>Ahorros</option>
      <option value="Corriente" <?php if (!(strcmp("Corriente", $row_clien['tipocuenta']))) {echo "selected=\"selected\"";} ?>>Corriente</option>
    </select></td>
  </tr>
  <tr>
    <td class="bold">Banco</td>
    <td class="cont"><input name="registro" type="text" id="banco" style="width:98%" value="<?php echo $row_clien['banco']; ?>"  /></td>
    <td class="bold">Forma De Pago</td>
    <td class="cont"><select name="registro" id="formapago" style="width:98%">
      <option value="" <?php if (!(strcmp("", $row_clien['formapago']))) {echo "selected=\"selected\"";} ?>>Seleccione</option>
      <option value="Credito" <?php if (!(strcmp("Credito", $row_clien['formapago']))) {echo "selected=\"selected\"";} ?>>Credito</option>
      <option value="Contado" <?php if (!(strcmp("Contado", $row_clien['formapago']))) {echo "selected=\"selected\"";} ?>>Contado</option>
    </select></td>
  </tr>
  <tr>
    <td class="bold">Periodo De Pago</td>
    <td class="cont"><input name="registro" type="text" id="periodopago" style="width:98%" value="<?php echo $row_clien['periodopago']; ?>" /></td>
    <td class="bold">Comentario</td>
    <td class="cont"><input name="registro" type="text" id="comentario" style="width:98%" value="<?php echo $row_clien['comentario']; ?>"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    
    <td></td>
    <td align="right"></td>
    <td align="center"></td>
  </tr>
</table>

<table width="98%" border="1">
  <tr>
    <td align="center"><input name="button5" type="submit" class="ext" id="button5" value="Aceptar" style="width:150px;"   onclick="confirmacion(); return false"/>&nbsp;
    
  <input type="submit" name="button1" id="button1" value="Cancelar"  onclick="window.close();" class="ext" style="width:150px"/></td>
  </tr>
</table>
<input type="hidden" name="registro" id="id" value="<?php echo $_GET['id']?>" >
<div id="dialog" >

</div>
</div> 
</form>
<!-- Finaliza el primer Div de personas  segundo -->

<script>
	
</script>




</body>
</html>
<?php
mysql_free_result($clien);
?>
