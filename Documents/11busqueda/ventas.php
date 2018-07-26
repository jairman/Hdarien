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
$query_dia = "SELECT * FROM d89xz_dias";
$dia = mysql_query($query_dia, $conexion) or die(mysql_error());
$row_dia = mysql_fetch_assoc($dia);
$totalRows_dia = mysql_num_rows($dia);

mysql_select_db($database_conexion, $conexion);
$query_mes = "SELECT * FROM d89xz_meses";
$mes = mysql_query($query_mes, $conexion) or die(mysql_error());
$row_mes = mysql_fetch_assoc($mes);
$totalRows_mes = mysql_num_rows($mes);

mysql_select_db($database_conexion, $conexion);
$query_anos = "SELECT * FROM d89xz_anos";
$anos = mysql_query($query_anos, $conexion) or die(mysql_error());
$row_anos = mysql_fetch_assoc($anos);
$totalRows_anos = mysql_num_rows($anos);

mysql_select_db($database_conexion, $conexion);
$query_client = "SELECT * FROM d89xz_clientes";
$client = mysql_query($query_client, $conexion) or die(mysql_error());
$row_client = mysql_fetch_assoc($client);
$totalRows_client = mysql_num_rows($client);

mysql_select_db($database_conexion, $conexion);
$query_hd = "SELECT * FROM d89xz_hacienda";
$hd = mysql_query($query_hd, $conexion) or die(mysql_error());
$row_hd = mysql_fetch_assoc($hd);
$totalRows_hd = mysql_num_rows($hd);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr th {
	color: #000;
}
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
 <li><a href="kar_ventas.php" >Vacunos Vendidos</a>  </li>
  <li><a href="ventas.php" class="current">Ventas</a>  </li>
   <li><a href="mostrar_nomina.php">Nomina</a>  </li>
    <li><a href="stin_bascula.php">Báscula</a>  </li>
      <li><a href="stin_buscar_bascula.php">Reporte Báscula</a>  </li>
  
</ul>
<p>&nbsp;</p>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a href="ventas.php" class="current">Ventas</a>  </li>
  <li><a href="ventas_reportes.php">Reportes</a></li>
 
</ul>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="630" border="1" align="center" cellspacing="0">
    <tr>
      <th colspan="4" bgcolor="#4D68A2" style="color: #FFF">Ingrese Datos de Venta</th>
    </tr>
    <tr>
      <th colspan="4" bgcolor="#f0f0f0">&nbsp;</th>
    </tr>
    <tr>
      <td width="106"><strong>Fecha</strong></td>
      <td>D<span id="spryselect1">
      <label for="select_dia2"></label>
      <select name="select_dia" id="select_dia2">
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
      </span>M<span id="spryselect2">
      <label for="select_mes2"></label>
      <select name="select_mes" id="select_mes2">
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
      </span>A<span id="spryselect3">
      <label for="text_anos2"></label>
      <select name="text_anos" id="text_anos2">
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
      </span></td>
      <th colspan="2">Dato Vacuno</th>
    </tr>
    <tr>
      <td><strong>Hacienda</strong></td>
      <td><span id="spryselect5">
        <label for="hacienda"></label>
        <select name="hacienda" id="hacienda" style="width:203px">
          <option value="">Seleccione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_hd['hacienda']?>"><?php echo $row_hd['hacienda']?></option>
<?php
} while ($row_hd = mysql_fetch_assoc($hd));
  $rows = mysql_num_rows($hd);
  if($rows > 0) {
      mysql_data_seek($hd, 0);
	  $row_hd = mysql_fetch_assoc($hd);
  }
?>
        </select>
      </span></td>
      <th width="145" style="color: #000">ID</th>
      <th width="145" style="color: #000">Peso(Kg)</th>
    </tr>
    <tr>
      <td><strong>Cliente</strong></td>
      <td><span id="spryselect4">
      <label for="cliente2"></label>
      <select name="cliente" id="cliente2" style="width:203px">
        <option value="">Cliente</option>
        <?php
