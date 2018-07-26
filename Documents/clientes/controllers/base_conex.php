<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); 
$usuario_resp=$usuario;
////////////////////////////////////////////VERIFICAR  Clientes //////////////////////
if (isset($_GET['verifC'])){
	 $id=$_GET['verifC']; 
	 $searchId = mysql_query("SELECT * FROM `d89xz_clientes` WHERE `cedula`='$id' and `delete`<>1 ") or die(mysql_error()); 
	$ids = mysql_num_rows($searchId);
	if($ids > 0){
		echo'existe';
	}else{
		echo'noexiste';
	}
	return false;	
}
////////////////////////////////////////////Insertar Clientes //////////////////////////

if(isset($_POST['insertarC'])){
	 $ids=$_POST['insertarC'];
	array_push($ids, 'user');
	$vals=$_POST['vals'];
	array_push($vals, $usuario_resp);
	$values = implode("', '", $vals); 
	$values = "'".$values."'"; 
	$columns = implode("`, `", $ids); 
	$columns = "`".$columns."`"; 
	mysql_query("INSERT INTO d89xz_clientes (".$columns.") VALUES (".$values.")")  or die(mysql_error());
	
	print_r($ids);
	print_r($vals);
	return false;
}
//////////////////////////Actualizar Clientes/////////////////////////////////////////////////////////////////

if(isset($_POST['verifCA'])){
	$ids=$_POST['verifCA'];
	$vals=$_POST['vals'];
mysql_query("UPDATE  d89xz_clientes set `$ids[0]`='$vals[0]',`$ids[1]`='$vals[1]', `$ids[2]`='$vals[2]', `$ids[3]`='$vals[3]', `$ids[4]`='$vals[4]',`$ids[5]`='$vals[5]',`$ids[6]`='$vals[6]',`$ids[7]`='$vals[7]',`$ids[8]`='$vals[8]', `$ids[9]`='$vals[9]',`user`='$usuario_resp'  WHERE id='$vals[10]' ", $conexion) or die(mysql_error().'51');
	print_r($ids);
	print_r($vals);
	return false;
	
}





////////////////////////////////////////////VERIFICAR  Proveedores //////////////////////
if (isset($_GET['verifP'])){
	 $id=$_GET['verifP']; 
	 $searchId = mysql_query("SELECT * FROM `d89xz_prove` WHERE `cedula`='$id' and `delete`<>1 ") or die(mysql_error()); 
	$ids = mysql_num_rows($searchId);
	if($ids > 0){
		echo'existe';
	}else{
		echo'noexiste';
	}
	return false;	
}
////////////////////////////////////////////Insertar Proveedores //////////////////////////////////////
if(isset($_POST['insertarP'])){
	 $ids=$_POST['insertarP'];
	array_push($ids, 'user');
	$vals=$_POST['vals'];
	array_push($vals, $usuario_resp);
	$values = implode("', '", $vals); 
	$values = "'".$values."'"; 
	$columns = implode("`, `", $ids); 
	$columns = "`".$columns."`"; 
	mysql_query("INSERT INTO d89xz_prove (".$columns.") VALUES (".$values.")")  or die(mysql_error());
	
	print_r($ids);
	print_r($vals);
	return false;
}
//////////////////////////Actualizar Proveedores/////////////////////////////////////////////////////////////////

if(isset($_POST['verifPA'])){
	$ids=$_POST['verifPA'];
	$vals=$_POST['vals'];
mysql_query("UPDATE  d89xz_prove set `$ids[0]`='$vals[0]',`$ids[1]`='$vals[1]', `$ids[2]`='$vals[2]', `$ids[3]`='$vals[3]', `$ids[4]`='$vals[4]',`$ids[5]`='$vals[5]',`$ids[6]`='$vals[6]',`$ids[7]`='$vals[7]',`$ids[8]`='$vals[8]',`$ids[9]`='$vals[9]',`$ids[10]`='$vals[10]',`$ids[11]`='$vals[11]',`$ids[12]`='$vals[12]',`$ids[13]`='$vals[13]',`$ids[14]`='$vals[14]',`$ids[15]`='$vals[15]',`$ids[16]`='$vals[16]',`$ids[17]`='$vals[17]',`$ids[18]`='$vals[18]',`$ids[19]`='$vals[19]',`$ids[20]`='$vals[20]',`$ids[21]`='$vals[21]',`$ids[22]`='$vals[22]',`$ids[23]`='$vals[23]', `user`='$usuario_resp'  WHERE id='$vals[24]' ", $conexion) or die(mysql_error().'51');
	print_r($ids);
	print_r($vals);
	return false;
	
}
?>