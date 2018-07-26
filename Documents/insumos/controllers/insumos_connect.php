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
	echo $ref=$_POST["ref"];
	//$bcode=$_POST["codb"];
	//$rfid=$_POST["rfid"];
	echo $mina=$_POST["min"];
	echo $maxa=$_POST["max"];
	$cat=$_POST["cat"];
	$und=$_POST["und"];
	$marca=$_POST["marca"];
	$desc=$_POST["desc"];
	$cont=$_POST["cont"];
	$cod=$_POST["cod"];
	$pre=$_POST["pre"];
	$color=$_POST["color"];
	$min=$_POST["precio"];
	$max=$_POST["preciom"];
	$user=$_POST["user"];
	
	$newProd = mysql_query("UPDATE `h01sg_insumos` SET `desc`='$desc',`unidad`='$und',`present`='$pre', 
	`contenido`='$cont',`codigo`='$cod',`color`='$color',`marca`='$marca',`categoria`='$cat',`max`='$maxa',`min`='$mina',
	`user`='$user' WHERE `ref`='$ref' AND `delete`<>1") or die(mysql_error());	
	
	if($newProd){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

?>