do {  
?>
        <option value="<?php echo $row_client['cedula']?>"><?php echo $row_client['nombre']?></option>
        <?php
} while ($row_client = mysql_fetch_assoc($client));
  $rows = mysql_num_rows($client);
  if($rows > 0) {
      mysql_data_seek($client, 0);
	  $row_client = mysql_fetch_assoc($client);
  }
?>
      </select>
      </span></td>
      <th><span id="sprytextfield2">
      <label for="text_vacuno"></label>
      <input type="text" name="text_vacuno" id="text_vacuno" />
      </span></th>
      <th><span id="sprytextfield3">
      <label for="text_peso2"></label>
      <input type="text" name="text_peso" id="text_peso" />
      </span></th>
    </tr>
    <tr>
      <td><strong>Valor(Kg)</strong></td>
      <td><span id="sprytextfield4">
      <label for="bna"></label>
      <input name="text_valorklo" type="text" id="text_valorklo2" size="28" />
      </span></td>
      <th><input type="text" name="text_vacuno2" id="text_vacuno2" /></th>
      <th><input type="text" name="text_peso2" id="text_peso2" /></th>
    </tr>
    <tr>
      <td><strong>B.N.A ($)</strong></td>
      <td><input name="bna" type="text" id="text_valorklo" value="0" size="28" /></td>
      <th><input type="text" name="text_vacuno3" id="text_vacuno3" /></th>
      <th><input type="text" name="text_peso3" id="text_peso3" /></th>
    </tr>
    <tr>
      <td><strong>Fomento($)</strong></td>
      <td><input name="fomento" type="text" id="fomento" value="0" size="28" /></td>
      <th><input type="text" name="text_vacuno4" id="text_vacuno4" /></th>
      <th><input type="text" name="text_peso4" id="text_peso4" /></th>
    </tr>
    <tr>
      <td><strong>Fletes($)</strong></td>
      <td><input name="fletes" type="text" id="fletes" value="0" size="28" /></td>
      <th><input type="text" name="text_vacuno5" id="text_vacuno5" /></th>
      <th><input type="text" name="text_peso5" id="text_peso5" /></th>
    </tr>
    <tr>
      <td><strong>Otros($)</strong></td>
      <td><input name="otro" type="text" id="otro" value="0" size="28" /></td>
      <th><input type="text" name="text_vacuno6" id="text_vacuno6" /></th>
      <th><input type="text" name="text_peso6" id="text_peso6" /></th>
    </tr>
    <tr>
      <td><strong>Liquidación(%)</strong></td>
      <td><input name="liqui" type="text" id="liqui" value="0" size="28" /></td>
      <th><input type="text" name="text_vacuno7" id="text_vacuno7" /></th>
      <th><input type="text" name="text_peso7" id="text_peso7" /></th>
    </tr>
    <tr>
      <td rowspan="2"><strong>Comentario</strong></td>
      <td rowspan="2"><label for="comen"></label>
      <textarea name="comen" id="comen" cols="22" rows="2"></textarea></td>
      <th><input type="text" name="text_vacuno8" id="text_vacuno8" /></th>
      <th><input type="text" name="text_peso8" id="text_peso8" /></th>
    </tr>
    <tr>
      <th><input type="text" name="text_vacuno9" id="text_vacuno9" /></th>
      <th><input type="text" name="text_peso9" id="text_peso9" /></th>
    </tr>
    <tr>
      <td><strong>Estado</strong></td>
      <td><span id="spryselect6" >
        <label for="estado"></label>
        <select name="estado" id="estado" style="width:203px">
          <option>Seleccione</option>
          <option value="Pago">Pago</option>
          <option value="Pendiente">Pendiente</option>
        </select>
      </span></td>
      <th><input type="text" name="text_vacuno10" id="text_vacuno10" /></th>
      <th><input type="text" name="text_peso10" id="text_peso10" /></th>
    </tr>
    <tr>
      <td><strong>Fecha De Pago</strong></td>
      <td>D<span id="spryselect7">
      <label for="select_dia3"></label>
      <select name="select_dia2" id="select_dia3">
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
      </span>M<span id="spryselect8">
      <label for="select_mes3"></label>
      <select name="select_mes2" id="select_mes3">
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
      </span>A<span id="spryselect9">
      <label for="text_anos3"></label>
      <select name="text_anos2" id="text_anos3">
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
      </span></td>
      <th><input type="text" name="text_vacuno11" id="text_vacuno11" /></th>
      <th><input type="text" name="text_peso11" id="text_peso11" /></th>
    </tr>
    <tr>
      <td colspan="2" rowspan="6">&nbsp;</td>
      <th><input type="text" name="text_vacuno12" id="text_vacuno12" /></th>
      <th><input type="text" name="text_peso12" id="text_peso12" /></th>
    </tr>
    <tr>
      <th><input type="text" name="text_vacuno13" id="text_vacuno13" /></th>
      <th><input type="text" name="text_peso13" id="text_peso13" /></th>
    </tr>
    <tr>
      <th><input type="text" name="text_vacuno14" id="text_vacuno14" /></th>
      <th><input type="text" name="text_peso14" id="text_peso14" /></th>
    </tr>
    <tr>
      <th><input type="text" name="text_vacuno15" id="text_vacuno15" /></th>
      <th><input type="text" name="text_peso15" id="text_peso15" /></th>
    </tr>
    <tr>
      <th><input type="text" name="text_vacuno16" id="text_vacuno16" /></th>
      <th><input type="text" name="text_peso16" id="text_peso16" /></th>
    </tr>
    <tr>
      <th><input type="text" name="text_vacuno17" id="text_vacuno17" /></th>
      <th><input type="text" name="text_peso17" id="text_peso17" /></th>
    </tr>
    <tr>
      <th colspan="4"><input type="image" src="aceptar.png"  onmouseover="src='aceptar1.png';"  onmouseout="src='aceptar.png';" value="Insertar Clientes" alt="aceptar" onclick="return confirm('Desea Generar Venta ');" /></th>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var sprytejamnld4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"]});
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var spryselect9 = new Spry.Widget.ValidationSelect("spryselect9", {validateOn:["blur"]});
var spryselect8 = new Spry.Widget.ValidationSelect("spryselect8", {validateOn:["blur"]});
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysql_free_result($dia);

