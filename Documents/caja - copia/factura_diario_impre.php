<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

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
 

 $hda=$_GET['hda'];
 $colname_fac = $_GET['id'];

mysql_select_db($database_conexion, $conexion);
$query_hd = "SELECT * FROM d89xz_empresa";
$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
$row_hd = mysql_fetch_assoc($hd);
$totalRows_hd = mysql_num_rows($hd);

mysql_select_db($database_conexion, $conexion);
$query_clien = "SELECT * FROM d89xz_clientes";
$clien = mysql_query($query_clien, $conexion) or die(mysql_error());
$row_clien = mysql_fetch_assoc($clien);
$totalRows_clien = mysql_num_rows($clien);

$colname_fac = "-1";
if (isset($_GET['id'])) {
  $colname_fac = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_fac = sprintf("SELECT * FROM d89xz_diario WHERE hacienda='$hda' and factura = %s", GetSQLValueString($colname_fac, "int"));
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);

$maxRows_fact1 = 10;
$pageNum_fact1 = 0;
if (isset($_GET['pageNum_fact1'])) {
  $pageNum_fact1 = $_GET['pageNum_fact1'];
}
$startRow_fact1 = $pageNum_fact1 * $maxRows_fact1;

$colname_fact1 = "-1";
if (isset($_GET['id'])) {
  $colname_fact1 = $_GET['id'];
}
mysql_select_db($database_conexion, $conexion);
$query_fact1 = sprintf("SELECT * FROM d89xz_diario WHERE hacienda='$hda' and factura = %s", GetSQLValueString($colname_fact1, "int"));
$query_limit_fact1 = sprintf("%s LIMIT %d, %d", $query_fact1, $startRow_fact1, $maxRows_fact1);
$fact1 = mysql_query($query_limit_fact1, $conexion) or die(mysql_error());
$row_fact1 = mysql_fetch_assoc($fact1);

if (isset($_GET['totalRows_fact1'])) {
  $totalRows_fact1 = $_GET['totalRows_fact1'];
} else {
  $all_fact1 = mysql_query($query_fact1);
  $totalRows_fact1 = mysql_num_rows($all_fact1);
}
$totalPages_fact1 = ceil($totalRows_fact1/$maxRows_fact1)-1;

$colname_haci = "-1";
if (isset($_GET['hda'])) {
  $colname_haci = $_GET['hda'];
}
mysql_select_db($database_conexion, $conexion);
$query_haci = sprintf("SELECT * FROM d89xz_hacienda WHERE hacienda = %s", GetSQLValueString($colname_haci, "text"));
$haci = mysql_query($query_haci, $conexion) or die(mysql_error());
$row_haci = mysql_fetch_assoc($haci);
$totalRows_haci = mysql_num_rows($haci);

$colname_clenfact = "-1";
if (isset($_POST['clientes'])) {
  $colname_clenfact = $_POST['clientes'];
}

mysql_select_db($database_conexion, $conexion);
@$cedulacli =$_GET["clientes"];
$query_clenfact = "SELECT * FROM d89xz_clientes WHERE cedula = '$cedulacli' ";
$clenfact = mysql_query($query_clenfact, $conexion) or die(mysql_error());
$row_clenfact = mysql_fetch_assoc($clenfact);
$totalRows_clenfact = mysql_num_rows($clenfact);



$result = mysql_query("SELECT SUM(`valor`) as total FROM d89xz_diario where hacienda='$hda' and `factura`= '$_GET[id]'"); 
$row = mysql_fetch_array($result, MYSQL_ASSOC);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="../css/clean.css" rel="stylesheet" type="text/css" />
<link href="../css/shadowbox.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/shadowbox.js" type="text/javascript"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="../js/printThis.js" type="text/javascript"></script>

</head>

<body>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="244" align="left">&nbsp;</td>
    <td width="308" align="center">&nbsp;</td>
    <td width="239" align="right"><img  title="Imprimir" src="../img/imprimir.png" alt=""  width="40" height="40" border="0" align="right" style="cursor:pointer" onclick="imprimir_esto('seleccion')"/></td>
  </tr>
