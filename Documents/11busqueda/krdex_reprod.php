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

$colname_idv = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_idv = $_GET['id_vacuno'];
}


mysql_select_db($database_conexion, $conexion);
$query_idv = sprintf("SELECT * FROM d89xz_vacunos WHERE madre = %s", GetSQLValueString($colname_idv, "text"));
$idv = mysql_query($query_idv, $conexion) or die(mysql_error());
$row_idv = mysql_fetch_assoc($idv);
$totalRows_idv = mysql_num_rows($idv);

$colname_reg = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_reg = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_reg = sprintf("SELECT * FROM d89xz_vacunos WHERE id_vacuno = %s", GetSQLValueString($colname_reg, "text"));
$reg = mysql_query($query_reg, $conexion) or die(mysql_error());
$row_reg = mysql_fetch_assoc($reg);
$totalRows_reg = mysql_num_rows($reg);

$maxRows_ins = 1;
$pageNum_ins = 0;
if (isset($_GET['pageNum_ins'])) {
  $pageNum_ins = $_GET['pageNum_ins'];
}
$startRow_ins = $pageNum_ins * $maxRows_ins;

$colname_ins = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_ins = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_ins = sprintf("SELECT * FROM d89xz_inseminacion WHERE vaca = %s ORDER BY id DESC", GetSQLValueString($colname_ins, "text"));
$query_limit_ins = sprintf("%s LIMIT %d, %d", $query_ins, $startRow_ins, $maxRows_ins);
$ins = mysql_query($query_limit_ins, $conexion) or die(mysql_error());
$row_ins = mysql_fetch_assoc($ins);

if (isset($_GET['totalRows_ins'])) {
  $totalRows_ins = $_GET['totalRows_ins'];
} else {
  $all_ins = mysql_query($query_ins);
  $totalRows_ins = mysql_num_rows($all_ins);
}
$totalPages_ins = ceil($totalRows_ins/$maxRows_ins)-1;

$colname_pal = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_pal = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_pal = sprintf("SELECT * FROM d89xz_detalle_palpacion WHERE vaca = %s", GetSQLValueString($colname_pal, "text"));
$pal = mysql_query($query_pal, $conexion) or die(mysql_error());
$row_pal = mysql_fetch_assoc($pal);
$totalRows_pal = mysql_num_rows($pal);

$colname_inse = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_inse = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_inse = sprintf("SELECT * FROM d89xz_detalle_inseminacion WHERE vaca = %s", GetSQLValueString($colname_inse, "text"));
$inse = mysql_query($query_inse, $conexion) or die(mysql_error());
$row_inse = mysql_fetch_assoc($inse);
$totalRows_inse = mysql_num_rows($inse);

$colname_mdr = "-1";
if (isset($_GET['madre'])) {
  $colname_mdr = $_GET['madre'];
}
mysql_select_db($database_conexion, $conexion);
$query_mdr = sprintf("SELECT * FROM d89xz_vacunos WHERE madre = %s", GetSQLValueString($colname_mdr, "text"));
$mdr = mysql_query($query_mdr, $conexion) or die(mysql_error());
$row_mdr = mysql_fetch_assoc($mdr);
$totalRows_mdr = mysql_num_rows($mdr);

$colname_pdr = "-1";
if (isset($_GET['madre'])) {
  $colname_pdr = $_GET['madre'];
}
mysql_select_db($database_conexion, $conexion);
$query_pdr = sprintf("SELECT * FROM d89xz_vacunos WHERE madre = %s", GetSQLValueString($colname_pdr, "text"));
$pdr = mysql_query($query_pdr, $conexion) or die(mysql_error());
$row_pdr = mysql_fetch_assoc($pdr);
$totalRows_pdr = mysql_num_rows($pdr);

$colname_jar = "-1";
if (isset($_GET['id_vacuno'])) {
  $colname_jar = $_GET['id_vacuno'];
}
mysql_select_db($database_conexion, $conexion);
$query_jar = sprintf("SELECT * FROM d89xz_vacunos WHERE madre = %s", GetSQLValueString($colname_jar, "text"));
$jar = mysql_query($query_jar, $conexion) or die(mysql_error());
$row_jar = mysql_fetch_assoc($jar);
$totalRows_jar = mysql_num_rows($jar);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reproductora</title>