mysql_free_result($mes);

mysql_free_result($anos);

mysql_free_result($client);

mysql_free_result($hd);
?>
<?
	$text_vacuno=$_POST['text_vacuno'];
	$vacuno2=$_POST["text_vacuno2"];	$vacuno3=$_POST["text_vacuno3"];	$vacuno4=$_POST["text_vacuno4"]; 
	$vacuno5=$_POST["text_vacuno5"];	$vacuno6=$_POST["text_vacuno6"];	$vacuno7=$_POST["text_vacuno7"];
	$vacuno8=$_POST["text_vacuno8"];	$vacuno9=$_POST["text_vacuno9"];	$vacuno10=$_POST["text_vacuno10"];
	$vacuno11=$_POST["text_vacuno11"];	$vacuno12=$_POST["text_vacuno12"];	$vacuno13=$_POST["text_vacuno13"];
	$vacuno14=$_POST["text_vacuno14"];	$vacuno15=$_POST["text_vacuno15"];	$vacuno16=$_POST["text_vacuno16"];
	$vacuno17=$_POST["text_vacuno17"];
	
	$peso=$_POST['text_peso'];
	$peso2=$_POST["text_peso2"];	$peso3=$_POST["text_peso3"];	$peso4=$_POST["text_peso4"];
	$peso5=$_POST["text_peso5"];	$peso6=$_POST["text_peso6"];	$peso7=$_POST["text_peso7"];
	$peso8=$_POST["text_peso8"];	$peso9=$_POST["text_peso9"];	$peso10=$_POST["text_peso10"];
	$peso11=$_POST["text_peso11"];	$peso12=$_POST["text_peso12"];	$peso13=$_POST["text_peso13"];
	$peso14=$_POST["text_peso14"];	$peso15=$_POST["text_peso15"];	$peso16=$_POST["text_peso16"];
	$peso17=$_POST["text_peso17"];
		
	$valor_klo=$_POST["text_valorklo"];
	
	$cliente=$_POST['cliente'];		$hacienda=$_POST["hacienda"];	$bna=$_POST["bna"];
	$fomento=$_POST["fomento"];		$fletes=$_POST["fletes"];		$otro=$_POST["otro"];
	$liqui=$_POST["liqui"];			$comen=$_POST["comen"];			$estado=$_POST["estado"];
	
	$diab=trim(strip_tags($_POST['select_dia']));	$diab2=trim(strip_tags($_POST['select_dia2']));
	$mesb=trim(strip_tags($_POST['select_mes']));	$mesb2=trim(strip_tags($_POST['select_mes2']));
	$anob=trim(strip_tags($_POST['text_anos']));	$anob2=trim(strip_tags($_POST['text_anos2']));
	$fecha=$anob.'-'.$mesb.'-'.$diab;				$fecha_pago=$anob2.'-'.$mesb2.'-'.$diab2;


