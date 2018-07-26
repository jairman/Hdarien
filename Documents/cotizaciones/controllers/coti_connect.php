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
// coti_form.php
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

if (isset($_GET['getconsecf'])){
	
	mysql_select_db($database_conexion, $conexion);
	$drio1 = mysql_query("SELECT * FROM `h01sg_cotizaciones` 
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

if ($action == "new_fact"){
	$consec=$_POST["consec"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$prove= $_POST["prove"];
	$tel=$_POST["tel"];
	$ced=$_POST["ced"];
	$obs=$_POST["obs"];
	$costo=$_POST["costo"];
	$cant=$_POST["cant"];
	$orig=$_POST["orig"];
	$fvig=$_POST["fvig"];
	
	$newfact = mysql_query("INSERT INTO `h01sg_cotizaciones` (`consec`, `punto_venta`, `cliente`, `ced`, `tel`, `f_fact`, `f_vig`, 
	`costo`, `cant`, `total`, `obs`, `user`) VALUES ('$consec','$orig','$prove','$ced','$tel','$fecha','$fvig','$costo','$cant',
	'$costo','$obs','$user')") or die(mysql_error());
	
	if($newfact){
		echo "Se creo la factura con exito";
	}
	else{
		echo "No se creo la factura con exito";
	}
}

if ($action == "new_inventreg"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$desc=$_POST["desc"];
	$marca=$_POST["marca"];
	$cant=$_POST["cant"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$costo=$_POST["costo"];
	
	$newInve = mysql_query("INSERT INTO `h01sg_cotizaciones_detalle`(`ref`, `desc`, `marca`, `cant`, `consec`, `costo`, 
	`fecha`, `user`) VALUES ('$ref','$desc','$marca','$cant','$consec','$costo','$fecha','$user')") 
	or die(mysql_error());
	
	if($newInve){
		echo "Se creo el detalle con exito";
	}
	else{
		echo "No se creo el detalle con exito";
	}
}

//--------------------------------
// coti_edit.php
//--------------------------------

if ($action == "del_prod"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$user=$_POST["user"];
	
	$newInve = mysql_query("UPDATE `h01sg_cotizaciones_detalle` SET `user`='$user',`delete`='1' WHERE
	`ref`='$ref' AND `consec`='$consec' AND `delete`<>1") 
	or die(mysql_error());

	if($newInve){
		echo "se borro el producto de la cotizacion";
	}
	else{
		echo "no se borro el producto de la cotizacion";
	}
	
}

if ($action == "upd_fact"){
	$consec=$_POST["consec"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$prove= $_POST["prove"];
	$tel=$_POST["tel"];
	$ced=$_POST["ced"];
	$obs= $_POST["obs"];
	$costo=$_POST["costo"];
	$cant=$_POST["cant"];
	$orig=$_POST["orig"];
	$fvig=$_POST["fvig"];	
	
	$newfact = mysql_query("UPDATE `h01sg_cotizaciones` SET `cliente`='$prove',`ced`='$ced',`tel`='$tel',`f_fact`='$fecha',
	`f_vig`='$fvig',`costo`='$costo',`cant`='$cant',`total`='$costo',`obs`='$obs',`user`='$user' WHERE`consec`='$consec' 
	AND `delete`<>1") or die(mysql_error());
	
	if($newfact){
		echo "Se actualizó la factura con exito";
	}
	else{
		echo "No se actualizó la factura con exito";
	}
}

if ($action == "upd_inventreg"){
	$consec=$_POST["consec"];
	$ref=$_POST["ref"];
	$desc=$_POST["desc"];
	$marca=$_POST["marca"];
	$cant=$_POST["cant"];
	$fecha=$_POST["fecha"];
	$user=$_POST["user"];
	$costo=$_POST["costo"];
	
	$newInve = mysql_query("UPDATE `h01sg_cotizaciones_detalle` SET `desc`='$desc',`marca`='$marca',
	`cant`='$cant',`costo`='$costo',`fecha`='$fecha',`user`='$user'
	WHERE `ref`='$ref' AND`consec`='$consec' AND `delete`<>1 ") 
	or die(mysql_error());
	
	if($newInve){
		echo "Se actualizó el detalle con exito";
	}
	else{
		echo "No se actualizó el detalle con exito";
	}
}

?>