<style type="text/css">
#form1 table tr th {
	color: #FFF;
	font-size: 14px;
}
ss {
	color: #000;
}
#seleccion #form1 table {
	font-size: 12px;
}
.xx {
	color: #000;
}
#seleccion #form1 table tr td strong {
}
#a {
}
#n {
	font-size: 14px;
	color: #FFF;
}
</style>
<link rel="stylesheet" type="text/css" href="shadowbox.css">
<script type="text/javascript" src="shadowbox.js"></script>
<script type="text/javascript"><!--
Shadowbox.init({
handleOversize: "drag",
modal: true
});
// --></script>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

</head>

<body>
<? 
@$vacuno=$_GET['vacuno'];
@$sexo=$_GET['sexo'];
@$macho=Macho;

?>
<ul id="MenuBar1" class="MenuBarHorizontal" >

  <li><a href="kardex_busqueda.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>&amp;sexo=<?php echo $sexo?>" class="current">Informacion</a>  </li>
   <li><a href="kardex_busqueda_sanitaria.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>&amp;sexo=<?php echo $sexo?>">Información Sanitaria</a>  </li>
    <li><a href="kardex_busqueda_peso.php?vacuno=<?php echo $vacuno ?>&amp;id_vacuno=<?php echo $vacuno ?>&amp;sexo=<?php echo $sexo?>">Información  Pesajes</a>  </li>
    
  <? 
   if($sexo != $macho){ 
  echo " <li><a href='krdex_reprod.php?vacuno=$vacuno&amp;id_vacuno=$vacuno&amp;sexo=$sexo' >Informacion Partos</a>  </li> "; 
  echo " <li><a href='krdex_reprod_palp.php?vacuno=$vacuno&amp;id_vacuno=$vacuno&amp;sexo=$sexo' >Control  Reproductivo</a></li>";
  };
  ?>
</ul>
 <p>&nbsp;</p>
  
  <table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#f0f0f0">
    <td width="121" align="left">&nbsp;</td>
    <td width="121" align="left">&nbsp;</td>
    <td width="308" align="center"><a href="busqueda_reproductoras.php"><img src="last.png" alt="" width="29" height="31" border="0" /></a></td>
    <td width="239" align="right"><a href="javascript:imprSelec('seleccion')" ><img src="imprimir.png" alt="" width="36" height="35" 

border="0" align="right" /></a></td>
  </tr>
</table>

