<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php');  ?>


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
echo $colname_fac = $_POST['factura'];
$hacienda=$_POST['hda'];
mysql_select_db($database_conexion, $conexion);
$query_fac ="SELECT * FROM d89xz_diario WHERE hacienda='$hacienda' and  factura = '$colname_fac'";
$fac = mysql_query($query_fac, $conexion) or die(mysql_error());
$row_fac = mysql_fetch_assoc($fac);
$totalRows_fac = mysql_num_rows($fac);

@$final=$row_fac['comentario'].'-'.$_POST['comen'];
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
	
/*	$gettareas = mysql_query("SELECT * FROM `d89xz_tareas` WHERE `consec`='$consec' AND `hac`='$puntov' AND `delete`<>1 ") 
	or die(mysql_error());
	
	 $n = mysql_num_rows($gettareas);
	
	if ($n > 0){
		$setTareas = mysql_query("UPDATE `d89xz_tareas` SET `user`='$user', `delete`='1' WHERE `consec`='$consec' 
		AND `hac`='$puntov' ") or die(mysql_error());  
		
		
	} */
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

$insertar1 = mysql_query("UPDATE d89xz_diario SET estado='Anulada', comentario= '$final', user='$usuario_resp' WHERE hacienda='$hacienda' and  factura='$colname_fac'", $conexion);

?>


<?php

mysql_free_result($fac);
?>