//echo"$peso";
//echo "<br>"; 
//echo"$valor_klo";
//echo "<br>"; 
$resultado=$peso * $valor_klo;		$resultado2=$peso2 * $valor_klo;		$resultado3=$peso3 * $valor_klo;
$resultado4=$peso4 * $valor_klo;	$resultado5=$peso5 * $valor_klo;		$resultado6=$peso6 * $valor_klo;
$resultado7=$peso7 * $valor_klo;	$resultado8=$peso8 * $valor_klo;		$resultado9=$peso9 * $valor_klo;
$resultado10=$peso10 * $valor_klo;	$resultado11=$peso11 * $valor_klo;		$resultado12=$peso12 * $valor_klo;
$resultado13=$peso13 * $valor_klo;	$resultado14=$peso14 * $valor_klo;		$resultado15=$peso15 * $valor_klo;
$resultado16=$peso16 * $valor_klo;	$resultado17=$peso17 * $valor_klo;
//echo "$resultado"; 
$queEmp ="SELECT * FROM `d89xz_clientes` WHERE `cedula`= '$cliente'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						@$nombre=	$rowEmp['nombre'];	
						@$apellido=	$rowEmp['apellido'];				
						}
					}
	@$responsable = $nombre;



/////////////////////////////  Costo De Ingreso ////////////////////////////////////////////////

////////////// 1 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$text_vacuno'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo1=$rowEmp['cos_entro'];			
						}
					}
////////////// 2 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno2'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo2=$rowEmp['cos_entro'];			
						}
					}					
////////////// 3 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno3'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo3=$rowEmp['cos_entro'];			
						}
					}
////////////// 4 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno4'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo4=$rowEmp['cos_entro'];			
						}
					}										
////////////// 5 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno5'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo5=$rowEmp['cos_entro'];			
						}
					}
////////////// 6 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno6'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo6=$rowEmp['cos_entro'];			
						}
					}
////////////// 7 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno7'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo7=$rowEmp['cos_entro'];			
						}
					}
////////////// 8 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno8'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo8=$rowEmp['cos_entro'];			
						}
					}																				
////////////// 9 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno9'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo9=$rowEmp['cos_entro'];			
						}
					}					
////////////// 10 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno10'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo10=$rowEmp['cos_entro'];			
						}
					}					
////////////// 11 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno11'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo11=$rowEmp['cos_entro'];			
						}
					}
////////////// 12 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno12'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo12=$rowEmp['cos_entro'];			
						}
					}
////////////// 13 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno13'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo13=$rowEmp['cos_entro'];			
						}
					}
////////////// 14 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno14'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo14=$rowEmp['cos_entro'];			
						}
					}
