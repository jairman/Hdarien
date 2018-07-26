<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>

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

	$colname_fac = "-1";
if (isset($_GET['factura'])) {
  $colname_fac = $_GET['factura'];
}
mysql_select_db($database_conexion, $conexion);
$query_fac = sprintf("SELECT * FROM d89xz_diario WHERE hacienda='$_GET[hda]' and  factura = %s", GetSQLValueString($colname_fac, "int"));
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);

$final=$row_fac['comentario'].'-'.$_POST['estado'];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
//if($tipo ='0'){
	

	
	

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

//$final=$row_fac['concep'].'--'.$row_fac['consec_fact'];

$concep=$row_fac['concep'];
$con=$row_fac['consec_fact'];
$punto=$row_fac['hacienda'];

if($concep='Egreso' && $con!=''){
	
	
	//echo "Egreso";
	
	$consec=$con;
	$user=$usuario2;
	$puntov=$punto;
		
	$newInve = mysql_query("UPDATE `h01sg_compra` SET `costo`='0',`cant`='0',`obs`='Anulada',
	`user`='$user',`delete`=2 WHERE `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
//-----------------------Tarea----------------------------------------------------------------	
	
	$gettareas = mysql_query("SELECT * FROM `d89xz_tareas` WHERE `consec`='$consec' AND `hac`='$puntov' AND `delete`<>1 ") 
	or die(mysql_error());
	
	 $n = mysql_num_rows($gettareas);
	
	if ($n > 0){
		$setTareas = mysql_query("UPDATE `d89xz_tareas` SET `user`='$user', `delete`='1' WHERE `consec`='$consec' 
		AND `hac`='$puntov' ") or die(mysql_error());  
		
		
	} 
//---------------------------Anula Producto------------------------------------------------------------	

$searchref = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
	//echo $n = mysql_num_rows($searchref);
	
	$searchdevo = mysql_query("SELECT * FROM `h01sg_compra` WHERE `consec`='$consec' AND `delete`=2 ") 
	or die(mysql_error());
	$devo = mysql_num_rows($searchdevo);
	
	
	while ($row_ref = mysql_fetch_assoc($searchref)){
		$ref = trim($row_ref['ref']);
		$puntov = trim($row_ref['punto_venta']);
		$canti = $row_ref['cant'];
		
		
		
		if ($devo >= 1){
			
			$getDevo = mysql_query("SELECT * FROM `h01sg_compras_devoluciones_detalle` WHERE
			`consec`='$consec' AND `ref`='$ref' AND `delete`<>1  ") or die(mysql_error());
			$row_devo = mysql_fetch_assoc($getDevo);
			echo ' val'.$devolucion = $row_devo['cant_dev'];
			
			$det = $canti-$devolucion;
			
			$getInv = mysql_query("SELECT `cant_ini`,`cant_final` FROM `h01sg_inventario` 
			WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") or die(mysql_error());
			$row_inv = mysql_fetch_assoc($getInv);
			$inv = $row_inv['cant_ini'];
			$tot = $row_inv['cant_final'];
			//echo  ' d'.$det.' i'.$inv.' t'.$tot.' | ';
			
			if($det == $inv){
				$upddet = mysql_query("UPDATE `h01sg_inventario_detalle` SET `cant`='0',`user`='$user' WHERE `ref`='$ref' AND
				`mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
				$delinvent = mysql_query("UPDATE `h01sg_inventario` SET `user`='$user',`delete`='1' 
				WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1 ") or die(mysql_error());
				
				$deldetail = mysql_query("INSERT INTO `h01sg_inventario_detalle_anul`  SELECT *  FROM `h01sg_inventario_detalle` 
				WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
				$deldetail2 = mysql_query("DELETE FROM `h01sg_inventario_detalle` 
				WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
			}else{
				$newcant = $inv - $det;
				$newtot = $tot - $det;
				
				//echo ' c'.$newcant.'t'.$newtot.' | ';
				
				$upddet = mysql_query("UPDATE `h01sg_inventario_detalle` SET `cant`='0',`user`='$user' WHERE `ref`='$ref' AND
				`mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
				$delinvent = mysql_query("UPDATE `h01sg_inventario`  SET `cant_ini`='$newcant',`cant_final`='$newtot',`user`='$user' 
				WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1 ") or die(mysql_error());
				
				$deldetail = mysql_query("INSERT INTO `h01sg_inventario_detalle_anul`  SELECT *  FROM `h01sg_inventario_detalle` 
				WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
				$deldetail2 = mysql_query("DELETE FROM `h01sg_inventario_detalle` 
				WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
			
			}
		}else{
			
			$det = $canti;
			
			$getInv = mysql_query("SELECT `cant_ini`,`cant_final` FROM `h01sg_inventario` 
			WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") or die(mysql_error());
			$row_inv = mysql_fetch_assoc($getInv);
			$inv = $row_inv['cant_ini'];
			$tot = $row_inv['cant_final'];
			
			if($det == $inv){
				$upddet = mysql_query("UPDATE `h01sg_inventario_detalle` SET `cant`='0',`user`='$user' WHERE `ref`='$ref' AND
				`mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
				$delinvent = mysql_query("UPDATE `h01sg_inventario` SET `user`='$user',`delete`='1' 
				WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1 ") or die(mysql_error());
				
				$deldetail = mysql_query("INSERT INTO `h01sg_inventario_detalle_anul`  SELECT *  FROM `h01sg_inventario_detalle` 
				WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
				$deldetail2 = mysql_query("DELETE FROM `h01sg_inventario_detalle` 
				WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
			}else{
				$newcant = $inv - $det;
				$newtot = $tot - $det;
				
				$upddet = mysql_query("UPDATE `h01sg_inventario_detalle` SET `cant`='0',`user`='$user' WHERE `ref`='$ref' AND
				`mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
				$delinvent = mysql_query("UPDATE `h01sg_inventario`  SET `cant_ini`='$newcant',`cant_final`='$newtot',`user`='$user' 
				WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1 ") or die(mysql_error());
				
				$deldetail = mysql_query("INSERT INTO `h01sg_inventario_detalle_anul`  SELECT *  FROM `h01sg_inventario_detalle` 
				WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
				
				$deldetail2 = mysql_query("DELETE FROM `h01sg_inventario_detalle` 
				WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
			
			}	
		}
	}
	

	


}

			
				if($concep='Ingreso' && $con!=''){
					//echo "Ingreso";
					
					
					
				}











  $insertar1 = mysql_query("UPDATE d89xz_diario SET estado='Anulada', comentario= '$final', user='$usuario_resp' WHERE hacienda='$_GET[hda]' and  factura='$_GET[factura]'", $conexion);

 echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";
}

//}else{
	
	
	
/*echo "<script type=''>
		alert('Señor Usuario Usted No Está Autorizado Para Realizar Esta Operación…!');
	</script>";
echo " <script type='text/javascript'>

  		 parent.location.reload();

			</script>";	*/
//}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p>&nbsp;</p>
<table width="80%" border="0" align="center">
  <tr>
    <td><img src="../img/Logo.png" alt="" width="200" height="90" /></td>
  </tr>
</table>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table border="1" align="center" cellspacing="0">
    <tr valign="baseline">
      <td colspan="2" align="center"  class="tittle">Anular factura</td>
    </tr>
    <tr valign="baseline">
      <th width="120" align="left" nowrap="nowrap" class="bold">Comentario</th>
      <th width="334"><input name="estado" type="text" class="cont" value="<?php echo htmlentities($row_fac['anula'], ENT_COMPAT, 'utf-8'); ?>" size="52" /></th>
    </tr>
    <tr valign="baseline">
      <th colspan="2" align="center" nowrap="nowrap"><input type="submit" class="ext" value="Actualizar Estado" /></th>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_fac['factura']; ?>" />
</form>

<p>&nbsp;</p>
</body>
</html>
<?php

mysql_free_result($fac);
?>