<DIV ID="seleccion">
  <form id="form1" name="form1" method="post" action="">
    
    <table width="100%" border="0" align="center" cellspacing="2" >
    <tr style="font-weight: bold">
      <td colspan="9" bgcolor="#FFFFFF"><img src="idsolutions--este.png" width="162" height="59" align="middle" /></td>
    </tr>
    <tr style="font-weight: bold">
      <td colspan="9" align="center" bgcolor="#4D68A2" style="color: #FFF" id="n">TARJETA   INDIVIDUAL  DE HEMBRAS PURAS        
          <label for="text_vaca"></label>
      </td>
      </tr>
    <tr bgcolor="#d8d8d8" style="font-weight: bold">
      <th colspan="9" bgcolor="#c0c0c0">&nbsp;</th>
    </tr>
    <tr bgcolor="#f0f0f0">
      <td colspan="6" style="font-weight: bold">&nbsp;</td>
      <td colspan="2" align="center" style=" font-weight: bold;"><strong style="font-size: 18px">VACA N°</strong></td>
      <td align="center" style="border-bottom: 1px solid #333333;font-weight: bold;"><?php echo $row_reg['id_vacuno']; ?></td>
    </tr>
    <tr bgcolor="#c0c0c0">
      <td width="132" style="font-weight: bold">Hacienda</td>
      <td colspan="3" align="center" ><?php echo $row_reg['ubicasion']; ?></td>
      <td colspan="2" align="center" style="font-weight: bold" >Estado  Actual</td>
      <td align="left" ><?php echo $row_reg['tp_rep']; ?></td>
      <td width="72" style="font-weight: bold">Hierro</td>
      <td width="120" align="center"><?php echo $row_reg['hierro']; ?></td>
      </tr>
    <tr bgcolor="#f0f0f0">
      <td style="font-weight: bold">Fecha Entrada</td>
      <td colspan="2" align="center" ><?php echo $row_reg['f_ingreso']; ?></td>
      <td style="font-weight: bold">Registro</td>
      <td width="112" align="center"><span ><?php echo $row_reg['registro']; ?></span></td>
      <td width="104" style="font-weight: bold" >Raza</td>
      <td align="center"><span ><?php echo $row_reg['raza']; ?></span></td>
      <td style="font-weight: bold" >Color</td>
       <td align="center" ><?php echo $row_reg['color']; ?></td>
    </tr>
    <tr bgcolor="#c0c0c0">
      <td style="font-weight: bold">Padre </td>
      <td width="100" align="center"><?php echo $row_reg['padre']; ?></td>
      <td width="125" style="font-weight: bold">Registro </td>
      <td width="131" align="center"><?php echo $row_pdr['registro']; ?></td>
      <td style="font-weight: bold">Madre </td>
      <td width="104" align="center"><?php echo $row_reg['madre']; ?></td>
      <td width="158" style="font-weight: bold">Registro</td>
      <td align="center"><?php echo $row_mdr['registro']; ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr bgcolor="#f0f0f0" style="font-weight: bold">
      <td colspan="9" align="center">Pesos Ajustados (Kgs)</td>
      </tr>
    <tr bgcolor="#c0c0c0">
      <td style="font-weight: bold" >Nacimiento</td>
      <td align="center"><?php echo $row_reg['p_ncto']; ?></td>
      <td style="font-weight: bold">Destete</td>
      <td align="center" ><?php echo $row_reg['p_dtt']; ?></td>
      <td><span style="font-weight: bold" >205</span>Días</td>
      <td align="center" ><?php echo $row_reg['p_205']; ?></td>
      <td><span style="font-weight: bold" >18 Meses</span></td>
      <td align="center"><?php echo $row_reg['p_18']; ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr bgcolor="#f0f0f0">
      <td style="font-weight: bold" >Observaciones</td>
      <td colspan="7"><?php echo $row_reg['observasiones']; ?></td>
      <td>&nbsp;</td>
      </tr>
   
    <?php do { ?>
   <?php } while ($row_idv = mysql_fetch_assoc($idv)); ?>
   
   
  </table>
  <table width="100%" border="1" align="center" cellspacing="0" >
    <tr>
      <th width="98" rowspan="2" bgcolor="#4D68A2" style="color: #FFF">TORO</th>
      <th colspan="2" bgcolor="#4D68A2" style="color: #FFF">PARTO</th>
      <th colspan="3" bgcolor="#4D68A2" style="color: #FFF">CRIA</th>
      <th colspan="2" bgcolor="#4D68A2" style="color: #FFF">DESTETE</th>
      <th width="459" rowspan="2" bgcolor="#4D68A2" style="color: #FFF"><p>OBSERVACIONES</p></th>
    </tr>
    <tr>
      <th width="100" bgcolor="#4D68A2" style="color: #FFF">FECHA</th>
      <th width="28" bgcolor="#4D68A2" style="color: #FFF">COD</th>
      <th bgcolor="#4D68A2" style="color: #FFF">ID</th>
      <th bgcolor="#4D68A2" style="color: #FFF">SEXO</th>
      <th bgcolor="#4D68A2" style="color: #FFF">PESO</th>
      <th width="78" bgcolor="#4D68A2" style="color: #FFF">FECHA</th>
      <th width="54" bgcolor="#4D68A2" style="color: #FFF">PESO</th>
      </tr>
    <?php do { ?>
    <tr align="center">
      <td><?php echo $row_jar['padre']; ?></td>
      <td width="100"><?php echo $row_jar['f_ingreso']; ?></td>
      <td width="28">&nbsp;</td>
      <td width="87"><?php echo $row_jar['id_vacuno']; ?></td>
      <td width="48"><?php echo $row_jar['sexo']; ?></td>
      <td width="61"><?php echo $row_jar['p_ncto']; ?></td>
      <td width="78"><?php echo $row_jar['f_dtt']; ?></td>
      <td><?php echo $row_jar['p_dtt']; ?></td>
      <td>&nbsp;</td>
      </tr>
    <?php } while ($row_jar = mysql_fetch_assoc($jar)); ?>
  </table>
  <p>&nbsp;</p>
</form>
</DIV>
</body>
</html>
<?php
mysql_free_result($idv);

mysql_free_result($reg);

mysql_free_result($ins);

mysql_free_result($pal);

mysql_free_result($inse);

mysql_free_result($mdr);

mysql_free_result($pdr);

mysql_free_result($jar);
?>

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
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>