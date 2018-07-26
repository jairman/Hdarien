<?php require_once('joom.php'); ?>
<?php require_once('../Connections/conexion.php'); ?>
<?php

ini_set('date.timezone', 'America/Bogota');
$c_date = date('Y-m-d');
$today = date("Y-m-d");//

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
		
	}
	
	$revref = mysql_query("SELECT * FROM `h01sg_compras_config` WHERE `delete`<>1") 
	or die(mysql_error());
	$rev = mysql_num_rows($revref);
	$row_rev = @mysql_fetch_assoc($revref);
	if ($rev >=1){
		$updref = mysql_query("UPDATE `h01sg_compras_config` SET `cod_barra`='$cod_barra',`rfid`='$rfid',`marca`='$marca',
		`talla`='$talla',`color`='$color',`categoria`='$categoria',`sub_cat`='$sub_cat',`precio_mayo`='$precio_mayo',
		`user`='$user' WHERE `delete`<>1")or die(mysql_error());
		
		if ( $updref ){
		echo 'Se Creo el registro de configuracion de manera exitosa';	
		}else{
			echo 'No se Creo el registro de configuracion';
		}
		
	}else{
		$insref = mysql_query("INSERT INTO `h01sg_compras_config`(`cod_barra`, `rfid`, `marca`, `talla`, `color`, `categoria`, 
		`sub_cat`, `precio_mayo`, `user`) VALUES ('$cod_barra','$rfid','$marca','$talla','$color','$categoria','$sub_cat',
		'$precio_mayo','$user')")or die(mysql_error());
		
		if ( $insref ){
			echo 'Se Creo el registro de configuracion de manera exitosa';	
		}else{
			echo 'No se Creo el registro de configuracion';
		}
		
	}

	//echo $i." ".$tama;
}

		
?>