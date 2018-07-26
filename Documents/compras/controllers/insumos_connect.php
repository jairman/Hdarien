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
// compras_insumo.php
//--------------------------------

if (isset($_GET['getprove'])){
	$prove=$_GET["getprove"];
	
	$newProd = mysql_query("SELECT * FROM `d89xz_prove` WHERE `nombre`='$prove' AND `delete`<>1 ") 
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

if (isset($_GET['getOrden'])){
	$ced=$_GET["getOrden"];
	
	$newIns = mysql_query("SELECT DISTINCT `ref` FROM `h01sg_insumos_coti` WHERE (`proveedor`='$ced' OR `proveedor`='') 
	AND `delete`<>1 ") or die(mysql_error());
	$rows = array();
	
	while($r = mysql_fetch_assoc($newIns)) {
		$ref = $r['ref'];
		$newIns1 = mysql_query("SELECT `ref`, `cod_barra`, `rfid`, `desc`, `unidad`, `present`, `contenido`, `codigo`, `color`, 
		`marca`, `categoria`, `proveedor`, `sub_cat`, `costo_und`, SUM(cant_cotiza) as coti, SUM(cant_p) as pedi 
		FROM `h01sg_insumos_coti` WHERE `ref`='$ref' AND `delete`<>1 ") or die(mysql_error());
		while($p = mysql_fetch_assoc($newIns1)) {
			$rows[] = $p;
			
		}
	}
	if($newIns){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getCat'])){
	
	$newcat = mysql_query("SELECT DISTINCT `cat` FROM `h01sg_categoria_insumo` WHERE `delete`<>1 ORDER BY `cat` ASC") or die(mysql_error());
	$rows = array();
	
	while($r = mysql_fetch_assoc($newcat)) {
		$ref = $r['cat'];
		$newCat1 = mysql_query("SELECT `cat`, `nombre` FROM `h01sg_categoria_insumo` WHERE `cat`='$ref' AND `delete`<>1 ") or die(mysql_error());
		while($p = mysql_fetch_assoc($newCat1)) {
			$rows[] = $p;
			
		}
	}
	if($newcat){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getUnd'])){
	
	$newund = mysql_query("SELECT DISTINCT `und` FROM `h01sg_unidad_insumos` WHERE `delete`<>1 ORDER BY `und` ASC") or die(mysql_error());
	$rows = array();
	
	while($r = mysql_fetch_assoc($newund)) {
		$ref = $r['und'];
		$newUnd1 = mysql_query("SELECT `und`, `nombre` FROM `h01sg_unidad_insumos` WHERE `und`='$ref' AND `delete`<>1 ") or die(mysql_error());
		while($p = mysql_fetch_assoc($newUnd1)) {
			$rows[] = $p;
		}
	}
	if($newund){
		echo json_encode($rows);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getref'])){
	$ref=$_GET["getref"];
	
	$newProd = mysql_query("SELECT * FROM `h01sg_insumos` WHERE `ref`='$ref' AND `delete`<>1 ") 
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
	$searchRfid = mysql_query("SELECT * FROM `h01sg_insumos` WHERE `ref`='$ref' AND `delete`<>1 ") or die(mysql_error());
	$rfid = mysql_num_rows($searchRfid);
	if($rfid > 0){
		echo'existe';
	}else{
		echo'noexiste';
	}
	return false;	
}

if (isset($_GET['getconsecf'])){
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `h01sg_compra` 
	WHERE `delete`<>1 ORDER BY `consec` DESC ") or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);			
	$factura1= $row_drio1['consec'];
	if($factura1!=''){
		$factura2=$factura1;
	}else{
		$factura2=0;	
	}
	$factura=$factura2 + 1;
	
	if($factura){
		echo json_encode($factura);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getconsecfd'])){
	$ptov = $_GET['getconsecfd'];
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `d89xz_diario` 
	WHERE `delete`<>1 AND `hacienda`='$ptov' ORDER BY `factura` DESC ") or die(mysql_error());
	$row_drio1 = mysql_fetch_assoc($drio1);			
	$factura1= $row_drio1['factura'];
	if($factura1!=''){
		$factura2=$factura1;
	}else{
		$factura2=0;	
	}
	$factura=$factura2 + 1;
	
	if($factura){
		echo json_encode($factura);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if ($action == "newDiario"){
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
	  $diario = $_POST["diario"];
	  
	  $setDiairoV = mysql_query(" INSERT INTO `d89xz_diario`(`fecha`, `factura`, `f_alarma`, `concep`,`consec_fact`, `estado`, `f_pago`, 
	  `valor`, `cliente`, `cedula`, `comentario`, `hacienda`, `user`) VALUES 
	  ('$fecha','$diario','$fecha_pago','$concepto','$consec','$estado','$fpago','$precio','$cliente','$ced','$descr',
	  '$puntov','$user') ") or die(mysql_error()); 
	  
	  if($setDiairoV){
		echo "Se creo el registro en la tabla de diario";
	  }
	  else{
		echo "No se creo el registro en la tabla de diario";
	  }
}

if ($action == "new_fact"){
	$consec=$_POST["consec"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$prove= $_POST["prove"];
	$tel=$_POST["tel"];
	$ced=$_POST["ced"];
	$forma=$_POST["forma"];
	$fpago=$_POST["fpago"];
	$obs=$_POST["obs"];
	$costo=$_POST["costo"];
	$cant=$_POST["cant"];
	$cot=$_POST["cot"];
	$puntov=trim($_POST["puntov"]);
	
	
	$newfact = mysql_query("INSERT INTO `h01sg_compra` (`consec`,`punto_venta`, `ped`, `cliente`, `ced`, `tel`, `f_fact`, 
	`f_pago`, `forma_pago`, `costo`, `cant`, `obs`, `user`, `delete`) VALUES ('$consec','$puntov','$cot','$prove','$ced', '$tel',
	'$fecha','$fpago','$forma','$costo','$cant','$obs','$user', '4')") 
	or die(mysql_error());
	
	if($newfact){
		echo "Se creo la factura con exito";
	}
	else{
		echo "No se creo la factura con exito";
	}
}

//--------------------
// compras_insumoe.php
//--------------------

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
		echo $ref=trim($refs[$j]);
		if ($ref){
			$getDet = mysql_query("SELECT `cant` FROM `h01sg_inventario_detalle` WHERE `consec`='$consec' AND `ref`='$ref' AND `delete`<>1") 
			or die(mysql_error());
			$row_det = mysql_fetch_assoc($getDet);
			echo 'det:'.$det = $row_det['cant'];
			
			$getCont = mysql_query("SELECT `contenido` FROM `h01sg_insumos` WHERE `ref`='$ref' AND `delete`<>1") 
			or die(mysql_error());
			$row_cont = mysql_fetch_assoc($getCont);
			echo 'cont:'.$cont = $row_cont['contenido'];
			
			$pre = $det*$cont;
			
			$getInv = mysql_query("SELECT `cant_ini`,`cant_final` FROM `h01sg_inventario_insumos` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") 
			or die(mysql_error());
			$row_inv = mysql_fetch_assoc($getInv);
			echo 'inv:'.$inv = $row_inv['cant_ini'];
			echo 'tot:'.$tot = $row_inv['cant_final'];
			
			if($pre == $inv){
				
				$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `user`='$user',`delete`='1' WHERE
				`ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
				or die(mysql_error());
			
				$updref = mysql_query("UPDATE `h01sg_inventario_insumos` SET `cant_ini`='0',`cant_usada`='0',`cant_final`='0',
				`user`='$user',`delete`=1 WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
			
				if($newInve && $updref){
					echo "se borro el producto";
				}
				else{
					echo "no se borro el producto";
				}
			}else{
				$newcant = $inv - $pre;
				$newtot = $tot - $pre;
				
				$newInve = mysql_query("UPDATE `h01sg_inventario_detalle` SET `user`='$user',`delete`='1' WHERE
				`ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
				or die(mysql_error());
			
				$updref = mysql_query("UPDATE `h01sg_inventario_insumos` SET `cant_ini`='$newcant',`cant_final`='$newtot',`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
			
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

//--------------------
// compras_ini.php
//--------------------

if ($action == "anulfac"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	
	$getptov = mysql_query("SELECT * FROM `h01sg_compra` WHERE `consec`='$consec' AND `delete`<>1 ") 
	or die(mysql_error());
	$row_p = mysql_fetch_assoc($getptov);
	$puntov = $row_p['punto_venta'];
	
	//Eliminar Factura	
	$newInve = mysql_query("UPDATE `h01sg_compra` SET `obs`='Anulada',
	`user`='$user',`delete`='5' WHERE `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
	
	//Eliminar Diario
	$estado= 'Anulada';
	
	$getdiario = mysql_query("SELECT * FROM `d89xz_diario` WHERE `factura`='$consec' AND `hacienda`='$puntov' AND `delete`<>1 ") 
	or die(mysql_error());
	
	$n = mysql_num_rows($getdiario);
	
	if ($n > 0){
		$setTareas = mysql_query("UPDATE `d89xz_diario` SET `estado`='$estado', `user`='$user' WHERE `factura`='$consec' 
		AND `hacienda`='$puntov' ") or die(mysql_error());  
	}
	
	//Eliminar Inventario
	$searchref = mysql_query("SELECT * FROM `h01sg_inventario_detalle` WHERE `mov`='c' AND `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());
	
	while ($row_ref = mysql_fetch_assoc($searchref)){
		$ref = trim($row_ref['ref']);
		$cant = $row_ref['cant'];

		$searchins = mysql_query("SELECT * FROM `h01sg_insumos` WHERE `ref`='$ref' AND `delete`<>1") 
		or die(mysql_error());
		$rowins = mysql_fetch_assoc($searchins);
		$cont = $rowins['contenido'];		
		$det = $cant * $cont;
		
		$getInv = mysql_query("SELECT `cant_ini`,`cant_final` FROM `h01sg_inventario_insumos` 
		WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1") or die(mysql_error());
		$row_inv = mysql_fetch_assoc($getInv);
		$inv = $row_inv['cant_ini'];
		$tot = $row_inv['cant_final'];
		
		if($det == $inv){
			//$upddet = mysql_query("UPDATE `h01sg_inventario_detalle` SET `cant`='0',`user`='$user' WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
			
			$delinvent = mysql_query("UPDATE `h01sg_inventario_insumos` SET `cant_ini`='0',`cant_usada`='0',`cant_final`='0',
			`user`='$user',`delete`='1' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1 ") or die(mysql_error());
			
			$deldetail = mysql_query("INSERT INTO `h01sg_inventario_detalle_anul` SELECT *  FROM `h01sg_inventario_detalle` 
			WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
			
			$deldetail2 = mysql_query("DELETE FROM `h01sg_inventario_detalle` 
			WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
			
		}else{
			$newcant = $inv - $det;
			$newtot = $tot - $det;
			
			//$upddet = mysql_query("UPDATE `h01sg_inventario_detalle` SET `cant`='0',`user`='$user' WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
			
			$delinvent = mysql_query("UPDATE `h01sg_inventario_insumos`  SET `cant_ini`='$newcant',`cant_final`='$newtot',`user`='$user' 
			WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1 ") or die(mysql_error());
			
			$deldetail = mysql_query("INSERT INTO `h01sg_inventario_detalle_anul`  SELECT *  FROM `h01sg_inventario_detalle` 
			WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
			
			$deldetail2 = mysql_query("DELETE FROM `h01sg_inventario_detalle` 
			WHERE `ref`='$ref' AND `mov`='c' AND `consec`='$consec' AND `delete`<>1 ") or die(mysql_error());
		
		}	
	}
	
	if($newInve && $setTareas && $delinvent && $deldetail && $deldetail2){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

?>