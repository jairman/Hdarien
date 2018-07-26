<?php require_once('../controllers/joom.php'); ?>
<?php require_once('../../Connections/conexion.php'); ?>
<?php

ini_set('date.timezone', 'America/Bogota');
$c_date = date('Y-m-d');
$today = date("Y-m-d");//

/*variable para definir que funcion se va a realizar*/
$action=$_POST["action"];

mysql_select_db($database_conexion, $conexion);

if(isset($_POST['campos'])){
	$campos= $_POST['campos'];
	$tama=$_POST['tam_env'];
	$user=$_POST['user'];
	
	$cod_barra = 0;
	$rfid = 0;
	$marca = 0;
	$talla = 0;
	$color = 0;
	$categoria = 0;
	$sub_cat = 0;
	$precio_mayo = 0;
	$ins_color = 0;
	$ins_marca = 0;
	
	for($j=0;$j<$tama;$j++){
		$campo=trim($campos[$j]);//
		if ($campo == 'cod_barra'){
			$cod_barra = 1;	
		}
		if ($campo == 'rfid'){
			$rfid = 1;	
		}
		if ($campo == 'marca'){
			$marca = 1;	
		}
		if ($campo == 'talla'){
			$talla = 1;	
		}
		if ($campo == 'color'){
			$color = 1;	
		}
		if ($campo == 'categoria'){
			$categoria = 1;	
		}
		if ($campo == 'sub_cat'){
			$sub_cat = 1;	
		}
		if ($campo == 'precio_mayo'){
			$precio_mayo = 1;	
		}
		if ($campo == 'ins_color'){
			$ins_color = 1;	
		}
		if ($campo == 'ins_marca'){
			$ins_marca = 1;	
		}
		
	}
	
	$revref = mysql_query("SELECT * FROM `h01sg_compras_config` WHERE `delete`<>1") 
	or die(mysql_error());
	$rev = mysql_num_rows($revref);
	$row_rev = @mysql_fetch_assoc($revref);
	if ($rev >=1){
		$updref = mysql_query("UPDATE `h01sg_compras_config` SET `cod_barra`='$cod_barra',`rfid`='$rfid',`marca`='$marca',
		`talla`='$talla',`color`='$color',`categoria`='$categoria',`sub_cat`='$sub_cat',`precio_mayo`='$precio_mayo',
		`ins_color`='$ins_color', `ins_marca`='$ins_marca', `user`='$user' WHERE `delete`<>1")or die(mysql_error());
		
		if ( $updref ){
		echo 'Se Creo el registro de configuracion de manera exitosa';	
		}else{
			echo 'No se Creo el registro de configuracion ';
		}
		
	}else{
		$insref = mysql_query("INSERT INTO `h01sg_compras_config`(`cod_barra`, `rfid`, `marca`, `talla`, `color`, `categoria`, 
		`sub_cat`, `precio_mayo`, `ins_color`, `ins_marca`, `user`) VALUES ('$cod_barra','$rfid','$marca','$talla','$color',
		'$categoria','$sub_cat','$precio_mayo','$ins_color','$ins_marca','$user')")or die(mysql_error());
		
		if ( $insref ){
			echo 'Se Creo el registro de configuracion de manera exitosa';	
		}else{
			echo 'No se Creo el registro de configuracion';
		}
		
	}

	//echo $i." ".$tama;
}

//--------------------------------
// config_cat.php
//--------------------------------

if ($action == "del_cat"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	//$rfid=$_POST["rfid"];
	
	$del_undc = mysql_query("UPDATE `h01sg_categoria_prod` SET `delete`=1, `user`='$user' WHERE `cat`='$und' AND `delete`<>1") or die(mysql_error());	
	
	if($del_undc){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "create_cat"){
	echo $und=$_POST["und"];
	$user=$_POST["user"];
	echo $desc=$_POST["desc"];
	
	$new_cat = mysql_query("INSERT INTO `h01sg_categoria_prod`(`cat`, `nombre`,`user`) VALUES 	
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
	
	$upd_catn = mysql_query("UPDATE `h01sg_categoria_prod` SET `nombre`='$desc', `user`='$user' WHERE `cat`='$und' AND `delete`<>1") or die(mysql_error());	
	
	if($upd_catn){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

//--------------------------------
// config_marca.php
//--------------------------------

if ($action == "del_marca"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	//$rfid=$_POST["rfid"];
	
	$del_undc = mysql_query("UPDATE `h01sg_marca_prod` SET `delete`=1, `user`='$user' WHERE `marca`='$und' AND `delete`<>1") or die(mysql_error());	
	
	if($del_undc){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "create_marca"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	$desc=$_POST["desc"];
	
	$new_cat = mysql_query("INSERT INTO `h01sg_marca_prod`(`marca`, `nombre`,`user`) VALUES 	
	('$und','$desc','$user')") or die(mysql_error());	
	
	if($new_cat){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

if ($action == "upd_marca"){
	$und=$_POST["und"];
	$user=$_POST["user"];
	$desc=$_POST["desc"];
	
	$upd_catn = mysql_query("UPDATE `h01sg_marca_prod` SET `nombre`='$desc', `user`='$user' WHERE `marca`='$und' AND `delete`<>1") or die(mysql_error());	
	
	if($upd_catn){
		echo "exitoso";
	}
	else{
		echo "noexitoso";
	}
}

		
?>