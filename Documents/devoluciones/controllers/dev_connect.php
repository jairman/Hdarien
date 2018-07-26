<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>
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

if (isset($_GET['getcliente'])){
	$cliente=$_GET["getcliente"];
	
	$searchCliente = mysql_query("SELECT `nombre`, `telefono`, `dir`, `saldo_favor` FROM `d89xz_clientes` 
	WHERE `cedula`='$cliente' AND `delete`<>1 ") or die(mysql_error());
	
	$rows = array();
	while($r = mysql_fetch_assoc($searchCliente)) {
		$rows[] = $r;
	}
	if($searchCliente){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if ($action == "updDiario"){
	  $consec=$_POST["consec"];
	  $user=$_POST["user"];
	  $puntov = $_POST["puntov"];
	  $dev = 2;
	  
	  $setDiairoV = mysql_query("UPDATE `d89xz_diario` SET `devolucion`='$dev',`user`='$user'
	  WHERE `consec_fact`='$consec' AND `hacienda`='$puntov' AND `delete`<>1 AND `concep`='Ingreso'
	  AND `f_pago`<>'Devolucion'") or die(mysql_error()); 
	  
	  if($setDiairoV){
		echo "Se actualizo la factura con la devolucion en la tabla de diario";
	  }
	  else{
		echo "No se actualizo la factura con la devolucion en la tabla de diario";
	  }
}

if ($action == "newAbono"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	$puntov = $_POST["puntov"];
	$nombre = $_POST["nombre"];
	$saldo = $_POST["saldo"];
	$saldob = $saldo;
	$ced=$_POST["ced"];
	$fpago='Devolucion';
	$estado='Pago';
	$descr='Devolucion Venta No:'.$consec;
	$fecha=$c_date;
	$qty=1;
	$precio=$saldo;
	$concepto = 'Ingreso';
		
	$consecs = mysql_query("SELECT * FROM `d89xz_diario` WHERE `consec_fact`='$consec' AND `hacienda`='$puntov' 
	AND `concep`='Ingreso' AND `delete`<>1  ") 
	or die(mysql_error());
	$n = mysql_num_rows($consecs);
	//echo 'dev'.$n.' 1 ';
	if ($n >=1){
		$row_consecs = mysql_fetch_assoc($consecs);
		$c = $row_consecs['factura'];
		
		$abono1 = mysql_query("SELECT * FROM `d89xz_abonos` WHERE `orden`='$c' AND `hacienda`='$puntov' ") 
		or die(mysql_error());
		$a = mysql_num_rows($abono1);
		//echo '*'.$a;
		
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
			`devolucion`='5',`user`='$user' WHERE `factura`='$c' AND `delete`<>1 AND `f_pago`='Devolucion' AND `concep`='Ingreso' ") or die(mysql_error());	
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

if ($action == "newAbono2"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	$puntov = $_POST["puntov"];
	$nombre = $_POST["nombre"];
	$saldo = $_POST["saldo"];
	$saldob = $saldo;
	$ced=$_POST["ced"];
	$fpago='Devolucion';
	$estado='Pago';
	$descr='Devolucion Venta No:'.$consec;
	$fecha=$c_date;
	$qty=1;
	$precio=$saldo;
	$concepto = 'Ingreso';
		
	$consecs = mysql_query("SELECT * FROM `d89xz_diario` WHERE `consec_fact`='$consec' AND `hacienda`='$puntov' 
	AND `concep`='Ingreso' AND `delete`<>1  ") 
	or die(mysql_error());
	$n = mysql_num_rows($consecs);
	//echo 'dev'.$n.' 1 ';
	if ($n >=1){
		$row_consecs = mysql_fetch_assoc($consecs);
		$c = $row_consecs['factura'];
				
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
		$setDiario = mysql_query("UPDATE `d89xz_diario` SET `fecha`='$c_date',`f_alarma`='$c_date',`valor`='$saldob', 
			`devolucion`='5',`user`='$user' WHERE `factura`='$c' AND `delete`<>1 AND `f_pago`='Devolucion' AND `concep`='Ingreso' ") or die(mysql_error());	
	}
		
	if($setDiario){
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
	  
	  $getDevo = mysql_query("SELECT * FROM `h01sg_devoluciones` WHERE `consec`='$consec' AND 
	  `punto_venta`='$puntov' AND `delete`<>1") or die(mysql_error()); 
	  $n = mysql_num_rows($getDevo);
	  if ($n<1){
		  $setDevo = mysql_query("INSERT INTO `h01sg_devoluciones`( `consec`, `punto_venta`, `ced`, `total`, `s_favor`, 
	  	  `user`) VALUES ('$consec','$puntov','$nit','$total','$saldo','$user')") or die(mysql_error()); 
	  }else{
		  $setDevo = mysql_query("UPDATE `h01sg_devoluciones` SET `ced`='$nit',`total`='$total',`s_favor`='$saldo',`user`='$user' 
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
	  $nit = $_POST["nit"];
	  $nombre = $_POST["nombre"];
	  $tel = $_POST["tel"];
	  $dev = 2;
	  
	  $setVenta = mysql_query("UPDATE `h01sg_venta` SET `cliente`='$nombre',`ced`='$nit',`tel`='$tel',`user`='$user',
	  `delete`='$dev' WHERE `consec`='$consec' AND `punto_venta`='$puntov' AND `delete`<>1") or die(mysql_error()); 
	  
	  if($setVenta){
		echo "Se creo la devolucion en la tabla de diario";
	  }
	  else{
		echo "No se creo la devolucion en la tabla de diario";
	  }
}

if ($action == "createDev"){
	$consec=$_POST["consec"];
	$puntov=$_POST["puntov"];
	$ref=$_POST["ref"];
	$dev=$_POST["dev"];
	$ed=$_POST["ed"];
	$fecha=$c_date;
	$user=$_POST["user"];
	
	$getInve = mysql_query("SELECT * FROM `h01sg_devoluciones_detalle` WHERE `consec`='$consec' 
	AND `punto_venta`='$puntov' AND `delete`<>1 AND `ref`='$ref' ") or die(mysql_error());
	$n = mysql_num_rows($getInve);
	
	if ($n == 0){	
		$newInve = mysql_query("INSERT INTO `h01sg_devoluciones_detalle`( `consec`, `punto_venta`, `fecha`, `ref`, `cant_dev`, 
		`user`) VALUES ('$consec','$puntov','$fecha','$ref','$dev','$user')") or die(mysql_error());
	}else{
		if ($dev == 0){
			$newInve = mysql_query("UPDATE `h01sg_devoluciones_detalle` SET `fecha`='$fecha',`cant_dev`='$dev',
			`user`='$user',`delete`='1' WHERE `consec`='$consec' 
			AND `punto_venta`='$puntov' AND `delete`<>1 AND `ref`='$ref' ") or die(mysql_error());
		}else{
			$newInve = mysql_query("UPDATE `h01sg_devoluciones_detalle` SET `fecha`='$fecha',`cant_dev`='$dev',
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
			$canti = $row_rev['cant_devo']+$cant;
			$tot = $row_rev['cant_final']+$cant;
		}else{
			if ($cant>$eds){
				$r = $cant - $ed;
				$canti = $row_rev['cant_devo']+$r;
				$tot = $row_rev['cant_final']+$r;
			}
			if ($cant<$ed){
				$r = $ed - $cant;
				$canti = $row_rev['cant_devo']-$r;
				$tot = $row_rev['cant_final']-$r;
			}
		}
		//echo 'd:'.$canti.' t:'.$tot;
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_devo`='$canti',`cant_final`='$tot',
		`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
		if($updref){			
			echo "Exitosa";
		}
		else{
			echo "Noexitosa";
		}
	}
}

if ($action == "new_client"){
	$user=$_POST["user"];
	$tel=$_POST["tel"];
	$ced=$_POST["ced"];
	$nombre=$_POST["nombre"];
	$dir=$_POST["dir"];
	$saldof = $_POST["saldof"];
	
	$newfact = mysql_query("INSERT INTO `d89xz_clientes`(`cedula`, `nombre`, `telefono`, `dir`,`saldo_favor`,`user`) VALUES 	
	('$ced','$nombre','$tel','$dir','$saldo','$user')") or die(mysql_error());
	
	if($newfact){
		echo "Se creo el cliente con exito";
	}
	else{
		echo "No se creo el cliente con exito";
	}
}

if ($action == "updclient"){
	$nit=$_POST["nit"];
	$user=$_POST["user"];
	$saldof = $_POST["saldof"];
	$consec=$_POST["consec"];
	$puntov=$_POST["puntov"];
	
	$revcli = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$nit' AND `delete`<>1  ") 
	or die(mysql_error());
	
	$revdebo = mysql_query("SELECT * FROM `h01sg_devoluciones` WHERE `consec`='$consec' AND `punto_venta`='$puntov' AND `delete`<>1") 
	or die(mysql_error());
	echo ' m:'.$m = mysql_num_rows($revdebo);
	
	if ($m < 1){
		$row_clie = mysql_fetch_assoc($revcli);
		$canti = $row_clie['saldo_favor']+$saldof;
		$setsaldo = mysql_query("UPDATE `d89xz_clientes` SET `saldo_favor`='$canti',`user`='$user' WHERE 
		`cedula`='$nit' AND `delete`<>1") or die(mysql_error()); 
	}else{
		$row_clie = mysql_fetch_assoc($revcli);
		$canti = $row_clie['saldo_favor'];
		$row_debo = mysql_fetch_assoc($revdebo);
		$cantd = $row_debo['s_favor'];
		if ($canti = 0){
			$total=$saldof;
		}else{
			if ($saldof > $cantd){
				$s = $saldof - $cantd;
				$total = $canti + $s;
			}else{
				$s = $cantd - $saldof;
				$total = $canti - $s;
			}
		}
		$setsaldo = mysql_query("UPDATE `d89xz_clientes` SET `saldo_favor`='$total',`user`='$user' WHERE 
		`cedula`='$nit' AND `delete`<>1") or die(mysql_error()); 
	}
	
	if($setsaldo){
		echo "Se actualizo la tabla de cliente";
	}
	else{
		echo "No se actualizo la tabla de cliente";
	}
}

?>