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
// invent_prod.php
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

if (isset($_GET['getref'])){
	$ref=$_GET["getref"];
	
	$newProd = mysql_query("SELECT * FROM `h01sg_producto` WHERE `ref`='$ref' AND `delete`<>1 ") 
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
	`f_pago`, `forma_pago`, `costo`, `cant`, `obs`, `user`) VALUES ('$consec','$puntov','$cot','$prove','$ced', '$tel',
	'$fecha','$fpago','$forma','$costo','$cant','$obs','$user')") 
	or die(mysql_error());
	
	if($newfact){
		echo "Se creo la factura con exito";
	}
	else{
		echo "No se creo la factura con exito";
	}
}

if ($action == "new_prod"){
	$rfid=$_POST["rfid"];
	echo ' *-'.trim($ref=$_POST["ref"]);
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
	echo $n = mysql_num_rows($revref);
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
	
	$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`, `punto_ini`, `cant`, 
	`obs`,`mov`, `consec`, `costo`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntov','$puntov',
	'$cant','$obs','$pre','$consec','$costo','$fecha','$user')") 
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
		
	$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
	or die(mysql_error());
	$rev = mysql_num_rows($revref);
	$row_rev = @mysql_fetch_assoc($revref);
	if ($rev >=1){
		$canti = $row_rev['cant_ini']+$cant;
		$tot = $row_rev['cant_final']+$cant;
		$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_ini`='$canti',`cant_final`='$tot',
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
// invent_regmulti.php
//--------------------------------


if ($action == "del_pict"){
	$id=$_POST["id"];
	$delprod = mysql_query("DELETE FROM `h01sg_temp_img` WHERE `id`='$id' ") 
	or die(mysql_error());
	
	if($delprod){
		echo "Se borro la imagen con exito";
	}
	else{
		echo "No se borro la imagen con exito";
	}
}

//--------------------------------
// invent_regmulti2.php
//--------------------------------

?>