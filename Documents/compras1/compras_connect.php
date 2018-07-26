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
// compras_ini.php
//--------------------------------

if ($action == "anulfac"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
		
	$newInve = mysql_query("UPDATE `h01sg_compra` SET `costo`='0',`cant`='0',`obs`='Anulada',
	`user`='$user',`delete`=2 WHERE `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "anulDiario"){
	$user=$_POST["user"];
	$puntov=$_POST["puntov"];
	$consec=$_POST["consec"];
	$estado= 'Anulada';
	
	$getdiario = mysql_query("SELECT * FROM `d89xz_diario` WHERE `factura`='$consec' AND `hacienda`='$puntov' AND `delete`<>1 ") 
	or die(mysql_error());
	
	echo $n = mysql_num_rows($getdiario);
	
	if ($n > 0){
		$setTareas = mysql_query("UPDATE `d89xz_diario` SET `estado`='$estado', `user`='$user' WHERE `factura`='$consec' 
		AND `hacienda`='$puntov' ") or die(mysql_error());  
		
		if($setTareas){
			echo "Se elimino el registro en la tabla de diario";
		}
		else{
			echo "No se elimino el registro en la tabla de diario";
		}
	} 
}

if ($action == "delDiario"){
	$user=$_POST["user"];
	$puntov=$_POST["puntov"];
	$consec=$_POST["consec"];
	
	$getdiario = mysql_query("SELECT * FROM `d89xz_diario` WHERE `factura`='$consec' AND `hacienda`='$puntov' AND `anula`<>1 ") 
	or die(mysql_error());
	
	echo $n = mysql_num_rows($getdiario);
	
	if ($n > 0){
		$setTareas = mysql_query("UPDATE `d89xz_diario` SET `respon`='$user', `anula`='1' WHERE `factura`='$consec' 
		AND `hacienda`='$puntov' ") or die(mysql_error());  
		
		if($setTareas){
			echo "Se elimino el registro en la tabla de diario";
		}
		else{
			echo "No se elimino el registro en la tabla de diario";
		}
	} 
}

if ($action == "delTarea"){
	$user=$_POST["user"];
	$puntov=$_POST["puntov"];
	$consec=$_POST["consec"];
	
	$gettareas = mysql_query("SELECT * FROM `d89xz_tareas` WHERE `consec`='$consec' AND `hac`='$puntov' AND `delete`<>1 ") 
	or die(mysql_error());
	
	echo $n = mysql_num_rows($gettareas);
	
	if ($n > 0){
		$setTareas = mysql_query("UPDATE `d89xz_tareas` SET `user`='$user', `delete`='1' WHERE `consec`='$consec' 
		AND `hac`='$puntov' ") or die(mysql_error());  
		
		if($setTareas){
			echo "Se elimino el registro en la tabla de tareas";
		}
		else{
			echo "No se elimino el registro en la tabla de tareas";
		}
	} 
}

if ($action == "anulprod"){
	$consec=trim($_POST["consec"]);
	$user=$_POST["user"];
		
	$searchref = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
	//echo $n = mysql_num_rows($searchref);
	
	$searchdevo = mysql_query("SELECT * FROM `h01sg_compra` WHERE `consec`='$consec' AND `delete`=2 ") 
	or die(mysql_error());
	echo 'dev'.$devo = mysql_num_rows($searchdevo);
	
	
	while ($row_ref = mysql_fetch_assoc($searchref)){
		echo ' ref'.$ref = trim($row_ref['ref']);
		echo ' ptv'.$puntov = trim($row_ref['punto_venta']);
		echo ' cant'.$canti = $row_ref['cant'];
		echo ' | ';
		//echo 'ref: '.$ref;
		
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
			echo  ' d'.$det.' i'.$inv.' t'.$tot.' | ';
			
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
				
				echo ' c'.$newcant.'t'.$newtot.' | ';
				
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
	
	if($searchref){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

//--------------------------------
// compras_edit.php
//--------------------------------

if (isset($_GET['getprove'])){
	$prove=$_GET["getprove"];
	
	$newProd = mysql_query("SELECT `cedula`, `telefono` FROM `d89xz_prove` WHERE `nombre`='$prove' AND `delete`<>1 ") 
	or die(mysql_error());
	$rows = array();
	while($r = mysql_fetch_assoc($newProd)) {
		$rows[] = $r;
	}
	if($newProd){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['verifref'])){
	$ref=$_GET['verifref'];  
	$searchRfid = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ") or die(mysql_error());
	$rfid = mysql_num_rows($searchRfid);
	if($rfid > 0){
		echo'existe';
	}else{
		echo'noexiste';
	}
	return false;	
}

if (isset($_GET['getref'])){
	$ref=$_GET["getref"];
	
	$newProd = mysql_query("SELECT  *
	FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ") 
	or die(mysql_error());
	$rows = array();
	while($r = mysql_fetch_assoc($newProd)) {
		$rows[] = $r;
	}
	if($newProd){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getids'])){
	
	$getids = mysql_query("SELECT `id` FROM `h01sg_temp_img` WHERE `delete`=0 ") 
	or die(mysql_error());
	$rows = array();
	while($r = mysql_fetch_assoc($getids)) {
		$rows[] = $r;
	}
	if($getids){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if ($action == "updDiario"){
	$consec=$_POST["consec"];
	$ced=$_POST["ced"];
	$cliente=$_POST["cliente"];
	$fpago=$_POST["fpago"];
	$estado=$_POST["estado"];
	$descr=$_POST["descr"];
	$fecha_pago=$_POST["fecha_pago"];
	$fecha=$_POST["fecha"];
	$qty=$_POST["qty"];
	$precio='-'.$_POST["precio"];
	$user=$_POST["user"];
	$concepto = $_POST["concepto"];
	$puntov = $_POST["puntov"];
	
	$getdiario = mysql_query("SELECT * FROM `d89xz_diario` WHERE `consec_fact`='$consec' AND `hacienda`='$puntov' AND `delete`<>1 ") or die(mysql_error());
	
	$n = mysql_num_rows($getdiario);
	if ($n > 0){
		$setDiairo = mysql_query(" UPDATE `d89xz_diario` SET `fecha`='$fecha',`f_alarma`='$fecha_pago',`concep`='$concepto',
		`estado`='$estado',`f_pago`='$fpago',`valor`='$precio',`cliente`='$cliente',`cedula`='$ced',
		`comentario`='$descr',`user`='$user' WHERE `consec_fact`='$consec' AND `hacienda`='$puntov' AND `delete`<>1") or die(mysql_error());
	}else{
		
		mysql_select_db($database_conexion, $conexion);
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
		
		$setDiairo = mysql_query("INSERT INTO `d89xz_diario`(`fecha`, `factura`, `f_alarma`, `concep`,`consec_fact`, 
		`estado`, `f_pago`, `valor`, `cliente`, `cedula`, `comentario`, `hacienda`, `user`) VALUES 
	  	('$fecha','$factura','$fecha_pago','$concepto','$consec','$estado','$fpago','$precio','$cliente','$ced','$descr',
	 	'$puntov','$user')") or die(mysql_error());
	}
	
	if($setDiairo){
	echo "Se actualizo el registro en la tabla de diario";
	}
	else{
	echo "No se actualizo el registro en la tabla de diario";
	}
}

if ($action == "delTarea"){
	$user=$_POST["user"];
	$puntov=$_POST["puntov"];
	$consec=$_POST["consec"];
	
	$gettareas = mysql_query("SELECT * FROM `d89xz_tareas` WHERE `consec`='$consec' AND `hac`='$puntov' AND `delete`<>1 ") 
	or die(mysql_error());
	
	echo $n = mysql_num_rows($gettareas);
	
	if ($n > 0){
		$setTareas = mysql_query("UPDATE `d89xz_tareas` SET `user`='$user', `delete`='1' WHERE `consec`='$consec' 
		AND `hac`='$puntov' ") or die(mysql_error());  
		
		if($setTareas){
			echo "Se elimino el registro en la tabla de tareas";
		}
		else{
			echo "No se elimino el registro en la tabla de tareas";
		}
	} 
}

if ($action == "updTarea"){
	$tarea=$_POST["tarea"];
	$estado=$_POST["estado"];
	$descr=$_POST["descr"];
	$fecha_pago=$_POST["fecha_pago"];
	$fecha=$_POST["fecha"]; 
	$user=$_POST["user"];
	$puntov=$_POST["puntov"];
	$consec=$_POST["consec"];
	
	$gettareas = mysql_query("SELECT * FROM `d89xz_tareas` WHERE `consec`='$consec' AND `hac`='$puntov' AND `delete`<>1 ") or die(mysql_error());
	
	$n = mysql_num_rows($gettareas);
	if ($n > 0){
		$setTareas = mysql_query("UPDATE `d89xz_tareas` SET `tarea`='$tarea',
		`fecha_ini`='$fecha',`fecha`='$fecha_pago',`estado`='$estado',`jorn`='$fecha',
		`respon`='$user',`comen`='$descr',`user`='$user' WHERE `consec`='$consec' 
		AND `hac`='$puntov' AND `delete`<>0") or die(mysql_error());  
	}else{
		$setTareas = mysql_query("INSERT INTO `d89xz_tareas`(`tarea`, `consec`, `fecha_ini`, `fecha`, `estado`, 
		`jorn`, `hac`, `respon`, `comen`, `user`) 
		VALUES ('$tarea', '$consec', '$fecha','$fecha_pago','$estado','$fecha','$puntov','$user',
		'$descr','$user')") or die(mysql_error());
	} 
	
	if($setTareas){
		echo "Se actualizo el registro en la tabla de tareas";
	}
	else{
		echo "No se actualizo el registro en la tabla de tareas";
	}
}

if(isset($_POST['del_prod'])){
	$refs= $_POST['del_prod'];
	$consec=$_POST['consec'];
	$fecha=$_POST['fecha'];
	$user=$_POST['user'];
	$puntov=$_POST['ptov'];
	$tama=$_POST['tama'];
	
	for($j=0;$j<$tama;$j++){
		$ref=trim($refs[$j]);
		if ($ref){
			$getDet = mysql_query("SELECT `cant` FROM `h01sg_inventario_detalle` WHERE `consec`='$consec' AND `ref`='$ref' AND `delete`<>1") 
			or die(mysql_error());
			$row_det = mysql_fetch_assoc($getDet);
			$det = $row_det['cant'];
			
			$getInv = mysql_query("SELECT `cant_ini`,`cant_final` FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") 
			or die(mysql_error());
			$row_inv = mysql_fetch_assoc($getInv);
			$inv = $row_inv['cant_ini'];
			$tot = $row_inv['cant_final'];
			
			if($det == $inv){
				
				$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `user`='$user',`delete`='1' WHERE
				`ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
				or die(mysql_error());
			
				$updref = mysql_query("UPDATE `h01sg_inventario` SET `user`='$user',`delete`=1 WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
			
				if($newInve && $updref){
					echo "se borro el producto";
				}
				else{
					echo "no se borro el producto";
				}
			}else{
				$newcant = $inv - $det;
				$newtot = $tot - $det;
				
				$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `user`='$user',`delete`='1' WHERE
				`ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
				or die(mysql_error());
			
				$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$newcant',`cant_final`='$newtot',`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
			
				if($newInve && $updref){
					echo "se actualizo el producto";
				}
				else{
					echo "no se actualizo el producto";
				}
			}	
		}	
	}
}

