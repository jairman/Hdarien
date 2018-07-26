<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); 

 $_GET['id'];
 
  ?>

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
<script src="../js/verProve.js" type="text/javascript"></script>


</head>

<body>
<table width="95%" align="center" id="table_header">
  <tr>
    <td width="93%" align="left">
    <div id="menu">
      <ul>
      <li> <a href="../views/verProve.php?id=<?= $colname_clien ?>" class='active'>Información del Provedor</a>
      </li>
      <li><a  href="../views/compras_ini.php?id=<?= $colname_clien ?>">Historial de Facturación</a></li>
      <li> <a href="../../caja/views/dia_dia_pendiente_prove.php?id=<?= $colname_clien ?>"  >Cuentas Por Pagar</a> </li>
      </ul>
    </div>  
    </td>
    <td width="7%" align="left"><img  title="Imprimir" src="../../img/imprimir.png" alt="" 
    width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('seleccion')"/>
</td>
  </tr>
</table>
<DIV ID="seleccion">
<div id="main">
&nbsp;
<table width="95%" align="center">
  <tr>
    <td align="left" ><img src="../../../img/Logo.png" alt="logo" name="logo" width="200" height="70" id="logo" /></td>
  </tr>
</table>

<form  id="form1" method="post" name="form1">

<input type="hidden" name="registro" id="categoria" >

  <table width="95%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="4" align="center" class="tittle" style="">Información registro de Proveedor</td>
    </tr>
  <tr>
    <td width="20%" class="bold">Cedula / NIT</td>
    <td width="30%" class="cont"><label for="textfield"></label>
      <input name="registro" type="text"  required="required" id="cedula" style="width:98%" value="<?= $row_clien['cedula']; ?>" readonly="readonly"/></td>
    <td width="20%" class="bold">Nombre/Empresa</td>
    <td width="30%" class="cont"><input name="registro" type="text"  required="required" id="nombre" style="width:98%" value="<?= $row_clien['nombre']; ?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td class="bold">Dirección</td>
    <td class="cont"><input name="registro" type="text" id="dir" style="width:98%" value="<?= $row_clien['dir']; ?>" readonly="readonly" /></td>
    <td class="bold">Ciudad</td>
    <td class="cont"><input name="registro" type="text" id="ciudad" style="width:98%" value="<?= $row_clien['ciudad']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Telefono</td>
    <td class="cont"><input name="registro" type="text" id="telefono" style="width:98%" value="<?= $row_clien['telefono']; ?>" readonly="readonly" /></td>
    <td class="bold">Celular</td>
    <td class="cont"><input name="registro" type="text" id="cel" style="width:98%" value="<?= $row_clien['cel']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Categoria</td>
    <td class="cont"><input name="registro" type="text" id="contacto" style="width:98%" value="<?= $row_clien['categoria']; ?>" readonly="readonly" /></td>
    <td class="bold">E mail</td>
    <td class="cont"><input name="registro" type="text" id="mail" style="width:98%" value="<?= $row_clien['mail']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Forma</td>
    <td class="cont"><input name="contacto" type="text" id="contacto3" style="width:98%" value="<?= $row_clien['forma']; ?>" readonly="readonly" /></td>
    <td class="bold">Tipo de Producto</td>
    <td class="cont"><input name="contacto2" type="text" id="contacto4" style="width:98%" value="<?= $row_clien['tipo']; ?>" readonly="readonly" /></td>
  </tr>
  </table>




  <table width="95%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="4" align="center" class="tittle" style="">Información De Contactos</td>
    </tr>
  <tr>
    <td width="20%" class="bold">Contacto 1</td>
    <td width="30%" class="cont"><label for="textfield"></label>
      <input name="registro" type="text" id="contacto1" style="width:98%" value="<?= $row_clien['contacto1']; ?>" readonly="readonly"  /></td>
    <td width="20%" class="bold">Contacto 2</td>
    <td width="30%" class="cont"><input name="registro" type="text" id="contacto2" style="width:98%" value="<?= $row_clien['contacto2']; ?>" readonly="readonly"  /></td>
  </tr>
  <tr>
    <td class="bold">Cargo</td>
    <td class="cont"><input name="registro" type="text" id="cargoc1" style="width:98%" value="<?= $row_clien['cargoc1']; ?>" readonly="readonly" /></td>
    <td class="bold">Cargo</td>
    <td class="cont"><input name="registro" type="text" id="cargoc2" style="width:98%" value="<?= $row_clien['cargoc2']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Telefono</td>
    <td class="cont"><input name="registro" type="text" id="telefonoc1" style="width:98%" value="<?= $row_clien['telefonoc1']; ?>" readonly="readonly" /></td>
    <td class="bold">Telefono</td>
    <td class="cont"><input name="registro" type="text" id="telefonoc2" style="width:98%" value="<?= $row_clien['telefonoc2']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">E mail</td>
    <td class="cont"><input  name="registro" type="text" id="mailc1" style="width:98%" value="<?= $row_clien['mailc1']; ?>" readonly="readonly" /></td>
    <td class="bold">E mail</td>
    <td class="cont"><input name="registro" type="text" id="mailc2" style="width:98%" value="<?= $row_clien['mailc2']; ?>" readonly="readonly" /></td>
  </tr>
</table>




<table width="95%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="4" class="tittle">Información Bancaria</td>
    </tr>
  <tr>
    <td width="20%" class="bold">Número De Cuenta</td>
    <td width="30%" class="cont"><input name="registro" type="text" id="cuenta" style="width:98%" value="<?= $row_clien['cuenta']; ?>" readonly="readonly" /></td>
    <td width="18%" class="bold">Tipo  De Cuenta</td>
    <td width="32%" class="cont"><input name="registro" type="text" id="tipocuenta" style="width:98%" value="<?= $row_clien['tipocuenta']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Banco</td>
    <td class="cont"><input name="registro" type="text" id="banco" style="width:98%" value="<?= $row_clien['banco']; ?>" readonly="readonly" /></td>
    <td class="bold">Forma De Pago</td>
    <td class="cont"><input name="registro" type="text" id="formapago" style="width:98%" value="<?= $row_clien['formapago']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td class="bold">Periodo De Pago</td>
    <td class="cont"><input name="registro" type="text" id="periodopago" style="width:98%" value="<?= $row_clien['periodopago']; ?>" readonly="readonly" /></td>
    <td class="bold">Comentario</td>
    <td class="cont"><input name="registro" type="text" id="comentario" style="width:98%" value="<?= $row_clien['comentario']; ?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="button" name="button1" id="button1" value="Cerrar"  onclick="javascript:window.close();" class="ext" style="width:150px"/>     </td>
    </tr>
</table>

 
</form>
</div>
</DIV>
</body>
</html>
<?php
mysql_free_result($clien);
?>