</table>
<DIV ID="seleccion">

  <table width="90%" border="1" align="center">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center" style="font-size: 18px"><p><?php echo $row_hd['empresa']; ?>&nbsp; </p>
        <p> NIT <?php echo $row_hd['nit']; ?></p>
      <p><?php echo $row_haci['direc']; ?> </p>
      <p>Teléfono &nbsp; <?php echo $row_haci['telefono']; ?></p>
      <p><?php echo ucwords(strtolower($row_haci['municipio'])); ?>- Colombia</p></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="90%" border="0" align="center" cellspacing="0">
  <tr >
    <td colspan="2" align="center" valign="top" style="font-size: 18px">    
        <?PHP  if($row_fac['concep'] == 'Egreso'){ ?>
        <strong>COMPROBANTE DE EGRESO </strong>
        <?PHP  } ?>
        <?PHP  if($row_fac['concep'] == 'Ingreso'){ ?>
        <strong>RECIBO DE CAJA </strong>
      <?PHP  } ?></td>
    </tr>
  <tr >
    <td colspan="2" align="center" valign="top" style="font-size: 18px"><strong style="font-size: 18px; color: #F00;"> N° <?php echo $row_fac['factura']; ?></strong></td>
    </tr>
  <tr>
    <td  class="bold" style="font-size: 14px">FECHA</td>
    <td  class="cont" style="font-size: 14px"><?php echo $row_fac['fecha']; ?></td>
    </tr>
  <tr>
    <td  class="bold" style="font-size: 14px">TELÉFONO</td>
    <td  class="cont" style="font-size: 14px"><?php
    
    
		mysql_select_db($database_conexion, $conexion);
		if($row_fac['concep'] == 'Egreso'){ 
		//echo 1;
      		$query_clenfact = "SELECT telefono FROM d89xz_prove WHERE cedula = '$row_fac[cedula]' ";  
      
           } 
       if($row_fac['concep'] == 'Ingreso'){ 
	   		//echo 2;
			$query_clenfact = "SELECT telefono FROM d89xz_clientes WHERE cedula = '$row_fac[cedula]' ";     
          } 
		$clenfact = mysql_query($query_clenfact, $conexion) or die(mysql_error());
		$row_clenfact = mysql_fetch_assoc($clenfact);
		$totalRows_clenfact = mysql_num_rows($clenfact);
		echo $row_clenfact['telefono']
    
    ?></td>
    </tr>
  <tr>
    <td  class="bold" style="font-size: 14px">ESTADO</td>
    <td  class="cont" style="font-size: 14px"><?php echo $row_fac['estado']; ?></td>
    </tr>
  <tr>
    <td  class="bold" style="font-size: 14px">
    <?PHP  if($row_fac['concep'] == 'Egreso'){ ?>
      <strong>PAGADO A </strong>
      <?PHP  } ?>
      <?PHP  if($row_fac['concep'] == 'Ingreso'){ ?>
      <strong>RECIBIMOS DE </strong>
      <?PHP  } ?>
    
    </td>
    <td  class="cont" style="font-size: 14px"><?php echo $row_fac['cliente']; ?></td>
    </tr>
  <tr>
    <td  class="bold" style="font-size: 14px">CÉDULA/NIT</td>
    <td  class="cont" style="font-size: 14px">
      <?php echo $row_fac['cedula']; ?> </td>
    </tr>
  <tr>
    <td  class="bold" style="font-size: 14px">LA SUMA DE</td>
    <td align="left" bgcolor="#FFFFFF" class="cont" style="font-size: 14px"> $ <? echo number_format (abs($row["total"])) ?></td>
    </tr>
  </table>

<table width="90%" border="1" align="center" cellspacing="0">
  <tr align="center"  class="tittle">
    <td width="49%" style="color: #000">CONCEPTO</td>
    <td width="30%" style="color: #000">FORMA </td>
    <td width="21%" style="color: #000">TOTAL</td>
    </tr>
  <?php do { ?>
    <tr class="row">
      <td align="center" style="font-size: 18px" ><?php echo $row_fac['comentario']; ?></td>
      <td align="center" style="font-size: 18px" ><?php echo $row_fac['f_pago']; ?></td>
      <td align="center" style="font-size: 18px"><?php echo number_format (abs ($row_fac['valor'])); ?></td>
      </tr>
      <?php } while ($row_fac = mysql_fetch_assoc($fac)); ?>
    
</table>
<p>&nbsp;</p>
<table width="90%" border="0" align="center" cellspacing="0">
  <tr>
    <td align="center" style="font-size: 18px">_________________________________________</td>
    <td align="center" style="font-size: 18px">__________________________________________</td>
  </tr>
  <tr>
    <td align="center" style="font-size: 18px"><p>Recibido  Por</p></td>
    <td align="center" style="font-size: 18px"><p>Administrador</p></td>
  </tr>
</table>

</DIV>
</body>
</html>
<?php
@mysql_free_result($vnt);

mysql_free_result($hd);

mysql_free_result($clien);

@mysql_free_result($fac);

@mysql_free_result($fact1);

mysql_free_result($haci);

mysql_free_result($clenfact);
?>
<script language="Javascript">
//funcion para imprimir la pantalla
function imprimir_esto(id_tabla){
	$("#"+id_tabla).printThis({
	     debug: false,          
	     importCSS: true,           
         printContainer: true,      				         
		 loadCSS: "../css/style-print.css", 
         pageTitle: "",             
         removeInline: false       
	  });
}

</script> 