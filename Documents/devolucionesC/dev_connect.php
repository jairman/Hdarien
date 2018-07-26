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

date_default_timezone_set('America/Bogota');
$c_date = date('Y-m-d');

/*variable para definir que funcion se va a realizar*/
$action=$_POST["action"];

mysql_select_db($database_conexion, $conexion);

//--------------------------------
// dev_ini.php
//--------------------------------

if ($action == "updDiario"){
	  $consec=$_POST["consec"];
	  $user=$_POST["user"];
	  $puntov = $_POST["puntov"];
	  $dev = 2;
	  
	  $setDiairoV = mysql_query("UPDATE `d89xz_diario` SET `devolucion`='$dev',`user`='$user'
	  WHERE `consec_fact`='$consec' AND `hacienda`='$puntov' AND `delete`<>1 AND `concep`='Egreso' AND `f_pago`!='Devolucion'") or die(mysql_error()); 
	  
	  if($setDiairoV){
		echo "Se creo la devolucion en la tabla de diario";
	  }
	  else{
		echo "No se creo la devolucion en la tabla de diario";
	  }
}

if ($action == "newAbono"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	$puntov = $_POST["puntov"];
	$nombre = $_POST["nombre"];
	$saldo = $_POST["saldo"];
	$saldob = '-'.$saldo;
	$ced=$_POST["ced"];
	$fpago='Devolucion';
	$estado='Pago';
	$descr='Devolucion Compra No:'.$consec;
	$fecha=$c_date;
	$qty=1;
	$precio=$saldo;
	$concepto = 'Egreso';
		
	$consecs = mysql_query("SELECT * FROM `d89xz_diario` WHERE `consec_fact`='$consec' AND `hacienda`='$puntov' 
	AND `concep`='Egreso' AND `delete`<>1  ") 
	or die(mysql_error());
	$n = mysql_num_rows($consecs);
	//echo 'dev'.$n.' 1 ';
	if ($n >=1){
		$row_consecs = mysql_fetch_assoc($consecs);
		$c = $row_consecs['factura'];
		
		$abono1 = mysql_query("SELECT * FROM `d89xz_abonos` WHERE `orden`='$c' AND `hacienda`='$puntov' ") 
		or die(mysql_error());
		echo '*'.$a = mysql_num_rows($abono1);
		
		if ($a == 0){
			$abono = mysql_query("INSERT INTO `d89xz_abonos`(`orden`, `abono`, `fecha`, `empre`, `cuenta`, `hacienda`, `docu`) VALUES 
			('$c','$saldo','$c_date','$descr','Devolucion','$puntov','$nombre')") or die(mysql_error());
			
			$drio1 = mysql_query("SELECT * FROM `d89xz_diario` 
			WHERE `delete`<>1 AND `hacienda`='$puntov' ORDER BY `factura` DESC ") or die(mysql_error());
			$row_drio1 = mysql_fetch_assoc($drio1);			
			$factura1= $row_drio1['factura'];
			if($factura1!=''){
				$factura2=$factura1;
			}else{
				$factura2=0;	
			}
			$factura=$factura2 + 1;
			$diario = $factura;
			
			$setDiario = mysql_query(" INSERT INTO `d89xz_diario`( `fecha`, `factura`, `f_alarma`, `concep`, `consec_fact`, 
			`estado`, `f_pago`, `valor`, `cliente`, `cedula`, `devolucion`, `comentario`, `hacienda`, `user`) VALUES 
			('$fecha','$diario','$fecha','$concepto','$consec','$estado','$fpago','$saldob','$nombre','$ced',
			'5','$descr','$puntov','$user')") or die(mysql_error()); 
			
		}else{
			$abono = mysql_query("UPDATE `d89xz_abonos` SET `abono`='$saldo',`fecha`='$c_date' 
			WHERE `orden`='$c'") or die(mysql_error());	
			
			$setDiario = mysql_query("UPDATE `d89xz_diario` SET `fecha`='$c_date',`f_alarma`='$c_date',`valor`='$saldob', 
			`devolucion`='5',`user`='$user' WHERE `factura`='$c' AND `delete`<>1 AND `f_pago`='Devolucion' ") or die(mysql_error());	
		}
		
	}else{
		
	}
		
	if($setDiario && $abono){
		echo "Se creo la devolucion en la tabla de devolucion";
	}
	else{
		echo "No se creo la devolucion en la tabla de devolucion";
	}
}

if ($action == "newDev"){
	  $consec=$_POST["consec"];
	  $user=$_POST["user"];
	  $puntov = $_POST["puntov"];
	  $nit = $_POST["nit"];
	  $total = $_POST["total"];
	  $saldo = $_POST["saldo"];
	  
	  $getDevo = mysql_query("SELECT * FROM `h01sg_compras_devoluciones` WHERE `consec`='$consec' AND 
	  `punto_venta`='$puntov' AND `delete`<>1") or die(mysql_error()); 
	  $n = mysql_num_rows($getDevo);
	  if ($n<1){
		  $setDevo = mysql_query("INSERT INTO `h01sg_compras_devoluciones`( `consec`, `punto_venta`, `ced`, `total`, `s_favor`, 
		  `user`) VALUES ('$consec','$puntov','$nit','$total','$saldo','$user')") or die(mysql_error()); 
	  }else{
		  $setDevo = mysql_query("UPDATE `h01sg_compras_devoluciones` SET `total`='$total',`user`='$user' 
		  WHERE `consec`='$consec' AND `punto_venta`='$puntov' AND `delete`<>1") or die(mysql_error()); 
	  }
	  
	  if($setDevo){
		echo "Se creo la devolucion en la tabla de devolucion";
	  }
	  else{
		echo "No se creo la devolucion en la tabla de devolucion";
	  }
}

if ($action == "updVenta"){
	  $consec=$_POST["consec"];
	  $user=$_POST["user"];
	  $puntov = $_POST["puntov"];
	  $dev = 3;
	  
	  $setVenta = mysql_query("UPDATE `h01sg_compra` SET `user`='$user',`delete`='$dev' WHERE `consec`='$consec' AND `punto_venta`='$puntov' AND `delete`<>1") or die(mysql_error()); 
	  
	  if($setVenta){
		echo "Se creo la devolucion en la tabla de diario";
	  }
	  else{
		echo "No se creo la devolucion en la tabla de diario";
	  }
}

if ($action == "createDev"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$dev=$_POST["dev"];
	$ed=$_POST["ed"];
	$fecha=$c_date;
	$puntov=$_POST["puntov"];
	$user=$_POST["user"];
	
	$getInve = mysql_query("SELECT * FROM `h01sg_compras_devoluciones_detalle` WHERE `consec`='$consec' 
	AND `punto_venta`='$puntov' AND `delete`<>1 AND `ref`='$ref' ") or die(mysql_error());
	$n = mysql_num_rows($getInve);
	
	if ($n == 0){	
		$newInve = mysql_query("INSERT INTO `h01sg_compras_devoluciones_detalle`( `consec`, `punto_venta`, `fecha`, `ref`, `cant_dev`, 
		`user`) VALUES ('$consec','$puntov','$fecha','$ref','$dev','$user')") or die(mysql_error());
	}else{
		if ($dev == 0){
			$newInve = mysql_query("UPDATE `h01sg_compras_devoluciones_detalle` SET `fecha`='$fecha',`cant_dev`='$dev',
			`user`='$user',`delete`='1' WHERE `consec`='$consec' 
			AND `punto_venta`='$puntov' AND `delete`<>1 AND `ref`='$ref' ") or die(mysql_error());
		}else{
			$newInve = mysql_query("UPDATE `h01sg_compras_devoluciones_detalle` SET `fecha`='$fecha',`cant_dev`='$dev',
			`user`='$user' WHERE `consec`='$consec' 
			AND `punto_venta`='$puntov' AND `delete`<>1 AND `ref`='$ref' ") or die(mysql_error());
		}
	}
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "updinv"){
	$ref=$_POST["ref"];
	$cant=$_POST["cant"];
	$ed=$_POST["ed"];
	$puntov=$_POST["puntov"];
	$user=$_POST["user"];
		
	$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
	or die(mysql_error());
	$n = mysql_num_rows($revref);
	//echo 'dev'.$n.' 1 ';
	if ($n >=1){
		$row_rev = mysql_fetch_assoc($revref);
		if ($ed == 0){
			$canti = $row_rev['cant_ini']-$cant;
			$tot = $row_rev['cant_final']-$cant;
		}else{
			if ($cant>$eds){
				$r = $cant - $ed;
				$canti = $row_rev['cant_ini']-$r;
				$tot = $row_rev['cant_final']-$r;
			}
			if ($cant<$ed){
				$r = $ed - $cant;
				$canti = $row_rev['cant_ini']+$r;
				$tot = $row_rev['cant_final']+$r;
			}
		}
		//echo 'd:'.$canti.' t:'.$tot;
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$canti',`cant_final`='$tot',
		`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
		if($updref){			
			echo "Exitosa";
		}
		else{
			echo "Noexitosa";
		}
	}
}


?>