/*if ($action == "del_prod"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$user=$_POST["user"];
	$puntov=$_POST["puntov"];
	
	$getDet = mysql_query("SELECT `cant` FROM `h01sg_inventario_detalle` WHERE `consec`='$consec' AND `ref`='$ref' AND `delete`<>1") 
	or die(mysql_error());
	$row_det = mysql_fetch_assoc($getDet);
	$det = $row_det['cant'];
	
	$getInv = mysql_query("SELECT `cant_ini`,`cant_final` FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") 
	or die(mysql_error());
	$row_inv = mysql_fetch_assoc($getInv);
	$inv = $row_inv['cant_ini'];
	$tot = $row_inv['cant_final'];
	
	if($det == $inv){
	
		$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `user`='$user',`delete`='1' WHERE
	`ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
	
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `user`='$user',`delete`=1 WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
	
		if($newProd && $newInve && $updref){
			echo "se borro el producto";
		}
		else{
			echo "no se borro el producto";
		}
	}else{
		$newcant = $inv - $det;
		$newtot = $tot - $det;
		
		$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `user`='$user',`delete`='1' WHERE
	`ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
	
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$newcant',`cant_final`='$newtot',`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
	
		if($newInve && $updref){
			echo "se actualizo el producto";
		}
		else{
			echo "no se actualizo el producto";
		}
		
	}
}*/