////////////// 15 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno15'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo15=$rowEmp['cos_entro'];			
						}
					}
////////////// 16 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno16'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo16=$rowEmp['cos_entro'];			
						}
					}
////////////// 17 ///////////
		
					$queEmp ="SELECT * FROM `d89xz_vacunos` WHERE `id_vacuno`= '$vacuno17'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {		
					while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$costo17=$rowEmp['cos_entro'];			
						}
					}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////										
																														
if ($anob!=''){
	
				$queEmp ="SELECT * FROM d89xz_consecu_orden";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
						$venta=	$rowEmp['venta'];	
						$factura=	$rowEmp['factura'];	
							
						}
					}
	

if($text_vacuno != ''){	
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$text_vacuno}','{$peso}','{$valor_klo}','{$resultado}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo1}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$text_vacuno'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$text_vacuno'",$conexion);	
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso' Where `id_vacuno`='$text_vacuno'", $conexion);


}
//////////////////    2      ////////////////
if($vacuno2 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno2}','{$peso2}','{$valor_klo}','{$resultado2}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo2}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno2'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno2'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso2' Where `id_vacuno`='$vacuno2'", $conexion);	
}

// 3///
if($vacuno3 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno3}','{$peso3}','{$valor_klo}','{$resultado3}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo3}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno3'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno3'",$conexion);	
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso3' Where `id_vacuno`='$vacuno3'", $conexion);	
}
// 4///
if($vacuno4 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno4}','{$peso4}','{$valor_klo}','{$resultado4}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo4}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno4'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno4'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso4' Where `id_vacuno`='$vacuno4'", $conexion);		
}
// 5///
if($vacuno5 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno5}','{$peso5}','{$valor_klo}','{$resultado5}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo5}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno5'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno5'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso5' Where `id_vacuno`='$vacuno5'", $conexion);		
}

// 6///
if($vacuno6 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno6}','{$peso6}','{$valor_klo}','{$resultado6}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo6}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno6'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno6'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso6' Where `id_vacuno`='$vacuno6'", $conexion);		
}

// 7///
if($vacuno7 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno7}','{$peso7}','{$valor_klo}','{$resultado7}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo7}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno7'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno7'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso7' Where `id_vacuno`='$vacuno7'", $conexion);		
}

// 8///
if($vacuno8 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno8}','{$peso8}','{$valor_klo}','{$resultado8}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo8}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno8'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno8'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso8' Where `id_vacuno`='$vacuno8'", $conexion);		
}
// 9///
if($vacuno9 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno9}','{$peso9}','{$valor_klo}','{$resultado9}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo9}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno9'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno9'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso9' Where `id_vacuno`='$vacuno9'", $conexion);		
}

// 10///
if($vacuno10 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno10}','{$peso10}','{$valor_klo}','{$resultado10}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo10}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno10'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno10'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso10' Where `id_vacuno`='$vacuno10'", $conexion);		
}
// 11///
if($vacuno11 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno11}','{$peso11}','{$valor_klo}','{$resultado11}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo11}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno11'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno11'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso11' Where `id_vacuno`='$vacuno11'", $conexion);		
}
// 12///
if($vacuno12 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno12}','{$peso12}','{$valor_klo}','{$resultado12}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo12}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno12'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno12'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso12' Where `id_vacuno`='$vacuno12'", $conexion);		
}

// 13///
if($vacuno13 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno13}','{$peso13}','{$valor_klo}','{$resultado13}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo13}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno13'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno13'",$conexion);	
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso13' Where `id_vacuno`='$vacuno13'", $conexion);	
}
// 14///
if($vacuno14 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno14}','{$peso14}','{$valor_klo}','{$resultado14}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo14}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno14'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno14'",$conexion);	
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso14' Where `id_vacuno`='$vacuno14'", $conexion);	
}

