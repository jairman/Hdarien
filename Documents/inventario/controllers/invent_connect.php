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
// invent_fichae.php
//--------------------------------

if ($action == "upd_prod"){
	$ref=$_POST["ref"];
	$rfid=$_POST["rfid"];
	$cat=$_POST["cat"];
	$scat=$_POST["scat"];
	$bcode=$_POST["codb"];
	$marca=$_POST["marca"];
	$desc=$_POST["desc"];
	$talla=$_POST["talla"];
	$color=$_POST["color"];
	$precio=$_POST["precio"];
	$preciom=$_POST["preciom"];
	$user=$_POST["user"];
	
	$newProd = mysql_query("UPDATE `h01sg_producto` SET `cod_barra`='$bcode',`rfid`='$rfid',
	`marca`='$marca',`desc`='$desc',`talla`='$talla',`color`='$color',`categoria`='$cat',`sub_cat`='$scat',
	`precio_mayo`='$preciom',`precio_und`='$precio',`user`='$user'
	 WHERE `ref`='$ref' AND `delete`<>1") or die(mysql_error());	
	
	if($newProd){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}


//--------------------------------
// invent_reg.php
//--------------------------------

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

if (isset($_GET['getbarcod'])){
	$code=$_GET["getbarcod"];
	
	$newProd = mysql_query("SELECT  `ref`, `fecha`, `cod_barra`, `rfid`, `marca`, `desc`, `precio_und`, `costo_und` 
	FROM `h01sg_producto` WHERE `cod_barra`='$code' AND `delete`<>1 ") 
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

if (isset($_GET['getcantr'])){
	$ref=$_GET["getcantr"];
	$origen=$_GET["orig"];
	
	$searchCant = mysql_query("SELECT  `cant_final` FROM `h01sg_inventario` 
	WHERE `ref`='$ref' AND `punto_venta`='$origen' AND `delete`<>1 ") 
	or die(mysql_error());
	$cant = mysql_fetch_assoc($searchCant);
	if($searchCant){
		echo json_encode($cant);
	}else{
		echo "noexitoso";
	}
	return false;	
}

if (isset($_GET['getconsect'])){
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `h01sg_inventario_detalle` 
	WHERE `delete`<>1 AND `mov`='t' ORDER BY `consec` DESC ") or die(mysql_error());
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

if ($action == "new_inventreg2"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$cant=$_POST["cant"];
	$fecha=$_POST["fecha"];
	$tipo=$_POST["tipo"];
	$mov=$_POST["mov"];
	$obs=$_POST["obs"];
	$pre=$_POST["pre"];
	$puntov=$_POST["puntov"];
	$puntovd=$_POST["puntovd"];
	$user=$_POST["user"];
		
	$newInve = mysql_query("INSERT INTO `h01sg_inventario_detalle`(`ref`, `tipo_mov`, `desc_mov`, `punto_venta`,`punto_ini`, `cant`, 
	`obs`,`mov`, `consec`, `fecha`, `user`) VALUES ('$ref','$tipo','$mov','$puntovd','$puntov',
	'$cant','obs','$pre','$consec','$fecha','$user')") 
	or die(mysql_error());
	
	if($newInve){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "new_cantreg2"){
	$ref=$_POST["ref"];
	$cant=$_POST["cant"];
	$mov=$_POST["mov"];
	$puntov=$_POST["puntov"];
	$puntovd=$_POST["puntovd"];
	$user=$_POST["user"];
	$tipo=$_POST["tipo"];
		
	if ($tipo == 'Devolucion'){
		$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
		or die(mysql_error());
		$n = mysql_num_rows($revref);
		//echo 'dev'.$n.' 1 ';
		$row_rev = mysql_fetch_assoc($revref);
		if ($n >=1){
			$canti = $row_rev['cant_devo']-$cant;
			$tot = $row_rev['cant_final']-$cant;
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
	if ($tipo == 'Inventario Inicial'){
		$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
		or die(mysql_error());
		$n = mysql_num_rows($revref);
		//echo 'inv'.$n.' 2 ';
		if ($n >=1){
			$row_rev = mysql_fetch_assoc($revref);
			$canti = $row_rev['cant_trasl']-$cant;
			$tot = $row_rev['cant_final']-$cant;
			$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_trasl`='$canti',`cant_final`='$tot',
			`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
			if($updref){
				$createinv =  mysql_query("INSERT INTO `h01sg_inventario`(`ref`, `punto_venta`, `cant_ini`, `cant_final`, 
				`user`) VALUES ('$ref','$puntovd','$cant','$cant','$user')")or die(mysql_error());
				if($createinv){
					echo "Exitosa";
				}
				else{
					echo "Noexitosa";
				}
			}
		}
	}
	if ($tipo == 'Traslado'){
		$revref = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ") 
		or die(mysql_error());
		$n = mysql_num_rows($revref);
		//echo 'trasl'.$n.' 3 ';
		$row_rev = mysql_fetch_assoc($revref);
		if ($n >=1){
			$canti = $row_rev['cant_trasl']-$cant;
			$tot = $row_rev['cant_final']-$cant;
			$updref = mysql_query("UPDATE `h01sg_inventario` SET `cant_trasl`='$canti',`cant_final`='$tot',
			`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntov' AND `delete`<>1  ")or die(mysql_error());
			if($updref){
				$revrefd = mysql_query("SELECT * FROM `h01sg_inventario` WHERE `ref`='$ref' AND `punto_venta`='$puntovd' 
				AND `delete`<>1 ") or die(mysql_error());
				$n = mysql_num_rows($revrefd);
				//echo 'trasl'.$n.' 4 ';
				$row_revd = mysql_fetch_assoc($revrefd);
				if ($n >=1){
					$cantid = $row_revd['cant_trasl']+$cant;
					$totd = $row_revd['cant_final']+$cant;
					$updref2 = mysql_query("UPDATE `h01sg_inventario` SET `cant_trasl`='$cantid',`cant_final`='$totd',
					`user`='$user' WHERE `ref`='$ref' AND `punto_venta`='$puntovd' AND `delete`<>1  ")or die(mysql_error());
					if($updref2){
						echo "Exitosa";
					}
					else{
						echo "Noexitosa";
					}
				}else{
					$insertref = mysql_query("INSERT INTO `h01sg_inventario`(`ref`, `punto_venta`, `cant_trasl`,
					`cant_final`, `user`) VALUES ('$ref','$puntovd','$cant','$cant','$user') ")or die(mysql_error());
					if($insertref){
						echo "Exitosa";
					}
					else{
						echo "Noexitosa";
					}
				}
			}
		}
	}
}

?>