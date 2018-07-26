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
// params_und.php
//--------------------------------

if ($action == "del_und"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	//$rfid=$_POST["rfid"];
	
	$del_undm = mysql_query("UPDATE `h01sg_unidad_insumos` SET `delete`=1, `user`='$user' WHERE `und`='$und' AND `delete`<>1") or die(mysql_error());	
	
	if($del_undm){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "create_und"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	$desc=$_POST["desc"];
	
	$new_und = mysql_query("INSERT INTO `h01sg_unidad_insumos`(`und`, `nombre`,`user`) VALUES 	
	('$und','$desc','$user')") or die(mysql_error());	
	
	if($new_und){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "upd_und"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	$desc=$_POST["desc"];
	
	$upd_undm = mysql_query("UPDATE `h01sg_unidad_insumos` SET `nombre`='$desc', `user`='$user' WHERE `und`='$und' AND `delete`<>1") or die(mysql_error());	
	
	if($upd_undm){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

//--------------------------------
// params_cat.php
//--------------------------------

if ($action == "del_cat"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	//$rfid=$_POST["rfid"];
	
	$del_undc = mysql_query("UPDATE `h01sg_categoria_insumo` SET `delete`=1, `user`='$user' WHERE `cat`='$und' AND `delete`<>1") or die(mysql_error());	
	
	if($del_undc){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "create_cat"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	$desc=$_POST["desc"];
	
	$new_cat = mysql_query("INSERT INTO `h01sg_categoria_insumo`(`cat`, `nombre`,`user`) VALUES 	
	('$und','$desc','$user')") or die(mysql_error());	
	
	if($new_cat){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "upd_cat"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	$desc=$_POST["desc"];
	
	$upd_catn = mysql_query("UPDATE `h01sg_categoria_insumo` SET `nombre`='$desc', `user`='$user' WHERE `cat`='$und' AND `delete`<>1") or die(mysql_error());	
	
	if($upd_catn){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

?>