// 15///
if($vacuno15 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno15}','{$peso15}','{$valor_klo}','{$resultado15}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo15}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno15'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno15'",$conexion);	
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso15' Where `id_vacuno`='$vacuno15'", $conexion);	
}
// 16///
if($vacuno16 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno16}','{$peso16}','{$valor_klo}','{$resultado16}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo16}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno16'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno16'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso16' Where `id_vacuno`='$vacuno16'", $conexion);		
}
// 17///
if($vacuno17 !=''){
	
		
$insertar = mysql_query("INSERT INTO d89xz_ventas(`vacuno`,`peso`,`v_kilo`,`venta`,`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`cos_entro`) VALUES ('{$vacuno17}','{$peso17}','{$valor_klo}','{$resultado17}','{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$costo17}')",$conexion);

$sql = mysql_query("INSERT INTO d89xz_vacunos_venta  SELECT *  FROM d89xz_vacunos WHERE `id_vacuno`='$vacuno17'",$conexion);
$sql1 = mysql_query("Delete FROM d89xz_vacunos Where `id_vacuno`='$vacuno17'",$conexion);
$insertar = mysql_query("UPDATE  `d89xz_vacunos_venta` SET `psalida`='$peso17' Where `id_vacuno`='$vacuno17'", $conexion);		
}
///////////////////////Totales //////////////////////////

@$total=($resultado + $resultado2 + $resultado3 + $resultado4 + $resultado5 + $resultado6 + $resultado7 + $resultado8 + $resultado9 + $resultado10 + $resultado11 + $resultado12 + $resultado13 + $resultado14 + $resultado15 + $resultado16 + $resultado17);

@$costo = $costo1 + $costo2 + $costo3 + $costo4 + $costo5 + $costo6 + $costo7 + $costo8 + $costo9 + $costo10 + $costo11 + $costo12 + $costo13 + $costo14 + $costo15 + $costo16 + $costo17;

@$descuentos = $bna + $fomento + $fletes + $otro ;
@$total_desc = $total - $descuentos;
@$total_costo = $total_desc - $costo;
@$total_liqui = $total_costo* ($liqui/100); 


$insertar = mysql_query("INSERT INTO d89xz_ventas(`fecha`,`client`,`hacien`,`bna`,`fomen`,`fletes`,`otros`,`liqui`,`comen`,`factura`,`tal`,`tal_des`,`tal_liqui`,`tal_cost`,`nom_cli`,`estado`,`f_alarma`) VALUES ('{$fecha}','{$cliente}','{$hacienda}','{$bna}','{$fomento}','{$fletes}','{$otro}','{$liqui}','{$comen}','{$factura}','{$total}','{$total_desc}','{$total_liqui}','{$total_costo}','{$responsable}','{$estado}','{$fecha_pago}')",$conexion);

$queEmp ="SELECT * FROM d89xz_ventas WHERE `factura`='$factura'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($resEmp);
					if ($totEmp> 0) {
						
						while ($rowEmp = mysql_fetch_assoc($resEmp)) {
											
							
						}
					}
$insertar11 = mysql_query("INSERT INTO d89xz_diario(`concep`,`descrip`,`estado`,`cantid`,`v_unit`,`v_tal`,`fecha`,`cliente`,`factura`,`f_alarma`,`cel_client`) VALUES ('Ingreso','Venta De Vacuno','{$estado}','$totEmp','1','{$total_liqui}',NOW(),'{$responsable}','{$factura}','{$fecha_pago}','{$cliente}')",$conexion);

//$insertar = mysql_query("UPDATE  `d89xz_consecu_orden` SET `venta`=venta + 1", $conexion);
$insertar1 = mysql_query("UPDATE `d89xz_consecu_orden` SET `factura`= factura + 1", $conexion);


if($estado==Pendiente){
		
		$insertar = mysql_query("INSERT INTO `d89xz_tareas`(`fecha`,`estado`,`tarea`,`comen`) VALUES ('{$fecha_pago}','{$estado}','Venta :Pendiente Pago de Factura N°.$factura','Venta De Vacuno ')",$conexion);
		
		
		}


}

mysql_close($conexion);
?>