if ($action == "upd_fact"){
	$consec=$_POST["consec"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$prove= $_POST["prove"];
	$tel=$_POST["tel"];
	$ced=$_POST["ced"];
	$forma=$_POST["forma"];
	$fpago=$_POST["fpago"];
	$obs= $_POST["obs"];
	$costo=$_POST["costo"];
	$cant=$_POST["cant"];
	$puntov=$_POST["puntov"];
	
	
	$newfact = mysql_query("UPDATE `h01sg_compra` SET `punto_venta`='$puntov', `cliente`='$prove',
	`ced`='$ced',`tel`='$tel',`f_fact`='$fecha',`f_pago`='$fpago',`forma_pago`='$forma',
	`costo`='$costo',`cant`='$cant',`obs`='$obs',`user`='$user' 
	WHERE`consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
	
	if($newfact){
		echo "Se actualizó la factura con exito";
	}
	else{
		echo "No se actualizó la factura con exito";
	}
}

if ($action == "new_prod"){
	$rfid=$_POST["rfid"];
	$ref=$_POST["ref"];
	$codb=$_POST["codb"];
	$marca=$_POST["marca"];
	$desc=$_POST["desc"];
	$talla=$_POST["talla"];
	$costo=$_POST["costo"];
	$precio=$_POST["precio"];
	$preciom=$_POST["preciom"];
	$user=$_POST["user"];
	$img=$_POST["img"];
	
	$revref = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1  ") 
	or die(mysql_error());
	$n = mysql_num_rows($revref);
	if ( $n >= 1){
		$newProd = mysql_query("UPDATE `h01sg_producto` SET `img_id`='$img',
		`fecha`='$c_date',`cod_barra`='$codb',`rfid`='$rfid',`marca`='$marca',`desc`='$desc',`talla`='$talla', 
		`precio_mayo`='$preciom',`precio_und`='$precio',`costo_und`='$costo',`user`='$user'
		 WHERE `ref`='$ref' AND `delete`<>1") 
		or die(mysql_error());	
	}else{
		$newProd = mysql_query("INSERT INTO `h01sg_producto`( `ref`, `img_id`, `fecha`, `cod_barra`, `rfid`, `marca`, 
		`desc`,`talla`,`precio_mayo`, `precio_und`, `costo_und`, `user`) VALUES ('$ref','$img','$c_date','$codb',
		'$rfid','$marca','$desc','$talla','$preciom', '$precio','$costo','$user') ") 
		or die(mysql_error());	
	}
	
	if($newProd){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "upd_prod"){
	$rfid=$_POST["rfid"];
	$ref=$_POST["ref"];
	$codb=$_POST["codb"];
	$marca=$_POST["marca"];
	$desc=$_POST["desc"];
	$talla=$_POST["talla"];
	$costo=$_POST["costo"];
	$precio=$_POST["precio"];
	$preciom=$_POST["preciom"];
	$user=$_POST["user"];
	$img=$_POST["img"];
	
	$newProd = mysql_query("UPDATE `h01sg_producto` SET `img_id`='$img',`cod_barra`='$codb',
	`rfid`='$rfid',`marca`='$marca',`desc`='$desc',`talla`='$talla',`precio_mayo`='$preciom',
	`precio_und`='$precio',`costo_und`='$costo',`user`='$user' 
	WHERE `ref`='$ref' AND `delete`<>1 ") 
	or die(mysql_error());
	
	if($newProd){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "img_upd"){
	$img=$_POST["img"];
	$est = 2;
	$updimg = mysql_query("UPDATE `h01sg_temp_img` SET `delete`='$est' WHERE `id`='$img' ") 
	or die(mysql_error());
	
	if($updimg){
		echo "Se actualizo la imagen con exito";
	}
	else{
		echo "No se actualizo la imagen";
	}
}

if ($action == "new_inventreg"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$cant=$_POST["cant"];
	$fecha=$_POST["fecha"];
	$tipo=$_POST["tipo"];
	$mov=$_POST["mov"];
	$obs=$_POST["obs"];
	$pre=$_POST["pre"];
	$puntov=$_POST["puntov"];
	$user=$_POST["user"];
	$costo=$_POST["costo"];
	
	$revinve = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `ref`='$ref' AND `delete`<>1  
	AND `consec`='$consec' AND `punto_venta`='$puntov'") 
	or die(mysql_error());
	$n = mysql_num_rows($revinve);
	if ($n >= 1){
		$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `punto_venta`='$puntov', `punto_ini`='$puntov', 
		`cant`='$cant', `obs`='$obs',`mov`='$mov',`fecha`='$fecha', `user`='$user', `costo`='$costo'
		 WHERE `ref`='$ref' AND `delete`<>1  AND `consec`='$consec' AND `punto_venta`='$puntov'") 
		or die(mysql_error());
	}else{
		$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`, `punto_ini`, 
		`cant`, `obs`,`mov`, `consec`,`costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntov',
		'$cant','$obs','$pre','$consec','$costo','$fecha','$user')") 
		or die(mysql_error());	
	}
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "upd_inventreg"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$cant=$_POST["cant"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$puntov=$_POST["puntov"];
	$costo=$_POST["costo"];
	
	$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `cant`='$cant',`fecha`='$fecha', `costo`='$costo',
	`user`='$user' WHERE `ref`='$ref' AND `mov`='c' AND`consec`='$consec' AND `delete`<>1 AND `punto_venta`='$puntov'") 
	or die(mysql_error());
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "new_cantreg"){
	$ref=$_POST["ref"];
	$cant=$_POST["cant"];
	$mov=$_POST["mov"];
	$puntov=$_POST["puntov"];
	$user=$_POST["user"];
		
	$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") 
	or die(mysql_error());
	$rev = mysql_num_rows($revref);
	$row_rev = @mysql_fetch_assoc($revref);
	if ($rev >=1){
		$ini = $row_rev['cant_ini'];
		$final = $row_rev['cant_final'];
		
		$cantb = $cant+$ini;
		$tot = $cant+$final;	
		
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$cantb',`cant_final`='$tot',
		`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
		if($updref){
			echo "exitoso";
		}
		else{
			echo "noexitoso";
		}
	}else{
		$insref = mysql_query("INSERT INTO `h01sg_inventario`( `ref`, `punto_venta`, `cant_ini`, `cant_final`, `user`) 
		VALUES ('$ref','$puntov','$cant','$cant','$user')  ")or die(mysql_error());
		if($insref){
			echo "exitoso";
		}
		else{
			echo "noexitoso";
		}
	}
}

//--------------------------------
// comp_ped_form.php
//--------------------------------


if ($action == "upd_cot"){
	$cot=$_POST["cot"];
	
	$newfact = mysql_query("UPDATE `h01sg_pedidos` SET `user`='$user', `delete`='2' WHERE`consec`='$cot' AND `delete`<>1") 
	or die(mysql_error());
	
	if($newfact){
		echo "Se actualizó el pedido con exito";
	}
	else{
		echo "No se actualizó el pedido";
	}
}

if ($action == "upd_prodc"){
	$cot=$_POST["cot"];
	$ref=$_POST["ref"];
	
	$newInve = mysql_query("UPDATE `h01sg_pedidos_detalle` SET `user`='$user', `delete`='2'
	WHERE `ref`='$ref' AND`consec`='$cot' AND `delete`<>1 ") 
	or die(mysql_error());
	
	if($newInve){
		echo "Se actualizó el detalle con exito";
	}
	else{
		echo "No se actualizó el detalle con exito";
	}
}

?>