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
// invent_cierre.php
//--------------------------------


if (isset($_GET['getconsec'])){
	$ptov = $_GET['getconsec'];
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `h01sg_inventario_cierre` 
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

if ($action == "new_cierre"){
	  $consec=$_POST["consec"];
	  $fecha=$_POST["fecha"];
	  $user=$_POST["user"];
	  $ptov=$_POST["ptov"];
	  $obs=$_POST["obs"];
	  $marca=$_POST["marca"];
	  
	  $setenca = mysql_query("INSERT INTO `h01sg_inventario_cierre`(`consec`, `punto_venta`,`marca`, `fecha`, `obs`, `user`) VALUES 
	  ('$consec','$ptov','$marca','$fecha','$obs','$user') ") or die(mysql_error()); 
	  
	  if($setenca){
		echo "Se creo el encabezado del cierre";
	  }
	  else{
		echo "No se creo el encabezado del cierre";
	  }
}

if ($action == "new_detail"){
	$consec=$_POST["consec"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$ptov=$_POST["ptov"];
	$ref=$_POST["ref"];
	$ini=$_POST["ini"];
	$tras=$_POST["tras"];
	$vent=$_POST["vent"];
	$devo=$_POST["devo"];
	$tot=$_POST["tot"];
	$fis=$_POST["fis"];
	$dif=$_POST["dif"];
	
	$setdetail = mysql_query("INSERT INTO `h01sg_inventario_cierre_detalle`(`consec`, `ref`, `punto_venta`, `cant_ini`, 
	`cant_trasl`, `cant_devo`, `cant_vend`, `cant_final`, `cant_fisica`, `diferencia`, `user`) VALUES 
	('$consec','$ref','$ptov','$ini','$tras','$devo','$vent','$tot','$fis','$dif','$user') ") or die(mysql_error()); 
	
	if($setdetail){
		if ($fis > 0){
			$setInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$fis',`cant_trasl`='0',
			`cant_devo`='0',`cant_vend`='0',`cant_final`='$fis',`user`='$user'
			 WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1 ") or die(mysql_error()); 
		}else{
			$delInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='0',`cant_trasl`='0',
			`cant_devo`='0',`cant_vend`='0',`cant_final`='0',`user`='$user', `delete`='1'
			 WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1 ") or die(mysql_error());
		}  
		echo "Se creo el detalle del cierre";
	}
	else{
		echo "No se creo el detalle del cierre";
	}
}

//--------------------------------
// invent_cierre.php
//--------------------------------

if ($action == "new_cierre2"){
	  $consec=$_POST["consec"];
	  $fecha=$_POST["fecha"];
	  $user=$_POST["user"];
	  $ptov=$_POST["ptov"];
	  $obs=$_POST["obs"];
	  $prove=$_POST["prove"];
	  $ced=$_POST["ced"];
	  
	  $setenca = mysql_query("INSERT INTO `h01sg_inventario_cierre`(`consec`, `punto_venta`, `ced`, `prove`, `fecha`, `obs`, 
	  `user`, `delete`) VALUES ('$consec','$ptov','$ced','$prove','$fecha','$obs','$user','2') ") or die(mysql_error()); 
	  
	  if($setenca){
		echo "Se creo el encabezado del cierre";
	  }
	  else{
		echo "No se creo el encabezado del cierre";
	  }
}

if (isset($_GET['getconseca'])){
	
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
		echo json_encode('noexitoso');
	}
	return false;	
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
	$puntov=trim($_POST["puntov"]);
	
	
	$newfact = mysql_query("INSERT INTO `h01sg_compra` (`consec`,`punto_venta`, `cliente`, `ced`, `tel`, `f_fact`, 
	`f_pago`, `forma_pago`, `costo`, `cant`, `obs`, `user`) VALUES ('$consec','$puntov','$prove','$ced', '$tel',
	'$fecha','$fpago','$forma','$costo','$cant','$obs','$user')") 
	or die(mysql_error());
	
	if($newfact){
		echo "Se creo la factura con exito";
	}
	else{
		echo "No se creo la factura con exito";
	}
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

if ($action == "updTarea"){
	  $tarea=$_POST["tarea"];
	  $estado=$_POST["estado"];
	  $descr=$_POST["descr"];
	  $fecha_pago=$_POST["fecha_pago"];
	  $fecha=$_POST["fecha"]; 
	  $user=$_POST["user"];
	  $puntov=$_POST["puntov"];
	  $consec=$_POST["consec"];
	  
	  $setTareas = mysql_query("INSERT INTO `d89xz_tareas`(`tarea`, `consec`, `fecha_ini`, `fecha`, `estado`, 
	  `jorn`, `hac`, `respon`, `comen`, `user`) 
	  VALUES ('$tarea','$consec','$fecha','$fecha_pago','$estado','$fecha','$puntov','$user','$descr','$user')") or die(mysql_error()); 
	  
	  if($setTareas){
		echo "Se creo el registro en la tabla de tareas";
	  }
	  else{
		echo "No se creo el registro en la tabla de tareas";
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
	
	$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`, `punto_ini`, `cant`, 
	`obs`,`mov`, `consec`, `costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntov',
	'$cant','$obs','$pre','$consec','$costo','$fecha','$user')") 
	or die(mysql_error());
	
	if($newInve){
		echo "Se creo el detalle del inventario";
	}
	else{
		echo "No se creo el detalle del inventario";
	}
}

if ($action == "del_consig"){
	echo $consec=$_POST["consec"];
	echo $puntov=$_POST["puntov"];
	echo $user=$_POST["user"];
	echo $ced=$_POST["ced"];
	
	$gconsec = mysql_query("SELECT `consec` FROM `h01sg_compra` WHERE `punto_venta`='$puntov' AND `ced`='$ced' 
	AND `forma_pago`='Consignación' AND `delete` <>1 AND `consec`<>'$consec' ") 
	or die(mysql_error());
	//echo ' n:'.$n = mysql_num_rows($gconsec);
	while ($row_consec = mysql_fetch_assoc($gconsec)){
		echo ' #'.$cons = $row_consec['consec'];
		
		$upd_compra1 = mysql_query("UPDATE `h01sg_compra` SET `user`='$user',`delete`='1' WHERE
		`consec`='$cons' AND `punto_venta`='$puntov' AND `delete`<>1 ") 
		or die(mysql_error());
		
		$upd_compra2 = mysql_query("UPDATE `h01sg_inventario_detalle` SET `user`='$user',`delete`='1' WHERE
		`punto_ini`='$puntov' AND `punto_venta`='$puntov' AND `mov`='c' AND `consec`='$cons' ") 
		or die(mysql_error());
		
	}
	
	if($upd_compra1 && $upd_compra2){
		echo "Se eliminaron las consignaciones viejas";
	}
	else{
		echo "No se eliminaron las consignaciones viejas";
	}
}


//--------------------------------
// cierre_edit.php
//--------------------------------

if ($action == "edit_cierre"){
	  $consec=$_POST["consec"];
	  $user=$_POST["user"];
	  $obs=$_POST["obs"];
	  
	  $setenca = mysql_query("UPDATE `h01sg_inventario_cierre` SET `obs`='$obs',`user`='$user'
	  WHERE `consec`='$consec' AND `delete`<>1 ") or die(mysql_error()); 
	  
	  if($setenca){
		echo "Se creo el encabezado del cierre";
	  }
	  else{
		echo "No se creo el encabezado del cierre";
	  }
}

if ($action == "edit_detail"){
	$consec=$_POST["consec"];
	$user=$_POST["user"];
	$ptov=$_POST["ptov"];
	$ref=$_POST["ref"];
	$tot=$_POST["tot"];
	$fis=$_POST["fis"];
	$fiso=$_POST["fiso"];
	$dif=$_POST["dif"];
	
	$setdetail = mysql_query("UPDATE `h01sg_inventario_cierre_detalle` SET `cant_fisica`='$fis',`diferencia`='$dif',
	`user`='$user' WHERE `consec`='$consec' AND `ref`='$ref' AND `delete`<>1 ") or die(mysql_error()); 
	
	if($setdetail){
		$res = $fis - $fiso;
			
		$getInve = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$ptov'") or die(mysql_error()); 
		echo $row_inve = mysql_fetch_assoc($getInve);
		$delete = $row_inve['delete'];
		
		if ($delete == 0){
			echo '-'.$inic = $row_inve['cant_ini'] + $res;
			echo '-'.$fin = $row_inve['cant_final'] + $res;	
			
			$setInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$inic', `cant_final`='$fin',`user`='$user'
			 WHERE `ref`='$ref' AND `punto_venta`='$ptov' AND `delete`<>1 ") or die(mysql_error()); 
		}else{
			$setInve = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$fis',`cant_trasl`='0',
			`cant_devo`='0',`cant_vend`='0',`cant_final`='$fis',`user`='$user', `delete`='0'
			 WHERE `ref`='$ref' AND `punto_venta`='$ptov'") or die(mysql_error()); 
		}
		 
		echo "Se creo el detalle del cierre";
	}else{
		echo "No se creo el detalle del cierre";
	}
}

?>